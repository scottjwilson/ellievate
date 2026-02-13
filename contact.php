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
                <button class="faq-question" type="button" aria-expanded="true" aria-controls="faq-1">
                    <span>How do I prepare for my facial appointment?</span>
                    <span class="faq-icon"><?php echo ellievated_icon(
                        "plus",
                        14,
                    ); ?></span>
                </button>
                <div class="faq-answer" id="faq-1">Come with a clean face free of makeup if possible. Avoid retinols or exfoliating products 48 hours before your appointment. Let us know about any skin sensitivities or allergies during your consultation.</div>
            </div>
            <div class="faq-item reveal">
                <button class="faq-question" type="button" aria-expanded="false" aria-controls="faq-2">
                    <span>How long does each service take?</span>
                    <span class="faq-icon"><?php echo ellievated_icon(
                        "plus",
                        14,
                    ); ?></span>
                </button>
                <div class="faq-answer" id="faq-2">A Custom Facial typically takes 60 minutes. A Brow Wax & Shape takes about 15 minutes. A Brazilian Wax takes approximately 30 minutes. Times may vary based on individual needs.</div>
            </div>
            <div class="faq-item reveal">
                <button class="faq-question" type="button" aria-expanded="false" aria-controls="faq-3">
                    <span>What is your cancellation policy?</span>
                    <span class="faq-icon"><?php echo ellievated_icon(
                        "plus",
                        14,
                    ); ?></span>
                </button>
                <div class="faq-answer" id="faq-3">We ask for at least 24 hours notice for cancellations or rescheduling. Late cancellations or no-shows may be subject to a cancellation fee.</div>
            </div>
            <div class="faq-item reveal">
                <button class="faq-question" type="button" aria-expanded="false" aria-controls="faq-4">
                    <span>Is waxing painful?</span>
                    <span class="faq-icon"><?php echo ellievated_icon(
                        "plus",
                        14,
                    ); ?></span>
                </button>
                <div class="faq-answer" id="faq-4">We use premium hard wax and gentle techniques to minimize discomfort. Most clients find the process much more comfortable than expected, especially with regular appointments.</div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>
