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
                <span><i class="fas fa-clock"></i><?php echo esc_html__('24H線上客服', 'your-theme-domain'); ?></span>
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
                <a href="<?php echo esc_url(get_theme_mod('line_id', 'https://line.me/ti/p/@599jmyld')); ?>" target="_blank" class="cta-button primary">加入LINE</a>
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

<?php get_footer(); ?> 