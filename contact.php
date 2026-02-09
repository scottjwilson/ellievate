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
    background: var(--color-cream-100);
    text-align: center;
}

.contact-hero-content {
    max-width: 600px;
    margin: 0 auto;
}

.contact-hero .text-label {
    color: var(--color-primary-600);
    margin-bottom: var(--space-4);
    display: block;
}

.contact-hero h1 {
    font-family: var(--font-display);
    font-size: var(--text-hero);
    font-weight: 400;
    color: var(--color-dark-900);
    margin-bottom: var(--space-6);
}

.contact-hero h1 em {
    font-style: italic;
    font-weight: 500;
}

.contact-hero-text {
    font-size: var(--text-lg);
    font-weight: 300;
    color: var(--color-neutral-500);
    line-height: var(--leading-relaxed);
}

/* Contact Section */
.contact-section {
    padding: var(--section-padding) 0;
    background: white;
}

.contact-grid {
    display: grid;
    gap: var(--space-12);
}

@media (min-width: 1024px) {
    .contact-grid {
        grid-template-columns: 1fr 1.2fr;
        gap: var(--space-16);
    }
}

/* Contact Info */
.contact-info h2 {
    font-family: var(--font-display);
    font-size: var(--text-3xl);
    font-weight: 500;
    margin-bottom: var(--space-4);
}

.contact-info > p {
    font-weight: 300;
    color: var(--color-neutral-500);
    line-height: var(--leading-relaxed);
    margin-bottom: var(--space-8);
}

.contact-methods {
    display: flex;
    flex-direction: column;
    gap: var(--space-6);
    margin-bottom: var(--space-10);
}

.contact-method {
    display: flex;
    align-items: flex-start;
    gap: var(--space-4);
}

.contact-method-icon {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--color-cream-200);
    color: var(--color-primary-700);
    flex-shrink: 0;
}

.contact-method h4 {
    font-family: var(--font-display);
    font-size: var(--text-base);
    font-weight: 500;
    margin-bottom: var(--space-1);
}

.contact-method p {
    font-size: var(--text-sm);
    font-weight: 300;
    color: var(--color-neutral-500);
}

.contact-method a {
    color: var(--color-primary-600);
    transition: color var(--transition-fast);
}

.contact-method a:hover {
    color: var(--color-primary-700);
}

/* Social Links */
.contact-social {
    padding-top: var(--space-8);
    border-top: 1px solid var(--color-neutral-200);
}

.contact-social h4 {
    font-family: var(--font-body);
    font-size: var(--text-xs);
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: var(--tracking-widest);
    color: var(--color-neutral-400);
    margin-bottom: var(--space-4);
}

.social-links {
    display: flex;
    gap: var(--space-3);
}

.social-links a {
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--color-cream-100);
    color: var(--color-neutral-600);
    transition: all var(--transition-base);
}

.social-links a:hover {
    background: var(--color-primary-600);
    color: white;
}

/* Contact Form */
.contact-form-wrapper {
    background: var(--color-cream-50);
    padding: var(--space-10);
}

.contact-form {
    display: flex;
    flex-direction: column;
    gap: var(--space-5);
}

.form-row {
    display: grid;
    gap: var(--space-5);
}

@media (min-width: 640px) {
    .form-row {
        grid-template-columns: repeat(2, 1fr);
    }
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: var(--space-2);
}

.form-group label {
    font-size: var(--text-xs);
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: var(--tracking-wider);
    color: var(--color-dark-800);
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: var(--space-4);
    background: white;
    border: 1px solid var(--color-neutral-200);
    font-size: var(--text-base);
    font-weight: 300;
    transition: all var(--transition-fast);
}

.form-group input:focus,
.form-group select:focus,
.form-group textarea:focus {
    outline: none;
    border-color: var(--color-primary-500);
    box-shadow: 0 0 0 3px var(--color-primary-100);
}

.form-group input::placeholder,
.form-group textarea::placeholder {
    color: var(--color-neutral-400);
}

.form-group textarea {
    resize: vertical;
    min-height: 120px;
}

.form-group.full-width {
    grid-column: 1 / -1;
}

.contact-form .btn {
    align-self: flex-start;
}

/* FAQ Section */
.contact-faq {
    padding: var(--section-padding) 0;
    background: var(--color-cream-50);
}

.faq-list {
    max-width: 700px;
    margin: var(--space-12) auto 0;
    display: flex;
    flex-direction: column;
    gap: var(--space-4);
}

.faq-item {
    background: white;
    border: 1px solid var(--color-neutral-200);
    overflow: hidden;
}

.faq-question {
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: var(--space-4);
    padding: var(--space-5) var(--space-6);
    font-family: var(--font-display);
    font-size: var(--text-lg);
    font-weight: 500;
    color: var(--color-dark-900);
    text-align: left;
    background: none;
    border: none;
    cursor: pointer;
    transition: background var(--transition-fast);
}

.faq-question:hover {
    background: var(--color-cream-50);
}

.faq-icon {
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--color-neutral-500);
    flex-shrink: 0;
    transition: all var(--transition-base);
}

.faq-item.is-open .faq-icon {
    transform: rotate(45deg);
    color: var(--color-primary-600);
}

.faq-answer {
    display: none;
    padding: 0 var(--space-6) var(--space-5);
    font-size: var(--text-sm);
    font-weight: 300;
    color: var(--color-neutral-500);
    line-height: var(--leading-relaxed);
}

.faq-item.is-open .faq-answer {
    display: block;
}
</style>

<!-- Hero Section -->
<section class="contact-hero">
    <div class="container">
        <div class="contact-hero-content reveal">
            <span class="text-label">Book Now</span>
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
                            <?php echo ellievated_icon("mail", 22); ?>
                        </div>
                        <div>
                            <h4>Email</h4>
                            <p><a href="mailto:hello@ellievatedbeauty.com">hello@ellievatedbeauty.com</a></p>
                        </div>
                    </div>

                    <div class="contact-method">
                        <div class="contact-method-icon">
                            <?php echo ellievated_icon("phone", 22); ?>
                        </div>
                        <div>
                            <h4>Phone</h4>
                            <p><a href="tel:+1234567890">(123) 456-7890</a></p>
                        </div>
                    </div>

                    <div class="contact-method">
                        <div class="contact-method-icon">
                            <?php echo ellievated_icon("map-pin", 22); ?>
                        </div>
                        <div>
                            <h4>Location</h4>
                            <p>Your City, State</p>
                        </div>
                    </div>

                    <div class="contact-method">
                        <div class="contact-method-icon">
                            <?php echo ellievated_icon("clock", 22); ?>
                        </div>
                        <div>
                            <h4>Hours</h4>
                            <p>By appointment only</p>
                        </div>
                    </div>
                </div>

                <div class="contact-social">
                    <h4>Follow Us</h4>
                    <div class="social-links">
                        <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                            <?php echo ellievated_icon("instagram", 18); ?>
                        </a>
                        <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" aria-label="Facebook">
                            <?php echo ellievated_icon("facebook", 18); ?>
                        </a>
                        <a href="https://tiktok.com" target="_blank" rel="noopener noreferrer" aria-label="TikTok">
                            <?php echo ellievated_icon("tiktok", 18); ?>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Contact Form -->
            <div class="contact-form-wrapper reveal reveal-delay-1">
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
                            <option value="signature-facial">Signature Facial</option>
                            <option value="brow-wax">Brow Wax</option>
                            <option value="brazilian-wax">Brazilian Wax</option>
                            <option value="other">Other / General Question</option>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label for="message">Message</label>
                        <textarea id="message" name="message" placeholder="Tell us about what you're looking for, any skin concerns, or preferred appointment times..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-outline btn-lg">
                        Send Message <?php echo ellievated_icon(
                            "arrow-right",
                        ); ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="contact-faq">
    <div class="container">
        <div class="section-header center reveal">
            <span class="text-label">FAQ</span>
            <h2 class="text-display">Common questions</h2>
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

            <div class="faq-item reveal reveal-delay-1">
                <button class="faq-question">
                    <span>How long does each service take?</span>
                    <span class="faq-icon"><?php echo ellievated_icon(
                        "plus",
                        14,
                    ); ?></span>
                </button>
                <div class="faq-answer">
                    A Signature Facial typically takes 60-75 minutes. A Brow Wax takes about 15-20 minutes. A Brazilian Wax takes approximately 30-45 minutes. Times may vary based on individual needs.
                </div>
            </div>

            <div class="faq-item reveal reveal-delay-2">
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

            <div class="faq-item reveal reveal-delay-3">
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

<?php get_footer(); ?>
