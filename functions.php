<?php
/**
 * Ellievated Beauty - Theme Functions
 *
 * @package Ellievated
 */

// Theme setup: menus, supports, and base assets
require_once get_template_directory() . "/inc/theme-setup.php";

// Vite integration: dev server detection and production asset loading
require_once get_template_directory() . "/inc/vite.php";

// Custom post types (if needed)
require_once get_template_directory() . "/inc/post-types.php";

// Booking management: database, availability, admin page
require_once get_template_directory() . "/inc/bookings.php";
