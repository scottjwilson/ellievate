<?php
/**
 * Template Name: Services Page
 *
 * Services page template for Fieldcraft Digital.
 *
 * @package Fieldcraft
 */

get_header(); ?>

<style>
/* Services Page Styles */
.services-hero {
    position: relative;
    padding: 10rem 0 6rem;
    background: linear-gradient(135deg, var(--color-dark-950) 0%, var(--color-primary-950) 100%);
    color: white;
    overflow: hidden;
}

.services-hero::before {
    content: "";
    position: absolute;
    top: -50%;
    right: -20%;
    width: 80%;
    height: 200%;
    background: radial-gradient(ellipse, rgba(6, 182, 212, 0.15) 0%, transparent 50%);
    pointer-events: none;
}

.services-hero-content {
    position: relative;
    z-index: 1;
    max-width: 700px;
}

.services-hero .text-label {
    color: var(--color-accent-400);
    margin-bottom: var(--space-4);
    display: block;
}

.services-hero h1 {
    font-size: var(--text-hero);
    color: white;
    margin-bottom: var(--space-6);
}

.services-hero-text {
    font-size: var(--text-xl);
    color: var(--color-dark-300);
    line-height: var(--leading-relaxed);
}

/* Services List */
.services-list {
    padding: var(--section-padding) 0;
    background: white;
}

.service-block {
    display: grid;
    gap: var(--space-12);
    padding: var(--space-16) 0;
    border-bottom: 1px solid var(--color-neutral-200);
}

.service-block:first-child {
    padding-top: 0;
}

.service-block:last-child {
    border-bottom: none;
    padding-bottom: 0;
}

@media (min-width: 1024px) {
    .service-block {
        grid-template-columns: 1fr 1fr;
        gap: var(--space-16);
        align-items: center;
    }

    .service-block:nth-child(even) .service-image {
        order: 2;
    }
}

.service-image {
    border-radius: var(--radius-3xl);
    overflow: hidden;
}

.service-image img {
    width: 100%;
    aspect-ratio: 4/3;
    object-fit: cover;
}

.service-content .text-label {
    margin-bottom: var(--space-3);
}

.service-content h2 {
    font-size: var(--text-4xl);
    margin-bottom: var(--space-4);
}

.service-content > p {
    font-size: var(--text-lg);
    color: var(--color-neutral-600);
    line-height: var(--leading-relaxed);
    margin-bottom: var(--space-6);
}

.service-features {
    display: grid;
    gap: var(--space-4);
    margin-bottom: var(--space-6);
}

.service-feature {
    display: flex;
    align-items: flex-start;
    gap: var(--space-3);
}

.service-feature svg {
    flex-shrink: 0;
    color: var(--color-primary-500);
    margin-top: 2px;
}

.service-feature span {
    color: var(--color-neutral-700);
}

/* Process Section */
.process-section-alt {
    padding: var(--section-padding) 0;
    background: var(--color-neutral-50);
}

.process-timeline {
    display: grid;
    gap: var(--space-6);
    margin-top: var(--space-12);
}

@media (min-width: 768px) {
    .process-timeline {
        grid-template-columns: repeat(4, 1fr);
    }
}

.process-item {
    position: relative;
    padding: var(--space-6);
    background: white;
    border-radius: var(--radius-2xl);
    border: 1px solid var(--color-neutral-200);
}

.process-number {
    font-family: var(--font-display);
    font-size: var(--text-5xl);
    font-weight: 800;
    color: var(--color-primary-100);
    line-height: 1;
    margin-bottom: var(--space-4);
}

.process-item h3 {
    font-size: var(--text-lg);
    margin-bottom: var(--space-2);
}

.process-item p {
    font-size: var(--text-sm);
    color: var(--color-neutral-600);
    line-height: var(--leading-relaxed);
}

/* Pricing Preview */
.pricing-preview {
    padding: var(--section-padding) 0;
    background: var(--color-dark-950);
    color: white;
}

.pricing-preview .section-header {
    max-width: none;
}

.pricing-preview .text-display {
    color: white;
}

.pricing-preview .section-header p {
    color: var(--color-dark-300);
}

.pricing-grid {
    display: grid;
    gap: var(--space-6);
    margin-top: var(--space-12);
}

@media (min-width: 768px) {
    .pricing-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

.pricing-card {
    padding: var(--space-8);
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    border-radius: var(--radius-2xl);
    text-align: center;
}

.pricing-card.is-featured {
    background: linear-gradient(135deg, var(--color-primary-600) 0%, var(--color-primary-700) 100%);
    border-color: var(--color-primary-500);
    transform: scale(1.02);
}

.pricing-badge {
    display: inline-block;
    padding: var(--space-1) var(--space-3);
    background: var(--color-accent-400);
    color: var(--color-dark-900);
    font-size: var(--text-xs);
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: var(--tracking-wider);
    border-radius: var(--radius-full);
    margin-bottom: var(--space-4);
}

.pricing-card h3 {
    font-size: var(--text-xl);
    color: white;
    margin-bottom: var(--space-2);
}

.pricing-card .price {
    font-family: var(--font-display);
    font-size: var(--text-4xl);
    font-weight: 700;
    color: white;
    margin-bottom: var(--space-2);
}

.pricing-card .price span {
    font-size: var(--text-base);
    font-weight: 400;
    color: var(--color-dark-400);
}

.pricing-card.is-featured .price span {
    color: rgba(255, 255, 255, 0.7);
}

.pricing-card .description {
    font-size: var(--text-sm);
    color: var(--color-dark-400);
    margin-bottom: var(--space-6);
}

.pricing-card.is-featured .description {
    color: rgba(255, 255, 255, 0.8);
}

.pricing-features {
    text-align: left;
    margin-bottom: var(--space-6);
}

.pricing-feature {
    display: flex;
    align-items: center;
    gap: var(--space-3);
    padding: var(--space-2) 0;
    font-size: var(--text-sm);
    color: var(--color-dark-300);
}

.pricing-card.is-featured .pricing-feature {
    color: rgba(255, 255, 255, 0.9);
}

.pricing-feature svg {
    flex-shrink: 0;
    color: var(--color-accent-400);
}

.pricing-card .btn {
    width: 100%;
}

.pricing-card .btn-outline {
    border-color: rgba(255, 255, 255, 0.2);
    color: white;
}

.pricing-card .btn-outline:hover {
    border-color: white;
    background: white;
    color: var(--color-dark-900);
}

/* CTA Section */
.services-cta {
    padding: var(--section-padding) 0;
    background: white;
}

.services-cta .cta-content {
    max-width: 600px;
    margin: 0 auto;
    text-align: center;
}

.services-cta .text-display {
    margin-bottom: var(--space-4);
}

.services-cta p {
    font-size: var(--text-lg);
    color: var(--color-neutral-600);
    line-height: var(--leading-relaxed);
    margin-bottom: var(--space-8);
}
</style>

<!-- Hero Section -->
<section class="services-hero">
    <div class="container">
        <div class="services-hero-content reveal">
            <span class="text-label">Our Services</span>
            <h1>End-to-end digital solutions</h1>
            <p class="services-hero-text">
                From strategy to execution, we provide comprehensive digital services to help your business thrive online.
            </p>
        </div>
    </div>
</section>

<!-- Services List -->
<section class="services-list">
    <div class="container">
        <!-- Web Design -->
        <div class="service-block">
            <div class="service-image reveal">
                <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?w=700&h=525&fit=crop" alt="Web Design">
            </div>
            <div class="service-content reveal reveal-delay-1">
                <span class="text-label">Web Design</span>
                <h2>Beautiful designs that convert</h2>
                <p>
                    We create stunning, user-centered designs that not only look amazing but also drive real business results. Every pixel is crafted with purpose.
                </p>
                <div class="service-features">
                    <div class="service-feature">
                        <?php echo fieldcraft_icon("check", 18); ?>
                        <span>Custom UI/UX design tailored to your brand</span>
                    </div>
                    <div class="service-feature">
                        <?php echo fieldcraft_icon("check", 18); ?>
                        <span>Mobile-first responsive layouts</span>
                    </div>
                    <div class="service-feature">
                        <?php echo fieldcraft_icon("check", 18); ?>
                        <span>Interactive prototypes and user testing</span>
                    </div>
                    <div class="service-feature">
                        <?php echo fieldcraft_icon("check", 18); ?>
                        <span>Design systems and style guides</span>
                    </div>
                </div>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary">
                    Get Started <?php echo fieldcraft_icon("arrow-right"); ?>
                </a>
            </div>
        </div>

        <!-- Development -->
        <div class="service-block">
            <div class="service-image reveal">
                <img src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=700&h=525&fit=crop" alt="Development">
            </div>
            <div class="service-content reveal reveal-delay-1">
                <span class="text-label">Development</span>
                <h2>Code that performs</h2>
                <p>
                    We build fast, secure, and scalable websites and applications using modern technologies. Clean code that's built to last.
                </p>
                <div class="service-features">
                    <div class="service-feature">
                        <?php echo fieldcraft_icon("check", 18); ?>
                        <span>Custom WordPress & headless CMS development</span>
                    </div>
                    <div class="service-feature">
                        <?php echo fieldcraft_icon("check", 18); ?>
                        <span>React, Next.js & modern JavaScript frameworks</span>
                    </div>
                    <div class="service-feature">
                        <?php echo fieldcraft_icon("check", 18); ?>
                        <span>E-commerce solutions (WooCommerce, Shopify)</span>
                    </div>
                    <div class="service-feature">
                        <?php echo fieldcraft_icon("check", 18); ?>
                        <span>API integrations and custom functionality</span>
                    </div>
                </div>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary">
                    Get Started <?php echo fieldcraft_icon("arrow-right"); ?>
                </a>
            </div>
        </div>

        <!-- SEO Strategy -->
        <div class="service-block">
            <div class="service-image reveal">
                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=700&h=525&fit=crop" alt="SEO Strategy">
            </div>
            <div class="service-content reveal reveal-delay-1">
                <span class="text-label">SEO Strategy</span>
                <h2>Get found online</h2>
                <p>
                    Data-driven SEO strategies that improve your visibility and drive organic traffic. We help you rank for the terms that matter most.
                </p>
                <div class="service-features">
                    <div class="service-feature">
                        <?php echo fieldcraft_icon("check", 18); ?>
                        <span>Comprehensive site audits and technical SEO</span>
                    </div>
                    <div class="service-feature">
                        <?php echo fieldcraft_icon("check", 18); ?>
                        <span>Keyword research and content strategy</span>
                    </div>
                    <div class="service-feature">
                        <?php echo fieldcraft_icon("check", 18); ?>
                        <span>On-page and off-page optimization</span>
                    </div>
                    <div class="service-feature">
                        <?php echo fieldcraft_icon("check", 18); ?>
                        <span>Monthly reporting and analytics</span>
                    </div>
                </div>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary">
                    Get Started <?php echo fieldcraft_icon("arrow-right"); ?>
                </a>
            </div>
        </div>

        <!-- Digital Marketing -->
        <div class="service-block">
            <div class="service-image reveal">
                <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=700&h=525&fit=crop" alt="Digital Marketing">
            </div>
            <div class="service-content reveal reveal-delay-1">
                <span class="text-label">Digital Marketing</span>
                <h2>Reach your audience</h2>
                <p>
                    Comprehensive marketing campaigns that connect with your target audience across all digital channels and drive meaningful engagement.
                </p>
                <div class="service-features">
                    <div class="service-feature">
                        <?php echo fieldcraft_icon("check", 18); ?>
                        <span>Paid advertising (Google, Meta, LinkedIn)</span>
                    </div>
                    <div class="service-feature">
                        <?php echo fieldcraft_icon("check", 18); ?>
                        <span>Social media strategy and management</span>
                    </div>
                    <div class="service-feature">
                        <?php echo fieldcraft_icon("check", 18); ?>
                        <span>Email marketing and automation</span>
                    </div>
                    <div class="service-feature">
                        <?php echo fieldcraft_icon("check", 18); ?>
                        <span>Content marketing and copywriting</span>
                    </div>
                </div>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary">
                    Get Started <?php echo fieldcraft_icon("arrow-right"); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Process Section -->
<section class="process-section-alt">
    <div class="container">
        <div class="section-header center reveal">
            <span class="text-label">Our Process</span>
            <h2 class="text-display">How we work</h2>
        </div>

        <div class="process-timeline">
            <div class="process-item reveal">
                <div class="process-number">01</div>
                <h3>Discovery</h3>
                <p>We learn about your business, goals, and audience to understand what success looks like.</p>
            </div>

            <div class="process-item reveal reveal-delay-1">
                <div class="process-number">02</div>
                <h3>Strategy</h3>
                <p>We develop a comprehensive plan that aligns creative solutions with your objectives.</p>
            </div>

            <div class="process-item reveal reveal-delay-2">
                <div class="process-number">03</div>
                <h3>Execute</h3>
                <p>Our team brings the strategy to life with expert design and development.</p>
            </div>

            <div class="process-item reveal reveal-delay-3">
                <div class="process-number">04</div>
                <h3>Optimize</h3>
                <p>We continuously measure, learn, and improve to maximize results over time.</p>
            </div>
        </div>
    </div>
</section>

<!-- Pricing Preview -->
<section class="pricing-preview">
    <div class="container">
        <div class="section-header center reveal">
            <span class="text-label">Pricing</span>
            <h2 class="text-display">Transparent pricing for every need</h2>
            <p>Choose a package that fits your project scope and budget.</p>
        </div>

        <div class="pricing-grid">
            <div class="pricing-card reveal">
                <h3>Starter</h3>
                <div class="price">$5,000 <span>starting</span></div>
                <p class="description">Perfect for small businesses and startups</p>
                <div class="pricing-features">
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon("check", 16); ?>
                        <span>5-page responsive website</span>
                    </div>
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon("check", 16); ?>
                        <span>Basic SEO setup</span>
                    </div>
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon("check", 16); ?>
                        <span>Contact form integration</span>
                    </div>
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon("check", 16); ?>
                        <span>2 rounds of revisions</span>
                    </div>
                </div>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-outline">Get Quote</a>
            </div>

            <div class="pricing-card is-featured reveal reveal-delay-1">
                <span class="pricing-badge">Most Popular</span>
                <h3>Professional</h3>
                <div class="price">$15,000 <span>starting</span></div>
                <p class="description">For growing businesses with bigger goals</p>
                <div class="pricing-features">
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon("check", 16); ?>
                        <span>Custom design with 10+ pages</span>
                    </div>
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon("check", 16); ?>
                        <span>Advanced SEO optimization</span>
                    </div>
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon("check", 16); ?>
                        <span>CMS integration (WordPress)</span>
                    </div>
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon("check", 16); ?>
                        <span>Analytics & tracking setup</span>
                    </div>
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon("check", 16); ?>
                        <span>3 months post-launch support</span>
                    </div>
                </div>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-accent">Get Quote</a>
            </div>

            <div class="pricing-card reveal reveal-delay-2">
                <h3>Enterprise</h3>
                <div class="price">Custom</div>
                <p class="description">For large-scale projects and ongoing partnerships</p>
                <div class="pricing-features">
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon("check", 16); ?>
                        <span>Fully custom solution</span>
                    </div>
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon("check", 16); ?>
                        <span>Dedicated project team</span>
                    </div>
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon("check", 16); ?>
                        <span>Priority support & SLA</span>
                    </div>
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon("check", 16); ?>
                        <span>Ongoing maintenance retainer</span>
                    </div>
                </div>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-outline">Contact Us</a>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="services-cta">
    <div class="container">
        <div class="cta-content reveal">
            <h2 class="text-display">Ready to get started?</h2>
            <p>Tell us about your project and we'll get back to you within 24 hours with a custom proposal.</p>
            <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-accent btn-lg">
                Start Your Project <?php echo fieldcraft_icon("arrow-right"); ?>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
