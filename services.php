<?php
/**
 * Template Name: Services Page
 *
 * @package Ellievated
 */

get_header(); ?>

<style>
.services-page-hero {
    min-height: 50vh;
    display: flex; align-items: center;
    background: linear-gradient(165deg, var(--cream) 0%, var(--pearl) 40%, var(--warm-linen) 100%);
    padding: 8rem 0 4rem;
    text-align: center;
    position: relative;
}
.services-page-hero::after {
    content: '';
    position: absolute; top: -15%; right: -8%;
    width: 55vw; height: 55vw; max-width: 650px; max-height: 650px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(157,168,142,0.1) 0%, transparent 70%);
    pointer-events: none;
}
.services-page-hero .container { position: relative; z-index: 2; }
.services-page-hero .section-title { max-width: 500px; margin: 0 auto 1rem; }
.services-page-hero .section-subtitle { margin: 0 auto; }
.services-page-hero .swash { margin: 0 auto 1.5rem; }

/* Detail blocks */
.service-details { padding: var(--section-pad) 0; background: #fff; }

.service-detail-block {
    display: grid; gap: clamp(2rem, 5vw, 5rem);
    padding: var(--section-pad) 0;
    border-bottom: 1px solid var(--border);
}
.service-detail-block:first-child { padding-top: 0; }
.service-detail-block:last-child { border-bottom: none; padding-bottom: 0; }

@media (min-width: 900px) {
    .service-detail-block { grid-template-columns: 1fr 1fr; align-items: center; }
    .service-detail-block:nth-child(even) .sd-visual { order: 2; }
}

.sd-visual-frame {
    width: 100%; aspect-ratio: 4/5;
    border-radius: 32px; overflow: hidden;
    position: relative;
}
.sd-visual-frame .sd-gradient {
    position: absolute; inset: 0;
}
.sd-visual-frame .sd-inner {
    position: absolute; inset: 2rem;
    border-radius: 24px;
    border: 1px solid rgba(255,255,255,0.2);
    display: flex; align-items: center; justify-content: center;
}
.sd-visual-frame .sd-icon-text {
    font-family: var(--font-display);
    font-size: clamp(2rem, 4vw, 3.5rem);
    font-weight: 300; font-style: italic;
    color: rgba(255,255,255,0.7);
}

.sd-gradient-1 { background: linear-gradient(160deg, var(--sage-light) 0%, var(--sage) 50%, var(--olive) 100%); }
.sd-gradient-2 { background: linear-gradient(160deg, #e4e8dc 0%, #ced5c2 50%, var(--sage) 100%); }
.sd-gradient-3 { background: linear-gradient(160deg, var(--olive) 0%, var(--forest) 50%, var(--black) 100%); }

.sd-content .section-label { margin-bottom: 0.5rem; }
.sd-content .section-title { margin-bottom: 0.5rem; }
.sd-price {
    font-family: var(--font-display);
    font-size: 1.75rem; font-weight: 400;
    color: var(--black); margin-bottom: 0.25rem;
}
.sd-price span {
    font-family: var(--font-body); font-size: 13px;
    color: var(--text-muted); font-weight: 400;
}
.sd-duration {
    font-size: 12px; color: var(--sage-deep);
    letter-spacing: 0.06em; text-transform: uppercase;
    font-weight: 500; margin-bottom: 1.5rem;
}
.sd-text {
    font-size: 15px; color: var(--text-muted);
    line-height: 1.8; margin-bottom: 2rem;
}
.sd-features { display: grid; gap: 0.75rem; margin-bottom: 2rem; }
.sd-feature {
    display: flex; align-items: center; gap: 0.75rem;
    font-size: 13px; font-weight: 500; color: var(--ink);
}
.sd-feature-dot {
    width: 8px; height: 8px; border-radius: 50%;
    background: var(--sage); flex-shrink: 0;
}

/* Booking info */
.booking-info { padding: var(--section-pad) 0; background: var(--bg-alt); }
.booking-info-grid {
    display: grid; gap: 1.5rem; margin-top: 3rem;
}
@media (min-width: 768px) { .booking-info-grid { grid-template-columns: repeat(3, 1fr); } }

.booking-info-card {
    background: #fff; border-radius: 20px;
    padding: 2rem; text-align: center;
    border: 1px solid var(--border);
}
.booking-info-card .bi-icon {
    font-size: 28px; margin-bottom: 1rem;
    color: var(--sage-deep);
}
.booking-info-card h3 {
    font-family: var(--font-display);
    font-size: 1.3rem; font-weight: 400;
    color: var(--black); margin-bottom: 0.5rem;
}
.booking-info-card p {
    font-size: 14px; color: var(--text-muted); line-height: 1.75;
}

/* CTA */
.services-cta {
    padding: var(--section-pad) 0;
    background: linear-gradient(165deg, var(--forest) 0%, var(--black) 100%);
    text-align: center; position: relative; overflow: hidden;
}
.services-cta::before {
    content: '';
    position: absolute; top: -30%; right: -10%;
    width: 50vw; height: 50vw; max-width: 600px; max-height: 600px;
    border-radius: 50%;
    background: radial-gradient(circle, rgba(157,168,142,0.12) 0%, transparent 70%);
}
.services-cta .container { position: relative; z-index: 2; }
.services-cta .section-label { color: var(--sage); }
.services-cta .section-title { color: #fff; max-width: 500px; margin: 0 auto 1rem; }
.services-cta-text {
    font-size: 15px; color: rgba(255,255,255,0.45);
    max-width: 440px; margin: 0 auto 2.5rem; line-height: 1.75;
}
</style>

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
        <!-- Custom Facial -->
        <div class="service-detail-block">
            <div class="sd-visual reveal">
                <div class="sd-visual-frame">
                    <div class="sd-gradient sd-gradient-1"></div>
                    <div class="sd-inner"><div class="sd-icon-text">&#10047;</div></div>
                </div>
            </div>
            <div class="sd-content reveal">
                <p class="section-label">Facial Treatment</p>
                <h2 class="section-title">Custom Facial</h2>
                <div class="sd-price">$85 <span>/ session</span></div>
                <p class="sd-duration">60 minutes</p>
                <p class="sd-text">A fully customized facial experience designed around your skin's unique needs. Using premium products and expert techniques, we'll cleanse, exfoliate, extract, and nourish your skin to reveal a healthy, radiant glow.</p>
                <div class="sd-features">
                    <div class="sd-feature"><span class="sd-feature-dot"></span> Deep cleansing and gentle exfoliation</div>
                    <div class="sd-feature"><span class="sd-feature-dot"></span> Customized treatment mask</div>
                    <div class="sd-feature"><span class="sd-feature-dot"></span> Facial massage for circulation</div>
                    <div class="sd-feature"><span class="sd-feature-dot"></span> LED light therapy (when applicable)</div>
                    <div class="sd-feature"><span class="sd-feature-dot"></span> Personalized skincare recommendations</div>
                </div>
                <a href="<?php echo esc_url(
                    home_url("/contact"),
                ); ?>" class="btn btn-primary">Book Now</a>
            </div>
        </div>

        <!-- Brow Wax -->
        <div class="service-detail-block">
            <div class="sd-visual reveal">
                <div class="sd-visual-frame">
                    <div class="sd-gradient sd-gradient-2"></div>
                    <div class="sd-inner"><div class="sd-icon-text">&#10043;</div></div>
                </div>
            </div>
            <div class="sd-content reveal">
                <p class="section-label">Waxing</p>
                <h2 class="section-title">Brow Wax &amp; Shape</h2>
                <div class="sd-price">$25 <span>/ session</span></div>
                <p class="sd-duration">15 minutes</p>
                <p class="sd-text">Perfectly shaped brows can transform your entire look. Precision waxing and shaping to frame your face beautifully, with a soothing aftercare balm to calm the skin.</p>
                <div class="sd-features">
                    <div class="sd-feature"><span class="sd-feature-dot"></span> Custom brow mapping for your face shape</div>
                    <div class="sd-feature"><span class="sd-feature-dot"></span> Gentle, low-irritation hard wax</div>
                    <div class="sd-feature"><span class="sd-feature-dot"></span> Precision tweezing for clean finish</div>
                    <div class="sd-feature"><span class="sd-feature-dot"></span> Soothing aftercare balm included</div>
                </div>
                <a href="<?php echo esc_url(
                    home_url("/contact"),
                ); ?>" class="btn btn-primary">Book Now</a>
            </div>
        </div>

        <!-- Brazilian Wax -->
        <div class="service-detail-block">
            <div class="sd-visual reveal">
                <div class="sd-visual-frame">
                    <div class="sd-gradient sd-gradient-3"></div>
                    <div class="sd-inner"><div class="sd-icon-text">&#10023;</div></div>
                </div>
            </div>
            <div class="sd-content reveal">
                <p class="section-label">Waxing</p>
                <h2 class="section-title">Brazilian Wax</h2>
                <div class="sd-price">$65 <span>/ session</span></div>
                <p class="sd-duration">30 minutes</p>
                <p class="sd-text">Smooth, long-lasting results using gentle hard wax. Designed for comfort with minimal irritation. Your comfort is our top priority — we'll make sure you feel completely at ease.</p>
                <div class="sd-features">
                    <div class="sd-feature"><span class="sd-feature-dot"></span> Premium hard wax for sensitive areas</div>
                    <div class="sd-feature"><span class="sd-feature-dot"></span> Comfortable, professional environment</div>
                    <div class="sd-feature"><span class="sd-feature-dot"></span> Pre and post-wax skin care included</div>
                    <div class="sd-feature"><span class="sd-feature-dot"></span> Aftercare instructions provided</div>
                </div>
                <a href="<?php echo esc_url(
                    home_url("/contact"),
                ); ?>" class="btn btn-primary">Book Now</a>
            </div>
        </div>
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
