<?php 


class concierge_quick_link extends WP_Widget{


	function __construct() {
		$widget_ops = array( 'description' => __('Add a quick link menu for casa.','casa') );
		parent::__construct( 'nav_menu', __('Casa Quick Link','casa'), $widget_ops );
	}


	function form( $instance ) {


		$title = isset( $instance['title'] ) ? $instance['title'] : '';
		$nav_menu = isset( $instance['nav_menu'] ) ? $instance['nav_menu'] : '';

		
		$menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );

		
		if ( !$menus ) {
			echo '<p>'. sprintf( __('No menus have been created yet. <a href="%s">Create some</a>.','autorent'), admin_url('nav-menus.php') ) .'</p>';
			return;
		}
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title:','casa') ?></label>
			<input type="text" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('nav_menu')); ?>"><?php _e('Select Menu:','casa'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('nav_menu')); ?>" name="<?php echo esc_attr($this->get_field_name('nav_menu')); ?>">
				<option value="0"><?php _e( '&mdash; Select &mdash;','casa' ) ?></option>
		<?php
			foreach ( $menus as $menu ) {
				echo '<option value="' . $menu->term_id . '"'
					. selected( $nav_menu, $menu->term_id, false )
					. '>'. esc_html( $menu->name ) . '</option>';
			}
		?>
			</select>
		</p>
		<?php
	}




	function widget($args, $instance) {
		
	
		$nav_menu = ! empty( $instance['nav_menu'] ) ? wp_get_nav_menu_object( $instance['nav_menu'] ) : false;



		if ( !$nav_menu )
			return;

		/** This filter is documented in wp-includes/default-widgets.php */
		$instance['title'] = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		echo apply_filters( 'before_quick_link_widget',  $args['before_widget'] );

		if ( !empty($instance['title']) )
			echo apply_filters('before_quick_link_title',$args['before_title']) . esc_attr($instance['title']) . apply_filters('after_quick_link_title',$args['after_title']);

		$quick_link_item = wp_get_nav_menu_items($nav_menu);
		
		
		$length = sizeof($quick_link_item);

		?>

		<div class="widget-content">
			<div class="row">
				
				<?php for($i=0; $i<$length; $i++ ){ ?>
				<div class="col-md-6">
					<ul class="custom-list">
						<li><a href="<?php echo esc_url($quick_link_item[$i]->url); ?>"><?php echo esc_attr($quick_link_item[$i]->title); ?></a></li>				
					</ul>
				</div>
				<?php } ?>
		
			</div>
		</div>
		


		
		<?php
		echo apply_filters( 'after_quick_link_widget',  $args['before_widget'] );
	}



	function update( $new_instance, $old_instance ) {
		$instance['title'] = strip_tags( stripslashes($new_instance['title']) );
		$instance['nav_menu'] = (int) $new_instance['nav_menu'];
		return $instance;
	}






}



function concierge_register_quick_link(){
	register_widget('concierge_quick_link');
}

add_action('widgets_init','concierge_register_quick_link' );	

 ?>