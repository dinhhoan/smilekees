<?php
/* banner-php */
?>
<div class="searh-holder">
	<form role="search" method="get" class="search-form searh-inner" action="<?php echo home_url( '/' ); ?>">
		<input type="text" class="search" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder','lambert' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( '', 'label','lambert' ) ?>"/>
		<button class="search-submit"  type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button','lambert' ) ?>"><?php _e('<i class="fa fa-search transition"></i> ','lambert'); ?></button>
	</form>
</div>