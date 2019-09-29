<?php
/* banner-php */
?>
<!-- post-->
<article <?php post_class('content-content');?>>
    <h4 class="article-title"><a href="<?php the_permalink();?>" class=" transition2"><?php the_title( );?></a></h4>
<?php if(lambert_global_var('blog_author') || lambert_global_var('blog_date') || lambert_global_var('blog_cats') || lambert_global_var('blog_comments') || lambert_global_var('blog_like_post') ):?>
	<ul class="post-meta">
        <?php if(lambert_global_var('blog_date')) :?>
		<li><?php _e('<i class="fa fa-calendar"></i> ','lambert');?><a class="meta_date" href="<?php echo get_day_link((int)get_the_time('Y' ), (int)get_the_time('m' ), (int)get_the_time('d' )); ?>"> <?php the_time(get_option('date_format' ));?></a></li>
		<?php endif;?>
		<?php if(lambert_global_var('blog_comments')) :?>
		<li><?php _e('<i class="fa fa-comments-o"></i> ','lambert');?><?php comments_popup_link(__('0', 'lambert'), __('1', 'lambert'), __('%', 'lambert')); ?></li>
		<?php endif;?>
        <?php if( function_exists('lambert_getPostLikeLink') && lambert_global_var('blog_like_post')) :?>
		<li><?php echo lambert_getPostLikeLink( get_the_ID() );?></li>
        <?php endif;?>
        <?php if(lambert_global_var('blog_cats')) :?>
			<?php if(get_the_category( )) { ?>
			<li>
				<?php _e('<i class="fa fa-file-o"></i> ','lambert');?>
				<?php the_category(', ' );?>					
			</li>
			<?php } ?>	
		<?php endif;?>
        <?php if(lambert_global_var('blog_author')) :?>
		<li><h5><?php _e('<i class="fa fa-user"></i> ','lambert');?> <?php the_author_posts_link( );?></h5></li>
		<?php endif;?> 
    </ul>	
<?php endif;?> 

	<?php 
	// Get the list of files
    $slider_images = get_post_meta( get_the_ID(), '_cmb_post_slider_images', true);
    if( !empty($slider_images) ){
	?>
		<div class="post-media">
			<div class="single-slider-holder">
	            <!-- <div class="customNavigation">
	                <a class="next-slide transition"><i class="fa fa-angle-right"></i></a>
	                <a class="prev-slide transition"><i class="fa fa-angle-left"></i></a>
	            </div> -->
	            <div class="single-slider owl-carousel owl-theme">
	                <?php 
	                foreach ( (array) $slider_images as $img_id => $img_url ) {
				        ?>
				        <div class="item">
							<?php echo wp_get_attachment_image( $img_id, 'lambert-thumb', false, array('class'=>'res-image') ); ?>
		                </div>

	                <?php
				    }
					?>
	            </div>
	        </div>
	    </div>
	<?php
	}elseif(has_post_thumbnail( )){ ?>
		<div class="post-media">
			<div class="box-item">
	            <a href="<?php the_permalink();?>" >
	            <?php the_post_thumbnail('lambert-thumb',array('class'=>'res-image') ); ?>
	            </a>
	        </div>
	    </div>
	<?php } ?>
	
    <?php edit_post_link( __( 'Edit', 'lambert' ), '<span class="edit-link">', '</span>' ); ?>
    <?php the_excerpt();?>
    <?php
		wp_link_pages( array(
		'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'lambert' ) . '</span>',
		'after'       => '</div>',
		'link_before' => '<span>',
		'link_after'  => '</span>',
		) );
	?>
	<div class="clearfix"></div>

    <a href="<?php the_permalink();?>" class=" post-link"><?php _e('Continue reading ...','lambert');?></a>
	<?php 
	if(lambert_global_var('blog_tags')) :?>
		<?php if(get_the_tags( )) { ?>
		<ul class="post-tags">
			<?php the_tags('<li>','</li><li>','</li>');?>			
		</ul>
		<?php } ?>
	<?php endif;?>
</article>