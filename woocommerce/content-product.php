<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.4.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
	$woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
	return;

// Increase loop count
$woocommerce_loop['loop']++;

// Extra post classes

$classes = array('col-lg-3', 'col-md-4',' col-sm-6','vechicle-single');
if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] )
	$classes[] = 'first';
if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] )
	$classes[] = 'last';
?>





<div <?php post_class( $classes ); ?> >

	<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>


		<?php 
			$meta = get_post_custom(get_the_ID());		
		?>


		<div class="vechicle-thumbnail">
			<div class="overlay">

				<?php 

					$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'large');
               		$product_image = autorent_aq_resize($large_image_url[0],263,263,true);
               
               		
				?>

				
				<a href="<?php the_permalink(); ?>" class="property-thumb">
				
					<?php if(!empty($product_image)){ ?>
						<img src="<?php echo esc_attr($product_image); ?>" alt="Product image" >						
					<?php }else{ ?>
						<img src="http://placehold.it/550x450&text=Property%20Image!" alt="Product image" >
						
					<?php } ?>
				</a>


				<div class="overlay-shadow">
					<div class="overlay-content">
						<a href="<?php the_permalink(); ?>" class="btn white"><?php _e('Read More','autorent') ?></a>
					</div>
				</div>
				
			</div>
		</div>




	<?php $product_meta = get_post_custom($post->ID);  ?>

	<div class="vechicle-specification">


		<header class="vechicle-header col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="header-inner">
                <h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            	<?php $price = $product_meta['_price'][0]; ?>
				<div><?php _e('Starting from ','autorent'); ?><div class="pull-right"><?php echo wc_price( $price ); ?></div></div>
            </div>
        </header>


		<ul class="properties col-lg-12 col-md-12 col-sm-12 col-xs-12">

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
		</ul>
	</div>

	<?php //do_action( 'woocommerce_after_shop_loop_item' ); ?>

</div>












