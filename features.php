<?php
/**
 * Template Name: Features Page
 *
 * Features page template showcasing agency capabilities.
 *
 * @package Fieldcraft
 */

get_header();
?>

<style>
/* Features Page Styles */
.features-hero {
    padding: 10rem 0 5rem;
    background: linear-gradient(180deg, var(--color-neutral-50) 0%, white 100%);
    text-align: center;
}

.features-hero-label {
    display: inline-block;
    font-size: var(--text-xs);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: var(--tracking-widest);
    color: var(--color-primary-600);
    background: var(--color-primary-100);
    padding: var(--space-2) var(--space-4);
    border-radius: var(--radius-full);
    margin-bottom: var(--space-6);
}

.features-hero h1 {
    font-size: var(--text-hero);
    color: var(--color-dark-900);
    margin-bottom: var(--space-6);
    max-width: 800px;
    margin-inline: auto;
}

.features-hero-text {
    font-size: var(--text-xl);
    color: var(--color-neutral-600);
    max-width: 600px;
    margin: 0 auto;
    line-height: var(--leading-relaxed);
}

/* Feature Showcase */
.feature-showcase {
    padding: var(--space-20) 0;
    border-bottom: 1px solid var(--color-neutral-100);
}

.feature-showcase:last-of-type {
    border-bottom: none;
}

.feature-showcase-inner {
    display: grid;
    gap: var(--space-12);
    align-items: center;
}

@media (min-width: 1024px) {
    .feature-showcase-inner {
        grid-template-columns: 1fr 1fr;
        gap: var(--space-16);
    }

    .feature-showcase.reverse .feature-showcase-inner {
        direction: rtl;
    }

    .feature-showcase.reverse .feature-showcase-inner > * {
        direction: ltr;
    }
}

.feature-showcase-content {
    max-width: 500px;
}

.feature-showcase-label {
    display: inline-flex;
    align-items: center;
    gap: var(--space-2);
    font-size: var(--text-xs);
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: var(--tracking-wider);
    color: var(--color-primary-600);
    margin-bottom: var(--space-4);
}

.feature-showcase-label svg {
    width: 1rem;
    height: 1rem;
}

.feature-showcase h2 {
    font-size: var(--text-4xl);
    color: var(--color-dark-900);
    margin-bottom: var(--space-4);
}

.feature-showcase p {
    font-size: var(--text-lg);
    color: var(--color-neutral-600);
    line-height: var(--leading-relaxed);
    margin-bottom: var(--space-6);
}

.feature-showcase-list {
    display: flex;
    flex-direction: column;
    gap: var(--space-3);
    margin-bottom: var(--space-6);
}

.feature-showcase-list li {
    display: flex;
    align-items: flex-start;
    gap: var(--space-3);
    font-size: var(--text-base);
    color: var(--color-neutral-700);
}

.feature-showcase-list li svg {
    width: 1.25rem;
    height: 1.25rem;
    color: var(--color-primary-500);
    flex-shrink: 0;
    margin-top: 2px;
}

.feature-showcase-visual {
    position: relative;
}

.feature-showcase-image {
    border-radius: var(--radius-3xl);
    overflow: hidden;
    box-shadow: var(--shadow-2xl);
}

.feature-showcase-image img {
    width: 100%;
    display: block;
}

.feature-badge {
    position: absolute;
    background: white;
    border-radius: var(--radius-xl);
    padding: var(--space-4) var(--space-5);
    box-shadow: var(--shadow-xl);
    display: flex;
    align-items: center;
    gap: var(--space-3);
}

.feature-badge-icon {
    width: 2.5rem;
    height: 2.5rem;
    background: var(--color-primary-100);
    border-radius: var(--radius-lg);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-primary-600);
}

.feature-badge-text {
    font-size: var(--text-sm);
    font-weight: 600;
    color: var(--color-dark-900);
}

.feature-badge-1 {
    bottom: -1rem;
    left: -1rem;
}

.feature-badge-2 {
    top: -1rem;
    right: -1rem;
}

@media (max-width: 1023px) {
    .feature-badge {
        display: none;
    }
}

/* Capabilities Section */
.capabilities-section {
    padding: var(--section-padding) 0;
    background: var(--color-neutral-50);
}

.capabilities-grid {
    display: grid;
    gap: var(--space-6);
    margin-top: var(--space-12);
}

@media (min-width: 768px) {
    .capabilities-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 1024px) {
    .capabilities-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

.capability-card {
    background: white;
    border-radius: var(--radius-2xl);
    padding: var(--space-8);
    border: 1px solid var(--color-neutral-200);
    transition: all var(--transition-base);
}

.capability-card:hover {
    border-color: var(--color-primary-200);
    box-shadow: var(--shadow-card-hover);
    transform: translateY(-4px);
}

.capability-icon {
    width: 3rem;
    height: 3rem;
    background: var(--color-primary-100);
    border-radius: var(--radius-xl);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-primary-600);
    margin-bottom: var(--space-5);
}

.capability-card h3 {
    font-size: var(--text-lg);
    margin-bottom: var(--space-3);
}

.capability-card p {
    font-size: var(--text-sm);
    color: var(--color-neutral-600);
    line-height: var(--leading-relaxed);
}

/* Tech Stack Section */
.tech-section {
    padding: var(--section-padding) 0;
    background: white;
}

.tech-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: var(--space-4);
    margin-top: var(--space-12);
}

@media (min-width: 768px) {
    .tech-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

@media (min-width: 1024px) {
    .tech-grid {
        grid-template-columns: repeat(6, 1fr);
    }
}

.tech-item {
    aspect-ratio: 1;
    background: var(--color-neutral-50);
    border: 1px solid var(--color-neutral-200);
    border-radius: var(--radius-xl);
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: var(--space-2);
    padding: var(--space-4);
    font-size: var(--text-xs);
    font-weight: 600;
    color: var(--color-neutral-600);
    transition: all var(--transition-base);
}

.tech-item:hover {
    border-color: var(--color-primary-300);
    background: white;
    box-shadow: var(--shadow-md);
}

.tech-item svg {
    width: 2rem;
    height: 2rem;
    color: var(--color-neutral-400);
}

/* Comparison Section */
.comparison-section {
    padding: var(--section-padding) 0;
    background: var(--color-neutral-50);
}

.comparison-table-wrapper {
    margin-top: var(--space-12);
    overflow-x: auto;
}

.comparison-table {
    width: 100%;
    min-width: 600px;
    border-collapse: collapse;
    background: white;
    border-radius: var(--radius-2xl);
    overflow: hidden;
    box-shadow: var(--shadow-card);
}

.comparison-table th,
.comparison-table td {
    padding: var(--space-5) var(--space-6);
    text-align: left;
    border-bottom: 1px solid var(--color-neutral-100);
}

.comparison-table th {
    font-size: var(--text-sm);
    font-weight: 700;
    color: var(--color-dark-900);
    background: var(--color-neutral-50);
}

.comparison-table th.highlight-col {
    background: var(--color-primary-600);
    color: white;
}

.comparison-table td {
    font-size: var(--text-sm);
    color: var(--color-neutral-700);
}

.comparison-table td:first-child {
    font-weight: 500;
    color: var(--color-dark-900);
}

.comparison-table td.highlight-col {
    background: var(--color-primary-50);
}

.comparison-table tbody tr:last-child td {
    border-bottom: none;
}

.check-icon {
    color: var(--color-primary-500);
}

.cross-icon {
    color: var(--color-neutral-300);
}

/* CTA Section */
.features-cta {
    padding: var(--section-padding) 0;
    background: var(--color-dark-950);
    text-align: center;
    position: relative;
    overflow: hidden;
}

.features-cta::before {
    content: "";
    position: absolute;
    inset: 0;
    background-image: radial-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px);
    background-size: 24px 24px;
    pointer-events: none;
}

.features-cta::after {
    content: "";
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(139, 92, 246, 0.2) 0%, transparent 60%);
    pointer-events: none;
}

.features-cta h2 {
    font-size: var(--text-5xl);
    color: white;
    margin-bottom: var(--space-4);
    position: relative;
}

.features-cta p {
    color: var(--color-dark-300);
    font-size: var(--text-lg);
    max-width: 500px;
    margin: 0 auto var(--space-8);
    position: relative;
}

.features-cta-buttons {
    display: flex;
    gap: var(--space-4);
    justify-content: center;
    flex-wrap: wrap;
    position: relative;
}

.features-cta .btn-outline {
    border-color: rgba(255, 255, 255, 0.2);
    color: white;
}

.features-cta .btn-outline:hover {
    border-color: white;
    background: white;
    color: var(--color-dark-900);
}
</style>

<!-- Hero Section -->
<section class="features-hero">
    <div class="container">
        <div class="reveal">
            <span class="features-hero-label">Why Choose Us</span>
            <h1>Everything you need to succeed online</h1>
            <p class="features-hero-text">
                We combine strategy, design, and technology to create digital experiences that drive real business results.
            </p>
        </div>
    </div>
</section>

<!-- Feature Showcase 1: Strategy -->
<section class="feature-showcase">
    <div class="container">
        <div class="feature-showcase-inner">
            <div class="feature-showcase-content reveal">
                <span class="feature-showcase-label">
                    <?php echo fieldcraft_icon("target"); ?>
                    Strategic Approach
                </span>
                <h2>Data-driven strategy that delivers</h2>
                <p>
                    We don't just build websites—we craft digital strategies aligned with your business goals. Every decision is backed by research and designed to maximize ROI.
                </p>
                <ul class="feature-showcase-list">
                    <li>
                        <?php echo fieldcraft_icon("check"); ?>
                        <span>Comprehensive market & competitor analysis</span>
                    </li>
                    <li>
                        <?php echo fieldcraft_icon("check"); ?>
                        <span>User research and persona development</span>
                    </li>
                    <li>
                        <?php echo fieldcraft_icon("check"); ?>
                        <span>KPI definition and success metrics</span>
                    </li>
                </ul>
                <a href="<?php echo esc_url(home_url('/services')); ?>" class="btn btn-primary">
                    Our Services <?php echo fieldcraft_icon("arrow-right"); ?>
                </a>
            </div>
            <div class="feature-showcase-visual reveal reveal-delay-1">
                <div class="feature-showcase-image">
                    <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=600&h=400&fit=crop" alt="Strategy planning">
                </div>
                <div class="feature-badge feature-badge-1">
                    <div class="feature-badge-icon">
                        <?php echo fieldcraft_icon("chart"); ?>
                    </div>
                    <span class="feature-badge-text">340% Avg ROI</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Feature Showcase 2: Design -->
<section class="feature-showcase reverse">
    <div class="container">
        <div class="feature-showcase-inner">
            <div class="feature-showcase-content reveal">
                <span class="feature-showcase-label">
                    <?php echo fieldcraft_icon("palette"); ?>
                    Award-Winning Design
                </span>
                <h2>Beautiful designs that convert</h2>
                <p>
                    Our design team creates stunning, user-centered experiences that not only look amazing but drive meaningful engagement and conversions.
                </p>
                <ul class="feature-showcase-list">
                    <li>
                        <?php echo fieldcraft_icon("check"); ?>
                        <span>Custom UI/UX tailored to your brand</span>
                    </li>
                    <li>
                        <?php echo fieldcraft_icon("check"); ?>
                        <span>Mobile-first responsive design</span>
                    </li>
                    <li>
                        <?php echo fieldcraft_icon("check"); ?>
                        <span>Interactive prototypes & user testing</span>
                    </li>
                </ul>
                <a href="<?php echo esc_url(home_url('/work')); ?>" class="btn btn-primary">
                    View Our Work <?php echo fieldcraft_icon("arrow-right"); ?>
                </a>
            </div>
            <div class="feature-showcase-visual reveal reveal-delay-1">
                <div class="feature-showcase-image">
                    <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?w=600&h=400&fit=crop" alt="Design process">
                </div>
                <div class="feature-badge feature-badge-2">
                    <div class="feature-badge-icon">
                        <?php echo fieldcraft_icon("star"); ?>
                    </div>
                    <span class="feature-badge-text">15 Awards Won</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Feature Showcase 3: Development -->
<section class="feature-showcase">
    <div class="container">
        <div class="feature-showcase-inner">
            <div class="feature-showcase-content reveal">
                <span class="feature-showcase-label">
                    <?php echo fieldcraft_icon("code"); ?>
                    Modern Development
                </span>
                <h2>Clean code that scales</h2>
                <p>
                    We build fast, secure, and maintainable websites using the latest technologies. Our code is crafted to grow with your business.
                </p>
                <ul class="feature-showcase-list">
                    <li>
                        <?php echo fieldcraft_icon("check"); ?>
                        <span>Modern tech stack (React, Next.js, WordPress)</span>
                    </li>
                    <li>
                        <?php echo fieldcraft_icon("check"); ?>
                        <span>Performance-optimized for Core Web Vitals</span>
                    </li>
                    <li>
                        <?php echo fieldcraft_icon("check"); ?>
                        <span>Secure, scalable architecture</span>
                    </li>
                </ul>
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-primary">
                    Start a Project <?php echo fieldcraft_icon("arrow-right"); ?>
                </a>
            </div>
            <div class="feature-showcase-visual reveal reveal-delay-1">
                <div class="feature-showcase-image">
                    <img src="https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=600&h=400&fit=crop" alt="Code development">
                </div>
                <div class="feature-badge feature-badge-1">
                    <div class="feature-badge-icon">
                        <?php echo fieldcraft_icon("lightning"); ?>
                    </div>
                    <span class="feature-badge-text">99 Performance</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Capabilities Grid -->
<section class="capabilities-section">
    <div class="container">
        <div class="section-header center reveal">
            <span class="text-label">Our Capabilities</span>
            <h2 class="text-display">Full-service digital expertise</h2>
            <p>From concept to launch and beyond, we handle every aspect of your digital presence.</p>
        </div>

        <div class="capabilities-grid">
            <div class="capability-card reveal">
                <div class="capability-icon">
                    <?php echo fieldcraft_icon("globe"); ?>
                </div>
                <h3>Web Design & UX</h3>
                <p>User-centered design that balances aesthetics with functionality and conversion optimization.</p>
            </div>

            <div class="capability-card reveal reveal-delay-1">
                <div class="capability-icon">
                    <?php echo fieldcraft_icon("code"); ?>
                </div>
                <h3>Custom Development</h3>
                <p>Tailored solutions built with modern technologies that perform, scale, and are easy to manage.</p>
            </div>

            <div class="capability-card reveal reveal-delay-2">
                <div class="capability-icon">
                    <?php echo fieldcraft_icon("search"); ?>
                </div>
                <h3>SEO & Content</h3>
                <p>Strategic SEO and content that drives organic traffic and establishes thought leadership.</p>
            </div>

            <div class="capability-card reveal">
                <div class="capability-icon">
                    <?php echo fieldcraft_icon("megaphone"); ?>
                </div>
                <h3>Digital Marketing</h3>
                <p>Multi-channel campaigns that reach your audience and generate qualified leads.</p>
            </div>

            <div class="capability-card reveal reveal-delay-1">
                <div class="capability-icon">
                    <?php echo fieldcraft_icon("layers"); ?>
                </div>
                <h3>Brand Identity</h3>
                <p>Cohesive brand systems that tell your story and resonate with your target audience.</p>
            </div>

            <div class="capability-card reveal reveal-delay-2">
                <div class="capability-icon">
                    <?php echo fieldcraft_icon("chart"); ?>
                </div>
                <h3>Analytics & CRO</h3>
                <p>Data-driven insights and continuous optimization to maximize your digital performance.</p>
            </div>
        </div>
    </div>
</section>

<!-- Tech Stack -->
<section class="tech-section">
    <div class="container">
        <div class="section-header center reveal">
            <span class="text-label">Technology</span>
            <h2 class="text-display">Built with the best tools</h2>
            <p>We use industry-leading technologies to deliver exceptional results.</p>
        </div>

        <div class="tech-grid reveal">
            <div class="tech-item">WordPress</div>
            <div class="tech-item">React</div>
            <div class="tech-item">Next.js</div>
            <div class="tech-item">Shopify</div>
            <div class="tech-item">Figma</div>
            <div class="tech-item">Webflow</div>
            <div class="tech-item">Node.js</div>
            <div class="tech-item">PHP</div>
            <div class="tech-item">Tailwind</div>
            <div class="tech-item">AWS</div>
            <div class="tech-item">Vercel</div>
            <div class="tech-item">HubSpot</div>
        </div>
    </div>
</section>

<!-- Comparison Section -->
<section class="comparison-section">
    <div class="container">
        <div class="section-header center reveal">
            <span class="text-label">Why Fieldcraft</span>
            <h2 class="text-display">See how we compare</h2>
            <p>We deliver more value than traditional agencies or freelancers.</p>
        </div>

        <div class="comparison-table-wrapper reveal">
            <table class="comparison-table">
                <thead>
                    <tr>
                        <th>What You Get</th>
                        <th class="highlight-col">Fieldcraft</th>
                        <th>Other Agencies</th>
                        <th>Freelancers</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dedicated project team</td>
                        <td class="highlight-col"><span class="check-icon"><?php echo fieldcraft_icon("check", 20); ?></span></td>
                        <td><span class="check-icon"><?php echo fieldcraft_icon("check", 20); ?></span></td>
                        <td><span class="cross-icon"><?php echo fieldcraft_icon("close", 20); ?></span></td>
                    </tr>
                    <tr>
                        <td>Strategy included</td>
                        <td class="highlight-col"><span class="check-icon"><?php echo fieldcraft_icon("check", 20); ?></span></td>
                        <td>Often extra</td>
                        <td><span class="cross-icon"><?php echo fieldcraft_icon("close", 20); ?></span></td>
                    </tr>
                    <tr>
                        <td>Full-service capabilities</td>
                        <td class="highlight-col"><span class="check-icon"><?php echo fieldcraft_icon("check", 20); ?></span></td>
                        <td><span class="check-icon"><?php echo fieldcraft_icon("check", 20); ?></span></td>
                        <td>Limited</td>
                    </tr>
                    <tr>
                        <td>Transparent pricing</td>
                        <td class="highlight-col"><span class="check-icon"><?php echo fieldcraft_icon("check", 20); ?></span></td>
                        <td>Varies</td>
                        <td><span class="check-icon"><?php echo fieldcraft_icon("check", 20); ?></span></td>
                    </tr>
                    <tr>
                        <td>Ongoing support</td>
                        <td class="highlight-col"><span class="check-icon"><?php echo fieldcraft_icon("check", 20); ?></span></td>
                        <td>Paid extra</td>
                        <td>Limited</td>
                    </tr>
                    <tr>
                        <td>Performance guarantees</td>
                        <td class="highlight-col"><span class="check-icon"><?php echo fieldcraft_icon("check", 20); ?></span></td>
                        <td><span class="cross-icon"><?php echo fieldcraft_icon("close", 20); ?></span></td>
                        <td><span class="cross-icon"><?php echo fieldcraft_icon("close", 20); ?></span></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="features-cta">
    <div class="container">
        <div class="reveal">
            <h2>Ready to elevate your digital presence?</h2>
            <p>Let's discuss how we can help your business grow online. Schedule a free consultation today.</p>
            <div class="features-cta-buttons">
                <a href="<?php echo esc_url(home_url('/contact')); ?>" class="btn btn-accent btn-lg">
                    Get Started <?php echo fieldcraft_icon("arrow-right"); ?>
                </a>
                <a href="<?php echo esc_url(home_url('/work')); ?>" class="btn btn-outline btn-lg">
                    View Our Work
                </a>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
