(function($){

	"use strict";


	/*start for reponsive videos*/
	//$(".article-content").fitVids();
	/*end for responsive videos*/



	/*casa comment from modification start*/


	$('#respond').children('form.comment-form').addClass('default-form');
	$('#respond').children('form.comment-form').children('p.form-submit').children('input.submit').addClass('yellow');
	$('.post-comments').children('.comment-respond').children('form.comment-form').children('p.form-submit').hide();
	
	/*casa comment from modification end*/



	/*concierge send mail to agency office start*/

	$(".send-mail-success").hide();

	$('#send_mail_to_office').submit(function(e){

		
		var formData = $(this).serializeArray();

		console.log(formData);

		
		$.ajax({
			type:'POST',
			url: ajaxurl,
			data: {'action':'concierge_user_data_for_message', 'form_data': formData	},
			success: function(result){
				
				
				$(".send-mail-success").show().delay(5000).fadeOut();				
			}

		});

		return false;

	});

	/*concierge send mail to agency office end*/




	/*Home page search for car start*/

	$('.reservation-form').submit(function(){

		var type = $('.reservation ul.horizontal-tab li.active a').data("rel");		
		var searchFormData = $(this).serializeArray();
		var dataObj = {};
		var search_page_id = $('#search-page-id').val();


		$(searchFormData).each(function(i, field){
		  dataObj[field.name] = field.value;
		});

		console.log(dataObj);

		var createSearchBar = '';

		if(dataObj.car_location != '' && dataObj.car_location != undefined){
			if(dataObj.car_location_area != '' && dataObj.car_location_area != undefined){
				createSearchBar += 'location='+dataObj.car_location_area+'&';
				if(dataObj.location_tax != '' && dataObj.location_tax != undefined){
					createSearchBar += 'locationTax='+dataObj.location_tax+'&';
				}
			}else{
				createSearchBar += 'location='+dataObj.car_location+'&';
				if(dataObj.location_tax != '' && dataObj.location_tax != undefined){
					createSearchBar += 'locationTax='+dataObj.location_tax+'&';
				}
			}
			
		}

		if(dataObj.car_return_location != '' && dataObj.car_return_location != undefined){
			if(dataObj.car_return_location_area != '' && dataObj.car_return_location_area != undefined){
				createSearchBar += 'returnLocation='+dataObj.car_return_location_area+'&';
				if(dataObj.return_location_tax != '' && dataObj.return_location_tax != undefined){
					createSearchBar += 'returnLocationTax='+dataObj.return_location_tax+'&';
				}
			}else{
				createSearchBar += 'returnLocation='+dataObj.car_return_location+'&';
				if(dataObj.return_location_tax != '' && dataObj.return_location_tax != undefined){
					createSearchBar += 'returnLocationTax='+dataObj.return_location_tax+'&';
				}
			}
			
		}

		if(dataObj.car_type != '' && dataObj.car_type != undefined){
			createSearchBar += 'carType='+dataObj.car_type+'&';
			if(dataObj.car_type_tax != '' && dataObj.car_type_tax != undefined){
				createSearchBar += 'carTypeTax='+dataObj.car_type_tax+'&';
			}
		}	

		if(dataObj.pickUpDate != '' && dataObj.pickUpDate != undefined){
			createSearchBar += 'pickUpDate='+dataObj.pickUpDate+'&'; 
		}

		if(dataObj.returnDate != '' && dataObj.returnDate != undefined){
			createSearchBar += 'returnDate='+dataObj.returnDate+'&'; 
		}
		
		window.location.href = dataObj.search_page+'#/?'+'type='+type+'&'+createSearchBar;

		return false;

	});

	/*Home page search for car end*/


	// PROPERTY IMAGES
	$( '.fleet-details .property-images' ).each(function(){

		var self = $(this),
		image_list = self.find( '.image-list' ),
		images = image_list.find( '.image' ),
		images_count = images.length,
		footer = self.find( '.images-footer' ),
		description = footer.find( '.image-description' ),
		counter = footer.find( '.image-counter' ),
		btn_prev = footer.find( '.prev-btn' ),
		btn_next = footer.find( '.next-btn' ),
		slide_image_count = 0;

		// ADD CLASSES
		if ( images_count === 1 ) {
		  self.addClass( 'single-image' );
		}
		if ( images.find( 'img[alt=""]' ).length === images_count || images.find( 'img:not([alt])' ).length === images_count ) {
		  self.addClass( 'no-description' );
		}

		// SET FIRST IMAGE DESCRIPTION
		if ( images.first().find( 'img' ).attr( 'alt' ) ) {
		  description.text( images.first().find( 'img' ).attr( 'alt' ) );
		}

		// INIT OWL SLIDER
		if ( $.fn.owlCarousel && images_count > 1 ) {

			// SET COUNTER
			if(slide_image_count>=images_count){
			    slide_image_count = 1;
			  }
			counter.text( '1/' + images_count );

			image_list.owlCarousel({
				autoPlay: false,
				slideSpeed: 300,
				pagination: false,
				paginationSpeed : 400,
				singleItem:true,
				addClassActive: true,
				afterMove: function(){

					var active = image_list.find( '.owl-item.active' ),
					index = active.index();
					slide_image_count++;

					if(slide_image_count>=images_count){
					slide_image_count = 0;
					}

					// SET DESCRIPTION
					if ( active.find( 'img' ).attr( 'alt' ) ) {
					description.text( active.find( 'img' ).attr( 'alt' ) );
					}
					else {
					description.text( '' );
					}

					// SET COUNTER
					counter.text( parseInt( slide_image_count ) + 1 + '/' + images_count );

				}
			});

			btn_prev.click(function(){
			image_list.trigger( 'owl.prev' );
			});
			btn_next.click(function(){
			image_list.trigger( 'owl.next' );
			});

		}

	});




	/*search query for shortcut search start*/

	$('ul.short-cuts li').click(function(){

		console.log('clicked');

		var reservationTypeTax = $(this).children("a").children("span").data("taxonomy");
		var searchPage = $(this).children("a").children("span").data("search");
		var searchTerm = $(this).children("a").children("span").data("terms");

		var createSearchBar = '';

		if(reservationTypeTax != '' && reservationTypeTax != undefined){
			createSearchBar += 'reservationTypeTax='+reservationTypeTax+'&'; 
		}


		if(searchTerm != '' && searchTerm != undefined){
			createSearchBar += 'searchTerm='+searchTerm+'&'; 
		}



		
		
		window.location.href = searchPage+'#/?'+createSearchBar;

	});


	/*search query for shortcut search end*/






	$('.return-car').hide();

	$('#return-car-to-different-location').click(function() {
        if($(this).is(':checked'))
            $('.return-car').show();
        else
            $('.return-car').hide();
    });




	/*start login script*/

	$('#bg-login').click(function(e){
        e.preventDefault();
        console.log('hi');

        var get_all_data = $('#bg-login-form').serializeArray();

        $.ajax({
        	
            url: ajax_object.ajaxurl+'?action=bg_login',
            type: 'POST',
            dataType:"json",
            data: get_all_data,
            success:function(result){

			    if(!result.loggedin){
			        $(".status").html(result.message).show(0).delay(5000).hide(0);
			    }else{

					$(".status").html(result.message).show(0).delay(5000).hide(0);
					window.location.href = result.url;
			    }

            }
        });

    });






	/*end login script*/

	

	$(".my_select_box").chosen();

  	$('.car_location_city').change(function(){  		
  		
  		var locations = locations_data.locations,
  			city      = $(this).val(),
          	areas     = $('.car_location_area');

  		var opt = '<option value=""> Choose Area </option>';

		$.each( locations, function( key, value ) {     
		if(key === city){          
		  $.each(value, function(ky , val){
		    opt += '<option value="'+val+'"> '+val+' </option>';  
		  })        
		}
		});

		$('.car_location_area').html(opt);
		$('.car_location_area').trigger("liszt:updated");
  	});
	


  	$('.car_return_location_city').change(function(){  		
  		
  		var locations = locations_data.return_locations,
  			city      = $(this).val(),
          	areas     = $('.car_return_location_area');

  		var opt = '<option value=""> Choose Area </option>';

		$.each( locations, function( key, value ) {     
		if(key === city){          
		  $.each(value, function(ky , val){
		    opt += '<option value="'+val+'"> '+val+' </option>';  
		  })        
		}
		});

		$('.car_return_location_area').html(opt);
		$('.car_return_location_area').trigger("liszt:updated");
  	});
	

	






})(jQuery);	