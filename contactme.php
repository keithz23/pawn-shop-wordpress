<?php
/*
Template Name: Contact Me
*/
get_header(); 
?>

<div class="contact-container">
    <h1><?php echo esc_html__('Contact Us', 'your-theme-domain'); ?></h1>
    <form action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="POST">
        <input type="hidden" name="action" value="submit_contact_form">
        <label for="name"><?php echo esc_html__('Name', 'your-theme-domain'); ?></label>
        <input type="text" id="name" name="name" required>

        <label for="email"><?php echo esc_html__('Email', 'your-theme-domain'); ?></label>
        <input type="email" id="email" name="email" required>

        <label for="message"><?php echo esc_html__('Message', 'your-theme-domain'); ?></label>
        <textarea id="message" name="message" required></textarea>

        <button type="submit"><?php echo esc_html__('Send', 'your-theme-domain'); ?></button>
    </form>
</div>

<?php get_footer(); ?>
