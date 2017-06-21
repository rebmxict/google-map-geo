lightbox_open = new Array();
jQuery(document).ready(function () {


 
    for(var entry in wpgmaps_localize) {

        jQuery( document ).on( 'wpgooglemaps_loaded', '#wpgmza_map_'+wpgmaps_localize[entry]['id'], function() {
            wpgooglemaps_load_full_screen_button(wpgmaps_localize[entry]['id']);
        });
        lightbox_open[entry] = 0;
    }
    var interval = new Array();

    /*Added for lightbox control*/

    jQuery('body').on("click",".wpgmaps_full_screen_icon", function(){
        var thismapid = jQuery(this).attr('mid');
        var wpgmaps_fs_center = MYMAP[thismapid].map.getCenter();

        jQuery("#wpgmza_map_"+thismapid).toggleClass("wpgmaps_fullscreen");

        if(lightbox_open[thismapid] === 0){
            //jQuery('.wpgmza_lightbox_map_'+thismapid+' .wpgmza_map').addClass('wpgmza_lb_override');
            //jQuery('.wpgmza_lb_overlay_closed').addClass('wpgmza_lb_overlay');
            //jQuery('.wpgmza_lb_overlay_closed').attr('mid',thismapid);
            jQuery(this).html(wpgmaps_full_screen_string_2);
            lightbox_open[thismapid] = 1;
            google.maps.event.trigger(MYMAP[thismapid].map, "resize");
            MYMAP[thismapid].map.setCenter(wpgmaps_fs_center);
        }
        else {
            jQuery(this).html(wpgmaps_full_screen_string_1);
            lightbox_open[thismapid] = 0;
            google.maps.event.trigger(MYMAP[thismapid].map, "resize");
            MYMAP[thismapid].map.setCenter(wpgmaps_fs_center);
        }
    });
        

    jQuery("body").on("click",".wpgmza_gd",function () {
        var thismapid = jQuery(this).attr('id');
        if(lightbox_open[thismapid] === 1){
            wpgooglemaps_close_full_screen(thismapid);
            
        }
    });
        



    for(var entry in wpgmaps_localize) {
        interval[parseInt(wpgmaps_localize[entry]['id'])] = setInterval(check_map(parseInt(wpgmaps_localize[entry]['id'])),500);
        var test = setInterval(function(){}, 1000);   
    }

});

function check_map(mapid) {

    if(MYMAP[mapid].map !== null){
        wpgooglemaps_load_full_screen_button(mapid);
        clearInterval(interval[mapid]);
        return;
    }
    // wait a little longer for the map to load.

}


function wpgooglemaps_load_full_screen_button(map_id) {
    google.maps.event.addListenerOnce(MYMAP[map_id].map, 'idle', function(){

        var iDiv = document.createElement('div');
        iDiv.id = 'wpgmza_fs_button_'+map_id;
        iDiv.className = 'wpgmza_fs_button';
        document.getElementsByTagName('body')[0].appendChild(iDiv);

        // Now create and append to iDiv
        var innerDiv = document.createElement('span');
        if (lightbox_open[map_id] == 1 ) {
            innerDiv.className = 'wpgmaps_full_screen_icon_close';
            innerDiv.alt = wpgmaps_full_screen_string_2;
            innerDiv.innerHTML = wpgmaps_full_screen_string_2;
            innerDiv.title = wpgmaps_full_screen_string_2;
            innerDiv.setAttribute('mid',map_id);
        } else {
            innerDiv.className = 'wpgmaps_full_screen_icon';
            innerDiv.alt = wpgmaps_full_screen_string_1;
            innerDiv.innerHTML = wpgmaps_full_screen_string_1;
            innerDiv.title = wpgmaps_full_screen_string_1;
            innerDiv.setAttribute('mid',map_id);
        }
        // The variable iDiv is still good... Just append to it.
        iDiv.appendChild(innerDiv);




        var legend = document.getElementById(iDiv.id);
        jQuery(legend).css('display','block');
        MYMAP[map_id].map.controls[google.maps.ControlPosition.LEFT_TOP].push(iDiv);
   
    });
}
