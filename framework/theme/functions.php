<?php
/**
 * Utility functions for theme usage
 *
 * Contains necessary functions for theme usage
 *
 * Wordpress 3.6+
 *
 * @package    CHANGE_THEME_NAME
 * @author     UOU Apps <info@uouapps.com>
 * @author     Ata Alqadi <ata.alqadi@gmail.com>
 * @link       http://themeforest.net/user/uouapps
 */
?>
<?php
/** Tell WordPress to run xxl_setup() when the 'after_setup_theme' hook is run. */
add_action( 'after_setup_theme', 'autorent_setup' );

global $nonce;

if ( ! isset( $content_width ) )
$content_width = 1140;

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * To override xxl_setup() in a child theme, add your own xxl_setup to your child theme's
 * functions.php file.
 *
 * @uses add_theme_support() To add support for post thumbnails and automatic feed links.
 * @uses register_nav_menus() To add support for navigation menus.
 * @uses add_custom_background() To add support for a custom background.
 * @uses add_editor_style() To style the visual editor.
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_custom_image_header() To add support for a custom header.
 * @uses register_default_headers() To register the default custom header images provided with the theme.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since CHANGE_THEME_NAME 1.0
 */
function autorent_setup(){
	load_theme_textdomain(SHORT_NAME, get_template_directory() . '/languages');
	
	add_theme_support( 'custom-background', array(
		'default-color' => 'ffffff',
	));
	
	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form' ) );
	add_theme_support( 'automatic-feed-links' );
}

add_action('init', 'autorent_init_nonce');



function autorent_init_nonce(){
	global $nonce;
	
	$salt = substr(str_shuffle(MD5(microtime())), 0, 12);
	$nonce = array('ajaxNounce' => wp_create_nonce( 'ajax-nonce-'.$salt ), 'salt' => $salt);
}



/* -------------------------------------------------------------------------
    END CASA COMMENT WALKER CLASS
------------------------------------------------------------------------- */



/*-------------------------------------------------------------------------
  START CONCIERGE CUSTOM PAGINATION
------------------------------------------------------------------------- */

function autorent_pagination($pages = '', $range = 2)
{  
     $showitems = ($range * 2)+1;  

     global $paged;
     if(empty($paged)) $paged = 1;

     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   

     if(1 != $pages)
     {
         echo "<div class='pagination'>";
         if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
         if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";

         for ($i=1; $i <= $pages; $i++)
         {
             if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
             {
                 echo ($paged == $i)? "<span class='current'>".$i."</span>":"<a href='".get_pagenum_link($i)."' class='inactive' >".$i."</a>";
             }
         }

         if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>";  
         if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
         echo "</div>\n";
     }
}

/*-------------------------------------------------------------------------
  END CONCIERGE CUSTOM PAGINATION
------------------------------------------------------------------------- */



/* -------------------------------------------------------------------------
    START CONCIERGE COMMENT WALKER CLASS
------------------------------------------------------------------------- */

class autorent_comment_walker extends Walker_Comment{

    /*initialize classwide variables*/

    var $tree_type = 'comment';
    var $db_fields = array('parent' => 'comment_parent', 'id' => 'comment_ID');

    
    function start_lvl(&$output, $depth = 0, $args = array()){

        $GLOBAL['comment_depth'] = $depth + 1; ?>
            <ul class="child-comments">
    <?php

    }


    function end_lvl(&$output, $depth = 0, $args = array()){

        $GLOBAL['comment_depth'] = $depth +1;?>
        </ul>

    <?php    
    }


    function start_el(&$output, $comment, $depth = 0, $args = array(), $id = 0){  

            $depth++;            
            $GLOBALS['comment_depth'] = $depth;
            $GLOBALS['comment'] = $comment;

            $parent_class = empty($args['has_children'])? '':'parent';
           

         ?>

         <li class="comment" id="comment-<?php comment_ID(); ?>">
           
            <div class="post-comment-portrait">
                <?php echo ( $args['avatar_size'] !=0 ? get_avatar($comment, $args['avatar_size']) : '' ); ?>
            </div>
            <div class="post-comment-meta">
                <span><?php comment_author_link(); ?></span><span><?php comment_date('j F, Y'); ?></span> - 
                <?php comment_reply_link(array_merge($args,array('depth'=>$depth,'max_depth'=>$args['max_depth']))); ?>
            </div>
            <div class="post-comment-content">
                <?php if($comment->comment_approved == 0): ?>
                    <p class="alert-message warning"><i class="ico fa fa-exclamation-circle"></i> <?php _e('Your comment is awaiting to approve','concierge' ); ?></p>
                <?php endif; ?>
                <?php comment_text(); ?>
            </div>
           
          
        

    <?php }

    function end_el(&$output, $comment, $depth = 0, $args = array() ){ ?>

        </li>

    <?php }



}

/* -------------------------------------------------------------------------
    END CONCIERGE COMMENT WALKER CLASS
------------------------------------------------------------------------- */



/* -------------------------------------------------------------------------
    START CUSTOM COMMENT FORM FOR CASA
------------------------------------------------------------------------- */

function autorent_custom_comment_form($defaults){
    
    $defaults['comment_notes_before'] = '';
    $defaults['id_form'] = "comment-form";
    $defaults['title_reply'] = __('Join This Conversation','casa');
    $defaults['comment_field'] = '<p class="form-row"><textarea rows="5"  name="comment" placeholder="Your Comments ..."></textarea></p>';
    $defaults['comment_notes_after'] ='';
           
   

    return $defaults;
}

add_filter('comment_form_defaults', 'autorent_custom_comment_form');

/* -------------------------------------------------------------------------
    END CUSTOM COMMENT FORM FOR CASA
------------------------------------------------------------------------- */



/* -------------------------------------------------------------------------
    START CUSTOM COMMENT FORM FIELD FOR CASA
------------------------------------------------------------------------- */

function autorent_custom_comment_form_fields(){

    $commenter = wp_get_current_commenter();
    $req = get_option('require_name_email' );

    $aria_req = $req? "aria-required='true'" : '';
    

    $fields = array(

            'author' => '<div class="row"><div class="col-sm-4">
                            <p class="form-row">
                                <input type="text"  name="author" value="'.esc_attr($commenter['comment_author']).'" placeholder="Name*" '.$aria_req.' >
                            </p>
                        </div>',
            'email' => '<div class="col-sm-4">
                            <p class="form-row">
                                <input type="text"  name="email" value="'.esc_attr($commenter['comment_author_email']).'" class="m-email m-required" placeholder="Email*" '.$aria_req.' >
                            </p>
                        </div>',
            'url' => '<div class="col-sm-4">
                        <p class="form-row">
                            <input type="text"  name="url" value="'.esc_attr($commenter['comment_author_url'] ).'" placeholder="Website">
                        </p>
                    </div></div>'                      
        );

    return $fields;


}

add_filter('comment_form_default_fields','autorent_custom_comment_form_fields');

/* -------------------------------------------------------------------------
    END CUSTOM COMMENT FORM FIELD FOR CASA
------------------------------------------------------------------------- */




/*-------------------------------------------------------------------------
  START CUSTOMIZED COMMENT SUBMIT BUTTON
------------------------------------------------------------------------- */
/*
function concierge_comment_submit_button(){

    echo '<button type="submit" class="btn dark">Post Message</button>';

}

add_action('comment_form','concierge_comment_submit_button');*/

/*-------------------------------------------------------------------------
  START CUSTOMIZED COMMENT SUBMIT BUTTON
------------------------------------------------------------------------- */



/*-------------------------------------------------------------------------
  START CONCIERGE MAIN WALKER NAV LEFT MENU 
------------------------------------------------------------------------- */

class autorent_nav_walker extends Walker_Nav_Menu{

    /**
     * Starts the list before the elements are added.
     *
     * @see Walker::start_lvl()
     *
     * @since 3.0.0
     *
     * @param string $output Passed by reference. Used to append additional content.
     * @param int    $depth  Depth of menu item. Used for padding.
     * @param array  $args   An array of arguments. @see wp_nav_menu()
     */
    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu custom-list\">\n";
    }



    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0){


        global $wp_query,$wpdb;


        $indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

        $class_names = $value = '';

        $classes = empty( $item->classes ) ? array() : (array) $item->classes;

        $key = '_menu_item_menu_item_parent';

        $has_children = $wpdb -> get_var( $wpdb->prepare("SELECT COUNT(meta_id) FROM {$wpdb->prefix}postmeta WHERE meta_key= %s AND meta_value= %d ", $key, $item->ID  ));


        if ( $has_children > 0 )
        {
            array_push( $classes, "has-submenu" );
        }
        //current-menu-ancestor

        if (in_array('current-menu-item', $classes, true) || in_array('current_page_item', $classes, true) || in_array('current-menu-ancestor', $classes, true) ) {
            $classes = array_diff($classes, array('current-menu-item', 'current_page_item', 'active'));

            array_push( $classes, "active" );
        }


        $class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
        $class_names = ' class="'. esc_attr( $class_names ) . '"';



        $output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';

        $attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
        $attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
        $attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';

        if($item->hash == 1){
          $attributes .= ' href="'.get_site_url().'/#'. esc_attr( $item->subtitle ).'"'; 
        }else{
          $attributes .= ! empty( $item->url )        ? ' href="'. esc_attr( $item->url) .'"' : ''; 
        }
         

        $item_output = $args->before;
        $item_output .= '<a'. $attributes .'>';
        $item_output .= $args->link_before .apply_filters( 'the_title', $item->title, $item->ID );
        $item_output .= $args->link_after;
        $item_output .= '</a>';
        $item_output .= $args->after;

        $output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );

    }




    public static function fallback( $args ) {


        if ( current_user_can( 'manage_options' ) ) {

            extract( $args );

            $fb_output = null;

            if ( $container ) {
                $fb_output = '<' . $container;

                if ( $container_id )
                    $fb_output .= ' id="' . $container_id . '"';

                if ( $container_class )
                    $fb_output .= ' class="' . $container_class . '"';

                $fb_output .= '>';
            }

            $fb_output .= '<ul';

            if ( $menu_id )
                $fb_output .= ' id="' . $menu_id . '"';

            if ( $menu_class )
                $fb_output .= ' class="' . $menu_class . '"';

            $fb_output .= '>';
            $fb_output .= '<li><a href="' . admin_url( 'nav-menus.php' ) . '">Add a menu</a></li>';
            $fb_output .= '</ul>';

            if ( $container )
                $fb_output .= '</' . $container . '>';

            echo $fb_output;
        }
    }



}

/*-------------------------------------------------------------------------
  END CONCIERGE MAIN WALKER NAV LEFT MENU 
------------------------------------------------------------------------- */



/*-------------------------------------------------------------------------
  AUTORENT CUSTOM CSS START
------------------------------------------------------------------------- */


add_action( 'wp_head', 'autorent_custom_css' );


function autorent_custom_css() {

  global $autorent_option_data;
  if(isset($autorent_option_data['autorent-custom-css'])){
    echo "<style>" . $autorent_option_data['autorent-custom-css'] . "</style>";  
  }
  
  
}


/*-------------------------------------------------------------------------
  AUTORENT CUSTOM CSS END
------------------------------------------------------------------------- */




/*-------------------------------------------------------------------------
  AUTORENT CUSTOM JS START
------------------------------------------------------------------------- */


add_action( 'wp_head', 'autorent_custom_js' );

function autorent_custom_js() {
  global $autorent_option_data;
  if(isset($autorent_option_data['autorent-custom-js'])){
    echo "<script>" . $autorent_option_data['autorent-custom-js'] . "</script>";  
  }
  
}


/*-------------------------------------------------------------------------
  AUTORENT CUSTOM JS END
------------------------------------------------------------------------- */





