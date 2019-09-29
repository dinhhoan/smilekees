<?php
/* banner-php */

Redux::setSection( $opt_name, array(
    'title' => __('Custom Code', 'lambert'),
    'id'         => 'custom-code',
    'subsection' => false,
    
    'icon'       => 'el-icon-file-new',
    'fields' => array(

        array(
            'id' => 'custom-css',
            'type' => 'ace_editor',
            'title' => esc_html__('CSS Code - Large Desktop View', 'lambert'),
            'subtitle' => esc_html__('Paste your CSS code here.', 'lambert'),
            'mode' => 'css',

            'full_width'=>false,
            'theme' => 'monokai',
            'default' => ""
        ),
        array(
            'id' => 'custom-css-medium',
            'type' => 'ace_editor',
            'title' => esc_html__('CSS Code - Medium Desktop View', 'lambert'),
            'subtitle' => esc_html__('Paste your CSS code here.', 'lambert'),
            'mode' => 'css',
            'full_width'=>false,
            'theme' => 'monokai',
            'default' => ""
        ),
        array(
            'id' => 'custom-css-tablet',
            'type' => 'ace_editor',
            'title' => esc_html__('CSS Code - Tablet View', 'lambert'),
            'subtitle' => esc_html__('Paste your CSS code here.', 'lambert'),
            'mode' => 'css',
            'full_width'=>false,
            'theme' => 'monokai',
            'default' => ""
        ),
        array(
            'id' => 'custom-css-mobile',
            'type' => 'ace_editor',
            'title' => esc_html__('CSS Code - Mobile View', 'lambert'),
            'subtitle' => esc_html__('Paste your CSS code here.', 'lambert'),
            'mode' => 'css',
            'full_width'=>false,
            'theme' => 'monokai',
            'default' => ""
        ),

        
    ),
) );

