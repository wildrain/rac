<?php
/**
 * The template for displaying Category Archive pages.
 *
 * @package WordPress
 * @subpackage autorent
 * @since 1.0
 */

get_header();  ?>


    <section class="blog">
		<div class="container">
			<div class="col-lg-8 col-md-8">

			  <!-- start single blog post --> 

			  <?php if(have_posts()) : while(have_posts()): the_post(); ?>

			    <?php get_template_part( 'templates/content', get_post_format()); ?>

			    
			  <?php endwhile; else : ?>               
			      <h5><?php _e( 'Sorry ! no blog post found ', 'concierge' ); ?></h5>     
			  <?php endif; ?>

			  <!-- end single blog post --> 


			  <!-- Start News-Posts Pagination -->

			  <?php $posts_per_page = get_option( 'posts_per_page' );  ?>
			  <?php $total_post = wp_count_posts( 'post');  ?> 

			  <?php if($posts_per_page < $total_post->publish) : ?>          

			    <?php autorent_pagination($pages = '', $range = 2); ?>          

			  <?php endif; ?>

			  <!-- End News-Posts Pagination -->
			  
			  
			</div>


			<!-- Start Sidebar -->
			<div class="col-lg-4 col-md-4">       

			  <?php get_sidebar(); ?>         

			</div>
			<!-- End Sidebar -->


		</div>

    </section>


    <!-- Start CTA -->
    <?php get_template_part( 'templates/autorent', 'purchasenow'); ?>
    <!-- End CTA -->
    

</div>
<!-- End Main-Wrapper -->



<?php get_footer(); ?>