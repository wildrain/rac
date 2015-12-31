<?php global $autorent_option_data; ?>

<?php if(isset($autorent_option_data['autorent_login_button']) && !empty($autorent_option_data['autorent_login_button'])) : ?>

<div class="header-cta-buttons">


	<div class="header-login">
		<a href="#" class="btn"><?php _e('login','autorent'); ?></a>
		<div>
			<form id="bg-login-form" method="post" action="login" role="form" class="default-form">
				
				<p class="status"></p>

				<p class="form-row">
					<input type="text" name="login_username" value="" class="form-control" placeholder="<?php _e('Username','autorent'); ?>">
				</p>
				<p class="form-row">
					<input type="password" name="login_password" value="" class="form-control" placeholder="<?php _e('Password','autorent'); ?>">
				</p>

				<p class="submit form-row">
	
					<input type="submit" name="wp-submit" id="bg-login" class="full-width yellow" value="Login">
					<input type="hidden" name="redirect_to" value="<?php echo esc_url(home_url()); ?>">
					<input type="hidden" name="testcookie" value="1">
				</p>
				
				<a href="<?php echo site_url('wp-login.php?action=lostpassword', 'login_post') ?>"><?php _e('Forgot Password?', 'takeaway'); ?></a>
				<?php wp_nonce_field( 'ajax-login-nonce', 'security' ); ?>
			
				
			</form>
		</div>
	</div>
	

</div>

<?php endif; ?>




