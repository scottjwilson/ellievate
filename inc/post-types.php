<?php
/**
 * Service Meta Fields & Helpers
 *
 * Adds custom meta box to WooCommerce products for service-specific
 * data (duration, icon, features) and provides a helper to query services.
 *
 * @package Ellievated
 */

defined("ABSPATH") || exit();

/**
 * Query published products ordered by menu_order.
 *
 * @param int $count Number of products to return (-1 for all).
 * @return WP_Query
 */
function ellievated_get_services(int $count = -1): WP_Query
{
    return new WP_Query([
        "post_type" => "product",
        "posts_per_page" => $count,
        "orderby" => "menu_order",
        "order" => "ASC",
        "post_status" => "publish",
    ]);
}

/**
 * Register the Service Details meta box on products.
 */
function ellievated_service_meta_box(): void
{
    add_meta_box(
        "ellievated_service_details",
        "Service Details",
        "ellievated_service_meta_box_html",
        "product",
        "side",
        "default",
    );
}
add_action("add_meta_boxes", "ellievated_service_meta_box");

/**
 * Render the Service Details meta box fields.
 */
function ellievated_service_meta_box_html(WP_Post $post): void
{
    $duration = get_post_meta($post->ID, "_service_duration", true);
    $icon = get_post_meta($post->ID, "_service_icon", true);
    $features = get_post_meta($post->ID, "_service_features", true);

    wp_nonce_field("ellievated_service_meta", "ellievated_service_nonce");
    ?>
    <p>
        <label for="ellievated_duration"><strong>Duration</strong></label><br>
        <input type="text" id="ellievated_duration" name="_service_duration"
               value="<?php echo esc_attr($duration); ?>"
               placeholder="e.g. 60 minutes" style="width:100%;">
    </p>
    <p>
        <label for="ellievated_icon"><strong>Icon (HTML entity)</strong></label><br>
        <input type="text" id="ellievated_icon" name="_service_icon"
               value="<?php echo esc_attr($icon); ?>"
               placeholder="e.g. &#10047;" style="width:100%;">
        <span class="description">Unicode symbol for service cards.</span>
    </p>
    <p>
        <label for="ellievated_features"><strong>Features</strong></label><br>
        <textarea id="ellievated_features" name="_service_features"
                  rows="6" placeholder="One feature per line" style="width:100%;"><?php echo esc_textarea(
                      $features,
                  ); ?></textarea>
        <span class="description">One feature per line. Used on Services page.</span>
    </p>
    <?php
}

/**
 * Save the Service Details meta box fields.
 */
function ellievated_save_service_meta(int $post_id): void
{
    if (!isset($_POST["ellievated_service_nonce"])) {
        return;
    }
    if (
        !wp_verify_nonce(
            $_POST["ellievated_service_nonce"],
            "ellievated_service_meta",
        )
    ) {
        return;
    }
    if (defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can("edit_post", $post_id)) {
        return;
    }

    if (isset($_POST["_service_duration"])) {
        update_post_meta(
            $post_id,
            "_service_duration",
            sanitize_text_field($_POST["_service_duration"]),
        );
    }
    if (isset($_POST["_service_icon"])) {
        update_post_meta(
            $post_id,
            "_service_icon",
            sanitize_text_field($_POST["_service_icon"]),
        );
    }
    if (isset($_POST["_service_features"])) {
        update_post_meta(
            $post_id,
            "_service_features",
            sanitize_textarea_field($_POST["_service_features"]),
        );
    }
}
add_action("save_post_product", "ellievated_save_service_meta");
