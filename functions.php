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

// Enqueue scripts and styles
function theme_scripts() {
    // Enqueue Google Fonts
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@400;500;700&family=Noto+Serif+TC:wght@600;700&display=swap', array(), null);
    
    // Enqueue Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css', array(), '6.0.0');
    
    // Enqueue main stylesheet
    wp_enqueue_style('zongkuan-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_style('zongkuan-main', get_template_directory_uri() . '/style.css', array(), '1.0.0');
    
    // Enqueue JavaScript
    wp_enqueue_script('zongkuan-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '1.0.0', true);
    
    // Enqueue carousel script
    wp_enqueue_script('zongkuan-carousel', get_template_directory_uri() . '/js/carousel.js', array('jquery'), '1.0.0', true);
    
    // Enqueue main script
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
        'name_admin_bar'        => _x('Contact Form', 'Add New on Toolbar', 'textdomain'),
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
        'Contact Form Submissions',  // Page title
        'Contact Forms',             // Menu title
        'manage_options',            // Capability
        'contact-forms',             // Menu slug
        'display_contact_forms',     // Callback function
        'dashicons-email',           // Icon
        25                           // Position
    );
}
add_action('admin_menu', 'register_contact_menu_page');



// Display Contact Forms in Admin
function display_contact_forms() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_form';
    $submissions = $wpdb->get_results("SELECT * FROM $table_name ORDER BY date DESC");

    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <?php if ($submissions) : ?>
            <table class="wp-list-table widefat fixed striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Amount</th>
                        <th>Message</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($submissions as $submission) : ?>
                        <tr>
                            <td><?php echo esc_html($submission->id); ?></td>
                            <td><?php echo esc_html($submission->name); ?></td>
                            <td><?php echo esc_html($submission->email); ?></td>
                            <td><?php echo esc_html($submission->phone); ?></td>
                            <td><?php echo esc_html($submission->amount); ?></td>
                            <td><?php echo esc_html($submission->message); ?></td>
                            <td><?php echo esc_html($submission->date); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else : ?>
            <p>No contact form submissions yet.</p>
        <?php endif; ?>
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
            'message' => $other . ' | Preferred time: ' . $time,
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