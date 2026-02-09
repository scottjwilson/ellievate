<?php
/**
 * Default Page Template
 *
 * @package Ellievated
 */

get_header(); ?>

<?php while (have_posts()):
    the_post(); ?>

<section style="padding: 10rem 0 4rem; background: var(--color-cream-100); text-align: center;">
    <div class="container">
        <h1 style="font-family: var(--font-display); font-size: var(--text-hero); font-weight: 400;"><?php the_title(); ?></h1>
        <?php if (has_excerpt()): ?>
            <p style="font-size: var(--text-lg); font-weight: 300; color: var(--color-neutral-500); max-width: 600px; margin: var(--space-4) auto 0;"><?php echo get_the_excerpt(); ?></p>
        <?php endif; ?>
    </div>
</section>

<section class="section" style="background: white;">
    <div class="container" style="max-width: 800px;">
        <div class="prose">
            <?php the_content(); ?>
        </div>
    </div>
</section>

<?php
endwhile; ?>

<?php get_footer(); ?>
