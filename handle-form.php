<?php

function handle_submit_contact_form() {
    if (!isset($_POST['contact_form_nonce']) || !wp_verify_nonce($_POST['contact_form_nonce'], 'submit_contact_form_action')) {
        wp_die('Invalid nonce. Form submission failed.', 'Security Error', array('response' => 403));
    }

    if (isset($_POST['action']) && $_POST['action'] === 'submit_contact_form') {
        global $wpdb;
        $table_name = $wpdb->prefix . 'contact_form';

        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $amount = floatval($_POST['amount']);
        $phone = sanitize_text_field($_POST['phone']);
        $time = sanitize_text_field($_POST['time']);
        $other = sanitize_textarea_field($_POST['other']);

        $result = $wpdb->insert($table_name, array(
            'name' => $name,
            'email' => $email,
            'message' => $other . ' | Preferred time: ' . $time,
            'phone' => $phone,
            'amount' => $amount,
        ));

        // Lấy ID của trang Contact đã tồn tại
        $contact_page = get_page_by_path('contact');
        if ($contact_page) {
            $redirect_url = get_permalink($contact_page->ID);
        } else {
            $redirect_url = home_url('/contact/'); // Fallback nếu không tìm thấy
            error_log('Contact page not found in database.');
        }

        if ($result !== false) {
            wp_safe_redirect(add_query_arg('success', '1', $redirect_url));
            exit;
        } else {
            wp_safe_redirect(add_query_arg('error', '1', $redirect_url));
            exit;
        }
    }
}
add_action('admin_post_submit_contact_form', 'handle_submit_contact_form');
add_action('admin_post_nopriv_submit_contact_form', 'handle_submit_contact_form');
?>