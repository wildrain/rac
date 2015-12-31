
<?php 

	global $autorent_option_data,$sitepress; 

	$background_image = $autorent_option_data['autorent-home-page-banner-image']['url'];
	$search_form = get_post_meta($post->ID, '_autorent_search_form_type', true);

	if(isset($autorent_option_data['autorent-select-search-page'])){
		$search_page = $autorent_option_data['autorent-select-search-page'];										
	}

	if($search_form === 'search_form_with_solid_bg'){
		$bg_color = "light-skin";
	}else{
		$bg_color = "dark-skin";
	}

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

    if ( is_plugin_active('sitepress-multilingual-cms/sitepress.php')){
    	$current_lang = $sitepress->get_current_language(); 
		$default_lang = $sitepress->get_default_language();
		$search_page_id = icl_object_id($search_page, 'page', false, $current_lang);
    }else{
    	$search_page_id = $search_page;
    }	

?>


<?php if(isset($autorent_option_data['autorent-home-page-banner']) && !empty($autorent_option_data['autorent-home-page-banner'])): ?>

<!-- Start Intro -->
<div class="intro" style="<?php if(isset($background_image) && !empty($background_image)){?>background-image: url(<?php echo esc_url($background_image);}?>);background-size:cover;">
   

    <div class="container">


      	
      	<?php if(isset($autorent_option_data['autorent-home-page-search']) && !empty($autorent_option_data['autorent-home-page-search'])): ?>

	    <div class="col-lg-5 col-lg-offset-0 col-md-5 col-md-offset-0 col-sm-8 col-sm-offset-2">


	        <div class="reservation">

	        	
	        	<?php
					$args = array(
								'orderby'  => 'name', 
								'order'    => 'ASC',
								'fields'   => 'all', 
							); 
					if(taxonomy_exists('reservation_type')){
						$terms = get_terms('reservation_type', $args);
					}

				?>
	        	<ul class="nav nav-tabs list-inline horizontal-tab clearfix" role="tablist">							
					<?php if(isset($terms) && !empty($terms)) : ?>         
						<?php foreach($terms as $key => $value) { ?>
							<?php if($key == 0){$active="active"; $tab="book";}else{$active = ""; $tab = "buy";} ?>
							<li class="tab-title <?php echo esc_attr($active); ?>"><a href="#<?php echo esc_attr($tab); ?>" role="tab" data-toggle="tab" data-rel="<?php echo esc_attr($value->slug); ?>"><?php _e('Fill the Fields'); ?></a></li>						
						<?php } ?>
					<?php endif; ?>							
				</ul>

	          
				<!-- Start Tab-Content -->
				<div class="tab-content">


					<!-- Start book section -->

					<?php if(isset($autorent_option_data['autorent_booktype_switch']) && $autorent_option_data['autorent_booktype_switch']): ?>

					<div class="tab-pane fade active in" id="book">
						
						<form action="#" class="reservation-form <?php echo esc_attr($bg_color); ?> default-form">


							<!-- configure car switch filed start -->
							<?php if($autorent_option_data['autorent_car_type_search_switch'] == 1) : ?>
							<div class="car-type reservation-step">
								<span class="step-number color-yellow">
									<?php if(isset($autorent_option_data['autorent_car_type_index']) && !empty($autorent_option_data['autorent_car_type_index'])): ?>
										<?php echo esc_attr( $autorent_option_data['autorent_car_type_index'] ); ?>
									<?php endif; ?>								
								</span>	

								<?php if(!empty($autorent_option_data['autorent_car_type_search_chage_name'])): ?>
									<h4 class="step-title"><?php echo esc_attr($autorent_option_data['autorent_car_type_search_chage_name']); ?></h4>
								<?php else: ?>    
									<h4 class="step-title"><?php _e('Choose Car Type:','autorent'); ?></h4>
								<?php endif; ?>
								<?php 
									$selected_tax = $autorent_option_data['autorent_car_type_search_select'];
									$args = array(
										'orderby'           => 'name', 
										'order'             => 'ASC',
										'fields'      => 'all',       
									); 
									if(taxonomy_exists($selected_tax)){
										$terms = get_terms($selected_tax, $args);
									}									
								?>								
								<?php if(isset($terms) && !empty($terms)) : ?>
									<span class="select-boxes" title="car-type">
										<select name="car_type" class="my_select_box" data-placeholder="<?php _e('- Select -','autorent'); ?> ">
											<option value=""><?php _e('- Select -','autorent'); ?></option>           
											<?php foreach($terms as $key => $value) { ?>
												<option value="<?php echo esc_attr($value->slug); ?>"><?php echo esc_attr($value->name); ?></option>
											<?php } ?>
										</select>
									</span>
								<?php endif; ?> 									
							</div>
							<input type="hidden" name="car_type_tax" value="<?php echo esc_attr($selected_tax); ?>">							
							<?php endif; ?>		
							<!-- configure car switch filed end -->









							<!-- Configure location field start -->
							<?php if($autorent_option_data['autorent_search_location_switch'] == 1) : ?>							
							<div class="location reservation-step">							
								<span class="step-number color-yellow">
									<?php if(isset($autorent_option_data['autorent_location_index']) && !empty($autorent_option_data['autorent_location_index'])): ?>
										<?php echo esc_attr( $autorent_option_data['autorent_location_index'] ); ?>
									<?php endif; ?>								
								</span>
								<!-- Arrival date start -->
								
								<?php if(!empty($autorent_option_data['autorent_location_chage_name'])): ?>
									<h4 class="step-title"><?php echo esc_attr($autorent_option_data['autorent_location_chage_name']); ?></h4>
								<?php else: ?>    
									<h4 class="step-title"><?php _e('Pick-up Location:','autorent'); ?></h4>
								<?php endif; ?>
								<?php 
									$selected_location = $autorent_option_data['autoren_search_location_select'];
									if($selected_location == 'city'){
										$placeholder = __('Select a city','autorent');
									}elseif($selected_location == 'state'){
										$placeholder = __('Select a state','autorent');
									}elseif($selected_location == 'airport'){
										$placeholder = __('Select a Airport','autorent');
									}								

									$args = array(
										'orderby' => 'name', 
										'order'   => 'ASC',
										'fields'  => 'all',  
										'parent'  => 0,    
									); 

									if(taxonomy_exists($selected_location)){
										$terms = get_terms($selected_location, $args);
									}									
								?>
								
								<?php if(isset($terms) && !empty($terms)) : ?>
									<span class="select-box-locations" title="car_location">
										<select name="car_location" class="my_select_box car_location_city" data-placeholder="- <?php echo esc_attr(_e($placeholder,'autorent')); ?> -">
											<option value=""><?php _e('- Select -','autorent'); ?></option>           
											<?php foreach($terms as $key => $value) { ?>
												<option value="<?php echo esc_attr($value->slug); ?>"><?php echo esc_attr($value->name); ?></option>
											<?php } ?>
										</select>
									</span>
									
									<span class="styled-selectss" title="car_location_area">
										<select name="car_location_area" class="my_select_box car_location_area" data-placeholder="- Choose Area -">
											<option value=""><?php _e('- Choose Area -','autorent'); ?></option> 											
										</select>
									</span>

								<?php endif; ?> 

								<input type="hidden" name="location_tax" value="<?php echo esc_attr($selected_location); ?>">
								<!-- Arrival date end -->

								<!-- Return on Location start -->
								<?php if($autorent_option_data['autorent_return_location_switch']) : ?>
									<span class="checkbox-input">
										<input type="checkbox" name="return_location" id="return-car-to-different-location">
										<label for="return-car-to-different-location"><?php _e('Return car to a different location','autorent'); ?></label>
									</span>	
									<div class="return-car">								
										<?php if(!empty($autorent_option_data['autorent_return_location_chage_name'])): ?>
											<h4 class="step-title"><?php echo esc_attr($autorent_option_data['autorent_return_location_chage_name']); ?></h4>
										<?php else: ?>    
											<h4 class="step-title"><?php _e('Return Location:','autorent'); ?></h4>
										<?php endif; ?>
										<?php 

											$return_location = $autorent_option_data['autoren_return_location_select'];										
											$args = array(
												'orderby'           => 'name', 
												'order'             => 'ASC',
												'fields'      => 'all',       
											);
											if(taxonomy_exists($return_location)){
												$return_terms = get_terms($return_location, $args);
											}											
										?>										
										<?php if(isset($return_terms) && !empty($return_terms)) : ?>  
											<span class="select-box-return-location" title="car_location">
												<select name="car_return_location" class="my_select_box car_return_location_city" data-placeholder="- <?php _e('Select Return Location','autorent'); ?> -">
													<option value=""><?php _e('- Select -','autorent'); ?></option>           
													<?php foreach($return_terms as $key => $value) { ?>
														<option value="<?php echo esc_attr($value->slug); ?>"><?php echo esc_attr($value->name); ?></option>
													<?php } ?>
												</select>
											</span>

											<span class="styled-selectss" title="car_return_location_area">
												<select name="car_return_location_area" class="my_select_box car_return_location_area" data-placeholder="- Choose Return Area -">
													<option value=""><?php _e('- Choose Return Area -','autorent'); ?></option> 											
												</select>
											</span>


										<?php endif; ?> 
										<input type="hidden" name="return_location_tax" value="<?php echo esc_attr($return_location); ?>">				
									</div>
								<?php endif; ?>
								<!-- Return on Location end -->
							</div>
							<?php endif; ?>
							<!-- Configure location field end -->









							<!-- start pickupdate and returndate  -->

							<?php if($autorent_option_data['autorent_pickup_date_switch'] || $autorent_option_data['autorent_return_date_switch'] == 1) : ?>
							<div class="date reservation-step">
								<span class="step-number color-yellow">
									<?php if(isset($autorent_option_data['autorent_date_index']) && !empty($autorent_option_data['autorent_date_index'])): ?>
										<?php echo esc_attr( $autorent_option_data['autorent_date_index'] ); ?>
									<?php endif; ?>								
								</span>	

								<?php if($autorent_option_data['autorent_pickup_date_switch'] == 1) : ?>
									<div class="pickupdatetime">	
										<?php if(!empty($autorent_option_data['autorent_pickup_date_chage_name'])): ?>
											<h4 class="step-title"><?php echo esc_attr($autorent_option_data['autorent_pickup_date_chage_name']); ?></h4>
										<?php else: ?>    
											<h4 class="step-title"><?php _e('Pick-up & Return Date:','autorent'); ?></h4>
										<?php endif; ?>
										<span class="calendar-input">
											<input type="text" name="pickUpDate" placeholder="<?php _e('Pick Up Date','autorent'); ?>" data-dateformat="dd-mm-yy">
											<i class="fa fa-calendar"></i>
										</span>
										<span class="select-box time">
											<select class="returnon-location pickup-time" name="pick-up-time">
												<option value=""><?php _e('PickupTime','autorent'); ?></option> 						
												<?php getTimeDropDown(); ?>
											</select>
										</span>
									</div>
								<?php endif; ?>							


								<?php if($autorent_option_data['autorent_return_date_switch'] == 1) : ?>
									<div class="returndatetime">
										<span class="calendar-input">
											<input type="text" name="returnDate" placeholder="<?php _e('Return Date','autorent'); ?>" data-dateformat="dd-mm-yy">
											<i class="fa fa-calendar"></i>
										</span>
										<span class="select-box time">
											<select class="returnon-location pickup-time" name="pick-up-time">
												<option value=""><?php _e('ReturnTime','autorent'); ?></option> 						
												<?php getTimeDropDown(); ?>
											</select>
										</span>
									</div>
								<?php endif; ?>
							</div>
							<?php endif; ?>	


							<div class="flight reservation-step">
								<!-- <h4 class="step-title"><?php _e('Flight No. if applicable : ','autorent'); ?></h4>
								<span class="flight-no-input">
									<input type="text" name="flight-no" placeholder="<?php _e('Flight No. if applicable','autorent'); ?>">
								</span> -->
							</div>

							<!-- end pickupdate and returndate  -->





							<input type="hidden" name="search_page" value="<?php echo esc_url(get_permalink($search_page_id)); ?>">
							<div class="cta-button">
								<button class="yellow"><?php _e('Continue','autorent'); ?></button>
							</div>




						</form>

					</div>

					<?php endif; ?>

					<!-- End Book Section -->



					<!-- start buy section -->

					<?php if(isset($autorent_option_data['autorent_buytype_switch']) && $autorent_option_data['autorent_buytype_switch']): ?>


					<div class="tab-pane fade" id="buy">

						<form action="#" class="reservation-form <?php echo esc_attr($bg_color); ?> default-form">


							<?php if($autorent_option_data['autorent_search_location_switch'] == 1) : ?>
							
							<div class="location reservation-step">


							
								<span class="step-number color-yellow">
									<?php if(isset($autorent_option_data['autorent_location_index']) && !empty($autorent_option_data['autorent_location_index'])): ?>
										<?php echo esc_attr( $autorent_option_data['autorent_location_index'] ); ?>
									<?php endif; ?>								
								</span>
								
								<?php if(!empty($autorent_option_data['autorent_location_chage_name'])): ?>
									<h4 class="step-title"><?php echo esc_attr($autorent_option_data['autorent_location_chage_name']); ?></h4>
								<?php else: ?>    
									<h4 class="step-title"><?php _e('Pick-up Location:','autorent'); ?></h4>
								<?php endif; ?>


								<?php 

									$selected_location = $autorent_option_data['autoren_search_location_select'];


									if($selected_location == 'city'){
										$placeholder = __('Select a city','autorent');
									}elseif($selected_location == 'state'){
										$placeholder = __('Select a state','autorent');
									}elseif($selected_location == 'airport'){
										$placeholder = __('Select a Airport','autorent');
									}
									

									$args = array(
										'orderby'           => 'name', 
										'order'             => 'ASC',
										'fields'      => 'all',       
									); 

									if(taxonomy_exists($selected_location)){
										$terms = get_terms($selected_location, $args);
									}
									
								?>

								
								<?php if(isset($terms) && !empty($terms)) : ?>     

									<span class="select-box" title="car-location">
										<select name="car_location" data-placeholder="- <?php echo esc_attr(_e($placeholder,'autorent')); ?> -">
											<option value=""><?php _e('- Select -','autorent'); ?></option>           
											<?php foreach($terms as $key => $value) { ?>
												<option value="<?php echo esc_attr($value->slug); ?>"><?php echo esc_attr($value->name); ?></option>
											<?php } ?>
										</select>
									</span>

								<?php endif; ?> 
								<input type="hidden" name="location_tax" value="<?php echo esc_attr($selected_location); ?>">
							</div>

							<?php endif; ?>



							<?php if($autorent_option_data['autorent_car_type_search_switch'] == 1) : ?>

							<div class="car-type reservation-step">

								<span class="step-number color-yellow">
									<?php if(isset($autorent_option_data['autorent_buy_car_type_index']) && !empty($autorent_option_data['autorent_buy_car_type_index'])): ?>
										<?php echo esc_attr( $autorent_option_data['autorent_buy_car_type_index'] ); ?>
									<?php endif; ?>								
								</span>

								<?php if(!empty($autorent_option_data['autorent_car_type_search_chage_name'])): ?>
									<h4 class="step-title"><?php echo esc_attr($autorent_option_data['autorent_car_type_search_chage_name']); ?></h4>
								<?php else: ?>    
									<h4 class="step-title"><?php _e('Choose Car Type:','autorent'); ?></h4>
								<?php endif; ?>


								<?php 

									$selected_tax = $autorent_option_data['autorent_car_type_search_select'];

									$args = array(
										'orderby'           => 'name', 
										'order'             => 'ASC',
										'fields'      => 'all',       
									); 

									if(taxonomy_exists($selected_tax)){
										$terms = get_terms($selected_tax, $args);
									}

									
								?>

								
								<?php if(isset($terms) && !empty($terms)) : ?>     

									<span class="select-box" title="car-type">
										<select name="car_type" data-placeholder="<?php _e('- Select -','autorent'); ?> ">
											<option value=""><?php _e('- Select -','autorent'); ?></option>           
											<?php foreach($terms as $key => $value) { ?>
												<option value="<?php echo esc_attr($value->slug); ?>"><?php echo esc_attr($value->name); ?></option>
											<?php } ?>
										</select>
									</span>

								<?php endif; ?> 						
										
									
							</div>
							<input type="hidden" name="car_type_tax" value="<?php echo esc_attr($selected_tax); ?>">


							<?php endif; ?>


							<input type="hidden" name="search_page" value="<?php echo esc_url(get_permalink($search_page_id)); ?>">


							<div class="cta-button">
								<button class="yellow"><?php _e('Make reservation now','autorent'); ?></button>
							</div>


						</form>

					</div>

					<?php endif; ?>

					<!-- End buy section -->


				</div>
				<!-- End Tab-Content -->

	        </div> 


	    </div>


		<?php endif; ?>

      



		<!-- start shortcut section -->


		
		<?php if(isset($autorent_option_data['autorent_quick_search_switch']) && !empty($autorent_option_data['autorent_quick_search_switch'])) : ?>


		<?php 

			$selected_quick_tax = $autorent_option_data['autorent_quick_search_select_tax'];

			$args = array(
				'orderby'           => 'name', 
				'order'             => 'ASC',
				'fields'      => 'all',       
			); 

			if(taxonomy_exists($selected_quick_tax)){
				$terms = get_terms($selected_quick_tax, $args);
			}

			
		?>






	    <div class="col-lg-6 col-lg-offset-1 col-md-7 col-md-offset-0 col-sm-8 col-sm-offset-2">
			<ul class="short-cuts custom-list">


				<?php if(isset($terms) && !empty($terms)) : ?>     

			         
					<?php foreach($terms as $key => $value) { ?>


						<li>
							<a href="#">
								<div class="icon-left"><i class="fa fa-rocket fa-3x"></i></div>
								<span data-taxonomy="<?php echo esc_attr($selected_quick_tax); ?>"  data-search="<?php echo esc_url(get_permalink($search_page)); ?>" data-terms="<?php echo esc_attr($value->slug); ?>"><?php echo esc_attr($value->name); ?></span>
								<div class="icon-ahead"><i class="fa fa-long-arrow-right"></i></div>
							</a>						

						</li>

				
					<?php } ?>
			
				<?php endif; ?> 



			</ul>

			<?php if(isset($autorent_option_data['autorent_intro_switch']) && !empty($autorent_option_data['autorent_intro_switch'])) : ?>

	        <div class="intro-text">
				<h1 class="main-title"><?php echo esc_attr($autorent_option_data['autorent_intro_title_text']); ?></h1>
				<h5><?php echo esc_attr($autorent_option_data['autorent_intro_subtitle_text']); ?></h5>
	        </div>

	    	<?php endif; ?>

	    </div>

		<?php endif; ?>





	    <!-- End shortcut section -->



    </div>


</div>

<?php endif; ?>
<!-- End Intro -->