<?php
/* banner-php */
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 */
function lambert_get_option( $setting, $default = null ) {
    global $lambert_options;

    $default_options = array(

        'favicon'                   => array( 'url'  => get_template_directory_uri().'/assets/images/favicon.ico' ),
        'logo_first'                => array( 'url'  => get_template_directory_uri().'/assets/images/logo.png' ),
        'logo_size_width'           => 134,
        'logo_size_height'          => 50,
        'logo_text'                 => '',
        'slogan'                    => '',
        'dynamic_menus'             => array(),
        'show_loader'               => true,
        'show_left_bar'             => true,
        'show_fixed_title'          => true,
        'left_socials'              => '<ul>
<li><a href="#" target="_blank" ><i class="fa fa-facebook"></i></a></li>
<li><a href="#" target="_blank"><i class="fa fa-twitter"></i></a></li>
<li><a href="#" target="_blank" ><i class="fa fa-instagram"></i></a></li>
<li><a href="#" target="_blank" ><i class="fa fa-pinterest"></i></a></li>
<li><a href="#" target="_blank" ><i class="fa fa-tumblr"></i></a></li>
</ul>',
        'footer_content'          => '<div class="row">
<div class="col-md-6">
    <!-- Footer logo --> 
    <div class="footer-item footer-logo">
        <a href="'.esc_url( home_url('/' )).'" class="ajax"><img src="'.get_template_directory_uri().'/assets/images/footer-logo.png" alt="footer logo"></a>
        <p>Our team takes over everything, from an idea and concept development to realization. We believe in traditions and incorporate them within our innovations.Client is the soul of the project.  </p>
    </div>
    <!-- Footer logo end --> 
</div>
<!-- Footer info --> 
<div class="col-md-2">
    <div class="footer-item">
        <h4 class="text-link">Call</h4>
        <ul>
            <li><a href="#">+7(111)123456789</a></li>
            <li><a href="#">+1(000)987654321</a></li>
        </ul>
    </div>
</div>
<!-- Footer info end--> 
<!-- Footer info --> 
<div class="col-md-2">
    <div class="footer-item">
        <h4 class="text-link">Write</h4>
        <ul>
            <li><a href="#">yourmail@domain.com</a></li>
            <li><a href="#">email@website.com</a></li>
        </ul>
    </div>
</div>
<!-- Footer info-->
<!-- Footer info end--> 
<div class="col-md-2">
    <div class="footer-item">
        <h4 class="text-link">Visit</h4>
        <ul>
            <li><span>USA 27TH BROOKLYN NY</span></li>
            <li> <a href="#" target="_blank">View on map</a></li>
        </ul>
    </div>
</div>
<!-- Footer info end--> 
</div>
<!-- Footer copyright -->
<div class="row">
<div class="col-md-6"></div>
<div class="col-md-6">
    <div class="footer-wrap">
        <span class="copyright">  &#169; Lambert 2016. All rights reserved.  
        </span>
        <span class="to-top">To Top</span>
    </div>
</div>
</div>
<!-- Footer copyright end -->',
        'show_constellation'        => true,
        'share_names'               => 'facebook,pinterest,googleplus,twitter,linkedin',
        'show_folio_header'         => true,

    );

    if( is_customize_preview() ) $lambert_options = get_option( 'lambert_options', array() );

    $value = false;
    if ( isset( $lambert_options[ $setting ] ) ) {
        $value = $lambert_options[ $setting ];
    }else {
        if(isset($default)){
            $value = $default;
        }else if( isset( $default_options[ $setting ] ) ){
            $value = $default_options[ $setting ];
        }
    }
    return $value;
}


/** 
 * Global variables fix
 * https://forums.envato.com/t/redux-framework-global-variable-issue/36739
 */ 
if ( !function_exists('lambert_global_var') ) {
    function lambert_global_var($opt_1 = '', $opt_2 = '', $opt_check = false){
        global $lambert_options;
        if( is_customize_preview() ) $lambert_options = get_option( 'lambert_options', array() );
        if( $opt_check ) {
            if( isset($lambert_options[$opt_1]) && isset($lambert_options[$opt_1][$opt_2]) ) {
                return $lambert_options[$opt_1][$opt_2];
            }
        } else {
            if(isset($lambert_options[$opt_1])) {
                return $lambert_options[$opt_1];
            }
        }

        return false;
        
    }
}

if(!function_exists('lambert_get_template_part')){
    /**
     * Load a template part into a template
     *
     * Makes it easy for a theme to reuse sections of code in a easy to overload way
     * for child themes.
     *
     * Includes the named template part for a theme or if a name is specified then a
     * specialised part will be included. If the theme contains no {slug}.php file
     * then no template will be included.
     *
     * The template is included using require, not require_once, so you may include the
     * same template part multiple times.
     *
     * For the $name parameter, if the file is called "{slug}-special.php" then specify
     * "special".
      * For the var parameter, simple create an array of variables you want to access in the template
     * and then access them e.g. 
     * 
     * array("var1=>"Something","var2"=>"Another One","var3"=>"heres a third";
     * 
     * becomes
     * 
     * $var1, $var2, $var3 within the template file.
     *
     *
     * @param string $slug The slug name for the generic template.
     * @param string $name The name of the specialised template.
     * @param array $vars The list of variables to carry over to the template
     * @author CTHthemes 
     * @ref http://www.zmastaa.com/2015/02/06/php-2/wordpress-passing-variables-get_template_part
     * @ref http://keithdevon.com/passing-variables-to-get_template_part-in-wordpress/
     */
    function lambert_get_template_part( $slug, $name = null, $vars = null ) {
        $template_name = "{$slug}.php";
        $name      = (string) $name;
        if ( '' !== $name ) {
            $template_name = "{$slug}-{$name}.php";
        }
        $located = locate_template($template_name, false);
        if($located !== ''){
            /*
             * This use of extract() cannot be removed. There are many possible ways that
             * templates could depend on variables that it creates existing, and no way to
             * detect and deprecate it.
             *
             * Passing the EXTR_SKIP flag is the safest option, ensuring globals and
             * function variables cannot be overwritten.
             */
            // phpcs:ignore WordPress.PHP.DontExtract.extract_extract
            if(isset($vars)) extract($vars, EXTR_SKIP);
            include $located;
        }
    }
}

/**
 * Custom comments list
 *
 */
if (!function_exists('lambert_comments')) {
    function lambert_comments($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        extract($args, EXTR_SKIP);
        
        if ('div' == $args['style']) {
            $tag = 'div';
            $add_below = 'comment';
        } 
        else {
            $tag = 'li';
            $add_below = 'div-comment';
        }
?>
        <<?php
        echo esc_attr($tag); ?> <?php
        comment_class(empty($args['has_children']) ? 'media' : 'media parent') ?> id="comment-<?php
        comment_ID() ?>">
        <?php
        if ('div' != $args['style']): ?>
        <div id="div-comment-<?php
            comment_ID() ?>" class="comment-body">
        <?php
        endif; ?>

            <div class="comment-author">
                <?php
        if ($args['avatar_size'] != 0) echo get_avatar($comment, $args['avatar_size']); ?>
            </div>
            <cite class="fn"><a href="#"><?php
        echo get_comment_author_link($comment->comment_ID); ?></a></cite>
            <div class="comment-meta">
                <h6><a href="#"><?php
        echo get_comment_date(esc_html__('F j, Y g:i a', 'lambert')); ?></a> / <?php
        comment_reply_link(array_merge($args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))); ?></h6>
            </div>
            <?php
        comment_text(); ?>

            <?php
        if ($comment->comment_approved == '0'): ?>
                <em class="comment-awaiting-moderation aligncenter"><?php
            esc_html_e('Your comment is awaiting moderation.', 'lambert'); ?></em>
                <br />
            <?php
        endif; ?>
        
        
        
        <?php
        if ('div' != $args['style']): ?>
        </div> 
        <?php
        endif; ?>

    <?php
    }
}

function lambert_relative_protocol_url(){
    return is_ssl() ? 'https' : 'http';
}
