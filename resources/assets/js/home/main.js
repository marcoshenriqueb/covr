(function($) {
var App = { init: function() {
	App.HomepageOpacity();          // changes homepage opacity on scroll
	App.MaxImage_Video();           // homepage background - video
	App.MaxImage_Slider();          // homepage background - image slider
	App.MaxImage_Single();          // homepage background - vingle image
	App.ScrollToSomeplace();        // script resposible for smooth scrolling after clicking on menu item
	App.Reviews();                  // reviews carousel
	App.Nivo_Lightbox();            // lightbox
	App.Elements_animation();       // animations
	},



	// Homepage Opacity - for single background image version
	HomepageOpacity: function() {
    "use strict";
        var h = window.innerHeight;
        $(window).on('scroll', function() {
            var st = $(this).scrollTop();
            $('#maximage_single').css('opacity', (1-st/h) );
        });
    },


	// MaxImage Fullscreen Background Slider
	MaxImage_Video: function() {
	"use strict";
	    jQuery('video, object').maximage('maxcover');

	    // detecting if browser is mobile and disabling the video background, leaving only poster as bg.
		if( navigator.userAgent.match(/Android/i)
		|| navigator.userAgent.match(/webOS/i)
		|| navigator.userAgent.match(/iPhone/i)
		|| navigator.userAgent.match(/iPad/i)
		|| navigator.userAgent.match(/iPod/i)
		|| navigator.userAgent.match(/BlackBerry/i)
		|| navigator.userAgent.match(/Windows Phone/i)
		 ){
		    $('#maximage_video video').css('display', 'none' );
		    classie.add( document.getElementById( 'maximage_video' ), 'mobile_novideo' );
		  };
	},


	// MaxImage Fullscreen Background Slider
	MaxImage_Slider: function() {
	"use strict";
	    $('#maximage_slider').maximage();
	},


	// MaxImage Fullscreen Background Slider
	MaxImage_Single: function() {
	"use strict";
	    $('#maximage_single').maximage();
	},


	// Scroll To ...
    ScrollToSomeplace: function() {
    $('.go_to_home').click(function () {$.scrollTo('.hero_fullscreen',1000,{easing:'easeInOutExpo','axis':'y'});return false});
    $('.go_to_more_info').click(function () {$.scrollTo('#more_info',1000,{easing:'easeInOutExpo','axis':'y'});return false});
    },





    // Elements Animation
    Elements_animation: function() {
		$('#more_info').waypoint(function() {
            setTimeout(function(){$('.more_info_anim1').addClass('animated fadeInUp')},0);
            setTimeout(function(){$('.more_info_anim2').addClass('animated fadeInRight')},200);
            setTimeout(function(){$('.more_info_anim3').addClass('animated fadeInRight')},400);
            setTimeout(function(){$('.more_info_anim4').addClass('animated fadeInUp')},600);
            setTimeout(function(){$('.more_info_anim5').addClass('animated fadeInUp')},800);
            setTimeout(function(){$('.more_info_anim6').addClass('animated fadeInUp')},1000);
            setTimeout(function(){$('.more_info_anim7').addClass('animated fadeInUp')},1200);
            setTimeout(function(){$('.more_info_anim8').addClass('animated fadeInUp')},1400);
            setTimeout(function(){$('.more_info_anim9').addClass('animated fadeInUp')},1600);
            setTimeout(function(){$('.more_info_anim10').addClass('animated fadeInUp')},1800);
        }, { offset: '50%' });

    	$('#features').waypoint(function() {
            setTimeout(function(){$('.features_anim1').addClass('animated fadeInUp')},0);
            setTimeout(function(){$('.features_anim2').addClass('animated fadeInLeft')},200);
            setTimeout(function(){$('.features_anim3').addClass('animated fadeInUp')},400);
            setTimeout(function(){$('.features_anim4').addClass('animated fadeInUp')},600);
            setTimeout(function(){$('.features_anim5').addClass('animated fadeInUp')},800);
            setTimeout(function(){$('.features_anim6').addClass('animated fadeInUp')},1000);
            setTimeout(function(){$('.features_anim7').addClass('animated fadeInUp')},1200);
            setTimeout(function(){$('.features_anim8').addClass('animated fadeInUp')},1400);
            setTimeout(function(){$('.features_anim9').addClass('animated fadeInUp')},1600);
            setTimeout(function(){$('.features_anim10').addClass('animated fadeInUp')},2000);
        }, { offset: '50%' });

        $('#screenshots').waypoint(function() {
            setTimeout(function(){$('.screenshots_anim1').addClass('animated fadeInUp')},0);
            setTimeout(function(){$('.screenshots_anim2').addClass('animated fadeInUp')},200);
            setTimeout(function(){$('.screenshots_anim3').addClass('animated fadeInUp')},400);
            setTimeout(function(){$('.screenshots_anim4').addClass('animated fadeInUp')},600);
            setTimeout(function(){$('.screenshots_anim5').addClass('animated fadeInUp')},800);
            setTimeout(function(){$('.screenshots_anim6').addClass('animated fadeInUp')},1000);
            setTimeout(function(){$('.screenshots_anim7').addClass('animated fadeInUp')},1200);
            setTimeout(function(){$('.screenshots_anim8').addClass('animated fadeInUp')},1400);
            setTimeout(function(){$('.screenshots_anim9').addClass('animated fadeInUp')},1600);
            setTimeout(function(){$('.screenshots_anim10').addClass('animated fadeInUp')},1800);
        }, { offset: '50%' });


        $('#faq').waypoint(function() {
            setTimeout(function(){$('.faq_anim1').addClass('animated fadeInUp')},0);
            setTimeout(function(){$('.faq_anim2').addClass('animated fadeInUp')},200);
            setTimeout(function(){$('.faq_anim3').addClass('animated fadeInUp')},400);
            setTimeout(function(){$('.faq_anim4').addClass('animated fadeInUp')},600);
            setTimeout(function(){$('.faq_anim5').addClass('animated fadeInUp')},800);
            setTimeout(function(){$('.faq_anim6').addClass('animated fadeInUp')},1000);
            setTimeout(function(){$('.faq_anim7').addClass('animated fadeInUp')},1200);
            setTimeout(function(){$('.faq_anim8').addClass('animated fadeInUp')},1400);
            setTimeout(function(){$('.faq_anim9').addClass('animated fadeInUp')},1600);
            setTimeout(function(){$('.faq_anim10').addClass('animated fadeInUp')},1800);
        }, { offset: '50%' });

        $('#reviews').waypoint(function() {
            setTimeout(function(){$('.reviews_anim1').addClass('animated fadeInUp')},0);
            setTimeout(function(){$('.reviews_anim2').addClass('animated fadeInUp')},200);
            setTimeout(function(){$('.reviews_anim3').addClass('animated fadeInLeft')},600);
            setTimeout(function(){$('.reviews_anim4').addClass('animated fadeInLeft')},400);
            setTimeout(function(){$('.reviews_anim5').addClass('animated fadeInRight')},400);
            setTimeout(function(){$('.reviews_anim6').addClass('animated fadeInRight')},600);
            setTimeout(function(){$('.reviews_anim7').addClass('animated fadeInUp')},1200);
            setTimeout(function(){$('.reviews_anim8').addClass('animated fadeInUp')},1400);
            setTimeout(function(){$('.reviews_anim9').addClass('animated fadeInUp')},1600);
            setTimeout(function(){$('.reviews_anim10').addClass('animated fadeInUp')},1800);
        }, { offset: '50%' });
    },


    // Nivo Lightbox
    Nivo_Lightbox: function() {
	    $('#screenshots .image_container a').nivoLightbox({
		    effect: 'slideDown'
	    });
    },

    // Reviews Carousel
    Reviews: function() {
	    $(".owl-carousel").owlCarousel({
		    loop:true,
		    singleItem : true,
	    });
    },

}

$(function() {
  App.init();

});

})(jQuery);
