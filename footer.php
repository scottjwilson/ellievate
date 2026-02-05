</main>

<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Brand Column -->
            <div class="footer-brand">
                <a href="<?php echo esc_url(
                    home_url("/"),
                ); ?>" class="site-logo">
                    <span class="logo-mark">F</span>
                    <span>Fieldcraft</span>
                </a>
                <p>We craft digital experiences that drive growth. Award-winning agency specializing in web design, development, and digital strategy.</p>
                <div class="footer-social">
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

            <!-- Services -->
            <nav class="footer-nav">
                <h4>Services</h4>
                <ul>
                    <li><a href="<?php echo esc_url(
                        home_url("/services/web-design"),
                    ); ?>">Web Design</a></li>
                    <li><a href="<?php echo esc_url(
                        home_url("/services/development"),
                    ); ?>">Development</a></li>
                    <li><a href="<?php echo esc_url(
                        home_url("/services/seo"),
                    ); ?>">SEO Strategy</a></li>
                    <li><a href="<?php echo esc_url(
                        home_url("/services/marketing"),
                    ); ?>">Digital Marketing</a></li>
                    <li><a href="<?php echo esc_url(
                        home_url("/services/branding"),
                    ); ?>">Brand Identity</a></li>
                </ul>
            </nav>

            <!-- Company -->
            <nav class="footer-nav">
                <h4>Company</h4>
                <ul>
                    <li><a href="<?php echo esc_url(
                        home_url("/about"),
                    ); ?>">About Us</a></li>
                    <li><a href="<?php echo esc_url(
                        home_url("/work"),
                    ); ?>">Our Work</a></li>
                    <li><a href="<?php echo esc_url(
                        home_url("/blog"),
                    ); ?>">Blog</a></li>
                    <li><a href="<?php echo esc_url(
                        home_url("/careers"),
                    ); ?>">Careers</a></li>
                    <li><a href="<?php echo esc_url(
                        home_url("/contact"),
                    ); ?>">Contact</a></li>
                </ul>
            </nav>

            <!-- Contact -->
            <div class="footer-contact">
                <h4>Get in Touch</h4>
                <ul>
                    <li>
                        <a href="mailto:hello@fieldcraft.digital">
                            <?php echo fieldcraft_icon("mail", 16); ?>
                            hello@fieldcraft.digital
                        </a>
                    </li>
                    <li>
                        <a href="tel:+1234567890">
                            <?php echo fieldcraft_icon("phone", 16); ?>
                            (123) 456-7890
                        </a>
                    </li>
                    <li>
                        <span>
                            <?php echo fieldcraft_icon("map-pin", 16); ?>
                            San Francisco, CA
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?php echo date(
                "Y",
            ); ?> Fieldcraft Digital. All rights reserved.</p>
            <div class="footer-links">
                <a href="<?php echo esc_url(
                    home_url("/privacy"),
                ); ?>">Privacy Policy</a>
                <a href="<?php echo esc_url(
                    home_url("/terms"),
                ); ?>">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
