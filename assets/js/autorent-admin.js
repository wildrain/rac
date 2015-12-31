(function($){

	/*start template showing*/

	"use strict";
	
	$('#concierge_front_page').hide();	

	var currentTemplate = $('#page_template').val();

	if(currentTemplate === 'Home-page.php' || currentTemplate === 'templates/about.php'){
		$('#concierge_front_page').show();
	}


	$('#page_template').change(function(){

		var template = $(this).val();
		
		if(template === 'Home-page.php' || template === 'templates/about.php'){					
			$('#concierge_front_page').show('slow');
		}else{
			$('#concierge_front_page').hide('slow');			
		}


	});

	/*end template showing*/


	/*admin panel include map start*/	

	$('#_autorent_property_address_map_canvas').closest("table").addClass("google_map");
	jQuery(".google_map").parent().append('<div id="map_canvas" style="height: 450px; width: 100%">' );


	$('#_map_ca_0').closest("table").addClass("google_map");
	jQuery(".google_map").parent().append('<div id="map_canvas" style="height: 450px; width: 100%">' );

	/*admin panel include map end*/



	/*page templete show or hide start*/

	$('#autorent_front_page').hide();
	$('#autorent_search_form').hide();

	var currentTemplate = $('#page_template').val();


	if(currentTemplate === 'Home-page.php' || currentTemplate === 'templates/autorent-page-templates.php'){
		
		$('#autorent_front_page').show();		
		
	}else if(currentTemplate === 'Home-page.php'){
		$('#autorent_search_form').show();
	}


	$('#page_template').change(function(){

		var template = $(this).val();

		if(template === 'templates/autorent-page-templates.php'){
			
			$('#autorent_front_page').show('slow');	
			$('#autorent_search_form').hide('slow');			

		}else if(template === 'Home-page.php') {
			$('#autorent_search_form').show('show');
			$('#autorent_front_page').show('slow');	
		}else{

			$('#autorent_front_page').hide('slow');
			$('#autorent_search_form').hide('slow');
		}	

	});

	/*page templete show or hide end */


	

})(jQuery);