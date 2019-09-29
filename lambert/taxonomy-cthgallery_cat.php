<?php
/* banner-php */
get_header(); 

$tax_header_image = '';
$t_id = get_queried_object()->term_id;
$term_meta = get_option( "_lambert_taxonomy_cthgallery_cat_$t_id" );
if($term_meta !== false){
    if( isset($term_meta['cat_header_image']['url']) ){
        $tax_header_image = $term_meta['cat_header_image']['url'];
    }
}
if($tax_header_image == ''){
	$tax_header_image = lambert_global_var('gallery_header_image','url',true);
}

?>
<div class="content">
	<section class="parallax-section header-section">
		<div class="bg bg-parallax" style="background-image:url(<?php echo esc_url( $tax_header_image );?>)" data-top-bottom="transform: translateY(300px);" data-bottom-top="transform: translateY(-300px);"></div>
        <div class="overlay"></div>
        <div class="container">
            <h1><?php single_term_title( ) ;?></h1>
            <h3><?php echo term_description( );?></h3>
        </div>
    </section>
    <?php 
    if(is_front_page()) {
        $paged = (get_query_var('page')) ? get_query_var('page') : 1;
    } else {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    }
    $post_args = array(
        'post_type' => 'cthgallery',
        'paged' => $paged,
        'posts_per_page'=> lambert_global_var('gallery_posts_per_page'),
        'order_by'=> lambert_global_var('gallery_archive_orderby'),
        'order'=> lambert_global_var('gallery_archive_order'),
    );
    $post_args['tax_query'][] = array(
        'taxonomy' => 'cthgallery_cat',
        'field' => 'term_id',
        'terms' => $t_id,
    );

    $gal_posts = new WP_Query($post_args); 
        
    if($gal_posts->have_posts()) : ?>

    <section class="cthgallery-archive-sec">
    	<div class="triangle-decor"></div>
	    <div class="container container-gallery">

            <div class="gallery-grid-wrap">

                <?php 
                $grid_cls = 'gallery-items';
                $grid_cls .= ' '.lambert_global_var('gallery_column').'-coulms';
                $grid_cls .= ' grid-'.lambert_global_var('gallery_pad').'-pad';
                if(lambert_global_var('gallery_enable_gallery'))  $grid_cls .= ' popup-gallery';
                ?>

                <div class="<?php echo esc_attr($grid_cls );?>"
                <?php if( lambert_global_var('gallery_show_loadmore') && (lambert_global_var('gallery_posts_per_page') != '-1' && $gal_posts->found_posts && $gal_posts->found_posts > lambert_global_var('gallery_posts_per_page') ) ):
                $lmore_data = $post_args;
                $lmore_data['action'] = 'lambert_lm_gal';
                $lmore_data['lmore_items'] = lambert_global_var('gallery_lm_items');
                ?>
                 data-lm-request="<?php echo esc_url(admin_url( 'admin-ajax.php' ) ) ;?>"
                 data-lm-nonce="<?php echo wp_create_nonce( 'lambert_lm_gal' ); ?>"
                 data-lm-settings="<?php echo esc_attr(json_encode($lmore_data) ); ?>"
                <?php endif;?>
                >
                    <div class="grid-sizer"></div>
	            <div class="grid-sizer-second"></div>
	            <div class="grid-sizer-three"></div>
                    <?php while($gal_posts->have_posts()) : $gal_posts->the_post(); ?>
                        
                        <?php get_template_part( 'template-parts/gal/list' ); ?>

                    <?php endwhile;?>                                   
                </div>

                <?php if( lambert_global_var('gallery_show_pagination')){lambert_custom_pagination($gal_posts->max_num_pages,$range = 2,$gal_posts ); } ?>
                <?php if( lambert_global_var('gallery_show_loadmore') && (lambert_global_var('gallery_posts_per_page') != '-1' && $gal_posts->found_posts && $gal_posts->found_posts > lambert_global_var('gallery_posts_per_page') ) ): ?>
                <div class="gal-grid-lmore-holder">
			        <a class="load-more-post gal-load-more" data-click="1" href="#" data-remain="yes"><?php echo wp_kses(__('<i class="fa fa-refresh fa-spin" aria-hidden="true"></i> <span>Load more galleries</span>','lambert'), array('i'=>array('class'=>array()),'span'=>array('class'=>array()),) );?></a>
			    </div>
                <?php endif; ?>
            


            </div>

        </div>

    </section>

    <?php endif;//have_posts()?>

    <?php wp_reset_postdata(); ?>

</div>


<?php 
get_footer( );
