<?php
/**
 * Template Name: Contact Page
 *
 * Book Now / Contact page for Ellievated Beauty.
 * Handles service booking requests via wp_mail().
 *
 * @package Ellievated
 */

defined("ABSPATH") || exit();

$booking_success = false;
$booking_error = "";
$preselected = isset($_GET["service"])
    ? sanitize_text_field($_GET["service"])
    : "";

// Handle form submission
if (
    $_SERVER["REQUEST_METHOD"] === "POST" &&
    isset($_POST["ellievated_booking_nonce"])
) {
    if (
        !wp_verify_nonce(
            $_POST["ellievated_booking_nonce"],
            "ellievated_booking_submit",
        )
    ) {
        $booking_error = "Security check failed. Please try again.";
    } else {
        $first_name = sanitize_text_field($_POST["first_name"] ?? "");
        $last_name = sanitize_text_field($_POST["last_name"] ?? "");
        $email = sanitize_email($_POST["email"] ?? "");
        $phone = sanitize_text_field($_POST["phone"] ?? "");
        $service = sanitize_text_field($_POST["service"] ?? "");
        $pref_date = sanitize_text_field($_POST["preferred_date"] ?? "");
        $pref_time = sanitize_text_field($_POST["preferred_time"] ?? "");
        $message = sanitize_textarea_field($_POST["message"] ?? "");

        // Validate required fields
        if (empty($first_name) || empty($email) || empty($service)) {
            $booking_error =
                "Please fill in your name, email, and select a service.";
        } elseif (!is_email($email)) {
            $booking_error = "Please enter a valid email address.";
        } else {
            // Look up service name from slug
            $service_name = $service;
            $service_post = get_page_by_path($service, OBJECT, "product");
            if ($service_post) {
                $service_name = $service_post->post_title;
                $product = wc_get_product($service_post->ID);
                $service_price = $product ? '$' . $product->get_price() : "";
            }

            $to = get_option("admin_email");
            $subject =
                "New Booking Request: " .
                $service_name .
                " — " .
                $first_name .
                " " .
                $last_name;

            $body = "New booking request from your website:\n\n";
            $body .= "━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
            $body .= "SERVICE: {$service_name}";
            if (!empty($service_price)) {
                $body .= " ({$service_price})";
            }
            $body .= "\n━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n\n";
            $body .= "Name: {$first_name} {$last_name}\n";
            $body .= "Email: {$email}\n";
            if (!empty($phone)) {
                $body .= "Phone: {$phone}\n";
            }
            if (!empty($pref_date)) {
                $body .= "Preferred Date: {$pref_date}\n";
            }
            if (!empty($pref_time)) {
                $body .= "Preferred Time: {$pref_time}\n";
            }
            if (!empty($message)) {
                $body .= "\nMessage:\n{$message}\n";
            }

            $headers = [
                "Reply-To: " .
                $first_name .
                " " .
                $last_name .
                " <" .
                $email .
                ">",
            ];

            if (wp_mail($to, $subject, $body, $headers)) {
                $booking_success = true;
            } else {
                $booking_error =
                    "Something went wrong sending your request. Please try calling or emailing us directly.";
            }
        }
    }
}

get_header();
?>

<style>
/* Book Now Page */
.book-hero {
    padding: 10rem 0 4rem;
    background: var(--cream);
    text-align: center;
}
.book-hero-content {
    max-width: 560px;
    margin: 0 auto;
}
.book-hero h1 {
    font-family: var(--font-display);
    font-size: clamp(2.8rem, 5vw, 4rem);
    font-weight: 300;
    color: var(--ink);
    margin-bottom: 1rem;
    line-height: 1.1;
}
.book-hero h1 em { font-style: italic; }
.book-hero-text {
    font-size: 1.05rem;
    font-weight: 300;
    color: var(--text-muted);
    line-height: 1.7;
}

/* Service Picker */
.service-picker {
    padding: 3rem 0 var(--section-pad);
    background: var(--cream);
}
.service-picker-label {
    font-family: var(--font-body);
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--sage-deep);
    margin-bottom: 1.25rem;
    text-align: center;
}
.service-picker-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 1rem;
    max-width: 820px;
    margin: 0 auto;
}
.service-select-card {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1.25rem 1.5rem;
    background: var(--pearl);
    border: 2px solid transparent;
    cursor: pointer;
    transition: all 0.3s var(--ease-out);
    position: relative;
}
.service-select-card:hover {
    border-color: var(--sage-light);
}
.service-select-card.selected {
    border-color: var(--olive);
    background: white;
}
.service-select-card.selected::after {
    content: '✓';
    position: absolute;
    top: 0.6rem;
    right: 0.75rem;
    width: 22px;
    height: 22px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--olive);
    color: white;
    font-size: 11px;
    border-radius: 50%;
}
.ssc-icon {
    font-size: 1.75rem;
    line-height: 1;
    flex-shrink: 0;
}
.ssc-info { flex: 1; }
.ssc-name {
    font-family: var(--font-display);
    font-size: 1.1rem;
    font-weight: 400;
    color: var(--ink);
    margin-bottom: 0.15rem;
}
.ssc-meta {
    font-size: 12px;
    color: var(--text-muted);
}
.ssc-meta strong {
    color: var(--ink);
    font-weight: 500;
}

/* Booking Form */
.book-form-section {
    padding: 0 0 var(--section-pad);
    background: var(--cream);
}
.book-form-wrapper {
    max-width: 680px;
    margin: 0 auto;
    background: var(--pearl);
    padding: clamp(2rem, 4vw, 3rem);
}
.book-form-title {
    font-family: var(--font-display);
    font-size: clamp(1.5rem, 3vw, 1.8rem);
    font-weight: 400;
    color: var(--ink);
    margin-bottom: 0.5rem;
}
.book-form-subtitle {
    font-size: 14px;
    color: var(--text-muted);
    margin-bottom: 2rem;
    line-height: 1.6;
}
.book-form {
    display: flex;
    flex-direction: column;
    gap: 1.25rem;
}
.form-row {
    display: grid;
    gap: 1.25rem;
}
@media (min-width: 640px) {
    .form-row { grid-template-columns: repeat(2, 1fr); }
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
    min-height: 100px;
}
.form-group.full-width {
    grid-column: 1 / -1;
}
.selected-service-display {
    display: none;
    align-items: center;
    gap: 0.75rem;
    padding: 0.875rem 1rem;
    background: var(--cream);
    border: 1px solid var(--olive);
    font-size: 0.95rem;
    color: var(--ink);
}
.selected-service-display.has-service {
    display: flex;
}
.selected-service-display .ssd-name {
    font-weight: 500;
}
.selected-service-display .ssd-change {
    margin-left: auto;
    font-size: 11px;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.08em;
    color: var(--olive);
    cursor: pointer;
    transition: color 0.3s var(--ease-out);
}
.selected-service-display .ssd-change:hover {
    color: var(--forest);
}

/* Success Message */
.book-success {
    max-width: 580px;
    margin: 0 auto;
    text-align: center;
    padding: 3rem 2rem;
}
.book-success-icon {
    width: 64px;
    height: 64px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--sage);
    color: white;
    border-radius: 50%;
    margin: 0 auto 1.5rem;
    font-size: 28px;
}
.book-success h2 {
    font-family: var(--font-display);
    font-size: clamp(1.8rem, 3vw, 2.2rem);
    font-weight: 300;
    color: var(--ink);
    margin-bottom: 1rem;
}
.book-success p {
    font-size: 15px;
    color: var(--text-muted);
    line-height: 1.7;
    margin-bottom: 0.5rem;
}
.book-success .btn-primary {
    margin-top: 2rem;
}

/* Error Message */
.book-error {
    background: rgba(201,169,152,0.15);
    border-left: 3px solid var(--rose);
    padding: 1rem 1.25rem;
    margin-bottom: 1.5rem;
    font-size: 14px;
    color: var(--ink);
}

/* Contact Info Strip */
.book-contact-strip {
    padding: var(--section-pad) 0;
    background: var(--pearl);
}
.contact-strip-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 2rem;
    text-align: center;
}
.contact-strip-item {}
.contact-strip-icon {
    width: 44px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--cream);
    color: var(--olive);
    border-radius: 50%;
    margin: 0 auto 0.75rem;
}
.contact-strip-label {
    font-size: 0.7rem;
    font-weight: 500;
    text-transform: uppercase;
    letter-spacing: 0.1em;
    color: var(--text-muted);
    margin-bottom: 0.25rem;
}
.contact-strip-value {
    font-size: 0.95rem;
    font-weight: 400;
    color: var(--ink);
}
.contact-strip-value a {
    color: var(--olive);
    text-decoration: none;
    transition: color 0.3s var(--ease-out);
}
.contact-strip-value a:hover {
    color: var(--forest);
}

/* FAQ */
.book-faq {
    padding: var(--section-pad) 0;
    background: var(--cream);
}
.book-faq .section-label,
.book-faq .section-title {
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
    background: var(--pearl);
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
    background: var(--cream);
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
</style>

<!-- Hero -->
<section class="book-hero">
    <div class="container">
        <div class="book-hero-content reveal">
            <span class="section-label">Book Now</span>
            <h1>Let's get you <em>glowing</em></h1>
            <p class="book-hero-text">Choose your service, pick a time that works, and we'll take care of the rest.</p>
        </div>
    </div>
</section>

<?php if ($booking_success): ?>

<!-- Success -->
<section style="padding: var(--section-pad) 0; background: var(--cream);">
    <div class="container">
        <div class="book-success reveal">
            <div class="book-success-icon"><?php echo ellievated_icon(
                "check",
                28,
            ); ?></div>
            <h2>Request received!</h2>
            <p>Thank you for booking with Ellievated Beauty. We'll confirm your appointment within 24 hours.</p>
            <p>Check your email for a confirmation shortly.</p>
            <a href="<?php echo esc_url(
                home_url("/"),
            ); ?>" class="btn-primary">Back to Home</a>
        </div>
    </div>
</section>

<?php else: ?>

<!-- Service Picker -->
<section class="service-picker" id="pick-service">
    <div class="container">
        <p class="service-picker-label">1. Choose your service</p>
        <div class="service-picker-grid reveal-stagger">
            <?php
            $services = ellievated_get_services();
            if ($services->have_posts()):
                while ($services->have_posts()):

                    $services->the_post();
                    $product = wc_get_product(get_the_ID());
                    $slug = get_post_field("post_name");
                    $duration = get_post_meta(
                        get_the_ID(),
                        "_service_duration",
                        true,
                    );
                    $icon = get_post_meta(get_the_ID(), "_service_icon", true);
                    $selected = $preselected === $slug ? " selected" : "";
                    ?>
                <div class="service-select-card<?php echo $selected; ?>"
                     data-slug="<?php echo esc_attr($slug); ?>"
                     data-name="<?php echo esc_attr(get_the_title()); ?>">
                    <?php if ($icon): ?>
                        <div class="ssc-icon"><?php echo $icon; ?></div>
                    <?php endif; ?>
                    <div class="ssc-info">
                        <div class="ssc-name"><?php the_title(); ?></div>
                        <div class="ssc-meta">
                            <strong>$<?php echo esc_html(
                                $product->get_price(),
                            ); ?></strong>
                            <?php if ($duration): ?>
                                &middot; <?php echo esc_html($duration); ?>
                            <?php endif; ?>
                        </div>
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

<!-- Booking Form -->
<section class="book-form-section" id="booking-form">
    <div class="container">
        <div class="book-form-wrapper reveal">
            <h2 class="book-form-title">2. Your details</h2>
            <p class="book-form-subtitle">Fill out the form below and we'll confirm your appointment within 24 hours.</p>

            <?php if ($booking_error): ?>
                <div class="book-error"><?php echo esc_html(
                    $booking_error,
                ); ?></div>
            <?php endif; ?>

            <form class="book-form" method="post" action="<?php echo esc_url(
                get_permalink(),
            ); ?>">
                <?php wp_nonce_field(
                    "ellievated_booking_submit",
                    "ellievated_booking_nonce",
                ); ?>
                <input type="hidden" name="service" id="selected-service" value="<?php echo esc_attr(
                    $preselected,
                ); ?>">

                <!-- Selected service display -->
                <div class="selected-service-display<?php echo $preselected
                    ? " has-service"
                    : ""; ?>" id="service-display">
                    <span class="ssd-name" id="service-display-name">
                        <?php if ($preselected) {
                            $sp = get_page_by_path(
                                $preselected,
                                OBJECT,
                                "product",
                            );
                            if ($sp) {
                                echo esc_html($sp->post_title);
                            }
                        } ?>
                    </span>
                    <span class="ssd-change" id="service-change">Change</span>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="first-name">First Name *</label>
                        <input type="text" id="first-name" name="first_name"
                               placeholder="Your first name"
                               value="<?php echo isset($_POST["first_name"])
                                   ? esc_attr($_POST["first_name"])
                                   : ""; ?>"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="last-name">Last Name</label>
                        <input type="text" id="last-name" name="last_name"
                               placeholder="Your last name"
                               value="<?php echo isset($_POST["last_name"])
                                   ? esc_attr($_POST["last_name"])
                                   : ""; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email *</label>
                        <input type="email" id="email" name="email"
                               placeholder="your@email.com"
                               value="<?php echo isset($_POST["email"])
                                   ? esc_attr($_POST["email"])
                                   : ""; ?>"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="tel" id="phone" name="phone"
                               placeholder="(123) 456-7890"
                               value="<?php echo isset($_POST["phone"])
                                   ? esc_attr($_POST["phone"])
                                   : ""; ?>">
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="preferred-date">Preferred Date</label>
                        <input type="date" id="preferred-date" name="preferred_date"
                               value="<?php echo isset($_POST["preferred_date"])
                                   ? esc_attr($_POST["preferred_date"])
                                   : ""; ?>">
                    </div>
                    <div class="form-group">
                        <label for="preferred-time">Preferred Time</label>
                        <select id="preferred-time" name="preferred_time">
                            <option value="">Select a time...</option>
                            <option value="morning"<?php echo isset(
                                $_POST["preferred_time"],
                            ) && $_POST["preferred_time"] === "morning"
                                ? " selected"
                                : ""; ?>>Morning (9am – 12pm)</option>
                            <option value="afternoon"<?php echo isset(
                                $_POST["preferred_time"],
                            ) && $_POST["preferred_time"] === "afternoon"
                                ? " selected"
                                : ""; ?>>Afternoon (12pm – 4pm)</option>
                            <option value="evening"<?php echo isset(
                                $_POST["preferred_time"],
                            ) && $_POST["preferred_time"] === "evening"
                                ? " selected"
                                : ""; ?>>Evening (4pm – 7pm)</option>
                        </select>
                    </div>
                </div>

                <div class="form-group full-width">
                    <label for="message">Notes <span style="font-weight:300; text-transform:none; letter-spacing:0; font-size:12px; color:var(--text-muted);">(optional)</span></label>
                    <textarea id="message" name="message" placeholder="Any skin concerns, allergies, or preferences we should know about..."><?php echo isset(
                        $_POST["message"],
                    )
                        ? esc_textarea($_POST["message"])
                        : ""; ?></textarea>
                </div>

                <button type="submit" class="btn-primary">
                    Request Appointment
                </button>
            </form>
        </div>
    </div>
</section>

<?php endif; ?>

<!-- Contact Info -->
<section class="book-contact-strip">
    <div class="container">
        <div class="contact-strip-grid reveal-stagger">
            <div class="contact-strip-item">
                <div class="contact-strip-icon"><?php echo ellievated_icon(
                    "mail",
                    20,
                ); ?></div>
                <p class="contact-strip-label">Email</p>
                <p class="contact-strip-value"><a href="mailto:hello@ellievatedbeauty.com">hello@ellievatedbeauty.com</a></p>
            </div>
            <div class="contact-strip-item">
                <div class="contact-strip-icon"><?php echo ellievated_icon(
                    "phone",
                    20,
                ); ?></div>
                <p class="contact-strip-label">Phone</p>
                <p class="contact-strip-value"><a href="tel:+1234567890">(123) 456-7890</a></p>
            </div>
            <div class="contact-strip-item">
                <div class="contact-strip-icon"><?php echo ellievated_icon(
                    "map-pin",
                    20,
                ); ?></div>
                <p class="contact-strip-label">Location</p>
                <p class="contact-strip-value">Your City, State</p>
            </div>
            <div class="contact-strip-item">
                <div class="contact-strip-icon"><?php echo ellievated_icon(
                    "clock",
                    20,
                ); ?></div>
                <p class="contact-strip-label">Hours</p>
                <p class="contact-strip-value">By appointment only</p>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="book-faq">
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

<?php get_footer(); ?>
