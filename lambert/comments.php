<?php
/* banner-php */

if ( post_password_required() )
    return;
?>
<div class="row align-text">
    <div class="col-md-12">
    <?php if ( have_comments() ) : ?>
    	<div id="comments">
    		
				<h6 id="comments-title">
					<?php
						printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'lambert' ),
							number_format_i18n( get_comments_number() ), get_the_title() );
					?>
				</h6>

				<?php 

				$args = array(
					'walker'            => null,
					'max_depth'         => '',
					'style'             => 'li',
					'callback'          => 'lambert_theme_comment',
					'end-callback'      => null,
					'type'              => 'all',
					'reply_text'        => esc_html__('Reply','lambert' ),
					'page'              => '',
					'per_page'          => '',
					'avatar_size'       => 50,
					'reverse_top_level' => null,
					'reverse_children'  => '',
					'format'            => 'html5', //or xhtml if no HTML5 theme support
					'short_ping'        => false, // @since 3.6,
				    'echo'     			=> true, // boolean, default is true
				);
				?>
				<ul class="commentlist clearfix">
				<?php wp_list_comments($args);?>
				</ul>
				<?php
				// Are there comments to navigate through?
				if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
					?>
				<div class="content-nav">
					<ul class="pager">
						<li class="previous"><?php previous_comments_link( __( '<i class="fa fa-long-arrow-left"></i>', 'lambert' ) ); ?></li>
						<li><span>/</span></li>
						<li class="next"><?php next_comments_link( __( '<i class="fa fa-long-arrow-right"></i>', 'lambert' ) ); ?></li>
					</ul>
				</div>
				<?php endif; // Check for comment navigation ?>

				<?php if ( ! comments_open() && get_comments_number() ) : ?>
					<p class="no-comments" style="margin-left:15px;"><?php _e( 'Comments are closed.' , 'lambert' ); ?></p>
				<?php endif; ?>

			
    	</div>

    	<div class="clearfix"></div>
    <?php endif; // have_comments() ?>

        <?php if(comments_open( )) : ?>
	    <div class="comment-form-holder">
	            <?php
					$aria_req = ( $req ? " aria-required='true'" : '' );
					$comment_args = array(
					'title_reply'=> __('Leave A Comment','lambert'),
					'fields' => apply_filters( 'comment_form_default_fields', 
					array(
							'author' => '<input type="text" id="author" name="author"  placeholder="'.__('Name','lambert').'" value="' . esc_attr( $commenter['comment_author'] ) . '" ' . $aria_req . '>',
							'email' =>'<input id="email" name="email" type="text"  placeholder="'.__('E-mail','lambert').'" value="' . esc_attr(  $commenter['comment_author_email'] ) .
									'" ' . $aria_req . ' />',
							) 
						),
					'comment_field' => '<textarea  placeholder="'.__('Message','lambert').'"  id="comment" rows="9" name="comment"  '.$aria_req.'></textarea>',
					'id_form'=>'comment-form',
					'id_submit' => 'submit',
					'class_submit'=>'transition button',
					'label_submit' => __('Post Comment','lambert'),
					'must_log_in'=> '<p class="not-empty" style="margin-left:15px;">' .  sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ,'lambert'), wp_login_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
					'logged_in_as' => '<p class="not-empty" style="margin-left:15px;">' . sprintf( __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','lambert' ), admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) ) ) . '</p>',
					//'comment_notes_before' => '<h5 class="text-center">'.__('Your email is safe with us.','lambert').'</h5>',
					'comment_notes_after' => '',
					);
				?>
				<?php comment_form($comment_args); ?>
	    </div>
	   	<?php endif;?>


    </div>
</div>