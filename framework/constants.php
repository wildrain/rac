<?php

if(!defined('THEME_NAME')){
	define('THEME_NAME', "autorent");
}
if(!defined('SHORT_NAME')){
	define('SHORT_NAME', "autorent");
}
if(!defined('THEME_NICE_NAME')){
	define('THEME_NICE_NAME', "autorent_wp");
}

if(!defined('THEME_HAS_PANEL')){
	define('THEME_HAS_PANEL', TRUE);
}


/*-------------------------------------------------------------------------
  START JS CSS AND IMG CONSTANT PATH DEFINED
------------------------------------------------------------------------- */

if(!defined('AUTORENT_JS')){

	define('AUTORENT_JS', get_template_directory_uri().'/assets/js/' );
}

if(!defined('AUTORENT_CSS')){

	define('AUTORENT_CSS', get_template_directory_uri().'/assets/css/' );
}

if(!defined('AUTORENT_IMAGE')){

	define('AUTORENT_IMAGE', get_template_directory_uri().'/assets/img/');
}

if(!defined('AUTORENT_VIDEO')){

	define('AUTORENT_VIDEO', get_template_directory_uri().'/assets/video/');
}

/*-------------------------------------------------------------------------
  END JS CSS AND IMG CONSTANT PATH DEFINED
------------------------------------------------------------------------- */
