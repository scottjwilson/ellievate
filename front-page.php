<?php
/**
 * Front Page Template
 * Ellievated Beauty - Esthetician & Skincare
 *
 * @package Ellievated
 */

get_header(); ?>

<!-- ========================================
     HERO SECTION
     ======================================== -->
<section class="hero">
    <div class="hero-bg">
        <div class="hero-bg-image"></div>
    </div>

    <div class="container">
        <div class="hero-inner">
            <div class="hero-content reveal">
                <h1>Reveal your <em>flawless</em> face</h1>
                <p>
                    Look and feel your best with personalized, results-focused skincare
                    solutions that cater to your unique needs. Book Ellievated Beauty
                    for expert facials, brow shaping, and waxing services.
                </p>
                <a href="<?php echo esc_url(
                    home_url("/contact"),
                ); ?>" class="btn btn-outline">
                    Book an Appointment
                </a>
            </div>

            <div class="hero-images reveal reveal-delay-1">
                <div class="hero-image-main">
                    <img src="https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=600&h=750&fit=crop" alt="Facial treatment">
                </div>
                <div class="hero-image-accent">
                    <img src="https://images.unsplash.com/photo-1616394584738-fc6e612e71b9?w=500&h=400&fit=crop" alt="Skincare results">
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     INTRO / ABOUT SECTION
     ======================================== -->
<section class="intro-section">
    <div class="container">
        <div class="intro-grid">
            <div class="intro-image reveal">
                <img src="https://images.unsplash.com/photo-1487412947147-5cebf100ffc2?w=600&h=800&fit=crop" alt="Ellievated Beauty skincare">
            </div>

            <div class="intro-content reveal reveal-delay-1">
                <span class="text-label">About Ellievated Beauty</span>
                <h2>Targeted treatments, <em>real results.</em></h2>
                <p>
                    Ready to glow like never before? Ellievated Beauty's goal-focused
                    facials and waxing services are here to help! Whether you're looking to tackle acne, fine
                    lines, or simply want a refreshing pick-me-up, we've got you
                    covered.
                </p>
                <p>
                    With a customized approach that's all about efficiency
                    and results, our services are designed to leave you feeling
                    confident and radiant.
                </p>
                <a href="<?php echo esc_url(
                    home_url("/services"),
                ); ?>" class="btn btn-outline">
                    View Services
                </a>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     SERVICES SECTION
     ======================================== -->
<section class="services-section" id="services">
    <div class="container">
        <div class="section-header center reveal">
            <span class="text-label">Our Services</span>
            <h2 class="text-display">Treatments tailored to you</h2>
            <p>Expert skincare and waxing services designed to enhance your natural beauty.</p>
        </div>

        <div class="services-grid">
            <div class="service-card reveal">
                <div class="service-card-image">
                    <img src="https://images.unsplash.com/photo-1616394584738-fc6e612e71b9?w=500&h=667&fit=crop" alt="Signature Facial">
                </div>
                <div class="service-card-content">
                    <h3>Signature Facial</h3>
                    <span class="service-price">Starting at $85</span>
                    <p>A customized facial experience tailored to your skin's specific needs for a healthy, radiant glow.</p>
                    <a href="<?php echo esc_url(
                        home_url("/services"),
                    ); ?>" class="service-link">
                        Learn More <?php echo ellievated_icon(
                            "arrow-right",
                            14,
                        ); ?>
                    </a>
                </div>
            </div>

            <div class="service-card reveal reveal-delay-1">
                <div class="service-card-image">
                    <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=500&h=667&fit=crop" alt="Brow Wax">
                </div>
                <div class="service-card-content">
                    <h3>Brow Wax</h3>
                    <span class="service-price">Starting at $25</span>
                    <p>Precision brow shaping to frame your face and enhance your natural features perfectly.</p>
                    <a href="<?php echo esc_url(
                        home_url("/services"),
                    ); ?>" class="service-link">
                        Learn More <?php echo ellievated_icon(
                            "arrow-right",
                            14,
                        ); ?>
                    </a>
                </div>
            </div>

            <div class="service-card reveal reveal-delay-2">
                <div class="service-card-image">
                    <img src="https://images.unsplash.com/photo-1552693673-1bf958c31657?w=500&h=667&fit=crop" alt="Brazilian Wax">
                </div>
                <div class="service-card-content">
                    <h3>Brazilian Wax</h3>
                    <span class="service-price">Starting at $55</span>
                    <p>Smooth, long-lasting results with our gentle technique designed for your comfort.</p>
                    <a href="<?php echo esc_url(
                        home_url("/services"),
                    ); ?>" class="service-link">
                        Learn More <?php echo ellievated_icon(
                            "arrow-right",
                            14,
                        ); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     TESTIMONIALS SECTION
     ======================================== -->
<section class="testimonials-section">
    <div class="container">
        <div class="section-header center reveal">
            <span class="text-label">Client Love</span>
            <h2 class="text-display">What our clients say</h2>
        </div>

        <div class="testimonials-grid">
            <div class="testimonial-card reveal">
                <div class="testimonial-stars">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                        <?php echo ellievated_icon("star", 16); ?>
                    <?php endfor; ?>
                </div>
                <blockquote>
                    "My skin has never looked better. The signature facial was exactly what I needed - personalized and so relaxing. I leave every appointment glowing!"
                </blockquote>
                <div class="testimonial-author">
                    <div>
                        <strong>Jessica M.</strong>
                        <span>Signature Facial Client</span>
                    </div>
                </div>
            </div>

            <div class="testimonial-card reveal reveal-delay-1">
                <div class="testimonial-stars">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                        <?php echo ellievated_icon("star", 16); ?>
                    <?php endfor; ?>
                </div>
                <blockquote>
                    "Best brow wax I've ever had. She took the time to understand the shape I wanted and the results were perfect. Won't go anywhere else!"
                </blockquote>
                <div class="testimonial-author">
                    <div>
                        <strong>Amanda K.</strong>
                        <span>Brow Wax Client</span>
                    </div>
                </div>
            </div>

            <div class="testimonial-card reveal reveal-delay-2">
                <div class="testimonial-stars">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                        <?php echo ellievated_icon("star", 16); ?>
                    <?php endfor; ?>
                </div>
                <blockquote>
                    "I was nervous for my first Brazilian but she made me feel so comfortable. Quick, professional, and virtually painless. Highly recommend!"
                </blockquote>
                <div class="testimonial-author">
                    <div>
                        <strong>Taylor R.</strong>
                        <span>Brazilian Wax Client</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     GALLERY SECTION
     ======================================== -->
<section class="gallery-section">
    <div class="container">
        <div class="section-header center reveal">
            <span class="text-label">Follow Along</span>
            <h2 class="text-display">@ellievatedbeauty</h2>
        </div>

        <div class="gallery-grid">
            <div class="gallery-item reveal">
                <img src="https://images.unsplash.com/photo-1596755389378-c31d21fd1273?w=400&h=400&fit=crop" alt="Beauty treatment">
                <div class="gallery-item-overlay">
                    <?php echo ellievated_icon("instagram", 24); ?>
                </div>
            </div>
            <div class="gallery-item reveal reveal-delay-1">
                <img src="https://images.unsplash.com/photo-1570172619644-dfd03ed5d881?w=400&h=400&fit=crop" alt="Facial treatment">
                <div class="gallery-item-overlay">
                    <?php echo ellievated_icon("instagram", 24); ?>
                </div>
            </div>
            <div class="gallery-item reveal reveal-delay-2">
                <img src="https://images.unsplash.com/photo-1522337360788-8b13dee7a37e?w=400&h=400&fit=crop" alt="Skincare products">
                <div class="gallery-item-overlay">
                    <?php echo ellievated_icon("instagram", 24); ?>
                </div>
            </div>
            <div class="gallery-item reveal reveal-delay-3">
                <img src="https://images.unsplash.com/photo-1487412947147-5cebf100ffc2?w=400&h=400&fit=crop" alt="Beauty results">
                <div class="gallery-item-overlay">
                    <?php echo ellievated_icon("instagram", 24); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ========================================
     CTA SECTION
     ======================================== -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content reveal">
            <h2>Ready to <em>elevate</em> your beauty routine?</h2>
            <p>Book your appointment today and experience the Ellievated difference. Your skin will thank you.</p>
            <a href="<?php echo esc_url(
                home_url("/contact"),
            ); ?>" class="btn btn-outline-light btn-lg">
                Book an Appointment
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
