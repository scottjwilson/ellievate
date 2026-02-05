<?php
/**
 * Template Name: Contact Page
 *
 * Contact page template for Fieldcraft Digital.
 *
 * @package Fieldcraft
 */

get_header(); ?>

<style>
/* Contact Page Styles */
.contact-hero {
    position: relative;
    padding: 10rem 0 6rem;
    background: linear-gradient(135deg, var(--color-dark-950) 0%, var(--color-primary-950) 100%);
    color: white;
    overflow: hidden;
}

.contact-hero::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    width: 50%;
    height: 100%;
    background: radial-gradient(ellipse at 80% 50%, rgba(139, 92, 246, 0.2) 0%, transparent 60%);
    pointer-events: none;
}

.contact-hero-content {
    position: relative;
    z-index: 1;
    max-width: 600px;
}

.contact-hero .text-label {
    color: var(--color-accent-400);
    margin-bottom: var(--space-4);
    display: block;
}

.contact-hero h1 {
    font-size: var(--text-hero);
    color: white;
    margin-bottom: var(--space-6);
}

.contact-hero-text {
    font-size: var(--text-xl);
    color: var(--color-dark-300);
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
    font-size: var(--text-3xl);
    margin-bottom: var(--space-4);
}

.contact-info > p {
    color: var(--color-neutral-600);
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
    background: var(--color-primary-100);
    border-radius: var(--radius-xl);
    color: var(--color-primary-600);
    flex-shrink: 0;
}

.contact-method h4 {
    font-size: var(--text-base);
    margin-bottom: var(--space-1);
}

.contact-method p {
    font-size: var(--text-sm);
    color: var(--color-neutral-600);
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
    font-size: var(--text-sm);
    text-transform: uppercase;
    letter-spacing: var(--tracking-wider);
    color: var(--color-neutral-500);
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
    background: var(--color-neutral-100);
    border-radius: var(--radius-lg);
    color: var(--color-neutral-600);
    transition: all var(--transition-base);
}

.social-links a:hover {
    background: var(--color-primary-600);
    color: white;
    transform: translateY(-2px);
}

/* Contact Form */
.contact-form-wrapper {
    background: var(--color-neutral-50);
    padding: var(--space-10);
    border-radius: var(--radius-3xl);
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
    font-size: var(--text-sm);
    font-weight: 500;
    color: var(--color-dark-800);
}

.form-group input,
.form-group select,
.form-group textarea {
    padding: var(--space-4);
    background: white;
    border: 1px solid var(--color-neutral-200);
    border-radius: var(--radius-lg);
    font-size: var(--text-base);
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
    min-height: 150px;
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
    background: var(--color-neutral-50);
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
    border-radius: var(--radius-xl);
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
    font-size: var(--text-base);
    font-weight: 600;
    color: var(--color-dark-900);
    text-align: left;
    background: none;
    border: none;
    cursor: pointer;
    transition: background var(--transition-fast);
}

.faq-question:hover {
    background: var(--color-neutral-50);
}

.faq-icon {
    width: 24px;
    height: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: var(--radius-full);
    border: 1.5px solid var(--color-neutral-300);
    color: var(--color-neutral-500);
    flex-shrink: 0;
    transition: all var(--transition-base);
}

.faq-item.is-open .faq-icon {
    background: var(--color-primary-600);
    border-color: var(--color-primary-600);
    color: white;
    transform: rotate(45deg);
}

.faq-answer {
    display: none;
    padding: 0 var(--space-6) var(--space-5);
    font-size: var(--text-sm);
    color: var(--color-neutral-600);
    line-height: var(--leading-relaxed);
}

.faq-item.is-open .faq-answer {
    display: block;
}

/* Map Section (placeholder) */
.map-section {
    height: 400px;
    background: var(--color-neutral-200);
    position: relative;
}

.map-placeholder {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, var(--color-dark-800) 0%, var(--color-dark-900) 100%);
    color: white;
}

.map-placeholder svg {
    margin-bottom: var(--space-4);
    color: var(--color-primary-400);
}

.map-placeholder p {
    font-size: var(--text-lg);
    color: var(--color-dark-300);
}
</style>

<!-- Hero Section -->
<section class="contact-hero">
    <div class="container">
        <div class="contact-hero-content reveal">
            <span class="text-label">Get in Touch</span>
            <h1>Let's build something great together</h1>
            <p class="contact-hero-text">
                Have a project in mind? We'd love to hear about it. Send us a message and we'll get back to you within 24 hours.
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
                    Whether you have a question about our services, want to discuss a project, or just want to say hello—we're here to help.
                </p>

                <div class="contact-methods">
                    <div class="contact-method">
                        <div class="contact-method-icon">
                            <?php echo fieldcraft_icon("mail", 22); ?>
                        </div>
                        <div>
                            <h4>Email Us</h4>
                            <p><a href="mailto:hello@fieldcraft.digital">hello@fieldcraft.digital</a></p>
                        </div>
                    </div>

                    <div class="contact-method">
                        <div class="contact-method-icon">
                            <?php echo fieldcraft_icon("phone", 22); ?>
                        </div>
                        <div>
                            <h4>Call Us</h4>
                            <p><a href="tel:+1234567890">(123) 456-7890</a></p>
                        </div>
                    </div>

                    <div class="contact-method">
                        <div class="contact-method-icon">
                            <?php echo fieldcraft_icon("map-pin", 22); ?>
                        </div>
                        <div>
                            <h4>Visit Us</h4>
                            <p>123 Design Street<br>San Francisco, CA 94102</p>
                        </div>
                    </div>
                </div>

                <div class="contact-social">
                    <h4>Follow Us</h4>
                    <div class="social-links">
                        <a href="https://twitter.com" target="_blank" rel="noopener noreferrer" aria-label="Twitter">
                            <?php echo fieldcraft_icon("twitter", 18); ?>
                        </a>
                        <a href="https://linkedin.com" target="_blank" rel="noopener noreferrer" aria-label="LinkedIn">
                            <?php echo fieldcraft_icon("linkedin", 18); ?>
                        </a>
                        <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" aria-label="Instagram">
                            <?php echo fieldcraft_icon("instagram", 18); ?>
                        </a>
                        <a href="https://dribbble.com" target="_blank" rel="noopener noreferrer" aria-label="Dribbble">
                            <?php echo fieldcraft_icon("dribbble", 18); ?>
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
                            <input type="text" id="first-name" name="first_name" placeholder="John" required>
                        </div>
                        <div class="form-group">
                            <label for="last-name">Last Name *</label>
                            <input type="text" id="last-name" name="last_name" placeholder="Doe" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="email">Email Address *</label>
                            <input type="email" id="email" name="email" placeholder="john@company.com" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <input type="tel" id="phone" name="phone" placeholder="(123) 456-7890">
                        </div>
                    </div>

                    <div class="form-group full-width">
                        <label for="service">What can we help you with?</label>
                        <select id="service" name="service">
                            <option value="">Select a service...</option>
                            <option value="web-design">Web Design</option>
                            <option value="development">Development</option>
                            <option value="seo">SEO Strategy</option>
                            <option value="marketing">Digital Marketing</option>
                            <option value="branding">Brand Identity</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label for="budget">Estimated Budget</label>
                        <select id="budget" name="budget">
                            <option value="">Select budget range...</option>
                            <option value="5k-10k">$5,000 - $10,000</option>
                            <option value="10k-25k">$10,000 - $25,000</option>
                            <option value="25k-50k">$25,000 - $50,000</option>
                            <option value="50k+">$50,000+</option>
                        </select>
                    </div>

                    <div class="form-group full-width">
                        <label for="message">Tell us about your project *</label>
                        <textarea id="message" name="message" placeholder="Describe your project, goals, and timeline..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-accent btn-lg">
                        Send Message <?php echo fieldcraft_icon("arrow-right"); ?>
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
                    <span>How long does a typical project take?</span>
                    <span class="faq-icon"><?php echo fieldcraft_icon("plus", 14); ?></span>
                </button>
                <div class="faq-answer">
                    Project timelines vary based on scope and complexity. A simple website typically takes 4-6 weeks, while larger projects can take 3-6 months. We'll provide a detailed timeline during our initial consultation.
                </div>
            </div>

            <div class="faq-item reveal reveal-delay-1">
                <button class="faq-question">
                    <span>What is your pricing structure?</span>
                    <span class="faq-icon"><?php echo fieldcraft_icon("plus", 14); ?></span>
                </button>
                <div class="faq-answer">
                    We offer both project-based pricing and retainer arrangements. Every project is unique, so we provide custom quotes based on your specific requirements. We're always transparent about costs upfront.
                </div>
            </div>

            <div class="faq-item reveal reveal-delay-2">
                <button class="faq-question">
                    <span>Do you work with clients remotely?</span>
                    <span class="faq-icon"><?php echo fieldcraft_icon("plus", 14); ?></span>
                </button>
                <div class="faq-answer">
                    Absolutely! We work with clients worldwide. We use modern collaboration tools like Slack, Zoom, and Figma to ensure seamless communication regardless of location.
                </div>
            </div>

            <div class="faq-item reveal reveal-delay-3">
                <button class="faq-question">
                    <span>What happens after the project is complete?</span>
                    <span class="faq-icon"><?php echo fieldcraft_icon("plus", 14); ?></span>
                </button>
                <div class="faq-answer">
                    We provide post-launch support to ensure everything runs smoothly. We also offer ongoing maintenance packages for clients who need regular updates and support.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Map Section -->
<section class="map-section">
    <div class="map-placeholder">
        <?php echo fieldcraft_icon("map-pin", 48); ?>
        <p>San Francisco, California</p>
    </div>
</section>

<?php get_footer(); ?>
