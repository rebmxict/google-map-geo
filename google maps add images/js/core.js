var MYMAP = new Array();
var wpgmzaTable = new Array();

var directionsDisplay = new Array();
var directionsService = new Array();
var infoWindow = new Array();
var store_locator_marker = new Array();
var cityCircle = new Array();
var infoWindow_poly = new Array();
var polygon_center = new Array();
var WPGM_Path_Polygon = new Array();
var WPGM_Path = new Array();
var marker_array = new Array();
var marker_array2 = new Array();
var marker_sl_array = new Array();
var wpgmza_controls_active = new Array();
var wpgmza_adv_styling_json = new Array();
var lazyload;
var autoplay;
var items;
var default_items;
var pagination;
var navigation;
var modern_iw_open = new Array();
var markerClusterer = new Array();
var original_iw;
var orig_fetching_directions;
var wpgmaps_map_mashup = new Array();
/**
 * Variables used to focus the map on a specific LAT and LNG once the map has loaded.
 */
var focus_lat = false,
    focus_lng = false;



var wpgmza_iw_Div = new Array();

var autocomplete = new Array();


var retina = window.devicePixelRatio > 1;


var click_from_list = false;

var wpgmza_user_marker = null;

autoheight = true;
autoplay = 6000;
lazyload = true;
pagination = false;
navigation = true;
items = 6;

if (typeof Array.prototype.forEach != 'function') {
    Array.prototype.forEach = function(callback) {
        for (var i = 0; i < this.length; i++) {
            callback.apply(this, [this[i], i, this]);
        }
    };
}

for (var entry in wpgmaps_localize) {
    modern_iw_open[entry] = false;
    if ('undefined' === typeof window.jQuery) {
        setTimeout(function() { document.getElementById('wpgmza_map_' + wpgmaps_localize[entry]['id']).innerHTML = 'Error: In order for WP Google Maps to work, jQuery must be installed. A check was done and jQuery was not present. Please see the <a href="http://www.wpgmaps.com/documentation/troubleshooting/jquery-troubleshooting/" title="WP Google Maps - jQuery Troubleshooting">jQuery troubleshooting section of our site</a> for more information.'; }, 5000);
    }


}

/* find out if we are dealing with mashups and which maps they relate to */
if (typeof wpgmza_mashup_ids !== "undefined") {
    for (var mashup_entry in wpgmza_mashup_ids) {
        wpgmaps_map_mashup[mashup_entry] = true;
    }
}

var wpgmza_retina_width;
var wpgmza_retina_height;

if ("undefined" !== typeof wpgmaps_localize_global_settings['wpgmza_settings_retina_width']) { wpgmza_retina_width = parseInt(wpgmaps_localize_global_settings['wpgmza_settings_retina_width']); } else { wpgmza_retina_width = 31; }
if ("undefined" !== typeof wpgmaps_localize_global_settings['wpgmza_settings_retina_height']) { wpgmza_retina_height = parseInt(wpgmaps_localize_global_settings['wpgmza_settings_retina_height']); } else { wpgmza_retina_height = 45; }


var user_location;

function InitMap(map_id, cat_id, reinit) {
    modern_iw_open[map_id] = false /* set modern infowindow open boolean to false to reset the creation of it considering the map has been reinitialized */

    if ('undefined' !== typeof wpgmaps_localize_shortcode_data) {
        if (wpgmaps_localize_shortcode_data[map_id]['lat'] !== false && wpgmaps_localize_shortcode_data[map_id]['lng'] !== false) {
            wpgmaps_localize[map_id]['map_start_lat'] = wpgmaps_localize_shortcode_data[map_id]['lat'];
            wpgmaps_localize[map_id]['map_start_lng'] = wpgmaps_localize_shortcode_data[map_id]['lng'];

        }
    }


    if ('undefined' === cat_id || cat_id === '' || !cat_id || cat_id === 0 || cat_id === "0") { cat_id = 'all'; }


    var myLatLng = new window.google.maps.LatLng(wpgmaps_localize[map_id]['map_start_lat'], wpgmaps_localize[map_id]['map_start_lng']);
    google = window.google;
    if (reinit === false) {
        if (typeof wpgmza_override_zoom !== "undefined" && typeof wpgmza_override_zoom[map_id] !== "undefined") {
            MYMAP[map_id].init("#wpgmza_map_" + map_id, myLatLng, parseInt(wpgmza_override_zoom[map_id]), wpgmaps_localize[map_id]['type'], map_id);
        } else {
            MYMAP[map_id].init("#wpgmza_map_" + map_id, myLatLng, parseInt(wpgmaps_localize[map_id]['map_start_zoom']), wpgmaps_localize[map_id]['type'], map_id);
        }
    }







    UniqueCode = Math.round(Math.random() * 10000);
    if ('undefined' !== typeof wpgmaps_localize_shortcode_data) {
        if (wpgmaps_localize_shortcode_data[map_id]['lat'] !== false && wpgmaps_localize_shortcode_data[map_id]['lng'] !== false) {
            /* we're using custom fields to create, only show the one marker */
            var point = new google.maps.LatLng(parseFloat(wpgmaps_localize_shortcode_data[map_id]['lat']), parseFloat(wpgmaps_localize_shortcode_data[map_id]['lng']));
            var marker = new google.maps.Marker({
                position: point,
                map: MYMAP[map_id].map
            });

        }
    } else {
        if (typeof wpgmaps_map_mashup !== "undefined" && typeof wpgmaps_map_mashup[map_id] !== "undefined" && wpgmaps_map_mashup[map_id] === true) {
            wpgmaps_localize_mashup_ids[map_id].forEach(function(entry_mashup) {
                if (typeof wpgmaps_localize[map_id]['other_settings']['store_locator_hide_before_search'] !== "undefined" && wpgmaps_localize[map_id]['other_settings']['store_locator_hide_before_search'] === 1) {
                    /* dont show markers */
                    MYMAP[map_id].placeMarkers(wpgmaps_markerurl + entry_mashup + 'markers.xml?u=' + UniqueCode, map_id, cat_id, null, null, null, null, false);
                } else if (typeof wpgmaps_localize[map_id]['other_settings']['store_locator_hide_before_search'] !== "undefined" && wpgmaps_localize[map_id]['other_settings']['store_locator_hide_before_search'] === 2) {
                    MYMAP[map_id].placeMarkers(wpgmaps_markerurl + entry_mashup + 'markers.xml?u=' + UniqueCode, map_id, cat_id, null, null, null, null, true);
                } else if (typeof wpgmaps_localize[map_id]['other_settings']['store_locator_hide_before_search'] === "undefined") {
                    MYMAP[map_id].placeMarkers(wpgmaps_markerurl + entry_mashup + 'markers.xml?u=' + UniqueCode, map_id, cat_id, null, null, null, null, true);
                } else {
                    MYMAP[map_id].placeMarkers(wpgmaps_markerurl + entry_mashup + 'markers.xml?u=' + UniqueCode, map_id, cat_id, null, null, null, null, true);
                }

            });
        } else {
            if (typeof wpgmaps_localize[map_id]['other_settings']['store_locator_hide_before_search'] !== "undefined" && wpgmaps_localize[map_id]['other_settings']['store_locator_hide_before_search'] === 1) {
                /* dont show markers */
                MYMAP[map_id].placeMarkers(wpgmaps_markerurl + map_id + 'markers.xml?u=' + UniqueCode, map_id, cat_id, null, null, null, null, false);
            } else if (typeof wpgmaps_localize[map_id]['other_settings']['store_locator_hide_before_search'] !== "undefined" && wpgmaps_localize[map_id]['other_settings']['store_locator_hide_before_search'] === 2) {
                MYMAP[map_id].placeMarkers(wpgmaps_markerurl + map_id + 'markers.xml?u=' + UniqueCode, map_id, cat_id, null, null, null, null, true);
            } else if (typeof wpgmaps_localize[map_id]['other_settings']['store_locator_hide_before_search'] === "undefined") {
                MYMAP[map_id].placeMarkers(wpgmaps_markerurl + map_id + 'markers.xml?u=' + UniqueCode, map_id, cat_id, null, null, null, null, true);
            } else {
                MYMAP[map_id].placeMarkers(wpgmaps_markerurl + map_id + 'markers.xml?u=' + UniqueCode, map_id, cat_id, null, null, null, null, true);
            }

        }
    }
};

function resetLocations(map_id) {
    if (typeof jQuery("#addressInput_" + map_id) === "object") { jQuery("#addressInput_" + map_id).val(''); }
    if (typeof jQuery("#nameInput_" + map_id) === "object") { jQuery("#nameInput_" + map_id).val(''); }
    reset_marker_lists(map_id);
    InitMap(map_id, 'all', true);
    MYMAP[map_id].map.setZoom(parseInt(wpgmaps_localize[map_id]['map_start_zoom']));

}

function fillInAddress(mid) {

    var place = autocomplete[mid].getPlace();
}



for (var entry in wpgmaps_localize) {

    var curmid = wpgmaps_localize[entry]['id'];

    var elementExists = document.getElementById('addressInput_' + curmid);

    var wpgmza_input_to_exists = document.getElementById('wpgmza_input_to_' + curmid);
    var wpgmza_input_from_exists = document.getElementById('wpgmza_input_from_' + curmid);

    if (typeof google === 'object' && typeof google.maps === 'object' && typeof google.maps.places === 'object' && typeof google.maps.places.Autocomplete === 'function') {

        if (elementExists !== null) {
            if (typeof wpgmaps_localize[curmid]['other_settings']['wpgmza_store_locator_restrict'] !== "undefined" && wpgmaps_localize[curmid]['other_settings']['wpgmza_store_locator_restrict'] != "") {
                autocomplete[curmid] = new google.maps.places.Autocomplete(
                    (document.getElementById('addressInput_' + curmid)), { types: ['geocode'], componentRestrictions: { country: wpgmaps_localize[curmid]['other_settings']['wpgmza_store_locator_restrict'] } });
                google.maps.event.addListener(autocomplete[curmid], 'place_changed', function() {
                    fillInAddress(curmid);
                });
            } else {
                autocomplete[curmid] = new google.maps.places.Autocomplete(
                    (document.getElementById('addressInput_' + curmid)), { types: ['geocode'] });
                google.maps.event.addListener(autocomplete[curmid], 'place_changed', function() {
                    fillInAddress(curmid);
                });
            }
        }

        if (wpgmza_input_to_exists !== null) {
            autocomplete[curmid] = new google.maps.places.Autocomplete(
                (document.getElementById('wpgmza_input_to_' + curmid)), { types: ['geocode'] });
            google.maps.event.addListener(autocomplete[curmid], 'place_changed', function() {
                fillInAddress(curmid);
            });
        }

        if (wpgmza_input_from_exists !== null) {
            autocomplete[curmid] = new google.maps.places.Autocomplete(
                (document.getElementById('wpgmza_input_from_' + curmid)), { types: ['geocode'] });
            google.maps.event.addListener(autocomplete[curmid], 'place_changed', function() {
                fillInAddress(curmid);
            });
        }
        if (document.getElementById('wpgmza_ugm_add_address_' + curmid) !== null) {

            /* initialize the autocomplete form */
            autocomplete[curmid] = new google.maps.places.Autocomplete(
                /** @type {HTMLInputElement} */
                (document.getElementById('wpgmza_ugm_add_address_' + curmid)), { types: ['geocode'] });
            /* When the user selects an address from the dropdown,
             populate the address fields in the form. */
            google.maps.event.addListener(autocomplete[curmid], 'place_changed', function() {
                fillInAddress(curmid);
            });
        }



    }
}



function searchLocations(map_id) {
    if (document.getElementById("addressInput_" + map_id) === null) { var address = null; } else { var address = document.getElementById("addressInput_" + map_id).value; }
    if (document.getElementById("nameInput_" + map_id) === null) { var search_title = null; } else { var search_title = document.getElementById("nameInput_" + map_id).value; }



    checkedCatValues = 'all';
    if (jQuery(".wpgmza_cat_checkbox_" + map_id).length > 0) {
        var checkedCatValues = jQuery('.wpgmza_checkbox:checked').map(function() { return this.value; }).get();
        if (checkedCatValues === "" || checkedCatValues.length < 1 || checkedCatValues === 0 || checkedCatValues === "0") { checkedCatValues = 'all'; }
    }
    if (jQuery(".wpgmza_filter_select_" + map_id).length > 0) {
        var checkedCatValues = jQuery(".wpgmza_filter_select_" + map_id).find(":selected").val();
        if (checkedCatValues === "" || checkedCatValues.length < 1 || checkedCatValues === 0 || checkedCatValues === "0") { checkedCatValues = 'all'; }
    }


    if (address === null || address === "") {
        var map_center = MYMAP[map_id].map.getCenter();
        searchLocationsNear(map_id, checkedCatValues, map_center, search_title);
    } else {

        checker = address.split(",");
        var wpgm_lat = "";
        var wpgm_lng = "";
        wpgm_lat = checker[0];
        wpgm_lng = checker[1];
        checker1 = parseFloat(checker[0]);
        checker2 = parseFloat(checker[1]);

        var geocoder = new google.maps.Geocoder();

        if (typeof wpgmaps_localize[map_id]['other_settings']['wpgmza_store_locator_restrict'] !== "undefined" && wpgmaps_localize[map_id]['other_settings']['wpgmza_store_locator_restrict'] != "") {
            if ((wpgm_lat.match(/[a-zA-Z]/g) === null && wpgm_lng.match(/[a-zA-Z]/g) === null) && checker.length === 2 && (checker1 != NaN && (checker1 <= 90 || checker1 >= -90)) && (checker2 != NaN && (checker2 <= 90 || checker2 >= -90))) {
                var point = new google.maps.LatLng(parseFloat(wpgm_lat), parseFloat(wpgm_lng));
                searchLocationsNear(map_id, checkedCatValues, point, search_title);
            } else {
                /* is an address, must geocode */
                geocoder.geocode({ address: address, componentRestrictions: { country: wpgmaps_localize[map_id]['other_settings']['wpgmza_store_locator_restrict'] } }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        searchLocationsNear(map_id, checkedCatValues, results[0].geometry.location, search_title);
                    } else {
                        alert(address + ' not found');
                    }
                });

            }
        } else {

            if ((typeof wpgm_lng !== "undefined" && wpgm_lat.match(/[a-zA-Z]/g) === null && wpgm_lng.match(/[a-zA-Z]/g) === null) && checker.length === 2 && (checker1 != NaN && (checker1 <= 90 || checker1 >= -90)) && (checker2 != NaN && (checker2 <= 90 || checker2 >= -90))) {
                var point = new google.maps.LatLng(parseFloat(wpgm_lat), parseFloat(wpgm_lng));
                searchLocationsNear(map_id, checkedCatValues, point, search_title);
            } else {
                /* is an address, must geocode */
                geocoder.geocode({ address: address }, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        searchLocationsNear(map_id, checkedCatValues, results[0].geometry.location, search_title);
                    } else {
                        alert(address + ' not found');
                    }
                });

            }

        }



    }
}


function clearLocations() {
    infoWindow.forEach(function(entry, index) {
        infoWindow[index].close();
    });
}




function searchLocationsNear(mapid, category, center_searched, search_title) {
    clearLocations();
    var distance_type = document.getElementById("wpgmza_distance_type_" + mapid).value;
    var radius = document.getElementById('radiusSelect_' + mapid).value;
    if (parseInt(category) === 0) { category = 'all'; }
    if (category === "0") { category = 'all'; }
    if (category === "Not found") { category = 'all'; }
    if (category === null) { category = 'all'; }
    if (category.length < 1) { category = 'all'; }

    if (distance_type === "1") {
        if (radius === "1") { zoomie = 14; } else if (radius === "5") { zoomie = 12; } else if (radius === "10") { zoomie = 11; } else if (radius === "25") { zoomie = 9; } else if (radius === "50") { zoomie = 8; } else if (radius === "75") { zoomie = 8; } else if (radius === "100") { zoomie = 7; } else if (radius === "150") { zoomie = 7; } else if (radius === "200") { zoomie = 6; } else if (radius === "300") { zoomie = 6; } else { zoomie = 14; }
    } else {
        if (radius === "1") { zoomie = 14; } else if (radius === "5") { zoomie = 12; } else if (radius === "10") { zoomie = 11; } else if (radius === "25") { zoomie = 10; } else if (radius === "50") { zoomie = 9; } else if (radius === "75") { zoomie = 9; } else if (radius === "100") { zoomie = 8; } else if (radius === "150") { zoomie = 8; } else if (radius === "200") { zoomie = 7; } else if (radius === "300") { zoomie = 7; } else { zoomie = 14; }
    }


    MYMAP[mapid].map.setCenter(center_searched);
    MYMAP[mapid].map.setZoom(zoomie);





    if (typeof wpgmaps_map_mashup[mapid] !== "undefined" && wpgmaps_map_mashup[mapid] === true) {
        wpgmaps_localize_mashup_ids[mapid].forEach(function(entry_mashup) {

            MYMAP[mapid].placeMarkers(wpgmaps_markerurl + entry_mashup + 'markers.xml?u=' + UniqueCode, mapid, category, radius, center_searched, distance_type, search_title, true);
        });
    } else {
        MYMAP[mapid].placeMarkers(wpgmaps_markerurl + mapid + 'markers.xml?u=' + UniqueCode, mapid, category, radius, center_searched, distance_type, search_title, true);
    }
    if (jQuery("#wpgmza_marker_holder_" + mapid).length > 0) {
        /* ensure that the marker list is showing (this is if the admin has chosen to hide the markers until a store locator search is done */
        jQuery("#wpgmza_marker_holder_" + mapid).show();
    }
    if (jQuery('#wpgmza_marker_list_container_' + wpgmaps_localize[entry]['id']).length > 0) {
        jQuery('#wpgmza_marker_list_container_' + wpgmaps_localize[entry]['id']).show();
    }

}

function toRad(Value) {
    /** Converts numeric degrees to radians */
    return Value * Math.PI / 180;
}

function wpgmza_getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m, key, value) {
        vars[key] = value;
    });
    return vars;
}
var wpgmza_open_marker = wpgmza_getUrlVars()["markerid"];
var wpgmza_open_marker_zoom = wpgmza_getUrlVars()["mzoom"];



function wpgmza_reinitialisetbl(map_id) {
    jQuery('#wpgmza_marker_holder_' + map_id).show();
    if (wpgmaps_localize[map_id]['order_markers_by'] === "1") { wpgmaps_order_by = parseInt(0); } else if (wpgmaps_localize[map_id]['order_markers_by'] === "2") { wpgmaps_order_by = parseInt(2); } else if (wpgmaps_localize[map_id]['order_markers_by'] === "3") { wpgmaps_order_by = parseInt(4); } else if (wpgmaps_localize[map_id]['order_markers_by'] === "4") { wpgmaps_order_by = parseInt(5); } else if (wpgmaps_localize[map_id]['order_markers_by'] === "5") { wpgmaps_order_by = parseInt(3); } else { wpgmaps_order_by = 0; }
    if (wpgmaps_localize[map_id]['order_markers_choice'] === "1") { wpgmaps_order_by_choice = "asc"; } else { wpgmaps_order_by_choice = "desc"; }
    wpgmzaTable[map_id].fnClearTable(0);
    wpgmzaTable[map_id] = jQuery('#wpgmza_table_' + map_id).DataTable({
        "bProcessing": true,
        "aaSorting": [],
        responsive: true,
        "iDisplayLength": wpgmza_settings_default_items,
        "oLanguage": {
            "sLengthMenu": wpgm_dt_sLengthMenu,
            "sZeroRecords": wpgm_dt_sZeroRecords,
            "sInfo": wpgm_dt_sInfo,
            "sInfoEmpty": wpgm_dt_sInfoEmpty,
            "sInfoFiltered": wpgm_dt_sInfoFiltered,
            "sSearch": wpgm_dt_sSearch,
            "oPaginate": {
                "sFirst": wpgm_dt_sFirst,
                "sLast": wpgm_dt_sLast,
                "sNext": wpgm_dt_sNext,
                "sPrevious": wpgm_dt_sPrevious,
                "sSearch": wpgm_dt_sSearch
            }
        }

    });


}

function wpgmza_filter_marker_lists_by_array(map_id, marker_sl_array) {
    /* update datatables (only if using datatables) */
    if (typeof jQuery("#wpgmza_table_" + map_id) === "object") {
        var data = {
            action: 'wpgmza_datatables_sl',
            security: wpgmaps_pro_nonce,
            map_id: map_id,
            marker_array: marker_sl_array
        };
        jQuery.post(ajaxurl, data, function(response) {
            jQuery("#wpgmza_marker_holder_" + map_id + "").html(response);
            wpgmzaTable[map_id] = jQuery('#wpgmza_table_' + map_id).DataTable({
                "bDestroy": true,
                responsive: true,
                "iDisplayLength": wpgmza_settings_default_items,
                "bProcessing": true,
                "aaSorting": [],
                "oLanguage": {
                    "sLengthMenu": wpgm_dt_sLengthMenu,
                    "sZeroRecords": wpgm_dt_sZeroRecords,
                    "sInfo": wpgm_dt_sInfo,
                    "sInfoEmpty": wpgm_dt_sInfoEmpty,
                    "sInfoFiltered": wpgm_dt_sInfoFiltered,
                    "sSearch": wpgm_dt_sSearch,
                    "oPaginate": {
                        "sFirst": wpgm_dt_sFirst,
                        "sLast": wpgm_dt_sLast,
                        "sNext": wpgm_dt_sNext,
                        "sPrevious": wpgm_dt_sPrevious,
                        "sSearch": wpgm_dt_sSearch
                    }
                }

            });

        });
    }
    if (typeof jQuery("#wpgmza_marker_list_container_" + map_id) === "object" && jQuery("#wpgmza_marker_list_container_" + map_id).length > 0) {
        if (jQuery("#wpgmza_marker_list_container_" + map_id).hasClass('wpgmza_marker_carousel')) {
            /* carousel listing */
            var data = {
                action: 'wpgmza_sl_carousel',
                security: wpgmaps_pro_nonce,
                map_id: map_id,
                marker_array: marker_sl_array
            };
            jQuery.post(ajaxurl, data, function(response) {
                items = default_items;
                jQuery("#wpgmza_marker_list_container_" + map_id + "").html(response);
                if (marker_sl_array.length < items) { items = marker_sl_array.length; } else { items = default_items; }
                if (items < 1) { items = 1; }

                jQuery("#wpgmza_marker_list_" + map_id + "").owlCarousel({
                    autoPlay: autoplay,
                    lazyLoad: lazyload,
                    autoHeight: autoheight,
                    pagination: pagination,
                    nav: navigation,
                    items: items
                });

            });
        }
    } else if (typeof jQuery("#wpgmza_marker_list_" + map_id) === "object") {
        if (jQuery("#wpgmza_marker_list_" + map_id).hasClass('wpgmza_basic_list')) {
            /* we're using the basic list marker listing */
            var data = {
                action: 'wpgmza_sl_basiclist',
                security: wpgmaps_pro_nonce,
                map_id: map_id,
                marker_array: marker_sl_array
            };
            jQuery.post(ajaxurl, data, function(response) {
                items = default_items;
                jQuery("#wpgmza_marker_list_" + map_id + "").html(response);

            });
        } else {
            /* we must be using the basic table listing */
            var data = {
                action: 'wpgmza_sl_basictable',
                security: wpgmaps_pro_nonce,
                map_id: map_id,
                marker_array: marker_sl_array
            };
            /* basic marker listing listing */
            jQuery.post(ajaxurl, data, function(response) {
                jQuery("#wpgmza_marker_list_" + map_id + "").html(response);


            });

        }





    }







}


function wpgmza_filter_marker_lists(wpgmza_map_id, selectedValue) {

    /* mashup support */
    if (typeof wpgmaps_localize_mashup_ids !== "undefined" && wpgmaps_localize_mashup_ids !== null) {
        if (typeof wpgmaps_localize_mashup_ids[wpgmza_map_id] !== "undefined") {
            list_mashup_ids = wpgmaps_localize_mashup_ids[wpgmza_map_id];
        } else {
            list_mashup_ids = false;
        }
    } else {
        list_mashup_ids = false;
    }



    if (typeof jQuery("#wpgmza_table_" + wpgmza_map_id) === "object") {
        if (selectedValue === 0 || selectedValue === "All" || selectedValue === "0") {

            /* update datatables */
            var data = {
                action: 'wpgmza_datatables',
                security: wpgmaps_pro_nonce,
                map_id: wpgmza_map_id,
                category_data: 'all'
            };
            jQuery.post(ajaxurl, data, function(response) {
                wpgmzaTable[wpgmza_map_id].fnDestroy();
                jQuery("#wpgmza_table_" + wpgmza_map_id + "").html(response);



                wpgmzaTable[wpgmza_map_id] = jQuery('#wpgmza_table_' + wpgmza_map_id).DataTable({
                    "bDestroy": true,
                    responsive: true,
                    "iDisplayLength": wpgmza_settings_default_items,
                    "bProcessing": true,
                    "aaSorting": [],
                    "oLanguage": {
                        "sLengthMenu": wpgm_dt_sLengthMenu,
                        "sZeroRecords": wpgm_dt_sZeroRecords,
                        "sInfo": wpgm_dt_sInfo,
                        "sInfoEmpty": wpgm_dt_sInfoEmpty,
                        "sInfoFiltered": wpgm_dt_sInfoFiltered,
                        "sSearch": wpgm_dt_sSearch,
                        "oPaginate": {
                            "sFirst": wpgm_dt_sFirst,
                            "sLast": wpgm_dt_sLast,
                            "sNext": wpgm_dt_sNext,
                            "sPrevious": wpgm_dt_sPrevious,
                            "sSearch": wpgm_dt_sSearch
                        }
                    }

                });

            });
        } else {

            /* update datatables */
            var data = {
                action: 'wpgmza_datatables',
                security: wpgmaps_pro_nonce,
                map_id: wpgmza_map_id,
                category_data: selectedValue
            };
            jQuery.post(ajaxurl, data, function(response) {
                if (typeof wpgmzaTable[wpgmza_map_id] !== "undefined") {
                    wpgmzaTable[wpgmza_map_id].destroy();

                    jQuery("#wpgmza_table_" + wpgmza_map_id + "").html(response);

                    /* deprecated in 5.64 as it apparently is not required to do this anymore. */
                    wpgmzaTable[wpgmza_map_id] = jQuery('#wpgmza_table_' + wpgmza_map_id).DataTable({
                        "bDestroy": true,
                        responsive: true,
                        "iDisplayLength": wpgmza_settings_default_items,
                        "bProcessing": true,
                        "aaSorting": [],
                        "oLanguage": {
                            "sLengthMenu": wpgm_dt_sLengthMenu,
                            "sZeroRecords": wpgm_dt_sZeroRecords,
                            "sInfo": wpgm_dt_sInfo,
                            "sInfoEmpty": wpgm_dt_sInfoEmpty,
                            "sInfoFiltered": wpgm_dt_sInfoFiltered,
                            "sSearch": wpgm_dt_sSearch,
                            "oPaginate": {
                                "sFirst": wpgm_dt_sFirst,
                                "sLast": wpgm_dt_sLast,
                                "sNext": wpgm_dt_sNext,
                                "sPrevious": wpgm_dt_sPrevious,
                                "sSearch": wpgm_dt_sSearch
                            }
                        }

                    });
                }

            });

        }

    }
    if (jQuery("#wpgmza_marker_list_" + wpgmza_map_id).length > 0) {

        /* check whether we are using carousel or normal marker listing */

        if (jQuery("#wpgmza_marker_list_" + wpgmza_map_id).hasClass('wpgmza_marker_carousel')) {

            if (selectedValue === 0 || selectedValue === "All" || selectedValue === "0") {

                var data = {
                    action: 'wpgmza_carousel_update',
                    security: wpgmaps_pro_nonce,
                    mashup_maps: list_mashup_ids,
                    map_id: wpgmza_map_id,
                    category_data: 'all'
                };
            } else {

                var data = {
                    action: 'wpgmza_carousel_update',
                    security: wpgmaps_pro_nonce,
                    mashup_maps: list_mashup_ids,
                    map_id: wpgmza_map_id,
                    category_data: selectedValue
                };
            }
            /* carousel listing */
            jQuery.post(ajaxurl, data, function(response) {
                jQuery("#wpgmza_marker_list_container_" + wpgmza_map_id + "").html(response);
                jQuery("#wpgmza_marker_list_" + wpgmza_map_id + "").owlCarousel({
                    autoPlay: autoplay,
                    lazyLoad: lazyload,
                    autoHeight: autoheight,
                    pagination: pagination,
                    nav: navigation,
                    items: items
                });

            });
        } else if (jQuery("#wpgmza_marker_list_" + wpgmza_map_id).hasClass('wpgmza_basic_list')) {

            /* we're using the basic list marker listing */
            if (selectedValue === 0 || selectedValue === "All" || selectedValue === "0") {
                var data = {
                    action: 'wpgmza_basiclist_update',
                    security: wpgmaps_pro_nonce,
                    map_id: wpgmza_map_id,
                    mashup_maps: list_mashup_ids,
                    category_data: 'all'
                };
            } else {
                var data = {
                    action: 'wpgmza_basiclist_update',
                    security: wpgmaps_pro_nonce,
                    map_id: wpgmza_map_id,
                    mashup_maps: list_mashup_ids,
                    category_data: selectedValue
                };
            }
            /* basic marker listing listing */
            jQuery.post(ajaxurl, data, function(response) {
                jQuery("#wpgmza_marker_list_" + wpgmza_map_id + "").html(response);


            });

        } else {
            /* we must be using the basic table listing */
            if (selectedValue === 0 || selectedValue === "All" || selectedValue === "0") {
                var data = {
                    action: 'wpgmza_basictable_update',
                    security: wpgmaps_pro_nonce,
                    mashup_maps: list_mashup_ids,
                    map_id: wpgmza_map_id,
                    category_data: 'all'
                };
            } else {
                var data = {
                    action: 'wpgmza_basictable_update',
                    security: wpgmaps_pro_nonce,
                    mashup_maps: list_mashup_ids,
                    map_id: wpgmza_map_id,
                    category_data: selectedValue
                };
            }
            /* basic marker listing listing */
            jQuery.post(ajaxurl, data, function(response) {
                jQuery("#wpgmza_marker_list_" + wpgmza_map_id + "").html(response);


            });
        }



    }


}




function reset_marker_lists(wpgmza_map_id) {

    if (typeof jQuery("#wpgmza_table_" + wpgmza_map_id) === "object" && jQuery("#wpgmza_table_" + wpgmza_map_id).length > 0) {
        /* update datatables */
        var data = {
            action: 'wpgmza_datatables',
            security: wpgmaps_pro_nonce,
            map_id: wpgmza_map_id,
            category_data: 'all'
        };
        jQuery.post(ajaxurl, data, function(response) {
            jQuery("#wpgmza_table_" + wpgmza_map_id + "").html(response);
            wpgmzaTable[wpgmza_map_id] = jQuery('#wpgmza_table_' + wpgmza_map_id).DataTable({
                "bDestroy": true,
                responsive: true,
                "iDisplayLength": wpgmza_settings_default_items,
                "bProcessing": true,
                "aaSorting": [],
                "oLanguage": {
                    "sLengthMenu": wpgm_dt_sLengthMenu,
                    "sZeroRecords": wpgm_dt_sZeroRecords,
                    "sInfo": wpgm_dt_sInfo,
                    "sInfoEmpty": wpgm_dt_sInfoEmpty,
                    "sInfoFiltered": wpgm_dt_sInfoFiltered,
                    "sSearch": wpgm_dt_sSearch,
                    "oPaginate": {
                        "sFirst": wpgm_dt_sFirst,
                        "sLast": wpgm_dt_sLast,
                        "sNext": wpgm_dt_sNext,
                        "sPrevious": wpgm_dt_sPrevious,
                        "sSearch": wpgm_dt_sSearch
                    }
                }

            });

        });

    }

    if (jQuery("#wpgmza_marker_list_" + wpgmza_map_id).length > 0) {

        /* check whether we are using carousel or normal marker listing */

        if (jQuery("#wpgmza_marker_list_" + wpgmza_map_id).hasClass('wpgmza_marker_carousel')) {

            var data = {
                action: 'wpgmza_carousel_update',
                security: wpgmaps_pro_nonce,
                map_id: wpgmza_map_id,
                category_data: 'all'
            };

            /* carousel listing */
            jQuery.post(ajaxurl, data, function(response) {
                jQuery("#wpgmza_marker_list_container_" + wpgmza_map_id + "").html(response);
                jQuery("#wpgmza_marker_list_" + wpgmza_map_id + "").owlCarousel({
                    autoPlay: autoplay,
                    lazyLoad: lazyload,
                    autoHeight: autoheight,
                    pagination: pagination,
                    nav: navigation,
                    items: default_items
                });

            });
        } else if (jQuery("#wpgmza_marker_list_" + wpgmza_map_id).hasClass('wpgmza_basic_list')) {
            /* we're using the basic list marker listing */



            var data = {
                action: 'wpgmza_basiclist_update',
                security: wpgmaps_pro_nonce,
                map_id: wpgmza_map_id,
                category_data: 'all'
            };

            /* basic marker listing listing */
            jQuery.post(ajaxurl, data, function(response) {
                jQuery("#wpgmza_marker_list_" + wpgmza_map_id + "").html(response);


            });

        } else {
            /* we must be using the basic table listing */

            var data = {
                action: 'wpgmza_basictable_update',
                security: wpgmaps_pro_nonce,
                map_id: wpgmza_map_id,
                category_data: 'all'
            };
            /* basic marker listing listing */
            jQuery.post(ajaxurl, data, function(response) {
                jQuery("#wpgmza_marker_list_" + wpgmza_map_id + "").html(response);


            });
        }



    }


}

jQuery(function() {

    jQuery(window).load(function() {
        jQuery(".wpgmaps_auto_get_directions").each(function() {
            var this_bliksem = jQuery(this);
            var this_bliksem_id = jQuery(this).attr('id');
            jQuery("#wpgmaps_directions_edit_" + this_bliksem_id).show(function() {
                jQuery(this_bliksem).click();
            });

        });
    });

    jQuery(document).ready(function() {
        if (typeof wpgmaps_localize_marker_data !== "undefined") { document.marker_data_array = wpgmaps_localize_marker_data; }

        for (var entry in wpgmaps_localize) {
            if (jQuery("#wpgmaps_directions_notification_" + entry).length > 0) {
                orig_fetching_directions = jQuery("#wpgmaps_directions_notification_" + entry).html();
            }


            if ("undefined" !== typeof wpgmaps_localize[entry]['other_settings'] && "undefined" !== typeof wpgmaps_localize[entry]['other_settings']['list_markers_by'] && wpgmaps_localize[entry]['other_settings']['list_markers_by'] === "3") {
                if ("undefined" !== typeof wpgmaps_localize_global_settings['carousel_lazyload'] && wpgmaps_localize_global_settings['carousel_lazyload'] === "yes") { lazyload = true; } else { lazyload = false; }
                if ("undefined" === typeof wpgmaps_localize_global_settings['carousel_lazyload']) { lazyload = true; }

                if ("undefined" !== typeof wpgmaps_localize_global_settings['carousel_autoplay']) { autoplay = parseInt(wpgmaps_localize_global_settings['carousel_autoplay']); } else { autoplay = false; }
                if ("undefined" === typeof wpgmaps_localize_global_settings['carousel_autoplay']) { autoplay = 6000; }

                if ("undefined" !== typeof wpgmaps_localize_global_settings['carousel_autoheight'] && wpgmaps_localize_global_settings['carousel_autoheight'] === "yes") { autoheight = true; } else { autoheight = false; }
                if ("undefined" === typeof wpgmaps_localize_global_settings['carousel_autoheight']) { autoheight = true; }

                if ("undefined" !== typeof wpgmaps_localize_global_settings['carousel_pagination'] && wpgmaps_localize_global_settings['carousel_pagination'] === "yes") { pagination = true; } else { pagination = false; }
                if ("undefined" === typeof wpgmaps_localize_global_settings['carousel_pagination']) { pagination = false; }

                if ("undefined" !== typeof wpgmaps_localize_global_settings['carousel_navigation'] && wpgmaps_localize_global_settings['carousel_navigation'] === "yes") { navigation = true; } else { navigation = false; }
                if ("undefined" === typeof wpgmaps_localize_global_settings['carousel_navigation']) { navigation = true; }

                if ("undefined" !== typeof wpgmaps_localize_global_settings['carousel_items']) { items = parseInt(wpgmaps_localize_global_settings['carousel_items']); } else { items = 5; }
                if ("undefined" === typeof wpgmaps_localize_global_settings['carousel_items']) { items = 6; }
                default_items = items;

                if (wpgmaps_localize[entry]['total_markers'] < items) { items = wpgmaps_localize[entry]['total_markers']; }
                jQuery("#wpgmza_marker_list_" + wpgmaps_localize[entry]['id']).owlCarousel({
                    autoPlay: autoplay,
                    lazyLoad: lazyload,
                    autoHeight: autoheight,
                    pagination: pagination,
                    nav: navigation,
                    items: items
                });

            }
        }



        if (/1\.(0|1|2|3|4|5|6|7)\.(0|1|2|3|4|5|6|7|8|9)/.test(jQuery.fn.jquery)) {
            for (var entry in wpgmaps_localize) {
                document.getElementById('wpgmza_map_' + wpgmaps_localize[entry]['id']).innerHTML = 'Error: Your version of jQuery is outdated. WP Google Maps requires jQuery version 1.7+ to function correctly. Go to Maps->Settings and check the box that allows you to over-ride your current jQuery to try eliminate this problem.';
            }
        } else {


            jQuery("body").on("click", ".wpgmaps_mlist_row", function() {
                var wpgmza_markerid = jQuery(this).attr("mid");
                var wpgmza_mapid = jQuery(this).attr("mapid");
                openInfoWindow(wpgmza_markerid, wpgmza_mapid, true);
                /* deprecated in 6.09 - see pro file for notes in 'wpgmaps_return_marker_anchors' function */
                /* location.hash = "#marker" + wpgmza_markerid; */
                location.hash = "#map" + wpgmza_mapid;
            });
            jQuery("body").on("click", ".wpgmaps_blist_row", function() {
                var wpgmza_markerid = jQuery(this).attr("mid");
                var wpgmza_mapid = jQuery(this).attr("mapid");
                openInfoWindow(wpgmza_markerid, wpgmza_mapid, true);

            });
            jQuery("body").on("change", "#wpgmza_filter_select", function() {

                /* do nothing if user has enabled store locator */
                var wpgmza_map_id = jQuery(this).attr("mid");
                if (jQuery("#addressInput_" + wpgmza_map_id).length > 0) {} else {

                    var selectedValue = jQuery(this).find(":selected").val();
                    var wpgmza_map_id = jQuery(this).attr("mid");
                    InitMap(wpgmza_map_id, selectedValue);
                    wpgmza_filter_marker_lists(wpgmza_map_id, selectedValue);
                }


            });
            jQuery("body").on("click", ".wpgmza_checkbox", function() {
                checkedCatValues = new Array();
                /* do nothing if user has enabled store locator */
                var wpgmza_map_id = jQuery(this).attr("mid");

                var original_click_cat = jQuery(this).attr("value");

                if (jQuery("#addressInput_" + wpgmza_map_id).length > 0) {} else {
                    var checkedCatValues = jQuery('.wpgmza_checkbox:checked').map(function() {
                        return this.value;
                    }).get();


                    /**
                     * find children categories
                     */

                    for (var tmp_cat_entry in checkedCatValues) {
                        var tmp_checker = true;
                        current_tmp_cat = parseInt(checkedCatValues[tmp_cat_entry]);


                        var counter = 0;

                        var cat_array_check_order = new Array();
                        /* set first category as 'to be checked' */
                        cat_array_check_order[current_tmp_cat] = 0;




                        while (tmp_checker === true) {

                            /* safety counter */
                            counter++;
                            if (counter > 1000) { break; }


                            for (current_category_to_check in cat_array_check_order) {

                                if (cat_array_check_order[current_category_to_check] === 0) {

                                    if (typeof wpgmaps_localize_categories[wpgmza_map_id] !== "undefined") {

                                        var children_found = 0;
                                        for (tmp_childd in wpgmaps_localize_categories[wpgmza_map_id]) {
                                            tmp_parent = wpgmaps_localize_categories[wpgmza_map_id][tmp_childd];
                                            if (parseInt(tmp_parent) === parseInt(current_category_to_check)) {
                                                /* found a child */


                                                /* should we parse this along to the ajax request? check global settings first */
                                                if (typeof wpgmaps_localize_global_settings['wpgmza_settings_cat_logic'] === "undefined" || parseInt(wpgmaps_localize_global_settings['wpgmza_settings_cat_logic']) === 0) {
                                                    if (typeof cat_array_check_order[tmp_childd] === "undefined") {
                                                        cat_array_check_order[tmp_childd] = 0;
                                                        /* add it to the array so that we can call it from the db */

                                                        if (jQuery.inArray(tmp_childd, checkedCatValues) === -1) {
                                                            checkedCatValues.push(tmp_childd);
                                                        }

                                                    }
                                                    children_found++;
                                                }
                                            }
                                        }
                                    }
                                }
                                /* mark this category as 'checked' */
                                cat_array_check_order[current_category_to_check] = 1;
                            }

                            /**
                             * Identify if all categories that needed to be checked were checked? i.e. they were all set to 1 
                             */
                            var tmp_continue = false;
                            for (tmp_checker2 in cat_array_check_order) {
                                if (cat_array_check_order[tmp_checker2] === 0) {
                                    tmp_continue = true;
                                }
                            }
                            if (!tmp_continue) {
                                /* we've checked everything, we can stop */
                                tmp_checker = false;
                            }

                        }



                    }



                    if (checkedCatValues[0] === "0" || typeof checkedCatValues === 'undefined' || checkedCatValues.length < 1) {
                        InitMap(wpgmza_map_id, 'all');
                        wpgmza_filter_marker_lists(wpgmza_map_id, 'all');
                    } else {
                        InitMap(wpgmza_map_id, checkedCatValues);
                        wpgmza_filter_marker_lists(wpgmza_map_id, checkedCatValues);
                    }

                }
            });



            jQuery("body").on("click", ".sl_use_loc", function() {
                var wpgmza_map_id = jQuery(this).attr("mid");
                jQuery('#addressInput_' + wpgmza_map_id).val(wpgmaps_lang_getting_location);

                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({ 'latLng': user_location }, function(results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            jQuery('#addressInput_' + wpgmza_map_id).val(results[0].formatted_address);
                        }
                    }
                });
            });
            jQuery("body").on("click", "#wpgmza_use_my_location_from", function() {
                var wpgmza_map_id = jQuery(this).attr("mid");
                jQuery('#wpgmza_input_from_' + wpgmza_map_id).val(wpgmaps_lang_getting_location);

                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({ 'latLng': user_location }, function(results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            jQuery('#wpgmza_input_from_' + wpgmza_map_id).val(results[0].formatted_address);
                        }
                    }
                });
            });
            jQuery("body").on("click", "#wpgmza_use_my_location_to", function() {
                var wpgmza_map_id = jQuery(this).attr("mid");
                jQuery('#wpgmza_input_to_' + wpgmza_map_id).val(wpgmaps_lang_getting_location);
                var geocoder = new google.maps.Geocoder();
                geocoder.geocode({ 'latLng': user_location }, function(results, status) {
                    if (status === google.maps.GeocoderStatus.OK) {
                        if (results[0]) {
                            jQuery('#wpgmza_input_to_' + wpgmza_map_id).val(results[0].formatted_address);
                        }
                    }
                });
            });



            jQuery('body').on('tabsactivate', function(event, ui) {
                for (var entry in wpgmaps_localize) {
                    InitMap(wpgmaps_localize[entry]['id'], 'all', false);
                }
            });
            jQuery('body').on('tabsshow', function(event, ui) {
                for (var entry in wpgmaps_localize) {
                    InitMap(wpgmaps_localize[entry]['id'], 'all', false);
                }
            });
            jQuery('body').on('accordionactivate', function(event, ui) {
                for (var entry in wpgmaps_localize) {
                    InitMap(wpgmaps_localize[entry]['id'], 'all', false);
                }
            });

            /* tab compatibility */
            jQuery('body').on('click', '.wpb_tabs_nav li', function(event, ui) { for (var entry in wpgmaps_localize) { InitMap(wpgmaps_localize[entry]['id'], 'all', false); } });
            jQuery('body').on('click', '.ui-tabs-nav li', function(event, ui) { for (var entry in wpgmaps_localize) { InitMap(wpgmaps_localize[entry]['id'], 'all', false); } });
            jQuery('body').on('click', '.tp-tabs li a', function(event, ui) { for (var entry in wpgmaps_localize) { InitMap(wpgmaps_localize[entry]['id'], 'all', false); } });
            jQuery('body').on('click', '.nav-tabs li a', function(event, ui) { for (var entry in wpgmaps_localize) { InitMap(wpgmaps_localize[entry]['id'], 'all', false); } });
            jQuery('body').on('click', '.vc_tta-panel-heading', function() { setTimeout(function() { for (var entry in wpgmaps_localize) { InitMap(wpgmaps_localize[entry]['id'], 'all', false);
                        jQuery(jQuery.fn.dataTable.tables(true)).DataTable().responsive.recalc(); } }, 500); });
            jQuery('body').on('click', '.ult_exp_section', function() { setTimeout(function() { for (var entry in wpgmaps_localize) { InitMap(wpgmaps_localize[entry]['id'], 'all', false);
                        jQuery(jQuery.fn.dataTable.tables(true)).DataTable().responsive.recalc(); } }, 300); });
            jQuery('body').on('click', '.x-accordion-heading', function() { setTimeout(function() { for (var entry in wpgmaps_localize) { InitMap(wpgmaps_localize[entry]['id'], 'all', false);
                        jQuery(jQuery.fn.dataTable.tables(true)).DataTable().responsive.recalc(); } }, 100); });
            jQuery('body').on('click', '.x-nav-tabs li', function(event, ui) { setTimeout(function() { for (var entry in wpgmaps_localize) { InitMap(wpgmaps_localize[entry]['id'], 'all', false); } }, 200); });
            jQuery('body').on('click', '.tab-title', function(event, ui) { setTimeout(function() { for (var entry in wpgmaps_localize) { InitMap(wpgmaps_localize[entry]['id'], 'all', false); } }, 200); });
            jQuery('body').on('click', '.tab-link', function(event, ui) { setTimeout(function() { for (var entry in wpgmaps_localize) { InitMap(wpgmaps_localize[entry]['id'], 'all', false); } }, 200); });
            jQuery('body').on('click', '.et_pb_tabs_controls li', function(event, ui) { setTimeout(function() { for (var entry in wpgmaps_localize) { InitMap(wpgmaps_localize[entry]['id'], 'all', false); } }, 200); });
            jQuery('body').on('click', '.fusion-tab-heading', function(event, ui) { setTimeout(function() { for (var entry in wpgmaps_localize) { InitMap(wpgmaps_localize[entry]['id'], 'all', false); } }, 200); });
            jQuery('body').on('click', '.et_pb_tab', function(event, ui) { setTimeout(function() { for (var entry in wpgmaps_localize) { InitMap(wpgmaps_localize[entry]['id'], 'all', false); } }, 200); });
            jQuery('body').on('click', '.gdl-tabs li', function(event, ui) { setTimeout(function() { for (var entry in wpgmaps_localize) { InitMap(wpgmaps_localize[entry]['id'], 'all', false); } }, 200); });
            jQuery('body').on('click', '#tabnav  li', function(event, ui) { setTimeout(function() { for (var entry in wpgmaps_localize) { InitMap(wpgmaps_localize[entry]['id'], 'all', false); } }, 200); });
            jQuery('body').on('click', '.tri-tabs-nav span', function(event, ui) { setTimeout(function() { for (var entry in wpgmaps_localize) { InitMap(wpgmaps_localize[entry]['id'], 'all', false); } }, 200); });


            for (var entry in wpgmaps_localize) {
                jQuery("#wpgmza_map_" + wpgmaps_localize[entry]['id']).css({
                    height: wpgmaps_localize[entry]['map_height'] + '' + wpgmaps_localize[entry]['map_height_type'],
                    width: wpgmaps_localize[entry]['map_width'] + '' + wpgmaps_localize[entry]['map_width_type']

                });
            }


            for (var entry in wpgmaps_localize) {
                InitMap(wpgmaps_localize[entry]['id'], wpgmaps_localize_cat_ids[wpgmaps_localize[entry]['id']], false);
            }

            for (var entry in wpgmaps_localize) {

                /*
                removed in 5.54 as we are sorting via PHP first
                 */
                /*
                if (wpgmaps_localize[entry]['order_markers_by'] === "1") { wpgmaps_order_by = parseInt(0); } 
                else if (wpgmaps_localize[entry]['order_markers_by'] === "2") { wpgmaps_order_by = parseInt(2); } 
                else if (wpgmaps_localize[entry]['order_markers_by'] === "3") { wpgmaps_order_by = parseInt(4); } 
                else if (wpgmaps_localize[entry]['order_markers_by'] === "4") { wpgmaps_order_by = parseInt(5); } 
                else if (wpgmaps_localize[entry]['order_markers_by'] === "5") { wpgmaps_order_by = parseInt(3); } 
                else { wpgmaps_order_by = 0; }
                if (wpgmaps_localize[entry]['order_markers_choice'] === "1") { wpgmaps_order_by_choice = "asc"; } 
                else { wpgmaps_order_by_choice = "desc"; }
                */
                if (wpgmaps_localize_global_settings['wpgmza_default_items'] === "" || 'undefined' === typeof wpgmaps_localize_global_settings['wpgmza_default_items']) { wpgmza_settings_default_items = 10; } else { wpgmza_settings_default_items = parseInt(wpgmaps_localize_global_settings['wpgmza_default_items']); }

                if (jQuery('#wpgmza_table_' + wpgmaps_localize[entry]['id']).length === 0) {} else {

                    wpgmzaTable[wpgmaps_localize[entry]['id']] = jQuery('#wpgmza_table_' + wpgmaps_localize[entry]['id']).DataTable({
                        "bProcessing": true,
                        "aaSorting": [],
                        "iDisplayLength": wpgmza_settings_default_items,
                        responsive: true,
                        "oLanguage": {
                            "sLengthMenu": wpgm_dt_sLengthMenu,
                            "sZeroRecords": wpgm_dt_sZeroRecords,
                            "sInfo": wpgm_dt_sInfo,
                            "sInfoEmpty": wpgm_dt_sInfoEmpty,
                            "sInfoFiltered": wpgm_dt_sInfoFiltered,
                            "sSearch": wpgm_dt_sSearch,
                            "oPaginate": {
                                "sFirst": wpgm_dt_sFirst,
                                "sLast": wpgm_dt_sLast,
                                "sNext": wpgm_dt_sNext,
                                "sPrevious": wpgm_dt_sPrevious,
                                "sSearch": wpgm_dt_sSearch
                            }
                        }
                    });


                    if (typeof wpgmza_controls_active[entry] !== 'undefined' && wpgmza_controls_active[entry]) {
                        /* hide certain elements */
                        jQuery("#wpgmza_table_" + [entry] + "_length").hide();
                    }

                    if (typeof wpgmaps_localize[entry]['other_settings']['store_locator_hide_before_search'] !== "undefined" && wpgmaps_localize[entry]['other_settings']['store_locator_hide_before_search'] === 1) {
                        jQuery('#wpgmza_marker_holder_' + wpgmaps_localize[entry]['id']).hide();
                    }
                }
                if (typeof wpgmaps_localize[entry]['other_settings']['store_locator_hide_before_search'] !== "undefined" && wpgmaps_localize[entry]['other_settings']['store_locator_hide_before_search'] === 1) {
                    if (jQuery('#wpgmza_marker_list_container_' + wpgmaps_localize[entry]['id']).length > 0) {
                        jQuery('#wpgmza_marker_list_container_' + wpgmaps_localize[entry]['id']).hide();
                    }
                }
            }


        }








    });








    for (var entry in wpgmaps_localize) {

        /* general directions settings and variables */
        directionsDisplay[wpgmaps_localize[entry]['id']];
        directionsService[wpgmaps_localize[entry]['id']] = new google.maps.DirectionsService();
        var currentDirections = null;
        var oldDirections = [];
        var new_gps;

        if (wpgmaps_localize[entry]['styling_json'] !== '' && wpgmaps_localize[entry]['styling_enabled'] === "1") {
            wpgmza_adv_styling_json[wpgmaps_localize[entry]['id']] = jQuery.parseJSON(wpgmaps_localize[entry]['styling_json']);
        } else {
            wpgmza_adv_styling_json[wpgmaps_localize[entry]['id']] = "";
        }


        MYMAP[wpgmaps_localize[entry]['id']] = {
            map: null,
            bounds: null,
            mc: null
        };


        if (wpgmaps_localize_global_settings['wpgmza_settings_map_draggable'] === "" || 'undefined' === typeof wpgmaps_localize_global_settings['wpgmza_settings_map_draggable']) { wpgmza_settings_map_draggable = true; } else { wpgmza_settings_map_draggable = false; }
        if (wpgmaps_localize_global_settings['wpgmza_settings_map_clickzoom'] === "" || 'undefined' === typeof wpgmaps_localize_global_settings['wpgmza_settings_map_clickzoom']) { wpgmza_settings_map_clickzoom = false; } else { wpgmza_settings_map_clickzoom = true; }
        if (wpgmaps_localize_global_settings['wpgmza_settings_map_scroll'] === "" || 'undefined' === typeof wpgmaps_localize_global_settings['wpgmza_settings_map_scroll']) { wpgmza_settings_map_scroll = true; } else { wpgmza_settings_map_scroll = false; }
        if (wpgmaps_localize_global_settings['wpgmza_settings_map_zoom'] === "" || 'undefined' === typeof wpgmaps_localize_global_settings['wpgmza_settings_map_zoom']) { wpgmza_settings_map_zoom = true; } else { wpgmza_settings_map_zoom = false; }
        if (wpgmaps_localize_global_settings['wpgmza_settings_map_pan'] === "" || 'undefined' === typeof wpgmaps_localize_global_settings['wpgmza_settings_map_pan']) { wpgmza_settings_map_pan = true; } else { wpgmza_settings_map_pan = false; }
        if (wpgmaps_localize_global_settings['wpgmza_settings_map_type'] === "" || 'undefined' === typeof wpgmaps_localize_global_settings['wpgmza_settings_map_type']) { wpgmza_settings_map_type = true; } else { wpgmza_settings_map_type = false; }
        if (wpgmaps_localize_global_settings['wpgmza_settings_map_streetview'] === "" || 'undefined' === typeof wpgmaps_localize_global_settings['wpgmza_settings_map_streetview']) { wpgmza_settings_map_streetview = true; } else { wpgmza_settings_map_streetview = false; }


        if ('undefined' === typeof wpgmaps_localize[entry]['other_settings']['map_max_zoom'] || wpgmaps_localize[entry]['other_settings']['map_max_zoom'] === "") { wpgmza_max_zoom = 0; } else { wpgmza_max_zoom = parseInt(wpgmaps_localize[entry]['other_settings']['map_max_zoom']); }
        if ('undefined' === typeof wpgmaps_localize[entry]['other_settings']['map_min_zoom'] || wpgmaps_localize[entry]['other_settings']['map_min_zoom'] === "") { wpgmza_min_zoom = 21; } else { wpgmza_min_zoom = parseInt(wpgmaps_localize[entry]['other_settings']['map_min_zoom']); }



        MYMAP[wpgmaps_localize[entry]['id']].init = function(selector, latLng, zoom, maptype, mapid) {
            if (typeof wpgmaps_localize_map_types !== "undefined") {
                var override_type = wpgmaps_localize_map_types[mapid];
            } else {
                var override_type = "";
            }

            var myOptions = {
                zoom: zoom,
                minZoom: wpgmza_max_zoom,
                maxZoom: wpgmza_min_zoom,
                center: latLng,
                draggable: wpgmza_settings_map_draggable,
                disableDoubleClickZoom: wpgmza_settings_map_clickzoom,
                scrollwheel: wpgmza_settings_map_scroll,
                zoomControl: wpgmza_settings_map_zoom,
                panControl: wpgmza_settings_map_pan,
                mapTypeControl: wpgmza_settings_map_type,
                streetViewControl: wpgmza_settings_map_streetview,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };


            if (override_type !== "") {
                if (override_type === "ROADMAP") { myOptions.mapTypeId = google.maps.MapTypeId.ROADMAP; } else if (override_type === "SATELLITE") { myOptions.mapTypeId = google.maps.MapTypeId.SATELLITE; } else if (override_type === "HYBRID") { myOptions.mapTypeId = google.maps.MapTypeId.HYBRID; } else if (override_type === "TERRAIN") { myOptions.mapTypeId = google.maps.MapTypeId.TERRAIN; } else { myOptions.mapTypeId = google.maps.MapTypeId.ROADMAP; }
            } else {
                if (maptype === "1") { myOptions.mapTypeId = google.maps.MapTypeId.ROADMAP; } else if (maptype === "2") { myOptions.mapTypeId = google.maps.MapTypeId.SATELLITE; } else if (maptype === "3") { myOptions.mapTypeId = google.maps.MapTypeId.HYBRID; } else if (maptype === "4") { myOptions.mapTypeId = google.maps.MapTypeId.TERRAIN; } else { myOptions.mapTypeId = google.maps.MapTypeId.ROADMAP; }
            }

            if (wpgmaps_localize_global_settings['wpgmza_settings_map_full_screen_control'] === "" || 'undefined' === typeof wpgmaps_localize_global_settings['wpgmza_settings_map_full_screen_control']) {
                myOptions.fullscreenControl = true;
            } else {
                myOptions.fullscreenControl = false;
            }


            this.map = new google.maps.Map(jQuery(selector)[0], myOptions);
            if ("undefined" !== typeof wpgmaps_localize[mapid]['other_settings']['wpgmza_theme_data'] && wpgmaps_localize[mapid]['other_settings']['wpgmza_theme_data'] !== false && wpgmaps_localize[mapid]['other_settings']['wpgmza_theme_data'] !== "") {
                wpgmza_theme_data = jQuery.parseJSON(wpgmaps_localize[mapid]['other_settings']['wpgmza_theme_data']);
                this.map.setOptions({ styles: jQuery.parseJSON(wpgmaps_localize[mapid]['other_settings']['wpgmza_theme_data']) });
            }

            if (override_type === "STREETVIEW") {
                var panoramaOptions = {
                    position: latLng
                };
                var panorama = new google.maps.StreetViewPanorama(jQuery(selector)[0], panoramaOptions);
                this.map.setStreetView(panorama);
            }



            this.bounds = new google.maps.LatLngBounds();
            jQuery("#wpgmza_map_" + mapid).trigger('wpgooglemaps_loaded');





            /* insert polygon and polyline functionality */
            if (wpgmaps_localize_heatmap_settings !== null) {
                if (typeof wpgmaps_localize_heatmap_settings[mapid] !== "undefined") {
                    for (var poly_entry in wpgmaps_localize_heatmap_settings[mapid]) {
                        add_heatmap(mapid, poly_entry);
                    }
                }
            }
            if (wpgmaps_localize_polygon_settings !== null) {
                if (typeof wpgmaps_localize_polygon_settings[mapid] !== "undefined") {
                    for (var poly_entry in wpgmaps_localize_polygon_settings[mapid]) {
                        add_polygon(mapid, poly_entry);
                    }
                }
            }
            if (wpgmaps_localize_polyline_settings !== null) {
                if (typeof wpgmaps_localize_polyline_settings[mapid] !== "undefined") {
                    for (var poly_entry in wpgmaps_localize_polyline_settings[mapid]) {
                        add_polyline(mapid, poly_entry);
                    }
                }
            }


            /*
            if (wpgmaps_localize_polyline_settings !== null) {
                if (wpgmaps_localize_polyline_settings[mapid] !== null) { 
                    for(var poly_entry in wpgmaps_localize_polyline_settings[mapid]) {
                        var tmp_data = wpgmaps_localize_polyline_settings[mapid];

                        var tmp_polydata = tmp_data[poly_entry]['polydata'];
                         var WPGM_PathData = new Array();
                         for (tmp_entry2 in tmp_polydata) {
                             WPGM_PathData.push(new google.maps.LatLng(tmp_polydata[tmp_entry2][0], tmp_polydata[tmp_entry2][1]));

                         }
                        if (tmp_data[poly_entry]['lineopacity'] === null || tmp_data[poly_entry]['lineopacity'] === "") {
                            tmp_data[poly_entry]['lineopacity'] = 1;
                        }
                        
                        var WPGM_Path = new google.maps.Polyline({
                         path: WPGM_PathData,
                         strokeColor: "#"+tmp_data[poly_entry]['linecolor'],
                         strokeOpacity: tmp_data[poly_entry]['opacity'],
                         fillColor: "#"+tmp_data[poly_entry]['fillcolor'],
                         strokeWeight: tmp_data[poly_entry]['linethickness']
                       });
                       WPGM_Path.setMap(MYMAP[mapid].map);

                    }
                 }
            }
            */

            if (wpgmaps_localize[entry]['bicycle'] === "1") {
                var bikeLayer = new google.maps.BicyclingLayer();
                bikeLayer.setMap(MYMAP[mapid].map);
            }
            if (wpgmaps_localize[entry]['traffic'] === "1") {
                var trafficLayer = new google.maps.TrafficLayer();
                trafficLayer.setMap(MYMAP[mapid].map);
            }
            if ("undefined" !== typeof wpgmaps_localize[mapid]['other_settings']['weather_layer'] && wpgmaps_localize[mapid]['other_settings']['weather_layer'] === 1) {
                if ("undefined" === typeof google.maps.weather) {} else {
                    if ("undefined" !== typeof wpgmaps_localize[mapid]['other_settings']['weather_layer_temp_type'] && wpgmaps_localize[mapid]['other_settings']['weather_layer_temp_type'] === 2) {
                        var weatherLayer = new google.maps.weather.WeatherLayer({
                            temperatureUnits: google.maps.weather.TemperatureUnit.FAHRENHEIT
                        });
                        weatherLayer.setMap(MYMAP[mapid].map);
                    } else {
                        var weatherLayer = new google.maps.weather.WeatherLayer({
                            temperatureUnits: google.maps.weather.TemperatureUnit.CELSIUS
                        });
                        weatherLayer.setMap(MYMAP[mapid].map);
                    }
                }
            }
            if ("undefined" !== typeof wpgmaps_localize[mapid]['other_settings']['cloud_layer'] && wpgmaps_localize[mapid]['other_settings']['cloud_layer'] === 1) {
                if ("undefined" === typeof google.maps.weather) {} else {
                    var cloudLayer = new google.maps.weather.CloudLayer();
                    cloudLayer.setMap(MYMAP[mapid].map);
                }
            }
            if ("undefined" !== typeof wpgmaps_localize[mapid]['other_settings']['transport_layer'] && wpgmaps_localize[mapid]['other_settings']['transport_layer'] === 1) {
                var transitLayer = new google.maps.TransitLayer();
                transitLayer.setMap(MYMAP[mapid].map);
            }
            if (wpgmaps_localize[entry]['kml'] !== "") {
                var wpgmaps_d = new Date();
                var wpgmaps_ms = wpgmaps_d.getTime();

                arr = wpgmaps_localize[mapid]['kml'].split(',');
                arr.forEach(function(entry) {
                    var georssLayer = new google.maps.KmlLayer(entry + '?tstamp=' + wpgmaps_ms, { preserveViewport: true });
                    georssLayer.setMap(MYMAP[mapid].map);
                });



            }
            if (wpgmaps_localize[mapid]['fusion'] !== "") {
                var fusionlayer = new google.maps.FusionTablesLayer(wpgmaps_localize[mapid]['fusion'], {
                    suppressInfoWindows: false
                });
                fusionlayer.setMap(MYMAP[mapid].map);
            }



            if (typeof wpgmaps_localize[mapid]['other_settings']['push_in_map'] !== 'undefined' && wpgmaps_localize[mapid]['other_settings']['push_in_map'] === "1") {


                if (typeof wpgmaps_localize[mapid]['other_settings']['wpgmza_push_in_map_width'] !== 'undefined') {
                    var wpgmza_con_width = wpgmaps_localize[mapid]['other_settings']['wpgmza_push_in_map_width'];
                } else {
                    var wpgmza_con_width = "30%";
                }
                if (typeof wpgmaps_localize[mapid]['other_settings']['wpgmza_push_in_map_height'] !== 'undefined') {
                    var wpgmza_con_height = wpgmaps_localize[mapid]['other_settings']['wpgmza_push_in_map_height'];
                } else {
                    var wpgmza_con_height = "50%";
                }

                if (jQuery('#wpgmza_marker_holder_' + mapid).length) {
                    var legend = document.getElementById('wpgmza_marker_holder_' + mapid);
                    jQuery(legend).width(wpgmza_con_width);
                    jQuery(legend).css('margin', '15px');
                    jQuery(legend).addClass('wpgmza_innermap_holder');
                    jQuery(legend).addClass('wpgmza-shadow');
                    jQuery('#wpgmza_table_' + mapid).addClass('');
                    wpgmza_controls_active[mapid] = true;
                } else if (jQuery('#wpgmza_marker_list_container_' + mapid).length) {
                    var legend_tmp = document.getElementById('wpgmza_marker_list_container_' + mapid);

                    jQuery('#wpgmza_marker_list_container_' + mapid).wrap("<div id='wpgmza_marker_list_parent_" + mapid + "'></div>");
                    var legend = document.getElementById('wpgmza_marker_list_parent_' + mapid);
                    jQuery(legend).width(wpgmza_con_width);
                    jQuery(legend).height(wpgmza_con_height);

                    jQuery(legend).css('margin', '15px');
                    jQuery(legend).css('overflow', 'auto');

                    /* check if we're using the carousel option */
                    if (jQuery(legend_tmp).hasClass("wpgmza_marker_carousel")) {} else {
                        jQuery(legend).addClass('wpgmza_innermap_holder');
                        jQuery(legend).addClass('wpgmza-shadow');
                    }

                    jQuery('#wpgmza_marker_list_' + mapid).addClass('');
                    wpgmza_controls_active[mapid] = true;

                } else if (jQuery('#wpgmza_marker_list_' + mapid).length) {
                    var legend_tmp = document.getElementById('wpgmza_marker_list_' + mapid);

                    jQuery('#wpgmza_marker_list_' + mapid).wrap("<div id='wpgmza_marker_list_parent_" + mapid + "'></div>");
                    var legend = document.getElementById('wpgmza_marker_list_parent_' + mapid);
                    jQuery(legend).width(wpgmza_con_width);
                    jQuery(legend).height(wpgmza_con_height);

                    jQuery(legend).css('margin', '15px');
                    jQuery(legend).css('overflow', 'auto');

                    /* check if we're using the carousel option */
                    if (jQuery(legend_tmp).hasClass("wpgmza_marker_carousel")) {} else {
                        jQuery(legend).addClass('wpgmza_innermap_holder');
                        jQuery(legend).addClass('wpgmza-shadow');
                    }

                    jQuery('#wpgmza_marker_list_' + mapid).addClass('');
                    wpgmza_controls_active[mapid] = true;
                }
                /*
                    beta - still to add options for this

            
                if (jQuery('#wpgmza_filter_'+mapid).length) {
                    var legend_tmp = document.getElementById('wpgmza_filter_'+mapid);
                    
                    jQuery('#wpgmza_filter_'+mapid).wrap("<div id='wpgmza_filter_parent_"+mapid+"'></div>");
                    var legend = document.getElementById('wpgmza_filter_parent_'+mapid);
                    jQuery(legend).width(wpgmza_con_width);
                    jQuery(legend).height(wpgmza_con_height);

                    jQuery(legend).css('margin','15px');
                    jQuery(legend).css('overflow','auto');

                    
                    if (jQuery(legend_tmp).hasClass("wpgmza_marker_carousel")) { } else {
                        jQuery(legend).addClass('wpgmza_innermap_holder');
                        jQuery(legend).addClass('wpgmza-shadow');
                    }

                    jQuery('#wpgmza_filter_'+mapid).addClass('');
                    wpgmza_controls_active[mapid] = true;
                }
                */
                if (typeof legend !== 'undefined') {
                    if (typeof wpgmaps_localize[mapid]['other_settings']['push_in_map_placement'] !== 'undefined') {
                        if (wpgmaps_localize[mapid]['other_settings']['push_in_map_placement'] === "1") { MYMAP[mapid].map.controls[google.maps.ControlPosition.TOP_CENTER].push(legend); } else if (wpgmaps_localize[mapid]['other_settings']['push_in_map_placement'] === "2") { MYMAP[mapid].map.controls[google.maps.ControlPosition.TOP_LEFT].push(legend); } else if (wpgmaps_localize[mapid]['other_settings']['push_in_map_placement'] === "3") { MYMAP[mapid].map.controls[google.maps.ControlPosition.TOP_RIGHT].push(legend); } else if (wpgmaps_localize[mapid]['other_settings']['push_in_map_placement'] === "4") { MYMAP[mapid].map.controls[google.maps.ControlPosition.LEFT_TOP].push(legend); } else if (wpgmaps_localize[mapid]['other_settings']['push_in_map_placement'] === "5") { MYMAP[mapid].map.controls[google.maps.ControlPosition.RIGHT_TOP].push(legend); } else if (wpgmaps_localize[mapid]['other_settings']['push_in_map_placement'] === "6") { MYMAP[mapid].map.controls[google.maps.ControlPosition.LEFT_CENTER].push(legend); } else if (wpgmaps_localize[mapid]['other_settings']['push_in_map_placement'] === "7") { MYMAP[mapid].map.controls[google.maps.ControlPosition.RIGHT_CENTER].push(legend); } else if (wpgmaps_localize[mapid]['other_settings']['push_in_map_placement'] === "8") { MYMAP[mapid].map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(legend); } else if (wpgmaps_localize[mapid]['other_settings']['push_in_map_placement'] === "9") { MYMAP[mapid].map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend); } else if (wpgmaps_localize[mapid]['other_settings']['push_in_map_placement'] === "10") { MYMAP[mapid].map.controls[google.maps.ControlPosition.BOTTOM_CENTER].push(legend); } else if (wpgmaps_localize[mapid]['other_settings']['push_in_map_placement'] === "11") { MYMAP[mapid].map.controls[google.maps.ControlPosition.BOTTOM_LEFT].push(legend); } else if (wpgmaps_localize[mapid]['other_settings']['push_in_map_placement'] === "12") { MYMAP[mapid].map.controls[google.maps.ControlPosition.BOTTOM_RIGHT].push(legend); } else { MYMAP[mapid].map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend); }

                    } else { MYMAP[mapid].map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend); }
                }

            }
        };






        google.maps.event.addDomListener(window, 'resize', function() {
            var myLatLng = MYMAP[wpgmaps_localize[entry]['id']].map.getCenter();

            if ('undefined' !== typeof MYMAP[wpgmaps_localize[entry]['id']].map) {
                MYMAP[wpgmaps_localize[entry]['id']].map.setCenter(myLatLng);
            }
        });





        MYMAP[wpgmaps_localize[entry]['id']].placeMarkers = function(filename, map_id, cat_id, radius, searched_center, distance_type, search_title, show_markers) {

            var total_marker_cat_count;
            if (Object.prototype.toString.call(cat_id) === '[object Array]') {
                total_marker_cat_count = Object.keys(cat_id).length;
            } else {
                total_marker_cat_count = 1;
            }

            if (typeof marker_array[map_id] !== "undefined") {
                for (var i = 0; i < marker_array[map_id].length; i++) {
                    /* remove any instance of a marker first tio avoid using a full reinit which causes the map to flicker */
                    if (typeof marker_array[map_id][i] !== 'undefined') {

                        marker_array[map_id][i].setMap(null);
                        /* Check which map we are working on, and only reset the correct markers. (Store locator, etc) */
                    }
                }
            }

            /* reset store locator circle */
            if (typeof cityCircle[map_id] !== "undefined") {
                cityCircle[map_id].setMap(null);
            }

            /* reset store locator i` if any */
            if (typeof store_locator_marker[map_id] !== "undefined") {
                store_locator_marker[map_id].setMap(null);
            }

            marker_array[map_id] = new Array();
            marker_sl_array[map_id] = new Array();
            marker_array2[map_id] = new Array();


            if (show_markers || typeof show_markers === "undefined") {

                if (typeof wpgm_g_e !== "undefined" && wpgm_g_e === '1') {
                    var mcOptions = {
                        gridSize: 20,
                        maxZoom: 15,
                        styles: [{
                                height: 53,
                                url: "//ccplugins.co/markerclusterer/images/m1.png",
                                width: 53
                            },
                            {
                                height: 56,
                                url: "//ccplugins.co/markerclusterer/images/m2.png",
                                width: 56
                            },
                            {
                                height: 66,
                                url: "//ccplugins.co/markerclusterer/images/m3.png",
                                width: 66
                            },
                            {
                                height: 78,
                                url: "//ccplugins.co/markerclusterer/images/m4.png",
                                width: 78
                            },
                            {
                                height: 90,
                                url: "//ccplugins.co/markerclusterer/images/m5.png",
                                width: 90
                            }
                        ]
                    };


                    if (typeof wpgmaps_custom_cluster_options !== "undefined") {
                        var customMcOptions = {};

                        if (typeof wpgmaps_custom_cluster_options['wpgmza_cluster_grid_size'] !== "undefined") { customMcOptions['gridSize'] = parseInt(wpgmaps_custom_cluster_options['wpgmza_cluster_grid_size']); } else { customMcOptions['gridSize'] = mcOptions['gridSize']; }
                        if (typeof wpgmaps_custom_cluster_options['wpgmza_cluster_max_zoom'] !== "undefined") { customMcOptions['maxZoom'] = parseInt(wpgmaps_custom_cluster_options['wpgmza_cluster_max_zoom']); } else { customMcOptions['maxZoom'] = mcOptions['maxZoom']; }
                        if (typeof wpgmaps_custom_cluster_options['wpgmza_cluster_min_cluster_size'] !== "undefined") { customMcOptions['minimumClusterSize'] = parseInt(wpgmaps_custom_cluster_options['wpgmza_cluster_min_cluster_size']); }
                        if (typeof wpgmaps_custom_cluster_options['wpgmza_cluster_zoom_click'] !== "undefined") { customMcOptions['zoomOnClick'] = true; } else { customMcOptions['zoomOnClick'] = false; }


                        var level1 = {};
                        if (typeof wpgmaps_custom_cluster_options['wpgmza_gold_cluster_level1'] !== "undefined") { level1['url'] = wpgmaps_custom_cluster_options['wpgmza_gold_cluster_level1'].replace(/%2F/g, "/"); }
                        if (typeof wpgmaps_custom_cluster_options['wpgmza_cluster_level1_width'] !== "undefined") { level1['width'] = parseInt(wpgmaps_custom_cluster_options['wpgmza_cluster_level1_width']); }
                        if (typeof wpgmaps_custom_cluster_options['wpgmza_cluster_level1_height'] !== "undefined") { level1['height'] = parseInt(wpgmaps_custom_cluster_options['wpgmza_cluster_level1_height']); }

                        var level2 = {};
                        if (typeof wpgmaps_custom_cluster_options['wpgmza_gold_cluster_level2'] !== "undefined") { level2['url'] = wpgmaps_custom_cluster_options['wpgmza_gold_cluster_level2'].replace(/%2F/g, "/"); }
                        if (typeof wpgmaps_custom_cluster_options['wpgmza_cluster_level2_width'] !== "undefined") { level2['width'] = parseInt(wpgmaps_custom_cluster_options['wpgmza_cluster_level2_width']); }
                        if (typeof wpgmaps_custom_cluster_options['wpgmza_cluster_level2_height'] !== "undefined") { level2['height'] = parseInt(wpgmaps_custom_cluster_options['wpgmza_cluster_level2_height']); }

                        var level3 = {};
                        if (typeof wpgmaps_custom_cluster_options['wpgmza_gold_cluster_level3'] !== "undefined") { level3['url'] = wpgmaps_custom_cluster_options['wpgmza_gold_cluster_level3'].replace(/%2F/g, "/"); }
                        if (typeof wpgmaps_custom_cluster_options['wpgmza_cluster_level3_width'] !== "undefined") { level3['width'] = parseInt(wpgmaps_custom_cluster_options['wpgmza_cluster_level3_width']); }
                        if (typeof wpgmaps_custom_cluster_options['wpgmza_cluster_level3_height'] !== "undefined") { level3['height'] = parseInt(wpgmaps_custom_cluster_options['wpgmza_cluster_level3_height']); }

                        var level4 = {};
                        if (typeof wpgmaps_custom_cluster_options['wpgmza_gold_cluster_level4'] !== "undefined") { level4['url'] = wpgmaps_custom_cluster_options['wpgmza_gold_cluster_level4'].replace(/%2F/g, "/"); }
                        if (typeof wpgmaps_custom_cluster_options['wpgmza_cluster_level4_width'] !== "undefined") { level4['width'] = parseInt(wpgmaps_custom_cluster_options['wpgmza_cluster_level4_width']); }
                        if (typeof wpgmaps_custom_cluster_options['wpgmza_cluster_level4_height'] !== "undefined") { level4['height'] = parseInt(wpgmaps_custom_cluster_options['wpgmza_cluster_level4_height']); }

                        var level5 = {};
                        if (typeof wpgmaps_custom_cluster_options['wpgmza_gold_cluster_level5'] !== "undefined") { level5['url'] = wpgmaps_custom_cluster_options['wpgmza_gold_cluster_level5'].replace(/%2F/g, "/"); }
                        if (typeof wpgmaps_custom_cluster_options['wpgmza_cluster_level5_width'] !== "undefined") { level5['width'] = parseInt(wpgmaps_custom_cluster_options['wpgmza_cluster_level5_width']); }
                        if (typeof wpgmaps_custom_cluster_options['wpgmza_cluster_level5_height'] !== "undefined") { level5['height'] = parseInt(wpgmaps_custom_cluster_options['wpgmza_cluster_level5_height']); }


                        if (typeof wpgmaps_custom_cluster_options['wpgmza_cluster_font_color'] !== "undefined") {
                            level1['textColor'] = wpgmaps_custom_cluster_options['wpgmza_cluster_font_color'];
                            level2['textColor'] = wpgmaps_custom_cluster_options['wpgmza_cluster_font_color'];
                            level3['textColor'] = wpgmaps_custom_cluster_options['wpgmza_cluster_font_color'];
                            level4['textColor'] = wpgmaps_custom_cluster_options['wpgmza_cluster_font_color'];
                            level5['textColor'] = wpgmaps_custom_cluster_options['wpgmza_cluster_font_color'];
                        }

                        if (typeof wpgmaps_custom_cluster_options['wpgmza_cluster_font_size'] !== "undefined") {
                            level1['textSize'] = parseInt(wpgmaps_custom_cluster_options['wpgmza_cluster_font_size']);
                            level2['textSize'] = parseInt(wpgmaps_custom_cluster_options['wpgmza_cluster_font_size']);
                            level3['textSize'] = parseInt(wpgmaps_custom_cluster_options['wpgmza_cluster_font_size']);
                            level4['textSize'] = parseInt(wpgmaps_custom_cluster_options['wpgmza_cluster_font_size']);
                            level5['textSize'] = parseInt(wpgmaps_custom_cluster_options['wpgmza_cluster_font_size']);
                        }

                        customMcOptions['styles'] = [level1, level2, level3, level4, level5];

                        mcOptions = customMcOptions; //Override
                    }

                    if (wpgmaps_localize[entry]['mass_marker_support'] === "1" || wpgmaps_localize[entry]['mass_marker_support'] === null) {
                        if (typeof markerClusterer[map_id] !== "undefined") { markerClusterer[map_id].clearMarkers(); }
                        markerClusterer[map_id] = new MarkerClusterer(MYMAP[map_id].map, null, mcOptions);
                    }
                }

                var check1 = 0;

                if (wpgmaps_localize_global_settings['wpgmza_settings_image_width'] === "" || 'undefined' === typeof wpgmaps_localize_global_settings['wpgmza_settings_image_width']) { wpgmaps_localize_global_settings['wpgmza_settings_image_width'] = 'auto'; } else { wpgmaps_localize_global_settings['wpgmza_settings_image_width'] = wpgmaps_localize_global_settings['wpgmza_settings_image_width'] + 'px'; }
                if (wpgmaps_localize_global_settings['wpgmza_settings_image_height'] === "" || 'undefined' === typeof wpgmaps_localize_global_settings['wpgmza_settings_image_height']) { wpgmaps_localize_global_settings['wpgmza_settings_image_height'] = 'auto'; } else { wpgmaps_localize_global_settings['wpgmza_settings_image_height'] = wpgmaps_localize_global_settings['wpgmza_settings_image_height'] + 'px'; }


                if (marker_pull === '1') {



                    jQuery.get(filename, function(xml) {

                        jQuery(xml).find("marker").each(function() {
                            var wpgmza_def_icon = wpgmaps_localize[map_id]['default_marker'];
                            var wpmgza_map_id = jQuery(this).find('map_id').text();
                            var wpmgza_marker_id = jQuery(this).find('marker_id').text();
                            var wpmgza_title = jQuery(this).find('title').text();
                            var wpgmza_orig_title = wpmgza_title;
                            if (wpmgza_title !== "") {
                                var wpmgza_title = '<p class="wpgmza_infowindow_title">' + jQuery(this).find('title').text() + '</p>';
                            }
                            var wpmgza_address = jQuery(this).find('address').text();
                            if (wpmgza_address !== "") {
                                var wpmgza_show_address = '<p class="wpgmza_infowindow_address">' + wpmgza_address + '</p>';
                            } else {
                                var wpmgza_show_address = '';
                            }

                            var wpmgza_mapicon = jQuery(this).find('icon').text();
                            var wpmgza_image = jQuery(this).find('pic').text();
                            var wpmgza_desc = jQuery(this).find('desc').text();
                            var wpgmza_orig_desc = wpmgza_desc;
                            if (wpmgza_desc !== "") {
                                var wpmgza_desc = '<p class="wpgmza_infowindow_description">' + jQuery(this).find('desc').text() + '</p>';
                            }
                            var wpmgza_linkd = jQuery(this).find('linkd').text();
                            var wpmgza_linkd_orig = wpmgza_linkd;
                            var wpmgza_anim = jQuery(this).find('anim').text();
                            var wpmgza_retina = jQuery(this).find('retina').text();
                            var wpmgza_category = jQuery(this).find('category').text();
                            var current_lat = jQuery(this).find('lat').text();
                            var current_lng = jQuery(this).find('lng').text();
                            var show_marker_radius = true;
                            var show_marker_title_string = true;

                            val = {};
                            if (wpmgza_mapicon) { val.icon = wpmgza_mapicon; }

                            var marker_other_data = jQuery(this).find('other_data').text();
                            if (typeof marker_other_data !== "undefined" && marker_other_data !== "") {
                                marker_other_data = JSON.parse(marker_other_data);
                                val.other_data = {};
                                val.other_data = marker_other_data;
                            } else {
                                marker_other_data = false;
                            }






                            if (radius !== null) {


                                if (check1 > 0) {} else {
                                    var sl_stroke_color = wpgmaps_localize[map_id]['other_settings']['sl_stroke_color'];
                                    if (sl_stroke_color !== "" || sl_stroke_color !== null) {} else { sl_stroke_color = 'FF0000'; }
                                    var sl_stroke_opacity = wpgmaps_localize[map_id]['other_settings']['sl_stroke_opacity'];
                                    if (sl_stroke_opacity !== "" || sl_stroke_opacity !== null) {} else { sl_stroke_opacity = '0.25'; }
                                    var sl_fill_opacity = wpgmaps_localize[map_id]['other_settings']['sl_fill_opacity'];
                                    if (sl_fill_opacity !== "" || sl_fill_opacity !== null) {} else { sl_fill_opacity = '0.15'; }
                                    var sl_fill_color = wpgmaps_localize[map_id]['other_settings']['sl_fill_color'];
                                    if (sl_fill_color !== "" || sl_fill_color !== null) {} else { sl_fill_color = 'FF0000'; }

                                    var point = new google.maps.LatLng(parseFloat(searched_center.lat()), parseFloat(searched_center.lng()));
                                    MYMAP[map_id].bounds.extend(point);
                                    if (wpgmaps_localize[map_id]['other_settings']['store_locator_bounce'] === 1) {
                                        if ("undefined" !== typeof wpgmaps_localize[map_id]['other_settings']['upload_default_sl_marker']) {
                                            store_locator_marker[map_id] = new google.maps.Marker({
                                                position: point,
                                                map: MYMAP[map_id].map,
                                                icon: wpgmaps_localize[map_id]['other_settings']['upload_default_sl_marker']

                                            });

                                        } else {
                                            store_locator_marker[map_id] = new google.maps.Marker({
                                                position: point,
                                                map: MYMAP[map_id].map

                                            });
                                        }
                                        if (typeof wpgmaps_localize[map_id]['other_settings']['wpgmza_sl_animation'] !== "undefined") {
                                            if (wpgmaps_localize[map_id]['other_settings']['wpgmza_sl_animation'] === '1') { store_locator_marker[map_id].setAnimation(google.maps.Animation.BOUNCE); } else if (wpgmaps_localize[map_id]['other_settings']['wpgmza_sl_animation'] === '2') { store_locator_marker[map_id].setAnimation(google.maps.Animation.DROP); } else {
                                                store_locator_marker[map_id].setAnimation(null);
                                            }

                                        }


                                    } else {
                                        /* do nothing */
                                    }
                                    if (distance_type === "1") {
                                        var populationOptions = {
                                            strokeColor: '#' + sl_stroke_color,
                                            strokeOpacity: sl_stroke_opacity,
                                            strokeWeight: 2,
                                            fillColor: '#' + sl_fill_color,
                                            fillOpacity: sl_fill_opacity,
                                            map: MYMAP[map_id].map,
                                            center: point,
                                            radius: parseInt(radius / 0.000621371)
                                        };
                                    } else {
                                        var populationOptions = {
                                            strokeColor: '#' + sl_stroke_color,
                                            strokeOpacity: sl_stroke_opacity,
                                            strokeWeight: 2,
                                            fillColor: '#' + sl_fill_color,
                                            fillOpacity: sl_fill_opacity,
                                            map: MYMAP[map_id].map,
                                            center: point,
                                            radius: parseInt(radius / 0.001)
                                        };
                                    }
                                    /* Add the circle for this city to the map. */
                                    cityCircle[map_id] = new google.maps.Circle(populationOptions);
                                    check1 = check1 + 1;
                                }

                                if (distance_type === "1") {
                                    R = 3958.7558657440545; /* Radius of earth in Miles  */
                                } else {
                                    R = 6378.16; /* Radius of earth in kilometers  */
                                }
                                var dLat = toRad(searched_center.lat() - current_lat);
                                var dLon = toRad(searched_center.lng() - current_lng);
                                var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.cos(toRad(current_lat)) * Math.cos(toRad(searched_center.lat())) * Math.sin(dLon / 2) * Math.sin(dLon / 2);
                                var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                                var d = R * c;

                                if (d < radius) { show_marker_radius = true; } else { show_marker_radius = false; }


                                /* check if they have done a title search too */
                                if (search_title === null || search_title === "") { show_marker_title_string = true; } else {
                                    var x = wpgmza_orig_title.toLowerCase().search(search_title.toLowerCase());
                                    var y = wpgmza_orig_desc.toLowerCase().search(search_title.toLowerCase());
                                    if (x >= 0 || y >= 0) {
                                        show_marker_title_string = true;
                                    } else {
                                        show_marker_title_string = false;
                                    }

                                }



                            }
                            var cat_is_cat;
                            cat_is_cat = false;
                            if (Object.prototype.toString.call(cat_id) === '[object Array]') {




                                if (cat_id[0] === '0') { cat_id === "all"; }
                                for (var tmp_val in cat_id) {
                                    /* only one category sent through to show */
                                    if (wpmgza_category.indexOf(',') === -1) {
                                        if (cat_id[tmp_val] === wpmgza_category) {
                                            cat_is_cat = true;
                                        }
                                    } else {
                                        var array = JSON.parse("[" + wpmgza_category + "]");
                                        array.forEach(function(entry) {
                                            if (parseInt(cat_id[tmp_val]) === parseInt(entry)) {
                                                cat_is_cat = true;
                                            }
                                        });
                                    }


                                }

                                /* identify if we are using AND or OR in category logic */
                                if (typeof wpgmaps_localize_global_settings['wpgmza_settings_cat_logic'] === "undefined" || parseInt(wpgmaps_localize_global_settings['wpgmza_settings_cat_logic']) === 0) {
                                    /* _OR_ LOGIC */
                                } else {
                                    /* _AND_ LOGIC */
                                    if (cat_logic_counter >= total_marker_cat_count) {
                                        /* dispaly this marker */
                                        cat_is_cat = true;
                                    } else {
                                        cat_is_cat = false;
                                    }

                                }

                            } else {

                                /* only one category sent through to show */
                                if (wpmgza_category.indexOf(',') === -1) {
                                    if (cat_id === wpmgza_category) {
                                        cat_is_cat = true;
                                    }
                                } else {
                                    var array = JSON.parse("[" + wpmgza_category + "]");
                                    array.forEach(function(entry) {
                                        if (parseInt(cat_id) === parseInt(entry)) {
                                            cat_is_cat = true;
                                        }
                                    });
                                }
                            }

                            if (cat_id === 'all' || cat_is_cat) {

                                var wpmgza_infoopen = jQuery(this).find('infoopen').text();


                                if (wpmgza_image !== "") {




                                    /* timthumb completely removed in 5.54 */
                                    /*if (wpgmaps_localize_global_settings['wpgmza_settings_use_timthumb'] === "" || 'undefined' === typeof wpgmaps_localize_global_settings['wpgmza_settings_use_timthumb']) {
                                            wpmgza_image = "<img src=\""+wpgmaps_plugurl+"/timthumb.php?src="+wpmgza_image+"&h="+wpgmaps_localize_global_settings['wpgmza_settings_image_height']+"&w="+wpgmaps_localize_global_settings['wpgmza_settings_image_width']+"&zc=1\" title=\"\" class=\"wpgmza_infowindow_image\" width=\""+wpgmaps_localize_global_settings['wpgmza_settings_image_width']+"\" height=\""+wpgmaps_localize_global_settings['wpgmza_settings_image_height']+"\" style=\"float:right; width:"+wpgmaps_localize_global_settings['wpgmza_settings_image_width']+"px; height:"+wpgmaps_localize_global_settings['wpgmza_settings_image_height']+"px;\" />";
                                    } else {*/
                                    if ('undefined' === typeof wpgmaps_localize_global_settings['wpgmza_settings_image_resizing'] || wpgmaps_localize_global_settings['wpgmza_settings_image_resizing'] === "yes") {

                                        wpmgza_image = "<img src=\"" + wpmgza_image + "\" title=\"\" class=\"wpgmza_infowindow_image\" alt=\"\" style=\"float:right; width:" + wpgmaps_localize_global_settings['wpgmza_settings_image_width'] + "; height:" + wpgmaps_localize_global_settings['wpgmza_settings_image_height'] + "; max-width:" + wpgmaps_localize_global_settings['wpgmza_settings_infowindow_width'] + "px !important;\" />";

                                    } else {
                                        wpmgza_image = "<img src=\"" + wpmgza_image + "\" class=\"wpgmza_infowindow_image wpgmza_map_image\" style=\"float:right; margin:5px; max-width:" + wpgmaps_localize_global_settings['wpgmza_settings_infowindow_width'] + "px !important;\" />";
                                    }
                                    /*}*/


                                } else { wpmgza_image = ""; }


                                if (wpmgza_linkd !== "") {
                                    if (wpgmaps_localize_global_settings['wpgmza_settings_infowindow_links'] === "yes") { wpgmza_iw_links_target = "target='_BLANK'"; } else { wpgmza_iw_links_target = ''; }
                                    wpmgza_linkd = "<p class=\"wpgmza_infowindow_link\"><a class=\"wpgmza_infowindow_link\" href=\"" + wpmgza_linkd + "\" " + wpgmza_iw_links_target + " title=\"" + wpgmaps_lang_more_details + "\">" + wpgmaps_lang_more_details + "</a></p>";
                                } else {
                                    wpgmza_iw_links_target = "";
                                }

                                if (wpmgza_mapicon === "" || !wpmgza_mapicon) { if (wpgmza_def_icon !== "") { wpmgza_mapicon = wpgmaps_localize[map_id]['default_marker']; } }

                                var wpgmza_optimized = true;
                                if (wpmgza_retina === "1" && wpmgza_mapicon !== "0") {
                                    wpmgza_mapicon = new google.maps.MarkerImage(wpmgza_mapicon, null, null, null, new google.maps.Size(wpgmza_retina_width, wpgmza_retina_height));
                                    wpgmza_optimized = false;
                                }



                                var lat = jQuery(this).find('lat').text();
                                var lng = jQuery(this).find('lng').text();
                                var point = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
                                MYMAP[map_id].bounds.extend(point);




                                if (show_marker_radius === true && show_marker_title_string === true) {
                                    if (wpmgza_anim === "1") {
                                        if (wpmgza_mapicon === null || wpmgza_mapicon === "" || wpmgza_mapicon === 0 || wpmgza_mapicon === "0") {
                                            var marker = new google.maps.Marker({
                                                position: point,
                                                map: MYMAP[map_id].map,
                                                animation: google.maps.Animation.BOUNCE
                                            });
                                        } else {
                                            var marker = new google.maps.Marker({
                                                position: point,
                                                map: MYMAP[map_id].map,
                                                icon: wpmgza_mapicon,
                                                animation: google.maps.Animation.BOUNCE,
                                                optimized: wpgmza_optimized

                                            });
                                        }
                                    } else if (wpmgza_anim === "2") {
                                        if (wpmgza_mapicon === null || wpmgza_mapicon === "" || wpmgza_mapicon === 0 || wpmgza_mapicon === "0") {
                                            var marker = new google.maps.Marker({
                                                position: point,
                                                map: MYMAP[map_id].map,
                                                animation: google.maps.Animation.DROP
                                            });

                                        } else {

                                            var marker = new google.maps.Marker({
                                                position: point,
                                                map: MYMAP[map_id].map,
                                                icon: wpmgza_mapicon,
                                                animation: google.maps.Animation.DROP,
                                                optimized: wpgmza_optimized
                                            });
                                        }
                                    } else {
                                        if (wpmgza_mapicon === null || wpmgza_mapicon === "" || wpmgza_mapicon === 0 || wpmgza_mapicon === "0") {
                                            var marker = new google.maps.Marker({
                                                position: point,
                                                map: MYMAP[map_id].map,
                                                optimized: wpgmza_optimized
                                            });

                                        } else {
                                            var marker = new google.maps.Marker({
                                                position: point,
                                                map: MYMAP[map_id].map,
                                                icon: wpmgza_mapicon,
                                                optimized: wpgmza_optimized
                                            });
                                        }
                                    }



                                    if (wpgmaps_localize_global_settings['wpgmza_settings_infowindow_address'] === "yes") {
                                        wpmgza_show_address = "";
                                    }
                                    if (wpgmaps_localize[map_id]['directions_enabled'] === "1") {
                                        wpmgza_dir_enabled = '<p><a href="javascript:void(0);" id="' + map_id + '" class="wpgmza_gd" wpgm_addr_field="' + wpmgza_address + '" gps="' + parseFloat(lat) + ',' + parseFloat(lng) + '">' + wpgmaps_lang_get_dir + '</a></p>';
                                    } else {
                                        wpmgza_dir_enabled = '';
                                    }
                                    if (radius !== null) {
                                        if (distance_type === "1") {
                                            d_string = "<p>" + Math.round(d, 2) + ' ' + wpgmaps_lang_m_away + "</p>";
                                        } else {
                                            d_string = "<p>" + Math.round(d, 2) + ' ' + wpgmaps_lang_km_away + "</p>";
                                        }
                                    } else { d_string = ''; }

                                    if (wpmgza_image !== "") {
                                        var html = '<div class="wpgmza_markerbox scrollFix">' +
                                            wpmgza_image +
                                            wpmgza_title +
                                            wpmgza_show_address +
                                            wpmgza_desc +
                                            wpmgza_linkd +
                                            d_string +
                                            wpmgza_dir_enabled +
                                            '</div>';

                                    } else {
                                        var html = '<div class="wpgmza_markerbox scrollFix">' +

                                            wpmgza_image +
                                            wpmgza_title +
                                            wpmgza_show_address +
                                            wpmgza_desc +
                                            wpmgza_linkd +
                                            d_string +
                                            wpmgza_dir_enabled +
                                            '</div>';

                                    }

                                    var marker_data_object = {
                                        title: wpgmza_orig_title,
                                        address: wpmgza_address,
                                        image: jQuery(this).find('pic').text(),
                                        link: wpmgza_linkd_orig,
                                        directions: wpmgza_dir_enabled,
                                        distance: d_string,
                                        desc: wpgmza_orig_desc,
                                        gps: parseFloat(lat) + ',' + parseFloat(lng),
                                        link_target: wpgmza_iw_links_target
                                    };
                                    infoWindow[wpmgza_marker_id] = new google.maps.InfoWindow();
                                    if (wpgmaps_localize_global_settings['wpgmza_settings_infowindow_width'] === "" || 'undefined' === typeof wpgmaps_localize_global_settings['wpgmza_settings_infowindow_width']) {
                                        wpgmaps_localize_global_settings['wpgmza_settings_infowindow_width'] = false;
                                    }

                                    if (wpmgza_infoopen === "1") {
                                        wpgmza_open_marker_func(map_id, marker, html, click_from_list, marker_data_object, wpmgza_marker_id, val);
                                    }

                                    /* do they want to open a marker from a GET variable? */
                                    if (typeof wpgmza_open_marker !== "underfined") {
                                        if (wpgmza_open_marker === wpmgza_marker_id) {


                                            if (wpgmaps_localize_global_settings['wpgmza_settings_infowindow_width']) { infoWindow[wpmgza_marker_id].setOptions({ maxWidth: wpgmaps_localize_global_settings['wpgmza_settings_infowindow_width'] }); }
                                            infoWindow[wpmgza_marker_id].setContent(html);
                                            infoWindow[wpmgza_marker_id].open(MYMAP[map_id].map, marker);
                                            MYMAP[map_id].map.setCenter(point);
                                            if (typeof wpgmza_open_marker_zoom !== "undefined") {
                                                MYMAP[map_id].map.setZoom(parseInt(wpgmza_open_marker_zoom));
                                            }
                                        }
                                    }

                                    if (typeof wpgmaps_localize[map_id]['other_settings']['click_open_link'] !== "undefined" && wpgmaps_localize[map_id]['other_settings']['click_open_link'] === 1 && typeof wpmgza_linkd_orig !== "undefined" && wpmgza_linkd_orig !== "") {
                                        google.maps.event.addListener(marker, 'click', function(evt) {
                                            location = wpmgza_linkd_orig;
                                        });
                                    }
                                    if (wpgmaps_localize_global_settings['wpgmza_settings_map_open_marker_by'] === "" || 'undefined' === typeof wpgmaps_localize_global_settings['wpgmza_settings_map_open_marker_by'] || wpgmaps_localize_global_settings['wpgmza_settings_map_open_marker_by'] === '1') {
                                        google.maps.event.addListener(marker, 'click', function(evt) {

                                            wpgmza_open_marker_func(map_id, marker, html, click_from_list, marker_data_object, wpmgza_marker_id, val);
                                        });
                                    } else {
                                        google.maps.event.addListener(marker, 'mouseover', function(evt) {
                                            wpgmza_open_marker_func(map_id, marker, html, click_from_list, marker_data_object, wpmgza_marker_id, val);

                                        });
                                    }





                                    marker_array[map_id][wpmgza_marker_id] = marker;
                                    marker_array[map_id][wpmgza_marker_id].default_icon = marker.icon;

                                    google.maps.event.addListener(infoWindow[wpmgza_marker_id], 'closeclick', function(evt) {
                                        if (typeof marker_array[map_id][wpmgza_marker_id].icon !== "undefined" && marker_array[map_id][wpmgza_marker_id].icon !== "") {
                                            marker_array[map_id][wpmgza_marker_id].setIcon(marker_array[map_id][wpmgza_marker_id].default_icon);
                                        } else {
                                            marker_array[map_id][wpmgza_marker_id].setIcon(null);
                                        }
                                    });

                                    marker_array2[map_id].push(marker);
                                    marker_sl_array[map_id].push(wpmgza_marker_id);

                                }
                            }

                        });

                        if (typeof wpgm_g_e !== "undefined" && wpgm_g_e === '1') {

                            if (wpgmaps_localize[map_id]['mass_marker_support'] === "1" || wpgmaps_localize[map_id]['mass_marker_support'] === null) {
                                if (typeof markerClusterer[map_id] !== "undefined") { markerClusterer[map_id].addMarkers(marker_array2[map_id]); }
                            }
                        }


                        if (radius !== null) {

                            wpgmza_filter_marker_lists_by_array(map_id, marker_sl_array[map_id]);

                        }

                    });

                } else {
                    /* DB method */
                    jQuery.each(document.marker_data_array[map_id], function(i, val) {


                        var wpgmza_def_icon = wpgmaps_localize[map_id]['default_marker'];


                        /*
                            removed due to mashup incompatibilities. If used, it tries to push the marker to the markers original ID instead of the MASHUP MAP ID.
                            var wpmgza_map_id = val.map_id;
                    
                        */
                        var wpmgza_map_id = map_id;


                        var wpmgza_marker_id = val.marker_id;

                        var wpmgza_title = val.title;
                        var wpgmza_orig_title = wpmgza_title;
                        if (wpmgza_title !== "") {
                            var wpmgza_title = '<p class="wpgmza_infowindow_title">' + val.title + '</p>';
                        }
                        var wpmgza_address = val.address;
                        if (wpmgza_address !== "") {
                            var wpmgza_show_address = '<p class="wpgmza_infowindow_address">' + wpmgza_address + '</p>';
                        } else {
                            var wpmgza_show_address = '';
                        }
                        var wpmgza_mapicon = val.icon;
                        var wpmgza_image = val.pic;
                        var wpmgza_desc = val.desc;
                        var wpgmza_orig_desc = wpmgza_desc;
                        if (wpmgza_desc !== "") {
                            var wpmgza_desc = '<p class="wpgmza_infowindow_description">' + val.desc; + '</p>';
                        }
                        var wpmgza_linkd = val.linkd;
                        var wpmgza_linkd_orig = wpmgza_linkd;

                        var wpmgza_anim = val.anim;
                        var wpmgza_retina = val.retina;
                        var wpmgza_category = val.category;
                        var current_lat = val.lat;
                        var current_lng = val.lng;
                        var show_marker_radius = true;
                        var show_marker_title_string = true;

                        if (typeof wpgmza_override_marker !== "undefined" && typeof wpgmza_override_marker[map_id] !== "undefined") {
                            if (parseInt(wpmgza_marker_id) == parseInt(wpgmza_override_marker[map_id])) {
                                /* we have a match for the focus marker, lets save the lat and lng so we can center on it when done */
                                focus_lat = current_lat;
                                focus_lng = current_lng;
                            }
                        }



                        if (radius !== null) {


                            if (check1 > 0) {} else {
                                var sl_stroke_color = wpgmaps_localize[map_id]['other_settings']['sl_stroke_color'];
                                if (sl_stroke_color !== "" || sl_stroke_color !== null) {} else { sl_stroke_color = 'FF0000'; }
                                var sl_stroke_opacity = wpgmaps_localize[map_id]['other_settings']['sl_stroke_opacity'];
                                if (sl_stroke_opacity !== "" || sl_stroke_opacity !== null) {} else { sl_stroke_opacity = '0.25'; }
                                var sl_fill_opacity = wpgmaps_localize[map_id]['other_settings']['sl_fill_opacity'];
                                if (sl_fill_opacity !== "" || sl_fill_opacity !== null) {} else { sl_fill_opacity = '0.15'; }
                                var sl_fill_color = wpgmaps_localize[map_id]['other_settings']['sl_fill_color'];
                                if (sl_fill_color !== "" || sl_fill_color !== null) {} else { sl_fill_color = 'FF0000'; }

                                var point = new google.maps.LatLng(parseFloat(searched_center.lat()), parseFloat(searched_center.lng()));
                                MYMAP[map_id].bounds.extend(point);

                                if (wpgmaps_localize[map_id]['other_settings']['store_locator_bounce'] === 1) {
                                    if ("undefined" !== typeof wpgmaps_localize[map_id]['other_settings']['upload_default_sl_marker']) {
                                        store_locator_marker[map_id] = new google.maps.Marker({
                                            position: point,
                                            map: MYMAP[map_id].map,
                                            icon: wpgmaps_localize[map_id]['other_settings']['upload_default_sl_marker']
                                        });

                                    } else {
                                        store_locator_marker[map_id] = new google.maps.Marker({
                                            position: point,
                                            map: MYMAP[map_id].map

                                        });
                                    }
                                    if (typeof wpgmaps_localize[map_id]['other_settings']['wpgmza_sl_animation'] !== "undefined") {
                                        if (wpgmaps_localize[map_id]['other_settings']['wpgmza_sl_animation'] === '1') { store_locator_marker[map_id].setAnimation(google.maps.Animation.BOUNCE); } else if (wpgmaps_localize[map_id]['other_settings']['wpgmza_sl_animation'] === '2') { store_locator_marker[map_id].setAnimation(google.maps.Animation.DROP); } else {
                                            store_locator_marker[map_id].setAnimation(null);
                                        }

                                    }



                                } else {
                                    /* do nothing */
                                }
                                if (distance_type === "1") {
                                    var populationOptions = {
                                        strokeColor: '#' + sl_stroke_color,
                                        strokeOpacity: sl_stroke_opacity,
                                        strokeWeight: 2,
                                        fillColor: '#' + sl_fill_color,
                                        fillOpacity: sl_fill_opacity,
                                        map: MYMAP[map_id].map,
                                        center: point,
                                        radius: parseInt(radius / 0.000621371)
                                    };
                                } else {
                                    var populationOptions = {
                                        strokeColor: '#' + sl_stroke_color,
                                        strokeOpacity: sl_stroke_opacity,
                                        strokeWeight: 2,
                                        fillColor: '#' + sl_fill_color,
                                        fillOpacity: sl_fill_opacity,
                                        map: MYMAP[map_id].map,
                                        center: point,
                                        radius: parseInt(radius / 0.001)
                                    };
                                }
                                cityCircle[map_id] = new google.maps.Circle(populationOptions);
                                check1 = check1 + 1;
                            }

                            if (distance_type === "1") {
                                R = 3958.7558657440545;
                            } else {
                                R = 6378.16;
                            }
                            var dLat = toRad(searched_center.lat() - current_lat);
                            var dLon = toRad(searched_center.lng() - current_lng);
                            var a = Math.sin(dLat / 2) * Math.sin(dLat / 2) + Math.cos(toRad(current_lat)) * Math.cos(toRad(searched_center.lat())) * Math.sin(dLon / 2) * Math.sin(dLon / 2);
                            var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                            var d = R * c;

                            if (d < radius) { show_marker_radius = true; } else { show_marker_radius = false; }


                            /* check if they have done a title search too */
                            if (search_title === null || search_title === "") { show_marker_title_string = true; } else {
                                var x = wpgmza_orig_title.toLowerCase().search(search_title.toLowerCase());
                                var y = wpgmza_orig_desc.toLowerCase().search(search_title.toLowerCase());
                                if (x >= 0 || y >= 0) {
                                    show_marker_title_string = true;
                                } else {
                                    show_marker_title_string = false;
                                }

                            }



                        }

                        var cat_is_cat;
                        cat_is_cat = false;
                        cat_logic_counter = 0;
                        if (Object.prototype.toString.call(cat_id) === '[object Array]') {

                            /* work with category array */
                            if (cat_id[0] === '0') { cat_id === "all";
                                cat_logic_counter++; }
                            for (var tmp_val in cat_id) {
                                /* only one category sent through to show */
                                if (wpmgza_category.indexOf(',') === -1) {
                                    if (cat_id[tmp_val] === wpmgza_category) {
                                        cat_is_cat = true;
                                        cat_logic_counter++;
                                    }
                                } else {
                                    var array = JSON.parse("[" + wpmgza_category + "]");
                                    array.forEach(function(entry) {
                                        if (parseInt(cat_id[tmp_val]) === parseInt(entry)) {
                                            cat_is_cat = true;
                                            cat_logic_counter++;
                                        }
                                    });
                                }


                            }


                            /* identify if we are using AND or OR in category logic */
                            if (typeof wpgmaps_localize_global_settings['wpgmza_settings_cat_logic'] === "undefined" || parseInt(wpgmaps_localize_global_settings['wpgmza_settings_cat_logic']) === 0) {
                                /* _OR_ LOGIC */
                            } else {
                                /* _AND_ LOGIC */
                                if (cat_logic_counter >= total_marker_cat_count) {
                                    /* dispaly this marker */
                                    cat_is_cat = true;
                                } else {
                                    cat_is_cat = false;
                                }

                            }
                        } else {

                            /* only one category sent through to show */
                            if (typeof wpmgza_category !== 'undefined') {
                                if (wpmgza_category.indexOf(',') === -1) {
                                    if (cat_id === wpmgza_category) {
                                        cat_is_cat = true;
                                    }
                                } else {
                                    var array = JSON.parse("[" + wpmgza_category + "]");
                                    array.forEach(function(entry) {
                                        if (parseInt(cat_id) === parseInt(entry)) {
                                            cat_is_cat = true;
                                        }
                                    });
                                }
                            } else {


                            }
                        }

                        if (cat_id === 'all' || cat_is_cat) {

                            var wpmgza_infoopen = val.infoopen;
                            if (wpmgza_image !== "") {

                                /* timthumb completely removed in 5.54 */
                                /*if (wpgmaps_localize_global_settings['wpgmza_settings_use_timthumb'] === "" || 'undefined' === typeof wpgmaps_localize_global_settings['wpgmza_settings_use_timthumb']) {
                                        wpmgza_image = "<img src=\""+wpgmaps_plugurl+"/timthumb.php?src="+wpmgza_image+"&h="+wpgmaps_localize_global_settings['wpgmza_settings_image_height']+"&w="+wpgmaps_localize_global_settings['wpgmza_settings_image_width']+"&zc=1\" title=\"\" class=\"wpgmza_infowindow_image\" width=\""+wpgmaps_localize_global_settings['wpgmza_settings_image_width']+"\" height=\""+wpgmaps_localize_global_settings['wpgmza_settings_image_height']+"\" style=\"float:right; width:"+wpgmaps_localize_global_settings['wpgmza_settings_image_width']+"px; height:"+wpgmaps_localize_global_settings['wpgmza_settings_image_height']+"px;\" />";
                                } else {*/
                                if ('undefined' === typeof wpgmaps_localize_global_settings['wpgmza_settings_image_resizing'] || wpgmaps_localize_global_settings['wpgmza_settings_image_resizing'] === "yes") {
                                    wpmgza_image = "<img src=\"" + wpmgza_image + "\" title=\"\" class=\"wpgmza_infowindow_image\" alt=\"\" style=\"float:right; width:" + wpgmaps_localize_global_settings['wpgmza_settings_image_width'] + "; height:" + wpgmaps_localize_global_settings['wpgmza_settings_image_height'] + "; max-width:" + wpgmaps_localize_global_settings['wpgmza_settings_infowindow_width'] + "px !important;\" />";

                                } else {
                                    wpmgza_image = "<img src=\"" + wpmgza_image + "\" class=\"wpgmza_infowindow_image wpgmza_map_image\" style=\"float:right; margin:5px; max-width:" + wpgmaps_localize_global_settings['wpgmza_settings_infowindow_width'] + "px !important;\" />";
                                }
                                /*}*/
                            }

                            if (wpmgza_linkd !== "") {
                                if (wpgmaps_localize_global_settings['wpgmza_settings_infowindow_links'] === "yes") { wpgmza_iw_links_target = "target='_BLANK'"; } else { wpgmza_iw_links_target = ''; }
                                wpmgza_linkd = "<p class=\"wpgmza_infowindow_link\"><a class=\"wpgmza_infowindow_link\" href=\"" + wpmgza_linkd + "\" " + wpgmza_iw_links_target + " title=\"" + wpgmaps_lang_more_details + "\">" + wpgmaps_lang_more_details + "</a></p>";
                            } else {
                                wpgmza_iw_links_target = "";
                            }

                            if (wpmgza_mapicon === "" || !wpmgza_mapicon) { if (wpgmza_def_icon !== "") { wpmgza_mapicon = wpgmaps_localize[map_id]['default_marker']; } }
                            var wpgmza_optimized = true;
                            if (wpmgza_retina === "1" && wpmgza_mapicon !== "0") {
                                wpmgza_mapicon = new google.maps.MarkerImage(wpmgza_mapicon, null, null, null, new google.maps.Size(wpgmza_retina_width, wpgmza_retina_height));
                                wpgmza_optimized = false;
                            }


                            var lat = val.lat;
                            var lng = val.lng;
                            var point = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
                            MYMAP[map_id].bounds.extend(point);




                            if (show_marker_radius === true && show_marker_title_string === true) {
                                if (wpmgza_anim === "1") {
                                    if (wpmgza_mapicon === null || wpmgza_mapicon === "" || wpmgza_mapicon === 0 || wpmgza_mapicon === "0") {
                                        var marker = new google.maps.Marker({
                                            position: point,
                                            map: MYMAP[map_id].map,
                                            animation: google.maps.Animation.BOUNCE
                                        });
                                    } else {
                                        var marker = new google.maps.Marker({
                                            position: point,
                                            map: MYMAP[map_id].map,
                                            icon: wpmgza_mapicon,
                                            animation: google.maps.Animation.BOUNCE,
                                            optimized: wpgmza_optimized

                                        });
                                    }
                                } else if (wpmgza_anim === "2") {
                                    if (wpmgza_mapicon === null || wpmgza_mapicon === "" || wpmgza_mapicon === 0 || wpmgza_mapicon === "0") {
                                        var marker = new google.maps.Marker({
                                            position: point,
                                            map: MYMAP[map_id].map,
                                            animation: google.maps.Animation.DROP
                                        });

                                    } else {

                                        var marker = new google.maps.Marker({
                                            position: point,
                                            map: MYMAP[map_id].map,
                                            icon: wpmgza_mapicon,
                                            animation: google.maps.Animation.DROP,
                                            optimized: wpgmza_optimized
                                        });
                                    }
                                } else {
                                    if (wpmgza_mapicon === null || wpmgza_mapicon === "" || wpmgza_mapicon === 0 || wpmgza_mapicon === "0") {
                                        var marker = new google.maps.Marker({
                                            position: point,
                                            map: MYMAP[map_id].map,
                                            optimized: wpgmza_optimized
                                        });

                                    } else {
                                        var marker = new google.maps.Marker({
                                            position: point,
                                            map: MYMAP[map_id].map,
                                            icon: wpmgza_mapicon,
                                            optimized: wpgmza_optimized
                                        });
                                    }
                                }


                                if (wpgmaps_localize_global_settings['wpgmza_settings_infowindow_address'] === "yes") {
                                    wpmgza_show_address = "";
                                }
                                if (wpgmaps_localize[entry]['directions_enabled'] === "1") {
                                    wpmgza_dir_enabled = '<p><a href="javascript:void(0);" id="' + map_id + '" class="wpgmza_gd" wpgm_addr_field="' + wpmgza_address + '" gps="' + parseFloat(lat) + ',' + parseFloat(lng) + '">' + wpgmaps_lang_get_dir + '</a></p>';
                                } else {
                                    wpmgza_dir_enabled = '';
                                }
                                if (radius !== null) {
                                    if (distance_type === "1") {
                                        d_string = "<p>" + Math.round(d, 2) + ' ' + wpgmaps_lang_m_away + "</p>";
                                    } else {
                                        d_string = "<p>" + Math.round(d, 2) + ' ' + wpgmaps_lang_km_away + "</p>";
                                    }
                                } else { d_string = ''; }
                                if (wpmgza_image !== "") {
                                    var html = '<div class="wpgmza_markerbox scrollFix">' +
                                        wpmgza_image +
                                        wpmgza_title +
                                        wpmgza_show_address +
                                        wpmgza_desc +
                                        wpmgza_linkd +
                                        d_string +
                                        wpmgza_dir_enabled +
                                        '</div>';

                                } else {
                                    var html = '<div class="wpgmza_markerbox scrollFix">' +
                                        wpmgza_image +
                                        wpmgza_title +
                                        wpmgza_show_address +
                                        wpmgza_desc +
                                        wpmgza_linkd +
                                        d_string +
                                        wpmgza_dir_enabled +
                                        '</div>';

                                }

                                var marker_data_object = {
                                    title: wpgmza_orig_title,
                                    address: wpmgza_address,
                                    image: val.pic,
                                    link: wpmgza_linkd_orig,
                                    directions: wpmgza_dir_enabled,
                                    distance: d_string,
                                    desc: wpgmza_orig_desc,
                                    gps: parseFloat(lat) + ',' + parseFloat(lng),
                                    link_target: wpgmza_iw_links_target
                                };


                                infoWindow[wpmgza_marker_id] = new google.maps.InfoWindow();
                                if (wpgmaps_localize_global_settings['wpgmza_settings_infowindow_width'] === "" || 'undefined' === typeof wpgmaps_localize_global_settings['wpgmza_settings_infowindow_width']) {
                                    wpgmaps_localize_global_settings['wpgmza_settings_infowindow_width'] = false;
                                }
                                if (wpmgza_infoopen === "1") {

                                    infoWindow[wpmgza_marker_id].setContent(html);
                                    infoWindow[wpmgza_marker_id].open(MYMAP[map_id].map, marker);
                                }
                                /* do they want to open a marker from a GET variable? */
                                if (typeof wpgmza_open_marker !== "underfined") {
                                    if (wpgmza_open_marker === wpmgza_marker_id) {

                                        infoWindow[wpmgza_marker_id].setOptions({ maxWidth: wpgmaps_localize_global_settings['wpgmza_settings_infowindow_width'] });
                                        infoWindow[wpmgza_marker_id].setContent(html);
                                        infoWindow[wpmgza_marker_id].open(MYMAP[map_id].map, marker);
                                        MYMAP[map_id].map.setCenter(point);
                                        if (typeof wpgmza_open_marker_zoom !== "undefined") {
                                            MYMAP[map_id].map.setZoom(parseInt(wpgmza_open_marker_zoom));
                                        }
                                    }
                                }
                                if (typeof wpgmaps_localize[map_id]['other_settings']['click_open_link'] !== "undefined" && wpgmaps_localize[map_id]['other_settings']['click_open_link'] === 1 && typeof wpmgza_linkd_orig !== "undefined" && wpmgza_linkd_orig !== "") {


                                    google.maps.event.addListener(marker, 'click', function(evt) {
                                        location = wpmgza_linkd_orig;
                                    });
                                }


                                if (wpgmaps_localize_global_settings['wpgmza_settings_map_open_marker_by'] === "" || 'undefined' === typeof wpgmaps_localize_global_settings['wpgmza_settings_map_open_marker_by'] || wpgmaps_localize_global_settings['wpgmza_settings_map_open_marker_by'] === '1') {
                                    google.maps.event.addListener(marker, 'click', function(evt) {
                                        if (typeof val.other_data !== "undefined" && typeof val.other_data.icon_on_click !== "undefined" && val.other_data.icon_on_click !== "") {
                                            marker.setIcon(val.other_data.icon_on_click);
                                        }
                                        wpgmza_open_marker_func(map_id, marker, html, click_from_list, marker_data_object, wpmgza_marker_id, val);
                                    });
                                } else {
                                    google.maps.event.addListener(marker, 'mouseover', function(evt) {
                                        if (typeof val.other_data !== "undefined" && typeof val.other_data.icon_on_click !== "undefined" && val.other_data.icon_on_click !== "") {

                                            marker.setIcon(val.other_data.icon_on_click);
                                        }
                                        wpgmza_open_marker_func(map_id, marker, html, click_from_list, marker_data_object, wpmgza_marker_id, val);
                                    });
                                }
                                marker_array[map_id][wpmgza_marker_id] = marker;
                                marker_array[map_id][wpmgza_marker_id].default_icon = marker.icon;

                                google.maps.event.addListener(infoWindow[wpmgza_marker_id], 'closeclick', function(evt) {
                                    if (typeof marker_array[map_id][wpmgza_marker_id].icon !== "undefined" && marker_array[map_id][wpmgza_marker_id].icon !== "") {
                                        marker_array[map_id][wpmgza_marker_id].setIcon(marker_array[map_id][wpmgza_marker_id].default_icon);
                                    } else {
                                        marker_array[map_id][wpmgza_marker_id].setIcon(null);
                                    }
                                });



                                marker_array2[map_id].push(marker);
                                marker_sl_array[map_id].push(wpmgza_marker_id);



                            }
                        }


                    });

                    if (typeof wpgm_g_e !== "undefined" && wpgm_g_e === '1') {

                        if (wpgmaps_localize[map_id]['mass_marker_support'] === "1" || wpgmaps_localize[map_id]['mass_marker_support'] === null) {
                            if (typeof markerClusterer[map_id] !== "undefined") { markerClusterer[map_id].addMarkers(marker_array2[map_id]); }
                        }
                    }

                    if (radius !== null) {
                        wpgmza_filter_marker_lists_by_array(map_id, marker_sl_array[map_id]);
                    }
                }
            }
            if (wpgmaps_localize[entry]['show_user_location'] === "1") {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function(position) {
                        user_location = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

                        if ("undefined" !== typeof wpgmaps_localize[map_id]['other_settings']['upload_default_ul_marker']) {
                            var marker = new google.maps.Marker({
                                position: user_location,
                                map: MYMAP[map_id].map,
                                icon: wpgmaps_localize[map_id]['other_settings']['upload_default_ul_marker'],
                                animation: google.maps.Animation.DROP
                            });
                        } else {
                            var marker = new google.maps.Marker({
                                position: user_location,
                                map: MYMAP[map_id].map,
                                animation: google.maps.Animation.DROP
                            });
                        }
                        var wpmgza_marker_id = marker_array[map_id].length + 1;
                        infoWindow[wpmgza_marker_id] = new google.maps.InfoWindow();
                        google.maps.event.addListener(marker, 'click', function(evt) {
                            clearLocations();

                            infoWindow[wpmgza_marker_id].setContent(wpgmaps_lang_my_location);
                            infoWindow[wpmgza_marker_id].open(MYMAP[wpgmaps_localize[entry]['id']].map, marker);
                        });

                        marker_array[map_id][wpmgza_marker_id] = marker;

                    });
                } else {
                    /* Browser doesn't support Geolocation */
                }
            }

            /**
             * Identify if we need to focus on a specific LAT and LNG (focused marker)
             */
            if (focus_lat !== false && focus_lng !== false) {
                var point = new google.maps.LatLng(parseFloat(focus_lat), parseFloat(focus_lng));
                MYMAP[map_id].map.setCenter(point);
            }

        };

        function wpgmza_open_marker_func(map_id, marker, html, click_from_list, marker_data, wpmgza_marker_id, val) {
            jQuery('.wpgmza_modern_infowindow').show();
            jQuery('.wpgmza_modern_infowindow').css('display', 'block');

            if (typeof val.other_data !== "undefined" && typeof val.other_data.icon_on_click !== "undefined" && val.other_data.icon_on_click !== "") {

                marker.setIcon(val.other_data.icon_on_click);
            }



            if ((typeof wpgmaps_localize_global_settings['wpgmza_iw_type'] !== 'undefined' && parseInt(wpgmaps_localize_global_settings['wpgmza_iw_type']) >= 1) || (typeof wpgmaps_localize[map_id]['other_settings']['wpgmza_iw_type'] !== "undefined" && parseInt(wpgmaps_localize[map_id]['other_settings']['wpgmza_iw_type']) >= 1)) {

                wpgmza_create_new_iw_window(map_id);
                /* set the variable to "open" */
                modern_iw_open[map_id] = true;


                /* see if the DOM element is there */
                if (modern_iw_open[map_id]) {

                } else {

                }

                /* reset the elements */
                jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_iw_marker_image").attr("src", "");
                jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_iw_title").html("");
                jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_iw_description").html("");
                jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_iw_address_p").html("");


                jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_more_info_button").attr("href", "#");
                jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_more_info_button").attr("target", "");
                jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_directions_button").attr("gps", "");
                jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_directions_button").attr("href", "#");
                jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_directions_button").attr("id", "");
                jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_directions_button").attr("wpgm_addr_field", "");



                if (marker_data.image === "" && marker_data.title === "") {
                    jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_iw_image").css("display", "none");
                } else {
                    jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_iw_image").css("display", "block");
                }


                if (marker_data.image !== "") {
                    jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_iw_marker_image").css("display", "block");
                    jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_iw_marker_image").attr("src", marker_data.image);
                    jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_iw_title").attr("style", "position: absolute !important");
                    if (marker_data.title !== "") { jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_iw_title").html(marker_data.title); }

                } else {
                    jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_iw_marker_image").css("display", "none");
                    jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_iw_title").attr("style", "position: relative !important");
                    if (marker_data.title !== "") { jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_iw_title").html(marker_data.title); }
                }

                if (marker_data.desc !== "") {
                    jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_iw_description").css("display", "block");
                    if (typeof marker_data.desc !== "undefined" && marker_data.desc !== "") { jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_iw_description").html(marker_data.desc); }
                } else {
                    jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_iw_description").css("display", "none");

                }


                if (typeof wpgmaps_localize_global_settings['wpgmza_settings_infowindow_address'] !== 'undefined' && wpgmaps_localize_global_settings['wpgmza_settings_infowindow_address'] === "yes") {} else {
                    if (typeof marker_data.address !== "undefined" && marker_data.address !== "") { jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_iw_address_p").html(marker_data.address); }
                }


                if (typeof marker_data.link !== "undefined" && marker_data.link !== "") {
                    jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_more_info_button").show();
                    jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_more_info_button").attr("href", marker_data.link);
                    if (marker_data.link_target !== "") {
                        jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_more_info_button").attr("target", "_BLANK");
                    }
                } else {
                    jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_more_info_button").hide();
                }
                if (typeof marker_data.directions !== "undefined" && marker_data.directions !== "") {
                    jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_directions_button").show();
                    jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_directions_button").attr("href", "javascript:void(0);");
                    jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_directions_button").attr("gps", marker_data.gps);
                    jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_directions_button").attr("wpgm_addr_field", marker_data.address);
                    jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_directions_button").attr("id", map_id);
                    jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_directions_button").addClass("wpgmza_gd");

                } else {
                    jQuery("#wpgmza_iw_holder_" + map_id + " .wpgmza_directions_button").hide();
                }

                if (click_from_list) {
                    MYMAP[map_id].map.panTo(marker.position);
                    MYMAP[map_id].map.setZoom(13);
                }
                click_from_list = false;

            } else {
                clearLocations();
                if (wpgmaps_localize_global_settings['wpgmza_settings_infowindow_width']) {
                    infoWindow[wpmgza_marker_id].setOptions({ maxWidth: wpgmaps_localize_global_settings['wpgmza_settings_infowindow_width'] });
                }
                infoWindow[wpmgza_marker_id].setContent(html);
                if (click_from_list) {
                    MYMAP[map_id].map.panTo(marker.position);
                    MYMAP[map_id].map.setZoom(13);
                }
                click_from_list = false;

                infoWindow[wpmgza_marker_id].open(MYMAP[map_id].map, marker);

            }



        }

        function wpgmza_create_new_iw_window(mapid) {
            /* handle new modern infowindow */
            if ((typeof wpgmaps_localize_global_settings['wpgmza_iw_type'] !== 'undefined' && parseInt(wpgmaps_localize_global_settings['wpgmza_iw_type']) >= 1) || (typeof wpgmaps_localize[mapid]['other_settings']['wpgmza_iw_type'] !== "undefined" && parseInt(wpgmaps_localize[mapid]['other_settings']['wpgmza_iw_type']) >= 1)) {
                if (typeof document.getElementById('wpgmza_iw_holder_' + mapid) !== "undefined") {

                    if (wpgmaps_localize_global_settings['wpgmza_settings_infowindow_width'] === "" || 'undefined' === typeof wpgmaps_localize_global_settings['wpgmza_settings_infowindow_width']) {
                        wpgmaps_localize_global_settings['wpgmza_settings_infowindow_width'] = false;
                    }

                    var legend = document.getElementById('wpgmza_iw_holder_' + mapid);
                    if (legend !== null) {
                        jQuery(legend).remove();
                    }

                    wpgmza_iw_Div[mapid] = document.createElement('div');
                    wpgmza_iw_Div[mapid].id = 'wpgmza_iw_holder_' + mapid;
                    wpgmza_iw_Div[mapid].style = 'display:block;';
                    document.getElementsByTagName('body')[0].appendChild(wpgmza_iw_Div[mapid]);

                    wpgmza_iw_Div_inner = document.createElement('div');
                    wpgmza_iw_Div_inner.className = 'wpgmza_modern_infowindow_inner wpgmza_modern_infowindow_inner_' + mapid;
                    wpgmza_iw_Div[mapid].appendChild(wpgmza_iw_Div_inner);

                    wpgmza_iw_Div_close = document.createElement('div');
                    wpgmza_iw_Div_close.className = 'wpgmza_modern_infowindow_close';
                    wpgmza_iw_Div_close.setAttribute('mid', mapid);

                    var t = document.createTextNode("x");
                    wpgmza_iw_Div_close.appendChild(t);
                    wpgmza_iw_Div_inner.appendChild(wpgmza_iw_Div_close);

                    wpgmza_iw_Div_img = document.createElement('div');
                    wpgmza_iw_Div_img.className = 'wpgmza_iw_image';
                    wpgmza_iw_Div_inner.appendChild(wpgmza_iw_Div_img);

                    wpgmza_iw_img = document.createElement('img');
                    wpgmza_iw_img.className = 'wpgmza_iw_marker_image';
                    wpgmza_iw_img.src = '';
                    wpgmza_iw_img.style = 'max-width:100%;';
                    wpgmza_iw_Div_img.appendChild(wpgmza_iw_img);

                    wpgmza_iw_img_div = document.createElement('div');
                    wpgmza_iw_img_div.className = 'wpgmza_iw_title';
                    wpgmza_iw_Div_inner.appendChild(wpgmza_iw_img_div);

                    wpgmza_iw_img_div_p = document.createElement('p');
                    wpgmza_iw_img_div_p.className = 'wpgmza_iw_title_p';
                    wpgmza_iw_img_div.appendChild(wpgmza_iw_img_div_p);

                    wpgmza_iw_address_div = document.createElement('div');
                    wpgmza_iw_address_div.className = 'wpgmza_iw_address';
                    wpgmza_iw_Div_inner.appendChild(wpgmza_iw_address_div);

                    wpgmza_iw_address_p = document.createElement('p');
                    wpgmza_iw_address_p.className = 'wpgmza_iw_address_p';
                    wpgmza_iw_address_div.appendChild(wpgmza_iw_address_p);

                    wpgmza_iw_description = document.createElement('div');
                    wpgmza_iw_description.className = 'wpgmza_iw_description';
                    wpgmza_iw_Div_inner.appendChild(wpgmza_iw_description);

                    wpgmza_iw_description_p = document.createElement('p');
                    wpgmza_iw_description_p.className = 'wpgmza_iw_description_p';
                    wpgmza_iw_description.appendChild(wpgmza_iw_description_p);


                    wpgmza_iw_buttons = document.createElement('div');
                    wpgmza_iw_buttons.className = 'wpgmza_iw_buttons';
                    wpgmza_iw_Div_inner.appendChild(wpgmza_iw_buttons);

                    wpgmza_directions_button = document.createElement('a');
                    wpgmza_directions_button.className = 'wpgmza_button wpgmza_left wpgmza_directions_button';
                    wpgmza_directions_button.src = '#';
                    var t = document.createTextNode(wpgmaps_lang_directions);
                    wpgmza_directions_button.appendChild(t);

                    wpgmza_iw_buttons.appendChild(wpgmza_directions_button);


                    wpgmza_more_info_button = document.createElement('a');
                    wpgmza_more_info_button.className = 'wpgmza_button wpgmza_right wpgmza_more_info_button';
                    wpgmza_more_info_button.src = '#';
                    var t = document.createTextNode(wpgmaps_lang_more_info);
                    wpgmza_more_info_button.appendChild(t);

                    wpgmza_iw_buttons.appendChild(wpgmza_more_info_button);


                    var legend = document.getElementById('wpgmza_iw_holder_' + mapid);

                    jQuery(legend).css('display', 'block');
                    jQuery(legend).addClass('wpgmza_modern_infowindow');
                    /* jQuery(legend).css('width',wpgmaps_localize_global_settings['wpgmza_settings_infowindow_width']+'px'); */
                    jQuery(legend).addClass('wpgmza-shadow');
                    MYMAP[mapid].map.controls[google.maps.ControlPosition.RIGHT_TOP].push(legend);
                }

            }
        }

        function add_heatmap(mapid, datasetid) {

            var tmp_data = wpgmaps_localize_heatmap_settings[mapid][datasetid];
            var current_poly_id = datasetid;
            var tmp_polydata = tmp_data['polydata'];
            var WPGM_PathData = new Array();
            for (tmp_entry2 in tmp_polydata) {
                if (typeof tmp_polydata[tmp_entry2][0] !== "undefined") {

                    WPGM_PathData.push(new google.maps.LatLng(tmp_polydata[tmp_entry2][0], tmp_polydata[tmp_entry2][1]));
                }
            }
            if (tmp_data['radius'] === null || tmp_data['radius'] === "") { tmp_data['radius'] = 20; }
            if (tmp_data['gradient'] === null || tmp_data['gradient'] === "") { tmp_data['gradient'] = null; }
            if (tmp_data['opacity'] === null || tmp_data['opacity'] === "") { tmp_data['opacity'] = 0.6; }

            var bounds = new google.maps.LatLngBounds();
            for (i = 0; i < WPGM_PathData.length; i++) {
                bounds.extend(WPGM_PathData[i]);
            }

            WPGM_Path_Polygon[datasetid] = new google.maps.visualization.HeatmapLayer({
                data: WPGM_PathData,
                map: MYMAP[mapid].map
            });

            WPGM_Path_Polygon[datasetid].setMap(MYMAP[mapid].map);
            var gradient = JSON.parse(tmp_data['gradient']);
            WPGM_Path_Polygon[datasetid].set('radius', tmp_data['radius']);
            WPGM_Path_Polygon[datasetid].set('opacity', tmp_data['opacity']);
            WPGM_Path_Polygon[datasetid].set('gradient', gradient);


            polygon_center = bounds.getCenter();



        }

        function add_polygon(mapid, polygonid) {
            var tmp_data = wpgmaps_localize_polygon_settings[mapid][polygonid];
            var current_poly_id = polygonid;
            var tmp_polydata = tmp_data['polydata'];
            var WPGM_PathData = new Array();
            for (tmp_entry2 in tmp_polydata) {
                if (typeof tmp_polydata[tmp_entry2][0] !== "undefined") {

                    WPGM_PathData.push(new google.maps.LatLng(tmp_polydata[tmp_entry2][0], tmp_polydata[tmp_entry2][1]));
                }
            }
            if (tmp_data['lineopacity'] === null || tmp_data['lineopacity'] === "") {
                tmp_data['lineopacity'] = 1;
            }

            var bounds = new google.maps.LatLngBounds();
            for (i = 0; i < WPGM_PathData.length; i++) {
                bounds.extend(WPGM_PathData[i]);
            }

            WPGM_Path_Polygon[polygonid] = new google.maps.Polygon({
                path: WPGM_PathData,
                clickable: true,
                /* must add option for this */
                strokeColor: "#" + tmp_data['linecolor'],
                fillOpacity: tmp_data['opacity'],
                strokeOpacity: tmp_data['lineopacity'],
                fillColor: "#" + tmp_data['fillcolor'],
                strokeWeight: 2,
                map: MYMAP[mapid].map
            });
            WPGM_Path_Polygon[polygonid].setMap(MYMAP[mapid].map);

            polygon_center = bounds.getCenter();

            if (tmp_data['title'] !== "") {
                infoWindow_poly[polygonid] = new google.maps.InfoWindow();
                google.maps.event.addListener(WPGM_Path_Polygon[polygonid], 'click', function(event) {
                    infoWindow_poly[polygonid].setPosition(event.latLng);
                    content = "";
                    if (tmp_data['link'] !== "") {
                        var content = "<a href='" + tmp_data['link'] + "'>" + tmp_data['title'] + "</a>";
                    } else {
                        var content = tmp_data['title'];
                    }
                    infoWindow_poly[polygonid].setContent(content);
                    infoWindow_poly[polygonid].open(MYMAP[mapid].map, this.position);
                });
            }


            google.maps.event.addListener(WPGM_Path_Polygon[polygonid], "mouseover", function(event) {
                this.setOptions({ fillColor: "#" + tmp_data['ohfillcolor'] });
                this.setOptions({ fillOpacity: tmp_data['ohopacity'] });
                this.setOptions({ strokeColor: "#" + tmp_data['ohlinecolor'] });
                this.setOptions({ strokeWeight: 2 });
                this.setOptions({ strokeOpacity: 0.9 });
            });
            google.maps.event.addListener(WPGM_Path_Polygon[polygonid], "click", function(event) {

                this.setOptions({ fillColor: "#" + tmp_data['ohfillcolor'] });
                this.setOptions({ fillOpacity: tmp_data['ohopacity'] });
                this.setOptions({ strokeColor: "#" + tmp_data['ohlinecolor'] });
                this.setOptions({ strokeWeight: 2 });
                this.setOptions({ strokeOpacity: 0.9 });
            });
            google.maps.event.addListener(WPGM_Path_Polygon[polygonid], "mouseout", function(event) {
                this.setOptions({ fillColor: "#" + tmp_data['fillcolor'] });
                this.setOptions({ fillOpacity: tmp_data['opacity'] });
                this.setOptions({ strokeColor: "#" + tmp_data['linecolor'] });
                this.setOptions({ strokeWeight: 2 });
                this.setOptions({ strokeOpacity: tmp_data['lineopacity'] });
            });





        }

        function add_polyline(mapid, polyline) {


            var tmp_data = wpgmaps_localize_polyline_settings[mapid][polyline];

            var current_poly_id = polyline;
            var tmp_polydata = tmp_data['polydata'];
            var WPGM_Polyline_PathData = new Array();
            for (tmp_entry2 in tmp_polydata) {
                if (typeof tmp_polydata[tmp_entry2][0] !== "undefined" && typeof tmp_polydata[tmp_entry2][1] !== "undefined") {
                    var lat = tmp_polydata[tmp_entry2][0].replace(')', '');
                    lat = lat.replace('(', '');
                    var lng = tmp_polydata[tmp_entry2][1].replace(')', '');
                    lng = lng.replace('(', '');
                    WPGM_Polyline_PathData.push(new google.maps.LatLng(lat, lng));
                }


            }
            if (tmp_data['lineopacity'] === null || tmp_data['lineopacity'] === "") {
                tmp_data['lineopacity'] = 1;
            }

            WPGM_Path[polyline] = new google.maps.Polyline({
                path: WPGM_Polyline_PathData,
                strokeColor: "#" + tmp_data['linecolor'],
                strokeOpacity: tmp_data['opacity'],
                strokeWeight: tmp_data['linethickness'],
                map: MYMAP[mapid].map
            });
            WPGM_Path[polyline].setMap(MYMAP[mapid].map);


        }




    }






});




function openInfoWindow(marker_id, map_id, by_list) {
    if (by_list) {
        click_from_list = true;
    } else {
        click_from_list = false;
    }

    if (wpgmaps_localize_global_settings['wpgmza_settings_map_open_marker_by'] === "" || 'undefined' === typeof wpgmaps_localize_global_settings['wpgmza_settings_map_open_marker_by'] || wpgmaps_localize_global_settings['wpgmza_settings_map_open_marker_by'] === '1') {
        google.maps.event.trigger(marker_array[map_id][marker_id], 'click');
    } else {
        google.maps.event.trigger(marker_array[map_id][marker_id], 'mouseover');
    }
    click_from_list = false;
}






function calcRoute(start, end, mapid, travelmode, avoidtolls, avoidhighways, avoidferries, waypoints) {

    var request = {
        origin: start,
        destination: end,
        provideRouteAlternatives: true,
        travelMode: google.maps.DirectionsTravelMode[travelmode],
        avoidHighways: avoidhighways,
        avoidTolls: avoidtolls,
        avoidTolls: avoidferries
    };

    if (typeof waypoints !== "undefined") {
        var waypoint_array = waypoints.split("|"); //Split by pipe
        for (var i in waypoint_array) {
            var the_loc = waypoint_array[i];
            waypoint_array[i] = {
                'location': the_loc,
                'stopover': false
            };
        }
        request['waypoints'] = waypoint_array;
    }


    dirflg = "c";

    if (travelmode === "DRIVING") { dirflg = "d"; } else if (travelmode === "WALKING") { dirflg = "w"; } else if (travelmode === "BICYCLING") { dirflg = "b"; } else if (travelmode === "TRANSIT") { dirflg = "t"; } else { dirflg = "c"; }


    directionsDisplay[mapid];
    directionsService[mapid] = new google.maps.DirectionsService();
    var currentDirections = null;
    var oldDirections = [];

    jQuery("#wpgmza_input_to_" + mapid).css("border", "");
    jQuery("#wpgmza_input_from_" + mapid).css("border", "");
    jQuery("#wpgmaps_directions_notification_" + mapid).html(orig_fetching_directions);


    directionsDisplay[mapid] = new google.maps.DirectionsRenderer({
        'map': MYMAP[mapid].map,
        'preserveViewport': true,
        'draggable': true
    });
    directionsDisplay[mapid].setPanel(document.getElementById("directions_panel_" + mapid));


    google.maps.event.addListener(directionsDisplay[mapid], 'directions_changed',
        function() {
            if (currentDirections) {
                oldDirections.push(currentDirections);
            }
            currentDirections = directionsDisplay[mapid].getDirections();
            jQuery("#directions_panel_" + mapid).show();
            jQuery("#wpgmaps_directions_notification_" + mapid).hide();
            jQuery("#wpgmaps_directions_reset_" + mapid).show();
        });


    directionsService[mapid].route(request, function(response, status) {
        if (status === google.maps.DirectionsStatus.OK) {
            directionsDisplay[mapid].setDirections(response);
        } else if (status === "ZERO_RESULTS") {
            jQuery("#wpgmaps_directions_editbox_" + mapid).show("fast");
            wpgmza_reset_directions(mapid);
            jQuery("#wpgmaps_directions_notification_" + mapid).show();
            jQuery("#wpgmaps_directions_notification_" + mapid).html("No results found.");

        } else if (status === "NOT_FOUND") {
            jQuery("#wpgmaps_directions_editbox_" + mapid).show("fast");
            wpgmza_reset_directions(mapid);
            jQuery("#wpgmaps_directions_notification_" + mapid).show();
            jQuery("#wpgmaps_directions_notification_" + mapid).html("No results found.");
            if (typeof response.geocoded_waypoints[0] !== "undefined" && typeof response.geocoded_waypoints[0].geocoder_status !== "undefined" && response.geocoded_waypoints[0].geocoder_status == "ZERO_RESULTS") {
                jQuery("#wpgmza_input_from_" + mapid).css("border", "1px solid red");
            }
            if (typeof response.geocoded_waypoints[1] !== "undefined" && typeof response.geocoded_waypoints[1].geocoder_status !== "undefined" && response.geocoded_waypoints[1].geocoder_status == "ZERO_RESULTS") {
                jQuery("#wpgmza_input_to_" + mapid).css("border", "1px solid red");
            }

        }
    });

    jQuery("#wpgmaps_print_directions_" + mapid).attr('href', 'https://maps.google.com/maps?saddr=' + encodeURIComponent(start) + '&daddr=' + encodeURIComponent(end) + '&dirflg=' + dirflg + '&om=1');

}

function wpgmza_show_options(wpgmzamid) {

    jQuery("#wpgmza_options_box_" + wpgmzamid).show();
    jQuery("#wpgmza_show_options_" + wpgmzamid).hide();
    jQuery("#wpgmza_hide_options_" + wpgmzamid).show();
}

function wpgmza_hide_options(wpgmzamid) {
    jQuery("#wpgmza_options_box_" + wpgmzamid).hide();
    jQuery("#wpgmza_show_options_" + wpgmzamid).show();
    jQuery("#wpgmza_hide_options_" + wpgmzamid).hide();
}

function wpgmza_reset_directions(wpgmzamid) {
    currentDirections = null;
    directionsDisplay[wpgmzamid].setMap(null);
    var currentDirections = null;

    jQuery("#wpgmaps_directions_editbox_" + wpgmzamid).show();
    jQuery("#directions_panel_" + wpgmzamid).hide();
    jQuery("#directions_panel_" + wpgmzamid).html('');
    jQuery("#wpgmaps_directions_notification_" + wpgmzamid).hide();
    jQuery("#wpgmaps_directions_reset_" + wpgmzamid).hide();
    jQuery("#wpgmaps_directions_notification_" + wpgmzamid).html(orig_fetching_directions);
}

jQuery("body").on("click", ".wpgmza_gd", function() {

    var wpgmzamid = jQuery(this).attr("id");
    var end = jQuery(this).attr("wpgm_addr_field");
    var latLong = jQuery(this).attr("gps");
    /* pelicanpaul updates for mobile */
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {

        if ((navigator.platform.indexOf("iPhone") != -1) ||
            (navigator.platform.indexOf("iPod") != -1) ||
            (navigator.platform.indexOf("iPad") != -1))
            window.open("maps://maps.google.com/maps?daddr=" + latLong + "&ll=");
        else
            window.open("http://maps.google.com/maps?daddr=" + latLong + "&ll=");
    } else {

        jQuery("#wpgmaps_directions_edit_" + wpgmzamid).show();
        jQuery("#wpgmaps_directions_editbox_" + wpgmzamid).show();
        jQuery("#wpgmza_input_to_" + wpgmzamid).val(end.length > 0 ? end : latLong);
        jQuery("#wpgmza_input_from_" + wpgmzamid).focus().select();
    }


});

jQuery("body").on("click", ".wpgmaps_get_directions", function() {

    var wpgmzamid = jQuery(this).attr("id");

    var avoidtolls = jQuery('#wpgmza_tolls_' + wpgmzamid).is(':checked');
    var avoidhighways = jQuery('#wpgmza_highways_' + wpgmzamid).is(':checked');
    var avoidferries = jQuery('#wpgmza_ferries_' + wpgmzamid).is(':checked');


    var wpgmza_dir_type = jQuery("#wpgmza_dir_type_" + wpgmzamid).val();
    var wpgmaps_from = jQuery("#wpgmza_input_from_" + wpgmzamid).val();
    var wpgmaps_to = jQuery("#wpgmza_input_to_" + wpgmzamid).val();

    var wpgmaps_waypoints = jQuery("#wpgmza_input_waypoints_" + wpgmzamid).val();

    if (wpgmaps_from === "" || wpgmaps_to === "") { alert(wpgmaps_lang_error1); } else { calcRoute(wpgmaps_from, wpgmaps_to, wpgmzamid, wpgmza_dir_type, avoidtolls, avoidhighways, avoidferries, wpgmaps_waypoints);
        jQuery("#wpgmaps_directions_editbox_" + wpgmzamid).hide("slow");
        jQuery("#wpgmaps_directions_notification_" + wpgmzamid).show("slow"); }
});



jQuery("body").on("keypress", ".addressInput", function(event) {
    if (event.which == 13) {
        var mid = jQuery(this).attr("mid");
        jQuery('.wpgmza_sl_search_button_' + mid).trigger('click');
    }
});

jQuery('body').on('click', '.wpgmza_modern_infowindow_close', function() {
    var mid = jQuery(this).attr('mid');
    jQuery("#wpgmza_iw_holder_" + mid).remove();


});