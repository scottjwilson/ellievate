<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo("charset"); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php
$header_class = "site-header";
if (is_front_page() || is_page_template(["services.php"])) {
    $header_class .= " header-light";
}
?>

<header class="<?php echo esc_attr($header_class); ?>">
    <div class="container">
        <div class="header-inner">
            <!-- Logo -->
            <a href="<?php echo esc_url(home_url("/")); ?>" class="site-logo">
                <span class="logo-mark">EB</span>
                <span>Ellievated Beauty</span>
            </a>

            <!-- Desktop Navigation -->
            <nav class="nav-desktop">
                <ul class="nav-menu">
                    <li><a href="<?php echo esc_url(
                        home_url("/"),
                    ); ?>" class="nav-link<?php echo is_front_page()
    ? " is-active"
    : ""; ?>">Home</a></li>
                    <li><a href="<?php echo esc_url(
                        home_url("/services"),
                    ); ?>" class="nav-link">Services</a></li>
                    <li><a href="<?php echo esc_url(
                        home_url("/shop"),
                    ); ?>" class="nav-link">Shop</a></li>
                    <li><a href="<?php echo esc_url(
                        home_url("/contact"),
                    ); ?>" class="nav-link">Contact</a></li>
                </ul>
                <div class="nav-actions">
                    <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" class="nav-social" aria-label="Instagram">
                        <?php echo ellievated_icon("instagram", 18); ?>
                    </a>
                    <a href="<?php echo esc_url(
                        home_url("/contact"),
                    ); ?>" class="btn btn-outline">
                        Book an Appointment
                    </a>
                </div>
            </nav>

            <!-- Mobile Menu Toggle -->
            <button class="menu-toggle" aria-expanded="false" aria-label="Toggle menu">
                <span class="icon-menu"><?php echo ellievated_icon(
                    "menu",
                    24,
                ); ?></span>
                <span class="icon-close"><?php echo ellievated_icon(
                    "close",
                    24,
                ); ?></span>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <nav class="nav-mobile" aria-hidden="true">
        <a href="<?php echo esc_url(
            home_url("/"),
        ); ?>" class="nav-link">Home</a>
        <a href="<?php echo esc_url(
            home_url("/services"),
        ); ?>" class="nav-link">Services</a>
        <a href="<?php echo esc_url(
            home_url("/shop"),
        ); ?>" class="nav-link">Shop</a>
        <a href="<?php echo esc_url(
            home_url("/contact"),
        ); ?>" class="nav-link">Contact</a>
        <div class="nav-mobile-actions">
            <a href="<?php echo esc_url(
                home_url("/contact"),
            ); ?>" class="btn btn-outline">
                Book an Appointment
            </a>
        </div>
    </nav>
</header>

<main class="main-content">
