<?php
/**
 * Template Name: Services Page
 *
 * @package Ellievated
 */

get_header(); ?>

<!-- Hero -->
<section class="services-page-hero">
    <div class="container">
        <span class="swash"></span>
        <p class="section-label">Our Services</p>
        <h1 class="section-title">Treatments for your best skin</h1>
        <p class="section-subtitle">From rejuvenating facials to precision waxing, each service is personalized to give you the results you deserve.</p>
    </div>
</section>

<!-- Service Details -->
<section class="service-details">
    <div class="container">
        <?php
        $services = ellievated_get_services();
        if ($services->have_posts()):
            $index = 0;
            while ($services->have_posts()):

                $services->the_post();
                $index++;
                $product = wc_get_product(get_the_ID());
                $duration = get_post_meta(
                    get_the_ID(),
                    "_service_duration",
                    true,
                );
                $icon = get_post_meta(get_the_ID(), "_service_icon", true);
                $features = get_post_meta(
                    get_the_ID(),
                    "_service_features",
                    true,
                );
                $cats = get_the_terms(get_the_ID(), "product_cat");
                $cat_name = $cats && !is_wp_error($cats) ? $cats[0]->name : "";
                $gradient = "sd-gradient-" . ((($index - 1) % 3) + 1);
                ?>
        <div class="service-detail-block">
            <div class="sd-visual reveal">
                <div class="sd-visual-frame">
                    <div class="sd-gradient <?php echo esc_attr(
                        $gradient,
                    ); ?>"></div>
                    <div class="sd-inner">
                        <?php if ($icon): ?>
                            <div class="sd-icon-text"><?php echo $icon; ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="sd-content reveal">
                <?php if ($cat_name): ?>
                    <p class="section-label"><?php echo esc_html(
                        $cat_name,
                    ); ?></p>
                <?php endif; ?>
                <h2 class="section-title"><?php the_title(); ?></h2>
                <div class="sd-price">$<?php echo esc_html(
                    $product->get_price(),
                ); ?> <span>/ session</span></div>
                <?php if ($duration): ?>
                    <p class="sd-duration"><?php echo esc_html(
                        $duration,
                    ); ?></p>
                <?php endif; ?>
                <p class="sd-text"><?php echo get_the_content(); ?></p>
                <?php if ($features):
                    $feature_list = array_filter(
                        array_map("trim", explode("\n", $features)),
                    );
                    if ($feature_list): ?>
                    <div class="sd-features">
                        <?php foreach ($feature_list as $feature): ?>
                            <div class="sd-feature"><span class="sd-feature-dot"></span> <?php echo esc_html(
                                $feature,
                            ); ?></div>
                        <?php endforeach; ?>
                    </div>
                    <?php endif;
                endif; ?>
                <a href="<?php the_permalink(); ?>" class="btn btn-primary">Book Now</a>
            </div>
        </div>
        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
</section>

<!-- Booking Info -->
<section class="booking-info">
    <div class="container">
        <div class="services-header reveal" style="text-align:center;">
            <span class="swash" style="margin:0 auto 1.5rem;"></span>
            <p class="section-label">Good to Know</p>
            <h2 class="section-title">Before your appointment</h2>
        </div>
        <div class="booking-info-grid reveal-stagger">
            <div class="booking-info-card">
                <div class="bi-icon">&#128197;</div>
                <h3>Book Ahead</h3>
                <p>We recommend booking at least 48 hours in advance to secure your preferred time slot.</p>
            </div>
            <div class="booking-info-card">
                <div class="bi-icon">&#9201;</div>
                <h3>Arrive On Time</h3>
                <p>Please arrive 5-10 minutes early to fill out any forms and get settled in.</p>
            </div>
            <div class="booking-info-card">
                <div class="bi-icon">&#10084;</div>
                <h3>Aftercare</h3>
                <p>Follow the personalized aftercare instructions to maintain your beautiful results.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="services-cta">
    <div class="container">
        <p class="section-label">Ready to Glow?</p>
        <h2 class="section-title">Your best skin is one booking away</h2>
        <p class="services-cta-text">Book your appointment today and experience the Ellievated difference.</p>
        <a href="<?php echo esc_url(
            home_url("/contact"),
        ); ?>" class="btn btn-light">Book Online</a>
    </div>
</section>

<?php get_footer(); ?>
