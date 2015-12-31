<?php

global $woocommerce, $product , $autorent_option_data;

?>
	<?php do_action( 'woocommerce_before_add_to_cart_form' ); ?>

	<form class="cart uou-form default-form" method="post" enctype='multipart/form-data'>

		<?php  ?>
		<?php 

			$get_product_base_cost = get_post_meta($product->id, 'uou_bookable_main_cost', true );
			$pickupdate = get_post_meta($product->id, 'home_search_pickup_date', true );
			$returndate = get_post_meta($product->id, 'home_search_returen_date', true );
			$pickuplocation = get_post_meta($product->id, 'home_search_pickuplocation', true );
			$returnlocation = get_post_meta($product->id, 'home_search_returnlocation', true );

		 ?>	



		<div id="uou-bookings-booking-form">
			
			<?php 

				$args = array(
					'orderby'           => 'name', 
					'order'             => 'ASC',
					'fields'      => 'all',       
				); 

				if(taxonomy_exists('state')){
					$states = get_terms('state', $args);
				}
				if(taxonomy_exists('city')){
					$cities = get_terms('city', $args);
				}
				if(taxonomy_exists('airport')){
					$airports = get_terms('airport', $args);
				}

				$terms = array_merge($states,$cities,$airports);
				
			?>

			
			<?php if(isset($terms) && !empty($terms)) : ?>     
				<h5><?php _e('Pick up location', 'uou-bookings') ?></h5>
				<select class="pick-up-location" name="pick-up-location">
					<option value=""><?php _e('- Select -','autorent'); ?></option>           
					<?php foreach($terms as $key => $value) { ?>
						<?php 
							if($value->slug == $pickuplocation){
								$selected = 'selected';	
							}else{
								$selected = '';
							} 
						?>
						<option value="<?php echo esc_attr($value->slug); ?>" <?php echo $selected; ?>><?php echo esc_attr($value->name); ?></option>
					<?php } ?>
				</select>

			<?php endif; ?>



			<?php 

				$args = array(
					'orderby'           => 'name', 
					'order'             => 'ASC',
					'fields'      => 'all',       
				); 

				if(taxonomy_exists('return_location')){
					$terms = get_terms('return_location', $args);
				}
				
			?>

			
			<?php if(isset($terms) && !empty($terms)) : ?>     
				<h5><?php _e('Return location', 'uou-bookings') ?></h5>
				<select class="returnon-location" name="pick-up-location">
					<option value=""><?php _e('- Select -','autorent'); ?></option>           
					<?php foreach($terms as $key => $value) { ?>
						<?php 
							if($value->slug == $returnlocation){
								$rselected = 'selected';	
							}else{
								$rselected = '';
							} 
						?>
						<option value="<?php echo esc_attr($value->slug); ?>" <?php echo $rselected; ?>><?php echo esc_attr($value->name); ?></option>
					<?php } ?>
				</select>

			<?php endif; ?>






		
			
			<?php if(isset($autorent_option_data['autorent_show_resource_field_switch']) && !empty($autorent_option_data['autorent_show_resource_field_switch'])): ?>

				<h5><?php _e('Resource', 'uou-bookings') ?></h5>
				
				<select class="my_select_box" multiple data-placeholder="Select Your Options" name="resoruce_select">
				<?php

					$booking_resource_meta = json_decode(get_post_meta( $product->id,'bookable_availibility_resource',true));

				    $resource_name = '';
				    $resource_value = '';
				    
				    if(isset($booking_resource_meta) && !empty($booking_resource_meta)){

				    	foreach ($booking_resource_meta as $meta) {

					    	foreach ($meta as $key => $value) {
					    		if($meta[$key]->name == 'uou_booking_resouce_availibility'){
					    			$resource_name = $meta[$key]->value;

					    			$post_7 = get_post($resource_name, ARRAY_A);
									$title = $post_7['post_title'];
					    		}
					    		if($meta[$key]->name == '_uou_booking_resource_cost'){
					    			$resource_value = $meta[$key]->value;
					    		}
					    	}
					    	?>

					        	<?php $val = array("title","resource_value"); ?>
							    <option value='{"resource_name":"<?php echo esc_attr($title); ?>","cost":"<?php echo esc_attr($resource_value); ?>"}'><?php echo esc_attr($title) . ' : &nbsp; &nbsp; ' . esc_attr(get_woocommerce_currency_symbol()).$resource_value; ?></option>


					        <?php
					    }

				    }
				    

				?>

				</select><!-- #end resource -->

			<?php endif; ?>


			<?php if(isset($autorent_option_data['autorent_show_person_field_switch']) && !empty($autorent_option_data['autorent_show_person_field_switch'])): ?>

				<h5><label> <?php _e('No. of Person', 'uou-bookings') ?></label></h5>
				
				<select id="person_cost_dropdown" class="my_select_box" name="person_select" data-placeholder="Select Your Options">
					<option value='{"person_no":"0","cost":"0"}'>Choose Additional Person Cost</option>

				<?php
					$booking_meta = json_decode( get_post_meta( $product->id, 'bookable_meta', true ) );

					$people_capacity = get_post_meta( $product->id,'_concierge_vehicle_people_capacity',true);
					
					if(is_array($booking_meta)){
					    foreach ($booking_meta as $meta) {

					    	$person_check = $meta['0']->value;

					    	if($person_check == 'uou_person'){
					    		foreach ($meta as $key => $value) {

						    		if($meta[$key]->name == '_uou_booking_number_person'){
						    			$person_no = $meta[$key]->value;
						    		}

						    		if($meta[$key]->name == "_uou_booking_cost"){
						    			$person_cost = $meta[$key]->value;

						    		}
						    	}

					    		?>

						        <option value='{"person_no":"<?php echo esc_attr($person_no+$people_capacity); ?>","cost":"<?php echo esc_attr($person_cost); ?>"}'><?php echo 'No of person ( ' . $person_no . ' ) - Additional Cost :   &nbsp; &nbsp;' .esc_attr(get_woocommerce_currency_symbol()). $person_cost; ?></option>


						    	<?php

					    	}

					    }
					}

				?>
				</select>

			<?php endif; ?>




			<p id="check-in-wrapper" class="form-row">
				<span class="calendar-input input-left" title="Departure">
					<input type="text" class="check-in" name="check-in" value="<?php echo esc_attr($pickupdate); ?>" placeholder="<?php _e('Arrival', 'uou-bookings') ?>">
					<i class="fa fa-calendar check-in"></i>
				</span>
				
				<select class="returnon-location pickup-time" name="pick-up-time" style="width: 49% !important; height: 43px;">
					<option value=""><?php _e('- Pickup time -','autorent'); ?></option> 						
					<?php getTimeDropDown(); ?>
				</select>

			</p>
			

			<p id="check-out-wrapper" class="form-row">
				<span class="calendar-input input-left" title="Departure">
					<input type="text" class="check-out" name="check-out" value="<?php echo esc_attr($returndate); ?>" placeholder="<?php _e('Departure', 'uou-bookings') ?>">
					<i class="fa fa-calendar check-out"></i>
				</span>
				<select class="returnon-location dropoff-time" name="drop-off-time" style="width: 49% !important; height: 43px;">
					<option value=""><?php _e('- Dropoff time -','autorent'); ?></option> 					
					<?php getTimeDropDown(); ?>
				</select>
			</p>

 			<?php do_action( 'woocommerce_before_add_to_cart_button' ); ?>

		</div>

		<h5 class="calculate-cart-total"><?php _e('Total Booking Cost : &nbsp;', 'uou-bookings') ?><span class = "total_cost"></span></h5>

		<input type="hidden" name="add-to-cart" value="<?php echo esc_attr( $product->id ); ?>" />
		<input type="hidden" class="currency_symbol" name="currency" value="<?php echo esc_attr( get_woocommerce_currency_symbol() ); ?>" />

		<button type="submit" class="single_add_to_cart_button button alt"><?php echo esc_attr($product->single_add_to_cart_text()); ?></button>

		<?php do_action( 'woocommerce_after_add_to_cart_button' ); ?>

	</form>

	<?php do_action( 'woocommerce_after_add_to_cart_form' ); ?>
