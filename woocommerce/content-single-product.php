
<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * Override this template by copying it to yourtheme/woocommerce/content-single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php
	/**
	 * woocommerce_before_single_product hook
	 *
	 * @hooked wc_print_notices - 10
	 */
	 do_action( 'woocommerce_before_single_product' );

	 if ( post_password_required() ) {
	 	echo get_the_password_form();
	 	return;
	 }
?>

<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>


	<?php 
		global $post, $autorent_option_data,$product;		
		$product_meta = get_post_custom($post->ID);					
	?>
	
<div>

<div>

	<!-- Start Listing-Details -->
	<section class="listing-details">
	    <div class="container">

	      	<div class="col-lg-8">
		        <div class="row">
			        <div class="fleet-details col-lg-12 col-md-12">


			        	<!-- property images start -->									
						<div class="property-images">

							<?php 

								$gallery = $product_meta['_product_image_gallery'][0];
								$gallery_img_id = explode(',', $gallery);										

							?>

							<div class="image-list">										
								<?php if(isset($gallery_img_id) && is_array($gallery_img_id)){ ?>
								<?php foreach($gallery_img_id as $key=>$value){ ?>
								<?php
									$large_image = wp_get_attachment_image_src( $value ,'huge');   
								 ?>
								<div class="owl-item active" style="width: 720px;">
									<div class="image">
										<img src="<?php echo esc_url($large_image[0]); ?>" alt="See more photos of this car" style="height: 405px; width: 100%">
									</div>
								</div>
								<?php }} ?>									
							</div>					

							<div class="images-footer">
								<div class="images-footer-inner">
									<div class="image-description"><?php _e( 'See more photos of this car', 'autorent' ); ?></div>
									<div class="image-counter">1/3</div>
								</div>
								<button class="prev-btn"><i class="fa fa-chevron-left"></i></button>
								<button class="next-btn"><i class="fa fa-chevron-right"></i></button>
							</div>

						</div>								
						<!-- PROPERTY IMAGES : end -->




						<header class="vechicle-header">
							<div class="header-inner">
								<h4 class="title pull-left"><?php the_title(); ?></h4>

								<?php $price = $product_meta['_price'][0]; ?>
								<div class="pull-right"><?php _e('Starting from ','autorent'); ?><?php echo wc_price( $price ); ?></div>

							</div>
						</header>

						<div class="vechicle-content"><?php the_content(); ?></div>



						<!-- TABS : begin -->
									
						<div class="fleet-vechicle-review">
							<?php
								/**
								 * woocommerce_after_single_product_summary hook
								 *
								 * @hooked woocommerce_output_product_data_tabs - 10
								 * @hooked woocommerce_output_related_products - 20
								 */
								do_action( 'woocommerce_after_single_product_summary' );
							?>
						</div>
						
						<!-- TABS : end -->

			        </div>
		        </div>
	   		</div>  <!-- END COL-LG-8 -->




			<div class="col-lg-4">

				<div class="sidebar">

					<!-- PROPERTY MAP : begin -->

					<?php if(isset($autorent_option_data['autorent_google_map_switch']) && !empty($autorent_option_data['autorent_google_map_switch'])): ?>

						<div class="fleet-details-sidebar google-map-location">

							<?php if(isset($product_meta['_autorent_property_address_lng'][0]) && isset($product_meta['_autorent_property_address_lat'][0])){ ?>
								
								<?php 

									if($autorent_option_data['autorent_map_zoom_car_single_map']){
										$map_zoom_level = $autorent_option_data['autorent_map_zoom_car_single_map'];
									}else{
										$map_zoom_level = 14;
									}

									$long = $product_meta['_autorent_property_address_lng'][0];
									$lat = $product_meta['_autorent_property_address_lat'][0];

						 		?>

								<?php if($long != '' && $lat != ''){  ?>

									<iframe src="https://maps.google.com/maps?q=<?php echo esc_attr($lat); ?>,<?php echo esc_attr($long); ?>&amp;num=1&amp;ie=UTF8&amp;ll=<?php echo esc_attr($lat); ?>,<?php echo esc_attr($long); ?>&amp;spn=0.007843,0.013937&amp;t=m&amp;z=<?php echo esc_attr($map_zoom_level); ?>&amp;output=embed"></iframe>
										
								<?php }else{ _e('porperty location is not defined','autorent'); }

							} ?>
							
						</div>	
					
					<?php endif; ?>

					<!-- PROPERTY MAP : end -->



					<!-- Property address details end -->

					<div class="fleet-details-sidebar">


						<?php 

							$additional_attrs = get_post_meta(get_the_ID(),'_autorent_add_attribute',true);
							//_log($additional_attrs);
						 ?>


						<?php if(isset($autorent_option_data['autorent_show_property_details_switch']) && !empty($autorent_option_data['autorent_show_property_details_switch'])): ?>
	
					
							<h4><?php the_title(); ?><?php _e('&nbsp;Properties:','autorent'); ?></h4>


							<ul class="custom-list properties fleet-vechicle-properties">
								<?php if(isset($product_meta['_autorent_vehicle_age'][0]) && !empty($product_meta['_autorent_vehicle_age'][0])): ?>
								<li><?php _e('Vehicle Age ','autorent') ?><strong><?php echo esc_attr($product_meta['_autorent_vehicle_age'][0]); ?></strong></li>
								<?php endif; ?>

								<?php if(isset($product_meta['_autorent_vehicle_people_capacity'][0]) && !empty($product_meta['_autorent_vehicle_people_capacity'][0])): ?>
								<li><?php _e('Capacity (People) ','autorent'); ?><strong><?php echo esc_attr($product_meta['_autorent_vehicle_people_capacity'][0]); ?><?php if(!empty($product_meta['_autorent_vehicle_additional_people_capacity'][0])): ?>+<?php echo esc_attr($product_meta['_autorent_vehicle_additional_people_capacity'][0]); ?><?php endif; ?></strong> </li>
								<?php endif; ?>

								<?php if(isset($product_meta['_autorent_vehicle_max_speed'][0]) && !empty($product_meta['_autorent_vehicle_max_speed'][0])): ?>
								<li><?php _e('Max Speed','autorent'); ?> <strong><?php echo esc_attr($product_meta['_autorent_vehicle_max_speed'][0]); ?></strong> </li>
								<?php endif; ?>

								<?php if(isset($product_meta['_autorent_vehicle_fuel_capacity'][0]) && !empty($product_meta['_autorent_vehicle_fuel_capacity'][0])): ?>
								<li><?php _e('Fuel Capacity','autorent'); ?><strong><?php echo esc_attr($product_meta['_autorent_vehicle_fuel_capacity'][0]); ?></strong></li>
								<?php endif; ?>

								<?php if(isset($product_meta['_autorent_vehicle_max_weight'][0]) && !empty($product_meta['_autorent_vehicle_max_weight'][0])): ?>
								<li><?php _e('Max Weight','autorent'); ?><strong><?php echo esc_attr($product_meta['_autorent_vehicle_max_weight'][0]); ?></strong></li>
								<?php endif; ?>

								<?php if(isset($product_meta['_autorent_vehicle_pilots'][0]) && !empty($product_meta['_autorent_vehicle_pilots'][0])): ?>
								<li><?php _e('Pilots (Min.)','autorent'); ?><strong><?php echo esc_attr($product_meta['_autorent_vehicle_pilots'][0]); ?></strong></li>
								<?php endif; ?>	

								<?php if(isset($additional_attrs) && !empty($additional_attrs)): ?>

									<?php foreach($additional_attrs as $key => $value){ ?>
										<li>								
										<?php foreach($value as $keys => $values){ ?>

											<?php if($keys === '_name'): ?><?php echo esc_attr($values); ?><?php endif; ?>
											<?php if($keys === '_value'): ?><strong><?php echo esc_attr($values); ?></strong><?php endif; ?>
											
										<?php } ?>
										</li>

									<?php } ?>


								<?php endif; ?>	


							</ul>

						<?php endif; ?>



						<?php if(isset($autorent_option_data['autorent_show_booking_form_switch']) && !empty($autorent_option_data['autorent_show_booking_form_switch'])): ?>

							<div class="book-now">

								<h5><?php _e('Book Now :','autorent'); ?></h5>

								<div class="summary entry-summary">

									<?php
										/**
										 * woocommerce_single_product_summary hook
										 *
										 * @hooked woocommerce_template_single_title - 5
										 * @hooked woocommerce_template_single_rating - 10
										 * @hooked woocommerce_template_single_price - 10
										 * @hooked woocommerce_template_single_excerpt - 20
										 * @hooked woocommerce_template_single_add_to_cart - 30
										 * @hooked woocommerce_template_single_meta - 40
										 * @hooked woocommerce_template_single_sharing - 50
										 */
										do_action( 'woocommerce_single_product_summary' );
									?>

								</div><!-- .summary -->

							</div> <!-- END BOOK NOW SECTION -->

						<?php endif; ?>



					</div>  <!-- END CAR DETAILS -->
					


				</div> <!-- END SIDEBAR -->


			</div> <!-- END COL-LG-4 -->

	    </div> <!-- END CONTAINE -->

	</section>
	  <!-- End Listing-Details -->



	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->


<!-- Start Partners -->

<?php get_template_part( 'templates/autorent', 'rental_experience'); ?>  
  
<!-- End Partners blog --> 




<?php do_action( 'woocommerce_after_single_product' ); ?>
