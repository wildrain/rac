<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package WordPress
 * @subpackage concierge
 * @since 1.0
 */

get_header(); 
global $concierge_option_data;

?>


    <!-- Start News -->
    <section class="news">
      <div class="container">
        <div class="row">

          <!-- Start News-Posts -->
          <div class="col-lg-12 col-md-12">

            <div class="news-posts">

              <!-- start single blog post --> 

              <?php if(have_posts()) : while(have_posts()): the_post(); ?>

              	<div <?php post_class( 'post row' ); ?> id="post-<?php the_ID(); ?> ">


					<?php if(has_post_thumbnail()){ ?>

					    <div class="col-lg-12 col-sm-12 thumb">

							<?php 

						    	$image_id =  get_post_thumbnail_id( get_the_ID() );
								$large_image = wp_get_attachment_image_src( $image_id ,array(295,295)); 				

							?>
							<a href="<?php the_permalink(); ?>"><img class="thumb" src="<?php echo esc_url($large_image[0]); ?>" alt=""></a>
				  	
					    </div>

					<?php } ?>


						<?php if($concierge_option_data['concierge-show-page-sidebar'] == 0){ ?>
						<div class="col-lg-12 col-sm-12 post-content">

							<header class="post-header">
								<h5><?php the_title(); ?></h5>
								<span><?php echo esc_attr(get_the_date('j M Y')); ?></span>
							</header>
							
							<?php if(current_user_can('edit_post',$post->ID )) {
								edit_post_link( __('Edit this','casa'),'<p class="article-meta-extra">', '</p>');
							} ?>

							<p>	<?php echo do_shortcode( the_content() );  ?> </p>

							<div>

								<?php 

									$args = array(

											'before' => '<p class="post-navigation">',
											'after' => '</p>',
											'pagelink' => 'Page %'
										);

									wp_link_pages( $args );

								 ?>

							</div>

						</div>
						<?php }else{ ?>

						<div class="col-lg-8 col-sm-8 post-content">

							<header class="post-header">
								<h5><?php the_title(); ?></h5>
								<span><?php echo esc_attr(get_the_date('j M Y')); ?></span>
							</header>
							
							<?php if(current_user_can('edit_post',$post->ID )) {
								edit_post_link( __('Edit this','casa'),'<p class="article-meta-extra">', '</p>');
							} ?>

							<p>	<?php echo do_shortcode( the_content() );  ?> </p>

							<div>

								<?php 

									$args = array(

											'before' => '<p class="post-navigation">',
											'after' => '</p>',
											'pagelink' => 'Page %'
										);

									wp_link_pages( $args );

								 ?>

							</div>

						</div>

						 <!-- Start Sidebar -->
					    <div class="col-lg-4 col-md-4">
					       
					       <?php get_sidebar(); ?>
					       
					    </div>
					    <!-- End Sidebar -->



						<?php } ?>

				</div>                

                
              <?php endwhile; else : ?>               
                  <h5><?php _e( 'Sorry ! no blog post found ', 'concierge' ); ?></h5>     
              <?php endif; ?>

              <!-- end single blog post --> 

            </div>            


          </div>
          <!-- End News-Posts -->

          <!-- Start Sidebar -->
          <!-- <div class="col-lg-4 col-md-4">
            
            <?php //get_sidebar(); ?>
            
          </div> -->
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



<?php get_footer();   ?>