<?php
/* banner-php */

get_header('404'); 
?>
<section class="fourofour">
	<div class="fourofour-bg" 
	<?php if( lambert_global_var('404_bg','url', true) ) :?>
	style="background-image:url(<?php echo esc_url( lambert_global_var('404_bg','url', true) );?>);" 
	<?php endif;?>
	>
		<div class="overlay"></div>
		<div class="header-inner">
			<?php _e('<h2>Oops!</h2>','lambert');?>
			<?php _e('<h1>404</h1>','lambert');?>
			<?php if(lambert_global_var('404_intro')) :?>
			<?php echo wpautop( lambert_global_var('404_intro') ); ?>
			<?php endif;?>
			<p>
				<?php _e('You can either return to the <a href="javascript:history.back()">previous page</a>','lambert');?>
				<?php printf(__(' or go back <a href="%s">home</a>','lambert'),esc_url(home_url('/' )));?>
			</p>
			
		</div>
	</div>
</section>
<?php get_footer('404'); ?>