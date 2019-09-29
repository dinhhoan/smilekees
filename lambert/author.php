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
	    	<h1 class="breadcrumb-title"><?php the_archive_title() ;?></h1>
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

					<div class="about-author">
						<div class="about-author-avatar">
							<a href="<?php echo esc_url(get_the_author_meta('user_url' ) ); ?>">
								<?php echo get_avatar(get_the_author_meta('user_email'),$size='72',$default='http://0.gravatar.com/avatar/ad516503a11cd5ca435acc9bb6523536?s=72' ); ?>
							</a>
						</div>
						<div class="about-author-info">
							<div class="media-heading"><h4><?php _e('About ','lambert');?><a href="<?php echo esc_url(get_the_author_meta('user_url' ));?>"><?php echo get_the_author_meta('display_name');?></a></h4></div>
							<?php echo get_the_author_meta('description');?>
						</div>
						<div class="clearfix"></div>
						<div class="nav-social">
							<ul>
						    <?php if(get_user_meta(get_the_author_meta('ID'), '_cmb_twitterurl' ,true)!=''){ ?>
						    	<li><a title="<?php _e('Follow on Twitter','lambert');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_cmb_twitterurl' ,true)); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
						    <?php } ?>
						    <?php if(get_user_meta(get_the_author_meta('ID'), '_cmb_facebookurl' ,true)!=''){ ?>
						    	<li><a title="<?php _e('Like on Facebook','lambert');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_cmb_facebookurl' ,true)); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
						    <?php } ?>
						    <?php if(get_user_meta(get_the_author_meta('ID'), '_cmb_googleplusurl' ,true)!=''){ ?>
						    	<li><a title="<?php _e('Circle on Google Plus','lambert');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_cmb_googleplusurl' ,true)) ;?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
						    <?php } ?>
						    <?php if(get_user_meta(get_the_author_meta('ID'), '_cmb_linkedinurl' ,true)!=''){ ?>
						    	<li><a title="<?php _e('Be Friend on Linkedin','lambert');?>" href="<?php echo esc_url(get_user_meta(get_the_author_meta('ID'), '_cmb_linkedinurl' ,true) ); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
						    <?php } ?>
						    </ul>
						</div>
						<div class="clearfix"></div>
					</div>
							
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