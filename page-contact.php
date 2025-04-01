<?php
/*
Template Name: Contact Page
*/
get_header(); 
?>

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
                <?php wp_nonce_field('contact_form_action', 'contact_form_nonce'); ?>
                <input type="hidden" name="contact_form_submit" value="1" />
                
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