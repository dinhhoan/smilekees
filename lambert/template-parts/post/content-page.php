<?php
/**
 * @package Lambert - Restaurant / Cafe / Pub WordPress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 28-08-2019
 *
 * @copyright  Copyright ( C ) 2014 - 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */
?>
<article <?php post_class('content-page cth-page');?>>
	<?php if(has_post_thumbnail( )){ ?>
	<div class="blog-media">
		<div class="box-item">
            <?php the_post_thumbnail('full',array('class'=>'blog-thumb') ); ?>
        </div>
    </div>
	<?php } ?>
    <div class="blog-text">
        <?php edit_post_link( __( 'Edit', 'lambert' ), '<span class="edit-link">', '</span>' ); ?>	
		<?php the_content( ); ?>
		<div class="clearfix"></div>
		<?php
			wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'lambert' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			) );
		?>
    </div>
</article>
<?php
// If comments are open or we have at least one comment, load up the comment template.
if ( comments_open() || get_comments_number() ) :
	comments_template();
endif;
?>