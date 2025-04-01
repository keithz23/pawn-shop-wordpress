<?php

// Add theme support
function theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
    
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'zongkuan'),
    ));
}
add_action('after_setup_theme', 'theme_setup');

// Enqueue scripts and styles
function theme_scripts() {
    wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@400;500;700&family=Noto+Serif+TC:wght@600;700&display=swap', array(), null);
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css', array(), '6.0.0');
    wp_enqueue_style('zongkuan-style', get_stylesheet_uri(), array(), '1.0.0');
    wp_enqueue_style('zongkuan-main', get_template_directory_uri() . '/style.css', array(), '1.0.0');
    
    wp_enqueue_script('zongkuan-navigation', get_template_directory_uri() . '/js/navigation.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('zongkuan-carousel', get_template_directory_uri() . '/js/carousel.js', array('jquery'), '1.0.0', true);
    wp_enqueue_script('zongkuan-main', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true);

    wp_localize_script('zongkuan-navigation', 'themeData', array(
        'templateUrl' => get_template_directory_uri(),
        'contactEmail' => get_theme_mod('contact_email', 'zhongkuan001@gmail.com')
    ));
}
add_action('wp_enqueue_scripts', 'theme_scripts');

// Register Custom Post Types
function register_custom_post_types() {
    register_post_type('testimonial', array(
        'labels' => array(
            'name' => __('Testimonials', 'zongkuan'),
            'singular_name' => __('Testimonial', 'zongkuan'),
        ),
        'public' => true,
        'has_archive' => false,
        'supports' => array('title', 'editor', 'custom-fields'),
        'menu_icon' => 'dashicons-format-quote',
    ));

    register_post_type('faq', array(
        'labels' => array(
            'name' => __('FAQs', 'zongkuan'),
            'singular_name' => __('FAQ', 'zongkuan'),
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
    $wp_customize->add_section('contact_info', array(
        'title' => __('Contact Information', 'zongkuan'),
        'priority' => 30,
    ));

    $wp_customize->add_setting('contact_email', array(
        'default' => 'zhongkuan001@gmail.com',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('contact_email', array(
        'label' => __('Contact Email', 'zongkuan'),
        'section' => 'contact_info',
        'type' => 'email',
    ));

    $wp_customize->add_setting('line_url', array(
        'default' => 'https://line.me/ti/p/@599jmyld',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('line_url', array(
        'label' => __('Line URL', 'zongkuan'),
        'section' => 'contact_info',
        'type' => 'url',
    ));

    $wp_customize->add_setting('business_hours', array(
        'default' => '週一至週日: 08:00 - 21:00',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('business_hours', array(
        'label' => __('Business Hours', 'zongkuan'),
        'section' => 'contact_info',
        'type' => 'text',
    ));

    $wp_customize->add_section('video_settings', array(
        'title' => __('Video Settings', 'zongkuan'),
        'priority' => 32,
        'description' => __('Upload your video and set a thumbnail image.', 'zongkuan'),
    ));

    $wp_customize->add_setting('video_url', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control('video_url', array(
        'label' => __('Video URL', 'zongkuan'),
        'description' => __('Enter the URL of your MP4 video file', 'zongkuan'),
        'section' => 'video_settings',
        'type' => 'url',
    ));

    $wp_customize->add_setting('video_thumbnail', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'video_thumbnail', array(
        'label' => __('Video Thumbnail', 'zongkuan'),
        'description' => __('Select an image to show before the video plays', 'zongkuan'),
        'section' => 'video_settings',
    )));

    $wp_customize->add_section('carousel_settings', array(
        'title' => __('Carousel Settings', 'zongkuan'),
        'priority' => 33,
        'description' => __('Upload images for the carousel slider. You can add up to 8 images.', 'zongkuan'),
    ));

    for ($i = 1; $i <= 8; $i++) {
        $wp_customize->add_setting("carousel_image_$i", array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "carousel_image_$i", array(
            'label' => sprintf(__('Carousel Image %d', 'zongkuan'), $i),
            'description' => __('Upload or select an image', 'zongkuan'),
            'section' => 'carousel_settings',
        )));

        $wp_customize->add_setting("carousel_title_$i", array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("carousel_title_$i", array(
            'label' => sprintf(__('Image %d Title', 'zongkuan'), $i),
            'description' => __('Enter a title for this image (optional)', 'zongkuan'),
            'section' => 'carousel_settings',
            'type' => 'text',
        ));

        $wp_customize->add_setting("carousel_description_$i", array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ));
        $wp_customize->add_control("carousel_description_$i", array(
            'label' => sprintf(__('Image %d Description', 'zongkuan'), $i),
            'description' => __('Enter a description for this image (optional)', 'zongkuan'),
            'section' => 'carousel_settings',
            'type' => 'textarea',
        ));
    }

    $wp_customize->add_setting('carousel_autoplay', array(
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));
    $wp_customize->add_control('carousel_autoplay', array(
        'label' => __('Enable Autoplay', 'zongkuan'),
        'section' => 'carousel_settings',
        'type' => 'checkbox',
    ));

    $wp_customize->add_setting('carousel_speed', array(
        'default' => '5000',
        'sanitize_callback' => 'absint',
    ));
    $wp_customize->add_control('carousel_speed', array(
        'label' => __('Autoplay Speed (ms)', 'zongkuan'),
        'section' => 'carousel_settings',
        'type' => 'number',
        'input_attrs' => array(
            'min' => 1000,
            'max' => 10000,
            'step' => 500,
        ),
    ));

    $wp_customize->add_section('social_proof', array(
        'title' => __('Social Proof', 'zongkuan'),
        'priority' => 35,
    ));

    $wp_customize->add_setting('success_cases', array(
        'default' => '2000+',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('success_cases', array(
        'label' => __('Success Cases', 'zongkuan'),
        'section' => 'social_proof',
        'type' => 'text',
    ));

    $wp_customize->add_setting('satisfaction_rate', array(
        'default' => '98%',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('satisfaction_rate', array(
        'label' => __('Satisfaction Rate', 'zongkuan'),
        'section' => 'social_proof',
        'type' => 'text',
    ));

    $wp_customize->add_setting('years_experience', array(
        'default' => '20+',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('years_experience', array(
        'label' => __('Years Experience', 'zongkuan'),
        'section' => 'social_proof',
        'type' => 'text',
    ));
}
add_action('customize_register', 'theme_customizer_settings');

// Enqueue Section Assets
function enqueue_section_assets() {
    wp_enqueue_style('sections-style', get_template_directory_uri() . '/assets/css/sections.css', array(), '1.0.0');
    wp_enqueue_script('sections-script', get_template_directory_uri() . '/assets/js/sections.js', array(), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_section_assets');

// Add meta boxes for testimonials
function add_testimonial_meta_boxes() {
    add_meta_box(
        'testimonial_author',
        __('Author Information', 'zongkuan'),
        'testimonial_author_callback',

        'testimonial',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'add_testimonial_meta_boxes');

function testimonial_author_callback($post) {
    wp_nonce_field('testimonial_author_nonce', 'testimonial_author_nonce');
    $author = get_post_meta($post->ID, '_testimonial_author', true);
    ?>
    <p>
        <label for="testimonial_author"><?php _e('Author Name:', 'zongkuan'); ?></label>
        <input type="text" id="testimonial_author" name="testimonial_author" value="<?php echo esc_attr($author); ?>" size="25" />
    </p>
    <?php
}

function save_testimonial_meta($post_id) {
    if (!isset($_POST['testimonial_author_nonce']) || !wp_verify_nonce($_POST['testimonial_author_nonce'], 'testimonial_author_nonce')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (isset($_POST['testimonial_author'])) {
        update_post_meta($post_id, '_testimonial_author', sanitize_text_field($_POST['testimonial_author']));
    }
}
add_action('save_post_testimonial', 'save_testimonial_meta');

// Add default testimonials
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
        $existing_testimonial = get_page_by_title($testimonial['title'], OBJECT, 'testimonial');
        if (!$existing_testimonial) {
            $post_data = array(
                'post_title' => $testimonial['title'],
                'post_content' => $testimonial['content'],
                'post_status' => 'publish',
                'post_type' => 'testimonial'
            );
            $post_id = wp_insert_post($post_data, true);
            if (is_wp_error($post_id)) {
                error_log('Failed to insert testimonial: ' . $post_id->get_error_message());
            } else {
                update_post_meta($post_id, '_testimonial_author', $testimonial['author']);
            }
        }
    }
}
add_action('after_switch_theme', 'add_default_testimonials');

// Create Contact Page
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
        }
    } else {
        update_post_meta($contact_page->ID, '_wp_page_template', 'page-contact.php');
    }
}
add_action('after_switch_theme', 'create_contact_page');

// Register Admin Menu Page
function register_contact_menu_page() {
    add_menu_page(
        'Contact Form Submissions',
        'Contact Forms',
        'manage_options',
        'contact-forms',
        'display_contact_forms',
        'dashicons-email',
        25
    );
}
add_action('admin_menu', 'register_contact_menu_page');

// Display Contact Forms Page
function display_contact_forms() {
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <p>This page will display contact form submissions (to be implemented).</p>
    </div>
    <?php
}

// Create Contact Form Table
function create_contact_form_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . 'contact_form';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE $table_name (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        message TEXT NOT NULL,
        phone VARCHAR(50),
        amount DECIMAL(10, 2),
        date DATETIME DEFAULT CURRENT_TIMESTAMP
    ) $charset_collate;";

    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
    dbDelta($sql);
}
add_action('after_switch_theme', 'create_contact_form_table');

// Register Contact Form Post Type
function create_contact_form_post_type() {
    register_post_type('contact_form', array(
        'labels' => array(
            'name' => __('Contact Forms', 'zongkuan'),
            'singular_name' => __('Contact Form', 'zongkuan')
        ),
        'public' => false,
        'show_ui' => true,
        'supports' => array('title', 'custom-fields'),
        'menu_icon' => 'dashicons-email',
    ));
}
add_action('init', 'create_contact_form_post_type');

// Custom Columns for Contact Form
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
  }
add_action('manage_contact_form_posts_custom_column', 'contact_form_custom_columns', 10, 2);

// Template Filter
add_filter('template_include', function ($template) {
    if (is_page('contact')) {
        $new_template = locate_template(array('page-contact.php'));
        if (!empty($new_template)) {
            return $new_template;
        }
    }
    return $template;
});