<?php
/**
 * Ellievated Beauty - Booking Management
 *
 * Custom database table for storing bookings, AJAX availability
 * checking, and admin page for managing appointments.
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
 * Auto-create table on first admin load if it doesn't exist yet.
 */
function ellievated_maybe_create_bookings_table(): void
{
    $db_version = "1.0";
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

    $result = $wpdb->insert($table, [
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
        "created_at" => current_time("mysql"),
    ], ["%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s", "%s"]);

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
add_action("wp_ajax_ellievated_check_availability", "ellievated_ajax_check_availability");
add_action("wp_ajax_nopriv_ellievated_check_availability", "ellievated_ajax_check_availability");

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
            wp_verify_nonce($_GET["_wpnonce"], "ellievated_booking_" . $action . "_" . $booking_id)
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
                esc_html($new_status) . '.</p></div>';
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
    if ($status_filter !== "all" && in_array($status_filter, ["pending", "confirmed", "cancelled"], true)) {
        $where = $wpdb->prepare(" WHERE status = %s", $status_filter);
    }
    $bookings = $wpdb->get_results(
        "SELECT * FROM $table{$where} ORDER BY booking_date DESC, booking_time ASC",
    );

    ?>
    <div class="wrap">
        <h1>Bookings</h1>

        <ul class="subsubsub">
            <li><a href="<?php echo esc_url(admin_url("admin.php?page=ellievated-bookings")); ?>"
                   class="<?php echo $status_filter === "all" ? "current" : ""; ?>">
                All <span class="count">(<?php echo $total; ?>)</span></a> | </li>
            <li><a href="<?php echo esc_url(admin_url("admin.php?page=ellievated-bookings&status=pending")); ?>"
                   class="<?php echo $status_filter === "pending" ? "current" : ""; ?>">
                Pending <span class="count">(<?php echo $counts["pending"] ?? 0; ?>)</span></a> | </li>
            <li><a href="<?php echo esc_url(admin_url("admin.php?page=ellievated-bookings&status=confirmed")); ?>"
                   class="<?php echo $status_filter === "confirmed" ? "current" : ""; ?>">
                Confirmed <span class="count">(<?php echo $counts["confirmed"] ?? 0; ?>)</span></a> | </li>
            <li><a href="<?php echo esc_url(admin_url("admin.php?page=ellievated-bookings&status=cancelled")); ?>"
                   class="<?php echo $status_filter === "cancelled" ? "current" : ""; ?>">
                Cancelled <span class="count">(<?php echo $counts["cancelled"] ?? 0; ?>)</span></a></li>
        </ul>

        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th style="width:110px">Date</th>
                    <th style="width:90px">Time</th>
                    <th>Service</th>
                    <th>Client</th>
                    <th style="width:100px">Status</th>
                    <th style="width:160px">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($bookings)): ?>
                    <tr><td colspan="6">No bookings found.</td></tr>
                <?php else: ?>
                    <?php foreach ($bookings as $booking): ?>
                        <tr>
                            <td><?php echo esc_html(date("M j, Y", strtotime($booking->booking_date))); ?></td>
                            <td><?php echo esc_html($booking->booking_time); ?></td>
                            <td><?php echo esc_html($booking->service_name); ?></td>
                            <td>
                                <strong><?php echo esc_html($booking->first_name . " " . $booking->last_name); ?></strong><br>
                                <a href="mailto:<?php echo esc_attr($booking->email); ?>"><?php echo esc_html($booking->email); ?></a>
                                <?php if (!empty($booking->phone)): ?>
                                    <br><?php echo esc_html($booking->phone); ?>
                                <?php endif; ?>
                                <?php if (!empty($booking->message)): ?>
                                    <br><em style="color:#666"><?php echo esc_html(wp_trim_words($booking->message, 10)); ?></em>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                $badge_colors = [
                                    "pending" => "#f0ad4e",
                                    "confirmed" => "#5cb85c",
                                    "cancelled" => "#999",
                                ];
                                $color = $badge_colors[$booking->status] ?? "#999";
                                ?>
                                <span style="display:inline-block;padding:3px 10px;border-radius:12px;font-size:12px;color:#fff;background:<?php echo $color; ?>">
                                    <?php echo esc_html(ucfirst($booking->status)); ?>
                                </span>
                            </td>
                            <td>
                                <?php if ($booking->status !== "confirmed"): ?>
                                    <a href="<?php echo esc_url(wp_nonce_url(
                                        admin_url("admin.php?page=ellievated-bookings&action=confirm&booking_id=" . $booking->id),
                                        "ellievated_booking_confirm_" . $booking->id,
                                    )); ?>" class="button button-small">Confirm</a>
                                <?php endif; ?>
                                <?php if ($booking->status !== "cancelled"): ?>
                                    <a href="<?php echo esc_url(wp_nonce_url(
                                        admin_url("admin.php?page=ellievated-bookings&action=cancel&booking_id=" . $booking->id),
                                        "ellievated_booking_cancel_" . $booking->id,
                                    )); ?>" class="button button-small"
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
