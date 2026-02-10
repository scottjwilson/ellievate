<?php
/**
 * Template Name: Contact Page
 *
 * Book Now — Integrated 3-step booking request flow.
 * Step 1: Choose service | Step 2: Pick date & time | Step 3: Your details
 *
 * @package Ellievated
 */

defined("ABSPATH") || exit();

$preselected = isset($_GET["service"])
    ? sanitize_text_field($_GET["service"])
    : "";

get_header();
?>

<style>
/* ═══ BOOK NOW PAGE ═══ */
.book-hero {
    padding: 6.5rem 0 0;
    background: var(--cream);
    text-align: center;
}
.book-hero-content { max-width: 560px; margin: 0 auto; }
.book-hero h1 {
    font-family: var(--font-display);
    font-size: clamp(2rem, 4vw, 2.8rem);
    font-weight: 300; color: var(--ink);
    margin-bottom: 0.5rem; line-height: 1.1;
}
.book-hero h1 em { font-style: italic; }
.book-hero-text {
    font-size: 0.95rem; font-weight: 300;
    color: var(--text-muted); line-height: 1.6;
}

/* ═══ STEP INDICATOR ═══ */
.step-indicator {
    display: flex; align-items: center; justify-content: center;
    gap: 0; padding: 1.5rem 0 2rem; background: var(--cream);
}
.step-item {
    display: flex; align-items: center; gap: 0.6rem;
    opacity: 0.35; transition: opacity 0.4s var(--ease-out);
}
.step-item.active, .step-item.completed { opacity: 1; }
.step-num {
    width: 32px; height: 32px; border-radius: 50%;
    display: flex; align-items: center; justify-content: center;
    font-size: 12px; font-weight: 600;
    border: 1.5px solid var(--sage); color: var(--sage-deep);
    transition: all 0.3s var(--ease-out); flex-shrink: 0;
}
.step-item.active .step-num {
    background: var(--olive); border-color: var(--olive); color: #fff;
}
.step-item.completed .step-num {
    background: var(--sage); border-color: var(--sage); color: #fff;
}
.step-label {
    font-size: 12px; font-weight: 500; text-transform: uppercase;
    letter-spacing: 0.08em; color: var(--ink);
}
.step-line {
    width: 48px; height: 1px; background: var(--border); margin: 0 1rem;
}
@media (max-width: 640px) {
    .step-label { display: none; }
    .step-line { width: 32px; margin: 0 0.5rem; }
}

/* ═══ BOOKING STEPS CONTAINER ═══ */
.booking-steps { background: var(--cream); padding-bottom: var(--section-pad); }
.booking-step {
    display: none;
    animation: fadeUp 0.5s var(--ease-out);
}
.booking-step.step-active { display: block; }

/* ═══ STEP 1: SERVICE PICKER ═══ */
.step-heading {
    font-family: var(--font-body); font-size: 11px; font-weight: 600;
    letter-spacing: 0.2em; text-transform: uppercase;
    color: var(--sage-deep); margin-bottom: 1.25rem; text-align: center;
}
.service-picker-grid {
    display: grid; grid-template-columns: 1fr;
    gap: 1rem;
}
.service-select-card {
    display: flex; align-items: center; gap: 1rem;
    padding: 1.25rem 1.5rem; background: var(--pearl);
    border: 2px solid transparent; cursor: pointer;
    transition: all 0.3s var(--ease-out); position: relative;
}
.service-select-card:hover { border-color: var(--sage-light); }
.service-select-card.selected { border-color: var(--olive); background: white; }
.service-select-card.selected::after {
    content: '✓'; position: absolute; top: 0.6rem; right: 0.75rem;
    width: 22px; height: 22px; display: flex; align-items: center;
    justify-content: center; background: var(--olive); color: white;
    font-size: 11px; border-radius: 50%;
}
.ssc-icon { font-size: 1.75rem; line-height: 1; flex-shrink: 0; }
.ssc-info { flex: 1; }
.ssc-name {
    font-family: var(--font-display); font-size: 1.1rem;
    font-weight: 400; color: var(--ink); margin-bottom: 0.15rem;
}
.ssc-meta { font-size: 12px; color: var(--text-muted); }
.ssc-meta strong { color: var(--ink); font-weight: 500; }

/* ═══ STEP 2: CALENDAR & TIME ═══ */
.calendar-panel {
    background: var(--pearl); padding: clamp(1.5rem, 3vw, 2.5rem);
    max-width: 480px; margin: 0 auto;
}
.cal-header {
    display: flex; align-items: center; justify-content: space-between;
    margin-bottom: 1.5rem;
}
.cal-title {
    font-family: var(--font-display); font-size: 1.3rem;
    font-weight: 400; color: var(--ink);
}
.cal-nav {
    width: 36px; height: 36px; display: flex; align-items: center;
    justify-content: center; border-radius: 50%; color: var(--text-muted);
    transition: all 0.2s var(--ease-out); cursor: pointer;
}
.cal-nav:hover { background: var(--cream); color: var(--olive); }
.cal-grid {
    display: grid; grid-template-columns: repeat(7, 1fr); gap: 4px;
    text-align: center;
}
.cal-day-name {
    font-size: 10px; font-weight: 600; text-transform: uppercase;
    letter-spacing: 0.1em; color: var(--text-muted); padding: 0.4rem 0;
}
.cal-day {
    width: 100%; aspect-ratio: 1; display: flex; align-items: center;
    justify-content: center; font-size: 13px; font-weight: 400;
    color: var(--ink); border-radius: 50%; cursor: pointer;
    transition: all 0.2s var(--ease-out);
}
.cal-day:hover:not(.cal-disabled):not(.cal-empty) { background: var(--sage-light); color: var(--ink); }
.cal-day.cal-today { border: 1.5px solid var(--sage); }
.cal-day.cal-selected { background: var(--olive); color: #fff; font-weight: 500; }
.cal-day.cal-disabled { color: var(--warm-linen); cursor: default; pointer-events: none; }
.cal-day.cal-empty { cursor: default; pointer-events: none; }

/* Time Slots */
.time-slots-section {
    margin-top: 2rem; max-width: 480px; margin-left: auto; margin-right: auto;
}
.time-slots-label {
    font-size: 11px; font-weight: 600; text-transform: uppercase;
    letter-spacing: 0.15em; color: var(--sage-deep); margin-bottom: 1rem;
    text-align: center;
}
.time-slots-grid {
    display: grid; grid-template-columns: repeat(auto-fill, minmax(90px, 1fr));
    gap: 0.5rem;
}
.time-slot {
    padding: 0.6rem 0.5rem; text-align: center; font-size: 12px;
    font-weight: 500; color: var(--ink); background: var(--pearl);
    border: 1.5px solid var(--border); border-radius: 100px;
    cursor: pointer; transition: all 0.25s var(--ease-out);
}
.time-slot:hover { border-color: var(--sage); background: var(--cream); }
.time-slot.selected { background: var(--olive); color: #fff; border-color: var(--olive); }
.time-slot.booked {
    opacity: 0.35; text-decoration: line-through;
    pointer-events: none; cursor: default;
}
.time-slots-loading {
    text-align: center; padding: 2rem; color: var(--text-muted);
    font-size: 14px;
}

/* ═══ STEP 3: REVIEW + SUMMARY ═══ */
.booking-summary {
    background: var(--pearl); padding: 2rem;
}
.summary-title {
    font-size: 11px; font-weight: 600; text-transform: uppercase;
    letter-spacing: 0.15em; color: var(--sage-deep); margin-bottom: 1.5rem;
}
.summary-service {
    display: flex; align-items: center; gap: 0.75rem;
    padding-bottom: 1.25rem; margin-bottom: 1.25rem;
    border-bottom: 1px solid var(--border);
}
.summary-service-icon { font-size: 1.5rem; }
.summary-service-name {
    font-family: var(--font-display); font-size: 1.15rem;
    font-weight: 400; color: var(--ink);
}
.summary-service-price {
    font-size: 12px; color: var(--text-muted);
}
.summary-row {
    display: flex; justify-content: space-between; align-items: center;
    padding: 0.6rem 0; font-size: 13px;
}
.summary-row-label { color: var(--text-muted); font-weight: 400; }
.summary-row-value { color: var(--ink); font-weight: 500; }
.summary-total {
    display: flex; justify-content: space-between; align-items: center;
    padding-top: 1.25rem; margin-top: 1.25rem;
    border-top: 1px solid var(--border);
}
.summary-total-label {
    font-size: 12px; font-weight: 500; text-transform: uppercase;
    letter-spacing: 0.08em; color: var(--text-muted);
}
.summary-total-value {
    font-family: var(--font-display); font-size: 1.5rem;
    font-weight: 400; color: var(--ink);
}

.booking-summary-centered {
    max-width: 480px; margin: 0 auto;
}
.book-checkout-error {
    max-width: 480px; margin: 1rem auto 0;
    padding: 0.875rem 1.25rem; background: #fef2f2;
    border: 1px solid #fca5a5; color: #991b1b;
    font-size: 14px; text-align: center;
}

/* Step Navigation */
.step-nav {
    display: flex; align-items: center; justify-content: space-between;
    margin-top: 2rem;
}
.step-nav:not(:has(.step-back)) .step-next { width: 100%; }
.step-back {
    display: inline-flex; align-items: center; gap: 0.4rem;
    font-size: 12px; font-weight: 500; text-transform: uppercase;
    letter-spacing: 0.08em; color: var(--text-muted);
    cursor: pointer; transition: color 0.3s var(--ease-out);
    background: none; border: none;
}
.step-back:hover { color: var(--olive); }
.step-back svg { transform: rotate(180deg); }
.step-next {
    margin-left: auto;
}

/* ═══ SUCCESS ═══ */
.book-success {
    max-width: 580px; margin: 0 auto; text-align: center; padding: 3rem 2rem;
}
.book-success-icon {
    width: 64px; height: 64px; display: flex; align-items: center;
    justify-content: center; background: var(--sage); color: white;
    border-radius: 50%; margin: 0 auto 1.5rem; font-size: 28px;
}
.book-success h2 {
    font-family: var(--font-display); font-size: clamp(1.8rem, 3vw, 2.2rem);
    font-weight: 300; color: var(--ink); margin-bottom: 1rem;
}
.book-success p {
    font-size: 15px; color: var(--text-muted); line-height: 1.7; margin-bottom: 0.5rem;
}
.book-success .btn-primary { margin-top: 2rem; }

.book-error {
    background: rgba(201,169,152,0.15); border-left: 3px solid var(--rose);
    padding: 1rem 1.25rem; margin-bottom: 1.5rem; font-size: 14px; color: var(--ink);
}

/* ═══ CONTACT STRIP ═══ */
.book-contact-strip { padding: var(--section-pad) 0; background: var(--pearl); }
.contact-strip-grid {
    display: flex; flex-wrap: wrap; justify-content: center;
    gap: 2.5rem 3rem; text-align: center;
}
.contact-strip-item {
    min-width: 180px;
}
.contact-strip-icon {
    width: 44px; height: 44px; display: flex; align-items: center;
    justify-content: center; background: var(--cream); color: var(--olive);
    border-radius: 50%; margin: 0 auto 0.75rem;
}
.contact-strip-label {
    font-size: 0.7rem; font-weight: 500; text-transform: uppercase;
    letter-spacing: 0.1em; color: var(--text-muted); margin-bottom: 0.25rem;
}
.contact-strip-value { font-size: 0.95rem; font-weight: 400; color: var(--ink); }
.contact-strip-value a {
    color: var(--olive); text-decoration: none;
    transition: color 0.3s var(--ease-out);
}
.contact-strip-value a:hover { color: var(--forest); }

/* ═══ FAQ ═══ */
.book-faq { padding: var(--section-pad) 0; background: var(--cream); }
.book-faq .section-label, .book-faq .section-title { text-align: center; }
.faq-list {
    max-width: 700px; margin: 3rem auto 0;
    display: flex; flex-direction: column; gap: 1rem;
}
.faq-item { background: var(--pearl); border: 1px solid var(--border); overflow: hidden; }
.faq-question {
    width: 100%; display: flex; align-items: center;
    justify-content: space-between; gap: 1rem;
    padding: 1.25rem 1.5rem; font-family: var(--font-display);
    font-size: 1.15rem; font-weight: 500; color: var(--ink);
    text-align: left; background: none; border: none;
    cursor: pointer; transition: background 0.3s var(--ease-out);
}
.faq-question:hover { background: var(--cream); }
.faq-icon {
    width: 24px; height: 24px; display: flex; align-items: center;
    justify-content: center; color: var(--text-muted); flex-shrink: 0;
    transition: all 0.3s var(--ease-out);
}
.faq-item.is-open .faq-icon { transform: rotate(45deg); color: var(--olive); }
.faq-answer {
    display: none; padding: 0 1.5rem 1.25rem;
    font-size: 0.9rem; font-weight: 300;
    color: var(--text-muted); line-height: 1.7;
}
.faq-item.is-open .faq-answer { display: block; }
</style>

<!-- Hero -->
<section class="book-hero">
    <div class="container">
        <div class="book-hero-content reveal">
            <h1>Let's get you <em>glowing</em></h1>
            <p class="book-hero-text">Choose your service, pick a time that works, and we'll take care of the rest.</p>
        </div>
    </div>
</section>

<!-- Step Indicator -->
<div class="step-indicator" id="stepIndicator">
    <div class="step-item active" data-step="1">
        <span class="step-num">1</span>
        <span class="step-label">Service</span>
    </div>
    <div class="step-line"></div>
    <div class="step-item" data-step="2">
        <span class="step-num">2</span>
        <span class="step-label">Date & Time</span>
    </div>
    <div class="step-line"></div>
    <div class="step-item" data-step="3">
        <span class="step-num">3</span>
        <span class="step-label">Review</span>
    </div>
</div>

<!-- Booking Steps -->
<section class="booking-steps">
    <div class="container">
        <div id="bookingForm">

            <!-- STEP 1: Choose Service -->
            <div class="booking-step step-active" data-step="1" id="step1">
                <p class="step-heading">Choose your service</p>
                <div class="service-picker-grid">
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
                            $icon = get_post_meta(
                                get_the_ID(),
                                "_service_icon",
                                true,
                            );
                            $selected =
                                $preselected === $slug ? " selected" : "";
                            ?>
                        <div class="service-select-card<?php echo $selected; ?>"
                             data-slug="<?php echo esc_attr($slug); ?>"
                             data-product-id="<?php echo esc_attr(
                                 get_the_ID(),
                             ); ?>"
                             data-name="<?php echo esc_attr(
                                 get_the_title(),
                             ); ?>"
                             data-price="<?php echo esc_attr(
                                 $product->get_price(),
                             ); ?>"
                             data-duration="<?php echo esc_attr($duration); ?>"
                             data-icon="<?php echo esc_attr($icon); ?>">
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
                                        &middot; <?php echo esc_html(
                                            $duration,
                                        ); ?>
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
                <div class="step-nav">
                    <div></div>
                    <button type="button" class="btn-primary step-next" id="toStep2">Continue</button>
                </div>
            </div>

            <!-- STEP 2: Date & Time -->
            <div class="booking-step" data-step="2" id="step2">
                <div class="calendar-panel">
                    <div class="cal-header">
                        <button type="button" class="cal-nav" id="calPrev"><?php echo ellievated_icon(
                            "arrow-right",
                            16,
                        ); ?></button>
                        <span class="cal-title" id="calTitle"></span>
                        <button type="button" class="cal-nav" id="calNext"><?php echo ellievated_icon(
                            "arrow-right",
                            16,
                        ); ?></button>
                    </div>
                    <div class="cal-grid" id="calGrid"></div>
                </div>

                <div class="time-slots-section" id="timeSlotsSection" style="display:none;">
                    <p class="time-slots-label">Choose a time</p>
                    <div class="time-slots-grid" id="timeSlotsGrid"></div>
                </div>

                <div class="step-nav">
                    <button type="button" class="step-back" id="backToStep1">
                        <?php echo ellievated_icon("arrow-right", 14); ?>
                        Back
                    </button>
                    <button type="button" class="btn-primary step-next" id="toStep3">Continue</button>
                </div>
            </div>

            <!-- STEP 3: Review & Checkout -->
            <div class="booking-step" data-step="3" id="step3">
                <div class="booking-summary booking-summary-centered" id="bookingSummary">
                    <p class="summary-title">Booking Summary</p>
                    <div class="summary-service">
                        <span class="summary-service-icon" id="summaryIcon"></span>
                        <div>
                            <div class="summary-service-name" id="summaryName">—</div>
                            <div class="summary-service-price" id="summaryDuration">—</div>
                        </div>
                    </div>
                    <div class="summary-row">
                        <span class="summary-row-label">Date</span>
                        <span class="summary-row-value" id="summaryDate">—</span>
                    </div>
                    <div class="summary-row">
                        <span class="summary-row-label">Time</span>
                        <span class="summary-row-value" id="summaryTime">—</span>
                    </div>
                    <div class="summary-total">
                        <span class="summary-total-label">Total</span>
                        <span class="summary-total-value" id="summaryPrice">—</span>
                    </div>
                </div>

                <div class="book-checkout-error" id="checkoutError" style="display:none;"></div>

                <div class="step-nav">
                    <button type="button" class="step-back" id="backToStep2">
                        <?php echo ellievated_icon("arrow-right", 14); ?>
                        Back
                    </button>
                    <button type="button" class="btn-primary step-next" id="proceedToCheckout">Proceed to Checkout</button>
                </div>
            </div>
        </div>
    </div>
</section>

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
                <p class="contact-strip-value"><a href="tel:+16614588040">(661) 458-8040</a></p>
            </div>
            <div class="contact-strip-item">
                <div class="contact-strip-icon"><?php echo ellievated_icon(
                    "map-pin",
                    20,
                ); ?></div>
                <p class="contact-strip-label">Location</p>
                <p class="contact-strip-value">Bakersfield, CA</p>
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
                <button class="faq-question" type="button">
                    <span>How do I prepare for my facial appointment?</span>
                    <span class="faq-icon"><?php echo ellievated_icon(
                        "plus",
                        14,
                    ); ?></span>
                </button>
                <div class="faq-answer">Come with a clean face free of makeup if possible. Avoid retinols or exfoliating products 48 hours before your appointment. Let us know about any skin sensitivities or allergies during your consultation.</div>
            </div>
            <div class="faq-item reveal">
                <button class="faq-question" type="button">
                    <span>How long does each service take?</span>
                    <span class="faq-icon"><?php echo ellievated_icon(
                        "plus",
                        14,
                    ); ?></span>
                </button>
                <div class="faq-answer">A Custom Facial typically takes 60 minutes. A Brow Wax & Shape takes about 15 minutes. A Brazilian Wax takes approximately 30 minutes. Times may vary based on individual needs.</div>
            </div>
            <div class="faq-item reveal">
                <button class="faq-question" type="button">
                    <span>What is your cancellation policy?</span>
                    <span class="faq-icon"><?php echo ellievated_icon(
                        "plus",
                        14,
                    ); ?></span>
                </button>
                <div class="faq-answer">We ask for at least 24 hours notice for cancellations or rescheduling. Late cancellations or no-shows may be subject to a cancellation fee.</div>
            </div>
            <div class="faq-item reveal">
                <button class="faq-question" type="button">
                    <span>Is waxing painful?</span>
                    <span class="faq-icon"><?php echo ellievated_icon(
                        "plus",
                        14,
                    ); ?></span>
                </button>
                <div class="faq-answer">We use premium hard wax and gentle techniques to minimize discomfort. Most clients find the process much more comfortable than expected, especially with regular appointments.</div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
