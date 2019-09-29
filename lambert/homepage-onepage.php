<?php
/* banner-php */
/**
 * Template Name: Home - One Page
 */

get_header('onepage');
while(have_posts()) : the_post(); 
	the_content();
	wp_link_pages();
endwhile;
get_footer();