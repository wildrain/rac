<?php 


/**
 * Text widget class
 *
 * @since 2.8.0
 */
class Autorent_About extends WP_Widget {

	// public function __construct() {
	// 	$widget_ops = array('classname' => 'autorent_widget_text', 'description' => __('Arbitrary text or HTML.','autorent'));
	// 	$control_ops = array('width' => 400, 'height' => 350);
	// 	parent::__construct('autorent_text', __('About Autorent','autorent'), $widget_ops, $control_ops);
	// }

	function __construct() {
		parent::__construct(
			'autorent_text', // Base ID
			__( 'About Autorent', 'autorent' ), // Name
			array( 'description' => __( 'Arbitrary text or HTML.', 'autorent' ), ) // Args
		);
	}




	public function widget( $args, $instance ) {

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$logo_icon = apply_filters( 'widget_title', empty( $instance['logo_icon'] ) ? '' : $instance['logo_icon'], $instance, $this->id_base );


		$facebook = apply_filters( 'widget_title', empty( $instance['facebook'] ) ? '' : $instance['facebook'], $instance, $this->id_base );
		$twitter = apply_filters( 'widget_title', empty( $instance['twitter'] ) ? '' : $instance['twitter'], $instance, $this->id_base );
		$linkedin = apply_filters( 'widget_title', empty( $instance['linkedin'] ) ? '' : $instance['linkedin'], $instance, $this->id_base );
		$instagram = apply_filters( 'widget_title', empty( $instance['instagram'] ) ? '' : $instance['instagram'], $instance, $this->id_base );
		$dribble = apply_filters( 'widget_title', empty( $instance['dribble'] ) ? '' : $instance['dribble'], $instance, $this->id_base );
		$googleplus = apply_filters( 'widget_title', empty( $instance['googleplus'] ) ? '' : $instance['googleplus'], $instance, $this->id_base );


		/**
		 * Filter the content of the Text widget.
		 *
		 * @since 2.3.0
		 *
		 * @param string    $widget_text The widget content.
		 * @param WP_Widget $instance    WP_Widget instance.
		 */


		$text = apply_filters( 'widget_text', empty( $instance['text'] ) ? '' : $instance['text'], $instance );		
		
		
		echo apply_filters( 'about_before',  $args['before_widget'] );

		if ( ! empty( $title ) ) {

			echo apply_filters('about_before_title',$args['before_title']). esc_attr($title) . apply_filters('about_after_title',$args['after_title']);

		} 


		if ( ! empty( $logo_icon ) ) {

			echo '<img src="'.AUTORENT_IMAGE.''.$logo_icon.'" alt="" class="logo">';

		} 



		?>



		<ul class="social list-inline custom-list">

			<?php 

			

			if ( ! empty( $facebook ) ) {
				echo '<li><a href="'.$facebook.'"><i class="fa fa-facebook"></i></a></li>';
			} 

			if ( ! empty( $twitter ) ) {
				echo '<li><a href="'.$twitter.'"><i class="fa fa-twitter"></i></a></li>';
			} 

			if ( ! empty( $linkedin ) ) {
				echo '<li><a href="'.$linkedin.'"><i class="fa fa-linkedin"></i></a></li>';
			} 

			if ( ! empty( $instagram ) ) {
				echo '<li><a href="'.$instagram.'"><i class="fa fa-instagram"></i></a></li>';
			} 

			if ( ! empty( $dribble ) ) {
				echo '<li><a href="'.$dribble.'"><i class="fa fa-dribbble"></i></a></li>';
			} 

			if ( ! empty( $googleplus ) ) {
				echo '<li><a href="'.$googleplus.'"><i class="fa fa-google-plus"></i></a></li>';
			} 

			?>

		</ul>



		<P class="textwidget"><?php echo !empty( $instance['filter'] ) ? wpautop( $text ) : $text; ?></P>
		
		<?php

		echo apply_filters( 'about_after',  $args['after_widget'] );

				

	}




	public function form( $instance ) {


		$instance = wp_parse_args( (array) $instance, array( 'title' => '', 'logo_icon' => '', 'facebook' => '', 'twitter' => '', 'linkedin' => '','instagram' => '', 'dribble' => '', 'googleplus' => '', 'text' => '' ) );
		$title = strip_tags($instance['title']);
		$logo_icon = strip_tags($instance['logo_icon']);
		$facebook = strip_tags($instance['facebook']);
		$twitter = strip_tags($instance['twitter']);
		$linkedin = strip_tags($instance['linkedin']);
		$instagram = strip_tags($instance['instagram']);
		$dribble = strip_tags($instance['dribble']);
		$googleplus = strip_tags($instance['googleplus']);
		$text = esc_textarea($instance['text']);
?>
		<p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:','autorent'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('logo_icon')); ?>"><?php _e('Footer Logo Icon:','autorent'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('logo_icon')); ?>" name="<?php echo esc_attr($this->get_field_name('logo_icon')); ?>" type="text" value="<?php echo esc_attr($logo_icon); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('facebook')); ?>"><?php _e('Facebook Profile Link:','autorent'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('facebook')); ?>" name="<?php echo esc_attr($this->get_field_name('facebook')); ?>" type="text" value="<?php echo esc_attr($facebook); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('twitter')); ?>"><?php _e('Twitter Profile Link:','autorent'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('twitter')); ?>" name="<?php echo esc_attr($this->get_field_name('twitter')); ?>" type="text" value="<?php echo esc_attr($twitter); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('linkedin')); ?>"><?php _e('Linkedin Profile Link:','autorent'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('linkedin')); ?>" name="<?php echo esc_attr($this->get_field_name('linkedin')); ?>" type="text" value="<?php echo esc_attr($linkedin); ?>" /></p>



		<p><label for="<?php echo esc_attr($this->get_field_id('instagram')); ?>"><?php _e('Instagram Profile Link:','autorent'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('instagram')); ?>" name="<?php echo esc_attr($this->get_field_name('instagram')); ?>" type="text" value="<?php echo esc_attr($instagram); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('dribble')); ?>"><?php _e('Dribble Profile Link:','autorent'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('dribble')); ?>" name="<?php echo esc_attr($this->get_field_name('dribble')); ?>" type="text" value="<?php echo esc_attr($dribble); ?>" /></p>

		<p><label for="<?php echo esc_attr($this->get_field_id('googleplus')); ?>"><?php _e('Google+ Profile Link:','autorent'); ?></label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id('googleplus')); ?>" name="<?php echo esc_attr($this->get_field_name('googleplus')); ?>" type="text" value="<?php echo esc_attr($googleplus); ?>" /></p>
			



		<textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr($this->get_field_id('text')); ?>" name="<?php echo esc_attr($this->get_field_name('text')); ?>"><?php echo esc_attr($text); ?></textarea>

		<p><input id="<?php echo esc_attr($this->get_field_id('filter')); ?>" name="<?php echo esc_attr($this->get_field_name('filter')); ?>" type="checkbox" <?php checked(isset($instance['filter']) ? $instance['filter'] : 0); ?> />&nbsp;<label for="<?php echo esc_attr($this->get_field_id('filter')); ?>"><?php _e('Automatically add paragraphs','autorent'); ?></label></p>
<?php

	}



	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['logo_icon'] = strip_tags($new_instance['logo_icon']);
		$instance['facebook'] = strip_tags($new_instance['facebook']);
		$instance['twitter'] = strip_tags($new_instance['twitter']);
		$instance['linkedin'] = strip_tags($new_instance['linkedin']);

		$instance['instagram'] = strip_tags($new_instance['instagram']);
		$instance['dribble'] = strip_tags($new_instance['dribble']);
		$instance['googleplus'] = strip_tags($new_instance['googleplus']);

		if ( current_user_can('unfiltered_html') )
			$instance['text'] =  $new_instance['text'];
		else
			$instance['text'] = stripslashes( wp_filter_post_kses( addslashes($new_instance['text']) ) ); // wp_filter_post_kses() expects slashed
		$instance['filter'] = isset($new_instance['filter']);
		return $instance;

	}




}



add_action('widgets_init', 'autorent_about');

function autorent_about(){

    register_widget('Autorent_About');

}