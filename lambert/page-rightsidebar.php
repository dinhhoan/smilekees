<?php
/* banner-php */
/**
 * Template Name: Page Right Sidebar
 */
get_header();
$sb_w = lambert_global_var('blog-sidebar-width') ? lambert_global_var('blog-sidebar-width') : 4;
$single_header_image = get_post_meta(get_the_ID(), "_cmb_single_header_image", true);
if($single_header_image == '') {
	$single_header_image = lambert_global_var('blog_header_image','url',true);
}
?>
<div class="content">
	<section class="parallax-section header-section">
		<div class="bg bg-parallax" style="background-image:url(<?php echo esc_url($single_header_image);?>)" data-top-bottom="transform: translateY(300px);" data-bottom-top="transform: translateY(-300px);"></div>
        <div class="overlay"></div>
        <div class="container">
            <h1><?php single_post_title( );?></h1>
        </div>
    </section>
    <section>
    	<div class="triangle-decor"></div>
        <div class="container">
			<div class="row">
				<div class="col-md-<?php echo 12 - $sb_w ;?> display-posts">
					<?php 
					if(lambert_global_var('blog_breadcrumbs')){
						lambert_breadcrumbs();
					}	
					?>
					<?php if(have_posts()) : ?>
						<?php while(have_posts()) : the_post(); ?>
							
							<?php get_template_part( 'template-parts/post/content', 'page'); ?>
						
						<?php endwhile; ?>

					<?php endif; ?> 
				</div>
				<div class="col-md-<?php echo esc_attr( $sb_w );?> page-sidebar right-sidebar">
		    		<?php get_sidebar('page'); ?>
				</div>
			</div><!-- .row -->
        </div><!-- .container -->
    </section>

</div>

<?php
get_footer(); 
?>