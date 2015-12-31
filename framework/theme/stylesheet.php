<?php



/*-------------------------------------------------------------------------
  START ENQUEUING STYLESHEETS
------------------------------------------------------------------------- */

if( !function_exists('autorent_add_style') ){
  
	function autorent_add_style(){


	 	global $is_IE;


	 	$protocol = is_ssl() ? 'https' : 'http';
    	wp_enqueue_style( 'autorent-opensans', "$protocol://fonts.googleapis.com/css?family=Open+Sans" );
    	wp_enqueue_style( 'autorent-Montserrat', "$protocol://fonts.googleapis.com/css?family=Montserrat:400,700" );
    	wp_enqueue_style( 'autrent-Baskerville', "$protocol://fonts.googleapis.com/css?family=Libre+Baskerville:400italic" );

	
	  	wp_register_style('owl.carousel', AUTORENT_CSS.'owl.carousel.css', array(), $ver = false, $media = 'all');
	  	wp_enqueue_style('owl.carousel'); 


	  	wp_register_style('woocommerce', AUTORENT_CSS.'woocommerce.css', array(), $ver = false, $media = 'all');
	    wp_enqueue_style('woocommerce'); 	


	  	wp_register_style('autorent-main-stylesheet', AUTORENT_CSS.'style.css', array(), $ver = false, $media = 'all');
	  	wp_enqueue_style('autorent-main-stylesheet');


	}

}

add_action('wp_enqueue_scripts', 'autorent_add_style');

/*-------------------------------------------------------------------------
  END ENQUEUING STYLESHEETS
------------------------------------------------------------------------- */

	
?>