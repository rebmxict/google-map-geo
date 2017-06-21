<?php

/* METHODS AVAILABLE: 
 * export_map
 * export_map( $mapid )
 * export_markers
 * export_polygons
 * export_polylines
 * import_maps
 * import_polygons
 * import_polylines
 */

class WPGMapsImportExport{

	public function __construct(){

	}

	public function export_map( $mapid = false ){

		if( $mapid ){

			/**
			 * Export a single map
			 */

			global $wpdb;

	    	$query = "SELECT * FROM `{$wpdb->prefix}wpgmza_maps` WHERE `id` = '$mapid'";

	        $results = $wpdb->get_row( $query, ARRAY_A );

	        $map_data = array();

	        foreach( $results as $key => $val ){
	        	if( $key == 'other_settings' )
	        		continue;
	        	$map_data[$key] = $val;
	        }

	        $other_results = maybe_unserialize( $results['other_settings'] );

	        foreach( $other_results as $key => $val ){
	        	$map_data['other_'.$key] = $val;
	        }

	        $fileName = $wpdb->prefix.'export_map_'.$mapid.'.csv';

	        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	        header('Content-Description: File Transfer');
	        header("Content-type: text/csv");
	        header("Content-Disposition: attachment; filename={$fileName}");
	        header("Expires: 0");
	        header("Pragma: public");
	        $fh = @fopen( 'php://output', 'w' );

            fputcsv($fh, array_keys($map_data), ",", '"');
            fputcsv($fh, $map_data, ",", '"');

	        fclose($fh);

	        exit();

		} else {

			/**
			 * Export all maps
			 */

			global $wpdb;

	    	$query = "SELECT * FROM `{$wpdb->prefix}wpgmza_maps`";

	        $results = $wpdb->get_results( $query, ARRAY_A );

	        $map_data = array();

	        $headerDisplayed = false;

	        foreach( $results as $key => $val ){

        		$map_data[$key] = $val;
        		//$other_settings = maybe_unserialize( $val['other_settings'] );
        		//if (is_array($other_settings)) {
		        //	foreach( $other_settings as $set => $setval ){
	        	//		$map_data[$key]['other_'.$set] = $setval;
		        //	}
		        //}

        		//unset($map_data[$key]['other_settings']);

	        }

	        $fileName = $wpdb->prefix.'export_maps.csv';

	        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	        header('Content-Description: File Transfer');
	        header("Content-type: text/csv");
	        header("Content-Disposition: attachment; filename={$fileName}");
	        header("Expires: 0");
	        header("Pragma: public");

	        $fh = @fopen( 'php://output', 'w' );

            foreach( $map_data as $map ){

            	if( !$headerDisplayed ){
	            	fputcsv($fh, array_keys($map), ",", '"');
	            	$headerDisplayed = true;
	            }  

            	fputcsv($fh, $map, ",", '"');

            }            

	        fclose($fh);

	        exit();

		}

	}

	public function export_markers(){

		global $wpdb;
        
        $fileName = $wpdb->prefix.'wpgmza.csv';
        
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Description: File Transfer');
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename={$fileName}");
        header("Expires: 0");
        header("Pragma: public");
        
        $fh = @fopen( 'php://output', 'w' );
        
        $query = "SELECT * FROM `{$wpdb->prefix}wpgmza`";
        
        $results = $wpdb->get_results( $query, ARRAY_A );
        
        $headerDisplayed = false;
        
        foreach ( $results as $data ) {
            // Add a header row if it hasn't been added yet
            if ( !$headerDisplayed ) {
                // Use the keys from $data as the titles
                fputcsv($fh, array_keys($data), ",", '"');
                $headerDisplayed = true;
            }
            // Put the data into the stream
            fputcsv($fh, $data, ",", '"');
        }

        // Close the file
        fclose($fh);

        // Make sure nothing else is sent, our file is done
        exit;

	}

	public function export_polygons(){

		global $wpdb;		

		$query = "SELECT * FROM `{$wpdb->prefix}wpgmza_polygon`";

		$results = $wpdb->get_results( $query, ARRAY_A );

        $headerDisplayed = false;

        $fileName = $wpdb->prefix.'wpgmza_polygons.csv';

        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Description: File Transfer');
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename={$fileName}");
        header("Expires: 0");
        header("Pragma: public");
        
        $fh = @fopen( 'php://output', 'w' );
        
        foreach ( $results as $data ) {
            // Add a header row if it hasn't been added yet
            if ( !$headerDisplayed ) {
                // Use the keys from $data as the titles
                fputcsv($fh, array_keys($data), ",", '"');
                $headerDisplayed = true;
            }
            // Put the data into the stream
            fputcsv($fh, $data, ",", '"');
        }

        // Close the file
        fclose($fh);

        // Make sure nothing else is sent, our file is done
        exit;

	}

	public function export_polylines(){

		global $wpdb;		

		$query = "SELECT * FROM `{$wpdb->prefix}wpgmza_polylines`";

		$results = $wpdb->get_results( $query, ARRAY_A );

        $headerDisplayed = false;

        $fileName = $wpdb->prefix.'wpgmza_polylines.csv';

        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header('Content-Description: File Transfer');
        header("Content-type: text/csv");
        header("Content-Disposition: attachment; filename={$fileName}");
        header("Expires: 0");
        header("Pragma: public");
        
        $fh = @fopen( 'php://output', 'w' );
        
        foreach ( $results as $data ) {
            // Add a header row if it hasn't been added yet
            if ( !$headerDisplayed ) {
                // Use the keys from $data as the titles
                fputcsv($fh, array_keys($data), ",", '"');
                $headerDisplayed = true;
            }
            // Put the data into the stream
            fputcsv($fh, $data, ",", '"');
        }

        // Close the file
        fclose($fh);

        // Make sure nothing else is sent, our file is done
        exit;

	}

	public function import_markers(){

		if (is_uploaded_file($_FILES['wpgmza_csvfile']['tmp_name'])) {
	        ini_set("auto_detect_line_endings", true);
	        global $wpdb;
	        global $wpgmza_tblname;
	        $handle = fopen($_FILES['wpgmza_csvfile']['tmp_name'], "r");
	        $header = fgetcsv($handle);

	        unset ($wpgmza_errormsg);
	        if ($header[0] != "id") { $wpgmza_errormsg = __("Header 1 should be 'id', not","wp-google-maps")." '$header[0]'<br />"; }
	        if ($header[1] != "map_id") { $wpgmza_errormsg .= __("Header 2 should be 'map_id', not","wp-google-maps")." '$header[1]'<br />"; }
	        if ($header[2] != "address") { $wpgmza_errormsg .= __("Header 3 should be 'address', not","wp-google-maps")." '$header[2]'<br />"; }
	        if ($header[3] != "description") { $wpgmza_errormsg .= __("Header 4 should be 'description', not","wp-google-maps")." '$header[3]'<br />"; }
	        if ($header[4] != "pic") { $wpgmza_errormsg .= __("Header 5 should be 'pic', not","wp-google-maps")." '$header[4]'<br />"; }
	        if ($header[5] != "link") { $wpgmza_errormsg .= __("Header 6 should be 'link', not","wp-google-maps")." '$header[5]'<br />"; }
	        if ($header[6] != "icon") { $wpgmza_errormsg .= __("Header 7 should be 'icon', not","wp-google-maps")." '$header[6]'<br />"; }
	        if ($header[7] != "lat") { $wpgmza_errormsg .= __("Header 8 should be 'lat', not","wp-google-maps")." '$header[7]'<br />"; }
	        if ($header[8] != "lng") { $wpgmza_errormsg .= __("Header 9 should be 'lng', not","wp-google-maps")." '$header[8]'<br />"; }
	        if ($header[9] != "anim") { $wpgmza_errormsg .= __("Header 10 should be 'anim', not","wp-google-maps")." '$header[9]'<br />"; }
	        if ($header[10] != "title") { $wpgmza_errormsg .= __("Header 11 should be 'title', not","wp-google-maps")." '$header[10]'<br />"; }
	        if ($header[11] != "infoopen") { $wpgmza_errormsg .= __("Header 12 should be 'infoopen', not","wp-google-maps")." '$header[11]'<br />"; }
	        if ($header[12] != "category") { $wpgmza_errormsg .= __("Header 13 should be 'category', not","wp-google-maps")." '$header[12]'<br />"; }
	        if ($header[13] != "approved") { $wpgmza_errormsg .= __("Header 14 should be 'approved', not","wp-google-maps")." '$header[13]'<br />"; }
	        if ($header[14] != "retina") { $wpgmza_errormsg .= __("Header 15 should be 'retina', not","wp-google-maps")." '$header[14]'<br />"; }
	        if (isset($wpgmza_errormsg)) {
	            echo "<div class='error below-h2'>".__("CSV import failed","wp-google-maps")."!<br /><br />$wpgmza_errormsg</div>";

	        }
	        else {
	            
	            if (isset($_POST['wpgmza_geocode']) && $_POST['wpgmza_geocode'] == "Yes" && !$_POST['wpgmza_api_key']) {
	                echo '<div class="error below-h1">Please enter a Google Maps Geocoding API key</div>';
	                return;
	            } else { 
	                
	                update_option("wpgmza_geocode_api_key",$_POST['wpgmza_api_key']);
	            
	                $lline = 0;
	                while(! feof($handle)){

	                    if (isset($_POST['wpgmza_csvreplace']) && $_POST['wpgmza_csvreplace'] == "Yes") { $wpdb->query("TRUNCATE TABLE $wpgmza_tblname"); }
	                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

	                    // do a Gmap lookup if we're missing geocode coordinates
	            		$lline++;
	                    if ( empty($data[7]) || empty($data[8]) ){
	                    		if (isset($_POST['wpgmza_geocode']) && $_POST['wpgmza_geocode'] == "Yes") {

		                           // check if cURL is available
		                          if ( function_exists('curl_version') ) {
		                                   // Add your GOogle API key here, or you won't receive a result from Google
		                                    $googlekey = $_POST['wpgmza_api_key'];
		                                    if (!$googlekey) { 
		                                        echo '<div class="error below-h1">Please enter a Google Maps Geocoding API key</div>';
		                                        return;

		                                    } else {

		                                    $address = utf8_encode( urlencode( $data[2] ) );

		                                    $url = "https://maps.googleapis.com/maps/api/geocode/json?sensor=true&key=". $googlekey ."&address=" . $address;
		                                    $curl = curl_init($url);
		                                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
		                                    curl_setopt($curl, CURLOPT_REFERER, $_SERVER['HTTP_HOST']);
		                                    curl_setopt($curl, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
		                                    $output = curl_exec($curl);
		                                    var_dump($output);
		                                    curl_close($curl);

		                                    // echo "Lookup on url $url<br>";
		                                    if (empty($output)){
		                                            echo "No data from lookup: $url<br>";
		                                            continue;
		                                    } else {
		                                            // echo '<div style="height:200px;width:400px;">' . print_r($output) . '</div>';
		                                    }

		                                    // probably should do some error checking here
		                                    $decoded = json_decode($output);
		                                    if ($decoded->status != "OK") { echo "Unable to get location data for <a href='$url'>" . $address . "</a> <br>"; var_dump($decoded); continue; }
		                                    $lat = $decoded->results[0]->geometry->location->lat;
		                                    $lng = $decoded->results[0]->geometry->location->lng;
		                                    echo "Lookup on address: " . $address . " decoded to: $lat, $lng<br>";

		                                    // set the data and continue
		                                    $data[7] = ! empty( $lat ) ? $lat : "";
		                                    $data[8] = ! empty( $lng ) ? $lng : "";

		                                    // add some time (1.2/10 second) between requests to keep them under 10 per second: 
		                                    usleep(12000);
		                                    }

		                            } else {
		                                    echo '<div class="error below-h2">curl is not installed; unable to lookup Google coordinates.</div>';
		                                    return;
		                            }
		                        } else {
		                        	echo "<div class=\"notice notice-error\">".sprintf(__("Cannot import line %d as the LAT and/or LNG is not defined.","wp-google-maps"),$lline)."</div>";
		                        }
	                    }

	                    // make sure http:// is in URL field
	                    if ( ! empty($data[5]) && strpos($data[5], "http://")) $data[5] = "http://" . $data[5];

	                        $ra = $wpdb->insert( $wpgmza_tblname, array(
	                            $header[1] => $data[1],
	                            $header[2] => $data[2],
	                            $header[3] => $data[3],
	                            $header[4] => $data[4],
	                            $header[5] => $data[5],
	                            $header[6] => $data[6],
	                            $header[7] => $data[7],
	                            $header[8] => $data[8],
	                            $header[9] => $data[9],
	                            $header[10] => $data[10],
	                            $header[11] => $data[11],
	                            $header[12] => $data[12],
	                            $header[13] => $data[13],
	                            $header[14] => $data[14]
	                            )
	                        );
	                    }
	                }
	                fclose($handle);
	            }
	       
		       echo "<div class='updated'>".__("Your CSV file has been successfully imported","wp-google-maps")."</div>";
	        }
	    }

	}

	public function import_maps(){

		global $wpdb;

		if (is_uploaded_file($_FILES['wpgmza_csv_map_import']['tmp_name'])) {
			ini_set("auto_detect_line_endings", true);
			
			$handle = fopen($_FILES['wpgmza_csv_map_import']['tmp_name'], "r");

	        // $handle = fopen(plugins_url().'/wp-google-maps-pro/maps.csv', "r");

	        $header = fgetcsv($handle);
	        
	        $array_data = array();
	        $values = array();
			$the_array = array();
			$joint = array();
			$other_settings_array = array();
			$modified_other_settings = array();
			$header_array = array();

	        while(! feof( $handle ) ){
	        	while ( ( $data = fgetcsv( $handle, 1000, "," ) ) !== FALSE ){
	        		$array_data[] = $data;
			    }
			}
			foreach( $header as $head => $er ){
				$header_array[$er] = '';
			}

			$cnt = 0;

			foreach( $array_data as $map_data ){
				foreach( $map_data as $key => $val ){
					$values[] = $val;
				}
				foreach( $header_array as $head_key => $head_value ){
					$the_array[$head_key] = $values[$cnt];
					$cnt++;
				}
				$joint[] = $the_array;

				//$cnt = 0;
			}

			$array_size = count( $the_array );

			$replace_current_map_data = false;
			//var_dump($_POST['wpgmza_csvreplace_map']);
			if (isset($_POST['wpgmza_csvreplace_map']) && $_POST['wpgmza_csvreplace_map'] == "Yes" ) {
				$replace_current_map_data = true;
			}

			if( $replace_current_map_data ){

				$wpdb->query("TRUNCATE TABLE `".$wpdb->prefix."wpgmza_maps`");

			}

			foreach( $joint as $join ){
				$sql = "";

				$sql .= "INSERT INTO `".$wpdb->prefix."wpgmza_maps` SET ";

				$tmp_cnt = 0;
				foreach( $join as $key => $val ){
					
					if( !$replace_current_map_data ){
						
						if( $key == 'id' ){
							$sql .= "";
							
						
							/*if (strpos($key, 'other_') !== false) {
								$other_settings_array[$key] = $val;
							} else {
								$sql .= "";
							}*/
						} else {
							$tmp_cnt++;
							if ($tmp_cnt == 1) {
								$sql .= "`$key` = '$val' ";
							} else {
								$sql .= ",`$key` = '$val' ";

							}


							/*	if (strpos($key, 'other_') !== false) {
									$other_settings_array[$key] = $val;
								} else {
									$sql .= "`$key` = '$val', ";
								}*/
						}
					} else {
						$tmp_cnt++;
						if ($tmp_cnt == 1) {
							$sql .= "`$key` = '$val' ";
						} else {
							$sql .= ",`$key` = '$val' ";

						}
						/*if (strpos($key, 'other_') !== false) {
							$other_settings_array[$key] = $val;
						} else {
							$sql .= "`$key` = '$val', ";
						}*/
					}	
					
					/*foreach( $other_settings_array as $key => $val ){
						$key = str_replace('other_', '', $key);
						$modified_other_settings[$key] = $val;
					}*/
				}
				
				//$other_settings = maybe_serialize( $modified_other_settings );

				//$sql .= "`other_settings` = '$other_settings'; ";	
				echo $sql;
				
				$wpdb->Query($sql);
			}		

		}	

        echo "<div class='updated'>".__("Your CSV file has been successfully imported","wp-google-maps")."</div>";
        
	}

	public function import_polylines(){

		global $wpdb;

		if (is_uploaded_file($_FILES['wpgmza_csv_polylines_import']['tmp_name'])) {
			ini_set("auto_detect_line_endings", true);
			$handle = fopen($_FILES['wpgmza_csv_polylines_import']['tmp_name'], "r");

	        // $handle = fopen(plugins_url().'/wp-google-maps-pro/polylines.csv', "r");

	        $header = fgetcsv($handle);
	        
	        $array_data = array();
	        $values = array();
			$the_array = array();
			$joint = array();
			$header_array = array();

	        while(! feof( $handle ) ){
	        	while ( ( $data = fgetcsv( $handle, 1000, "," ) ) !== FALSE ){
	        		$array_data[] = $data;
			    }
			}
				
			foreach( $header as $head => $er ){
				$header_array[$er] = '';
			}

			$cnt = 0;

			foreach( $array_data as $map_data ){
				foreach( $map_data as $key => $val ){
					$values[] = $val;
				}
				foreach( $header_array as $head_key => $head_value ){
					$the_array[$head_key] = $values[$cnt];
					$cnt++;
				}
				$joint[] = $the_array;
			}

			$replace_current_map_data = false;
			if (isset($_POST['wpgmza_csvreplace_polyline']) && $_POST['wpgmza_csvreplace_polyline'] == "Yes" ) { $replace_current_map_data = true; }
			if( $replace_current_map_data ){ $wpdb->query("TRUNCATE TABLE `".$wpdb->prefix."wpgmza_polylines`"); }

			$array_size_count = 1;

			foreach( $joint as $join ){
				$sql = "";

				$sql .= "INSERT INTO `".$wpdb->prefix."wpgmza_polylines` SET ";
				$array_size = count( $join );

				foreach( $join as $key => $val ){
					if( $key == 'id' ){
						$sql .= "";
					} else {
						if( $array_size_count == $array_size ){
							$sql .= "`$key` = '$val' ";
						} else {
							$sql .= "`$key` = '$val', ";	
						}
						
					}

					$array_size_count++;

				}

				$wpdb->Query($sql);

				$array_size_count = 1;

			}
		}			

        echo "<div class='updated'>".__("Your CSV file has been successfully imported","wp-google-maps")."</div>";

	}

	public function import_polygons(){

		global $wpdb;

		if (is_uploaded_file($_FILES['wpgmza_csv_polygons_import']['tmp_name'])) {
			ini_set("auto_detect_line_endings", true);
			$handle = fopen($_FILES['wpgmza_csv_polygons_import']['tmp_name'], "r");

	        $header = fgetcsv($handle);
	        
	        $array_data = array();
	        $values = array();
			$the_array = array();
			$joint = array();
			$header_array = array();

	        while(! feof( $handle ) ){
	        	while ( ( $data = fgetcsv( $handle, 1000, "," ) ) !== FALSE ){
	        		$array_data[] = $data;
			    }
			}
				
			foreach( $header as $head => $er ){
				$header_array[$er] = '';
			}

			$cnt = 0;

			foreach( $array_data as $map_data ){
				foreach( $map_data as $key => $val ){
					$values[] = $val;
				}
				foreach( $header_array as $head_key => $head_value ){
					$the_array[$head_key] = $values[$cnt];
					$cnt++;
				}
				$joint[] = $the_array;
			}

			$replace_current_map_data = false;
			if (isset($_POST['wpgmza_csvreplace_polygon']) && $_POST['wpgmza_csvreplace_polygon'] == "Yes" ) { $replace_current_map_data = true; }
			if( $replace_current_map_data ){ $wpdb->query("TRUNCATE TABLE `".$wpdb->prefix."wpgmza_polygon`"); }


			$array_size_count = 1;

			foreach( $joint as $join ){
				$sql = "";

				$sql .= "INSERT INTO `".$wpdb->prefix."wpgmza_polygon` SET ";
				$array_size = count( $join );

				foreach( $join as $key => $val ){
					if( $key == 'id' ){
						$sql .= "";
					} else {
						if( $array_size_count == $array_size ){
							$sql .= "`$key` = '$val' ";
						} else {
							$sql .= "`$key` = '$val', ";	
						}
						
					}

					$array_size_count++;

				}


				$wpdb->Query($sql);

				$array_size_count = 1;

			}

		}			

        echo "<div class='updated'>".__("Your CSV file has been successfully imported","wp-google-maps")."</div>";

	}
}