<?php

add_action('wp_ajax_nopriv_lambert_lm_gal', 'lambert_lm_gal_callback');
add_action('wp_ajax_lambert_lm_gal', 'lambert_lm_gal_callback');

function lambert_lm_gal_callback(){
    

    $output = array();
    $output['status'] = 'fail';
    if ( ! isset( $_POST['_lmnonce'] ) || ! wp_verify_nonce( $_POST['_lmnonce'], 'lambert_lm_gal' ) ) {
        // This nonce is not valid.
        $output['content'] = esc_html__('Sorry, your nonce did not verify.','lambert' );
        $output['is_remaining'] = 'no';
    } else {
        // The nonce was valid.
        // Do stuff here.
        $default_args = array(
            'post_type' => 'cthgallery',
            'paged' => 1,
            'posts_per_page'=> 3,
            'post__in' => array(),
            'post__not_in' => array(),
            'order_by'=> 'date',
            'order'=> 'DESC',
            'cat'=> '',
            'lmore_items'=> 3,
        );

        $args = wp_parse_args( $_POST['wp_query'], $default_args );

        $lmore_items = $args['lmore_items'];

        if(isset($args['enable_gallery'])){
            $enable_gallery = $args['enable_gallery'];
            unset($args['enable_gallery']);
        }else{
            $enable_gallery = lambert_global_var('gallery_enable_gallery');
        }
        
        unset($args['action']);
        unset($args['lmore_items']);
        

        $args['offset'] = $current_offset = $args['posts_per_page'] + $lmore_items*($_POST['click_num']-1);
        $args['posts_per_page'] = $lmore_items;

        $gal_posts = new WP_Query($args);
        ob_start(); 
        if($gal_posts->have_posts()) : 
            
            while($gal_posts->have_posts()) : $gal_posts->the_post(); 
                
                lambert_get_template_part( 'template-parts/gal/list', '', array( 'enable_gallery'=>$enable_gallery ) ); 
                
            endwhile;

        endif;

        $output['status'] = 'success';

        $output['content'] = ob_get_clean();

        //check for remaining items
        if($gal_posts->found_posts && $gal_posts->found_posts > $current_offset + $lmore_items){
            $output['is_remaining'] = 'yes';
        }else{
            $output['is_remaining'] = 'no';
        }

        wp_reset_postdata();
    }
    wp_send_json( $output );
}


add_action('wp_ajax_nopriv_lambert_lm_gallery', 'lambert_lm_gallery_callback');
add_action('wp_ajax_lambert_lm_gallery', 'lambert_lm_gallery_callback');

function lambert_lm_gallery_callback(){
    $output = array();
    $output['status'] = 'fail';
    $output['content'] = '';
    $output['is_remaining'] = 'no';
    if ( ! isset( $_POST['_lmnonce'] ) || ! wp_verify_nonce( $_POST['_lmnonce'], 'lambert_lm_gallery' ) ) {
        // This nonce is not valid.
        $output['content'] = esc_html__('Sorry, your nonce did not verify.','lambert' );
        $output['is_remaining'] = 'no';
    } else {
        // The nonce was valid.
        // Do stuff here.
        $default_args = array(
            'images' => '',
            'lmore_items'=> 3,
        );

        $args = wp_parse_args( $_POST['wp_query'], $default_args );
        $lmore_items = $args['lmore_items'];
        $lmore_images = $args['images'];
        $loaded = $args['loaded'];
        // $show_zoom = $args['show_zoom'];

        // if(isset($args['show_img_title'])){
        //     $show_img_title = $args['show_img_title'];
        // }else{
        //     $show_img_title = 'no';
        // }

        // if(isset($args['show_img_desc'])){
        //     $show_img_desc = $args['show_img_desc'];
        // }else{
        //     $show_img_desc = 'no';
        // }

        // if(isset($args['open_desc_link'])){
        //     $open_desc_link = $args['open_desc_link'];
        // }else{
        //     $open_desc_link = 'no';
        // }
        // if(isset($args['target'])){
        //     $target = $args['target'];
        // }else{
        //     $target = '_self';
        // }

        $loaded += $lmore_items*($_POST['click_num']-1);
        $new_loaded = $loaded + $lmore_items;

        if(!empty($lmore_images)){

            $images = explode(",", $lmore_images);

            if(!empty($images)) : 

            ob_start(); 

            foreach ($images as $key => $img_id) {
                if($key >= $loaded && $key < $new_loaded) {
                    

                    $at_img = get_post($img_id);

                    $at_tit = $at_img->post_title;
                    $at_cap = $at_img->post_excerpt;
                    $at_des = $at_img->post_content;

                    $item_w = ' image-id-'.$img_id;

                    if( preg_match_all('/-f-([^-]*)-f-/m', $at_cap, $matches ) !== false ){
                        if(!empty($matches[1])){
                            foreach ($matches[1] as $fil) {
                                $item_w .= ' filter-'.sanitize_title( $fil );
                            }
                        }
                    }

                    $image_size = 'lambert-gallery-one';

                    if(strpos($at_des, "size-two") !== false){
                        $item_w .= ' gallery-item-second';
                        $image_size = 'lambert-gallery-second';
                    }
                    if(strpos($at_des, "size-three") !== false){
                        $item_w .= ' gallery-item-three';
                        $image_size = 'lambert-gallery-three';
                    }


            ?>
                <div class="gallery-item <?php echo esc_attr( $item_w );?>">
                    <div class="grid-item-holder">
                        <div class="box-item">

                            <a href="<?php echo esc_url(wp_get_attachment_url( $img_id ) );?>"  class="por-linksss" title="<?php echo get_the_title($img_id);?>">
                                <span class="overlay"></span>
                                <i class="fa fa-image"></i>
                                <?php echo wp_get_attachment_image($img_id, $image_size ); ?>
                                
                            </a>
                        </div>
                    </div>
                </div>

        <?php
                }

            }

            if($key >= $new_loaded){
                $output['is_remaining'] = 'yes';
            }

            $output['content'] = ob_get_clean();

            endif;

        }


        $output['status'] = 'success';

    }
    wp_send_json( $output );

}



add_action('wp_ajax_memPop', 'lambert_member_popup_content');
add_action('wp_ajax_nopriv_memPop', 'lambert_member_popup_content'); // not really needed

function lambert_member_popup_content() {
    $id = (int)$_GET['id'];

    // setup your query to get what you want
    $args = array(
        'post_type' => 'member',
        'post__in' => (array)$id,
    );
    $member = new WP_Query($args);

    // initialsise your output
    $output = '<div id="custom-content" class="white-popup-block"><div class="team-modal"><a href="#" class="popup-modal-dismiss"><i class="fa fa-compress"></i></a>';
    // the Loop
    while ($member->have_posts()) : $member->the_post();

        $output .= do_shortcode(get_the_content( ) );

    endwhile;

    $output .= '</div></div>';
    // Reset Query
    wp_reset_postdata();


    echo wp_kses_post($output );

    die();

}

add_action('wp_ajax_lambert_member_popup', 'lambert_member_popup_callback');
add_action('wp_ajax_nopriv_lambert_member_popup', 'lambert_member_popup_callback'); // not really needed

function lambert_member_popup_callback() {
    $id = (int)$_GET['id'];

    // setup your query to get what you want
    $args = array(
        'post_type' => 'member',
        'p' => $id,
    );
    $member = new WP_Query($args);

    // initialsise your output
    $output = '<div id="custom-content" class="white-popup-block"><div class="team-modal"><a href="#" class="popup-modal-dismiss"><i class="fa fa-compress"></i></a>';
    // the Loop
    while ($member->have_posts()) : $member->the_post();
        $mem_job = get_post_meta(get_the_ID(),'_cmb_mem_job',true);
        ob_start();
    ?>
    <div class="row-fluid member-popup-content-wrap">
        <div class="col-md-6">
            <?php the_post_thumbnail('full',array('class'=>'res-image') ); ?>
        </div>
        <div class="col-md-6">
            <div class="section-title">
                <h3><?php the_title( );?></h3>
                <?php if(!empty($mem_job)) :?>
                <h4 class="decor-title"><?php echo wp_kses_post( $mem_job );?></h4>
                <div class="separator color-separator"></div>
                <?php endif;?>
            </div>
            <?php the_excerpt();?>
            <?php
                $facebookurl = get_post_meta( get_the_ID(), '_cmb_facebookurl', true );
                $twitterurl = get_post_meta( get_the_ID(), '_cmb_twitterurl', true );
                $googleplusurl = get_post_meta( get_the_ID(), '_cmb_googleplusurl', true );
                $dribbbleurl = get_post_meta( get_the_ID(), '_cmb_dribbbleurl', true );
                $linkedinurl = get_post_meta( get_the_ID(), '_cmb_linkedinurl', true );
                $instagramurl = get_post_meta( get_the_ID(), '_cmb_instagramurl', true );
                $tumblrurl = get_post_meta( get_the_ID(), '_cmb_tumblrurl', true );
                $pinterestrurl = get_post_meta( get_the_ID(), '_cmb_pinterestrurl', true );
                if($facebookurl != '' || $twitterurl != '' ||$googleplusurl != '' ||$dribbbleurl != '' ||$linkedinurl != '' ||$instagramurl != '' ||$tumblrurl != '' ||$pinterestrurl != '') : 
            ?>
            <h5><?php esc_html_e('Find on :','lambert' );?></h5>
            <ul class="team-social">
                <?php if($facebookurl!=''){ ?>
                <li><a class="elem" href="<?php echo esc_url($facebookurl); ?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
                <?php } ?>
                <?php if($twitterurl!=''){ ?>
                <li><a class="elem" href="<?php echo esc_url($twitterurl); ?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
                <?php } ?>
                <?php if($googleplusurl!=''){ ?>
                <li><a class="elem" href="<?php echo esc_url($googleplusurl); ?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
                <?php } ?>
                <?php if($dribbbleurl!=''){ ?>
                <li><a class="elem" href="<?php echo esc_url($dribbbleurl); ?>" target="_blank"><i class="fa fa-dribbble"></i></a></li>
                <?php } ?>
                <?php if($linkedinurl!=''){ ?>
                <li><a class="elem" href="<?php echo esc_url($linkedinurl); ?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                <?php } ?>
                <?php if($instagramurl!=''){ ?>
                <li><a class="elem" href="<?php echo esc_url($instagramurl); ?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
                <?php } ?>
                <?php if($tumblrurl!=''){ ?>
                <li><a class="elem" href="<?php echo esc_url($tumblrurl); ?>" target="_blank"><i class="fa fa-tumblr"></i></a></li>
                <?php } ?>
                <?php if($pinterestrurl!=''){ ?>
                <li><a class="elem" href="<?php echo esc_url($pinterestrurl); ?>" target="_blank"><i class="fa fa-pinterest-square"></i></a></li>
                <?php } ?>
                
            </ul>
            <?php 
                endif;
            ?>


        </div>
    </div>
    <?php

        $output .= ob_get_clean(); // do_shortcode( get_the_content( ) );

    endwhile;

    $output .= '</div></div>';
    // Reset Query
    wp_reset_postdata();


    echo wp_kses_post($output );

    die();

}



