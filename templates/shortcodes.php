<?php  
/**
 * Template Name: Shortcodes
 *
 */
get_header();

?>


<section class="shortcodes">
   

        <?php echo do_shortcode( the_content() ); ?>


</section>



<section class="features-icons">
                                  
	<!-- Start Features-Icons -->
	<?php get_template_part( 'templates/autorent', 'feature_services'); ?>    
	<!-- End Pricing -->         

</section>


<!-- Start Essentials -->
<section id="essentials">
<?php get_template_part( 'templates/autorent', 'rental_experience'); ?>  
</section>  
<!-- End Essentials -->



<!-- Start Essentials -->
<section id="essentials">
<?php get_template_part( 'templates/autorent', 'partner'); ?>  
</section>  
<!-- End Essentials -->


    
<?php get_footer();   ?>    