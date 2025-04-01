<?php

function handle_contact_form_submission() {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contact_form_submit']) && $_POST['contact_form_submit'] == '1') {
        if (!isset($_POST['contact_form_nonce']) || !wp_verify_nonce($_POST['contact_form_nonce'], 'contact_form_action')) {
            error_log("Nonce verification failed.");
            wp_safe_redirect(add_query_arg('error', 'nonce', home_url('/contact/')));
            exit;
        }

        global $wpdb;
        $table_name = $wpdb->prefix . 'contact_form';

        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $amount = floatval($_POST['amount']);
        $phone = sanitize_text_field($_POST['phone']);
        $time = sanitize_text_field($_POST['time']);
        $other = sanitize_textarea_field($_POST['other']);

        error_log("Attempting to insert data into $table_name: name=$name, email=$email");

        $result = $wpdb->insert($table_name, array(
            'name' => $name,
            'email' => $email,
            'message' => $other . ' | Preferred time: ' . $time,
            'phone' => $phone,
            'amount' => $amount,
        ));

        $redirect_url = home_url('/contact/');

        if ($result !== false) {
            error_log("Data inserted successfully into $table_name.");
            wp_safe_redirect(add_query_arg('success', '1', $redirect_url));
            exit;
        } else {
            error_log("Failed to insert data into $table_name: " . $wpdb->last_error);
            wp_safe_redirect(add_query_arg('error', '1', $redirect_url));
            exit;
        }
    }
}
add_action('init', 'handle_contact_form_submission');
?>