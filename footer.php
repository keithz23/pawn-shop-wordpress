    <footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-info">
                    <h3><?php echo esc_html__('營業時間', 'zongkuan'); ?></h3>
                    <p><?php echo esc_html(get_theme_mod('business_hours', '週一至週日: 08:00 - 21:00')); ?></p>
                    <p><?php echo esc_html__('24H線上客服', 'zongkuan'); ?></p>
                </div>
                <div class="footer-info">
                    <p><i class="fas fa-envelope"></i> <?php echo esc_html(get_theme_mod('contact_email', 'zhongkuan001@gmail.com')); ?></p>
                    <?php if (get_theme_mod('company_registration_number')) : ?>
                        <p><i class="fas fa-building"></i> <?php echo esc_html__('公司登記號碼', 'zongkuan'); ?>: <?php echo esc_html(get_theme_mod('company_registration_number')); ?></p>
                    <?php endif; ?>
                    <?php if (get_theme_mod('company_address')) : ?>
                        <p><i class="fas fa-map-marker-alt"></i> <?php echo nl2br(esc_html(get_theme_mod('company_address'))); ?></p>
                    <?php endif; ?>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> <?php echo esc_html(get_bloginfo('name')); ?> <?php echo esc_html__('版權所有', 'zongkuan'); ?> | <a href="<?php echo esc_url(get_permalink(get_page_by_path('privacy-policy'))); ?>"><?php echo esc_html__('隱私權政策', 'zongkuan'); ?></a></p>
            </div>
        </div>
    </footer>
    <?php wp_footer(); ?>
</body>
</html>
