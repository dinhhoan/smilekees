<?php
/* banner-php */

$item_classes = array();
$sizer_option = get_post_meta( get_the_ID(), '_cmb_masonry_size', true ) ;
$item_classes[] = 'gallery-item-'. $sizer_option;
$item_classes = implode(" ", $item_classes);


$masonry_thumb_size = 'lambert-gallery-'.$sizer_option;
$gallery_popup_link = get_post_meta(get_the_ID(), '_cmb_gallery_popup_link', true);
if (isset($enable_gallery)) {
    //$enable_gallery = false;
    if($enable_gallery === 'yes'||$enable_gallery == true){
        $enable_gallery = true;
    }else {
    	$enable_gallery = false;
    }
}else{
    $enable_gallery =  lambert_global_var('gallery_enable_gallery');
}


$popup_cls = '';
$popup_icon = 'fa fa-image';
if($gallery_popup_link){
    $item_classes .= ' has-popup';
    $url_args = parse_url($gallery_popup_link);
    $popup_cls = 'image-popup';
    $popup_icon = 'fa fa-search';
    if($enable_gallery) {
        $popup_cls = 'gal-popup-gallery';
        $popup_icon = 'fa fa-image';
    }
    switch($url_args['host']) {
        case 'youtu.be':
        case 'www.youtube.com':
        case 'youtube.com':
        case 'vimeo.com':
        case 'www.vimeo.com':
        case 'soundcloud.com':
            if($enable_gallery) {
                $popup_cls .= ' mfp-iframe';
                $popup_icon = 'fa fa-play-circle';
            }else{
                $popup_cls = 'popup-youtube';
                $popup_icon = 'fa fa-play-circle';
            }
            
            break;
    }
}elseif($enable_gallery){
    $item_classes .= ' has-popup';
    $popup_cls = 'gal-popup-gallery';
    $gallery_popup_link = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
    $popup_icon = 'fa fa-image';
}
?>
<div <?php post_class('gallery-item '.$item_classes);?>>
	<div class="grid-item-holder">
        <div class="box-item">
        <?php if( $popup_cls != ''): ?>
            <a href="<?php echo esc_url($gallery_popup_link );?>"  class="por-link <?php echo esc_attr($popup_cls );?>" title="<?php the_title();?>">
            	<span class="overlay"></span>
		        <i class="<?php echo esc_attr($popup_icon );?>"></i>
        <?php else : ?>
			<a href="<?php the_permalink();?>"  class="to-gal-single" title="<?php the_title();?>">
				<span class="overlay"></span>
		        <i class="fa fa-link"></i>
        <?php endif; ?>
	            
	            <?php the_post_thumbnail($masonry_thumb_size,array('class'=>'galimg'));?>
            </a>
        </div>
    </div>
</div>

