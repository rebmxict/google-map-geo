jQuery(document).ready(function($){
    var tgm_media_frame_default;

    $(document.body).on('click.tgmOpenMediaManager', '#upload_default_category_marker_btn', function(e){
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
                text:  'Use as Default Category Marker'
            }
        });

        tgm_media_frame_default.on('select', function(){
            var media_attachment = tgm_media_frame_default.state().get('selection').first().toJSON();
            jQuery('#upload_default_category_marker').val(media_attachment.url);
            jQuery("#wpgmza_mm").html("<img src=\""+media_attachment.url+"\" />");
        });
        tgm_media_frame_default.open();
    });

});