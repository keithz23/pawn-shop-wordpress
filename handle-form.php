<?php

function handle_contact_form_submission() {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['contact_form_submit'])) {
        global $wpdb;
        $table_name = $wpdb->prefix . 'contact_form';

        // Sanitize and validate input data
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $message = sanitize_textarea_field($_POST['message']);
        $phone = sanitize_text_field($_POST['phone']);
        $amount = floatval($_POST['amount']);

        // Insert data into the custom table
        $result = $wpdb->insert($table_name, array(
            'name' => $name,
            'email' => $email,
            'message' => $message,
            'phone' => $phone,
            'amount' => $amount,
        ));

        // Check if the insert was successful
        if ($result !== false) {
            // Optionally save as custom post type
            $post_id = wp_insert_post(array(
                'post_title' => 'Contact from ' . $name,
                'post_type' => 'contact_form',
                'post_status' => 'publish',
            ));

            if (!is_wp_error($post_id)) {
                update_post_meta($post_id, 'email', $email);
                update_post_meta($post_id, 'phone', $phone);
                update_post_meta($post_id, 'amount', $amount);
            } else {
                error_log('Failed to create contact form post: ' . $post_id->get_error_message());
            }

            // Redirect with success message
            wp_redirect(add_query_arg('success', '1', get_permalink()));
            exit;
        } else {
            // Log error if insertion fails
            error_log('Failed to insert contact form data into database.');
            wp_redirect(add_query_arg('error', '1', get_permalink()));
            exit;
        }
    }
}
add_action('init', 'handle_contact_form_submission');

?>