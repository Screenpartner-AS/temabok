/*
 * Overview Post Scripts File
 *
 * This file will be called automatically in the footer
 *
*/

jQuery(document).ready(function($) {
  // Init flickity
  $('.netflix-row').flickity({
    // options
    "imagesLoaded": true,
    "percentPosition": false,
    "wrapAround": true,
    "pageDots": false,
    "prevNextButtons": false,
    "freeScroll": true
  });

  function hideOverviewContent() {
    $('.hidden-on-tile-popup').addClass('hidden');
  }

  function showOverviewContent() {
    $('.hidden-on-tile-popup').removeClass('hidden');
  }

  function positionPopup() {
    var tile_popup = $('.tile-popup');
    var tile_popup_height = tile_popup.height();
    var netflix_carousel = $('.netflix-row');
    var header_height = $('#header').height();
    var offset_top = netflix_carousel.offset().top;

    var new_height = offset_top - header_height;
    var new_top = offset_top - tile_popup_height;

    tile_popup.css({
      height: new_height + 'px',
      top: header_height + 20 + 'px'
    });
  }

  function openTileBox(tile_number) {
    var tile_popup = $('.tile-popup');

    // Open popup
    tile_popup.addClass('active');
    loadTileBox(tile_number);
    hideOverviewContent();
  }

  function closeTileBox() {
    var tile_popup = $('.tile-popup');

    // Close popup
    tile_popup.removeClass('active');
    showOverviewContent();
  }

  function refreshTileBox() {
    var tile_popup = $('.tile-popup');

    tile_popup.addClass('updated-content');
    setTimeout(function(){
      tile_popup.removeClass('updated-content');
    }, 500);
  }

  function loadTileBox(tile_number) {
    // tiles variable is specified in template-parts/content-single-pverview-post.php
    var new_data = tiles[tile_number];

    var tile_image = $('.tile-popup').find('.tile-popup-image');
    var tile_tematittel = $('.tile-popup').find('.tile-popup-tematittel');
    var tile_tittel = $('.tile-popup').find('.tile-popup-tittel');
    var tile_utdrag = $('.tile-popup').find('.tile-popup-utdrag');
    var tile_lenke = $('.tile-popup').find('.tile-popup-lenke');

    tile_image.attr('src', new_data['bilde']);
    tile_tematittel.html(new_data['tematittel']);
    tile_tittel.html(new_data['tittel']);
    tile_utdrag.html(new_data['utdragstekst']);
    tile_lenke.attr('href', new_data['relatert_artikkel']);
  }

  $('.netflix-tile').on('click', function(e) {
    e.preventDefault();

    var tile_number = $(this).attr('data-popup-title');

    openTileBox(tile_number);
    refreshTileBox();
    positionPopup();

  });

  $('.close-tile-popup').on('click', function(e) {
    e.preventDefault();
    closeTileBox();
  });
});
