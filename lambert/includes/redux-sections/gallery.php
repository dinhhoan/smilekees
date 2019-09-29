<?php
/* banner-php */

Redux::setSection( $opt_name, array(
    'title' => esc_html__('Gallery', 'lambert'),
    'id'         => 'gallery-settings',
    'subsection' => false,
    
    'icon'       => 'fa fa-tv',
    'fields' => array(

        array(
            'id' => 'gallery_home_text',
            'type' => 'textarea',
            'title' => __('Gallery Heading Text', 'lambert'),
            'default' => '<h1>Our gallery</h1>
<h3>Booking a table online is easy</h3>'
        ),
        
        array(
            'id' => 'gallery_header_image',
            'type' => 'media',
            'url' => true,
            'title' => esc_html__('Gallery Header Image', 'lambert'),
            'default' => array('url' => get_template_directory_uri().'/assets/images/bg/17.jpg'),
        ),

        
        array(
            'id' => 'gallery_column',
            'type' => 'select',
            'title' => esc_html__('Gallery Columns', 'lambert'),
            'options' => array(
                            'one' => 'One Column',
                            'two' => 'Two Columns',
                            'three' => 'Three Columns', 
                            'four' => 'Four Columns',
                            'five' => 'Five Columns', 
                            
                            ), //Must provide key => value pairs for select options
            'default' => 'three'
        ),
        array(
            'id'       => 'gallery_show_filter',
            'type'     => 'switch',
            'on'=> esc_html__('Yes', 'lambert'),
            'off'=> esc_html__('No', 'lambert'),
            'title'    => esc_html__( 'Show Filter', 'lambert' ),
            'default'  => true,
        ),
        array(
            'id' => 'gallery_filter_orderby',
            'type' => 'select',
            'title' => esc_html__('Order Filter By', 'lambert'),
            'options' => array(
                            'id' => esc_html__( 'ID', 'lambert' ), 
                            'count' => esc_html__( 'Count', 'lambert' ),
                            'name' => esc_html__( 'Name', 'lambert' ), 
                            'slug' => esc_html__( 'Slug', 'lambert' ),
                            'none' => esc_html__( 'None', 'lambert' )
                        ), //Must provide key => value pairs for select options
            'default' => 'name'
        ),
        array(
            'id' => 'gallery_filter_order',
            'type' => 'select',
            'title' => esc_html__('Sort order', 'lambert'),
            'options' => array(
                            'ASC' => esc_html__( 'Ascending', 'lambert' ), 
                            'DESC' => esc_html__( 'Descending', 'lambert' ),
                        ), //Must provide key => value pairs for select options
            'default' => 'ASC'
        ),
        array(
            'id'       => 'gallery_posts_per_page',
            'type'     => 'text',
            'title'    => esc_html__( 'Posts per page', 'lambert' ),
            'subtitle' => esc_html__( 'Number of galleries to show per page, -1 to show all posts.', 'lambert' ),
            'default'  => '12',
        ),
        
        array(
            'id' => 'gallery_archive_orderby',
            'type' => 'select',
            'title' => esc_html__('Order Galleries By', 'lambert'),
            'desc' => '',
            'options' => array(
                            'none' => esc_html__( 'None', 'lambert' ), 
                            'ID' => esc_html__( 'Post ID', 'lambert' ), 
                            'author' => esc_html__( 'Post Author', 'lambert' ),
                            'title' => esc_html__( 'Post title', 'lambert' ), 
                            'name' => esc_html__( 'Post name (post slug)', 'lambert' ),
                            'date' => esc_html__( 'Created Date', 'lambert' ),
                            'modified' => esc_html__( 'Last modified date', 'lambert' ),
                            'parent' => esc_html__( 'Post Parent id', 'lambert' ),
                            'rand' => esc_html__( 'Random', 'lambert' ),
                        ), //Must provide key => value pairs for select options
            'default' => 'date'
        ),
        array(
            'id' => 'gallery_archive_order',
            'type' => 'select',
            'title' => esc_html__('Sort order', 'lambert'),
            'desc' => '',
            'options' => array(
                            'DESC' => esc_html__( 'Descending', 'lambert' ),
                            'ASC' => esc_html__( 'Ascending', 'lambert' ), 
                            
                        ), //Must provide key => value pairs for select options
            'default' => 'DESC'
        ),

        array(
            'id' => 'gallery_pad',
            'type' => 'select',
            'title' => esc_html__('Spacing', 'lambert'),
            'subtitle' => esc_html__('The space between gallery grid items.', 'lambert'),
            'desc' => '',
            'options' => array(
                            'none' => esc_html__('None','lambert'), 
                            'extrasmall' => esc_html__('Extra Small','lambert'), 
                            'small' => esc_html__('Small','lambert'), 
                            'medium' =>  esc_html__('Medium','lambert'),
                            'big' =>  esc_html__('Big','lambert'),
                        ), //Must provide key => value pairs for select options
            'default' => 'small'
        ),

        
        array(
            'id'       => 'gallery_show_pagination',
            'type'     => 'switch',
            'on'=> esc_html__('Yes', 'lambert'),
            'off'=> esc_html__('No', 'lambert'),
            'title'    => esc_html__( 'Show Pagination', 'lambert' ),
            'default'  => false,
        ),
        
        array(
            'id'       => 'gallery_show_loadmore',
            'type'     => 'switch',
            'on'=> esc_html__('Yes', 'lambert'),
            'off'=> esc_html__('No', 'lambert'),
            'title'    => esc_html__( 'Show Load More', 'lambert' ),
            'default'  => true,
        ),

        array(
            'id'       => 'gallery_lm_items',
            'type'     => 'text',
            'title'    => esc_html__( 'Loadmore items', 'lambert' ),
            'subtitle' => esc_html__( 'Number of gallery items to loadmore.', 'lambert' ),
            'default'  => '3',
        ),
        
        array(
            'id'       => 'gallery_enable_gallery',
            'type'     => 'switch',
            'on'=> esc_html__('Yes', 'lambert'),
            'off'=> esc_html__('No', 'lambert'),
            'title'    => esc_html__( 'Enable Image Gallery on Gallery Grid', 'lambert' ),
            'default'  => false,
        ),
    ),
) );

