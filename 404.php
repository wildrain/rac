<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage concierge
 * @since 1.0
 */

get_header();  ?>


	<!-- Start News -->

    <section class="news">
      	<div class="container">
	        <div class="row">

	          <!-- Start News-Posts -->
	          <div class="col-lg-8 col-md-8">	          	

	            <div class="news-posts">

		            <!-- start 404 page notice --> 

		            <h2><?php _e( '404 ! This is somewhat embarrassing', 'conciege' ); ?></h2>
		            <p><?php _e( 'Apologies, but no results were found. ', 'conciege' ); ?>
		                <a href="<?php echo esc_url(home_url()); ?>"><?php _e('Go Back','concierge'); ?></a>
		            </p>

		            <!-- end 404 page notice --> 

	            </div>
	            
	            <!-- Start News-Posts Pagination -->

	            <?php $posts_per_page = get_option( 'posts_per_page' );  ?>
	            <?php $total_post = wp_count_posts( 'post');  ?> 

	            <?php if($posts_per_page < $total_post->publish) : ?>

	            <ul class="news-posts-pagination">

	              <?php concierge_pagination($pages = '', $range = 2); ?>              
	              
	            </ul>

	            <?php endif; ?>

	            <!-- End News-Posts Pagination -->

	          </div>
	          <!-- End News-Posts -->

	          <!-- Start Sidebar -->
	          <div class="col-lg-4 col-md-4">
	            
	            <?php get_sidebar(); ?>
	            
	          </div>
	          <!-- End Sidebar -->
	        </div>
      	</div>
    </section>

    <!-- End News -->



	<!-- Start Partners -->
    <section class="partners">
    <?php get_template_part( 'templates/concierge', 'partner'); ?>  
    </section>  
    <!-- End Partners --> 

<?php get_footer();  ?>

