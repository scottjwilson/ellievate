<?php
/**
 * Default Page Template
 *
 * @package Ellievated
 */

get_header(); ?>

<?php while (have_posts()):
    the_post(); ?>

<section style="padding: 10rem 0 4rem; background: var(--cream); text-align: center;">
    <div class="container">
        <h1 style="font-family: var(--font-display); font-size: clamp(2.8rem, 5vw, 4rem); font-weight: 400; color: var(--ink);"><?php the_title(); ?></h1>
        <?php if (has_excerpt()): ?>
            <p style="font-size: 1.125rem; font-weight: 300; color: var(--text-muted); max-width: 600px; margin: 1rem auto 0; line-height: 1.7;"><?php echo get_the_excerpt(); ?></p>
        <?php endif; ?>
    </div>
</section>

<section style="padding: var(--section-pad) 0; background: var(--cream);">
    <div class="container" style="max-width: 800px;">
        <div class="prose">
            <?php the_content(); ?>
        </div>
    </div>
</section>

<?php
endwhile; ?>

<?php get_footer(); ?>
