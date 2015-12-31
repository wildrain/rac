<?php
/**
 * The template for displaying search forms
 *
 * @package WordPress
 * @subpackage concierge
 * @since 1.0
 */
?>


<form method="get" action="<?php echo esc_url(home_url()); ?>" class="default-form search-form">
    <input type="text" value="search" name="s" id="s" placeholder="<?php _e('search','autorent'); ?> " onblur="if(this.value=='')this.value='search'" onfocus="if(this.value=='search')this.value=''" >
    <input type="hidden" value="submit" />
    <button><i class="fa fa-search"></i></button>
</form>


