<?php
/**
 * Template Name: Services Page
 *
 * Services page for Ellievated Beauty.
 *
 * @package Ellievated
 */

get_header(); ?>

<style>
/* Services Page Styles */
.services-hero {
    position: relative;
    padding: 10rem 0 6rem;
    background: var(--color-cream-100);
    text-align: center;
}

.services-hero-content {
    max-width: 650px;
    margin: 0 auto;
}

.services-hero .text-label {
    color: var(--color-primary-600);
    margin-bottom: var(--space-4);
    display: block;
}

.services-hero h1 {
    font-family: var(--font-display);
    font-size: var(--text-hero);
    font-weight: 400;
    color: var(--color-dark-900);
    margin-bottom: var(--space-6);
}

.services-hero h1 em {
    font-style: italic;
    font-weight: 500;
}

.services-hero-text {
    font-size: var(--text-lg);
    font-weight: 300;
    color: var(--color-neutral-500);
    line-height: var(--leading-relaxed);
}

/* Service Detail Blocks */
.services-detail {
    padding: var(--section-padding) 0;
    background: white;
}

.service-detail-block {
    display: grid;
    gap: var(--space-12);
    padding: var(--space-16) 0;
    border-bottom: 1px solid var(--color-neutral-200);
}

.service-detail-block:first-child {
    padding-top: 0;
}

.service-detail-block:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

@media (min-width: 1024px) {
    .service-detail-block {
        grid-template-columns: 1fr 1fr;
        gap: var(--space-16);
        align-items: center;
    }

    .service-detail-block:nth-child(even) .service-detail-image {
        order: 2;
    }
}

.service-detail-image {
    overflow: hidden;
}

.service-detail-image img {
    width: 100%;
    aspect-ratio: 4/5;
    object-fit: cover;
}

.service-detail-content .text-label {
    margin-bottom: var(--space-3);
    display: block;
}

.service-detail-content h2 {
    font-family: var(--font-display);
    font-size: clamp(2rem, 4vw, 2.75rem);
    font-weight: 400;
    margin-bottom: var(--space-2);
}

.service-detail-price {
    font-family: var(--font-body);
    font-size: var(--text-lg);
    font-weight: 400;
    color: var(--color-primary-600);
    margin-bottom: var(--space-6);
}

.service-detail-content > p {
    font-size: var(--text-base);
    font-weight: 300;
    color: var(--color-neutral-500);
    line-height: var(--leading-relaxed);
    margin-bottom: var(--space-6);
}

.service-detail-features {
    display: grid;
    gap: var(--space-4);
    margin-bottom: var(--space-8);
}

.service-detail-feature {
    display: flex;
    align-items: flex-start;
    gap: var(--space-3);
}

.service-detail-feature svg {
    flex-shrink: 0;
    color: var(--color-primary-500);
    margin-top: 2px;
}

.service-detail-feature span {
    font-size: var(--text-sm);
    font-weight: 300;
    color: var(--color-neutral-600);
}

/* Booking Info */
.booking-info {
    padding: var(--section-padding) 0;
    background: var(--color-cream-100);
}

.booking-info-grid {
    display: grid;
    gap: var(--space-8);
    margin-top: var(--space-12);
}

@media (min-width: 768px) {
    .booking-info-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

.booking-info-card {
    text-align: center;
    padding: var(--space-8);
    background: white;
}

.booking-info-card svg {
    color: var(--color-primary-500);
    margin: 0 auto var(--space-4);
}

.booking-info-card h3 {
    font-family: var(--font-display);
    font-size: var(--text-xl);
    font-weight: 500;
    margin-bottom: var(--space-2);
}

.booking-info-card p {
    font-size: var(--text-sm);
    font-weight: 300;
    color: var(--color-neutral-500);
    line-height: var(--leading-relaxed);
}

/* Services CTA */
.services-cta {
    padding: var(--section-padding) 0;
    background: var(--color-dark-900);
    text-align: center;
    color: white;
}

.services-cta .cta-content {
    max-width: 600px;
    margin: 0 auto;
}

.services-cta h2 {
    font-family: var(--font-display);
    font-size: clamp(2rem, 4vw, 3rem);
    font-weight: 400;
    color: white;
    margin-bottom: var(--space-4);
}

.services-cta h2 em {
    font-style: italic;
}

.services-cta p {
    font-size: var(--text-base);
    font-weight: 300;
    color: var(--color-dark-300);
    line-height: var(--leading-relaxed);
    margin-bottom: var(--space-8);
}
</style>

<!-- Hero Section -->
<section class="services-hero">
    <div class="container">
        <div class="services-hero-content reveal">
            <span class="text-label">Our Services</span>
            <h1>Treatments for your <em>best</em> skin</h1>
            <p class="services-hero-text">
                From rejuvenating facials to precision waxing, each service is
                personalized to give you the results you deserve.
            </p>
        </div>
    </div>
</section>

<!-- Service Details -->
<section class="services-detail">
    <div class="container">
        <!-- Signature Facial -->
        <div class="service-detail-block">
            <div class="service-detail-image reveal">
                <img src="https://images.unsplash.com/photo-1616394584738-fc6e612e71b9?w=700&h=875&fit=crop" alt="Signature Facial treatment">
            </div>
            <div class="service-detail-content reveal reveal-delay-1">
                <span class="text-label">Facial Treatment</span>
                <h2>Signature Facial</h2>
                <p class="service-detail-price">Starting at $85</p>
                <p>
                    Our signature facial is a fully customized experience designed around your
                    skin's unique needs. Using premium products and expert techniques, we'll
                    cleanse, exfoliate, extract, and nourish your skin to reveal a healthy,
                    radiant glow.
                </p>
                <div class="service-detail-features">
                    <div class="service-detail-feature">
                        <?php echo ellievated_icon("check", 18); ?>
                        <span>Deep cleansing and gentle exfoliation</span>
                    </div>
                    <div class="service-detail-feature">
                        <?php echo ellievated_icon("check", 18); ?>
                        <span>Customized treatment mask for your skin type</span>
                    </div>
                    <div class="service-detail-feature">
                        <?php echo ellievated_icon("check", 18); ?>
                        <span>Facial massage for circulation and relaxation</span>
                    </div>
                    <div class="service-detail-feature">
                        <?php echo ellievated_icon("check", 18); ?>
                        <span>LED light therapy (when applicable)</span>
                    </div>
                    <div class="service-detail-feature">
                        <?php echo ellievated_icon("check", 18); ?>
                        <span>Personalized skincare recommendations</span>
                    </div>
                </div>
                <a href="<?php echo esc_url(
                    home_url("/contact"),
                ); ?>" class="btn btn-outline">
                    Book Now <?php echo ellievated_icon("arrow-right"); ?>
                </a>
            </div>
        </div>

        <!-- Brow Wax -->
        <div class="service-detail-block">
            <div class="service-detail-image reveal">
                <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=700&h=875&fit=crop" alt="Brow Wax service">
            </div>
            <div class="service-detail-content reveal reveal-delay-1">
                <span class="text-label">Waxing</span>
                <h2>Brow Wax</h2>
                <p class="service-detail-price">Starting at $25</p>
                <p>
                    Perfectly shaped brows can transform your entire look. Our precision
                    brow waxing service sculpts and defines your brows to complement your
                    face shape, giving you that polished, put-together look every day.
                </p>
                <div class="service-detail-features">
                    <div class="service-detail-feature">
                        <?php echo ellievated_icon("check", 18); ?>
                        <span>Custom brow mapping for your face shape</span>
                    </div>
                    <div class="service-detail-feature">
                        <?php echo ellievated_icon("check", 18); ?>
                        <span>Gentle, low-irritation hard wax formula</span>
                    </div>
                    <div class="service-detail-feature">
                        <?php echo ellievated_icon("check", 18); ?>
                        <span>Precision tweezing for clean finish</span>
                    </div>
                    <div class="service-detail-feature">
                        <?php echo ellievated_icon("check", 18); ?>
                        <span>Soothing post-wax treatment to calm skin</span>
                    </div>
                </div>
                <a href="<?php echo esc_url(
                    home_url("/contact"),
                ); ?>" class="btn btn-outline">
                    Book Now <?php echo ellievated_icon("arrow-right"); ?>
                </a>
            </div>
        </div>

        <!-- Brazilian Wax -->
        <div class="service-detail-block">
            <div class="service-detail-image reveal">
                <img src="https://images.unsplash.com/photo-1552693673-1bf958c31657?w=700&h=875&fit=crop" alt="Brazilian Wax service">
            </div>
            <div class="service-detail-content reveal reveal-delay-1">
                <span class="text-label">Waxing</span>
                <h2>Brazilian Wax</h2>
                <p class="service-detail-price">Starting at $55</p>
                <p>
                    Experience smooth, long-lasting results with our Brazilian wax service.
                    We use premium hard wax and a gentle technique to minimize discomfort
                    while delivering flawless results. Your comfort is our top priority.
                </p>
                <div class="service-detail-features">
                    <div class="service-detail-feature">
                        <?php echo ellievated_icon("check", 18); ?>
                        <span>Premium hard wax for sensitive areas</span>
                    </div>
                    <div class="service-detail-feature">
                        <?php echo ellievated_icon("check", 18); ?>
                        <span>Comfortable, professional environment</span>
                    </div>
                    <div class="service-detail-feature">
                        <?php echo ellievated_icon("check", 18); ?>
                        <span>Pre and post-wax skin care included</span>
                    </div>
                    <div class="service-detail-feature">
                        <?php echo ellievated_icon("check", 18); ?>
                        <span>Aftercare instructions and product recommendations</span>
                    </div>
                </div>
                <a href="<?php echo esc_url(
                    home_url("/contact"),
                ); ?>" class="btn btn-outline">
                    Book Now <?php echo ellievated_icon("arrow-right"); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Booking Info -->
<section class="booking-info">
    <div class="container">
        <div class="section-header center reveal">
            <span class="text-label">Good to Know</span>
            <h2 class="text-display">Before your appointment</h2>
        </div>

        <div class="booking-info-grid">
            <div class="booking-info-card reveal">
                <?php echo ellievated_icon("calendar", 32); ?>
                <h3>Book Ahead</h3>
                <p>We recommend booking at least 48 hours in advance to secure your preferred time slot.</p>
            </div>

            <div class="booking-info-card reveal reveal-delay-1">
                <?php echo ellievated_icon("clock", 32); ?>
                <h3>Arrive On Time</h3>
                <p>Please arrive 5-10 minutes before your appointment to fill out any forms and get settled.</p>
            </div>

            <div class="booking-info-card reveal reveal-delay-2">
                <?php echo ellievated_icon("heart", 32); ?>
                <h3>Aftercare</h3>
                <p>Follow the personalized aftercare instructions provided to maintain your beautiful results.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="services-cta">
    <div class="container">
        <div class="cta-content reveal">
            <h2>Ready to <em>glow</em>?</h2>
            <p>Book your appointment today and let us help you look and feel your absolute best.</p>
            <a href="<?php echo esc_url(
                home_url("/contact"),
            ); ?>" class="btn btn-outline-light btn-lg">
                Book an Appointment
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
