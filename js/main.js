jQuery(document).ready(function($) {
    // FAQ functionality
    $('.faq-question').on('click', function() {
      const $answer = $(this).next('.faq-answer');
      const $icon = $(this).find('i');
      
      // Toggle answer visibility
      if ($answer.hasClass('open')) {
        $answer.removeClass('open');
        $answer.css('max-height', '0');
        $icon.css('transform', 'rotate(0)');
      } else {
        $answer.addClass('open');
        $answer.css('max-height', $answer.prop('scrollHeight') + 'px');
        $icon.css('transform', 'rotate(180deg)');
      }
    });

    // Banner features click handler
    $('.banner-features span').on('click', function() {
        const categoryText = $(this).text().trim();
        const $categoryTab = $('.category-tab[data-category="' + categoryText + '"]');
        
        if ($categoryTab.length) {
            // Scroll to the category section
            $('html, body').animate({
                scrollTop: $('#服務項目').offset().top - 100
            }, 1000);

            // Activate the corresponding category tab
            $('.category-tab').removeClass('active');
            $categoryTab.addClass('active').trigger('click');
        }
    });
});