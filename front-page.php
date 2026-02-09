<?php
/**
 * Front Page Template
 * Ellievated Beauty — Esthetician Studio
 *
 * @package Ellievated
 */

get_header(); ?>

<!-- HERO -->
<section class="hero">
    <div class="container">
        <div class="hero-content">
            <p class="hero-tagline">Licensed Esthetician</p>
            <h1 class="hero-title">Elevate your <em>natural glow</em></h1>
            <p class="hero-desc">Expert facials, precision brow shaping, and silky-smooth waxing — all in a relaxing, boutique studio designed around you.</p>
            <div class="hero-actions">
                <a href="#services" class="btn btn-primary">View Services</a>
                <a href="<?php echo esc_url(
                    home_url("/contact"),
                ); ?>" class="btn btn-outline">Book Appointment</a>
            </div>
        </div>
        <div class="hero-visual">
            <div class="hero-image-frame">
                <!-- Replace with actual photo: <img src="hero.jpg" alt="Ellievated Beauty Studio"> -->
                <div class="palette-dots">
                    <div class="palette-dot"></div>
                    <div class="palette-dot"></div>
                    <div class="palette-dot"></div>
                    <div class="palette-dot"></div>
                    <div class="palette-dot"></div>
                </div>
            </div>
            <div class="hero-badge">
                <div class="hero-badge-icon">&#10022;</div>
                <div class="hero-badge-text">
                    <strong>500+ Happy Clients</strong>
                    <span style="color: var(--text-muted);">5.0 &#9733; on Google</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SERVICES -->
<section class="services" id="services">
    <div class="container">
        <div class="services-header reveal">
            <span class="swash"></span>
            <p class="section-label">Our Services</p>
            <h2 class="section-title">Three ways to glow</h2>
            <p class="section-subtitle">Each treatment is tailored to your unique skin. Relax, unwind, and let Ellie take care of the rest.</p>
        </div>
        <div class="services-grid reveal-stagger">
            <div class="service-card">
                <div class="service-icon">&#10047;</div>
                <h3 class="service-name">Custom Facial</h3>
                <p class="service-duration">60 minutes</p>
                <p class="service-desc">A fully customized treatment featuring deep cleansing, exfoliation, extractions, and a nourishing mask — tailored to your skin's needs.</p>
                <div class="service-footer">
                    <div class="service-price">$85 <span>/ session</span></div>
                    <a href="<?php echo esc_url(
                        home_url("/contact"),
                    ); ?>" class="btn btn-primary service-book">Book</a>
                </div>
            </div>
            <div class="service-card">
                <div class="service-icon">&#10043;</div>
                <h3 class="service-name">Brow Wax &amp; Shape</h3>
                <p class="service-duration">15 minutes</p>
                <p class="service-desc">Precision waxing and shaping to frame your face beautifully. Includes a soothing aftercare balm to calm the skin.</p>
                <div class="service-footer">
                    <div class="service-price">$25 <span>/ session</span></div>
                    <a href="<?php echo esc_url(
                        home_url("/contact"),
                    ); ?>" class="btn btn-primary service-book">Book</a>
                </div>
            </div>
            <div class="service-card">
                <div class="service-icon">&#10023;</div>
                <h3 class="service-name">Brazilian Wax</h3>
                <p class="service-duration">30 minutes</p>
                <p class="service-desc">Smooth, long-lasting results using gentle hard wax. Designed for comfort with minimal irritation and maximum confidence.</p>
                <div class="service-footer">
                    <div class="service-price">$65 <span>/ session</span></div>
                    <a href="<?php echo esc_url(
                        home_url("/contact"),
                    ); ?>" class="btn btn-primary service-book">Book</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ABOUT -->
<section class="about" id="about">
    <div class="container">
        <div class="about-visual reveal">
            <div class="about-image">
                <div class="about-image-inner">
                    <div class="about-image-text">E</div>
                </div>
            </div>
            <div class="about-stat-float">
                <div class="about-stat-number">8+</div>
                <div class="about-stat-label">Years Experience</div>
            </div>
        </div>
        <div class="about-content reveal">
            <span class="swash"></span>
            <p class="section-label">Meet Your Esthetician</p>
            <h2 class="section-title">Hi, I'm Ellie</h2>
            <p class="about-text">I'm a licensed esthetician with a passion for helping you feel your most confident. My studio is a calm, clean, judgment-free space where every treatment is personalized to your skin and your comfort.</p>
            <p class="about-text">Whether it's your first facial or your hundredth Brazilian, I'm here to make every visit relaxing and results-driven.</p>
            <div class="about-features">
                <div class="about-feature"><span class="about-feature-dot"></span> Licensed &amp; Certified</div>
                <div class="about-feature"><span class="about-feature-dot"></span> Premium Products</div>
                <div class="about-feature"><span class="about-feature-dot"></span> Sanitized Studio</div>
                <div class="about-feature"><span class="about-feature-dot"></span> Personalized Care</div>
            </div>
            <a href="<?php echo esc_url(
                home_url("/contact"),
            ); ?>" class="btn btn-on-dark">Book with Ellie</a>
        </div>
    </div>
</section>

<!-- TESTIMONIALS -->
<section class="testimonials" id="reviews">
    <div class="container">
        <div class="testimonials-header reveal">
            <span class="swash"></span>
            <p class="section-label">Client Love</p>
            <h2 class="section-title">What our clients are saying</h2>
        </div>
        <div class="testimonials-grid reveal-stagger">
            <div class="testimonial-card">
                <div class="testimonial-stars">&#9733; &#9733; &#9733; &#9733; &#9733;</div>
                <p class="testimonial-text">"My skin has never looked better. Ellie really listens to what your skin needs and every facial feels like a luxurious escape."</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">JR</div>
                    <div>
                        <div class="testimonial-name">Jessica R.</div>
                        <div class="testimonial-service">Custom Facial</div>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-stars">&#9733; &#9733; &#9733; &#9733; &#9733;</div>
                <p class="testimonial-text">"Best brows I've ever had — she gets the shape absolutely perfect every single time. I won't go anywhere else!"</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">AK</div>
                    <div>
                        <div class="testimonial-name">Amanda K.</div>
                        <div class="testimonial-service">Brow Wax &amp; Shape</div>
                    </div>
                </div>
            </div>
            <div class="testimonial-card">
                <div class="testimonial-stars">&#9733; &#9733; &#9733; &#9733; &#9733;</div>
                <p class="testimonial-text">"So gentle and professional. I was nervous for my first Brazilian but Ellie made me feel completely at ease. Absolutely painless!"</p>
                <div class="testimonial-author">
                    <div class="testimonial-avatar">ST</div>
                    <div>
                        <div class="testimonial-name">Sarah T.</div>
                        <div class="testimonial-service">Brazilian Wax</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta" id="book">
    <div class="container">
        <p class="section-label">Ready to Glow?</p>
        <h2 class="section-title">Your best skin is one booking away</h2>
        <p class="cta-subtitle">New clients receive 15% off their first service. Book your appointment today and experience the Ellievated difference.</p>
        <div class="cta-actions">
            <a href="<?php echo esc_url(
                home_url("/contact"),
            ); ?>" class="btn btn-light">Book Online</a>
            <a href="tel:+15551234567" class="btn btn-outline-light">Call (555) 123-4567</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
