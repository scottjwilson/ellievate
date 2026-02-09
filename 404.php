<?php
/**
 * 404 Error Page
 *
 * @package Ellievated
 */

get_header(); ?>

<section style="min-height: 70vh; display: flex; align-items: center; background: var(--color-cream-100);">
    <div class="container" style="text-align: center;">
        <p style="font-family: var(--font-display); font-size: 8rem; font-weight: 400; color: var(--color-neutral-200); line-height: 1; margin-bottom: 1rem;">404</p>
        <h1 style="font-family: var(--font-display); font-size: var(--text-5xl); font-weight: 400;"><?php esc_html_e(
            "Page Not Found",
            "ellievated",
        ); ?></h1>
        <p style="font-size: var(--text-lg); font-weight: 300; color: var(--color-neutral-500); margin: var(--space-4) auto var(--space-8); max-width: 400px;">
            <?php esc_html_e(
                "The page you're looking for doesn't exist or has been moved.",
                "ellievated",
            ); ?>
        </p>
        <a href="<?php echo esc_url(
            home_url("/"),
        ); ?>" class="btn btn-outline btn-lg">
            <?php esc_html_e("Back to Home", "ellievated"); ?>
        </a>
    </div>
</section>

<?php get_footer(); ?>
