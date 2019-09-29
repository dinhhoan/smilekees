<?php
/* banner-php */

Redux::setSection( $opt_name, array(
    'title' => esc_html__('MailChimp Subscribe', 'lambert'),
    'id'         => 'mailchimp-subscribe',
    'subsection' => false,
    
    'icon'       => 'el-icon-pencil',
    'fields' => array(
        array(
            'id' => 'mailchimp_api',
            'type' => 'text',
            'title' => esc_html__('Mailchimp API key', 'lambert'),
            'desc' => '<a href="'.esc_url('http://kb.mailchimp.com/accounts/management/about-api-keys#Finding-or-generating-your-API-key').'" target="_blank">Find your API key</a>',
            'default' => '',
        ),
        array(
            'id' => 'mailchimp_list_id',
            'type' => 'text',
            'title' => esc_html__('Mailchimp List ID', 'lambert'),
            'desc' => '<a href="'.esc_url('http://kb.mailchimp.com/lists/managing-subscribers/find-your-list-id').'" target="_blank">Find your list ID</a>',
            'default' => '',
        ),

        array(
            'id'    => 'mailchimp_shortcode',
            'type'  => 'info',
            'title' => esc_html__('Subscribe Shortcode', 'lambert'),
            'style' => 'info',
            'icon'  => 'fa fa-info',
            'notice'=> true,
            'desc'  => wp_kses_post( __('Use the <code><strong>[lambert_mailchimp]</strong></code> shortcode  to display subscribe form inside a post, page or text widget.
<br>Available Variables:<br>
<strong>listid</strong> - your MailChimp list id or ignore it to use default from option above<br>
<strong>placeholder</strong>="Your email address.."<br>
<strong>button</strong>="Sign up now"<br>
<strong>class</strong>="your_extra_class_to_style_the_form"', 'lambert') )
        ),

        
    ),
) );