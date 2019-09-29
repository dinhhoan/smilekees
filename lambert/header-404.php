<?php
/* banner-php */

 ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
    <head>
        <meta charset="<?php bloginfo( 'charset' ); ?>"/>
        <link rel="profile" href="//gmpg.org/xfn/11" />
        <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">   
        <?php if ( lambert_global_var('favicon','url',true) != '' && ( false == function_exists( 'has_site_icon' ) || false == has_site_icon() ) ) { ?>
        <!-- Favicon -->        
        <link rel="shortcut icon" href="<?php echo esc_url( lambert_global_var('favicon','url',true) );?>" type="image/x-icon"/>
        <?php } ?>
        <?php    
    
        wp_head(); ?>
        
    </head>
    <body <?php body_class(  );?>>
        