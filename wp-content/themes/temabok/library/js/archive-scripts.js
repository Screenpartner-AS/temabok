/*
 * Archive Scripts File
 *
 * This file will be called automatically in the footer
 *
*/

/*
 * Put all your regular jQuery in here.
*/
jQuery(document).ready(function($) {

	$(window).scroll(function () {
    var scroll = $(window).scrollTop();
		var filterHeight = $('.archive-header').outerHeight() + $('.header').outerHeight();
		var winHeight = $(window).height();
		var footerHeight = $('.footer').offset().top;
		var toggleBtn = $('.filters-toggle');

		if (((filterHeight - 85) < scroll) && (footerHeight > (winHeight + scroll))) {
			toggleBtn.addClass('active');
		} else {
			toggleBtn.removeClass('active');
		}
	});

	// Filters toggle
	$('.filters-toggle a').on('click', function(e) {
    $('html, body').animate({ scrollTop: 0 }, 500);
    e.preventDefault();
  });

}); /* end of as page load scripts */
