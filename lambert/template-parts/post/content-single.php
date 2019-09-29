<?php
/* banner-php */
?>
<article <?php post_class('cth-single single-post' );?>>
<?php if(!lambert_global_var('show_blog_header_single')) : ?>
	<h1 class="article-title"><?php the_title( );?></h1>
<?php endif;?>
	<?php if(lambert_global_var('blog_author_single') || lambert_global_var('blog_date_single') || lambert_global_var('blog_cats_single') || lambert_global_var('blog_comments_single') || lambert_global_var('blog_like_post_single') ):?>
		<ul class="post-meta">
	        <?php if(lambert_global_var('blog_date_single')) :?>
			<li><?php _e('<i class="fa fa-calendar"></i> ','lambert');?><a class="meta_date" href="<?php echo get_day_link((int)get_the_time('Y' ), (int)get_the_time('m' ), (int)get_the_time('d' )); ?>"> <?php the_date(get_option('date_format' ));?></a></li>
			<?php endif;?>
			<?php if(lambert_global_var('blog_comments_single')) :?>
			<li><?php _e('<i class="fa fa-comments-o"></i> ','lambert');?><?php comments_popup_link(__('0', 'lambert'), __('1', 'lambert'), __('%', 'lambert')); ?></li>
			<?php endif;?>
			<?php if( function_exists('lambert_getPostLikeLink') && lambert_global_var('blog_like_post_single')) :?>
			<li><?php echo lambert_getPostLikeLink( get_the_ID() );?></li>
	        <?php endif;?>
	        <?php if(lambert_global_var('blog_cats_single')) :?>
				<?php if(get_the_category( )) { ?>
				<li>
					<?php _e('<i class="fa fa-file-o"></i> ','lambert');?>
					<?php the_category(', ' );?>					
				</li>
				<?php } ?>	
			<?php endif;?>
	        <?php if(lambert_global_var('blog_author_single')) :?>
			<li><h5><?php _e('<i class="fa fa-user"></i> ','lambert');?> <?php the_author_posts_link( );?></h5></li>
			<?php endif;?> 
	    </ul>	
	<?php endif;?> 

<?php if( lambert_global_var('blog_featured_single') ) :?>

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
							<?php echo wp_get_attachment_image( $img_id, 'lambert-large', false, array('class'=>'res-image') ); ?>
		                </div>

	                <?php
				    }
					?>
	            </div>
	        </div>
	    </div>
	<?php }elseif(get_post_meta(get_the_ID(), '_cmb_embed_video', true)!=""){ 

		if(get_post_format( ) == 'audio') :
		?>
		<div class="post-media">
			<div class="resp-audio">
			<?php
			$audio_url = get_post_meta(get_the_ID(), '_cmb_embed_video', true);
			if(preg_match('/(.mp3|.ogg|.wma|.m4a|.wav)$/i', $audio_url )){
				$attr = array(
					'src'      => $audio_url,
					'loop'     => '',
					'autoplay' => '',
					'preload'  => 'none'
				);
				echo wp_audio_shortcode( $attr );
			}else{
				echo wp_oembed_get($audio_url, array('height'=>'166') );
			}
			?>
			</div>
		</div>
		<?php else : ?>
		<div class="post-media">	
			<div class="responsive-video">
				<?php echo wp_oembed_get(get_post_meta(get_the_ID(), '_cmb_embed_video', true)); ?>
			</div>
		</div>
		<?php endif ; ?>
	<?php }elseif(has_post_thumbnail( )){ ?>
	<div class="post-media">
		<div class="box-item">
            <?php the_post_thumbnail('lambert-large',array('class'=>'res-image') ); ?>
        </div>
    </div>
	<?php } ?>

<?php endif; ?>
	
	<div class="clearfix"></div>
	<?php the_content();?>
    <?php
		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'lambert' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		) );
	?>
	<div class="clearfix"></div>
	<?php 
	if(lambert_global_var('blog_tags_single')) :?>
		<?php if(get_the_tags( )) { ?>
		<ul class="post-tags">
			<?php the_tags('<li>','</li><li>','</li>');?>			
		</ul>
		<?php } ?>
	<?php endif;?>
	<div class="clearfix"></div>
	<?php lambert_post_nav();?>

	<?php if(lambert_global_var('blog_author_single_block')) :?>
	<div class="post-author">
        <div class="author-img">
            <?php //echo get_avatar( get_the_author_meta('user_email'), 74 );
                echo get_avatar(get_the_author_meta('user_email'),$size='100',$default='http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=100' );
            ?> 
        </div>
        <div class="author-content">
            <h5><a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>" title="<?php echo esc_html__('Posts by ','lambert') . get_the_author_meta('nickname');?>" rel="author"><?php echo get_the_author_meta('nickname');?></a></h5>
            <p><?php echo get_the_author_meta('description');?></p>
        </div>
    </div>
	<?php endif;?>
</article>

<div class="clearfix"></div>

<?php
if ( comments_open() || get_comments_number() ) :
	
 	comments_template(); 
 	
endif; ?>