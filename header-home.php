<?php
if(isset($post) ){
    global $post;
    setup_postdata( $post );
}
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!-->

<html class="no-js" <?php language_attributes(); ?>>

<!--<![endif]-->
  <head>

    <!-- <title><?php //wp_title('|',true,'right'); ?></title> -->
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">    
    
    <link rel="shortcut icon" href="dummies/favicon.ico">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">


    <?php global $autorent_option_data; ?>

      <!-- favicon  -->
    <?php if(isset($autorent_option_data['autorent-favicon'])): ?>
    <link rel="shortcut icon" href="<?php echo esc_url($autorent_option_data['autorent-favicon']['url']); ?>" type="image/x-icon" />
    <?php endif; ?>


    <?php if(isset($autorent_option_data['autorent-favicon-iphone'])): ?>
    <!-- For iPhone -->
    <link rel="apple-touch-icon-precomposed" href="<?php echo esc_url($autorent_option_data['autorent-favicon-iphone']['url']); ?>">
    <?php endif; ?>


    <?php if(isset($autorent_option_data['autorent-favicon-ipad'])): ?>
    <!-- For iPad -->
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo esc_url($autorent_option_data['autorent-favicon-ipad']['url']); ?>">
    <?php endif; ?>

    <!-- end of favicon  -->
    <?php if ( is_singular() ) wp_enqueue_script( "comment-reply" ); ?>


    <?php wp_head(); ?>
      

  </head>

  <body <?php body_class("fixed-header"); ?>>


    <!-- Start Main-Wrapper -->
    <div id="main-wrapper">
  
      <!-- Start Header -->
      <?php $header_bg_coor = $autorent_option_data['autorent_header_bg_color']['color']; ?>  

      <header id="header" <?php if(isset($header_bg_coor) && !empty($header_bg_coor)): ?> style="background: <?php echo esc_attr($header_bg_coor); ?>" <?php endif; ?>>
        
        <div class="header-toolbar-left">
        
          <!-- Start Header-Logo -->
          <?php if(isset($autorent_option_data['autorent-header-icon']) && $autorent_option_data['autorent-header-icon']) : ?>
          <div class="header-logo">
            <a href="<?php echo esc_url(home_url()); ?>">
              <img src="<?php echo esc_url($autorent_option_data['autorent-header-icon']['url']);  ?>" alt="logo">
            </a>
          </div>
          <?php endif; ?>
          <!-- End Header-Logo -->


          <?php if(isset($autorent_option_data['autorent_header_car_icon']) && $autorent_option_data['autorent_header_car_icon']) : ?>

          <div class="header-logo-icon">
            <i class="fa fa-car fa-3x"></i>
          </div>

          <?php endif; ?>


          <!-- Start Social -->
          <?php if(isset($autorent_option_data['autorent-share-button']) && $autorent_option_data['autorent-share-button'] == 1) : ?>
          <ul class="social list-inline custom-list">
            <?php if(isset($autorent_option_data['autorent-share-button-facebook']) && $autorent_option_data['autorent-share-button-facebook'] == 1) : ?>
            <li><a  href="http://www.facebook.com/sharer.php?u=<?php home_url();?> "><i class="fa fa-facebook"></i></a></li>
            <?php endif; ?>
            <?php if(isset($autorent_option_data['autorent-share-button-twitter']) && $autorent_option_data['autorent-share-button-twitter'] == 1) : ?>
            <li><a  href="http://twitthis.com/twit?url=<?php home_url(); ?>"><i class="fa fa-twitter"></i></a></li>
            <?php endif; ?>
            <?php if(isset($autorent_option_data['autorent-share-button-linkedin']) && $autorent_option_data['autorent-share-button-linkedin'] == 1) : ?>
            <li><a href="http://www.linkedin.com/shareArticle??url=<?php home_url();?>"><i class="fa fa-linkedin"></i></a></li>
            <?php endif; ?>
          </ul> 
          <?php endif; ?>
          <!-- End Social -->

        </div>



        <div class="header-toolbar-right">



          <!-- Start autorent menu -->
          
          <?php get_template_part( 'templates/header', 'menu' ); ?>    

          <!-- End autorent menu -->



          <!-- Start header language part -->
          
          <?php get_template_part( 'templates/header', 'language' ); ?>    

          <!-- End header language part -->




          <!-- Start header login part -->

          <?php get_template_part( 'templates/header', 'login' ); ?>    

          <!-- End header login part -->




          <button class="toggle"><i class="fa fa-navicon"></i></button>

          
        </div>
      </header>
      <!-- End Header -->



      <!-- Start Intro -->

      <?php get_template_part( 'templates/autorent', 'intro' ); ?>    

      <!-- End Intro -->

