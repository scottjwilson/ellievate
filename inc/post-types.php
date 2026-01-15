<?php
/**
 * Register Custom Post Types
 */
function fieldcraft_register_post_types(): void {
    register_post_type('case_study', [
        'labels' => [
            'name' => __('Case Studies', 'fieldcraft'),
            'singular_name' => __('Case Study', 'fieldcraft'),
        ],
        'public' => true,
        'has_archive' => true,
        'rewrite' => ['slug' => 'work'],
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
        'menu_icon' => 'dashicons-portfolio',
        'show_in_rest' => true,
    ]);

    register_post_type('service', [
        'labels' => [
            'name' => __('Services', 'fieldcraft'),
            'singular_name' => __('Service', 'fieldcraft'),
        ],
        'public' => true,
        'has_archive' => false,
        'rewrite' => ['slug' => 'services'],
        'supports' => ['title', 'editor', 'thumbnail', 'excerpt', 'page-attributes'],
        'menu_icon' => 'dashicons-hammer',
        'show_in_rest' => true,
    ]);
}
add_action('init', 'fieldcraft_register_post_types');
