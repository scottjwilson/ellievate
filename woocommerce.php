<?php
/**
 * WooCommerce Shop Template
 *
 * @package Ellievated
 */

get_header(); ?>

<section class="shop-hero" style="padding: 10rem 0 4rem; background: var(--color-cream-100); text-align: center;">
    <div class="container">
        <span class="text-label" style="display: block; margin-bottom: var(--space-4);">Shop</span>
        <h1 style="font-family: var(--font-display); font-size: var(--text-hero); font-weight: 400;">Our <em style="font-style: italic; font-weight: 500;">Favorites</em></h1>
        <p style="font-size: var(--text-lg); font-weight: 300; color: var(--color-neutral-500); max-width: 500px; margin: var(--space-4) auto 0;">
            Curated skincare products we love and trust for maintaining your results at home.
        </p>
    </div>
</section>

<section class="section" style="background: white;">
    <div class="container">
        <?php woocommerce_content(); ?>
    </div>
</section>

<?php get_footer(); ?>
