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

    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Imperial Premium Rent a Car is a premium car rental company based in Dubai. We offer great customer services to serve your needs like Car Rental in Dubai. 
    It is fast, simple and easy. so enjoy the ride!" />       
    <link rel="shortcut icon" href="dummies/favicon.ico">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">


    <?php global $autorent_option_data; ?>

      <!-- favicon  -->
    <?php if(isset($autorent_option_data['autorent-favicon']) && !empty($autorent_option_data['autorent-favicon'])): ?>
    <link rel="shortcut icon" href="<?php echo esc_url($autorent_option_data['autorent-favicon']['url']); ?>" type="image/x-icon" />
    <?php endif; ?>


    <?php if(isset($autorent_option_data['autorent-favicon-iphone']) && !empty($autorent_option_data['autorent-favicon-iphone'])): ?>
    <!-- For iPhone -->
    <link rel="apple-touch-icon-precomposed" href="<?php echo esc_url($autorent_option_data['autorent-favicon-iphone']['url']); ?>">
    <?php endif; ?>


    <?php if(isset($autorent_option_data['autorent-favicon-ipad']) && !empty($autorent_option_data['autorent-favicon-ipad'])): ?>
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

		<?php $header_bg_coor = $autorent_option_data['autorent_header_bg_color']['color'];	?>

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


	<!-- Start Header-Title-Inner -->	

	<?php 

		if(is_home() || is_front_page() || is_category() || is_tag() || is_author() || is_404() || is_archive() || is_search()){

			if(isset($autorent_option_data['autorent-general-banner'])){
				$background_image = $autorent_option_data['autorent-general-banner']['url'];	
			}

			if(isset($autorent_option_data['autorent-general-banner-color'])){
				$background_color = $autorent_option_data['autorent-general-banner-color']['color'];	
			}			
			
		}

		if(is_page_template('atmf-search.php') || is_singular( 'product' )){
			
			if(isset($autorent_option_data['autorent-product-banner'])){
				$background_image = $autorent_option_data['autorent-product-banner']['url'];	
			}

			if(isset($autorent_option_data['autorent-product-banner-color'])){
				$background_color = $autorent_option_data['autorent-product-banner-color']['color'];	
			}			
				
		}


		if(is_page_template('templates/contact-us.php')){
			
			if(isset($autorent_option_data['autorent-contact-banner'])){
				$background_image = $autorent_option_data['autorent-contact-banner']['url'];	
			}

			if(isset($autorent_option_data['autorent-contact-banner-color'])){				
				$background_color = $autorent_option_data['autorent-contact-banner-color']['color'];
			}

		}

		if(is_page_template('templates/autorent-page-templates.php')){

			if(isset($autorent_option_data['autorent-frontpage-banner'])){
				$background_image = $autorent_option_data['autorent-frontpage-banner']['url'];	
			}

			if(isset($autorent_option_data['autorent-frontpage-banner-color'])){
				$background_color = $autorent_option_data['autorent-frontpage-banner-color']['color'];
			}

		}



		if(is_page() && !is_page_template('templates/autorent-page-templates.php') && !is_page_template('templates/contact-us.php') && !is_page_template('atmf-search.php') && !is_singular( 'product' )  ){
			
			if(isset($autorent_option_data['autorent-defaultpage-banner'])){
				$background_image = $autorent_option_data['autorent-defaultpage-banner']['url'];	
			}

			if(isset($autorent_option_data['autorent-defaultpage-banner-color'])){
				$background_color = $autorent_option_data['autorent-defaultpage-banner-color']['color'];	
			}

				
			
		}


	 ?>




	<div class="sub-header" style="<?php if(isset($background_color) && !empty($background_color)) {?>background: <?php echo esc_attr($background_color);}?>; <?php if(isset($background_image) && !empty($background_image)){?>background-image: url(<?php echo esc_url($background_image);}?>);background-size:cover;">

		<?php if(is_home() || is_front_page()): ?>

			<h2><?php _e( 'Blog', 'autorent' ); ?></h2>

		<?php elseif(is_category()): ?>

			<h2><?php printf( __( 'Category Archives: %s', 'autorent' ), '<span>' . single_cat_title( '', false ) . '</span>' ); ?></h2>
		
		<?php elseif(is_tag()): ?>

			<h2><?php printf( __( 'Tag Archives: %s', 'autorent' ), '<span>' . single_tag_title( '', false ) . '</span>' ); ?></h2>
		
		<?php elseif(is_author()): ?>
			
			<?php
				$curauth = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
			?>
			
			<h2><?php _e('Posts written by: ', 'adaptive-framework'); ?> <?php echo esc_attr($curauth->display_name); ?></h2>
		
		<?php elseif(is_404()): ?>

			<h2><?php _e( 'Error 404', 'autorent' ); ?></h2>

		<?php elseif(is_archive()): ?>
			
			<?php if ( is_day() ) : ?>
		        <h2><?php printf( __( 'Daily Archives: <span>%s</span>', 'autorent' ), get_the_date() ); ?></h2>
		    <?php elseif ( is_month() ) : ?>
		        <h2><?php printf( __( 'Monthly Archives: <span>%s</span>', 'autorent' ), get_the_date( _x( 'F Y', 'monthly archives date format', 'autorent' ) ) ); ?></h2>
		    <?php elseif ( is_year() ) : ?>
		        <h2><?php printf( __( 'Yearly Archives: <span>%s</span>', 'autorent' ), get_the_date( _x( 'Y', 'yearly archives date format', 'autorent' ) ) ); ?></h2>
		    <?php else : ?>
		        <h2><?php _e( 'Blog Archives', 'autorent' ); ?></h2>
		    <?php endif; ?>
			

		<?php elseif(is_search()): ?>

			<h2><?php _e( 'Search Result for "', 'autorent' ); ?><?php echo esc_attr(get_search_query()); ?><?php echo '"'; ?></h2>	

		<?php else: ?>

			<h2><?php the_title(); ?></h2>

		<?php endif; ?>


		<!-- <h2 class="pull-left">News</h2> -->
		<ul class="custom-list breadcrumbs">

			<?php autorent_breadcrumbs(); ?>
			
		</ul>

	</div>
	<!-- End Header-Title-Inner -->

