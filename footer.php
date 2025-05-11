    <footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-info">
                    <h3><?php echo esc_html__('Business Hours', 'zongkuan'); ?></h3>
                    <p><?php echo esc_html(get_theme_mod('business_hours', 'Monday to Sunday: 08:00 - 21:00')); ?></p>
                    <p><?php echo esc_html__('24H Online Customer Service', 'zongkuan'); ?></p>
                </div>
                <div class="footer-info">
                    <p><i class="fas fa-envelope"></i> <?php echo esc_html(get_theme_mod('contact_email', 'zhongkuan001@gmail.com')); ?></p>
                    <?php if (get_theme_mod('company_registration_number')) : ?>
                        <p><i class="fas fa-building"></i> <?php echo esc_html__('Company Registration Number', 'zongkuan'); ?>: <?php echo esc_html(get_theme_mod('company_registration_number')); ?></p>
                    <?php endif; ?>
                    <?php if (get_theme_mod('company_address')) : ?>
                        <p><i class="fas fa-map-marker-alt"></i> <?php echo nl2br(esc_html(get_theme_mod('company_address'))); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php echo esc_html(get_bloginfo('name')); ?> <?php echo esc_html__('All Rights Reserved', 'zongkuan'); ?> | <a href="<?php echo esc_url(get_permalink(get_page_by_path('privacy-policy'))); ?>"><?php echo esc_html__('Privacy Policy', 'zongkuan'); ?></a></p>
            </div>
        </div>
    </footer>
    <?php wp_footer(); ?>
</body>
</html>
