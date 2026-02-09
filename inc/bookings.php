<?php
/**
 * Ellievated Beauty - Booking Management
 *
 * Custom database table for storing bookings, AJAX availability
 * checking, Stripe Checkout deposits, and admin page.
 *
 * @package Ellievated
 */

// ─── Database Table ──────────────────────────────────────────────

/**
 * Create or update the bookings table.
 */
function ellievated_create_bookings_table(): void
{
    global $wpdb;
    $table = $wpdb->prefix . "ellievated_bookings";
    $charset = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table (
        id BIGINT(20) UNSIGNED NOT NULL AUTO_INCREMENT,
        service_slug VARCHAR(200) NOT NULL,
        service_name VARCHAR(200) NOT NULL,
        booking_date DATE NOT NULL,
        booking_time VARCHAR(20) NOT NULL,
        first_name VARCHAR(100) NOT NULL,
        last_name VARCHAR(100) DEFAULT '',
        email VARCHAR(200) NOT NULL,
        phone VARCHAR(50) DEFAULT '',
        message TEXT,
        status VARCHAR(20) NOT NULL DEFAULT 'pending',
        stripe_session_id VARCHAR(200) DEFAULT '',
        stripe_payment_id VARCHAR(200) DEFAULT '',
        deposit_amount INT NOT NULL DEFAULT 0,
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY booking_date (booking_date),
        KEY status (status)
    ) $charset;";

    require_once ABSPATH . "wp-admin/includes/upgrade.php";
    dbDelta($sql);
}
add_action("after_switch_theme", "ellievated_create_bookings_table");

/**
 * Auto-create/update table on admin load when version changes.
 */
function ellievated_maybe_create_bookings_table(): void
{
    $db_version = "1.1";
    if (get_option("ellievated_bookings_db_version") !== $db_version) {
        ellievated_create_bookings_table();
        update_option("ellievated_bookings_db_version", $db_version);
    }
}
add_action("admin_init", "ellievated_maybe_create_bookings_table");

// ─── CRUD ────────────────────────────────────────────────────────

/**
 * Save a booking to the database.
 *
 * @param array $data Booking fields.
 * @return int|false Insert ID on success, false on failure.
 */
function ellievated_save_booking(array $data)
{
    global $wpdb;
    $table = $wpdb->prefix . "ellievated_bookings";

    $result = $wpdb->insert(
        $table,
        [
            "service_slug" => sanitize_text_field($data["service_slug"] ?? ""),
            "service_name" => sanitize_text_field($data["service_name"] ?? ""),
            "booking_date" => sanitize_text_field($data["booking_date"] ?? ""),
            "booking_time" => sanitize_text_field($data["booking_time"] ?? ""),
            "first_name" => sanitize_text_field($data["first_name"] ?? ""),
            "last_name" => sanitize_text_field($data["last_name"] ?? ""),
            "email" => sanitize_email($data["email"] ?? ""),
            "phone" => sanitize_text_field($data["phone"] ?? ""),
            "message" => sanitize_textarea_field($data["message"] ?? ""),
            "status" => "pending",
            "deposit_amount" => absint($data["deposit_amount"] ?? 0),
            "created_at" => current_time("mysql"),
        ],
        [
            "%s",
            "%s",
            "%s",
            "%s",
            "%s",
            "%s",
            "%s",
            "%s",
            "%s",
            "%s",
            "%d",
            "%s",
        ],
    );

    return $result ? $wpdb->insert_id : false;
}

/**
 * Get booked (non-cancelled) time slots for a given date.
 *
 * @param string $date YYYY-MM-DD format.
 * @return array List of booked time strings.
 */
function ellievated_get_booked_times(string $date): array
{
    global $wpdb;
    $table = $wpdb->prefix . "ellievated_bookings";

    return $wpdb->get_col(
        $wpdb->prepare(
            "SELECT booking_time FROM $table WHERE booking_date = %s AND status != 'cancelled'",
            $date,
        ),
    );
}

// ─── AJAX Availability ──────────────────────────────────────────

/**
 * AJAX handler: return booked times for a date.
 */
function ellievated_ajax_check_availability(): void
{
    check_ajax_referer("ellievated_booking_availability", "nonce");

    $date = sanitize_text_field($_POST["date"] ?? "");
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
        wp_send_json_error("Invalid date format.");
    }

    $booked = ellievated_get_booked_times($date);
    wp_send_json_success(["booked" => $booked]);
}
add_action(
    "wp_ajax_ellievated_check_availability",
    "ellievated_ajax_check_availability",
);
add_action(
    "wp_ajax_nopriv_ellievated_check_availability",
    "ellievated_ajax_check_availability",
);

/**
 * Pass AJAX URL and nonce to frontend JS.
 */
function ellievated_localize_booking_script(): void
{
    if (!is_page_template("contact.php")) {
        return;
    }

    wp_localize_script("ellievated-main", "ellievatedBooking", [
        "ajaxUrl" => admin_url("admin-ajax.php"),
        "nonce" => wp_create_nonce("ellievated_booking_availability"),
    ]);
}
add_action("wp_enqueue_scripts", "ellievated_localize_booking_script", 20);

// ─── Stripe Integration ─────────────────────────────────────────

/**
 * Get Stripe API keys from options.
 */
function ellievated_get_stripe_keys(): array
{
    return [
        "secret" => get_option("ellievated_stripe_secret_key", ""),
        "publishable" => get_option("ellievated_stripe_publishable_key", ""),
        "webhook_secret" => get_option("ellievated_stripe_webhook_secret", ""),
    ];
}

/**
 * Get the configured deposit amount in cents.
 */
function ellievated_get_deposit_amount(): int
{
    return absint(get_option("ellievated_deposit_amount", 0));
}

/**
 * Check if Stripe is fully configured.
 */
function ellievated_stripe_is_configured(): bool
{
    $keys = ellievated_get_stripe_keys();
    return !empty($keys["secret"]) && ellievated_get_deposit_amount() > 0;
}

/**
 * Make a Stripe API request.
 *
 * @param string $endpoint API endpoint path (e.g. "/v1/checkout/sessions").
 * @param array  $body     Request body parameters.
 * @param string $method   HTTP method.
 * @return array|false Decoded response or false on failure.
 */
function ellievated_stripe_request(
    string $endpoint,
    array $body = [],
    string $method = "POST",
) {
    $keys = ellievated_get_stripe_keys();
    if (empty($keys["secret"])) {
        return false;
    }

    $args = [
        "method" => $method,
        "headers" => [
            "Authorization" => "Bearer " . $keys["secret"],
            "Content-Type" => "application/x-www-form-urlencoded",
        ],
        "timeout" => 30,
    ];

    if ($method === "POST" && !empty($body)) {
        $args["body"] = $body;
    }

    $response = wp_remote_request("https://api.stripe.com" . $endpoint, $args);

    if (is_wp_error($response)) {
        return false;
    }

    return json_decode(wp_remote_retrieve_body($response), true);
}

/**
 * Create a Stripe Checkout Session for a booking deposit.
 *
 * @param int   $booking_id   The booking row ID.
 * @param array $booking_data The booking data (service_name, email, etc.).
 * @return string|false Checkout URL or false on failure.
 */
function ellievated_create_checkout_session(
    int $booking_id,
    array $booking_data,
) {
    $deposit = ellievated_get_deposit_amount();
    if ($deposit <= 0) {
        return false;
    }

    $contact_url = get_permalink(get_page_by_path("contact"));
    if (!$contact_url) {
        $contact_url = home_url("/contact/");
    }

    $session = ellievated_stripe_request("/v1/checkout/sessions", [
        "mode" => "payment",
        "customer_email" => sanitize_email($booking_data["email"] ?? ""),
        "line_items[0][price_data][currency]" => "usd",
        "line_items[0][price_data][product_data][name]" =>
            "Booking Deposit: " . ($booking_data["service_name"] ?? "Service"),
        "line_items[0][price_data][unit_amount]" => $deposit,
        "line_items[0][quantity]" => 1,
        "metadata[booking_id]" => $booking_id,
        "success_url" => add_query_arg(
            [
                "booking_confirmed" => "1",
                "session_id" => "{CHECKOUT_SESSION_ID}",
            ],
            $contact_url,
        ),
        "cancel_url" => add_query_arg("booking_cancelled", "1", $contact_url),
    ]);

    if (!$session || empty($session["url"]) || !empty($session["error"])) {
        return false;
    }

    // Store session ID on the booking
    global $wpdb;
    $wpdb->update(
        $wpdb->prefix . "ellievated_bookings",
        [
            "stripe_session_id" => sanitize_text_field($session["id"]),
            "deposit_amount" => $deposit,
        ],
        ["id" => $booking_id],
        ["%s", "%d"],
        ["%d"],
    );

    return $session["url"];
}

/**
 * Verify a completed Checkout Session and confirm the booking.
 *
 * @param string $session_id Stripe Checkout Session ID.
 * @return array|false Booking row on success, false on failure.
 */
function ellievated_verify_checkout_session(string $session_id)
{
    $session = ellievated_stripe_request(
        "/v1/checkout/sessions/" . urlencode($session_id),
        [],
        "GET",
    );

    if (!$session || ($session["payment_status"] ?? "") !== "paid") {
        return false;
    }

    $booking_id = absint($session["metadata"]["booking_id"] ?? 0);
    if (!$booking_id) {
        return false;
    }

    global $wpdb;
    $table = $wpdb->prefix . "ellievated_bookings";

    // Confirm the booking and store payment ID
    $wpdb->update(
        $table,
        [
            "status" => "confirmed",
            "stripe_payment_id" => sanitize_text_field(
                $session["payment_intent"] ?? "",
            ),
        ],
        ["id" => $booking_id],
        ["%s", "%s"],
        ["%d"],
    );

    return $wpdb->get_row(
        $wpdb->prepare("SELECT * FROM $table WHERE id = %d", $booking_id),
    );
}

// ─── Stripe Webhook ─────────────────────────────────────────────

/**
 * Register the webhook REST endpoint.
 */
function ellievated_register_webhook_endpoint(): void
{
    register_rest_route("ellievated/v1", "/stripe-webhook", [
        "methods" => "POST",
        "callback" => "ellievated_handle_stripe_webhook",
        "permission_callback" => "__return_true",
    ]);
}
add_action("rest_api_init", "ellievated_register_webhook_endpoint");

/**
 * Handle incoming Stripe webhook events.
 */
function ellievated_handle_stripe_webhook(
    \WP_REST_Request $request,
): \WP_REST_Response {
    $keys = ellievated_get_stripe_keys();
    $payload = $request->get_body();
    $sig_header = $request->get_header("Stripe-Signature");

    // Verify signature if webhook secret is configured
    if (!empty($keys["webhook_secret"]) && $sig_header) {
        $elements = [];
        foreach (explode(",", $sig_header) as $part) {
            [$key, $value] = explode("=", trim($part), 2);
            $elements[$key] = $value;
        }

        $timestamp = $elements["t"] ?? "";
        $signature = $elements["v1"] ?? "";

        if (!$timestamp || !$signature) {
            return new \WP_REST_Response(["error" => "Invalid signature"], 400);
        }

        $signed_payload = $timestamp . "." . $payload;
        $expected = hash_hmac(
            "sha256",
            $signed_payload,
            $keys["webhook_secret"],
        );

        if (!hash_equals($expected, $signature)) {
            return new \WP_REST_Response(
                ["error" => "Signature mismatch"],
                400,
            );
        }
    }

    $event = json_decode($payload, true);
    if (!$event || !isset($event["type"])) {
        return new \WP_REST_Response(["error" => "Invalid payload"], 400);
    }

    if ($event["type"] === "checkout.session.completed") {
        $session = $event["data"]["object"] ?? [];
        $booking_id = absint($session["metadata"]["booking_id"] ?? 0);

        if ($booking_id && ($session["payment_status"] ?? "") === "paid") {
            global $wpdb;
            $wpdb->update(
                $wpdb->prefix . "ellievated_bookings",
                [
                    "status" => "confirmed",
                    "stripe_payment_id" => sanitize_text_field(
                        $session["payment_intent"] ?? "",
                    ),
                ],
                ["id" => $booking_id],
                ["%s", "%s"],
                ["%d"],
            );
        }
    }

    return new \WP_REST_Response(["received" => true], 200);
}

// ─── Admin Page ─────────────────────────────────────────────────

/**
 * Register the Bookings admin menu page.
 */
function ellievated_bookings_admin_menu(): void
{
    add_menu_page(
        "Bookings",
        "Bookings",
        "manage_options",
        "ellievated-bookings",
        "ellievated_bookings_admin_page",
        "dashicons-calendar-alt",
        30,
    );
}
add_action("admin_menu", "ellievated_bookings_admin_menu");

/**
 * Render the Bookings admin page.
 */
function ellievated_bookings_admin_page(): void
{
    global $wpdb;
    $table = $wpdb->prefix . "ellievated_bookings";

    // Handle settings save
    if (
        isset($_POST["ellievated_save_stripe_settings"]) &&
        wp_verify_nonce(
            $_POST["_stripe_nonce"] ?? "",
            "ellievated_stripe_settings",
        )
    ) {
        update_option(
            "ellievated_stripe_secret_key",
            sanitize_text_field($_POST["stripe_secret_key"] ?? ""),
        );
        update_option(
            "ellievated_stripe_publishable_key",
            sanitize_text_field($_POST["stripe_publishable_key"] ?? ""),
        );
        update_option(
            "ellievated_stripe_webhook_secret",
            sanitize_text_field($_POST["stripe_webhook_secret"] ?? ""),
        );

        $deposit_dollars = floatval($_POST["deposit_amount"] ?? 0);
        update_option(
            "ellievated_deposit_amount",
            absint($deposit_dollars * 100),
        );

        echo '<div class="notice notice-success is-dismissible"><p>Settings saved.</p></div>';
    }

    // Handle status update actions
    if (isset($_GET["action"], $_GET["booking_id"], $_GET["_wpnonce"])) {
        $action = sanitize_text_field($_GET["action"]);
        $booking_id = absint($_GET["booking_id"]);

        if (
            in_array($action, ["confirm", "cancel"], true) &&
            wp_verify_nonce(
                $_GET["_wpnonce"],
                "ellievated_booking_" . $action . "_" . $booking_id,
            )
        ) {
            $new_status = $action === "confirm" ? "confirmed" : "cancelled";
            $wpdb->update(
                $table,
                ["status" => $new_status],
                ["id" => $booking_id],
                ["%s"],
                ["%d"],
            );

            echo '<div class="notice notice-success is-dismissible"><p>Booking ' .
                esc_html($new_status) .
                ".</p></div>";
        }
    }

    // Current filter
    $status_filter = sanitize_text_field($_GET["status"] ?? "all");

    // Get counts for tabs
    $counts = [];
    $count_rows = $wpdb->get_results(
        "SELECT status, COUNT(*) as count FROM $table GROUP BY status",
    );
    foreach ($count_rows as $row) {
        $counts[$row->status] = (int) $row->count;
    }
    $total = array_sum($counts);

    // Query bookings
    $where = "";
    if (
        $status_filter !== "all" &&
        in_array($status_filter, ["pending", "confirmed", "cancelled"], true)
    ) {
        $where = $wpdb->prepare(" WHERE status = %s", $status_filter);
    }
    $bookings = $wpdb->get_results(
        "SELECT * FROM $table{$where} ORDER BY booking_date DESC, booking_time ASC",
    );

    // Current settings
    $keys = ellievated_get_stripe_keys();
    $deposit_cents = ellievated_get_deposit_amount();
    $deposit_dollars =
        $deposit_cents > 0
            ? number_format($deposit_cents / 100, 2, ".", "")
            : "";
    $is_configured = ellievated_stripe_is_configured();
    $show_settings = isset($_GET["tab"]) && $_GET["tab"] === "settings";
    ?>
    <div class="wrap">
        <h1>Bookings</h1>

        <h2 class="nav-tab-wrapper">
            <a href="<?php echo esc_url(
                admin_url("admin.php?page=ellievated-bookings"),
            ); ?>"
               class="nav-tab <?php echo !$show_settings
                   ? "nav-tab-active"
                   : ""; ?>">Bookings</a>
            <a href="<?php echo esc_url(
                admin_url("admin.php?page=ellievated-bookings&tab=settings"),
            ); ?>"
               class="nav-tab <?php echo $show_settings
                   ? "nav-tab-active"
                   : ""; ?>">Stripe Settings</a>
        </h2>

        <?php if ($show_settings): ?>

            <form method="post" style="max-width:600px;margin-top:20px;">
                <?php wp_nonce_field(
                    "ellievated_stripe_settings",
                    "_stripe_nonce",
                ); ?>

                <table class="form-table">
                    <tr>
                        <th><label for="stripe_secret_key">Secret Key</label></th>
                        <td>
                            <input type="password" id="stripe_secret_key" name="stripe_secret_key"
                                   value="<?php echo esc_attr(
                                       $keys["secret"],
                                   ); ?>"
                                   class="regular-text" autocomplete="off">
                            <p class="description">Starts with sk_live_ or sk_test_</p>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="stripe_publishable_key">Publishable Key</label></th>
                        <td>
                            <input type="text" id="stripe_publishable_key" name="stripe_publishable_key"
                                   value="<?php echo esc_attr(
                                       $keys["publishable"],
                                   ); ?>"
                                   class="regular-text" autocomplete="off">
                            <p class="description">Starts with pk_live_ or pk_test_</p>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="stripe_webhook_secret">Webhook Secret</label></th>
                        <td>
                            <input type="password" id="stripe_webhook_secret" name="stripe_webhook_secret"
                                   value="<?php echo esc_attr(
                                       $keys["webhook_secret"],
                                   ); ?>"
                                   class="regular-text" autocomplete="off">
                            <p class="description">
                                Starts with whsec_. Set your webhook URL to:<br>
                                <code><?php echo esc_html(
                                    rest_url("ellievated/v1/stripe-webhook"),
                                ); ?></code>
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <th><label for="deposit_amount">Deposit Amount ($)</label></th>
                        <td>
                            <input type="number" id="deposit_amount" name="deposit_amount"
                                   value="<?php echo esc_attr(
                                       $deposit_dollars,
                                   ); ?>"
                                   min="0" step="0.01" class="small-text">
                            <p class="description">Set to 0 to disable deposits (email-only mode).</p>
                        </td>
                    </tr>
                </table>

                <p>
                    <span style="display:inline-block;padding:4px 12px;border-radius:12px;font-size:12px;color:#fff;background:<?php echo $is_configured
                        ? "#5cb85c"
                        : "#999"; ?>;margin-right:8px;">
                        <?php echo $is_configured
                            ? "Stripe connected"
                            : "Not configured"; ?>
                    </span>
                </p>

                <p class="submit">
                    <input type="submit" name="ellievated_save_stripe_settings"
                           class="button button-primary" value="Save Settings">
                </p>
            </form>

        <?php else: ?>

            <ul class="subsubsub">
                <li><a href="<?php echo esc_url(
                    admin_url("admin.php?page=ellievated-bookings"),
                ); ?>"
                       class="<?php echo $status_filter === "all"
                           ? "current"
                           : ""; ?>">
                    All <span class="count">(<?php echo $total; ?>)</span></a> | </li>
                <li><a href="<?php echo esc_url(
                    admin_url(
                        "admin.php?page=ellievated-bookings&status=pending",
                    ),
                ); ?>"
                       class="<?php echo $status_filter === "pending"
                           ? "current"
                           : ""; ?>">
                    Pending <span class="count">(<?php echo $counts[
                        "pending"
                    ] ?? 0; ?>)</span></a> | </li>
                <li><a href="<?php echo esc_url(
                    admin_url(
                        "admin.php?page=ellievated-bookings&status=confirmed",
                    ),
                ); ?>"
                       class="<?php echo $status_filter === "confirmed"
                           ? "current"
                           : ""; ?>">
                    Confirmed <span class="count">(<?php echo $counts[
                        "confirmed"
                    ] ?? 0; ?>)</span></a> | </li>
                <li><a href="<?php echo esc_url(
                    admin_url(
                        "admin.php?page=ellievated-bookings&status=cancelled",
                    ),
                ); ?>"
                       class="<?php echo $status_filter === "cancelled"
                           ? "current"
                           : ""; ?>">
                    Cancelled <span class="count">(<?php echo $counts[
                        "cancelled"
                    ] ?? 0; ?>)</span></a></li>
            </ul>

            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th style="width:110px">Date</th>
                        <th style="width:90px">Time</th>
                        <th>Service</th>
                        <th>Client</th>
                        <th style="width:80px">Deposit</th>
                        <th style="width:100px">Status</th>
                        <th style="width:160px">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($bookings)): ?>
                        <tr><td colspan="7">No bookings found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($bookings as $booking): ?>
                            <tr>
                                <td><?php echo esc_html(
                                    date(
                                        "M j, Y",
                                        strtotime($booking->booking_date),
                                    ),
                                ); ?></td>
                                <td><?php echo esc_html(
                                    $booking->booking_time,
                                ); ?></td>
                                <td><?php echo esc_html(
                                    $booking->service_name,
                                ); ?></td>
                                <td>
                                    <strong><?php echo esc_html(
                                        $booking->first_name .
                                            " " .
                                            $booking->last_name,
                                    ); ?></strong><br>
                                    <a href="mailto:<?php echo esc_attr(
                                        $booking->email,
                                    ); ?>"><?php echo esc_html(
    $booking->email,
); ?></a>
                                    <?php if (!empty($booking->phone)): ?>
                                        <br><?php echo esc_html(
                                            $booking->phone,
                                        ); ?>
                                    <?php endif; ?>
                                    <?php if (!empty($booking->message)): ?>
                                        <br><em style="color:#666"><?php echo esc_html(
                                            wp_trim_words(
                                                $booking->message,
                                                10,
                                            ),
                                        ); ?></em>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if (
                                        !empty($booking->deposit_amount) &&
                                        $booking->deposit_amount > 0
                                    ): ?>
                                        $<?php echo esc_html(
                                            number_format(
                                                $booking->deposit_amount / 100,
                                                2,
                                            ),
                                        ); ?>
                                        <?php if (
                                            !empty($booking->stripe_payment_id)
                                        ): ?>
                                            <br><small style="color:#5cb85c">Paid</small>
                                        <?php else: ?>
                                            <br><small style="color:#f0ad4e">Unpaid</small>
                                        <?php endif; ?>
                                    <?php else: ?>
                                        <span style="color:#999">&mdash;</span>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php
                                    $badge_colors = [
                                        "pending" => "#f0ad4e",
                                        "confirmed" => "#5cb85c",
                                        "cancelled" => "#999",
                                    ];
                                    $color =
                                        $badge_colors[$booking->status] ??
                                        "#999";
                                    ?>
                                    <span style="display:inline-block;padding:3px 10px;border-radius:12px;font-size:12px;color:#fff;background:<?php echo $color; ?>">
                                        <?php echo esc_html(
                                            ucfirst($booking->status),
                                        ); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if (
                                        $booking->status !== "confirmed"
                                    ): ?>
                                        <a href="<?php echo esc_url(
                                            wp_nonce_url(
                                                admin_url(
                                                    "admin.php?page=ellievated-bookings&action=confirm&booking_id=" .
                                                        $booking->id,
                                                ),
                                                "ellievated_booking_confirm_" .
                                                    $booking->id,
                                            ),
                                        ); ?>" class="button button-small">Confirm</a>
                                    <?php endif; ?>
                                    <?php if (
                                        $booking->status !== "cancelled"
                                    ): ?>
                                        <a href="<?php echo esc_url(
                                            wp_nonce_url(
                                                admin_url(
                                                    "admin.php?page=ellievated-bookings&action=cancel&booking_id=" .
                                                        $booking->id,
                                                ),
                                                "ellievated_booking_cancel_" .
                                                    $booking->id,
                                            ),
                                        ); ?>" class="button button-small"
                                           onclick="return confirm('Cancel this booking?')">Cancel</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>

        <?php endif; ?>
    </div>
    <?php
}
