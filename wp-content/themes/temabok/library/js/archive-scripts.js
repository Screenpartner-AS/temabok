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

	/*
	 * Toggle Filter Display
	 */
	$('.sp-filterbox-header').on('click', function(e) {
		e.preventDefault();
		var box_content = $(this).next('.sp-filterbox-content');
		$(this).toggleClass('closed');
		box_content.slideToggle('fast');
	});

	// Filters toggle
	$('.sp-toggle-mobile-filters').on('click', function() {
		$(this).toggleClass('active');
		$('.sidebar').toggleClass('active');
		$('.sp-overlay').toggleClass('active');
	});

	// Filters toggle
	$('.close-sidebar, .sp-overlay').on('click', function() {
		$('.sidebar').toggleClass('active');
		$('.sp-overlay').toggleClass('active');
	});

}); /* end of as page load scripts */
