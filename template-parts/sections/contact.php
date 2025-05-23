<!-- Contact Section with Social Proof -->
<section class="contact-section", id="contact">
  <div class="contact-container">
    <h2 class="contact-title"><?php echo esc_html__('免費諮詢', 'your-theme-domain'); ?></h2>
    <div class="underline"></div>
    
    <div class="social-proof">
      <div class="proof-item">
        <span class="proof-number"><?php echo esc_html(get_theme_mod('service_coverage', '全國')); ?></span>
        <p class="proof-text"><?php echo esc_html__('服務範圍', 'your-theme-domain'); ?></p>
      </div>
      <div class="proof-item">
        <span class="proof-number"><?php echo esc_html(get_theme_mod('loan_options', '5+')); ?></span>
        <p class="proof-text"><?php echo esc_html__('貸款選擇', 'your-theme-domain'); ?></p>
      </div>
      <div class="proof-item">
        <span class="proof-number"><?php echo esc_html(get_theme_mod('online_service', '24/7')); ?></span>
        <p class="proof-text"><?php echo esc_html__('線上客服', 'your-theme-domain'); ?></p>
      </div>
    </div>

    <p class="contact-description"><?php echo esc_html__('專業服務團隊為您解答，全程保密、免費估價', 'your-theme-domain'); ?></p>
    
    <div class="contact-buttons">
      <a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email', 'zhongkuan001@gmail.com')); ?>" class="contact-button email-button">
        <i class="fas fa-envelope"></i>
        <span><?php echo esc_html__('Email諮詢', 'your-theme-domain'); ?></span>
      </a>
      <a href="<?php echo esc_url(get_theme_mod('line_url', 'https://line.me/ti/p/@599jmyld')); ?>" target="_blank" class="contact-button line-button">
        <i class="fab fa-line"></i>
        <span><?php echo esc_html__('LINE諮詢', 'your-theme-domain'); ?></span>
      </a>
    </div>
  </div>
</section>
