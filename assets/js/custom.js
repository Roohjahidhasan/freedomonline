/*
  * @package Dart
  * @subpackage Dart HTML
  * 
  * Template Scripts
  * Created by Tripples
  
  1. Fixed header
  2. Site search
  3. Main slideshow
  4. Owl Carousel
      a. Testimonial
      b. Clients
      c. Team
  5. Back to top
  6. Skills
  7. BX slider
      a. Blog Slider
      b. Portfolio item slider
  8. Isotope
  9. Animation (wow)
  10. Flickr
  
*/


jQuery(function($) {
  "use strict";


  /* ----------------------------------------------------------- */
  /*  Fixed header
  /* ----------------------------------------------------------- */

  function fixedHeader()
  {
    var windowWidth = $(window).width();

    if(windowWidth > 120 ){
      $(window).on('scroll', function(){
        if( $(window).scrollTop()>100 ){
          $('.main-nav').addClass('header-fixed animated slideInDown');
        } else {
          $('.main-nav').removeClass('header-fixed animated slideInDown');
        }
      });
    }else{
      
      $('.main-nav').addClass('fixed-menu animated slideInDown');
        
    }
  }

  fixedHeader();


  /* ----------------------------------------------------------- */
  /*  Site search
  /* ----------------------------------------------------------- */

  $('.navbar-nav .fa-search').on('click', function() {
    $("html, body").animate({ scrollTop: 0 }, "slow");
    $('.site-search .container').toggleClass('open');
  })

  $('.site-search .close').on('click', function() {
    $('.site-search .container').removeClass('open');;
  })

  /*----------------------------------------------------*/
	/*	Nav Menu & Search
	/*----------------------------------------------------*/
	
	$(".nav > li:has(ul)").addClass("drop");
	$(".nav > li.drop > ul").addClass("dropdown");
	$(".nav > li.drop > ul.dropdown ul").addClass("sup-dropdown");
	
	$('.show-search').click(function() {
		$('.search-form').fadeIn(300);
		$('.search-form input').focus();
	});
	$('.search-form input').blur(function() {
		$('.search-form').fadeOut(300);
	});
	

 /* Slick Nav 
 */

 $('.wpb-mobile-menu').slicknav({
  prependTo: '.navbar-header',
  parentTag: 'margo',
  allowParentLinks: true,
  duplicate: false,
  label: '',
  closedSymbol: '<i class="fa fa-angle-right"></i>',
  openedSymbol: '<i class="fa fa-angle-down"></i>',
});
  /* ----------------------------------------------------------- */
  /*  Main slideshow
  /* ----------------------------------------------------------- */

  $('#main-slide').carousel({
    pause: true,
    interval: 6000,
  });


  /* ----------------------------------------------------------- */
  /*  Owl Carousel
  /* ----------------------------------------------------------- */


    //Testimonial

    $("#testimonial-carousel").owlCarousel({
 
      navigation : true, // Show next and prev buttons
      slideSpeed : 600,
      pagination:false,
      singleItem:true
 
    });

    // Custom Navigation Events
    var owl = $("#testimonial-carousel");


    // Custom Navigation Events
    $(".next").click(function(){
      owl.trigger('owl.next');
    })
    $(".prev").click(function(){
      owl.trigger('owl.prev');
    })
    $(".play").click(function(){
      owl.trigger('owl.play',1000); //owl.play event accept autoPlay speed as second parameter
    })
    $(".stop").click(function(){
      owl.trigger('owl.stop');
    })
    

    //Clients
    $("#client-carousel").owlCarousel({

      navigation : true, // Show next and prev buttons
      navigationText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
      slideSpeed : 800,
      pagination:false,
      items : 5,
      rewindNav: true,
      itemsDesktop : [1199,3],
      itemsDesktopSmall : [979,3],
      stopOnHover:true

    });

      //Team
      $("#team-carousel").owlCarousel({
 
        navigation : true, // Show next and prev buttons
        navigationText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
        slideSpeed : 800,
        pagination:false,
        items : 4,
        rewindNav: true,
        itemsDesktop : [1199,3],
        itemsDesktopSmall : [979,3],
        stopOnHover:true
 
      });

      /* ----------------------------------------------------------- */
      /*  Back to top
      /* ----------------------------------------------------------- */

       $(window).scroll(function () {
            if ($(this).scrollTop() > 50) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });
      // scroll body to 0px on click
      $('#back-to-top').click(function () {
          $('#back-to-top').tooltip('hide');
          $('body,html').animate({
              scrollTop: 0
          }, 800);
          return false;
      });
      
      $('#back-to-top').tooltip('hide');
 
  
      /* ----------------------------------------------------------- */
      /*  Skills
      /* ----------------------------------------------------------- */

          if($('.percentage').length){
          $('.percentage').easyPieChart({
            animate: 5000,
            onStep: function(value) {
            this.$el.find('span').text(~~value);
            }
            });
          }

      /* ----------------------------------------------------------- */
      /*  BX r
      /* ----------------------------------------------------------- */

      //Blog Slider
      $('#blog-gallary').bxSlider({
        mode: 'fade',
        autoControls: false
      });

      //Portfolio item slider
      $('#portfolio-slider').bxSlider({
        mode: 'fade',
        autoControls: false
      });


      /* ----------------------------------------------------------- */
      /*  Isotope
      /* ----------------------------------------------------------- */


      // portfolio filter
      $(window).load(function(){

        var $isotope_selectors = $('#isotope-filter>a');

        if($isotope_selectors!='undefined'){
          var $portfolio = $('.isotope');
          $portfolio.isotope({
            itemSelector : '.col-sm-3',
            layoutMode : 'fitRows'
          });
          
          $isotope_selectors.on('click', function(){
            $isotope_selectors.removeClass('active');
            $(this).addClass('active');
            var selector = $(this).attr('data-filter');
            $portfolio.isotope({ filter: selector });
            return false;
          });
        }
      });


      /* ----------------------------------------------------------- */
      /*  Animation
      /* ----------------------------------------------------------- */
        //Wow
        new WOW().init();


      /* ----------------------------------------------------------- */
      /*  Prettyphoto
      /* ----------------------------------------------------------- */

      //PrettyPhoto

        $("a[data-rel^='prettyPhoto']").prettyPhoto();

});