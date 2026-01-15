<?php
/**
 * Home Page Template
 *
 * @package Fieldcraft
 */

get_header();
?>

<!-- Hero Section -->
<section class="hero">
    <div class="container">
        <div class="hero-content reveal">
            <h1 class="text-hero">A Single Solution<br>For Optimizing Your<br>Business</h1>
            <p class="hero-subtitle">
                Streamline your operations with our comprehensive platform. Manage projects, collaborate with your team, and scale your business effortlessly.
            </p>
            <div class="hero-actions">
                <a href="#features" class="btn btn-primary btn-lg">
                    Get Started
                    <?php echo fieldcraft_icon('arrow-right'); ?>
                </a>
                <a href="#demo" class="btn btn-outline btn-lg">Watch Demo</a>
            </div>
        </div>
    </div>
</section>

<!-- Logo Bar -->
<section class="logo-bar">
    <div class="container">
        <div class="logo-bar-inner">
            <span style="font-family: var(--font-display); font-weight: 600; font-size: 0.9rem;">logoipsum</span>
            <span style="font-family: var(--font-display); font-weight: 600; font-size: 0.9rem;">◇ logoipsum</span>
            <span style="font-family: var(--font-display); font-weight: 600; font-size: 0.9rem;">⚡ Logoipsum</span>
            <span style="font-family: var(--font-display); font-weight: 600; font-size: 0.9rem;">🔲 Logoipsum</span>
            <span style="font-family: var(--font-display); font-weight: 600; font-size: 0.9rem;">|||||||</span>
        </div>
    </div>
</section>

<!-- Values Section -->
<section class="section values-section">
    <div class="container">
        <div class="section-header reveal">
            <h2 class="text-display">Our Agency Values<br>Are The Cornerstone<br>Of Our Work</h2>
        </div>

        <div class="values-grid">
            <!-- Row 1 -->
            <div class="card value-card card-purple reveal">
                <div class="icon-box icon-box-white">
                    <?php echo fieldcraft_icon('star'); ?>
                </div>
                <h4 class="card-title">Integrity</h4>
                <p class="card-text" style="color: rgba(255,255,255,0.7);">Our intuitive dashboard provides a bird's eye view of your tasks, projects, and team performance.</p>
            </div>

            <div class="card value-card reveal reveal-delay-1">
                <div class="icon-box icon-box-purple">
                    <?php echo fieldcraft_icon('lightning'); ?>
                </div>
                <h4 class="card-title">Innovation</h4>
                <p class="card-text">Stay organized and on top of your workload with our robust task management features.</p>
            </div>

            <div class="card value-card reveal reveal-delay-2">
                <div class="icon-box icon-box-purple">
                    <?php echo fieldcraft_icon('users'); ?>
                </div>
                <h4 class="card-title">Collaboration</h4>
                <p class="card-text">Foster collaboration and communication among your team members with our tools.</p>
            </div>

            <!-- Row 2 -->
            <div class="card value-card card-light-purple reveal">
                <div class="icon-box icon-box-purple">
                    <?php echo fieldcraft_icon('users'); ?>
                </div>
                <h4 class="card-title">Team Player</h4>
                <p class="card-text">Accurately track the time you and your team spend on tasks and projects with ease.</p>
            </div>

            <div class="card value-card reveal reveal-delay-1">
                <div class="icon-box icon-box-purple">
                    <?php echo fieldcraft_icon('settings'); ?>
                </div>
                <h4 class="card-title">Automation</h4>
                <p class="card-text">Plan and manage your projects with ease using our comprehensive project planning tools.</p>
            </div>

            <div class="card value-card card-yellow reveal reveal-delay-2">
                <div class="icon-box" style="background-color: var(--color-primary-700); color: white;">
                    <?php echo fieldcraft_icon('chart'); ?>
                </div>
                <h4 class="card-title">Scaling Up</h4>
                <p class="card-text" style="color: var(--color-primary-800);">Say goodbye to scattered documents and files with our centralized document management system.</p>
            </div>
        </div>
    </div>
</section>

<!-- Split Section - About -->
<section class="section">
    <div class="container">
        <div class="split">
            <div class="split-image reveal">
                <img src="https://images.unsplash.com/photo-1522071820081-009f0129c71c?w=600&h=500&fit=crop" alt="Team collaboration">
            </div>
            <div class="split-content reveal reveal-delay-1">
                <ul class="split-list">
                    <li>Our agency value is collaborative</li>
                    <li>We work for future adaptation</li>
                    <li>Our team values the work culture we follow</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="section" style="background-color: var(--color-neutral-50);">
    <div class="container">
        <div class="section-header text-left reveal" style="max-width: none; margin-left: 0;">
            <h2 class="text-display">The Team With<br>Skill & Experience</h2>
        </div>

        <div class="team-grid reveal">
            <div class="team-card">
                <div class="team-image" style="background: linear-gradient(135deg, #fde047, #facc15);"></div>
                <h4 class="team-name">Sarah Johnson</h4>
                <p class="team-role">CEO & Founder</p>
            </div>
            <div class="team-card">
                <div class="team-image" style="background: linear-gradient(135deg, #a78bfa, #7c3aed);"></div>
                <h4 class="team-name">Michael Chen</h4>
                <p class="team-role">Lead Developer</p>
            </div>
            <div class="team-card">
                <div class="team-image" style="background: linear-gradient(135deg, #fde047, #facc15);"></div>
                <h4 class="team-name">Emily Davis</h4>
                <p class="team-role">Design Director</p>
            </div>
            <div class="team-card">
                <div class="team-image" style="background: linear-gradient(135deg, #c4b5fd, #a78bfa);"></div>
                <h4 class="team-name">James Wilson</h4>
                <p class="team-role">Project Manager</p>
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="section features-section">
    <div class="container">
        <div class="features-header reveal">
            <h2 class="text-display">Dynamic Features<br>Assisting Your<br>Business</h2>
        </div>

        <div class="section-header reveal" style="color: white;">
            <h3 style="color: white; font-size: 1.5rem; text-transform: uppercase; margin-bottom: 1rem;">Features That Enable Business Scale Up</h3>
        </div>

        <div class="features-grid">
            <div class="feature-card reveal">
                <div class="icon-box icon-box-white" style="margin-bottom: 1rem;">
                    <?php echo fieldcraft_icon('code'); ?>
                </div>
                <h4>Seamless integration tools amongst platforms</h4>
                <p>Connect all your favorite tools and streamline your workflow.</p>
            </div>

            <div class="feature-card reveal reveal-delay-1">
                <div class="icon-box icon-box-white" style="margin-bottom: 1rem;">
                    <?php echo fieldcraft_icon('chart'); ?>
                </div>
                <h4>Startups backed up</h4>
                <p>Our startup focused features will help you get the right fit for a great team.</p>
            </div>

            <div class="feature-card reveal reveal-delay-2">
                <div class="icon-box icon-box-white" style="margin-bottom: 1rem;">
                    <?php echo fieldcraft_icon('lightning'); ?>
                </div>
                <h4>Increased efficiency</h4>
                <p>Business productivity tools effortlessly help your business remain proactive.</p>
            </div>

            <div class="feature-card reveal">
                <div class="icon-box icon-box-white" style="margin-bottom: 1rem;">
                    <?php echo fieldcraft_icon('settings'); ?>
                </div>
                <h4>Boost Productivity</h4>
                <p>Based on proven productivity hacks for smarter business intelligence.</p>
            </div>

            <div class="feature-card reveal reveal-delay-1">
                <div class="icon-box icon-box-white" style="margin-bottom: 1rem;">
                    <?php echo fieldcraft_icon('globe'); ?>
                </div>
                <h4>Analytics data set</h4>
                <p>The best optimization tools with data-centric analytics with strategy.</p>
            </div>

            <div class="feature-card feature-card-highlight reveal reveal-delay-2">
                <div class="icon-box" style="background-color: var(--color-primary-700); color: white; margin-bottom: 1rem;">
                    <?php echo fieldcraft_icon('users'); ?>
                </div>
                <h4>Team collaboration</h4>
                <p>Work together seamlessly with real-time collaboration features.</p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="section">
    <div class="container">
        <div class="split">
            <div class="split-content reveal">
                <h2 class="text-display">Boost Up<br>Customer Reach</h2>
                <p style="font-size: 1.125rem;">Count on us to be there for you at every stage</p>

                <div class="stats-row" style="justify-content: flex-start; padding: 2rem 0;">
                    <div class="stat-item">
                        <div class="stat-value">$156M</div>
                        <div class="stat-label">Happy global users</div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-value">35,400+</div>
                        <div class="stat-label">Startups ready to be connected</div>
                    </div>
                </div>
            </div>
            <div class="split-image reveal reveal-delay-1">
                <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?w=600&h=500&fit=crop" alt="Business growth">
            </div>
        </div>
    </div>
</section>

<!-- Pricing Section -->
<section id="pricing" class="section pricing-section">
    <div class="container">
        <div class="section-header reveal">
            <h2 class="text-display">Pricing Plan For<br>Profitable Business<br>Automation</h2>
        </div>

        <div class="pricing-grid">
            <!-- Starter Pack -->
            <div class="pricing-card reveal">
                <span class="pricing-badge">Free</span>
                <h3 class="pricing-name">Starter Pack</h3>
                <p class="pricing-description">Best fit for individual business platform</p>
                <div class="pricing-price">
                    <span class="pricing-amount">$0</span>
                    <span class="pricing-period">/mo</span>
                </div>
                <div class="pricing-features">
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon('check', 16); ?>
                        <span>One individual account</span>
                    </div>
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon('check', 16); ?>
                        <span>Weekly data analytics</span>
                    </div>
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon('check', 16); ?>
                        <span>3 Startup idea support</span>
                    </div>
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon('check', 16); ?>
                        <span>SEO, Wireframe implementation</span>
                    </div>
                </div>
                <a href="#" class="btn btn-outline">Buy Package <?php echo fieldcraft_icon('arrow-right', 16); ?></a>
            </div>

            <!-- Growth Pack -->
            <div class="pricing-card is-featured reveal reveal-delay-1">
                <span class="pricing-badge">Most economic</span>
                <h3 class="pricing-name">Growth Pack</h3>
                <p class="pricing-description">Best fit for individual any kind of startup</p>
                <div class="pricing-price">
                    <span class="pricing-amount">$24</span>
                    <span class="pricing-period">/mo</span>
                </div>
                <div class="pricing-features">
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon('check', 16); ?>
                        <span>12 business account</span>
                    </div>
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon('check', 16); ?>
                        <span>Weekly, daily data analytics</span>
                    </div>
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon('check', 16); ?>
                        <span>3 Startup idea support with revision</span>
                    </div>
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon('check', 16); ?>
                        <span>SEO, Wireframe implementation</span>
                    </div>
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon('check', 16); ?>
                        <span>Data analytics report with cross platform collaboration</span>
                    </div>
                </div>
                <a href="#" class="btn btn-primary">Buy Package <?php echo fieldcraft_icon('arrow-right', 16); ?></a>
            </div>

            <!-- Business Pack -->
            <div class="pricing-card reveal reveal-delay-2">
                <span class="pricing-badge">Customized</span>
                <h3 class="pricing-name">Business Pack</h3>
                <p class="pricing-description">Best fit for mega business platform</p>
                <div class="pricing-price">
                    <span class="pricing-amount">$40</span>
                    <span class="pricing-period">/mo</span>
                </div>
                <div class="pricing-features">
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon('check', 16); ?>
                        <span>15 business account</span>
                    </div>
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon('check', 16); ?>
                        <span>Weekly, daily data analytics</span>
                    </div>
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon('check', 16); ?>
                        <span>5 Startup idea account with revision</span>
                    </div>
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon('check', 16); ?>
                        <span>SEO, Wireframe implementation with AI adaptation</span>
                    </div>
                    <div class="pricing-feature">
                        <?php echo fieldcraft_icon('check', 16); ?>
                        <span>Social media management</span>
                    </div>
                </div>
                <a href="#" class="btn btn-outline">Buy Package <?php echo fieldcraft_icon('arrow-right', 16); ?></a>
            </div>
        </div>
    </div>
</section>

<!-- Integrations Section -->
<section class="section">
    <div class="container">
        <div class="split">
            <div class="split-content reveal">
                <h2 class="text-display">Our Seamless<br>Integrations</h2>
                <p>Rest easy knowing that your data is safe and secure with industry-leading security measures.</p>
                <a href="#" class="btn btn-primary" style="margin-top: 1rem;">
                    Explore Integration <?php echo fieldcraft_icon('arrow-right'); ?>
                </a>
            </div>
            <div class="integrations-grid reveal reveal-delay-1">
                <?php
                $colors = ['#8b5cf6', '#facc15', '#ef4444', '#22c55e', '#3b82f6', '#f97316', '#ec4899', '#06b6d4', '#eab308', '#a855f7'];
                for ($i = 0; $i < 10; $i++): ?>
                <div class="integration-item">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none">
                        <rect width="40" height="40" rx="8" fill="<?php echo $colors[$i]; ?>" fill-opacity="0.1"/>
                        <circle cx="20" cy="20" r="10" fill="<?php echo $colors[$i]; ?>"/>
                    </svg>
                </div>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="section" style="background-color: var(--color-neutral-50);">
    <div class="container">
        <div class="section-header reveal">
            <h2 class="text-display">Frequently Asked<br>Questions</h2>
        </div>

        <div class="faq-list">
            <div class="faq-item is-open reveal">
                <button class="faq-question">
                    <span>What is Fieldcraft?</span>
                    <span class="faq-icon"><?php echo fieldcraft_icon('plus', 14); ?></span>
                </button>
                <div class="faq-answer">
                    Our user-friendly dashboard provides a clear overview of your business operations, allowing you to monitor important metrics and track progress in real time. Streamline your project workflows with powerful task management features. Assign tasks, set deadlines.
                </div>
            </div>

            <div class="faq-item reveal reveal-delay-1">
                <button class="faq-question">
                    <span>How can Fieldcraft benefit my business?</span>
                    <span class="faq-icon"><?php echo fieldcraft_icon('plus', 14); ?></span>
                </button>
                <div class="faq-answer">
                    Fieldcraft provides comprehensive tools to streamline your operations, improve team collaboration, and scale your business efficiently with data-driven insights.
                </div>
            </div>

            <div class="faq-item reveal reveal-delay-2">
                <button class="faq-question">
                    <span>Is Fieldcraft suitable for businesses of all sizes?</span>
                    <span class="faq-icon"><?php echo fieldcraft_icon('plus', 14); ?></span>
                </button>
                <div class="faq-answer">
                    Yes! Whether you're a startup or an enterprise, our flexible pricing plans and scalable features adapt to your business needs.
                </div>
            </div>

            <div class="faq-item reveal reveal-delay-3">
                <button class="faq-question">
                    <span>Can I integrate Fieldcraft with other tools we use?</span>
                    <span class="faq-icon"><?php echo fieldcraft_icon('plus', 14); ?></span>
                </button>
                <div class="faq-answer">
                    Absolutely! Fieldcraft offers seamless integrations with popular tools and platforms to ensure your workflow remains uninterrupted.
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="section cta-section">
    <div class="container">
        <div class="cta-content reveal">
            <h2 class="text-display">Ready to Transform<br>Your Business?</h2>
            <p>Join thousands of businesses already using Fieldcraft to optimize their operations and drive growth.</p>
            <a href="#" class="btn btn-accent btn-lg">
                Get Started Free <?php echo fieldcraft_icon('arrow-right'); ?>
            </a>
        </div>
    </div>
</section>

<?php get_footer(); ?>
