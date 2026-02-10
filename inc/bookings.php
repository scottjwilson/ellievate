<?php
/**
 * Ellievated Beauty - Booking Management
 *
 * Custom database table for tracking bookings/availability,
 * WooCommerce cart/order integration, and admin page.
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
        order_id BIGINT(20) UNSIGNED DEFAULT 0,
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
        created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY (id),
        KEY booking_date (booking_date),
        KEY status (status),
        KEY order_id (order_id)
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
    $db_version = "2.0";
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
            "order_id" => absint($data["order_id"] ?? 0),
            "service_slug" => sanitize_text_field($data["service_slug"] ?? ""),
            "service_name" => sanitize_text_field($data["service_name"] ?? ""),
            "booking_date" => sanitize_text_field($data["booking_date"] ?? ""),
            "booking_time" => sanitize_text_field($data["booking_time"] ?? ""),
            "first_name" => sanitize_text_field($data["first_name"] ?? ""),
            "last_name" => sanitize_text_field($data["last_name"] ?? ""),
            "email" => sanitize_email($data["email"] ?? ""),
            "phone" => sanitize_text_field($data["phone"] ?? ""),
            "message" => sanitize_textarea_field($data["message"] ?? ""),
            "status" => sanitize_text_field($data["status"] ?? "pending"),
            "created_at" => current_time("mysql"),
        ],
        [
            "%d",
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

// ─── AJAX ────────────────────────────────────────────────────────

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
 * AJAX handler: add service to cart with booking date/time.
 */
function ellievated_ajax_add_to_cart(): void
{
    check_ajax_referer("ellievated_booking_availability", "nonce");

    $product_id = absint($_POST["product_id"] ?? 0);
    $date = sanitize_text_field($_POST["booking_date"] ?? "");
    $time = sanitize_text_field($_POST["booking_time"] ?? "");

    if (!$product_id || !$date || !$time) {
        wp_send_json_error("Missing required fields.");
    }

    $product = wc_get_product($product_id);
    if (!$product) {
        wp_send_json_error("Product not found.");
    }

    // Check if this slot is still available
    $booked = ellievated_get_booked_times($date);
    if (in_array($time, $booked, true)) {
        wp_send_json_error(
            "This time slot is no longer available. Please choose another.",
        );
    }

    // Clear cart (one service booking at a time)
    WC()->cart->empty_cart();

    // Add to cart with booking meta
    $cart_item_key = WC()->cart->add_to_cart(
        $product_id,
        1,
        0,
        [],
        [
            "booking_date" => $date,
            "booking_time" => $time,
        ],
    );

    if (!$cart_item_key) {
        wp_send_json_error("Could not add service to cart.");
    }

    wp_send_json_success(["redirect" => wc_get_checkout_url()]);
}
add_action("wp_ajax_ellievated_add_to_cart", "ellievated_ajax_add_to_cart");
add_action(
    "wp_ajax_nopriv_ellievated_add_to_cart",
    "ellievated_ajax_add_to_cart",
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

// ─── WooCommerce Integration ────────────────────────────────────

/**
 * Display booking date/time in cart and checkout.
 */
function ellievated_display_cart_item_meta(
    array $item_data,
    array $cart_item,
): array {
    if (!empty($cart_item["booking_date"])) {
        $date = date("l, F j, Y", strtotime($cart_item["booking_date"]));
        $item_data[] = [
            "key" => "Date",
            "value" => $date,
        ];
    }
    if (!empty($cart_item["booking_time"])) {
        $item_data[] = [
            "key" => "Time",
            "value" => $cart_item["booking_time"],
        ];
    }
    return $item_data;
}
add_filter(
    "woocommerce_get_item_data",
    "ellievated_display_cart_item_meta",
    10,
    2,
);

/**
 * Save booking date/time to order line item meta.
 */
function ellievated_save_order_item_meta(
    $item,
    $cart_item_key,
    $values,
    $order,
): void {
    if (!empty($values["booking_date"])) {
        $item->add_meta_data("Booking Date", $values["booking_date"], true);
    }
    if (!empty($values["booking_time"])) {
        $item->add_meta_data("Booking Time", $values["booking_time"], true);
    }
}
add_action(
    "woocommerce_checkout_create_order_line_item",
    "ellievated_save_order_item_meta",
    10,
    4,
);

/**
 * Create a booking record when an order is paid/processing.
 */
function ellievated_order_to_booking(int $order_id): void
{
    global $wpdb;
    $table = $wpdb->prefix . "ellievated_bookings";

    // Check if booking already exists for this order
    $exists = $wpdb->get_var(
        $wpdb->prepare("SELECT id FROM $table WHERE order_id = %d", $order_id),
    );
    if ($exists) {
        return;
    }

    $order = wc_get_order($order_id);
    if (!$order) {
        return;
    }

    foreach ($order->get_items() as $item) {
        $booking_date = $item->get_meta("Booking Date");
        $booking_time = $item->get_meta("Booking Time");

        if (!$booking_date || !$booking_time) {
            continue;
        }

        $product = $item->get_product();
        ellievated_save_booking([
            "order_id" => $order_id,
            "service_slug" => $product ? $product->get_slug() : "",
            "service_name" => $item->get_name(),
            "booking_date" => $booking_date,
            "booking_time" => $booking_time,
            "first_name" => $order->get_billing_first_name(),
            "last_name" => $order->get_billing_last_name(),
            "email" => $order->get_billing_email(),
            "phone" => $order->get_billing_phone(),
            "status" => "confirmed",
        ]);
    }
}
add_action(
    "woocommerce_order_status_processing",
    "ellievated_order_to_booking",
);
add_action("woocommerce_order_status_completed", "ellievated_order_to_booking");

/**
 * Cancel booking when order is cancelled or refunded.
 */
function ellievated_order_cancel_booking(int $order_id): void
{
    global $wpdb;
    $wpdb->update(
        $wpdb->prefix . "ellievated_bookings",
        ["status" => "cancelled"],
        ["order_id" => $order_id],
        ["%s"],
        ["%d"],
    );
}
add_action(
    "woocommerce_order_status_cancelled",
    "ellievated_order_cancel_booking",
);
add_action(
    "woocommerce_order_status_refunded",
    "ellievated_order_cancel_booking",
);

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
    ?>
    <div class="wrap">
        <h1>Bookings</h1>

        <ul class="subsubsub">
            <li><a href="<?php echo esc_url(
                admin_url("admin.php?page=ellievated-bookings"),
            ); ?>"
                   class="<?php echo $status_filter === "all"
                       ? "current"
                       : ""; ?>">
                All <span class="count">(<?php echo $total; ?>)</span></a> | </li>
            <li><a href="<?php echo esc_url(
                admin_url("admin.php?page=ellievated-bookings&status=pending"),
            ); ?>"
                   class="<?php echo $status_filter === "pending"
                       ? "current"
                       : ""; ?>">
                Pending <span class="count">(<?php echo $counts["pending"] ??
                    0; ?>)</span></a> | </li>
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
                    <th style="width:80px">Order</th>
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
                                    <br><?php echo esc_html($booking->phone); ?>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($booking->order_id)): ?>
                                    <a href="<?php echo esc_url(
                                        admin_url(
                                            "post.php?post=" .
                                                $booking->order_id .
                                                "&action=edit",
                                        ),
                                    ); ?>">
                                        #<?php echo esc_html(
                                            $booking->order_id,
                                        ); ?>
                                    </a>
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
                                    $badge_colors[$booking->status] ?? "#999";
                                ?>
                                <span style="display:inline-block;padding:3px 10px;border-radius:12px;font-size:12px;color:#fff;background:<?php echo $color; ?>">
                                    <?php echo esc_html(
                                        ucfirst($booking->status),
                                    ); ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($booking->status !== "confirmed"): ?>
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
                                <?php if ($booking->status !== "cancelled"): ?>
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
    </div>
    <?php
}
