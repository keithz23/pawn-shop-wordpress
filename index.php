<?php get_header(); ?>
<!-- Banner Section -->
<section class="banner">
    <?php if (has_post_thumbnail()): ?>
        <?php the_post_thumbnail('full', array('class' => 'banner-image')); ?>
    <?php else: ?>
        <img src="<?php echo esc_url(get_theme_file_uri('assets/banner_cropped.jpg')); ?>" alt="<?php bloginfo('name'); ?>" class="banner-image">
    <?php endif; ?>
    <div class="banner-text">
        <h1>專業金融服務 全方位解決方案</h1>
        <div class="banner-features">
            <div class="features-column">
                <span><i class="fas fa-building"></i> 企業融資</span>
                <span><i class="fas fa-home"></i> 不動產貸款</span>
                <span><i class="fas fa-user"></i> 個人信貸</span>
                <span><i class="fas fa-car"></i> 汽機車借款</span>
            </div>
            <div class="features-column">
                <span><i class="fas fa-exchange-alt"></i> 代償高利</span>
                <span><i class="fas fa-handshake"></i> 債務協商</span>
                <span><i class="fas fa-store"></i> 商販週轉</span>
                <span><i class="fas fa-dollar-sign"></i> 小額借貸&支票週轉</span>
            </div>
        </div>
        <p class="banner-description">快速審核 · 專業規劃 · 利率透明</p>
        <div class="banner-cta">
            <a href="<?php echo esc_url(get_theme_mod('line_id', 'https://line.me/ti/p/@599jmyld')); ?>" target="_blank" class="cta-button primary" style="background-color: #00B900 !important; border-color: #00B900 !important;" onclick="return gtag_report_conversion('<?php echo esc_url(get_theme_mod('line_id', 'https://line.me/ti/p/@599jmyld')); ?>');">LINE立即諮詢</a>
            <a href="#服務項目" class="cta-button secondary" style="background-color: #808080; color: white;">了解更多</a>
        </div>
    </div>
</section>

<!-- Video Section -->
<section class="video-section">
    <div class="video-container">
        <div class="video-wrapper">
            <?php if (get_theme_mod('video_url')): ?>
                <video controls poster="<?php echo esc_url(get_theme_mod('video_thumbnail')); ?>">
                    <source src="<?php echo esc_url(get_theme_mod('video_url')); ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            <?php endif; ?>
        </div>
        <div class="video-content">
            <h2>了解我們的服務</h2>
            <p>觀看影片，深入了解我們如何協助您解決資金需求</p>
            <a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email')); ?>" class="video-cta">
                <i class="fas fa-envelope"></i> 立即諮詢
            </a>
        </div>
    </div>
</section>

<!-- Carousel Section -->
<section class="carousel-section">
    <div class="carousel-container">
        <div class="carousel-track">
            <?php
            for ($i = 1; $i <= 8; $i++) {
                $image_url = get_theme_mod("carousel_image_$i");
                $title = get_theme_mod("carousel_title_$i");
                $description = get_theme_mod("carousel_description_$i");
                
                if ($image_url) {
                    echo '<div class="carousel-slide">';
                    echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($title) . '">';
                    if ($title || $description) {
                        echo '<div class="carousel-caption">';
                        if ($title) {
                            echo '<h3>' . esc_html($title) . '</h3>';
                        }
                        if ($description) {
                            echo '<p>' . esc_html($description) . '</p>';
                        }
                        echo '</div>';
                    }
                    echo '</div>';
                }
            }
            ?>
        </div>
        <button class="carousel-button prev">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="carousel-button next">
            <i class="fas fa-chevron-right"></i>
        </button>
        <div class="carousel-indicators"></div>
    </div>
</section>

<!-- Emergency Service Section -->
<section class="emergency-service">
    <div class="emergency-container">
        <div class="emergency-content">
            <i class="fas fa-bolt"></i>
            <h2>急需資金週轉？</h2>
            <p>企業融資、個人信貸、各類貸款，立即與我們聯繫</p>
            <a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email')); ?>" class="emergency-button">
                <i class="fas fa-envelope"></i> 立即諮詢
            </a>
        </div>
    </div>
</section>

<!-- Category Section -->
<section class="category-section" id="服務項目">
    <h2>服務項目</h2>
    <div class="underline"></div>
    <div class="category-nav">
        <button class="category-tab active" data-category="企業融資">企業融資</button>
        <button class="category-tab" data-category="不動產貸款">不動產貸款</button>
        <button class="category-tab" data-category="個人信貸">個人信貸</button>
        <button class="category-tab" data-category="汽機車借款">汽機車借款</button>
        <button class="category-tab" data-category="代償高利">代償高利</button>
        <button class="category-tab" data-category="債務協商">債務協商</button>
        <button class="category-tab" data-category="商販週轉">商販週轉</button>
        <button class="category-tab" data-category="小額借貸&支票週轉">小額借貸&支票週轉</button>
    </div>

    <!-- Category Content -->
    <div class="category-content">
        <!-- Content will be loaded dynamically via JavaScript -->
    </div>
</section>

<!-- Include template parts -->
<?php get_template_part('template-parts/sections/why-choose-us'); ?>
<?php get_template_part('template-parts/sections/testimonials'); ?>
<?php get_template_part('template-parts/sections/faq'); ?>
<?php get_template_part('template-parts/sections/contact'); ?>

<?php get_footer(); ?>
