<?php
/* banner-php */

Redux::setSection( $opt_name, array(
    'title' => esc_html__('Blog Single', 'lambert'),
    'id'         => 'blog-single-optons',
    'subsection' => true,
    'fields' => array(

        array(
            'id'       => 'show_blog_header_single',
            'type'     => 'switch',
            'on'        => esc_html__('Yes','lambert'),
            'off'       => esc_html__('No','lambert'),
            'title'    => esc_html__( 'Show Single Post Header', 'lambert' ),
            'default'  => true,
        ),
        array(
            'id'       => 'blog_featured_single',
            'type'     => 'switch',
            'on'        => esc_html__('Yes','lambert'),
            'off'       => esc_html__('No','lambert'),
            'title'    => esc_html__( 'Show Featured Image on single post page', 'lambert' ),
            'default'  => true,
        ),
        array(
            'id'       => 'blog_author_single',
            'type'     => 'switch',
            'on'        => esc_html__('Yes','lambert'),
            'off'       => esc_html__('No','lambert'),
            'title'    => esc_html__( 'Show Author', 'lambert' ),
            'default'  => true,
        ),
        array(
            'id'       => 'blog_date_single',
            'type'     => 'switch',
            'on'        => esc_html__('Yes','lambert'),
            'off'       => esc_html__('No','lambert'),
            'title'    => esc_html__( 'Show Date', 'lambert' ),
            'default'  => true,
        ),
        array(
            'id'       => 'blog_cats_single',
            'type'     => 'switch',
            'on'        => esc_html__('Yes','lambert'),
            'off'       => esc_html__('No','lambert'),
            'title'    => esc_html__( 'Show Categories', 'lambert' ),
            'default'  => true,
        ),
        array(
            'id'       => 'blog_comments_single',
            'type'     => 'switch',
            'on'        => esc_html__('Yes','lambert'),
            'off'       => esc_html__('No','lambert'),
            'title'    => esc_html__( 'Show Comments', 'lambert' ),
            'default'  => true,
        ),
        array(
            'id'       => 'blog_tags_single',
            'type'     => 'switch',
            'on'        => esc_html__('Yes','lambert'),
            'off'       => esc_html__('No','lambert'),
            'title'    => esc_html__( 'Show Tags', 'lambert' ),
            // 'subtitle' => esc_html__( '', 'lambert' ),
            'default'  => true,
        ),
        array(
            'id'       => 'blog_like_post_single',
            'type'     => 'switch',
            'on'        => esc_html__('Yes','lambert'),
            'off'       => esc_html__('No','lambert'),
            'title'    => esc_html__( 'Show Like post', 'lambert' ),
            // 'subtitle' => esc_html__( '', 'lambert' ),
            'default'  => false,
        ),

        array(
            'id'       => 'blog_author_single_block',
            'type'     => 'switch',
            'on'        => esc_html__('Yes','lambert'),
            'off'       => esc_html__('No','lambert'),
            'title'    => esc_html__( 'Show Author Block on single post page', 'lambert' ),
            // 'subtitle' => esc_html__( '', 'lambert' ),
            'default'  => true,
        ),

        array(
            'id'       => 'blog_single_navigation',
            'type'     => 'switch',
            'on'        => esc_html__('Yes','lambert'),
            'off'       => esc_html__('No','lambert'),
            'title'    => esc_html__( 'Show posts navigation', 'lambert' ),
            'default'  => true,
        ),
        array(
            'id'        => 'blog_single_nav_same_term',
            'type'      => 'switch',
            'on'        => esc_html__('Yes','lambert'),
            'off'       => esc_html__('No','lambert'),
            'title'     => esc_html__( 'Next/Prev posts should be in same category', 'lambert' ),
            'default'  => false,
        ),


        array(
            'id' => 'blog_list_link',
            'type' => 'text',
            'title' => esc_html__('Blog List Link', 'lambert'),
            'desc' => esc_html__('Link for blog list icon on single blog post page.', 'lambert'),
            'default' => esc_url( home_url('/blog/' ) )
        ),

          
    ),
));

