<?php
/**
 * Fieldcraft Digital 2.0 Theme Setup
 *
 * Core theme configuration, menus, and theme supports.
 */

defined("ABSPATH") || exit();

define("FIELDCRAFT_VERSION", "2.0.0");
define("FIELDCRAFT_DIR", get_template_directory());
define("FIELDCRAFT_URI", get_template_directory_uri());

/**
 * Register theme supports and navigation menus
 */
function fieldcraft_setup(): void
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

    add_image_size("fieldcraft-card", 600, 400, true);
    add_image_size("fieldcraft-hero", 1400, 800, true);
    add_image_size("fieldcraft-portfolio", 800, 600, true);
    add_image_size("fieldcraft-team", 400, 500, true);

    register_nav_menus([
        "primary" => __("Primary Menu", "fieldcraftdigital2"),
        "footer" => __("Footer Menu", "fieldcraftdigital2"),
    ]);
}
add_action("after_setup_theme", "fieldcraft_setup");

/**
 * Enqueue base styles and scripts
 */
function fieldcraft_enqueue_assets(): void
{
    // Main stylesheet (required by WordPress)
    wp_enqueue_style(
        "fieldcraft-style",
        get_stylesheet_uri(),
        [],
        FIELDCRAFT_VERSION,
    );

    // Check if Vite handles assets
    if (function_exists("fieldcraft_detect_vite_server")) {
        $vite = fieldcraft_detect_vite_server();
        $has_manifest = file_exists(get_theme_file_path("dist/manifest.json"));

        if ($vite["running"] || $has_manifest) {
            return;
        }
    }

    // Fallback: enqueue CSS directly if Vite is not available
    wp_enqueue_style(
        "fieldcraft-variables",
        get_template_directory_uri() . "/css/variables.css",
        [],
        FIELDCRAFT_VERSION,
    );
    wp_enqueue_style(
        "fieldcraft-base",
        get_template_directory_uri() . "/css/base.css",
        ["fieldcraft-variables"],
        FIELDCRAFT_VERSION,
    );
    wp_enqueue_style(
        "fieldcraft-header",
        get_template_directory_uri() . "/css/header.css",
        ["fieldcraft-base"],
        FIELDCRAFT_VERSION,
    );
    wp_enqueue_style(
        "fieldcraft-footer",
        get_template_directory_uri() . "/css/footer.css",
        ["fieldcraft-base"],
        FIELDCRAFT_VERSION,
    );

    if (is_front_page()) {
        wp_enqueue_style(
            "fieldcraft-front-page",
            get_template_directory_uri() . "/css/front-page.css",
            ["fieldcraft-base"],
            FIELDCRAFT_VERSION,
        );
    }

    // Enqueue main JavaScript
    wp_enqueue_script(
        "fieldcraft-main",
        get_template_directory_uri() . "/js/main.js",
        [],
        FIELDCRAFT_VERSION,
        true,
    );
}
add_action("wp_enqueue_scripts", "fieldcraft_enqueue_assets");

/**
 * Custom excerpt length
 */
function fieldcraft_excerpt_length(int $length): int
{
    return 20;
}
add_filter("excerpt_length", "fieldcraft_excerpt_length", 999);

/**
 * SVG Icons Library
 */
function fieldcraft_icon($name, $size = 20): string
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

        // Services
        "code" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="none"><path d="M13.333 15l5-5-5-5M6.667 5l-5 5 5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        "palette" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="none"><path d="M10 17.5a7.5 7.5 0 100-15 7.5 7.5 0 000 15z" stroke="currentColor" stroke-width="1.5"/><circle cx="6.5" cy="9" r="1.25" fill="currentColor"/><circle cx="10" cy="6.5" r="1.25" fill="currentColor"/><circle cx="13.5" cy="9" r="1.25" fill="currentColor"/><path d="M13.75 13.75a1.25 1.25 0 100-2.5 1.25 1.25 0 000 2.5z" fill="currentColor"/></svg>',
        "chart" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="none"><path d="M15 16.667V8.333M10 16.667V3.333M5 16.667v-5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        "megaphone" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="none"><path d="M16.667 3.333v10M16.667 8.333c-3.333 0-6.667-2.5-10-2.5H4.167a1.667 1.667 0 00-1.667 1.667v1.667a1.667 1.667 0 001.667 1.666h.833l1.667 5H10l-1.667-5h.834c3.333 0 6.666-2.5 10-2.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        "search" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="none"><circle cx="9.167" cy="9.167" r="5.833" stroke="currentColor" stroke-width="1.5"/><path d="M17.5 17.5l-4.167-4.167" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>',
        "target" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="10" r="8.333" stroke="currentColor" stroke-width="1.5"/><circle cx="10" cy="10" r="5" stroke="currentColor" stroke-width="1.5"/><circle cx="10" cy="10" r="1.667" fill="currentColor"/></svg>',
        "lightning" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="none"><path d="M11.667 1.667L2.5 11.667h7.5l-.833 6.666 9.166-10h-7.5l.834-6.666z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        "globe" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="10" r="8.333" stroke="currentColor" stroke-width="1.5"/><path d="M1.667 10h16.666M10 1.667a12.75 12.75 0 013.333 8.333 12.75 12.75 0 01-3.333 8.333 12.75 12.75 0 01-3.333-8.333A12.75 12.75 0 0110 1.667z" stroke="currentColor" stroke-width="1.5"/></svg>',
        "layers" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="none"><path d="M10 1.667L1.667 5.833 10 10l8.333-4.167L10 1.667zM1.667 14.167L10 18.333l8.333-4.166M1.667 10L10 14.167 18.333 10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',

        // Social
        "users" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="none"><path d="M14.167 17.5v-1.667a3.333 3.333 0 00-3.334-3.333H5.833a3.333 3.333 0 00-3.333 3.333V17.5M8.333 9.167a3.333 3.333 0 100-6.667 3.333 3.333 0 000 6.667zM17.5 17.5v-1.667a3.333 3.333 0 00-2.5-3.225M12.5 2.608a3.333 3.333 0 010 6.459" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        "linkedin" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="currentColor"><path d="M4.477 6.564H.897v10.87h3.58V6.564zM2.687 4.988c1.145 0 2.073-.94 2.073-2.1C4.76 1.727 3.831.8 2.686.8 1.54.8.612 1.728.612 2.887c0 1.16.929 2.1 2.075 2.1zM19.388 17.434h-3.574v-5.29c0-1.26-.025-2.88-1.74-2.88-1.743 0-2.01 1.373-2.01 2.79v5.38H8.49V6.564h3.432v1.484h.049c.478-.913 1.646-1.877 3.387-1.877 3.623 0 4.29 2.406 4.29 5.535v5.728h-.26z"/></svg>',
        "twitter" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="currentColor"><path d="M17.944 5.33c.014.178.014.356.014.535 0 5.464-4.16 11.763-11.764 11.763A11.693 11.693 0 010 15.695c.33.038.647.05.99.05a8.284 8.284 0 005.134-1.766 4.145 4.145 0 01-3.867-2.87c.254.037.508.062.775.062.368 0 .736-.05 1.079-.139A4.14 4.14 0 01.794 7c0-.025 0-.037.013-.05v-.05a4.17 4.17 0 001.867.521 4.14 4.14 0 01-1.841-3.447c0-.762.203-1.46.559-2.07a11.758 11.758 0 008.528 4.325 4.666 4.666 0 01-.102-.946 4.138 4.138 0 014.14-4.14c1.193 0 2.272.508 3.033 1.32a8.146 8.146 0 002.63-1.003 4.127 4.127 0 01-1.817 2.283 8.294 8.294 0 002.384-.647 8.898 8.898 0 01-2.07 2.133z"/></svg>',
        "instagram" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="currentColor"><path d="M10 1.802c2.67 0 2.987.01 4.042.058 2.71.124 3.975 1.41 4.099 4.099.048 1.054.057 1.37.057 4.04 0 2.672-.01 2.988-.057 4.042-.124 2.687-1.387 3.975-4.1 4.099-1.054.048-1.37.058-4.041.058-2.67 0-2.987-.01-4.04-.058-2.718-.124-3.977-1.416-4.1-4.1-.048-1.054-.058-1.37-.058-4.041 0-2.67.01-2.986.058-4.04.124-2.69 1.387-3.976 4.1-4.1 1.054-.047 1.37-.057 4.04-.057zM10 0C7.284 0 6.944.012 5.877.06 2.246.228.228 2.242.06 5.877.012 6.944 0 7.284 0 10s.012 3.057.06 4.123c.168 3.63 2.182 5.65 5.817 5.817 1.067.048 1.407.06 4.123.06s3.057-.012 4.123-.06c3.629-.167 5.652-2.182 5.817-5.817.048-1.066.06-1.407.06-4.123s-.012-3.056-.06-4.122C19.777 2.249 17.76.228 14.124.06 13.057.012 12.716 0 10 0zm0 4.865a5.135 5.135 0 100 10.27 5.135 5.135 0 000-10.27zm0 8.468a3.333 3.333 0 110-6.666 3.333 3.333 0 010 6.666zm5.338-9.87a1.2 1.2 0 100 2.4 1.2 1.2 0 000-2.4z"/></svg>',
        "dribbble" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 0C4.48 0 0 4.48 0 10s4.48 10 10 10c5.51 0 10-4.48 10-10S15.51 0 10 0zm6.605 4.61a8.502 8.502 0 011.93 5.314c-.281-.054-3.101-.629-5.943-.271-.065-.141-.12-.293-.184-.445a25.424 25.424 0 00-.564-1.236c3.145-1.28 4.577-3.124 4.761-3.362zM10 1.475c2.17 0 4.154.814 5.662 2.148-.152.216-1.443 1.941-4.48 3.08-1.399-2.57-2.95-4.675-3.189-5A8.686 8.686 0 0110 1.475zm-3.633.803a53.896 53.896 0 013.167 4.935c-3.992 1.063-7.517 1.04-7.896 1.04a8.581 8.581 0 014.729-5.975zM1.453 10.01v-.26c.37.01 4.512.065 8.775-1.215.245.477.477.965.694 1.453-.109.033-.228.065-.336.098-4.404 1.42-6.747 5.303-6.942 5.629a8.522 8.522 0 01-2.19-5.705zM10 18.547a8.482 8.482 0 01-5.239-1.8c.152-.315 1.888-3.656 6.703-5.337.022-.01.033-.01.054-.022a35.318 35.318 0 011.823 6.475 8.4 8.4 0 01-3.341.684zm4.761-1.465c-.086-.52-.542-3.015-1.66-6.084 2.68-.423 5.023.271 5.315.369a8.468 8.468 0 01-3.655 5.715z" clip-rule="evenodd"/></svg>',

        // Misc
        "settings" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="10" r="2.5" stroke="currentColor" stroke-width="1.5"/><path d="M16.167 12.5a1.375 1.375 0 00.275 1.517l.05.05a1.667 1.667 0 11-2.359 2.358l-.05-.05a1.375 1.375 0 00-1.516-.275 1.375 1.375 0 00-.834 1.258v.142a1.667 1.667 0 11-3.333 0v-.075a1.375 1.375 0 00-.9-1.258 1.375 1.375 0 00-1.517.275l-.05.05a1.667 1.667 0 11-2.358-2.359l.05-.05a1.375 1.375 0 00.275-1.516 1.375 1.375 0 00-1.258-.834h-.142a1.667 1.667 0 110-3.333h.075a1.375 1.375 0 001.258-.9 1.375 1.375 0 00-.275-1.517l-.05-.05a1.667 1.667 0 112.359-2.358l.05.05a1.375 1.375 0 001.516.275h.067a1.375 1.375 0 00.833-1.258v-.142a1.667 1.667 0 013.334 0v.075a1.375 1.375 0 00.833 1.258 1.375 1.375 0 001.517-.275l.05-.05a1.667 1.667 0 112.358 2.359l-.05.05a1.375 1.375 0 00-.275 1.516v.067a1.375 1.375 0 001.258.833h.142a1.667 1.667 0 010 3.334h-.075a1.375 1.375 0 00-1.258.833z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
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
        "play" =>
            '<svg width="' .
            $size .
            '" height="' .
            $size .
            '" viewBox="0 0 20 20" fill="currentColor"><path d="M4.167 2.5v15l12.5-7.5-12.5-7.5z"/></svg>',
    ];

    return $icons[$name] ?? "";
}

/**
 * Body Classes
 */
function fieldcraft_body_classes($classes): array
{
    if (is_front_page()) {
        $classes[] = "is-front-page";
    }
    return $classes;
}
add_filter("body_class", "fieldcraft_body_classes");

/**
 * Add preconnect for Google Fonts
 */
function fieldcraft_preconnect_fonts(): void
{
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">';
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>';
}
add_action("wp_head", "fieldcraft_preconnect_fonts", 1);
