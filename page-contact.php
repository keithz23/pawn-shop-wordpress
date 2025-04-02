<?php
/*
Template Name: Contact Page
*/
get_header(); 
?>

<!-- Contact Banner Section -->
<section class="banner">
      <img
        src="<?php echo esc_url(get_theme_file_uri('assets/contactme_cropped.jpg')); ?>"
        alt="聯絡我們"
        class="banner-image"
      />
      <div class="banner-container">
        <div class="banner-form">
          <h1>線上預約 專人回覆</h1>
          <div class="form-container">
            <?php if (isset($_GET['success']) && $_GET['success'] == '1') : ?>
                <p class="success-message">感謝您的提交！我們會盡快與您聯繫。</p>
            <?php elseif (isset($_GET['error']) && $_GET['error'] == '1') : ?>
                <p class="error-message">提交表單時出現錯誤，請稍後再試。</p>
            <?php endif; ?>
            <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
               <input type="hidden" name="action" value="handle_contact_form">
              <?php wp_nonce_field('contact_form_action', 'contact_form_nonce'); ?>
              <input type="hidden" name="contact_form_submit" value="1" />

              <div class="form-group">
                <label for="name"
                  >貴賓姓名 <span style="color: red">(必填)</span></label
                >
                <input
                  type="text"
                  id="name"
                  name="name"
                  placeholder="請輸入姓名"
                  required
                />
              </div>

              <div class="form-group">
                <label for="email"
                  >電子郵件 <span style="color: red">(必填)</span></label
                >
                <input
                  type="email"
                  id="email"
                  name="email"
                  placeholder="請輸入電子郵件"
                  required
                />
              </div>

              <div class="form-group">
                <label for="amount"
                  >借款金額 <span style="color: red">(必填)</span></label
                >
                <input
                  type="number"
                  id="amount"
                  name="amount"
                  placeholder="例如: 50000元"
                  required
                />
              </div>

              <div class="form-group">
                <label for="phone"
                  >聯絡電話 <span style="color: red">(必填)</span></label
                >
                <input
                  type="tel"
                  id="phone"
                  name="phone"
                  placeholder="請輸入聯絡電話"
                  required
                />
              </div>

              <div class="form-group">
                <label for="time"
                  >可聯絡時間 <span style="color: red">(必填)</span></label
                >
                <select id="time" name="time" required>
                  <option value="">請選擇聯絡時段</option>
                  <option value="morning">上午</option>
                  <option value="afternoon">下午</option>
                  <option value="evening">晚上</option>
                </select>
              </div>

              <div class="form-group">
                <label for="other">其它需求</label>
                <textarea
                  id="other"
                  name="other"
                  rows="3"
                  placeholder="請輸入您的需求"
                ></textarea>
              </div>

              <button type="submit" class="submit-btn">送出訊息</button>
            </form>
          </div>
        </div>
        <div class="banner-text">
          <h1>聯絡我們</h1>
          <div class="banner-features">
            <div class="features-column">
              <span
                ><i class="fas fa-clock"></i> 週一至週六: 09:00 - 21:00</span
              >
              <span><i class="fas fa-clock"></i> 週日: 10:00 - 18:00</span>
            </div>
            <div class="features-column">
              <span
                ><i class="fas fa-envelope"></i> zhongkuan001@gmail.com</span
              >
              <span><i class="fab fa-line"></i> LINE ID: @599jmyld</span>
            </div>
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