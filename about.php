<?php
/**
 * Template Name: About Page
 *
 * About page template for Fieldcraft Digital.
 *
 * @package Fieldcraft
 */

get_header(); ?>

<style>
/* About Page Styles */
.about-hero {
    position: relative;
    padding: 10rem 0 6rem;
    background: linear-gradient(135deg, var(--color-dark-950) 0%, var(--color-primary-950) 100%);
    color: white;
    overflow: hidden;
}

.about-hero::before {
    content: "";
    position: absolute;
    top: 0;
    right: 0;
    width: 60%;
    height: 100%;
    background: radial-gradient(ellipse at 70% 50%, rgba(139, 92, 246, 0.2) 0%, transparent 60%);
    pointer-events: none;
}

.about-hero-content {
    position: relative;
    z-index: 1;
    max-width: 700px;
}

.about-hero .text-label {
    color: var(--color-accent-400);
    margin-bottom: var(--space-4);
    display: block;
}

.about-hero h1 {
    font-size: var(--text-hero);
    color: white;
    margin-bottom: var(--space-6);
}

.about-hero-text {
    font-size: var(--text-xl);
    color: var(--color-dark-300);
    line-height: var(--leading-relaxed);
}

/* Story Section */
.story-section {
    padding: var(--section-padding) 0;
    background: white;
}

.story-grid {
    display: grid;
    gap: var(--space-12);
    align-items: center;
}

@media (min-width: 1024px) {
    .story-grid {
        grid-template-columns: 1fr 1fr;
        gap: var(--space-16);
    }
}

.story-image {
    border-radius: var(--radius-3xl);
    overflow: hidden;
}

.story-image img {
    width: 100%;
    aspect-ratio: 4/3;
    object-fit: cover;
}

.story-content .text-display {
    margin-bottom: var(--space-6);
}

.story-content p {
    color: var(--color-neutral-600);
    line-height: var(--leading-loose);
    margin-bottom: var(--space-4);
}

.story-content p:last-of-type {
    margin-bottom: 0;
}

/* Values Section */
.values-section {
    padding: var(--section-padding) 0;
    background: var(--color-neutral-50);
}

.values-grid {
    display: grid;
    gap: var(--space-6);
    margin-top: var(--space-12);
}

@media (min-width: 768px) {
    .values-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 1024px) {
    .values-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

.value-card {
    background: white;
    padding: var(--space-8);
    border-radius: var(--radius-2xl);
    border: 1px solid var(--color-neutral-200);
}

.value-icon {
    width: 48px;
    height: 48px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: var(--color-primary-100);
    border-radius: var(--radius-xl);
    color: var(--color-primary-600);
    margin-bottom: var(--space-5);
}

.value-card h3 {
    font-size: var(--text-lg);
    margin-bottom: var(--space-3);
}

.value-card p {
    font-size: var(--text-sm);
    color: var(--color-neutral-600);
    line-height: var(--leading-relaxed);
}

/* Team Section */
.team-section {
    padding: var(--section-padding) 0;
    background: white;
}

.team-grid {
    display: grid;
    gap: var(--space-8);
    margin-top: var(--space-12);
}

@media (min-width: 640px) {
    .team-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

@media (min-width: 1024px) {
    .team-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

.team-member {
    text-align: center;
}

.team-photo {
    position: relative;
    border-radius: var(--radius-2xl);
    overflow: hidden;
    margin-bottom: var(--space-4);
    aspect-ratio: 3/4;
    background: var(--color-neutral-100);
}

.team-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform var(--duration-slow) var(--ease-out);
}

.team-member:hover .team-photo img {
    transform: scale(1.05);
}

.team-social {
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    display: flex;
    justify-content: center;
    gap: var(--space-2);
    padding: var(--space-4);
    background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
    opacity: 0;
    transform: translateY(10px);
    transition: all var(--transition-base);
}

.team-member:hover .team-social {
    opacity: 1;
    transform: translateY(0);
}

.team-social a {
    width: 36px;
    height: 36px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: rgba(255, 255, 255, 0.2);
    border-radius: var(--radius-full);
    color: white;
    transition: background var(--transition-fast);
}

.team-social a:hover {
    background: white;
    color: var(--color-dark-900);
}

.team-member h3 {
    font-size: var(--text-lg);
    margin-bottom: var(--space-1);
}

.team-member span {
    font-size: var(--text-sm);
    color: var(--color-neutral-500);
}

/* Stats Section */
.stats-section {
    padding: var(--section-padding) 0;
    background: var(--color-dark-950);
    color: white;
}

.stats-grid {
    display: grid;
    gap: var(--space-8);
    text-align: center;
}

@media (min-width: 768px) {
    .stats-grid {
        grid-template-columns: repeat(4, 1fr);
    }
}

.stat-item .stat-number {
    display: block;
    font-family: var(--font-display);
    font-size: var(--text-5xl);
    font-weight: 700;
    color: white;
    line-height: 1;
    margin-bottom: var(--space-2);
}

.stat-item .stat-label {
    font-size: var(--text-sm);
    color: var(--color-dark-400);
}

/* CTA Section */
.about-cta {
    padding: var(--section-padding) 0;
    background: var(--color-neutral-50);
}

.about-cta .cta-card {
    background: linear-gradient(135deg, var(--color-primary-700) 0%, var(--color-primary-800) 100%);
    border-radius: var(--radius-3xl);
    padding: var(--space-12);
    text-align: center;
    position: relative;
    overflow: hidden;
}

.about-cta .cta-card::before {
    content: "";
    position: absolute;
    inset: 0;
    background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
    background-size: 20px 20px;
    pointer-events: none;
}

.about-cta h2 {
    color: white;
    margin-bottom: var(--space-4);
    position: relative;
}

.about-cta p {
    color: rgba(255, 255, 255, 0.8);
    font-size: var(--text-lg);
    max-width: 500px;
    margin: 0 auto var(--space-8);
    position: relative;
}

.about-cta .btn {
    position: relative;
}
</style>

<!-- Hero Section -->
<section class="about-hero">
    <div class="container">
        <div class="about-hero-content reveal">
            <span class="text-label">About Fieldcraft</span>
            <h1>We believe in the power of great design</h1>
            <p class="about-hero-text">
                Since 2016, we've been helping ambitious brands create digital experiences that matter. We're a team of designers, developers, and strategists united by a passion for craft.
            </p>
        </div>
    </div>
</section>

<!-- Story Section -->
<section class="story-section">
    <div class="container">
        <div class="story-grid">
            <div class="story-image reveal">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=700&h=525&fit=crop" alt="Fieldcraft team working together">
            </div>
            <div class="story-content reveal reveal-delay-1">
                <h2 class="text-display">Our story</h2>
                <p>
                    Fieldcraft was born from a simple belief: that great design can transform businesses. We started as a small studio in San Francisco with big dreams and a commitment to excellence.
                </p>
                <p>
                    Today, we're a full-service digital agency that has partnered with over 100 companies across industries. From startups to Fortune 500 companies, we've helped our clients build products that users love.
                </p>
                <p>
                    What sets us apart is our approach. We don't just build websites and apps—we become an extension of your team. We immerse ourselves in your business, understand your challenges, and create solutions that drive real results.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="values-section">
    <div class="container">
        <div class="section-header center reveal">
            <span class="text-label">Our Values</span>
            <h2 class="text-display">What guides our work</h2>
        </div>

        <div class="values-grid">
            <div class="value-card reveal">
                <div class="value-icon">
                    <?php echo fieldcraft_icon("star", 24); ?>
                </div>
                <h3>Excellence</h3>
                <p>We hold ourselves to the highest standards. Good enough is never good enough—we push for exceptional in everything we do.</p>
            </div>

            <div class="value-card reveal reveal-delay-1">
                <div class="value-icon">
                    <?php echo fieldcraft_icon("users", 24); ?>
                </div>
                <h3>Collaboration</h3>
                <p>Great work happens together. We foster open communication and work alongside our clients as true partners.</p>
            </div>

            <div class="value-card reveal reveal-delay-2">
                <div class="value-icon">
                    <?php echo fieldcraft_icon("lightning", 24); ?>
                </div>
                <h3>Innovation</h3>
                <p>We stay ahead of the curve, constantly exploring new technologies and approaches to deliver cutting-edge solutions.</p>
            </div>

            <div class="value-card reveal">
                <div class="value-icon">
                    <?php echo fieldcraft_icon("target", 24); ?>
                </div>
                <h3>Impact</h3>
                <p>We measure success by results. Every project is designed to create meaningful, measurable impact for our clients.</p>
            </div>

            <div class="value-card reveal reveal-delay-1">
                <div class="value-icon">
                    <?php echo fieldcraft_icon("globe", 24); ?>
                </div>
                <h3>Transparency</h3>
                <p>We believe in honest, open communication. No surprises, no hidden agendas—just straightforward partnerships.</p>
            </div>

            <div class="value-card reveal reveal-delay-2">
                <div class="value-icon">
                    <?php echo fieldcraft_icon("chart", 24); ?>
                </div>
                <h3>Growth</h3>
                <p>We're always learning. Continuous improvement drives us to become better at what we do, every single day.</p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="team-section">
    <div class="container">
        <div class="section-header center reveal">
            <span class="text-label">Our Team</span>
            <h2 class="text-display">Meet the people behind the work</h2>
        </div>

        <div class="team-grid">
            <div class="team-member reveal">
                <div class="team-photo">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=400&h=500&fit=crop" alt="Sarah Chen">
                    <div class="team-social">
                        <a href="#" aria-label="LinkedIn"><?php echo fieldcraft_icon("linkedin", 16); ?></a>
                        <a href="#" aria-label="Twitter"><?php echo fieldcraft_icon("twitter", 16); ?></a>
                    </div>
                </div>
                <h3>Sarah Chen</h3>
                <span>CEO & Founder</span>
            </div>

            <div class="team-member reveal reveal-delay-1">
                <div class="team-photo">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=400&h=500&fit=crop" alt="Marcus Johnson">
                    <div class="team-social">
                        <a href="#" aria-label="LinkedIn"><?php echo fieldcraft_icon("linkedin", 16); ?></a>
                        <a href="#" aria-label="Dribbble"><?php echo fieldcraft_icon("dribbble", 16); ?></a>
                    </div>
                </div>
                <h3>Marcus Johnson</h3>
                <span>Design Director</span>
            </div>

            <div class="team-member reveal reveal-delay-2">
                <div class="team-photo">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=400&h=500&fit=crop" alt="Alex Rivera">
                    <div class="team-social">
                        <a href="#" aria-label="LinkedIn"><?php echo fieldcraft_icon("linkedin", 16); ?></a>
                        <a href="#" aria-label="Twitter"><?php echo fieldcraft_icon("twitter", 16); ?></a>
                    </div>
                </div>
                <h3>Alex Rivera</h3>
                <span>Lead Developer</span>
            </div>

            <div class="team-member reveal reveal-delay-3">
                <div class="team-photo">
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=400&h=500&fit=crop" alt="Emily Rodriguez">
                    <div class="team-social">
                        <a href="#" aria-label="LinkedIn"><?php echo fieldcraft_icon("linkedin", 16); ?></a>
                        <a href="#" aria-label="Instagram"><?php echo fieldcraft_icon("instagram", 16); ?></a>
                    </div>
                </div>
                <h3>Emily Rodriguez</h3>
                <span>Marketing Lead</span>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="stats-section">
    <div class="container">
        <div class="stats-grid reveal">
            <div class="stat-item">
                <span class="stat-number" data-counter="150">0</span>
                <span class="stat-label">Projects Completed</span>
            </div>
            <div class="stat-item">
                <span class="stat-number" data-counter="50">0</span>
                <span class="stat-label">Happy Clients</span>
            </div>
            <div class="stat-item">
                <span class="stat-number" data-counter="8">0</span>
                <span class="stat-label">Years Experience</span>
            </div>
            <div class="stat-item">
                <span class="stat-number" data-counter="15">0</span>
                <span class="stat-label">Awards Won</span>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="about-cta">
    <div class="container">
        <div class="cta-card reveal">
            <h2 class="text-display">Want to work with us?</h2>
            <p>We're always looking for talented people to join our team. Check out our open positions.</p>
            <a href="<?php echo esc_url(home_url('/careers')); ?>" class="btn btn-white btn-lg">
                View Careers <?php echo fieldcraft_icon("arrow-right"); ?>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
