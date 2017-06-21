jQuery(document).ready(function() {


    
    var tgm_media_frame_custom_1;
    jQuery(document.body).on('click.tgmOpenMediaManager', '#upload_custom_marker_click_button', function(e){
        e.preventDefault();

        if ( tgm_media_frame_custom_1 ) {
            tgm_media_frame_custom_1.open();
            return;
        }

        tgm_media_frame_custom_1 = wp.media.frames.tgm_media_frame = wp.media({
            className: 'media-frame tgm-media-frame',
            frame: 'select',
            multiple: false,
            title: 'Upload Custom Marker Icon',
            library: {
                type: 'image'
            },

            button: {
                text:  'Use as Custom Marker'
            }
        });

        tgm_media_frame_custom_1.on('select', function(){
            var media_attachment = tgm_media_frame_custom_1.state().get('selection').first().toJSON();
            jQuery('#wpgmza_add_custom_marker_on_click').val(media_attachment.url);
            jQuery("#wpgmza_cmm_custom").html("<img src=\""+media_attachment.url+"\" />");
        });
        tgm_media_frame_custom_1.open();
    });

    var tgm_media_frame_default;
    jQuery(document.body).on('click.tgmOpenMediaManager', '#upload_default_ul_marker_btn', function(e){
        e.preventDefault();

        if ( tgm_media_frame_default ) {
            tgm_media_frame_default.open();
            return;
        }

        tgm_media_frame_default = wp.media.frames.tgm_media_frame = wp.media({
            className: 'media-frame tgm-media-frame',
            frame: 'select',
            multiple: false,
            title: 'Default Marker Icon',
            library: {
                type: 'image'
            },
            button: {
                text:  'Use as Default Marker'
            }
        });

        tgm_media_frame_default.on('select', function(){
            var media_attachment = tgm_media_frame_default.state().get('selection').first().toJSON();
            jQuery('#upload_default_ul_marker').val(media_attachment.url);
            jQuery("#wpgmza_mm_ul").html("<img src=\""+media_attachment.url+"\" />");
        });
        tgm_media_frame_default.open();
    });
    jQuery(document.body).on('click.tgmOpenMediaManager', '#upload_default_sl_marker_btn', function(e){
        e.preventDefault();

        if ( tgm_media_frame_default ) {
            tgm_media_frame_default.open();
            return;
        }

        tgm_media_frame_default = wp.media.frames.tgm_media_frame = wp.media({
            className: 'media-frame tgm-media-frame',
            frame: 'select',
            multiple: false,
            title: 'Default Marker Icon',
            library: {
                type: 'image'
            },
            button: {
                text:  'Use as Default Marker'
            }
        });

        tgm_media_frame_default.on('select', function(){
            var media_attachment = tgm_media_frame_default.state().get('selection').first().toJSON();
            jQuery('#upload_default_sl_marker').val(media_attachment.url);
            jQuery("#wpgmza_mm_sl").html("<img src=\""+media_attachment.url+"\" />");
        });
        tgm_media_frame_default.open();
    });    


    jQuery("body").on("click",".wpgmza_copy_shortcode", function() {
        var $temp = jQuery('<input>');
        var $tmp2 = jQuery('<span id="wpgmza_tmp" style="display:none; width:100%; text-align:center;">');
        jQuery("body").append($temp);
        $temp.val(jQuery(this).val()).select();
        document.execCommand("copy");
        $temp.remove();
        jQuery(this).after($tmp2);
        jQuery($tmp2).html(wpgmaps_localize_strings["wpgm_copy_string"]);
        jQuery($tmp2).fadeIn();
        setTimeout(function(){ jQuery($tmp2).fadeOut(); }, 1000);
        setTimeout(function(){ jQuery($tmp2).remove(); }, 1500);
    });



    if(jQuery('#wpgmza_store_locator_bounce').attr('checked')){
        jQuery('#wpgmza_store_locator_bounce_conditional').fadeIn();
    }else{
        jQuery('#wpgmza_store_locator_bounce_conditional').fadeOut();
    }

    jQuery('#wpgmza_store_locator_bounce').on('change', function(){
        if(jQuery(this).attr('checked')){
            jQuery('#wpgmza_store_locator_bounce_conditional').fadeIn();
        }else{
            jQuery('#wpgmza_store_locator_bounce_conditional').fadeOut();
        }
    });


    if(jQuery('#wpgmza_show_user_location').attr('checked')){
        jQuery('#wpgmza_show_user_location_conditional').fadeIn();
    }else{
        jQuery('#wpgmza_show_user_location_conditional').fadeOut();
    }

    jQuery('#wpgmza_show_user_location').on('change', function(){
        if(jQuery(this).attr('checked')){
            jQuery('#wpgmza_show_user_location_conditional').fadeIn();
        }else{
            jQuery('#wpgmza_show_user_location_conditional').fadeOut();
        }
    });

    jQuery("body").on("click","#wpgmza_gradient_show", function(e) {
        e.preventDefault();
        var gtype = jQuery(this).attr("gtype");
        if (gtype == "default") {
              var gradient = '1';
            jQuery("#heatmap_gradient").html(JSON.stringify(gradient));
            jQuery('#heatmap_gradient').keyup();
        }
        if (gtype == "blue") {
              var gradient = [
                'rgba(0, 255, 255, 0)',
                'rgba(0, 255, 255, 1)',
                'rgba(0, 191, 255, 1)',
                'rgba(0, 127, 255, 1)',
                'rgba(0, 63, 255, 1)',
                'rgba(0, 0, 255, 1)',
                'rgba(0, 0, 223, 1)',
                'rgba(0, 0, 191, 1)',
                'rgba(0, 0, 159, 1)',
                'rgba(0, 0, 127, 1)',
                'rgba(63, 0, 91, 1)',
                'rgba(127, 0, 63, 1)',
                'rgba(191, 0, 31, 1)',
                'rgba(255, 0, 0, 1)'
              ]
            jQuery("#heatmap_gradient").html(JSON.stringify(gradient));
            jQuery('#heatmap_gradient').keyup();
        }

    })

    jQuery("#wpgmza_mlist_selection_1").click(function() {
        jQuery("#rb_wpgmza_mlist_selection_1").attr('checked', true);
        jQuery("#rb_wpgmza_mlist_selection_2").attr('checked', false);
        jQuery("#rb_wpgmza_mlist_selection_3").attr('checked', false);
        jQuery("#rb_wpgmza_mlist_selection_4").attr('checked', false);
        jQuery("#rb_wpgmza_mlist_selection_5").attr('checked', false);
        jQuery("#wpgmza_mlist_selection_1").addClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_mlist_selection_2").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_mlist_selection_3").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_mlist_selection_4").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_mlist_selection_5").removeClass("wpgmza_mlist_selection_activate");
        jQuery(".wpgmza_mlist_sel_text").text(wpgmaps_localize_strings["wpgm_mlist_sel_2"]);

    });

    jQuery("#wpgmza_mlist_selection_2").click(function() {
        jQuery("#rb_wpgmza_mlist_selection_1").attr('checked', false);
        jQuery("#rb_wpgmza_mlist_selection_2").attr('checked', true);
        jQuery("#rb_wpgmza_mlist_selection_3").attr('checked', false);
        jQuery("#rb_wpgmza_mlist_selection_4").attr('checked', false);
        jQuery("#rb_wpgmza_mlist_selection_5").attr('checked', false);
        jQuery("#wpgmza_mlist_selection_1").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_mlist_selection_2").addClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_mlist_selection_3").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_mlist_selection_4").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_mlist_selection_5").removeClass("wpgmza_mlist_selection_activate");
        jQuery(".wpgmza_mlist_sel_text").text(wpgmaps_localize_strings["wpgm_mlist_sel_4"]);

    });

    jQuery("#wpgmza_mlist_selection_3").click(function() {
        jQuery("#rb_wpgmza_mlist_selection_1").attr('checked', false);
        jQuery("#rb_wpgmza_mlist_selection_2").attr('checked', false);
        jQuery("#rb_wpgmza_mlist_selection_3").attr('checked', true);
        jQuery("#rb_wpgmza_mlist_selection_4").attr('checked', false);
        jQuery("#rb_wpgmza_mlist_selection_5").attr('checked', false);
        jQuery("#wpgmza_mlist_selection_1").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_mlist_selection_2").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_mlist_selection_3").addClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_mlist_selection_4").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_mlist_selection_5").removeClass("wpgmza_mlist_selection_activate");
        jQuery(".wpgmza_mlist_sel_text").text(wpgmaps_localize_strings["wpgm_mlist_sel_3"]);

    });


    jQuery("#wpgmza_mlist_selection_4").click(function() {
        jQuery("#rb_wpgmza_mlist_selection_1").attr('checked', false);
        jQuery("#rb_wpgmza_mlist_selection_2").attr('checked', false);
        jQuery("#rb_wpgmza_mlist_selection_3").attr('checked', false);
        jQuery("#rb_wpgmza_mlist_selection_4").attr('checked', true);
        jQuery("#rb_wpgmza_mlist_selection_5").attr('checked', false);
        jQuery("#wpgmza_mlist_selection_1").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_mlist_selection_2").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_mlist_selection_3").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_mlist_selection_4").addClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_mlist_selection_5").removeClass("wpgmza_mlist_selection_activate");
        jQuery(".wpgmza_mlist_sel_text").text(wpgmaps_localize_strings["wpgm_mlist_sel_5"]);

    });


    jQuery("#wpgmza_mlist_selection_5").click(function() {
        jQuery("#rb_wpgmza_mlist_selection_1").attr('checked', false);
        jQuery("#rb_wpgmza_mlist_selection_2").attr('checked', false);
        jQuery("#rb_wpgmza_mlist_selection_3").attr('checked', false);
        jQuery("#rb_wpgmza_mlist_selection_4").attr('checked', false);
        jQuery("#rb_wpgmza_mlist_selection_5").attr('checked', true);
        jQuery("#wpgmza_mlist_selection_1").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_mlist_selection_2").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_mlist_selection_3").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_mlist_selection_4").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_mlist_selection_5").addClass("wpgmza_mlist_selection_activate");
        jQuery(".wpgmza_mlist_sel_text").text(wpgmaps_localize_strings["wpgm_mlist_sel_1"]);
    });


    jQuery("#wpgmza_iw_selection_1").click(function() {
        jQuery("#rb_wpgmza_iw_selection_1").attr('checked', true);
        jQuery("#rb_wpgmza_iw_selection_2").attr('checked', false);
        jQuery("#rb_wpgmza_iw_selection_3").attr('checked', false);
        jQuery("#rb_wpgmza_iw_selection_4").attr('checked', false);
        jQuery("#rb_wpgmza_iw_selection_null").attr('checked', false);
        jQuery("#wpgmza_iw_selection_1").addClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_iw_selection_2").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_iw_selection_3").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_iw_selection_4").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_iw_selection_null").removeClass("wpgmza_mlist_selection_activate");
        jQuery(".wpgmza_iw_sel_text").text(wpgmaps_localize_strings["wpgm_iw_sel_1"]);
    });

    jQuery("#wpgmza_iw_selection_2").click(function() {
        jQuery("#rb_wpgmza_iw_selection_1").attr('checked', false);
        jQuery("#rb_wpgmza_iw_selection_2").attr('checked', true);
        jQuery("#rb_wpgmza_iw_selection_3").attr('checked', false);
        jQuery("#rb_wpgmza_iw_selection_4").attr('checked', false);
        jQuery("#rb_wpgmza_iw_selection_null").attr('checked', false);
        jQuery("#wpgmza_iw_selection_1").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_iw_selection_2").addClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_iw_selection_3").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_iw_selection_4").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_iw_selection_null").removeClass("wpgmza_mlist_selection_activate");
        jQuery(".wpgmza_iw_sel_text").text(wpgmaps_localize_strings["wpgm_iw_sel_2"]);
    });

    jQuery("#wpgmza_iw_selection_3").click(function() {
        jQuery("#rb_wpgmza_iw_selection_1").attr('checked', false);
        jQuery("#rb_wpgmza_iw_selection_2").attr('checked', false);
        jQuery("#rb_wpgmza_iw_selection_3").attr('checked', true);
        jQuery("#rb_wpgmza_iw_selection_4").attr('checked', false);
        jQuery("#rb_wpgmza_iw_selection_null").attr('checked', false);
        jQuery("#wpgmza_iw_selection_1").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_iw_selection_2").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_iw_selection_3").addClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_iw_selection_4").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_iw_selection_null").removeClass("wpgmza_mlist_selection_activate");
        jQuery(".wpgmza_iw_sel_text").text(wpgmaps_localize_strings["wpgm_iw_sel_3"]);
    });

    jQuery("#wpgmza_iw_selection_4").click(function() {
        jQuery("#rb_wpgmza_iw_selection_1").attr('checked', false);
        jQuery("#rb_wpgmza_iw_selection_2").attr('checked', false);
        jQuery("#rb_wpgmza_iw_selection_3").attr('checked', false);
        jQuery("#rb_wpgmza_iw_selection_4").attr('checked', true);
        jQuery("#rb_wpgmza_iw_selection_null").attr('checked', false);
        jQuery("#wpgmza_iw_selection_1").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_iw_selection_2").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_iw_selection_3").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_iw_selection_4").addClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_iw_selection_null").removeClass("wpgmza_mlist_selection_activate");
        jQuery(".wpgmza_iw_sel_text").text(wpgmaps_localize_strings["wpgm_iw_sel_4"]);
    });

    jQuery("#wpgmza_iw_selection_null").click(function() {
        jQuery("#rb_wpgmza_iw_selection_1").attr('checked', false);
        jQuery("#rb_wpgmza_iw_selection_2").attr('checked', false);
        jQuery("#rb_wpgmza_iw_selection_3").attr('checked', false);
        jQuery("#rb_wpgmza_iw_selection_4").attr('checked', false);
        jQuery("#rb_wpgmza_iw_selection_null").attr('checked', true);
        jQuery("#wpgmza_iw_selection_1").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_iw_selection_2").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_iw_selection_3").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_iw_selection_4").removeClass("wpgmza_mlist_selection_activate");
        jQuery("#wpgmza_iw_selection_null").addClass("wpgmza_mlist_selection_activate");
        jQuery(".wpgmza_iw_sel_text").text(wpgmaps_localize_strings["wpgm_iw_sel_null"]);
    });

    jQuery('.add-new-editor').hover(function(){
        jQuery('#wpmgza_unsave_notice').fadeToggle();
    });

});