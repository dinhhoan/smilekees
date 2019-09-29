<?php
/* banner-php */

get_header();
$sb_w = lambert_global_var('blog-sidebar-width') ? lambert_global_var('blog-sidebar-width') : 4;

$blog_header_image = lambert_global_var('blog_header_image','url', true) ;
$t_id = get_queried_object()->term_id;
$term_meta = get_option( "taxonomy_category_$t_id" );
if($term_meta !== false){
    if(isset($term_meta['cat_header_image']['url']) && $term_meta['cat_header_image']['url'] != ''){
        $blog_header_image = $term_meta['cat_header_image']['url'];
    }
}

?>
<div class="content">
	<section class="parallax-section header-section">
	    <div class="bg bg-parallax" style="background-image:url(<?php echo esc_url($blog_header_image);?>)" data-top-bottom="transform: translateY(300px);" data-bottom-top="transform: translateY(-300px);"></div>
	    <div class="overlay"></div>
	    <div class="container">
	    	<h1 class="breadcrumb-title"><?php the_archive_title() ;?></h1>
	    	<h3><?php echo category_description( );?></h3>
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
							
					<?php get_template_part( 'template-parts/loop' ); ?>
					

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
?>
