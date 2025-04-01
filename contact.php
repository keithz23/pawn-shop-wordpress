<?php
/*
Template Name: Contact Me
*/
get_header(); 
?>

<form action="<?php echo get_template_directory_uri(); ?>/handle-form.php" method="POST">
    <input type="text" name="name" placeholder="請輸入姓名" required>
    <input type="email" name="email" placeholder="請輸入電子郵件" required>
    <input type="number" name="amount" placeholder="例如: 50000元" required>
    <input type="tel" name="phone" placeholder="請輸入聯絡電話" required>
    <select name="time" required>
        <option value="">請選擇聯絡時段</option>
        <option value="morning">上午</option>
        <option value="afternoon">下午</option>
        <option value="evening">晚上</option>
    </select>
    <textarea name="other" rows="3" placeholder="請輸入您的需求"></textarea>
    <button type="submit" name="contact_form_submit">送出訊息</button>
</form>


<?php get_footer(); ?>
