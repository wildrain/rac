<?php

//Access the WordPress Pages via an Array
$mgd_pages = array();
$mgd_pages[0] = "Select a page"; 
$mgd_pages_obj = get_pages('sort_column=post_parent,menu_order');    
foreach ($mgd_pages_obj as $mgd_page) {
$mgd_pages[$mgd_page->ID] = $mgd_page->post_title;
}

/**
 * Convert seconds to h:m:s format
 *
 * @param int $sec The number of seconds to convert
 * @param boolean $padHours Pad the number of hours
 *
 * @return boolean Valid or not valid
 */
function uou_sec2hms($sec, $padHours = false) {
	$hms = "";
	$hours = intval(intval($sec) / 3600);
	if($hours != 0){
	$hms .= ($padHours)
	? str_pad($hours, 2, "0", STR_PAD_LEFT). ':'
	: $hours. ':';
	}
	$minutes = intval(($sec / 60) % 60);
	$hms .= str_pad($minutes, 2, "0", STR_PAD_LEFT). ':';
	$seconds = intval($sec % 60);
	$hms .= str_pad($seconds, 2, "0", STR_PAD_LEFT);
	return $hms;
}

/**
 * Validates email address input from users
 *
 * @param string $email The email address to be verified
 *
 * @return boolean Valid or not valid
 */
function uou_check_email_address($email) {
  // First, we check that there's one @ symbol, 
  // and that the lengths are right.
  if (!ereg("^[^@]{1,64}@[^@]{1,255}$", $email)) {
    // Email invalid because wrong number of characters 
    // in one section or wrong number of @ symbols.
    return false;
  }
  // Split it into sections to make life easier
  $email_array = explode("@", $email);
  $local_array = explode(".", $email_array[0]);
  for ($i = 0; $i < sizeof($local_array); $i++) {
    if
(!ereg("^(([A-Za-z0-9!#$%&'*+/=?^_`{|}~-][A-Za-z0-9!#$%&
?'*+/=?^_`{|}~\.-]{0,63})|(\"[^(\\|\")]{0,62}\"))$",
$local_array[$i])) {
      return false;
    }
  }
  // Check if domain is IP. If not, 
  // it should be valid domain name
  if (!ereg("^\[?[0-9\.]+\]?$", $email_array[1])) {
    $domain_array = explode(".", $email_array[1]);
    if (sizeof($domain_array) < 2) {
        return false; // Not enough parts to domain
    }
    for ($i = 0; $i < sizeof($domain_array); $i++) {
      if
(!ereg("^(([A-Za-z0-9][A-Za-z0-9-]{0,61}[A-Za-z0-9])|
?([A-Za-z0-9]+))$",
$domain_array[$i])) {
        return false;
      }
    }
  }
  return true;
}


/**
 * Validates URL input from users
 *
 * @param string $url The url to be verified
 *
 * @return boolean Valid or not valid
 *
 * @link http://www.daniweb.com/web-development/php/threads/290866/regular-expression-help-with-url-validation
 */
function uou_check_url($url) {
  /*
  $url_regex = '/^(http\:\/\/[a-zA-Z0-9_\-]+(?:\.[a-zA-Z0-9_\-]+)*\.[a-zA-Z]{2,4}(?:\/[a-zA-Z0-9_]+)*(?:\/[a-zA-Z0-9_]+\.[a-zA-Z]{2,4}(?:\?[a-zA-Z0-9_]+\=[a-zA-Z0-9_]+)?)?(?:\&[a-zA-Z0-9_]+\=[a-zA-Z0-9_]+)*)$/';
  */

  /* Make sure it's a properly formatted URL. */
  // From: http://www.daniweb.com/web-development/php/threads/290866
  // Scheme
  $url_regex = '^(https?|s?ftp\:\/\/)|(mailto\:)';
  // User and password (optional)
  $url_regex .= '([a-z0-9\+!\*\(\)\,\;\?&=\$_\.\-]+(\:[a-z0-9\+!\*\(\)\,\;\?&=\$_\.\-]+)?@)?';
  // Hostname or IP
  // http://x = allowed (ex. http://localhost, http://routerlogin)
  $url_regex .= '[a-z0-9\+\$_\-]+(\.[a-z0-9\+\$_\-]+)*';
  // http://x.x = minimum
  // $url_regex .= "[a-z0-9\+\$_\-]+(\.[a-z0-9+\$_\-]+)+";
  // http://x.xx(x) = minimum
  // $url_regex .= "([a-z0-9\+\$_\-]+\.)*[a-z0-9\+\$_\-]{2,3}";
  // use only one of the above
  // Port (optional)
  $url_regex .= '(\:[0-9]{2,5})?';
  // Path (optional)
  // $urlregex .= '(\/([a-z0-9\+\$_\-]\.\?)+)*\/?';
  // GET Query (optional)
  $url_regex .= '(\?[a-z\+&\$_\.\-][a-z0-9\;\:@\/&%=\+\$_\.\-]*)?';
  // Anchor (optional)
  // $urlregex .= '(\#[a-z_\.\-][a-z0-9\+\$_\.\-]*)?$';


  if ($url == 'http://' || $url == 'https://') {
    return false;
  }

  return preg_match('/'.$url_regex.'/i', $url);
}


/**
 * Gets post excerpt by Post ID.
 *
 * Gets the Excerpt Automatically Using the Post ID Outside of the Loop
 *
 * @param integer $post_id The id of the post
 * @param boolean $trim_content Indicates whether to trim the content 
 * @param integer $excerpt_length Sets excerpt length by word count
 * @param string $more_text Text to be displayed after the trimmed excerpt
 * @param boolean $wrap_paragraph Wraps the result in a paragraph html tags
 * @param string $wrap_tag the html tag wrapper type, e.g. p, strong, em, h1 ...etc
 *
 * @return string the desired post excerpt.
 *
 * @link http://uplifted.net/programming/wordpress-get-the-excerpt-automatically-using-the-post-id-outside-of-the-loop/
 */
function uou_get_excerpt_by_id($post_id, $trim_content = TRUE, $excerpt_length = 35, $more_text = '...', $wrap_paragraph = true, $wrap_tag = 'p'){
    $the_post = get_post($post_id);
	$the_excerpt = $the_post->post_excerpt;
	if((!isset($the_post->post_excerpt) || empty($the_post->post_excerpt)) && $trim_content){
		$the_excerpt = $the_post->post_content; //Gets post_content to be used as a basis for the excerpt
		$the_excerpt = strip_tags(strip_shortcodes($the_excerpt)); //Strips tags and images
		
		//Limit to the words count
		$words = explode(' ', $the_excerpt, $excerpt_length + 1);
		if(count($words) > $excerpt_length) :
		array_pop($words);
		array_push($words, $more_text);
		$the_excerpt = implode(' ', $words);
		endif;
	}
	//Wrap the excerpt
	if($wrap_paragraph){
	$the_excerpt = '<'.$wrap_tag.'>' . $the_excerpt . '</'.$wrap_tag.'>';
	}
    return $the_excerpt;
}


/**
* Aqua Resizer
* Description	: Resizes WordPress images on the fly
* Version	: 1.1.3
* Author	: Syamil MJ
* Author URI	: http://aquagraphite.com
* License	: WTFPL - http://sam.zoy.org/wtfpl/
* Documentation	: https://github.com/sy4mil/Aqua-Resizer/
*
* @param string $url - (required) must be uploaded using wp media uploader
* @param int $width - (required)
* @param int $height - (optional)
* @param bool $crop - (optional) default to soft crop
* @param bool $single - (optional) returns an array if false
* @uses wp_upload_dir()
* @uses image_resize_dimensions()
* @uses image_resize()
*
* @return str|array
*/

function uou_resize( $url, $width, $height = null, $crop = null, $single = true ) {
	
	//validate inputs
	if(!$url OR !$width ) return false;
	
	//define upload path & dir
	$upload_info = wp_upload_dir();
	$upload_dir = $upload_info['basedir'];
	$upload_url = $upload_info['baseurl'];
	
	//check if $img_url is local
	if(strpos( $url, home_url() ) === false) return false;
	
	//define path of image
	$rel_path = str_replace( $upload_url, '', $url);
	$img_path = $upload_dir . $rel_path;
	
	//check if img path exists, and is an image indeed
	if( !file_exists($img_path) OR !getimagesize($img_path) ){
		$g_upload_dir = dirname($upload_info['basedir']).'/gallery';
		$g_upload_url = dirname($upload_info['baseurl']).'/gallery';
		
		//define path of image
		$g_rel_path = str_replace( $g_upload_url, '', $url);
		$g_img_path = $g_upload_dir . $g_rel_path;
	
		if( !file_exists($g_img_path) OR !getimagesize($g_img_path) ){
			return false;
		}else{
			$upload_dir = $g_upload_dir;
			$upload_url = $g_upload_url;
			$img_path = $g_img_path;
			$rel_path = $g_rel_path;
		}
	}	
	
	//get image info
	$info = pathinfo($img_path);
	$ext = $info['extension'];
	list($orig_w,$orig_h) = getimagesize($img_path);
	
	//get image size after cropping
	$dims = image_resize_dimensions($orig_w, $orig_h, $width, $height, $crop);
	$dst_w = $dims[4];
	$dst_h = $dims[5];
	
	//use this to check if cropped image already exists, so we can return that instead
	$suffix = "{$dst_w}x{$dst_h}";
	$dst_rel_path = str_replace( '.'.$ext, '', $rel_path);
	$destfilename = "{$upload_dir}{$dst_rel_path}-{$suffix}.{$ext}";
	
	//if orig size is smaller
	if($width >= $orig_w) {
		
		if(!$dst_h) :
			//can't resize, so return original url
			$img_url = $url;
			$dst_w = $orig_w;
			$dst_h = $orig_h;
			
		else :
			//else check if cache exists
			if(file_exists($destfilename) && getimagesize($destfilename)) {
				$img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
			} 
			//else resize and return the new resized image url
			else {
				$image = wp_get_image_editor( $img_path );
				if ( ! is_wp_error( $image ) ) {
					$image->resize( $width, $height, $crop );
					$saved = $image->save();
					$rel_path = str_replace( $upload_dir, '', $saved['path']);
					$img_url = $upload_url.'/'.$rel_path;
				}
			}
			
		endif;
		
	}
	//else check if cache exists
	elseif(file_exists($destfilename) && getimagesize($destfilename)) {
		$img_url = "{$upload_url}{$dst_rel_path}-{$suffix}.{$ext}";
	} 
	//else, we resize the image and return the new resized image url
	else {
		$image = wp_get_image_editor( $img_path );
		if ( ! is_wp_error( $image ) ) {
			$image->resize( $width, $height, $crop );
			$saved = $image->save();
			
			$rel_path = str_replace( $upload_dir, '', $saved['path']);
			$img_url = $upload_url.'/'.$rel_path;
		}
	}
	
	//return the output
	if($single) {
		//str return
		$image = $img_url;
	} else {
		//array return
		$image = array (
			0 => $img_url,
			1 => $dst_w,
			2 => $dst_h
		);
	}
	
	return $image;
}
/**
* Gets a float number out of a string
* 
* @param string $str - (required) the string to be converted
*
* @return float
*
* http://php.net/floatval
*/

function uou_get_float($str) {
  if(preg_match("#([0-9\.\,]+)#im", html_entity_decode(strip_tags($str)), $match)) { // search for number that may contain '.' 
    return floatval($match[0]); 
  } else { 
    return floatval($str); // take some last chances with floatval 
  }
}

if ( ! function_exists( 'uou_get_avatar_url' ) ) {
function uou_get_avatar_url($get_avatar){
    preg_match("/src='(.*?)'/i", $get_avatar, $matches);
    return $matches[1];
}
}

function uou_has_items_list($post_id, $meta_key){
	$meta = get_post_meta($post_id, $meta_key, true);
	$meta_obj = json_decode(htmlspecialchars_decode($meta));
	
	if(is_object($meta_obj)){
		return true;
	}
	return false;
}
function uou_get_items_list($post_id, $meta_key, $args = array()){
	
	$args = wp_parse_args( $args, array(
		'width' => 150,
		'height' => 150,
		'crop' => true,
		'type' => 'attachment',
		'echo' => true,
		'no_image_url' => get_template_directory_uri().'/framework/uoulib/admin/img/no_image.jpg',
		'template' => '<li><img src="IMAGE_URL" alt="ITEM_NAME" /></li>',
	) );
	//IMAGE_URL, ITEM_NAME, ITEM_ID, META_KEY, FULL_IMAGE_URL
	
	$meta = get_post_meta($post_id, $meta_key, true);
	$meta_obj = json_decode(htmlspecialchars_decode($meta));
	
	$patterns = array();
	$patterns[0] = '/FULL_IMAGE_URL/';
	$patterns[1] = '/ITEM_NAME/';
	$patterns[2] = '/ITEM_ID/';
	$patterns[3] = '/META_KEY/';
	$patterns[4] = '/IMAGE_URL/';
	
	$results = array();

	if(is_object($meta_obj)) : ?>			
		<?php
		foreach($meta_obj as $item_id) :
			$thumb_id = $item_id;
			$title = get_the_title($item_id);
			if($args['type'] != 'attachment'):
				$thumb_id = get_post_thumbnail_id($item_id);
			endif;				
			if($this_image = wp_get_attachment_image_src($thumb_id, 'full')) :
				$full_image_url = $this_image[0];
				$image_url = uou_resize($this_image[0], $args['width'], $args['height'], $args['crop']);
			else:
				$full_image_url = $image_url = $args['no_image_url'];
			endif;
			
			$replacements = array();
			$replacements[0] = $full_image_url;
			$replacements[1] = $title;
			$replacements[2] = $item_id;
			$replacements[3] = $meta_key;
			$replacements[4] = $image_url;
			
			if($args['echo']){
				echo preg_replace($patterns, $replacements, $args['template']);
			}else{
				$results[] = preg_replace($patterns, $replacements, $args['template']);
			}
			
			endforeach; ?>
	<?php endif;
	
	return $results;
}

/**
 * Gets the languages
 *
 * Gets single and array meta values defined in the admin scripts for theme usage.
 *
 * @param integer $is The meta value id
 * @param integer $post_id The id of the post
 * @param boolean $is_single Indicates whether to parse the value as an array or as a single object.
 *
 * @return array The desired meta value
 */

function uou_get_theme_langs(){
	global $post, $posts;
	if(function_exists('icl_get_languages')){
		$old_posts = $posts;
		$langs = icl_get_languages('skip_missing=N&orderby=KEY&order=DIR&link_empty_to=str');
		$posts = $old_posts;
		wp_reset_query();
	}else{
		$langs = array('&nbsp;' => array('url' => '#', 'active' => 0, 'code' => "&nbsp;"));
	}
	
	return $langs;
}

function uou_is_page_template($template){
	$page_template = basename(get_page_template(),'.php');
	if(is_array($template) && in_array($page_template, $template)){
		return true;
	}else if($template == $page_template){
		return true;
	}
	
	return false;
}
?>