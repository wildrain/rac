<nav class="navigation">


    <?php 

      $defaults = array(
        'theme_location'  => 'primary_navigation',
        'menu'            => '',
        'container'       => '',
        'container_class' => '',
        'container_id'    => '',
        'menu_class'      => 'menu',
        'menu_id'         => '',
        'echo'            => true,            
        'before'          => '',
        'after'           => '',
        'link_before'     => '',
        'link_after'      => '',
        'items_wrap'      => '<ul id="%1$s" class="list-inline custom-list %2$s">%3$s</ul>',
        'depth'           => 4,
        'fallback_cb'     => 'autorent_nav_walker::fallback',
        'walker'          => new autorent_nav_walker()
      );

        
      wp_nav_menu( $defaults );

    ?>

</nav>