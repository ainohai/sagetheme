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

                $('.gallery-size-thumbnail').addClass('mdl-grid');
                $('.gallery-size-thumbnail .gallery-item').addClass('mdl-cell--4-col');

                var colorboxSettings = {
                    rel: 'cboxElement',
                    width: '95%',
                    height: 'auto',
                    maxWidth: '660',
                    maxHeight: 'auto',
                    title: function() {
                        return $(this).find('img').attr('alt');
                    }
                };

                $('.gallery a').colorbox(colorboxSettings);

                //Keep lightbox responsive on screen resize
                $(window).on('resize', function() {
                    $.colorbox.resize({
                        width: window.innerWidth > parseInt(colorboxSettings.maxWidth) ? colorboxSettings.maxWidth : colorboxSettings.width
                    });
                });

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
                var height = p.outerHeight();
                var width = p.innerWidth();
                var footer = $('.mdl-mega-footer');
                var origPosition = p.position();

                var styleEl = document.createElement('style'),
                    styleSheet;
                // Append style element to head
                document.head.appendChild(styleEl);
                styleSheet = styleEl.sheet;
                var cssRule = ".researchTopicNav.fixed { width: " + width + "px; }";
                styleSheet.insertRule(cssRule, styleSheet.cssRules.length);

                $('.mdl-layout__content').scroll(function(){
                    var position = p.position();
                    var footerPos = footer.position();
                    if (position.top <= 65  &&  height < footerPos.top && $(this).scrollTop() > origPosition.top) {
                        $('.researchTopicNav').removeClass('inTheBottom');
                        $('.researchTopicNav').addClass('fixed');
                    } else if ( height > footerPos.top ) {
                        $('.researchTopicNav').removeClass('fixed');
                        $('.researchTopicNav').addClass('inTheBottom');
                    } else {
                        $('.researchTopicNav').removeClass('inTheBottom');
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
