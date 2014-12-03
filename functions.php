<?php
/**
 * @package Thuriot.be
 * @subpackage Thuriot.be_Theme
 */
 
$content_width = 450;

automatic_feed_links();

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2 class="widgettitle">',
		'after_title' => '</h2>',
	));
}

add_filter('stylesheet_directory_uri','wpi_stylesheet_dir_uri',10,2);

/**
 * wpi_stylesheet_dir_uri
 * overwrite theme stylesheet directory uri
 * filter stylesheet_directory_uri
 * @see get_stylesheet_directory_uri()
 */
function wpi_stylesheet_dir_uri($stylesheet_dir_uri, $theme_name){

	$subdir = '/css';
	return $stylesheet_dir_uri.$subdir;

}
/*
if (!is_admin()) {
    wp_enqueue_script('hash-change', get_bloginfo('template_directory') . '/js/jquery.ba-hashchange.min.js', array('jquery'), false, true);
    wp_enqueue_script('ajax-theme', get_bloginfo('template_directory') . '/js/Ajax.js', array('jquery', 'hash-change'), false, true);
}
*/
require_once(TEMPLATEPATH . '/code/controlpanel.php');
$cpanel = new ControlPanel();

add_editor_style();

?>
