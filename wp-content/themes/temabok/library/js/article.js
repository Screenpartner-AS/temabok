/*
 * Article Scripts File
 *
 * This file will be called automatically in the footer
 *
*/

// This fixes scrollto animations getting stuck
jQuery(window).bind("mousewheel", function() {
  jQuery("html, body").stop(true, false);
});

const progress = document.querySelector('#header-progress');
const bar = progress.querySelector('#header-progress span');
let timer = null;

window.addEventListener('scroll', () => updateProgressBar() );
window.addEventListener('resize', () => updateProgressBar() );

window.addEventListener('scroll', () => setArticleStatusForUser() );

window.addEventListener('scroll', () => viewJumpBackIn() );

function percentRead() {
	let lastScrollTop = document.querySelector('#header-progress span').getAttribute('data-progress');
	let scrollSpace = document.querySelector('#inner-content').scrollHeight - window.innerHeight;
	let read = window.scrollY / scrollSpace * 100;
	let returnRead = read;

	// Making sure percentRead only updates
	// when scrolling down
	if (read > lastScrollTop) {
		if (read >= 100) {
			returnRead = 100;
		} else {
			returnRead = read;
		}
	} else {
		returnRead = lastScrollTop;
	}

	lastScrollTop = read <= 0 ? 0 : read;

	return returnRead;
}

function updateProgressBar() {
	let read = percentRead();
	bar.style.width = `${read}%`;
	bar.setAttribute('data-percent', read);
}

function setArticleStatusForUser() {
	if (timer !== null) {
		clearTimeout(timer);
	}

	timer = setTimeout( function() {
		let read = percentRead();
		let post_id = jQuery('#article-post-id').val();

		jQuery.ajax( {
      type: 'POST',
			url: ajax_object.ajaxurl,
      data: {
        action : 'sp_update_article_progress',
        read : read,
        post_id : post_id
      }
    } )
    .success( function( results ) {
      console.log( 'Article reading progress updated' );
      console.log( results );
    } )
    .fail( function( data ) {
      console.log( data.responseText );
      console.log( 'Request failed: ' + data.statusText );
    } );
	}, 500);
}

function viewJumpBackIn() {
	let lastScrollTop = document.querySelector('#header-progress span').getAttribute('data-progress');
	let scrollSpace = document.querySelector('#inner-content').scrollHeight - window.innerHeight;
	let currentlyRead = window.scrollY / scrollSpace * 100;
	let read = percentRead();
	let scrollPercentOfWindow = scrollSpace / 100 * read;

	let jumpBackIn = jQuery('.jump-back-in');

	if (currentlyRead < read) {
    setTimeout(function(){
      jumpBackIn.addClass('active');
    }, 1000);

		jumpBackIn.find('.scroll-to-read').on('click', function(e) {
			e.preventDefault();
			jumpBackIn.remove();
			jQuery('html, body').animate({ scrollTop: scrollPercentOfWindow }, 750);
		});

    jumpBackIn.find('.close-notification').on('click', function(e) {
			e.preventDefault();
      jumpBackIn.removeClass('active');
      setTimeout(function(){
        jumpBackIn.remove();
      }, 500);
		});
	} else {
		jumpBackIn.removeClass('active');
	}
}

updateProgressBar();
viewJumpBackIn();

// Helper function
jQuery.fn.extend({
  toggleText: function (a, b){
    var that = this;
      if (that.text() != a && that.text() != b){
        that.text(a);
      }
      else
      if (that.text() == a){
        that.text(b);
      }
      else
      if (that.text() == b){
        that.text(a);
      }
    return this;
  }
});

jQuery(document).ready(function($) {

  // Filters toggle
	$('.create-quiz').on('click', function(e) {
    var title = $(this).text();
    $('#acf-form').toggleClass('active');
    $(this).toggleText('Skjul Quiz-redigering', 'Opprett Quiz');
    $('html, body').animate({ scrollTop: $('#acf-form').offset().top - 150 }, 350);
    e.preventDefault();
  });

}); /* end of as page load scripts */
