<?php
/**
 * Main template file
 *
 * @package Fieldcraft
 */

get_header();
?>

<section class="section">
    <div class="container">
        <?php if (have_posts()) : ?>
            <div class="grid grid-3">
                <?php while (have_posts()) : the_post(); ?>
                    <article class="card card-hover">
                        <?php if (has_post_thumbnail()) : ?>
                            <div style="aspect-ratio: 16/10; border-radius: var(--radius-lg); overflow: hidden; margin-bottom: 1rem;">
                                <?php the_post_thumbnail('fieldcraft-card', ['style' => 'width: 100%; height: 100%; object-fit: cover;']); ?>
                            </div>
                        <?php endif; ?>

                        <span style="font-size: 0.75rem; color: var(--color-neutral-500);">
                            <?php echo get_the_date('M j, Y'); ?>
                        </span>

                        <h3 style="font-size: 1.125rem; margin: 0.5rem 0;">
                            <a href="<?php the_permalink(); ?>" style="color: var(--color-neutral-900);">
                                <?php the_title(); ?>
                            </a>
                        </h3>

                        <p class="card-text"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>

                        <a href="<?php the_permalink(); ?>" style="display: inline-flex; align-items: center; gap: 0.5rem; margin-top: 1rem; font-weight: 600; font-size: 0.875rem; color: var(--color-primary-700);">
                            Read more <?php echo fieldcraft_icon('arrow-right', 16); ?>
                        </a>
                    </article>
                <?php endwhile; ?>
            </div>

            <?php the_posts_pagination(); ?>

        <?php else : ?>
            <div style="text-align: center; padding: 4rem 0;">
                <h2 class="text-display">Nothing Found</h2>
                <p style="color: var(--color-neutral-600); margin: 1rem 0 2rem;">We couldn't find what you're looking for.</p>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">Back to Home</a>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php get_footer(); ?>
