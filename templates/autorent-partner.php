<?php 
	global $autorent_option_data;

	if(isset($autorent_option_data['autorent_our_partner_bg_color'])){
		$partner_bg_color = $autorent_option_data['autorent_our_partner_bg_color']['color'];
	}
	if(isset($autorent_option_data['autorent_our_partner_bg_image'])){
		$partner_bg_image = $autorent_option_data['autorent_our_partner_bg_image']['url'];
	}
?> 

<!-- Start Clients -->

<?php if(isset($autorent_option_data['autorent-partners-switch']) && !empty($autorent_option_data['autorent-partners-switch'])) : ?>

	
	<?php if(isset($autorent_option_data['autorent-our-partners']) && !empty($autorent_option_data['autorent-our-partners'])){ ?>

		<section class="clients" style="<?php if(isset($partner_bg_image) && !empty($partner_bg_image)){?>background-image: url(<?php echo esc_url($partner_bg_image);}?>);background-size:cover; <?php if(isset($partner_bg_color) && !empty($partner_bg_color)){?>background: <?php echo esc_url($partner_bg_color);}?>">
			<div class="container">
				<div class="clients-slider">	

					<?php foreach ($autorent_option_data['autorent-our-partners'] as $key => $value) { ?>

						<?php if(!empty($value['image'])){ ?>
							<div class="client">
								<a href="<?php echo esc_url($value['url']); ?>"><img src="<?php echo esc_url($value['image']); ?>" alt=""></a>
							</div>
						<?php } ?>

					<?php } ?>

				</div>
			</div>
		</section>

	<?php } ?>

<?php endif; ?>


<!-- End Clients -->
		