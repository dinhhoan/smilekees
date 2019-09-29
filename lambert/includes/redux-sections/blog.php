<?php
/* banner-php */

Redux::setSection( $opt_name, array(
    'title' => __('Blog Settings', 'lambert'),
    'id'         => 'blog-settings',
    'subsection' => false,
    //'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
    'icon'       => 'el-icon-website',
    'fields' => array(
        array(
                'id' => 'blog_home_text',
                'type' => 'text',
                'title' => __('Blog Heading Text', 'lambert'),
                // 'subtitle' => __('', 'lambert'),
                // 'desc' => __('', 'lambert'),
                'default' => 'Our Blog'
            ),
        array(
                'id' => 'blog_home_text_intro',
                'type' => 'textarea',
                'title' => __('Blog Intro Text', 'lambert'),
                // 'subtitle' => __('', 'lambert'),
                // 'desc' => __('', 'lambert'),
                'default' => "<h3>Ler's read </h3>"
            ),
        array(
            'id' => 'blog_header_image',
            'type' => 'media',
            'url' => true,
            'title' => __('Blog Header Image', 'lambert'),
            //'compiler' => 'true',
            //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Upload your blog header image', 'lambert'),
            // 'subtitle' => __('', 'lambert'),
            'default' => array('url' => get_template_directory_uri().'/assets/images/bg/18.jpg'),
        ),
        array(
                'id'       => 'blog_layout',
                'type'     => 'image_select',
                //'compiler' => true,
                'title'    => __( 'Blog Layout', 'lambert' ),
                'subtitle' => __( 'Select main content and sidebar layout.', 'lambert' ),
                'options'  => array(
                    'fullwidth' => array(
                        'alt' => 'Fullwidth',
                        'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                    ),
                    'left_sidebar' => array(
                        'alt' => 'Left Sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                    ),
                    'right_sidebar' => array(
                        'alt' => 'Right Sidebar',
                        'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                    ),
                    // 'lambert' => array(
                    //     'alt' => 'Right Sidebar',
                    //     'img' => get_template_directory_uri() . '/functions/assets/lambert.png'
                    // ),
                    
                ),
                'default'  => 'right_sidebar'
            ),
        array(
            'id' => 'blog-sidebar-width',
            'type' => 'select',
            'title' => esc_html__('Blog Sidebar Width', 'lambert'),
            'subtitle' => esc_html__( 'Based on Bootstrap 12 columns.', 'lambert' ),
            'options' => array(
                            '2' => esc_html__('2 Columns', 'lambert'),
                            '3' => esc_html__('3 Columns', 'lambert'),
                            '4' => esc_html__('4 Columns', 'lambert'),
                            '5' => esc_html__('5 Columns', 'lambert'),
                            '6' => esc_html__('6 Columns', 'lambert'),
             ), //Must provide key => value pairs for select options
            'default' => '4'
        ),

        array(
            'id'       => 'blog_breadcrumbs',
            'type'     => 'switch',
            'title'    => __( 'Blog Breadcrumbs', 'lambert' ),
            'subtitle' => __( 'Set this to On to show blog page breadcrumbs.', 'lambert' ),
            'default'  => false,
        ),
        array(
            'id'       => 'blog_author',
            'type'     => 'switch',
            'on'        => esc_html__('Yes','lambert'),
            'off'       => esc_html__('No','lambert'),
            'title'    => __( 'Show Author', 'lambert' ),
            // 'subtitle' => __( '', 'lambert' ),
            'default'  => true,
        ),
        array(
            'id'       => 'blog_date',
            'type'     => 'switch',
            'on'        => esc_html__('Yes','lambert'),
            'off'       => esc_html__('No','lambert'),
            'title'    => __( 'Show Date', 'lambert' ),
            // 'subtitle' => __( '', 'lambert' ),
            'default'  => true,
        ),
        array(
            'id'       => 'blog_like_post',
            'type'     => 'switch',
            'on'        => esc_html__('Yes','lambert'),
            'off'       => esc_html__('No','lambert'),
            'title'    => __( 'Show Like Post', 'lambert' ),
            // 'subtitle' => __( '', 'lambert' ),
            'default'  => false,
        ),
        array(
            'id'       => 'blog_cats',
            'type'     => 'switch',
            'on'        => esc_html__('Yes','lambert'),
            'off'       => esc_html__('No','lambert'),
            'title'    => __( 'Show Categories', 'lambert' ),
            // 'subtitle' => __( '', 'lambert' ),
            'default'  => true,
        ),
        
        array(
            'id'       => 'blog_comments',
            'type'     => 'switch',
            'on'        => esc_html__('Yes','lambert'),
            'off'       => esc_html__('No','lambert'),
            'title'    => __( 'Show Comments', 'lambert' ),
            // 'subtitle' => __( '', 'lambert' ),
            'default'  => true,
        ),

        array(
            'id'       => 'blog_tags',
            'type'     => 'switch',
            'on'        => esc_html__('Yes','lambert'),
            'off'       => esc_html__('No','lambert'),
            'title'    => __( 'Show Tags', 'lambert' ),
            // 'subtitle' => __( '', 'lambert' ),
            'default'  => true,
        ),

    ),
) );

