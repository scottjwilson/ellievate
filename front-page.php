<?php
/**
 * Front Page Template
 * Fieldcraft Digital 2.0 - Digital Marketing Agency
 *
 * @package Fieldcraft
 */

get_header(); ?>

<!-- ========================================
     HERO SECTION
     ======================================== -->
<section class="hero">
    <div class="hero-bg">
        <div class="hero-gradient"></div>
        <div class="hero-grid"></div>
        <div class="hero-orb hero-orb-1"></div>
        <div class="hero-orb hero-orb-2"></div>
    </div>

    <div class="container">
        <div class="hero-inner">
            <div class="hero-content reveal">
                <span class="hero-label">Digital Marketing Agency</span>
                <h1 class="text-hero">
                    We craft digital experiences that <span class="text-gradient">drive growth</span>
                </h1>
                <p class="hero-subtitle">
                    Award-winning agency specializing in web design, development, and digital strategy.
                    We partner with ambitious brands to build products that matter.
                </p>
                <div class="hero-actions">
                    <a href="<?php echo esc_url(
                        home_url("/contact"),
                    ); ?>" class="btn btn-accent btn-lg">
                        Start a Project
                        <?php echo fieldcraft_icon("arrow-right"); ?>
                    </a>
                    <a href="<?php echo esc_url(
                        home_url("/work"),
                    ); ?>" class="btn btn-outline btn-lg">
                        View Our Work
                    </a>
                </div>
            </div>

            <div class="hero-stats reveal reveal-delay-1">
                <div class="stat-card">
                    <span class="stat-number">150+</span>
                    <span class="stat-text">Projects Delivered</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number">8+</span>
                    <span class="stat-text">Years Experience</span>
                </div>
                <div class="stat-card">
                    <span class="stat-number">98%</span>
                    <span class="stat-text">Client Satisfaction</span>
                </div>
            </div>
        </div>
    </div>

    <div class="hero-scroll">
        <span>Scroll to explore</span>
        <div class="scroll-indicator"></div>
    </div>
</section>

<!-- ========================================
     CLIENTS LOGO BAR
     ======================================== -->
<section class="clients-section">
    <div class="container">
        <p class="clients-label">Trusted by innovative companies</p>
        <div class="clients-logos">
            <div class="logo-item">
                <svg viewBox="0 0 120 30" fill="currentColor"><rect x="0" y="8" width="14" height="14" rx="3"/><text x="22" y="20" font-size="13" font-weight="600">Stripe</text></svg>
            </div>
            <div class="logo-item">
                <svg viewBox="0 0 120 30" fill="currentColor"><circle cx="7" cy="15" r="7"/><text x="22" y="20" font-size="13" font-weight="600">Notion</text></svg>
            </div>
            <div class="logo-item">
                <svg viewBox="0 0 120 30" fill="currentColor"><polygon points="7,3 14,27 0,27"/><text x="22" y="20" font-size="13" font-weight="600">Vercel</text></svg>
            </div>
            <div class="logo-item">
                <svg viewBox="0 0 120 30" fill="currentColor"><rect x="0" y="5" width="10" height="10" rx="2"/><rect x="4" y="15" width="10" height="10" rx="2"/><text x="22" y="20" font-size="13" font-weight="600">Linear</text></svg>
            </div>
            <div class="logo-item">
                <svg viewBox="0 0 120 30" fill="currentColor"><path d="M0,15 L7,5 L14,15 L7,25 Z"/><text x="22" y="20" font-size="13" font-weight="600">Figma</text></svg>
            </div>
            <div class="logo-item">
                <svg viewBox="0 0 120 30" fill="currentColor"><circle cx="7" cy="10" r="5"/><circle cx="7" cy="22" r="3"/><text x="22" y="20" font-size="13" font-weight="600">Framer</text></svg>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     SERVICES SECTION
     ======================================== -->
<section class="section services-section" id="services">
    <div class="container">
        <div class="section-header reveal">
            <span class="text-label">What We Do</span>
            <h2 class="text-display">Services tailored for<br>modern businesses</h2>
            <p>We offer a comprehensive suite of digital services to help your brand stand out and succeed in the digital landscape.</p>
        </div>

        <div class="services-grid">
            <div class="service-card reveal">
                <div class="service-icon">
                    <?php echo fieldcraft_icon("palette", 28); ?>
                </div>
                <h3>Web Design</h3>
                <p>Beautiful, user-centered designs that capture your brand essence and convert visitors into customers.</p>
                <a href="<?php echo esc_url(
                    home_url("/services/web-design"),
                ); ?>" class="service-link">
                    Learn more <?php echo fieldcraft_icon("arrow-right", 16); ?>
                </a>
            </div>

            <div class="service-card reveal reveal-delay-1">
                <div class="service-icon">
                    <?php echo fieldcraft_icon("code", 28); ?>
                </div>
                <h3>Development</h3>
                <p>Custom web applications and WordPress solutions built with modern technologies for speed and scalability.</p>
                <a href="<?php echo esc_url(
                    home_url("/services/development"),
                ); ?>" class="service-link">
                    Learn more <?php echo fieldcraft_icon("arrow-right", 16); ?>
                </a>
            </div>

            <div class="service-card reveal reveal-delay-2">
                <div class="service-icon">
                    <?php echo fieldcraft_icon("search", 28); ?>
                </div>
                <h3>SEO Strategy</h3>
                <p>Data-driven SEO strategies that improve visibility, drive organic traffic, and boost your search rankings.</p>
                <a href="<?php echo esc_url(
                    home_url("/services/seo"),
                ); ?>" class="service-link">
                    Learn more <?php echo fieldcraft_icon("arrow-right", 16); ?>
                </a>
            </div>

            <div class="service-card reveal">
                <div class="service-icon">
                    <?php echo fieldcraft_icon("megaphone", 28); ?>
                </div>
                <h3>Digital Marketing</h3>
                <p>Comprehensive marketing campaigns that reach your audience across all digital channels effectively.</p>
                <a href="<?php echo esc_url(
                    home_url("/services/marketing"),
                ); ?>" class="service-link">
                    Learn more <?php echo fieldcraft_icon("arrow-right", 16); ?>
                </a>
            </div>

            <div class="service-card reveal reveal-delay-1">
                <div class="service-icon">
                    <?php echo fieldcraft_icon("layers", 28); ?>
                </div>
                <h3>Brand Identity</h3>
                <p>Strategic branding that tells your story and creates lasting connections with your target audience.</p>
                <a href="<?php echo esc_url(
                    home_url("/services/branding"),
                ); ?>" class="service-link">
                    Learn more <?php echo fieldcraft_icon("arrow-right", 16); ?>
                </a>
            </div>

            <div class="service-card reveal reveal-delay-2">
                <div class="service-icon">
                    <?php echo fieldcraft_icon("chart", 28); ?>
                </div>
                <h3>Analytics & Insights</h3>
                <p>Turn data into actionable insights with comprehensive analytics and performance tracking solutions.</p>
                <a href="<?php echo esc_url(
                    home_url("/services/analytics"),
                ); ?>" class="service-link">
                    Learn more <?php echo fieldcraft_icon("arrow-right", 16); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     FEATURED WORK SECTION
     ======================================== -->
<section class="section work-section">
    <div class="container">
        <div class="section-header reveal">
            <span class="text-label">Selected Work</span>
            <h2 class="text-display">Projects that speak<br>for themselves</h2>
        </div>

        <div class="work-grid">
            <article class="work-card work-card-large reveal">
                <a href="#" class="work-card-link">
                    <div class="work-card-image">
                        <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=800&h=600&fit=crop" alt="TechFlow Dashboard">
                        <div class="work-card-overlay">
                            <span class="btn btn-white">View Project <?php echo fieldcraft_icon(
                                "arrow-up-right",
                                16,
                            ); ?></span>
                        </div>
                    </div>
                    <div class="work-card-content">
                        <span class="work-category">Web Application</span>
                        <h3>TechFlow Dashboard</h3>
                        <p>A comprehensive analytics dashboard for a SaaS startup, featuring real-time data visualization.</p>
                    </div>
                </a>
            </article>

            <article class="work-card reveal reveal-delay-1">
                <a href="#" class="work-card-link">
                    <div class="work-card-image">
                        <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?w=600&h=450&fit=crop" alt="Verde Organic">
                        <div class="work-card-overlay">
                            <span class="btn btn-white">View Project <?php echo fieldcraft_icon(
                                "arrow-up-right",
                                16,
                            ); ?></span>
                        </div>
                    </div>
                    <div class="work-card-content">
                        <span class="work-category">E-Commerce</span>
                        <h3>Verde Organic</h3>
                        <p>Brand identity and online store for an organic skincare company.</p>
                    </div>
                </a>
            </article>

            <article class="work-card reveal reveal-delay-2">
                <a href="#" class="work-card-link">
                    <div class="work-card-image">
                        <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=600&h=450&fit=crop" alt="FinanceHub">
                        <div class="work-card-overlay">
                            <span class="btn btn-white">View Project <?php echo fieldcraft_icon(
                                "arrow-up-right",
                                16,
                            ); ?></span>
                        </div>
                    </div>
                    <div class="work-card-content">
                        <span class="work-category">FinTech</span>
                        <h3>FinanceHub</h3>
                        <p>Modern banking experience redesign with focus on mobile-first approach.</p>
                    </div>
                </a>
            </article>

            <article class="work-card reveal">
                <a href="#" class="work-card-link">
                    <div class="work-card-image">
                        <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?w=600&h=450&fit=crop" alt="StartupX">
                        <div class="work-card-overlay">
                            <span class="btn btn-white">View Project <?php echo fieldcraft_icon(
                                "arrow-up-right",
                                16,
                            ); ?></span>
                        </div>
                    </div>
                    <div class="work-card-content">
                        <span class="work-category">Marketing Site</span>
                        <h3>StartupX</h3>
                        <p>High-converting landing pages for a venture-backed tech startup.</p>
                    </div>
                </a>
            </article>

            <article class="work-card reveal reveal-delay-1">
                <a href="#" class="work-card-link">
                    <div class="work-card-image">
                        <img src="https://images.unsplash.com/photo-1553877522-43269d4ea984?w=600&h=450&fit=crop" alt="Artisan Coffee">
                        <div class="work-card-overlay">
                            <span class="btn btn-white">View Project <?php echo fieldcraft_icon(
                                "arrow-up-right",
                                16,
                            ); ?></span>
                        </div>
                    </div>
                    <div class="work-card-content">
                        <span class="work-category">Brand & Web</span>
                        <h3>Artisan Coffee Co.</h3>
                        <p>Complete rebrand and website for a specialty coffee roaster.</p>
                    </div>
                </a>
            </article>
        </div>

        <div class="work-cta reveal">
            <a href="<?php echo esc_url(
                home_url("/work"),
            ); ?>" class="btn btn-outline btn-lg">
                View All Projects <?php echo fieldcraft_icon("arrow-right"); ?>
            </a>
        </div>
    </div>
</section>

<!-- ========================================
     PROCESS SECTION
     ======================================== -->
<section class="section process-section">
    <div class="container">
        <div class="process-grid">
            <div class="process-content reveal">
                <span class="text-label">Our Process</span>
                <h2 class="text-display">How we bring your vision to life</h2>
                <p>We follow a proven methodology that ensures every project is delivered on time, on budget, and exceeds expectations.</p>
            </div>

            <div class="process-steps">
                <div class="process-step reveal">
                    <div class="step-number">01</div>
                    <div class="step-content">
                        <h4>Discovery</h4>
                        <p>We dive deep into your business, goals, and audience to understand what success looks like.</p>
                    </div>
                </div>

                <div class="process-step reveal reveal-delay-1">
                    <div class="step-number">02</div>
                    <div class="step-content">
                        <h4>Strategy</h4>
                        <p>We craft a detailed roadmap that aligns creative solutions with your business objectives.</p>
                    </div>
                </div>

                <div class="process-step reveal reveal-delay-2">
                    <div class="step-number">03</div>
                    <div class="step-content">
                        <h4>Design & Build</h4>
                        <p>Our team brings concepts to life with pixel-perfect design and clean, efficient code.</p>
                    </div>
                </div>

                <div class="process-step reveal reveal-delay-3">
                    <div class="step-number">04</div>
                    <div class="step-content">
                        <h4>Launch & Grow</h4>
                        <p>We ensure a smooth launch and provide ongoing support to help your project thrive.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     TESTIMONIALS SECTION
     ======================================== -->
<section class="section testimonials-section">
    <div class="container">
        <div class="section-header center reveal">
            <span class="text-label">Client Stories</span>
            <h2 class="text-display">What our clients say</h2>
        </div>

        <div class="testimonials-grid">
            <div class="testimonial-card reveal">
                <div class="testimonial-quote">
                    <?php echo fieldcraft_icon("quote", 32); ?>
                </div>
                <blockquote>
                    "Fieldcraft transformed our online presence completely. The new website increased our conversions by 340% in just three months. Their attention to detail is unmatched."
                </blockquote>
                <div class="testimonial-author">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=100&h=100&fit=crop" alt="Sarah Chen">
                    <div>
                        <strong>Sarah Chen</strong>
                        <span>CEO, TechFlow</span>
                    </div>
                </div>
            </div>

            <div class="testimonial-card reveal reveal-delay-1">
                <div class="testimonial-quote">
                    <?php echo fieldcraft_icon("quote", 32); ?>
                </div>
                <blockquote>
                    "Working with Fieldcraft was a game-changer for our brand. They didn't just build us a website—they gave us a digital identity that truly represents who we are."
                </blockquote>
                <div class="testimonial-author">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=100&h=100&fit=crop" alt="Marcus Johnson">
                    <div>
                        <strong>Marcus Johnson</strong>
                        <span>Founder, Verde Organic</span>
                    </div>
                </div>
            </div>

            <div class="testimonial-card reveal reveal-delay-2">
                <div class="testimonial-quote">
                    <?php echo fieldcraft_icon("quote", 32); ?>
                </div>
                <blockquote>
                    "The team at Fieldcraft is exceptional. They took our complex requirements and delivered a solution that was both beautiful and incredibly functional."
                </blockquote>
                <div class="testimonial-author">
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=100&h=100&fit=crop" alt="Emily Rodriguez">
                    <div>
                        <strong>Emily Rodriguez</strong>
                        <span>CMO, FinanceHub</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     ABOUT SECTION
     ======================================== -->
<section class="section about-section">
    <div class="container">
        <div class="about-grid">
            <div class="about-images reveal">
                <div class="about-image about-image-main">
                    <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=600&h=700&fit=crop" alt="Fieldcraft team at work">
                </div>
                <div class="about-image about-image-accent">
                    <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=400&h=300&fit=crop" alt="Team collaboration">
                </div>
            </div>

            <div class="about-content reveal reveal-delay-1">
                <span class="text-label">About Us</span>
                <h2 class="text-display">A team passionate about digital craft</h2>
                <p class="text-subtitle">
                    We're a collective of designers, developers, and strategists who believe in the power of thoughtful digital experiences.
                </p>
                <p>
                    Founded in 2016, Fieldcraft has grown from a small studio into a full-service digital agency. We've had the privilege of working with startups, scale-ups, and established brands across industries.
                </p>
                <p>
                    What sets us apart? We treat every project as our own. We're not just service providers—we're partners invested in your success.
                </p>

                <div class="about-stats">
                    <div class="about-stat">
                        <span class="stat-value">50+</span>
                        <span class="stat-label">Happy Clients</span>
                    </div>
                    <div class="about-stat">
                        <span class="stat-value">12</span>
                        <span class="stat-label">Team Members</span>
                    </div>
                    <div class="about-stat">
                        <span class="stat-value">15</span>
                        <span class="stat-label">Awards Won</span>
                    </div>
                </div>

                <a href="<?php echo esc_url(
                    home_url("/about"),
                ); ?>" class="btn btn-primary btn-lg">
                    Meet the Team <?php echo fieldcraft_icon("arrow-right"); ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     CTA SECTION
     ======================================== -->
<section class="section cta-section">
    <div class="container">
        <div class="cta-card reveal">
            <div class="cta-content">
                <h2 class="text-display">Ready to start your project?</h2>
                <p>Let's discuss how we can help bring your vision to life. Get in touch for a free consultation.</p>
                <div class="cta-actions">
                    <a href="<?php echo esc_url(
                        home_url("/contact"),
                    ); ?>" class="btn btn-accent btn-lg">
                        Start a Conversation
                        <?php echo fieldcraft_icon("arrow-right"); ?>
                    </a>
                    <a href="mailto:hello@fieldcraft.digital" class="cta-email">
                        <?php echo fieldcraft_icon("mail", 20); ?>
                        hello@fieldcraft.digital
                    </a>
                </div>
            </div>
            <div class="cta-decoration">
                <div class="cta-orb"></div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
