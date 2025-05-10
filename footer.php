    <footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-info">
                    <h3><?php echo esc_html__('營業時間', 'your-theme-domain'); ?></h3>
                    <p><?php echo esc_html(get_theme_mod('business_hours', '週一至週日: 08:00 - 21:00')); ?></p>
                    <p><?php echo esc_html__('24H線上客服', 'your-theme-domain'); ?></p>
                </div>
                <div class="footer-info">
                    <p><i class="fas fa-envelope"></i> <?php echo esc_html(get_theme_mod('contact_email', 'zhongkuan001@gmail.com')); ?></p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php echo esc_html(get_bloginfo('name')); ?> <?php echo esc_html__('版權所有', 'your-theme-domain'); ?> | <a href="<?php echo esc_url(get_permalink(get_page_by_path('privacy-policy'))); ?>">Privacy Policy</a></p>
            </div>
        </div>
    </footer>
    <?php wp_footer(); ?>
</body>
</html>
