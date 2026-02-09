<?php
/**
 * Main Template File
 *
 * @package Ellievated
 */

get_header(); ?>

<section style="padding: 10rem 0 4rem; background: var(--color-cream-100); text-align: center;">
    <div class="container">
        <h1 style="font-family: var(--font-display); font-size: var(--text-hero); font-weight: 400;">Blog</h1>
    </div>
</section>

<section class="section" style="background: white;">
    <div class="container">
        <?php if (have_posts()): ?>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: var(--space-8);">
                <?php while (have_posts()):
                    the_post(); ?>
                    <article class="card" style="overflow: hidden;">
                        <?php if (has_post_thumbnail()): ?>
                            <div style="aspect-ratio: 16/10; overflow: hidden; margin: calc(var(--space-8) * -1) calc(var(--space-8) * -1) var(--space-4);">
                                <?php the_post_thumbnail("ellievated-card", [
                                    "style" =>
                                        "width: 100%; height: 100%; object-fit: cover;",
                                ]); ?>
                            </div>
                        <?php endif; ?>

                        <span style="font-size: var(--text-xs); color: var(--color-neutral-400); text-transform: uppercase; letter-spacing: var(--tracking-wider);">
                            <?php echo get_the_date("M j, Y"); ?>
                        </span>

                        <h3 style="font-family: var(--font-display); font-size: var(--text-xl); font-weight: 500; margin: var(--space-2) 0;">
                            <a href="<?php the_permalink(); ?>" style="color: var(--color-dark-900);">
                                <?php the_title(); ?>
                            </a>
                        </h3>

                        <p style="font-size: var(--text-sm); font-weight: 300; color: var(--color-neutral-500);">
                            <?php echo wp_trim_words(get_the_excerpt(), 15); ?>
                        </p>

                        <a href="<?php the_permalink(); ?>" class="service-link" style="margin-top: var(--space-4); display: inline-flex;">
                            <?php esc_html_e("Read more", "ellievated"); ?>
                            <?php echo ellievated_icon("arrow-right", 14); ?>
                        </a>
                    </article>
                <?php
                endwhile; ?>
            </div>

            <?php the_posts_pagination(); ?>

        <?php else: ?>
            <div style="text-align: center; padding: 4rem 0;">
                <h2 style="font-family: var(--font-display); font-size: var(--text-3xl); font-weight: 400;"><?php esc_html_e(
                    "Nothing Found",
                    "ellievated",
                ); ?></h2>
                <p style="color: var(--color-neutral-500); font-weight: 300; margin: var(--space-4) 0 var(--space-8);"><?php esc_html_e(
                    "Check back soon for skincare tips and beauty insights.",
                    "ellievated",
                ); ?></p>
                <a href="<?php echo esc_url(
                    home_url("/"),
                ); ?>" class="btn btn-outline"><?php esc_html_e(
    "Back to Home",
    "ellievated",
); ?></a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
