;(function($) {

"use strict";

var $body = $('body');
// var $head = $('head');
// var $mainWrapper = $('#main-wrapper');

// MEDIA QUERY BREAKPOINT
var uouMediaQueryBreakpoint = function() {

  if ( $( '#media-query-breakpoint' ).length < 1 ) {
    $( 'body' ).append( '<var id="media-query-breakpoint"><span></span></var>' );
  }
  var value = $( '#media-query-breakpoint' ).css( 'content' );
  if ( typeof value !== 'undefined' ) {
    value = value.replace( "\"", "" ).replace( "\"", "" ).replace( "\'", "" ).replace( "\'", "" );
    if ( isNaN( parseInt( value, 10 ) ) ){
      $( '#media-query-breakpoint span' ).each(function(){
        value = window.getComputedStyle( this, ':before' ).content;
      });
      value = value.replace( "\"", "" ).replace( "\"", "" ).replace( "\'", "" ).replace( "\'", "" );
    }
    if(isNaN(parseInt(value,10))){
      value = 1199;
    }
  }
  else {
    value = 1199;
  }
  return value;

};

//jQuery('span.time').children('input.value-holder').css('width','45% !important');

// SELECT BOX
$.fn.uouSelectBox = function(){

  var self = $(this),
  select = self.find( 'select' );
  self.prepend( '<ul class="select-clone custom-list"></ul>' );

  var placeholder = select.data( 'placeholder' ) ? select.data( 'placeholder' ) : select.find( 'option:eq(0)' ).text(),
  clone = self.find( '.select-clone' );
  self.prepend( '<input class="value-holder" type="text" disabled="disabled" placeholder="' + placeholder + '"><i class="fa fa-caret-down"></i>' );
  var value_holder = self.find( '.value-holder' );

  // INPUT PLACEHOLDER FIX FOR IE
  if ( $.fn.placeholder ) {
    self.find( 'input, textarea' ).placeholder();
  }

  // CREATE CLONE LIST
  select.find( 'option' ).each(function(){
    if ( $(this).attr( 'value' ) ){
      clone.append( '<li data-value="' + $(this).val() + '">' + $(this).text() + '</li>' );
    }
  });

  // TOGGLE LIST
  self.click(function(){
    var media_query_breakpoint = uouMediaQueryBreakpoint();
    if ( media_query_breakpoint > 991 ) {
      clone.slideToggle(100);
      self.toggleClass( 'active' );
    }
  });

  // CLICK
  clone.find( 'li' ).click(function(){
    console.log($(this).text());
    value_holder.val( $(this).text() );
    select.find( 'option[value="' + $(this).attr( 'data-value' ) + '"]' ).attr('selected', 'selected');

    // IF LIST OF LINKS
    if ( self.hasClass( 'links' ) ) {
      window.location.href = select.val();
    }

  });

  // HIDE LIST
  self.bind( 'clickoutside', function(event){
    clone.slideUp(100);
  });

  // LIST OF LINKS
  if ( self.hasClass( 'links' ) ) {
    select.change( function(){
      window.location.href = select.val();
    });
  }

};




 // SELECT BOX
  $.fn.uouSelectBoxLocation = function(){
    
    console.log('roman');

    var self = $(this),
    area = $('.car_location_area'),
    select = self.find( 'select' );
    self.prepend( '<ul class="select-clone custom-list"></ul>' );

    var placeholder = select.data( 'placeholder' ) ? select.data( 'placeholder' ) : select.find( 'option:eq(0)' ).text(),
    clone = self.find( '.select-clone' );
    self.prepend( '<input class="value-holder" type="text" disabled="disabled" placeholder="' + placeholder + '"><i class="fa fa-caret-down"></i>' );
    var value_holder = self.find( '.value-holder' );

    // INPUT PLACEHOLDER FIX FOR IE
    if ( $.fn.placeholder ) {
      self.find( 'input, textarea' ).placeholder();
    }

    // CREATE CLONE LIST
    select.find( 'option' ).each(function(){
    if ( $(this).attr( 'value' ) ){
      clone.append( '<li data-value="' + $(this).val() + '">' + $(this).text() + '</li>' );
    }
    });

    // TOGGLE LIST
    self.click(function(){
    var media_query_breakpoint = uouMediaQueryBreakpoint();
    if ( media_query_breakpoint > 991 ) {
      clone.slideToggle(100);
      self.toggleClass( 'active' );
    }
    });

    // CLICK
    clone.find( 'li' ).click(function(){

      var locations = locations_data.locations,
          areas;
      
      console.log($(this).data('value'));

      var city = $(this).data('value');
      
      value_holder.val( $(this).text() );
      select.find( 'option[value="' + $(this).attr( 'data-value' ) + '"]' ).attr('selected', 'selected');

      var opt = '<option value=""> Choose Area </option>';
      


      $.each( locations, function( key, value ) {     
        if(key === city){          
          $.each(value, function(ky , val){
            opt += '<option value="'+val+'"> '+val+' </option>';  
          })        
        }
      });

      area.html(opt);

      // IF LIST OF LINKS
      if ( self.hasClass( 'links' ) ) {
        window.location.href = select.val();
      }

    });

    // HIDE LIST
    self.bind( 'clickoutside', function(event){
    clone.slideUp(100);
    });

    // LIST OF LINKS
    if ( self.hasClass( 'links' ) ) {
    select.change( function(){
      window.location.href = select.val();
    });
    }

  }; 













// CHEKCBOX INPUT
$.fn.uouCheckboxInput = function(){

  var self = $(this),
  input = self.find( 'input' );



  // INITIAL STATE
  if ( input.is( ':checked' ) ) {
    self.addClass( 'active' );
  }
  else {
    self.removeClass( 'active' );
  }

  // CHANGE STATE
  input.change(function(){
    if ( input.is( ':checked' ) ) {
      self.addClass( 'active' );
    }
    else {
      self.removeClass( 'active' );
    }
  });

};


$(document).ready(function () {

	// HEADER TOOLBAR LANGUAGE
  var $headerLanguageToggle = $('.header-language');

  $headerLanguageToggle.children('.toggleButton, .header-btn').on('click', function (event) {
    event.preventDefault();
    $(this).parent('.header-language').toggleClass('active');
  });

  $headerLanguageToggle.on('clickoutside touchendoutside', function () {
    if ($headerLanguageToggle.hasClass('active')) { $headerLanguageToggle.removeClass('active'); }
  });

  // CLIENTS SLIDER LOGOS
  $(".clients-slider").owlCarousel({
    items : 5,
    navigation: true,
    navigationText: [
      "<div class='button prevSlide'><i class='fa fa-angle-left'></i></div>",
      "<div class='button nextSlide'><i class='fa fa-angle-right'></i></div>"
    ]
  });

  // TESTIMONIALS SLIDER
  $(".testimonials-slider").owlCarousel({
    singleItem: true,
    pagination: true
  });

  // BACKGROUND FOR EACH SLIDE
  $( '.features-tabs' ).each(function(){

    var self = $(this),
    images = self.find( '.tab-pane' );

    // SET BG IMAGES
    images.each(function(){
      var img =  $(this).find( 'img' );
      if ( img.length > 0 ) {
        $(this).css( 'background-image', 'url(' + img.attr( 'src' ) + ')' );
        img.hide();
      }
    });
  });

  // HEADER TOOLBAR LOGIN/REGISTER
  var $headerLoginRegister = $('#header .header-toolbar-right .header-login, #header .header-toolbar-right .header-register');

  $headerLoginRegister.each(function () {
    var $this = $(this);

    $this.children('a').on('click', function (event) {
      event.preventDefault();
      $this.toggleClass('active');
    });

    $this.on('clickoutside touchendoutside', function () {
      if ($this.hasClass('active')) { $this.removeClass('active'); }
    });
  });

  // HOVER SUBMENU
  $('.has-submenu').hover(function() {
    if (media_query_breakpoint > 1200) {
      $(this).addClass('hover');
      $(this).find('.sub-menu').stop(true, true).fadeIn(200);
    }
  }, function() {
    if (media_query_breakpoint > 1200) {
      $(this).removeClass('hover');
      $(this).find('.sub-menu').stop(true, true).delay(10).fadeOut(200);
    }
  });

  // CREATE TOGGLE BUTTONS
  $( '.has-submenu' ).each(function(){
    $(this).append( '<button class="submenu-toggle"><i class="fa fa-chevron-down"></i></button>' );
  });

  // TOGGLE SUBMENU
  $('.submenu-toggle').each(function() {
    $(this).click(function() {
      $(this).parent().find('> .sub-menu').slideToggle(200);
      $(this).find('.fa').toggleClass('fa-chevron-up fa-chevron-down');
    });
  });

  // TABS
  $('a[data-toggle="tab"]').on('shown.bs.tab', function () {

    $(window).resize(function() {
      setTimeout(function() {
          google.maps.event.trigger(map, 'resize');
       }, 300)  
    });

    // MAP OFFICES
    /*$("#offices-map").gmap3({
      marker: {
        values: [{
          latLng: [44.28952958093682, 6.152559438984804],
          options: {
              icon: "img/marker-pin.png"
          }
      }, ],
      },
      map:{
        options:{
          zoom:6,
          mapTypeControl: true,
          mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
          },
          navigationControl: false,
          scrollwheel: false,
          streetViewControl: true,
          styles: [{
            featureType: "all",
            elementType: "all",
            stylers: [
              {"saturation":-800},{"lightness":25},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}
            ]
          }]
        }
      }
    });*/

  });

  // FORM ELEMENTS
  $( '.checkbox-input' ).each(function(){
    $(this).uouCheckboxInput();
  });

  $( '.select-box' ).each(function(){
    $(this).uouSelectBox();
  });

  $( '.select-box-location' ).each(function(){
      $(this).uouSelectBoxLocation();
  });

  // CALENDAR INPUT
  $( '.calendar-input' ).each(function(){
    var input = $(this).find( 'input' ),
    dateformat = input.data( 'dateformat' ) ? input.data( 'dateformat' ) : 'm/d/y',
    icon = $(this).find( '.fa' ),
    widget = input.datepicker( 'widget' );

    input.datepicker({
      dateFormat: dateformat,
      minDate: 0,
      beforeShow: function(){
        input.addClass( 'active' );
      },
      onClose: function(){
        input.removeClass( 'active' );
        // TRANSPLANT WIDGET BACK TO THE END OF BODY IF NEEDED
        widget.hide();
        if ( ! widget.parent().is( 'body' ) ) {
          widget.detach().appendTo( $( 'body' ) );
        }
      }
    });
    icon.click(function(){
      input.focus();
    });
  });

  // NAVBAR TOGGLE
  $('.toggle').each(function() {
    $(this).click(function() {
      $(this).parent().parent().find('.navigation').slideToggle('200');

      var media_query_breakpoint = uouMediaQueryBreakpoint();
      if ( media_query_breakpoint < 991 ) {
        $(this).parent().parent().find('.header-language').slideToggle('200');
        $(this).parent().parent().find('.header-cta-buttons').slideToggle('200');
      }
    });
  });

  // PRICE FILTER
 /* $( '.slider-range-container' ).each(function(){
    if ( $.fn.slider ) {

      var self = $(this),
      slider = self.find( '.slider-range' ),
      min = slider.data( 'min' ) ? slider.data( 'min' ) : 100,
      max = slider.data( 'max' ) ? slider.data( 'max' ) : 2000,
      step = slider.data( 'step' ) ? slider.data( 'step' ) : 100,
      default_min = slider.data( 'default-min' ) ? slider.data( 'default-min' ) : 100,
      default_max = slider.data( 'default-max' ) ? slider.data( 'default-max' ) : 500,
      currency = slider.data( 'currency' ) ? slider.data( 'currency' ) : '$',
      input_from = self.find( '.range-from' ),
      input_to = self.find( '.range-to' );

      input_from.val( currency + ' ' + default_min );
      input_to.val( currency + ' ' + default_max );

      slider.slider({
        range: true,
        min: min,
        max: max,
        step: step,
        values: [ default_min, default_max ],
        slide: function( event, ui ) {
          input_from.val( currency + ' ' + ui.values[0] );
          input_to.val( currency + ' ' + ui.values[1] );
        }
      });

    }
  });*/

  // TOGGLE
  $.fn.uouToggle = function(){
    var self = $(this),
    title = self.find( '.toggle-button' ),
    vechicles = self.parent().parent().find('.fleet-listing'),
    content = self.find( '.sidebar' );
    title.click(function(){
      title.toggleClass( 'closed' );
      vechicles.toggleClass('full-width');
      content.slideToggle(0);
    });
  };

  // ISOTOPE FILTERS


  $(window).load(function(){

    $('.essentials-filters').each(function() {
      var $container = $('.essentials-filters-content').isotope({
        itemSelector: '.essentials-filters-content .vechicle',
        layoutMode: 'fitRows'
      });
       var filterFns = {
        };

      $('.essentials-filters li a').on( 'click', function() {
        var filterValue = $( this ).attr('data-filter');
        // use filterFn if matches value
        filterValue = filterFns[ filterValue ] || filterValue;
        $container.isotope({ filter: filterValue });

        $('.essentials-filters li a').each(function(){
          $(this).removeClass("active");
        });
        $(this).addClass("active");

        return false;
      });
    });
    
  })

  

  // MEDIA QUERY BREAKPOINT REMOVE STYLE
  $(window).resize(function(){
    if ( uouMediaQueryBreakpoint() !== media_query_breakpoint ) {
      media_query_breakpoint = uouMediaQueryBreakpoint();

      /* RESET HEADER ELEMENTS */
      $( '.navigation, .header-language, .header-cta-buttons, .sub-menu' ).removeAttr( 'style' );
      $('.header-login, .header-register').removeClass('active');
    }
  });

  // MAP CONTACT
  /*$("#contact-map").gmap3({
    marker: {
      values: [{
        latLng: [44.28952958093682, 6.152559438984804],
        options: {
            icon: "img/marker-contact.png"
        }
    }, ],
    },
    map:{
      options:{
        zoom:6,
        mapTypeControl: true,
        mapTypeControlOptions: {
          style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
        },
        navigationControl: false,
        scrollwheel: false,
        streetViewControl: true,
        styles: [{
          featureType: "all",
          elementType: "all",
          stylers: [
            {"saturation":-800},{"lightness":25},{"visibility":"on"}]},{"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},{"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},{"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},{"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},{"featureType":"administrative.province","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},{"lightness":-25},{"saturation":-100}]},{"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}
          ]
        }]
      }
    }
  });
*/
  $('#contact-map').css({'height': $('.contact-box').innerHeight()});

  // TOGGLES
  $( '.fleet-filter' ).each(function(){
    $(this).uouToggle();
  });

  // GET ACTUAL MEDIA QUERY BREAKPOINT
  var media_query_breakpoint = uouMediaQueryBreakpoint();
});

// Touch
// ---------------------------------------------------------
var dragging = false;

$body.on('touchmove', function() {
	dragging = true;
});

$body.on('touchstart', function() {
	dragging = false;
});



}(jQuery));
