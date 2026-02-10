<?php
/**
 * Ellievated Beauty Theme Setup
 *
 * Core theme configuration, menus, and theme supports.
 */

defined("ABSPATH") || exit();

define("ELLIEVATED_VERSION", "1.0.0");
define("ELLIEVATED_DIR", get_template_directory());
define("ELLIEVATED_URI", get_template_directory_uri());

/**
 * Register theme supports and navigation menus
 */
function ellievated_setup(): void
{
    add_theme_support("automatic-feed-links");
    add_theme_support("title-tag");
    add_theme_support("post-thumbnails");
    add_theme_support("custom-logo", [
        "height" => 40,
        "width" => 160,
        "flex-width" => true,
        "flex-height" => true,
    ]);
    add_theme_support("align-wide");
    add_theme_support("responsive-embeds");
    add_theme_support("html5", [
        "search-form",
        "comment-form",
        "comment-list",
        "gallery",
        "caption",
    ]);

    // WooCommerce support
    add_theme_support("woocommerce");
    add_theme_support("wc-product-gallery-zoom");
    add_theme_support("wc-product-gallery-lightbox");
    add_theme_support("wc-product-gallery-slider");

    add_image_size("ellievated-card", 600, 400, true);
    add_image_size("ellievated-hero", 1400, 800, true);
    add_image_size("ellievated-service", 800, 600, true);

    register_nav_menus([
        "primary" => __("Primary Menu", "ellievated"),
        "footer" => __("Footer Menu", "ellievated"),
    ]);
}
add_action("after_setup_theme", "ellievated_setup");

/**
 * Enqueue base styles and scripts
 */
function ellievated_enqueue_assets(): void
{
    // Main stylesheet (required by WordPress)
    wp_enqueue_style(
        "ellievated-style",
        get_stylesheet_uri(),
        [],
        ELLIEVATED_VERSION,
    );

    // Google Fonts
    wp_enqueue_style(
        "ellievated-fonts",
        "https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=DM+Sans:ital,wght@0,300;0,400;0,500;0,600;1,400&display=swap",
        [],
        null,
    );

    // Check if Vite handles assets
    if (function_exists("ellievated_detect_vite_server")) {
        $vite = ellievated_detect_vite_server();
        $has_manifest = file_exists(get_theme_file_path("dist/manifest.json"));

        if ($vite["running"] || $has_manifest) {
            return;
        }
    }

    // Fallback: enqueue CSS directly if Vite is not available
    wp_enqueue_style(
        "ellievated-variables",
        get_template_directory_uri() . "/css/variables.css",
        [],
        ELLIEVATED_VERSION,
    );
    wp_enqueue_style(
        "ellievated-base",
        get_template_directory_uri() . "/css/base.css",
        ["ellievated-variables"],
        ELLIEVATED_VERSION,
    );
    wp_enqueue_style(
        "ellievated-header",
        get_template_directory_uri() . "/css/header.css",
        ["ellievated-base"],
        ELLIEVATED_VERSION,
    );
    wp_enqueue_style(
        "ellievated-footer",
        get_template_directory_uri() . "/css/footer.css",
        ["ellievated-base"],
        ELLIEVATED_VERSION,
    );

    if (is_front_page() || is_singular("product")) {
        wp_enqueue_style(
            "ellievated-front-page",
            get_template_directory_uri() . "/css/front-page.css",
            ["ellievated-base"],
            ELLIEVATED_VERSION,
        );
    }

    // Enqueue main JavaScript
    wp_enqueue_script(
        "ellievated-main",
        get_template_directory_uri() . "/js/main.js",
        [],
        ELLIEVATED_VERSION,
        true,
    );
}
add_action("wp_enqueue_scripts", "ellievated_enqueue_assets");

/**
 * Custom excerpt length
 */
function ellievated_excerpt_length(int $length): int
{
    return 20;
}
add_filter("excerpt_length", "ellievated_excerpt_length", 999);

/**
 * SVG Icons Library
 */
function ellievated_icon($name, $size = 20): string
{
    $icons = [
        // Navigation
        "arrow-right" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="none"><path d="M4.167 10h11.666M10 4.167L15.833 10 10 15.833" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        "arrow-up-right" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="none"><path d="M5.833 14.167L14.167 5.833M14.167 5.833H5.833M14.167 5.833v8.334" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        "menu" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none"><path d="M3 12h18M3 6h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        "close" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none"><path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',

        // UI Elements
        "check" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="none"><path d="M16.667 5L7.5 14.167 3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        "plus" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="none"><path d="M10 4.167v11.666M4.167 10h11.666" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        "star" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="none"><path d="M10 1.667l2.575 5.216 5.758.842-4.166 4.058.983 5.734L10 14.792l-5.15 2.725.983-5.734-4.166-4.058 5.758-.842L10 1.667z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        "quote" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="currentColor"><path d="M3.333 10h3.334c.92 0 1.666.746 1.666 1.667v3.333c0 .92-.746 1.667-1.666 1.667H5c-.92 0-1.667-.747-1.667-1.667v-5c0-3.682 2.985-6.667 6.667-6.667V5c-2.761 0-5 2.239-5 5h-1.667zm8.334 0h3.333c.92 0 1.667.746 1.667 1.667v3.333c0 .92-.747 1.667-1.667 1.667h-1.667c-.92 0-1.666-.747-1.666-1.667v-5c0-3.682 2.985-6.667 6.666-6.667V5c-2.761 0-5 2.239-5 5h-1.666z"/></svg>',

        // Beauty / Services
        "sparkle" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none"><path d="M12 2l2.4 7.2L22 12l-7.6 2.8L12 22l-2.4-7.2L2 12l7.6-2.8L12 2z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        "leaf" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none"><path d="M17 8C8 10 5.9 16.17 3.82 21.34l1.89.66.95-2.3c.48.17.98.3 1.34.3C19 20 22 3 22 3c-1 2-8 2.25-13 3.25S2 11.5 2 13.5s1.75 3.75 1.75 3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        "droplet" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none"><path d="M12 2.69l5.66 5.66a8 8 0 11-11.31 0z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        "heart" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none"><path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        "calendar" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none"><rect x="3" y="4" width="18" height="18" rx="2" stroke="currentColor" stroke-width="1.5"/><path d="M16 2v4M8 2v4M3 10h18" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
        "clock" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"/><path d="M12 6v6l4 2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',

        // Contact
        "mail" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="none"><path d="M3.333 3.333h13.334c.916 0 1.666.75 1.666 1.667v10c0 .917-.75 1.667-1.666 1.667H3.333c-.916 0-1.666-.75-1.666-1.667V5c0-.917.75-1.667 1.666-1.667z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><path d="M18.333 5l-8.333 5.833L1.667 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        "phone" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="none"><path d="M18.333 14.1v2.5a1.667 1.667 0 01-1.816 1.667 16.492 16.492 0 01-7.192-2.559 16.25 16.25 0 01-5-5 16.492 16.492 0 01-2.558-7.225 1.667 1.667 0 011.658-1.816h2.5a1.667 1.667 0 011.667 1.433c.105.8.3 1.586.583 2.342a1.667 1.667 0 01-.375 1.758l-1.058 1.058a13.333 13.333 0 005 5L12.8 12.2a1.667 1.667 0 011.758-.375c.756.284 1.542.478 2.342.583a1.667 1.667 0 011.433 1.692z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        "map-pin" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="none"><path d="M17.5 8.333c0 5.834-7.5 10.834-7.5 10.834s-7.5-5-7.5-10.834a7.5 7.5 0 1115 0z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/><circle cx="10" cy="8.333" r="2.5" stroke="currentColor" stroke-width="1.5"/></svg>',

        // Social
        "instagram" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="currentColor"><path d="M10 1.802c2.67 0 2.987.01 4.042.058 2.71.124 3.975 1.41 4.099 4.099.048 1.054.057 1.37.057 4.04 0 2.672-.01 2.988-.057 4.042-.124 2.687-1.387 3.975-4.1 4.099-1.054.048-1.37.058-4.041.058-2.67 0-2.987-.01-4.04-.058-2.718-.124-3.977-1.416-4.1-4.1-.048-1.054-.058-1.37-.058-4.041 0-2.67.01-2.986.058-4.04.124-2.69 1.387-3.976 4.1-4.1 1.054-.047 1.37-.057 4.04-.057zM10 0C7.284 0 6.944.012 5.877.06 2.246.228.228 2.242.06 5.877.012 6.944 0 7.284 0 10s.012 3.057.06 4.123c.168 3.63 2.182 5.65 5.817 5.817 1.067.048 1.407.06 4.123.06s3.057-.012 4.123-.06c3.629-.167 5.652-2.182 5.817-5.817.048-1.066.06-1.407.06-4.123s-.012-3.056-.06-4.122C19.777 2.249 17.76.228 14.124.06 13.057.012 12.716 0 10 0zm0 4.865a5.135 5.135 0 100 10.27 5.135 5.135 0 000-10.27zm0 8.468a3.333 3.333 0 110-6.666 3.333 3.333 0 010 6.666zm5.338-9.87a1.2 1.2 0 100 2.4 1.2 1.2 0 000-2.4z"/></svg>',
        "tiktok" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="currentColor"><path d="M14.125 0h-3.2v13.6c0 1.6-1.28 2.88-2.88 2.88S5.165 15.2 5.165 13.6s1.28-2.88 2.88-2.88c.32 0 .64.04.92.16V7.6c-.32-.04-.6-.08-.92-.08C3.645 7.52.005 11.16.005 15.56S3.645 20 8.045 20s8.04-3.6 8.04-8.04V6.52c1.48 1.08 3.28 1.72 5.24 1.72V5c-2.88-.16-5.32-1.92-6.32-4.44-.24-.4-.6-.56-.88-.56z"/></svg>',
        "facebook" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="currentColor"><path d="M18.896 0H1.104C.494 0 0 .494 0 1.104v17.793C0 19.506.494 20 1.104 20h9.58v-7.745H8.076V9.237h2.608V7.01c0-2.583 1.578-3.99 3.883-3.99 1.104 0 2.052.082 2.329.119v2.7h-1.598c-1.254 0-1.496.596-1.496 1.47v1.928h2.989l-.39 3.018h-2.6V20h5.098c.608 0 1.102-.494 1.102-1.104V1.104C20 .494 19.506 0 18.896 0z"/></svg>',
    ];

    return $icons[$name] ?? "";
}

/**
 * Body Classes
 */
function ellievated_body_classes($classes): array
{
    if (is_front_page()) {
        $classes[] = "is-front-page";
    }
    return $classes;
}
add_filter("body_class", "ellievated_body_classes");

/**
 * Add preconnect for Google Fonts
 */
function ellievated_preconnect_fonts(): void
{
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
}
add_action("wp_head", "ellievated_preconnect_fonts", 1);

/**
 * WooCommerce: Wrap content in theme markup
 */
function ellievated_woocommerce_wrapper_before(): void
{
    echo '<section class="section"><div class="container">';
}

function ellievated_woocommerce_wrapper_after(): void
{
    echo "</div></section>";
}

remove_action(
    "woocommerce_before_main_content",
    "woocommerce_output_content_wrapper",
    10,
);
remove_action(
    "woocommerce_after_main_content",
    "woocommerce_output_content_wrapper_end",
    10,
);
add_action(
    "woocommerce_before_main_content",
    "ellievated_woocommerce_wrapper_before",
);
add_action(
    "woocommerce_after_main_content",
    "ellievated_woocommerce_wrapper_after",
);

/**
 * WooCommerce: Disable sidebar on shop pages
 */
remove_action("woocommerce_sidebar", "woocommerce_get_sidebar", 10);

/**
 * WooCommerce: Remove default shop page title
 */
add_filter("woocommerce_show_page_title", "__return_false");

/**
 * WooCommerce: Remove default add-to-cart on single products
 * Purchases go through the booking flow instead.
 */
remove_action(
    "woocommerce_single_product_summary",
    "woocommerce_template_single_add_to_cart",
    30,
);
remove_action(
    "woocommerce_simple_add_to_cart",
    "woocommerce_simple_add_to_cart",
    30,
);
