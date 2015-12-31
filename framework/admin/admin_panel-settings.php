<?php

add_action('init','concierge_propanel_of_options');

if (!function_exists('concierge_propanel_of_options')) {
function concierge_propanel_of_options(){
//global $xxl_pages;
/*-----------------------------------------------------------------------------------*/
/* Create The Custom Site Options Panel
/*-----------------------------------------------------------------------------------*/
$options = array(); // do not delete this line - sky will fall

/* Option Page 1 - General Settings */
$options[] = array( "name" => __('General Settings',THEME_NAME),
			"type" => "heading");
			
$options[] = array( "name" => __('Tracking Code',THEME_NAME),
			"desc" => __('Paste Google Analytics (or other) tracking code here.', THEME_NAME),
			"id" => SHORT_NAME."_google_analytics",
			"std" => "",
			"type" => "textarea");

$options[] = array( "name" => __('Custom CSS',THEME_NAME),
			"desc" => __('Add your custom css here',THEME_NAME),
			"id" => SHORT_NAME."_custom_css",
			"std" => "",
			"type" => "textarea");

$options[] = array( "name" => __('Custom CSS',THEME_NAME),
			"desc" => __('Add your custom css here',THEME_NAME),
			"id" => SHORT_NAME."_custom_images",
			"std" => "",
			"type" => "upload_min");


update_option('of_template',$options); 					  
update_option('of_shortname',SHORT_NAME);

}
}
?>