<?php
/**
 * The default template for displaying content
 *
 * @package WordPress
 * @subpackage autorent
 * @since 1.0
 */
	
  global $autorent_option_data;		

?>


<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<?php if(has_post_thumbnail()): ?>

		<?php 

	    	$image_id =  get_post_thumbnail_id( get_the_ID() );
			$large_image = wp_get_attachment_image_src( $image_id ,array(801,350)); 				

		?>
		<a href="<?php the_permalink(); ?>"><img src="<?php echo esc_url($large_image[0]); ?>" alt=""  class="main-photo"></a>
	

	<?php endif; ?>	

	<!-- <img src="<?php //echo AUTORENT_IMAGE; ?>article-thumbnail-1.jpg" alt=""> -->
	
		
	<?php if(is_sticky(get_the_ID()) == 1):  ?>


		<div class="marker-ribbon">
	        <div class="ribbon-banner">
	            <div class="ribbon-text">Sticky</div>
	        </div>
	    </div>

	<?php endif; ?>    



	<header>
		<h4 class="title"><a href=" <?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

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

	<div class="article-content">
		<?php 
			the_excerpt();
		?>


		<a href="<?php the_permalink(); ?>" class="btn yellow"><?php _e('Read More','autorent' ); ?></a>


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

	</div>	

	


</article>

