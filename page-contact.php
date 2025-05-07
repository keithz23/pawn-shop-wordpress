<?php
/*
Template Name: Contact Page
*/
get_header(); ?>

<script>
  function gtag_report_conversion_form_submit() {
    // Grab the amount entered by the user
    var raw = document.getElementById('amount').value;
    var value = parseFloat(raw) || 0;
    // Send event with dynamic value and fixed currency
    gtag('event', 'conversion', {
      'send_to': 'AW-17054481244/c31BCOnsk8MaENz2msQ_',
      'value': value,            // CHANGED: pass the loan amount as conversion value
      'currency': 'TWD'          // CHANGED: Taiwanese Dollar
    });
    return true; // allow the form to submit
  }
</script>

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
        <?php if ( isset($_GET['success']) && $_GET['success'] == '1' ) : ?>
          <p class="success-message"><?php _e('Thank you for your submission!', 'zongkuan'); ?></p>
        <?php elseif ( isset($_GET['error']) && $_GET['error'] == '1' ) : ?>
          <p class="error-message"><?php _e('Please fill in all required fields.', 'zongkuan'); ?></p>
        <?php endif; ?>

        <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
          <input type="hidden" name="action" value="handle_contact_form">
          <?php wp_nonce_field('contact_form_action', 'contact_form_nonce'); ?>
          <input type="hidden" name="contact_form_submit" value="1" />

          <div class="form-group">
            <label for="name">
              <?php _e('Name:', 'zongkuan'); ?> <span style="color: red">(<?php _e('required', 'zongkuan'); ?>)</span>
            </label>
            <input
              type="text"
              id="name"
              name="name"
              placeholder="<?php esc_attr_e('Please enter your name', 'zongkuan'); ?>"
              required
            />
          </div>

          <div class="form-group">
            <label for="amount">
              <?php _e('Amount:', 'zongkuan'); ?> <span style="color: red">(<?php _e('required', 'zongkuan'); ?>)</span>
            </label>
            <input
              type="number"
              id="amount"
              name="amount"
              placeholder="<?php esc_attr_e('Example: 50000', 'zongkuan'); ?>"
              required
            />
          </div>

          <div class="form-group">
            <label for="phone">
              <?php _e('Phone:', 'zongkuan'); ?> <span style="color: red">(<?php _e('required', 'zongkuan'); ?>)</span>
            </label>
            <input
              type="tel"
              id="phone"
              name="phone"
              placeholder="<?php esc_attr_e('Please enter your phone number', 'zongkuan'); ?>"
              required
            />
          </div>

          <div class="form-group">
            <label for="time">
              <?php _e('Preferred Contact Time:', 'zongkuan'); ?> <span style="color: red">(<?php _e('required', 'zongkuan'); ?>)</span>
            </label>
            <select id="time" name="time" required>
              <option value=""><?php _e('Please select contact time', 'zongkuan'); ?></option>
              <option value="上午"><?php _e('Morning', 'zongkuan'); ?></option>
              <option value="下午"><?php _e('Afternoon', 'zongkuan'); ?></option>
              <option value="晚上"><?php _e('Evening', 'zongkuan'); ?></option>
            </select>
          </div>

          <div class="form-group">
            <label for="other"><?php _e('Message:', 'zongkuan'); ?></label>
            <textarea
              id="other"
              name="other"
              rows="3"
              placeholder="<?php esc_attr_e('Please enter your message', 'zongkuan'); ?>"
            ></textarea>
          </div>

          <!-- CHANGED: Trigger conversion only on click, passing value & currency -->
          <button
            type="submit"
            onclick="return gtag_report_conversion_form_submit()"
            class="submit-btn"
          >
            <?php _e('Submit', 'zongkuan'); ?>
          </button>
        </form>
      </div>
    </div>

    <div class="banner-text">
      <h1>聯絡我們</h1>
      <div class="banner-features">
        <div class="features-column">
          <span><i class="fas fa-clock"></i> 週一至週六: 09:00 - 21:00</span>
          <span><i class="fas fa-clock"></i> 週日: 10:00 - 18:00</span>
        </div>
        <div class="features-column">
          <span><i class="fas fa-envelope"></i> zhongkuan001@gmail.com</span>
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
        <a href="<?php echo esc_url(get_theme_mod('line_id', 'https://line.me/ti/p/@599jmyld')); ?>"
           target="_blank"
           class="cta-button primary"
           onclick="return gtag_report_form_conversion();">
          加入LINE
        </a>
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

<!-- Notification Dialog -->
<div class="notification-overlay" id="notification-overlay"></div>
<div class="notification-dialog" id="notification-dialog">
  <h3 id="notification-title"></h3>
  <p id="notification-message"></p>
  <button class="close-btn" id="notification-close"><?php _e('Close', 'zongkuan'); ?></button>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const contactForm = document.querySelector('.form-container form');
  const notificationDialog = document.getElementById('notification-dialog');
  const notificationOverlay = document.getElementById('notification-overlay');
  const notificationTitle = document.getElementById('notification-title');
  const notificationMessage = document.getElementById('notification-message');
  const notificationClose = document.getElementById('notification-close');
  
  function showNotification(title, message, type) {
    notificationTitle.textContent = title;
    notificationMessage.textContent = message;
    notificationDialog.className = 'notification-dialog ' + type;
    notificationDialog.classList.add('show');
    notificationOverlay.classList.add('show');
  }
  
  notificationClose.addEventListener('click', () => {
    notificationDialog.classList.remove('show');
    notificationOverlay.classList.remove('show');
  });
  notificationOverlay.addEventListener('click', () => {
    notificationDialog.classList.remove('show');
    notificationOverlay.classList.remove('show');
  });
  
  if (contactForm) {
    contactForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const formData = new FormData(contactForm);
      formData.append('action', 'handle_contact_form');
      formData.append('contact_form_nonce', '<?php echo wp_create_nonce("contact_form_action"); ?>');
      
      fetch('<?php echo admin_url('admin-post.php'); ?>', {
        method: 'POST',
        body: formData
      }).catch(error => console.error('Network error:', error));

      showNotification(
        '<?php _e('Success!', 'zongkuan'); ?>', 
        '<?php _e('Thank you for your submission! We will contact you soon.', 'zongkuan'); ?>', 
        'success'
      );

      const redirectUrl = '<?php echo home_url('/contact/?success=1'); ?>';
      function finalize() {
        contactForm.reset();
        window.location.href = redirectUrl;
      }

      notificationClose.onclick = finalize;
      notificationOverlay.onclick = finalize;
    });
  }
});
</script>

