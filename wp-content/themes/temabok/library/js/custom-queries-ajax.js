/*
 * CUSTOM QUERIES AJAX PAGINATION
 *
 * This file will be called automatically in the footer
 *
*/


jQuery(document).ready(function($) {
  var ajaxUrl = ajaxpagination.ajaxurl;
  var favorites_page = 1; // What page we are on.
  var favorites_ppp = 8; // Post per page
  var user_reads_page = 1; // What page we are on.
  var user_reads_ppp = 8; // Post per page

  $("#load-more-favorites").on("click", function(e) {
  	e.preventDefault();

    var $this = $(this);

    $("#load-more-favorites").attr("disabled",true); // Disable the button, temp.

    $.post( ajaxUrl, {
      action: "more_favorites_ajax",
      favorites_offset: (favorites_page * favorites_ppp) + 1,
      favorites_ppp: favorites_ppp
    } )
    .success( function( posts ) {
      favorites_page++;
      $(".favorites-list .articles-wrapper").append(posts); // CHANGE THIS!
      $("#load-more-favorites").attr("disabled",false);
      $(document).trigger('favorites-update-all-buttons');

      var listWrap = $('.list-wrap');
      var newHeight = $this.closest('.tab-content').height();

      listWrap.animate({
          height: newHeight
      }, 300);

    } );
  });

  $("#load-more-user-reads").on("click", function(e) {
  	e.preventDefault();

    var $this = $(this);

    $("#load-more-user-reads").attr("disabled",true); // Disable the button, temp.

    $.post( ajaxUrl, {
      action: "more_user_reads_ajax",
      user_reads_offset: (user_reads_page * user_reads_ppp) + 1,
      user_reads_ppp: user_reads_ppp
    } )
    .success( function( posts ) {
      user_reads_page++;
      $(".user-reads-list .articles-wrapper").append(posts); // CHANGE THIS!
      $("#load-more-user-reads").attr("disabled",false);
      $(document).trigger('favorites-update-all-buttons');

      var listWrap = $('.list-wrap');
      var newHeight = $this.closest('.tab-content').height();

      listWrap.animate({
          height: newHeight
      }, 300);

    } );
  });
}); /* end of as page load scripts */
