<?php
/* banner-php */
// -> START General Settings

Redux::setSection( $opt_name, array(
    'title' => __('General Settings', 'lambert'),
    'id'         => 'general-settings',
    'subsection' => false,
    //'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
    'icon'       => 'el-icon-cogs',
    'fields' => array(
        array(
            'id' => 'favicon',
            'type' => 'media',
            'url' => true,
            'title' => __('Custom Favicon', 'lambert'),
            //'compiler' => 'true',
            //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Upload your Favicon.', 'lambert'),
            // 'subtitle' => __('', 'lambert'),
            'default' => array('url' => get_template_directory_uri().'/assets/images/favicon.ico'),
        ),
        array(
            'id' => 'logo',
            'type' => 'media',
            'url' => true,
            'title' => __('Main Logo', 'lambert'),
            //'compiler' => 'true',
            //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Upload your main logo.', 'lambert'),
            // 'subtitle' => __('', 'lambert'),
            'default' => array('url' => get_template_directory_uri().'/assets/images/logo.png'),
        ),
        array(
            'id' => 'logo2',
            'type' => 'media',
            'url' => true,
            'title' => __('Secondary Logo', 'lambert'),
            //'compiler' => 'true',
            //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Upload your secondary logo.', 'lambert'),
            // 'subtitle' => __('', 'lambert'),
            'default' => array('url' => get_template_directory_uri().'/assets/images/logo2.png'),
        ),
        array(
            'id' => 'logo_size_width',
            'type' => 'text',
            'title' => __('Logo Size Width', 'lambert'),
            // 'subtitle' => __('', 'lambert'),
            // 'desc' => __('', 'lambert'),
            'default' => '150'
        ),
        array(
            'id' => 'logo_size_height',
            'type' => 'text',
            'title' => __('Logo Size Height', 'lambert'),
            // 'subtitle' => __('', 'lambert'),
            // 'desc' => __('', 'lambert'),
            'default' => '62'
        ),
        array(
            'id' => 'logo_text',
            'type' => 'text',
            'title' => __('Logo Text', 'lambert'),
            // 'subtitle' => __('', 'lambert'),
            // 'desc' => __('', 'lambert'),
            'default' => ''
        ),
        array(
            'id' => 'slogan',
            'type' => 'text',
            'title' => __('Slogan (Sub Logo Text)', 'lambert'),
            // 'subtitle' => __('', 'lambert'),
            // 'desc' => __('', 'lambert'),
            'default' => ''
        ),
        array(
            'id' => 'show_loader',
            'type' => 'select',
            'title' => __('Show animation loadder', 'lambert'),
            'subtitle' => __('Show animation loader', 'lambert'),
            // 'desc' => '',
            'options' => array('no' => 'No', 'yes' => 'Yes'), //Must provide key => value pairs for select options
            'default' => 'yes'
        ),
        array(
            'id' => 'loader_icon',
            'type' => 'media',
            'url' => true,
            'title' => __('Loader Image Icon', 'lambert'),
            // 'subtitle' => __('', 'lambert'),
            'desc' => __('Upload your loader image icon.', 'lambert'),
            'default' => array('url' => get_template_directory_uri().'/assets/images/loader.png'),
        ),
        
        // array(
        //     'id' => 'seo_des',
        //     'type' => 'textarea',
        //     'title' => __('SEO Description', 'lambert'),
        //     'subtitle' => __('', 'lambert'),
        //     'desc' => __('', 'lambert'),
        //     'default' => ''
        // ),
        // array(
        //     'id' => 'seo_key',
        //     'type' => 'textarea',
        //     'title' => __('SEO Keywords', 'lambert'),
        //     'subtitle' => __('', 'lambert'),
        //     'desc' => __('', 'lambert'),
        //     'default' => ''
        // ),

        array(
            'id' => 'gmap_api_key',
            'type' => 'text',
            // 'url' => true,
            'title' => esc_html__('Google Map API Key', 'lambert'),
            // 'subtitle' => esc_html__('', 'lambert'),
            'desc' => '<a href="https://developers.google.com/maps/documentation/javascript/get-api-key" target="_blank">Get a key</a>.',
            // 'default' => '',
        ),
    ),
) );