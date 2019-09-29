<?php
/* banner-php */

Redux::setSection( $opt_name, array(
    'title' => __('Shop Settings', 'lambert'),
    'id'         => 'shop-settings',
    'subsection' => false,
    //'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
    'icon'       => 'el-icon-shopping-cart',
    'fields' => array(
        array(
            'id' => 'shopbg',
            'type' => 'media',
            'url' => true,
            'title' => __('Shop Header Background', 'lambert'),
            //'compiler' => 'true',
            //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Upload your Shop Header Background.', 'lambert'),
            // 'subtitle' => __('', 'lambert'),
            'default' => array('url' => get_template_directory_uri().'/assets/images/bg/21.jpg'),
        ),

        // array(
        //     'id'       => 'shop_show_page_title',
        //     'type'     => 'switch',
        //     'title'    => __( 'Show Shop Page Title', 'lambert' ),
        //     'subtitle' => __( 'Set this to On to show shop page title', 'lambert' ),
        //     'default'  => true,
        // ),

        array(
            'id' => 'shop_page_intro',
            'type' => 'ace_editor',
            'title' => __('Shop Introtext', 'lambert'),
            // 'subtitle' => __('', 'lambert'),
            'mode' => 'html',
            //'compiler'=>array('body'),
            'full_width'=>false,
            'theme' => 'monokai',
            'desc' => 'This introtext will display in shop header page.',
            'default' => '
<div class="section-title">
<h4>Shop Information</h4>
</div>
<div class="inner">
<p> Numerous commentators have also referred to the supposed restaurant owner\'s eccentric habit of touting for custom outside his establishment, dressed in aristocratic fashion and brandishing a sword</p>
</div>
<div class="bold-separator">
<span></span>
</div>'
        ),

        array(
            'id'       => 'shop_posts_per_page',
            'type'     => 'text',
            'title'    => esc_html__( 'Posts per page', 'lambert' ),
            'subtitle' => esc_html__( 'Number of post to show per page, -1 to show all posts.', 'lambert' ),
            'default'  => 12,
        ),

        

        array(
            'id' => 'shop_columns',
            'type' => 'select',
            'title' => __('Shop Archive Columns Grid', 'lambert'),
            // 'subtitle' => __('', 'lambert'),
            // 'desc' => '',
            'options' => array('12' => 'One Column', '6' => 'Two Columns','4' => 'Three Columns', '3' => 'Four Columns', 'five' => 'Five Columns', '2' => 'Six Columns'), //Must provide key => value pairs for select options
            'default' => '4'
        ),

        array(
            'id' => 'shop_smcolumns',
            'type' => 'select',
            'title' => __('Shop Archive Columns Grid (for tablet horizontal view)', 'lambert'),
            // 'subtitle' => __('', 'lambert'),
            // 'desc' => '',
            'options' => array('12' => 'One Column', '6' => 'Two Columns','4' => 'Three Columns', '3' => 'Four Columns', 'five' => 'Five Columns', '2' => 'Six Columns'), //Must provide key => value pairs for select options
            'default' => '6'
        ),

        array(
            'id'       => 'shop_sidebar',
            'type'     => 'select',
            'title'    => __( 'Shop Sidebar', 'lambert' ),
            // 'subtitle' => __( '', 'lambert' ),
            // 'desc' => '',
            'options' => array('right' => 'Right Sidebar', 'left' => 'Left Sidebar','none' => 'No Sidebar'), //Must provide key => value pairs for select options
            'default' => 'right'
        ),

        array(
            'id' => 'related_products_count',
            'type' => 'text',
            'title' => __('Related Products Count', 'lambert'),
            // 'subtitle' => '',
            'desc' => 'Set number of related products to show.',
            
            'default' => '3'
        ),

        array(
            'id'       => 'shop_breadcrumbs',
            'type'     => 'switch',
            'title'    => __( 'Show Shop Breadcrumbs', 'lambert' ),
            'subtitle' => __( 'Set this to On to show shop page breadcrumbs.', 'lambert' ),
            'default'  => true,
        ),
    ),
) );

