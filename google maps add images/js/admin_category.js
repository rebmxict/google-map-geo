jQuery(document).ready(function() {

var clicked_on_markerbtn = false;

jQuery('#upload_default_category_marker_btn').click(function() {
 formfield = jQuery('#upload_default_category_marker').attr('name');
 clicked_on_imgbtn = false;
 clicked_on_markerbtn = true;
 clicked_on_custommarkerbtn = false;
 tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true');
 return false;
});

window.send_to_editor = function(html) {
 imgurl = jQuery('img',html).attr('src');
 if (clicked_on_markerbtn) { jQuery('#upload_default_category_marker').val(imgurl); jQuery("#wpgmza_mm").html("<img src=\""+imgurl+"\" />"); }
 tb_remove();
}



});