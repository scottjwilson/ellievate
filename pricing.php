<?php
/**
 * Template Name: Pricing Page
 *
 * Pricing page template for Fieldcraft Digital.
 *
 * @package Fieldcraft
 */

get_header();
?>

<style>
/* Pricing Page Styles */
.pricing-hero {
    padding: 10rem 0 5rem;
    background: linear-gradient(135deg, var(--color-dark-950) 0%, var(--color-primary-950) 100%);
    text-align: center;
    position: relative;
    overflow: hidden;
}

.pricing-hero::before {
    content: "";
    position: absolute;
    top: 0;
    left: 50%;
    transform: translateX(-50%);
    width: 150%;
    height: 100%;
    background: radial-gradient(ellipse at center top, rgba(139, 92, 246, 0.2) 0%, transparent 60%);
    pointer-events: none;
}

.pricing-hero h1 {
    font-size: var(--text-hero);
    color: white;
    margin-bottom: var(--space-4);
    position: relative;
}

.pricing-hero-text {
    font-size: var(--text-xl);
    color: var(--color-dark-300);
    max-width: 600px;
    margin: 0 auto;
    position: relative;
    line-height: var(--leading-relaxed);
}

/* Pricing Cards */
.pricing-cards-section {
    padding: var(--section-padding) 0;
    background: var(--color-neutral-50);
    margin-top: -3rem;
    position: relative;
    z-index: 1;
}

.pricing-cards-grid {
    display: grid;
    gap: var(--space-6);
    max-width: 1100px;
    margin: 0 auto;
}

@media (min-width: 768px) {
    .pricing-cards-grid {
        grid-template-columns: repeat(3, 1fr);
        align-items: start;
    }
}

.pricing-card-wrapper {
    position: relative;
}

.pricing-card-popular {
    position: absolute;
    top: -0.75rem;
    left: 50%;
    transform: translateX(-50%);
    background: var(--color-accent-400);
    color: var(--color-dark-900);
    font-size: var(--text-xs);
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: var(--tracking-wider);
    padding: var(--space-1) var(--space-4);
    border-radius: var(--radius-full);
    white-space: nowrap;
}

.pricing-card {
    background: white;
    border-radius: var(--radius-3xl);
    padding: var(--space-10) var(--space-8);
    border: 1px solid var(--color-neutral-200);
    text-align: center;
    transition: all var(--transition-base);
}

.pricing-card:hover {
    box-shadow: var(--shadow-xl);
}

.pricing-card.is-featured {
    background: var(--color-primary-600);
    border-color: var(--color-primary-500);
    transform: scale(1.02);
    box-shadow: var(--shadow-2xl);
}

@media (max-width: 767px) {
    .pricing-card.is-featured {
        transform: none;
    }
}

.pricing-card.is-featured * {
    color: white;
}

.pricing-card.is-featured .pricing-card-price span {
    color: rgba(255, 255, 255, 0.6);
}

.pricing-card.is-featured .pricing-feature svg {
    color: var(--color-accent-400);
}

.pricing-card.is-featured .btn-outline {
    border-color: white;
    color: white;
}

.pricing-card.is-featured .btn-outline:hover {
    background: white;
    color: var(--color-primary-600);
}

.pricing-card-icon {
    width: 3.5rem;
    height: 3.5rem;
    margin: 0 auto var(--space-6);
    background: var(--color-primary-100);
    border-radius: var(--radius-xl);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-primary-600);
}

.pricing-card.is-featured .pricing-card-icon {
    background: rgba(255, 255, 255, 0.15);
    color: white;
}

.pricing-card-name {
    font-size: var(--text-xl);
    font-weight: 700;
    margin-bottom: var(--space-2);
}

.pricing-card-desc {
    font-size: var(--text-sm);
    color: var(--color-neutral-500);
    margin-bottom: var(--space-6);
}

.pricing-card.is-featured .pricing-card-desc {
    color: rgba(255, 255, 255, 0.7);
}

.pricing-card-price {
    font-family: var(--font-display);
    font-size: var(--text-5xl);
    font-weight: 700;
    color: var(--color-dark-900);
    line-height: 1;
    margin-bottom: var(--space-2);
}

.pricing-card-price span {
    font-size: var(--text-base);
    font-weight: 400;
    color: var(--color-neutral-500);
}

.pricing-card-billing {
    font-size: var(--text-sm);
    color: var(--color-neutral-400);
    margin-bottom: var(--space-8);
}

.pricing-features {
    text-align: left;
    margin-bottom: var(--space-8);
}

.pricing-feature {
    display: flex;
    align-items: flex-start;
    gap: var(--space-3);
    padding: var(--space-2) 0;
    font-size: var(--text-sm);
    color: var(--color-neutral-700);
}

.pricing-card.is-featured .pricing-feature {
    color: rgba(255, 255, 255, 0.9);
}

.pricing-feature svg {
    width: 1.25rem;
    height: 1.25rem;
    color: var(--color-primary-500);
    flex-shrink: 0;
    margin-top: 1px;
}

.pricing-card .btn {
    width: 100%;
}

/* Enterprise Section */
.enterprise-section {
    padding: var(--section-padding) 0;
    background: white;
}

.enterprise-card {
    background: linear-gradient(135deg, var(--color-dark-900) 0%, var(--color-dark-800) 100%);
    border-radius: var(--radius-3xl);
    padding: var(--space-12);
    display: grid;
    gap: var(--space-8);
    align-items: center;
    color: white;
}

@media (min-width: 768px) {
    .enterprise-card {
        grid-template-columns: 1fr auto;
        padding: var(--space-16);
    }
}

.enterprise-content h2 {
    font-size: var(--text-4xl);
    color: white;
    margin-bottom: var(--space-4);
}

.enterprise-content p {
    font-size: var(--text-lg);
    color: var(--color-dark-300);
    line-height: var(--leading-relaxed);
    max-width: 500px;
}

.enterprise-features {
    display: flex;
    flex-wrap: wrap;
    gap: var(--space-4);
    margin-top: var(--space-6);
}

.enterprise-feature {
    display: flex;
    align-items: center;
    gap: var(--space-2);
    font-size: var(--text-sm);
    color: var(--color-dark-200);
}

.enterprise-feature svg {
    width: 1rem;
    height: 1rem;
    color: var(--color-accent-400);
}

/* What's Included */
.included-section {
    padding: var(--section-padding) 0;
    background: var(--color-neutral-50);
}

.included-grid {
    display: grid;
    gap: var(--space-6);
    margin-top: var(--space-12);
}

@media (min-width: 768px) {
    .included-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 1024px) {
    .included-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

.included-item {
    text-align: center;
    padding: var(--space-6);
}

.included-icon {
    width: 3.5rem;
    height: 3.5rem;
    margin: 0 auto var(--space-4);
    background: var(--color-primary-100);
    border-radius: var(--radius-xl);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-primary-600);
}

.included-item h3 {
    font-size: var(--text-base);
    margin-bottom: var(--space-2);
}

.included-item p {
    font-size: var(--text-sm);
    color: var(--color-neutral-500);
    line-height: var(--leading-relaxed);
}

/* FAQ Section */
.pricing-faq {
    padding: var(--section-padding) 0;
    background: white;
}

.faq-grid {
    display: grid;
    gap: var(--space-6);
    margin-top: var(--space-12);
}

@media (min-width: 768px) {
    .faq-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

.faq-card {
    background: var(--color-neutral-50);
    border-radius: var(--radius-2xl);
    padding: var(--space-6);
}

.faq-card h3 {
    font-size: var(--text-base);
    margin-bottom: var(--space-3);
}

.faq-card p {
    font-size: var(--text-sm);
    color: var(--color-neutral-600);
    line-height: var(--leading-relaxed);
}

/* Guarantee Section */
.guarantee-section {
    padding: var(--section-padding) 0;
    background: var(--color-neutral-50);
}

.guarantee-card {
    background: white;
    border: 2px solid var(--color-primary-200);
    border-radius: var(--radius-3xl);
    padding: var(--space-12);
    text-align: center;
    max-width: 700px;
    margin: 0 auto;
}

.guarantee-icon {
    width: 4rem;
    height: 4rem;
    margin: 0 auto var(--space-6);
    background: var(--color-primary-100);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-primary-600);
}

.guarantee-card h2 {
    font-size: var(--text-3xl);
    margin-bottom: var(--space-4);
}

.guarantee-card p {
    font-size: var(--text-lg);
    color: var(--color-neutral-600);
    line-height: var(--leading-relaxed);
    max-width: 500px;
    margin: 0 auto;
}
</style>

<!-- Hero Section -->
<section class="pricing-hero">
    <div class="container">
        <div class="reveal">
            <h1>Transparent pricing</h1>
            <p class="pricing-hero-text">
                Straightforward pricing for projects of any size. No hidden fees, no surprises—just great work at fair prices.
            </p>
        </div>
    </div>
</section>

<!-- Pricing Cards -->
<section class="pricing-cards-section">
    <div class="container">
        <div class="pricing-cards-grid">
            <!-- Starter Plan -->
            <div class="pricing-card-wrapper reveal">
                <div class="pricing-card">
                    <div class="pricing-card-icon">
                        <?php echo fieldcraft_icon("star", 24); ?>
                    </div>
                    <h3 class="pricing-card-name">Starter</h3>
                    <p class="pricing-card-desc">Perfect for small businesses and startups</p>
                    <div class="pricing-card-price">$5,000 <span>starting</span></div>
                    <p class="pricing-card-billing">One-time project fee</p>
                    <div class="pricing-features">
                        <div class="pricing-feature">
                            <?php echo fieldcraft_icon("check"); ?>
                            <span>5-page responsive website</span>
                        </div>
                        <div class="pricing-feature">
                            <?php echo fieldcraft_icon("check"); ?>
                            <span>Custom design (2 concepts)</span>
                        </div>
                        <div class="pricing-feature">
                            <?php echo fieldcraft_icon("check"); ?>
                            <span>Mobile-optimized</span>
                        </div>
                        <div class="pricing-feature">
                            <?php echo fieldcraft_icon("check"); ?>
                            <span>Basic SEO setup</span>
                        </div>
                        <div class="pricing-feature">
                            <?php echo fieldcraft_icon("check"); ?>
                            <span>Contact form integration</span>
                        </div>
                        <div class="pricing-feature">
                            <?php echo fieldcraft_icon("check"); ?>
                            <span>2 rounds of revisions</span>
                        </div>
                    </div>
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-outline">Get Started</a>
                </div>
            </div>

            <!-- Professional Plan -->
            <div class="pricing-card-wrapper reveal reveal-delay-1">
                <span class="pricing-card-popular">Most Popular</span>
                <div class="pricing-card is-featured">
                    <div class="pricing-card-icon">
                        <?php echo fieldcraft_icon("lightning", 24); ?>
                    </div>
                    <h3 class="pricing-card-name">Professional</h3>
                    <p class="pricing-card-desc">For growing businesses with bigger goals</p>
                    <div class="pricing-card-price">$15,000 <span>starting</span></div>
                    <p class="pricing-card-billing">One-time project fee</p>
                    <div class="pricing-features">
                        <div class="pricing-feature">
                            <?php echo fieldcraft_icon("check"); ?>
                            <span>Up to 15 custom pages</span>
                        </div>
                        <div class="pricing-feature">
                            <?php echo fieldcraft_icon("check"); ?>
                            <span>Custom UI/UX design</span>
                        </div>
                        <div class="pricing-feature">
                            <?php echo fieldcraft_icon("check"); ?>
                            <span>CMS integration (WordPress)</span>
                        </div>
                        <div class="pricing-feature">
                            <?php echo fieldcraft_icon("check"); ?>
                            <span>Advanced SEO optimization</span>
                        </div>
                        <div class="pricing-feature">
                            <?php echo fieldcraft_icon("check"); ?>
                            <span>Analytics & tracking setup</span>
                        </div>
                        <div class="pricing-feature">
                            <?php echo fieldcraft_icon("check"); ?>
                            <span>3 months post-launch support</span>
                        </div>
                        <div class="pricing-feature">
                            <?php echo fieldcraft_icon("check"); ?>
                            <span>Unlimited revisions</span>
                        </div>
                    </div>
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-accent">Get Started</a>
                </div>
            </div>

            <!-- Business Plan -->
            <div class="pricing-card-wrapper reveal reveal-delay-2">
                <div class="pricing-card">
                    <div class="pricing-card-icon">
                        <?php echo fieldcraft_icon("chart", 24); ?>
                    </div>
                    <h3 class="pricing-card-name">Business</h3>
                    <p class="pricing-card-desc">For established brands with complex needs</p>
                    <div class="pricing-card-price">$30,000 <span>starting</span></div>
                    <p class="pricing-card-billing">One-time project fee</p>
                    <div class="pricing-features">
                        <div class="pricing-feature">
                            <?php echo fieldcraft_icon("check"); ?>
                            <span>Unlimited pages</span>
                        </div>
                        <div class="pricing-feature">
                            <?php echo fieldcraft_icon("check"); ?>
                            <span>Custom web application</span>
                        </div>
                        <div class="pricing-feature">
                            <?php echo fieldcraft_icon("check"); ?>
                            <span>E-commerce integration</span>
                        </div>
                        <div class="pricing-feature">
                            <?php echo fieldcraft_icon("check"); ?>
                            <span>Custom API development</span>
                        </div>
                        <div class="pricing-feature">
                            <?php echo fieldcraft_icon("check"); ?>
                            <span>Brand strategy included</span>
                        </div>
                        <div class="pricing-feature">
                            <?php echo fieldcraft_icon("check"); ?>
                            <span>6 months priority support</span>
                        </div>
                        <div class="pricing-feature">
                            <?php echo fieldcraft_icon("check"); ?>
                            <span>Dedicated project manager</span>
                        </div>
                    </div>
                    <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-outline">Get Started</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Enterprise Section -->
<section class="enterprise-section">
    <div class="container">
        <div class="enterprise-card reveal">
            <div class="enterprise-content">
                <h2>Enterprise & Retainer</h2>
                <p>
                    For large organizations or ongoing partnerships, we offer custom enterprise solutions and monthly retainer packages tailored to your specific needs.
                </p>
                <div class="enterprise-features">
                    <span class="enterprise-feature">
                        <?php echo fieldcraft_icon("check"); ?>
                        Dedicated team
                    </span>
                    <span class="enterprise-feature">
                        <?php echo fieldcraft_icon("check"); ?>
                        Custom SLA
                    </span>
                    <span class="enterprise-feature">
                        <?php echo fieldcraft_icon("check"); ?>
                        Priority support
                    </span>
                    <span class="enterprise-feature">
                        <?php echo fieldcraft_icon("check"); ?>
                        Monthly strategy calls
                    </span>
                </div>
            </div>
            <div class="enterprise-cta">
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-accent btn-lg">
                    Contact Us <?php echo fieldcraft_icon("arrow-right"); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- What's Included -->
<section class="included-section">
    <div class="container">
        <div class="section-header center reveal">
            <span class="text-label">What's Included</span>
            <h2 class="text-display">Every project includes</h2>
        </div>

        <div class="included-grid">
            <div class="included-item reveal">
                <div class="included-icon">
                    <?php echo fieldcraft_icon("users", 24); ?>
                </div>
                <h3>Discovery Session</h3>
                <p>Deep dive into your business, goals, and target audience.</p>
            </div>

            <div class="included-item reveal reveal-delay-1">
                <div class="included-icon">
                    <?php echo fieldcraft_icon("palette", 24); ?>
                </div>
                <h3>Custom Design</h3>
                <p>Unique designs tailored to your brand—no templates.</p>
            </div>

            <div class="included-item reveal reveal-delay-2">
                <div class="included-icon">
                    <?php echo fieldcraft_icon("globe", 24); ?>
                </div>
                <h3>Responsive Build</h3>
                <p>Pixel-perfect on all devices and screen sizes.</p>
            </div>

            <div class="included-item reveal reveal-delay-3">
                <div class="included-icon">
                    <?php echo fieldcraft_icon("lightning", 24); ?>
                </div>
                <h3>Performance</h3>
                <p>Optimized for speed and Core Web Vitals.</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="pricing-faq">
    <div class="container">
        <div class="section-header center reveal">
            <span class="text-label">FAQ</span>
            <h2 class="text-display">Common questions</h2>
        </div>

        <div class="faq-grid">
            <div class="faq-card reveal">
                <h3>How long does a typical project take?</h3>
                <p>Timeline varies by project scope. Starter projects typically take 4-6 weeks, Professional projects 8-12 weeks, and Business projects 12-16+ weeks.</p>
            </div>

            <div class="faq-card reveal reveal-delay-1">
                <h3>What's your payment structure?</h3>
                <p>We typically require 50% upfront to begin work, with the remaining 50% due upon project completion. Enterprise clients may have custom terms.</p>
            </div>

            <div class="faq-card reveal">
                <h3>Do you offer ongoing maintenance?</h3>
                <p>Yes! We offer monthly maintenance and support packages starting at $500/month for updates, security, backups, and priority support.</p>
            </div>

            <div class="faq-card reveal reveal-delay-1">
                <h3>What if I need changes after launch?</h3>
                <p>Post-launch changes are covered during your support period. After that, we offer hourly rates or can discuss a retainer arrangement.</p>
            </div>

            <div class="faq-card reveal">
                <h3>Do you work with clients remotely?</h3>
                <p>Absolutely! We work with clients worldwide using Slack, Zoom, and modern collaboration tools. Location is never a barrier.</p>
            </div>

            <div class="faq-card reveal reveal-delay-1">
                <h3>What technologies do you use?</h3>
                <p>We specialize in WordPress, React, Next.js, and Shopify. We'll recommend the best tech stack based on your specific needs and goals.</p>
            </div>
        </div>
    </div>
</section>

<!-- Guarantee Section -->
<section class="guarantee-section">
    <div class="container">
        <div class="guarantee-card reveal">
            <div class="guarantee-icon">
                <?php echo fieldcraft_icon("star", 32); ?>
            </div>
            <h2>Satisfaction guaranteed</h2>
            <p>
                We stand behind our work. If you're not happy with the initial design concepts, we'll refund your deposit in full—no questions asked.
            </p>
        </div>
    </div>
</section>

<?php get_footer(); ?>
