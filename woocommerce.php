<?php
/**
 * WooCommerce Shop Template
 *
 * @package Ellievated
 */

get_header(); ?>

<section style="padding: 10rem 0 4rem; background: var(--cream); text-align: center;">
    <div class="container">
        <p class="section-label">Shop</p>
        <h1 class="section-title">Our <em class="swash">Favorites</em></h1>
        <p style="font-size: 1.125rem; font-weight: 300; color: var(--text-muted); max-width: 500px; margin: 1rem auto 0; line-height: 1.7;">
            Curated skincare products we love and trust for maintaining your results at home.
        </p>
    </div>
</section>

<section style="padding: var(--section-pad) 0; background: var(--cream);">
    <div class="container">
        <?php woocommerce_content(); ?>
    </div>
</section>

<?php get_footer(); ?>
