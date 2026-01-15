<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
    <div class="container">
        <div class="header-inner">
            <!-- Logo -->
            <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                <span class="logo-icon">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                        <circle cx="8" cy="8" r="6" fill="currentColor"/>
                    </svg>
                </span>
                Fieldcraft
            </a>

            <!-- Desktop Navigation -->
            <nav class="nav-desktop">
                <ul class="nav-menu">
                    <li><a href="<?php echo esc_url(home_url('/')); ?>" class="nav-link">Home</a></li>
                    <li><a href="<?php echo esc_url(home_url('/about')); ?>" class="nav-link">About</a></li>
                    <li><a href="<?php echo esc_url(home_url('/services')); ?>" class="nav-link">Features</a></li>
                    <li><a href="<?php echo esc_url(home_url('/pricing')); ?>" class="nav-link">Pricing</a></li>
                    <li><a href="<?php echo esc_url(home_url('/resources')); ?>" class="nav-link">Resources</a></li>
                </ul>
                <div class="nav-actions">
                    <a href="<?php echo esc_url(home_url('/login')); ?>" class="btn btn-ghost">Login</a>
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary">Register</a>
                </div>
            </nav>

            <!-- Mobile Menu Toggle -->
            <button class="menu-toggle" aria-expanded="false" aria-label="Toggle menu">
                <span class="icon-menu"><?php echo fieldcraft_icon('menu', 24); ?></span>
                <span class="icon-close"><?php echo fieldcraft_icon('close', 24); ?></span>
            </button>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <nav class="nav-mobile">
        <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-link">Home</a>
        <a href="<?php echo esc_url(home_url('/about')); ?>" class="nav-link">About</a>
        <a href="<?php echo esc_url(home_url('/services')); ?>" class="nav-link">Features</a>
        <a href="<?php echo esc_url(home_url('/pricing')); ?>" class="nav-link">Pricing</a>
        <a href="<?php echo esc_url(home_url('/resources')); ?>" class="nav-link">Resources</a>
        <div style="display: flex; gap: 1rem; margin-top: 1rem;">
            <a href="<?php echo esc_url(home_url('/login')); ?>" class="btn btn-outline">Login</a>
            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary">Register</a>
        </div>
    </nav>
</header>

<main class="main-content">
