<?php
/**
 * Related Products
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop , $autorent_option_data;

if ( empty( $product ) || ! $product->exists() ) {
	return;
}

$related = $product->get_related( $posts_per_page );



if ( sizeof( $related ) == 0 ) return;

$args = apply_filters( 'woocommerce_related_products_args', array(
	'post_type'            => 'product',
	'ignore_sticky_posts'  => 1,
	'no_found_rows'        => 1,
	'posts_per_page'       => $posts_per_page,
	'orderby'              => $orderby,
	'post__in'             => $related,
	'post__not_in'         => array( $product->id )
) );

$products = new WP_Query( $args );

$woocommerce_loop['columns'] = $columns;

if ( $products->have_posts() ) : ?>

	<?php if(isset($autorent_option_data['autorent_show_related_product_switch']) && !empty($autorent_option_data['autorent_show_related_product_switch'])): ?>

		<div class="related products">

			<h4 class="title-related"><?php _e( 'Related Products', 'woocommerce' ); ?></h4>

			<?php woocommerce_product_loop_start(); ?>

				<?php while ( $products->have_posts() ) : $products->the_post(); ?>

					<?php wc_get_template_part( 'content', 'related-product' ); ?>

				<?php endwhile; // end of the loop. ?>

			<?php woocommerce_product_loop_end(); ?>

		</div>	

	<?php endif; ?>

<?php endif;

wp_reset_postdata();
