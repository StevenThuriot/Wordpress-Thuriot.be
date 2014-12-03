<?php
/**
 * @package Thuriot.be
 * @subpackage Thuriot.be_Theme
 */
get_header(); 

if (have_posts()) 
{ 
	while (have_posts()) 
	{	
		the_post();
		the_content('<p class="serif">' . __('Read the rest of this page &raquo;', 'kubrick') . '</p>');
		wp_link_pages(array('before' => '<p><strong>' . __('Pages:', 'kubrick') . '</strong> ', 'after' => '</p>', 'next_or_number' => 'number'));
	}
}

//edit_post_link(__('Edit Page', 'Thuriot.be'), '<p id="editLink">', '</p>');
comments_template();

get_footer(); 

?>

