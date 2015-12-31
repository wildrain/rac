<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments
 * and the comment form. The actual display of comments is
 * handled by a callback to twentyeleven_comment() which is
 * located in the functions.php file.
 *
 * @package WordPress
 * @subpackage concierge
 * @since 1.0
 */



if(!empty($_SERVER['SCRIPT-FILENAME']) && basename($_SERVER['SCRIPT-FILENAME']) == 'comments.php'){

	die(__('You can not access this file directly','concierge'));
}

/*check comments required password start*/
if(post_password_required()) : ?>

	<p>
		<?php _e('The post is password protected ! Enter password to see the post','concierge');
			  return;	
		 ?>
	</p>

<?php endif;
/*check comments required password end*/


if(have_comments()){ ?>

	<!-- comments count start -->
	 <h4 class="title"><?php comments_number( __('No Comment','concierge'), __(' 1 Comment','concierge'), __(' % Comments','concierge')); ?></h4>
	<!-- comments count end -->

	
	<!-- comments show start -->
	<ul class="custom-list comments">

		<?php 

			$args = array(

					'walker' => new autorent_comment_walker,
			        'style' => '',
			        'callback' => null,
			        'end-callback' => null,
			        'type' => 'all',
			        'page' => null,
			        'avatar_size' => 100

				);

		 ?>

		<?php wp_list_comments($args); ?>


	</ul>
	<!-- comments show end -->


	<!-- comments navigation start -->
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>

		<nav class="comment-nav">

			<ul class="pager">
		  		<li class="previous">
		    		<?php previous_comments_link( __( '<i class="icon-arrow-left"></i> Older comments', 'origines' ) ); ?>
		  		</li>
		  		<li class="next">
		    		<?php next_comments_link( __( 'Newer comments <i class="icon-arrow-right"></i>', 'origines' ) ); ?>
		  		</li>
			</ul>

		</nav>

	<?php endif; ?>
	<!-- comments navigation end -->


<?php } 


/*check comment is closed start*/
if(!comments_open() && !is_page() && post_type_supports(get_post_type(), 'comments')){ ?>

	<p class="closed"><?php _e('comments are closed .','autorent') ?></p>

<?php }
/*check comment is closed end*/

comment_form();


?>





	