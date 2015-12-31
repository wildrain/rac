<?php  
/**
 * Template Name: Company Locations
 *
 */
get_header();

?>






<!-- Start Map Locations -->
<div id="map-locations" style="width:100%; height: 550px;"></div>
<!-- End Map Locations -->





<!-- Start Locations -->
<section class="locations">
	<div class="container">
		<div class="row">


			<?php 

				$args = array(

						'post_type' => 'company_location',
						'show_per_page' => -1

					);

				$all_agencies = get_posts( $args );

				
			?>	

			<!-- Start Location-Agency -->

			<?php if(isset($all_agencies) && !empty($all_agencies)) :  ?>
				<?php foreach($all_agencies as $agecy_key => $agency_value){ ?>	

					<?php 

						$meta_value = get_post_meta($agency_value->ID,'_concierge_company_location_field',true); 
						
					 ?>

					<div class="location-agency">
						<div class="col-lg-6 col-md-6">
							<?php $agency_place = get_post_meta($agency_value->ID,'_concierge_company_location_place',true);  ?>
							<?php if(isset($agency_place) && !empty($agency_place)): ?>	
								<h3 class="location-agency-title"><?php echo esc_attr($agency_place); ?><?php _e('&nbsp;office','concierge'); ?></h3>
							<?php endif; ?>
							<h5 class="location-agency-subtitle"><?php _e('Office','concierge'); ?></h5>
							<ul class="custom-list location-agency-contact col-lg-6 col-md-6">
								
								<?php $agency_field = get_post_meta($agency_value->ID,'_concierge_company_location_field',true);  ?>
								<?php if(!empty($agency_field)): ?>
									<?php foreach($agency_field as $field_key => $field_value){ ?>	
										<li><?php echo esc_attr($field_value); ?></li>
									<?php } ?>
								<?php endif; ?>

							</ul>
							<ul class="custom-list location-agency-contact col-lg-6 col-md-6">
								
								<?php $agency_phone = get_post_meta($agency_value->ID,'_concierge_company_location_phone',true);  ?>
								<?php if(!empty($agency_phone)): ?>	
									<?php foreach($agency_phone as $phone_key => $phone_value){ ?>	
										<li><?php echo esc_attr('Phone '.intval($phone_key+1).' :&nbsp; '); ?><?php echo esc_attr($phone_value); ?></li>
									<?php } ?>
								<?php endif; ?>

								<?php if(!empty($agency_fax)): ?>
								<?php $agency_fax = get_post_meta($agency_value->ID,'_concierge_company_location_fax',true);  ?>
									<?php foreach($agency_fax as $fax_key => $fax_value){ ?>	
										<li><?php echo esc_attr('Fax '.intval($fax_key+1).' :&nbsp; '); ?><?php echo esc_attr($fax_value); ?></li>
									<?php } ?>	
								<?php endif; ?>

							</ul>
							<ul class="custom-list location-agency-contact col-lg-6 col-md-6">
								
								<?php $agency_email = get_post_meta($agency_value->ID,'_concierge_company_location_email',true);  ?>
								<?php if(!empty($agency_email)): ?>
									<?php foreach($agency_email as $email_key => $email_value){ ?>	
										<li><?php echo esc_attr('Email '.intval($email_key+1).' :&nbsp; '); ?><?php echo esc_attr($email_value); ?></li>
									<?php } ?>	
								<?php endif; ?>
								
								<?php $agency_website = get_post_meta($agency_value->ID,'_concierge_company_location_website',true);  ?>
								<?php if(!empty($agency_website)): ?>
								<?php foreach($agency_website as $website_key => $website_value){ ?>	
									<li><?php echo esc_attr('Website '.intval($website_key+1).' :&nbsp; '); ?><?php echo esc_attr($website_value); ?></li>
								<?php } ?>	
								<?php endif; ?>

							</ul>
						</div>
						<div class="col-lg-6 col-md-6">
							<?php 

						    	$image_id =  get_post_thumbnail_id( $agency_value->ID );
								$large_image = wp_get_attachment_image_src( $image_id ,'large'); 				

							?>
							<img src="<?php echo esc_url($large_image[0]); ?>" alt="" class="location-agency-thumbnail">
							
							<div class="button-overlay">
								<a href="tel:+43543543543" class="btn light">Call Us</a>
								<a href="mailto:youremail@mail.com" class="btn light">Mail Us</a>
							</div>
						</div>
					</div>

				<?php } ?>
			<?php endif; ?>
			<!-- End Location-Agency -->

		</div>
	</div>
</section>
<!-- End Locations -->




<!-- Start Partners -->
<section class="partners">
<?php get_template_part( 'templates/concierge', 'partner'); ?>  
</section>  
<!-- End Partners --> 


<?php get_footer();   ?>

