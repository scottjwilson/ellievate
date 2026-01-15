<?php
/**
 * Theme functions and definitions
 */

// Theme setup: menus, supports, and base assets
require_once get_template_directory() . '/inc/theme-setup.php';

// Vite integration: dev server detection and production asset loading
require_once get_template_directory() . '/inc/vite.php';

// Post types
require_once get_template_directory() . '/inc/post-types.php';
