<?php
/**
 * Single Product — Service Page
 *
 * Custom template that replaces WooCommerce's default single-product.php
 * to present products as bookable services rather than shippable goods.
 *
 * @package Ellievated
 */

defined("ABSPATH") || exit();

get_header();

while (have_posts()):

    the_post();
    global $product;

    $duration = get_post_meta(get_the_ID(), "_service_duration", true);
    $icon = get_post_meta(get_the_ID(), "_service_icon", true);
    $features = get_post_meta(get_the_ID(), "_service_features", true);
    $cats = get_the_terms(get_the_ID(), "product_cat");
    $cat_name = $cats && !is_wp_error($cats) ? $cats[0]->name : "";
    ?>

<style>
/* Single Service Page */
.service-hero {
    padding: 10rem 0 4rem;
    background: linear-gradient(165deg, var(--cream) 0%, var(--pearl) 40%, var(--warm-linen) 100%);
    position: relative;
}
.service-hero::after {
    content: '';
    position: absolute;
    top: -15%;
    right: -8%;
    width: 55vw;
    height: 55vw;
    max-width: 650px;
    max-height: 650px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(157,168,142,0.1) 0%, transparent 70%);
    pointer-events: none;
}
.service-hero .container {
    position: relative;
    z-index: 2;
    display: grid;
    gap: clamp(2rem, 5vw, 4rem);
}
@media (min-width: 900px) {
    .service-hero .container {
        grid-template-columns: 1fr 1fr;
        align-items: center;
    }
}

.service-hero-content {}
.service-hero-cat {
    font-family: var(--font-body);
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--sage-deep);
    margin-bottom: 0.75rem;
}
.service-hero-title {
    font-family: var(--font-display);
    font-weight: 300;
    font-size: clamp(2.4rem, 5vw, 3.5rem);
    line-height: 1.1;
    color: var(--black);
    margin-bottom: 1.25rem;
}
.service-hero-meta {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    margin-bottom: 1.5rem;
    flex-wrap: wrap;
}
.service-hero-price {
    font-family: var(--font-display);
    font-size: 2rem;
    font-weight: 400;
    color: var(--black);
}
.service-hero-price span {
    font-family: var(--font-body);
    font-size: 13px;
    color: var(--text-muted);
    font-weight: 400;
}
.service-hero-duration {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    font-size: 12px;
    font-weight: 500;
    letter-spacing: 0.06em;
    text-transform: uppercase;
    color: var(--sage-deep);
    background: rgba(157,168,142,0.15);
    padding: 0.4rem 0.9rem;
    border-radius: 100px;
}
.service-hero-desc {
    font-size: 15px;
    color: var(--text-muted);
    line-height: 1.8;
    max-width: 480px;
    margin-bottom: 2rem;
}
.service-hero-actions {
    display: flex;
    gap: 1rem;
    flex-wrap: wrap;
}

/* Service visual */
.service-hero-visual {
    display: flex;
    justify-content: center;
}
.service-visual-frame {
    width: 100%;
    max-width: 420px;
    aspect-ratio: 4/5;
    border-radius: 32px;
    overflow: hidden;
    position: relative;
}
.service-visual-gradient {
    position: absolute;
    inset: 0;
}
.service-visual-inner {
    position: absolute;
    inset: 2rem;
    border-radius: 24px;
    border: 1px solid rgba(255,255,255,0.2);
    display: flex;
    align-items: center;
    justify-content: center;
}
.service-visual-icon {
    font-family: var(--font-display);
    font-size: clamp(3rem, 6vw, 5rem);
    font-weight: 300;
    font-style: italic;
    color: rgba(255,255,255,0.7);
}

/* Product image override */
.service-hero-visual .woocommerce-product-gallery {
    max-width: 420px;
    width: 100%;
}
.service-hero-visual .woocommerce-product-gallery img {
    border-radius: 32px;
    width: 100%;
    height: auto;
}

/* Features section */
.service-features-section {
    padding: var(--section-pad) 0;
    background: var(--cream);
}
.service-features-grid {
    display: grid;
    gap: clamp(2rem, 5vw, 4rem);
}
@media (min-width: 900px) {
    .service-features-grid {
        grid-template-columns: 1fr 1fr;
        align-items: start;
    }
}
.service-features-content h2 {
    font-family: var(--font-display);
    font-weight: 300;
    font-size: clamp(1.8rem, 3vw, 2.4rem);
    color: var(--black);
    margin-bottom: 1.5rem;
}
.service-full-desc {
    font-size: 15px;
    color: var(--text-muted);
    line-height: 1.8;
}
.service-full-desc p {
    margin-bottom: 1rem;
}
.service-features-list {
    background: var(--pearl);
    padding: 2.5rem;
    border-radius: 0;
}
.service-features-list h3 {
    font-family: var(--font-body);
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--sage-deep);
    margin-bottom: 1.5rem;
}
.sfl-items {
    display: grid;
    gap: 1rem;
}
.sfl-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    font-size: 14px;
    font-weight: 400;
    color: var(--ink);
}
.sfl-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: var(--sage);
    flex-shrink: 0;
}

/* CTA banner */
.service-cta {
    padding: var(--section-pad) 0;
    background: linear-gradient(135deg, var(--forest) 0%, var(--black) 100%);
    text-align: center;
    position: relative;
    overflow: hidden;
}
.service-cta::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -20%;
    width: 60%;
    height: 200%;
    background: radial-gradient(circle, rgba(157,168,142,0.08) 0%, transparent 70%);
    pointer-events: none;
}
.service-cta .container {
    position: relative;
    z-index: 2;
}
.service-cta-text {
    font-size: 15px;
    color: rgba(255,255,255,0.45);
    max-width: 440px;
    margin: 0 auto 2.5rem;
    line-height: 1.75;
}

/* Contact Strip */
.service-contact { padding: var(--section-pad) 0; background: var(--pearl); }
.contact-strip-grid {
    display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem; text-align: center;
}
.contact-strip-icon {
    width: 44px; height: 44px; display: flex; align-items: center;
    justify-content: center; background: var(--cream); color: var(--olive);
    border-radius: 50%; margin: 0 auto 0.75rem;
}
.contact-strip-label {
    font-size: 0.7rem; font-weight: 500; text-transform: uppercase;
    letter-spacing: 0.1em; color: var(--text-muted); margin-bottom: 0.25rem;
}
.contact-strip-value { font-size: 0.95rem; font-weight: 400; color: var(--ink); }
.contact-strip-value a {
    color: var(--olive); text-decoration: none;
    transition: color 0.3s var(--ease-out);
}
.contact-strip-value a:hover { color: var(--forest); }

/* Related Services */
.related-services {
    padding: var(--section-pad) 0;
    background: var(--cream);
}
.related-services-header {
    text-align: center;
    margin-bottom: 3rem;
}

/* Back link */
.service-back {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 12px;
    font-weight: 500;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: 2rem;
    transition: color 0.3s var(--ease-out);
}
.service-back:hover {
    color: var(--olive);
}
.service-back svg {
    transform: rotate(180deg);
}
</style>

<!-- Hero -->
<section class="service-hero">
    <div class="container">
        <div class="service-hero-content reveal">
            <a href="<?php echo esc_url(
                get_permalink(wc_get_page_id("shop")),
            ); ?>" class="service-back">
                <?php echo ellievated_icon("arrow-right", 14); ?>
                All Services
            </a>

            <?php if ($cat_name): ?>
                <p class="service-hero-cat"><?php echo esc_html(
                    $cat_name,
                ); ?></p>
            <?php endif; ?>

            <h1 class="service-hero-title"><?php the_title(); ?></h1>

            <div class="service-hero-meta">
                <div class="service-hero-price">$<?php echo esc_html(
                    $product->get_price(),
                ); ?> <span>/ session</span></div>
                <?php if ($duration): ?>
                    <span class="service-hero-duration">
                        <?php echo ellievated_icon("clock", 14); ?>
                        <?php echo esc_html($duration); ?>
                    </span>
                <?php endif; ?>
            </div>

            <?php if (has_excerpt()): ?>
                <p class="service-hero-desc"><?php echo get_the_excerpt(); ?></p>
            <?php endif; ?>

            <div class="service-hero-actions">
                <a href="<?php echo esc_url(
                    add_query_arg(
                        "service",
                        get_post_field("post_name"),
                        home_url("/contact"),
                    ),
                ); ?>" class="btn-primary">Book This Service</a>
                <a href="#contact" class="btn-outline">Ask a Question</a>
            </div>
        </div>

        <div class="service-hero-visual reveal">
            <?php if (has_post_thumbnail()): ?>
                <?php the_post_thumbnail("large", [
                    "style" =>
                        "border-radius: 32px; width: 100%; max-width: 420px; height: auto;",
                ]); ?>
            <?php else: ?>
                <img src="<?php echo esc_url(
                    get_template_directory_uri() . "/images/f.jpg",
                ); ?>"
                     alt="<?php echo esc_attr(get_the_title()); ?>"
                     style="border-radius: 32px; width: 100%; max-width: 420px; height: auto;">
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Details + Features -->
<?php
$content = get_the_content();
$has_features = $features && trim($features);
if ($content || $has_features): ?>
<section class="service-features-section">
    <div class="container">
        <div class="service-features-grid">
            <?php if ($content): ?>
                <div class="service-features-content reveal">
                    <h2>About this treatment</h2>
                    <div class="service-full-desc">
                        <?php echo wpautop($content); ?>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($has_features):
                $feature_list = array_filter(
                    array_map("trim", explode("\n", $features)),
                );
                if ($feature_list): ?>
                <div class="service-features-list reveal">
                    <h3>What's included</h3>
                    <div class="sfl-items">
                        <?php foreach ($feature_list as $feature): ?>
                            <div class="sfl-item">
                                <span class="sfl-dot"></span>
                                <?php echo esc_html($feature); ?>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif;
            endif; ?>
        </div>
    </div>
</section>
<?php endif;
?>

<!-- Related Services -->
<?php
$current_id = get_the_ID();
$related_services = new WP_Query([
    "post_type" => "product",
    "posts_per_page" => 3,
    "post__not_in" => [$current_id],
    "orderby" => "menu_order",
    "order" => "ASC",
    "post_status" => "publish",
]);

if ($related_services->have_posts()): ?>
<section class="related-services">
    <div class="container">
        <div class="related-services-header reveal">
            <p class="section-label">You might also like</p>
            <h2 class="section-title">Other <em class="swash">services</em></h2>
        </div>
        <div class="services-grid reveal-stagger">
            <?php
            while ($related_services->have_posts()):

                $related_services->the_post();
                $rel_product = wc_get_product(get_the_ID());
                $rel_duration = get_post_meta(
                    get_the_ID(),
                    "_service_duration",
                    true,
                );
                $rel_icon = get_post_meta(get_the_ID(), "_service_icon", true);
                ?>
            <div class="service-card">
                <?php if ($rel_icon): ?>
                    <div class="service-icon"><?php echo $rel_icon; ?></div>
                <?php endif; ?>
                <h3 class="service-name"><?php the_title(); ?></h3>
                <?php if ($rel_duration): ?>
                    <p class="service-duration"><?php echo esc_html(
                        $rel_duration,
                    ); ?></p>
                <?php endif; ?>
                <p class="service-desc"><?php echo get_the_excerpt(); ?></p>
                <div class="service-footer">
                    <div class="service-price">$<?php echo esc_html(
                        $rel_product->get_price(),
                    ); ?> <span>/ session</span></div>
                    <a href="<?php the_permalink(); ?>" class="btn btn-primary service-book">View</a>
                </div>
            </div>
            <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
    </div>
</section>
<?php endif;
?>

<!-- Contact -->
<section class="service-contact" id="contact">
    <div class="container">
        <div class="contact-strip-grid reveal-stagger">
            <div class="contact-strip-item">
                <div class="contact-strip-icon"><?php echo ellievated_icon(
                    "mail",
                    20,
                ); ?></div>
                <p class="contact-strip-label">Email</p>
                <p class="contact-strip-value"><a href="mailto:hello@ellievatedbeauty.com?subject=Question about <?php echo urlencode(
                    get_the_title(),
                ); ?>">hello@ellievatedbeauty.com</a></p>
            </div>
            <div class="contact-strip-item">
                <div class="contact-strip-icon"><?php echo ellievated_icon(
                    "phone",
                    20,
                ); ?></div>
                <p class="contact-strip-label">Phone</p>
                <p class="contact-strip-value"><a href="tel:+1234567890">(123) 456-7890</a></p>
            </div>
            <div class="contact-strip-item">
                <div class="contact-strip-icon"><?php echo ellievated_icon(
                    "map-pin",
                    20,
                ); ?></div>
                <p class="contact-strip-label">Location</p>
                <p class="contact-strip-value">Your City, State</p>
            </div>
            <div class="contact-strip-item">
                <div class="contact-strip-icon"><?php echo ellievated_icon(
                    "clock",
                    20,
                ); ?></div>
                <p class="contact-strip-label">Hours</p>
                <p class="contact-strip-value">By appointment only</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="service-cta">
    <div class="container">
        <div class="reveal">
            <p class="section-label" style="color: var(--sage);">Ready to book?</p>
            <h2 class="section-title" style="color: white;">Your skin will <em class="swash" style="display:inline; width:auto; height:auto; background:none;">thank you</em></h2>
            <p class="service-cta-text">Book your <?php echo esc_html(
                strtolower(get_the_title()),
            ); ?> today and experience the Ellievated difference.</p>
            <a href="<?php echo esc_url(
                add_query_arg(
                    "service",
                    get_post_field("post_name"),
                    home_url("/contact"),
                ),
            ); ?>" class="btn-light">Book Appointment</a>
        </div>
    </div>
</section>

<?php
endwhile;
?>

<?php get_footer(); ?>
