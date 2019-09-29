<?php
/* banner-php */

Redux::setSection( $opt_name, array(
    'title' => __('Styling Options', 'lambert'),
    'id'         => 'styling-settings',
    'subsection' => false,
    //'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
    'icon'       => 'el-icon-magic',
    'fields' => array(
       
        array(
            'id'       => 'color-preset',
            'type'     => 'image_select',
            'title'    => __( 'Theme Color', 'lambert' ),
            'subtitle' => __( 'Select your theme color', 'lambert' ),
            'desc'     => __( 'Select your theme color', 'lambert' ),
            //Must provide key => value(array:title|img) pairs for radio options
            'options'  => array(
                'default' => array(
                    'alt' => 'Default',
                    'img' => get_template_directory_uri(). '/assets/redux/default.png'
                ),
                'red' => array(
                    'alt' => 'Default',
                    'img' => get_template_directory_uri(). '/assets/redux/red.png'
                ),
                'blue' => array(
                    'alt' => 'Skin 2',
                    'img' => get_template_directory_uri(). '/assets/redux/skin2.png'
                ),
                'green' => array(
                    'alt' => 'Skin 3',
                    'img' => get_template_directory_uri(). '/assets/redux/skin3.png'
                ),
                'orange' => array(
                    'alt' => 'Skin 4',
                    'img' => get_template_directory_uri(). '/assets/redux/skin4.png'
                ),
                'pink' => array(
                    'alt' => 'Skin 5',
                    'img' => get_template_directory_uri(). '/assets/redux/skin5.png'
                ),
                'purple' => array(
                    'alt' => 'Skin 6',
                    'img' => get_template_directory_uri(). '/assets/redux/skin6.png'
                ),
                
                
            ),
            'default'  => 'default'
        ),
        array(
            'id' => 'override-preset',
            'type' => 'switch',
            'title' => __('Use Your Own', 'lambert'),
            'subtitle' => __('Set this to <b>Yes</b> if you want to use color variants bellow.', 'lambert'),
            // 'desc' => '',
            'default' => false
        ),
        array(
            'id' => 'theme-skin-color',
            'type' => 'color',
            'title' => __('Theme Skin Color', 'lambert'),
            //'compiler'      => true,
            //'compiler'=> array('.l-line span,.overlay,nav li a:before , nav li a:after,.nav-button span,.section-title h3:before,.services-info:before , .services-info:after,.section-separator,.team-box:before , .team-box:after,.team-box .overlay,.hide-column:before , .hide-column:after,.filter-button ul li,.gallery-filters  a:before,.grid-item-holder:before,.fullwidth-slider-holder .customNavigation a:before,.resume-head:before,.show-hidden-info:before , .show-hidden-info:after,.footer-decor:before , .footer-decor:after,.selectMe:before,.inline-facts-holder:before,.ajaxPageSwitchBacklink:before'),
            'subtitle' => __('Pick the primary color for the theme (default: #C59D5F).', 'lambert'),
            'default' => '#C59D5F',
            'validate' => 'color',
            //'mode'=>'background-color',
        ),
        array(
            'id' => 'footer-bg-color',
            'type' => 'color',
            'title' => __('Footer Background Color', 'lambert'),
            //'compiler'      => true,
            //'compiler'=> array('.l-line span,.overlay,nav li a:before , nav li a:after,.nav-button span,.section-title h3:before,.services-info:before , .services-info:after,.section-separator,.team-box:before , .team-box:after,.team-box .overlay,.hide-column:before , .hide-column:after,.filter-button ul li,.gallery-filters  a:before,.grid-item-holder:before,.fullwidth-slider-holder .customNavigation a:before,.resume-head:before,.show-hidden-info:before , .show-hidden-info:after,.footer-decor:before , .footer-decor:after,.selectMe:before,.inline-facts-holder:before,.ajaxPageSwitchBacklink:before'),
            'subtitle' => __('Footer Background Color (default: #191919).', 'lambert'),
            'default' => '#191919',
            'validate' => 'color',
            //'mode'=>'background-color',
        ),
        array(
            'id' => 'footer-copy-bg-color',
            'type' => 'color',
            'title' => __('Footer Copyright Background Color', 'lambert'),
            //'compiler'      => true,
            //'compiler'=> array('.l-line span,.overlay,nav li a:before , nav li a:after,.nav-button span,.section-title h3:before,.services-info:before , .services-info:after,.section-separator,.team-box:before , .team-box:after,.team-box .overlay,.hide-column:before , .hide-column:after,.filter-button ul li,.gallery-filters  a:before,.grid-item-holder:before,.fullwidth-slider-holder .customNavigation a:before,.resume-head:before,.show-hidden-info:before , .show-hidden-info:after,.footer-decor:before , .footer-decor:after,.selectMe:before,.inline-facts-holder:before,.ajaxPageSwitchBacklink:before'),
            'subtitle' => __('Footer Copyright Background Color (default: #262526).', 'lambert'),
            'default' => '#262526',
            'validate' => 'color',
            //'mode'=>'background-color',
        ),
        array(
            'id' => 'overlay-bg-color',
            'type' => 'color',
            'title' => __('Overlay Background Color', 'lambert'),
            //'compiler'      => true,
            //'compiler'=> array('.l-line span,.overlay,nav li a:before , nav li a:after,.nav-button span,.section-title h3:before,.services-info:before , .services-info:after,.section-separator,.team-box:before , .team-box:after,.team-box .overlay,.hide-column:before , .hide-column:after,.filter-button ul li,.gallery-filters  a:before,.grid-item-holder:before,.fullwidth-slider-holder .customNavigation a:before,.resume-head:before,.show-hidden-info:before , .show-hidden-info:after,.footer-decor:before , .footer-decor:after,.selectMe:before,.inline-facts-holder:before,.ajaxPageSwitchBacklink:before'),
            'subtitle' => __('Overlay Background Color (default: #000).', 'lambert'),
            'default' => '#000',
            'validate' => 'color',
            //'mode'=>'background-color',
        ),
        
        
        
        
    ),
) );


