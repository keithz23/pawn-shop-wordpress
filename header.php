<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?php bloginfo('description'); ?>">
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-17054481244"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'AW-17054481244');
    </script>
    <!-- Event snippet for 點擊-LINE按鈕 -->
    <script>
      function gtag_report_conversion(url) {
        var callback = function () {
          if (typeof(url) != 'undefined') {
            window.location = url;
          }
        };
        gtag('event', 'conversion', {
          'send_to': 'AW-17054481244/D_jeCOzsk8MaENz2msQ_',
          'event_callback': callback
        });
        return false;
      }
    </script>
    <script>(function(w,d,t,r,u){var f,n,i;w[u]=w[u]||[],f=function(){var o={ti:"97186346", enableAutoSpaTracking: true};o.q=w[u],w[u]=new UET(o),w[u].push("pageLoad")},n=d.createElement(t),n.src=r,n.async=1,n.onload=n.onreadystatechange=function(){var s=this.readyState;s&&s!=="loaded"&&s!=="complete"||(f(),n.onload=n.onreadystatechange=null)},i=d.getElementsByTagName(t)[0],i.parentNode.insertBefore(n,i)})(window,document,"script","//bat.bing.com/bat.js","uetq");</script>
    <title><?php wp_title('|', true, 'right'); bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Floating Contact Button -->
<div class="floating-contact">
    <a href="<?php echo esc_url(get_theme_mod('line_id', 'https://line.me/ti/p/@599jmyld')); ?>" class="floating-line" target="_blank" onclick="return gtag_report_conversion('<?php echo esc_url(get_theme_mod('line_id', 'https://line.me/ti/p/@599jmyld')); ?>');">
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
