<?php
/*
Marker Category functionality for WP Google Maps Pro


*/


function wpgmaps_menu_category_layout() {


    if (!isset($_GET['action'])) {

        if (function_exists('wpgmza_register_pro_version')) {
            echo"<div class=\"wrap\"><div id=\"icon-edit\" class=\"icon32 icon32-posts-post\"><br></div><h2>".__("Marker Categories","wp-google-maps")." <a href=\"admin.php?page=wp-google-maps-menu-categories&action=new\" class=\"add-new-h2\">".__("Add New Category","wp-google-maps")."</a></h2>";
            wpgmaps_list_categories();
        } else {
            echo"<div class=\"wrap\"><div id=\"icon-edit\" class=\"icon32 icon32-posts-post\"><br></div><h2>".__("Marker Categories","wp-google-maps")."</h2>";
            echo"<p><i><a href='http://www.wpgmaps.com/purchase-professional-version/?utm_source=plugin&utm_medium=link&utm_campaign=category' title='".__("Pro Version","wp-google-maps")."'>".__("Create marker categories","wp-google-maps")."</a> ".__("with the","wp-google-maps")." <a href='http://www.wpgmaps.com/purchase-professional-version/?utm_source=plugin&utm_medium=link&utm_campaign=category' title='Pro Version'>".__("Pro Version","wp-google-maps")."</a> ".__("of WP Google Maps for only","wp-google-maps")." <strong>$14.99!</strong></i></p>";


        }
        echo "</div>";
        echo"<br /><div style='float:right;'><a href='http://www.wpgmaps.com/documentation/troubleshooting/' title='WP Google Maps Troubleshooting Section'>".__("Problems with the plugin? See the troubleshooting manual.","wp-google-maps")."</a></div>";
    } else {

        if ($_GET['action'] == "trash" && isset($_GET['cat_id'])) {
            if (isset($_GET['s']) && $_GET['s'] == "1") {
                if (wpgmaps_trash_cat($_GET['cat_id'])) {
                    echo "<script>window.location = \"".get_option('siteurl')."/wp-admin/admin.php?page=wp-google-maps-menu-categories\"</script>";
                } else {
                    _e("There was a problem deleting the category.");;
                }
            } else {
                echo "<h2>".__("Delete your Category","wp-google-maps")."</h2><p>".__("Are you sure you want to delete the category","wp-google-maps")."? <br /><a href='?page=wp-google-maps-menu-categories&action=trash&cat_id=".$_GET['cat_id']."&s=1'>".__("Yes","wp-google-maps")."</a> | <a href='?page=wp-google-maps-menu-categories'>".__("No","wp-google-maps")."</a></p>";
            }


        }
        
        if ($_GET['action'] == "new") {
            wpgmza_pro_category_new_layout();
        }
        if ($_GET['action'] == "edit") {
            wpgmza_pro_category_edit_layout($_GET['cat_id']);
        }

    }

}

if (isset($_GET['page']) && $_GET['page'] == 'wp-google-maps-menu-categories') {
    add_action('admin_print_scripts', 'wpgmaps_admin_category_scripts');
    add_action('admin_print_styles', 'wpgmaps_admin_category_styles');
}
function wpgmaps_admin_category_scripts() {
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script('jquery-ui-core');

    if (function_exists('wp_enqueue_media')) {
        wp_enqueue_media();
        wp_register_script('my-wpgmaps-upload', plugins_url('js/category_media.js', __FILE__), array('jquery'), '1.0', true);
        wp_enqueue_script('my-wpgmaps-upload');
    } else {
        wp_enqueue_script('media-upload');
        wp_enqueue_script('thickbox');
        wp_register_script('my-wpgmaps-upload', WP_PLUGIN_URL.'/'.plugin_basename(dirname(__FILE__)).'/js/admin_category.js', array('jquery','media-upload','thickbox'));
        wp_enqueue_script('my-wpgmaps-upload');
    }

}
function wpgmaps_admin_category_styles() {
    
}

function wpgmza_pro_category_new_layout() {
    
    $display_marker = "<img src=\"".wpgmaps_get_plugin_url()."/images/marker.png\" />";
    
    $map_ids = wpgmza_return_all_map_ids();
    
    echo "<div class='wrap'>";
    echo "  <h1>WP Google Maps</h1>";
    echo "  <div class='wide'>";
    echo "      <h2>".__("Add a Marker Category","wp-google-maps")."</h2>";
    echo "      <form action='admin.php?page=wp-google-maps-menu-categories' method='post' id='wpgmaps_add_marker_category' name='wpgmaps_add_marker_category_form'>";
    echo "      <table class='wpgmza-listing-comp'>";
    echo "          <tr>";
    echo "              <td><strong>".__("Category Name","wp-google-maps")."</strong>:</td>";
    echo "              <td><input type='text' name='wpgmaps_marker_category_name' id='wpgmaps_marker_category_name' value='' /></td>";
    echo "              <td></td>";
    echo "          </tr>";
    echo "          <tr style='height:20px;'>";
    echo "              <td></td>";
    echo "              <td></td>";
    echo "              <td></td>";
    echo "          </tr>";
    echo "          <tr valign='top'>";
    echo "              <td valign='middle'><strong>".__("Category Marker","wp-google-maps")."</strong>:</td>";
    echo "              <td align='left'><span id=\"wpgmza_mm\">$display_marker</span>";
    echo "              Enter URL <input id=\"upload_default_category_marker\" name=\"upload_default_category_marker\" type='text' size='35' class='regular-text' maxlength='700' value='' /> or <input class='wpgmza_general_btn' id=\"upload_default_category_marker_btn\" type=\"button\" value=\"".__("Upload Image","wp-google-maps")."\" /> <a href=\"javascript:void(0);\" onClick=\"document.forms['wpgmaps_add_marker_category_form'].upload_default_category_marker.value = ''; var span = document.getElementById('wpgmza_mm'); while( span.firstChild ) { span.removeChild( span.firstChild ); } span.appendChild( document.createTextNode('')); return false;\" title=\"Reset to default\">-reset-</a> <small><i>".__("Get great map markers <a href='http://mapicons.nicolasmollet.com/' target='_BLANK' title='Great Google Map Markers'>here</a>","wp-google-maps")."</i></small></td>";
    echo "          </tr>";
    echo "          <tr>";
    echo "              <td><strong>".__("Retina Ready","wp-google-maps")."</strong>:</td>";
    echo "              <td><div class='switch'><input type='checkbox' class='cmn-toggle cmn-toggle-round-flat' id='wpgmaps_marker_category_retina' name='wpgmaps_marker_category_retina' value='1'><label for='wpgmaps_marker_category_retina'></label></div> ".__("This marker is a retina-ready marker","wp-google-maps")."</td>";
    echo "              <td></td>";
    echo "          </tr>";
    echo "          <tr style='height:20px;'>";
    echo "              <td></td>";
    echo "              <td></td>";
    echo "              <td></td>";
    echo "          </tr>";
    echo "          <tr>";
    echo "              <td valign='top'><strong>".__("Parent Category:","wp-google-maps")."</strong></td>";
    echo "              <td>";
    echo "                  <select name='parent_category' id='parent_category'>";
    echo "                      <option value='0'>".__( "None", "wp-google-maps" )."</option>";
    
    $cats = wpgmza_return_all_categories();
    if ($cats) {
        foreach ($cats as $cat) {
            
            $cat_id = $cat->id;
            if (isset($cat->category_name)) { $cat_name = $cat->category_name; } else { $cat_name = ""; }

            $display_cat_name = $cat_name . " (#" . $cat_id . ")";
            echo "                      <option value='".$cat_id."'>". $display_cat_name ."</option>";
        }
    }
    echo "                  </select>";
    echo "                  <p class='description'>" . __( "Optional", "wp-google-maps" ) . "</p>";
    echo "              </td>";
    echo "          </tr>";
    echo "          <tr style='height:20px;'>";
    echo "              <td></td>";
    echo "              <td></td>";
    echo "              <td></td>";
    echo "          </tr>";

    echo "          <tr>";
    echo "              <td valign='top'><strong>".__("Assigned to ","wp-google-maps")."</strong>:</td>";
    echo "              <td>";
    echo "                  <div class='switch'><input class='cmn-toggle cmn-toggle-round-flat' id='map-cat-all' type='checkbox' name='assigned_to_map[]' value='ALL'><label for='map-cat-all'></label></div> All Maps <br /><br />";
    
    foreach ($map_ids as $map_id) {
        $map_data = wpgmza_get_map_data($map_id);
        echo "                  <div class='switch'><input class='cmn-toggle cmn-toggle-round-flat' type='checkbox' id='map-cat-".$map_id."' name='assigned_to_map[]' value='".$map_id."'> <label for='map-cat-".$map_id."'></label></div>".$map_data->map_title."  (#".$map_id.")<br />";
    }
    echo "              </td>";
    echo "          </tr>";
    
    echo "      </table>";
    
    echo "          <p class='submit'><input type='submit' name='wpgmza_save_marker_category' class='button-primary' value='".__("Save Category","wp-google-maps")." &raquo;' /></p>";
    echo "      </form>";
    echo "  </div>";
    echo "</div>";

}
function wpgmza_pro_category_edit_layout($cat_id) {

    global $wpdb;
    global $wpgmza_tblname_categories;
    
    $map_ids = wpgmza_return_all_map_ids();
    
    
    $results = $wpdb->get_results("
      SELECT *
      FROM $wpgmza_tblname_categories
      WHERE `id` = '$cat_id' LIMIT 1
    ");

    
    if (isset($results[0]->category_icon) && $results[0]->category_icon != '') {
        $display_marker = "<img src='".$results[0]->category_icon."' />";
        $display_url = $results[0]->category_icon;
    } else {
        $display_marker = "<img src=\"".wpgmaps_get_plugin_url()."/images/marker.png\" />";
        $display_url = "";

    }
    
    if (isset($results[0]->retina) && intval($results[0]->retina) == 1) {
        $retina_checked = "checked='checked'";
    } else {
        $retina_checked = "";
    }

    if (isset($results[0]->parent) && $results[0]->parent > 0) {
        $cat_parent_selected = $results[0]->parent;
    } else {
        $cat_parent_selected = 0;
    }    

    echo "<div class='wrap'>";
    echo "  <h1>WP Google Maps</h1>";
    echo "  <div class='wide'>";
    echo "      <h2>".__("Edit a Marker Category","wp-google-maps")."</h2>";
    echo "      <form action='admin.php?page=wp-google-maps-menu-categories' method='post' id='wpgmaps_add_marker_category' name='wpgmaps_edit_marker_category_form'>";

    echo "      <table class='wpgmza-listing-comp'>";
    echo "          <tr>";
    echo "              <td><strong>".__("Category Name","wp-google-maps")."</strong>:</td>";
    echo "              <td><input type='hidden' name='wpgmaps_marker_category_id' id='wpgmaps_marker_category_id' value='".$results[0]->id."' /><input type='text' name='wpgmaps_marker_category_name' id='wpgmaps_marker_category_name' value='".$results[0]->category_name."' /></td>";
    echo "              <td></td>";
    echo "          </tr>";
    echo "          <tr style='height:20px;'>";
    echo "              <td></td>";
    echo "              <td></td>";
    echo "              <td></td>";
    echo "          </tr>";
    echo "          <tr valign='top'>";
    echo "              <td valign='middle'><strong>".__("Category Marker","wp-google-maps")."</strong>:</td>";
    echo "              <td align='left'><span id=\"wpgmza_mm\">$display_marker</span> </td>";
    echo "              <td valign='middle'>Enter URL <input id=\"upload_default_category_marker\" name=\"upload_default_category_marker\" type='text' size='35' class='regular-text' maxlength='700' value='$display_url' /> or <input class='wpgmza_general_btn' id=\"upload_default_category_marker_btn\" type=\"button\" value=\"".__("Upload Image","wp-google-maps")."\" /> <a href=\"javascript:void(0);\" onClick=\"document.forms['wpgmaps_edit_marker_category_form'].upload_default_category_marker.value = ''; var span = document.getElementById('wpgmza_mm'); while( span.firstChild ) { span.removeChild( span.firstChild ); } span.appendChild( document.createTextNode('')); return false;\" title=\"Reset to default\">-reset-</a> <small><i>".__("Get great map markers <a href='http://mapicons.nicolasmollet.com/' target='_BLANK' title='Great Google Map Markers'>here</a>","wp-google-maps")."</i></small></td>";
    echo "          </tr>";
    echo "          <tr>";
    echo "              <td><strong>".__("Retina Ready","wp-google-maps")."</strong>:</td>";
    echo "              <td><div class='switch'><input type='checkbox' class='cmn-toggle cmn-toggle-round-flat' id='wpgmaps_marker_category_retina' name='wpgmaps_marker_category_retina' value='1' $retina_checked><label for='wpgmaps_marker_category_retina'></label></div> ".__("This marker is a retina-ready marker","wp-google-maps")."</td>";
    echo "              <td></td>";
    echo "          </tr>";
    echo "          <tr style='height:20px;'>";
    echo "              <td></td>";
    echo "              <td></td>";
    echo "              <td></td>";
    echo "          </tr>";


    echo "          <tr>";
    echo "              <td valign='top'><strong>".__("Parent Category:","wp-google-maps")."</strong></td>";
    echo "              <td>";
    echo "                  <select name='parent_category' id='parent_category'>";
    echo "                      <option value='0'>".__( "None", "wp-google-maps" )."</option>";
    
    $cats = wpgmza_return_all_categories();
    if ($cats) {
        foreach ($cats as $cat) {
            
            $current_cat_id = $cat->id;
            if (isset($cat->category_name)) { $cat_name = $cat->category_name; } else { $cat_name = ""; }

            /* do not show if this is the same category id as the one we are editing - cannot be a parent of iteself... */
            if ($cat_id !== $current_cat_id) {
                $display_cat_name = $cat_name . " (#" . $current_cat_id . ")";
                if ($cat_parent_selected == $current_cat_id) {
                    echo "                      <option value='".$current_cat_id."' selected>". $display_cat_name ."</option>";
                } else {
                    echo "                      <option value='".$current_cat_id."'>". $display_cat_name ."</option>";

                }
            }
        }
    }
    echo "                  </select>";
    echo "                  <p class='description'>" . __( "Optional", "wp-google-maps" ) . "</p>";
    echo "              </td>";
    echo "          </tr>";
    echo "          <tr style='height:20px;'>";
    echo "              <td></td>";
    echo "              <td></td>";
    echo "              <td></td>";
    echo "          </tr>";

    echo "          <tr>";
    echo "              <td valign='top'><strong>".__("Assigned to ","wp-google-maps")."</strong>:</td>";
    echo "              <td>";
    echo "                  <div class='switch'><input class='cmn-toggle cmn-toggle-round-flat' id='map-cat-all' type='checkbox' name='assigned_to_map[]' value='ALL' ".wpgmza_check_cat_map('ALL',$cat_id)."><label for='map-cat-all'></label></div> All Maps <br /><br />";
    
    foreach ($map_ids as $map_id) {
        $map_data = wpgmza_get_map_data($map_id);
        echo "                   <div class='switch'><input class='cmn-toggle cmn-toggle-round-flat' type='checkbox' id='map-cat-".$map_id."' name='assigned_to_map[]' value='".$map_id."' ".wpgmza_check_cat_map($map_id,$cat_id)."> <label for='map-cat-".$map_id."'></label></div>".$map_data->map_title."  (id ".$map_id.")<br />";
    }
    echo "              </td>";
    echo "          </tr>";
    
    echo "      </table>";    
    
    
    echo "          <p class='submit'><input type='submit' name='wpgmza_edit_marker_category' class='button-primary' value='".__("Save Category","wp-google-maps")." &raquo;' /></p>";
    echo "      </form>";
    echo "  </div>";
    echo "</div>";

}


function wpgmza_check_cat_map($map_id,$cat_id) {
    global $wpdb;
    global $wpgmza_tblname_category_maps;
    if ($map_id == "ALL") {
        $sql = "SELECT COUNT(*) FROM `".$wpgmza_tblname_category_maps."` WHERE `cat_id` = '$cat_id' AND `map_id` = '0' LIMIT 1";
    } else {
        $sql = "SELECT COUNT(*) FROM `".$wpgmza_tblname_category_maps."` WHERE `cat_id` = '$cat_id' AND `map_id` = '$map_id' LIMIT 1";
    }
    $results = $wpdb->get_var($sql);
    if ($results>0) { return "checked"; } else { return ""; }
}

add_action('admin_head', 'wpgmaps_category_head');
function wpgmaps_category_head() {

    if (isset($_GET['page']) && $_GET['page'] == "wp-google-maps-menu-categories" && isset($_POST['wpgmza_save_marker_category'])) {
        if (isset($_POST['wpgmza_save_marker_category'])){
            global $wpdb;
            global $wpgmza_tblname_categories;
            global $wpgmza_tblname_category_maps;
            
            
            
            $wpgmaps_category_name = esc_attr($_POST['wpgmaps_marker_category_name']);
            $wpgmaps_category_marker = esc_attr($_POST['upload_default_category_marker']);

            if (isset($_POST['wpgmaps_marker_category_retina'])) { $wpgmaps_category_retina = sanitize_text_field( $_POST['wpgmaps_marker_category_retina'] ); } else { $wpgmaps_category_retina = 0; }

            if ( !isset( $_POST['assigned_to_map'] ) ) { $_POST['assigned_to_map'][0] = __( "All", "wp-google-maps" ); }
            
            if ( !isset( $_POST['parent_category'] ) ) { $cat_parent = 0; } else { $cat_parent = intval( sanitize_text_field( $_POST['parent_category'] ) );}

            
            $rows_affected = $wpdb->query( $wpdb->prepare(
                    "INSERT INTO $wpgmza_tblname_categories SET
                        category_name = %s,
                        active = %d,
                        category_icon = %s,
                        retina = %d,
                        parent = %d
                    ",
                    $wpgmaps_category_name,
                    0,
                    $wpgmaps_category_marker,
                    intval($wpgmaps_category_retina),
                    $cat_parent
                )
            );
            
            $cat_id = $wpdb->insert_id;
            
            
            if ($_POST['assigned_to_map'][0] == "ALL") {
                    $rows_affected = $wpdb->query( $wpdb->prepare(
                        "INSERT INTO $wpgmza_tblname_category_maps SET
                            cat_id = %d,
                            map_id = %d
                        ",
                        $cat_id,
                        0
                    )
                    );
            } else {
                if( isset( $_POST['assigned_to_map'] ) ){ 
                    foreach ($_POST['assigned_to_map'] as $assigned_map) {

                        $rows_affected = $wpdb->query( $wpdb->prepare(
                            "INSERT INTO $wpgmza_tblname_category_maps SET
                                cat_id = %d,
                                map_id = %d
                            ",
                            $cat_id,
                            $assigned_map
                        )
                        );
                    }            
                }
            }
            echo "<div class='updated'>";
            _e("Your category has been created.","wp-google-maps");
            echo "</div>";


        }

    }
    if (isset($_GET['page']) && $_GET['page'] == "wp-google-maps-menu-categories" && isset($_POST['wpgmza_edit_marker_category'])) {
        
            global $wpdb;
            global $wpgmza_tblname_categories;
            global $wpgmza_tblname_category_maps;
            $wpgmaps_cid = esc_attr($_POST['wpgmaps_marker_category_id']);
            if ( !isset($_POST['wpgmaps_marker_category_name'] ) ) { $wpgmaps_category_name = "Unnamed category"; } else { $wpgmaps_category_name = esc_attr($_POST['wpgmaps_marker_category_name']); }
            if ( isset($_POST['wpgmaps_marker_category_retina'] ) ) { $wpgmaps_category_retina = esc_attr($_POST['wpgmaps_marker_category_retina']); } else { $wpgmaps_category_retina = 0; }

            if ( !isset($_POST['assigned_to_map'] ) ) { $_POST['assigned_to_map'][0] = __( "All", "wp-google-maps" ); }

            if ( !isset( $_POST['parent_category'] ) ) { $cat_parent = 0; } else { $cat_parent = intval( sanitize_text_field( $_POST['parent_category'] ) ); }

            $wpgmaps_category_marker = esc_attr($_POST['upload_default_category_marker']);

            $rows_affected = $wpdb->query( $wpdb->prepare(
                "DELETE FROM $wpgmza_tblname_category_maps WHERE
                cat_id = %d"
                ,
                $wpgmaps_cid) 
            ); // remove all instances of this category in the category_maps table

            
            $rows_affected = $wpdb->query( $wpdb->prepare(
                "UPDATE $wpgmza_tblname_categories SET

                category_name = %s,
                active = %d,
                category_icon = %s,
                retina = %d,
                parent = %d

                WHERE
                id = %d",
                $wpgmaps_category_name,
                0,
                $wpgmaps_category_marker,
                intval($wpgmaps_category_retina),
                $cat_parent,
                $wpgmaps_cid) 
            );
            
            
            if ($_POST['assigned_to_map'][0] == "ALL") {
                    $rows_affected = $wpdb->query( $wpdb->prepare(
                        "INSERT INTO $wpgmza_tblname_category_maps SET
                            cat_id = %d,
                            map_id = %d
                        ",
                        $wpgmaps_cid,
                        0
                    )
                    );
            } else {
                
                
                foreach ($_POST['assigned_to_map'] as $assigned_map) {

                    $rows_affected = $wpdb->query( $wpdb->prepare(
                        "INSERT INTO $wpgmza_tblname_category_maps SET
                            cat_id = %d,
                            map_id = %d
                        ",
                        $wpgmaps_cid,
                        $assigned_map
                    )
                    );
                }            
            }            

            echo "<div class='updated'>";
            _e("Your category has been saved.","wp-google-maps");
            echo "</div>";
    }
}

function old_wpgmza_pro_return_category_select_list($map_id) {
    global $wpdb;
    global $wpgmza_tblname_categories;
    global $wpgmza_tblname_category_maps;
    $ret_msg = "";
    $ret_msg .= "<option value=\"0\">".__("All","wp-google-maps")."</option>";
    
    $sql = "SELECT * FROM `$wpgmza_tblname_category_maps` LEFT JOIN `$wpgmza_tblname_categories` ON $wpgmza_tblname_category_maps.cat_id = $wpgmza_tblname_categories.id WHERE (`map_id` = '$map_id' OR `map_id` = '0') AND $wpgmza_tblname_categories.active = '0' ORDER BY `category_name` ASC";

    $results = $wpdb->get_results($sql);
    foreach ( $results as $result ) {
            $ret_msg .= "<option value=\"".$result->id."\">".stripslashes($result->category_name)."</option>";
    }
    

    return $ret_msg;

}
function wpgmza_pro_return_category_select_list($map_id) {
    global $wpdb;
    global $wpgmza_tblname_categories;
    global $wpgmza_tblname_category_maps;
    $ret_msg = "";
    $ret_msg .= "<option value=\"0\">".__("All","wp-google-maps")."</option>";
    
    $sql = "SELECT * FROM `$wpgmza_tblname_category_maps` LEFT JOIN `$wpgmza_tblname_categories` ON $wpgmza_tblname_category_maps.cat_id = $wpgmza_tblname_categories.id WHERE ( `map_id` = '$map_id' OR `map_id` = '0' ) AND `active` = 0 AND `parent` = '0' ORDER BY `category_name` ASC";

    $results = $wpdb->get_results($sql);

    

    /**
     * Builds the final category array that we will use to construct HTML
     * @var array
     */
    $category_array = array();

    foreach ( $results as $result ) {
        $category_array[$result->id] = array();

        $category_array[$result->id]['title'] = stripslashes($result->category_name);
        $category_array[$result->id]['id'] = $result->id;
        $category_array[$result->id]['retina'] = $result->retina;
        $category_array[$result->id]['active'] = $result->active;
        $category_array[$result->id]['parent_id'] = 0;
        $category_array[$result->id]['total_markers'] = wpgmza_return_marker_count_by_category( $result->id, $map_id );
        $category_array[$result->id]['children'] = false; /* set this to false by default */


        /* lets look for children */
        $continue = true;
        $parents_to_check = array();
        $parents_to_check[$result->id] = false;


        $safety_counter = 0;
        while ($continue) {
            $safety_counter++;
            if ($safety_counter > 1000) {
                break;
            }

            foreach ($parents_to_check as $current_parent_id => $has_been_checked) {
                if (!$has_been_checked) {
                    $sql = "SELECT * FROM `$wpgmza_tblname_categories` WHERE `active` = 0 AND `parent` = '".$current_parent_id."' ORDER BY `category_name` ASC";
                    
                    $child_results = $wpdb->get_results($sql);
                    if ($child_results) {

                        /* there are children */
                        foreach ( $child_results as $child_result ) {

                            $category_array[$child_result->id]['title'] = stripslashes($child_result->category_name);
                            $category_array[$child_result->id]['id'] = $child_result->id;
                            $category_array[$child_result->id]['retina'] = $child_result->retina;
                            $category_array[$child_result->id]['active'] = $child_result->active;
                            $category_array[$child_result->id]['parent_id'] = $current_parent_id;
                            $category_array[$child_result->id]['total_markers'] = wpgmza_return_marker_count_by_category( $child_result->id, $map_id );
                            $category_array[$child_result->id]['children'] = false; /* set this to false by default */

                            /* mark this ID as 'to be checked' within the loop */
                            $category_array[$current_parent_id]['children'][] = $child_result->id;
                            $parents_to_check[$child_result->id] = false;

                        }

                        /* mark this parent as 'checked' */
                       

                    } else {
                        /* no children left.. */
                    }
                    $parents_to_check[$current_parent_id] = true;

                    
                }
            }

            /* lets identify if we've gone through the enture checker array and marked everything as true. i.e. check if we are complete */
            $still_continue = false;
            foreach ($parents_to_check as $current_parent_id => $has_been_checked) {
                if (!$has_been_checked) { $still_continue = true; /* theres still categories to look at*/ }
            }
            if (!$still_continue) {
                $continue = false;
            }
            
        }


       

        
        //$ret_msg .= "<div class='wpgmza_cat_checkbox_item_holder wpgmza_cat_checkbox_item_holder_".$result->id."' ".$div_style."><input type='checkbox' class='wpgmza_checkbox' id='wpgmza_cat_checkbox_".$result->id."' name='wpgmza_cat_checkbox$array_suffix' mid=\"".$map_id."\" value=\"".$result->id."\" /><label for='wpgmza_cat_checkbox_".$result->id."'>".stripslashes($result->category_name)."</label></div>";
    }    


     /* build the tree */
    $tree = wpgmza_build_tree($category_array);


    global $wpmgza_cat_tree_html;
    $wpmgza_cat_tree_html = '';
    
    
    wpgmza_consume_tree_dropdown($tree, "", $map_id, '');

    $ret_msg.= $wpmgza_cat_tree_html;


    
    return $ret_msg;

}
function wpgmza_pro_return_category_checkbox_list($map_id,$show_all = true,$array = false) {
    global $wpdb;
    global $wpgmza_tblname_categories;
    global $wpgmza_tblname_category_maps;
    if ($array) { $array_suffix = "[]"; } else { $array_suffix = ""; }
    $sql = "SELECT * FROM `$wpgmza_tblname_category_maps` LEFT JOIN `$wpgmza_tblname_categories` ON $wpgmza_tblname_category_maps.cat_id = $wpgmza_tblname_categories.id WHERE ( `map_id` = '$map_id' OR `map_id` = '0' ) AND `active` = 0 AND `parent` = '0' ORDER BY `category_name` ASC";

    $ret_msg = "<div class='wpgmza_cat_checkbox_holder wpgmza_cat_checkbox_".$map_id."'>";
    //$ret_msg .= "<div class='wpgmza_cat_checkbox_item_holder_first'>";
    //if ($show_all) { $ret_msg .= "<input type='checkbox' class='wpgmza_checkbox' id='wpgmza_cat_checkbox_0' name='wpgmza_cat_checkbox$array_suffix' mid=\"".$map_id."\" value=\"0\" /><label for='wpgmza_cat_checkbox_0'>".__("All","wp-google-maps")."</label>"; }
    //$ret_msg .= "</div>";
    
    $results = $wpdb->get_results($sql);
    $cat_link_text = sprintf( __( '<a href="%1$s">Create a category.</a>', 'wp-google-maps' ),
        admin_url("admin.php?page=wp-google-maps-menu-categories")
    );


    if (!$results && is_admin()) { return __("<em><small>No categories found</small></em>","wp-google-maps"). " <em><small>".$cat_link_text."</em></small>"; }
    if (!$results && !is_admin()) { return __("<em><small>No categories found</small></em>","wp-google-maps"); }


    /**
     * Builds the final category array that we will use to construct HTML
     * @var array
     */
    $category_array = array();

    foreach ( $results as $result ) {
        $category_array[$result->id] = array();

        $category_array[$result->id]['title'] = stripslashes($result->category_name);
        $category_array[$result->id]['id'] = $result->id;
        $category_array[$result->id]['retina'] = $result->retina;
        $category_array[$result->id]['active'] = $result->active;
        $category_array[$result->id]['parent_id'] = 0;
        $category_array[$result->id]['total_markers'] = wpgmza_return_marker_count_by_category( $result->id, $map_id );
        $category_array[$result->id]['children'] = false; /* set this to false by default */


        /* lets look for children */
        $continue = true;
        $parents_to_check = array();
        $parents_to_check[$result->id] = false;


        $safety_counter = 0;
        while ($continue) {
            $safety_counter++;
            if ($safety_counter > 1000) {
                break;
            }

            foreach ($parents_to_check as $current_parent_id => $has_been_checked) {
                if (!$has_been_checked) {
                    $sql = "SELECT * FROM `$wpgmza_tblname_categories` WHERE `active` = 0 AND `parent` = '".$current_parent_id."' ORDER BY `category_name` ASC";
                    
                    $child_results = $wpdb->get_results($sql);
                    if ($child_results) {

                        /* there are children */
                        foreach ( $child_results as $child_result ) {

                            $category_array[$child_result->id]['title'] = stripslashes($child_result->category_name);
                            $category_array[$child_result->id]['id'] = $child_result->id;
                            $category_array[$child_result->id]['retina'] = $child_result->retina;
                            $category_array[$child_result->id]['active'] = $child_result->active;
                            $category_array[$child_result->id]['parent_id'] = $current_parent_id;
                            $category_array[$child_result->id]['total_markers'] = wpgmza_return_marker_count_by_category( $child_result->id, $map_id );
                            $category_array[$child_result->id]['children'] = false; /* set this to false by default */

                            /* mark this ID as 'to be checked' within the loop */
                            $category_array[$current_parent_id]['children'][] = $child_result->id;
                            $parents_to_check[$child_result->id] = false;

                        }

                        /* mark this parent as 'checked' */
                       

                    } else {
                        /* no children left.. */
                    }
                    $parents_to_check[$current_parent_id] = true;

                    
                }
            }

            /* lets identify if we've gone through the enture checker array and marked everything as true. i.e. check if we are complete */
            $still_continue = false;
            foreach ($parents_to_check as $current_parent_id => $has_been_checked) {
                if (!$has_been_checked) { $still_continue = true; /* theres still categories to look at*/ }
            }
            if (!$still_continue) {
                $continue = false;
            }
            
        }


       

        
        //$ret_msg .= "<div class='wpgmza_cat_checkbox_item_holder wpgmza_cat_checkbox_item_holder_".$result->id."' ".$div_style."><input type='checkbox' class='wpgmza_checkbox' id='wpgmza_cat_checkbox_".$result->id."' name='wpgmza_cat_checkbox$array_suffix' mid=\"".$map_id."\" value=\"".$result->id."\" /><label for='wpgmza_cat_checkbox_".$result->id."'>".stripslashes($result->category_name)."</label></div>";
    }    


     /* build the tree */
    $tree = wpgmza_build_tree($category_array);


    global $wpmgza_cat_tree_html;
    $wpmgza_cat_tree_html = '';
    
    
    wpgmza_consume_tree($tree, $array_suffix, $map_id);

    $ret_msg.= $wpmgza_cat_tree_html;


    $ret_msg .= "</div>";
    
    return $ret_msg;

}


function wpgmza_return_marker_count_by_category( $cat_id = false, $map_id = false ) {

    if (!$cat_id || !$map_id)
        return 0;

    global $wpdb;
    global $wpgmza_tblname;
    $counter = 0;


    $wpgmza_sql1 = "SELECT `id`,`category` FROM $wpgmza_tblname WHERE `map_id` = '$map_id' AND `category` != '0'";

    $results = $wpdb->get_results($wpgmza_sql1);

    foreach ($results as $result) {
        $cat_check = explode(",", $result->category);
        
        foreach ($cat_check as $key => $cat_c) {
            if ($cat_c == $cat_id) {
                $counter++;
            }
        }

        
    }


    return intval($counter);

}

global $wpmgza_cat_tree_marker_counter;
$wpmgza_cat_tree_marker_counter = 0;

function wpgmza_return_marker_count_category_via_elements( $elements, $wpgmza_settings ) {
    if (isset($wpgmza_settings['wpgmza_settings_cat_display_qty']) && $wpgmza_settings['wpgmza_settings_cat_display_qty'] == 'yes' && !is_admin()) {
        global $wpmgza_cat_tree_marker_counter;
        $wpmgza_cat_tree_marker_counter = 0;
        wpgmza_tree_marker_counter( $elements, $wpgmza_settings );
        return "<span class='wpgmza_cat_count'>(".$wpmgza_cat_tree_marker_counter.")</span>";
    } else {
        return '';
    }
}

function wpgmza_tree_marker_counter( $elements, $wpgmza_settings ) {
    global $wpmgza_cat_tree_marker_counter;
    foreach($elements as $element){
        $marker_count = $element['total_markers'];
        $wpmgza_cat_tree_marker_counter += $marker_count;

        if (!isset($wpgmza_settings['wpgmza_settings_cat_logic']) || $wpgmza_settings['wpgmza_settings_cat_logic'] === "0") {
            /* only get the sub category count if the user has selected "OR" category logic in the settings */
            if(is_array($element['children'])){
                wpgmza_tree_marker_counter($element['children'], $wpgmza_settings);
            }
        }

    }
}


global $wpmgza_cat_tree_html;

function wpgmza_consume_tree(array $array,$array_suffix,$map_id) {

    $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");


    global $wpmgza_cat_tree_html;
    $wpmgza_cat_tree_html .= "<ul class='wpgmza_cat_ul wpgmza_cat_checkbox_item_holder'>";

    foreach($array as $key => $value){
        //If $value is an array.

        $wpmgza_cat_tree_html .= "<li class='wpgmza_cat_checkbox_item_holder wpgmza_cat_checkbox_item_holder_".$value['id']."'>";
        $wpmgza_cat_tree_html .= "<input type='checkbox' class='wpgmza_checkbox' id='wpgmza_cat_checkbox_".$value['id']."' name='wpgmza_cat_checkbox".$array_suffix."' mid=\"".$map_id."\" value=\"".$value['id']."\" />";
        $wpmgza_cat_tree_html .= "<label for='wpgmza_cat_checkbox_".$value['id']."'>".stripslashes($value['title'])." ".wpgmza_return_marker_count_category_via_elements(array(0=>$value), $wpgmza_settings)."</label>";

        if(is_array($value['children'])){
            wpgmza_consume_tree($value['children'], $array_suffix, $map_id);
        }
        $wpmgza_cat_tree_html .= "</li>";
    }

    $wpmgza_cat_tree_html .= "</ul>";

    
}

function wpgmza_consume_tree_dropdown(array $array,$array_suffix,$map_id, $ext_string = '') {

    $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");


    global $wpmgza_cat_tree_html;

    foreach($array as $key => $value){
        //If $value is an array.

        if ($value['parent_id'] == 0) {
            $ext_string = '';
        }

        $wpmgza_cat_tree_html .= "<option value=\"".$value['id']."\">".$ext_string.stripslashes($value['title'])." ".wpgmza_return_marker_count_category_via_elements(array(0=>$value), $wpgmza_settings)."</option>";


        
        
        if(is_array($value['children'])){
            $ext_string .= '&nbsp; ';
            wpgmza_consume_tree_dropdown($value['children'], $array_suffix, $map_id, $ext_string);
        }
    }
    $ext_string = '-';



    
}

function wpgmza_build_tree(array $elements, $parentId = 0) {
    $branch = array();

    foreach ($elements as $element) {
        if ($element['parent_id'] == $parentId) {
            $children = wpgmza_build_tree($elements, $element['id']);
            if ($children) {
                $element['children'] = $children;
            }
            $branch[] = $element;
        }
    }
    return $branch;
}

function wpgmza_pro_return_category_dropdown_list($map_id, $show_all = true, $array = false) {
    global $wpdb;
    global $wpgmza_tblname_categories;
    global $wpgmza_tblname_category_maps;

    if ($array) {
        $array_suffix = "[]";
    } else {
        $array_suffix = "";
    }

    $sql = "SELECT * FROM `$wpgmza_tblname_category_maps` LEFT JOIN `$wpgmza_tblname_categories` ON $wpgmza_tblname_category_maps.cat_id = $wpgmza_tblname_categories.id WHERE ( `map_id` = '$map_id' OR `map_id` = '0' ) AND `active` = 0 ORDER BY `category_name` ASC";

    $results = $wpdb->get_results($sql);

    $ret_msg .= "<select name='wpgmza_cat_checkbox'>";
    
    if ($show_all) {
        $ret_msg .= "<option id='wpgmza_cat_checkbox_0' name='wpgmza_cat_checkbox$array_suffix' mid=\"" . $map_id . "\" value=\"0\" />" . __("All", "wp-google-maps") . "</option>";
    }

    foreach ($results as $result) {
        $ret_msg .= "<option class='wpgmza_checkbox' id='wpgmza_cat_checkbox_" . $result->id . "' name='wpgmza_cat_checkbox' mid=\"" . $map_id . "\" value=\"" . $result->id . "\">" . stripslashes($result->category_name) . "</option>";
    }

    $ret_msg .= "</select>";

    $ret_msg .= "</div>";

    return $ret_msg;
}

function wpgmza_pro_return_category_blocks($map_id,$show_all = true,$array = false) {
    global $wpdb;
    global $wpgmza_tblname_categories;
    global $wpgmza_tblname_category_maps;
    if ($array) { $array_suffix = "[]"; } else { $array_suffix = ""; }
    $sql = "SELECT * FROM `$wpgmza_tblname_category_maps` WHERE `map_id` = '$map_id' OR `map_id` = '0'";
        $ret_msg = "<div style='display:block; overflow:hidden;'>";

    
    $results = $wpdb->get_results($sql);
    if (!$results) { return __("<em><small>No categories found</small></em>","wp-google-maps"); }
    foreach ( $results as $result ) {

        $cat_id = $result->cat_id;
    
        $results = $wpdb->get_results("
            SELECT *
            FROM `$wpgmza_tblname_categories`
            WHERE `active` = 0
            AND `id` = '$cat_id'
            ORDER BY `id` DESC
            ");
        foreach ( $results as $result ) {
            $ret_msg .= "<div class='wpgmza_cat_block' style='border: 1px solid #fff; box-shadow: 0 0 1px #a8c6c4; text-align: left; margin-bottom: 8px; font-family: 'museo_sans300'; font-size: 12px;  width: 159px; padding: 5px; color: #FFF;'><a href='javascript:void(0);' id='wpgmza_cat_block_".$result->id."' name='wpgmza_cat_block$array_suffix' mid=\"".$map_id."\" markerid=\"".$result->id."\" />".stripslashes( $result->category_name )."</a></div>";
        }
    
    }    
        $ret_msg .= "</div>";
    
    return $ret_msg;

}
function wpgmza_pro_return_maps_linked_to_cat($cat_id) {
    global $wpdb;
    global $wpgmza_tblname_category_maps;
    $ret_msg = "";
    
    $sql = "SELECT * FROM `$wpgmza_tblname_category_maps` WHERE `cat_id` = '$cat_id'";
    $results = $wpdb->get_results($sql);
    $cnt = count($results);
    $cnt_i = 1;
    foreach ( $results as $result ) {
        
        $map_id = $result->map_id;
        if ($map_id == 0) {
            $ret_msg .= "<a href=\"?page=wp-google-maps-menu\">".__("All maps","wp-google-maps")."</option>";
            return $ret_msg;
        } else { 
            $map_data = wpgmza_get_map_data($map_id);
            if ($cnt_i == $cnt) { $wpgmza_com = ""; } else { $wpgmza_com = ","; }
            $ret_msg .= "<a href=\"?page=wp-google-maps-menu&action=edit&map_id=".$map_id."\">".$map_data->map_title."</a>$wpgmza_com ";
        }
        $cnt_i++;
        
    }
    

    return $ret_msg;

}



function wpgmaps_list_categories() {

    global $wpdb;
    global $wpgmza_tblname_categories;

    $results = $wpdb->get_results("SELECT * FROM `$wpgmza_tblname_categories` WHERE `active` = 0 AND `parent` = '0' ORDER BY `category_name` ASC");
    $ret_msg = "<table class=\"wp-list-table widefat fixed striped pages\">";
    $ret_msg .= "  <thead>";
    $ret_msg .= "      <tr>";
    $ret_msg .= "          <th scope='col' width='100px' id='id' class='manage-column column-id' style=''>".__("ID","wp-google-maps")."</th>";
    $ret_msg .= "          <th scope='col' id='cat_cat' class='manage-column column-map_title'  style=''>".__("Category","wp-google-maps")."</th>";
    $ret_msg .= "          <th scope='col' id='cat_icon' class='manage-column column-map_width' style=\"\">".__("Icon","wp-google-maps")."</th>";
    $ret_msg .= "          <th scope='col' id='cat_linked' class='manage-column column-map_width' style=\"\">".__("Linked maps","wp-google-maps")."</th>";
    $ret_msg .= "      </tr>";
    $ret_msg .= "  </thead>";
    $ret_msg .= "<tbody id=\"the-list\" class='list:wp_list_text_link'>";

    
    /**
     * Builds the final category array that we will use to construct HTML
     * @var array
     */
    $category_array = array();

    foreach ( $results as $result ) {
        $category_array[$result->id] = array();

        $category_array[$result->id]['title'] = stripslashes($result->category_name);
        $category_array[$result->id]['id'] = $result->id;
        $category_array[$result->id]['retina'] = $result->retina;
        $category_array[$result->id]['active'] = $result->active;
        $category_array[$result->id]['category_icon'] = $result->category_icon;
        $category_array[$result->id]['parent_id'] = 0;
        $category_array[$result->id]['total_markers'] = wpgmza_return_marker_count_by_category( $result->id, false );
        $category_array[$result->id]['children'] = false; /* set this to false by default */


        /* lets look for children */
        $continue = true;
        $parents_to_check = array();
        $parents_to_check[$result->id] = false;


        $safety_counter = 0;
        while ($continue) {
            $safety_counter++;
            if ($safety_counter > 1000) {
                break;
            }

            foreach ($parents_to_check as $current_parent_id => $has_been_checked) {
                if (!$has_been_checked) {
                    $sql = "SELECT * FROM `$wpgmza_tblname_categories` WHERE `active` = 0 AND `parent` = '".$current_parent_id."' ORDER BY `category_name` ASC";
                    
                    $child_results = $wpdb->get_results($sql);
                    if ($child_results) {

                        /* there are children */
                        foreach ( $child_results as $child_result ) {

                            $category_array[$child_result->id]['title'] = stripslashes($child_result->category_name);
                            $category_array[$child_result->id]['id'] = $child_result->id;
                            $category_array[$child_result->id]['retina'] = $child_result->retina;
                            $category_array[$child_result->id]['active'] = $child_result->active;
                            $category_array[$child_result->id]['category_icon'] = $child_result->category_icon;
                            $category_array[$child_result->id]['parent_id'] = $current_parent_id;
                            $category_array[$child_result->id]['total_markers'] = wpgmza_return_marker_count_by_category( $child_result->id, false );
                            $category_array[$child_result->id]['children'] = false; /* set this to false by default */

                            /* mark this ID as 'to be checked' within the loop */
                            $category_array[$current_parent_id]['children'][] = $child_result->id;
                            $parents_to_check[$child_result->id] = false;

                        }

                        /* mark this parent as 'checked' */
                       

                    } else {
                        /* no children left.. */
                    }
                    $parents_to_check[$current_parent_id] = true;

                    
                }
            }

            /* lets identify if we've gone through the enture checker array and marked everything as true. i.e. check if we are complete */
            $still_continue = false;
            foreach ($parents_to_check as $current_parent_id => $has_been_checked) {
                if (!$has_been_checked) { $still_continue = true; /* theres still categories to look at*/ }
            }
            if (!$still_continue) {
                $continue = false;
            }
            
        }


       

        
        //$ret_msg .= "<div class='wpgmza_cat_checkbox_item_holder wpgmza_cat_checkbox_item_holder_".$result->id."' ".$div_style."><input type='checkbox' class='wpgmza_checkbox' id='wpgmza_cat_checkbox_".$result->id."' name='wpgmza_cat_checkbox$array_suffix' mid=\"".$map_id."\" value=\"".$result->id."\" /><label for='wpgmza_cat_checkbox_".$result->id."'>".stripslashes($result->category_name)."</label></div>";
    }    


     /* build the tree */

    $tree = array();
    $tree = wpgmza_build_tree($category_array);

    global $wpmgza_cat_tree_html;
    $wpmgza_cat_tree_html = '';
    
    
    wpgmza_consume_tree_main_list($tree, "", false, '');

    $ret_msg.= $wpmgza_cat_tree_html;
    $ret_msg .= "</tbody>";
    $ret_msg .= "</table>";

    
    echo $ret_msg;

}

function wpgmza_consume_tree_main_list(array $array,$array_suffix,$map_id, $ext_string = '') {

    $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");


    global $wpmgza_cat_tree_html;

    foreach($array as $key => $value) {


        $trashlink = "| <a href=\"?page=wp-google-maps-menu-categories&action=trash&cat_id=".$value['id']."\" title=\"Trash\">".__("Trash","wp-google-maps")."</a>";


        $wpmgza_cat_tree_html .=  "<tr id=\"record_".$value['id']."\">";
        $wpmgza_cat_tree_html .=  "  <td class='id column-id'>".$value['id']."</td>";
        $wpmgza_cat_tree_html .=  "  <td class='column-map_title'><strong><big><a href=\"?page=wp-google-maps-menu-categories&action=edit&cat_id=".$value['id']."\" title=\"".__("Edit","wp-google-maps")."\">".$ext_string.stripslashes($value['title'])."</a></big></strong><br /><a href=\"?page=wp-google-maps-menu-categories&action=edit&cat_id=".$value['id']."\" title=\"".__("Edit","wp-google-maps")."\">".__("Edit","wp-google-maps")."</a> $trashlink</td>";
        $wpmgza_cat_tree_html .=  "  <td class='column-map_width'><img src=\"".$value['category_icon']."\" style=\"max-width:100px; max-height:100px;\" /></td>";
        $wpmgza_cat_tree_html .=  "  <td class='column-map_width'>".wpgmza_pro_return_maps_linked_to_cat($value['id'])."</td>";
        $wpmgza_cat_tree_html .=  "</tr>";

        //If $value is an array.

        if ($value['parent_id'] == 0) {
            $ext_string = '';
        }

        
        if(is_array($value['children'])){
            $ext_string .= '— ';
            wpgmza_consume_tree_main_list($value['children'], $array_suffix, $map_id, $ext_string);
        }
    }
    $ext_string = '-';



    
}

function old_wpgmaps_list_categories() {
    global $wpdb;
    global $wpgmza_tblname_categories;

    $results = $wpdb->get_results("SELECT * FROM `$wpgmza_tblname_categories` WHERE `active` = 0 ORDER BY `category_name` ASC");
    echo "<table class=\"wp-list-table widefat fixed striped pages\">";
    echo "  <thead>";
    echo "      <tr>";
    echo "          <th scope='col' width='100px' id='id' class='manage-column column-id' style=''>".__("ID","wp-google-maps")."</th>";
    echo "          <th scope='col' id='cat_cat' class='manage-column column-map_title'  style=''>".__("Category","wp-google-maps")."</th>";
    echo "          <th scope='col' id='cat_icon' class='manage-column column-map_width' style=\"\">".__("Icon","wp-google-maps")."</th>";
    echo "          <th scope='col' id='cat_parent' class='manage-column column-map_width' style=\"\">".__("Parent","wp-google-maps")."</th>";
    echo "          <th scope='col' id='cat_linked' class='manage-column column-map_width' style=\"\">".__("Linked maps","wp-google-maps")."</th>";
    echo "      </tr>";
    echo "  </thead>";
    echo "<tbody id=\"the-list\" class='list:wp_list_text_link'>";

    foreach ( $results as $result ) {
        $trashlink = "| <a href=\"?page=wp-google-maps-menu-categories&action=trash&cat_id=".$result->id."\" title=\"Trash\">".__("Trash","wp-google-maps")."</a>";

        if ($result->parent > 0) {
            $parent_data = wpgmza_return_category_data( $result->parent );
            $parent_link = admin_url('admin.php?page=wp-google-maps-menu-categories&action=edit&cat_id='.$result->parent);
            $parent_title = "<a href='".$parent_link."'>".stripslashes( $parent_data->category_name )."</a>";
        } else {
            $parent_title = '';
        }

        echo "<tr id=\"record_".$result->id."\">";
        echo "  <td class='id column-id'>".$result->id."</td>";
        echo "  <td class='column-map_title'><strong><big><a href=\"?page=wp-google-maps-menu-categories&action=edit&cat_id=".$result->id."\" title=\"".__("Edit","wp-google-maps")."\">".stripslashes( $result->category_name )."</a></big></strong><br /><a href=\"?page=wp-google-maps-menu-categories&action=edit&cat_id=".$result->id."\" title=\"".__("Edit","wp-google-maps")."\">".__("Edit","wp-google-maps")."</a> $trashlink</td>";
        echo "  <td class='column-map_width'><img src=\"".$result->category_icon."\" style=\"max-width:100px; max-height:100px;\" /></td>";
        echo "  <td class='column-map_width'>".$parent_title."</td>";
        echo "  <td class='column-map_width'>".wpgmza_pro_return_maps_linked_to_cat($result->id)."</td>";
        echo "</tr>";
    }
    echo "</table>";
}


function wpgmaps_trash_cat( $cat_id ) {
    global $wpdb;
    global $wpgmza_tblname_categories;
    global $wpgmza_tblname_category_maps;
    if ( isset( $cat_id ) ) {
        $rows_affected = $wpdb->query( $wpdb->prepare( "UPDATE $wpgmza_tblname_categories SET active = %d WHERE id = %d", 1, $cat_id) );
        $rows_affected = $wpdb->query( $wpdb->prepare( "DELETE FROM $wpgmza_tblname_category_maps WHERE cat_id = %d", $cat_id) );
        return true;
    } else {
        return false;
    }
}

/**
 * Return all category data from the table row that matches
 * 
 * @param  intval $cat_id   Category ID
 * @return array|boolean    Array if there is data or FALSE if not
 */
function wpgmza_return_category_data( $cat_id ) {
    global $wpgmza_tblname_categories;
    global $wpdb;
    $result = $wpdb->get_row( "SELECT * FROM `".$wpgmza_tblname_categories."` WHERE `id` = '".intval( $cat_id )."' AND `active` = 0 LIMIT 1" );
    return $result;
}


/**
 * Return all active categories
 *
 * @param  intval           $map_id    Map ID (optional)
 * @param  intval           $active    0 = active, 1 = deleted 
 * @return array|boolean               Array if there is data or FALSE if not
 */
function wpgmza_return_all_categories( $map_id = false, $active = 0 ) {
    global $wpdb;
    global $wpgmza_tblname_categories;
    global $wpgmza_tblname_category_maps;    

    if ( !$map_id ) {
        /* get all category data for all maps */
        $results = $wpdb->get_results("SELECT * FROM `".$wpgmza_tblname_categories."` WHERE `active` = ".$active." ORDER BY `id` DESC");
    } else {
        /* get all category data for a specific map */

        $sql = "

        SELECT $wpgmza_tblname_category_maps.* , $wpgmza_tblname_categories.*
        FROM $wpgmza_tblname_category_maps LEFT JOIN $wpgmza_tblname_categories

        ON $wpgmza_tblname_category_maps.cat_id = $wpgmza_tblname_categories.id  
        WHERE  ($wpgmza_tblname_category_maps.map_id = 0 OR $wpgmza_tblname_category_maps.map_id = $map_id) 
        AND `active` = $active  
       ";
        
        $results = $wpdb->get_results($sql);
    }
    return $results;
}


/**
 * Returns an array of category data for the specific map (parents and children)
 * @param  intval $map_id Map ID
 * @return array
 */
function wpgmza_get_category_localized_data( $map_id ) {
    if ( !$map_id )
        return;

    
    $cat_data = wpgmza_return_all_categories( $map_id, 0 );
    return $cat_data;

}