<?php
/**
 * @package Lambert - Restaurant / Cafe / Pub WordPress Theme
 * @author Cththemes - http://themeforest.net/user/cththemes
 * @date: 28-08-2019
 *
 * @copyright  Copyright ( C ) 2014 - 2015 cththemes.com . All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

if(!function_exists('lambert_hex2rgb')){
    function lambert_hex2rgb($hex) {
        $hex = str_replace("#", "", $hex);
        
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } 
        else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        $rgb = array($r, $g, $b);
        return $rgb;
    }
}
if(!function_exists('lambert_colourBrightness')){
    /*
    * $hex = '#ae64fe';
    * $percent = 0.5; // 50% brighter
    * $percent = -0.5; // 50% darker
    */
    function lambert_colourBrightness($hex, $percent) {
        // Work out if hash given
        $hash = '';
        if (stristr($hex,'#')) {
            $hex = str_replace('#','',$hex);
            $hash = '#';
        }
        /// HEX TO RGB
        $rgb = lambert_hex2rgb($hex);
        //// CALCULATE 
        for ($i=0; $i<3; $i++) {
            // See if brighter or darker
            if ($percent > 0) {
                // Lighter
                $rgb[$i] = round($rgb[$i] * $percent) + round(255 * (1-$percent));
            } else {
                // Darker
                $positivePercent = $percent - ($percent*2);
                $rgb[$i] = round($rgb[$i] * $positivePercent) + round(0 * (1-$positivePercent));
            }
            // In case rounding up causes us to go to 256
            if ($rgb[$i] > 255) {
                $rgb[$i] = 255;
            }
        }
        //// RBG to Hex
        $hex = '';
        for($i=0; $i < 3; $i++) {
            // Convert the decimal digit to hex
            $hexDigit = dechex($rgb[$i]);
            // Add a leading zero if necessary
            if(strlen($hexDigit) == 1) {
            $hexDigit = "0" . $hexDigit;
            }
            // Append to the hex string
            $hex .= $hexDigit;
        }
        return $hash.$hex;
    }
}
if(!function_exists('lambert_stripWhitespace')){
    /**
     * Strip whitespace.
     *
     * @param  string $content The CSS content to strip the whitespace for.
     * @return string
     */
    function lambert_stripWhitespace($content)
    {
        // remove leading & trailing whitespace
        $content = preg_replace('/^\s*/m', '', $content);
        $content = preg_replace('/\s*$/m', '', $content);

        // replace newlines with a single space
        $content = preg_replace('/\s+/', ' ', $content);

        // remove whitespace around meta characters
        // inspired by stackoverflow.com/questions/15195750/minify-compress-css-with-regex
        $content = preg_replace('/\s*([\*$~^|]?+=|[{};,>~]|!important\b)\s*/', '$1', $content);
        $content = preg_replace('/([\[(:])\s+/', '$1', $content);
        $content = preg_replace('/\s+([\]\)])/', '$1', $content);
        $content = preg_replace('/\s+(:)(?![^\}]*\{)/', '$1', $content);

        // whitespace around + and - can only be stripped in selectors, like
        // :nth-child(3+2n), not in things like calc(3px + 2px) or shorthands
        // like 3px -2px
        $content = preg_replace('/\s*([+-])\s*(?=[^}]*{)/', '$1', $content);

        // remove semicolon/whitespace followed by closing bracket
        $content = preg_replace('/;}/', '}', $content);

        return trim($content);
    }

}

if(!function_exists('lambert_overridestyle')){
	function lambert_overridestyle(){
		

		$inline_style = '
.nav-separator:before , 
.nav-separator:after , 
nav:after , 
.bold-separator:before , 
.bold-separator:after , 
#submit:hover , 
.to-top-holder:before , 
.ic__days .ic__day_state_current , 
.ic__days .ic__day_state_selected  , 
.ic__days .ic__day:hover  ,   
.scroll-nav li a.actscroll:before ,  
.scroll-nav ul:before, 
.scroll-nav ul:after , 
footer:after  , 
.hot-desc  , 
.content-pagination a.current-page , 
.content-pagination a:hover , 
.shopping-cart-link-count  , 
.quantity input.qty , 
.order-count   , 
.hero-title h4:before , 
.hero-title h4:after , 
.current-page , 
.pagination a:hover,
.pagination span,
.product-images-wrapp .onsale,
.product-cat-mains span.onsale,
.content-pagination .page-numbers.current,
.widget #wp-subscribe input.submit,
.woocommerce .widget_price_filter .ui-slider .ui-slider-range,
.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
.cart_list.product_list_widget li .remove:hover,
.woocommerce ul.products li.product .onsale,
.woocommerce nav.woocommerce-pagination ul li span.current,
.woocommerce nav.woocommerce-pagination ul li a:hover,
.lambert_subscribe .subscribe-button {
    background:'.lambert_get_option('theme-skin-color').';
}
.widget a:hover,
span.wpcf7-not-valid-tip,
nav li  a.act-link ,
.main_navigation ul ul li a.act-link, 
nav li  a:hover , 
.nav-social h3  , 
.nav-social li a:hover  , 
.parallax-section h3 , 
.section-title h3 , 
.team-slider h3 , 
.footer-widgets .widget-title,
#submit , 
.to-top , 
#submit-res , 
.link , 
.tooltip , 
.hero-link a:hover  , 
.to-top-holder p span , 
.twitter-feed-id li a , 
.twitter-holder  .customNavigation a:hover , 
#subscribe  .subscribe-button , 
.twitter-holder  .customNavigation a.twit-link   , 
.footer-social h3 , 
.footer-contacts li a:hover , 
.footer-social ul li a:hover , 
.subscribe-message i , 
.section-icon  , 
.testimonials-holder h4 a ,  
.testi-item h4 a,
.chefinfo , 
.team-social  li a:hover , 
.team-modal h5 , 
.popup-modal-dismiss:hover , 
.promotion-price , 
.big-number a , 
.testimonials-holder .customNavigation a:hover , 
.testimonials-slider ul li , 
.testi-item ul li , 
.menu-item a:hover , 
.mn-menu-item a:hover , 
.product-cats li a , 
.product-price a , 
.shopping-cart-link   , 
.subnav a:hover span  , 
.product-rating  , 
.product-item-price del span ,  
.quantity a , 
.product-meta span a ,
.product_meta span a ,
.tabs-menu .current a   , 
.order-money ,  
/*.product-name a:hover  , 
.product-name , */
.coupon-holder button:hover , 
.cart-totals  button , 
.search-submit , 
.post-tags li a:hover, 
.tagcloud li a:hover , 
.post-link:hover , 
.slides-navigation a:hover , 
.post-meta i , 
.gallery-filters  a.gallery-filter-active , 
.box-item i , 
.fullheight-carousel-holder .customNavigation a:hover , 
.carousel-link-holder  h4 , 
#success_page p strong,
.woocommerce .page-title,
.woocommerce-review-link,
.star-rating,
.star-1:after,.star-2:after,.star-3:after,.star-4:after,.star-5:after,
.woocommerce .star-rating:before,
.woocommerce-product-rating,
.woocommerce .woocommerce-product-rating .star-rating:before,
.quantity button,
.woocommerce-breadcrumb a,
.cart-table span.amount,
.cart-table .cart-product a,
.woocommerce-shipping-calculator a,
.cart_totals section.shipping-calculator-form p button:hover,
.cart_totals section.shipping-calculator-form p button:focus,
.cart_totals  a.button,
.cart_totals  a.button.alt:hover,
body.woocommerce-checkout .woocommerce-info a,
.login_submit:hover,
.lost_password a ,
.woocommerce #payment #place_order,
blockquote a,
.media-heading a:hover,
.reservation-form #message,
.cart_list.product_list_widget li .remove,
.cart_list.product_list_widget .quantity .amount,
p.total .amount,
.fourofour p a ,
.woocommerce-message a,
.woocommerce .widget_shopping_cart .buttons a:hover, .woocommerce.widget_shopping_cart .buttons a:hover,
.woocommerce div.product form.cart .button,
.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
.footer-widgets:nth-child(2) h3.widget-title
{
    color:'.lambert_get_option('theme-skin-color').';
}
.cart_list.product_list_widget li .remove {
    color:'.lambert_get_option('theme-skin-color').' !important;
}
.cart_list.product_list_widget li .remove:hover{
    color:#fff !important;
}
.fourofour p a {border-color:'.lambert_get_option('theme-skin-color').';}
.hot-deal:before {
    border:2px  solid '.lambert_get_option('theme-skin-color').';
}
.team-modal:before  , .half-circle{
    border:4px  double '.lambert_get_option('theme-skin-color').';
}
.half-circle {
     border:3px  solid '.lambert_get_option('theme-skin-color').';}
footer.footer-main {background-color:'.lambert_get_option('footer-bg-color').';}
.to-top-holder {background-color:'.lambert_get_option('footer-copy-bg-color').';}
.overlay {background-color:'.lambert_get_option('overlay-bg-color').';}
article.sticky {padding: 10px;border: 2px solid '.lambert_get_option('theme-skin-color').';}
';

        
        // Remove whitespace
        $inline_style = lambert_stripWhitespace($inline_style);

        return $inline_style;

	}
}
