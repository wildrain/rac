<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage concierge
 * @since 1.0
 */
?>





  <!-- SIDEBAR : begin -->  

  <?php if ( is_active_sidebar( 'mainsidebar' ) ) : ?>
        
    <?php dynamic_sidebar( 'mainsidebar' ); ?>
        
  <?php else : ?>

    <div class="alert alert-message">
    
      <p><?php _e("Please activate some Widgets","autorent"); ?></p>
    
    </div>

  <?php endif; ?>
    
  <!-- SIDEBAR : end -->  





