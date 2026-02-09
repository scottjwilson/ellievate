<?php
/**
 * 404 Error Page
 *
 * @package Ellievated
 */

get_header(); ?>

<section style="min-height: 70vh; display: flex; align-items: center; background: var(--cream);">
    <div class="container" style="text-align: center;">
        <p style="font-family: var(--font-display); font-size: 8rem; font-weight: 400; color: var(--sage-light); line-height: 1; margin-bottom: 1rem;">404</p>
        <h1 style="font-family: var(--font-display); font-size: clamp(2rem, 4vw, 3rem); font-weight: 400; color: var(--ink);"><?php esc_html_e(
            "Page Not Found",
            "ellievated",
        ); ?></h1>
        <p style="font-size: 1.125rem; font-weight: 300; color: var(--text-muted); margin: 1rem auto 2rem; max-width: 400px; line-height: 1.7;">
            <?php esc_html_e(
                "The page you're looking for doesn't exist or has been moved.",
                "ellievated",
            ); ?>
        </p>
        <a href="<?php echo esc_url(home_url("/")); ?>" class="btn-outline">
            <?php esc_html_e("Back to Home", "ellievated"); ?>
        </a>
    </div>
</section>

<?php get_footer(); ?>
