
<!-- Start Header-Language -->
					
<?php 

	global $autorent_option_data;

	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

    if ( is_plugin_active('sitepress-multilingual-cms/sitepress.php') && $autorent_option_data['autorent-top-language'] == 1){
    	
    	autorent_wpml_languages();

    }else{  ?>


		<?php if(isset($autorent_option_data['autorent-top-language']) && $autorent_option_data['autorent-top-language'] == 1) : ?>
		<div class="header-language">
			<?php if(isset($autorent_option_data['autorent-language']) && is_array($autorent_option_data['autorent-language']) && !empty($autorent_option_data['autorent-language'])) : ?>
			<div class="toggleButton">
				<span>En</span>
				<i class="fa fa-caret-down"></i>
			</div>
			
			<ul class="custom-list">
				<?php foreach($autorent_option_data['autorent-language'] as $key => $value){ ?>

				<li ><a href="#"><?php echo esc_attr($value); ?></a></li>
				
				<?php } ?>
			</ul>
	
			<?php endif; ?>
		</div>
		<?php endif; ?>

<?php } ?>


<!-- End Header-Language -->