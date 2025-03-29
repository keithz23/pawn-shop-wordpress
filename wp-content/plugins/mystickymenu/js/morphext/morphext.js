/*!
 * morphext - Text Rotating Plugin for jQuery
 * https://github.com/ferbueno/morphext
 *
 * Built on jQuery Boilerplate
 * http://jqueryboilerplate.com/
 */

(function ($) {
  "use strict";

  const pluginName = "morphext",
    defaults = {
      animation: "bounce",
      speed: 2000,
      autoInit: true,
      phrases: [],
      animateCssVersion: "4.1.1",
      autoAttachAnimateCss: true,
    };

  function Plugin(element) {
    this.element = $(element);
    this._settings = $.extend(
      {},
      defaults,
      JSON.parse(this.element.attr("data-morphext-options"))
    );
    this._defaults = defaults;
    this._init();
  }

  Plugin.prototype = {
    _init: function () {
      this.element.addClass("morphext");

      // Attach AnimateCSS
      if (this._settings.autoAttachAnimateCss) {
        const animateCssPath = `https://cdnjs.cloudflare.com/ajax/libs/animate.css/${this._settings.animateCssVersion}/animate.min.css`;
        if (!$(`link[href='${animateCssPath}']`).length) {
          $(`<link href="${animateCssPath}" rel="stylesheet">`).appendTo("head");
        }
      }

      this._index = 0;
      this.animate();
      this.start();
    },
    animate: function () {
      // Calculate the index
      this._index = this._index % this._settings.phrases.length;

      // Create the span element
      const innserSpan = document.createElement("span");

      // Using plain vanilla to shorten method
      innserSpan.classList.add(
        "morphext__animated",
        "animate__animated",
        `animate__${this._settings.animation}`
      );

      // Add next phrase
      $(innserSpan).text(this._settings.phrases[this._index]);

      // Attach the new element to the parent
      this.element.html($(innserSpan).prop('outerHTML'));

      // Set next index
      this._index += 1;
    },
    start: function () {
      var $that = this;
      this._interval = setInterval(function () {
        $that.animate();
      }, this._settings.speed);
    },
    stop: function () {
      this._interval = clearInterval(this._interval);
    },
  };

  $.fn[pluginName] = function (options) {
    return this.each(function () {
      if (!$.data(this, "plugin_" + pluginName)) {
        $.data(this, "plugin_" + pluginName, new Plugin(this, options));
      }
    });
  };
})(jQuery);
