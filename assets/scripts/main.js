/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {

  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
        console.log("running common");

        $('.gallery-size-thumbnail').addClass('mdl-grid');
        $('.gallery-size-thumbnail .gallery-item').addClass('mdl-cell--4-col');

      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
      page_template_template_research_php: {
      init: function() {
        var p = $( '.researchTopicNav' );
        var position = p.position();
        var height = p.outerHeight();
        var footer = $('.mdl-mega-footer');
        var footerPos = footer.position();
        $('.mdl-layout__content').scroll(function(){
          if ($(this).scrollTop() > position.top) {
              //if ($(this).scrollTop() < (footerPos.top - height)) {
                  //$('.researchTopicNav').removeClass('fixed');
                  //add pos
              //}

              $('.researchTopicNav').addClass('fixed');


          }
            else {
            $('.researchTopicNav').removeClass('fixed');

          }

        });
      }
    },

    page_template_template_labmember_php: {
      init: function() {
        // Slideshow
        $(".rslides").responsiveSlides({
          auto: true,
          //pagination: true,
          //nav: true,
          fade: 1000,
          timeout: 6000
          //maxwidth: 800
        });

        console.log("running labmemb");
      }

    }

  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
          console.log(classnm);
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.

function initMap () {
  console.log("inifMap");
  var location = {lat: 60.1912461, lng: 24.9042853};
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 13,
    center: location
  });
  var marker = new google.maps.Marker({
    position: location,
    map: map
  });
}
