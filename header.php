<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Floating Contact Button -->
<div class="floating-contact">
    <a href="<?php echo esc_url(get_theme_mod('line_id', 'https://line.me/ti/p/@599jmyld')); ?>" class="floating-line" target="_blank">
        <i class="fab fa-line"></i>
    </a>
    <a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email', 'zhongkuan001@gmail.com')); ?>" class="floating-phone">
        <i class="fas fa-envelope"></i>
    </a>
</div>

<header class="fixed-navbar">
    <div class="top-bar">
        <div class="top-bar-container">
            <p>
                <a href="mailto:<?php echo esc_attr(get_theme_mod('contact_email', 'zhongkuan001@gmail.com')); ?>" class="top-bar-link">
                    <i class="fas fa-envelope"></i> Email
                </a>
                |
                <a href="<?php echo esc_url(get_theme_mod('line_id', 'https://line.me/ti/p/@599jmyld')); ?>" target="_blank" class="top-bar-link">
                    <i class="fa-brands fa-line"></i> Line
                </a>
            </p>
        </div>
    </div>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="logo">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <?php if (has_custom_logo()): ?>
                    <?php the_custom_logo(); ?>
                <?php else: ?>
                    <img src="<?php echo esc_url(get_theme_file_uri('assets/logo.jpg')); ?>" alt="<?php bloginfo('name'); ?>" class="logo-image">
                <?php endif; ?>
                <div class="logo-text-container">
                    <span class="logo-text"><?php bloginfo('name'); ?></span>
                    <span class="logo-text">Zong kuan Asset Management</span>
                </div>
            </a>
        </div>
        <div class="menu-toggle">
            <i class="fas fa-bars"></i>
        </div>
        <ul class="nav-links">
            <?php 
            $current_page_id = get_queried_object_id();
            $is_homepage = is_front_page();
            $home_url = home_url('/');
            ?>
            <li><a href="<?php echo $is_homepage ? '#服務項目' : $home_url . '#服務項目'; ?>">服務項目</a></li>
            <li><a href="<?php echo $is_homepage ? '#優勢' : $home_url . '#優勢'; ?>">服務優勢</a></li>
            <li><a href="<?php echo $is_homepage ? '#常見問題' : $home_url . '#常見問題'; ?>">常見問題</a></li>
            <li><a href="<?php echo esc_url(get_permalink(get_page_by_path('contact'))); ?>"><?php echo esc_html__('聯繫我們', 'your-theme-domain'); ?></a></li>
        </ul>
    </nav>
</header>