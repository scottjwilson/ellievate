<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo("charset"); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="header" id="header">
    <div class="container">
        <a href="<?php echo esc_url(
            home_url("/"),
        ); ?>" class="logo">Ellievated <em>Beauty</em></a>
        <nav>
            <ul class="nav-links" id="navLinks">
                <li><a href="<?php echo esc_url(
                    home_url("/#services"),
                ); ?>">Services</a></li>
                <li><a href="<?php echo esc_url(
                    home_url("/#about"),
                ); ?>">About</a></li>
                <li><a href="<?php echo esc_url(
                    home_url("/#reviews"),
                ); ?>">Reviews</a></li>
                <li><a href="<?php echo esc_url(
                    home_url("/shop"),
                ); ?>">Shop</a></li>
                <li class="nav-cta"><a href="<?php echo esc_url(
                    home_url("/contact"),
                ); ?>" class="btn btn-primary" style="font-size:12px; padding:0.6rem 1.5rem;">Book Now</a></li>
            </ul>
        </nav>
        <button class="mobile-toggle" id="mobileToggle" aria-label="Toggle menu">
            <span></span><span></span><span></span>
        </button>
    </div>
</header>

<main>
