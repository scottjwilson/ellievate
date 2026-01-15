<?php
/**
 * Theme Setup
 *
 * Core theme configuration, menus, and theme supports.
 */


 defined('ABSPATH') || exit;

 define('FIELDCRAFT_VERSION', '1.0.0');
 define('FIELDCRAFT_DIR', get_template_directory());
 define('FIELDCRAFT_URI', get_template_directory_uri());

/**
 * Register theme supports and navigation menus
 */

function the_theme_setup(): void {
    add_theme_support('automatic-feed-links');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('custom-logo', ['height' => 40, 'width' => 160, 'flex-width' => true, 'flex-height' => true]);
    add_theme_support('align-wide');
    add_theme_support('responsive-embeds');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ));

    add_image_size('fieldcraft-card', 600, 400, true);
    add_image_size('fieldcraft-hero', 1200, 800, true);

    register_nav_menus([
        'primary' => __('Primary Menu', 'fieldcraft'),
        'footer'  => __('Footer Menu', 'fieldcraft'),
    ]);
}
add_action('after_setup_theme', 'the_theme_setup');

/**
 * Add preconnect hints for Google Fonts
 */
function the_theme_font_preconnect(): void {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action('wp_head', 'the_theme_font_preconnect', 1);

/**
 * Enqueue base styles and scripts
 */
function the_theme_enqueue_assets(): void {
    // Google Fonts
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700;800&display=swap',
        array(),
        null
    );

    // Main stylesheet (required by WordPress)
    wp_enqueue_style('the-theme-style', get_stylesheet_uri());

    // Check if Vite handles assets
    if (function_exists('the_theme_detect_vite_server')) {
        $vite = the_theme_detect_vite_server();
        $has_manifest = file_exists(get_theme_file_path('dist/manifest.json'));

        if ($vite['running'] || $has_manifest) {
            return;
        }
    }

    // Fallback: enqueue CSS directly if Vite is not available
    wp_enqueue_style('variables', get_template_directory_uri() . '/css/variables.css', array('google-fonts'), '1.0.0');
    wp_enqueue_style('base', get_template_directory_uri() . '/css/base.css', array('variables'), '1.0.0');
    wp_enqueue_style('header', get_template_directory_uri() . '/css/header.css', array('base'), '1.0.0');
    wp_enqueue_style('footer', get_template_directory_uri() . '/css/footer.css', array('base'), '1.0.0');

    if (is_front_page()) {
        wp_enqueue_style('front-page', get_template_directory_uri() . '/css/front-page.css', array('base'), '1.0.0');
    }
}
add_action('wp_enqueue_scripts', 'the_theme_enqueue_assets');

/**
 * Custom excerpt length
 *
 * @param int $length Default excerpt length
 * @return int Modified excerpt length
 */
function the_theme_excerpt_length(int $length): int {
    return 15;
}
add_filter('excerpt_length', 'the_theme_excerpt_length', 999);


/**
 * SVG Icons
 */
function fieldcraft_icon($name, $size = 20): string {
    $icons = [
        'arrow-right' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 20 20" fill="none"><path d="M4.167 10h11.666M10 4.167L15.833 10 10 15.833" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'check' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 20 20" fill="none"><path d="M16.667 5L7.5 14.167 3.333 10" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'plus' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 20 20" fill="none"><path d="M10 4.167v11.666M4.167 10h11.666" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'lightning' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 20 20" fill="none"><path d="M11.667 1.667L2.5 11.667h7.5l-.833 6.666 9.166-10h-7.5l.834-6.666z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'code' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 20 20" fill="none"><path d="M13.333 15l5-5-5-5M6.667 5l-5 5 5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'chart' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 20 20" fill="none"><path d="M15 16.667V8.333M10 16.667V3.333M5 16.667v-5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'users' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 20 20" fill="none"><path d="M14.167 17.5v-1.667a3.333 3.333 0 00-3.334-3.333H5.833a3.333 3.333 0 00-3.333 3.333V17.5M8.333 9.167a3.333 3.333 0 100-6.667 3.333 3.333 0 000 6.667zM17.5 17.5v-1.667a3.333 3.333 0 00-2.5-3.225M12.5 2.608a3.333 3.333 0 010 6.459" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'settings' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="10" r="2.5" stroke="currentColor" stroke-width="1.5"/><path d="M16.167 12.5a1.375 1.375 0 00.275 1.517l.05.05a1.667 1.667 0 11-2.359 2.358l-.05-.05a1.375 1.375 0 00-1.516-.275 1.375 1.375 0 00-.834 1.258v.142a1.667 1.667 0 11-3.333 0v-.075a1.375 1.375 0 00-.9-1.258 1.375 1.375 0 00-1.517.275l-.05.05a1.667 1.667 0 11-2.358-2.359l.05-.05a1.375 1.375 0 00.275-1.516 1.375 1.375 0 00-1.258-.834h-.142a1.667 1.667 0 110-3.333h.075a1.375 1.375 0 001.258-.9 1.375 1.375 0 00-.275-1.517l-.05-.05a1.667 1.667 0 112.359-2.358l.05.05a1.375 1.375 0 001.516.275h.067a1.375 1.375 0 00.833-1.258v-.142a1.667 1.667 0 013.334 0v.075a1.375 1.375 0 00.833 1.258 1.375 1.375 0 001.517-.275l.05-.05a1.667 1.667 0 112.358 2.359l-.05.05a1.375 1.375 0 00-.275 1.516v.067a1.375 1.375 0 001.258.833h.142a1.667 1.667 0 010 3.334h-.075a1.375 1.375 0 00-1.258.833z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'star' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 20 20" fill="none"><path d="M10 1.667l2.575 5.216 5.758.842-4.166 4.058.983 5.734L10 14.792l-5.15 2.725.983-5.734-4.166-4.058 5.758-.842L10 1.667z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'globe' => '<svg width="' . $size . '" height="' . $size . '" viewBox="0 0 20 20" fill="none"><circle cx="10" cy="10" r="8.333" stroke="currentColor" stroke-width="1.5"/><path d="M1.667 10h16.666M10 1.667a12.75 12.75 0 013.333 8.333 12.75 12.75 0 01-3.333 8.333 12.75 12.75 0 01-3.333-8.333A12.75 12.75 0 0110 1.667z" stroke="currentColor" stroke-width="1.5"/></svg>',
        'menu' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M3 12h18M3 6h18M3 18h18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
        'close' => '<svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M18 6L6 18M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>',
    ];

    return $icons[$name] ?? '';
}

/**
 * Body Classes
 */
function fieldcraft_body_classes($classes): array {
    if (is_front_page()) {
        $classes[] = 'is-front-page';
    }
    return $classes;
}
add_filter('body_class', 'fieldcraft_body_classes');
