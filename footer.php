</main>

<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Brand -->
            <div class="footer-brand">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="site-logo">
                    <span class="logo-icon" style="background-color: white; color: var(--color-primary-700);">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none">
                            <circle cx="8" cy="8" r="6" fill="currentColor"/>
                        </svg>
                    </span>
                    Fieldcraft
                </a>
                <p>Modern WordPress websites built for growth. Custom development, performance optimization, and business-focused solutions.</p>
            </div>

            <!-- Product -->
            <nav class="footer-nav">
                <h4>Product</h4>
                <ul>
                    <li><a href="#">Features</a></li>
                    <li><a href="#">Pricing</a></li>
                    <li><a href="#">Integrations</a></li>
                    <li><a href="#">Changelog</a></li>
                </ul>
            </nav>

            <!-- Company -->
            <nav class="footer-nav">
                <h4>Company</h4>
                <ul>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </nav>

            <!-- Legal -->
            <nav class="footer-nav">
                <h4>Legal</h4>
                <ul>
                    <li><a href="#">Privacy</a></li>
                    <li><a href="#">Terms</a></li>
                    <li><a href="#">Security</a></li>
                </ul>
            </nav>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> Fieldcraft Digital. All rights reserved.</p>
            <div class="footer-links">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
            </div>
        </div>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
