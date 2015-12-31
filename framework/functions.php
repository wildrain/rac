<?php



/*-------------------------------------------------------------------------
  START INITIALIZE FILE LINK
------------------------------------------------------------------------- */

require_once(TEMPLATEPATH . '/framework/constants.php');
require_once(TEMPLATEPATH . '/framework/ext/extensions-setup.php');
require_once(TEMPLATEPATH . '/framework/theme/functions.php');
require_once(TEMPLATEPATH . '/framework/theme/scripts.php');
require_once(TEMPLATEPATH . '/framework/theme/stylesheet.php');
require_once(TEMPLATEPATH . '/framework/theme/Breadcrumbs.php');
require_once(TEMPLATEPATH . '/framework/theme/contact-form.php');
require_once(TEMPLATEPATH . '/framework/admin/functions.php');
require_once(TEMPLATEPATH . '/framework/ext/autorent-recent-posts.php');
require_once(TEMPLATEPATH . '/framework/ext/autorent-about.php');
require_once(TEMPLATEPATH . '/framework/ext/autorent-get-touch.php');
require_once(TEMPLATEPATH . '/framework/theme/woo-functions.php');
require_once(TEMPLATEPATH . '/framework/theme/autorent-image.php');
require_once(TEMPLATEPATH . '/framework/theme/autorent-wpml.php');


/*-------------------------------------------------------------------------
  END INITIALIZE FILE LINK
------------------------------------------------------------------------- */



/*-------------------------------------------------------------------------
  START ENQUEUING REDUX OPTION FRAMEWORK
------------------------------------------------------------------------- */

if(THEME_HAS_PANEL == TRUE){



	if ( !class_exists( 'ReduxFramework' ) && file_exists( dirname( __FILE__ ) . '/redux/ReduxCore/framework.php' ) ) {
	    require_once( dirname( __FILE__ ) . '/redux/ReduxCore/framework.php' );
	}
	if ( !isset( $casa_option_data ) && file_exists( dirname( __FILE__ ) . '/redux/config/config.php' ) ) {
	    require_once( dirname( __FILE__ ) . '/redux/config/config.php' );
	}

	
}

/*-------------------------------------------------------------------------
  END ENQUEUING REDUX OPTION FRAMEWORK
------------------------------------------------------------------------- */


