(function($) {
	"use strict";

	// Parallax effect
    $('#main-slider, .home-widget', '.page-title').stellar({
        horizontalScrolling: false,
        verticalOffset: 10
    });

	$('#main-menu ul.main').mobileMenu({
		defaultText: 'Menu',
		className: 'select-menu',
		subMenuDash: '&ndash;'
	});

	// Full screen Sliders
	$('#home-sliders').superslides({
		play: 5000,
		animation: 'fade',
		pagination: false
	});
	
    // Main Menu
    $('#menu-main-menu').superfish({
        delay:       1,
        animation:   {opacity:'show', height:'show'},
        speed:       'fast',
        dropShadows: false
    });

	// Gallery
	$('ul.gallery').mixitup();
	$('.gallery li').hover(function() {
		$(this).find('.overlay').animate({
		  opacity: 1
		})
	}, function() {
		$(this).find('.overlay').animate({
		  opacity: 0
		})
	});

	// Main menu navigation
	$('#main-menu ul li').hover(function() {
		$(this).find('ul').stop().slideToggle();
	});

	// Dynamic Height
	$(window).resize(function() {
		var slideshowHeight = $(window).height();
		if( $('body.admin-bar').length > 0 ) {
			$('#main-slider').height(slideshowHeight - 32);
		} else {
			$('#main-slider').height(slideshowHeight);
		}
	});

	// Animate
	$('.home-events article.hentry, .home-blog article.hentry').addClass('wow fadeIn');
	$('.timeline ul li.odd, .about_couple .groom, .groom-tweets').addClass('wow fadeInLeft');
	$('.about_couple .bride, .timeline ul li.even, .bride-tweets').addClass('wow fadeInRight');
	$('.home-widget .section-title').addClass('wow bounce');
	$('#countdown').addClass('wow pulse');

	var wow = new WOW({
        boxClass: 'wow',
        animateClass: 'animated',
        offset: 100,
        delay: 2000,
        mobile: false
	});
	wow.init();

	// Parralx Effect
	$(window).trigger('resize');
  
  	// Floating navigation
 	 var menu = jQuery('nav#main-menu'),
        pos = menu.offset();

    $(menu).addClass('default');

	$(window).scroll( function(){
         if($(this).scrollTop() > pos.top+menu.height() && menu.hasClass('default')){
                menu.fadeOut('fast', function(){
                    $(this).removeClass('default').addClass('fixed').fadeIn('fast');
                });
            } else if($(this).scrollTop() <= pos.top && menu.hasClass('fixed')){
                menu.fadeOut('slow', function(){
                    $(this).removeClass('fixed').addClass('default').fadeIn('fast');
                });
            }
	 });

	// prettyPhoto
    $('dl.gallery-item dt a[href*=".jpg"], dl.gallery-item dt a[href*=".png"], dl.gallery-item dt a[href*=".gif"]').attr('rel', 'prettyPhoto["gallery"]'); 
	$('a[rel^="prettyPhoto"], a[rel="prettyPhoto"]').prettyPhoto({
		theme: 'pp_default',
		deeplinking: false,
		social_tools: false
	});

	$(window).load(function() {
		// Page loading spinner
	    $('#spinner').fadeOut('slow');
	    
		$('.testimonial').flexslider({
		    animation: 'fade',
		    controlNav: true,
		    directionNav: false,
		    animationLoop: false,
		    smoothHeight: true
		});

		// Opacity
		$('section.home-rsvp .opacity').css({
			width: $('section.home-rsvp').outerWidth(),
			height: $('section.home-rsvp').outerHeight(),
		});

		// Countdown - Countup
		if( $('#countdown').length > 0 ) {
			var timeTarget = new Date(_warrior.countdown_time),
				timeCurrent = new Date(),
				timeDiff = (timeTarget.getTime()) - (timeCurrent.getTime());

			if ( timeDiff  > 0 ) {
				$('#countdown').countdown({
					until: timeTarget,
					format: 'YODHMS',
					layout: $('#timer').html()
				});
			} else {
				$('#countdown-widget .section-title').text(_warrior.countup_title);
				$('#countdown').countdown({
					since: timeTarget,
					format: 'YODHMS',
					layout: $('#timer').html()
				});
			}
		}

	    // If Google Map widget is loaded
	    if( $('#map-wrapper').length > 0 ) {
	    	initializeMap();
	    }
	});


	// Google Map
    function initializeMap() {
		var name = $("#map-wrapper").data("map-name"),
			address = $("#map-wrapper").data("map-address"),
			image = $("#map-wrapper").data("map-image"),
			lat = $("#map-wrapper").data("map-lat"),
			lng = $("#map-wrapper").data("map-lng"),
			zoom = $("#map-wrapper").data("map-zoom");
		
		var infoWindow = new google.maps.InfoWindow;
		var html = "<div class='map-thumbnail'><img src='" + image + "' width='60' /></div><div class='map-detail'><b>" + name + "</b> <br/>" + address + '</div><div style="clear:both;"></div></div>';
		
		if ( lat !== "" && lng !== "" ) {
			var isDraggable = $(document).width() > 480 ? true : false;
			var map = new google.maps.Map(document.getElementById("map-wrapper"), {
				center: new google.maps.LatLng(lat,lng),
				zoom: zoom,
				mapTypeId: 'roadmap',
				scrollwheel: false,
				draggable: isDraggable
			});

			var marker = new google.maps.Marker({
				map: map,
				position: map.getCenter(),
				icon: _warrior.map_marker_icon,
				shadow: _warrior.map_marker_shadow
			});
			
			bindInfoWindow(marker, map, infoWindow, html);
		} else {
			var geocoder = new google.maps.Geocoder();
			geocoder.geocode( { 'address': address}, function(results, status) {
				if(status == google.maps.GeocoderStatus.OK) {
					var isDraggable = $(document).width() > 480 ? true : false;
					var map = new google.maps.Map(document.getElementById("map-wrapper"), {
						center: results[0].geometry.location,
						zoom: zoom,
						mapTypeId: 'roadmap',
						scrollwheel: false,
						draggable: isDraggable
					});

					var marker = new google.maps.Marker({
						map: map,
						position: results[0].geometry.location,
						icon: _warrior.map_marker_icon,
						shadow: _warrior.map_marker_shadow
					});

					bindInfoWindow(marker, map, infoWindow, html);
				}
			});
		}
    }
	
   function bindInfoWindow(marker, map, infoWindow, html) {
      google.maps.event.addListener(marker, 'click', function() {
        infoWindow.setContent(html);
        infoWindow.open(map, marker);
      });
    }

})(jQuery);