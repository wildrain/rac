<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage concierge
 * @since 1.0
 */

 get_header();

?>


<!-- Start Blog -->
<section class="blog">
	<div class="container">
		<div class="col-lg-8 col-md-8">
			<article>

				<?php if ( has_post_thumbnail() ) { ?>					

					<?php 

						$image_id =  get_post_thumbnail_id( get_the_ID() );
						$large_image = wp_get_attachment_image_src( $image_id ,'large');  										

					?>
					<img src="<?php echo esc_url($large_image[0]); ?>" alt="" class="main-photo">


				<?php } ?>

				
				<header>
					<h4 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

					<ul class="post-meta list-inline custom-list">

						<li>
							<i class="fa fa-comments"></i>
							<span>
								<?php 
							
									if(! post_password_required() && ( comments_open() || get_comments_number() )){
										comments_popup_link( 'No comment', '1 comment', '% comments', 'article-post-meta' );
									}
								?>	
							</span>
						</li>

						<li><i class="fa fa-user"></i><span><?php the_author_posts_link(); ?></span></li>
						<li><i class="fa fa-clock-o"></i><span><a href="<?php the_permalink(); ?>"><?php echo esc_attr(get_the_date('j M Y')); ?></a></span></li>
						<?php if(has_category()): ?>		
							<li><i class="fa fa-tags"></i><span><?php the_category('&nbsp;,&nbsp;'); ?></span></li>
						<?php endif; ?>

					</ul>
					


				</header>


				<div class="article-content single-post">
					<div class="entry-content">

						<?php 

							the_content();
							wp_link_pages( array(
								'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentyfourteen' ) . '</span>',
								'after'       => '</div>',
								'link_before' => '<span>',
								'link_after'  => '</span>',
							) ); 
							
						?>
						
					</div> 


					<?php if(has_tag()) : ?>

						<?php the_tags('<ul class="tags list-inline custom-list"><li>','</li><li>','</li></ul>'); ?>
					
					<?php endif; ?>


					<ul class="social list-inline custom-list">
						<?php if(isset($autorent_option_data['autorent-share-button-facebook']) && $autorent_option_data['autorent-share-button-facebook'] == 1) : ?>
						<li><a  href="http://www.facebook.com/sharer.php?u=<?php home_url();?> "><i class="fa fa-facebook"></i></a></li>
						<?php endif; ?>
						<?php if(isset($autorent_option_data['autorent-share-button-twitter']) && $autorent_option_data['autorent-share-button-twitter'] == 1) : ?>
						<li><a  href="http://twitthis.com/twit?url=<?php home_url(); ?>"><i class="fa fa-twitter"></i></a></li>
						<?php endif; ?>
						<?php if(isset($autorent_option_data['autorent-share-button-linkedin']) && $autorent_option_data['autorent-share-button-linkedin'] == 1) : ?>
						<li><a href="http://www.linkedin.com/shareArticle??url=<?php home_url();?>"><i class="fa fa-linkedin"></i></a></li>
						<?php endif; ?>
					</ul>


					<div id="comments">

						<?php comments_template('', true); ?>

					</div>



				</div>
			</article>
		</div>


		<div class="col-lg-4 col-md-4">
			<?php get_sidebar(); ?>
		</div>


	</div>
</section>
<!-- End Blog -->









<?php get_footer(); ?>





