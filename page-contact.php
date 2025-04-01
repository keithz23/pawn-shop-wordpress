<?php
/*
Template Name: Contact Page
*/
get_header(); 
?>

<!-- Contact Banner Section -->
<section class="banner">
    <img src="<?php echo esc_url(get_theme_file_uri('assets/contactme_cropped.jpg')); ?>" alt="聯絡我們" class="banner-image">
    <div class="banner-text">
        <h1>聯絡我們</h1>
        <div class="banner-features">
            <div class="features-column">
                <span><i class="fas fa-clock"></i><?php echo esc_html(get_theme_mod('business_hours', '週一至週日: 08:00 - 21:00')); ?></span>
                <span><i class="fas fa-clock"></i><?php echo esc_html__('24H線上客服', 'zongkuan'); ?></span>
            </div>
            <div class="features-column">
                <span><i class="fab fa-line"></i> LINE ID: @599jmyld</span>
                <span><i class="fas fa-envelope"></i> <?php echo esc_html(get_theme_mod('contact_email', 'zhongkuan001@gmail.com')); ?></span>
            </div>
        </div>
    </div>
</section>

<!-- Contact Information Section -->
<section class="contact-section">
    <h2>立即諮詢</h2>
    <div class="underline"></div>
    <div class="social-proof">
        <div class="proof-item">
            <span class="proof-number"><?php echo esc_html(get_theme_mod('success_cases', '5000+')); ?></span>
            <p>成功案例</p>
        </div>
        <div class="proof-item">
            <span class="proof-number"><?php echo esc_html(get_theme_mod('satisfaction_rate', '98%')); ?></span>
            <p>客戶滿意度</p>
        </div>
        <div class="proof-item">
            <span class="proof-number"><?php echo esc_html(get_theme_mod('years_experience', '20+')); ?></span>
            <p>年專業經驗</p>
        </div>
    </div>

    <!-- Contact Methods -->
    <div class="why-choose-container">
        <div class="why-choose-item">
            <i class="fas fa-envelope"></i>
            <h3>Email諮詢</h3>
            <p>快速回覆，專業服務</p>
            <div class="category-cta">
                <a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email', 'zhongkuan001@gmail.com')); ?>" class="cta-button primary">發送Email</a>
            </div>
        </div>
        <div class="why-choose-item">
            <i class="fab fa-line"></i>
            <h3>LINE諮詢</h3>
            <p>即時對話，方便快速</p>
            <div class="category-cta">
                <a href="<?php echo esc_url(get_theme_mod('line_url', 'https://line.me/ti/p/@599jmyld')); ?>" target="_blank" class="cta-button primary">加入LINE</a>
            </div>
        </div>
    </div>

    <!-- Service List -->
    <div class="trust-section">
        <div class="trust-container">
            <div class="trust-item">
                <i class="fas fa-building"></i>
                <h3>企業融資</h3>
                <p>靈活方案，快速審核</p>
            </div>
            <div class="trust-item">
                <i class="fas fa-home"></i>
                <h3>不動產貸款</h3>
                <p>最高可貸8成，利率優惠</p>
            </div>
            <div class="trust-item">
                <i class="fas fa-user"></i>
                <h3>個人信貸</h3>
                <p>手續簡便，快速撥款</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Form Section -->
<section class="contact-form-section">
    <h2>線上預約 專人回覆</h2>
    <div class="form-map-container">
        <div class="form-container">
            <?php if (isset($_GET['success']) && $_GET['success'] == '1') : ?>
                <p class="success-message">感謝您的提交！我們會盡快與您聯繫。</p>
            <?php elseif (isset($_GET['error']) && $_GET['error'] == '1') : ?>
                <p class="error-message">提交表單時出現錯誤，請稍後再試。</p>
            <?php endif; ?>

            <form method="post" action="">
                <?php wp_nonce_field('submit_contact_form_action', 'contact_form_nonce'); ?>
                <input type="hidden" name="action" value="submit_contact_form" />
                
                <div class="form-group">
                    <label for="name">貴賓姓名 <span style="color: red">(必填)</span></label>
                    <input type="text" id="name" name="name" placeholder="請輸入姓名" required />
                </div>
                <div class="form-group">
                    <label for="email">電子郵件 <span style="color: red">(必填)</span></label>
                    <input type="email" id="email" name="email" placeholder="請輸入電子郵件" required />
                </div>
                <div class="form-group">
                    <label for="amount">借款金額 <span style="color: red">(必填)</span></label>
                    <input type="number" id="amount" name="amount" placeholder="例如: 50000元" required />
                </div>
                <div class="form-group">
                    <label for="phone">聯絡電話 <span style="color: red">(必填)</span></label>
                    <input type="tel" id="phone" name="phone" placeholder="請輸入聯絡電話" required />
                </div>
                <div class="form-group">
                    <label for="time">可聯絡時間 <span style="color: red">(必填)</span></label>
                    <select id="time" name="time" required>
                        <option value="">請選擇聯絡時段</option>
                        <option value="morning">上午</option>
                        <option value="afternoon">下午</option>
                        <option value="evening">晚上</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="other">其它需求</label>
                    <textarea id="other" name="other" rows="3" placeholder="請輸入您的需求"></textarea>
                </div>
                <button type="submit" class="submit-btn">送出訊息</button>
            </form>
        </div>

        <div class="map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14564334.91234593!2d118.06479748749998!3d23.69781!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x345d54d8b9d2e7e5%3A0xb5b16e8cb443a68d!2zVGFpd2Fu!5e0!3m2!1sen!2stw!4v1711951234567!5m2!1sen!2stw"
                width="100%"
                height="300"
                style="border: 0"
                allowfullscreen=""
                loading="lazy">
            </iframe>
        </div>
    </div>
</section>

<?php get_footer(); ?>