$(function(){
    if(typeof $.fn.layerSlider == "undefined") { lsShowNotice("layerslider_1","jquery"); } 
    else { 
        $("#layerslider_1").layerSlider({
            responsive: false, 
            responsiveUnder: 1280, 
            layersContainer: 1280, 
            startInViewport: false,
            pauseOnHover: false, 
            forceLoopNum: false, 
            autoPlayVideos: false, 
            skinsPath: "/file/self/",
            skin: "fullwidthdark"
        })
    }
    
    var H=$(".header").height();
    if($(window).width()>780){
        $(".wrapper").css('margin-top',H+'px');
    }
    $( window ).resize(function() {
      if($(window).width()>780){
            $(".wrapper").css('margin-top',H+'px');
        }
    });
    
    $("body").append('<a href="#" class="scrollTo-top" style="display: inline;"><i class="fa fa-angle-double-up"></i></a>');
    var viewPortWidth = $(window).width();
    $(window).scroll(function(event) {
        event.preventDefault();
        if ($(this).scrollTop() > 180) {
            $('.scrollTo-top').fadeIn();
        } else {
            $('.scrollTo-top').fadeOut();
        }
    });    
    $('.scrollTo-top').click(function(event) {
        $('html, body').animate({scrollTop : 0 }, 600);
        event.preventDefault();
    }); 
    
    //Initiat WOW JS
	new WOW().init();
    
    $( "#tabs" ).tabs();
    
    $(".test-popup-link").magnificPopup({
      type: "image",
      zoom: {
        enabled: true,
        duration: 300
      }
    });
    $('.popup-gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile',
        gallery: {
            enabled: true,
            navigateByImgClick: true,
            preload: [0,1] // Will preload 0 - before current, and 1 after the current image
        },
        zoom: {
            enabled: true,
            duration: 300
        },
        image: {
            verticalFit:true
        }
	});   
    $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
      disableOn: 700,
      type: 'iframe',
      mainClass: 'mfp-fade',
      removalDelay: 160,
      preloader: false,
      zoom: {
            enabled: true,
            duration: 300
      },
      fixedContentPos: false
    });  
    
    
    
    
    
    
})
