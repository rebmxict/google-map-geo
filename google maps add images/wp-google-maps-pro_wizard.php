<?php
/* Maps 6.0 Wizard*/


function wpgmaps_wizard_layout() {

    if (isset($_GET['page']) && $_GET['page'] == 'wp-google-maps-menu-categories') {
        add_action('admin_print_scripts', 'wpgmaps_admin_wizard_scripts');
    }

    ?>
    <div class='wrap'>
    <h1><?php _e("Select a Map Type (beta)", "wp-google-maps"); ?></h1>

    <style>.wpgmza-support-notice{display:none !important;}</style>
        <div class='wide'>
            <script>
                jQuery(document).ready(function(){
                    jQuery('.wpgmza-listing-wizard-1').click(function(){
                        jQuery('.wpgmza-listing-wizard-1').fadeIn('fast');
                        jQuery('.wpgmza-listing-wizard-2').hide();
                        jQuery(this).hide();
                        jQuery(this).next(".wpgmza-listing-wizard-2").fadeIn('fast');
                    });

                    jQuery('#wpgmza_wizard_sl_btn').click(function(){
                        updateLink("#wpgmza_wizard_sl_btn",  [
                            '#wpgmza-wizard-sl-title',
                            "#wpgmza-wizard-sl-enabled",
                            "#wpgmza-wizard-sl-distance",
                            "#wpgmza-wizard-sl-bounce",
                            "#wpgmza-wizard-sl-hide"
                            ]);
                        window.location = jQuery(this).attr('url');
                    });

                    jQuery('#wpgmza_wizard_gd_btn').click(function(){
                        updateLink("#wpgmza_wizard_gd_btn",  [
                            '#wpgmza-wizard-gd-title',
                            "#wpgmza-wizard-gd-to-address",
                            "#wpgmza-wizard-gd-enabled"
                            ]);
                        window.location = jQuery(this).attr('url');
                    });

                    jQuery('#wpgmza_wizard_ml_btn').click(function(){
                        updateLink("#wpgmza_wizard_ml_btn",  [
                            '#wpgmza-wizard-ml-title',
                            "#wpgmza-wizard-ml-list-by-select"
                            ]);
                        window.location = jQuery(this).attr('url');
                    });

                    jQuery('#wpgmza_wizard_c_btn').click(function(){
                        window.location = "?page=wp-google-maps-menu&action=new";
                    });

                    <?php do_action("wpgmza_wizard_jquery_action", 10);?>

                });



                function updateLink(buttonID, optionsArray){
                    var queryString = "?page=wp-google-maps-menu&action=new-wizard";
                    var valuesArray = new Array();
                    queryString += "&wpgmza_keys=";

                    var otherSettings = "";

                    for(i = 0; i < optionsArray.length; i++){
                        if(jQuery(optionsArray[i]).attr('wpgmza-other-setting')){
                            //Handle this differently
                            
                            if(jQuery(optionsArray[i]).attr('wpgmza-dropdown') == "true"){
                                otherSettings += jQuery(optionsArray[i]).attr('wpgmza-key') + "@" + (parseInt(jQuery(optionsArray[i] + " option:selected").attr('value'))) + (i < optionsArray.length -1 ? "@" : "");
                                
                            }else{
                                otherSettings += jQuery(optionsArray[i]).attr('wpgmza-key') + "@" +  (jQuery(optionsArray[i]).attr('checked') ? "1" : "0") + (i < optionsArray.length -1 ? "@" : ""); //Add key to other setting array
                            }
                            //console.log(jQuery(optionsArray[i]).attr('wpgmza-key'));
                        }else{
                            queryString += jQuery(optionsArray[i]).attr('wpgmza-key') + "," ; //Add key
                            valuesArray.push(jQuery(optionsArray[i]).attr('checked'));
                        }
                    }

                     //Now add 'OTHER SETTINGS'
                    
                    queryString += "other_settings";
                    

                    queryString += "&wpgmza_values=";
                    for(i = 0; i < valuesArray.length; i++){
                        if(jQuery(optionsArray[i]).attr('type') == "checkbox"){
                            queryString += (valuesArray[i] ? "1" : "0") + (i < valuesArray.length-1 || otherSettings !== "" ? ",": ""); //Add key
                        }else if(jQuery(optionsArray[i]).attr('type') == "text"){
                            queryString += (jQuery(optionsArray[i]).val()) + (i < valuesArray.length-1 || otherSettings !== "" ? ",": "");
                        }else if(jQuery(optionsArray[i]).attr('wpgmza-dropdown') == "true"){
                            queryString += (parseInt(jQuery(optionsArray[i] + " option:selected").attr('value'))) + (i < valuesArray.length-1 || otherSettings !== "" ? ",": "");
                        }
                    }

                     //Now add 'OTHER SETTINGS'
                    if(otherSettings != ""){
                        queryString += otherSettings;
                    }
                    
                    jQuery(buttonID).attr('url', queryString);
                }

            </script>

            <?php $wpgmza_wizard_content = ""; $wpgmza_wizard_content = apply_filters("wpgmza_wizard_content_filter", $wpgmza_wizard_content, 10, 1) ; echo $wpgmza_wizard_content;?> 

        </div>
    </div>

    <?php
    

}

function wpgmaps_admin_wizard_scripts() {
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script('jquery-ui-core');

}

add_filter("wpgmza_wizard_content_filter", "wpgmza_wizard_item_control_sl");
function wpgmza_wizard_item_control_sl($content){
    $content .= "
            <div class='wpgmza-listing-comp wpgmza-listing-wizard'>
                <div class='wpgmza-listing-wizard-1'>
                    <div class='wpmgza-listing-1-icon'>
                        <i class='fa fa-building-o'></i>
                    </div>  
                    <h2 style='text-align:center'>".__("Store Locator", "wp-google-maps")."</h2>
                </div>
                <div class='wpgmza-listing-wizard-2' style='display:none;'>
                    <div style='font-size:18px'><i class='fa fa-building-o'></i> ".__("Store Locator", "wp-google-maps")."</div> 
                    <hr>
                    <div>
                        <input type='text' wpgmza-key='map_title' style='display:none' id='wpgmza-wizard-sl-title' value='Store Locator Map'>
                        <input type='checkbox' wpgmza-other-setting='true' wpgmza-key='store_locator_enabled' style='display:none' id='wpgmza-wizard-sl-enabled' checked>
                        <table style='width:100%'>
                            <tr>
                                <td>
                                    ".__("Show distance in:", "wp-google-maps")."
                                </td>
                                <td style='text-align:right;'>
                                    <div class='switch'>
                                        <input type='checkbox' wpgmza-other-setting='true' wpgmza-key='store_locator_distance' class='cmn-toggle cmn-toggle-yes-no' id='wpgmza-wizard-sl-distance'><label style='width:66px !important' for='wpgmza-wizard-sl-distance' data-on='".__("Miles", "wp-google-maps")."' data-off='".__("Kilometers", "wp-google-maps")."'></label>
                                    </div> 
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    ".__("Show bouncing icon:", "wp-google-maps")."
                                </td>
                                <td style='text-align:right;'>
                                     <div class='switch'>
                                        <input type='checkbox' wpgmza-other-setting='true' wpgmza-key='store_locator_bounce' class='cmn-toggle cmn-toggle-round-flat' id='wpgmza-wizard-sl-bounce'><label for='wpgmza-wizard-sl-bounce'></label>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    ".__("Hide markers until search is done:", "wp-google-maps")."
                                </td>
                                <td style='text-align:right;'>
                                    <div class='switch'>
                                        <input type='checkbox' wpgmza-other-setting='true' wpgmza-key='store_locator_hide_before_search' class='cmn-toggle cmn-toggle-round-flat' id='wpgmza-wizard-sl-hide'><label for='wpgmza-wizard-sl-hide'></label>
                                    </div> 
                                </td>
                            </tr>
                        </table>

                        
                                        
                    </div>
                    <button style='position:absolute;bottom:5px;' class='wpgmza_createmap_btn' id='wpgmza_wizard_sl_btn' url=''>".__("Create Map", "wp-google-maps")."</button>
                </div>
            </div>
    ";
    return $content;
}

add_filter("wpgmza_wizard_content_filter", "wpgmza_wizard_item_control_gd",10,1);
function wpgmza_wizard_item_control_gd($content){
    $content .= "
            <div class='wpgmza-listing-comp wpgmza-listing-wizard'>
                <div class='wpgmza-listing-wizard-1'>
                    <div class='wpmgza-listing-1-icon'>
                        <i class='fa fa-compass'></i>
                    </div> 
                        <h2 style='text-align:center'>".__("Directions", "wp-google-maps")."</h2>
                 </div>
                    <div class='wpgmza-listing-wizard-2' style='display:none;'>
                        <div style='font-size:18px'><i class='fa fa-compass'></i> ".__("Directions", "wp-google-maps")."</div> 
                        <hr>
                        <div>
                            <input type='text' wpgmza-key='map_title' style='display:none' id='wpgmza-wizard-gd-title' value='Directions Map'>
                            <input type='checkbox' wpgmza-key='directions_enabled' style='display:none' id='wpgmza-wizard-gd-enabled' checked >

                            <table style='width:100%'>
                                <tr>
                                    <td>
                                        ".__("Default 'To' Address:", "wp-google-maps")."
                                    </td>
                                    <td style='text-align:right;'>
  
                                            <input type='text' wpgmza-key='default_to' id='wpgmza-wizard-gd-to-address' value='' placeholder='".__("Enter Address", "wp-google-maps")."'>
                                        
                                    </td>
                                </tr>
                            </table>
                             
                             
                        </div>
                        <button style='position:absolute;bottom:5px;' class='wpgmza_createmap_btn' id='wpgmza_wizard_gd_btn' url=''>".__("Create Map", "wp-google-maps")."</button>
                    </div>
            </div>
    ";
    return $content;
}

add_filter("wpgmza_wizard_content_filter", "wpgmza_wizard_item_control_ml",10,1);
function wpgmza_wizard_item_control_ml($content){
    $content .= "
           <div class='wpgmza-listing-comp wpgmza-listing-wizard'>
                <div class='wpgmza-listing-wizard-1'>
                    <div class='wpmgza-listing-1-icon'>
                        <i class='fa fa-list'></i>
                    </div>  
                    <h2 style='text-align:center'>".__("Marker Listing", "wp-google-maps")."</h2>
                </div>
                <div class='wpgmza-listing-wizard-2' style='display:none;'>
                    <div style='font-size:18px'><i class='fa fa-list'></i> ".__("Marker Listing", "wp-google-maps")."</div> 
                        <hr>
                        <div>
                            <input type='text' wpgmza-key='map_title' style='display:none' id='wpgmza-wizard-ml-title' value='Marker Listing Map'>

                            <table style='width:100%'>
                                <tr>
                                    <td>
                                        ".__("Marker Listing Style", "wp-google-maps")."
                                    </td>
                                    <td style='text-align:right;'>
  
                                            <select id='wpgmza-wizard-ml-list-by-select' wpgmza-dropdown='true' wpgmza-other-setting='true' wpgmza-key='list_markers_by'>
                                                <option value='1'>".__("Basic Table", "wp-google-maps")."</option>
                                                <option value='4'>".__("Basic List", "wp-google-maps")."</option>
                                                <option value='2' selected>".__("Advanced Table", "wp-google-maps")."</option>
                                                <option value='3'>".__("Carousel", "wp-google-maps")."</option>
                                            </select>
                                        
                                    </td>
                                </tr>
                            </table>
                             
                             
                        </div>
                   <button style='position:absolute;bottom:5px;' class='wpgmza_createmap_btn' id='wpgmza_wizard_ml_btn' url=''>".__("Create Map", "wp-google-maps")."</button>
                </div>
            </div>
    ";
    return $content;
}

add_filter("wpgmza_wizard_content_filter", "wpgmza_wizard_item_control_c",1,1);
function wpgmza_wizard_item_control_c($content){
    $content .= "
           <div class='wpgmza-listing-comp wpgmza-listing-wizard'>
                <div class='wpgmza-listing-wizard-1' id='wpgmza_wizard_c_btn'>
                    <div class='wpmgza-listing-1-icon'>
                        <i class='fa fa-map-o'></i>
                    </div>  
                    <h2 style='text-align:center'>".__("Blank Map", "wp-google-maps")."</h2>
                </div>
                <div class='wpgmza-listing-wizard-2' style='display:none;'>

                </div>
            </div>
    ";
    return $content;
}


add_filter("wpgmza_wizard_content_filter", "wpgmza_wizard_control_feedback",99,1);
function wpgmza_wizard_control_feedback($content){
    $content .= "
           <div class='update-nag update-blue'>
                Please consider giving us feedback on our new map wizard.<br><br>
                <a target='_blank' href='http://www.wpgmaps.com/contact-us/'>Share your thoughts</a>
            </div>
    ";
    return $content;
}


