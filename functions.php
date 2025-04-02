<?php

// Add theme support
function theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    
    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'zongkuan'),
    ));
}
add_action('after_setup_theme', 'theme_setup');

function theme_scripts() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@400;500;700&family=Noto+Serif+TC:wght@600;700&display=swap', array(), null);
    
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css', array(), '6.0.0');

    wp_register_style('zongkuan-home', get_template_directory_uri() . '/styles/style.css', array(), '1.0.0');
    wp_register_style('zongkuan-contact', get_template_directory_uri() . '/styles/contact.css', array(), '1.0.0');

    if (is_front_page()) { 
        wp_enqueue_style('zongkuan-home');
    } elseif (is_page('contact')) { 
        wp_enqueue_style('zongkuan-contact');
    } else {
        wp_enqueue_style('zongkuan-style', get_stylesheet_uri(), array(), '1.0.0');
    }

    wp_enqueue_script('zongkuan-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('zongkuan-carousel', get_template_directory_uri() . '/js/carousel.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('zongkuan-main', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true);

    // Localize the navigation script
    wp_localize_script('zongkuan-navigation', 'themeData', array(
        'templateUrl' => get_template_directory_uri(),
        'contactEmail' => get_theme_mod('contact_email', 'zhongkuan001@gmail.com')
    ));
}
add_action('wp_enqueue_scripts', 'theme_scripts');

// Register Custom Post Types
function register_custom_post_types() {
    // Testimonials
    register_post_type('testimonial', array(
        'labels' => array(
            'name' => __('Testimonials', 'your-theme-domain'),
            'singular_name' => __('Testimonial', 'your-theme-domain'),
        ),
        'public' => true,
        'has_archive' => false,
        'supports' => array('title', 'editor', 'custom-fields'),
        'menu_icon' => 'dashicons-format-quote',
    ));

    // FAQs
    register_post_type('faq', array(
        'labels' => array(
            'name' => __('FAQs', 'your-theme-domain'),
            'singular_name' => __('FAQ', 'your-theme-domain'),
        ),
        'public' => true,
        'has_archive' => false,
        'supports' => array('title', 'editor'),
        'menu_icon' => 'dashicons-editor-help',
    ));
}
add_action('init', 'register_custom_post_types');

// Add Theme Customizer Settings
function theme_customizer_settings($wp_customize) {
    // Contact Information Section
    $wp_customize->add_section('contact_info', array(
        'title' => __('Contact Information', 'your-theme-domain'),
        'priority' => 30,
    ));

    // Email Setting
    $wp_customize->add_setting('contact_email', array(
        'default' => 'zhongkuan001@gmail.com',
        'sanitize_callback' => 'sanitize_email',
    ));

    $wp_customize->add_control('contact_email', array(
        'label' => __('Contact Email', 'your-theme-domain'),
        'section' => 'contact_info',
        'type' => 'email',
    ));

    // Line URL Setting
    $wp_customize->add_setting('line_url', array(
        'default' => 'https://line.me/ti/p/@599jmyld',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('line_url', array(
        'label' => __('Line URL', 'your-theme-domain'),
        'section' => 'contact_info',
        'type' => 'url',
    ));

    // Business Hours Setting
    $wp_customize->add_setting('business_hours', array(
        'default' => '週一至週日: 08:00 - 21:00',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('business_hours', array(
        'label' => __('Business Hours', 'your-theme-domain'),
        'section' => 'contact_info',
        'type' => 'text',
    ));

    // Video Section
    $wp_customize->add_section('video_settings', array(
        'title' => __('Video Settings', 'your-theme-domain'),
        'priority' => 32,
        'description' => __('Upload your video and set a thumbnail image.', 'your-theme-domain'),
    ));

    // Video URL Setting
    $wp_customize->add_setting('video_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('video_url', array(
        'label' => __('Video URL', 'your-theme-domain'),
        'description' => __('Enter the URL of your MP4 video file', 'your-theme-domain'),
        'section' => 'video_settings',
        'type' => 'url',
    ));

    // Video Thumbnail Setting
    $wp_customize->add_setting('video_thumbnail', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'video_thumbnail', array(
        'label' => __('Video Thumbnail', 'your-theme-domain'),
        'description' => __('Select an image to show before the video plays', 'your-theme-domain'),
        'section' => 'video_settings',
    )));

    // Carousel Section
    $wp_customize->add_section('carousel_settings', array(
        'title' => __('Carousel Settings', 'your-theme-domain'),
        'priority' => 33,
        'description' => __('Upload images for the carousel slider. You can add up to 8 images.', 'your-theme-domain'),
    ));

    // Carousel Images
    for ($i = 1; $i <= 8; $i++) {
        $wp_customize->add_setting("carousel_image_$i", array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "carousel_image_$i", array(
            'label' => sprintf(__('Carousel Image %d', 'your-theme-domain'), $i),
            'description' => __('Upload or select an image', 'your-theme-domain'),
            'section' => 'carousel_settings',
        )));

        // Image Title Setting
        $wp_customize->add_setting("carousel_title_$i", array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control("carousel_title_$i", array(
            'label' => sprintf(__('Image %d Title', 'your-theme-domain'), $i),
            'description' => __('Enter a title for this image (optional)', 'your-theme-domain'),
            'section' => 'carousel_settings',
            'type' => 'text',
        ));

        // Image Description Setting
        $wp_customize->add_setting("carousel_description_$i", array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control("carousel_description_$i", array(
            'label' => sprintf(__('Image %d Description', 'your-theme-domain'), $i),
            'description' => __('Enter a description for this image (optional)', 'your-theme-domain'),
            'section' => 'carousel_settings',
            'type' => 'textarea',
        ));
    }

    // Carousel Settings
    $wp_customize->add_setting('carousel_autoplay', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));

    $wp_customize->add_control('carousel_autoplay', array(
        'label' => __('Enable Autoplay', 'your-theme-domain'),
        'section' => 'carousel_settings',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('carousel_speed', array(
        'default' => '5000',
        'sanitize_callback' => 'absint',
    ));

    $wp_customize->add_control('carousel_speed', array(
        'label' => __('Autoplay Speed (ms)', 'your-theme-domain'),
        'section' => 'carousel_settings',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 1000,
            'max' => 10000,
            'step' => 500,
        ),
    ));

    // Social Proof Section
    $wp_customize->add_section('social_proof', array(
        'title' => __('Social Proof', 'your-theme-domain'),
        'priority' => 35,
    ));

    // Success Cases
    $wp_customize->add_setting('success_cases', array(
        'default' => '2000+',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('success_cases', array(
        'label' => __('Success Cases', 'your-theme-domain'),
        'section' => 'social_proof',
        'type' => 'text',
    ));

    // Satisfaction Rate
    $wp_customize->add_setting('satisfaction_rate', array(
        'default' => '98%',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('satisfaction_rate', array(
        'label' => __('Satisfaction Rate', 'your-theme-domain'),
        'section' => 'social_proof',
        'type' => 'text',
    ));

    // Years Experience
    $wp_customize->add_setting('years_experience', array(
        'default' => '20+',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('years_experience', array(
        'label' => __('Years Experience', 'your-theme-domain'),
        'section' => 'social_proof',
        'type' => 'text',
    ));
}
add_action('customize_register', 'theme_customizer_settings');

// Enqueue Scripts and Styles
function enqueue_section_assets() {
    wp_enqueue_style('sections-style', get_template_directory_uri() . '/assets/css/sections.css', array(), '1.0.0');
    wp_enqueue_script('sections-script', get_template_directory_uri() . '/assets/js/sections.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_section_assets');

// Add meta boxes for testimonials
function add_testimonial_meta_boxes() {
    add_meta_box(
        'testimonial_author',
        __('Author Information', 'your-theme-domain'),
        'testimonial_author_callback',
        'testimonial',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_testimonial_meta_boxes');

// Callback function for the author meta box
function testimonial_author_callback($post) {
    wp_nonce_field('testimonial_author_nonce', 'testimonial_author_nonce');
    $author = get_post_meta($post->ID, '_testimonial_author', true);
    ?>
    <p>
        <label for="testimonial_author"><?php _e('Author Name:', 'your-theme-domain'); ?></label>
        <input type="text" id="testimonial_author" name="testimonial_author" value="<?php echo esc_attr($author); ?>" size="25" />
    </p>
    <?php
}

// Save testimonial meta data
function save_testimonial_meta($post_id) {
    if (!isset($_POST['testimonial_author_nonce'])) {
        return;
    }
    if (!wp_verify_nonce($_POST['testimonial_author_nonce'], 'testimonial_author_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (isset($_POST['testimonial_author'])) {
        update_post_meta(
            $post_id,
            '_testimonial_author',
            sanitize_text_field($_POST['testimonial_author'])
        );
    }
}
add_action('save_post_testimonial', 'save_testimonial_meta');

// Function to add default testimonials
function add_default_testimonials() {
    $default_testimonials = array(
        array(
            'title' => '專業服務評價',
            'content' => '服務非常專業，估價合理，整個過程都很順利，讓人很放心。',
            'author' => '王小姐'
        ),
        array(
            'title' => '快速服務評價',
            'content' => '急需資金時找到忠款，15分鐘內就完成手續，真的很感謝！',
            'author' => '李先生'
        ),
        array(
            'title' => '透明服務評價',
            'content' => '利率透明，服務態度好，是值得信賴的。',
            'author' => '張先生'
        )
    );

    foreach ($default_testimonials as $testimonial) {
        // Check if testimonial already exists
        $existing_testimonial = get_page_by_title($testimonial['title'], OBJECT, 'testimonial');
        
        if (!$existing_testimonial) {
            $post_data = array(
                'post_title' => $testimonial['title'],
                'post_content' => $testimonial['content'],
                'post_status' => 'publish',
                'post_type' => 'testimonial'
            );
            
            $post_id = wp_insert_post($post_data);
            
            if ($post_id) {
                update_post_meta($post_id, '_testimonial_author', $testimonial['author']);
            }
        }
    }
}
// Hook to run after theme activation
add_action('after_switch_theme', 'add_default_testimonials');

function create_contact_page() {
    $contact_page = get_page_by_path('contact');
    
    if (!$contact_page) {
        $contact_page_args = array(
            'post_title'    => '聯繫我們',
            'post_content'  => '<!-- wp:paragraph --><p>Contact page content will be handled by the template.</p><!-- /wp:paragraph -->',
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_name'     => 'contact',
        );
        
        $page_id = wp_insert_post($contact_page_args, true);
        if (!is_wp_error($page_id)) {
            update_post_meta($page_id, '_wp_page_template', 'page-contact.php');
            flush_rewrite_rules();
        } else {
            error_log('Failed to create contact page: ' . $page_id->get_error_message());
        }
    } else {
        update_post_meta($contact_page->ID, '_wp_page_template', 'page-contact.php');
    }
}
add_action('after_switch_theme', 'create_contact_page');

function register_contact_menu_page() {
    // Register Custom Post Type
    $labels = array(
        'name'                  => _x('Contact Forms', 'Post type general name', 'textdomain'),
        'singular_name'         => _x('Contact Form', 'Post type singular name', 'textdomain'),
        'menu_name'             => _x('Contact Forms', 'Admin Menu text', 'textdomain'),
        'name_admin_bar'        => _x('Contact Form ', 'Add New on Toolbar', 'textdomain'),
        'add_new'               => __('Add New', 'textdomain'),
        'add_new_item'          => __('Add New Contact Form', 'textdomain'),
        'new_item'              => __('New Contact Form', 'textdomain'),
        'edit_item'             => __('Edit Contact Form', 'textdomain'),
        'view_item'             => __('View Contact Form', 'textdomain'),
        'all_items'             => __('All Contact Forms', 'textdomain'),
        'search_items'          => __('Search Contact Forms', 'textdomain'),
        'not_found'             => __('No contact forms found.', 'textdomain'),
    );

    $args = array(
        'labels'                => $labels,
        'public'                => false,           // Not visible on frontend
        'show_ui'               => true,            // Visible in admin
        'show_in_menu'          => 'contact-forms', // Attach to the custom menu
        'query_var'             => false,
        'rewrite'               => false,
        'capability_type'       => 'post',
        'has_archive'           => false,
        'hierarchical'          => false,
        'supports'              => array('title', 'custom-fields'),
    );
    register_post_type('contact_form', $args);

    // Register Admin Menu Page
    add_menu_page(
        '聯絡表單提交',  // Page title
        '客服訊息',             // Menu title
        'manage_options',            // Capability
        'contact-forms',             // Menu slug
        'display_contact_forms',     // Callback function
        'dashicons-email',           // Icon
        25                           // Position
    );
}
add_action('admin_menu', 'register_contact_menu_page');

function export_contact_form_csv() {
    if (!current_user_can('manage_options')) {
        wp_die('You do not have permission to access this action.', 'Permission Denied', array('response' => 403));
    }

    if (!isset($_POST['export_nonce']) || !wp_verify_nonce($_POST['export_nonce'], 'export_contact_form_csv_nonce')) {
        wp_die('Nonce verification failed', 'Error', array('response' => 403));
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_form';
    $submissions = $wpdb->get_results("SELECT * FROM $table_name ORDER BY date DESC");

    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename="聯絡表單提交_' . date('Y-m-d_H-i-s') . '.csv"');

    $output = fopen('php://output', 'w');
    fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

    fputcsv($output, array('編號', '姓名', '電子郵件', '電話', '金額', '訊息', '日期', '已連絡'));

    foreach ($submissions as $submission) {
        fputcsv($output, array(
            $submission->id,
            $submission->name,
            $submission->email,
            $submission->phone,
            $submission->amount,
            $submission->message,
            $submission->date,
            $submission->is_contacted ? '是' : '否'
        ));
    }

    fclose($output);
    exit;
}
add_action('admin_post_export_contact_form_csv', 'export_contact_form_csv');

function update_contact_form_marked() {
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'update_marked_nonce')) {
        wp_send_json_error(array('message' => 'Nonce verification failed'), 403);
    }

    if (!current_user_can('manage_options')) {
        wp_send_json_error(array('message' => 'Permission denied'), 403);
    }

    $submission_id = isset($_POST['submission_id']) ? intval($_POST['submission_id']) : 0;
    $is_contacted = isset($_POST['is_contacted']) ? intval($_POST['is_contacted']) : 0;

    if ($submission_id <= 0) {
        wp_send_json_error(array('message' => 'Invalid submission ID'), 400);
    }

    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_form';

    $table_exists = $wpdb->get_var("SHOW TABLES LIKE '$table_name'");
    if (!$table_exists) {
        error_log("Table $table_name does not exist");
        wp_send_json_error(array('message' => 'Table does not exist'), 500);
    }

    $column_exists = $wpdb->get_results("SHOW COLUMNS FROM $table_name LIKE 'is_contacted'");
    if (empty($column_exists)) {
        error_log("Column is_contacted does not exist in $table_name");
        wp_send_json_error(array('message' => 'Column is_contacted does not exist'), 500);
    }

    $updated = $wpdb->update(
        $table_name,
        array('is_contacted' => $is_contacted),
        array('id' => $submission_id),
        array('%d'),
        array('%d')
    );

    if ($updated === false) {
        error_log("Failed to update $table_name: " . $wpdb->last_error);
        wp_send_json_error(array('message' => 'Failed to update database: ' . $wpdb->last_error), 500);
    }

    wp_send_json_success();
}
add_action('wp_ajax_update_contact_form_marked', 'update_contact_form_marked');

function display_contact_forms() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_form';
    $submissions = $wpdb->get_results("SELECT * FROM $table_name ORDER BY date DESC");

    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form method="post" action="<?php echo admin_url('admin-post.php'); ?>" style="margin-bottom: 10px;">
            <input type="hidden" name="action" value="export_contact_form_csv">
            <?php wp_nonce_field('export_contact_form_csv_nonce', 'export_nonce'); ?>
            <input type="submit" class="button button-primary" value="匯出為CSV">
        </form>

        <table class="wp-list-table widefat fixed striped">
            <thead>
                <tr>
                    <th><input type="checkbox" id="select-all"></th>
                    <th>編號</th>
                    <th>姓名</th>
                    <th>電子郵件</th>
                    <th>電話</th>
                    <th>金額</th>
                    <th>訊息</th>
                    <th>日期</th>
                    <th>已連絡</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($submissions) : ?>
                    <?php foreach ($submissions as $submission) : ?>
                        <tr>
                            <td>
                                <input type="checkbox" 
                                       name="submission_ids[]" 
                                       value="<?php echo esc_attr($submission->id); ?>" 
                                       class="submission-checkbox" 
                                       <?php checked($submission->is_contacted, 1); ?>
                                       data-id="<?php echo esc_attr($submission->id); ?>">
                            </td>
                            <td><?php echo esc_html($submission->id); ?></td>
                            <td><?php echo esc_html($submission->name); ?></td>
                            <td><?php echo esc_html($submission->email); ?></td>
                            <td><?php echo esc_html($submission->phone); ?></td>
                            <td><?php echo esc_html($submission->amount); ?></td>
                            <td><?php echo esc_html($submission->message); ?></td>
                            <td><?php echo esc_html($submission->date); ?></td>
                            <td class="marked-status"><?php echo $submission->is_contacted ? '是' : '否'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="9">尚無聯絡表單提交</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const selectAll = document.getElementById('select-all');
                const checkboxes = document.querySelectorAll('.submission-checkbox');

                const ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
                const nonce = '<?php echo wp_create_nonce('update_marked_nonce'); ?>';

                selectAll.addEventListener('change', function() {
                    const isChecked = this.checked;
                    checkboxes.forEach(checkbox => {
                        checkbox.checked = isChecked;
                        updateMarkedStatus(checkbox);
                    });
                });

                checkboxes.forEach(checkbox => {
                    checkbox.addEventListener('change', function() {
                        updateMarkedStatus(this);
                    });
                });

                function updateMarkedStatus(checkbox) {
                    const submissionId = checkbox.getAttribute('data-id');
                    const isMarked = checkbox.checked ? 1 : 0;
                    const row = checkbox.closest('tr');
                    const statusCell = row.querySelector('.marked-status');

                    jQuery.ajax({
                        url: ajaxurl,
                        type: 'POST',
                        data: {
                            action: 'update_contact_form_marked',
                            submission_id: submissionId,
                            is_contacted: isMarked,
                            nonce: nonce
                        },
                        success: function(response) {
                            if (response.success) {
                                statusCell.textContent = isMarked ? '是' : '否';
                            } else {
                                alert('Failed to update: ' + response.data.message);
                                checkbox.checked = !checkbox.checked;
                            }
                        },
                        error: function() {
                            alert('An error occurred while updating.');
                            checkbox.checked = !checkbox.checked; 
                        }
                    });
                }
            });
        </script>
    </div>
    <?php
}

function create_contact_form_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_form';
    $charset_collate = $wpdb->get_charset_collate();

    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
        $sql = "CREATE TABLE $table_name (
            id INT NOT NULL AUTO_INCREMENT,
            name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            message TEXT NOT NULL,
            phone VARCHAR(50),
            amount DECIMAL(10,2),
            date DATETIME DEFAULT CURRENT_TIMESTAMP,
            is_contacted TINYINT(1) DEFAULT 0,
            PRIMARY KEY (id)
        ) $charset_collate;";

        require_once ABSPATH . 'wp-admin/includes/upgrade.php';
        dbDelta($sql);

        error_log("Tried to create table $table_name");
    }
}
add_action('after_switch_theme', 'create_contact_form_table');

// Custom Columns for Contact Form Post Type
function contact_form_admin_columns($columns) {
    $columns['email'] = 'Email';
    $columns['phone'] = 'Phone';
    $columns['amount'] = 'Amount';
    return $columns;
}
add_filter('manage_contact_form_posts_columns', 'contact_form_admin_columns');

function contact_form_custom_columns($column, $post_id) {
    switch ($column) {
        case 'email':
            echo esc_html(get_post_meta($post_id, 'email', true));
            break;
        case 'phone':
            echo esc_html(get_post_meta($post_id, 'phone', true));
            break;
        case 'amount':
            echo esc_html(get_post_meta($post_id, 'amount', true));
            break;
    }
}
add_action('manage_contact_form_posts_custom_column', 'contact_form_custom_columns', 10, 2);

function handle_contact_form_submission() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (!isset($_POST['contact_form_nonce']) || !wp_verify_nonce($_POST['contact_form_nonce'], 'contact_form_action')) {
            wp_die('Nonce verification failed', 'Error', array('response' => 403));
        }

        global $wpdb;
        $table_name = $wpdb->prefix . 'contact_form';

        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $amount = floatval($_POST['amount']);
        $phone = sanitize_text_field($_POST['phone']);
        $time = sanitize_text_field($_POST['time']);
        $other = sanitize_textarea_field($_POST['other']);

        $result = $wpdb->insert($table_name, [
            'name'    => $name,
            'email'   => $email,
            'phone'   => $phone,
            'amount'  => $amount,
            'message' => $other . ' | 請選擇聯絡時段: ' . $time,
        ]);

        if ($result) {
            wp_safe_redirect(home_url('/contact/?success=1'));
        } else {
            wp_die('Database error', 'Error', array('response' => 500));
        }
        exit;
    }
}

add_action('admin_post_nopriv_handle_contact_form', 'handle_contact_form_submission');
add_action('admin_post_handle_contact_form', 'handle_contact_form_submission');


function hide_admin_menus() {
    global $menu;

    $allowed_menus = ['contact-forms']; 

    // Loop through each menu item
    foreach ($menu as $key => $value) {
        // Check if the menu slug is not in the allowed list and remove it
        if (!in_array($value[2], $allowed_menus)) {
            remove_menu_page($value[2]);
        }
    }
}
add_action('admin_menu', 'hide_admin_menus', 999);


// Add a filter to ensure template is loaded
add_filter('template_include', function($template) {
    if (is_page('contact')) {
        $new_template = locate_template(array('page-contact.php'));
        if (!empty($new_template)) {
            return $new_template;
        }
    }
    return $template;
}); 