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
// Determine header variant based on template
$header_class = "site-header";
$use_light_header =
    is_front_page() || is_page_template(["about.php", "services.php"]);
if ($use_light_header) {
    $header_class .= " header-light";
}
?>

<header class="<?php echo esc_attr($header_class); ?>">
    <div class="container">
        <div class="header-inner">
            <!-- Logo -->
            <a href="<?php echo esc_url(home_url("/")); ?>" class="site-logo">
                <span class="logo-mark">F</span>
                <span>Fieldcraft</span>
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
                        home_url("/work"),
                    ); ?>" class="nav-link">Work</a></li>
                    <li><a href="<?php echo esc_url(
                        home_url("/about"),
                    ); ?>" class="nav-link">About</a></li>
                    <li><a href="<?php echo esc_url(
                        home_url("/blog"),
                    ); ?>" class="nav-link">Blog</a></li>
                </ul>
                <div class="nav-actions">
                    <a href="<?php echo esc_url(
                        home_url("/contact"),
                    ); ?>" class="btn btn-accent">
                        Get in Touch
                        <?php echo fieldcraft_icon("arrow-right"); ?>
                    </a>
                </div>
            </nav>

            <!-- Mobile Menu Toggle -->
            <button class="menu-toggle" aria-expanded="false" aria-label="Toggle menu">
                <span class="icon-menu"><?php echo fieldcraft_icon(
                    "menu",
                    24,
                ); ?></span>
                <span class="icon-close"><?php echo fieldcraft_icon(
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
            home_url("/work"),
        ); ?>" class="nav-link">Work</a>
        <a href="<?php echo esc_url(
            home_url("/about"),
        ); ?>" class="nav-link">About</a>
        <a href="<?php echo esc_url(
            home_url("/blog"),
        ); ?>" class="nav-link">Blog</a>
        <div class="nav-mobile-actions">
            <a href="<?php echo esc_url(
                home_url("/contact"),
            ); ?>" class="btn btn-accent">
                Get in Touch
                <?php echo fieldcraft_icon("arrow-right"); ?>
            </a>
        </div>
    </nav>
</header>

<main class="main-content">
