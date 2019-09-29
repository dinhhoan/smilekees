<?php
/* banner-php */
get_header(); 
$single_header_image = get_post_meta(get_the_ID(), "_cmb_single_header_image", true);
if($single_header_image == '') {
    $single_header_image = lambert_global_var('blog_header_image','url',true);
}
?>
<div class="content">
	<section class="parallax-section header-section">
		<div class="bg bg-parallax" style="background-image:url(<?php echo esc_url( $single_header_image );?>)" data-top-bottom="transform: translateY(300px);" data-bottom-top="transform: translateY(-300px);"></div>
        <div class="overlay"></div>
        <div class="container">
            <h1><?php single_post_title( );?></h1>
        </div>
    </section>

    <?php while(have_posts()) : the_post(); ?>

	    <?php the_content(); ?>
	    <?php wp_link_pages(); ?>


	<?php endwhile; ?> 

</div>
<?php 
get_footer( );
