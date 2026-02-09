<?php
/**
 * WooCommerce Shop Template
 *
 * @package Ellievated
 */

get_header(); ?>

<section style="padding: var(--section-pad) 0; padding-top: 10rem; background: var(--cream);">
    <div class="container">
        <?php woocommerce_content(); ?>
    </div>
</section>

<?php get_footer(); ?>
