<?php


if ( ! isset( $content_width ) )
  $content_width = 1140;



/*-------------------------------------------------------------------------
  START REGISTER THEME FEATURES
------------------------------------------------------------------------- */


function autorent_wp_theme_features()  {

  global $wp_version;

  // Add theme support for Automatic Feed Links
  if ( version_compare( $wp_version, '3.0', '>=' ) ) :
    add_theme_support( 'automatic-feed-links' );
  endif;

  
  /*$formats = array( 'status', 'quote', 'gallery', 'image', 'video', 'audio', 'link', 'aside', 'chat', );
  add_theme_support( 'post-formats', $formats );*/

 
  add_theme_support( 'post-thumbnails' ); 
  add_theme_support( 'woocommerce' );
  add_theme_support( 'custom-header' );
  add_theme_support( "title-tag" );

  
  load_theme_textdomain( 'autorent', get_template_directory() . '/language' );

 

}

add_action( 'after_setup_theme', 'autorent_wp_theme_features' );


/*-------------------------------------------------------------------------
  END REGISTER THEME FEATURES
------------------------------------------------------------------------- */






add_filter('next_posts_link_attributes', 'autorent_posts_link_attributes');
add_filter('previous_posts_link_attributes', 'autorent_posts_link_attributes');


function autorent_posts_link_attributes() {
    return 'class="b-button"';
}




add_filter('next_post_link', 'autorent_post_link_attributes');
add_filter('previous_post_link', 'autorent_post_link_attributes');

function autorent_post_link_attributes($output) {
    $code = 'class="b-button"';
    return str_replace('<a href=', '<a '.$code.' href=', $output);
}






function autorent_theme_add_editor_styles() {
  add_editor_style( 'custom-editor-style.css' );
}
add_action( 'init', 'autorent_theme_add_editor_styles' );



add_filter( 'wpcf7_form_elements', 'autorent_wpcf7_form_elements' );

function autorent_wpcf7_form_elements( $form ) {
 /* print_r($form);*/
  $form = do_shortcode( $form );

  return $form;
}





/*-------------------------------------------------------------------------
  START REGISTER autorent SIDEBARS
------------------------------------------------------------------------- */

if ( ! function_exists( 'autorent_sidebar' ) ) {


function autorent_sidebar() {

  $args = array(
    'id'            => 'mainsidebar',
    'name'          => __( 'Blog Page Sidebar', 'autorent' ),   
    'description'   => __('Put your main sidebar widgets here','autorent'),  
    'before_widget' => '<div class="sidebar-widget custom-list">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="widget-title">',
    'after_title'   => '</h4>',
  );

  register_sidebar( $args );

   $footer_left_sidebar = array(

    'id'            => 'autorent_footer_left_sidebar',
    'name'          => __( 'Footer Left Sidebar', 'autorent' ),
    'description'   => __('Put your widgets here that show on footer left side area','autorent'),    
    'before_widget' => '<div class="widget col-lg-4 col-md-4 col-sm-12">',
    'after_widget'  => '</div>', 
    'before_title'  => '<h4 class="title">',
    'after_title'   => '</h4>',

  );

  register_sidebar( $footer_left_sidebar );

  $footer_middle_sidebar_agrs = array(

    'id'            => 'autorent_footer_middle_sidebar',
    'name'          => __( 'Footer Middle Sidebar', 'autorent' ),
    'description'   => __('Put your widgets here that show on footer middle area','autorent'), 
    'before_widget' => '<div class="widget contact col-lg-4 col-md-4 col-sm-12">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="title">',
    'after_title'   => '</h4>',

  );

  register_sidebar( $footer_middle_sidebar_agrs );

  $footer_right_sidebar = array(
    'id'            => 'autorent_footer_right_sidebar',
    'name'          => __( 'Footer Right Sidebar', 'autorent' ),
    'description'   => __('Put your widgets here that show on footer right side area','autorent'), 
    'before_widget' => '<div class="widget col-lg-4 col-md-4 col-sm-12">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4 class="title">',
    'after_title'   => '</h4>',
  );

  register_sidebar( $footer_right_sidebar );


}

add_action( 'widgets_init', 'autorent_sidebar' );

}

/*-------------------------------------------------------------------------
  END RESGISTER autorent SIDEBARS
------------------------------------------------------------------------- */




/*-------------------------------------------------------------------------
  START RESGISTER NAVIGATION MENUS FOR autorent
 ------------------------------------------------------------------------- */   

function autorent_custom_navigation_menus() {

  $locations = array(

    'primary_navigation'   => __( 'Primary Menu', 'uoulib' ),   

  );

  register_nav_menus( $locations );

}

add_action( 'init', 'autorent_custom_navigation_menus' );

/*-------------------------------------------------------------------------
  END REGISTER NAVIGATION MENUS FOR  autorent
 ------------------------------------------------------------------------- */ 





