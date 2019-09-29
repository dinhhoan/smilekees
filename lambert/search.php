<?php
/* banner-php */
get_header();
$sb_w = lambert_global_var('blog-sidebar-width') ? lambert_global_var('blog-sidebar-width') : 4;
?>
<div class="content">
	<section class="parallax-section header-section">
	    <div class="bg bg-parallax" style="background-image:url(<?php echo esc_url(lambert_global_var('blog_header_image','url', true));?>)" data-top-bottom="transform: translateY(300px);" data-bottom-top="transform: translateY(-300px);"></div>
	    <div class="overlay"></div>
	    <div class="container">
	    	<h1 class="breadcrumb-title"><?php printf(__('Search Results for "%s" Query','lambert'),get_search_query( ));?></h1>
	    	
	    </div>
	</section>

	<!--================= Section post's ================-->
    <section class="align-text">
        <div class="triangle-decor"></div>
        <div class="content">
            <div class="container">
                <div class="row">
                <?php if(lambert_global_var('blog_layout') == 'left_sidebar'):?>
					<div class="col-md-<?php echo esc_attr( $sb_w );?> blog-sidebar left-sidebar">
			    		<?php get_sidebar( ); ?>
					</div>
				<?php endif;?>
				<?php if(lambert_global_var('blog_layout') == 'fullwidth'):?>
					<div class="col-md-12 display-posts">
				<?php else:?>
					<div class="col-md-<?php echo 12 - $sb_w ;?> display-posts">
				<?php endif;?>

					<?php 
					if(lambert_global_var('blog_breadcrumbs')){
						lambert_breadcrumbs();
					}
					?>

					<?php 
					if(have_posts()): 
					    while(have_posts()) : the_post(); 
					        get_template_part( 'template-parts/post/content', 'search' );
					    endwhile;
					    lambert_pagination();
					else:
						get_template_part('template-parts/post/content','none' );
					endif;
					?>

				</div>

				<?php if( lambert_global_var('blog_layout') == 'right_sidebar'):?>
				<div class="col-md-<?php echo esc_attr( $sb_w );?> blog-sidebar right-sidebar">
	        		<?php get_sidebar( ); ?>
	        	</div>
				<?php endif;?>

                </div>
            </div>
        </div>
    </section>
    <!-- section end -->

</div>
<?php
get_footer(); 
