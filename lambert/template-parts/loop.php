<?php
/* banner-php */


if(have_posts()): 
    while(have_posts()) : the_post(); 
        if(lambert_get_option('blog_show_format', true )){
            get_template_part( 'template-parts/post/content', ( post_type_supports( get_post_type(), 'post-formats' ) ? get_post_format() : get_post_type() ) );
        }else{
            get_template_part( 'template-parts/post/content' );
        }
    endwhile;
    lambert_pagination();
else:
	get_template_part('template-parts/post/content','none' );
endif;
