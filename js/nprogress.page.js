/**
 * @file
 */
(function (Drupal, drupalSettings) {

  "use strict";

  Drupal.behaviors.pageNProgress = {
    attach: function (context, settings) {
      if (typeof NProgress === 'undefined') {
        return;
      }

      var timer = drupalSettings.nprogress.timer;
      var color = drupalSettings.nprogress.page_color;

      function setColor() {
      document.querySelector('#nprogress .bar').style.background = color;
      document.querySelector('#nprogress .peg').style.boxShadow = '0 0 10px ' + color + ', 0 0 5px ' + color;
      document.querySelector('#nprogress .spinner-icon').style.borderTopColor = color;
      document.querySelector('#nprogress .spinner-icon').style.borderLeftColor = color;
      }

      NProgress.set(0.4);
      setColor();
      NProgress.inc();

      window.setTimeout(NProgress.done, timer);

      window.onbeforeunload = function() {
        NProgress.start();
        setColor();
      };
    }
  };

})(Drupal, drupalSettings);
