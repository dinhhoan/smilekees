<?php
/* banner-php */

Redux::setSection( $opt_name, array(
    'title' => __('404 Page', 'lambert'),
    'id'         => '404-intro-text-settings',
    'subsection' => false,
    //'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
    'icon'       => 'el-icon-file-edit',
    'fields' => array(
        array(
            'id' => '404_bg',
            'type' => 'media',
            'url' => true,
            'title' => __('404 Background', 'lambert'),
            //'compiler' => 'true',
            //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('This image will be used for background image in 404 page.', 'lambert'),
            // 'subtitle' => __('', 'lambert'),
            'default' => array('url' => get_template_directory_uri().'/assets/images/bg/1.jpg'),
        ),
        array(
            'id' => '404_intro',
            'type' => 'editor',
            'title' => __('404 Page Message', 'lambert'),
            // 'mode' => 'html',
            // 'full_width'=>false,
            // 'subtitle' => '',
            // 'desc' => '',
            
            'default' => '<p>Sorry, but the page you are looking for has not been found.</p>'
        ),
        
    ),
) );

