<?php


class Autorent_Latest_posts extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'autorent_widget_recent_entries', 'description' => __( "Your site&#8217;s Latest Posts.",'autorent' ) );
        parent::__construct('autorent-recent-posts', __('Autorent Latest Posts','autorent' ), $widget_ops);
        $this->alt_option_name = 'xxl_widget_recent_entries';

        add_action( 'save_post', array($this, 'flush_widget_cache') );
        add_action( 'deleted_post', array($this, 'flush_widget_cache') );
        add_action( 'switch_theme', array($this, 'flush_widget_cache') );
    }

    public function widget($args, $instance) {

        $cache = wp_cache_get('widget_recent_posts', 'widget');

        if ( !is_array($cache) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo esc_attr($cache[ $args['widget_id']]);
            return;
        }

        ob_start();
        extract($args);

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Latest Posts','autorent'  );
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 10;
        if ( ! $number )
            $number = 10;
        $words = ( ! empty( $instance['words'] ) ) ? absint( $instance['words'] ) : 15;
        if ( ! $words )
            $words = 15;
        $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
        $show_image = isset( $instance['show_image'] ) ? $instance['show_image'] : true;


        $query = array(
            'showposts'           => $number,
            'nopaging'            => 0,
            'no_found_rows'       => true,
            'post_status'         => 'publish',
            'ignore_sticky_posts' => 1
        );

        $r = new WP_Query( $query );

        if ( $r->have_posts() ) :  ?>

            <?php echo apply_filters( 'before_recent_post_widget',  $args['before_widget'] ); ?>

                <?php if ( $title ) echo apply_filters('before_recent_post_title',$args['before_title']). esc_attr($title) . apply_filters('after_recent_post_title',$args['after_title']); ?>
               
                <ul class="recent-posts custom-list">
                    <?php while ( $r->have_posts() ) : $r->the_post(); ?>
                       
                        <li><a href="<?php the_permalink(); ?>"> <span><?php  echo esc_attr(get_the_title());  ?></span><div class="icon-ahead"><i class="fa fa-long-arrow-right"></i></div></a></li>                    
                        
                    <?php endwhile; ?>
                </ul>
               
            <?php echo apply_filters( 'after_recent_post_widget',  $args['after_widget'] ); ?>
            
            <?php
            
            wp_reset_postdata();

        endif;

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('widget_recent_posts', $cache, 'widget');

    }

    function update( $new_instance, $old_instance ) {

        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['words'] = strip_tags($new_instance['words']);
        $instance['show_image'] = strip_tags($new_instance['show_image']);
        $instance['number'] = (int) $new_instance['number'];
        $instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
        $this->flush_widget_cache();

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_recent_entries']) )
            delete_option('widget_recent_entries');

        return $instance;
    }

    function flush_widget_cache() {

        wp_cache_delete('widget_recent_posts', 'widget');

    }

    public function form( $instance ) {

        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        $words    = isset( $instance['words'] ) ? absint( $instance['words'] ) : 15;
        $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
        $show_image = isset( $instance['show_image'] ) ? (bool) $instance['show_image'] : true;

    ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e( 'Title:','autorent'  ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('number')); ?>"><?php _e( 'Number of posts to show:','autorent'  ); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('number')); ?>" name="<?php echo esc_attr($this->get_field_name('number')); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('words')); ?>"><?php _e( 'Words of words to be displayed:','autorent'  ); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('words')); ?>" name="<?php echo esc_attr($this->get_field_name('words')); ?>" type="text" value="<?php echo esc_attr($words); ?>" size="3" />
        </p>
        
    <?php
    }
}

add_action('widgets_init', 'autorent_latest_posts');

function autorent_latest_posts(){

    register_widget('Autorent_Latest_posts');

}