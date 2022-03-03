/*
 * Builder Scripts File
 *
 * This file will be called automatically in the footer
 *
*/


jQuery(document).ready(function($) {
  function loadScrollEffects() {
    // set the viewport using the function above
    viewport = updateViewportDimensions();
    if (viewport.width >= 768) {

      var rightreveal = {
        delay				: 200,
        origin	 		: "right",
        distance 		: "40px",
        duration 		: 1200,
        scale		 		: 1,
        reset				: true,
        viewFactor	: 0.1
      };

      var leftreveal = {
        delay				: 600,
        origin	 		: "left",
        distance 		: "40px",
        duration 		: 1200,
        scale		 		: 1,
        reset				: true,
        viewFactor	: 0.1
      };

      var upreveal = {
        delay				: 200,
        origin	 		: "bottom",
        distance 		: "40px",
        scale		 		: 1,
        duration 		: 1200,
        reset				: true,
        viewFactor	: 0.1,
        interval    : 120,
        beforeReveal: function (el) {
          el.classList.add('is-visible');
        },
        afterReveal: function (el) {
          el.classList.add('done-animating');
        },
        afterReset: function (el) {
          el.classList.remove('is-visible');
          el.classList.remove('done-animating');
        }
      };

      //ScrollReveal().reveal(".rightreveal", rightreveal);
      //ScrollReveal().reveal(".leftreveal", leftreveal);
      //ScrollReveal().reveal(".simplereveal", upreveal);

    }
  } // end function

  function addViewClass (el) {
    el.classList.add('is-visible');
  }

  loadScrollEffects();
}); /* end of as page load scripts */
