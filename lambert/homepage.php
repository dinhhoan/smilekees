<?php
/* banner-php */
/**
 * Template Name: Home Page
 *
 */
get_header();
while(have_posts()) : the_post(); 
	the_content();
	wp_link_pages();
endwhile;
get_footer();