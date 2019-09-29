<?php
/* banner-php */

/**
 * Woocommerce support
 *
 */

if ( ! function_exists( 'lambert_is_woocommerce_activated' ) ) {
    function lambert_is_woocommerce_activated() {
        if ( class_exists( 'WooCommerce' ) ) { return true; } else { return false; }
    }
}