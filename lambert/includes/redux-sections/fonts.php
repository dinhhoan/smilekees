<?php
/* banner-php */

Redux::setSection( $opt_name, array(
    'title' => esc_html__('Fonts', 'lambert'),
    'id'         => 'font-settings',
    'subsection' => false,
    
    'icon'       => 'el-icon-font',
    'fields' => array(
        
        array(
            'id' => 'body-font',
            'type' => 'typography',
            'output' => array('body'),
            'title' => __('Body Font', 'lambert'),
            'subtitle' => __('Specify the body font properties.</br> Default</br>font-family: Source Sans Pro</br>font-size: 12px</br>line-height: 24px</br>font-weight: 400</br>color: #000000', 'lambert'),
            'google' => true,
            // 'default' => array(
            //     'color' => '#444444',
            //     'font-size' => '14px',
            //     'line-height' => '24px',
            //     'font-family' => "Open Sans",
            //     'font-weight' => '400',
            // ),
        ),
        array(
            'id' => 'paragraph-font',
            'type' => 'typography',
            'output' => array('p'),
            'title' => __('Paragraph Font', 'lambert'),
            'subtitle' => __('Specify paragraph font properties. Default</br>font-family: Source Sans Pro</br>font-size: 16px</br>line-height: 24px</br>font-weight: 400</br>color: #000000', 'lambert'),
            'google' => true,
            // 'default' => array(
            //     'font-size' => '14px',
            //     'line-height' => '18px',
            //     'font-family' => "Open Sans",
            // ),
        ),
        array(
            'id' => 'header-font',
            'type' => 'typography',
            'output' => array('h1, h2, h3, h4, h5, h6'),
            'title' => __('Title-Header Font', 'lambert'),
            'subtitle' => __('Specify the title and heading font properties.</br> Default</br>font-family: Source Sans Pro</br>color: #000000', 'lambert'),
            'google' => true,
            // 'default' => array(
            //     'color' => '#222222',
            //     'font-family' => "Open Sans",
            //     'font-weight' => '700',
            // ),
        ),
        
        
        
    ),
) );