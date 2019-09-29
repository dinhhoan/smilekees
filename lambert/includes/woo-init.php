<?php
/* banner-php */

if ( ! function_exists( 'lambert_is_woocommerce_activated' ) ) {
	function lambert_is_woocommerce_activated() {
		if ( class_exists( 'WooCommerce' ) ) { return true; } else { return false; }
	}
}



/**
 * Styles
 */
//add_filter( 'woocommerce_enqueue_styles', 	'__return_empty_array' );

/**
 * Layout
 * @see  cththemes_woo_before_content()
 * @see  cththemes_woo_after_content()
 * @see  woocommerce_breadcrumb()
 * @see  cththemes_woo_shop_messages()
 */
remove_action( 'woocommerce_before_main_content', 	'woocommerce_breadcrumb', 20, 0 );
remove_action( 'woocommerce_before_main_content', 	'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 	'woocommerce_output_content_wrapper_end', 10 );
remove_action( 'woocommerce_sidebar', 				'woocommerce_get_sidebar', 10 );
remove_action( 'woocommerce_after_shop_loop', 		'woocommerce_pagination', 10 );
remove_action( 'woocommerce_before_shop_loop', 		'woocommerce_result_count', 20 );
remove_action( 'woocommerce_before_shop_loop', 		'woocommerce_catalog_ordering', 30 );

add_action( 'woocommerce_before_main_content', 		'cththemes_woo_shop_header', 11 );
if(!function_exists('cththemes_woo_shop_header')){
	function cththemes_woo_shop_header(){
		
		?>
		<section class="parallax-section header-section shop-header-section">
            <div class="bg bg-parallax" style="background-image:url(<?php echo esc_url( lambert_global_var('shopbg','url',true) );?>)" data-top-bottom="transform: translateY(300px);" data-bottom-top="transform: translateY(-300px);"></div>
            <div class="overlay"></div>
            <div class="container">
            	<h1 class="breadcrumb-title"><?php 
				if(is_shop()){
					 echo get_the_title( wc_get_page_id( 'shop' ) );
				}elseif(is_page()){
					woocommerce_page_title(); 
				}elseif(is_single()){
					single_post_title( ); 
				}elseif(is_product_category()||is_product_tag()||is_category()||is_tag()||is_author()||is_date() ){
					the_archive_title();
				} ?></h1>
				<?php //do_action('cththemes_woo_breadcrumbs' );?>
            </div>
        </section>
        <?php 
	}
}

//sub header - bradcrumbs
add_action('cththemes_woo_breadcrumbs','woocommerce_breadcrumb', 10, 0 );

//products list container
add_action( 'woocommerce_before_main_content', 		'cththemes_woo_products_container', 12 );
if(!function_exists('cththemes_woo_products_container')){
	function cththemes_woo_products_container(){
		
		?>
		<section>
        	<div class="triangle-decor"></div>
            <div class="container">
				<div class="row">
					<?php if( lambert_get_option('shop_sidebar') === 'left') :?>
						
						<div class="col-md-3 left-sidebar">
							<aside>
								<?php do_action( 'cththemes_woo_sidebar' ); ?>
							</aside>
						</div><!-- .lef-sidebar -->

					<?php endif;?>

					<?php if( lambert_get_option('shop_sidebar') === 'none') :?>
						<div class="col-md-12">
					<?php else :?>
						<div class="col-md-9">
					<?php endif;?>
							
							<?php if(  lambert_get_option('shop_breadcrumbs') ) {
			            		do_action('cththemes_woo_breadcrumbs' );
			            	}
			            	if( lambert_get_option('shop_page_intro') != '' && is_shop() ){
			            		echo wp_kses_post(  lambert_get_option('shop_page_intro')  );
			            	}
			            	do_action('cththemes_woo_content_top' ); 

	}
}

add_action( 'woocommerce_before_main_content', 		'cththemes_woo_before_content', 10 );
/**
 * Before Content
 * Wraps all WooCommerce content in wrappers which match the theme markup
 * @since   1.0.0
 * @return  void
 */
if ( ! function_exists( 'cththemes_woo_before_content' ) ) {
	function cththemes_woo_before_content() {
		?>
		<div class="content">
	    	<?php
	}
}
//page title 
add_filter("woocommerce_show_page_title", '__return_false');



//products list container end
add_action( 'woocommerce_after_main_content', 		'cththemes_woo_products_container_end', 9 );
if(!function_exists('cththemes_woo_products_container_end')){
	function cththemes_woo_products_container_end(){
		
		?>
				<?php if( lambert_get_option('shop_sidebar') === 'none') :?>
					</div><!-- .col-md-12 -->
				<?php else :?>
					</div><!-- .col-md-9 -->
				<?php endif;?>
					
				<?php if( lambert_get_option('shop_sidebar') === 'right') :?>
					
					<div class="col-md-3 right-sidebar">
						<aside>
							<?php do_action( 'cththemes_woo_sidebar' ); ?>
						</aside>
					</div><!-- .right-sidebar -->

				<?php endif;?>
				</div><!-- .row -->	
			</div><!-- .container -->	
		</section>
        <?php 
	}
}
add_action( 'woocommerce_after_main_content', 		'cththemes_woo_after_content', 	10 );
/**
 * After Content
 * Closes the wrapping divs
 * @since   1.0.0
 * @return  void
 */
if ( ! function_exists( 'cththemes_woo_after_content' ) ) {
	function cththemes_woo_after_content() {
		?>
		</div><!-- .content -->

		<?php do_action( 'cththemes_woo_sidebar' );
	}
}


add_action( 'cththemes_woo_content_top', 			'woocommerce_catalog_ordering', 			10 );
add_action( 'woocommerce_after_shop_loop', 			'woocommerce_result_count', 				20 );
add_action( 'woocommerce_after_shop_loop', 			'woocommerce_pagination', 					30 );

/**
 * Products
 * @see  cththemes_woo_upsell_display()
 */

add_action('woocommerce_after_shop_loop_item_title', 'cththemes_woo_product_cat',11);
/**
 * Product Category
 */
function cththemes_woo_product_cat(){
	global $post, $product;

	echo wc_get_product_category_list($product->get_id(),'</li><li>', '<ul class="product-cats"><li>', '</li></ul>');
	
	//echo $product->get_categories( '</li><li>', '<ul class="product-cats"><li>', '</li></ul>' ); 
}
add_action( 'woocommerce_after_shop_loop_item', 'lambert_custom_price_add_to_cart' );
function lambert_custom_price_add_to_cart(){
	?>
	<div class="product-price">
		<?php do_action('lambert_custom_price_add_to_cart') ;?>
	</div>
<?php
}
remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price' , 10);
add_action('lambert_custom_price_add_to_cart','woocommerce_template_loop_price' );

remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart' , 10);
add_action('lambert_custom_price_add_to_cart','woocommerce_template_loop_add_to_cart');


remove_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail',10 );
add_action('woocommerce_before_shop_loop_item_title','cththemes_woo_template_loop_product_thumbnail',10 );
if ( ! function_exists( 'cththemes_woo_template_loop_product_thumbnail' ) ) {

	/**
	 * Get the product thumbnail for the loop.
	 *
	 * @subpackage	Loop
	 */
	function cththemes_woo_template_loop_product_thumbnail() {
		echo cththemes_woo_get_product_thumbnail();
	}
}
if(!function_exists('cththemes_woo_get_product_thumbnail')){
	/**
	 * Get the product thumbnail, or the placeholder if not set.
	 *
	 * @subpackage	Loop
	 * @param string $size (default: 'shop_catalog')//lambert size: blog-thumb
	 * @param int $placeholder_width (default: 0)
	 * @param int $placeholder_height (default: 0)
	 * @return string
	 */
	function cththemes_woo_get_product_thumbnail( $size = 'shop_catalog', $placeholder_width = 0, $placeholder_height = 0  ) {
		global $post;

		$image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );

		if ( has_post_thumbnail() ) {
			return get_the_post_thumbnail( $post->ID, $image_size, array('class'=>'responsive-img') );
		} elseif ( wc_placeholder_img_src() ) {
			return wc_placeholder_img( $size );
		}
	}
}
// remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );

//for shop product column layout - lambert
add_filter( 'loop_shop_columns', 						'cththemes_woo_woocommerce_loop_columns' );
/**
 * Default loop columns on product archives
 * @return integer products per row
 * @since  1.0.0
 */

if (!function_exists('cththemes_woo_woocommerce_loop_columns')) {
	function cththemes_woo_woocommerce_loop_columns() {
		
		if( '' != lambert_get_option('shop_columns') ){
			return lambert_get_option('shop_columns');
		}else{
			return 3; //bootstrap column number class - 4 products per row
		}
		
	}
}
add_filter( 'loop_shop_smcolumns', 						'cththemes_woo_woocommerce_loop_smcolumns' );
/**
 * Default loop columns on product archives on mobile device
 * @return integer products per row
 * @since  1.0.0
 */

if (!function_exists('cththemes_woo_woocommerce_loop_smcolumns')) {
	function cththemes_woo_woocommerce_loop_smcolumns() {
		
		if( '' != lambert_get_option('shop_smcolumns') ){
			return lambert_get_option('shop_smcolumns');
		}else{
			return 6; //bootstrap column number class - 2 products per row
		}
		
	}
}
// sidebar
add_action('cththemes_woo_sidebar', 'woocommerce_get_sidebar', 10);
/*
* Product
*
*/
remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating',10 );
remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10 );
//Description Tab - Hide Heading
// add_filter('woocommerce_product_description_heading','__return_empty_string' );

add_action('woocommerce_single_product_summary','cththemes_woo_product_before_price',10 );
if(!function_exists('cththemes_woo_product_before_price')){
	function cththemes_woo_product_before_price(){
		?>
		<div class="pr-opt">
        <?php 
	}
}
add_action('woocommerce_single_product_summary','woocommerce_template_single_price',10 );
add_action('woocommerce_single_product_summary','woocommerce_template_single_rating',10 );
add_action('woocommerce_single_product_summary','cththemes_woo_product_after_rating',10 );
if(!function_exists('cththemes_woo_product_after_rating')){
	function cththemes_woo_product_after_rating(){
		?>
		</div>
        <?php 
	}
}
add_action('woocommerce_single_product_summary','cththemes_woo_clearfix',10 );
if(!function_exists('cththemes_woo_clearfix')){
	function cththemes_woo_clearfix(){
		?>
		<div class="clearfix"></div>
        <?php 
	}
}
add_filter('woocommerce_short_description', 'cththemes_woo_product_short_description',1);
if(!function_exists('cththemes_woo_product_short_description')){
	function cththemes_woo_product_short_description($des){

		if(!empty($des)){
			?>
			<h4 class="product-short-description-title"><?php _e('Quick Overview','lambert');?></h4>
		<?php 
			echo wp_kses_post($des );
		}
	}
}
//remove_action( 'woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20 );

/**
 * Header
 * @see  cththemes_woo_product_search()
 * @see  cththemes_woo_header_cart()
 */
/**
 * Filters
*/
add_filter('woocommerce_output_related_products_args','cththemes_woo_product_single_related_products_args');
/* product related args */
if(!function_exists('cththemes_woo_product_single_related_products_args')){
	function cththemes_woo_product_single_related_products_args($args = array()){
		/*$args = array(
			'posts_per_page' => 2,
			'columns' => 2,
			'orderby' => 'rand'
		);*/
		
		if(!is_array($args)||empty($args)){
			$args = array(
				'posts_per_page' => 3,
				'columns' => 4,
				'orderby' => 'rand'
			);
		}else{
			if( lambert_get_option('shop_columns') ){
				$args['columns'] = lambert_get_option('shop_columns');
			}else{
				$args['columns'] = 4;
			}
			if( lambert_get_option('related_products_count') ){
				$args['posts_per_page'] = lambert_get_option('related_products_count');
			}else{
				$args['posts_per_page'] = 3;
			}
		}
		
		return $args;

	}
}

// Cart page
// add_filter('woocommerce_cross_sells_columns','cththemes_woo_woocommerce_loop_columns' );
// remove_action('woocommerce_proceed_to_checkout','woocommerce_button_proceed_to_checkout', 20 );
// add_action('woocommerce_proceed_to_checkout','cththemes_woo_button_proceed_to_checkout', 20 );
if(!function_exists('cththemes_woo_button_proceed_to_checkout')){
	/**
	 * Output the proceed to checkout button.
	 *
	 * @subpackage	Cart
	 */
	function cththemes_woo_button_proceed_to_checkout() {
		$checkout_url = WC()->cart->get_checkout_url();

		?>
			<a href="<?php echo esc_url(wc_get_page_permalink( 'shop' ) );?>" class="button alt"><?php _e( 'Countinue shopping', 'lambert' ); ?></a>
			<a href="<?php echo esc_url( $checkout_url ); ?>" class="button checkout-button wc-forward"><?php _e( 'Proceed to Checkout', 'lambert' ); ?></a>
		<?php
	}
}
//add_action( 'woocommerce_share', 'cththemes_woo_patricks_woocommerce_social_share_icons', 10 );

// new update
// remove_action('woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open',10 );
// remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_product_link_close',5 );


