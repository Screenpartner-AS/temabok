/*
 * Bones Scripts File
 *
 * This file will be called automatically in the footer
 *
*/


/*
 * Get Viewport Dimensions
 * returns object with viewport dimensions to match css in width and height properties
 * ( source: http://andylangton.co.uk/blog/development/get-viewport-size-width-and-height-javascript )
*/
function updateViewportDimensions() {
	var w=window,d=document,e=d.documentElement,g=d.getElementsByTagName('body')[0],x=w.innerWidth||e.clientWidth||g.clientWidth,y=w.innerHeight||e.clientHeight||g.clientHeight;
	return { width:x,height:y };
}
// setting the viewport width
var viewport = updateViewportDimensions();

/*
 * We're going to swap out the gravatars.
 * In the functions.php file, you can see we're not loading the gravatar
 * images on mobile to save bandwidth. Once we hit an acceptable viewport
 * then we can swap out those images since they are located in a data attribute.
*/
function loadGravatars() {
  // set the viewport using the function above
  viewport = updateViewportDimensions();
  // if the viewport is tablet or larger, we load in the gravatars
  if (viewport.width >= 768) {
	  jQuery('.comment img[data-gravatar]').each(function(){
	    jQuery(this).attr('src',jQuery(this).attr('data-gravatar'));
	  });
	}
} // end function

var images = document.getElementsByClassName('effect-parallax');
var parallax_options = {
	delay: 1.8,
	orientation: 'up',
	scale: 1.3,
	overflow: false
};
var image_parallax = new simpleParallax(images, parallax_options);


/*
 * Put all your regular jQuery in here.
*/
jQuery(document).ready(function($) {

  loadGravatars();

	$('.nav-toggle').on('click', function(e) {
		e.preventDefault();

		$(this).toggleClass('active');
		$('.mobile-nav').toggleClass('active');
	});

	// var navigation = $('#nav-main').okayNav({
	// 	swipe_enabled: false
	// });

	var $carousel = $('.banner').flickity({
		cellAlign: 'left',
		contain: true,
		imagesLoaded: true,
		prevNextButtons: false,
		pageDots: true,
		autoPlay: 5000,
		dragThreshold: 10,
	});

	var lightbox = $('.wp-block-image a').simpleLightbox();

}); /* end of as page load scripts */

(function($) {
	$(document).on('facetwp-loaded', function() {
		if ( FWP.loaded ) {
			$(document).trigger('favorites-update-all-buttons');
		}
	});

	// Fix Ninja Forms submit on enter key press
	$(document).on('nfFormReady', function() {
		$('.nf-form-content input:not([type=button])').keypress(function(e) {
			if (e.keyCode == 13) {
				console.log('pressed enter');
				$('.nf-form-content .submit-container input[type=button]').focus().trigger('click');
			}
		});
	});
})(jQuery);

// (function($) {
// 	$(document).on('facetwp-loaded', function() {
// 		var page = FWP.settings.pager.page;
// 		var filterHeight = $('.archive-header').outerHeight() + $('.header').outerHeight();
//
// 		if (page < 2) {
// 			// Scroll to the top of the page after the page is refreshed
// 			$('html, body').animate({ scrollTop: (filterHeight - 80) }, 500);
// 			$('.news-article').addClass('fadeIn animated');
// 		}
// 	});
// })(jQuery);

jQuery(document).ready(function($) {
	$('.quiz-taker').on('click', function(e) {
		e.preventDefault();
		var parent_item = $(this).closest('.quiz-result').find('.quiz-result-content');

		parent_item.slideToggle();
	});
});


jQuery(document).ready(function($){
	$('.account-modal-open').on('click', function(e){
		e.preventDefault();
		$('.my-account-window').addClass('active');
	});

	$('#curr_lang').on('click', function(e){
		e.preventDefault();
		$('.my-account-window-container .first-block-list.active').removeClass('active');
		$('.my-account-window-container .second-block-list').addClass('active');
	});

	$('.back-btn').on('click', function(e){
		e.preventDefault();
		$('.my-account-window-container .first-block-list').addClass('active');
		$('.my-account-window-container .second-block-list.active').removeClass('active');		
	})

	$('.close-btn').on('click', function(e){
		e.preventDefault();
		$('.my-account-window').removeClass('active');
	});
})