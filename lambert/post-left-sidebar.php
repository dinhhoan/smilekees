<?php
/* banner-php */
/**
 * Template Name: Post Left Sidebar
 * Template Post Type: post
 */

get_header(); 
$sb_w = lambert_global_var('blog-sidebar-width') ? lambert_global_var('blog-sidebar-width') : 4;
$single_header_image = get_post_meta(get_the_ID(), "_cmb_single_header_image", true);
if($single_header_image == '') {
	$single_header_image = lambert_global_var('blog_header_image','url',true);
}
?>
<div class="content">
<?php if(lambert_global_var('show_blog_header_single')) : ?>
	<section class="parallax-section header-section">
		<div class="bg bg-parallax" style="background-image:url(<?php echo esc_url($single_header_image);?>)" data-top-bottom="transform: translateY(300px);" data-bottom-top="transform: translateY(-300px);"></div>
	    <div class="overlay"></div>
	    <div class="container">
	    	<h1 class="breadcrumb-title"><?php single_post_title( ) ;?></h1>
	    </div>
	</section>
	<section class="align-text contact-container"  id="sec2">
<?php else : ?>
	<section class="align-text contact-container hide-single-head"  id="sec2">
<?php endif;?>
		<div class="triangle-decor"></div>
        <div class="content">
            <div class="container">
                <div class="row">
					<div class="col-md-<?php echo esc_attr( $sb_w );?> blog-sidebar left-sidebar">
			    		<?php get_sidebar( ); ?>
					</div>
					<div class="col-md-<?php echo 12 - $sb_w ;?> display-posts">
						<?php while(have_posts()) : the_post(); ?>
							<?php get_template_part( 'template-parts/post/content', 'single' ); ?>
						<?php endwhile;?>
					</div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php 
get_footer(); 
?>