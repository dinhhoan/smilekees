<?php
/* banner-php */

Redux::setSection( $opt_name, array(
    'title' => __('Footer Settings', 'lambert'),
    'id'         => 'footer-settings',
    'subsection' => false,
    //'desc'       => __( 'For full documentation on this field, visit: ', 'redux-framework-demo' ) . '<a href="http://docs.reduxframework.com/core/fields/checkbox/" target="_blank">http://docs.reduxframework.com/core/fields/checkbox/</a>',
    'icon'       => 'el-icon-pencil',
    'fields' => array(
        array(
            'id' => 'footer_info',
            'type' => 'ace_editor',
            //'url' => true,
            'title' => __('Footer Info', 'lambert'),
            //'compiler' => 'true',
            'mode'=>'html',
            'full_width'=>false,
            'desc' => __('Footer Info', 'lambert'),
            // 'subtitle' => __('', 'lambert'),
            'default' => '
<div class="bold-separator">
<span></span>
</div>
<!--footer contacts links -->
<ul class="footer-contacts">
<li><a href="#">+7(111)123456789</a></li>
<li><a href="#">27th Brooklyn New York, NY 10065</a></li>
<li><a href="mailto:yourmail@domain.com">yourmail@domain.com</a></li>
</ul>',
        ),
        array(
            'id' => 'footer_copyright',
            'type' => 'ace_editor',
            //'url' => true,
            'title' => __('Footer Copyright', 'lambert'),
            //'compiler' => 'true',
            'mode'=>'html',
            'full_width' => false,
            'desc' => __('Footer Copyright', 'lambert'),
            // 'subtitle' => __('', 'lambert'),
            'default' => '
<div class="to-top-holder">
<div class="container">
    <p> <span> &#169; Copyright <a href="https://themeforest.net/user/cththemes" target="_blank">CTHthemes</a> 2019 . </span> All rights reserved.</p>
    <div class="to-top"><span>Back To Top </span><i class="fa fa-angle-double-up"></i></div>
</div>
</div>',
        ),

        
    ),
) );
