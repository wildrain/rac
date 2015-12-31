
<?php 

	
	global $autorent_option_data;
	if(isset($autorent_option_data['autorent-rental-experience-bg'])){
		$background_image = $autorent_option_data['autorent-rental-experience-bg']['url'];
	}

	if(isset($autorent_option_data['autorent-rental-experience-bg-color'])){
		$background_color = $autorent_option_data['autorent-rental-experience-bg-color']['color'];
	}
	
	
?>



<?php if($autorent_option_data['autorent-rental-experience-switch'] == 1): ?>


<section class="cta" style="<?php if(isset($background_image) && !empty($background_image)){?>background-image: url(<?php echo esc_url($background_image);}?>);background-size:cover; <?php if(isset($background_color) && !empty($background_color)){?>background: <?php echo esc_url($background_color);}?>">
	<?php if(isset($background_color) && empty($background_color)): ?>	
	<div id="overlay"></div>
	<?php endif; ?>
	<div class="container">
		<div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
			<?php if(isset($autorent_option_data['autorent-rental-experience-part1text'])): ?>
			<h3><?php echo esc_attr($autorent_option_data['autorent-rental-experience-part1text']); ?><span class="color-white"><?php echo esc_attr($autorent_option_data['autorent-rental-experience-part2text']); ?></span></h3>
			<?php endif; ?>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 text-right">

			<?php if(isset($autorent_option_data['autorent-rental-experience-readmore-button-text']) && !empty($autorent_option_data['autorent-rental-experience-readmore-button-text'])): ?>
			<div class="button-login">
				<a href="<?php echo esc_url($autorent_option_data['autorent-rental-experience-readmore-button-url']); ?>" class="btn white"><?php echo esc_attr($autorent_option_data['autorent-rental-experience-readmore-button-text']); ?></a>
			</div>
			<?php endif; ?>

			<?php if(isset($autorent_option_data['autorent-rental-experience-purchase-button-text']) && !empty($autorent_option_data['autorent-rental-experience-purchase-button-text'])): ?>
			<div class="button-register">
				<a href="<?php echo esc_url($autorent_option_data['autorent-rental-experience-purchase-button-url']); ?>" class="btn dark"><?php echo esc_attr($autorent_option_data['autorent-rental-experience-purchase-button-text']); ?></a>
			</div>
			<?php endif; ?>
		</div>
	</div>
</section>

<?php endif; ?>