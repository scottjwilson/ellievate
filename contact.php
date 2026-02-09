<?php
/**
 * Template Name: Contact Page
 *
 * Contact / Booking page for Ellievated Beauty.
 *
 * @package Ellievated
 */

get_header(); ?>

<style>
/* Contact Page Styles */
.contact-hero {
    position: relative;
    padding: 10rem 0 6rem;
    background: var(--cream);
    text-align: center;
}

.contact-hero-content {
    max-width: 600px;
    margin: 0 auto;
}

.contact-hero .section-label {
    margin-bottom: 1rem;
    display: block;
}

.contact-hero h1 {
    font-family: var(--font-display);
    font-size: clamp(2.8rem, 5vw, 4rem);
    font-weight: 400;
    color: var(--ink);
    margin-bottom: 1.5rem;
    line-height: 1.1;
}

.contact-hero h1 em {
    font-style: italic;
    font-weight: 500;
}

.contact-hero-text {
    font-size: 1.125rem;
    font-weight: 300;
    color: var(--text-muted);
    line-height: 1.7;
}

/* Contact Section */
.contact-section {
    padding: var(--section-pad) 0;
    background: var(--cream);
}

.contact-grid {
    display: grid;
    gap: 3rem;
}

@media (min-width: 900px) {
    .contact-grid {
        grid-template-columns: 1fr 1.2fr;
        gap: 4rem;
    }
}

/* Contact Info */
.contact-info h2 {
    font-family: var(--font-display);
    font-size: clamp(1.8rem, 3vw, 2.4rem);
    font-weight: 400;
    color: var(--ink);
    margin-bottom: 1rem;
}

.contact-info > p {
    font-weight: 300;
    color: var(--text-muted);
    line-height: 1.7;
    margin-bottom: 2rem;
}

.contact-methods {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
    margin-bottom: 2.5rem;
}

.contact-method {
    display: flex;
    align-items: flex-start;
    gap: 1rem;
}

.contact-method-icon {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--pearl);
    color: var(--olive);
    border-radius: 50%;
    flex-shrink: 0;
}

.contact-method h4 {
    font-family: var(--font-body);
    font-size: 0.75rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--text-muted);
    margin-bottom: 0.25rem;
}

.contact-method p {
    font-size: 0.95rem;
    font-weight: 400;
    color: var(--ink);
}

.contact-method a {
    color: var(--olive);
    text-decoration: none;
    transition: color 0.3s var(--ease-out);
}

.contact-method a:hover {
    color: var(--forest);
}

/* Social Links */
.contact-social {
    padding-top: 2rem;
    border-top: 1px solid var(--border);
}

.contact-social h4 {
    font-family: var(--font-body);
    font-size: 0.7rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.12em;
    color: var(--text-muted);
    margin-bottom: 1rem;
}

.contact-social-links {
    display: flex;
    gap: 0.75rem;
}

.contact-social-links a {
    width: 40px;
    height: 40px;
    display: flex;
    align-items: center;
    justify-content: center;
    border: 1px solid var(--border);
    border-radius: 50%;
    color: var(--text-muted);
    font-size: 0.7rem;
    font-weight: 500;
    letter-spacing: 0.02em;
    text-decoration: none;
    transition: all 0.3s var(--ease-out);
}

.contact-social-links a:hover {
    background: var(--olive);
    border-color: var(--olive);
    color: white;
}

/* Contact Form */
.contact-form-wrapper {
    background: var(--pearl);
    padding: 2.5rem;
    border-radius: 0;
}

.contact-form {
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}

.form-row {
    display: grid;
    gap: 1.25rem;
}

@media (min-width: 640px) {
    .form-row {
        grid-template-columns: repeat(2, 1fr);
    }
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.form-group label {
    font-size: 0.7rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--ink);
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: 0.875rem 1rem;
    background: var(--cream);
    border: 1px solid var(--border);
    font-family: var(--font-body);
    font-size: 0.95rem;
    font-weight: 300;
    color: var(--ink);
    transition: border-color 0.3s var(--ease-out);
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--sage);
}

.form-group input::placeholder,
.form-group textarea::placeholder {
    color: var(--sage);
}

.form-group textarea {
    resize: vertical;
    min-height: 120px;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.contact-form .btn-primary {
    align-self: flex-start;
}

/* FAQ Section */
.contact-faq {
    padding: var(--section-pad) 0;
    background: var(--pearl);
}

.contact-faq .section-label {
    text-align: center;
}

.contact-faq .section-title {
    text-align: center;
}

.faq-list {
    max-width: 700px;
    margin: 3rem auto 0;
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.faq-item {
    background: var(--cream);
    border: 1px solid var(--border);
    overflow: hidden;
}

.faq-question {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 1rem;
    padding: 1.25rem 1.5rem;
    font-family: var(--font-display);
    font-size: 1.15rem;
    font-weight: 500;
    color: var(--ink);
    text-align: left;
    background: none;
    border: none;
    cursor: pointer;
    transition: background 0.3s var(--ease-out);
}

.faq-question:hover {
    background: var(--pearl);
}

.faq-icon {
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--text-muted);
    flex-shrink: 0;
    transition: all 0.3s var(--ease-out);
}

.faq-item.is-open .faq-icon {
    transform: rotate(45deg);
    color: var(--olive);
}

.faq-answer {
    display: none;
    padding: 0 1.5rem 1.25rem;
    font-size: 0.9rem;
    font-weight: 300;
    color: var(--text-muted);
    line-height: 1.7;
}

.faq-item.is-open .faq-answer {
    display: block;
}

/* CTA Section */
.contact-cta {
    padding: var(--section-pad) 0;
    background: linear-gradient(135deg, var(--forest) 0%, var(--black) 100%);
    text-align: center;
    position: relative;
    overflow: hidden;
}

.contact-cta::before {
    content: '';
    position: absolute;
    top: -50%;
    left: -20%;
    width: 60%;
    height: 200%;
    background: radial-gradient(circle, rgba(157,168,142,0.08) 0%, transparent 70%);
    pointer-events: none;
}
</style>

<!-- Hero Section -->
<section class="contact-hero">
    <div class="container">
        <div class="contact-hero-content reveal">
            <span class="section-label">Book Now</span>
            <h1>Let's get you <em>glowing</em></h1>
            <p class="contact-hero-text">
                Ready for your appointment? Reach out to book a service or ask any questions about our treatments.
            </p>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="contact-section">
    <div class="container">
        <div class="contact-grid">
            <!-- Contact Info -->
            <div class="contact-info reveal">
                <h2>Contact Information</h2>
                <p>
                    Have a question about our services or want to book an appointment? We'd love to hear from you.
                </p>

                <div class="contact-methods">
                    <div class="contact-method">
                        <div class="contact-method-icon">
                            <?php echo ellievated_icon("mail", 20); ?>
                        </div>
                        <div>
                            <h4>Email</h4>
                            <p><a href="mailto:hello@ellievatedbeauty.com">hello@ellievatedbeauty.com</a></p>
                        </div>
                    </div>

                    <div class="contact-method">
                        <div class="contact-method-icon">
                            <?php echo ellievated_icon("phone", 20); ?>
                        </div>
                        <div>
                            <h4>Phone</h4>
                            <p><a href="tel:+1234567890">(123) 456-7890</a></p>
                        </div>
                    </div>

                    <div class="contact-method">
                        <div class="contact-method-icon">
                            <?php echo ellievated_icon("map-pin", 20); ?>
                        </div>
                        <div>
                            <h4>Location</h4>
                            <p>Your City, State</p>
                        </div>
                    </div>

                    <div class="contact-method">
                        <div class="contact-method-icon">
                            <?php echo ellievated_icon("clock", 20); ?>
                        </div>
                        <div>
                            <h4>Hours</h4>
                            <p>By appointment only</p>
                        </div>
                    </div>
                </div>

                <div class="contact-social">
                    <h4>Follow Us</h4>
                    <div class="contact-social-links">
                        <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" aria-label="Instagram">ig</a>
                        <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" aria-label="Facebook">fb</a>
                        <a href="https://tiktok.com" target="_blank" rel="noopener noreferrer" aria-label="TikTok">tk</a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form-wrapper reveal">
                <form class="contact-form" action="#" method="post">
                    <div class="form-row">
                        <div class="form-group">
                            <label for="first-name">First Name *</label>
                            <input type="text" id="first-name" name="first_name" placeholder="Your first name" required>
                        </div>
                        <div class="form-group">
                            <label for="last-name">Last Name *</label>
                            <input type="text" id="last-name" name="last_name" placeholder="Your last name" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" id="email" name="email" placeholder="your@email.com" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="tel" id="phone" name="phone" placeholder="(123) 456-7890">
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label for="service">Service Interested In</label>
                        <select id="service" name="service">
                            <option value="">Select a service...</option>
                            <option value="custom-facial">Custom Facial</option>
                            <option value="brow-wax">Brow Wax & Shape</option>
                            <option value="brazilian-wax">Brazilian Wax</option>
                            <option value="other">Other / General Question</option>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" placeholder="Tell us about what you're looking for, any skin concerns, or preferred appointment times..."></textarea>
                    </div>

                    <button type="submit" class="btn-primary">
                        Send Message
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="contact-faq">
    <div class="container">
        <div class="reveal">
            <p class="section-label">FAQ</p>
            <h2 class="section-title">Common questions</h2>
        </div>

        <div class="faq-list">
            <div class="faq-item is-open reveal">
                <button class="faq-question">
                    <span>How do I prepare for my facial appointment?</span>
                    <span class="faq-icon"><?php echo ellievated_icon(
                        "plus",
                        14,
                    ); ?></span>
                </button>
                <div class="faq-answer">
                    Come with a clean face free of makeup if possible. Avoid retinols or exfoliating products 48 hours before your appointment. Let us know about any skin sensitivities or allergies during your consultation.
                </div>
            </div>

            <div class="faq-item reveal">
                <button class="faq-question">
                    <span>How long does each service take?</span>
                    <span class="faq-icon"><?php echo ellievated_icon(
                        "plus",
                        14,
                    ); ?></span>
                </button>
                <div class="faq-answer">
                    A Custom Facial typically takes 60 minutes. A Brow Wax & Shape takes about 15 minutes. A Brazilian Wax takes approximately 30 minutes. Times may vary based on individual needs.
                </div>
            </div>

            <div class="faq-item reveal">
                <button class="faq-question">
                    <span>What is your cancellation policy?</span>
                    <span class="faq-icon"><?php echo ellievated_icon(
                        "plus",
                        14,
                    ); ?></span>
                </button>
                <div class="faq-answer">
                    We ask for at least 24 hours notice for cancellations or rescheduling. Late cancellations or no-shows may be subject to a cancellation fee.
                </div>
            </div>

            <div class="faq-item reveal">
                <button class="faq-question">
                    <span>Is waxing painful?</span>
                    <span class="faq-icon"><?php echo ellievated_icon(
                        "plus",
                        14,
                    ); ?></span>
                </button>
                <div class="faq-answer">
                    We use premium hard wax and gentle techniques to minimize discomfort. Most clients find the process much more comfortable than expected, especially with regular appointments. We also provide pre and post-wax care to soothe the skin.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="contact-cta">
    <div class="container">
        <div class="reveal" style="max-width: 600px; margin: 0 auto;">
            <p class="section-label" style="color: var(--sage);">Ready?</p>
            <h2 class="section-title" style="color: white;">Book your appointment <em class="swash">today</em></h2>
            <p style="color: var(--sage-light); font-weight: 300; line-height: 1.7; margin-bottom: 2rem;">Your skin deserves expert care. Let's create a personalized treatment plan just for you.</p>
            <a href="#" class="btn-on-dark">Book a Consultation</a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
