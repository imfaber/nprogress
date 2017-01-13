/**
 * @file
 */
(function ($, Drupal, drupalSettings) {

  'use strict';

  Drupal.behaviors.ajaxNProgress = {
    attach: function (context, settings) {
      if (typeof NProgress === 'undefined') {
        return;
      }

      var color = drupalSettings.nprogress.ajax_color;

      $(document, context).ajaxStart(function () {
        NProgress.start();
        document.querySelector('#nprogress .bar').style.background = color;
        document.querySelector('#nprogress .peg').style.boxShadow = '0 0 10px ' + color + ', 0 0 5px ' + color;
        document.querySelector('#nprogress .spinner-icon').style.borderTopColor = color;
        document.querySelector('#nprogress .spinner-icon').style.borderLeftColor = color;
      });

      $(document, context).ajaxComplete(function () {
        NProgress.done();
      });

      $(document, context).ajaxError(function () {
        NProgress.done();
      });
    }
  };

}(jQuery, Drupal, drupalSettings));
