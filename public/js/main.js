/**
* Template Name: Pintarmedia Black - v2.2.1
* Template URL: #
* Author: Yuwono
* License: #
*/
!(function(i) {
    "use strict";
    function t() {
        i(".mobile-nav-overly").remove(), i("body").removeClass("mobile-nav-active"), i(".nav-menu").hide(), i(".mobile-nav-show").show(), i(".mobile-nav-hide").hide()
    }
      // Back to top button
      i(window).scroll(function() {
        100 < i(this).scrollTop() ? i(".back-to-top").hasClass("back-to-top-display") || i(".back-to-top").addClass("back-to-top-display") : i(".back-to-top").hasClass("back-to-top-display") && i(".back-to-top").removeClass("back-to-top-display")
    }), i(".back-to-top").click(function(e) {
        return e.preventDefault(), i("html, body").animate({
            scrollTop: 0
        }, 1500, "easeInOutExpo"), !0
    }), i(".search-bar-toggle").on("click", function() {
        i(".search-bar").is(":visible") ? i(".search-bar").slideUp() : i(".search-bar").slideDown()
    }), i(document).on("click", ".mobile-nav-show", function(e) {
        e.preventDefault(), i("body").append('<div class="mobile-nav-overly"></div>'), i("body").addClass("mobile-nav-active"), i(".nav-menu").show(), i(".mobile-nav-show").hide(), i(".mobile-nav-hide").show()
    }), i(document).on("click", ".mobile-nav-hide", function(e) {
        e.preventDefault(), t()
    }), i(document).on("click", ".mobile-nav-active .nav-menu li:not(.nav-categories) a", function(e) {
        t()
    }), i(document).on("click", ".mobile-nav-active .nav-categories > a", function(e) {
        e.preventDefault(), i(".nav-menu .nav-categories ul").toggleClass("d-flex")
    })
//   i(window).scroll(function() {
//     if (i(this).scrollTop() > 100) {
//         i(".back-to-top").addClass("back-to-top-display");
//         i('.back-to-top').fadeIn('slow');
//     } else {
//         i(".back-to-top").removeClass("back-to-top-display");
//         i('.back-to-top').fadeOut('slow');
//     }
//   });

//   i('.back-to-top').click(function() {
//     i('html, body').animate({
//       scrollTop: 0
//     }, 1500, 'easeInOutExpo');
//     return false;
//   });
})(jQuery);