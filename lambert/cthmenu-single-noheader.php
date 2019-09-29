<?php
/* banner-php */
/**
 * Template Name: Without Header
 * Template Post Type: cthmenu
 */
get_header(); 
	while(have_posts()) : the_post();
	    the_content();
	    wp_link_pages();
	endwhile; 
get_footer( );
