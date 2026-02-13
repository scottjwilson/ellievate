</main>

<footer class="footer">
    <div class="container">
        <div class="footer-logo">Ellievated <em>Beauty</em></div>
        <ul class="footer-links">
            <li><a href="<?php echo esc_url(
                home_url("/#services"),
            ); ?>">Services</a></li>
            <li><a href="<?php echo esc_url(
                home_url("/#about"),
            ); ?>">About</a></li>
            <li><a href="<?php echo esc_url(
                home_url("/#reviews"),
            ); ?>">Reviews</a></li>
            <li><a href="<?php echo esc_url(
                home_url("/contact"),
            ); ?>">Book Now</a></li>
        </ul>
        <div class="footer-social">
            <a href="https://instagram.com" target="_blank" rel="noopener noreferrer" aria-label="Instagram"><?php echo ellievated_icon(
                "instagram",
                16,
            ); ?></a>
            <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><?php echo ellievated_icon(
                "facebook",
                16,
            ); ?></a>
            <a href="https://tiktok.com" target="_blank" rel="noopener noreferrer" aria-label="TikTok"><?php echo ellievated_icon(
                "tiktok",
                16,
            ); ?></a>
        </div>
    </div>
    <div class="footer-bottom container">
        <p>&copy; <?php echo date(
            "Y",
        ); ?> Ellievated Beauty. All rights reserved.</p>
    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
