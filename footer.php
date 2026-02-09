</main>

<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Brand Column -->
            <div class="footer-brand">
                <a href="<?php echo esc_url(
                    home_url("/"),
                ); ?>" class="site-logo">
                    <span class="logo-mark">EB</span>
                    <span>Ellievated Beauty</span>
                </a>
                <p>Expert esthetician services tailored to your unique skin. Facials, waxing, and skincare solutions that help you look and feel your best.</p>
                <div class="footer-social">
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

            <!-- Quick Links -->
            <nav class="footer-nav">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="<?php echo esc_url(
                        home_url("/services"),
                    ); ?>">Services</a></li>
                    <li><a href="<?php echo esc_url(
                        home_url("/shop"),
                    ); ?>">Shop</a></li>
                    <li><a href="<?php echo esc_url(
                        home_url("/contact"),
                    ); ?>">Contact</a></li>
                    <li><a href="<?php echo esc_url(
                        home_url("/contact"),
                    ); ?>">Book an Appointment</a></li>
                </ul>
            </nav>

            <!-- Contact -->
            <div class="footer-contact">
                <h4>Get in Touch</h4>
                <ul>
                    <li>
                        <a href="mailto:hello@ellievatedbeauty.com">
                            <?php echo ellievated_icon("mail", 16); ?>
                            hello@ellievatedbeauty.com
                        </a>
                    </li>
                    <li>
                        <a href="tel:+1234567890">
                            <?php echo ellievated_icon("phone", 16); ?>
                            (123) 456-7890
                        </a>
                    </li>
                    <li>
                        <span>
                            <?php echo ellievated_icon("map-pin", 16); ?>
                            Your City, State
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?php echo date(
                "Y",
            ); ?> Ellievated Beauty. All rights reserved.</p>
            <div class="footer-links">
                <a href="<?php echo esc_url(
                    home_url("/privacy"),
                ); ?>">Privacy Policy</a>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
