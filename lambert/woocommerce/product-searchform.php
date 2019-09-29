<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see     http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="searh-holder">
	<form role="search" method="get" class="search-form searh-inner" action="<?php echo esc_url( home_url( '/'  ) ); ?>">
		<input type="text" class="search" placeholder="<?php echo esc_attr_x( 'Search...', 'search product placeholder','lambert' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'search product', 'label','lambert' ) ?>"/>
		<button class="search-submit"  type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button','lambert' ) ?>"><?php _e('<i class="fa fa-search transition"></i> ','lambert'); ?></button>
		<input type="hidden" name="post_type" value="product" />
	</form>
</div>