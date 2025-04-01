<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contact_form_submit'])) {
    $name = sanitize_text_field($_POST['name']);
    $email = sanitize_email($_POST['email']);
    $amount = sanitize_text_field($_POST['amount']);
    $phone = sanitize_text_field($_POST['phone']);
    $time = sanitize_text_field($_POST['time']);
    $other = sanitize_textarea_field($_POST['other']);

    $post_id = wp_insert_post(array(
        'post_title' => $name,
        'post_type' => 'contact_form',
        'post_status' => 'publish',
    ));

    if ($post_id) {
        add_post_meta($post_id, 'email', $email);
        add_post_meta($post_id, 'amount', $amount);
        add_post_meta($post_id, 'phone', $phone);
        add_post_meta($post_id, 'time', $time);
        add_post_meta($post_id, 'other', $other);
    }

    wp_redirect(home_url('/'));
    exit;
}
?>
