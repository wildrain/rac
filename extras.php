<?php get_header(); ?>

<?php 

	global $wp_query;

	$state = $wp_query->query_vars['extras'];
	_log($wp_query);

?>

<p>Extras page </p>

<?php get_footer(); ?>