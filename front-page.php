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
                <img src="<?php echo esc_url(
                    get_template_directory_uri() . "/images/d.jpg",
                ); ?>" alt="Ellievated Beauty — Esthetician at work">
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
            <?php
            $services = ellievated_get_services(3);
            if ($services->have_posts()):
                while ($services->have_posts()):

                    $services->the_post();
                    $product = wc_get_product(get_the_ID());
                    $duration = get_post_meta(
                        get_the_ID(),
                        "_service_duration",
                        true,
                    );
                    $icon = get_post_meta(get_the_ID(), "_service_icon", true);
                    ?>
            <div class="service-card">
                <?php if ($icon): ?>
                    <div class="service-icon"><?php echo $icon; ?></div>
                <?php endif; ?>
                <h3 class="service-name"><?php the_title(); ?></h3>
                <?php if ($duration): ?>
                    <p class="service-duration"><?php echo esc_html(
                        $duration,
                    ); ?></p>
                <?php endif; ?>
                <p class="service-desc"><?php echo get_the_excerpt(); ?></p>
                <div class="service-footer">
                    <div class="service-price">$<?php echo esc_html(
                        $product->get_price(),
                    ); ?> <span>/ session</span></div>
                    <a href="<?php the_permalink(); ?>" class="btn btn-primary service-book">Book</a>
                </div>
            </div>
            <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
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
