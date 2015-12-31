<?php 


/**
 * Text widget class
 *
 * @since 2.8.0
 */
class Autorent_Get_Touch extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'autorent_widget_get_touch', 'description' => __('Autrent get touch widgets','autorent'));
		$control_ops = array('width' => 400, 'height' => 350);
		parent::__construct('autorent_get_touch', __('Autorent Get Touch','autorent'), $widget_ops, $control_ops);
	}



	public function widget( $args, $instance ) {

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$mobile_no = apply_filters( 'autorent_mobile_no', empty( $instance['mobile_no'] ) ? '' : $instance['mobile_no'], $instance, $this->id_base );


		$phone_no = apply_filters( 'autorent_phone_no', empty( $instance['phone_no'] ) ? '' : $instance['phone_no'], $instance, $this->id_base );

		$email = apply_filters( 'autorent_email', empty( $instance['email'] ) ? '' : $instance['email'], $instance, $this->id_base );


		$fax_no = apply_filters( 'autorent_fax_no', empty( $instance['fax_no'] ) ? '' : $instance['fax_no'], $instance, $this->id_base );


		$text = apply_filters( 'autorent_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );	

		$button_text = apply_filters( 'autorent_button_text', empty( $instance['button_text'] ) ? '' : $instance['button_text'], $instance );	

		$button_link = apply_filters( 'autorent_button_link', empty( $instance['button_link'] ) ? '' : $instance['button_link'], $instance );	
		
		
		echo apply_filters( 'about_before',  $args['before_widget'] );

		if ( ! empty( $title ) ) {

			echo apply_filters('about_before_title',$args['before_title']). esc_attr($title) . apply_filters('about_after_title',$args['after_title']);

		} ?>


		<P><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></P>
		


		<ul class="contact-info custom-list">

			<?php 

			

			if ( ! empty( $phone_no ) ) {

				echo '<li><i class="fa fa-phone-square"></i><a href="'.$phone_no.'"><span>'.$phone_no.'</span></a></li>';

			} 


			if ( ! empty( $mobile_no ) ) {

				echo '<li><i class="fa fa-mobile"></i><a href="'.$mobile_no.'"><span>'.$mobile_no.'</span></a></li>';

			} 


			if ( ! empty( $fax_no ) ) {

				echo '<li><i class="fa fa-fax"></i><a href="'.$fax_no.'"><span>'.$fax_no.'</span></a></li>';

			} 

			if ( ! empty( $email ) ) {

				echo '<li><i class="fa fa-envelope"></i><a href="mailto:'.$email.'"><span>'.$email.'</span></a></li>';

			} 


			?>

		</ul>


		<a href="<?php echo esc_url($button_link); ?>" class="btn location yellow"><?php echo esc_attr($button_text); ?></a>



		
		<?php

		echo apply_filters( 'about_after',  $args['after_widget'] );

				

	}




	public function form( $instance ) {


		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'mobile_no' => '', 'phone_no' => '', 'email' => '', 'fax_no' => '', 'text' => '','button_text' => '', 'button_link' => '' ) );
		$title = strip_tags($instance['title']);
		$mobile_no = strip_tags($instance['mobile_no']);
		$phone_no = strip_tags($instance['phone_no']);
		$email = strip_tags($instance['email']);
		$fax_no = strip_tags($instance['fax_no']);
		$text = esc_textarea($instance['text']);
		$button_text = esc_textarea($instance['button_text']);
		$button_link = esc_textarea($instance['button_link']);
?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:','autorent'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('mobile_no')); ?>"><?php _e('Mobile No:','autorent'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('mobile_no')); ?>" name="<?php echo esc_attr($this->get_field_name('mobile_no')); ?>" type="text" value="<?php echo esc_attr($mobile_no); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('phone_no')); ?>"><?php _e('Phone No:','autorent'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('phone_no')); ?>" name="<?php echo esc_attr($this->get_field_name('phone_no')); ?>" type="text" value="<?php echo esc_attr($phone_no); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('email')); ?>"><?php _e('Email :','autorent'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('email')); ?>" name="<?php echo esc_attr($this->get_field_name('email')); ?>" type="text" value="<?php echo esc_attr($email); ?>" /></p>


		<p><label for="<?php echo esc_attr($this->get_field_id('fax_no')); ?>"><?php _e('Fax :','autorent'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('fax_no')); ?>" name="<?php echo esc_attr($this->get_field_name('fax_no')); ?>" type="text" value="<?php echo esc_attr($fax_no); ?>" /></p>

		<textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>"><?php echo esc_attr($text); ?></textarea>

		<p><label for="<?php echo esc_attr($this->get_field_id('button_text')); ?>"><?php _e('Button Text :','autorent'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('button_text')); ?>" name="<?php echo esc_attr($this->get_field_name('button_text')); ?>" type="text" value="<?php echo esc_attr($button_text); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('button_link')); ?>"><?php _e('Button Link :','autorent'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('button_link')); ?>" name="<?php echo esc_attr($this->get_field_name('button_link')); ?>" type="text" value="<?php echo esc_attr($button_link); ?>" /></p>

		<p><input id="<?php echo esc_attr($this->get_field_id('filter')); ?>" name="<?php echo esc_attr($this->get_field_name('filter')); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo esc_attr($this->get_field_id('filter')); ?>"><?php _e('Automatically add paragraphs','autorent'); ?></label></p>
<?php

	}



	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['mobile_no'] = strip_tags($new_instance['mobile_no']);
		$instance['phone_no'] = strip_tags($new_instance['phone_no']);
		$instance['email'] = strip_tags($new_instance['email']);
		$instance['fax_no'] = strip_tags($new_instance['fax_no']);
		$instance['button_text'] = strip_tags($new_instance['button_text']);
		$instance['button_link'] = strip_tags($new_instance['button_link']);
		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;

	}




}



add_action('widgets_init', 'autorent_get_touch');

function autorent_get_touch(){

    register_widget('Autorent_Get_Touch');

}