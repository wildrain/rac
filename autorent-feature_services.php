
<?php 

	global $autorent_option_data;

	
?>



<!-- Start Features-Icons -->

<?php if(isset($autorent_option_data['autorent-service-feature-switch']) && !empty($autorent_option_data['autorent-service-feature-switch'])) : ?>

<div class="container">



	<?php if(isset($autorent_option_data['autorent-service-features-slides']) && !empty($autorent_option_data['autorent-service-features-slides'])){ ?>

        <?php foreach ($autorent_option_data['autorent-service-features-slides'] as $key => $value) { ?>

          
			<div class="feature col-lg-2 col-md-2 col-sm-4 col-xs-12">
				<?php if(!empty($value['image'])){ ?>
					<img src="<?php echo esc_url($value['image']); ?>" alt="">
				<?php }else{ ?>
					<i class="fa <?php echo esc_attr($value['url']); ?>"></i>
				<?php } ?>

				<h5 class="title"><?php echo esc_attr($value['title']); ?></h5>
				<p><?php echo esc_attr($value['description']); ?></p>

			</div>

        <?php } ?>

      <?php }else{ ?>

        <?php _e( 'Set Slider Image Here From concierge Banner Option Settings', 'autorent' ); ?>
      
    <?php } ?>



</div>

<?php endif; ?>

<!-- End Features-Icons -->