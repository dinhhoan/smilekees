<?php
/* banner-php */

if ( version_compare( $GLOBALS['wp_version'], '5.0', '<' ) ) {
    require get_template_directory() . '/includes/back-compat.php';
    return;
}

if ( file_exists(get_template_directory() . '/includes/redux-configs.php')) {
    require_once get_template_directory() . '/includes/redux-configs.php';
}

$old_theme_version = wp_get_theme()->get( 'Version' );
if( version_compare( $old_theme_version, '2.5.1', '<' ) ){
    $old_theme_option = get_option( 'cththemes_options', false );
    if( !empty( $old_theme_option ) ){
        update_option( 'lambert_options', $old_theme_option );
        delete_option( 'cththemes_options' );
    } 
}


if(!isset($lambert_options)) $lambert_options = get_option( 'lambert_options', array() );


/*  Add responsive container to embeds
/* ------------------------------------ */ 
function lambert_embed_html( $html ) {
    return '<div class="responsive-video">' . $html . '</div>';
}
 
//add_filter( 'embed_oembed_html', 'lambert_embed_html', 10, 3 );
add_filter( 'video_embed_html', 'lambert_embed_html' );


if(!function_exists('lambert_content_width')){
    /**
     * Sets the content width in pixels, based on the theme's design and stylesheet.
     *
     * Priority 0 to make it available to lower priority callbacks.
     *
     * @global int $content_width
     *
     * 
     */
    function lambert_content_width() {
        $GLOBALS['content_width'] = apply_filters( 'lambert_content_width', 750 );
    }
    add_action( 'after_setup_theme', 'lambert_content_width', 0 );

}


//navigation modified
add_filter('nav_menu_css_class', 'lambert_nav_menu_css_class_func', 10, 2);
$link_class = array();
function lambert_nav_menu_css_class_func($classes, $item) {
    global $link_class;
    $link_class = array();
    $act_link_key = array_search("act-link", $classes);
    if ($act_link_key !== false) {
        $link_class[] = 'act-link';
        unset($classes[$act_link_key]);
    }
    $external_key = array_search("external", $classes);
    if ($external_key !== false) {
        $link_class[] = 'external';
        unset($classes[$external_key]);
    }
    $current_key = array_search("current-menu-item", $classes);
    if ($current_key !== false) {
        $link_class[] = 'act-link';
    }
    $current_ancestor_key = array_search("current-menu-ancestor", $classes);
    if ($current_ancestor_key !== false) {
        $link_class[] = 'act-link';
    }
    return $classes;
}
add_filter('nav_menu_link_attributes', 'lambert_nav_menu_link_attributes_func', 10, 3);

function lambert_nav_menu_link_attributes_func($atts, $item, $args) {
    global $link_class;
    if (!empty($link_class)) {
        $atts['class'] = implode(" ", $link_class);
    }
    
    return $atts;
}

/**
 * Count number of widgets in a sidebar
 * Used to add classes to widget areas so widgets can be displayed one, two, three or four per row
 */
function cththemes_slbd_count_widgets( $sidebar_id ) {
    // If loading from front page, consult $_wp_sidebars_widgets rather than options
    // to see if wp_convert_widget_settings() has made manipulations in memory.
    global $_wp_sidebars_widgets;
    if ( empty( $_wp_sidebars_widgets ) ) :
        $_wp_sidebars_widgets = get_option( 'sidebars_widgets', array() );
    endif;
    
    $sidebars_widgets_count = $_wp_sidebars_widgets;
    
    if ( isset( $sidebars_widgets_count[ $sidebar_id ] ) ) :
        $widget_count = count( $sidebars_widgets_count[ $sidebar_id ] );
        $widget_classes = 'widget-count-' . count( $sidebars_widgets_count[ $sidebar_id ] );
        if ( $widget_count % 6 == 0 && $widget_count >= 6 ) :
            // Six widgets er row if there are exactly four or more than six
            $widget_classes .= ' col-md-2';
        elseif ( $widget_count % 4 == 0 && $widget_count >= 4 ) :
            // Four widgets er row if there are exactly four or more than six
            $widget_classes .= ' col-md-3';
        elseif ( $widget_count % 3 == 0 && $widget_count >= 3 ) :
            // Three widgets per row if there's three or more widgets 
            $widget_classes .= ' col-md-4';
        elseif ( 2 == $widget_count ) :
            // Otherwise show two widgets per row
            $widget_classes .= ' col-md-6';
        elseif ( 1 == $widget_count ) :
            // Otherwise show two widgets per row
            $widget_classes .= ' col-md-12';
        endif; 

        return $widget_classes;
    endif;
}

/* Register Sidebars */
function lambert_register_sidebars() {
    
    register_sidebar(
        array(
            'name' => __('Main Sidebar', 'lambert'), 
            'id' => 'sidebar-1', 
            'description' => __('Appears in the sidebar section of the site.', 'lambert'), 
            'before_widget' => '<div id="%1$s" class="widget %2$s">', 
            'after_widget' => '</div>', 
            'before_title' => '<h3 class="widget-title">', 
            'after_title' => '</h3>',
        )
    );
    
    register_sidebar(
        array(
            'name' => __('Page Sidebar', 'lambert'), 
            'id' => 'sidebar-2', 
            'description' => __('Appears in the sidebar section of the page template.', 'lambert'), 
            'before_widget' => '<div id="%1$s" class="widget cth %2$s">', 
            'after_widget' => '</div>', 
            'before_title' => '<h3 class="widget-title">', 
            'after_title' => '</h3>',
        )
    );
    
    register_sidebar(
        array(
            'name' => __('Shop Page Sidebar', 'lambert'), 
            'id' => 'sidebar-shop', 
            'description' => __('Appears in the sidebar section on shop pages.', 'lambert'), 
            'before_widget' => '<div id="%1$s" class="widget cth-widget %2$s">', 
            'after_widget' => '</div>', 
            'before_title' => '<h3 class="widget-title">', 
            'after_title' => '</h3>',
        )
    );
    register_sidebar(
        array(
            'name' => __('Top Social Widget', 'lambert'), 
            'id' => 'top_social_widget', 
            'description' => __('Appears in top social widget, above main navigation menu', 'lambert'), 
            'before_widget' => '<div id="%1$s" class="widget %2$s">', 
            'after_widget' => '</div>', 
            'before_title' => '<h3 class="widget-title">', 
            'after_title' => '</h3>',
        )
    );
    register_sidebar(
        array(
            'name' => __('Footer Widgets Widget', 'lambert'), 
            'id' => 'footer_widgets_widget', 
            'description' => __('Appears above footer contact info widget', 'lambert'), 
            'before_widget' => '<div id="%1$s" class="widget footer-widgets %2$s '. cththemes_slbd_count_widgets( 'footer_widgets_widget' ) .'">', 
            'after_widget' => '</div>', 
            'before_title' => '<h3 class="widget-title">', 
            'after_title' => '</h3>',
        )
    );
    register_sidebar(
        array(
            'name' => __('Footer Contact Info Widget', 'lambert'), 
            'id' => 'footer_contacts_widget', 
            'description' => __('Appears above footer copyright text', 'lambert'), 
            'before_widget' => '<div id="%1$s" class="widget %2$s">', 
            'after_widget' => '</div>', 
            'before_title' => '<h3 class="widget-title">', 
            'after_title' => '</h3>',
        )
    );
    register_sidebar(
        array(
            'name' => __('Footer Copyright Widget', 'lambert'), 
            'id' => 'footer_copyright_widget', 
            'description' => __('Appears above footer copyright text', 'lambert'), 
            'before_widget' => '<div id="%1$s" class="widget %2$s">', 
            'after_widget' => '</div>', 
            'before_title' => '<h3 class="widget-title">', 
            'after_title' => '</h3>',
        )
    );
    register_sidebar(
        array(
            'name' => __('OpenTable Widget', 'lambert'), 
            'id' => 'opentable_widget', 
            'description' => __('Please inset OpenTable widget here then use Widgetised Sidebar - Visual Composer component to insert OpenTable Reservation form to your page.', 'lambert'), 
            'before_widget' => '<div id="%1$s" class="widget cth_opentable_widget %2$s">', 
            'after_widget' => '</div>', 
            'before_title' => '<h3 class="widget-title">', 
            'after_title' => '</h3>',
        )
    );
}

add_action('widgets_init', 'lambert_register_sidebars');
if(!function_exists('lambert_theme_setup')){
    function lambert_theme_setup() {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         */
        load_theme_textdomain( 'lambert', get_template_directory() . '/languages' );

        // Add default posts and comments RSS feed links to head.
        add_theme_support( 'automatic-feed-links' );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support( 'title-tag' );

        
        add_theme_support('post-thumbnails');

        lambert_get_thumbnail_sizes();

        // Set the default content width.
        $GLOBALS['content_width'] = apply_filters( 'lambert_content_width', 750 );  

        // This theme uses wp_nav_menu() in one location.
        register_nav_menu('primary', __('Main Navigation Menu', 'lambert'));
        register_nav_menu('onepage', __('One Page Navigation Menu', 'lambert'));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support( 'post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
            'gallery',
            'audio',
        ) );

        // Add theme support for Custom Logo.
        add_theme_support( 'custom-logo', array(
            'width'       => 150,
            'height'      => 60,
            'flex-width'  => true,
            'flex-height' => true,
            'header-text' => array( 'site-title', 'site-description' ),

        ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support( 'customize-selective-refresh-widgets' );

        // from version 2.0
        // add_theme_support( 'woocommerce' );
        // add_theme_support( 'wc-product-gallery-zoom' );
        //add_theme_support( 'wc-product-gallery-lightbox' );
        //add_theme_support( 'wc-product-gallery-slider' );

        add_theme_support( 'woocommerce', array(
            'thumbnail_image_width' => esc_attr_x( '300', 'WooCommerce thumbnail width', 'lambert' ),
            'single_image_width'    => esc_attr_x( '500', 'WooCommerce single image width', 'lambert' ),

            'product_grid'          => array(
                'default_rows'    => 3,
                'min_rows'        => 2,
                'max_rows'        => 8,
                'default_columns' => 4,
                'min_columns'     => 2,
                'max_columns'     => 5,
            ),
        ) );
        add_theme_support( 'wc-product-gallery-zoom' );
        // add_theme_support( 'wc-product-gallery-lightbox' );
        add_theme_support( 'wc-product-gallery-slider' );
        
        add_filter('use_default_gallery_style', '__return_false');

        /*
         * This theme styles the visual editor to resemble the theme style,
         * specifically font, colors, and column width.
         */
        add_editor_style( array( 'assets/css/editor-style.css', lambert_google_fonts_url() ) );

    }
}


add_action('after_setup_theme', 'lambert_theme_setup');

if(!function_exists('lambert_get_thumbnail_sizes')){
    function lambert_get_thumbnail_sizes(){
        // options default must have these values
        if( false == lambert_get_option('enable_custom_sizes') ) return;
        $option_sizes = array(
            'lambert-gallery-one'       =>'galmasonry_thumbnail_size_one',
            'lambert-gallery-second'    =>'galmasonry_thumbnail_size_two',
            'lambert-gallery-three'     =>'galmasonry_thumbnail_size_three',

            'lambert-thumb'             =>'blog_image_thumb',
            'lambert-large'             =>'blog_image_large_thumb',
            'member-thumb'              =>'team_member_thumb',
            
        );

        foreach ($option_sizes as $name => $opt) {
            $option_size = lambert_get_option($opt);
            if($option_size !== false && is_array($option_size)){
                $size_val = array(
                    'width' => (isset($option_size['width']) && !empty($option_size['width']) )? (int)$option_size['width'] : (int)'9999',
                    'height' => (isset($option_size['height']) && !empty($option_size['height']) )? (int)$option_size['height'] : (int)'9999',
                    'hard_crop' => (isset($option_size['hard_crop']) && !empty($option_size['hard_crop']) )? (bool)$option_size['hard_crop'] : (bool)'0',
                );

                add_image_size( $name, $size_val['width'], $size_val['height'], $size_val['hard_crop'] );
            }
        }
    }
}



if(!function_exists('lambert_theme_scripts_styles')){
    function lambert_theme_scripts_styles() {
        
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }

        if( '' != lambert_get_option('gmap_api_key') ){
            wp_enqueue_script("lambert-gmap", "https://maps.google.com/maps/api/js?key=".lambert_get_option('gmap_api_key'),array(),null,true);
        }
        
        wp_enqueue_script("lambert-plugins", get_template_directory_uri() . "/assets/js/plugins.js", array('jquery'), null, true);
        wp_enqueue_script("lambert-scripts", get_template_directory_uri() . "/assets/js/scripts.js", array('imagesloaded'), null, true);
        
        
        wp_enqueue_style('lambert-google-fonts', lambert_google_fonts_url(), array(), null); 

        
        wp_enqueue_style('lambert-plugins', get_template_directory_uri() . '/assets/css/plugins.css', array(), null);
        wp_enqueue_style('lambert-theme-style', get_stylesheet_uri(), array(), null);
        if (lambert_is_woocommerce_activated()) {
            wp_enqueue_style('lambert-woo', get_template_directory_uri() . '/assets/css/woocommerce.css', array(), null);
        }
        
        wp_enqueue_style('lambert-responsive', get_template_directory_uri() . '/assets/css/responsive.css', array(), null);

        if ( lambert_get_option('override-preset') ) {
           
            $inline_style = lambert_overridestyle();
            if(!empty($inline_style)){
                wp_add_inline_style('lambert-responsive', $inline_style);
            }  

        }else{
            wp_enqueue_style('lambert-color', get_template_directory_uri() . '/assets/skins/'.lambert_get_option('color-preset').'.css', array(), null);
            //wp_enqueue_style('lambert-custom', get_template_directory_uri() . '/css/custom.css', array(), null);
        }

        wp_enqueue_style('lambert-custom', get_template_directory_uri() . '/assets/css/custom.css', array(), null);

        $inline_custom_style = trim( lambert_get_option('custom-css') );

        if( '' != lambert_get_option('custom-css-medium') ){
            $inline_custom_style .= '@media only screen and  (max-width: 992px){'.trim( lambert_get_option('custom-css-medium') ).'}';
        }
        if( '' != lambert_get_option('custom-css-tablet') ){
            $inline_custom_style .= '@media only screen and  (max-width: 768px){'.trim( lambert_get_option('custom-css-tablet') ).'}';
        }
        if( '' != lambert_get_option('custom-css-mobile') ){
            $inline_custom_style .= '@media only screen and  (max-width: 540px){'.trim( lambert_get_option('custom-css-mobile') ).'}';
        }
        
        if (!empty($inline_custom_style)) {
            wp_add_inline_style('lambert-custom', lambert_stripWhitespace($inline_custom_style) );
        }


        
    }
}
add_action('wp_enqueue_scripts', 'lambert_theme_scripts_styles');




if ( ! function_exists( 'lambert_google_fonts_url' ) ) {
    /**
     * Register Google fonts.
     *
     * @return string Google fonts URL for the theme.
     */
    function lambert_google_fonts_url() {
        $fonts_url = '';
        $fonts     = array();
        $subsets   = 'latin,latin-ext';

        if ( 'off' !== esc_html_x( 'on', 'Source Sans Pro font: on or off', 'lambert' ) ) {
            $fonts[] = 'Source+Sans+Pro:400,700,900';
        }
        if ( 'off' !== esc_html_x( 'on', 'Cabin font: on or off', 'lambert' ) ) {
            $fonts[] = 'Cabin:400,700';
        }
        if ( 'off' !== esc_html_x( 'on', 'Droid Serif font: on or off', 'lambert' ) ) {
            $fonts[] = 'Droid+Serif:400,700';
        }
        if ( 'off' !== esc_html_x( 'on', 'Playball font: on or off', 'lambert' ) ) {
            $fonts[] = 'Playball';
        }

        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urlencode( implode( '|', $fonts ) ),
                'subset' => urlencode( $subsets ),
            ), 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;

    }

}


if(!function_exists('lambert_breadcrumbs')){
    function lambert_breadcrumbs() {
          
        // Settings
        $separator          = __('/','lambert');//'&gt;';
        $breadcrums_id      = 'breadcrumbs';
        $breadcrums_class   = 'breadcrumbs';
        $home_title         = __('Home','lambert');
        $blog_title         = __('Our Blog','lambert');
         
        // If you have any custom post types with custom taxonomies, put the taxonomy name below (e.g. product_cat)
        $custom_taxonomy    = 'product_cat,skill';
          
        // Get the query & post information
        global $post,$wp_query;
          
        // Do not display on the homepage
        if ( !is_front_page() ) {
          
            // Build the breadcrums
            echo '<ul id="' . esc_attr($breadcrums_id ) . '" class="' . esc_attr($class ) . '">';
              
            // Home page
            echo '<li class="item-home"><a class="bread-link bread-home" href="' . get_home_url() . '" title="' . esc_attr($home_title ) . '">' . esc_attr($home_title ) . '</a></li>';
            echo '<li class="separator separator-home"> ' . esc_html($separator ) . ' </li>';

            if(is_home()){
                // Blog page
                echo '<li class="item-current item-blog"><strong class="bread-current item-blog">' . esc_attr($blog_title ) . '</strong></li>';
            }
              
            if ( is_archive() && !is_tax() ) {
                 
                echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . get_the_archive_title() . '</strong></li>'; //post_type_archive_title($prefix, false)
                 
            } else if ( is_archive() && is_tax() ) {
                 
                // If post is a custom post type
                $post_type = get_post_type();
                 
                // If it is a custom post type display name and link
                if($post_type != 'post') {
                     
                    $post_type_object = get_post_type_object($post_type);
                    $post_type_archive = get_post_type_archive_link($post_type);
                 
                    echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                    echo '<li class="separator"> ' . $separator . ' </li>';
                 
                }
                 
                $custom_tax_name = get_queried_object()->name;
                echo '<li class="item-current item-archive"><strong class="bread-current bread-archive">' . $custom_tax_name . '</strong></li>';
                 
            } else if ( is_single() ) {
                 
                // If post is a custom post type
                $post_type = get_post_type();
                 
                // If it is a custom post type display name and link
                if($post_type != 'post') {
                     
                    $post_type_object = get_post_type_object($post_type);
                    $post_type_archive = get_post_type_archive_link($post_type);

                 
                    echo '<li class="item-cat item-custom-post-type-' . $post_type . '"><a class="bread-cat bread-custom-post-type-' . $post_type . '" href="' . $post_type_archive . '" title="' . $post_type_object->labels->name . '">' . $post_type_object->labels->name . '</a></li>';
                    echo '<li class="separator"> ' . $separator . ' </li>';

                }
                    // Get post category info
                    $category = get_the_category();
                     
                    // Get last category post is in
                    $last_category = '';
                    if($category){
                        $last_category = end(array_values($category));
                     
                        // Get parent any categories and create array
                        $get_cat_parents = rtrim(get_category_parents($last_category->term_id, true, ','),',');
                        $cat_parents = explode(',',$get_cat_parents);
                         
                        // Loop through parent categories and store in variable $cat_display
                        $cat_display = '';
                        foreach($cat_parents as $parents) {
                            $cat_display .= '<li class="item-cat">'.$parents.'</li>';
                            $cat_display .= '<li class="separator"> ' . $separator . ' </li>';
                        }
                    }
                    
                    if(!empty($last_category)) {
                        echo wp_kses_post( $cat_display );
                        echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                         
                    // Else if post is in a custom taxonomy
                    }
                     
                    // If it's a custom post type within a custom taxonomy
                    if(empty($last_category) && !empty($custom_taxonomy)) {
                        $custom_taxonomy_arr = explode(",", $custom_taxonomy) ;
                        foreach ($custom_taxonomy_arr as $key => $custom_taxonomy_val) {
                            $taxonomy_terms = get_the_terms( $post->ID, $custom_taxonomy_val );
                            $cat_id         = $taxonomy_terms[0]->term_id;
                            $cat_nicename   = $taxonomy_terms[0]->slug;
                            $cat_link       = get_term_link($taxonomy_terms[0]->term_id, $custom_taxonomy_val);
                            $cat_name       = $taxonomy_terms[0]->name;

                            if(!empty($cat_id)) {
                         
                                echo '<li class="item-cat item-cat-' . $cat_id . ' item-cat-' . $cat_nicename . '"><a class="bread-cat bread-cat-' . $cat_id . ' bread-cat-' . $cat_nicename . '" href="' . $cat_link . '" title="' . $cat_name . '">' . $cat_name . '</a></li>';
                                echo '<li class="separator"> ' . $separator . ' </li>';
                                echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '" title="' . get_the_title() . '">' . get_the_title() . '</strong></li>';
                             
                            }

                         } 
                        
                      
                    }
                 
                
                 
            } else if ( is_category() ) {
                  
                // Category page
                echo '<li class="item-current item-cat-' . $category[0]->term_id . ' item-cat-' . $category[0]->category_nicename . '"><strong class="bread-current bread-cat-' . $category[0]->term_id . ' bread-cat-' . $category[0]->category_nicename . '">' . $category[0]->cat_name . '</strong></li>';
                  
            } else if ( is_page() ) {
                  
                // Standard page
                if( $post->post_parent ){
                      
                    // If child page, get parents 
                    $anc = get_post_ancestors( $post->ID );
                      
                    // Get parents in the right order
                    $anc = array_reverse($anc);
                      
                    // Parent page loop
                    foreach ( $anc as $ancestor ) {
                        $parents .= '<li class="item-parent item-parent-' . $ancestor . '"><a class="bread-parent bread-parent-' . $ancestor . '" href="' . get_permalink($ancestor) . '" title="' . get_the_title($ancestor) . '">' . get_the_title($ancestor) . '</a></li>';
                        $parents .= '<li class="separator separator-' . $ancestor . '"> ' . $separator . ' </li>';
                    }
                      
                    // Display parent pages
                    echo wp_kses_post( $parents );
                      
                    // Current page
                    echo '<li class="item-current item-' . $post->ID . '"><strong title="' . get_the_title() . '"> ' . get_the_title() . '</strong></li>';
                      
                } else {
                      
                    // Just display current page if not parents
                    echo '<li class="item-current item-' . $post->ID . '"><strong class="bread-current bread-' . $post->ID . '"> ' . get_the_title() . '</strong></li>';
                      
                }
                  
            } else if ( is_tag() ) {
                  
                // Tag page
                  
                // Get tag information
                $term_id = get_query_var('tag_id');
                $taxonomy = 'post_tag';
                $args ='include=' . $term_id;
                $terms = get_terms( $taxonomy, $args );
                  
                // Display the tag name
                echo '<li class="item-current item-tag-' . $terms[0]->term_id . ' item-tag-' . $terms[0]->slug . '"><strong class="bread-current bread-tag-' . $terms[0]->term_id . ' bread-tag-' . $terms[0]->slug . '">' . $terms[0]->name . '</strong></li>';
              
            } elseif ( is_day() ) {
                  
                // Day archive
                  
                // Year link
                echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . __(' Archives','lambert').'</a></li>';
                echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
                  
                // Month link
                echo '<li class="item-month item-month-' . get_the_time('m') . '"><a class="bread-month bread-month-' . get_the_time('m') . '" href="' . get_month_link( get_the_time('Y'), get_the_time('m') ) . '" title="' . get_the_time('M') . '">' . get_the_time('M') . __(' Archives','lambert').'</a></li>';
                echo '<li class="separator separator-' . get_the_time('m') . '"> ' . $separator . ' </li>';
                  
                // Day display
                echo '<li class="item-current item-' . get_the_time('j') . '"><strong class="bread-current bread-' . get_the_time('j') . '"> ' . get_the_time('jS') . ' ' . get_the_time('M') .  __(' Archives','lambert').'</strong></li>';
                  
            } else if ( is_month() ) {
                  
                // Month Archive
                  
                // Year link
                echo '<li class="item-year item-year-' . get_the_time('Y') . '"><a class="bread-year bread-year-' . get_the_time('Y') . '" href="' . get_year_link( get_the_time('Y') ) . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . __(' Archives','lambert').'</a></li>';
                echo '<li class="separator separator-' . get_the_time('Y') . '"> ' . $separator . ' </li>';
                  
                // Month display
                echo '<li class="item-month item-month-' . get_the_time('m') . '"><strong class="bread-month bread-month-' . get_the_time('m') . '" title="' . get_the_time('M') . '">' . get_the_time('M') . __(' Archives','lambert').'</strong></li>';
                  
            } else if ( is_year() ) {
                  
                // Display year archive
                echo '<li class="item-current item-current-' . get_the_time('Y') . '"><strong class="bread-current bread-current-' . get_the_time('Y') . '" title="' . get_the_time('Y') . '">' . get_the_time('Y') . __(' Archives','lambert').'</strong></li>';
                  
            } else if ( is_author() ) {
                  
                // Auhor archive
                  
                // Get the author information
                global $author;
                $userdata = get_userdata( $author );
                  
                // Display author name
                echo '<li class="item-current item-current-' . $userdata->user_nicename . '"><strong class="bread-current bread-current-' . $userdata->user_nicename . '" title="' . $userdata->display_name . '">' .  __(' Author: ','lambert') . $userdata->display_name . '</strong></li>';
              
            } else if ( get_query_var('paged') ) {
                  
                // Paginated archives
                echo '<li class="item-current item-current-' . get_query_var('paged') . '"><strong class="bread-current bread-current-' . get_query_var('paged') . '" title="'.__('Page','lambert') . get_query_var('paged') . '">'.__('Page','lambert') . ' ' . get_query_var('paged') . '</strong></li>';
                  
            } else if ( is_search() ) {
              
                // Search results page
                echo '<li class="item-current item-current-' . get_search_query() . '"><strong class="bread-current bread-current-' . get_search_query() . '" title="'.__('Search results for: ','lambert') . get_search_query() . '">'.__('Search results for: ','lambert') . get_search_query() . '</strong></li>';
              
            } elseif ( is_404() ) {
                  
                // 404 page
                echo '<li>' . __('Error 404','lambert') . '</li>';
            }
          
            echo '</ul>';
              
        }
          
    }
}

function lambert_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'lambert_excerpt_more');

//pagination
function lambert_pagination($prev = '' , $next = '' , $pages = '') {
    global $wp_query, $wp_rewrite;
    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
    if ($pages == '') {
        $pages = $wp_query->max_num_pages;
        if (!$pages) {
            $pages = 1;
        }
    }
    $pagination = array('base' => str_replace(999999999, '%#%', get_pagenum_link(999999999)), 'format' => '', 'current' => max(1, get_query_var('paged')), 'total' => $pages, 'prev_text' => __('<i class="fa fa-chevron-left"></i> ','lambert') , 'next_text' => __('<i class="fa fa-chevron-right"></i>','lambert') , 'type' => 'list', 'end_size' => 3, 'mid_size' => 3);
    $return = paginate_links($pagination);
    if (!$return) return;
    $return = str_replace("<ul class='page-numbers'>", '<ul class="lambert_pagi">', $return);
    echo '<div class="pagination">' . str_replace("page-numbers", "blog-page transition", $return) . '</div>';
}

if (!function_exists('lambert_custom_pagination')) {
    function lambert_custom_pagination($pages = '', $range = 2, $current_query = '') {
        // var_dump($pages);die;
        $showitems = ($range * 2) + 1;
        
        if ($current_query == '') {
            global $paged;
            if (empty($paged)) $paged = 1;
        } 
        else {
            $paged = $current_query->query_vars['paged'];
        }
        
        if ($pages == '') {
            if ($current_query == '') {
                global $wp_query;
                $pages = $wp_query->max_num_pages;
                if (!$pages) {
                    $pages = 1;
                }
            } 
            else {
                $pages = $current_query->max_num_pages;
            }
        }
        
        if (1 < $pages) {
            

            
            echo '<div class="pagination">';
            
            if ($paged > 1) echo '<a href="' . get_pagenum_link($paged - 1) . '" class="prevposts-link transition ajax">'.wp_kses(__('<i class="fa fa-chevron-left"></i>','lambert'),array('i'=>array('class'=>array(),),) ).'</a>';
            
            for ($i = 1; $i <= $pages; $i++) {
                if (1 != $pages && (!($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
                    if($paged == $i)
                        echo "<span class='blog-page current-page transitiona'>" . $i . "</span>";
                    else 
                        echo "<a href='" . get_pagenum_link($i) . "' class='blog-page transition ajax' >" . $i . "</a>";
                }
            }
            
            if ($paged < $pages) echo '<a href="' . get_pagenum_link($paged + 1) . '" class="nextposts-link transition ajax">'.wp_kses(__('<i class="fa fa-chevron-right"></i>','lambert'),array('i'=>array('class'=>array(),),) ).'</a>';
            
            echo "</div>";
            
            
        }

    }
}

function lambert_post_nav($extraclass = '') {
    global $post;
    if( false == lambert_get_option('blog_single_navigation') ) return ;
    
    // Don't print empty markup if there's nowhere to navigate.
    $prev_post = (is_attachment()) ? get_post($post->post_parent) : get_adjacent_post( lambert_get_option('blog_single_nav_same_term') , '', true);
    $next_post = get_adjacent_post( lambert_get_option('blog_single_nav_same_term') , '', false);
    if ( false == is_a( $prev_post, 'WP_Post' ) && false == is_a( $next_post, 'WP_Post' ) ) return;
?>
    <ul class="pager <?php echo esc_attr($extraclass); ?> clearfix">
        <?php
        
        if ( is_a( $prev_post, 'WP_Post' ) ) :
        ?>
            <li class="previous"><a href="<?php echo get_permalink( $prev_post->ID ); ?>" class="lef-ar-nav" title="<?php echo get_the_title($prev_post->ID ); ?>"><i class="fa fa-angle-double-left"></i> <?php echo esc_html_x('Previous post','Previous post link','lambert') ;?></a></li>
        <?php endif ?>
        <?php
        
        if ( is_a( $next_post, 'WP_Post' ) ) :
        ?>
            <li class="next"><a href="<?php echo get_permalink( $next_post->ID ); ?>" class="rig-ar-nav" title="<?php echo get_the_title($next_post->ID ); ?>"><?php echo esc_html_x('Next post','Next post link','lambert');?> <i class="fa fa-angle-double-right"></i></a></li>
        <?php endif ?>


        <?php
        if ( lambert_get_option('blog_list_link') != ''): ?>
            <div class="p-all">
                <a href="<?php echo esc_url( lambert_get_option('blog_list_link') ); ?>" ><i class="fa fa-th"></i></a>
            </div>
            <?php
        endif; ?>

    </ul>   
<?php
}


function lambert_search_form($form) {
    $form = '
      <form role="search" method="get" id="searchform" action="' . home_url('/') . '" >
      <div class="search">
      <input type="text" size="16" class="search-field form-control" placeholder="' . __('Search ...', 'lambert') . '" value="' . get_search_query() . '" name="s" id="s" />
        <input type="hidden" name="post_type" value="post">
      </div>
      </form>
   ';
    return $form;
}

//Custom comment List:
function lambert_theme_comment($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;
    extract($args, EXTR_SKIP);
    
    if ('div' == $args['style']) {
        $tag = 'div';
        $add_below = 'comment';
    } 
    else {
        $tag = 'li';
        $add_below = 'div-comment';
    }
?>
    <<?php
    echo esc_attr($tag); ?> <?php
    comment_class(empty($args['has_children']) ? 'media' : 'media parent') ?> id="comment-<?php
    comment_ID() ?>">
    <?php
    if ('div' != $args['style']): ?>
    <div id="div-comment-<?php
        comment_ID() ?>" class="comment-body">
    <?php
    endif; ?>
        <div class="comment-author">
            <?php
    if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size']); ?>
        </div>
        <cite class="fn"><a href="#"><?php
    echo get_comment_author_link($comment->comment_ID); ?></a></cite>
        <div class="comment-meta">
            <h6><a href="<?php
    echo htmlspecialchars(get_comment_link($comment->comment_ID)); ?>">
        <?php
    
    /* translators: 1: date, 2: time */
    printf(__('%1$s at %2$s', 'lambert'), get_comment_date(), get_comment_time()); ?></a> / <?php
    comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?> <?php
    edit_comment_link(__('/ (Edit)', 'lambert'), '  ', ''); ?> </h6>
        </div>
        <?php
    comment_text(); ?>

        <?php
    if ($comment->comment_approved == '0'): ?>
            <em class="comment-awaiting-moderation aligncenter"><?php
        _e('Your comment is awaiting moderation.', 'lambert'); ?></em>
            <br />
        <?php
    endif; ?>
    
    
    
    <?php
    if ('div' != $args['style']): ?>
    </div> 
    <?php
    endif; ?>
<?php
}

function lambert_custom_tag_cloud_widget($args) {
    // $args['number'] = 0; //adding a 0 will display all tags
    // $args['largest'] = 18; //largest tag
    // $args['smallest'] = 10; //smallest tag
    // $args['unit'] = 'px'; //tag font unit
    $args['format'] = 'list'; //ul with a class of wp-tag-cloud
    return $args;
}
add_filter( 'widget_tag_cloud_args', 'lambert_custom_tag_cloud_widget' );
add_filter( 'woocommerce_product_tag_cloud_widget_args','lambert_custom_tag_cloud_widget');




/** 
 * Filter the body_class for global configuration
 * 
 * 
 */ 
// Apply filter
add_filter('body_class', 'lambert_body_classes');
if(!function_exists('lambert_body_classes')){
    function lambert_body_classes($classes) {
            
            $classes[] = 'lambert-wp-theme';
            if( lambert_get_option('shop_columns') != '' ){
                $classes[] = 'shop-list-'.lambert_get_option('shop_columns').'-cols';
            }
            if( lambert_get_option('shop_smcolumns') != ''  ){
                $classes[] = 'shop-list-tablet-'.lambert_get_option('shop_smcolumns').'-cols';
            }
            return $classes;
    }
}

/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/includes/template-tags.php' );

/**
 * Additional features to allow styling of the templates.
 */
require get_parent_theme_file_path( '/includes/template-functions.php' );



/**
 * Custom meta box for page, post, portfolio...
 *
 *
 */
// require_once get_template_directory() . '/cmb2/functions.php';
/**
 * Custom meta box for page, post, portfolio...
 *
 * 
 */
//require_once get_template_directory() . '/framework/Custom-Metaboxes/metabox-functions.php';
// require_once get_template_directory() . '/cmb2/functions.php';

// require_once get_template_directory() . '/shortcodes.php';

// require_once get_template_directory() . '/framework/WordPress-Post-Like-System/vendor/fontawesome/post-like.php';
/**
 * Visual Composer plugin integration
 *
 * 
 */
// require_once get_template_directory() . '/inc/cth_for_vc.php';

/**
 * Theme custom style
 *
 * 
 */
require_once get_parent_theme_file_path( '/includes/overridestyle.php' );
/**
 * Portfolio archive rewrite rules
 * example.com/portfolio/2015/01/30
 * 
 */
// require_once get_template_directory() . '/inc/rewrite_rules.php';

/**
 * Taxonomy meta box
 *
 * 
 */
// require_once get_template_directory() . '/inc/cth_taxonomy_fields.php';
// require_once get_template_directory() . '/inc/category_metabox_fields.php';
// // require_once get_template_directory() . '/inc/tag_metabox_fields.php';
// require_once get_template_directory() . '/inc/cthgallery_cat_metabox_fields.php';



/**
 * Custom elements for VC
 *
 * 
 */
// require_once get_template_directory() . '/vc_extend/vc_shortcodes.php';

/**
 * Implement the One Click to import demo data
 *
 * 
 */
//require_once get_template_directory() . '/includes/cththemes-importer.php';


// require_once get_template_directory() . '/inc/ajax.php';

/**
 * Implement the One Click Demo Import plugin
 *
 * 
 */
// require_once get_template_directory() . '/includes/one-click-import-data.php';


/**
 * Woocommerce support
 *
 * 
 */

require_once get_parent_theme_file_path( '/includes/ajax.php' );
require_once get_parent_theme_file_path( '/includes/woo-init.php' );

/**
 * Implement the One Click to import demo data
 *
 */

require_once get_parent_theme_file_path( '/includes/one-click-import-data.php' );

/**
 * Include the TGM_Plugin_Activation class.
 */
require_once get_parent_theme_file_path( '/lib/class-tgm-plugin-activation.php' );

add_action('tgmpa_register', 'lambert_register_required_plugins');

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function lambert_register_required_plugins() {
    /*
     * Array of plugin arrays. Required keys are name and slug.
     * If the source is NOT from the .org repo, then source is also required.
     */
    $plugins = array(

        array('name' => esc_html__('WPBakery Page Builder','lambert'),
             // The plugin name.
            'slug' => 'js_composer',
             // The plugin slug (typically the folder name).
            'source' => 'http://assets.cththemes.com/plugins/js_composer.zip',
             // The plugin source.
            'required' => true,
            'external_url' => esc_url(lambert_relative_protocol_url().'://codecanyon.net/item/visual-composer-page-builder-for-wordpress/242431' ),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => '',
            'class_to_check'            => 'Vc_Manager'
        ), 

        array(
            'name' => esc_html__('WooCommerce','lambert'),
             // The plugin name.
            'slug' => 'woocommerce',
             // The plugin slug (typically the folder name).
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(lambert_relative_protocol_url().'://wordpress.org/plugins/woocommerce/' ), 
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => '',
            'class_to_check'            => 'WooCommerce'
        ), 

        array('name' => esc_html__('Redux Framework','lambert'),
             // The plugin name.
            'slug' => 'redux-framework',
             // The plugin source.
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(lambert_relative_protocol_url().'://wordpress.org/plugins/redux-framework/' ),
             // If set, overrides default API URL and points to an external URL.
            'function_to_check'         => '',
            'class_to_check'            => 'ReduxFramework'
        ), 

        array(
            'name' => esc_html__('Contact Form 7','lambert'),
             // The plugin name.
            'slug' => 'contact-form-7',
             // The plugin slug (typically the folder name).
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(lambert_relative_protocol_url().'://wordpress.org/plugins/contact-form-7/' ),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => 'wpcf7',
            'class_to_check'            => 'WPCF7'
        ), 


        array(
            'name' => esc_html__('CMB2','lambert'),
             // The plugin name.
            'slug' => 'cmb2',
             // The plugin slug (typically the folder name).
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(lambert_relative_protocol_url().'://wordpress.org/support/plugin/cmb2'),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => 'cmb2_bootstrap',
            'class_to_check'            => 'CMB2_Base'
        ),
        

        array(
            'name' => esc_html__('Lambert Add-ons','lambert' ),
             // The plugin name.
            'slug' => 'lambert-add-ons',
             // The plugin slug (typically the folder name).
            'source' => 'lambert-add-ons.zip',
             // The plugin source.
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.

            'force_deactivation'        => true,

            'function_to_check'         => '',
            'class_to_check'            => 'Lambert_Addons'
        ), 

        array(
            'name' => esc_html__('Loco Translate','lambert'),
             // The plugin name.
            'slug' => 'loco-translate',
             // The plugin slug (typically the folder name).
            'required' => false,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(lambert_relative_protocol_url().'://wordpress.org/plugins/loco-translate/'),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => 'loco_autoload',
            'class_to_check'            => 'Loco_Locale'
        ),

        
        array(
            'name' => esc_html__('Envato Market','lambert' ),
             // The plugin name.
            'slug' => 'envato-market',
             // The plugin slug (typically the folder name).
            'source' => esc_url(lambert_relative_protocol_url().'://envato.github.io/wp-envato-market/dist/envato-market.zip' ),
             // The plugin source.
            'required' => true,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url('//envato.github.io/wp-envato-market/' ),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => 'envato_market',
            'class_to_check'            => 'Envato_Market'
        ),

        array('name' => esc_html__('One Click Demo Import','lambert'),
             // The plugin name.
            'slug' => 'one-click-demo-import',
             // The plugin slug (typically the folder name).
            'required' => false,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(lambert_relative_protocol_url().'://wordpress.org/plugins/one-click-demo-import/'),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => '',
            'class_to_check'            => 'OCDI_Plugin'
        ),

        array('name' => esc_html__('Regenerate Thumbnails','lambert'),
             // The plugin name.
            'slug' => 'regenerate-thumbnails',
             // The plugin slug (typically the folder name).
            'required' => false,
             // If false, the plugin is only 'recommended' instead of required.
            'external_url' => esc_url(lambert_relative_protocol_url().'://wordpress.org/plugins/regenerate-thumbnails/' ),
             // If set, overrides default API URL and points to an external URL.

            'function_to_check'         => 'RegenerateThumbnails',
            'class_to_check'            => 'RegenerateThumbnails'
        ),

        


    );

    /*
     * Array of configuration settings. Amend each line as needed.
     *
     * TGMPA will start providing localized text strings soon. If you already have translations of our standard
     * strings available, please help us make TGMPA even better by giving us access to these translations or by
     * sending in a pull-request with .po file(s) with the translations.
     *
     * Only uncomment the strings in the config array if you want to customize the strings.
     */
    $config = array(
        'id'           => 'lambert',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => get_template_directory() . '/lib/plugins/',                      // Default absolute path to bundled plugins.
        'menu'         => 'tgmpa-install-plugins', // Menu slug.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.

        
    );

    tgmpa( $plugins, $config );
}


