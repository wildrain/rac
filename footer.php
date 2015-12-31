<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package WordPress
 * @subpackage autorent
 * @since 1.0
 */
?>

<?php global $autorent_option_data; ?>

	<!-- Start Footer -->

	<?php 

		if(isset($autorent_option_data['autorent_footer_bg_color'])){
			$footer_bg_color = $autorent_option_data['autorent_footer_bg_color']['color'];
		}

		if(isset($autorent_option_data['autorent_footer_bg_image'])){
			$footer_bg_image = $autorent_option_data['autorent_footer_bg_image']['url'];			
		}

	?>

	<footer id="footer">

	<!-- Start Footer-Top -->
	<div class="footer-top" style="<?php if(isset($footer_bg_image) && !empty($footer_bg_image)){?>background-image: url(<?php echo esc_url($footer_bg_image);}?>);background-size:cover; <?php if(isset($footer_bg_color) && !empty($footer_bg_color)){?>background: <?php echo esc_url($footer_bg_color);}?>">
		
		<div class="container">
			<!-- start left footer widgets -->
			<?php

				if(is_active_sidebar('autorent_footer_left_sidebar')):

					dynamic_sidebar('autorent_footer_left_sidebar');

				endif;	

			?>
			<!-- end left footer widgets -->


			<!-- start footer middle widgets -->
			<?php

				if(is_active_sidebar('autorent_footer_middle_sidebar')):

					dynamic_sidebar('autorent_footer_middle_sidebar');

				endif;	

			?>
			<!-- end footer middle widgets -->


			<!-- start right footer widgets -->
			<?php

				if(is_active_sidebar('autorent_footer_right_sidebar')):

					dynamic_sidebar('autorent_footer_right_sidebar');

				endif;	

			?>

			<!-- end right footer widgets -->



		</div>
	</div>
	<!-- End Footer-Top -->



	<!-- Start Footer-Copyrights -->

	<?php 

		if(isset($autorent_option_data['autorent_our_partner_bg_color'])){
			$bg_color = $autorent_option_data['autorent_copyright_bg_color']['color'];
		}
		if(isset($autorent_option_data['autorent_our_partner_bg_image'])){
			$bg_image = $autorent_option_data['autorent_copyright_bg_image']['url'];
		}
	?> 

	<?php if(isset($autorent_option_data['autorent-show-footer-copyrights']) && $autorent_option_data['autorent-show-footer-copyrights'] == 1) : ?>
      	<div class="footer-copyrights text-center" style="<?php if(isset($bg_image) && !empty($bg_image)){?>background-image: url(<?php echo esc_url($bg_image);}?>);background-size:cover; <?php if(isset($bg_color) && !empty($bg_color)){?>background: <?php echo esc_url($bg_color);}?>">
      		<?php if(isset($autorent_option_data['autorent-copyright-text']) && !empty($autorent_option_data['autorent-copyright-text'])) : ?>
        	
          		<h5><?php echo esc_attr($autorent_option_data['autorent-copyright-text'] ); ?><?php _e( '&nbsp;Powered by' , 'autorent' ); ?> <a href="<?php echo esc_url($autorent_option_data['autorent-company-link']); ?>"><span class="color-yellow"><?php echo esc_attr($autorent_option_data['autorent-powered-by'] ); ?></span></a></h5>
        	
        	<?php endif; ?>
      	</div>
    <?php endif; ?>

	<!-- End Footer-Copyrights -->

	</footer>
	<!-- End Footer -->

</div>
<!-- End Main-Wrapper -->

<?php wp_footer(); ?>

</body>
</html>