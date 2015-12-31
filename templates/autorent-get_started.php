<?php 
	global $autorent_option_data;
?> 



    <div class="container">
      
		<!-- Start Heading -->
		<div class="heading light col-lg-8 col-lg-offset-2">
      
      <?php if(!empty($autorent_option_data['autorent_get_started_name_change'])): ?>
              <h3><?php echo esc_attr($autorent_option_data['autorent_get_started_name_change']); ?></h3>
          <?php else: ?>    
             <h3><?php _e('Get Started','autorent'); ?></h3>
          <?php endif; ?> 
			
			<span><i class="fa fa-car"></i></span>
		</div>
		<!-- End Heading -->
      
		<!-- Start Nav-Tabs -->
		<div class="col-lg-12 col-md-12 col-sm-12">
	  		<ul class="nav nav-tabs list-inline horizontal-tab clearfix" role="tablist">

	        <?php if($autorent_option_data['autorent-car-switch'] == 1) : ?>

	          <?php if(!empty($autorent_option_data['autorent_our_car_name_change'])): ?>
	              <li class="active"><a href="#cars" role="tab" data-toggle="tab"><?php echo esc_attr($autorent_option_data['autorent_our_car_name_change']); ?></a></li>
	          <?php else: ?>    
	              <li class="active"><a href="#cars" role="tab" data-toggle="tab"><?php _e('Our Cars','autorent'); ?></a></li>
	          <?php endif; ?>    
	        
	        <?php endif; ?>



	  			<?php if($autorent_option_data['autorent-location-switch'] == 1) : ?>

	          <?php if(!empty($autorent_option_data['autorent_location_name_change'])): ?>
	              <li class="our_location_mpa"><a href="#offices" role="tab" data-toggle="tab"><?php echo esc_attr($autorent_option_data['autorent_location_name_change']); ?></a></li>
	          <?php else: ?>    
	             <li class="our_location_mpa"><a href="#offices" role="tab" data-toggle="tab"><?php _e('Our Offices','autorent'); ?></a></li>
	          <?php endif; ?> 

	        <?php endif; ?>		


	        <?php if($autorent_option_data['autorent-brands-switch'] == 1) : ?>

	          <?php if(!empty($autorent_option_data['autorent_brand_name_change'])): ?>
	              <li class=""><a href="#brands" role="tab" data-toggle="tab"><?php echo esc_attr($autorent_option_data['autorent_brand_name_change']); ?></a></li>
	          <?php else: ?>    
	             <li class=""><a href="#brands" role="tab" data-toggle="tab"><?php _e('Our Brands','autorent'); ?></a></li>
	          <?php endif; ?>
	          
	  		  <?php endif; ?>

	      	</ul>
	  		<!-- End Nav-Tabs -->
      
	        <!-- Start Tab-Content -->
	        <div class="tab-content">




				<?php 

					$selected_tax = $autorent_option_data['autorent-tab-select'];

					$args = array(
						'orderby'           => 'name', 
						'order'             => 'ASC',
						'fields'      => 'all',       
					); 

					if(taxonomy_exists($selected_tax)){
						$terms = get_terms($selected_tax, $args);
					}


				?>




	          
				<?php if($autorent_option_data['autorent-car-switch'] == 1) : ?>


				<div class="tab-pane fade active in" id="cars">


		            <ul class="essentials-filters col-lg-12 col-md-12 col-sm-12 col-xs-12">

						<li><a href="#" class="active" data-filter="*"><?php _e('All','autorent'); ?></a></li>

						<?php if(isset($terms) && !empty($terms)) : ?>                
						<?php foreach($terms as $key => $value) { ?>
						<li><a href="#" data-filter=".<?php echo esc_attr($value->slug); ?>"><?php echo esc_attr($value->name); ?></a></li>
						<?php } ?>
						<?php endif; ?>   

		            </ul>

		            
		            <div class="essentials-filters-content">



		              <?php 

		                if(isset($terms) && !empty($terms)){

		              
		                  foreach($terms as $key => $value) { 

		                    

		                    $args = array(
		                      'post_type' => 'product',
		                      'tax_query' => array(
		                        array(
		                          'taxonomy' => $selected_tax,
		                          'field'    => 'slug',
		                          'terms'    => $value->slug,
		                          'posts_per_page' => -1,
		                        ),
		                      ),
		                    );

		                    $all_posts = new Wp_Query($args);
		                    $query = $all_posts->posts;

		                    

		                    if(isset($query) && !empty($query)){

								foreach($query as $keys => $posts){  ?>


								<div class="vechicle <?php echo esc_attr($value->slug); ?> col-lg-3 col-md-3 col-sm-6 col-xs-12">


									<?php if ( has_post_thumbnail($posts->ID) ) {

										$image_id =  get_post_thumbnail_id( $posts->ID );

										$large_image = wp_get_attachment_url( $image_id ,'full'); 

										$resize = autorent_aq_resize( $large_image, 255, 190, true );                           
									  
									?>

										<figure>
											<div class="overlay">
												<img src="<?php echo esc_url($resize); ?>" alt="">
												<div class="overlay-shadow">
													<div class="overlay-content">
														<a href="<?php echo esc_url(get_the_permalink($posts->ID)); ?>" target="_blank" class="btn white"><?php _e('Read More','autorent'); ?></a>
													</div>
												</div>
											</div>
										</figure>

									<?php } ?>



	

									<div class="caption">
										
										<?php 


											$price = get_post_meta( $posts->ID, '_price', true); 												

												
										?>

										
										<h5><a target="_blank" href="<?php echo esc_url(get_the_permalink($posts->ID)); ?>"><?php echo esc_attr($posts->post_title); ?></a></h5>
										<span class="price"><?php echo esc_attr( get_woocommerce_currency_symbol() ); echo esc_attr($price); ?></span>
										
										<?php 

											if( has_term( 'book', 'reservation_type',$posts->ID ) ) { ?>
											    <span class="per">Day</span>
											<?php }																

			
										 ?>


									</div>


								</div>



								<?php }

		                    }

		                  }

		                }
		                        
		               ?>

		              
		            </div>
		            <!-- END ESSENTIAL-FILTER -->


				</div> <!-- END TAB PANEL -->


				<?php endif; ?>





				
				<!-- START MAP -->

				<?php if($autorent_option_data['autorent-location-switch'] == 1) : ?>

				<div class="tab-pane fade" id="offices">
					<div class="col-lg-12 col-md-12 col-sm-12">
						<div id="offices-map"></div>
					</div>
				</div>

				<?php endif; ?>

				<!-- END MAP -->






				<?php if($autorent_option_data['autorent-brands-switch'] == 1): ?>




					<div class="tab-pane fade" id="brands">

						<?php if(isset($autorent_option_data['autorent-our-brands']) && !empty($autorent_option_data['autorent-our-brands'])){ ?>
							<?php foreach ($autorent_option_data['autorent-our-brands'] as $key => $value) { ?>

								<div class="brand col-lg-3">

									<?php if(!empty($value['image'])){ ?>

									<figure>
										<div class="overlay">
											<div class="logo">
												<img src="<?php echo esc_url($value['image']); ?>" alt="">
											</div>
											<div class="overlay-shadow">
												<div class="overlay-content">
													<a href="<?php echo esc_url($value['url']); ?>" target="_blank" class="btn white"><?php _e('Read More','autorent'); ?></a>
												</div>
											</div>
										</div>
									</figure>

									<div class="caption">
										<h5><a href="<?php echo esc_url($value['url']); ?>" target="_blank"><?php echo esc_attr($value['title']); ?></a></h5>
									</div>

									<?php } ?>

								</div>

							<?php } ?>

						<?php }else{ ?>

							<h4><?php _e('No Brand is set yet ! ' ,'autorent'); ?></h4>

						<?php } ?>


					</div> <!-- END TAB PANEL FOR BRAND -->

				<?php endif; ?>


	        </div> <!-- END TAB -CONTENT -->
        </div> <!-- END COL-LG-12 -->
	</div> <!-- END CONTAINER -->
	
