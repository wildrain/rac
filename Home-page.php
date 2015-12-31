<?php  
/**
 * Template Name: Front-Page
 *
 */
get_header('home');

?>


  <?php 

    $queried_posts = get_post_meta(get_the_ID(),'_autorent_front_page_selected_block',true );

  ?>



  <!-- MONST OUTER IF-ELSE:BEGIN -->
  <?php if(isset($queried_posts) && !empty($queried_posts) && is_array($queried_posts)){ ?>

      <!-- FOREACH: BEGIN  --> 
      <?php foreach ($queried_posts as $key => $value) { ?>

        <?php 

          $post_id = $value;
          
          $args = array(
              'post_type' => 'block',
              'post__in' => array($value),      
              'posts_per_page' => -1,
            );

          $block_post = get_posts($args);

          $meta = get_post_custom( $post_id );   

          $block_type = $meta['_autorent_block_type'][0];    

        ?>




        <!-- BLOCK IF-ESLE : BEGIN -->
        <?php if($block_type === 'content_block_without_social_link'){ ?>


          <?php

            if(isset($meta['_autorent_block_style_background_color'][0])){
              $background_color = $meta['_autorent_block_style_background_color'][0];
            } 

            if(isset($meta['_autorent_block_style_background_image'][0])){
              $background_image_id = $meta['_autorent_block_style_background_image'][0];
              $background_image = wp_get_attachment_image_src( $background_image_id ,'large');  
            } 

          ?>

          <!-- CONTENT BLOCK : BEGIN -->
          <section class="content-block about" style="<?php if(isset($background_color) && !empty($background_color)) {?>background: <?php echo esc_attr($background_color);}?>; <?php if(isset($background_image) && !empty($background_image)){?>background-image: url(<?php echo esc_url($background_image[0]);}?>);background-size:cover;">
            <div class="container">  
                      
              <?php if(isset($block_post)){ ?>

              <?php foreach($block_post as $key => $value){ ?>

                <?php echo do_shortcode($value->post_content ); ?>
                
              <?php } ?>

            <?php } ?>

            </div>

          </section>
          <!-- CONTENT BLOCK : END -->

          <!-- BLOCK IF-ESLE : BEGIN -->
        <?php } elseif($block_type === 'content_block_with_social_link'){ ?>


          <?php

            if(isset($meta['_autorent_block_style_background_color'][0])){
              $background_color = $meta['_autorent_block_style_background_color'][0];
            } 

            if(isset($meta['_autorent_block_style_background_image'][0])){
              $background_image_id = $meta['_autorent_block_style_background_image'][0];
              $background_image = wp_get_attachment_image_src( $background_image_id ,'large');  
            } 

          ?>

          <!-- CONTENT BLOCK : BEGIN -->
          <section class="about" style="<?php if(isset($background_color) && !empty($background_color)) {?>background: <?php echo esc_attr($background_color);}?>; <?php if(isset($background_image) && !empty($background_image)){?>background-image: url(<?php echo esc_url($background_image[0]);}?>);background-size:cover;">
            <div class="container">  
                      
              <?php if(isset($block_post)){ ?>

              <?php foreach($block_post as $key => $value){ ?>

                <?php echo do_shortcode($value->post_content ); ?>
                
              <?php } ?>

            <?php } ?>

            </div>

          </section>
          <!-- CONTENT BLOCK : END -->


         <?php } elseif($block_type === 'service_offer'){ ?>


          <?php

            if(isset($meta['_autorent_block_style_background_color'][0])){
              $background_color = $meta['_autorent_block_style_background_color'][0];
            } 

            if(isset($meta['_autorent_block_style_background_image'][0])){
              $background_image_id = $meta['_autorent_block_style_background_image'][0];
              $background_image = wp_get_attachment_image_src( $background_image_id ,'large');  
            } 

          ?>

          <!-- CONTENT BLOCK : BEGIN -->
          <section class="tour" style="<?php if(isset($background_color) && !empty($background_color)) {?>background: <?php echo esc_attr($background_color);}?>; <?php if(isset($background_image) && !empty($background_image)){?>background-image: url(<?php echo esc_url($background_image[0]);}?>);background-size:cover;">
                      
              <?php if(isset($block_post)){ ?>

              <?php foreach($block_post as $key => $value){ ?>

                <?php echo do_shortcode($value->post_content ); ?>
                
              <?php } ?>

            <?php } ?>
   
          </section>
          <!-- CONTENT BLOCK : END --> 


        <?php } elseif($block_type === 'service_features'){ ?>


          <?php

            if(isset($meta['_autorent_block_style_background_color'][0])){
              $background_color = $meta['_autorent_block_style_background_color'][0];
            } 

            if(isset($meta['_autorent_block_style_background_image'][0])){
              $background_image_id = $meta['_autorent_block_style_background_image'][0];
              $background_image = wp_get_attachment_image_src( $background_image_id ,'large');  
            } 

          ?>

          <!-- CONTENT BLOCK : BEGIN -->
          <section class="features-icons" style="<?php if(isset($background_color) && !empty($background_color)) {?>background: <?php echo esc_attr($background_color);}?>; <?php if(isset($background_image) && !empty($background_image)){?>background-image: url(<?php echo esc_url($background_image[0]);}?>);background-size:cover;">
                                  
              <!-- Start Features-Icons -->
              <?php get_template_part( 'templates/autorent', 'feature_services'); ?>    
              <!-- End Pricing -->         

          </section>
          <!-- End Features-Icons -->


        <?php }elseif($block_type === 'autorent_get_stated'){ ?>


          <?php

            if(isset($meta['_autorent_block_style_background_color'][0])){
              $background_color = $meta['_autorent_block_style_background_color'][0];
            } 

            if(isset($meta['_autorent_block_style_background_image'][0])){
              $background_image_id = $meta['_autorent_block_style_background_image'][0];
              $background_image = wp_get_attachment_image_src( $background_image_id ,'large');  
            } 

          ?>


          <!-- Start Essentials -->
          <section class="essentials" style="<?php if(isset($background_color) && !empty($background_color)) {?>background: <?php echo esc_attr($background_color);}?>; <?php if(isset($background_image) && !empty($background_image)){?>background-image: url(<?php echo esc_url($background_image[0]);}?>);background-size:cover;">
            <?php get_template_part( 'templates/autorent', 'get_started'); ?>  
          </section>  
          <!-- End Essentials -->


        <?php }elseif($block_type === 'contact'){ ?>


          <p>Contact</p>

         <?php }elseif($block_type === 'about_us'){ ?>
         

          <?php

            if(isset($meta['_autorent_block_style_background_color'][0])){
              $background_color = $meta['_autorent_block_style_background_color'][0];
            } 

            if(isset($meta['_autorent_block_style_background_image'][0])){
              $background_image_id = $meta['_autorent_block_style_background_image'][0];
              $background_image = wp_get_attachment_image_src( $background_image_id ,'large');  
            } 

          ?>


          <?php if(isset($block_post)){ ?>

              <section class="about heading-section"  style="<?php if(isset($background_color) && !empty($background_color)) {?>background: <?php echo esc_attr($background_color);}?>; <?php if(isset($background_image) && !empty($background_image)){?>background-image: url(<?php echo esc_url($background_image[0]);}?>);background-size:cover;">
                <div class="container">
            
                  <?php foreach($block_post as $key => $value){ ?>

                    <?php echo do_shortcode($value->post_content ); ?>
                    
                  <?php } ?>

                  </div>
              </section>

          <?php } ?> 


        <?php }elseif($block_type === 'tab'){ ?>


          <?php

            if(isset($meta['_autorent_block_style_background_color'][0])){
              $background_color = $meta['_autorent_block_style_background_color'][0];
            } 

            if(isset($meta['_autorent_block_style_background_image'][0])){
              $background_image_id = $meta['_autorent_block_style_background_image'][0];
              $background_image = wp_get_attachment_image_src( $background_image_id ,'large');  
            } 

          ?>


          <!-- SUPERTAB : BEGIN -->
          <?php if(isset($block_post)){ ?>

            <section class="about" style="<?php if(isset($background_color) && !empty($background_color)) {?>background: <?php echo esc_attr($background_color);}?>; <?php if(isset($background_image) && !empty($background_image)){?>background-image: url(<?php echo esc_url($background_image[0]);}?>);background-size:cover;">
              <div class="container">
  
                <?php foreach($block_post as $key => $value){ ?>

                  <?php echo do_shortcode($value->post_content ); ?>
                  
                <?php } ?>

              </div>
            </section>

          <?php } ?>
          <!-- SUPERTAB : END -->



        <?php }elseif($block_type === 'testimonial'){ ?>

          <?php

            if(isset($meta['_autorent_block_style_background_color'][0])){
              $background_color = $meta['_autorent_block_style_background_color'][0];
            } 

            if(isset($meta['_autorent_block_style_background_image'][0])){
              $background_image_id = $meta['_autorent_block_style_background_image'][0];
              $background_image = wp_get_attachment_image_src( $background_image_id ,'large');  
            } 

          ?>


          <!-- TESTIMONIAL : BEGIN -->
          <div class="testimonials-cover" style="<?php if(isset($background_color) && !empty($background_color)) {?>background: <?php echo esc_attr($background_color);}?>; <?php if(isset($background_image) && !empty($background_image)){?>background-image: url(<?php echo esc_url($background_image[0]);}?>);background-size:cover;">
            
            <?php if(isset($block_post)){ ?>

              <?php foreach($block_post as $key => $value){ ?>

                <?php echo do_shortcode($value->post_content ); ?>
                
              <?php } ?>

            <?php } ?>

          </div>
          <!-- TESTIMONIAL : END -->


        <?php }elseif($block_type === 'pricing'){ ?>  

          <?php

            if(isset($meta['_autorent_block_style_background_color'][0])){
              $background_color = $meta['_autorent_block_style_background_color'][0];
            } 

            if(isset($meta['_autorent_block_style_background_image'][0])){
              $background_image_id = $meta['_autorent_block_style_background_image'][0];
              $background_image = wp_get_attachment_image_src( $background_image_id ,'large');  
            } 

          ?>

          <section class="pricing pricing-home" style="<?php if(isset($background_color) && !empty($background_color)) {?>background: <?php echo esc_attr($background_color);}?>; <?php if(isset($background_image) && !empty($background_image)){?>background-image: url(<?php echo esc_url($background_image[0]);}?>);background-size:cover;">
            
            <!-- Start Pricing -->
            <?php get_template_part( 'templates/autorent', 'pricing'); ?>    
            <!-- End Pricing -->

          </section>          


        <?php }elseif($block_type === 'partner'){ ?>  


          <?php

            if(isset($meta['_autorent_block_style_background_color'][0])){
              $background_color = $meta['_autorent_block_style_background_color'][0];
            } 

            if(isset($meta['_autorent_block_style_background_image'][0])){
              $background_image_id = $meta['_autorent_block_style_background_image'][0];
              $background_image = wp_get_attachment_image_src( $background_image_id ,'large');  
            } 

          ?>          

          <!-- Start Partners -->
          <?php get_template_part( 'templates/autorent', 'partner'); ?>
          <!-- End Partners -->


          <?php }elseif($block_type === 'rental_experience'){ ?>  


          <!-- Start Partners -->
          <?php get_template_part( 'templates/autorent', 'rental_experience'); ?>
          <!-- End Partners -->  


        <?php }else{ ?>

          <?php _e( 'No Block type found ! or Invalid block type for this home  page', 'casa' ); ?>

        <?php } ?>
        <!-- BLOCK IF-ESLE : END -->


      <?php } ?>  
      <!-- FOREACH: END  --> 


  <?php }else{ ?>

    <h3 class="banner-align"><?php _e( 'Select Blocks To Build This Page', 'casa' ); ?></h3>

  <?php } ?>
  <!-- MOST OUTER IF-ELSE :END -->



<?php get_footer();   ?>