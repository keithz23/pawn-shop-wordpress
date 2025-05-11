<?php
/**
 * Template Name: 隱私權政策頁面範本 (Privacy Policy Page Template)
 *
 * This is the template that displays the custom privacy policy content.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/page-template-files/
 *
 * @package YourThemeName  // Replace YourThemeName with your actual theme's text domain or name
 */

get_header();
wp_enqueue_style('privacy-policy', get_template_directory_uri() . '/styles/privacy-policy.css', array(), '1.0.0', 'all');
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php
        // Start the Loop.
        while ( have_posts() ) :
            the_post();
            ?>

            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php
                // You can optionally display the WordPress Page Title using the_title()
                // if you want it above your custom content.
                // For this specific request, the title is part of the hardcoded content.
                // If you prefer the WP page title:
                // if ( get_the_title() ) {
                //     the_title( '<header class="entry-header"><h1 class="entry-title">', '</h1></header>' );
                // }
                ?>

                <div class="entry-content privacy-policy-container">
                    <h1>忠款資產管理 隱私權政策</h1>

                    <p>忠款資產管理（以下簡稱「本公司」）為保護您的個人資料，讓您安心使用本公司提供的各項服務，特此說明本隱私權政策（以下簡稱「本政策」）。請您詳閱以下內容，以了解我們如何蒐集、使用及保護您的個人資料。</p>

                    <h2>一、適用範圍</h2>
                    <p>本政策適用於您在使用本公司網站及其相關服務時，涉及的個人資料蒐集、處理及利用行為。不適用於連結至其他網站之情況，請另參考該等網站之隱私政策。</p>

                    <h2>二、個人資料的蒐集與使用</h2>
                    <p>本公司基於特定業務目的及依據相關法令規定，蒐集並使用您的個人資料。除法律另有規定或經您事前同意外，本公司不會將您的個人資料提供予第三方或作其他用途。以下為可能使用個人資料的情形：</p>
                    <ul>
                        <li>配合法院、檢警調等司法機關或其他主管機關之調查或命令；</li>
                        <li>為行使本公司或債權人之法律權利、帳務催收或訴訟防禦；</li>
                        <li>公司業務重組、合併、收購時資料之轉移，並將於轉移前告知您；</li>
                        <li>委託第三方提供服務時，將要求其遵守資料保護相關規範。</li>
                    </ul>

                    <h2>三、個人資料安全保護</h2>
                    <p>本公司採用合理且嚴謹之資訊安全技術與管理措施，保障您的個人資料不被未經授權之存取、使用或洩漏。本公司人員皆經資訊安全訓練並簽署保密協議，違反者將依法處理。</p>

                    <h2>四、蒐集之資料類別</h2>
                    <p>依據法務部《個人資料保護法》及其子法規定，可能蒐集的個人資料類型包括（代碼如有修訂，將依更新調整）：</p>
                    <ul>
                        <li>C001～C003：身份及財務識別資訊</li>
                        <li>C011～C038：個人描述、家庭情形、財產及職業</li>
                        <li>C081～C086：收入、資產、信用評等與債務資料等</li>
                    </ul>

                    <h2>五、蒐集之特定目的</h2>
                    <p>本公司蒐集個人資料的特定目的包括但不限於：</p>
                    <ul>
                        <li>069：契約或法律關係事務</li>
                        <li>081：個人資料合法交易</li>
                        <li>090：客戶管理與服務</li>
                        <li>137：資訊安全管理</li>
                        <li>154：徵信</li>
                        <li>176：正當性之蒐集利用</li>
                        <li>181～182：本公司依法登記營業項目所需之諮詢或顧問服務</li>
                    </ul>

                    <h2>六、Cookies 使用說明</h2>
                    <p>為提升服務品質，本公司網站可能使用 Cookies 技術記錄使用行為。您可透過瀏覽器設定拒絕 Cookies，但此舉可能導致部分功能無法正常運作。</p>

                    <h2>七、政策修訂</h2>
                    <p>本公司將因應法令變動、業務需求或資訊安全調整，保留隨時修訂本政策之權利。修訂後之政策將公告於本網站，恕不另行個別通知。建議您定期查閱，以保障自身權益。</p>

                </div><!-- .entry-content -->
            </article><!-- #post-## -->

            <?php

        endwhile; // End of the loop.
        ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
// get_sidebar(); // Uncomment if you want a sidebar on this page
get_footer();
?>
