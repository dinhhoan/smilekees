// Page preload ------------------
jQuery(window).load(function() {
    "use strict";
    if(jQuery("#lambert-loader").length){
        jQuery(".lambert-loader").fadeOut(500, function() {
            jQuery("#main").animate({
                opacity: "1"
            }, 500);
        });
    }
});

// all functions ------------------
function initLambert() {
    "use strict";
    if (jQuery("header.mainpage-header").hasClass("flat-header")) jQuery('<div clas="height-emulator"></div>').prependTo("#wrapper").css({
        height: jQuery("header.mainpage-header").outerHeight(true)
    });
    if(jQuery('.hide-single-head').length){
        jQuery("header.mainpage-header").addClass('flat-header');
        jQuery('.hide-single-head').css({ 'margin-top': jQuery("header.mainpage-header").outerHeight(true) });
    }
    function a() {
        jQuery(".hero-title").css({
            "margin-top": -1 * jQuery(".hero-title").height() / 2 + "px"
        });
        jQuery(".carousel-link-holder").css({
            "margin-top": -1 * jQuery(".carousel-link-holder").height() / 2 + "px"
        });
        jQuery(".full-height").css({
            height: jQuery(window).outerHeight(true)
        });
        var ww = jQuery(window).width();
        if(ww > 992){
            jQuery('.nav-holder').css('display','block');
        }else {
            jQuery('.nav-holder').css('display','none');
        }
    }
    a();
    jQuery(window).resize(function(){
        a();
    })
	// magnificPopup------------------
    jQuery(".image-popup").each(function(){
        jQuery(this).magnificPopup({
            type: "image",
            closeOnContentClick: false,
            removalDelay: 600,
            mainClass: "my-mfp-slide-bottom",
            image: {
                verticalFit: true
            }
        });
    });
    jQuery(".popup-youtube, .popup-vimeo , .show-map").each(function(){
        jQuery(this).magnificPopup({
            disableOn: 700,
            type: "iframe",
            removalDelay: 600,
            mainClass: "my-mfp-slide-bottom"
        });
    });
    jQuery(".popup-gallery").each(function(){
        jQuery(this).magnificPopup({
            delegate: "a:not(.popup-youtube,.popup-vimeo)",
            type: "image",
            fixedContentPos: true,
            fixedBgPos: true,
            tLoading: "Loading image #%curr%...",
            removalDelay: 600,
            closeBtnInside: true,
            mainClass: "my-mfp-slide-bottom",
            gallery: {
                enabled: true,
                navigateByImgClick: true,
                preload: [ 0, 1 ]
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.'
            }
        });
    });
    jQuery(".popup-with-move-anim").each(function(){
        jQuery(this).magnificPopup({
            type: "ajax",
            alignTop: false,
            overflowY: "scroll",
            fixedContentPos: true,
            fixedBgPos: true,
            closeBtnInside: false,
            midClick: true,
            modal: true,
            removalDelay: 600,
            mainClass: "my-mfp-slide-bottom"
        });
    });
    jQuery(document).on("click", ".popup-modal-dismiss", function(a) {
        a.preventDefault();
        jQuery.magnificPopup.close();
    });
	// owl carousel  ------------------

    var owlrtl = false;
    if(jQuery('body').hasClass('rtl')) owlrtl = true;

    jQuery(".fullscreen-slider").each(function(){

        var fhowl = jQuery(this) ;

        var fhowl_df = {animateOut:false,animateIn:false,responsive: false, smartSpeed:1300,autoplay:false,items:1,loop:true,nav: false, dots: true,center:false,autoWidth:false,autoHeight:false};
        var fhowl_ops = fhowl.data('options') ? fhowl.data('options') : {};
        fhowl_ops = jQuery.extend({}, fhowl_df, fhowl_ops);

        if(fhowl_ops.responsive){
                var respArr = fhowl_ops.responsive.split(',');
                fhowl_ops.responsive = {};
                for (var i = 0; i < respArr.length ; i++){
                    var tempVal = respArr[i].split(':');
                    fhowl_ops.responsive[tempVal[0]] = { 
                        items: parseInt(tempVal[1])
                    };

                }
            }else{
                fhowl_ops.responsive = false;
            }

        fhowl.owlCarousel({
            autoWidth: fhowl_ops.autoWidth,
            autoHeight: fhowl_ops.autoHeight,
            margin: 0,
            items: fhowl_ops.items,
            smartSpeed: fhowl_ops.smartSpeed,
            loop: fhowl_ops.loop,
            autoplay: fhowl_ops.autoplay,
            center: fhowl_ops.center,
            nav: fhowl_ops.nav,
            dots: fhowl_ops.dots,
            //thumbs: fhowl_ops.thumbs,
            responsive: fhowl_ops.responsive,
            // thumbImage: true,
            // thumbContainerClass: "owl-thumbs",
            // thumbItemClass: "owl-thumb-item",

            animateOut: fhowl_ops.animateOut,
            animateIn: fhowl_ops.animateIn,

            navText: ['',''],
            rtl:owlrtl,
        });

        jQuery(".fullscreen-slider-holder a.next-slide").on("click", function() {
            jQuery(this).closest(".fullscreen-slider-holder").find(fhowl).trigger("next.owl.carousel");
        });
        jQuery(".fullscreen-slider-holder a.prev-slide").on("click", function() {
            jQuery(this).closest(".fullscreen-slider-holder").find(fhowl).trigger("prev.owl.carousel");
        });


    });

    // var b = jQuery(".fullscreen-slider");
    // b.owlCarousel({
    //     navigation: false,
    //     slideSpeed: 500,
    //     singleItem: true,
    //     pagination: true
    // });
    // jQuery(".fullscreen-slider-holder a.next-slide").on("click", function() {
    //     jQuery(this).closest(".fullscreen-slider-holder").find(b).trigger("owl.next");
    // });
    // jQuery(".fullscreen-slider-holder a.prev-slide").on("click", function() {
    //     jQuery(this).closest(".fullscreen-slider-holder").find(b).trigger("owl.prev");
    // });
    // var c = jQuery(".testimonials-slider");
    // var optionsData = c.data('options') ? JSON.parse(decodeURIComponent(c.data('options'))) : {slidespeed:500,singleitem:true,autoplay:false};
    // if(!optionsData.itemsCustom) optionsData.itemsCustom = '320:1,768:1,992:1,1200:1';
    // var itemsCustomArr = optionsData.itemsCustom.split(',');
    // var itemsCustomVal = new Array();
    // for (var i = 0; i < itemsCustomArr.length ; i++){
    //     itemsCustomVal[i] = itemsCustomArr[i].split(':');
    // }
    // c.owlCarousel({
    //     navigation: false,
    //     slideSpeed: optionsData.slidespeed,
    //     singleItem: optionsData.singleitem,
    //     pagination: false,
    //     autoPlay  : optionsData.autoplay,
    //     autoHeight:true,
    //     responsiveRefreshRate: 200,
    //     itemsCustom: itemsCustomVal,
        
    // });
    // jQuery(".testimonials-holder a.next-slide").on("click", function() {
    //     jQuery(this).closest(".testimonials-holder").find(c).trigger("owl.next");
    // });
    // jQuery(".testimonials-holder a.prev-slide").on("click", function() {
    //     jQuery(this).closest(".testimonials-holder").find(c).trigger("owl.prev");
    // });
    jQuery(".testimonials-slider").each(function(){

        var fhowl = jQuery(this) ;

        var fhowl_df = {animateOut:false,animateIn:false,responsive: false, smartSpeed:500,autoplay:false,items:1,loop:true,nav: false, dots: false,center:false,autoWidth:false,autoHeight:true};
        var fhowl_ops = fhowl.data('options') ? fhowl.data('options') : {};
        fhowl_ops = jQuery.extend({}, fhowl_df, fhowl_ops);

        if(fhowl_ops.responsive){
                var respArr = fhowl_ops.responsive.split(',');
                fhowl_ops.responsive = {};
                for (var i = 0; i < respArr.length ; i++){
                    var tempVal = respArr[i].split(':');
                    fhowl_ops.responsive[tempVal[0]] = { 
                        items: parseInt(tempVal[1])
                    };

                }
            }else{
                fhowl_ops.responsive = false;
            }

        fhowl.owlCarousel({
            autoWidth: fhowl_ops.autoWidth,
            autoHeight: fhowl_ops.autoHeight,
            margin: 0,
            items: fhowl_ops.items,
            smartSpeed: fhowl_ops.smartSpeed,
            loop: fhowl_ops.loop,
            autoplay: fhowl_ops.autoplay,
            center: fhowl_ops.center,
            nav: fhowl_ops.nav,
            dots: fhowl_ops.dots,
            responsive: fhowl_ops.responsive,

            animateOut: fhowl_ops.animateOut,
            animateIn: fhowl_ops.animateIn,

            navText: ['',''],
            rtl:owlrtl,
        });

        jQuery(".testimonials-holder a.next-slide").on("click", function() {
            jQuery(this).closest(".testimonials-holder").find(fhowl).trigger("next.owl.carousel");
        });
        jQuery(".testimonials-holder a.prev-slide").on("click", function() {
            jQuery(this).closest(".testimonials-holder").find(fhowl).trigger("prev.owl.carousel");
        });


    });

    jQuery(".slideshow-container").superslides({
        animation: "fade",
        play: 6000
    });	
    jQuery(".fullheight-carousel").each(function(){

        var fhowl = jQuery(this) ;

        var fhowl_df = {animateOut:false,animateIn:false,responsive: false, smartSpeed:500,autoplay:false,items:4,loop:true,nav: false, dots: false,center:false,autoWidth:false,autoHeight:false,slideBy: 1};
        var fhowl_ops = fhowl.data('options') ? fhowl.data('options') : {};
        fhowl_ops = jQuery.extend({}, fhowl_df, fhowl_ops);

        if(fhowl_ops.responsive){
                var respArr = fhowl_ops.responsive.split(',');
                fhowl_ops.responsive = {};
                for (var i = 0; i < respArr.length ; i++){
                    var tempVal = respArr[i].split(':');
                    fhowl_ops.responsive[tempVal[0]] = { 
                        items: parseInt(tempVal[1])
                    };

                }
            }else{
                fhowl_ops.responsive = false;
            }

        fhowl.owlCarousel({
            autoWidth: fhowl_ops.autoWidth,
            autoHeight: fhowl_ops.autoHeight,
            margin: 0,
            items: fhowl_ops.items,
            smartSpeed: fhowl_ops.smartSpeed,
            loop: fhowl_ops.loop,
            autoplay: fhowl_ops.autoplay,
            center: fhowl_ops.center,
            nav: fhowl_ops.nav,
            dots: fhowl_ops.dots,
            responsive: fhowl_ops.responsive,

            animateOut: fhowl_ops.animateOut,
            animateIn: fhowl_ops.animateIn,

            navText: ['',''],
            rtl:owlrtl,

            slideBy : fhowl_ops.slideBy,
        });
        jQuery(".fullheight-carousel-holder a.next-slide").on("click", function() {
            jQuery(this).closest(".fullheight-carousel-holder").find(fhowl).trigger("next.owl.carousel");
        });
        jQuery(".fullheight-carousel-holder a.prev-slide").on("click", function() {
            jQuery(this).closest(".fullheight-carousel-holder").find(fhowl).trigger("prev.owl.carousel");
        });
        jQuery(".carousel-link-holder").hover(function() {
            jQuery(this).parent(".carousel-item").addClass("vis-decor");
        }, function() {
            jQuery(this).parent(".carousel-item").removeClass("vis-decor");
        });

    });
    
    // jQuery(".single-slider").each(function(){
    //     var e = jQuery(this);
    //     var optionsData = e.data('options') ? JSON.parse(decodeURIComponent(e.data('options'))) : {slidespeed:1000,singleitem:true,autoplay:false};
    //     if(!optionsData.itemsCustom) optionsData.itemsCustom = '320:1,768:1,992:1,1200:1';
    //     var itemsCustomArr = optionsData.itemsCustom.split(',');
    //     var itemsCustomVal = new Array();
    //     for (var i = 0; i < itemsCustomArr.length ; i++){
    //         itemsCustomVal[i] = itemsCustomArr[i].split(':');
    //     }
    //     e.owlCarousel({
    //         navigation: false,
    //         slideSpeed: optionsData.slidespeed,
    //         singleItem: optionsData.singleitem,
    //         pagination: true,
    //         autoPlay  : optionsData.autoplay,
    //         autoHeight:true,
    //         responsiveRefreshRate: 200,
    //         itemsCustom: itemsCustomVal,
            
    //     });
    //     jQuery(".single-slider-holder a.next-slide").on("click", function() {
    //         jQuery(this).closest(".single-slider-holder").find(e).trigger("owl.next");
    //     });
    //     jQuery(".single-slider-holder a.prev-slide").on("click", function() {
    //         jQuery(this).closest(".single-slider-holder").find(e).trigger("owl.prev");
    //     });
    // });
    jQuery(".single-slider").each(function(){

        var fhowl = jQuery(this) ;

        var fhowl_df = {animateOut:false,animateIn:false,responsive: false, smartSpeed:1000,autoplay:false,items:1,loop:true,nav: true, dots: true,center:false,autoWidth:false,autoHeight:true};
        var fhowl_ops = fhowl.data('options') ? fhowl.data('options') : {};
        fhowl_ops = jQuery.extend({}, fhowl_df, fhowl_ops);

        if(fhowl_ops.responsive){
                var respArr = fhowl_ops.responsive.split(',');
                fhowl_ops.responsive = {};
                for (var i = 0; i < respArr.length ; i++){
                    var tempVal = respArr[i].split(':');
                    fhowl_ops.responsive[tempVal[0]] = { 
                        items: parseInt(tempVal[1])
                    };

                }
            }else{
                fhowl_ops.responsive = false;
            }

        fhowl.owlCarousel({
            autoWidth: fhowl_ops.autoWidth,
            autoHeight: fhowl_ops.autoHeight,
            margin: 0,
            items: fhowl_ops.items,
            smartSpeed: fhowl_ops.smartSpeed,
            loop: fhowl_ops.loop,
            autoplay: fhowl_ops.autoplay,
            center: fhowl_ops.center,
            nav: fhowl_ops.nav,

            dots: fhowl_ops.dots,
            responsive: fhowl_ops.responsive,

            animateOut: fhowl_ops.animateOut,
            animateIn: fhowl_ops.animateIn,

            navText: ['',''],
            rtl:owlrtl,
        });

        jQuery(".single-slider-holder a.next-slide").on("click", function() {
            jQuery(this).closest(".single-slider-holder").find(fhowl).trigger("next.owl.carousel");
        });
        jQuery(".single-slider-holder a.prev-slide").on("click", function() {
            jQuery(this).closest(".single-slider-holder").find(fhowl).trigger("prev.owl.carousel");
        });


    });
    

    // var bpsl = jQuery(".blog-post-slider");
    // bpsl.owlCarousel({
    //     singleItem: true,
    //     slideSpeed: 1000,
    //     navigation: false,
    //     pagination: true,
    //     responsiveRefreshRate: 200,
    //     autoHeight: true
    // });
    // jQuery(".blog-post-slider-holder a.next-slide").on("click", function() {
    //     jQuery(this).closest(".blog-post-slider-holder").find(bpsl).trigger("owl.next");
    // });
    // jQuery(".blog-post-slider-holder a.prev-slide").on("click", function() {
    //     jQuery(this).closest(".blog-post-slider-holder").find(bpsl).trigger("owl.prev");
    // });


    // var f = jQuery(".product-slider");
    // f.owlCarousel({
    //     navigation: false,
    //     slideSpeed: 300,
    //     paginationSpeed: 400,
    //     singleItem: true,
    //     afterInit: g
    // });
    // jQuery(".product-image a.next-slide").on("click", function() {
    //     jQuery(this).closest(".product-image").find(f).trigger("owl.next");
    // });
    // jQuery(".product-image a.prev-slide").on("click", function() {
    //     jQuery(this).closest(".product-image").find(f).trigger("owl.prev");
    // });
    function g() {
        jQuery(".owl-controls .owl-page").append('<a class="item-link" href="#"/>');
        var a = jQuery(".owl-controls .item-link");
        jQuery.each(this.owl.userItems, function(b) {
            jQuery(a[b]).css({
                background: "url(" + jQuery(this).find("img").attr("src") + ") center center no-repeat",
                "-webkit-background-size": "cover",
                "-moz-background-size": "cover",
                "-o-background-size": "cover",
                "background-size": "cover"
            }).click(function(a) {
                a.preventDefault();
                owl.trigger("owl.goTo", b);
            });
        });
    }
    // var h = jQuery(".twitter-slider");
    // h.owlCarousel({
    //     navigation: false,
    //     slideSpeed: 500,
    //     pagination: false,
    //     autoHeight: false,
    //     singleItem: true
    // });
    // jQuery(".twitter-holder .next-slide").on("click", function() {
    //     jQuery(this).closest(".twitter-holder").find(h).trigger("owl.next");
    // });
    // jQuery(".twitter-holder .prev-slide").on("click", function() {
    //     jQuery(this).closest(".twitter-holder").find(h).trigger("owl.prev");
    // });
    jQuery(".twitter-slider").each(function(){

        var fhowl = jQuery(this) ;

        var fhowl_df = {animateOut:false,animateIn:false,responsive: false, smartSpeed:500,autoplay:false,items:1,loop:true,nav: false, dots: false,center:false,autoWidth:false,autoHeight:false};
        var fhowl_ops = fhowl.data('options') ? fhowl.data('options') : {};
        fhowl_ops = jQuery.extend({}, fhowl_df, fhowl_ops);

        if(fhowl_ops.responsive){
                var respArr = fhowl_ops.responsive.split(',');
                fhowl_ops.responsive = {};
                for (var i = 0; i < respArr.length ; i++){
                    var tempVal = respArr[i].split(':');
                    fhowl_ops.responsive[tempVal[0]] = { 
                        items: parseInt(tempVal[1])
                    };

                }
            }else{
                fhowl_ops.responsive = false;
            }

        fhowl.owlCarousel({
            autoWidth: fhowl_ops.autoWidth,
            autoHeight: fhowl_ops.autoHeight,
            margin: 0,
            items: fhowl_ops.items,
            smartSpeed: fhowl_ops.smartSpeed,
            loop: fhowl_ops.loop,
            autoplay: fhowl_ops.autoplay,
            center: fhowl_ops.center,
            nav: fhowl_ops.nav,
            dots: fhowl_ops.dots,
            responsive: fhowl_ops.responsive,
            animateOut: fhowl_ops.animateOut,
            animateIn: fhowl_ops.animateIn,
            navText: ['',''],
            rtl:owlrtl,
        });

        jQuery(".twitter-holder .next-slide").on("click", function() {
            jQuery(this).closest(".twitter-holder").find(fhowl).trigger("next.owl.carousel");
        });
        jQuery(".twitter-holder .prev-slide").on("click", function() {
            jQuery(this).closest(".twitter-holder").find(fhowl).trigger("prev.owl.carousel");
        });

    });

    jQuery(".refrestonresizeowl").each(function(){
        var slider = jQuery(this);
        jQuery(window).on('resize',function(){
            if(slider.find(".owl-stage-outer").length) slider.trigger('refresh.owl.carousel');
        });
    });

	// tabs------------------
    jQuery(".tabs-menu a").on("click", function(a) {
        a.preventDefault();
        jQuery(this).parent().addClass("current");
        jQuery(this).parent().siblings().removeClass("current");
        var b = jQuery(this).attr("href");
        jQuery(".tab-content").not(b).css("display", "none");
        jQuery(b).fadeIn();
    });
	// one page nav ------------------
    if(jQuery('.scroll-nav').length){
        jQuery(".scroll-nav ul").singlePageNav({
            filter: ":not(.external)",
            updateHash: false,
            offset: 90,
            threshold: 120,
            speed: 1200,
            currentClass: "act-link"
        });
    }
    
	// youtube video------------------

    jQuery(".background-video").each(function(){
        var that = jQuery(this);
        var l = that.data("vid");
        var m = that.data("mv") ? that.data("mv") : 1;
        var ql = that.data("ql") ? that.data("ql") : 'highres';
        var pos = that.data("pos") ? that.data("pos") : 1;
        var ftb = that.data("ftb") ? that.data("ftb") : 1;
        that.YTPlayer({
            fitToBackground: ftb,
            videoId: l,
            pauseOnScroll: pos,
            mute: m,
            //ratio: 16 / 9,// 4/3,
            playerVars: {
                modestbranding: 0,
                autoplay: 1,
                controls: 0,
                showinfo: 0,
                wmode: 'transparent',
                branding: 0,
                rel: 0,
                autohide: 0,
                origin: window.location.origin
            },
            callback: function() {
                var a = that.data("ytPlayer").player;
                a.setPlaybackQuality(ql);//small,medium,large,hd720,hd1080,highres,default
            }
        });
    });
	// isotope ------------------
    function k() {
        if (jQuery(".gallery-items").length) {
            jQuery(".gallery-items").each(function(){
                var that = jQuery(this),
                    gallery_container = that.closest('container-gallery');
                
                // var a = that.isotope({
                //     singleMode: true,
                //     columnWidth: ".grid-sizer, .grid-sizer-second, .grid-sizer-three",
                //     itemSelector: ".gallery-item, .gallery-item-second, .gallery-item-three"
                // });
                // a.imagesLoaded(function() {
                //     a.isotope("layout");
                // });

                var a = jQuery(this).isotope({
                    itemSelector: ".gallery-item, .gallery-item-second, .gallery-item-three",
                    percentPosition: true,
                    masonry: {
                        // use outer width of grid-sizer for columnWidth
                        columnWidth: ".grid-sizer, .grid-sizer-second, .grid-sizer-three",
                    },
                    transformsEnabled: true,
                    transitionDuration: "700ms",
                    resizable: true
                });
                a.imagesLoaded(function() {
                    a.isotope("layout");
                });

                
                // gallery_container.find('a.gallery-filter').on("click", function(b) {
                //     b.preventDefault();
                //     var c = jQuery(this).attr("data-filter");
                //     a.isotope({
                //         filter: c
                //     });
                //     gallery_container.find(".gallery-filters a.gallery-filter").removeClass("gallery-filter-active");
                //     jQuery(this).addClass("gallery-filter-active");
                //     initparallax();
                //     return false;
                // });
                jQuery(".gallery-filters").on("click", "a.gallery-filter", function(b) {
                    b.preventDefault();
                    var c = jQuery(this).attr("data-filter");
                    a.isotope({
                        filter: c
                    });
                    jQuery(".gallery-filters a.gallery-filter").removeClass("gallery-filter-active");
                    jQuery(this).addClass("gallery-filter-active");
                    initparallax();
                    return false;
                });

                /*infinite scroll*/

                var win = jQuery(window);

                var in_scroll_progress = false;

                var scroll_offset = 0;

                // Each time the user scrolls
                win.scroll(function() {
                    // End of the document reached?
                    /*check for gallery */
                    if(jQuery('.gallery-load-more').length){

                        if(jQuery('.gallery-load-more').scrollTop()){
                            var compare_pos = jQuery('.gallery-load-more').scrollTop();
                        }else{
                            var lm_anchor_pos = jQuery('.gallery-load-more').offset() ;
                            var compare_pos = lm_anchor_pos.top;
                        }

                        if (win.scrollTop() >= compare_pos - win.height() + scroll_offset ) {
                            if(!in_scroll_progress){
                                
                                in_scroll_progress = true;

                                var lm_btn = jQuery('.gallery-load-more');
                                var click_num = lm_btn.attr('data-click')? lm_btn.attr('data-click') : 1;
                                var remain = lm_btn.attr('data-remain')? lm_btn.attr('data-remain') : 'no';
                                if(remain == 'yes'){
                                    var grid_hoder = lm_btn.closest('.gallery-images-grid-wrap').children('.gallery-items');
                                    var ajaxurl = grid_hoder.data('lm-request');
                                    var lm_settings = grid_hoder.data('lm-settings')? grid_hoder.data('lm-settings'): {action:'lambert_lm_gallery',lmore_items:3,images:'',loaded:10};
                                    
                                    lm_btn.closest('.gallery-lmore-holder').css('visibility','visible');

                                    var ajaxdata = {
                                        action: lm_settings['action'],
                                        _lmnonce: grid_hoder.data('lm-nonce'),
                                        wp_query : lm_settings,
                                        click_num: click_num
                                    };
                                    //console.log(ajaxdata);

                                    jQuery.ajax({
                                        type: "POST",
                                        data: ajaxdata,
                                        url: ajaxurl,
                                        success: function(d) {
                                            //console.log(d);
                                            lm_btn.closest('.gallery-lmore-holder').css('visibility','hidden');
                                            if(d.status == 'fail'){
                                                lm_btn.attr('data-remain','no');
                                                lm_btn.closest('.gallery-lmore-holder').remove();

                                            }else if(d.status == 'success'){
                                                a.isotope();
                                                a.isotope( 'insert', jQuery(d.content) );
                                                a.imagesLoaded(function() {
                                                    a.isotope("layout");
                                                });

                                                if(d.is_remaining == 'no'){
                                                    lm_btn.attr('data-remain','no');
                                                    lm_btn.closest('.gallery-lmore-holder').remove();
                                                    
                                                }
                                            }

                                            lm_btn.attr('data-click',++click_num);

                                            in_scroll_progress = false;
                                            
                                        }
                                    });//end ajax


                                }//end remain
                                    
                            }//end in_scroll_progress
                        }//end compare position
                    }
                    /*check for portfolio */
                    if(jQuery('.gal-load-more').length){

                        //console.log('gal-load-more');

                        if(jQuery('.gal-load-more').scrollTop()){
                            var compare_pos = jQuery('.gal-load-more').scrollTop();
                        }else{
                            var lm_btn_pos = jQuery('.gal-load-more').offset() ;
                            var compare_pos = lm_btn_pos.top;
                        }
                        // console.log(compare_pos);
                        // console.log(win.scrollTop());
                        // console.log(win.height());
                        if (win.scrollTop() >= compare_pos - win.height() + scroll_offset ) {//win.scrollTop()) {

                            if(!in_scroll_progress){
                                
                                in_scroll_progress = true;

                                var lm_btn = jQuery('.gal-load-more');
                                var click_num = lm_btn.attr('data-click')? lm_btn.attr('data-click') : 1;
                                var remain = lm_btn.attr('data-remain')? lm_btn.attr('data-remain') : 'no';
                                var grid_hoder = lm_btn.closest('.gallery-grid-wrap').children('.gallery-items');
                                var ajaxurl = grid_hoder.data('lm-request');
                                var lm_settings = grid_hoder.data('lm-settings')? grid_hoder.data('lm-settings'): {action:'lambert_lm_gal',lmore_items:3};

                                if(remain === 'yes'){

                                    lm_btn.closest('.gal-grid-lmore-holder').css('visibility','visible');

                                    var ajaxdata = {
                                        action: lm_settings['action'],
                                        _lmnonce: grid_hoder.data('lm-nonce'),
                                        wp_query : lm_settings,
                                        click_num: click_num
                                    };

                                    jQuery.ajax({
                                        type: "POST",
                                        data: ajaxdata,
                                        url: ajaxurl,
                                        success: function(d) {
                                            lm_btn.closest('.gal-grid-lmore-holder').css('visibility','hidden');
                                            if(d.status == 'fail'){

                                                lm_btn.attr('data-remain','no');
                                                lm_btn.closest('.gal-grid-lmore-holder').remove();

                                            }else if(d.status == 'success'){
                                                a.isotope();
                                                a.isotope( 'insert', jQuery(d.content) );
                                                a.imagesLoaded(function() {
                                                    a.isotope("layout");
                                                });

                                                // var j = jQuery(".gallery-item").length;
                                                // jQuery(".all-album").html(j);

                                                if(d.is_remaining == 'no'){
                                                    
                                                    lm_btn.attr('data-remain','no');
                                                    lm_btn.closest('.gal-grid-lmore-holder').remove();
                                                }
                                            }

                                            lm_btn.attr('data-click',++click_num);

                                            in_scroll_progress = false;
                                            
                                        }
                                    });


                                }

                            }
                        }
                    }

                    
                });
                /*infinite scroll - end */

            });

        }
    }
    k();
    // jQuery(window).load(function() {
    //     k();
    // });
	// scroll------------------
    jQuery(".to-top").on("click", function() {
        jQuery("html, body").animate({
            scrollTop: 0
        }, 1200, "easeInOutExpo");
    });
    jQuery(".custom-scroll-link").on("click", function() {
        var a = 74;
        if (location.pathname.replace(/^\//, "") == this.pathname.replace(/^\//, "") || location.hostname == this.hostname) {
            var b = jQuery(this.hash);
            b = b.length ? b : jQuery("[name=" + this.hash.slice(1) + "]");
            if (b.length) {
                jQuery("html,body").animate({
                    scrollTop: b.offset().top - a
                }, {
                    queue: false,
                    duration: 1200,
                    easing: "easeInOutExpo"
                });
                return false;
            }
        }
    });
	// map ------------------
    if( jQuery('.lambert_gmap').length && null != window.google ){
        jQuery('.lambert_gmap').each(function(){
            var map = jQuery(this);
            var q = map.attr("data-latitude"), r = map.attr("data-longitude"), s = map.attr("data-location"), z = map.attr("data-zoom"), i = map.attr("data-marker"), a = map.attr("data-add");
            var a_obj = new Array({
                            latLng: [ q, r ],
                            data: s,
                            options: {
                                icon: i
                            }
                        });

            if(a != ''){
                var a_arr = a.split('|');
                //console.log(a_arr);
                var mar = 1;
                for (var ii = 0; ii < a_arr.length; ii++) {
                    if(a_arr[ii] !== ''){
                        var a_obj_val = a_arr[ii].split(";");
                        var new_ob = {};
                        if(a_obj_val.length == 3){
                            new_ob.latLng = [a_obj_val[0],a_obj_val[1]];
                            new_ob.data = a_obj_val[2];
                        }else if(a_obj_val.length == 2){
                            new_ob.latLng = [a_obj_val[0],a_obj_val[1]];
                            new_ob.data = '';
                        }
                        new_ob.options = {icon:i};
                        a_obj[mar] = new_ob;
                        mar++;
                        //console.log(new_ob);
                    }
                }
            }

            //console.log(a_obj);
            
            map.gmap3({
                action: "init",
                marker: {
                    // markers and locations------------------
                    values: a_obj ,
                    options: {
                        draggable: false
                    },
                    events: {
                        mouseover: function(a, b, c) {
                            var d = jQuery(this).gmap3("get"), e = jQuery(this).gmap3({
                                get: {
                                    name: "infowindow"
                                }
                            });
                            if (e) {
                                e.open(d, a);
                                e.setContent(c.data);
                            } else jQuery(this).gmap3({
                                infowindow: {
                                    anchor: a,
                                    options: {
                                        content: c.data
                                    }
                                }
                            });
                        },
                        mouseout: function() {
                            var a = jQuery(this).gmap3({
                                get: {
                                    name: "infowindow"
                                }
                            });
                            if (a) a.close();
                        }
                    }
                },
                map: {
                    options: {
                        zoom: parseInt(z),
                        zoomControl: true,
                        mapTypeControl: true,
                        scaleControl: true,
                        scrollwheel: false,
                        streetViewControl: true,
                        draggable: true,
                        styles: [ {
                            featureType: "all",
                            elementType: "labels.text",
                            stylers: [ {
                                weight: "0.04"
                            }, {
                                visibility: "simplified"
                            } ]
                        }, {
                            featureType: "administrative.locality",
                            elementType: "all",
                            stylers: [ {
                                hue: "#C59D5F"
                            }, {
                                saturation: 7
                            }, {
                                lightness: 19
                            }, {
                                visibility: "on"
                            } ]
                        }, {
                            featureType: "administrative.locality",
                            elementType: "labels.text",
                            stylers: [ {
                                hue: "#ffde00"
                            } ]
                        }, {
                            featureType: "landscape",
                            elementType: "all",
                            stylers: [ {
                                hue: "#ffffff"
                            }, {
                                saturation: -100
                            }, {
                                lightness: 100
                            }, {
                                visibility: "simplified"
                            } ]
                        }, {
                            featureType: "poi",
                            elementType: "all",
                            stylers: [ {
                                hue: "#C59D5F"
                            }, {
                                saturation: -100
                            }, {
                                lightness: 100
                            }, {
                                visibility: "off"
                            } ]
                        }, {
                            featureType: "road",
                            elementType: "geometry",
                            stylers: [ {
                                hue: "#C59D5F"
                            }, {
                                saturation: -93
                            }, {
                                lightness: 31
                            }, {
                                visibility: "simplified"
                            } ]
                        }, {
                            featureType: "road",
                            elementType: "labels",
                            stylers: [ {
                                hue: "#C59D5F"
                            }, {
                                saturation: -93
                            }, {
                                lightness: 31
                            }, {
                                visibility: "on"
                            } ]
                        }, {
                            featureType: "road.arterial",
                            elementType: "labels",
                            stylers: [ {
                                hue: "#C59D5F"
                            }, {
                                saturation: -93
                            }, {
                                lightness: -2
                            }, {
                                visibility: "simplified"
                            } ]
                        }, {
                            featureType: "road.local",
                            elementType: "geometry",
                            stylers: [ {
                                hue: "#C59D5F"
                            }, {
                                saturation: -90
                            }, {
                                lightness: -8
                            }, {
                                visibility: "simplified"
                            } ]
                        }, {
                            featureType: "transit",
                            elementType: "all",
                            stylers: [ {
                                hue: "#C59D5F"
                            }, {
                                saturation: 10
                            }, {
                                lightness: 69
                            }, {
                                visibility: "on"
                            } ]
                        }, {
                            featureType: "water",
                            elementType: "all",
                            stylers: [ {
                                hue: "#C59D5F"
                            }, {
                                saturation: -78
                            }, {
                                lightness: 67
                            }, {
                                visibility: "simplified"
                            } ]
                        } ]
                    }
                }
            });
        });
    }// end check for map
    jQuery(window).scroll(function() {
        if (jQuery(this).scrollTop() > 150) {
            jQuery("header.mainpage-header").addClass("sticky");
            setTimeout(function() {
                jQuery(".logo-holder").addClass("logo-sticky");
            }, 350);
        } else {
            jQuery("header.mainpage-header").removeClass("sticky");
            setTimeout(function() {
                jQuery(".logo-holder").removeClass("logo-sticky");
            }, 350);
        }
    });
	// video ------------------
    jQuery(".video-container").css("width", jQuery(window).width() + "px");
    jQuery(".video-container ").css("height", parseInt(720 / 1280 * jQuery(window).width()) + "px");
    if (jQuery(".video-container").height() < jQuery(window).height()) {
        jQuery(".video-container ").css("height", jQuery(window).height() + "px");
        jQuery(".video-container").css("width", parseInt(1280 / 720 * jQuery(window).height()) + "px");
    }
    jQuery(".video-holder").height(jQuery(".media-container").height());
    if (jQuery(window).width() > 1024) {
        if (jQuery(".video-holder").size() > 0) if ((jQuery(".media-container").height() + 150) / 9 * 16 > jQuery(".media-container").width()) {
            jQuery("iframe ").height(jQuery(".media-container").height() + 150).width((jQuery(".media-container").height() + 150) / 9 * 16);
            jQuery("iframe").css({
                "margin-left": -1 * jQuery("iframe").width() / 2 + "px",
                top: "-75px",
                "margin-top": "0px"
            });
        } else {
            jQuery("iframe").width(jQuery(window).width()).height(jQuery(window).width() / 16 * 9);
            jQuery("iframe ").css({
                "margin-left": -1 * jQuery("iframe").width() / 2 + "px",
                "margin-top": -1 * jQuery("iframe").height() / 2 + "px",
                top: "50%"
            });
        }
    } else if (jQuery(window).width() < 760) {
        jQuery(".video-holder").height(jQuery(".media-container").height());
        jQuery("iframe").height(jQuery(".media-container").height());
    } else {
        jQuery(".video-holder").height(jQuery(".media-container").height());
        jQuery("iframe").height(jQuery(".media-container").height());
    }
    var l = jQuery(".vimeo-player")[0], m = $f(l), n = jQuery(".status");
    m.addEvent("ready", function() {
        m.api("setVolume", 0);
    });
    jQuery(".triangle-decor").append('<svg x="0px" y="0px" width="100%" height="15px"><defs><pattern id="bottom-divider" x="0" y="0" width="15" height="15" patternUnits="userSpaceOnUse"><path fill-rule="evenodd" clip-rule="evenodd" fill="#fff" d="M7.504-0.008l7.504,7.504L7.504,15L0,7.496L7.504-0.008z"></path></pattern></defs><rect x="0" y="0" width="100%" height="15" fill="url(#bottom-divider)"></rect></svg>');
    jQuery(".header-inner .container").append('<div class="nav-button-holder"><div class="nav-button vis-m"><span></span><span></span><span></span></div></div>');
	jQuery(".hero-content").append('<div class="hero-line"></div>');
	// navigation------------------
    var o = jQuery(".nav-button"), p = jQuery(".nav-holder"), q = jQuery(".nav-holder ,.nav-button ");
    function r() {
        o.removeClass("vis-m");
        p.slideDown(500);
    }
    function s() {
        o.addClass("vis-m");
        p.slideUp(500);
    }
    o.on("click", function() {
        if (jQuery(this).hasClass("vis-m")) r(); else s();
    });
    jQuery(window).resize(function() {
        a();
    });
	jQuery(".scroll-nav a").on("click",function(){
	var ww = jQuery(window).width();
		if (ww < 992) {
			s();	
		}		
	});
}

function initparallax() {
    var a = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return a.Android() || a.BlackBerry() || a.iOS() || a.Opera() || a.Windows();
        }
    };
    trueMobile = a.any();
    if (null == trueMobile) {
        var b = jQuery("#main");
        if(b.find("[data-top-bottom]").length > 0){
            jQuery( window ).load(function() {
                
                s = skrollr.init();
                s.destroy();
                jQuery(window).resize(function() {
                    /*var a = jQuery(window).width();
                    if (a < 1036) s.destroy(); else */ skrollr.init({
                        forceHeight: !1,
                        easing: "outCubic",
                        mobileCheck: function() {
                            return !1;
                        }
                    });
                });
                skrollr.init({
                    forceHeight: !1,
                    easing: "outCubic",
                    mobileCheck: function() {
                        return !1;
                    }
                });
                
            });

            // b.imagesLoaded( function() {
            //     s = skrollr.init();
            //     s.destroy();
            //     jQuery(window).resize(function() {
            //         /*var a = jQuery(window).width();
            //         if (a < 1036) s.destroy(); else */ skrollr.init({
            //             forceHeight: !1,
            //             easing: "outCubic",
            //             mobileCheck: function() {
            //                 return !1;
            //             }
            //         });
            //     });
            //     skrollr.init({
            //         forceHeight: !1,
            //         easing: "outCubic",
            //         mobileCheck: function() {
            //             return !1;
            //         }
            //     });

            // });
        }

    }
    if (trueMobile) { jQuery(".video-container video , .video-holder iframe , .background-video").remove();}
}

jQuery(document).ready(function() {
    initLambert();
    initparallax();

});
(function($){
    'use strict';


    //------------- DETAIL ADD - MINUS COUNT ORDER -------------//
    $('.btn-number').click(function(e){
        e.preventDefault();
        
        var fieldName = $(this).attr('data-field');
        var type      = $(this).attr('data-type');
        var input = $("input[name='"+fieldName+"']");
        var currentVal = parseInt(input.val());
        if (!isNaN(currentVal)) {
            if(type == 'minus') {
                
                if(currentVal > input.attr('data-min')) {
                    input.val(currentVal - 1).change();
                } 
                if(parseInt(input.val()) == input.attr('data-min')) {
                    $(this).attr('disabled', true);
                }

            } else if(type == 'plus') {

                if(currentVal < input.attr('data-max')) {
                    input.val(currentVal + 1).change();
                }
                if(parseInt(input.val()) == input.attr('data-max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });
    $('.input-number').focusin(function(){
       $(this).data('oldValue', $(this).val());
    });
    $('.input-number').change(function() {
        
        var minValue =  parseInt($(this).attr('data-min'));
        var maxValue =  parseInt($(this).attr('data-max'));
        var valueCurrent = parseInt($(this).val());
        
        var name = $(this).attr('name');
        if(valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if(valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        
        
    });
    $(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });

    $('body').on('added_to_cart',function(event, fragments){
        // console.log(fragments['div.widget_shopping_cart_content']);
        var cart_quantity_total = 0;
        $(fragments['div.widget_shopping_cart_content']).find('span.quantity').each(function(){
            cart_quantity_total += parseInt($(this).text());
        });
        $('.subnav.cart-num a span').text(cart_quantity_total);
    });


})(jQuery);


