<?php
/* banner-php */

Redux::setSection( $opt_name, array(
    'title' => esc_html__('Media', 'lambert'),
    'id'         => 'thumbnail_images',
    'subsection' => false,
    'desc'       => wp_kses(__( '<p>These settings affect the display and dimensions of images in your pages.</p>
        <p><em> Enter 9999 as Width value and uncheck Hard Crop to make your thumbnail dynamic width.</em></p>
        <p><em> Enter 9999 as Height value and uncheck Hard Crop to make your thumbnail dynamic height.</em></p>
        <p><em> Enter 9999 as Width and Height values to use full size image.</em></p>
After changing these settings you may need to ', 'lambert' ), array('p'=>array(),'a'=>array('class'=>array(),'href'=>array(),'target'=>array(),),'strong'=>array(),'em'=>array(),) ) .'<a href="'.esc_url('http://wordpress.org/extend/plugins/regenerate-thumbnails/' ).'" target="_blank">regenerate your thumbnails</a>',
    'icon'       => 'el-icon-picture',
    'fields' => array(
        array(
            'id' => 'enable_custom_sizes',
            'type' => 'switch',
            'on'=> esc_html__('Yes','lambert'),
            'off'=> esc_html__('No','lambert'),
            'title' => esc_html__('Enable Custom Image Sizes', 'lambert'),
            'default' => false
        ), 

        // array(
        //     'id'       => 'fullscreen_thumb',
        //     'type'     => 'thumbnail_size',
        //     'title' => esc_html__('Home Thumbnail Size', 'lambert'),
        //     'subtitle' => esc_html__('Demo: Width - 9999, Height - 9999, Hard crop - checked', 'lambert'),
        //     'default'  => array(
        //         'width'   => '9999', 
        //         'height'  => '9999',
        //         'hard_crop'  => 1
        //     ),
        // ),
        

        array(
            'id'       => 'galmasonry_thumbnail_size_one',
            'type'     => 'thumbnail_size',
            'title' => esc_html__('Portfolio Masonry Size One', 'lambert'),
            'subtitle' => esc_html__('Demo: Width - 367, Height - 230, Hard crop - checked', 'lambert'),
            'default'  => array(
                'width'   => '367', 
                'height'  => '230',
                'hard_crop'  => 1
            ),
        ),
        array(
            'id'       => 'galmasonry_thumbnail_size_two',
            'type'     => 'thumbnail_size',
            'title' => esc_html__('Portfolio Masonry Size Two', 'lambert'),
            'subtitle' => esc_html__('Demo: Width - 753, Height - 470, Hard crop - checked', 'lambert'),
            'default'  => array(
                'width'   => '753', 
                'height'  => '470',
                'hard_crop'  => 1
            ),
        ),

        array(
            'id'       => 'galmasonry_thumbnail_size_three',
            'type'     => 'thumbnail_size',
            'title' => esc_html__('Portfolio Masonry Size Three', 'lambert'),
            'subtitle' => esc_html__('Demo: Width - 1141, Height - 710, Hard crop - checked', 'lambert'),
            'default'  => array(
                'width'   => '1141', 
                'height'  => '710',
                'hard_crop'  => 1
            ),
        ),

        

        
        array(
            'id'       => 'team_member_thumb',
            'type'     => 'thumbnail_size',
            'title' => esc_html__('Member Thumbnail Size', 'lambert'),
            'subtitle' => esc_html__('Demo: Width - 160, Height - 160, Hard crop - checked', 'lambert'),
            'default'  => array(
                'width'   => '160', 
                'height'  => '160',
                'hard_crop'  => 1
            ),
        ),




        array(
            'id'       => 'blog_image_thumb',
            'type'     => 'thumbnail_size',
            'title' => esc_html__('Blog Thumbnail Size', 'lambert'),
            'subtitle' => esc_html__('Demo: Width - 750, Height - 469, Hard crop - checked', 'lambert'),
            'default'  => array(
                'width'   => '750', 
                'height'  => '469',
                'hard_crop'  => 1
            ),
        ),

        array(
            'id'       => 'blog_image_large_thumb',
            'type'     => 'thumbnail_size',
            'title' => esc_html__('Blog Single Size', 'lambert'),
            'subtitle' => esc_html__('Demo: Width - 750, Height - 469, Hard crop - checked', 'lambert'),
            'default'  => array(
                'width'   => '750', 
                'height'  => '469',
                'hard_crop'  => 1
            ),
        ),

    ),
) );

