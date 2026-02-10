<?php
/**
 * WooCommerce Template
 *
 * Routes single products to our custom service template,
 * everything else (shop, archive) uses woocommerce_content().
 *
 * @package Ellievated
 */

if (is_singular("product")) {
    wc_get_template("single-product.php");
    return;
}

get_header();
?>

<section style="padding: var(--section-pad) 0; padding-top: 10rem; background: var(--cream);">
    <div class="container">
        <?php woocommerce_content(); ?>
    </div>
</section>

<?php get_footer(); ?>
