<?php
/**
 * 404 Error Page
 *
 * @package Fieldcraft
 */

get_header();
?>

<section class="hero" style="min-height: 70vh; display: flex; align-items: center;">
    <div class="container">
        <div class="hero-content">
            <p style="font-family: var(--font-display); font-size: 8rem; font-weight: 700; color: var(--color-neutral-200); line-height: 1; margin-bottom: 1rem;">404</p>
            <h1 class="text-display">Page Not Found</h1>
            <p class="hero-subtitle">The page you're looking for doesn't exist or has been moved.</p>
            <div class="hero-actions">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary btn-lg">
                    Back to Home <?php echo fieldcraft_icon('arrow-right'); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-outline btn-lg">Contact Us</a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
