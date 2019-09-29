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
        <?php if(lambert_global_var('show_loader') == 'yes'):?>
        <div class="loader lambert-loader" id="lambert-loader"><img src="<?php echo esc_url(lambert_global_var('loader_icon','url',true));?>" alt="loader icon"></div>
        <div id="main">
        <?php else :?>
        <div id="main" class="hide-loader">
        <?php endif;?> 
            <header class="mainpage-header">
                <div class="header-inner">
                    <div class="container">
                        <div class="nav-social">
                            <?php 
                            if(is_active_sidebar('top_social_widget')){
                                dynamic_sidebar('top_social_widget');
                            }
                            ?>
                        </div>            
                        <div class="logo-holder">
                            <a href="<?php echo esc_url(home_url('/'));?>">
                                <?php if(lambert_global_var('logo','url',true)):?>
                                    <img src="<?php echo esc_url(lambert_global_var('logo','url',true));?>"  
                                    <?php if(lambert_global_var('logo_size_width')):?> 
                                     width="<?php echo esc_attr(lambert_global_var('logo_size_width'));?>"
                                    <?php endif;?>
                                    <?php if(lambert_global_var('logo_size_height')):?> 
                                     height="<?php echo esc_attr(lambert_global_var('logo_size_height'));?>"
                                    <?php endif;?>
                                     class="responsive-img logo-vis" alt="<?php bloginfo('name');?>" />
                                <?php endif;?>
                                <?php if(lambert_global_var('logo2','url',true)):?>
                                    <img src="<?php echo esc_url(lambert_global_var('logo2','url',true));?>" 
                                    <?php if(lambert_global_var('logo_size_width')):?> 
                                     width="<?php echo esc_attr(lambert_global_var('logo_size_width'));?>"
                                    <?php endif;?>
                                    <?php if(lambert_global_var('logo_size_height')):?> 
                                     height="<?php echo esc_attr(lambert_global_var('logo_size_height'));?>"
                                    <?php endif;?>
                                     class="responsive-img logo-notvis" alt="<?php bloginfo('name');?>" />
                                <?php endif;?>
                                <?php if(lambert_global_var('logo_text')):?>
                                    <h1 class="logo_text"><?php echo esc_html(lambert_global_var('logo_text'));?></h1>
                                <?php endif;?>
                                <?php if(lambert_global_var('slogan')):?>
                                    <h3 class="slogan"><em><?php echo esc_html(lambert_global_var('slogan'));?></em></h3>
                                <?php endif;?>

                            </a>
                        </div>
                        <?php 
                        if ( lambert_is_woocommerce_activated() ) {
                            global $woocommerce;
                            $my_cart_count = $woocommerce->cart->cart_contents_count;
                            if($my_cart_count > 0){
                                $url = wc_get_page_permalink( 'cart' );
                            }else{
                                $url = wc_get_page_permalink( 'shop' );
                            }

                        ?>
                        <div class="subnav cart-num">
                            <a href="<?php echo esc_url($url );?>"><i class="fa fa-shopping-cart"></i>( <span><?php echo esc_html($my_cart_count );?></span> )</a>
                        </div>
                        
                        <?php 
                        }
                        ?>
                        <div class="nav-holder">
                            <nav class="main_navigation">
                                <?php 
                                    $defaults1= array(
                                        'theme_location'  => 'primary',
                                        'menu'            => '',
                                        'container'       => '',
                                        'container_class' => '',
                                        'container_id'    => '',
                                        'menu_class'      => 'lambert_main-nav',
                                        'menu_id'         => '',
                                        'echo'            => true,
                                        'fallback_cb'     => 'wp_page_menu ',
                                        'walker'          => new Walker_Nav_Menu(),
                                        'before'          => '',
                                        'after'           => '',
                                        'link_before'     => '',
                                        'link_after'      => '',
                                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                        'depth'           => 0,
                                    );
                                    
                                    if ( has_nav_menu( 'primary' ) ) {
                                        wp_nav_menu( $defaults1 );
                                    }
                                ?>
                            </nav>
                        </div>
                    </div>
                </div>
            </header>
            <div id="wrapper">

                    