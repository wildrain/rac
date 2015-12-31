
jQuery( function( $ ) {


    "use strict";

	/*start google map*/


    var contactPageZoom = parseInt(autorent_option_data.autorent_map_zoom_for_contact_page); 
    var homePageZoom = parseInt(autorent_option_data.autorent_map_zoom_for_essential_block); 

    var styles = [
    
                    {"featureType":"landscape","stylers":[{"saturation":-100},{"lightness":65},{"visibility":"on"}]},
                    {"featureType":"poi","stylers":[{"saturation":-100},{"lightness":51},{"visibility":"simplified"}]},
                    {"featureType":"road.highway","stylers":[{"saturation":-100},{"visibility":"simplified"}]},
                    {"featureType":"road.arterial","stylers":[{"saturation":-100},{"lightness":30},{"visibility":"on"}]},
                    {"featureType":"road.local","stylers":[{"saturation":-100},{"lightness":40},{"visibility":"on"}]},
                    {"featureType":"transit","stylers":[{"saturation":-100},{"visibility":"simplified"}]},
                    {"featureType":"administrative.province","stylers":[{"visibility":"off"}]},
                    {"featureType":"water","elementType":"labels","stylers":[{"visibility":"on"},
                    {"lightness":-25},{"saturation":-100}]},
                    {"featureType":"water","elementType":"geometry","stylers":[{"hue":"#ffff00"},{"lightness":-25},{"saturation":-97}]}
                ]


    
    if(current_page == 'Home-page.php'){


        $('.our_location_mpa').click(function(){


            new Maplace({
                map_div: '#offices-map',
                locations: marker_location,
                start: 1,
               
                map_options: {
                    navigationControl: false, 
                    
                    scrollwheel: false,  
                    zoom: homePageZoom
                },
                styles: { 

                        'Night': [
                        {
                            featureType: 'all',
                            stylers: [{ invert_lightness: 'true' }]
                        }
                    ],
                    'Greyscale':  styles
                }

            }).Load(); 



        });

         

    }else if(current_page == 'templates/contact-us.php'){

        new Maplace({
            map_div: '#contact-map',
            locations: marker_location,
            start: 1,           
            map_options: {
                navigationControl: false,                
                scrollwheel: false,  
                zoom: contactPageZoom,
            },

            styles: { 

                    'Night': [
                    {
                        featureType: 'all',
                        stylers: [{ invert_lightness: 'true' }]
                    }
                ],
                'Greyscale':  styles
            }

        }).Load(); 
   

    }



});
