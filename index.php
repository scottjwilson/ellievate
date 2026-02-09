<?php
/**
 * Main Template File
 *
 * @package Ellievated
 */

get_header(); ?>

<section style="padding: 10rem 0 4rem; background: var(--cream); text-align: center;">
    <div class="container">
        <p class="section-label">Journal</p>
        <h1 class="section-title">Beauty <em class="swash">insights</em></h1>
    </div>
</section>

<section style="padding: var(--section-pad) 0; background: var(--cream);">
    <div class="container">
        <?php if (have_posts()): ?>
            <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem;">
                <?php while (have_posts()):
                    the_post(); ?>
                    <article class="reveal" style="background: var(--pearl); padding: 0; overflow: hidden;">
                        <?php if (has_post_thumbnail()): ?>
                            <div style="aspect-ratio: 16/10; overflow: hidden;">
                                <?php the_post_thumbnail("ellievated-card", [
                                    "style" =>
                                        "width: 100%; height: 100%; object-fit: cover;",
                                ]); ?>
                            </div>
                        <?php endif; ?>

                        <div style="padding: 1.5rem;">
                            <span style="font-size: 0.7rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 0.1em; font-weight: 500;">
                                <?php echo get_the_date("M j, Y"); ?>
                            </span>

                            <h3 style="font-family: var(--font-display); font-size: 1.4rem; font-weight: 400; margin: 0.5rem 0; color: var(--ink);">
                                <a href="<?php the_permalink(); ?>" style="color: inherit; text-decoration: none;">
                                    <?php the_title(); ?>
                                </a>
                            </h3>

                            <p style="font-size: 0.9rem; font-weight: 300; color: var(--text-muted); line-height: 1.6;">
                                <?php echo wp_trim_words(
                                    get_the_excerpt(),
                                    15,
                                ); ?>
                            </p>

                            <a href="<?php the_permalink(); ?>" style="display: inline-flex; align-items: center; gap: 0.5rem; margin-top: 1rem; font-size: 0.8rem; font-weight: 500; color: var(--olive); text-decoration: none; text-transform: uppercase; letter-spacing: 0.08em;">
                                <?php esc_html_e("Read more", "ellievated"); ?>
                                <?php echo ellievated_icon(
                                    "arrow-right",
                                    14,
                                ); ?>
                            </a>
                        </div>
                    </article>
                <?php
                endwhile; ?>
            </div>

            <?php the_posts_pagination(); ?>

        <?php else: ?>
            <div style="text-align: center; padding: 4rem 0;">
                <h2 style="font-family: var(--font-display); font-size: clamp(1.8rem, 3vw, 2.4rem); font-weight: 400; color: var(--ink);"><?php esc_html_e(
                    "Nothing Found",
                    "ellievated",
                ); ?></h2>
                <p style="color: var(--text-muted); font-weight: 300; margin: 1rem 0 2rem; line-height: 1.7;"><?php esc_html_e(
                    "Check back soon for skincare tips and beauty insights.",
                    "ellievated",
                ); ?></p>
                <a href="<?php echo esc_url(
                    home_url("/"),
                ); ?>" class="btn-outline"><?php esc_html_e(
    "Back to Home",
    "ellievated",
); ?></a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
