<?php
/*
Plugin Name: WP Google Maps - Pro Add-on
Plugin URI: http://www.wpgmaps.com
Description: This is the Pro add-on for WP Google Maps. The Pro add-on enables you to add descriptions, pictures, links and custom icons to your markers as well as allows you to download your markers to a CSV file for quick editing and re-upload them when complete.
Version:  6.13
Author: WP Google Maps
Author URI: http://www.wpgmaps.com
 * 
 * 6.13 - 2017-01-26 - Medium priority
 * Fixed the bug that caused the directions box to show up automatically if waypoints are being used in the shortcode
 * Fixed a bug that caused the Google Maps API call to be added to all pages
 * 
 * 6.12 - 2017-01-24 - Medium priority
 * Direction waypoint functionality added via shortcode. Example: [wpgmza id='1' directions_from='New York' directions_to='Los Angeles' directions_waypoints='Wisconsin|Texas' directions_auto='true']
 * Fixed bug that caused our JS to be enqueued on all pages
 *
 * 6.11 - 2017-01-19 - Medium priority
 * Fixed PHP warning bugs
 * Added sub-category functionality
 *  - You can now add sub-categories (infinite levels)
 *  - You can now choose to use "AND" or "OR" logic when selecting and markers based on your category selection
 *  - You can now choose to show/hide marker counts per category on the front end
 * Fixed a bug that caused marker lists to not be updated correctly when using mashups
 * 
 * 
 * 6.10 - 2017-01-13 - Medium priority
 * Fixed a bug that caused multiple maps to stop working
 * Fixed a bug that caused markers to not display when using the XML data method
 * Fixed a bug that caused slashes to appear in category names with apostrophes
 * UI improvements to the marker listing buttons in the admin section
 * 
 * 6.09 - 2017-01-11 - Medium priority
 * Moved all echoed out JS variables to localized variables - this will also fix issues with single quotes and double quotes with some translated strings that are pushed to JS variables
 * Enqueued the Google Maps API with wp_enqueue_script instead of using document.write() which caused console warnings
 * Moved the map stylesheet to the footer and fixed the invalid W3C in-line styling
 * Refactored some JS code in the core.js file to suit the new localized JS variables 
 * Added Gesture Override (Two Finger Override)
 * Added Compat for Custom Cluster Options
 * Added a new attribute to the shortcode handler that allows you to focus on a specific marker. Example: [wpgmza id='1' marker='5' zoom='13']
 * Added a new attribute that allows you to disable directions via the shortcode. Example: [wpgzma id='1' enable_directions='0'] (disables directions)
 * Added a new attribute that allows you to disable category filtering via the shortcode. Example: [wpgzma id='1' enable_category='0'] (disables category filtering)
 * Added a new attribute that allows you to open marker infowindow links in a new window (override global settings) via the shortcode. Example: [wpgzma id='1' new_window_link='yes']
 * You can now disable the display of the VGM form by using disable_vgm_form='1' within the shortcode
 * Fixed a bug that caused the map to display at the top of the page where the shortcode was used
 * Fixed a bug that added slashes to category names with quotation marks
 * Fixed a bug that caused non-utf8 characters within an address to cause the insertion of the marker to fail
 * 
 * 6.08 - 2016-10-27 - Medium priority
 * Fixed a bug that caused a JS error in the admin section when adding or editing a marker (dataTables)
 * You can now add a default address to your store locator
 * Full screen map functionality added
 * Fixed a bug that caused PHP warnings when a polygon or polyline had no polydata
 * JS and short code refactoring
 * Updated DataTables.js and DataTables.min.js
 * Removed unnecessary anchor tags for each marker
 * 
 * 
 * 6.07 - 2016-09-15 - Medium priority
 * Fixed markup bugs in the admin section
 * UI improvements to the add/edit marker section
 * New feature: Set your markers to be hidden on the front end and only show in the backend
 * Fixed a bug that caused the map error to flash before the map loaded on the front end
 * Fixed a bug that caused a PHP warning when trying to delete a category
 * Fixed a bug whereby the map category-map link data was not actually deleted in the table when deleting a category
 * Fixed a bug that caused deleted categories to show up in the category filtering functionality
 * Added labels to the category checkboxes on the front end
 * Datatables updated
 * When a marker is deleted, the view does not reset
 * You can now set the zoom level via the shortcode. Example: [wpgmza id='1' zoom=8]
 * 
 * 6.06 - 2016-08-04 - Low priority
 * Store locator bug fixed
 * 
 * 6.05 - 2016-08-01 - Medium priority
 * Fixed a bug that stripped out all HTML from the marker description when editing
 * Adding security patches to the admin side
 * Removed inline styling from store locator elements and added class names
 * Added functionality to allow for the dropdown category selector in the store locator
 * Removed the fixed CSS width for the checkbox filter container - caused conflicts when the map was used in a widget
 * Changed the default width for the directions box from 250px to 100%
 * Fixed the bug that caused the directions output box to keep the old directions data when the directions were reset and calculated again
 * Added Transit directions functionality
 * Added functionality that would report on "ZERO_RESULTS" if the directions API came back with nothing
 * Set the directions to show alternative routes by default
 * Added "Avoid Ferries" to directions options
 * Added additional tab support (tri-tabs-nav span)
 * Fixed a bug that caused the map editor to display when trying to delete a map
 * Fixed a bug that showed deleted maps in the map list when creating a new category
 * The category drop down now sorts categories alphabetically by default
 * Fixed a styling issue for the marker title in the modern infowindow
 * 
 * 
 * 6.04 - 2016-07-19 - Low priority
 * Bug fix for adding markers
 * 
 * 6.03 - 2016-07-18 - High priority
 * Security patches
 * Additional tab support
 * The full image (as opposed to the thumbnail) is now used by default when uploading an image to a marker
 * CSS validation fixes
 * Fixed a bug where the directions were not reset but rather added onto
 * Fixed a bug that sometimes cause "null" to be displayed for the marker description
 * Fixed a bug that caused wpgmaps_localize_marker_data is not defined
 * 
 * 6.02 - 2016-07-07 - Medium priority
 * Fixed a bug which prevented markers from being hidden until search is done
 * Added option to disable Maps API from being loaded on front end
 * Added the Places lbrary to API calls as these were removed in previous update
 * Fixed styling conflict which prevented modern info-window from closing when close button is clicked
 *
 * 6.01 - 2016-07-06 - Medium priority
 * Fixed Resize Bug
 *
 * 6.00 - 2016-06-27 - Medium priority
 * Modernized UI introduced
 * Heatmap functionality added
 * New marker description editor added
 * More comprehensive import/export functionality added
 * Two new modern infowindows added
 * A new map wizard has been added
 * Videos can now be added to your markers
 * You can now set the default store locator icon
 * You can now set the default user location icon
 * You can now set the minimum zoom level
 * Added event listeners for both jQuery and accordions so that the map can init correctly when placed in a tab or accordion
 * Fixed issues that caused errors to show up when saving your map
 * Fixed the positioning issue of the modern infowindow with the new Google Maps API. It now appears in the top right by default.
 * Modern Infowindow scroll bars now only appear when they need to 
 * Marker clustering icons fixed
 * 
 * 5.70 - 2016-04-13 - High priority for Gold users
 * Fixed the marker clustering icons
 * Fixed issues that caused errors to show up when saving your map
 * 
 * 5.69 - 2016-04-15 - High priority
 * Deprecated google maps api 3.14 and 3.15, added 3.23 and 3.24
 * 
 * 5.68 - 2016-04-13 - Low Priority
 * You can now enter in your own Google Maps API key
 * 
 * 5.67 - 2016-04-04 - Low Priority
 * Google Maps API sensor removed from API call 
 * Fixed a bug that caused an error for the autocomplete functionality when the Gold add-on was active
 * Autocomplete functionality added to the 'to' and 'from' directions fields
 * Fixed a bug that affected the HTML structure on some sites
 * Weather & Cloud layer options removed (Deprecated in the Google Maps API)
 * 
 * 5.66 - 2016-03-04 - Low priority
 * Fixed a bug that showed an error message below the map if directions was enabled and open above the map.
 * Improvements to the import functionality
 * 
 * 
 * 5.65 - 2016-01-08 - Low priority
 * Style bug fix with the modern infowindow
 * Fixed an IIS bug
 * 
 * 5.64 - 2016-01-07 - Low priority
 * Additional tab compatibility
 * UI improvements - add/edit marker section
 * Fixed a bug that caused the wrong default marker icon to be displayed when using multiple maps on one page
 * Fixed a bug that caused the modern infowindow to show incorrectly when using multiple maps on one page
 * Fixed a bug that caused the enter key to not work when searching using the store locator
 * Fixed a bug that if you previously clicked on a marker in a list (which zooms to the location), and then click on another marker on the map, it will now no longer zoom to the marker location but rather just open the marker as expected, without zooming.
 * Fixed a map mashup bug that stopped the marker list from reflecting the correct markers
 * Fixed a bug that caused some content to not be loaded through SSL when you are using SSL
 * Fixed a bug that stopped the advanced marker listing from updating when using IE.
 * 
 * 5.63 - 2015-12-01- - Low priority
 * Added custom hooks and filters
 * 
 * 5.62 - 2015-11-23 - Low Priority
 * Fixed a bug that caused the map to break when a theme was not selectd
 * 
 * 5.61 - 2015-11-19 - Low Priority
 * Theme directory and functionality added to the Pro version
 * Fixed a bug that served http content on an SSL site in the marker clusterer functionality
 * Fixed a bug that took the Print Directions page to a 404 error
 * You can now close a modern info window by clicking on an x
 * A class has been added to the containing div when filtering by category
 * 
 * 5.60 - 2015-09-04 - Low priority
 * Added 5 themes to the map editor
 * Added a native map widget so you can drag and drop your maps to your widget area
 * Fixed a bug that incorrrectly geocoded certain GPS co-ordinates when using the Store Locator
 * Fixed an undefined notice
 * Removed old version warnings
 * Added another tab to the tabs compatibility list
 * Turkish translation added - thank you Suha Karalar
 *  
 * 5.59 - 2015-08-20 - High priority
 * Fixed a bug that caused a conflict with WordPress 4.3's jQuery and DataTables.js
 * Styling bug fixes in WordPress 4.3
 * 
 * 
 * 5.58 - Liberty Update
 * Fixed a bug that caused the default marker listing quantity to reset after selecting a category
 * Minor bug fixes
 * Fixed a bug that caused a jQuery error message to be displayed briefly before the map loads\
 * Fixed a bug that caused the center of the map to be incorrectly changed when clicking on a marker in a marker list on certain iOS devices
 * Added the autocomplete functionality to the add marker section in the map editor
 * 
 * 5.57
 * New infowindow style available: Modern Infowindow
 * Bug fix with JS error being produced as a result of the new google maps autocomplete
 * Minor bug fixes in the google map HTML output
 * SSL bug fix
 * CSV import bug fix ('retina' and 'approved' where not being imported)
 * Support added for 3 new tabs
 * Added accessibility support for the directions box (http://achecker.ca/)
 * Fixed the bug that caused an alert to pop up regarding jQuery dataTables when filtering the markers
 * Fixed the bug that caused the marker list advanced table to span passed the width of the main parent DIV
 * Added Google Autocomplete to the store locator
 * Removed the slashes in the category name within the marker listing
 * 
 * 5.56
 * Directions now open up in native map app if on a mobile device (thank you pelicanpaul!)
 * Fixed the "auto approve" bug with the VGM add-on
 * Polygon and polyline bug fixes with mashup functionality
 * Rocketscript fix (Cloudfare)
 * Categories are now displayed in alphabetical order (thank you Duncan McMillan!)
 * Fixed the bug that caused the directions width type to show as PX instead of %
 * Map centers to original center location when resized
 * json_encode (extra parameter) issue fixed for hosts using PHP version < 5.3
 * PHP Notice fixes
 * 
 * 5.55
 * Directions box width can now be set to either PX or %
 * Marker image width and/or height can now be left blank to automatically set the width/height
 * Clicking/hovering on a marker no longer pans the map to that marker
 * Mass marker bug fix
 * Now using sensor=true in the geocoding API calls
 * Fixed max zoom bug
 * Fixed the bug that caused the marker title to not show up in the marker listing (basic table) in certain instances
 * "Get directions" now appears in the basic table marker list
 * 
 * 5.54 2015-03-16
 * Timthumb removed
 * New marker listing functionality - you can now list your markers in the map itself
 * Category filter (dropdown) bug fix
 * You can now set the width and height for Retina markers in the settings page
 * Advanced marker listing table is now responsive
 * Major improvements to how the plugin handles marker sorting
 * You can now force a marker infowindow to open by using a GET variable (?markerid=x). You can also assign a zoom level (&mzoom=x)
 * Fixed the MaxZoom bug not allowing you to go to zoom level 0
 * The map now automatically shows in the language you have set in your WordPress settings
 * Code improvements in the main JS file
 * Fixed the bug that didnt allow for category filtering when multiple maps are on the same page
 * Mashup (via database method) bug fix
 * Store locator datatables bug fix
 * Fixed bug that didnt allow filtering when multiple maps are on the same page
 * Fixed a bug that caused the wrong map to setCentre when clicking on a polygon with multiple maps on a page
 * SSL Compatibility for the datatables theme css file
 * Fixed a bug that caused the image url to not be inserted when trying to use an image that doesnt have a standard wordpress thumbnail size
 * Refactored the way we handle category filtering
 * 
 * 
 * 5.53 2015-02-18 Low priority
 * Timthumb will be phased out and replaced with standard WordPress image handling in the next version - notices and new options added to this version
 * Small bug fix with the store locator
 * You can now use the Enter key to submit a store locator search
 * Fixed a bug that caused the map to not show in certain situations
 * 
 * 5.52 2015-02-16 High priority
 * Fixed the bug that didnt allow you to add a new marker to a blank map if you had the "database" option selected
 * 
 * 5.51 2015-02-03
 * Safari bug fix
 * New support page added
 * Bug fix - filter by checkbox is now working
 * Bug fix - Hide columns in advanced marker listing is now working
 * Added a space between the number and "miles" or "kilometers" for the store locator.
 * Added a Max Zoom option for your google map
 * PHP notices fixed
 * Fixed a bug that caused the map to not display if the polygon was corrupted
 * 
 * 5.50 2015-02-01
 * Bug fix for french translations
 * 
 * 5.49 2015-01-27
 * Core.js bug fixes
 * Fixed a bug that tried to check file permissions for the XML file even if the user selected the Database method for the marker pull option
 * Removed the marker limit warning
 * Duplicate map functionality added
 * Added support for the VGM add-on (auto approve markers)
 * 
 * 5.48
 * Fixed approval bug
 * Fixed a bug that caused polygons and polylines to now show on certain installations
 * Fixed a bug that caused more than one map to not display on certain installations
 * Fixed a bug that caused issues when using the database marker pull method and multiple maps
 * Added classes to the TO and FROM elements in the direction box
 * Code improvements in the core.js file
 * CSV import bug fixes - retina and approved columns now gets imported
 * 
 * 
 * 5.47
 * Fixed the marker ordering bug for the basic table
 * 
 * 5.46
 * Introduced a new method of pulling and displaying the marker data
 * 
 * 5.45
 * Code improvements
 * 
 * 5.44 2014-11-27
 * Code refactoring within the main class
 * Infowindow styling improvements (attempt at minimizing scrollbars and including more classes and structure to the infowindow)
 * Fixed the bug whereby the marker listing table was not ending correctly
 * Added compatibility for maps displaying within Elegant Builder tabs
 * Added title/description search options and functionality to the store locator (beta)
 * Fixed the map from not showing when using Hebrew locale
 * Added placeholders for the store locator inputs
 * PreserveViewport now set to true when using KML files (avoid zoom override)
 * Retina display support for markers
 * Added new strings to the PO file
 * "Lowest level of access to the map editor" option added to the pro version
 * A simple map can now be generated by using custom fields in a post/page. See our blog for more details.
 * Fixed the bug that didnt display the correct markers when the Store Locator was used and a map mashup was being used
 * 
 * 5.43 2014-11-05
 * Fixed IE bug (console log)
 * Fixed bug that switched the datatables back to English upon filtering when using another language
 * Fixed a marker sorting bug (sort by Marker ID)
 * 
 * 5.42 2014-11-04
 * New marker listing option - "Carousel"
 * Code improvements to both PHP and the JS core file
 * Shortcode additions: Map type and Streetview
 * New option: You can now show or hide the Store Locator bouncing icon
 * New option: Select default items to display in the advanced marker listing
 * Bug fixes
 *  IE8 issue with mashups
 *  IE8 issue with multiple KML files
 * 
 * 5.41
 * Better marker file handling
 * Permission error bug fix
 * Multiple KML/KMZ/GeoRSS files can now be used (comma separated)
 * Small bug fixes (Thank you Thomas)
 * 
 * 5.40
 * Enfold / Avia theme conflict (Google Maps API loading twice) resolved
 *  
 * 5.39 2014-09-29
 * Security updates (thank you www.htbridge.com)
 * Fixed the bug that didnt correctly check the category checkboxes when editing your marker
 * Code improvements (PHP warnings)
 * Code improvements (file permissions) (Thank you Thomas)
 * Fixed bug that showed "Show _MENU_ entries" when it should have displayed "No records found" (Thank you Thomas)
 * Broken image bug fix (Thank you Thomas)
 * 
 * 5.38
 * Removed "the map could not load" error that showed briefly before the map loads.
 * 
 * 5.37
 * Fixed the bug that was not causing the marker lists to be updated on a store locator search or category filtering
 * 
 * 5.36
 * Code improvements (PHP warnings)
 * 
 * 5.35
 * Code improvements (PHP warnings)
 * 
 * 5.34
 * New features:
 *  - Marker filtering now changes the marker list below
 *  - Store locator filtering now changes the marker list below
 *  - Markers can now have mulitple categories
 *  - You can now right click to add a marker to the map
 *  - New markers can be dragged
 *  - Polygons and polylines now have labels
 * Backend UI improvements
 * Polyline bug fix
 * Fixed incorrect warning about permissions when permissions where "2755" etc.
 * 
 * 5.33
 * Print directions bug fix
 * 
 * 5.32
 * New feature: Print directions
 * You can now set the query string for the store locator
 * 
 * 5.31
 * Bug fixes
 *  - Incorrect polyline data caused the map to not load
 *  - Changed incorrect HTML in the directions box on the front end
 * 
 * 5.30
 * Bug fix - multiple maps with polygons now work
 * 
 * 5.29
 * Small bug fix (warning)
 * 
 * 5.28
 * New feature: Geocode on import now available (BETA) - Thank you Tony Palleschi - http://apartcreations.com/
 * New polygon functionality: add "on hover" properties, a title and a link to your polygons.
 * Fixed a bug that when threw off gps co-ordinates when adding a lat,lng as an address
 * 
 * 5.27
 * Minor code improvements (warnings)
 * Multisite bug fix (marker location)
 * 
 * 5.26
 * Minor code improvements
 * 
 * 5.25
 * You can now choose which folder your markers are saved in
 * Better error reporting for file permission issues
 * 
 * 5.24
 * Fixed a language bug with the use of datatables (thank you Jean-Philippe Boily)
 * 
 * 5.23
 * Fixed more PHP warnings
 * Code improvements
 *  
 * 5.22
 * Fixed PHP notice warnings (shown in debug mode)
 * Fixed marker location bug when the default uploads directory has been changed
 * 
 * 5.21
 * Fixed a bug that caused KML, Fusion tables and polygons to appear on the first map instead of individual maps when multiple maps where used on one page
 * Fixed a map width bug (%)
 * Added the option to select which API version you would like to use
 * 
 * 5.20
 * Introduced ini_set("auto_detect_line_endings", true); for better mac/pc importing of CSV files
 * Maps now work automatically when put in tabs
 * Added more options for the store locator
 * Added opacity options for polygon lines
 * 
 * 5.19
 * Small bug fix
 * 
 * 5.18
 * Mutlisite marker location bug fixed
 * 
 * 5.17
 * Markers are now stored in the uploads/wp-google-maps/ directory
 * 
 * 5.16
 * Small bug fix
 * 
 * 5.15
 * Performance improvements
 * 
 * 5.14
 * Added the option to display categories as a dropdown or as checkboxes
 * Added store locator functionality. More functionality for this to follow soon (Still in BETA)
 * Fixed the bug that swapped the variables around for disabling "double click zoom"
 * Fixed a bug that forced a new geocode on every marker edit, even if the address wasnt changed
 * New functionality:
 *  - You can now choos to open a marker from click or hover
 *  - Better error handling
 * 
 * 5.13
 * Fixed a conflict between KML layers and Polygons whereby clicks on markers within a KML layer were not triggering if the polygon overlapped the KML layer markers. Polygons 'clickable' now set to false
 * 
 * 5.12
 * Fixed the category selection bug that did not revert back to 'all' markers.
 * 
 * 5.11
 * Small bug fix
 * 
 * 5.10
 * Small bug fix
 * 
 * 5.09
 * Added category filtering via shortcode
 * 
 * 5.08
 * Fixed a conflict with the NextGen plugin
 * 
 * 5.07
 * Fixed a bug that stopped directions from working with multiple maps on the same page
 * 
 * 5.06
 * Small bug fixes in the core.js file
 * 
 * 5.05
 * Fixed a bug causign JS conflicts in IE8
 * 
 * 5.04
 * Fixed a bug that messed up the iamge sizes in some browsers
 * 
 * 5.03
 * Fixed a bug that caused all control elements on the map to disspear
 * 
 * 5.02
 * Fixed an marker icon bug for some hosts
 * Fixed small bug with resetting select boxes within the add marker section
 * 
 * 5.01
 * Small bug fixes
 * 
 * 5.0
 * Complete re-code
 * Upgrade: The JavaScript is now in it's own file
 * Better error handling
 * You now have the ability to add a default "To" address for the directions.
 * Fixed map align center bug
 * Fixed infowindow styling issues when images are used
 * Fixed the bug that caused the map to not load if a blank polyline/polygon was created
 * Fixed cross-browser infowindow styling bugs
 * You can now hide/show columns of your choice with the advanced listing option
 * Fixed many smaller bugs
 * 
 * 
 * 4.18
 * You can now add HTML into the description field
 * Functionality added for category icons
 * You can now assign categories to specific maps or all maps
 * Bug fixes:
 *  Fixed the sorting markers bug
 *  Fixed the bug that stopped you from deleting polylines
 *  Fixed the bug that caused no markers to display in the marker list when "Select" was selected in the category filter drop down.
 * 
 * 4.17
 * There is now the option to hide the Category column
 * 
 * 4.16
 * Fixed an infowindow styling bug
 * 
 * 4.15
 * Added a check to see if the Google Maps API was already loaded to avoid duplicate loading
 * Fixed some SSL bugs
 * Added extra style support for the standard marker listing
 * Advanced marker list now updates with category drop down selection
 *
 * 4.14
 * Added a min-width to the DIV within the InfoWindow class to stop the scroll bars from appearing in IE10
 *
 * 4.13
 * Map mashups are now available by modifying the shortcode.
 * Added Category functionality.
 * Fixed a bug with the normal marker list layout
 * Added backwards compatibility for older versions of WordPress
 * Fixed a few small bugs
 * Replaced deprecated WordPress function calls
 * Added Spanish translation - Thank you Fernando!
 * Coming soon in 4.14: Map mashup via custom fields in post.
 *
 * 4.12
 * Fixed a small bug
 *
 * 4.11
 * Better localization support
 * Fixed a SSL bug
 * 
 * 4.10
 * Added Polygon functionality
 * Added Polyline functionality
 * You can now show your visitors location on the map
 * Markers can now be sorted by id,title,description or address
 * Added better support for jQuery versions
 * Plugin now works out the box with jQuery tabs
 * Added standards for the advanced marker list style
 * Added user access support for the visitor generated markers add-on
 * Adjusted the KML functionality to avoid caching
 * Fixed small bugs causing PHP warnings
 * Fixed a bug that stopped the advanced marker listing from working
 * 
 * 4.09
 * Fixed a bug that didnt allow for multiple clicks on the marker list to bring the view back to the map
 * 
 * 4.08
 * This version allows the plugin to update itself moving forward
 * 
 * 4.07
 * Fixed a bug that was causing a JavaScript error with DataTables
 * 
 * 4.06
 * Added troubleshooting support
 * Fixed a bug that was stopping the plugin from working on IIS servers
 * 
 * 4.05
 * Added support for one-page-style themes.
 * Fixed a firefox styling bug when using percentage width/height and set map alignment to 'none'
 * Added support for disabling mouse zooming and dragging
 * Added support for jQuery1.9+
 * 
 * 4.04
 * Fixed a centering bug - thank you Yannick!
 * Italian translation added
 * Fixed an IE9 display bug 
 * Fixed a compatibility bug between the VGm add-on and the Pro add-on
 * Fixed a bug with the VGM display option
 * Fixed a bug with importing markers whereby it always showed as an error even when importing correctly
 *
 * 4.03
 * Fixed a firefox styling bug that caused the Directions box to load on the right of the map instead of below.
 * Added support code for the new WP Google Maps Visitor Generated Markers plugin
 * Added the option for a more advanced way to list your markers below your maps
 * Added responsive size functionality
 * Added support for Fusion Tables
 *
 * 4.02
 * Fixed the bug that caused the directions box to show above the map by default
 * Fixed the bug whereby an address was already hard-coded into the "To" field of the directions box
 * Fixed the bug that caused the traffic layer to show by default
 *
 * 4.01
 * Added the functionality to list your markers below the map
 * Added more advanced directions functionality
 * Fixed small bugs
 * Fixed a bug that caused a fatal error when trying to activate the plugin on some hosts.
 *
 * 4.0
 * Plugin now supports multiple maps on one page
 * Bicycle directions now added
 * Walking directions now added
 * "Avoid tolls" now added to the directions functionality
 * "Avoid highways" now added to directions functionality
 * New setting: open links in a new window
 * Added functionality to reset the default marker image if required.
 *
 * 3.12
 * Fixed the bug that told users they had an outdated plugin when in fact they never
 *
 * 3.11
 * Fixed the bug that was causing both the bicycle layer and traffic layer to show all the time
 * 
 * 3.10
 * Added the bicycle layer
 * Added the traffic layer
 * Fixed the bug that was not allowing users to overwrite existing data when uploading a CSV file
 *
 * 3.9
 * Added support for KML/GeoRSS layers.
 * Fixed the directions box styling error in Firefox.
 * Fixed the bug whereby users couldnt change the default location without adding a marker first.
 * When the "Directions" link is clicked on, the "From" field is automatically highlighted for the user.
 * Added additional settings
 *
 * 3.8
 * Markers now automatically close when you click on another marker.
 * Russian localization added
 * The "To" field in the directions box now shows the address and not the GPS co-ords.
 *
 * 3.7
 * Added support for localization
 *
 * 3.6
 * Fixed the bug that caused slow loading times with sites that contain a high number of maps and markers
 *
 * 3.5
 * Fixed the bug where sometimes the short code wasnt working for home pages
 *
 * 3.4
 * Added functionality for 'Titles' for each marker
 *
 * 3.3
 * Added functionality for WordPress MU
 *
 * 3.2
 * Fixed a bug where in IE the zoom checkbox was showing
 * Fixed the bug where the map wasnt saving correctly in some instances

 * 3.1
 * Fixed redirect problem
 * Fixed bug that never created the default map on some systems

 * 3.0
 * Added Map Alignment functionality
 * Added Map Type functionality
 * Started using the Geocoding API Version 3  instead of Version 2 - quicker results!
 * Fixed bug that didnt import animation data for CSV files
 * Fixed zoom bug

 * 2.1
 * Fixed a few bugs with the jQuery script
 * Fixed the shortcode bug where the map wasnt displaying when two or more short codes were one the post/page
 * Fixed a bug that wouldnt save the icon on editing a marker in some instances
 *
 * 
 *
*/
//error_reporting(E_ERROR);
global $wpgmza_pro_version;
global $wpgmza_pro_string;
$wpgmza_pro_version = "6.13";
$wpgmza_pro_string = "pro";

global $wpgmza_current_map_cat_selection;
global $wpgmza_current_map_shortcode_data;
global $wpgmza_current_map_type;

global $wpgmza_p;
global $wpgmza_t;
$wpgmza_p = true;
$wpgmza_t = "pro";

global $wpgmza_count;
$wpgmza_count = 0;

global $wpgmza_post_nonce;
$wpgmza_post_nonce = md5(time());

global $wpdb;
global $wpgmza_tblname_datasets;
$wpgmza_tblname_datasets = $wpdb->prefix . "wpgmza_datasets";

global $wpgmza_override;
$wpgmza_override = array();


include ("wp-google-maps-pro_categories.php");
include ("wp-google-maps-pro_wizard.php");
include ("wp-google-maps-pro_export_import.class.php");
include ("wpgmza.php");

add_action('admin_head', 'wpgmaps_upload_csv');
add_action('init', 'wpgmza_register_pro_version');


function wpgmaps_pro_activate() { 
    wpgmza_cURL_response_pro("activate");
    wpgmaps_handle_db_pro();
    if (function_exists("wpgmaps_handle_directory")) { wpgmaps_handle_directory(); } ;
}
function wpgmaps_pro_deactivate() { wpgmza_cURL_response_pro("deactivate"); }




function wpgmza_register_pro_version() {
    global $wpgmza_pro_version;
    global $wpgmza_pro_string;
    global $wpgmza_t;
    
      
    /* version control */
    wpgmza_pro_update_control();
    
    
    if (!get_option('WPGMZA_PRO')) {

    	/* first time user */

 		$wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");
        if (isset($wpgmza_settings['wpgmza_settings_image_resizing'])) {  } else { $wpgmza_settings['wpgmza_settings_image_resizing'] = "yes"; }
        if (isset($wpgmza_settings['wpgmza_settings_use_timthumb'])) {  } else { $wpgmza_settings['wpgmza_settings_use_timthumb'] = "yes"; } /* this disables the use of timthumb by default */

        update_option("WPGMZA_OTHER_SETTINGS",$wpgmza_settings);

        add_option('WPGMZA_PRO',array("version" => $wpgmza_pro_version, "version_string" => $wpgmza_t));
    } else {
        update_option('WPGMZA_PRO',array("version" => $wpgmza_pro_version, "version_string" => $wpgmza_t));
    }
    


    if (isset($_GET['action']) && $_GET['action'] == "wpgmza_csv_export") {

		$export = new WPGMapsImportExport();

    	$export->export_markers();
        
    } 

    if (isset($_GET['action']) &&  $_GET['action'] == 'export_single_map' ){

    	$export = new WPGMapsImportExport();

    	$export->export_map( sanitize_text_field( $_GET['mid'] ) );

    }

	if (isset($_GET['action']) &&  $_GET['action'] == 'export_all_maps' ){
    	
		$export = new WPGMapsImportExport();

    	$export->export_map();

    }

    if (isset($_GET['action']) &&  $_GET['action'] == 'export_polygons' ){
    	
		$export = new WPGMapsImportExport();

    	$export->export_polygons();

    }

    if (isset($_GET['action']) &&  $_GET['action'] == 'export_polylines' ){
    	
		$export = new WPGMapsImportExport();

    	$export->export_polylines();

    }	   

	if (isset($_GET['action']) &&  $_GET['action'] == 'import_polylines' ){
    	
		$export = new WPGMapsImportExport();

    	$export->import_polylines();

    }

    if (isset($_GET['action']) &&  $_GET['action'] == 'import_polygons' ){
    	
		$export = new WPGMapsImportExport();

    	$export->import_polygons();

    }

	
}


function wpgmza_pro_update_control() {
    global $wpgmza_pro_version;


    
    
    $saved_version = get_option('WPGMZA_PRO');
    if ($saved_version['version'] != $wpgmza_pro_version) {

    	

        if (function_exists("wpgmaps_handle_db")) { wpgmaps_handle_db(); }
        wpgmaps_handle_db_pro();


        /* create default settings if they dont exist. */
        $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");
        if (isset($wpgmza_settings['wpgmza_settings_carousel_markerlist_image'])) {  } else { $wpgmza_settings['wpgmza_settings_carousel_markerlist_image'] = ""; }
        if (isset($wpgmza_settings['wpgmza_settings_carousel_markerlist_icon'])) {  } else { $wpgmza_settings['wpgmza_settings_carousel_markerlist_icon'] = ""; }
        if (isset($wpgmza_settings['wpgmza_settings_carousel_markerlist_title'])) {  } else { $wpgmza_settings['wpgmza_settings_carousel_markerlist_title'] = ""; }
        if (isset($wpgmza_settings['wpgmza_settings_carousel_markerlist_description'])) {  } else { $wpgmza_settings['wpgmza_settings_carousel_markerlist_description'] = "yes"; }
        if (isset($wpgmza_settings['wpgmza_settings_carousel_markerlist_address'])) {  } else { $wpgmza_settings['wpgmza_settings_carousel_markerlist_address'] = ""; }
        if (isset($wpgmza_settings['wpgmza_settings_carousel_markerlist_directions'])) {  } else { $wpgmza_settings['wpgmza_settings_carousel_markerlist_directions'] = ""; }
        if (isset($wpgmza_settings['wpgmza_settings_carousel_markerlist_link'])) {  } else { $wpgmza_settings['wpgmza_settings_carousel_markerlist_link'] = ""; }
        /**
         * Deprecated in 6.09
         * if (isset($wpgmza_settings['wpgmza_settings_carousel_markerlist_resize_image'])) {  } else { $wpgmza_settings['wpgmza_settings_carousel_markerlist_resize_image'] = "yes"; }
         */        

        if (isset($wpgmza_settings['wpgmza_settings_image_resizing'])) {  } else { $wpgmza_settings['wpgmza_settings_image_resizing'] = "yes"; }
        if (isset($wpgmza_settings['wpgmza_settings_use_timthumb'])) {  } else { $wpgmza_settings['wpgmza_settings_use_timthumb'] = "yes"; } /* this disables the use of timthumb by default */

        if (isset($wpgmza_settings['carousel_items'])) {  } else { $wpgmza_settings['carousel_items'] = "5"; }
        if (isset($wpgmza_settings['carousel_lazyload'])) {  } else { $wpgmza_settings['carousel_lazyload'] = "yes"; }
        if (isset($wpgmza_settings['carousel_autoplay'])) {  } else { $wpgmza_settings['carousel_autoplay'] = "5000"; }
        if (isset($wpgmza_settings['carousel_pagination'])) {  } else { $wpgmza_settings['carousel_pagination'] = ""; }
        if (isset($wpgmza_settings['carousel_navigation'])) {  } else { $wpgmza_settings['carousel_navigation'] = "yes"; }
        if (isset($wpgmza_settings['carousel_autoheight'])) {  } else { $wpgmza_settings['carousel_autoheight'] = "yes"; }


        if (isset($wpgmza_settings['wpgmza_api_version']) && ($wpgmza_settings['wpgmza_api_version'] == "3.14" || $wpgmza_settings['wpgmza_api_version'] == "3.15" || $wpgmza_settings['wpgmza_api_version'] == "3.23")) { $wpgmza_settings['wpgmza_api_version'] = "3.26"; }


        update_option("WPGMZA_OTHER_SETTINGS",$wpgmza_settings);



    }
    
}

/* deprecated from 6.02 */
//add_action('wp_enqueue_scripts','wpgmaps_user_styles_pro');
function wpgmaps_user_styles_pro() {
		global $short_code_active;
		if ($short_code_active) {
			/* only show styles on pages that contain the shortcode for the map */
			global $wpgmza_pro_version;
       		//wp_register_style( 'wpgmaps-style-pro', plugins_url('css/wpgmza_style_pro.css', __FILE__), array(), $wpgmza_pro_version);
       		//wp_enqueue_style( 'wpgmaps-style-pro' );


       	}
}
        
function wpgmaps_handle_db_pro() {
    global $wpdb;
    global $wpgmza_tblname_datasets;

    $sql = "
        CREATE TABLE `".$wpgmza_tblname_datasets."` (
          id int(11) NOT NULL AUTO_INCREMENT,
          map_id int(11) NOT NULL,
          type INT(3) NOT NULL,
          dataset_name VARCHAR(100) NOT NULL,
          dataset LONGTEXT NOT NULL,
          options LONGTEXT NOT NULL,
          PRIMARY KEY  (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
    ";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);

	global $wpgmza_tblname_categories;
    $sql = "
        CREATE TABLE `".$wpgmza_tblname_categories."` (
          id int(11) NOT NULL AUTO_INCREMENT,
          active TINYINT(1) NOT NULL,
          category_name VARCHAR(50) NOT NULL,
          category_icon VARCHAR(700) NOT NULL,
          retina TINYINT(1) DEFAULT '0',
          parent INT(11) DEFAULT '0',
          PRIMARY KEY  (id)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
    ";

    dbDelta($sql);

}

function wpgmza_pro_menu() {
    global $wpgmza_pro_version;
    global $wpgmza_p_version;
    global $wpgmza_post_nonce;
    global $wpgmza_tblname_maps;
    global $wpdb;
    
    $handle = 'avia-google-maps-api';
    $list = 'enqueued';
    if (wp_script_is( $handle, $list )) {
        wp_deregister_script('avia-google-maps-api');
    }
    
    $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");
    
    
    
    
    if (!isset($wpgmza_settings['wpgmza_settings_use_timthumb'])) {
        /* only check permissions if the user has requested to use timthumb 
        deprecated in 5.57
        if (function_exists("wpgmaps_check_permissions_cache") && function_exists("wpgmaps_cache_permission_warning")) { 
            if (!wpgmaps_check_permissions_cache()) { wpgmaps_cache_permission_warning(); }
        }
        */
    }
    
    
    if ($_GET['action'] == "edit") {

    }
    else if($_GET['action'] == "wizard"){
    	wpgmaps_wizard_layout();
    }
    else if ($_GET['action'] == "new" || $_GET['action'] == "new-wizard") {


        $def_data = get_option("WPGMZA_SETTINGS");
        if (isset($def_data->map_default_starting_lat)) { $data['map_default_starting_lat'] = $def_data->map_default_starting_lat; }
        if (isset($def_data->map_default_starting_lng)) { $data['map_default_starting_lng'] = $def_data->map_default_starting_lng; }
        if (isset($def_data->map_default_height)) { $data['map_default_height'] = $def_data->map_default_height; }
        if (isset($def_data->map_default_width)) { $data['map_default_width'] = $def_data->map_default_width; }
        if (isset($def_data->map_default_height_type)) { $data['map_default_height_type'] = stripslashes($def_data->map_default_height_type); }
        if (isset($def_data->map_default_width_type)) { $data['map_default_width_type'] =stripslashes($def_data->map_default_width_type); }
        if (isset($def_data->map_default_zoom)) { $data['map_default_zoom'] = $def_data->map_default_zoom; }
        if (isset($def_data->map_default_type)) { $data['map_default_type'] = $def_data->map_default_type; }
        if (isset($def_data->map_default_alignment)) { $data['map_default_alignment'] = $def_data->map_default_alignment; }
        if (isset($def_data->map_default_order_markers_by)) { $data['map_default_order_markers_by'] = $def_data->map_default_order_markers_by; }
        if (isset($def_data->map_default_order_markers_choice)) { $data['map_default_order_markers_choice'] = $def_data->map_default_order_markers_choice; }
        if (isset($def_data->map_default_show_user_location)) { $data['map_default_show_user_location'] = $def_data->map_default_show_user_location; }
        if (isset($def_data->map_default_directions)) { $data['map_default_directions'] = $def_data->map_default_directions; }
        if (isset($def_data->map_default_bicycle)) { $data['map_default_bicycle'] = $def_data->map_default_bicycle; }
        if (isset($def_data->map_default_traffic)) { $data['map_default_traffic'] = $def_data->map_default_traffic; }
        if (isset($def_data->map_default_dbox)) { $data['map_default_dbox'] = $def_data->map_default_dbox; }
        if (isset($def_data->map_default_dbox_width)) { $data['map_default_dbox_width'] = $def_data->map_default_dbox_width; }
        if (isset($def_data->map_default_default_to)) { $data['map_default_default_to'] = $def_data->map_default_default_to; }
        if (isset($def_data->map_default_marker)) { $data['map_default_marker'] = $def_data->map_default_marker; }


        if (isset($def_data['map_default_height_type'])) {
            $wpgmza_height_type = $def_data['map_default_height_type'];
        } else {
            $wpgmza_height_type = "px";
        }
        if (isset($def_data['map_default_width_type'])) {
            $wpgmza_width_type = $def_data['map_default_width_type'];
        } else {
            $wpgmza_width_type = "px";
        }
        
        if (isset($def_data['map_default_height'])) {
            $wpgmza_height = $def_data['map_default_height'];
        } else {
            $wpgmza_height = "400";
        }
        if (isset($def_data['map_default_width'])) {
            $wpgmza_width = $def_data['map_default_width'];
        } else {
            $wpgmza_width = "600";
        }
        if (isset($def_data['map_default_marker'])) {
            $wpgmza_def_marker = $def_data['map_default_marker'];
        } else {
            $wpgmza_def_marker = "0";
        }
        if (isset($def_data['map_default_alignment'])) {
            $wpgmza_def_alignment = $def_data['map_default_alignment'];
        } else {
            $wpgmza_def_alignment = "0";
        }
        if (isset($def_data['map_default_order_markers_by'])) {
            $wpgmza_def_order_markers_by = $def_data['map_default_order_markers_by'];
        } else {
            $wpgmza_def_order_markers_by = "0";
        }
        if (isset($def_data['map_default_order_markers_choice'])) {
            $wpgmza_def_order_markers_choice = $def_data['map_default_order_markers_choice'];
        } else {
            $wpgmza_def_order_markers_choice = "0";
        }
        if (isset($def_data['map_default_show_user_location'])) {
            $wpgmza_def_show_user_location = $def_data['map_default_show_user_location'];
        } else {
            $wpgmza_def_show_user_location = "0";
        }
        if (isset($def_data['map_default_directions'])) {
            $wpgmza_def_directions = $def_data['map_default_directions'];
        } else {
            $wpgmza_def_directions = "0";
        }
        if (isset($def_data['map_default_bicycle'])) {
            $wpgmza_def_bicycle = $def_data['map_default_bicycle'];
        } else {
            $wpgmza_def_bicycle = "0";
        }
        if (isset($def_data['map_default_traffic'])) {
            $wpgmza_def_traffic = $def_data['map_default_traffic'];
        } else {
            $wpgmza_def_traffic = "0";
        }
        if (isset($def_data['map_default_dbox'])) {
            $wpgmza_def_dbox = $def_data['map_default_dbox'];
        } else {
            $wpgmza_def_dbox = "0";
        }
        if (isset($def_data['map_default_dbox_wdith'])) {
            $wpgmza_def_dbox_width = $def_data['map_default_dbox_width'];
        } else {
            $wpgmza_def_dbox_width = "100";
        }
        if (isset($def_data['map_default_default_to'])) {
            $wpgmza_def_default_to = $def_data['map_default_default_to'];
        } else {
            $wpgmza_def_default_to = "";
        }
        if (isset($def_data['map_default_listmarkers'])) {
            $wpgmza_def_listmarkers = $def_data['map_default_listmarkers'];
        } else {
            $wpgmza_def_listmarkers = "0";
        }
        if (isset($def_data['map_default_listmarkers_advanced'])) {
            $wpgmza_def_listmarkers_advanced = $def_data['map_default_listmarkers_advanced'];
        } else {
            $wpgmza_def_listmarkers_advanced = "0";
        }
        if (isset($def_data['map_default_filterbycat'])) {
            $wpgmza_def_filterbycat = $def_data['map_default_filterbycat'];
        } else {
            $wpgmza_def_filterbycat = "0";
        }
        if (isset($def_data['map_default_type'])) {
            $wpgmza_def_type = $def_data['map_default_type'];
        } else {
            $wpgmza_def_type = "1";
        }

        if (isset($def_data['map_default_zoom'])) {
            $start_zoom = $def_data['map_default_zoom'];
        } else {
            $start_zoom = 5;
        }
        
        if (isset($def_data['map_default_ugm_access'])) {
            $ugm_access = $def_data['map_default_ugm_access'];
        } else {
            $ugm_access = 0;
        }
        
        if (isset($def_data['map_default_starting_lat']) && isset($def_data['map_default_starting_lng'])) {
            $wpgmza_lat = $def_data['map_default_starting_lat'];
            $wpgmza_lng = $def_data['map_default_starting_lng'];
        } else {
            $wpgmza_lat = "51.5081290";
            $wpgmza_lng = "-0.1280050";
        }

        $wpgmza_map_data_content = array(
            "map_title" => "New Map",
            "map_start_lat" => "$wpgmza_lat",
            "map_start_lng" => "$wpgmza_lng",
            "map_width" => "$wpgmza_width",
            "map_height" => "$wpgmza_height",
            "map_start_location" => "$wpgmza_lat,$wpgmza_lng",
            "map_start_zoom" => "$start_zoom",
            "default_marker" => "$wpgmza_def_marker",
            "alignment" => "$wpgmza_def_alignment",
            "styling_enabled" => "0",
            "styling_json" => "",
            "active" => "0",
            "directions_enabled" => "$wpgmza_def_directions",
            "default_to" => "",
            "type" => "$wpgmza_def_type",
            "kml" => "",
            "fusion" => "",
            "map_width_type" => "$wpgmza_width_type",
            "map_height_type" => "$wpgmza_height_type",
            "fusion" => "",
            "mass_marker_support" => "0",
            "ugm_enabled" => "0",
            "ugm_category_enabled" => "0",
            "ugm_access" => "$ugm_access",
            "bicycle" => "$wpgmza_def_bicycle",
            "traffic" => "$wpgmza_def_traffic",
            "dbox" => "$wpgmza_def_dbox",
            "dbox_width" => "$wpgmza_def_dbox_width",
            "listmarkers" => "$wpgmza_def_listmarkers",
            "listmarkers_advanced" => "$wpgmza_def_listmarkers_advanced",
            "filterbycat" => "$wpgmza_def_filterbycat",
            "order_markers_by" => "$wpgmza_def_order_markers_by",
            "order_markers_choice" => "$wpgmza_def_order_markers_choice",
            "show_user_location" => "$wpgmza_def_show_user_location",
            "other_settings" => ""
            );

		//Filter Array if the wizard is in use
		if($_GET['action'] == "new-wizard"){
			if(isset($_GET['wpgmza_keys']) && isset($_GET['wpgmza_values'])){
				$wpgmza_map_data_keys = explode(",", urldecode($_GET['wpgmza_keys']));
				$wpgmza_map_data_values = explode(",", urldecode($_GET['wpgmza_values']));

				$wpgmza_map_data_content = wpgmza_wizard_data_filter($wpgmza_map_data_content, $wpgmza_map_data_keys, $wpgmza_map_data_values);
			}
		}
	    $wpdb->insert( $wpgmza_tblname_maps, $wpgmza_map_data_content);
        $lastid = $wpdb->insert_id;
        //echo $wpdb->last_error;

        $_GET['map_id'] = $lastid;
        //wp_redirect( admin_url('admin.php?page=wp-google-maps-menu&action=edit&map_id='.$lastid) );
        //$wpdb->print_errors();
        
       	echo "<script>window.location = \"".get_option('siteurl')."/wp-admin/admin.php?page=wp-google-maps-menu&action=edit&map_id=".$lastid."\"</script>";
    }


    if (isset($_GET['map_id'])) {
        
        if (function_exists("wpgmaps_marker_permission_check")) { wpgmaps_marker_permission_check(); }

        

        $res = wpgmza_get_map_data($_GET['map_id']);

        if (function_exists("google_maps_api_key_warning")) { google_maps_api_key_warning(); }


        if (function_exists("wpgmza_register_gold_version")) { $addon_text = __("including Pro &amp; Gold add-ons","wp-google-maps"); } else { $addon_text = __("including Pro add-on","wp-google-maps"); }
        
        if (function_exists("wpgmza_register_gold_version")) { 
            global $wpgmza_gold_version;
            if (floatval($wpgmza_gold_version) < 3.25) {
                $addon_text .= "<div class='error below-h1'><p>".__("Please <a href='update-core.php'>update your WP Google Maps GOLD version</a>. Your current Gold version is not compatible with the current Pro version.")."</p></div>";
            }
            
        }
        
        /* if (!$res->map_id || $res->map_id == "") { $wpgmza_data['map_id'] = 1; } */
        if (!$res->default_marker || $res->default_marker == "" || $res->default_marker == "0") { $display_marker = "<img src=\"".wpgmaps_get_plugin_url()."/images/marker.png\" />"; } else { $display_marker = "<img src=\"".$res->default_marker."\" />"; }
        if ($res->map_start_zoom) { $wpgmza_zoom[intval($res->map_start_zoom)] = "SELECTED"; } else { $wpgmza_zoom[8] = "SELECTED"; }
        if ($res->type) { $wpgmza_map_type[intval($res->type)] = "SELECTED"; } else { $wpgmza_map_type[1] = "SELECTED"; }
        if ($res->alignment) { $wpgmza_map_align[intval($res->alignment)] = "SELECTED"; } else { $wpgmza_map_align[1] = "SELECTED"; }
        if ($res->directions_enabled) { $wpgmza_directions[intval($res->directions_enabled)] = "checked"; } else { $wpgmza_directions[2] = ""; }
        if ($res->bicycle) { $wpgmza_bicycle[intval($res->bicycle)] = "checked"; } else { $wpgmza_bicycle[2] = ""; }
        if ($res->traffic) { $wpgmza_traffic[intval($res->traffic)] = "checked"; } else { $wpgmza_traffic[2] = ""; }
        if ($res->dbox != "1") { $wpgmza_dbox[intval($res->dbox)] = "SELECTED"; } else { $wpgmza_dbox[1] = "SELECTED"; }

        if ($res->order_markers_by) { $wpgmza_map_order_markers_by[intval($res->order_markers_by)] = "SELECTED"; } else { $wpgmza_map_order_markers_by[1] = "SELECTED"; }
        if ($res->order_markers_choice) { $wpgmza_map_order_markers_choice[intval($res->order_markers_choice)] = "SELECTED"; } else { $wpgmza_map_order_markers_choice[2] = "SELECTED"; }

        if ($res->show_user_location) { $wpgmza_show_user_location[intval($res->show_user_location)] = "checked"; } else { $wpgmza_show_user_location[2] = ""; }
        
        $wpgmza_map_width_type_px = "";
        $wpgmza_map_height_type_px = "";
        $wpgmza_map_width_type_percentage = "";
        $wpgmza_map_height_type_percentage = "";
        
       if (stripslashes($res->map_width_type) == "%") { $wpgmza_map_width_type_percentage = "SELECTED"; } else { $wpgmza_map_width_type_px = "SELECTED"; }
       if (stripslashes($res->map_height_type) == "%") { $wpgmza_map_height_type_percentage = "SELECTED"; } else { $wpgmza_map_height_type_px = "SELECTED"; }


        if (isset($res->listmarkers) && $res->listmarkers == "1") { $listmarkers_checked = "CHECKED"; } else { $listmarkers_checked = ""; }
        if (isset($res->filterbycat) && $res->filterbycat == "1") { $listfilters_checked = "CHECKED"; } else { $listfilters_checked = ""; }
        if (isset($res->listmarkers_advanced) && $res->listmarkers_advanced == "1") { $listmarkers_advanced_checked = "CHECKED"; } else { $listmarkers_advanced_checked = ""; }

        
        
        
        
        for ($i=0;$i<22;$i++) {
            if (!isset($wpgmza_zoom[$i])) { $wpgmza_zoom[$i] = ""; }
        }
        for ($i=0;$i<5;$i++) {
            if (!isset($wpgmza_map_type[$i])) { $wpgmza_map_type[$i] = ""; }
        }
        for ($i=0;$i<3;$i++) {
            if (!isset($wpgmza_sl_animation[$i])) { $wpgmza_sl_animation[$i] = ""; }
        }        
        for ($i=0;$i<5;$i++) {
            if (!isset($wpgmza_map_align[$i])) { $wpgmza_map_align[$i] = ""; }
        }
        for ($i=0;$i<3;$i++) {
            if (!isset($wpgmza_bicycle[$i])) { $wpgmza_bicycle[$i] = ""; }
        }
        for ($i=0;$i<3;$i++) {
            if (!isset($wpgmza_traffic[$i])) { $wpgmza_traffic[$i] = ""; }
        }
        for ($i=0;$i<3;$i++) {
            if (!isset($wpgmza_directions[$i])) { $wpgmza_directions[$i] = ""; }
        }
        for ($i=0;$i<6;$i++) {
            if (!isset($wpgmza_dbox[$i])) { $wpgmza_dbox[$i] = ""; }
        }
        for ($i=0;$i<6;$i++) {
            if (!isset($wpgmza_map_order_markers_by[$i])) { $wpgmza_map_order_markers_by[$i] = ""; }
        } 
        for ($i=0;$i<6;$i++) {
            if (!isset($wpgmza_map_order_markers_choice[$i])) { $wpgmza_map_order_markers_choice[$i] = ""; }
        }   
        for ($i=0;$i<3;$i++) {
            if (!isset($wpgmza_show_user_location[$i])) { $wpgmza_show_user_location[$i] = ""; }
        }   


        
        
        $other_settings_data = maybe_unserialize($res->other_settings);
        if (isset($other_settings_data['store_locator_enabled'])) { $wpgmza_store_locator_enabled = $other_settings_data['store_locator_enabled']; } else { $wpgmza_store_locator_enabled = 0; }
        if (isset($other_settings_data['wpgmza_store_locator_restrict'])) { $wpgmza_store_locator_restrict = $other_settings_data['wpgmza_store_locator_restrict']; } else { $wpgmza_store_locator_restrict = ""; }
        if (isset($other_settings_data['store_locator_distance'])) { $wpgmza_store_locator_distance = $other_settings_data['store_locator_distance']; } else { $wpgmza_store_locator_distance = 0; }
        if (isset($other_settings_data['store_locator_below'])) { $wpgmza_store_locator_below = $other_settings_data['store_locator_below']; } else { $wpgmza_store_locator_below = 0; }
        if (isset($other_settings_data['wpgmza_sl_animation'])) { $wpgmza_sl_animation[intval($other_settings_data['wpgmza_sl_animation'])] = 'selected'; } else { $wpgmza_sl_animation[1] = 'selected'; }

        if (isset($other_settings_data['store_locator_bounce'])) { $wpgmza_store_locator_bounce = $other_settings_data['store_locator_bounce']; } else { $wpgmza_store_locator_bounce = 0; }
        if (isset($other_settings_data['store_locator_hide_before_search'])) { $wpgmza_store_locator_hide_before_search = $other_settings_data['store_locator_hide_before_search']; } else { $wpgmza_store_locator_hide_before_search = 0; }
        if (isset($other_settings_data['store_locator_use_their_location'])) { $wpgmza_store_locator_use_their_location = $other_settings_data['store_locator_use_their_location']; } else { $wpgmza_store_locator_use_their_location = 0; }
        if (isset($other_settings_data['store_locator_default_address'])) { $wpgmza_store_locator_default_address = stripslashes($other_settings_data['store_locator_default_address']); } else { $wpgmza_store_locator_default_address = ""; }
        
        if (isset($other_settings_data['store_locator_name_search'])) { $wpgmza_store_locator_name_search = $other_settings_data['store_locator_name_search']; } else { $wpgmza_store_locator_name_search = 0; }
        if (isset($other_settings_data['store_locator_category'])) { $wpgmza_store_locator_category_enabled = $other_settings_data['store_locator_category']; }
        if (isset($other_settings_data['store_locator_query_string'])) { $wpgmza_store_locator_query_string = stripslashes($other_settings_data['store_locator_query_string']); } else { $wpgmza_store_locator_query_string = __("ZIP / Address:","wp-google-maps"); }
        if (isset($other_settings_data['store_locator_name_string'])) { $wpgmza_store_locator_name_string = stripslashes($other_settings_data['store_locator_name_string']); } else { $wpgmza_store_locator_name_string = __("Title / Description:","wp-google-maps"); }
        
        if (isset($other_settings_data['click_open_link'])) { $wpgmza_click_open_link[intval($other_settings_data['click_open_link'])] = "checked"; } else { $wpgmza_click_open_link[2] = "checked";  }
        for ($i=0;$i<3;$i++) {
            if (!isset($wpgmza_click_open_link[$i])) { $wpgmza_click_open_link[$i] = ""; }
        }   
        
        if (isset($other_settings_data['weather_layer'])) { $wpgmza_weather_option = $other_settings_data['weather_layer']; } else { $wpgmza_weather_option = ""; }
        if (isset($other_settings_data['weather_layer_temp_type'])) { $wpgmza_weather_option_temp_type = $other_settings_data['weather_layer_temp_type']; } else { $wpgmza_weather_option_temp_type = 1; } 
        if (isset($other_settings_data['cloud_layer'])) { $wpgmza_cloud_option = $other_settings_data['cloud_layer']; } else { $wpgmza_cloud_option = ""; }
        if (isset($other_settings_data['transport_layer'])) { $wpgmza_transport_option = $other_settings_data['transport_layer']; } else { $wpgmza_transport_option = 0; }
        if (isset($other_settings_data['map_max_zoom'])) { $wpgmza_max_zoom[intval($other_settings_data['map_max_zoom'])] = "SELECTED"; } else { $wpgmza_max_zoom[3] = "SELECTED";  }
        if (isset($other_settings_data['map_min_zoom'])) { $wpgmza_min_zoom[intval($other_settings_data['map_min_zoom'])] = "SELECTED"; } else { $wpgmza_min_zoom[21] = "SELECTED";  }

        if (isset($other_settings_data['list_markers_by'])) { $list_markers_by_checked[intval($other_settings_data['list_markers_by'])] = "CHECKED"; $list_markers_by_class[intval($other_settings_data['list_markers_by'])] = "wpgmza_mlist_selection_activate"; } else { $list_markers_by = false; }

        if (isset($other_settings_data['push_in_map']) && $other_settings_data['push_in_map'] == "1") { $pushinmap_checked = "CHECKED"; } else { $pushinmap_checked = ""; }
        if (isset($other_settings_data['push_in_map_placement'])) {$push_in_map_placement_checked[$other_settings_data['push_in_map_placement']] = "SELECTED"; } else { $push_in_map_placement_checked[9] = "SELECTED"; }
        if (isset($other_settings_data['wpgmza_push_in_map_width'])) { $wpgmza_push_in_map_width = $other_settings_data['wpgmza_push_in_map_width']; } else { $wpgmza_push_in_map_width = ""; }
        if (isset($other_settings_data['wpgmza_push_in_map_height'])) { $wpgmza_push_in_map_height = $other_settings_data['wpgmza_push_in_map_height']; } else { $wpgmza_push_in_map_height = ""; }
        
        if (isset($other_settings_data['wpgmza_dbox_width_type']) && $other_settings_data['wpgmza_dbox_width_type'] == "px") { $wpgmza_dbox_width_type[1] = "SELECTED"; } else { $wpgmza_dbox_width_type[2] = "SELECTED"; }


        if (empty($list_markers_by) || !$list_markers_by) {
            /* first check what their old setting was before the new options */
            
            
            if ($listmarkers_checked == "CHECKED" && $listmarkers_advanced_checked == "") { 
                /* old basic mode enabled */
                $list_markers_by_checked[1] = "checked";
            }
            else if ($listmarkers_checked == "CHECKED" && $listmarkers_advanced_checked == "CHECKED") { 
                /* old advanced mode enabled */
                
                $list_markers_by_checked[2] = "checked";
                
            } else {
                $list_markers_by_checked[0] = "checked";
            }
        }
        for ($i=0;$i<5;$i++) {
            if (!isset($list_markers_by_checked[$i])) { $list_markers_by_checked[$i] = ""; }
        }
        for ($i=0;$i<5;$i++) {
            if (!isset($list_markers_by_class[$i])) { $list_markers_by_class[$i] = ""; }
        }
        if (isset($other_settings_data['list_markers_by'])) {
        	if ($other_settings_data['list_markers_by'] == "0") {
        		$list_markers_by_sel_text = __("No marker list","wp-google-maps");
        	}
        	if ($other_settings_data['list_markers_by'] == "1") {
        		$list_markers_by_sel_text = __("Basic table","wp-google-maps");
        	}
        	if ($other_settings_data['list_markers_by'] == "4") {
        		$list_markers_by_sel_text = __("Basic list","wp-google-maps");
        	}
        	if ($other_settings_data['list_markers_by'] == "2") {
        		$list_markers_by_sel_text = __("Advanced table","wp-google-maps");
        	}
        	if ($other_settings_data['list_markers_by'] == "3") {
        		$list_markers_by_sel_text = __("Carousel","wp-google-maps");
        	}


        } else { 
        	$list_markers_by_sel_text = "";
    	}
        for ($i=0;$i<22;$i++) { if (!isset($wpgmza_max_zoom[$i])) { $wpgmza_max_zoom[$i] = ""; } }
        for ($i=0;$i<22;$i++) { if (!isset($wpgmza_min_zoom[$i])) { $wpgmza_min_zoom[$i] = ""; } }
        for ($i=0;$i<13;$i++) { if (!isset($push_in_map_placement_checked[$i])) { $push_in_map_placement_checked[$i] = ""; } }
        for ($i=1;$i<3;$i++) { if (!isset($wpgmza_dbox_width_type[$i])) { $wpgmza_dbox_width_type[$i] = ""; } }

        if (isset($other_settings_data['store_marker_listing_below'])) { $wpgmza_marker_listing_below = $other_settings_data['store_marker_listing_below']; } else { $wpgmza_marker_listing_below = 0; }


		$wpgmza_store_locator_enabled_checked = $wpgmza_store_locator_enabled == 1 ? 'checked' : '';

        $wpgmza_store_locator_distance_checked = $wpgmza_store_locator_distance == 1 ? 'checked' : '';

        $wpgmza_store_locator_below_checked = $wpgmza_store_locator_below == 1 ? 'checked' : '';
        
        $wpgmza_marker_listing_below_checked = $wpgmza_marker_listing_below == 1 ? 'checked' : '';
 
        $wpgmza_store_locator_bounce_checked = $wpgmza_store_locator_bounce == 1 ? 'checked' : '';
       
       	$wpgmza_store_locator_category_checked = isset($wpgmza_store_locator_category_enabled) && $wpgmza_store_locator_category_enabled == 1 ? 'checked' : '';
        
        $wpgmza_store_locator_hide_before_search_checked = $wpgmza_store_locator_hide_before_search == 1 ? 'checked' : '';
       
      	$wpgmza_store_locator_use_their_location_checked = $wpgmza_store_locator_use_their_location == 1 ? 'checked' : '';      

      	$wpgmza_store_locator_name_search_checked = $wpgmza_store_locator_name_search == 1 ? 'checked' : '';

        
        if (isset($other_settings_data['sl_stroke_color'])) { $sl_stroke_color = $other_settings_data['sl_stroke_color']; }
        if (isset($other_settings_data['sl_stroke_opacity'])) { $sl_stroke_opacity = $other_settings_data['sl_stroke_opacity']; }
        if (isset($other_settings_data['sl_fill_color'])) { $sl_fill_color = $other_settings_data['sl_fill_color']; }
        if (isset($other_settings_data['sl_fill_opacity'])) { $sl_fill_opacity = $other_settings_data['sl_fill_opacity']; }

        if (!isset($sl_stroke_color) || $sl_stroke_color == "") {
            $sl_stroke_color = "FF0000";
        }
        if (!isset($sl_stroke_opacity) || $sl_stroke_opacity == "") {
            $sl_stroke_opacity = "0.25";
        }
        if (!isset($sl_fill_color) || $sl_fill_color == "") {
            $sl_fill_color = "FF0000";
        }
        if (!isset($sl_fill_opacity) || $sl_fill_opacity == "") {
            $sl_fill_opacity = "0.15";
        }
        
        if (isset($other_settings_data['iw_primary_color'])) { $iw_primary_color = $other_settings_data['iw_primary_color']; }
        if (isset($other_settings_data['iw_accent_color'])) { $iw_accent_color = $other_settings_data['iw_accent_color']; }
        if (isset($other_settings_data['iw_text_color'])) { $iw_text_color = $other_settings_data['iw_text_color']; }

        if (!isset($iw_primary_color) || $iw_primary_color == "") {
            $iw_primary_color = "2A3744";
        }
        if (!isset($iw_accent_color) || $iw_accent_color == "") {
            $iw_accent_color = "252F3A";
        }
        if (!isset($iw_text_color) || $iw_text_color == "") {
            $iw_text_color = "FFFFFF";
        }

		if (isset($other_settings_data['wpgmza_iw_type'])) { $infowwindow_sel_checked[$other_settings_data['wpgmza_iw_type']] = "checked"; $wpgmza_iw_class[$other_settings_data['wpgmza_iw_type']] = "wpgmza_mlist_selection_activate"; } else {  $wpgmza_iw_type = false; }



		for ($i=0;$i<4;$i++) {
            if (!isset($wpgmza_iw_class[$i])) { $wpgmza_iw_class[$i] = ""; }
        }
		for ($i=0;$i<4;$i++) {
            if (!isset($infowwindow_sel_checked[$i])) { $infowwindow_sel_checked[$i] = ""; }
        }	
		

        if ($infowwindow_sel_checked[0] == "checked") {
        	$infowwindow_sel_text = __("Default Infowindow","wp-google-maps");
        } else if ($infowwindow_sel_checked[1] == "checked") {
        	$infowwindow_sel_text = __("Modern Infowindow","wp-google-maps");
        } else if ($infowwindow_sel_checked[2] == "checked") {
        	$infowwindow_sel_text = __("Modern Plus Infowindow","wp-google-maps");
        }else if ($infowwindow_sel_checked[3] == "checked") {
        	$infowwindow_sel_text = __("Circular Infowindow","wp-google-maps");
        }else {
        	$infowwindow_sel_text = __("Currently using your selection chosen in the global settings","wp-google-maps");
        }


	    if (isset($other_settings_data['wpgmza_theme_selection'])) { $theme_sel_checked[$other_settings_data['wpgmza_theme_selection']] = "checked"; $wpgmza_theme_class[$other_settings_data['wpgmza_theme_selection']] = "wpgmza_theme_selection_activate"; } else {  $wpgmza_theme = false; $wpgmza_theme_class[0] = "wpgmza_theme_selection_activate"; }
	    for ($i=0;$i<9;$i++) {
	        if (!isset($wpgmza_theme_class[$i])) { $wpgmza_theme_class[$i] = ""; }
	    }
	    for ($i=0;$i<9;$i++) {
	        if (!isset($theme_sel_checked[$i])) { $theme_sel_checked[$i] = ""; }
	    }   
	    global $wpgmza_version;
	    $v_check = str_replace(".","",$wpgmza_version);

	    if (intval($v_check) < 6300) {
	    	$theme_version_check = "<br /><p><div class='update-nag'>Please <a href='update-core.php'>update your WP Google Maps</a> free version to 6.3.00 to make use of this feautre</div></p><br /><br />";
	    } else {
	    	$theme_version_check = "";
	    }

        
	    if( isset( $other_settings_data['wpgmza_theme_data'] ) ){
	        $wpgmza_theme_data_custom = $other_settings_data['wpgmza_theme_data'];
	    } else {
	        $wpgmza_theme_data_custom  = '';
	    }
        
        $wpgmza_weather_layer_checked[0] = '';
        $wpgmza_weather_layer_checked[1] = '';
        $wpgmza_weather_layer_temp_type_checked[0] = '';
        $wpgmza_weather_layer_temp_type_checked[1] = '';
        
        $wpgmza_cloud_layer_checked[0] = '';
        $wpgmza_cloud_layer_checked[1] = '';
        $wpgmza_transport_layer_checked[0] = '';
        $wpgmza_transport_layer_checked[1] = '';
        
        
        if ($wpgmza_weather_option == 1) {
            $wpgmza_weather_layer_checked[0] = 'checked';
        } else {
            $wpgmza_weather_layer_checked[1] = 'checked';
        }
        if ($wpgmza_weather_option_temp_type == 1) {
            $wpgmza_weather_layer_temp_type_checked[0] = 'checked';
        } else {
            $wpgmza_weather_layer_temp_type_checked[1] = 'checked';
        }
        if ($wpgmza_cloud_option == 1) {
            $wpgmza_cloud_layer_checked[0] = 'checked';
        } else {
            $wpgmza_cloud_layer_checked[1] = 'checked';
        }
        if ($wpgmza_transport_option == 1) {
            $wpgmza_transport_layer_checked[0] = 'checked';
        } else {
            $wpgmza_transport_layer_checked[1] = 'checked';
        }

        $def_ul_marker = isset($other_settings_data['upload_default_ul_marker']) ? $other_settings_data['upload_default_ul_marker'] : "";
        if ($def_ul_marker == "") { $display_ul_marker = "<img src=\"".wpgmaps_get_plugin_url()."/images/marker.png\" />"; } else { $display_ul_marker = "<img src=\"".$def_ul_marker."\" />"; }

        $def_sl_marker = isset($other_settings_data['upload_default_sl_marker']) ? $other_settings_data['upload_default_sl_marker'] : "";
        if ($def_sl_marker == "") { $display_sl_marker = "<img src=\"".wpgmaps_get_plugin_url()."/images/marker.png\" />"; } else { $display_sl_marker = "<img src=\"".$def_sl_marker."\" />"; }
        
        $wpgmza_csv = "<a href=\"".wpgmaps_get_plugin_url()."/csv.php\" title=\"".__("Download this as a CSV file","wp-google-maps")."\">".__("Download this data as a CSV file","wp-google-maps")."</a>";

        

    }

    if($_GET['action'] != "wizard"){

	    global $wpgmza_version;
	    $wpgmza_vc = floatval(str_replace(".","",$wpgmza_version));
	    
	    if ($wpgmza_vc < 6312) {
	    	$wpgmza_string_heatmaps = "<span class='update-nag update-blue'>".__("Please update your basic version to use this function.","wp-google-maps")."</span>";
	    } else {
			$wpgmza_string_heatmaps = "<span id=\"wpgmza_addheatmap_div\"><a href='".get_option('siteurl')."/wp-admin/admin.php?page=wp-google-maps-menu&action=add_heatmap&map_id=".$_GET['map_id']."' id='wpgmza_addheatmap' class='button-primary' value='".__("Add a New Dataset","wp-google-maps")."' />".__("Add a New Dataset","wp-google-maps")."</a></span><div id=\"wpgmza_heatmap_holder\">".wpgmza_b_return_heatmaps_list($_GET['map_id'])."</div>";
	    }

    	if( function_exists( 'wpgmza_caching_notice_changes' ) ){    		
    		$wpgmza_caching_notices = wpgmza_caching_notice_changes( true, true );
    	} else {
    		$wpgmza_caching_notices = "";
    	}
	    

    echo "
       <div class='wrap'>
    
    
    
    
    
    
        <h1>WP Google Maps <small>($addon_text)</small></h1>
        <div class='wide'>
                ".wpgmza_version_check()."
                <h2>".__("Create your Map","wp-google-maps")." <a href=\"admin.php?page=wp-google-maps-menu&action=new\" class=\"add-new-h2 add-new-editor\">".__("New","wp-google-maps")."</a> <div class='update-nag update-blue update-slim' id='wpmgza_unsave_notice' style='display:none;'> Unsaved data will be lost</div> </h2>

    
        <form action='' method='post' id='wpgmaps_options' name='wpgmza_map_form'>

        <div id=\"wpgmaps_tabs\">
                <ul>
                        <li><a href=\"#tabs-1\">".__("General Settings","wp-google-maps")."</a></li>
                        <li><a href=\"#tabs-7\">".__("Themes","wp-google-maps")."</a></li>
                        <li><a href=\"#tabs-2\">".__("Directions","wp-google-maps")."</a></li>
                        <li><a href=\"#tabs-3\">".__("Store Locator","wp-google-maps")."</a></li>
                        <li><a href=\"#tabs-4\">".__("Advanced Settings","wp-google-maps")."</a></li>
                        <li><a href=\"#tabs-5\">".__("Marker Listing Options","wp-google-maps")."</a></li>
                        ".apply_filters("wpgmaps_filter_pro_map_editor_tabs","")."
                </ul>
                <div id=\"tabs-1\">

                     
            
                    <p></p>

                        <input type='hidden' name='http_referer' value='".$_SERVER['PHP_SELF']."' />
                        <input type='hidden' name='wpgmza_id' id='wpgmza_id' value='".$res->id."' />
                        <input id='wpgmza_start_location' name='wpgmza_start_location' type='hidden' size='40' maxlength='100' value='".$res->map_start_location."' />
                        <select id='wpgmza_start_zoom' name='wpgmza_start_zoom' style=\"display:none;\">
                            <option value=\"1\" ".$wpgmza_zoom[1].">1</option>
                            <option value=\"2\" ".$wpgmza_zoom[2].">2</option>
                            <option value=\"3\" ".$wpgmza_zoom[3].">3</option>
                            <option value=\"4\" ".$wpgmza_zoom[4].">4</option>
                            <option value=\"5\" ".$wpgmza_zoom[5].">5</option>
                            <option value=\"6\" ".$wpgmza_zoom[6].">6</option>
                            <option value=\"7\" ".$wpgmza_zoom[7].">7</option>
                            <option value=\"8\" ".$wpgmza_zoom[8].">8</option>
                            <option value=\"9\" ".$wpgmza_zoom[9].">9</option>
                            <option value=\"10\" ".$wpgmza_zoom[10].">10</option>
                            <option value=\"11\" ".$wpgmza_zoom[11].">11</option>
                            <option value=\"12\" ".$wpgmza_zoom[12].">12</option>
                            <option value=\"13\" ".$wpgmza_zoom[13].">13</option>
                            <option value=\"14\" ".$wpgmza_zoom[14].">14</option>
                            <option value=\"15\" ".$wpgmza_zoom[15].">15</option>
                            <option value=\"16\" ".$wpgmza_zoom[16].">16</option>
                            <option value=\"17\" ".$wpgmza_zoom[17].">17</option>
                            <option value=\"18\" ".$wpgmza_zoom[18].">18</option>
                            <option value=\"19\" ".$wpgmza_zoom[19].">19</option>
                            <option value=\"20\" ".$wpgmza_zoom[20].">20</option>
                            <option value=\"21\" ".$wpgmza_zoom[21].">21</option>
                        </select>

                    <table>
                        <tr>
                            <td>".__("Short code","wp-google-maps").":</td>
                            <td><input type='text' readonly name='shortcode' class='wpgmza_copy_shortcode' style='font-size:18px; text-align:center;' value='[wpgmza id=\"".$res->id."\"]' /> <small><i>".__("copy this into your post or page to display the map","wp-google-maps")."</i>
                        </td>
                        </tr>
                        <tr>
                            <td>".__("Map Name","wp-google-maps").":</td>
                            <td><input id='wpgmza_title' name='wpgmza_title' class='regular-text' type='text' size='20' maxlength='50' value='".$res->map_title."' /></td>
                        </tr>
                        <tr>
                            <td>".__("Zoom Level","wp-google-maps").":</td>
                            <td>
                            <input type=\"text\" id=\"amount\" style=\"display:none;\"  value=\"$res->map_start_zoom\"><div id=\"slider-range-max\"></div>
                            </td>
                        </tr>

                        <tr>
                                     <td>".__("Width","wp-google-maps").":</td>
                                     <td>
                                     <input id='wpgmza_width' name='wpgmza_width' type='text' size='4' maxlength='4' value='".$res->map_width."' />
                                     <select id='wpgmza_map_width_type' name='wpgmza_map_width_type'>
                                        <option value=\"px\" $wpgmza_map_width_type_px>px</option>
                                        <option value=\"%\" $wpgmza_map_width_type_percentage>%</option>
                                     </select>
                                     <small><em>".__("Set to 100% for a responsive map","wp-google-maps")."</em></small>

                                    </td>
                                </tr>
                                <tr>
                                    <td>".__("Height","wp-google-maps").":</td>
                                    <td><input id='wpgmza_height' name='wpgmza_height' type='text' size='4' maxlength='4' value='".$res->map_height."' />
                                     <select id='wpgmza_map_height_type' name='wpgmza_map_height_type'>
                                        <option value=\"px\" $wpgmza_map_height_type_px>px</option>
                                        <option value=\"%\" $wpgmza_map_height_type_percentage>%</option>
                                     </select><span style='display:none; width:200px; font-size:10px;' id='wpgmza_height_warning'>".__("We recommend that you leave your height in PX. Depending on your theme, using % for the height may break your map.","wp-google-maps")."</span>

                                    </td>
                                </tr>

                    </table>
                    
            
            
                </div>

                <div id=\"tabs-7\">
                    <p>".__("Select a theme for your map","wp-google-maps")."</p>


                    ".$theme_version_check."
							<table class='' id='wpgmaps_theme_table'>

                                <tr>
                                    <td width='50%'>        
                                        <img src=\"".WPGMAPS_DIR."/images/theme_0.jpg\" title=\"Default\" id=\"wpgmza_theme_selection_0\" width=\"200\" class=\"wpgmza_theme_selection ".$wpgmza_theme_class[0]."\" tid=\"0\">     
                                        <img src=\"".WPGMAPS_DIR."/images/theme_1.jpg\" title=\"Blue\" id=\"wpgmza_theme_selection_1\" width=\"200\" class=\"wpgmza_theme_selection ".$wpgmza_theme_class[1]."\"  tid=\"1\">     
                                        <img src=\"".WPGMAPS_DIR."/images/theme_2.jpg\" title=\"Apple Maps\" id=\"wpgmza_theme_selection_2\" width=\"200\" class=\"wpgmza_theme_selection ".$wpgmza_theme_class[2]."\"  tid=\"2\">     
                                        <img src=\"".WPGMAPS_DIR."/images/theme_3.jpg\" title=\"Grayscale\" id=\"wpgmza_theme_selection_3\" width=\"200\" class=\"wpgmza_theme_selection ".$wpgmza_theme_class[3]."\"  tid=\"3\">     
                                        <img src=\"".WPGMAPS_DIR."/images/theme_4.jpg\" title=\"Pale\" id=\"wpgmza_theme_selection_4\" width=\"200\" class=\"wpgmza_theme_selection ".$wpgmza_theme_class[4]."\"  tid=\"4\">     
                                        <img src=\"".WPGMAPS_DIR."/images/theme_5.jpg\" title=\"Red\" id=\"wpgmza_theme_selection_5\" width=\"200\" class=\"wpgmza_theme_selection ".$wpgmza_theme_class[5]."\"  tid=\"5\">     
                                        <img src=\"".WPGMAPS_DIR."/images/theme_6.jpg\" title=\"Dark Grey\" id=\"wpgmza_theme_selection_6\" width=\"200\" class=\"wpgmza_theme_selection ".$wpgmza_theme_class[6]."\"  tid=\"6\">     
                                        <img src=\"".WPGMAPS_DIR."/images/theme_7.jpg\" title=\"Monochrome\" id=\"wpgmza_theme_selection_7\" width=\"200\" class=\"wpgmza_theme_selection ".$wpgmza_theme_class[7]."\"  tid=\"7\">     
                                        <img src=\"".WPGMAPS_DIR."/images/theme_8.jpg\" title=\"Old Fashioned\" id=\"wpgmza_theme_selection_8\" width=\"200\" class=\"wpgmza_theme_selection ".$wpgmza_theme_class[8]."\"  tid=\"8\">     
                                        <input type=\"radio\" name=\"wpgmza_theme\" id=\"rb_wpgmza_theme_0\" value=\"0\" ".$theme_sel_checked[0]." class=\"wpgmza_theme_radio wpgmza_hide_input\">
                                        <input type=\"radio\" name=\"wpgmza_theme\" id=\"rb_wpgmza_theme_1\" value=\"1\" ".$theme_sel_checked[1]." class=\"wpgmza_theme_radio wpgmza_hide_input\">
                                        <input type=\"radio\" name=\"wpgmza_theme\" id=\"rb_wpgmza_theme_2\" value=\"2\" ".$theme_sel_checked[2]." class=\"wpgmza_theme_radio wpgmza_hide_input\">
                                        <input type=\"radio\" name=\"wpgmza_theme\" id=\"rb_wpgmza_theme_3\" value=\"3\" ".$theme_sel_checked[3]." class=\"wpgmza_theme_radio wpgmza_hide_input\">
                                        <input type=\"radio\" name=\"wpgmza_theme\" id=\"rb_wpgmza_theme_4\" value=\"4\" ".$theme_sel_checked[4]." class=\"wpgmza_theme_radio wpgmza_hide_input\">
                                        <input type=\"radio\" name=\"wpgmza_theme\" id=\"rb_wpgmza_theme_5\" value=\"5\" ".$theme_sel_checked[5]." class=\"wpgmza_theme_radio wpgmza_hide_input\">
                                        <input type=\"radio\" name=\"wpgmza_theme\" id=\"rb_wpgmza_theme_6\" value=\"6\" ".$theme_sel_checked[6]." class=\"wpgmza_theme_radio wpgmza_hide_input\">
                                        <input type=\"radio\" name=\"wpgmza_theme\" id=\"rb_wpgmza_theme_7\" value=\"7\" ".$theme_sel_checked[7]." class=\"wpgmza_theme_radio wpgmza_hide_input\">
                                        <input type=\"radio\" name=\"wpgmza_theme\" id=\"rb_wpgmza_theme_8\" value=\"8\" ".$theme_sel_checked[8]." class=\"wpgmza_theme_radio wpgmza_hide_input\">
                                        <textarea name=\"wpgmza_theme_data_0\" id=\"rb_wpgmza_theme_data_0\" class=\"wpgmza_hide_input\">"."[ \"visibility\", \"invert_lightness\", \"color\", \"weight\", \"hue\", \"saturation\", \"lightness\", \"gamma\"]"."</textarea>
                                        <textarea name=\"wpgmza_theme_data_1\" id=\"rb_wpgmza_theme_data_1\" class=\"wpgmza_hide_input\">"."[{\"featureType\": \"administrative\",\"elementType\": \"labels.text.fill\",\"stylers\": [{\"color\": \"#444444\"}]},{\"featureType\": \"landscape\",\"elementType\": \"all\",\"stylers\": [{\"color\": \"#f2f2f2\"}]},{\"featureType\": \"poi\",\"elementType\": \"all\",\"stylers\": [{\"visibility\": \"off\"}]},{\"featureType\": \"road\",\"elementType\": \"all\",\"stylers\": [{\"saturation\": -100},{\"lightness\": 45}]},{\"featureType\": \"road.highway\",\"elementType\": \"all\",\"stylers\": [{\"visibility\": \"simplified\"}]},{\"featureType\": \"road.arterial\",\"elementType\": \"labels.icon\",\"stylers\": [{\"visibility\": \"off\"}]},{\"featureType\": \"transit\",\"elementType\": \"all\",\"stylers\": [{\"visibility\": \"off\"}]},{\"featureType\": \"water\",\"elementType\": \"all\",\"stylers\": [{\"color\": \"#46bcec\"},{\"visibility\": \"on\"}]}]"."</textarea>
                                        <textarea name=\"wpgmza_theme_data_2\" id=\"rb_wpgmza_theme_data_2\" class=\"wpgmza_hide_input\">"."[{\"featureType\":\"landscape.man_made\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#f7f1df\"}]},{\"featureType\":\"landscape.natural\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#d0e3b4\"}]},{\"featureType\":\"landscape.natural.terrain\",\"elementType\":\"geometry\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"poi\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"poi.business\",\"elementType\":\"all\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"poi.medical\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#fbd3da\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#bde6ab\"}]},{\"featureType\":\"road\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"road\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"#ffe15f\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#efd151\"}]},{\"featureType\":\"road.arterial\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"#ffffff\"}]},{\"featureType\":\"road.local\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"black\"}]},{\"featureType\":\"transit.station.airport\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"#cfb2db\"}]},{\"featureType\":\"water\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#a2daf2\"}]}]"."</textarea>
                                        <textarea name=\"wpgmza_theme_data_3\" id=\"rb_wpgmza_theme_data_3\" class=\"wpgmza_hide_input\">"."[{\"featureType\":\"landscape\",\"stylers\":[{\"saturation\":-100},{\"lightness\":65},{\"visibility\":\"on\"}]},{\"featureType\":\"poi\",\"stylers\":[{\"saturation\":-100},{\"lightness\":51},{\"visibility\":\"simplified\"}]},{\"featureType\":\"road.highway\",\"stylers\":[{\"saturation\":-100},{\"visibility\":\"simplified\"}]},{\"featureType\":\"road.arterial\",\"stylers\":[{\"saturation\":-100},{\"lightness\":30},{\"visibility\":\"on\"}]},{\"featureType\":\"road.local\",\"stylers\":[{\"saturation\":-100},{\"lightness\":40},{\"visibility\":\"on\"}]},{\"featureType\":\"transit\",\"stylers\":[{\"saturation\":-100},{\"visibility\":\"simplified\"}]},{\"featureType\":\"administrative.province\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"water\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"on\"},{\"lightness\":-25},{\"saturation\":-100}]},{\"featureType\":\"water\",\"elementType\":\"geometry\",\"stylers\":[{\"hue\":\"#ffff00\"},{\"lightness\":-25},{\"saturation\":-97}]}]"."</textarea>
                                        <textarea name=\"wpgmza_theme_data_4\" id=\"rb_wpgmza_theme_data_4\" class=\"wpgmza_hide_input\">"."[{\"featureType\":\"administrative\",\"elementType\":\"all\",\"stylers\":[{\"visibility\":\"on\"},{\"lightness\":33}]},{\"featureType\":\"landscape\",\"elementType\":\"all\",\"stylers\":[{\"color\":\"#f2e5d4\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#c5dac6\"}]},{\"featureType\":\"poi.park\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"on\"},{\"lightness\":20}]},{\"featureType\":\"road\",\"elementType\":\"all\",\"stylers\":[{\"lightness\":20}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#c5c6c6\"}]},{\"featureType\":\"road.arterial\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#e4d7c6\"}]},{\"featureType\":\"road.local\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#fbfaf7\"}]},{\"featureType\":\"water\",\"elementType\":\"all\",\"stylers\":[{\"visibility\":\"on\"},{\"color\":\"#acbcc9\"}]}]"."</textarea>
                                        <textarea name=\"wpgmza_theme_data_5\" id=\"rb_wpgmza_theme_data_5\" class=\"wpgmza_hide_input\">[{\"stylers\": [ {\"hue\": \"#890000\"}, {\"visibility\": \"simplified\"}, {\"gamma\": 0.5}, {\"weight\": 0.5} ] }, { \"elementType\": \"labels\", \"stylers\": [{\"visibility\": \"off\"}] }, { \"featureType\": \"water\", \"stylers\": [{\"color\": \"#890000\"}] } ]</textarea>
                                        <textarea name=\"wpgmza_theme_data_6\" id=\"rb_wpgmza_theme_data_6\" class=\"wpgmza_hide_input\">[{\"featureType\":\"all\",\"elementType\":\"labels.text.fill\",\"stylers\":[{\"saturation\":36},{\"color\":\"#000000\"},{\"lightness\":40}]},{\"featureType\":\"all\",\"elementType\":\"labels.text.stroke\",\"stylers\":[{\"visibility\":\"on\"},{\"color\":\"#000000\"},{\"lightness\":16}]},{\"featureType\":\"all\",\"elementType\":\"labels.icon\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"administrative\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"#000000\"},{\"lightness\":20}]},{\"featureType\":\"administrative\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#000000\"},{\"lightness\":17},{\"weight\":1.2}]},{\"featureType\":\"landscape\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#000000\"},{\"lightness\":20}]},{\"featureType\":\"poi\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#000000\"},{\"lightness\":21}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry.fill\",\"stylers\":[{\"color\":\"#000000\"},{\"lightness\":17}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry.stroke\",\"stylers\":[{\"color\":\"#000000\"},{\"lightness\":29},{\"weight\":0.2}]},{\"featureType\":\"road.arterial\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#000000\"},{\"lightness\":18}]},{\"featureType\":\"road.local\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#000000\"},{\"lightness\":16}]},{\"featureType\":\"transit\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#000000\"},{\"lightness\":19}]},{\"featureType\":\"water\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#000000\"},{\"lightness\":17}]}]</textarea>
                                        <textarea name=\"wpgmza_theme_data_7\" id=\"rb_wpgmza_theme_data_7\" class=\"wpgmza_hide_input\">[{\"featureType\":\"administrative.locality\",\"elementType\":\"all\",\"stylers\":[{\"hue\":\"#2c2e33\"},{\"saturation\":7},{\"lightness\":19},{\"visibility\":\"on\"}]},{\"featureType\":\"landscape\",\"elementType\":\"all\",\"stylers\":[{\"hue\":\"#ffffff\"},{\"saturation\":-100},{\"lightness\":100},{\"visibility\":\"simplified\"}]},{\"featureType\":\"poi\",\"elementType\":\"all\",\"stylers\":[{\"hue\":\"#ffffff\"},{\"saturation\":-100},{\"lightness\":100},{\"visibility\":\"off\"}]},{\"featureType\":\"road\",\"elementType\":\"geometry\",\"stylers\":[{\"hue\":\"#bbc0c4\"},{\"saturation\":-93},{\"lightness\":31},{\"visibility\":\"simplified\"}]},{\"featureType\":\"road\",\"elementType\":\"labels\",\"stylers\":[{\"hue\":\"#bbc0c4\"},{\"saturation\":-93},{\"lightness\":31},{\"visibility\":\"on\"}]},{\"featureType\":\"road.arterial\",\"elementType\":\"labels\",\"stylers\":[{\"hue\":\"#bbc0c4\"},{\"saturation\":-93},{\"lightness\":-2},{\"visibility\":\"simplified\"}]},{\"featureType\":\"road.local\",\"elementType\":\"geometry\",\"stylers\":[{\"hue\":\"#e9ebed\"},{\"saturation\":-90},{\"lightness\":-8},{\"visibility\":\"simplified\"}]},{\"featureType\":\"transit\",\"elementType\":\"all\",\"stylers\":[{\"hue\":\"#e9ebed\"},{\"saturation\":10},{\"lightness\":69},{\"visibility\":\"on\"}]},{\"featureType\":\"water\",\"elementType\":\"all\",\"stylers\":[{\"hue\":\"#e9ebed\"},{\"saturation\":-78},{\"lightness\":67},{\"visibility\":\"simplified\"}]}]</textarea>
                                        <textarea name=\"wpgmza_theme_data_8\" id=\"rb_wpgmza_theme_data_8\" class=\"wpgmza_hide_input\">[{\"featureType\":\"administrative\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"poi\",\"stylers\":[{\"visibility\":\"simplified\"}]},{\"featureType\":\"road\",\"elementType\":\"labels\",\"stylers\":[{\"visibility\":\"simplified\"}]},{\"featureType\":\"water\",\"stylers\":[{\"visibility\":\"simplified\"}]},{\"featureType\":\"transit\",\"stylers\":[{\"visibility\":\"simplified\"}]},{\"featureType\":\"landscape\",\"stylers\":[{\"visibility\":\"simplified\"}]},{\"featureType\":\"road.highway\",\"stylers\":[{\"visibility\":\"off\"}]},{\"featureType\":\"road.local\",\"stylers\":[{\"visibility\":\"on\"}]},{\"featureType\":\"road.highway\",\"elementType\":\"geometry\",\"stylers\":[{\"visibility\":\"on\"}]},{\"featureType\":\"water\",\"stylers\":[{\"color\":\"#84afa3\"},{\"lightness\":52}]},{\"stylers\":[{\"saturation\":-17},{\"gamma\":0.36}]},{\"featureType\":\"transit.line\",\"elementType\":\"geometry\",\"stylers\":[{\"color\":\"#3f518c\"}]}]</textarea>
                                    </td>
                                    <td width='50%'>
                                    <h3>".__("Or use a custom theme","wp-google-maps")."</h3>
                                    <p><a href='http://www.wpgmaps.com/map-themes/?utm_source=plugin&utm_medium=link&utm_campaign=browse_themes' title='' target='_BLANK' class='button button-primary'>".__("Browse the theme directory","wp-google-maps")."</a></p>
                                    <p>".__("Paste your custom theme data here:","wp-google-maps")."</p>
                                        <textarea name=\"wpgmza_styling_json\" id=\"wpgmza_styling_json\" rows=\"8\" cols=\"40\">".stripslashes($wpgmza_theme_data_custom)."</textarea>
                                    <p><a href='javascript:void(0);' title='".__("Preview","wp-google-maps")."' class='button button-seconday' id='wpgmza_preview_theme'>".__("Preview","wp-google-maps")."</a></p>
                                    </td>

                                </tr>
                                <tr>
                                <td>
                                    <p>

                                    </p>
                                </td>
                                </tr>
                            </table>

                </div>
                <div id=\"tabs-2\">
                    <table class='' id='wpgmaps_advanced_options'>
                        
                        <tr>
                            <td width='200'>".__("Enable Directions?","wp-google-maps").":</td>
                            <td><!--<select id='wpgmza_directions' name='wpgmza_directions' class='postform'>
                                <option value=\"1\" ".$wpgmza_directions[1].">".__("Yes","wp-google-maps")."</option>
                                <option value=\"2\" ".$wpgmza_directions[2].">".__("No","wp-google-maps")."</option>
                            </select>-->
                            <div class='switch'>
                            	<input type='checkbox' id='wpgmza_directions' name='wpgmza_directions' class='postform cmn-toggle cmn-toggle-yes-no cmn' ".$wpgmza_directions[1]."> <label class='cmn-override-big' for='wpgmza_directions' data-on='Yes' data-off='No'></label>
                            </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                            ".__("Directions Box Open by Default?","wp-google-maps").":
                            </td>
                            <td>
                            <select id='wpgmza_dbox' name='wpgmza_dbox' class='postform'>
                                <option value=\"1\" ".$wpgmza_dbox[1].">".__("No","wp-google-maps")."</option>
                                <option value=\"2\" ".$wpgmza_dbox[2].">".__("Yes, on the left","wp-google-maps")."</option>
                                <option value=\"3\" ".$wpgmza_dbox[3].">".__("Yes, on the right","wp-google-maps")."</option>
                                <option value=\"4\" ".$wpgmza_dbox[4].">".__("Yes, above","wp-google-maps")."</option>
                                <option value=\"5\" ".$wpgmza_dbox[5].">".__("Yes, below","wp-google-maps")."</option>
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ".__("Directions Box Width","wp-google-maps").":
                            </td>
                            <td>
                                <input id='wpgmza_dbox_width' name='wpgmza_dbox_width' type='text' size='4' maxlength='4' class='small-text' value='".$res->dbox_width."' /> 
                                <select id='wpgmza_dbox_width_type' name='wpgmza_dbox_width_type' class='postform'>
	                                <option value=\"px\" ".$wpgmza_dbox_width_type[1].">".__("px","wp-google-maps")."</option>
	                                <option value=\"%\" ".$wpgmza_dbox_width_type[2].">".__("%","wp-google-maps")."</option>
                            	</select>
                            </td>
                        </tr>
                        <tr>
                            <td>".__("Default 'To' address","wp-google-maps").":</td>
                            <td>
                             <input id='wpgmza_default_to' name='wpgmza_default_to' type='text' size='100' maxlength='700' class='regular-text' value='".$res->default_to."' /></td>
                            </td>
                        </tr>
                        </table>

                        
                            

            
    
                </div>
                <div id=\"tabs-3\">
                    <table class='' id='wpgmaps_directions_options'>
                        <tr>
                            <td><h3>".__("General options","wp-google-maps").":</h3></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td width='400'>".__("Enable Store Locator","wp-google-maps").":</td>
                            <td><div class='switch'>
                                    <input type='checkbox' id='wpgmza_store_locator' name='wpgmza_store_locator' class='postform cmn-toggle cmn-toggle-yes-no' ".$wpgmza_store_locator_enabled_checked."> <label class='cmn-override-big' for='wpgmza_store_locator' data-on='".__("Yes","wp-google-maps")."' data-off='".__("No","wp-google-maps")."''></label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width='400'>".__("Restrict to country","wp-google-maps").":</td>
                            <td>";
                            if( function_exists('wpgmza_return_country_tld_array') ){ 

                                echo "<select name='wpgmza_store_locator_restrict' id='wpgmza_store_locator_restrict'>";
                                
                                $countries = wpgmza_return_country_tld_array();

                                if( $countries ){
                                    echo "<option value=''>".__('No country selected', 'wp-google-maps')."</option>";
                                    foreach( $countries as $key => $val ){

                                        if( $key == $wpgmza_store_locator_restrict ){ $selected = 'selected'; } else { $selected = ''; }
                                        echo "<option value='$key' $selected>$val</option>";

                                    }

                                }
                                echo "</select></td>";
                            } else {
                            	echo "
                            <input type=\"text\" name=\"wpgmza_store_locator_restrict\" id=\"wpgmza_store_locator_restrict\" value=\"$wpgmza_store_locator_restrict\" style='width:110px;' placeholder='Country TLD'> <small><em>".__("Insert country TLD. For example, use DE for Germany.","wp-google-maps")." ".__("Leave blank for no restrictions.","wp-google-maps")."</em></small></td>";
                        }
                        echo "
                        </tr>

                        <tr>
                            <td>".__("Show distance in","wp-google-maps").":</td>
                            <td>
                            	<div class='switch'>
                                        <input type='checkbox' id='wpgmza_store_locator_distance' name='wpgmza_store_locator_distance' class='postform cmn-toggle cmn-toggle-yes-no' ".$wpgmza_store_locator_distance_checked."> <label class='cmn-override-big-wide' for='wpgmza_store_locator_distance' data-on='".__("Miles","wp-google-maps")."' data-off='".__("Kilometers","wp-google-maps")."''></label>
                                </div>
                            </td>
                        </tr>

                         <tr>
                            <td>".__("Store Locator Placement","wp-google-maps").":</td>
                            <td>
                            	<div class='switch'>
                                        <input type='checkbox' id='wpgmza_store_locator_position' name='wpgmza_store_locator_position' class='postform cmn-toggle cmn-toggle-yes-no' ".$wpgmza_store_locator_below_checked."> <label class='cmn-override-big-wide' for='wpgmza_store_locator_position' data-on='".__("Below Map","wp-google-maps")."' data-off='".__("Above Map","wp-google-maps")."''></label>
                                </div>
                            </td>
                        </tr>
                        
                        <tr>
                            <td>".__("Allow category selection","wp-google-maps").":</td>
                            <td>
                            	<div class='switch'>
                                        <input type='checkbox' id='wpgmza_store_locator_category_enabled' name='wpgmza_store_locator_category_enabled' class='postform cmn-toggle cmn-toggle-round-flat' ".$wpgmza_store_locator_category_checked."> <label for='wpgmza_store_locator_category_enabled'></label>
                                </div>
                            </td>
                        </tr>
						<tr>
                            <td width='400'>".__("Allow users to use their location as the starting point","wp-google-maps").":</td>
                            <td>
                                <div class='switch'>
                                        <input type='checkbox' id='wpgmza_store_locator_use_their_location' name='wpgmza_store_locator_use_their_location' class='postform cmn-toggle cmn-toggle-round-flat' ".$wpgmza_store_locator_use_their_location_checked."> <label for='wpgmza_store_locator_use_their_location'></label>
                                </div>
                                <small><em>".__("Please ensure that \"show user's location\" is enabled in the \"Advanced Settings\" tab.","wp-google-maps")."</em></small>
                            </td>
                        </tr>
                        <tr>
                            <td width='400'>".__("Show center point as an icon","wp-google-maps").":</td>
                            <td>
                                <div class='switch'>
                                        <input type='checkbox' id='wpgmza_store_locator_bounce' name='wpgmza_store_locator_bounce' class='postform cmn-toggle cmn-toggle-round-flat' ".$wpgmza_store_locator_bounce_checked."> <label for='wpgmza_store_locator_bounce'></label>
                                </div>
                            </td>
                        </tr>
                        <tr id='wpgmza_store_locator_bounce_conditional' style='display:none;'>
                            <td><label for=\"upload_default_sl_marker\">".__("Default Icon","wp-google-maps")."</label></td>
                            <td><span id=\"wpgmza_mm_sl\">$display_sl_marker</span> <input id=\"upload_default_sl_marker\" name=\"upload_default_sl_marker\" type='hidden' size='35' class='regular-text' maxlength='700' value='".$def_sl_marker."' /> <input style='position: relative;' class='wpgmza_general_btn' id=\"upload_default_sl_marker_btn\" type=\"button\" value=\"".__("Upload Icon","wp-google-maps")."\"  /> <a class='wpgmza_file_select_btn' style='position: relative;' href=\"javascript:void(0);\" onClick=\"document.forms['wpgmza_map_form'].upload_default_sl_marker.value = ''; var span = document.getElementById('wpgmza_mm_sl'); while( span.firstChild ) { span.removeChild( span.firstChild ); } span.appendChild( document.createTextNode('')); return false;\" title=\"Reset to default\">Reset</a> &nbsp; &nbsp;</td>
                        </tr>
                        <tr>
                            <td>".__("Marker animation","wp-google-maps").": </td>
                            <td>
                                <select name=\"wpgmza_sl_animation\" id=\"wpgmza_sl_animation\">
                                    <option value=\"0\" ".$wpgmza_sl_animation[0].">".__("None","wp-google-maps")."</option>
                                    <option value=\"1\" ".$wpgmza_sl_animation[1].">".__("Bounce","wp-google-maps")."</option>
                                    <option value=\"2\" ".$wpgmza_sl_animation[2].">".__("Drop","wp-google-maps")."</option>
                            </td>
                        </tr>

                        <tr>
                            <td width='400'>".__("Hide all markers until a search is done","wp-google-maps").":</td>
                            <td>
                                <div class='switch'>
                                        <input type='checkbox' id='wpgmza_store_locator_hide_before_search' name='wpgmza_store_locator_hide_before_search' class='postform cmn-toggle cmn-toggle-round-flat' ".$wpgmza_store_locator_hide_before_search_checked."> <label for='wpgmza_store_locator_hide_before_search'></label>
                                </div>

                            </td>
                        </tr>
                        <tr style='height:20px;'>
                            <td></td>
                            <td></td>

                        </tr>
                        <tr>
                            <td>".__("Query String","wp-google-maps").":</td>
                            <td><input type=\"text\" name=\"wpgmza_store_locator_query_string\" id=\"wpgmza_store_locator_query_string\" value=\"$wpgmza_store_locator_query_string\">
                            </td>
                        </tr>
                        <tr>
                            <td>".__("Default address","wp-google-maps").":</td>
                            <td><input type=\"text\" name=\"wpgmza_store_locator_default_address\" id=\"wpgmza_store_locator_default_address\" value=\"".esc_attr($wpgmza_store_locator_default_address)."\">
                            </td>
                        </tr>

                        <tr>
                            <td width='400'>".__("Enable title search","wp-google-maps").":</td>
                            <td>

                                <div class='switch'>
                                        <input type='checkbox' id='wpgmza_store_locator_name_search' name='wpgmza_store_locator_name_search' class='postform cmn-toggle cmn-toggle-round-flat' ".$wpgmza_store_locator_name_search_checked."> <label for='wpgmza_store_locator_name_search'></label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>".__("Title search String","wp-google-maps").":</td>
                            <td><input type=\"text\" name=\"wpgmza_store_locator_name_string\" id=\"wpgmza_store_locator_name_string\" value=\"$wpgmza_store_locator_name_string\">
                            </td>
                        </tr>
                        <tr>
                            <td><h3>".__("Style options","wp-google-maps").":</h3></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                ".__("Line color","wp-google-maps")."
                            </td>
                            <td>
                                <input id=\"sl_stroke_color\" name=\"sl_stroke_color\" type=\"text\" class=\"color\" value=\"$sl_stroke_color\" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ".__("Line opacity","wp-google-maps")."
                            </td>
                            <td>
                                <input id=\"sl_stroke_opacity\" name=\"sl_stroke_opacity\" type=\"text\" value=\"$sl_stroke_opacity\" /> ".__("(0 - 1.0) example: 0.5 for 50%","wp-google-maps")."
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ".__("Fill color","wp-google-maps")."
                            </td>
                            <td>
                                <input id=\"sl_fill_color\" name=\"sl_fill_color\" type=\"text\" class=\"color\" value=\"$sl_fill_color\" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ".__("Fill opacity","wp-google-maps")."
                            </td>
                            <td>
                                <input id=\"sl_fill_opacity\" name=\"sl_fill_opacity\" type=\"text\" value=\"$sl_fill_opacity\" /> ".__("(0 - 1.0) example: 0.5 for 50%","wp-google-maps")."
                            </td>
                        </tr>
                                                     




                        </table>
                        <p><em>".__('View','wp-google-maps')." <a href='http://wpgmaps.com/documentation/store-locator' target='_BLANK'>".__('Store Locator Documentation','wp-google-maps')."</a></em></p>
                        <p><em>Please note: the store locator functionality is still in Beta. If you find any bugs, please <a href='http://wpgmaps.com/contact-us/'>let us know</a></em></p>


                        
                            

            
    
                </div>
                <div id=\"tabs-4\">
                    <table class='' id='wpgmaps_advanced_options'>
                        <tr>
                            <td><label for=\"upload_default_marker\">".__("Default Marker Image","wp-google-maps")."</label></td>
                            <td><span id=\"wpgmza_mm\">$display_marker</span> <input id=\"upload_default_marker\" name=\"upload_default_marker\" type='hidden' size='35' class='regular-text' maxlength='700' value='".$res->default_marker."' /> <input style='position: relative;' class='wpgmza_general_btn' id=\"upload_default_marker_btn\" type=\"button\" value=\"".__("Upload Image","wp-google-maps")."\"  /> <a class='wpgmza_file_select_btn' style='position: relative;' href=\"javascript:void(0);\" onClick=\"document.forms['wpgmza_map_form'].upload_default_marker.value = ''; var span = document.getElementById('wpgmza_mm'); while( span.firstChild ) { span.removeChild( span.firstChild ); } span.appendChild( document.createTextNode('')); return false;\" title=\"Reset to default\">Reset</a> &nbsp; &nbsp; <small><i>".__("Get great map markers <a href='http://www.wpgmaps.com/marker-icons/' target='_BLANK' title='Great Google Map Markers'>here</a>","wp-google-maps")."</i></small></td>
                        </tr>

                        <tr>
                            <td><label for=\"wpgmza_map_type\">".__("Map type","wp-google-maps")."</label></td>
                            <td><select id='wpgmza_map_type' name='wpgmza_map_type' class='postform'>
                                <option value=\"1\" ".$wpgmza_map_type[1].">".__("Roadmap","wp-google-maps")."</option>
                                <option value=\"2\" ".$wpgmza_map_type[2].">".__("Satellite","wp-google-maps")."</option>
                                <option value=\"3\" ".$wpgmza_map_type[3].">".__("Hybrid","wp-google-maps")."</option>
                                <option value=\"4\" ".$wpgmza_map_type[4].">".__("Terrain","wp-google-maps")."</option>
                            </select>
                            </td>
                        </tr>
                        
                        <tr>
                            <td><label for=\"wpgmza_map_align\">".__("Map Alignment","wp-google-maps")."</label></td>
                            <td><select id='wpgmza_map_align' name='wpgmza_map_align' class='postform'>
                                <option value=\"1\" ".$wpgmza_map_align[1].">".__("Left","wp-google-maps")."</option>
                                <option value=\"2\" ".$wpgmza_map_align[2].">".__("Center","wp-google-maps")."</option>
                                <option value=\"3\" ".$wpgmza_map_align[3].">".__("Right","wp-google-maps")."</option>
                                <option value=\"4\" ".$wpgmza_map_align[4].">".__("None","wp-google-maps")."</option>
                            </select>
                            </td>
                        </tr>

                        <tr>
                            <td><label for=\"wpgmza_show_user_location\">".__("Show User's Location?","wp-google-maps")."</label></td>
                            <td>
                            <div class='switch'>
                               	<input type='checkbox' id='wpgmza_show_user_location' name='wpgmza_show_user_location' class='postform cmn-toggle cmn-toggle-round-flat' ".$wpgmza_show_user_location[1]."> <label for='wpgmza_show_user_location' data-on='".__("Yes","wp-google-maps")."' data-off='".__("No","wp-google-maps")."''></label>
                            </div> 
                            </td>
                        </tr>
                        <tr id='wpgmza_show_user_location_conditional' style='display:none;'>
                            <td><label for=\"upload_default_ul_marker\">".__("Default User Location Icon","wp-google-maps")."</label></td>
                            <td><span id=\"wpgmza_mm_ul\">$display_ul_marker</span> <input id=\"upload_default_ul_marker\" name=\"upload_default_ul_marker\" type='hidden' size='35' class='regular-text' maxlength='700' value='".$def_ul_marker."' /> <input style='position: relative;' class='wpgmza_general_btn' id=\"upload_default_ul_marker_btn\" type=\"button\" value=\"".__("Upload Icon","wp-google-maps")."\"  /> <a class='wpgmza_file_select_btn' style='position: relative;' href=\"javascript:void(0);\" onClick=\"document.forms['wpgmza_map_form'].upload_default_ul_marker.value = ''; var span = document.getElementById('wpgmza_mm_ul'); while( span.firstChild ) { span.removeChild( span.firstChild ); } span.appendChild( document.createTextNode('')); return false;\" title=\"Reset to default\">Reset</a> &nbsp; &nbsp;</td>
                        </tr>
                        <tr>
                            <td><label for=\"wpgmza_click_open_link\">".__("Click marker opens link","wp-google-maps")."</label></td>
                            <td>
                            <div class='switch'>
                               	<input type='checkbox' id='wpgmza_click_open_link' name='wpgmza_click_open_link' class='postform cmn-toggle cmn-toggle-round-flat' ".$wpgmza_click_open_link[1]."> <label for='wpgmza_click_open_link' data-on='".__("Yes","wp-google-maps")."' data-off='".__("No","wp-google-maps")."''></label>
                            </div>
                            </td>
                        </tr>
                        
                        

                        <tr>
                            <td width='320'><label for=\"wpgmza_max_zoom\">".__("Maximum Zoom Out Level","wp-google-maps")."</label></td>
                            <td>
                                <select id='wpgmza_max_zoom' name='wpgmza_max_zoom' >
                                    <option value=\"0\" ".$wpgmza_max_zoom[0].">0</option>
                                    <option value=\"1\" ".$wpgmza_max_zoom[1].">1</option>
                                    <option value=\"2\" ".$wpgmza_max_zoom[2].">2</option>
                                    <option value=\"3\" ".$wpgmza_max_zoom[3].">3</option>
                                    <option value=\"4\" ".$wpgmza_max_zoom[4].">4</option>
                                    <option value=\"5\" ".$wpgmza_max_zoom[5].">5</option>
                                    <option value=\"6\" ".$wpgmza_max_zoom[6].">6</option>
                                    <option value=\"7\" ".$wpgmza_max_zoom[7].">7</option>
                                    <option value=\"8\" ".$wpgmza_max_zoom[8].">8</option>
                                    <option value=\"9\" ".$wpgmza_max_zoom[9].">9</option>
                                    <option value=\"10\" ".$wpgmza_max_zoom[10].">10</option>
                                    <option value=\"11\" ".$wpgmza_max_zoom[11].">11</option>
                                    <option value=\"12\" ".$wpgmza_max_zoom[12].">12</option>
                                    <option value=\"13\" ".$wpgmza_max_zoom[13].">13</option>
                                    <option value=\"14\" ".$wpgmza_max_zoom[14].">14</option>
                                    <option value=\"15\" ".$wpgmza_max_zoom[15].">15</option>
                                    <option value=\"16\" ".$wpgmza_max_zoom[16].">16</option>
                                    <option value=\"17\" ".$wpgmza_max_zoom[17].">17</option>
                                    <option value=\"18\" ".$wpgmza_max_zoom[18].">18</option>
                                    <option value=\"19\" ".$wpgmza_max_zoom[19].">19</option>
                                    <option value=\"20\" ".$wpgmza_max_zoom[20].">20</option>
                                    <option value=\"21\" ".$wpgmza_max_zoom[21].">21</option>
                                </select>
                            </td>
                        </tr> 
                        <tr>
                            <td width='320'><label for=\"wpgmza_min_zoom\">".__("Maximum Zoom In Level","wp-google-maps")."</label></td>
                            <td>
                                <select id='wpgmza_min_zoom' name='wpgmza_min_zoom' >
                                    <option value=\"0\" ".$wpgmza_min_zoom[0].">0</option>
                                    <option value=\"1\" ".$wpgmza_min_zoom[1].">1</option>
                                    <option value=\"2\" ".$wpgmza_min_zoom[2].">2</option>
                                    <option value=\"3\" ".$wpgmza_min_zoom[3].">3</option>
                                    <option value=\"4\" ".$wpgmza_min_zoom[4].">4</option>
                                    <option value=\"5\" ".$wpgmza_min_zoom[5].">5</option>
                                    <option value=\"6\" ".$wpgmza_min_zoom[6].">6</option>
                                    <option value=\"7\" ".$wpgmza_min_zoom[7].">7</option>
                                    <option value=\"8\" ".$wpgmza_min_zoom[8].">8</option>
                                    <option value=\"9\" ".$wpgmza_min_zoom[9].">9</option>
                                    <option value=\"10\" ".$wpgmza_min_zoom[10].">10</option>
                                    <option value=\"11\" ".$wpgmza_min_zoom[11].">11</option>
                                    <option value=\"12\" ".$wpgmza_min_zoom[12].">12</option>
                                    <option value=\"13\" ".$wpgmza_min_zoom[13].">13</option>
                                    <option value=\"14\" ".$wpgmza_min_zoom[14].">14</option>
                                    <option value=\"15\" ".$wpgmza_min_zoom[15].">15</option>
                                    <option value=\"16\" ".$wpgmza_min_zoom[16].">16</option>
                                    <option value=\"17\" ".$wpgmza_min_zoom[17].">17</option>
                                    <option value=\"18\" ".$wpgmza_min_zoom[18].">18</option>
                                    <option value=\"19\" ".$wpgmza_min_zoom[19].">19</option>
                                    <option value=\"20\" ".$wpgmza_min_zoom[20].">20</option>
                                    <option value=\"21\" ".$wpgmza_min_zoom[21].">21</option>
                                </select>
                            </td>
                        </tr> 

                        <tr style='height:20px;'>
                            <td></td>
                            <td></td>
                        </tr>
                        
                        <tr>
                            <td valign='top'><label for=\"wpgmza_bicycle\">".__("Enable Layers","wp-google-maps")."</label></td>
                            <td>
                                <div class='switch'>
                                	<input type='checkbox' id='wpgmza_bicycle' name='wpgmza_bicycle' class='postform cmn-toggle cmn-toggle-round-flat' ".$wpgmza_bicycle[1]."> <label for='wpgmza_bicycle' data-on='".__("Yes","wp-google-maps")."' data-off='".__("No","wp-google-maps")."''></label>
                            	</div> ".__("Bicycle Layer","wp-google-maps")."<br />
                                <div class='switch'>
                                	<input type='checkbox' id='wpgmza_traffic' name='wpgmza_traffic' class='postform cmn-toggle cmn-toggle-round-flat' ".$wpgmza_traffic[1]."> <label for='wpgmza_traffic' data-on='".__("Yes","wp-google-maps")."' data-off='".__("No","wp-google-maps")."''></label>
                            	</div> ".__("Traffic Layer","wp-google-maps")."<br />
                                <div class='switch'>
                                	<input type='checkbox' id='wpgmza_transport' name='wpgmza_transport' class='postform cmn-toggle cmn-toggle-round-flat' ".$wpgmza_transport_layer_checked[0]."> <label for='wpgmza_transport' data-on='".__("Yes","wp-google-maps")."' data-off='".__("No","wp-google-maps")."''></label>
                           		</div> ".__("Transit Layer","wp-google-maps")."

                            </td>
                        </tr>

                        <tr>
                            <td><label for=\"wpgmza_kml\">".__("KML/GeoRSS URL","wp-google-maps")."</label></td>
                            <td>
                             <input id='wpgmza_kml' name='wpgmza_kml' type='text' size='100' class='regular-text' value='".$res->kml."' /> <em><small>".__("The KML/GeoRSS layer will over-ride most of your map settings","wp-google-maps").". ".__("For multiple sources, separate each one by a comma.","wp-google-maps")."</small></em></td>
                            </td>
                        </tr>
                        <tr>
                            <td><label for=\"wpgmza_fusion\">".__("Fusion table ID","wp-google-maps")."</label></td>
                            <td>
                             <input id='wpgmza_fusion' name='wpgmza_fusion' type='text' size='20' maxlength='200' class='small-text' value='".$res->fusion."' /> <em><small>".__("Read data directly from your Fusion Table. For more information, see <a href='http://googlemapsmania.blogspot.com/2010/05/fusion-tables-google-maps-api.html'>http://googlemapsmania.blogspot.com/2010/05/fusion-tables-google-maps-api.html</a>","wp-google-maps")."</small></em></td>
                            </td>
                        </tr>
                        <tr style='height:20px;'>
                            <td></td>
                            <td></td>
                        </tr>
                        
				    	<tr>
					        <td>
					        	<label for=\"wpgmza_iw_type\">".__("Infowindow Style","wp-google-maps")."</label>
				        	</td>
					        <td>        
					            <img src=\"".WPGMAPS_DIR."/images/marker_iw_type_1.png\" title=\"Default\" id=\"wpgmza_iw_selection_1\" width=\"250\" class=\"iw_custom_click_hide wpgmza_mlist_selection ".$wpgmza_iw_class[0]."\">     
					            <img src=\"".WPGMAPS_DIR."/images/marker_iw_type_2.png\" title=\"Modern\" id=\"wpgmza_iw_selection_2\" width=\"250\" class=\"iw_custom_click_show wpgmza_mlist_selection ".$wpgmza_iw_class[1]."\">
					            <img src=\"".WPGMAPS_DIR."/images/marker_iw_type_3.png\" title=\"Modern\" id=\"wpgmza_iw_selection_3\" width=\"250\" class=\"iw_custom_click_show wpgmza_mlist_selection ".$wpgmza_iw_class[2]."\">  
					            <img src=\"".WPGMAPS_DIR."/images/marker_iw_type_4.png\" title=\"Modern\" id=\"wpgmza_iw_selection_4\" width=\"250\" class=\"iw_custom_click_show wpgmza_mlist_selection ".$wpgmza_iw_class[3]."\">       
                                <input type=\"radio\" name=\"wpgmza_iw_type\" id=\"rb_wpgmza_iw_selection_1\" value=\"0\" ".$infowwindow_sel_checked[0]." class=\"wpgmza_hide_input\">
                                <input type=\"radio\" name=\"wpgmza_iw_type\" id=\"rb_wpgmza_iw_selection_2\" value=\"1\" ".$infowwindow_sel_checked[1]." class=\"wpgmza_hide_input\">
                                <input type=\"radio\" name=\"wpgmza_iw_type\" id=\"rb_wpgmza_iw_selection_3\" value=\"2\" ".$infowwindow_sel_checked[2]." class=\"wpgmza_hide_input\">
                                <input type=\"radio\" name=\"wpgmza_iw_type\" id=\"rb_wpgmza_iw_selection_4\" value=\"3\" ".$infowwindow_sel_checked[3]." class=\"wpgmza_hide_input\">
					        </td>
				    	</tr>
				    	<tr>
					        <th>
					        	&nbsp;
				        	</th>
					        <td>     
					       	 ".__("Your selection:","wp-google-maps")."   
					            <span class=\"wpgmza_iw_sel_text\" style=\"font-weight:bold;\">".$infowwindow_sel_text."</span>
					        </td>
					        <script>
                                	jQuery(document).ready(function(){
                                		
                                		if(jQuery('#rb_wpgmza_iw_selection_2').attr('checked')){
						          			jQuery('#iw_custom_colors_row').fadeIn();
						          		}else if(jQuery('#rb_wpgmza_iw_selection_3').attr('checked')){
						          			jQuery('#iw_custom_colors_row').fadeIn();
						          		}else if(jQuery('#rb_wpgmza_iw_selection_4').attr('checked')){
						          			jQuery('#iw_custom_colors_row').fadeIn();
						          		}else{
						          			jQuery('#iw_custom_colors_row').fadeOut();
							          	}

							          	jQuery('.iw_custom_click_show').click(function(){
							          		jQuery('#iw_custom_colors_row').fadeIn();
							          	});

										jQuery('.iw_custom_click_hide').click(function(){
							          		jQuery('#iw_custom_colors_row').fadeOut();
							          	});

							          });
                            </script>

				    	</tr>

				    	<tr id='iw_custom_colors_row' style='display:none;'>
				    		<td>
				    		</td>
				    		<td>
				    			<br><strong>".__("Infowindow Colors","wp-google-maps")."</strong><br>
				    			<table>
				    				<tr>
				    					<td>
				    						".__("Primary Color", "wp-google-maps")."
				    					</td>
				    					<td>
				    						<input id=\"iw_primary_color\" name=\"iw_primary_color\" type=\"text\" class=\"color\" value=\"$iw_primary_color\" /><br>
				    					</td>
				    				</tr>
				    				<tr>
				    					<td>
				    						".__("Accent Color", "wp-google-maps")."
				    					</td>
				    					<td>
				    						<input id=\"iw_accent_color\" name=\"iw_accent_color\" type=\"text\" class=\"color\" value=\"$iw_accent_color\" /><br>
				    					</td>
				    				</tr>
				    				<tr>
				    					<td>
				    						".__("Text Color", "wp-google-maps")."
				    					</td>
				    					<td>
				    						<input id=\"iw_text_color\" name=\"iw_text_color\" type=\"text\" class=\"color\" value=\"$iw_text_color\" /><br>
				    					</td>
				    				</tr>
				    			</table>
                       
				    		</td>
				    	</td>
					    	
				    </table>
                            

            
    
                </div> 
                <div id=\"tabs-5\">

					<table class=\"form-table\"><form method=\"post\"></form>
					    <tbody>
					    	<tr>
						        <th>
						        	<label for=\"\">".__("Marker Listing Style","wp-google-maps")."</label>
					        	</th>
						        <td>        
						            <img src=\"".WPGMAPS_DIR."/images/marker_list_0.png\" title=\"No marker listing\" id=\"wpgmza_mlist_selection_1\" width=\"150\" class=\"wpgmza_mlist_selection ".$list_markers_by_class[0]."\">     
						            <img src=\"".WPGMAPS_DIR."/images/marker_list_1.png\" title=\"Basic table\" id=\"wpgmza_mlist_selection_2\" width=\"150\" class=\"wpgmza_mlist_selection ".$list_markers_by_class[1]."\">     
						            <img src=\"".WPGMAPS_DIR."/images/marker_list_2.png\" title=\"Basic list\" id=\"wpgmza_mlist_selection_3\" width=\"150\" class=\"wpgmza_mlist_selection ".$list_markers_by_class[4]."\">     
						            <img src=\"".WPGMAPS_DIR."/images/marker_list_3.png\" title=\"Advanced table\" id=\"wpgmza_mlist_selection_4\" width=\"150\" class=\"wpgmza_mlist_selection ".$list_markers_by_class[2]."\">     
						            <img src=\"".WPGMAPS_DIR."/images/marker_list_4.png\" title=\"Carousel\" id=\"wpgmza_mlist_selection_5\" width=\"150\" class=\"wpgmza_mlist_selection ".$list_markers_by_class[3]."\">     

	                                <input type=\"radio\" name=\"wpgmza_listmarkers_by\" id=\"rb_wpgmza_mlist_selection_1\" value=\"0\" ".$list_markers_by_checked[0]." class=\"sola_t_hide_input\">
	                                <input type=\"radio\" name=\"wpgmza_listmarkers_by\" id=\"rb_wpgmza_mlist_selection_2\" value=\"1\" ".$list_markers_by_checked[1]." class=\"sola_t_hide_input\">
	                                <input type=\"radio\" name=\"wpgmza_listmarkers_by\" id=\"rb_wpgmza_mlist_selection_3\" value=\"4\" ".$list_markers_by_checked[4]." class=\"sola_t_hide_input\">
	                                <input type=\"radio\" name=\"wpgmza_listmarkers_by\" id=\"rb_wpgmza_mlist_selection_4\" value=\"2\" ".$list_markers_by_checked[2]." class=\"sola_t_hide_input\">
	                                <input type=\"radio\" name=\"wpgmza_listmarkers_by\" id=\"rb_wpgmza_mlist_selection_5\" value=\"3\" ".$list_markers_by_checked[3]." class=\"sola_t_hide_input\">
						        </td>
					    	</tr>
					    	<tr>
						        <th>
						        	&nbsp;
					        	</th>
						        <td>     
						       	 ".__("Your selection:","wp-google-maps")."   
						            <span class=\"wpgmza_mlist_sel_text\" style=\"font-weight:bold;\">".$list_markers_by_sel_text."</span>
						        </td>
					    	</tr>
					    </table>

                    <table class='' id='wpgmaps_marker_listing_options'>
                       
                    	<tr>
                            <td>".__("Marker Listing Placement","wp-google-maps").":</td>
                            <td>
                            	<div class='switch'>
                                        <input type='checkbox' id='wpgmza_marker_listing_position' name='wpgmza_marker_listing_position' class='postform cmn-toggle cmn-toggle-yes-no' ".$wpgmza_marker_listing_below_checked."> <label class='cmn-override-big-wide' for='wpgmza_marker_listing_position' data-on='".__("Above Map","wp-google-maps")."' data-off='".__("Below Map","wp-google-maps")."''></label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                             <td>".__("Order markers by","wp-google-maps").":</td>
                             <td>
                                <select id='wpgmza_order_markers_by' name='wpgmza_order_markers_by' class='postform'>
                                    <option value=\"1\" ".$wpgmza_map_order_markers_by[1].">".__("ID","wp-google-maps")."</option>
                                    <option value=\"2\" ".$wpgmza_map_order_markers_by[2].">".__("Title","wp-google-maps")."</option>
                                    <option value=\"3\" ".$wpgmza_map_order_markers_by[3].">".__("Address","wp-google-maps")."</option>
                                    <option value=\"4\" ".$wpgmza_map_order_markers_by[4].">".__("Description","wp-google-maps")."</option>
                                    <option value=\"5\" ".$wpgmza_map_order_markers_by[5].">".__("Category","wp-google-maps")."</option>
                                </select>
                                <select id='wpgmza_order_markers_choice' name='wpgmza_order_markers_choice' class='postform'>
                                    <option value=\"1\" ".$wpgmza_map_order_markers_choice[1].">".__("Ascending","wp-google-maps")."</option>
                                    <option value=\"2\" ".$wpgmza_map_order_markers_choice[2].">".__("Descending","wp-google-maps")."</option>
                                </select>

                            </td>
                        </tr>
						<tr style='height:20px;'>
                             <td></td>
                             <td></td>
                        </tr>

                        <tr>
                             <td valign='top'>".__("Move list inside map","wp-google-maps").":</td>
                             <td>
                                <div class='switch'>
                                	<input id='wpgmza_push_in_map' name='wpgmza_push_in_map' class='cmn-toggle cmn-toggle-round-flat' type='checkbox' value='1' $pushinmap_checked /> <label for='wpgmza_push_in_map'></label></div> ".__("Move your marker list inside the map area","wp-google-maps")." <span style='color:red;'>".__("(still in beta)","wp-google-maps")."</span><br />
                                </div>
                                <script>
                                	jQuery(document).ready(function(){
                                		
                                		if(jQuery('#wpgmza_push_in_map').attr('checked')){
						          			jQuery('#wpgmza_marker_list_conditional').fadeIn();
						          		}else{
						          			jQuery('#wpgmza_marker_list_conditional').fadeOut();
							          	}

							          	jQuery('#wpgmza_push_in_map').on('change', function(){
							          		if(jQuery(this).attr('checked')){
							          			jQuery('#wpgmza_marker_list_conditional').fadeIn();
							          		}else{
							          			jQuery('#wpgmza_marker_list_conditional').fadeOut();
							          		}
							          	});
							          });
                                </script>
                                <div id='wpgmza_marker_list_conditional'>
									<br>".__("Placement: ","wp-google-maps")."
									<select id='wpgmza_push_in_map_placement' name='wpgmza_push_in_map_placement' class='postform'>
	                                    <option value=\"1\" ".$push_in_map_placement_checked[1].">".__("Top Center","wp-google-maps")."</option>
	                                    <option value=\"2\" ".$push_in_map_placement_checked[2].">".__("Top Left","wp-google-maps")."</option>
	                                    <option value=\"3\" ".$push_in_map_placement_checked[3].">".__("Top Right","wp-google-maps")."</option>
	                                    <option value=\"4\" ".$push_in_map_placement_checked[4].">".__("Left Top ","wp-google-maps")."</option>
	                                    <option value=\"5\" ".$push_in_map_placement_checked[5].">".__("Right Top","wp-google-maps")."</option>
	                                    <option value=\"6\" ".$push_in_map_placement_checked[6].">".__("Left Center","wp-google-maps")."</option>
	                                    <option value=\"7\" ".$push_in_map_placement_checked[7].">".__("Right Center","wp-google-maps")."</option>
	                                    <option value=\"8\" ".$push_in_map_placement_checked[8].">".__("Left Bottom","wp-google-maps")."</option>
	                                    <option value=\"9\" ".$push_in_map_placement_checked[9].">".__("Right Bottom","wp-google-maps")."</option>
	                                    <option value=\"10\" ".$push_in_map_placement_checked[10].">".__("Bottom Center","wp-google-maps")."</option>
	                                    <option value=\"11\" ".$push_in_map_placement_checked[11].">".__("Bottom Left","wp-google-maps")."</option>
	                                    <option value=\"12\" ".$push_in_map_placement_checked[12].">".__("Bottom Right","wp-google-maps")."</option>
	                                </select> <br />
	                                ".__("Container Width: ","wp-google-maps")."<input type=\"text\" name=\"wpgmza_push_in_map_width\" id=\"wpgmza_push_in_map_width\" value=\"$wpgmza_push_in_map_width\" style='width:70px;' placeholder='% or px'> <em>Set as % or px, eg. 30% or 400px</em><br />
	                                ".__("Container Height: ","wp-google-maps")."<input type=\"text\" name=\"wpgmza_push_in_map_height\" id=\"wpgmza_push_in_map_height\" value=\"$wpgmza_push_in_map_height\" style='width:70px;' placeholder='% or px'>
                            	</div>
                            </td>
                        </tr>
						<tr style='height:20px;'>
                             <td></td>
                             <td></td>
                        </tr>

                         <tr>
                             <td>".__("Filter by Category","wp-google-maps").":</td>
                             <td>
                                <div class=''switch'>
                                	<input id='wpgmza_filterbycat' name='wpgmza_filterbycat' class='cmn-toggle cmn-toggle-round-flat' type='checkbox' value='1' $listfilters_checked /> <label for='wpgmza_filterbycat'></label></div>".__("Allow users to filter by category?","wp-google-maps")."
                                </div>
                            </td>
                        </tr>

                        </table>
                            

            
    
                </div>  <!-- end of tab5 -->     
                ".apply_filters("wpgmaps_filter_pro_map_editor_tab_content","")."
            </div>   






                <p class='submit'><input type='submit' name='wpgmza_savemap' class='button-primary' value='".__("Save Map","wp-google-maps")." &raquo;' /></p>
                <p style=\"width:600px; color:#808080;\">
                    ".__("Tip: Use your mouse to change the layout of your map. When you have positioned the map to your desired location, press \"Save Map\" to keep your settings.","wp-google-maps")."</p>

                <div style='display:block; overflow:auto; width:100%;'>
                    <div style='display:block; width:49%; margin-right:1%; overflow:auto; float:left;'>
                

                        <a name=\"wpgmaps_marker\" /></a>

                        <div id=\"wpgmaps_tabs_markers\">
                        <ul>
                                <li><a href=\"#tabs-m-1\" class=\"tabs-m-1\">".__("Markers","wp-google-maps")."</a></li>
                                <li><a href=\"#tabs-m-2\" class=\"tabs-m-2\">".__("Polygons","wp-google-maps")."</a></li>
                                <li><a href=\"#tabs-m-3\" class=\"tabs-m-3\">".__("Polylines","wp-google-maps")."</a></li>
                                <li><a href=\"#tabs-m-4\" class=\"tabs-m-4\">".__("Heatmaps","wp-google-maps")."</a></li>
                        </ul>
                        <div id=\"tabs-m-1\">


                            <h2 style=\"padding-top:0; margin-top:0;\">".__("Add a marker","wp-google-maps")."</h2>
                            <input type=\"hidden\" name=\"wpgmza_edit_id\" id=\"wpgmza_edit_id\" value=\"\" />
                            <p>
                            <table>
                            <tr>
                                <td>".apply_filters("wpgmza_filter_title_name",__("Title","wp-google-maps"))." </td>
                                <td><input id='wpgmza_add_title' name='wpgmza_add_title' type='text' size='35' maxlength='200' value='' /> &nbsp;<br /></td>

                            </tr>
                            <tr valign='top'>
                                <td>".apply_filters("wpgmza_filter_address_name",__("Address/GPS","wp-google-maps"))." </td>
                                <td><input id='wpgmza_add_address' name='wpgmza_add_address' type='text' size='35' maxlength='200' value='' /> &nbsp;<br /><small><em>".__("Or right click on the map","wp-google-maps")."</small></em><br /><br /></td>

                            </tr>

                            <tr><td valign='top'>".apply_filters("wpgmza_filter_description_name",__("Description","wp-google-maps"))." </td>

                            <td>";

                            wp_editor('',"wpgmza_add_desc",array("teeny" => false, "media_buttons" => true, "textarea_name" => "wpgmza_add_desc", "textarea_rows" => 5));

                            echo "
                            &nbsp;<br /></td></tr>
                            <tr><td>".__("Pic URL","wp-google-maps")." </td>
                            <td><input id='wpgmza_add_pic' name=\"wpgmza_add_pic\" type='text' size='35' maxlength='700' value='' /> <input id=\"upload_image_button\" type=\"button\" value=\"".__("Upload Image","wp-google-maps")."\"  /> <br /></td></tr>
                            <tr><td>".__("Link URL","wp-google-maps")." </td>
                                <td><input id='wpgmza_link_url' name='wpgmza_link_url' type='text' size='35' maxlength='700' value=''  /><small><i> ".__("Format: http://www.domain.com","wp-google-maps")."</i></small><br /></td></tr>
                            <tr><td>".__("Custom Marker","wp-google-maps")." </td>
                            <td><span id=\"wpgmza_cmm\"><img src='".wpgmaps_get_plugin_url()."/images/marker.png' border='0' /></span><input id='wpgmza_add_custom_marker' name=\"wpgmza_add_custom_marker\" type='hidden' size='35' maxlength='700' value='' /> <input id=\"upload_custom_marker_button\" type=\"button\" value=\"".__("Upload Image","wp-google-maps")."\"  /> &nbsp; <small><i>(".__("ignore if you want to use the default marker","wp-google-maps").")</i></small><br />
                                <input type=\"checkbox\" name=\"wpgmza_add_retina\" id=\"wpgmza_add_retina\" value=\"1\" /><small>".__("This is a retina ready marker","wp-google-maps")."</small>
							</td></tr>
                            <tr>
                                <td>".apply_filters("wpgmza_filter_category_name",__("Category","wp-google-maps"))." </td>
                                <td>
                                        ".wpgmza_pro_return_category_checkbox_list($_GET['map_id'],false,false)."
                                </td>
                            </tr>
                            <tr>
                                <td>".__("Animation","wp-google-maps")." </td>
                                <td>
                                    <select name=\"wpgmza_animation\" id=\"wpgmza_animation\">
                                        <option value=\"0\">".__("None","wp-google-maps")."</option>
                                        <option value=\"1\">".__("Bounce","wp-google-maps")."</option>
                                        <option value=\"2\">".__("Drop","wp-google-maps")."</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>".__("InfoWindow open by default","wp-google-maps")." </td>
                                <td>
                                    <select name=\"wpgmza_infoopen\" id=\"wpgmza_infoopen\">
                                        <option value=\"0\">".__("No","wp-google-maps")."</option>
                                        <option value=\"1\">".__("Yes","wp-google-maps")."</option>
                                    </select>
                                </td>
                            </tr>
                            ".apply_filters("wpgmza_filter_marker_add_table_tr","",$res,$other_settings_data)."
                            <tr>
                                <td></td>
                                <td>
                                    <span id=\"wpgmza_addmarker_div\"><input type=\"button\" id='wpgmza_addmarker' class='button-primary' value='".__("Add Marker","wp-google-maps")."' /></span> <span id=\"wpgmza_addmarker_loading\" style=\"display:none;\">".__("Adding","wp-google-maps")."...</span>
                                    <span id=\"wpgmza_editmarker_div\" style=\"display:none;\"><input type=\"button\" id='wpgmza_editmarker' class='button-primary' value='".__("Save Marker","wp-google-maps")."' /></span><span id=\"wpgmza_editmarker_loading\" style=\"display:none;\">".__("Saving","wp-google-maps")."...</span>
                                    <div id=\"wpgm_notice_message_save_marker\" style=\"display:none;\">
                                        <div class=\"update-nag\" style='text-align:left; padding:1px; margin:1px;'>
                                                 <h4 style='padding:1px; margin:1px;'>".__("Remember to save your marker","wp-google-maps")."</h4>
                                        </div>

                                    </div>                                
                                </td>
                            </tr>
                            </table>
                           
                        </div>
                        <div id=\"tabs-m-2\">
                                <h2 style=\"padding-top:0; margin-top:0;\">".__("Add a Polygon","wp-google-maps")."</h2>
                                <span id=\"wpgmza_addpolygon_div\"><a href='".get_option('siteurl')."/wp-admin/admin.php?page=wp-google-maps-menu&action=add_poly&map_id=".$_GET['map_id']."' id='wpgmza_addpoly' class='button-primary' value='".__("Add a New Polygon","wp-google-maps")."' />".__("Add a New Polygon","wp-google-maps")."</a></span>
                                <div id=\"wpgmza_poly_holder\">".wpgmza_b_return_polygon_list($_GET['map_id'])."</div>
                        </div>
                        <div id=\"tabs-m-3\">
                                <h2 style=\"padding-top:0; margin-top:0;\">".__("Add a Polyline","wp-google-maps")."</h2>
                                <span id=\"wpgmza_addpolyline_div\"><a href='".get_option('siteurl')."/wp-admin/admin.php?page=wp-google-maps-menu&action=add_polyline&map_id=".$_GET['map_id']."' id='wpgmza_addpolyline' class='button-primary' value='".__("Add a New Polyline","wp-google-maps")."' />".__("Add a New Polyline","wp-google-maps")."</a></span>
                                <div id=\"wpgmza_polyline_holder\">".wpgmza_b_return_polyline_list($_GET['map_id'])."</div>
                        </div>
                        <div id=\"tabs-m-4\">
                                <h2 style=\"padding-top:0; margin-top:0;\">".__("Add a dataset","wp-google-maps")."</h2>
                                ".$wpgmza_string_heatmaps."
                        </div>
                    </div>
                </div>
                <div style='display:block; width:50%; overflow:auto; float:left;'>

                    <div id=\"wpgmza_map\">
                        
                    </div>
                    <div id=\"wpgmaps_save_reminder\" style=\"display:none;\">
                        <div class=\"update-nag\" style='text-align:center;'>
                            <ul>
                                <li>
                                 <h4>".__("Remember to save your map!","wp-google-maps")."</h4>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id='wpgmaps_marker_cache_reminder' style='display: none;'>                                
                        ".(function_exists("wpgmza_caching_notice_changes") ? wpgmza_caching_notice_changes(true, true) : '')."
                    </div>
                </div>
            </div>

 <h2 style=\"padding-top:0; margin-top:0;\">".__("Your Markers","wp-google-maps")."</h2>
                            <div id=\"wpgmza_marker_holder\">
                                ".wpgmza_return_marker_list($_GET['map_id'])."
                            </div>
                
            </form>

            

            ".wpgmza_return_pro_add_ons()." 
            <p><br /><br />".__("WP Google Maps encourages you to make use of the amazing icons created by Nicolas Mollet's Maps Icons Collection","wp-google-maps")." <a href='http://mapicons.nicolasmollet.com'>http://mapicons.nicolasmollet.com/</a> ".__("and to credit him when doing so.","wp-google-maps")."</p>


            </div>
        </div>
    ";

	}

}
function wpgmaps_action_callback_pro() {
        global $wpdb;
        global $wpgmza_tblname;
        global $wpgmza_tblname_poly;
        global $wpgmza_tblname_polylines;
        $check = check_ajax_referer( 'wpgmza', 'security' );
        $table_name = $wpdb->prefix . "wpgmza";
        
        if ($check == 1) {

            if ($_POST['action'] == "add_marker") {
                
                if (is_array($_POST['category'])) { $cat = implode(",",$_POST['category']); } else { $cat = $_POST['category']; }
                $wpgmza_tags = wpgmza_get_allowed_tags();

                $other_data = array();
                if ( $_POST['icon_on_click'] ) {
                	$other_data['icon_on_click'] = sanitize_text_field( $_POST['icon_on_click'] );
                }

                $ins_array = array( 
                	'map_id' => $_POST['map_id'],
                	'title' => sanitize_text_field($_POST['title']),
                	'address' => sanitize_text_field($_POST['address']),
                	'description' => wp_kses($_POST['desc'], $wpgmza_tags),
                	'pic' => sanitize_text_field($_POST['pic']),
                	'icon' => sanitize_text_field($_POST['icon']),
                	'link' => sanitize_text_field($_POST['link']),
                	'lat' => sanitize_text_field($_POST['lat']),
                	'lng' => sanitize_text_field($_POST['lng']),
                	'anim' => sanitize_text_field($_POST['anim']),
                	'category' => sanitize_text_field($cat),
                	'infoopen' => sanitize_text_field($_POST['infoopen']),
                	'approved' => intval(sanitize_text_field($_POST['approved'])),
                	'retina' => sanitize_text_field($_POST['retina']),
                	'other_data' => maybe_serialize( $other_data )
                	);

                $rows_affected = $wpdb->insert( $table_name, $ins_array );
                wpgmaps_update_xml_file($_POST['map_id']);
                $return_a = array(
                    "marker_id" => $wpdb->insert_id,
                    "marker_data" => wpgmaps_return_markers_pro($_POST['map_id']),
                    "table_html" => wpgmza_return_marker_list($_POST['map_id'])
                );
                echo json_encode($return_a);
            }
           
 
            if ($_POST['action'] == "edit_marker") {
                $desc = $_POST['desc'];
                $link = $_POST['link'];
                $pic = $_POST['pic'];
                $icon = $_POST['icon'];
                $anim = $_POST['anim'];
                $retina = $_POST['retina'];
                $approved = $_POST['approved'];

                $other_data = array();
                $other_data['0'] = '0';
                if ( $_POST['icon_on_click'] ) {
                	$other_data['icon_on_click'] = sanitize_text_field( $_POST['icon_on_click'] );
                }

                if (is_array($_POST['category'])) { $category = implode(",",$_POST['category']); } else { $category = $_POST['category']; }
                $infoopen = $_POST['infoopen'];
                $cur_id = intval($_POST['edit_id']);
                $wpgmza_tags = wpgmza_get_allowed_tags();
                $rows_affected = $wpdb->query(
                	$wpdb->prepare(
                		"UPDATE $table_name SET 
                		`title` = %s, 
                		`address` = %s, 
                		`description` = %s, 
                		`link` = %s, 
                		`icon` = %s, 
                		`pic` = %s, 
                		`lat` = %f, 
                		`lng` = %f, 
                		`anim` = %s, 
                		`category` = %s, 
                		`infoopen` = %s, 
                		`approved` = %s, 
                		`retina` = %s,
                		`other_data` = %s 
                		WHERE `id`  = %d",
                		sanitize_text_field($_POST['title']),
                		sanitize_text_field($_POST['address']),
                		wp_kses($desc, $wpgmza_tags),
                		sanitize_text_field($link),
                		sanitize_text_field($icon),
                		sanitize_text_field($pic),
                		sanitize_text_field($_POST['lat']),
                		sanitize_text_field($_POST['lng']),
                		sanitize_text_field($anim),
                		sanitize_text_field($category),
                		sanitize_text_field($infoopen),
                		sanitize_text_field($approved),
                		sanitize_text_field($retina),
                		maybe_serialize( $other_data ),
                		intval($cur_id)
                		)
                	);
                wpgmaps_update_xml_file($_POST['map_id']);
                $return_a = array(
                    "marker_id" => $cur_id,
                    "marker_data" => wpgmaps_return_markers_pro($_POST['map_id']),
                    "table_html" => wpgmza_return_marker_list($_POST['map_id'])
                );
                echo json_encode($return_a);
           }

            if ($_POST['action'] == "delete_marker") {
                $marker_id = $_POST['marker_id'];
                $wpdb->query(
                        "
                        DELETE FROM $wpgmza_tblname
                        WHERE `id` = '$marker_id'
                        LIMIT 1
                        "
                );
                $wpgmza_check = wpgmaps_update_xml_file($_POST['map_id']);
                if ( is_wp_error($wpgmza_check) ) wpgmza_return_error($wpgmza_check);
                $return_a = array(
                    "marker_id" => $marker_id,
                    "marker_data" => wpgmaps_return_markers_pro($_POST['map_id']),
                    "table_html" => wpgmza_return_marker_list($_POST['map_id'])
                );
                echo json_encode($return_a);

            }
            if ($_POST['action'] == "approve_marker") {
                $marker_id = $_POST['marker_id'];
                $wpdb->query(
                        "
                        UPDATE $wpgmza_tblname
                        SET `approved` = 1
                        WHERE `id` = '$marker_id'
                        LIMIT 1
                        "
                );
                wpgmaps_update_xml_file($_POST['map_id']);
                $return_a = array(
                    "marker_id" => $marker_id,
                    "marker_data" => wpgmaps_return_markers_pro($_POST['map_id']),
                    "table_html" => wpgmza_return_marker_list($_POST['map_id'])
                );
                echo json_encode($return_a);

            }
            if ($_POST['action'] == "delete_poly") {
                $poly_id = $_POST['poly_id'];
                
                $wpdb->query(
                        "
                        DELETE FROM $wpgmza_tblname_poly
                        WHERE `id` = '$poly_id'
                        LIMIT 1
                        "
                );
                
                echo wpgmza_b_return_polygon_list($_POST['map_id']);

            }
            if ($_POST['action'] == "delete_polyline") {
                $poly_id = $_POST['poly_id'];
                
                $wpdb->query(
                        "
                        DELETE FROM $wpgmza_tblname_polylines
                        WHERE `id` = '$poly_id'
                        LIMIT 1
                        "
                );
                
                echo wpgmza_b_return_polyline_list($_POST['map_id']);

            }
            if ($_POST['action'] == "delete_dataset") {
                $poly_id = $_POST['poly_id'];
                global $wpgmza_tblname_datasets;
                $wpdb->query("DELETE FROM ".$wpgmza_tblname_datasets." WHERE `id` = '$poly_id' LIMIT 1");
                
                echo wpgmza_b_return_heatmaps_list($_POST['map_id']);


            }
        }

        die(); // this is required to return a proper result

}
function wpgmza_return_pro_add_ons() {
    $wpgmza_ret = "";
    if (function_exists("wpgmza_register_gold_version")) { $wpgmza_ret .= wpgmza_gold_addon_display(); } else { $wpgmza_ret  .= ""; }
    if (function_exists("wpgmza_register_ugm_version")) { $wpgmza_ret .= wpgmza_ugm_addon_display_mapspage(); } else { $wpgmza_ret  .= ""; }
    return $wpgmza_ret;
}


function wpgmaps_tag_pro( $atts ) {

	global $wpdb;

	$result = $wpdb->get_row("SELECT `map_title` FROM `".$wpdb->prefix.'wpgmza_maps'."` WHERE `id` = '".sanitize_text_field( $atts['id'] )."' AND `active` = '0'");

	if( $result == null ){
		return("<p>".__('The map ID you have entered does not exist. Please enter a map ID that exists.', 'wp-google-maps')."</p>");
	}

    global $wpgmza_current_map_id;
    global $wpgmza_current_map_cat_selection;
    global $wpgmza_current_map_shortcode_data;
    global $wpgmza_current_map_type;
    global $wpgmza_current_mashup;
    global $wpgmza_mashup_ids;
    global $wpgmza_mashup_all;
    global $wpgmza_override;
    $wpgmza_current_mashup = false;
    extract( shortcode_atts( array(
        'id' => '1',
        'mashup' => false,
        'mashup_ids' => false,
        'cat' => 'all',
        'type' => 'default',
        'parent_id' => false,
        'lat' => false,
        'lng' => false
    ), $atts ) );
    
    
    /* first check if we are using custom fields to generate the map */
    if (isset($atts['lng']) && isset($atts['lat']) && isset($atts['parent_id']) && $atts['lat'] && $atts['lng']) {
        $atts['id'] = $atts['parent_id']; /* set the main ID as the specified parent id */
        $wpgmza_current_map_id = $atts['parent_id'];
        $wpgmza_current_map_shortcode_data[$wpgmza_current_map_id]['lat'] = $atts['lat'];
        $wpgmza_current_map_shortcode_data[$wpgmza_current_map_id]['lng'] = $atts['lng'];
        $wpgmza_current_map_shortcode_data[$wpgmza_current_map_id]['parent_id'] = $atts['parent_id'];
        $wpgmza_using_custom_meta = true;
        
    } else {
        $wpgmza_current_map_shortcode_data[$wpgmza_current_map_id]['lat'] = false;
        $wpgmza_current_map_shortcode_data[$wpgmza_current_map_id]['lng'] = false;
        $wpgmza_current_map_shortcode_data[$wpgmza_current_map_id]['parent_id'] = false;
        $wpgmza_using_custom_meta = false;
    }    
    
    $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");

    if (isset($atts['mashup'])) { $wpgmza_mashup = $atts['mashup']; }


    
    if (isset($atts['parent_id'])) { $wpgmza_mashup_parent_id = $atts['parent_id']; }

    if (isset($wpgmza_mashup_ids) && $wpgmza_mashup_ids == "ALL") {

    } else {
        if (isset($atts['mashup_ids'])) {
            $wpgmza_mashup_ids[$atts['id']] = explode(",",$atts['mashup_ids']);
        }
    }

    if (isset($wpgmza_mashup)) { $wpgmza_current_mashup = true; }

    if (isset($wpgmza_mashup)) {
        $wpgmza_current_map_id = $wpgmza_mashup_parent_id;
        $res = wpgmza_get_map_data($wpgmza_mashup_parent_id);
    } else {
        $wpgmza_current_map_id = $atts['id'];
        
        
        if (isset($wpgmza_settings['wpgmza_settings_marker_pull']) && $wpgmza_settings['wpgmza_settings_marker_pull'] == '0') {
        } else {
            /* only check if marker file exists if they are using the XML method */
            wpgmza_check_if_marker_file_exists($wpgmza_current_map_id);
        }
        
        $res = wpgmza_get_map_data($atts['id']);
    }
    if (!isset($atts['cat']) || $atts['cat'] == "all" || $atts['cat'] == "0") {
        $wpgmza_current_map_cat_selection[$wpgmza_current_map_id] = 'all';
    } else {
        $wpgmza_current_map_cat_selection[$wpgmza_current_map_id] = explode(",",$atts['cat']);
    }
    

    if (!isset($atts['type']) || $atts['type'] == "default" || $atts['type'] == "") {
        $wpgmza_current_map_type[$wpgmza_current_map_id] = '';
    } else {
        $wpgmza_current_map_type[$wpgmza_current_map_id] = $atts['type'];
    }
	
	$map_other_settings = maybe_unserialize($res->other_settings);

	$iw_output = "";
	$iw_custom_styles ="";
    /* handle new modern infowindow HTML output */
    if ((isset($wpgmza_settings['wpgmza_iw_type']) && intval($wpgmza_settings['wpgmza_iw_type']) >= 1) || (isset($map_other_settings['wpgmza_iw_type']) && intval($map_other_settings['wpgmza_iw_type']) >= 1)) {

    	/* Enqueue Modern Styles */

    	wp_enqueue_style("wpgmza_modern_base", plugins_url("wp-google-maps-pro") . "/css/wpgmza_style_pro_modern_base.css");

    	$wpmgza_info_window = isset($wpgmza_settings['wpgmza_iw_type']) && intval($wpgmza_settings['wpgmza_iw_type']) != -1 ? intval($wpgmza_settings['wpgmza_iw_type']) : intval($map_other_settings['wpgmza_iw_type']);
    	switch($wpmgza_info_window){
    		case 2: //Modern Plus
    			wp_enqueue_style("wpgmza_modern_plus", plugins_url("wp-google-maps-pro") . "/css/wpgmza_style_pro_modern_plus.css");
    			break;
    		case 3: //Circular
				wp_enqueue_style("wpgmza_modern_circular", plugins_url("wp-google-maps-pro") . "/css/wpgmza_style_pro_modern_circular.css");
    			break;
    	}

    	if (isset($wpgmza_settings['wpgmza_settings_infowindow_link_text'])) { $wpgmza_settings_infowindow_link_text = $wpgmza_settings['wpgmza_settings_infowindow_link_text']; } else { $wpgmza_settings_infowindow_link_text = __("More details","wp-google-maps"); }
 
    	$iw_custom_styles .=  ".wpgmza_modern_infowindow { background-color: " . (isset($map_other_settings['iw_primary_color']) ? "#" . $map_other_settings['iw_primary_color'] : "#2A3744") . "; }";
    	
    	if($wpmgza_info_window !== 1){
    		$iw_custom_styles .=  ".wpgmza_iw_title { color: " . (isset($map_other_settings['iw_text_color']) ? "#" . $map_other_settings['iw_text_color'] : "#ffffff") . "; }";
    	} else{
    		$iw_custom_styles .=  " .wpgmza_iw_title { ";
    		$iw_custom_styles .=  "		color: " . (isset($map_other_settings['iw_text_color']) ? "#" . $map_other_settings['iw_text_color'] : "#ffffff") . "; " ;
    		$iw_custom_styles .=  "		background-color: " . (isset($map_other_settings['iw_accent_color']) ? "#" . $map_other_settings['iw_accent_color'] : "#252F3A") . ";";
    		$iw_custom_styles .=  " }";
    	}

    	$iw_custom_styles .=  ".wpgmza_iw_description { color: " . (isset($map_other_settings['iw_text_color']) ? "#" . $map_other_settings['iw_text_color'] : "#ffffff") . "; }";
    	$iw_custom_styles .=  ".wpgmza_iw_address_p { color: " . (isset($map_other_settings['iw_text_color']) ? "#" . $map_other_settings['iw_text_color'] : "#ffffff") . "; }";


    	$iw_custom_styles .=  ".wpgmza_button { ";
    	$iw_custom_styles .=  "			color: " . (isset($map_other_settings['iw_text_color']) ? "#" . $map_other_settings['iw_text_color'] : "#ffffff") . ";";
    	$iw_custom_styles .=  "			background-color: " . (isset($map_other_settings['iw_accent_color']) ? "#" . $map_other_settings['iw_accent_color'] : "#252F3A") . ";";
    	$iw_custom_styles .=  " }";
    	

    	$iw_output = "<div id='wpgmza_iw_holder_".$wpgmza_current_map_id."' style='display:none;'>";

    	$iw_output .= 	"<div class='wpgmza_modern_infowindow_inner wpgmza_modern_infowindow_inner_".$wpgmza_current_map_id."'>";
    	$iw_output .= 		"<div class='wpgmza_modern_infowindow_close'> x </div>";

    	$iw_output .= 		"<div class='wpgmza_iw_image'>";
    	$iw_output .= 			"<img src='' style='max-width:100% !important;' class='wpgmza_iw_marker_image' />";
    	
    	$iw_output .= 			"<div class='wpgmza_iw_title'>";
    	$iw_output .= 				"<p class='wpgmza_iw_title_p'></p>";
    	$iw_output .= 			"</div>";

    	$iw_output .= 			"";
    	$iw_output .= 		"</div>";
    	$iw_output .= 		"<div class='wpgmza_iw_address'>";
    	$iw_output .= 			"<p class='wpgmza_iw_address_p'></p>";
    	$iw_output .= 		"</div>";
    	$iw_output .= 		"<div class='wpgmza_iw_description'>";
    	$iw_output .= 			"<p class='wpgmza_iw_description_p'></p>";
    	$iw_output .= 		"</div>";
    	$iw_output .= 		"<div class='wpgmza_iw_buttons'>";
    	$iw_output .= 			"<a href='#' class='wpgmza_button wpgmza_left wpgmza_directions_button'>".__("Directions","wp-google-maps")."</a>";
    	$iw_output .= 			"<a href='#' class='wpgmza_button wpgmza_right wpgmza_more_info_button'>$wpgmza_settings_infowindow_link_text</a>";
    	$iw_output .= 		"</div>";
    	$iw_output .= 	"</div>";
    	$iw_output .= "</div>";


    }
    

   
    if (isset($wpgmza_settings['wpgmza_settings_markerlist_category'])) { $hide_category_column = $wpgmza_settings['wpgmza_settings_markerlist_category']; }
    if (isset($wpgmza_settings['wpgmza_settings_markerlist_icon'])) { $hide_icon_column = $wpgmza_settings['wpgmza_settings_markerlist_icon']; }
    if (isset($wpgmza_settings['wpgmza_settings_markerlist_title'])) { $hide_title_column = $wpgmza_settings['wpgmza_settings_markerlist_title']; }
    if (isset($wpgmza_settings['wpgmza_settings_markerlist_address'])) { $hide_address_column = $wpgmza_settings['wpgmza_settings_markerlist_address']; }
    if (isset($wpgmza_settings['wpgmza_settings_markerlist_description'])) { $hide_description_column = $wpgmza_settings['wpgmza_settings_markerlist_description']; }
    if (isset($wpgmza_settings['wpgmza_settings_filterbycat_type'])) { $filterbycat_type = $wpgmza_settings['wpgmza_settings_filterbycat_type']; } else { $filterbycat_type = false; }
    if (!$filterbycat_type) { $filterbycat_type = 1; }
    
    $map_width_type = stripslashes($res->map_width_type);
    $map_height_type = stripslashes($res->map_height_type);
    if (!isset($map_width_type)) { $map_width_type = "px"; }
    if (!isset($map_height_type)) { $map_height_type = "px"; }
    if ($map_width_type == "%" && intval($res->map_width) > 100) { $res->map_width = 100; }
    if ($map_height_type == "%" && intval($res->map_height) > 100) { $res->map_height = 100; }
    $map_align = $res->alignment;
    if (!$map_align || $map_align == "" || $map_align == "1") { $map_align = "float:left;"; }
    else if ($map_align == "2") { $map_align = "margin-left:auto !important; margin-right:auto !important; align:center;"; }
    else if ($map_align == "3") { $map_align = "float:right;"; }
    else if ($map_align == "4") { $map_align = "clear:both;"; }
    $map_style = "style=\"display:block; overflow:auto; width:".$res->map_width."".$map_width_type."; height:".$res->map_height."".$map_height_type."; $map_align\"";
    global $short_code_active;
    $short_code_active = true;
    global $wpgmza_pro_version;
	

	wp_register_style( 'wpgmaps-style-pro', plugins_url('css/wpgmza_style_pro.css', __FILE__), array(), $wpgmza_pro_version );
	wp_enqueue_style( 'wpgmaps-style-pro' );


	$wpgmaps_extra_css = ".wpgmza_map img { max-width:none; }
        .wpgmza_widget { overflow: auto; }";
    wp_add_inline_style( 'wpgmaps-style-pro', $wpgmaps_extra_css );
	wp_add_inline_style( 'wpgmaps-style-pro', $iw_custom_styles );


    $wpgmza_main_settings = get_option("WPGMZA_OTHER_SETTINGS");
    if (isset($wpgmza_main_settings['wpgmza_custom_css']) && $wpgmza_main_settings['wpgmza_custom_css'] != "") { 
        wp_add_inline_style( 'wpgmaps-style-pro', $wpgmza_main_settings['wpgmza_custom_css'] );
    }

    global $wpgmza_short_code_array;
    $wpgmza_short_code_array[] = $wpgmza_current_map_id;
    
    $d_enabled = $res->directions_enabled;
    $filterbycat = $res->filterbycat;
    $map_width = $res->map_width;
    $map_width_type = $res->map_width_type;
    // for marker list
    $default_marker = $res->default_marker;

    if (isset($atts['zoom'])) {
        $zoom_override = $atts['zoom'];
        if (!isset($wpgmza_override['zoom'])) {
        	$wpgmza_override['zoom'] = array();
        }
        $wpgmza_override['zoom'][$wpgmza_current_map_id] = $zoom_override;
    }    

     if (isset($atts['new_window_link'])) {
        $new_window_link = $atts['new_window_link'];
        $wpgmza_override['new_window_link'][$wpgmza_current_map_id] = $new_window_link;
    }   


   	/**
	 * Handle 'direction box' override attribute
	 */
    if (isset($atts['enable_directions'])) { 
    	$d_enabled = intval($atts['enable_directions']);
    }


    if (isset($res->default_to)) { $default_to = $res->default_to; } else { $default_to = ""; }


    /* CUSTOM attr handler*/
    $default_from = "";
 	if(isset($atts['directions_from'])){
 		$default_from = $atts['directions_from'];
 	}

 	if(isset($atts['directions_to'])){
 		$default_to = $atts['directions_to'];
 	}

 	$directions_auto = "";
 	if(isset($atts['directions_auto']) && $atts['directions_auto'] == "true"){
 		$directions_auto = "wpgmaps_auto_get_directions";
 	}

 	$directions_waypoints = "";
 	if(isset($atts['directions_waypoints'])){
 		$directions_waypoints = "<tr class='wpgmaps_to_row' style='display:none;'>
									<td>
										<label for=\"wpgmza_input_waypoints_".$wpgmza_current_map_id."\">".__("Waypoints","wp-google-maps")."</label>
									</td>
									<td>
										<input type=\"text\" value=\"".$atts['directions_waypoints']."\" id=\"wpgmza_input_waypoints_".$wpgmza_current_map_id."\" style='width:80%' />
									</td>
								</tr>";
 	}

    
    $show_location = $res->show_user_location;
    if ($show_location == "1") {
        $use_location_from = "<span style=\"font-size:0.75em;\"><button id=\"wpgmza_use_my_location_from\" mid=\"".$wpgmza_current_map_id."\" title='".__("Use my location","wp-google-maps")."' ><img src='".plugins_url(plugin_basename(dirname(__FILE__)))."/images/mylocation.png' title='".__("Use my location","wp-google-maps")."' width='15' /></button></span>";
        $use_location_to = "<span style=\"font-size:0.75em;\"><button id=\"wpgmza_use_my_location_to\" mid=\"".$wpgmza_current_map_id."\" title='".__("Use my location","wp-google-maps")."' ><img src='".plugins_url(plugin_basename(dirname(__FILE__)))."/images/mylocation.png' title='".__("Use my location","wp-google-maps")."' width='15' /></button></span>";
    } else {
        $use_location_from = "";
        $use_location_to = "";
    }
    if ($default_marker) { $default_marker = "<img src='".$default_marker."' />"; } else { $default_marker = "<img src='".wpgmaps_get_plugin_url()."/images/marker.png' />"; }
    $dbox_width = $res->dbox_width;
    $dbox_option = $res->dbox;


    /* set the width of the directions box */

    if (isset($map_other_settings['wpgmza_dbox_width_type'])) { $wpgmza_dbox_width_type = $map_other_settings['wpgmza_dbox_width_type']; } else { $wpgmza_dbox_width_type = "%"; }




    if ($dbox_option == "1") { $dbox_style = "display:none; width:".$dbox_width.$wpgmza_dbox_width_type."; clear:both;"; }
    else if ($dbox_option == "2") { $dbox_style = "float:left; width:".$dbox_width.$wpgmza_dbox_width_type."; padding-right:10px; display:block; overflow:auto;"; }
    else if ($dbox_option == "3") { $dbox_style = "float:right; width:".$dbox_width.$wpgmza_dbox_width_type."; padding-right:10px; display:block; overflow:auto;"; }
    else if ($dbox_option == "4") { $dbox_style = "float:none; width:".$dbox_width.$wpgmza_dbox_width_type."; padding-bottom:10px; display:block; overflow:auto; clear:both;"; }
    else if ($dbox_option == "5") { $dbox_style = "float:none; width:".$dbox_width.$wpgmza_dbox_width_type."; padding-top:10px; display:block; overflow:auto; clear:both;"; }
    else { $dbox_style = "display:none;"; }

    $wpgmza_marker_list_output = "";
    $wpgmza_marker_filter_output = "";
    // Filter by category
    

   	/**
	 * Handle 'category' filter override attribute
	 */
    if (isset($atts['enable_category'])) { 
    	$filterbycat = intval($atts['enable_category']);
    }

    
    if ($filterbycat == 1) {
        if ($filterbycat_type == "1") {
            $wpgmza_marker_filter_output .= "<p id='wpgmza_filter_".$wpgmza_current_map_id."' style='text-align:left; margin-bottom:0px;'>".__("Filter by","wp-google-maps")."";
            $wpgmza_filter_dropdown = wpgmza_pro_return_category_select_list($wpgmza_current_map_id);
            $wpgmza_marker_filter_output .= "<select mid=\"".$wpgmza_current_map_id."\" name=\"wpgmza_filter_select\" id=\"wpgmza_filter_select\">";
            $wpgmza_marker_filter_output .= $wpgmza_filter_dropdown;
            $wpgmza_marker_filter_output .= "</select></p>";
        } else if (intval($filterbycat_type) == 2) {

            $wpgmza_marker_filter_output .= "<p id='wpgmza_filter_".$wpgmza_current_map_id."' style='text-align:left; margin-bottom:0px;'>".__("Filter by","wp-google-maps")."</p>";
            $wpgmza_marker_filter_output .= "<div style=\"overflow:auto; display:block; width:100%; height:auto; margin-top:10px;\">";
            $wpgmza_marker_filter_output .= "<div class='wpgmza_filter_container' id='wpgmza_filter_container_".$wpgmza_current_map_id."'>";
            $wpgmza_marker_filter_output .= wpgmza_pro_return_category_checkbox_list($wpgmza_current_map_id,true,false);
            $wpgmza_marker_filter_output .= "</div>";
            $wpgmza_marker_filter_output .= "</div>";
            
        } else {
            $wpgmza_marker_filter_output .= "<p id='wpgmza_filter_".$wpgmza_current_map_id."' style='text-align:left; margin-bottom:0px;'>".__("Filter by","wp-google-maps")."";
            $wpgmza_filter_dropdown = wpgmza_pro_return_category_select_list($wpgmza_current_map_id);
            $wpgmza_marker_filter_output .= "<select mid=\"".$wpgmza_current_map_id."\" name=\"wpgmza_filter_select\" id=\"wpgmza_filter_select\">";
            $wpgmza_marker_filter_output .= $wpgmza_filter_dropdown;
            $wpgmza_marker_filter_output .= "</select></p>";
        }
    } 
    $wpgmza_marker_datatables_output = "";
    if (isset($hide_category_column) && $hide_category_column == "yes") { $wpgmza_marker_datatables_output .= "<style>.wpgmza_table_category { display: none !important; }</style>"; }
    if (isset($hide_icon_column) && $hide_icon_column == "yes") { $wpgmza_marker_datatables_output .= "<style>.wpgmza_table_marker { display: none; }</style>"; }
    if (isset($hide_title_column) && $hide_title_column == "yes") { $wpgmza_marker_datatables_output .= "<style>.wpgmza_table_title { display: none; }</style>"; }
    if (isset($hide_address_column) && $hide_address_column == "yes") { $wpgmza_marker_datatables_output .= "<style>.wpgmza_table_address { display: none; }</style>"; }
    if (isset($hide_description_column) && $hide_description_column == "yes") { $wpgmza_marker_datatables_output .= "<style>.wpgmza_table_description { display: none; }</style>"; }
    

   	/**
	 * Handle 'store locator box' override attribute
	 */
	$sl_override = "1";
    if (isset($atts['enable_store_locator'])) { 
    	$sl_override = intval($atts['enable_store_locator']);
    }
    
    $sl_data = "";
    if ($sl_override == "0") { } else {
	    if (isset($map_other_settings['store_locator_enabled']) && $map_other_settings['store_locator_enabled'] == 1) {
	        $sl_data = wpgmaps_sl_user_output_pro($wpgmza_current_map_id,$atts);
	        $wpgmza_marker_filter_output = "";
	    } else { $sl_data = ""; }
	}
    // GET LIST OF MARKERS

    if (isset($map_other_settings['list_markers_by']) && $map_other_settings['list_markers_by'] != "") {
        /* they are using the new listing options */
        
        if ($map_other_settings['list_markers_by'] == "3") {
            if ($wpgmza_current_mashup) {
                $wpgmc = new wpgmza();
                $wpgmza_marker_list_output .= $wpgmc->list_markers(false,3,$wpgmza_mashup_parent_id,$wpgmza_current_map_cat_selection[$wpgmza_current_map_id],true,$wpgmza_mashup_ids[$atts['id']]);
            } else {
                $wpgmc = new wpgmza();
                $wpgmza_marker_list_output .= $wpgmc->list_markers(false,3,$wpgmza_current_map_id,$wpgmza_current_map_cat_selection[$wpgmza_current_map_id]);
            }
           
        }
        else if ($map_other_settings['list_markers_by'] == "1") {
            if ($wpgmza_current_mashup) {
                $wpgmc = new wpgmza();
                $wpgmza_marker_list_output .= $wpgmc->list_markers(false,1,$wpgmza_mashup_parent_id,$wpgmza_current_map_cat_selection[$wpgmza_mashup_parent_id],true,$wpgmza_mashup_ids[$atts['id']],false,$res->order_markers_by,$res->order_markers_choice);
            } else {
                $wpgmc = new wpgmza();
                $wpgmza_marker_list_output .= $wpgmc->list_markers(false,1,$wpgmza_current_map_id,$wpgmza_current_map_cat_selection[$wpgmza_current_map_id],false,false,false,$res->order_markers_by,$res->order_markers_choice);
            }
           
        }
        else if ($map_other_settings['list_markers_by'] == "2") {
            if ($wpgmza_current_mashup) {
                $wpgmc = new wpgmza();
                $wpgmza_marker_list_output .= $wpgmc->list_markers(false,2,$wpgmza_mashup_parent_id,$wpgmza_current_map_cat_selection[$wpgmza_mashup_parent_id],true,$wpgmza_mashup_ids[$atts['id']]);
            } else {
                $wpgmc = new wpgmza();
                $wpgmza_marker_list_output .= $wpgmc->list_markers(false,2,$wpgmza_current_map_id,$wpgmza_current_map_cat_selection[$wpgmza_current_map_id]);
            }
           
        }
        else if ($map_other_settings['list_markers_by'] == "4") {
            if ($wpgmza_current_mashup) {
                $wpgmc = new wpgmza();
                $wpgmza_marker_list_output .= $wpgmc->list_markers(false,4,$wpgmza_mashup_parent_id,$wpgmza_current_map_cat_selection[$wpgmza_mashup_parent_id],true,$wpgmza_mashup_ids[$atts['id']]);
            } else {
                $wpgmc = new wpgmza();
                $wpgmza_marker_list_output .= $wpgmc->list_markers(false,4,$wpgmza_current_map_id,$wpgmza_current_map_cat_selection[$wpgmza_current_map_id]);
            }
           
        }
        
    } else {
    
        if ($res->listmarkers == 1 && $res->listmarkers_advanced == 1) {
            if ($wpgmza_current_mashup) {
                $wpgmza_marker_list_output .= wpgmza_return_marker_list($wpgmza_mashup_parent_id,false,$map_width.$map_width_type,$wpgmza_current_mashup,$wpgmza_mashup_ids[$atts['id']]);
            } else {
                $wpgmza_marker_list_output .= wpgmza_return_marker_list($wpgmza_current_map_id,false,$map_width.$map_width_type,false);
            }
        }
        else if ($res->listmarkers == 1 && $res->listmarkers_advanced == 0) {

            global $wpdb;
            global $wpgmza_tblname;

            // marker sorting functionality
            if ($res->order_markers_by == 1) { $order_by = "id"; }
            else if ($res->order_markers_by == 2) { $order_by = "title"; }
            else if ($res->order_markers_by == 3) { $order_by = "address"; }
            else if ($res->order_markers_by == 4) { $order_by = "description"; }
            else if ($res->order_markers_by == 5) { $order_by = "category"; }
            else { $order_by = "id"; }
            if ($res->order_markers_choice == 1) { $order_choice = "ASC"; }
            else { $order_choice = "DESC"; }

            if ($wpgmza_current_mashup) {

                $wpgmza_cnt = 0;
                $sql_string1 = "";
                if ($wpgmza_mashup_ids[$atts['id']][0] == "ALL") {
                    $wpgmza_sql1 ="SELECT * FROM $wpgmza_tblname ORDER BY `$order_by` $order_choice";
                } else {
                    $wpgmza_id_cnt = count($wpgmza_mashup_ids[$atts['id']]);
                    foreach ($wpgmza_mashup_ids[$atts['id']] as $wpgmza_map_id) {
                        $wpgmza_cnt++;
                        if ($wpgmza_cnt == 1) { $sql_string1 .= "`map_id` = '$wpgmza_map_id' "; }
                        elseif ($wpgmza_cnt > 1 && $wpgmza_cnt < $wpgmza_id_cnt) { $sql_string1 .= "OR `map_id` = '$wpgmza_map_id' "; }
                        else { $sql_string1 .= "OR `map_id` = '$wpgmza_map_id' "; }

                    }
                    $wpgmza_sql1 ="SELECT * FROM $wpgmza_tblname WHERE $sql_string1 ORDER BY `$order_by` $order_choice";
                }
            } else {
                $wpgmza_sql1 ="SELECT * FROM $wpgmza_tblname WHERE `map_id` = '$wpgmza_current_map_id' ORDER BY `$order_by` $order_choice";
            }

            $results = $wpdb->get_results($wpgmza_sql1);


            $wpgmza_marker_list_output .= "
                    <div style='clear:both;'>
                    <table id=\"wpgmza_marker_list\" class=\"wpgmza_marker_list_class\" cellspacing=\"0\" cellpadding=\"0\" style='width:".$map_width."".$map_width_type."'>
                    <tbody>
            ";


            $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");
			if (isset($wpgmza_settings['wpgmza_settings_image_resizing']) && $wpgmza_settings['wpgmza_settings_image_resizing'] == 'yes') { $wpgmza_image_resizing = true; } else { $wpgmza_image_resizing = false; }
            if (isset($wpgmza_settings['wpgmza_settings_image_height'])) { $wpgmza_image_height = $wpgmza_settings['wpgmza_settings_image_height']; } else { $wpgmza_image_height = false; }
            if (isset($wpgmza_settings['wpgmza_settings_image_height'])) { $wpgmza_image_height = $wpgmza_settings['wpgmza_settings_image_height']."px"; } else { $wpgmza_image_height = false; }
            if (isset($wpgmza_settings['wpgmza_settings_image_width'])) { $wpgmza_image_width = $wpgmza_settings['wpgmza_settings_image_width']."px"; } else { $wpgmza_image_width = false; }
            if (!$wpgmza_image_height || !isset($wpgmza_image_height)) { $wpgmza_image_height = "auto"; }
            if (!$wpgmza_image_width || !isset($wpgmza_image_width)) { $wpgmza_image_width = "auto"; }
            $wmcnt = 0;
            foreach ( $results as $result ) {
                $wmcnt++;
                $img = $result->pic;
                $wpgmaps_id = $result->id;
                $link = $result->link;
                $icon = $result->icon;
                $wpgmaps_lat = $result->lat;
                $wpgmaps_lng = $result->lng;
                $wpgmaps_address = $result->address;
            	/* added in 5.52 - phasing out timthumb */
            	/* timthumb completely removed in 5.54 */
                /*if ($wpgmza_use_timthumb == "" || !isset($wpgmza_use_timthumb)) {
					$pic = "<img src='".wpgmaps_get_plugin_url()."/timthumb.php?src=".$result->pic."&h=".$wpgmza_image_height."&w=".$wpgmza_image_width."&zc=1' />";
                } else {*/
		            if (!$img) { $pic = ""; } else {
		        		if ($wpgmza_image_resizing) {
		                    $pic = "<img src='".$result->pic."' class='wpgmza_map_image' style=\"margin:5px; height:".$wpgmza_image_height."px; width:".$wpgmza_image_width.".px\" />";
		                } else {
		                    $pic = "<img src='".$result->pic."' class='wpgmza_map_image' style=\"margin:5px;\" />";
		                }
                   	}
                /*}*/
                if (!$icon) { $icon = $default_marker; } else { $icon = "<img src='".$result->icon."' />"; }
                if ($d_enabled == "1") {
                    $wpgmaps_dir_text = "<br /><a href=\"javascript:void(0);\" id=\"$wpgmza_current_map_id\" title=\"".__("Get directions to","wp-google-maps")." ".$result->title."\" class=\"wpgmza_gd\" wpgm_addr_field=\"".$wpgmaps_address."\" gps=\"$wpgmaps_lat,$wpgmaps_lng\">".__("Directions","wp-google-maps")."</a>";
                } else { $wpgmaps_dir_text = ""; }
                if ($result->description) {
                    $wpgmaps_desc_text = "<br />".$result->description."";
                } else {
                    $wpgmaps_desc_text = "";
                }
                if ($wmcnt%2) { $oddeven = "wpgmaps_odd"; } else { $oddeven = "wpgmaps_even"; }



                $wpgmza_marker_list_output .= "
                    <tr id=\"wpgmza_marker_".$result->id."\" mid=\"".$result->id."\" mapid=\"".$result->map_id."\" class=\"wpgmaps_mlist_row $oddeven\">
                        <td height=\"40\" class=\"wpgmaps_mlist_marker\">".$icon."</td>
                        <td class=\"wpgmaps_mlist_pic\" style=\"width:".($wpgmza_image_width+20)."px;\">$pic</td>
                        <td  valign=\"top\" align=\"left\" class=\"wpgmaps_mlist_info\">
                            <strong><a href=\"javascript:openInfoWindow($wpgmaps_id);\" id=\"wpgmaps_marker_$wpgmaps_id\" title=\"".stripslashes($result->title)."\">".stripslashes($result->title)."</a></strong>
                            ".stripslashes($wpgmaps_desc_text)."
                            $wpgmaps_dir_text
                        </td>

                    </tr>";
            }
            $wpgmza_marker_list_output .= "</tbody></table></div>";

        } else { $wpgmza_marker_list_output = ""; }
    }

	if ($d_enabled == "1") {
	    $dbox_div = "
			<div id=\"wpgmaps_directions_edit_".$wpgmza_current_map_id."\" style=\"$dbox_style\" class=\"wpgmaps_directions_outer_div\">
				<h2>".__("Get Directions","wp-google-maps")."</h2>
				<div id=\"wpgmaps_directions_editbox_".$wpgmza_current_map_id."\">
					<table>
						<tr>
							<td>
								<label for=\"wpgmza_dir_type_".$wpgmza_current_map_id."\">".__("For","wp-google-maps")."</label>
							</td>
							<td>
								<select id=\"wpgmza_dir_type_".$wpgmza_current_map_id."\" name=\"wpgmza_dir_type_".$wpgmza_current_map_id."\">
									<option value=\"DRIVING\" selected=\"selected\">".__("Driving","wp-google-maps")."</option>
									<option value=\"WALKING\">".__("Walking","wp-google-maps")."</option>
									<option value=\"TRANSIT\">".__("Transit","wp-google-maps")."</option>
									<option value=\"BICYCLING\">".__("Bicycling","wp-google-maps")."</option>
								</select>
								&nbsp;
								<a href=\"javascript:void(0);\" mapid=\"".$wpgmza_current_map_id."\" id=\"wpgmza_show_options_".$wpgmza_current_map_id."\" onclick=\"wpgmza_show_options(".$wpgmza_current_map_id.");\" style=\"font-size:10px;\">".__("show options","wp-google-maps")."</a>
								<a href=\"javascript:void(0);\" mapid=\"".$wpgmza_current_map_id."\" id=\"wpgmza_hide_options_".$wpgmza_current_map_id."\" onclick=\"wpgmza_hide_options(".$wpgmza_current_map_id.");\" style=\"font-size:10px; display:none;\">".__("hide options","wp-google-maps")."</a>
								<div style=\"display:none\" id=\"wpgmza_options_box_".$wpgmza_current_map_id."\">
									<input type=\"checkbox\" id=\"wpgmza_tolls_".$wpgmza_current_map_id."\" name=\"wpgmza_tolls_".$wpgmza_current_map_id."\" value=\"tolls\" /> <label for=\"wpgmza_tolls_".$wpgmza_current_map_id."\">".__("Avoid Tolls","wp-google-maps")."</label><br />
									<input type=\"checkbox\" id=\"wpgmza_highways_".$wpgmza_current_map_id."\" name=\"wpgmza_highways_".$wpgmza_current_map_id."\" value=\"highways\" /> <label for=\"wpgmza_highways_".$wpgmza_current_map_id."\">".__("Avoid Highways","wp-google-maps")."</label><br />
									<input type=\"checkbox\" id=\"wpgmza_ferries_".$wpgmza_current_map_id."\" name=\"wpgmza_ferries_".$wpgmza_current_map_id."\" value=\"ferries\" /> <label for=\"wpgmza_ferries_".$wpgmza_current_map_id."\">".__("Avoid Ferries","wp-google-maps")."</label>
								</div>
							</td>
						</tr>
						<tr class='wpgmaps_from_row'>
							<td class='wpgmaps_from_td1'>
								<label for=\"wpgmza_input_from_".$wpgmza_current_map_id."\">".__("From","wp-google-maps")."</label>
							</td>
							<td width='90%' class='wpgmaps_from_td2'>
								<input type=\"text\" value=\"$default_from\" id=\"wpgmza_input_from_".$wpgmza_current_map_id."\" style='width:80%' /> $use_location_from
							</td>
						</tr>
						<tr class='wpgmaps_to_row'>
							<td class='wpgmaps_to_td1'>
								<label for=\"wpgmza_input_to_".$wpgmza_current_map_id."\">".__("To","wp-google-maps")."</label>
							</td>
							<td width='90%' class='wpgmaps_to_td2'>
								<input type=\"text\" value=\"$default_to\" id=\"wpgmza_input_to_".$wpgmza_current_map_id."\" style='width:80%' /> $use_location_to
							</td>
						</tr>
						". $directions_waypoints ."
						<tr>
							<td>
							</td>
							<td>
								<input onclick=\"javascript:void(0);\" class=\"wpgmaps_get_directions $directions_auto\" id=\"".$wpgmza_current_map_id."\" type=\"button\" value=\"".__("Go","wp-google-maps")."\"/>
							</td>
						</tr>
					</table>
				</div>
			</div>

	    ";
	} else {
		$dbox_div = "";
	}


    if ($dbox_option == "5" || $dbox_option == "1" || !isset($dbox_option)) {
        

        if ($wpgmza_current_mashup) {
            $wpgmza_anchors = $wpgmza_mashup_ids[$atts['id']];
        } else {
            $wpgmza_anchors = $wpgmza_current_map_id;
        }

        $ret_msg = "
            $wpgmza_marker_datatables_output
            ".wpgmaps_check_approval_string()."
            ".wpgmaps_return_marker_anchors($wpgmza_anchors)."
            <a name='map".$wpgmza_current_map_id."'></a>
            $wpgmza_marker_filter_output
            ".apply_filters("wpgooglemaps_filter_map_output","",$wpgmza_current_map_id)."
            ".(!isset($map_other_settings['store_locator_below']) ? "$sl_data" : "")."
            ".(isset($map_other_settings['store_marker_listing_below']) ? "$wpgmza_marker_list_output" : "")."

            ".apply_filters("wpgooglemaps_filter_map_div_output","<div class=\"wpgmza_map\" id=\"wpgmza_map_".$wpgmza_current_map_id."\" $map_style> </div>",$wpgmza_current_map_id)."
            ".(isset($map_other_settings['store_locator_below']) ? "$sl_data" : "")."
            ".(!isset($map_other_settings['store_marker_listing_below']) ? "$wpgmza_marker_list_output" : "")."
            

<div style=\"display:block; width:100%;\">
	
	$dbox_div
	
	<div id=\"wpgmaps_directions_notification_".$wpgmza_current_map_id."\" style=\"display:none;\">".__("Fetching directions...","wp-google-maps")."...</div>
	
	<div id=\"wpgmaps_directions_reset_".$wpgmza_current_map_id."\" style=\"display:none;\">
		<a href='javascript:void(0)' onclick='wpgmza_reset_directions(".$wpgmza_current_map_id.");' id='wpgmaps_reset_directions' title='".__("Reset directions","wp-google-maps")."'>".__("Reset directions","wp-google-maps")."</a>
		<br />
		<a href='' id='wpgmaps_print_directions_".$wpgmza_current_map_id."' title='".__("Print directions","wp-google-maps")."'>".__("Print directions","wp-google-maps")."</a>
	</div>
	
	<div id=\"directions_panel_".$wpgmza_current_map_id."\"></div>

</div>

        ";
    } else {
        if ($wpgmza_current_mashup) {
            $wpgmza_anchors = $wpgmza_mashup_ids[$atts['id']];
        } else {
            $wpgmza_anchors = $wpgmza_current_map_id;
        }

        
        $ret_msg = "
			$wpgmza_marker_datatables_output

			<div style=\"display:block; width:100%;\">

				$dbox_div
			
				<div id=\"wpgmaps_directions_notification_".$wpgmza_current_map_id."\" style=\"display:none;\">".__("Fetching directions...","wp-google-maps")."...</div>
				<div id=\"wpgmaps_directions_reset_".$wpgmza_current_map_id."\" style=\"display:none;\">
					<a href='javascript:void(0)' onclick='wpgmza_reset_directions(".$wpgmza_current_map_id.");' id='wpgmaps_reset_directions' title='".__("Reset directions","wp-google-maps")."'>".__("Reset directions","wp-google-maps")."</a>
					<br />
					<a href='' id='wpgmaps_print_directions_".$wpgmza_current_map_id."' title='".__("Print directions","wp-google-maps")."'>".__("Print directions","wp-google-maps")."</a>
				</div>
			
				<div id=\"directions_panel_".$wpgmza_current_map_id."\"></div>
			
			</div>

			$wpgmza_marker_filter_output
			".(!isset($map_other_settings['store_locator_below']) ? "$sl_data" : "")."
			".(isset($map_other_settings['store_marker_listing_below']) ? "$wpgmza_marker_list_output" : "")."

			".wpgmaps_return_marker_anchors($wpgmza_anchors)."
            <a name='map".$wpgmza_current_map_id."'></a>

			".apply_filters("wpgooglemaps_filter_map_div_output","<div class=\"wpgmza_map\" id=\"wpgmza_map_".$wpgmza_current_map_id."\" $map_style> </div>", $wpgmza_current_map_id)."   
			".(isset($map_other_settings['store_locator_below']) ? "$sl_data" : "")."

			".(!isset($map_other_settings['store_marker_listing_below']) ? "$wpgmza_marker_list_output" : "")."
			

        ";

    }

    if (function_exists("wpgmza_register_ugm_version")) {
        $ugm_enabled = $res->ugm_enabled;
        if ($ugm_enabled == 1) {

     		if (isset($atts['disable_vgm_form']) && $atts['disable_vgm_form'] == '1') {
     			/* do nothing */
     		} else {
            	$ret_msg .= wpgmaps_ugm_user_form($wpgmza_current_map_id, false, false);
            }
        }
    }
    
    
    if ($wpgmza_using_custom_meta) {
        /* we're using meta fields to generate the map, ignore default functionality */
        
        $ret_msg = "
            ".apply_filters("wpgooglemaps_filter_map_div_output","<div class=\"wpgmza_map\" id=\"wpgmza_map_".$wpgmza_current_map_id."\" $map_style> </div>", $wpgmza_current_map_id)."

            ";
    }
    

    




    if (isset($atts['marker'])) {
        $wpgmza_focus_marker = $atts['marker'];
        if (!isset($wpgmza_override['marker'])) {
        	$wpgmza_override['marker'] = array();
        }
        $wpgmza_override['marker'][$wpgmza_current_map_id] = $wpgmza_focus_marker;
    }    


    return $ret_msg;
}


add_action('wp_footer','wpgmza_output_user_js_pro');
 /**
 * Output user JS
 */
function wpgmza_output_user_js_pro() {
	wpgmaps_user_javascript_pro();

}

/**
 * @deprecated 6.4.00
 */
function wpgmza_generate_marker_list($map_id, $type) {
    global $wpdb;
    
}

function wpgmaps_check_approval_string() {
    if (isset($_POST['wpgmza_approval'] ) && $_POST['wpgmza_approval'] == "1") {
        return "<p class='wpgmza_marker_approval_msg'>".__("Thank you. Your marker is awaiting approval.","wp-google-maps")."</p>";

    }
}

function wpgmaps_return_marker_anchors($mid) {
	/* deprecated in 6.09 - causes irrelevant anchors (for each marker) to be displayed on the map only for the event of clicking on the marker and centering the page to the top of the map. A single anchor can achieve the same */
	return "";


    global $wpdb;
    global $wpgmza_tblname;



    if (is_array($mid)) {
        $wpgmza_cnt = 0;
        $sql_string1 = "";

        if ($mid[0] == "ALL") {
            $results = $wpdb->get_results("
                SELECT *
                FROM $wpgmza_tblname
                ORDER BY `id` DESC
            ");
        } else {

            $wpgmza_id_cnt = count($mid);
            foreach ($mid as $wpgmza_map_id) {
                $wpgmza_cnt++;
                if ($wpgmza_cnt == 1) { $sql_string1 .= "`map_id` = '$wpgmza_map_id' "; }
                elseif ($wpgmza_cnt > 1 && $wpgmza_cnt < $wpgmza_id_cnt) { $sql_string1 .= "OR `map_id` = '$wpgmza_map_id' "; }
                else { $sql_string1 .= "OR `map_id` = '$wpgmza_map_id' "; }

            }
            $results = $wpdb->get_results("
                SELECT *
                FROM $wpgmza_tblname
                WHERE $sql_string1 ORDER BY `id` DESC
            ");
        }
    } else {
        $results = $wpdb->get_results("
            SELECT *
            FROM $wpgmza_tblname
            WHERE `map_id` = '$mid' ORDER BY `id` DESC
        ");
    }







    

    $wpmlist = "";
    foreach ( $results as $result ) {
        $marker_id = $result->id;
        $wpmlist .= "<a name='marker".$marker_id."' ></a>";
    }
    return $wpmlist;
    
    
}
function wpgmza_return_all_map_ids() {
    global $wpdb;
    global $wpgmza_tblname_maps;
    $sql = "SELECT `id` FROM `".$wpgmza_tblname_maps."` WHERE `active` = 0";
    $results = $wpdb->get_results($sql);
    $tarr = array();
    foreach ($results as $result) {
        array_push($tarr,$result->id);
    }
    return $tarr;

}

function wpgmaps_user_javascript_pro($atts = false) {

    global $short_code_active;
    if ($short_code_active) {


	    global $wpgmza_count;
	    $wpgmza_count++;
	    if ($wpgmza_count >1) {  } else {
	    global $wpgmza_current_map_id;
	    global $wpgmza_short_code_array;
	    global $wpgmza_current_mashup;
	    global $wpgmza_pro_version;
	    
	    global $wpgmza_current_map_cat_selection;
	    global $wpgmza_current_map_shortcode_data;
	    global $wpgmza_current_map_type;
	    
	    if ($wpgmza_current_mashup) { $wpgmza_current_mashup_string = "true"; } else { $wpgmza_current_mashup_string = "false"; }
	    
	    global $wpgmza_mashup_ids;
	    if (isset($wpgmza_mashup_ids)) {
	        if (isset($wpgmza_mashups_ids) && $wpgmza_mashups_ids == "ALL") {
	            $wpgmza_mashup_ids = wpgmza_return_all_map_ids();
	        }
	    }


	    if (isset($wpgmza_settings['wpgmza_api_version'])) { $api_version = $wpgmza_settings['wpgmza_api_version']; } else { $api_version = ""; }
	    if (isset($api_version) && $api_version != "") {
	        $api_version_string = "v=$api_version&";
	    } else {
	        $api_version_string = "v=3.exp&";
	    }


		$wpgmza_locale = get_locale();
		$wpgmza_suffix = ".com";
		/* Hebrew correction */
		if ($wpgmza_locale == "he_IL") { $wpgmza_locale = "iw"; }

		/* Chinese integration */
		if ($wpgmza_locale == "zh_CN") { $wpgmza_suffix = ".cn"; } else { $wpgmza_suffix = ".com"; }

	    if(isset($wpgmza_settings['wpgmza_settings_remove_api']) && $wpgmza_settings['wpgmza_settings_remove_api'] == "yes"){ } else { 


			$wpgmza_api_key = get_option( 'wpgmza_google_maps_api_key' );

	        if( $wpgmza_api_key ){
	            wp_enqueue_script('wpgmza_api_call', '//maps.google'.$wpgmza_suffix.'/maps/api/js?'.$api_version_string.'key='.$wpgmza_api_key.'&language='.$wpgmza_locale.'&libraries=places,visualization', array(), $wpgmza_pro_version.'p', false );
	        } else {
	            wp_enqueue_script('wpgmza_api_call', '//maps.google'.$wpgmza_suffix.'/maps/api/js?'.$api_version_string.'language='.$wpgmza_locale.'&libraries=places,visualization', array(), $wpgmza_pro_version.'p', false );            
	        }
	    	

	 	} 






    

      
        $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");
        global $wpgmza_pro_version;
        $ajax_nonce = wp_create_nonce("wpgmza");
        wp_register_script('wpgmaps_datatables', plugins_url(plugin_basename(dirname(__FILE__)))."/js/jquery.dataTables.min.js", true);
        wp_enqueue_script( 'wpgmaps_datatables' );
        wp_register_script('wpgmaps_datatables-responsive', plugins_url(plugin_basename(dirname(__FILE__)))."/js/dataTables.responsive.js", true);
        wp_enqueue_script( 'wpgmaps_datatables-responsive' );

        wp_register_style('wpgmaps_datatables_style', plugins_url(plugin_basename(dirname(__FILE__)))."/css/data_table_front.css", array(), $wpgmza_pro_version);
        wp_enqueue_style( 'wpgmaps_datatables_style' );
        wp_register_style('wpgmaps_datatables_responsive-style', "//cdn.datatables.net/responsive/1.0.4/css/dataTables.responsive.css", array(), $wpgmza_pro_version);
        wp_enqueue_style( 'wpgmaps_datatables_responsive-style' );

        $wpgmza_using_custom_fields = false;
            
            $res = array();
            $marker_data_array = array();
            

            /**
             * Used for acquiring category data for all the maps on the page
             * @var array
             */
            $map_id_array = array();


            $include_owl = false;
			$mashup_js_string = "";

            if (isset($wpgmza_short_code_array)) {


                foreach ($wpgmza_short_code_array as $wpgmza_cmd) {

					$map_id_array[$wpgmza_cmd] = "1";


					if (isset($wpgmza_mashup_ids[$wpgmza_cmd])) { $mashup_js_string .= "wpgmaps_map_mashup[$wpgmza_cmd] = true;\n"; }
                	$marker_data_array[$wpgmza_cmd] = array();
		 			

					if ($wpgmza_settings['wpgmza_settings_marker_pull'] == "0") {
		            	if (isset($wpgmza_mashup_ids[$wpgmza_cmd])) {


			                foreach ($wpgmza_mashup_ids[$wpgmza_cmd] as $mashup_id) {
			                    //$res[$wpgmza_cmd] = wpgmza_get_map_data($mashup_id);

			                	$temp_marker_array = wpgmaps_return_markers($mashup_id);
			                	
			                	foreach ($temp_marker_array as $temp_array) {
	                				array_push($marker_data_array[$wpgmza_cmd], $temp_array);
			                	}

		                        //$marker_data_array[$wpgmza_cmd] = wpgmaps_return_markers($mashup_id);
		            		}
		            	} else {
		                    if ($wpgmza_settings['wpgmza_settings_marker_pull'] == "0" || $wpgmza_settings['wpgmza_settings_marker_pull'] == 0) {
		                        $marker_data_array[$wpgmza_cmd] = wpgmaps_return_markers($wpgmza_cmd);
		                    }

		            	}
		            }





                    $res[$wpgmza_cmd] = wpgmza_get_map_data($wpgmza_cmd);
                    
                    /* Added in version 5.44
                     */
                    
                    /* check if we are using custom fields instead of traditional map data */
                    if (isset($wpgmza_current_map_shortcode_data[$wpgmza_current_map_id]['lat']) && isset($wpgmza_current_map_shortcode_data[$wpgmza_current_map_id]['lng']) && isset($wpgmza_current_map_shortcode_data[$wpgmza_current_map_id]['parent_id']) && $wpgmza_current_map_shortcode_data[$wpgmza_current_map_id]['lng'] && $wpgmza_current_map_shortcode_data[$wpgmza_current_map_id]['lat']) {
                        /* we are using custom fields, get the parent map data */
                            $wpgmza_using_custom_fields = true;
                            $res[$wpgmza_cmd] = wpgmza_get_map_data($wpgmza_current_map_shortcode_data[$wpgmza_current_map_id]['parent_id']);
                            $temp_other_settings = maybe_unserialize($res[$wpgmza_cmd]->other_settings);
                            $temp_other_settings['store_locator_enabled'] = 0;
                            $res[$wpgmza_cmd]->other_settings['store_locator_enabled'] = 0;
                            $res[$wpgmza_cmd]->other_settings = maybe_serialize($temp_other_settings);
                    } else {
                        $wpgmza_using_custom_fields = false;
                    }

                    
                    /* end of 5.44 addition */
                    
                    
                    
                    if ($res[$wpgmza_cmd]->styling_json != '') {
                        $res[$wpgmza_cmd]->styling_json = html_entity_decode(stripslashes($res[$wpgmza_cmd]->styling_json));
                    }
                    if ($res[$wpgmza_cmd]->other_settings != '') {
                        $res[$wpgmza_cmd]->other_settings = $other_settings = maybe_unserialize($res[$wpgmza_cmd]->other_settings);
                        if (isset($other_settings['list_markers_by']) && $other_settings['list_markers_by'] == '3') { $include_owl = true; }
                        if (isset($other_settings['wpgmza_theme_data']) && $other_settings['wpgmza_theme_data'] != false) { $res[$wpgmza_cmd]->other_settings['wpgmza_theme_data'] = html_entity_decode(stripslashes($other_settings['wpgmza_theme_data'])); }
                    }
                    $res[$wpgmza_cmd]->map_width_type = stripslashes($res[$wpgmza_cmd]->map_width_type);
                    $res[$wpgmza_cmd]->total_markers = wpgmza_return_marker_count($wpgmza_cmd);
                    
                    

                	/** handle directions override attribute from shortcode */
                	if ($atts) {
					    if (isset($atts['enable_directions'])) { 
					    	$res[$wpgmza_cmd]->directions_enabled = $atts['enable_directions'];
					        // carousel marker listing fix
					        echo '<style>.wpgmza_marker_directions_link { display:none; }</style>';

					    }
				    }
                    
                    

                }
            }


            /**
             * Get all category data for all current maps for localization
             */
            $category_data_array = array();

            foreach ( $map_id_array as $key_map => $key_val ) {
            	$category_data_array_tmp = array();

            	$category_data_array[$key_map] = array();
            	
            	$tmp_cat_data = wpgmza_get_category_localized_data( $key_map );
            	foreach ( $tmp_cat_data as $tmp_cat_data_single ) {

            		$category_data_array_tmp[intval( $tmp_cat_data_single->cat_id )] = intval( $tmp_cat_data_single->parent );
            	}
            	$category_data_array[$key_map] = $category_data_array_tmp;
            } 

            
            
   
            if (function_exists("wpgmaps_gold_activate")) {
                wp_register_script('wpgmaps_user_marker_clusterer_js', wpgmaps_get_plugin_url() .'/js/markerclusterer.js',array(),"1.0",false);
                wp_enqueue_script( 'wpgmaps_user_marker_clusterer_js' );
                
            }

            if ($include_owl) {
                wp_register_script('owl_carousel', plugins_url('wp-google-maps-pro') .'/js/owl.carousel.min.js', array(), $wpgmza_pro_version.'p' , false);
                wp_enqueue_script( 'owl_carousel' );
                wp_register_style('owl_carousel_style', plugins_url('wp-google-maps-pro') .'/css/owl.carousel.css', array(), $wpgmza_pro_version);
                wp_enqueue_style( 'owl_carousel_style' );
                wp_register_style('owl_carousel_style_theme', plugins_url('wp-google-maps-pro') .'/css/owl.theme.css', array(), $wpgmza_pro_version);
                wp_enqueue_style( 'owl_carousel_style_theme' );
                if (isset($wpgmza_settings['wpgmza_settings_carousel_markerlist_theme']) && $wpgmza_settings['wpgmza_settings_carousel_markerlist_theme'] == 'sky') { 
                    wp_register_style('owl_carousel_style_theme_select', plugins_url('wp-google-maps-pro') .'/css/carousel_sky.css', array(), $wpgmza_pro_version);
                    wp_enqueue_style( 'owl_carousel_style_theme_select' );
                } else if (isset($wpgmza_settings['wpgmza_settings_carousel_markerlist_theme']) && $wpgmza_settings['wpgmza_settings_carousel_markerlist_theme'] == 'sun') { 
                    wp_register_style('owl_carousel_style_theme_select', plugins_url('wp-google-maps-pro') .'/css/carousel_sun.css', array(), $wpgmza_pro_version);
                    wp_enqueue_style( 'owl_carousel_style_theme_select' );
                } else if (isset($wpgmza_settings['wpgmza_settings_carousel_markerlist_theme']) && $wpgmza_settings['wpgmza_settings_carousel_markerlist_theme'] == 'earth') { 
                    wp_register_style('owl_carousel_style_theme_select', plugins_url('wp-google-maps-pro') .'/css/carousel_earth.css', array(), $wpgmza_pro_version);
                    wp_enqueue_style( 'owl_carousel_style_theme_select' );
                } else if (isset($wpgmza_settings['wpgmza_settings_carousel_markerlist_theme']) && $wpgmza_settings['wpgmza_settings_carousel_markerlist_theme'] == 'monotone') { 
                    wp_register_style('owl_carousel_style_theme_select', plugins_url('wp-google-maps-pro') .'/css/carousel_monotone.css', array(), $wpgmza_pro_version);
                    wp_enqueue_style( 'owl_carousel_style_theme_select' );
                } else if (isset($wpgmza_settings['wpgmza_settings_carousel_markerlist_theme']) && $wpgmza_settings['wpgmza_settings_carousel_markerlist_theme'] == 'pinkpurple') { 
                    wp_register_style('owl_carousel_style_theme_select', plugins_url('wp-google-maps-pro') .'/css/carousel_pinkpurple.css', array(), $wpgmza_pro_version);
                    wp_enqueue_style( 'owl_carousel_style_theme_select' );
                } else if (isset($wpgmza_settings['wpgmza_settings_carousel_markerlist_theme']) && $wpgmza_settings['wpgmza_settings_carousel_markerlist_theme'] == 'white') { 
                    wp_register_style('owl_carousel_style_theme_select', plugins_url('wp-google-maps-pro') .'/css/carousel_white.css', array(), $wpgmza_pro_version);
                    wp_enqueue_style( 'owl_carousel_style_theme_select' );
                } else if (isset($wpgmza_settings['wpgmza_settings_carousel_markerlist_theme']) && $wpgmza_settings['wpgmza_settings_carousel_markerlist_theme'] == 'black') { 
                    wp_register_style('owl_carousel_style_theme_select', plugins_url('wp-google-maps-pro') .'/css/carousel_black.css', array(), $wpgmza_pro_version);
                    wp_enqueue_style( 'owl_carousel_style_theme_select' );
                } else {
                    wp_register_style('owl_carousel_style_theme_select', plugins_url('wp-google-maps-pro') .'/css/carousel_sky.css', array(), $wpgmza_pro_version);
                    wp_enqueue_style( 'owl_carousel_style_theme_select' );
                }
                
            }


            wp_enqueue_script('wpgmaps_core', plugins_url('wp-google-maps-pro') .'/js/core.js', array(), $wpgmza_pro_version.'p' , false);
            do_action("wpgooglemaps_hook_user_js_after_core");

            
            if ( function_exists( "wpgmaps_ugm_activate" ) ) {
                global $wpgmza_ugm_version;
			    $wpgmza_vgmc = floatval(str_replace(".","",$wpgmza_ugm_version));
			    
			    if ($wpgmza_vgmc < 300) {
			    	/* only load this if the version is less than 3.00 */
                	wp_enqueue_script('wpgmaps_ugm_core', plugins_url('wp-google-maps-ugm') .'/js/ugm-core.js', array('wpgmaps_core'), $wpgmza_ugm_version.'vgm' , false);

                }
                
            }
            
            if (function_exists("wpgmaps_sl_activate")) {
                global $wpgmza_sl_version;
                wp_enqueue_script('wpgmaps_sl_core', plugins_url('wp-google-maps-store-locator') .'/js/sl-core.js', array(), $wpgmza_sl_version.'sl' , false);
            }
            
            
            global $wpgmza_pro_version;
            
            
            if (isset($wpgmza_settings['list_markers_by'])) { } else { $wpgmza_settings['list_markers_by'] = false; }
                
            
            

            
            wp_localize_script( 'wpgmaps_core', 'wpgmaps_localize', $res);
            wp_localize_script( 'wpgmaps_core', 'wpgmaps_localize_mashup_ids', $wpgmza_mashup_ids);
            if ($wpgmza_settings['wpgmza_settings_marker_pull'] == "0") {
                wp_localize_script( 'wpgmaps_core', 'wpgmaps_localize_marker_data', $marker_data_array);
            }
            wp_localize_script( 'wpgmaps_core', 'wpgmaps_localize_cat_ids', $wpgmza_current_map_cat_selection);
            if ($wpgmza_using_custom_fields) {
                wp_localize_script( 'wpgmaps_core', 'wpgmaps_localize_shortcode_data', $wpgmza_current_map_shortcode_data);
            }
            wp_localize_script( 'wpgmaps_core', 'wpgmaps_localize_map_types', $wpgmza_current_map_type);

            $wpgmza_settings = apply_filters("wpgmza_filter_localize_settings",$wpgmza_settings);

            wp_localize_script( 'wpgmaps_core', 'wpgmaps_localize_global_settings', $wpgmza_settings);
            


            wp_localize_script( 'wpgmaps_core', 'wpgmaps_localize_categories', $category_data_array);



            if ($wpgmza_mashup_ids !== null) {
            	wp_localize_script( 'wpgmaps_core', 'wpgmza_mashup_ids', $wpgmza_mashup_ids);
            }
            
            do_action("wpgooglemaps_hook_user_js_after_localize",$res);
            
            $polygonoptions = array();
            $datasetoptions = array();
            $polylineoptions = array();
            
            // get polyline and polygon settings and localize it
            if (isset($wpgmza_short_code_array)) {

				
                foreach ($wpgmza_short_code_array as $wpgmza_cmd) {
                    if ($wpgmza_current_mashup) {
                         foreach ($wpgmza_mashup_ids as $wpgmza_tmp_plg_array) {
                         	foreach ($wpgmza_tmp_plg_array as $wpgmza_tmp_plg) {
	                            $total_poly_array = wpgmza_b_return_dataset_id_array($wpgmza_tmp_plg);
	                            if ($total_poly_array > 0) {
	                                foreach ($total_poly_array as $dataset_id) {
	                                    $datasetoptions[$wpgmza_cmd][$dataset_id] = wpgmza_b_return_dataset_options($dataset_id);
	                                    $dataset_second_options[$wpgmza_cmd][$dataset_id] = maybe_unserialize($datasetoptions[$wpgmza_cmd][$dataset_id]->options);

	                                    $tmp_poly_array = wpgmza_b_return_dataset_array($dataset_id);
	                                    $poly_data_raw_array = array();
	                                    foreach ($tmp_poly_array as $single_poly) {
	                                        $poly_data_raw = str_replace(" ","",$single_poly);
	                                        $poly_data_raw = explode(",",$poly_data_raw);
	                                        $lat = $poly_data_raw[0];
	                                        $lng = $poly_data_raw[1];
	                                        $poly_data_raw_array[] = $poly_data_raw;
	                                    }
	                                    $datasetoptions[$wpgmza_cmd][$dataset_id]->polydata = $poly_data_raw_array;

                                    if (isset($dataset_second_options[$wpgmza_cmd][$dataset_id]['heatmap_gradient'])) { $datasetoptions[$wpgmza_cmd][$dataset_id]->gradient = stripslashes(html_entity_decode($dataset_second_options[$wpgmza_cmd][$dataset_id]['heatmap_gradient'])); } else { $datasetoptions[$wpgmza_cmd][$dataset_id]->gradient = ""; }
                                   	if (isset($dataset_second_options[$wpgmza_cmd][$dataset_id]['heatmap_radius'])) { $datasetoptions[$wpgmza_cmd][$dataset_id]->radius = $dataset_second_options[$wpgmza_cmd][$dataset_id]['heatmap_radius']; } else { $datasetoptions[$wpgmza_cmd][$dataset_id]->radius = 20; }
                                    if (isset($dataset_second_options[$wpgmza_cmd][$dataset_id]['heatmap_opacity'])) { $datasetoptions[$wpgmza_cmd][$dataset_id]->opacity = $dataset_second_options[$wpgmza_cmd][$dataset_id]['heatmap_opacity']; } else { $datasetoptions[$wpgmza_cmd][$dataset_id]->opacity = 0.6; }
	                                }
	                            }
                        	}
                         }
                        } else {
                             $total_poly_array = wpgmza_b_return_dataset_id_array($wpgmza_cmd);

                            if ($total_poly_array > 0) {
                                foreach ($total_poly_array as $dataset_id) {
                                    $datasetoptions[$wpgmza_cmd][$dataset_id] = wpgmza_b_return_dataset_options($dataset_id);
                                    $dataset_second_options[$wpgmza_cmd][$dataset_id] = maybe_unserialize($datasetoptions[$wpgmza_cmd][$dataset_id]->options);

                                    $tmp_poly_array = wpgmza_b_return_dataset_array($dataset_id);
                                    $poly_data_raw_array = array();
                                    foreach ($tmp_poly_array as $single_poly) {
                                        $poly_data_raw = str_replace(" ","",$single_poly);
                                        $poly_data_raw = explode(",",$poly_data_raw);
                                        $lat = $poly_data_raw[0];
                                        $lng = $poly_data_raw[1];
                                        $poly_data_raw_array[] = $poly_data_raw;
                                    }
                                    $datasetoptions[$wpgmza_cmd][$dataset_id]->polydata = $poly_data_raw_array;

                                    if (isset($dataset_second_options[$wpgmza_cmd][$dataset_id]['heatmap_gradient'])) { $datasetoptions[$wpgmza_cmd][$dataset_id]->gradient = stripslashes(html_entity_decode($dataset_second_options[$wpgmza_cmd][$dataset_id]['heatmap_gradient'])); } else { $datasetoptions[$wpgmza_cmd][$dataset_id]->gradient = ""; }
                                   	if (isset($dataset_second_options[$wpgmza_cmd][$dataset_id]['heatmap_radius'])) { $datasetoptions[$wpgmza_cmd][$dataset_id]->radius = $dataset_second_options[$wpgmza_cmd][$dataset_id]['heatmap_radius']; } else { $datasetoptions[$wpgmza_cmd][$dataset_id]->radius = 20; }
                                    if (isset($dataset_second_options[$wpgmza_cmd][$dataset_id]['heatmap_opacity'])) { $datasetoptions[$wpgmza_cmd][$dataset_id]->opacity = $dataset_second_options[$wpgmza_cmd][$dataset_id]['heatmap_opacity']; } else { $datasetoptions[$wpgmza_cmd][$dataset_id]->opacity = 0.6; }
                                }
                            }  else { $datasetoptions = array(); }     
                        }
                }


	            
                foreach ($wpgmza_short_code_array as $wpgmza_cmd) {
                    if ($wpgmza_current_mashup) {
                         foreach ($wpgmza_mashup_ids as $wpgmza_tmp_plg_array) {
                         	foreach ($wpgmza_tmp_plg_array as $wpgmza_tmp_plg) {
	                            $total_poly_array = wpgmza_b_return_polygon_id_array($wpgmza_tmp_plg);
	                            if ($total_poly_array > 0) {
	                                foreach ($total_poly_array as $poly_id) {
	                                    $polygonoptions[$wpgmza_cmd][$poly_id] = wpgmza_b_return_poly_options($poly_id);

	                                    $tmp_poly_array = wpgmza_b_return_polygon_array($poly_id);
	                                    $poly_data_raw_array = array();
	                                    foreach ($tmp_poly_array as $single_poly) {
	                                        $poly_data_raw = str_replace(" ","",$single_poly);
	                                        $poly_data_raw = explode(",",$poly_data_raw);
	                                        if (isset($poly_data_raw[0]) && isset($poly_data_raw[1])) {
		                                        $lat = $poly_data_raw[0];
		                                        $lng = $poly_data_raw[1];
		                                        $poly_data_raw_array[] = $poly_data_raw;
		                                    }
	                                    }
	                                    $polygonoptions[$wpgmza_cmd][$poly_id]->polydata = $poly_data_raw_array;

	                                    $linecolor = $polygonoptions[$wpgmza_cmd][$poly_id]->linecolor;
	                                    $fillcolor = $polygonoptions[$wpgmza_cmd][$poly_id]->fillcolor;
	                                    $fillopacity = $polygonoptions[$wpgmza_cmd][$poly_id]->opacity;
	                                    if (!$linecolor) { $polygonoptions[$wpgmza_cmd][$poly_id]->linecolor = "000000"; }
	                                    if (!$fillcolor) { $polygonoptions[$wpgmza_cmd][$poly_id]->fillcolor = "66FF00"; }
	                                    if (!$fillopacity) { $polygonoptions[$wpgmza_cmd][$poly_id]->opacity = "0.5"; }
	                                }
	                            }
                        	}
                         }
                        } else {
                             $total_poly_array = wpgmza_b_return_polygon_id_array($wpgmza_cmd);

                            if ($total_poly_array > 0) {
                                foreach ($total_poly_array as $poly_id) {
                                    $polygonoptions[$wpgmza_cmd][$poly_id] = wpgmza_b_return_poly_options($poly_id);

                                    $tmp_poly_array = wpgmza_b_return_polygon_array($poly_id);
                                    $poly_data_raw_array = array();
                                    foreach ($tmp_poly_array as $single_poly) {
                                        $poly_data_raw = str_replace(" ","",$single_poly);
                                        $poly_data_raw = explode(",",$poly_data_raw);
                                        if (isset($poly_data_raw[0]) && isset($poly_data_raw[1])) {
	                                        $lat = $poly_data_raw[0];
	                                        $lng = $poly_data_raw[1];
	                                        $poly_data_raw_array[] = $poly_data_raw;
	                                    }
                                    }
                                    $polygonoptions[$wpgmza_cmd][$poly_id]->polydata = $poly_data_raw_array;

                                    $linecolor = $polygonoptions[$wpgmza_cmd][$poly_id]->linecolor;
                                    $fillcolor = $polygonoptions[$wpgmza_cmd][$poly_id]->fillcolor;
                                    $fillopacity = $polygonoptions[$wpgmza_cmd][$poly_id]->opacity;
                                    if (!$linecolor) { $polygonoptions[$wpgmza_cmd][$poly_id]->linecolor = "000000"; }
                                    if (!$fillcolor) { $polygonoptions[$wpgmza_cmd][$poly_id]->fillcolor = "66FF00"; }
                                    if (!$fillopacity) { $polygonoptions[$wpgmza_cmd][$poly_id]->opacity = "0.5"; }
                                }
                            }  else { $polygonoptions = array(); }     
                        }
                }


                
                foreach ($wpgmza_short_code_array as $wpgmza_cmd) {
                    if ($wpgmza_current_mashup) {
                         foreach ($wpgmza_mashup_ids as $wpgmza_tmp_plg_array) {
                         	foreach ($wpgmza_tmp_plg_array as $wpgmza_tmp_plg) {

		                        $total_poly_array = wpgmza_b_return_polyline_id_array($wpgmza_tmp_plg);
		                        if ($total_poly_array > 0) {
		                            foreach ($total_poly_array as $poly_id) {
		                                $polylineoptions[$wpgmza_cmd][$poly_id] = wpgmza_b_return_polyline_options($poly_id);

		                                $tmp_poly_array = wpgmza_b_return_polyline_array($poly_id);
		                                $poly_data_raw_array = array();
		                                foreach ($tmp_poly_array as $single_poly) {
		                                    $poly_data_raw = str_replace(" ","",$single_poly);
		                                    $poly_data_raw = str_replace(")","",$poly_data_raw );
		                                    $poly_data_raw = str_replace("(","",$poly_data_raw );
		                                    $poly_data_raw = explode(",",$poly_data_raw);
	                                        if (isset($poly_data_raw[0]) && isset($poly_data_raw[1])) {
	                                       	    $lat = $poly_data_raw[0];
			                                    $lng = $poly_data_raw[1];
			                                    $poly_data_raw_array[] = $poly_data_raw;
			                                }
		                                }
		                                $polylineoptions[$wpgmza_cmd][$poly_id]->polydata = $poly_data_raw_array;


		                                if (isset($polylineoptions[$wpgmza_cmd][$poly_id]->linecolor)) { $linecolor = $polylineoptions[$wpgmza_cmd][$poly_id]->linecolor; } else { $linecolor = false; } 
		                                if (isset($polylineoptions[$wpgmza_cmd][$poly_id]->fillcolor)) { $fillcolor = $polylineoptions[$wpgmza_cmd][$poly_id]->fillcolor; } else { $fillcolor = false; } 
		                                if (isset($polylineoptions[$wpgmza_cmd][$poly_id]->opacity)) { $fillopacity = $polylineoptions[$wpgmza_cmd][$poly_id]->opacity; } else { $fillopacity = false; } 
		                                if (!$linecolor) { $polylineoptions[$wpgmza_cmd][$poly_id]->linecolor = "000000"; }
		                                if (!$fillcolor) { $polylineoptions[$wpgmza_cmd][$poly_id]->fillcolor = "66FF00"; }
		                                if (!$fillopacity) { $polylineoptions[$wpgmza_cmd][$poly_id]->opacity = "0.5"; }
		                            }
		                        } 
		                    }
                         }
                        } else {
                            $total_poly_array = wpgmza_b_return_polyline_id_array($wpgmza_cmd);
                            if ($total_poly_array > 0) {
                                foreach ($total_poly_array as $poly_id) {
                                    $polylineoptions[$wpgmza_cmd][$poly_id] = wpgmza_b_return_polyline_options($poly_id);

                                    $tmp_poly_array = wpgmza_b_return_polyline_array($poly_id);
                                    $poly_data_raw_array = array();
                                    foreach ($tmp_poly_array as $single_poly) {
                                        $poly_data_raw = str_replace(" ","",$single_poly);
                                        $poly_data_raw = str_replace(")","",$poly_data_raw );
                                        $poly_data_raw = str_replace("(","",$poly_data_raw );
                                        $poly_data_raw = explode(",",$poly_data_raw);
                                        if (isset($poly_data_raw[0]) && isset($poly_data_raw[1])) {
	                                        $lat = $poly_data_raw[0];
	                                        $lng = $poly_data_raw[1];
	                                        $poly_data_raw_array[] = $poly_data_raw;
	                                    }
                                    }
                                    $polylineoptions[$wpgmza_cmd][$poly_id]->polydata = $poly_data_raw_array;

 
                                    if (isset($polylineoptions[$wpgmza_cmd][$poly_id]->linecolor)) { $linecolor = $polylineoptions[$wpgmza_cmd][$poly_id]->linecolor; } else { $linecolor = false; }
                                    if (isset($polylineoptions[$wpgmza_cmd][$poly_id]->fillcolor)) { $fillcolor = $polylineoptions[$wpgmza_cmd][$poly_id]->fillcolor; } else { $fillcolor = false; }
                                    if (isset($polylineoptions[$wpgmza_cmd][$poly_id]->opacity)) { $fillopacity = $polylineoptions[$wpgmza_cmd][$poly_id]->opacity; } else { $fillopacity = false; }
                                    if (!$linecolor) { $polylineoptions[$wpgmza_cmd][$poly_id]->linecolor = "000000"; }
                                    if (!$fillcolor) { $polylineoptions[$wpgmza_cmd][$poly_id]->fillcolor = "66FF00"; }
                                    if (!$fillopacity) { $polylineoptions[$wpgmza_cmd][$poly_id]->opacity = "0.5"; }
                                }
                            } else { $polylineoptions = array(); }       
                        }
                }
            }
            
            wp_localize_script( 'wpgmaps_core', 'wpgmaps_localize_polygon_settings', $polygonoptions);
            wp_localize_script( 'wpgmaps_core', 'wpgmaps_localize_polyline_settings', $polylineoptions);
            wp_localize_script( 'wpgmaps_core', 'wpgmaps_localize_heatmap_settings', $datasetoptions);

            if (isset($wpgmza_settings['wpgmza_force_greedy_gestures']) && $wpgmza_settings['wpgmza_force_greedy_gestures'] == "yes") {
			    wp_localize_script( 'wpgmaps_core', 'wpgmza_force_greedy_gestures', "greedy");
			}

            if (isset($wpgmza_settings['wpgmza_api_version'])) { $api_version = $wpgmza_settings['wpgmza_api_version']; } else { $api_version = ""; }
            if (isset($api_version) && $api_version != "") {
                $api_version_string = "v=$api_version&";
            } else {
                $api_version_string = "v=3.exp&";
            }
            
             if (isset($wpgmza_settings['wpgmza_settings_marker_pull'])) { $marker_pull = $wpgmza_settings['wpgmza_settings_marker_pull']; } else { $marker_pull = "1"; }



        	/* moved the old call of Google Maps API from here */



            global $wpgmza_version;
            if (floatval($wpgmza_version) < 6 || $wpgmza_version == "6.0.4" || $wpgmza_version == "6.0.3" || $wpgmza_version == "6.0.2" || $wpgmza_version == "6.0.1" || $wpgmza_version == "6.0.0") {
                if (is_multisite()) { 
                    global $blog_id;
                    $wurl = wpgmaps_get_plugin_url()."/".$blog_id."-";
                }
                else {
                    $wurl = wpgmaps_get_plugin_url()."/";
                }
            } else {
                /* later versions store marker files in wp-content/uploads/wp-google-maps director */
              
                
                
                
                if (function_exists("wpgmza_return_marker_url")) {
                    if (get_option("wpgmza_xml_url") == "") {
                        add_option("wpgmza_xml_url",'{uploads_dir}/wp-google-maps/');
                    }
                    $xml_marker_url = wpgmza_return_marker_url();
                } else {
                    if (get_option("wpgmza_xml_url") == "") {
                        $upload_dir = wp_upload_dir();
                        add_option("wpgmza_xml_url",$upload_dir['baseurl'].'/wp-google-maps/');
                    }
                    $xml_marker_url = get_option("wpgmza_xml_url");
                }

                if (is_multisite()) { 
                    global $blog_id;
                    $wurl = $xml_marker_url.$blog_id."-";
                }
                else {
                    $wurl = $xml_marker_url;
                }
            }
            wp_localize_script( 'wpgmaps_core', 'wpgmaps_markerurl', $wurl);

            
            
            if (isset($wpgmza_settings['wpgmza_settings_infowindow_link_text'])) { $wpgmza_settings_infowindow_link_text = $wpgmza_settings['wpgmza_settings_infowindow_link_text']; } else { $wpgmza_settings_infowindow_link_text = false; }
            if (!$wpgmza_settings_infowindow_link_text) { $wpgmza_settings_infowindow_link_text = __("More details","wp-google-maps"); }
            

            wp_localize_script( 'wpgmaps_core', 'wpgmaps_lang_more_details', $wpgmza_settings_infowindow_link_text);
            wp_localize_script( 'wpgmaps_core', 'wpgmaps_lang_get_dir', apply_filters( "wpgmza_filter_change_get_directions_string", __( "Get directions", "wp-google-maps" ) ) );
            wp_localize_script( 'wpgmaps_core', 'wpgmaps_lang_my_location', apply_filters( "wpgmza_filter_change_my_location_string", __( "My location", "wp-google-maps" ) ) );
            wp_localize_script( 'wpgmaps_core', 'wpgmaps_lang_km_away', apply_filters( "wpgmza_filter_change_km_away_string", __( "km away", "wp-google-maps" ) ) );
            wp_localize_script( 'wpgmaps_core', 'wpgmaps_lang_m_away', apply_filters( "wpgmza_filter_change_miles_away_string", __( "miles away", "wp-google-maps" ) ) );
            wp_localize_script( 'wpgmaps_core', 'wpgmaps_lang_directions', apply_filters( "wpgmza_filter_change_directions_string", __( "Directions", "wp-google-maps" ) ) );
            wp_localize_script( 'wpgmaps_core', 'wpgmaps_lang_more_info', $wpgmza_settings_infowindow_link_text );
            wp_localize_script( 'wpgmaps_core', 'wpgmaps_lang_error1', __("Please fill out both the \"from\" and \"to\" fields","wp-google-maps") );
            wp_localize_script( 'wpgmaps_core', 'wpgmaps_lang_getting_location', __('Getting your current location address...','wp-google-maps') );
           


            wp_localize_script( 'wpgmaps_core', 'wpgm_dt_sLengthMenu', __('Show _MENU_ entries','wp-google-maps') );
            wp_localize_script( 'wpgmaps_core', 'wpgm_dt_sZeroRecords', __('Nothing found - sorry','wp-google-maps') );
            wp_localize_script( 'wpgmaps_core', 'wpgm_dt_sInfo', __('Showing _START_ to _END_ of _TOTAL_ records','wp-google-maps') );
            wp_localize_script( 'wpgmaps_core', 'wpgm_dt_sInfoEmpty', __('Showing 0 to 0 of 0 records','wp-google-maps') );
            wp_localize_script( 'wpgmaps_core', 'wpgm_dt_sInfoFiltered', __('(filtered from _MAX_ total records)','wp-google-maps') );
            wp_localize_script( 'wpgmaps_core', 'wpgm_dt_sFirst', __('First','wp-google-maps') );
            wp_localize_script( 'wpgmaps_core', 'wpgm_dt_sLast', __('Last','wp-google-maps') );
            wp_localize_script( 'wpgmaps_core', 'wpgm_dt_sNext', __('Next','wp-google-maps') );
            wp_localize_script( 'wpgmaps_core', 'wpgm_dt_sPrevious', __('Previous','wp-google-maps') );
            wp_localize_script( 'wpgmaps_core', 'wpgm_dt_sSearch', __('Search','wp-google-maps') );
            wp_localize_script( 'wpgmaps_core', 'ajaxurl', admin_url( 'admin-ajax.php' ) );

        	if (function_exists("wpgmaps_ugm_activate")) {
	            /* VGM variables */
	            wp_localize_script( 'wpgmaps_core', 'vgm_human_error_string', __("Please prove that you are human by checking the checkbox above","wp-google-maps") );
	            $ajax_nonce_ugm = wp_create_nonce("wpgmza_ugm");
	            wp_localize_script( 'wpgmaps_core', 'wpgmaps_nonce', $ajax_nonce_ugm );
	        }

        	$ajax_nonce_pro = wp_create_nonce("wpgmza_pro_ugm");
			wp_localize_script( 'wpgmaps_core', 'wpgmaps_pro_nonce', $ajax_nonce_pro );
			wp_localize_script( 'wpgmaps_core', 'wpgmaps_plugurl', wpgmaps_get_plugin_url() );
			wp_localize_script( 'wpgmaps_core', 'marker_pull', $marker_pull );
            if (function_exists("wpgmaps_gold_activate")) { 
            	wp_localize_script( 'wpgmaps_core', 'wpgm_g_e', '1' );
            } else {
            	wp_localize_script( 'wpgmaps_core', 'wpgm_g_e', '0' );
            }


        }
    }

}


function wpgmza_return_marker_count($map_id) {
    global $wpdb;
    global $wpgmza_tblname;
    
    $wpgmza_sql1 = "
        SELECT COUNT(`id`) as `total_markers`
        FROM $wpgmza_tblname
        WHERE `map_id` = '$map_id'
        ";

    $results = $wpdb->get_row($wpgmza_sql1);
    return intval($results->total_markers);
}



function wpgmaps_admin_javascript_pro() {
    global $wpdb;
    global $wpgmza_tblname_maps;
    $ajax_nonce = wp_create_nonce("wpgmza");


    if( isset( $_POST['wpgmza_save_google_api_key_list'] ) ){  
        if( $_POST['wpgmza_google_maps_api_key'] !== '' ){      
            update_option('wpgmza_google_maps_api_key', sanitize_text_field($_POST['wpgmza_google_maps_api_key']) );
            echo "<div class='updated'><p>";
            $settings_page = "<a href='".admin_url('/admin.php?page=wp-google-maps-menu-settings#tabs-4')."'>".__('settings', 'wp-google-maps')."</a>";
            echo sprintf( __('Your Google Maps API key has been successfully saved. This API key can be changed in the %s page', 'wp-google-maps'), $settings_page );
            echo "</p></div>";
        }          
    }



    if (is_admin() && isset($_GET['page']) && isset($_GET['action']) && $_GET['page'] == 'wp-google-maps-menu' && $_GET['action'] == "edit_marker") { wpgmaps_admin_edit_marker_javascript(); }
    else if (is_admin() && isset($_GET['page']) && isset($_GET['action']) && $_GET['page'] == 'wp-google-maps-menu' && $_GET['action'] == "add_poly") { wpgmaps_b_admin_add_poly_javascript(sanitize_text_field($_GET['map_id'])); }
    else if (is_admin() && isset($_GET['page']) && isset($_GET['action']) && $_GET['page'] == 'wp-google-maps-menu' && $_GET['action'] == "edit_poly") { wpgmaps_b_admin_edit_poly_javascript(sanitize_text_field($_GET['map_id']),sanitize_text_field($_GET['poly_id'])); }
    else if (is_admin() && isset($_GET['page']) && isset($_GET['action']) && $_GET['page'] == 'wp-google-maps-menu' && $_GET['action'] == "add_polyline") { wpgmaps_b_admin_add_polyline_javascript(sanitize_text_field($_GET['map_id'])); }
    else if (is_admin() && isset($_GET['page']) && isset($_GET['action']) && $_GET['page'] == 'wp-google-maps-menu' && $_GET['action'] == "edit_polyline") { wpgmaps_b_admin_edit_polyline_javascript(sanitize_text_field($_GET['map_id']),sanitize_text_field($_GET['poly_id'])); }
    else if (is_admin() && isset($_GET['page']) && isset($_GET['action']) && $_GET['page'] == 'wp-google-maps-menu' && $_GET['action'] == "add_heatmap") { wpgmaps_b_admin_add_heatmap_javascript(sanitize_text_field($_GET['map_id']),sanitize_text_field($_GET['map_id'])); }
    else if (is_admin() && isset($_GET['page']) && isset($_GET['action']) && $_GET['page'] == 'wp-google-maps-menu' && $_GET['action'] == "edit_heatmap") { wpgmaps_b_admin_edit_heatmap_javascript(sanitize_text_field($_GET['map_id']),sanitize_text_field($_GET['id'])); }
    else if (is_admin() && isset($_GET['page']) && isset($_GET['action']) && $_GET['page'] == 'wp-google-maps-menu' && $_GET['action'] == "edit") {
        wpgmaps_update_xml_file($_GET['map_id']);
        $res = wpgmza_get_map_data($_GET['map_id']);
        $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");

        $wpgmza_lat = $res->map_start_lat;
        $wpgmza_lng = $res->map_start_lng;
        $wpgmza_width = $res->map_width;
        $wpgmza_height = $res->map_height;
        $wpgmza_width_type = stripslashes($res->map_width_type);
        $wpgmza_height_type = $res->map_height_type;
        $wpgmza_map_type = $res->type;
        $wpgmza_default_icon = $res->default_marker;
        $kml = $res->kml;
        $fusion = $res->fusion;
        $wpgmza_traffic = $res->traffic;
        $wpgmza_bicycle = $res->bicycle;
        $wpgmza_dbox = $res->dbox;
        $wpgmza_dbox_width = $res->dbox_width;

        
        $map_other_settings = maybe_unserialize($res->other_settings);
        if (isset($map_other_settings['weather_layer'])) { $weather_layer = $map_other_settings['weather_layer']; } else { $weather_layer = ""; }
        if (isset($map_other_settings['weather_layer_temp_type'])) { $weather_layer_temp_type = $map_other_settings['weather_layer_temp_type']; } else { $weather_layer_temp_type = 0; }
        if (isset($map_other_settings['cloud_layer'])) { $cloud_layer = $map_other_settings['cloud_layer']; } else { $cloud_layer = ""; }
        if (isset($map_other_settings['transport_layer'])) { $transport_layer = $map_other_settings['transport_layer']; } else { $transport_layer = ""; }
        if (isset($map_other_settings['map_max_zoom'])) { $wpgmza_max_zoom = intval($map_other_settings['map_max_zoom']); } else { $wpgmza_max_zoom = 0; }
        if (isset($map_other_settings['map_min_zoom'])) { $wpgmza_min_zoom = intval($map_other_settings['map_min_zoom']); } else { $wpgmza_min_zoom = 21; }
        if (isset($map_other_settings['wpgmza_theme_data'])) { $wpgmza_theme_data = $map_other_settings['wpgmza_theme_data']; } else { $wpgmza_theme_data = false; }

        if (isset($wpgmza_settings['wpgmza_settings_map_open_marker_by'])) { $wpgmza_open_infowindow_by = $wpgmza_settings['wpgmza_settings_map_open_marker_by']; } else { $wpgmza_open_infowindow_by = false; }
        if ($wpgmza_open_infowindow_by == null || !isset($wpgmza_open_infowindow_by)) { $wpgmza_open_infowindow_by = '1'; }

        if ($wpgmza_default_icon == "0") { $wpgmza_default_icon = ""; }
        if (!$wpgmza_map_type || $wpgmza_map_type == "" || $wpgmza_map_type == "1") { $wpgmza_map_type = "ROADMAP"; }
        else if ($wpgmza_map_type == "2") { $wpgmza_map_type = "SATELLITE"; }
        else if ($wpgmza_map_type == "3") { $wpgmza_map_type = "HYBRID"; }
        else if ($wpgmza_map_type == "4") { $wpgmza_map_type = "TERRAIN"; }
        else { $wpgmza_map_type = "ROADMAP"; }

        $start_zoom = $res->map_start_zoom;
        if ($start_zoom < 1 || !$start_zoom) {
            $start_zoom = 5;
        }
        if (!$wpgmza_lat || !$wpgmza_lng) {
            $wpgmza_lat = "51.5081290";
            $wpgmza_lng = "-0.1280050";
        }
        
        
        // marker sorting functionality
        if ($res->order_markers_by == 1) { $order_by = 0; }
        else if ($res->order_markers_by == 2) { $order_by = 2; }
        else if ($res->order_markers_by == 3) { $order_by = 4; }
        else if ($res->order_markers_by == 4) { $order_by = 5; }
        else if ($res->order_markers_by == 5) { $order_by = 3; }
        else { $order_by = 0; }
        if ($res->order_markers_choice == 1) { $order_choice = "asc"; }
        else { $order_choice = "desc"; }
        if (isset($wpgmza_settings['wpgmza_api_version'])) { $api_version = $wpgmza_settings['wpgmza_api_version']; } 
        if (isset($api_version) && $api_version != "") {
            $api_version_string = "v=$api_version&";
        } else {
            $api_version_string = "v=3.exp&";
        }
        
        if (isset($wpgmza_settings['wpgmza_settings_marker_pull'])) { $marker_pull = $wpgmza_settings['wpgmza_settings_marker_pull']; } else { $marker_pull = "1"; }
        if (isset($marker_pull) && $marker_pull == "0") {
            if (!defined('PHP_VERSION_ID')) {
                $phpversion = explode('.', PHP_VERSION);
                define('PHP_VERSION_ID', ($phpversion[0] * 10000 + $phpversion[1] * 100 + $phpversion[2]));
            }
            if (PHP_VERSION_ID < 50300) {
                $markers = json_encode(wpgmaps_return_markers_pro($_GET['map_id']));
            } else {
                $markers = json_encode(wpgmaps_return_markers_pro($_GET['map_id']),JSON_HEX_APOS);    
            }
        }
    ?>
    <?php 

	$wpgmza_locale = get_locale();
	$wpgmza_suffix = ".com";
	/* Hebrew correction */
	if ($wpgmza_locale == "he_IL") { $wpgmza_locale = "iw"; }

	/* Chinese integration */
	if ($wpgmza_locale == "zh_CN") { $wpgmza_suffix = ".cn"; } else { $wpgmza_suffix = ".com"; } 

	$wpgmza_locale = substr( $wpgmza_locale, 0, 2 );

    if( get_option( 'wpgmza_google_maps_api_key' ) ){ ?>
        <script type="text/javascript">
            var gmapsJsHost = (("https:" == document.location.protocol) ? "https://" : "http://");
            var wpgmza_api_key = '<?php echo get_option( 'wpgmza_google_maps_api_key' ); ?>';
            document.write(unescape("%3Cscript src='" + gmapsJsHost + "maps.google<?php echo $wpgmza_suffix; ?>/maps/api/js?<?php echo $api_version_string; ?>key="+wpgmza_api_key+"&language=<?php echo $wpgmza_locale; ?>&libraries=places,visualization' type='text/javascript'%3E%3C/script%3E"));
        </script>
    <?php } else { ?>
        <script type="text/javascript">
            var gmapsJsHost = (("https:" == document.location.protocol) ? "https://" : "http://");
            document.write(unescape("%3Cscript src='" + gmapsJsHost + "maps.google<?php echo $wpgmza_suffix; ?>/maps/api/js?<?php echo $api_version_string; ?>language=<?php echo $wpgmza_locale; ?>&libraries=places,visualization' type='text/javascript'%3E%3C/script%3E"));
        </script>
    <?php } ?>	 	
   <!-- <link rel="stylesheet" href="//code.jquery.com/ui/1.8.24/themes/smoothness/jquery-ui.css" /> -->
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo wpgmaps_get_plugin_url(); ?>/css/data_table.css" />
    <script type="text/javascript" src="<?php echo wpgmaps_get_plugin_url(); ?>/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" >
    var heatmap = [];
    var WPGM_PathLine = [];
	var WPGM_Path = [];
	var WPGM_PathLineData = [];
	var WPGM_PathData = [];

    var marker_pull = '<?php echo $marker_pull; ?>';
    <?php if (isset($markers) && strlen($markers) > 0 && $markers != "[]"){ ?>var db_marker_array = JSON.stringify(<?php echo $markers; ?>);<?php } else { echo "var db_marker_array = '';"; } ?>

    jQuery(function() {
    	var placeSearch, autocomplete, wpgmza_def_i;

        
        function fillInAddress() {
          // Get the place details from the autocomplete object.
          var place = autocomplete.getPlace();	
        }	

        
        var wpgmza_table_length;


                jQuery(document).ready(function(){
                	var wpgmzaTable;
                	wpgmza_def_i = jQuery("#wpgmza_cmm").html();


                    

                     if (typeof document.getElementById('wpgmza_add_address') !== "undefined") {
	                    /* initialize the autocomplete form */
	                    autocomplete = new google.maps.places.Autocomplete(
	                      /** @type {HTMLInputElement} */(document.getElementById('wpgmza_add_address')),
	                      { types: ['geocode'] });
	                    // When the user selects an address from the dropdown,
	                    // populate the address fields in the form.
	                    google.maps.event.addListener(autocomplete, 'place_changed', function() {
	                    fillInAddress();
	                    });
                	}
                    
                    jQuery("#wpgmaps_show_advanced").click(function() {
                      jQuery("#wpgmaps_advanced_options").show();
                      jQuery("#wpgmaps_show_advanced").hide();
                      jQuery("#wpgmaps_hide_advanced").show();

                    });
                    jQuery("#wpgmaps_hide_advanced").click(function() {
                      jQuery("#wpgmaps_advanced_options").hide();
                      jQuery("#wpgmaps_show_advanced").show();
                      jQuery("#wpgmaps_hide_advanced").hide();

                    });



                    wpgmzaTable = jQuery('#wpgmza_table').DataTable({
                        "bProcessing": true,
                        "aaSorting": [[ <?php echo "$order_by";?>, "<?php echo $order_choice; ?>" ]]
                    });
                    function wpgmza_reinitialisetbl() {
                        if (wpgmza_table_length === "") { wpgmza_table_length = 10; }
                        var wpgmzaTable = jQuery('#wpgmza_table').DataTable({
                            "bProcessing": true,
                            "aaSorting": [[ <?php echo "$order_by";?>, "<?php echo $order_choice; ?>" ]],
                            "iDisplayLength": wpgmza_table_length
                        });
                    }
                    function wpgmza_InitMap() {
                        var myLatLng = new google.maps.LatLng(<?php echo $wpgmza_lat; ?>,<?php echo $wpgmza_lng; ?>);
                        MYMAP.init('#wpgmza_map', myLatLng, <?php echo $start_zoom; ?>);
                        UniqueCode=Math.round(Math.random()*10000);
                        MYMAP.placeMarkers('<?php echo wpgmaps_get_marker_url($_GET['map_id']); ?>?u='+UniqueCode,<?php echo $_GET['map_id']; ?>);
                    }

                    jQuery("#wpgmza_map").css({
                        height:'<?php echo $wpgmza_height; ?><?php echo $wpgmza_height_type; ?>',
                        width:'<?php echo $wpgmza_width; ?><?php echo $wpgmza_width_type; ?>'

                    });
                    
                    
                    jQuery("#sl_line_color").focusout(function() {
                        poly.setOptions({ strokeColor: "#"+jQuery("#poly_line").val() }); 
                    });
                    jQuery("#sl_fill_color").keyup(function() {
                        poly.setOptions({ strokeOpacity: jQuery("#poly_opacity").val() }); 
                    });
                    jQuery("#sl_opacity").keyup(function() {
                        poly.setOptions({ strokeWeight: jQuery("#poly_thickness").val() }); 
                    });
                    
                    var geocoder = new google.maps.Geocoder();
                    wpgmza_InitMap();


                    jQuery("select[name=wpgmza_table_length]").change(function () {
                    	wpgmza_table_length = jQuery(this).val();
                    })
                    jQuery("body").on("click", ".wpgmza_del_btn", function() {
                    	
                        var cur_id = jQuery(this).attr("id");

                      

                            
                    
                        var wpgm_map_id = "0";
                        if (document.getElementsByName("wpgmza_id").length > 0) { wpgm_map_id = jQuery("#wpgmza_id").val(); }
                        var data = {
                                action: 'delete_marker',
                                security: '<?php echo $ajax_nonce; ?>',
                                map_id: wpgm_map_id,
                                marker_id: cur_id
                        };
                        
                        jQuery.post(ajaxurl, data, function(response) {
                                returned_data = JSON.parse(response);
                                db_marker_array = JSON.stringify(returned_data.marker_data);
                                wpgmza_InitMap();

	                    		jQuery("#wpgmza_marker_holder").html(JSON.parse(response).table_html);
	                            wpgmza_reinitialisetbl();
                                
                        });

                    });
                    jQuery("body").on("click", ".wpgmza_approve_btn", function() {
                        var cur_id = jQuery(this).attr("id");
                        var wpgm_map_id = "0";
                        if (document.getElementsByName("wpgmza_id").length > 0) { wpgm_map_id = jQuery("#wpgmza_id").val(); }
                        var data = {
                                action: 'approve_marker',
                                security: '<?php echo $ajax_nonce; ?>',
                                map_id: wpgm_map_id,
                                marker_id: cur_id
                        };
                        jQuery.post(ajaxurl, data, function(response) {
                                returned_data = JSON.parse(response);
                                db_marker_array = JSON.stringify(returned_data.marker_data);
                                wpgmza_InitMap();
                                jQuery("#wpgmza_marker_holder").html(JSON.parse(response).table_html);
                                wpgmza_reinitialisetbl();

                        });

                    });
                    jQuery("body").on("click", ".wpgmza_poly_del_btn", function() {
                        var cur_id = parseInt(jQuery(this).attr("id"));
                        var wpgm_map_id = "0";
                        if (document.getElementsByName("wpgmza_id").length > 0) { wpgm_map_id = jQuery("#wpgmza_id").val(); }
                        var data = {
                                action: 'delete_poly',
                                security: '<?php echo $ajax_nonce; ?>',
                                map_id: wpgm_map_id,
                                poly_id: cur_id
                        };
                        jQuery.post(ajaxurl, data, function(response) {
                                
                                	
                                WPGM_Path[cur_id].setMap(null);
                                delete WPGM_PathData[cur_id];
                                delete WPGM_Path[cur_id];
                                /*wpgmza_InitMap();*/
                                jQuery("#wpgmza_poly_holder").html(response);
                                /*window.location.reload();*/
                        });

                    });
                    jQuery("body").on("click", ".wpgmza_polyline_del_btn", function() {
                        var cur_id = jQuery(this).attr("id");
                        var wpgm_map_id = "0";
                        if (document.getElementsByName("wpgmza_id").length > 0) { wpgm_map_id = jQuery("#wpgmza_id").val(); }
                        var data = {
                                action: 'delete_polyline',
                                security: '<?php echo $ajax_nonce; ?>',
                                map_id: wpgm_map_id,
                                poly_id: cur_id
                        };
                        jQuery.post(ajaxurl, data, function(response) {
                                WPGM_PathLine[cur_id].setMap(null);
                                delete WPGM_PathLineData[cur_id];
                                delete WPGM_PathLine[cur_id];
                                /*wpgmza_InitMap();*/
                                jQuery("#wpgmza_polyline_holder").html(response);
                                /*window.location.reload();*/
                        });

                    });
                    jQuery("body").on("click", ".wpgmza_dataset_del_btn", function() {
                        var cur_id = jQuery(this).attr("id");
                        var wpgm_map_id = "0";
                        if (document.getElementsByName("wpgmza_id").length > 0) { wpgm_map_id = jQuery("#wpgmza_id").val(); }
                        var data = {
                                action: 'delete_dataset',
                                security: '<?php echo $ajax_nonce; ?>',
                                map_id: wpgm_map_id,
                                poly_id: cur_id
                        };
                        jQuery.post(ajaxurl, data, function(response) {
                                heatmap[cur_id].setMap(null);
                                delete heatmap[cur_id];
                                /*wpgmza_InitMap();*/
                                jQuery("#wpgmza_heatmap_holder").html(response);
                                /*window.location.reload();*/
                        });

                    });

                    var wpgmza_edit_address = ""; /* set this here so we can use it in the edit marker function below */
                    var wpgmza_edit_lat = ""; 
                    var wpgmza_edit_lng = ""; 

                    jQuery("body").on("click", ".wpgmza_edit_btn", function() {
                        var cur_id = jQuery(this).attr("id");

                        var wpgmza_edit_title = jQuery("#wpgmza_hid_marker_title_"+cur_id).val();
                        wpgmza_edit_address = jQuery("#wpgmza_hid_marker_address_"+cur_id).val();
                        wpgmza_edit_lat = jQuery("#wpgmza_hid_marker_lat_"+cur_id).val();
                        wpgmza_edit_lng = jQuery("#wpgmza_hid_marker_lng_"+cur_id).val();
                        
                        
                        var wpgmza_edit_desc = jQuery("#wpgmza_hid_marker_desc_"+cur_id).val();
                        var wpgmza_edit_pic = jQuery("#wpgmza_hid_marker_pic_"+cur_id).val();
                        var wpgmza_edit_link = jQuery("#wpgmza_hid_marker_link_"+cur_id).val();
                        var wpgmza_edit_icon = jQuery("#wpgmza_hid_marker_icon_"+cur_id).val();
                        var wpgmza_edit_anim = jQuery("#wpgmza_hid_marker_anim_"+cur_id).val();
                        var wpgmza_edit_category = jQuery("#wpgmza_hid_marker_category_"+cur_id).val();
                        var wpgmza_edit_retina = jQuery("#wpgmza_hid_marker_retina_"+cur_id).val();
                        var wpgmza_edit_approved = jQuery("#wpgmza_hid_marker_approved_"+cur_id).val();
                        var wpgmza_edit_infoopen = jQuery("#wpgmza_hid_marker_infoopen_"+cur_id).val();
                        jQuery("#wpgmza_edit_id").val(cur_id);
                        jQuery("#wpgmza_add_title").val(wpgmza_edit_title);
                        jQuery("#wpgmza_add_address").val(wpgmza_edit_address);

                        if (jQuery("#wp-wpgmza_add_desc-wrap").hasClass("tmce-active")){
                        	var tinymce_editor_id = 'wpgmza_add_desc'; 
							tinyMCE.get(tinymce_editor_id).setContent(wpgmza_edit_desc);
					    }else{
	                        jQuery("#wpgmza_add_desc").val(wpgmza_edit_desc);
					    }

                        jQuery("#wpgmza_add_pic").val(wpgmza_edit_pic);
                        jQuery("#wpgmza_link_url").val(wpgmza_edit_link);
                        jQuery("#wpgmza_animation").val(wpgmza_edit_anim);
                        
                        jQuery('input[name=wpgmza_add_retina]').removeAttr('checked');
                        if (wpgmza_edit_retina === 0 || wpgmza_edit_retina === "0") { } else {
                            jQuery("#wpgmza_add_retina").prop('checked', true);
                        }

                        var cat_array = wpgmza_edit_category.split(",");
                        jQuery('input[name=wpgmza_cat_checkbox]').removeAttr('checked');
                        cat_array.forEach(function(entry) {
                            if (entry === 0) { } else {
                                jQuery("#wpgmza_cat_checkbox_"+entry).prop('checked', true);
                            }
                        });
                        
                        jQuery("#wpgmza_infoopen").val(wpgmza_edit_infoopen);
                        jQuery("#wpgmza_approved").val(wpgmza_edit_approved);
                        jQuery("#wpgmza_add_custom_marker").val(wpgmza_edit_icon);
                        if (wpgmza_edit_icon != "")
                          jQuery("#wpgmza_cmm").html("<img src='"+wpgmza_edit_icon+"' />");
                        else
                          jQuery("#wpgmza_cmm").html(wpgmza_def_i); 
                        jQuery("#wpgmza_addmarker_div").hide();
                        jQuery("#wpgmza_editmarker_div").show();


                    });

                    

                    jQuery("#wpgmza_addmarker").click(function(){
                        jQuery("#wpgmza_addmarker").hide();
                        jQuery("#wpgmza_addmarker_loading").show();



                        var wpgm_title = "";
                        var wpgm_address = "0";
                        var wpgm_desc = "0";
                        var wpgm_pic = "0";
                        var wpgm_link = "0";
                        var wpgm_icon = "0";
                        var wpgm_approved = "0";
                        var wpgm_gps = "0";

                        var wpgm_anim = "0";
                        var wpgm_category = "0";
                        var wpgm_retina = "0";
                        var wpgm_infoopen = "0";
                        var wpgm_map_id = "0";
                        var wpgmza_add_custom_marker_on_click = '';
                        if (document.getElementsByName("wpgmza_add_title").length > 0) { wpgm_title = jQuery("#wpgmza_add_title").val(); }
                        if (document.getElementsByName("wpgmza_add_address").length > 0) { wpgm_address = jQuery("#wpgmza_add_address").val(); }

                        if (jQuery("#wp-wpgmza_add_desc-wrap").hasClass("tmce-active")){
                        	var tinymce_editor_id = 'wpgmza_add_desc'; 
							wpgm_desc = tinyMCE.get(tinymce_editor_id).getContent();
					    }else{
					        if (document.getElementsByName("wpgmza_add_desc").length > 0) { wpgm_desc = jQuery("#wpgmza_add_desc").val(); }
					    }

                        					    
                        if (document.getElementsByName("wpgmza_add_pic").length > 0) { wpgm_pic = jQuery("#wpgmza_add_pic").val(); }
                        if (document.getElementsByName("wpgmza_link_url").length > 0) { wpgm_link = jQuery("#wpgmza_link_url").val(); }
                        if (document.getElementsByName("wpgmza_add_custom_marker").length > 0) { wpgm_icon = jQuery("#wpgmza_add_custom_marker").val(); }
                        if (document.getElementsByName("wpgmza_add_custom_marker_on_click").length > 0) { wpgmza_add_custom_marker_on_click = jQuery("#wpgmza_add_custom_marker_on_click").val(); }
                        if (document.getElementsByName("wpgmza_animation").length > 0) { wpgm_anim = jQuery("#wpgmza_animation").val(); }
                        
                        var Checked = jQuery('input[name="wpgmza_add_retina"]:checked').length > 0;
                        if (Checked) { wpgm_retina = "1"; } else { wpgm_retina = "0"; }

                        if (document.getElementsByName("wpgmza_category").length > 0) { wpgm_category = jQuery("#wpgmza_category").val(); }
                        
                    
                        var checkValues = jQuery('input[name=wpgmza_cat_checkbox]:checked').map(function() {
                            return jQuery(this).val();
                        }).get();
                        if (checkValues.length > 0) { wpgm_category = checkValues; }
                        wpgm_category.toString();
                        
                        
                        if (document.getElementsByName("wpgmza_infoopen").length > 0) { wpgm_infoopen = jQuery("#wpgmza_infoopen").val(); }
                        if (document.getElementsByName("wpgmza_approved").length > 0) { wpgm_approved = jQuery("#wpgmza_approved").val(); }
                        if (document.getElementsByName("wpgmza_id").length > 0) { wpgm_map_id = jQuery("#wpgmza_id").val(); }
                        /* first check if user has added a GPS co-ordinate */
                        checker = wpgm_address.split(",");
                        var wpgm_lat = "";
                        var wpgm_lng = "";
                        wpgm_lat = checker[0];
                        wpgm_lng = checker[1];
                        checker1 = parseFloat(checker[0]);
                        checker2 = parseFloat(checker[1]);
                        if (typeof wpgm_lat !== "undefined" && typeof wpgm_lng !== "undefined" && (wpgm_lat.match(/[a-zA-Z]/g) === null && wpgm_lng.match(/[a-zA-Z]/g) === null) && checker.length === 2 && (checker1 != NaN && (checker1 <= 90 || checker1 >= -90)) && (checker2 != NaN && (checker2 <= 90 || checker2 >= -90))) {
                            var data = {
                                action: 'add_marker',
                                security: '<?php echo $ajax_nonce; ?>',
                                map_id: wpgm_map_id,
                                title: wpgm_title,
                                address: wpgm_address,
                                desc: wpgm_desc,
                                link: wpgm_link,
                                icon: wpgm_icon,
                                icon_on_click: wpgmza_add_custom_marker_on_click,
                                retina: wpgm_retina,
                                pic: wpgm_pic,
                                anim: wpgm_anim,
                                category: wpgm_category,
                                infoopen: wpgm_infoopen,
                                approved: wpgm_approved,
                                lat: wpgm_lat,
                                lng: wpgm_lng

                            };


                            jQuery.post(ajaxurl, data, function(response) {
                                    returned_data = JSON.parse(response);
                                    
                                    db_marker_array = JSON.stringify(returned_data.marker_data);
                                    wpgmza_InitMap();

                                    jQuery("#wpgmza_marker_holder").html(JSON.parse(response).table_html);
                                    
                                    jQuery("#wpgmza_addmarker").show();
                                    jQuery("#wpgmza_addmarker_loading").hide();
                                    jQuery("#wpgmza_add_title").val("");
                                    jQuery("#wpgmza_add_address").val("");
			                        if (jQuery("#wp-wpgmza_add_desc-wrap").hasClass("tmce-active")){
			                        	var tinymce_editor_id = 'wpgmza_add_desc'; 
										tinyMCE.get(tinymce_editor_id).setContent('');
								    }else{
	                                    jQuery("#wpgmza_add_desc").val("");
								    }
                                    jQuery("#wpgmza_add_pic").val("");
                                    jQuery("#wpgmza_link_url").val("");
                                    jQuery("#wpgmza_animation").val("0");
                                    jQuery("#wpgmza_approved").val("1");
                                    jQuery("#wpgmza_add_retina").attr('checked',false);
                                    jQuery("#wpgmza_edit_id").val("");
                                    jQuery("#wpgmza_cmm").html(wpgmza_def_i);
                                    jQuery("#wpgmza_cmm_custom").html(wpgmza_def_i);
                                    jQuery("#wpgmza_add_custom_marker").val("");
	                                jQuery("#wpgmza_add_custom_marker_on_click").val("");
                                    jQuery('input[name=wpgmza_cat_checkbox]').attr('checked',false);

                                    marker_data_point = new google.maps.LatLng(wpgm_lat,wpgm_lng);
                                    MYMAP.map.setCenter(marker_data_point);

                                    wpgmza_reinitialisetbl();

                                	if( jQuery("#wpgmaps_marker_cache_reminder").length > 0 ){

				                        jQuery("#wpgmaps_marker_cache_reminder").fadeIn();

				                    }
                            });
                            
                            
                        } else { 
                            geocoder.geocode( { 'address': wpgm_address}, function(results, status) {
                                if (status == google.maps.GeocoderStatus.OK) {
                                    wpgm_gps = String(results[0].geometry.location);
                                    var latlng1 = wpgm_gps.replace("(","");
                                    var latlng2 = latlng1.replace(")","");
                                    var latlngStr = latlng2.split(",",2);
                                    var wpgm_lat = parseFloat(latlngStr[0]);
                                    var wpgm_lng = parseFloat(latlngStr[1]);

                                    var data = {
                                        action: 'add_marker',
                                        security: '<?php echo $ajax_nonce; ?>',
                                        map_id: wpgm_map_id,
                                        title: wpgm_title,
                                        address: wpgm_address,
                                        desc: wpgm_desc,
                                        link: wpgm_link,
                                        icon: wpgm_icon,
                                        icon_on_click: wpgmza_add_custom_marker_on_click,
                                        retina: wpgm_retina,
                                        pic: wpgm_pic,
                                        anim: wpgm_anim,
                                        category: wpgm_category,
                                        infoopen: wpgm_infoopen,
                                		approved: wpgm_approved,
                                        lat: wpgm_lat,
                                        lng: wpgm_lng
                                    };


                                    jQuery.post(ajaxurl, data, function(response) {
                                            returned_data = JSON.parse(response);
                                            db_marker_array = JSON.stringify(returned_data.marker_data);
                                            wpgmza_InitMap();


                                            jQuery("#wpgmza_marker_holder").html(JSON.parse(response).table_html);
                                            jQuery("#wpgmza_addmarker").show();
                                            jQuery("#wpgmza_addmarker_loading").hide();

                                            jQuery("#wpgmza_add_title").val("");
                                            jQuery("#wpgmza_add_address").val("");
					                        if (jQuery("#wp-wpgmza_add_desc-wrap").hasClass("tmce-active")){
					                        	var tinymce_editor_id = 'wpgmza_add_desc'; 
												tinyMCE.get(tinymce_editor_id).setContent('');
										    }else{
			                                    jQuery("#wpgmza_add_desc").val("");
										    }
                                            jQuery("#wpgmza_add_pic").val("");
                                            jQuery("#wpgmza_link_url").val("");
                                            jQuery("#wpgmza_animation").val("0");
		                                    jQuery("#wpgmza_approved").val("1");
                                            jQuery("#wpgmza_add_retina").attr('checked',false);
		                                    jQuery("#wpgmza_cmm").html(wpgmza_def_i);
		                                    jQuery("#wpgmza_cmm_custom").html(wpgmza_def_i);
		                                    jQuery("#wpgmza_add_custom_marker").val("");
			                                jQuery("#wpgmza_add_custom_marker_on_click").val("");
                                            jQuery("#wpgmza_edit_id").val("");
                                            jQuery('input[name=wpgmza_cat_checkbox]').attr('checked',false);
		                                    
		                                    marker_data_point = new google.maps.LatLng(wpgm_lat,wpgm_lng);
		                                    MYMAP.map.setCenter(marker_data_point);

                                            wpgmza_reinitialisetbl();

                                            if( jQuery("#wpgmaps_marker_cache_reminder").length > 0 ){

						                        jQuery("#wpgmaps_marker_cache_reminder").fadeIn();

						                    }
                                    });

                                } else {
                                    alert("<?php _e("Geocode was not successful for the following reason","wp-google-maps"); ?>: " + status);
                                    jQuery("#wpgmza_addmarker").show();
                        			jQuery("#wpgmza_addmarker_loading").hide();
                                }
                            });
                        }


                    });
                    jQuery("#wpgmza_editmarker").click(function(){

                        jQuery("#wpgmza_editmarker_div").hide();
                        jQuery("#wpgmza_editmarker_loading").show();


                        var wpgm_edit_id;
                        wpgm_edit_id = parseInt(jQuery("#wpgmza_edit_id").val());
                        var wpgm_title = "";
                        var wpgm_address = "0";
                        var wpgm_desc = "0";
                        var wpgm_pic = "0";
                        var wpgm_link = "0";
                        var wpgm_anim = "0";
                        var wpgm_category = "0";
                        var wpgm_infoopen = "0";
                        var wpgm_approved = "0";
                        var wpgm_icon = "";
                        var wpgm_retina = "0";
                        var wpgm_map_id = "0";
                        var wpgm_gps = "0";
                        var wpgmza_add_custom_marker_on_click = "";

                        if (document.getElementsByName("wpgmza_add_title").length > 0) { wpgm_title = jQuery("#wpgmza_add_title").val(); }
                        if (document.getElementsByName("wpgmza_add_address").length > 0) { wpgm_address = jQuery("#wpgmza_add_address").val(); }

                        if (jQuery("#wp-wpgmza_add_desc-wrap").hasClass("tmce-active")){
                        	var tinymce_editor_id = 'wpgmza_add_desc'; 
							wpgm_desc = tinyMCE.get(tinymce_editor_id).getContent();
					    }else{
					        if (document.getElementsByName("wpgmza_add_desc").length > 0) { wpgm_desc = jQuery("#wpgmza_add_desc").val(); }
					    }


                        if (document.getElementsByName("wpgmza_add_pic").length > 0) { wpgm_pic = jQuery("#wpgmza_add_pic").val(); }
                        if (document.getElementsByName("wpgmza_link_url").length > 0) { wpgm_link = jQuery("#wpgmza_link_url").val(); }
                        if (document.getElementsByName("wpgmza_animation").length > 0) { wpgm_anim = jQuery("#wpgmza_animation").val(); }
                        if (document.getElementsByName("wpgmza_category").length > 0) { wpgm_category = jQuery("#wpgmza_category").val(); }
                        var Checked = jQuery('input[name="wpgmza_add_retina"]:checked').length > 0;
                        if (Checked) { wpgm_retina = "1"; } else { wpgm_retina = "0"; }
                        
                        
                        var checkValues = jQuery('input[name=wpgmza_cat_checkbox]:checked').map(function() {
                            return jQuery(this).val();
                        }).get();
                        if (checkValues.length > 0) { wpgm_category = checkValues; }
                        wpgm_category.toString();
                        if (document.getElementsByName("wpgmza_infoopen").length > 0) { wpgm_infoopen = jQuery("#wpgmza_infoopen").val(); }
                        if (document.getElementsByName("wpgmza_approved").length > 0) { wpgm_approved = jQuery("#wpgmza_approved").val(); }
                        if (document.getElementsByName("wpgmza_add_custom_marker").length > 0) { wpgm_icon = jQuery("#wpgmza_add_custom_marker").val(); }
                        if (document.getElementsByName("wpgmza_add_custom_marker_on_click").length > 0) { wpgmza_add_custom_marker_on_click = jQuery("#wpgmza_add_custom_marker_on_click").val(); } else { wpgmza_add_custom_marker_on_click = ''; }
                        if (document.getElementsByName("wpgmza_id").length > 0) { wpgm_map_id = jQuery("#wpgmza_id").val(); }



                        var do_geocode;
                        if (wpgm_address === wpgmza_edit_address) {
                            do_geocode = false;
                            var wpgm_lat = wpgmza_edit_lat;
                            var wpgm_lng = wpgmza_edit_lng;
                        } else { 
                            do_geocode = true;
                        }

                        if (do_geocode === true) {


	                        geocoder.geocode( { 'address': wpgm_address}, function(results, status) {
	                            if (status == google.maps.GeocoderStatus.OK) {
	                                wpgm_gps = String(results[0].geometry.location);
	                                var latlng1 = wpgm_gps.replace("(","");
	                                var latlng2 = latlng1.replace(")","");
	                                var latlngStr = latlng2.split(",",2);
	                                var wpgm_lat = parseFloat(latlngStr[0]);
	                                var wpgm_lng = parseFloat(latlngStr[1]);

	                                var data = {
	                                        action: 'edit_marker',
	                                        security: '<?php echo $ajax_nonce; ?>',
	                                        map_id: wpgm_map_id,
	                                        edit_id: wpgm_edit_id,
	                                        title: wpgm_title,
	                                        address: wpgm_address,
	                                        lat: wpgm_lat,
	                                        lng: wpgm_lng,
	                                        icon: wpgm_icon,
	                                        icon_on_click: wpgmza_add_custom_marker_on_click,
	                                        retina: wpgm_retina,
	                                        desc: wpgm_desc,
	                                        link: wpgm_link,
	                                        pic: wpgm_pic,
	                                        approved: wpgm_approved,
	                                        anim: wpgm_anim,
	                                        category: wpgm_category,
	                                        infoopen: wpgm_infoopen
	                                };

	                                jQuery.post(ajaxurl, data, function(response) {
	                                    returned_data = JSON.parse(response);
	                                    db_marker_array = JSON.stringify(returned_data.marker_data);
	                                    wpgmza_InitMap();
	                                    jQuery("#wpgmza_marker_holder").html(JSON.parse(response).table_html);
	                                    jQuery("#wpgmza_addmarker_div").show();
	                                    jQuery("#wpgmza_editmarker_loading").hide();
	                                    jQuery("#wpgmza_add_title").val("");
	                                    jQuery("#wpgmza_add_address").val("");
				                        if (jQuery("#wp-wpgmza_add_desc-wrap").hasClass("tmce-active")){
				                        	var tinymce_editor_id = 'wpgmza_add_desc'; 
											tinyMCE.get(tinymce_editor_id).setContent('');
									    }else{
		                                    jQuery("#wpgmza_add_desc").val("");
									    }
	                                    jQuery("#wpgmza_add_pic").val("");
	                                    jQuery("#wpgmza_cmm").html(wpgmza_def_i);
	                                    jQuery("#wpgmza_cmm_custom").html(wpgmza_def_i);
	                                    jQuery("#wpgmza_add_custom_marker").val("");
		                                jQuery("#wpgmza_add_custom_marker_on_click").val("");
	                                    jQuery("#wpgmza_link_url").val("");
	                                    jQuery("#wpgmza_edit_id").val("");
	                                    jQuery("#wpgmza_add_retina").attr('checked',false);
	                                    jQuery("#wpgmza_animation").val("0");
	                                    jQuery("#wpgmza_approved").val("1");
	                                    jQuery('input[name=wpgmza_cat_checkbox]').attr('checked',false);
	                                    wpgmza_reinitialisetbl();

	                                    if( jQuery("#wpgmaps_marker_cache_reminder").length > 0 ){

					                        jQuery("#wpgmaps_marker_cache_reminder").fadeIn();

					                    }
	                                });

	                            } else {
	                                alert("<?php _e("Geocode was not successful for the following reason","wp-google-maps"); ?>: " + status);
		                            jQuery("#wpgmza_addmarker").show();
		                			jQuery("#wpgmza_addmarker_loading").hide();
	                            }
	                        });
                        } else {
                            /* address was the same, no need for geocoding */
                            var data = {
                                action: 'edit_marker',
                                security: '<?php echo $ajax_nonce; ?>',
                                map_id: wpgm_map_id,
                                edit_id: wpgm_edit_id,
                                title: wpgm_title,
                                address: wpgm_address,
                                lat: wpgm_lat,
                                lng: wpgm_lng,
                                icon: wpgm_icon,
                                icon_on_click: wpgmza_add_custom_marker_on_click,
                                retina: wpgm_retina,
                                desc: wpgm_desc,
                                link: wpgm_link,
                                approved: wpgm_approved,
                                pic: wpgm_pic,
                                anim: wpgm_anim,
                                category: wpgm_category,
                                infoopen: wpgm_infoopen
                            };

                            jQuery.post(ajaxurl, data, function(response) {
                                returned_data = JSON.parse(response);
                                db_marker_array = JSON.stringify(returned_data.marker_data);
                                wpgmza_InitMap();
                                jQuery("#wpgmza_marker_holder").html(JSON.parse(response).table_html);
                                jQuery("#wpgmza_addmarker_div").show();
                                jQuery("#wpgmza_editmarker_loading").hide();
                                jQuery("#wpgmza_add_title").val("");
                                jQuery("#wpgmza_add_address").val("");
			                        if (jQuery("#wp-wpgmza_add_desc-wrap").hasClass("tmce-active")){
			                        	var tinymce_editor_id = 'wpgmza_add_desc'; 
										tinyMCE.get(tinymce_editor_id).setContent('');
								    }else{
	                                    jQuery("#wpgmza_add_desc").val("");
								    }
                                jQuery("#wpgmza_cmm").html(wpgmza_def_i);
                                jQuery("#wpgmza_cmm_custom").html(wpgmza_def_i);
                                jQuery("#wpgmza_add_custom_marker").val("");
                                jQuery("#wpgmza_add_custom_marker_on_click").val("");
                                jQuery("#wpgmza_add_pic").val("");
                                jQuery("#wpgmza_link_url").val("");
                                jQuery("#wpgmza_add_retina").attr('checked',false);
                                jQuery("#wpgmza_edit_id").val("");
                                jQuery("#wpgmza_animation").val("0");
                                jQuery("#wpgmza_approved").val("1");
                                jQuery("#wpgmza_category").val("Select");
                                jQuery('input[name=wpgmza_cat_checkbox]').attr('checked',false);
                                wpgmza_reinitialisetbl();

                                if( jQuery("#wpgmaps_marker_cache_reminder").length > 0 ){

			                        jQuery("#wpgmaps_marker_cache_reminder").fadeIn();

			                    }
                            });
                        }





                    });
            });

            });



            <?php
                $total_poly_array = wpgmza_b_return_polygon_id_array(sanitize_text_field($_GET['map_id']));
                if ($total_poly_array > 0) {
                foreach ($total_poly_array as $poly_id) {
                    $polyoptions = wpgmza_b_return_poly_options($poly_id);
                    $linecolor = $polyoptions->linecolor;
                    $lineopacity = $polyoptions->lineopacity;
                    $fillcolor = $polyoptions->fillcolor;
                    $fillopacity = $polyoptions->opacity;
                    if (!$linecolor) { $linecolor = "000000"; }
                    if (!$fillcolor) { $fillcolor = "66FF00"; }
                    if ($fillopacity == "") { $fillopacity = "0.5"; }
                    if ($lineopacity == "") { $lineopacity = "1"; }
                    $linecolor = "#".$linecolor;
                    $fillcolor = "#".$fillcolor;
                    
                    $poly_array = wpgmza_b_return_polygon_array($poly_id);
                    
                        
            ?> 

            <?php if (sizeof($poly_array) > 1) { ?>

            WPGM_PathData[<?php echo $poly_id; ?>] = [
                <?php
                        foreach ($poly_array as $single_poly) {
                            $poly_data_raw = str_replace(" ","",$single_poly);
                            $poly_data_raw = explode(",",$poly_data_raw);
                            $lat = $poly_data_raw[0];
                            $lng = $poly_data_raw[1];
                            ?>
                            new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>),            
                            <?php
                        }
                ?>
                
               
            ];
            WPGM_Path[<?php echo $poly_id; ?>] = new google.maps.Polygon({
              path: WPGM_PathData[<?php echo $poly_id; ?>],
              strokeColor: "<?php echo $linecolor; ?>",
              strokeOpacity: "<?php echo $lineopacity; ?>",
              fillOpacity: "<?php echo $fillopacity; ?>",
              fillColor: "<?php echo $fillcolor; ?>",
              strokeWeight: 2
            });

            
            <?php } } ?>

            <?php } ?>


           
			<?php
                
                    $total_polyline_array = wpgmza_b_return_polyline_id_array(sanitize_text_field($_GET['map_id']));
                    if ($total_polyline_array > 0) {
                    foreach ($total_polyline_array as $poly_id) {
                        $polyoptions = wpgmza_b_return_polyline_options($poly_id);
                        $linecolor = $polyoptions->linecolor;
                        $fillopacity = $polyoptions->opacity;
                        $linethickness = $polyoptions->linethickness;
                        if (!$linecolor) { $linecolor = "000000"; }
                        if (!$linethickness) { $linethickness = "4"; }
                        if (!$fillopacity) { $fillopacity = "0.5"; }
                        $linecolor = "#".$linecolor;
                        $poly_array = wpgmza_b_return_polyline_array($poly_id);
                        ?>
                    
                <?php if (sizeof($poly_array) > 1) { ?>
                    WPGM_PathLineData[<?php echo $poly_id; ?>] = [
                    <?php
                    $poly_array = wpgmza_b_return_polyline_array($poly_id);

                    foreach ($poly_array as $single_poly) {
                        $poly_data_raw = str_replace(" ","",$single_poly);
                        $poly_data_raw = str_replace(")","",$poly_data_raw );
                        $poly_data_raw = str_replace("(","",$poly_data_raw );
                        $poly_data_raw = explode(",",$poly_data_raw);
                        $lat = $poly_data_raw[0];
                        $lng = $poly_data_raw[1];
                        ?>
                        new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>),            
                        <?php
                    }
                    ?>
                ];
                WPGM_PathLine[<?php echo $poly_id; ?>] = new google.maps.Polyline({
                  path: WPGM_PathLineData[<?php echo $poly_id; ?>],
                  strokeColor: "<?php echo $linecolor; ?>",
                  strokeOpacity: "<?php echo $fillopacity; ?>",
                  strokeWeight: "<?php echo $linethickness; ?>"
                  
                });

                
                <?php } } } ?> 

           <?php
            $total_dataset_array = wpgmza_b_return_dataset_id_array(sanitize_text_field($_GET['map_id']));
            if ($total_dataset_array > 0) {
            foreach ($total_dataset_array as $poly_id) {
                $polyoptions = wpgmza_b_return_dataset_options($poly_id);
                $dataset_options = maybe_unserialize($polyoptions->options);
                
                $poly_array = wpgmza_b_return_dataset_array($poly_id);                    

                	if (isset($dataset_options['heatmap_opacity'])) { $opacity = floatval($dataset_options['heatmap_opacity']); } else { $opacity = floatval(0.6); }
                    if (isset($dataset_options['heatmap_gradient'])) { $gradient = stripslashes(html_entity_decode($dataset_options['heatmap_gradient'])); } else { $gradient = false; }
                    if (isset($dataset_options['heatmap_radius'])) { $radius = intval($dataset_options['heatmap_radius']); } else { $radius = intval(20); }



					if (sizeof($poly_array) >= 1) { ?>
	                    WPGM_PathLineData[<?php echo $poly_id; ?>] = [
	                    <?php
	                    $poly_array = wpgmza_b_return_dataset_array($poly_id);

	                    foreach ($poly_array as $single_poly) {
	                        $poly_data_raw = str_replace(" ","",$single_poly);
	                        $poly_data_raw = explode(",",$poly_data_raw);
	                        $lat = floatval($poly_data_raw[0]);
	                        $lng = floatval($poly_data_raw[1]);
	                        ?>
                new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>),            
	                        <?php
	                    }
	                    ?>
	                ];
              	heatmap[<?php echo $poly_id; ?>] = new google.maps.visualization.HeatmapLayer({
              		data: WPGM_PathLineData[<?php echo $poly_id; ?>],
              	});              	


            <?php  } } ?>

            <?php } ?>

            var MYMAP = {
                map: null,
                bounds: null,
                mc: null
            }
            MYMAP.init = function(selector, latLng, zoom) {
              var myOptions = {
                zoom:zoom,
                minZoom: <?php echo $wpgmza_max_zoom; ?>,
                maxZoom: 21,
                center: latLng,
                scrollwheel: <?php if (isset($wpgmza_settings['wpgmza_settings_map_scroll']) && $wpgmza_settings['wpgmza_settings_map_scroll'] == "yes") { echo "false"; } else { echo "true"; } ?>,
                zoomControl: <?php if (isset($wpgmza_settings['wpgmza_settings_map_zoom']) && $wpgmza_settings['wpgmza_settings_map_zoom'] == "yes") { echo "false"; } else { echo "true"; } ?>,
                panControl: <?php if (isset($wpgmza_settings['wpgmza_settings_map_pan']) && $wpgmza_settings['wpgmza_settings_map_pan'] == "yes") { echo "false"; } else { echo "true"; } ?>,
                mapTypeControl: <?php if (isset($wpgmza_settings['wpgmza_settings_map_type']) && $wpgmza_settings['wpgmza_settings_map_type'] == "yes") { echo "false"; } else { echo "true"; } ?>,
                streetViewControl: <?php if (isset($wpgmza_settings['wpgmza_settings_map_streetview']) && $wpgmza_settings['wpgmza_settings_map_streetview'] == "yes") { echo "false"; } else { echo "true"; } ?>,
                fullscreenControl: <?php if (isset($wpgmza_settings['wpgmza_settings_map_full_screen_control']) && $wpgmza_settings['wpgmza_settings_map_full_screen_control'] == "yes") { echo "false"; } else { echo "true"; } ?>,
                mapTypeId: google.maps.MapTypeId.<?php echo $wpgmza_map_type; ?>
              }
            this.map = new google.maps.Map(jQuery(selector)[0], myOptions);
            this.bounds = new google.maps.LatLngBounds();
            <?php if ($wpgmza_theme_data !== false && isset($wpgmza_theme_data) && $wpgmza_theme_data != "") { ?>
            this.map.setOptions({styles: <?php echo stripslashes($wpgmza_theme_data); ?>});
            <?php } ?>

            google.maps.event.addListener(MYMAP.map, 'zoom_changed', function() {
                zoomLevel = MYMAP.map.getZoom();
                jQuery("#wpgmza_start_zoom").val(zoomLevel);
            });
            
            
            google.maps.event.addListener(MYMAP.map, 'rightclick', function(event) {
                var marker = new google.maps.Marker({
                    position: event.latLng, 
                    map: MYMAP.map
                });
                marker.setDraggable(true);
                google.maps.event.addListener(marker, 'dragend', function(event) { 
                    jQuery("#wpgmza_add_address").val(event.latLng.lat()+','+event.latLng.lng());
                } );

                google.maps.event.addListener(marker, 'click', function() {
                    marker.setMap(null);

                });
                jQuery("#wpgmza_add_address").val(event.latLng.lat()+', '+event.latLng.lng());
                jQuery("#wpgm_notice_message_save_marker").show();
                setTimeout(function() {
                    jQuery("#wpgm_notice_message_save_marker").fadeOut('slow')
                }, 3000);
               
            });



            <?php
            $total_dataset_array = wpgmza_b_return_dataset_id_array(sanitize_text_field($_GET['map_id']));
            if ($total_dataset_array > 0) {
            foreach ($total_dataset_array as $poly_id) {
            	$polyoptions = wpgmza_b_return_dataset_options($poly_id);
            	$dataset_options = maybe_unserialize($polyoptions->options);
            	if (isset($dataset_options['heatmap_opacity'])) { $opacity = floatval($dataset_options['heatmap_opacity']); } else { $opacity = floatval(0.6); }
                if (isset($dataset_options['heatmap_gradient'])) { $gradient = stripslashes(html_entity_decode($dataset_options['heatmap_gradient'])); } else { $gradient = false; }
                if (isset($dataset_options['heatmap_radius'])) { $radius = intval($dataset_options['heatmap_radius']); } else { $radius = intval(20); }
                ?>
				if (typeof heatmap !== "undefined" && typeof heatmap[<?php echo $poly_id; ?>] !== "undefined") { 

	            	heatmap[<?php echo $poly_id; ?>].setMap(this.map);
	            	heatmap[<?php echo $poly_id; ?>].set('opacity', <?php echo $opacity; ?>);
	            	<?php if ($gradient) { ?> heatmap[<?php echo $poly_id; ?>].set('gradient', <?php echo $gradient; ?>); <?php } ?>
	            	heatmap[<?php echo $poly_id; ?>].set('radius', <?php echo $radius; ?>);
            	}

            <?php  } } ?>


            
            <?php
                $total_poly_array = wpgmza_b_return_polygon_id_array(sanitize_text_field($_GET['map_id']));
                if ($total_poly_array > 0) {
	                foreach ($total_poly_array as $poly_id) {
	                ?>
	            		if (typeof WPGM_Path !== "undefined" && typeof WPGM_Path[<?php echo $poly_id; ?>] !== "undefined") { WPGM_Path[<?php echo $poly_id; ?>].setMap(this.map); }

	            	<?php
	            	}
            	} ?>



           
			<?php
                
                $total_polyline_array = wpgmza_b_return_polyline_id_array(sanitize_text_field($_GET['map_id']));
                if ($total_polyline_array > 0) {
                	foreach ($total_polyline_array as $poly_id) {
               		?>
                		if (typeof WPGM_PathLine !== "undefined" && typeof WPGM_PathLine[<?php echo $poly_id; ?>] !== "undefined") { WPGM_PathLine[<?php echo $poly_id; ?>].setMap(this.map); }
                    <?php 
                	}
                } ?>    


            google.maps.event.addListener(MYMAP.map, 'center_changed', function() {
                var location = MYMAP.map.getCenter();
                jQuery("#wpgmza_start_location").val(location.lat()+","+location.lng());
                jQuery("#wpgmaps_save_reminder").show();
            });

            <?php if ($wpgmza_bicycle == "1") { ?>
            var bikeLayer = new google.maps.BicyclingLayer();
            bikeLayer.setMap(this.map);
            <?php } ?>
            <?php if ($wpgmza_traffic == "1") { ?>
            var trafficLayer = new google.maps.TrafficLayer();
            trafficLayer.setMap(this.map);
            <?php } ?>
            <?php if ($weather_layer == 1) { ?>
            <?php if($weather_layer_temp_type == 2) { ?>
                var weatherLayer = new google.maps.weather.WeatherLayer({ 
                    temperatureUnits: google.maps.weather.TemperatureUnit.FAHRENHEIT
                });
                weatherLayer.setMap(MYMAP.map);
            <?php } else { ?>
                var weatherLayer = new google.maps.weather.WeatherLayer({ 
                    temperatureUnits: google.maps.weather.TemperatureUnit.CELSIUS
                });
                weatherLayer.setMap(MYMAP.map);
                
            <?php } ?>
            <?php } ?>
            <?php if ($cloud_layer == 1) { ?>
            var cloudLayer = new google.maps.weather.CloudLayer();
            cloudLayer.setMap(this.map);
            <?php } ?>
            <?php if ($transport_layer == 1) { ?>
            var transitLayer = new google.maps.TransitLayer();
            transitLayer.setMap(this.map);
            <?php } ?>



            <?php if ($kml != "") { ?>
            var temp = '<?php echo $kml; ?>';
            arr = temp.split(',');
            arr.forEach(function(entry) {
                var georssLayer = new google.maps.KmlLayer(entry+'?tstamp=<?php echo time(); ?>',{preserveViewport: true});
                georssLayer.setMap(MYMAP.map);
            });
            <?php } ?>
            <?php if ($fusion != "") { ?>
                var fusionlayer = new google.maps.FusionTablesLayer('<?php echo $fusion; ?>', {
                      suppressInfoWindows: false
                });
                fusionlayer.setMap(this.map);
            <?php } ?>


            } 

            var infoWindow = new google.maps.InfoWindow();
            <?php
                $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS"); 
                if (isset($wpgmza_settings['wpgmza_settings_infowindow_width'])) { $wpgmza_settings_infowindow_width = intval($wpgmza_settings['wpgmza_settings_infowindow_width']); } else { $wpgmza_settings_infowindow_width = false; }
            
                if ($wpgmza_settings_infowindow_width) { ?>
            
            infoWindow.setOptions({maxWidth:<?php echo $wpgmza_settings_infowindow_width; ?>});
            <?php } ?>

            google.maps.event.addDomListener(window, 'resize', function() {
                var myLatLng = new google.maps.LatLng(<?php echo $wpgmza_lat; ?>,<?php echo $wpgmza_lng; ?>);
                MYMAP.map.setCenter(myLatLng);
            });


            

            MYMAP.placeMarkers = function(filename,map_id) {
                marker_array = [];
                if (marker_pull === '1') {
                        jQuery.get(filename, function(xml) {
                                jQuery(xml).find("marker").each(function(){
                                        var wpgmza_def_icon = '<?php echo $wpgmza_default_icon; ?>';
                                        var wpmgza_map_id = jQuery(this).find('map_id').text();

                                        if (wpmgza_map_id == map_id) {
                                            var wpmgza_title = jQuery(this).find('title').text();
                                            var wpmgza_show_address = jQuery(this).find('address').text();
                                            var wpmgza_address = jQuery(this).find('address').text();
                                            var wpmgza_mapicon = jQuery(this).find('icon').text();
                                            var wpmgza_image = jQuery(this).find('pic').text();
                                            var wpmgza_desc  = jQuery(this).find('desc').text();
                                            var wpmgza_anim  = jQuery(this).find('anim').text();
                                            var wpmgza_retina  = jQuery(this).find('retina').text();
                                            var wpmgza_infoopen  = jQuery(this).find('infoopen').text();
                                            var wpmgza_linkd = jQuery(this).find('linkd').text();
                                            if (wpmgza_title != "") {
                                                wpmgza_title = wpmgza_title+'<br />';
                                            }

                                            /* check image */
                                            if (wpmgza_image != "") {

                                        <?php
                                            $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");
                                            if (isset($wpgmza_settings['wpgmza_settings_infowindow_link_text'])) { $wpgmza_settings_infowindow_link_text = $wpgmza_settings['wpgmza_settings_infowindow_link_text']; } else { $wpgmza_settings_infowindow_link_text = false; }
                                            if (!$wpgmza_settings_infowindow_link_text) { $wpgmza_settings_infowindow_link_text = __("More details","wp-google-maps"); }
											
											if (isset($wpgmza_settings['wpgmza_settings_image_resizing']) && $wpgmza_settings['wpgmza_settings_image_resizing'] == 'yes') { $wpgmza_image_resizing = true; } else { $wpgmza_image_resizing = false; }
 											if (isset($wpgmza_settings['wpgmza_settings_use_timthumb'])) { $wpgmza_use_timthumb = $wpgmza_settings['wpgmza_settings_use_timthumb']; } else { $wpgmza_use_timthumb = true; }
                                            if (isset($wpgmza_settings['wpgmza_settings_image_height'])) { $wpgmza_image_height = $wpgmza_settings['wpgmza_settings_image_height']."px"; } else { $wpgmza_image_height = false; }
                                            if (isset($wpgmza_settings['wpgmza_settings_image_width'])) { $wpgmza_image_width = $wpgmza_settings['wpgmza_settings_image_width']."px"; } else { $wpgmza_image_width = false; }
                                            if (!$wpgmza_image_height || !isset($wpgmza_image_height)) { $wpgmza_image_height = "auto"; }
                                            if (!$wpgmza_image_width || !isset($wpgmza_image_width)) { $wpgmza_image_width = "auto"; }
											
											/* check if using timthumb */
											/* timthumb completely removed in 5.54 */
                                            
                                            /*if (!isset($wpgmza_use_timthumb) || $wpgmza_use_timthumb == "" || $wpgmza_use_timthumb == 1) { ?>
                                                wpmgza_image = "<img src='<?php echo wpgmaps_get_plugin_url(); ?>/timthumb.php?src="+wpmgza_image+"&h=<?php echo $wpgmza_image_height; ?>&w=<?php echo $wpgmza_image_width; ?>&zc=1' title='' alt='' style=\"float:right; width:"+<?php echo $wpgmza_image_width; ?>+"px; height:"+<?php echo $wpgmza_image_height; ?>+"px;\" />";
	                                        <?php } else { 
                                            */
                                               
	                                        	/* User has chosen not to use timthumb. excellent! */
												if ($wpgmza_image_resizing) {
	                                            	?>
	                                            	wpgmza_resize_string = "width='<?php echo $wpgmza_image_width; ?>' height='<?php echo $wpgmza_image_height; ?>'";
	                                            	<?php
	                                            } else {
													?>
	                                            	wpgmza_resize_string = "";
	                                            	<?php
	                                            }
	                                            ?>
                                        	    
	                                        	wpmgza_image = "<img src='"+wpmgza_image+"' class='wpgmza_map_image wpgmza_map_image_"+wpmgza_map_id+"' style='float:right;' "+wpgmza_resize_string+" />";




	                                        <?php /* }  */ ?>

                                            /* end check image */
                                            } else { wpmgza_image = "" }

                                            <?php
                                            if (isset($wpgmza_settings['wpgmza_settings_retina_width'])) { $wpgmza_settings_retina_width = intval($wpgmza_settings['wpgmza_settings_retina_width']); } else { $wpgmza_settings_retina_width = 31; };
                                            if (isset($wpgmza_settings['wpgmza_settings_retina_height'])) { $wpgmza_settings_retina_height = intval($wpgmza_settings['wpgmza_settings_retina_height']); } else { $wpgmza_settings_retina_height = 45; };
                                          	?>

                                            if (wpmgza_linkd != "") {
                                                    <?php
                                                        $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");
                                                        if (isset($wpgmza_settings['wpgmza_settings_infowindow_links'])) { $wpgmza_settings_infowindow_links = $wpgmza_settings['wpgmza_settings_infowindow_links']; }
                                                        if (isset($wpgmza_settings_infowindow_links) && $wpgmza_settings_infowindow_links == "yes") { $wpgmza_settings_infowindow_links = "target='_BLANK'";  } else { $wpgmza_settings_infowindow_links = ""; }
                                                    ?>

                                                    wpmgza_linkd = "<a href='"+wpmgza_linkd+"' <?php echo $wpgmza_settings_infowindow_links; ?> title='<?php echo $wpgmza_settings_infowindow_link_text; ?>'><?php echo $wpgmza_settings_infowindow_link_text; ?></a>";
                                                }
                                            if (wpmgza_mapicon == "" || !wpmgza_mapicon) { if (wpgmza_def_icon != "") { wpmgza_mapicon = '<?php echo $wpgmza_default_icon; ?>'; } }
                                            var wpgmza_optimized = true;
                                            if (wpmgza_retina === "1" && wpmgza_mapicon !== "") {
                                                wpmgza_mapicon = new google.maps.MarkerImage(wpmgza_mapicon, null, null, null, new google.maps.Size(<?php echo $wpgmza_settings_retina_width; ?>,<?php echo $wpgmza_settings_retina_height; ?>));
                                                wpgmza_optimized = false;
                                            }
                                            var lat = jQuery(this).find('lat').text();
                                            var lng = jQuery(this).find('lng').text();
                                            var point = new google.maps.LatLng(parseFloat(lat),parseFloat(lng));
                                            MYMAP.bounds.extend(point);
                                            if (wpmgza_anim == "1") {
                                            var marker = new google.maps.Marker({
                                                    position: point,
                                                    map: MYMAP.map,
                                                    icon: wpmgza_mapicon,
                                                    animation: google.maps.Animation.BOUNCE
                                            });
                                            }
                                            else if (wpmgza_anim == "2") {
                                                var marker = new google.maps.Marker({
                                                        position: point,
                                                        map: MYMAP.map,
                                                        icon: wpmgza_mapicon,
                                                        animation: google.maps.Animation.DROP
                                                });
                                            }
                                            else {
                                                var marker = new google.maps.Marker({
                                                        position: point,
                                                        map: MYMAP.map,
                                                        icon: wpmgza_mapicon
                                                });
                                            }
                                            
                                            <?php
                                                    $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");
                                                    if (isset($wpgmza_settings['wpgmza_settings_infowindow_address'])) { 
                                                        $wpgmza_settings_infowindow_address = $wpgmza_settings['wpgmza_settings_infowindow_address'];
                                                    } else { $wpgmza_settings_infowindow_address = ""; }
                                                    if ($wpgmza_settings_infowindow_address == "yes") {

                                            ?>
                                                        wpmgza_show_address = "";
                                            <?php } ?>


                                            var html='<div id="wpgmza_markerbox">'+wpmgza_image+'<p><strong>'+wpmgza_title+'</strong>'+wpmgza_show_address+'<br />'
                                                    +wpmgza_desc+
                                                    '<br />'
                                                    +wpmgza_linkd+
                                                    ''
                                                    +'</p></div>';
                                            if (wpmgza_infoopen == "1") {

                                                infoWindow.setContent(html);
                                                infoWindow.open(MYMAP.map, marker);
                                            }

                                            <?php if ($wpgmza_open_infowindow_by == '2') { ?>
                                            google.maps.event.addListener(marker, 'mouseover', function() {
                                                infoWindow.close();
                                                infoWindow.setContent(html);
                                                infoWindow.open(MYMAP.map, marker);

                                            });
                                            <?php } else { ?>
                                            google.maps.event.addListener(marker, 'click', function() {
                                                infoWindow.close();
                                                infoWindow.setContent(html);
                                                infoWindow.open(MYMAP.map, marker);

                                            });
                                            <?php } ?>


                                        }

                            });
                    });
                
                } else {
                    
                    if (db_marker_array.length > 0) {
                    var dec_marker_array = jQuery.parseJSON(db_marker_array);
                    jQuery.each(dec_marker_array, function(i, val) {


                        var wpgmza_def_icon = '<?php echo $wpgmza_default_icon; ?>';
                        var wpmgza_map_id = val.map_id;

                        if (wpmgza_map_id == map_id) {
                            if( val.title !== null ){
								var wpmgza_title = val.title.replace(/\\/g, '');
							} else {
								var wpmgza_title = val.title;
							}
                            var wpmgza_show_address = val.address;
                            var wpmgza_address = val.address;
                            var wpmgza_mapicon = val.icon;
                            var wpmgza_image = val.pic;
                            
                            if( val.desc !== null ){
								var wpmgza_desc = val.desc.replace(/\\/g, '');
							} else {
								var wpmgza_desc = val.desc;
							}
                            var wpmgza_anim  = val.anim;
                            var wpmgza_retina  = val.retina;
                            var wpmgza_infoopen  = val.infoopen;
                            var wpmgza_linkd = val.linkd;
                            if (wpmgza_title != "") {
                                wpmgza_title = wpmgza_title+'<br />';
                            }
                           /* check image */
                            if (wpmgza_image != "") {

                        <?php
                            $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");
                            if (isset($wpgmza_settings['wpgmza_settings_infowindow_link_text'])) { $wpgmza_settings_infowindow_link_text = $wpgmza_settings['wpgmza_settings_infowindow_link_text']; } else { $wpgmza_settings_infowindow_link_text = false; }
                            if (!$wpgmza_settings_infowindow_link_text) { $wpgmza_settings_infowindow_link_text = __("More details","wp-google-maps"); }
							
							if (isset($wpgmza_settings['wpgmza_settings_image_resizing']) && $wpgmza_settings['wpgmza_settings_image_resizing'] == 'yes') { $wpgmza_image_resizing = true; } else { $wpgmza_image_resizing = false; }
							if (isset($wpgmza_settings['wpgmza_settings_use_timthumb'])) { $wpgmza_use_timthumb = $wpgmza_settings['wpgmza_settings_use_timthumb']; } else { $wpgmza_use_timthumb = true; }
                            if (isset($wpgmza_settings['wpgmza_settings_image_height'])) { $wpgmza_image_height = $wpgmza_settings['wpgmza_settings_image_height']."px"; } else { $wpgmza_image_height = false; }
                            if (isset($wpgmza_settings['wpgmza_settings_image_width'])) { $wpgmza_image_width = $wpgmza_settings['wpgmza_settings_image_width']."px"; } else { $wpgmza_image_width = false; }
                            if (!$wpgmza_image_height || !isset($wpgmza_image_height)) { $wpgmza_image_height = "auto"; }
                            if (!$wpgmza_image_width || !isset($wpgmza_image_width)) { $wpgmza_image_width = "auto"; }
							
							/* check if using timthumb */
							/* timthumb completely removed in 5.54 */
                            /*if (!isset($wpgmza_use_timthumb) || $wpgmza_use_timthumb == "" || $wpgmza_use_timthumb == 1) { ?>
                                wpmgza_image = "<img src='<?php echo wpgmaps_get_plugin_url(); ?>/timthumb.php?src="+wpmgza_image+"&h=<?php echo $wpgmza_image_height; ?>&w=<?php echo $wpgmza_image_width; ?>&zc=1' title='' alt='' style=\"float:right; width:"+<?php echo $wpgmza_image_width; ?>+"px; height:"+<?php echo $wpgmza_image_height; ?>+"px;\" />";
                            <?php } else { 
                            */    
                            	/* User has chosen not to use timthumb. excellent! */
								if ($wpgmza_image_resizing) {
                                	?>
                                	wpgmza_resize_string = "width='<?php echo $wpgmza_image_width; ?>' height='<?php echo $wpgmza_image_height; ?>'";
                                	<?php
                                } else {
									?>
                                	wpgmza_resize_string = "";
                                	<?php
                                }
                                ?>
                        	    
                            	wpmgza_image = "<img src='"+wpmgza_image+"' class='wpgmza_map_image wpgmza_map_image_"+wpmgza_map_id+"' style='float:right;' "+wpgmza_resize_string+" />";




                            <?php /* } */ ?>

                            /* end check image */
                            } else { wpmgza_image = "" }

                            <?php
                            if (isset($wpgmza_settings['wpgmza_settings_retina_width'])) { $wpgmza_settings_retina_width = intval($wpgmza_settings['wpgmza_settings_retina_width']); } else { $wpgmza_settings_retina_width = 31; };
                            if (isset($wpgmza_settings['wpgmza_settings_retina_height'])) { $wpgmza_settings_retina_height = intval($wpgmza_settings['wpgmza_settings_retina_height']); } else { $wpgmza_settings_retina_height = 45; };
                          	?>
                            if (wpmgza_linkd != "") {
                                    <?php
                                        $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");
                                        if (isset($wpgmza_settings['wpgmza_settings_infowindow_links'])) { $wpgmza_settings_infowindow_links = $wpgmza_settings['wpgmza_settings_infowindow_links']; }
                                        if (isset($wpgmza_settings_infowindow_links) && $wpgmza_settings_infowindow_links == "yes") { $wpgmza_settings_infowindow_links = "target='_BLANK'";  } else { $wpgmza_settings_infowindow_links = ""; }
                                    ?>

                                    wpmgza_linkd = "<a href='"+wpmgza_linkd+"' <?php echo $wpgmza_settings_infowindow_links; ?> title='<?php echo $wpgmza_settings_infowindow_link_text; ?>'><?php echo $wpgmza_settings_infowindow_link_text; ?></a>";
                                }
                            if (wpmgza_mapicon == "" || !wpmgza_mapicon) { if (wpgmza_def_icon != "") { wpmgza_mapicon = '<?php echo $wpgmza_default_icon; ?>'; } }
                            var wpgmza_optimized = true;
                            if (wpmgza_retina === "1" && wpmgza_mapicon !== "") {
                                wpmgza_mapicon = new google.maps.MarkerImage(wpmgza_mapicon, null, null, null, new google.maps.Size(<?php echo $wpgmza_settings_retina_width; ?>,<?php echo $wpgmza_settings_retina_height; ?>));
                                wpgmza_optimized = false;
                            }
                            var lat = val.lat;
                            var lng = val.lng;
                            var point = new google.maps.LatLng(parseFloat(lat),parseFloat(lng));
                            MYMAP.bounds.extend(point);
                            if (wpmgza_anim == "1") {
                            var marker = new google.maps.Marker({
                                    position: point,
                                    map: MYMAP.map,
                                    icon: wpmgza_mapicon,
                                    animation: google.maps.Animation.BOUNCE
                            });
                            }
                            else if (wpmgza_anim == "2") {
                                var marker = new google.maps.Marker({
                                        position: point,
                                        map: MYMAP.map,
                                        icon: wpmgza_mapicon,
                                        animation: google.maps.Animation.DROP
                                });
                            }
                            else {
                                var marker = new google.maps.Marker({
                                        position: point,
                                        map: MYMAP.map,
                                        icon: wpmgza_mapicon
                                });
                            }
                            
                            <?php
                                    $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");
                                    if (isset($wpgmza_settings['wpgmza_settings_infowindow_address'])) { 
                                        $wpgmza_settings_infowindow_address = $wpgmza_settings['wpgmza_settings_infowindow_address'];
                                    } else { $wpgmza_settings_infowindow_address = ""; }
                                    if ($wpgmza_settings_infowindow_address == "yes") {

                            ?>
                                        wpmgza_show_address = "";
                            <?php } ?>

                            
                            var html='<div id="wpgmza_markerbox">'+wpmgza_image+'<p><strong>'+wpmgza_title+'</strong>'+wpmgza_show_address+'<br />'
                                    +wpmgza_desc+
                                    '<br />'
                                    +wpmgza_linkd+
                                    ''
                                    +'</p></div>';
                            if (wpmgza_infoopen == "1") {

                                infoWindow.setContent(html);
                                infoWindow.open(MYMAP.map, marker);
                            }

                            <?php if ($wpgmza_open_infowindow_by == '2') { ?>
                            google.maps.event.addListener(marker, 'mouseover', function() {
                                infoWindow.close(); 
                               infoWindow.setContent(html);
                                infoWindow.open(MYMAP.map, marker);

                            });
                            <?php } else { ?>
                            google.maps.event.addListener(marker, 'click', function() {
                                infoWindow.close();
                                infoWindow.setContent(html);
                                infoWindow.open(MYMAP.map, marker);

                            });
                            <?php } ?>


                        }






                  });
                  }
                
                
                
                
                
                
                
                }
            }

        </script>
<?php
}

}


function wpgmaps_upload_csv() {
    if (!function_exists("wpgmaps_activate")) {
        echo "<div id='message' class='updated' style='padding:10px; '><span style='font-weight:bold; color:red;'>".__("WP Google Maps","wp-google-maps").":</span> ".__("Please ensure you have <strong>both</strong> the <strong>Basic</strong> and <strong>Pro</strong> versions of WP Google Maps installed and activated at the same time in order for the plugin to function correctly.","wp-google-maps")."<br /></div>";
    }
    
    
    if (isset($_POST['wpgmza_uploadcsv_btn'])) {

    	if( isset( $_FILES['wpgmza_csvfile'] ) ){

    		$import = new WPGMapsImportExport();
    		$import->import_markers();

        } else if ( isset( $_FILES['wpgmza_csv_map_import'] ) ){

        	$import = new WPGMapsImportExport();
    		$import->import_maps();

        }  else if ( isset( $_FILES['wpgmza_csv_polygons_import'] ) ){

        	$import = new WPGMapsImportExport();
    		$import->import_polygons();

        }  else if ( isset( $_FILES['wpgmza_csv_polylines_import'] ) ){

        	$import = new WPGMapsImportExport();
    		$import->import_polylines();

        } 
    }

}

function wpgmza_cURL_response_pro($action) {
    if (function_exists('curl_version')) {
        global $wpgmza_pro_version;
        global $wpgmza_pro_string;
        $request_url = "http://www.wpgmaps.com/api/rec.php?action=$action&dom=".$_SERVER['HTTP_HOST']."&ver=".$wpgmza_pro_version.$wpgmza_pro_string;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $request_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);
        curl_close($ch);
    }

}

function wpgmza_pro_advanced_menu() {
    global $wpgmza_post_nonce;
    $wpgmza_csv_marker = "<a href=\"?page=wp-google-maps-menu-advanced&action=wpgmza_csv_export\" target=\"_BLANK\" title=\"".__("Download ALL marker data to a CSV file","wp-google-maps")."\">".__("Download ALL marker data to a CSV file","wp-google-maps")."</a>";
    $wpgmza_csv_map = "<a href=\"?page=wp-google-maps-menu-advanced&action=export_all_maps\" target=\"_BLANK\" title=\"".__("Download ALL map data to a CSV file","wp-google-maps")."\">".__("Download ALL map data to a CSV file","wp-google-maps")."</a>";
    $wpgmza_csv_polygon = "<a href=\"?page=wp-google-maps-menu-advanced&action=export_polygons\" target=\"_BLANK\" title=\"".__("Download ALL polygon data to a CSV file","wp-google-maps")."\">".__("Download ALL polygon data to a CSV file","wp-google-maps")."</a>";
    $wpgmza_csv_polyline = "<a href=\"?page=wp-google-maps-menu-advanced&action=export_polylines\" target=\"_BLANK\" title=\"".__("Download ALL polyline data to a CSV file","wp-google-maps")."\">".__("Download ALL polyline data to a CSV file","wp-google-maps")."</a>";
    echo "
        <div class=\"wrap\"><div id=\"icon-tools\" class=\"icon32 icon32-posts-post\"><br></div><h2>".__("Advanced Options","wp-google-maps")."</h2>

        <script>
          jQuery(document).ready(function(){
          	jQuery('#wpgmza_geocode').on('change', function(){
          		if(jQuery(this).attr('checked')){
          			jQuery('#wpgmza_geocode_conditional').fadeIn();
          		}else{
          			jQuery('#wpgmza_geocode_conditional').fadeOut();
          		}
          	});
          });
        </script>
        <div id=\"wpgmaps_tabs\">
            <ul>
                    <li><a href=\"#tabs-1\">".__("Map Data","wp-google-maps")."</a></li>
                    <li><a href=\"#tabs-2\">".__("Marker Data","wp-google-maps")."</a></li>
                    <li><a href=\"#tabs-3\">".__("Polygon Data","wp-google-maps")."</a></li>
                    <li><a href=\"#tabs-4\">".__("Polyline Data","wp-google-maps")."</a></li>
            </ul>
            <div id=\"tabs-1\">
            	<form enctype=\"multipart/form-data\" method=\"POST\">
	                
	                <strong style='font-size:18px'>".__("Upload Map CSV File","wp-google-maps")."</strong><br /><br />
	                
	                <input name=\"wpgmza_csv_map_import\" id=\"wpgmza_csv_map_import\" type=\"file\" style='display:none'/>
	                
	                <label for='wpgmza_csv_map_import' class='wpgmza_file_select_btn'><i class='fa fa-download'></i> Select File</label><br />
	                
	                <input name=\"wpgmza_security\" type=\"hidden\" value=\"$wpgmza_post_nonce\" /><br /><br>
	                
	                <div class='switch'><input name=\"wpgmza_csvreplace_map\" id='wpgmza_csvreplace_map' class='cmn-toggle cmn-toggle-round-flat' type=\"checkbox\" value=\"Yes\" /> <label for='wpgmza_csvreplace_map'></label></div> ".__("Replace existing data with data in file","wp-google-maps")."<br />
	                

	                <br /><input class='wpgmza_general_btn' type=\"submit\" name=\"wpgmza_uploadcsv_btn\" value=\"".__("Upload File","wp-google-maps")."\" /><br/><br/>
	                <strong style='font-size:18px'>".__("Download Map Data","wp-google-maps")."</strong><br /><br />
	                $wpgmza_csv_map
	            </form>
            </div>
            <div id=\"tabs-2\">
                <form enctype=\"multipart/form-data\" method=\"POST\">
	                <strong style='font-size:18px'>".__("Upload Marker CSV File","wp-google-maps")."</strong><br /><br />
	                <input name=\"wpgmza_csvfile\" id=\"wpgmza_csvfile\" type=\"file\" style='display:none'/>
	                <label for='wpgmza_csvfile' class='wpgmza_file_select_btn'><i class='fa fa-download'></i> Select File</label><br />
	                <input name=\"wpgmza_security\" type=\"hidden\" value=\"$wpgmza_post_nonce\" /><br /><br>
	                <div class='switch'><input name=\"wpgmza_csvreplace\" id='wpgmza_csvreplace' class='cmn-toggle cmn-toggle-round-flat' type=\"checkbox\" value=\"Yes\" /> <label for='wpgmza_csvreplace'></label></div> ".__("Replace existing data with data in file","wp-google-maps")."<br />
	                <div class='switch'><input name=\"wpgmza_geocode\" id='wpgmza_geocode' class='cmn-toggle cmn-toggle-round-flat' type=\"checkbox\" value=\"Yes\" /> <label for='wpgmza_geocode'></label></div> (Beta) ".__("Automatically geocode addresses to GPS co-ordinates if none are supplied","wp-google-maps")." <br>
	                
	                <br><div style='display:none;' id='wpgmza_geocode_conditional'><strong>".__("Google API Key (Required)","wp-google-maps").": </strong><input name=\"wpgmza_api_key\" type=\"text\" value=\"".get_option("wpgmza_geocode_api_key")."\" /> 
	                (".__("You will need a Google Maps Geocode API key for this to work. See <a href='https://developers.google.com/maps/documentation/geocoding/#Limits'>Geocoding Documentation</a>","wp-google-maps")."). <br> ".__("There is a 0.12second delay between each request","wp-google-maps")."<br /></div>

	                <br /><input class='wpgmza_general_btn' type=\"submit\" name=\"wpgmza_uploadcsv_btn\" value=\"".__("Upload File","wp-google-maps")."\" /><br/><br/>
	                <strong style='font-size:18px'>".__("Download Marker Data","wp-google-maps")."</strong><br /><br />
	                $wpgmza_csv_marker
	            </form>
            </div>
            <div id=\"tabs-3\">
            	<form enctype=\"multipart/form-data\" method=\"POST\">
	                
	                <strong style='font-size:18px'>".__("Upload Polygon CSV File","wp-google-maps")."</strong><br /><br />
	                
	                <input name=\"wpgmza_csv_polygons_import\" id=\"wpgmza_csv_polygons_import\" type=\"file\" style='display:none'/>
	                
	                <label for='wpgmza_csv_polygons_import' class='wpgmza_file_select_btn'><i class='fa fa-download'></i> Select File</label><br />
	                
	                <input name=\"wpgmza_security\" type=\"hidden\" value=\"$wpgmza_post_nonce\" /><br /><br>
	                
	                <div class='switch'><input name=\"wpgmza_csvreplace_polygon\" id='wpgmza_csvreplace_polygon' class='cmn-toggle cmn-toggle-round-flat' type=\"checkbox\" value=\"Yes\" /> <label for='wpgmza_csvreplace_polygon'></label></div> ".__("Replace existing data with data in file","wp-google-maps")."<br />
	                

	                <br /><input class='wpgmza_general_btn' type=\"submit\" name=\"wpgmza_uploadcsv_btn\" value=\"".__("Upload File","wp-google-maps")."\" /><br/><br/>
	                <strong style='font-size:18px'>".__("Download Polygon Data","wp-google-maps")."</strong><br /><br />
	                $wpgmza_csv_polygon
	            </form>
            </div>
            <div id=\"tabs-4\">
            	<form enctype=\"multipart/form-data\" method=\"POST\">
	                
	                <strong style='font-size:18px'>".__("Upload Polyline CSV File","wp-google-maps")."</strong><br /><br />
	                
	                <input name=\"wpgmza_csv_polylines_import\" id=\"wpgmza_csv_polylines_import\" type=\"file\" style='display:none'/>
	                
	                <label for='wpgmza_csv_polylines_import' class='wpgmza_file_select_btn'><i class='fa fa-download'></i> Select File</label><br />
	                
	                <input name=\"wpgmza_security\" type=\"hidden\" value=\"$wpgmza_post_nonce\" /><br /><br>
	                
	                <div class='switch'><input name=\"wpgmza_csvreplace_polyline\" id='wpgmza_csvreplace_polyline' class='cmn-toggle cmn-toggle-round-flat' type=\"checkbox\" value=\"Yes\" /> <label for='wpgmza_csvreplace_polyline'></label></div> ".__("Replace existing data with data in file","wp-google-maps")."<br />
	                

	                <br /><input class='wpgmza_general_btn' type=\"submit\" name=\"wpgmza_uploadcsv_btn\" value=\"".__("Upload File","wp-google-maps")."\" /><br/><br/>
	                <strong style='font-size:18px'>".__("Download Polyline Data","wp-google-maps")."</strong><br /><br />
	                $wpgmza_csv_polyline
	            </form>
            </div>
            <br /><br /><a href='http://www.wpgmaps.com/documentation/exporting-and-importing-your-markers/' target='_BLANK'>".__("Need help? Read the documentation.","wp-google-maps")."</a><br />
        </div>
    ";


}

function wpgmza_pro_support_menu() {
?>   
        <h1><?php _e("WP Google Maps Support","wp-google-maps"); ?></h1>
        <div class="wpgmza_row">
            <div class='wpgmza_row_col' style='background-color:#FFF;padding: 12px;'>
                <h2><i class="fa fa-book"></i> <?php _e("Documentation","wp-google-maps"); ?></h2>
                <hr />
                <p><?php _e("Getting started? Read through some of these articles to help you along your way.","wp-google-maps"); ?></p>
                <p><strong><?php _e("Documentation:","wp-google-maps"); ?></strong></p>
                <ul>
                    <li><a href='http://www.wpgmaps.com/documentation/creating-your-first-map/' target='_BLANK' title='<?php _e("Creating your first map","wp-google-maps"); ?>'><?php _e("Creating your first map","wp-google-maps"); ?></a></li>
                    <li><a href='http://www.wpgmaps.com/documentation/using-your-map-in-a-widget/' target='_BLANK' title='<?php _e("Using your map as a Widget","wp-google-maps"); ?>'><?php _e("Using your map as a Widget","wp-google-maps"); ?></a></li>
                    <li><a href='http://www.wpgmaps.com/documentation/exporting-and-importing-your-markers/' target='_BLANK' title='<?php _e("Exporting and Importing your map markers","wp-google-maps"); ?>'><?php _e("Exporting and Importing your map markers","wp-google-maps"); ?></a></li>
                    <li><a href='http://www.wpgmaps.com/documentation/changing-the-google-maps-language/' target='_BLANK' title='<?php _e("Changing the Google Maps language","wp-google-maps"); ?>'><?php _e("Changing the Google Maps language","wp-google-maps"); ?></a></li>
                    <li><a href='http://www.wpgmaps.com/documentation/' target='_BLANK' title='<?php _e("WP Google Maps Documentation","wp-google-maps"); ?>'><?php _e("View all documentation.","wp-google-maps"); ?></a></li>
                </ul>
            </div>
            <div class='wpgmza_row_col' style='background-color:#FFF;padding: 12px;'>
                <h2><i class="fa fa-exclamation-circle"></i> <?php _e("Troubleshooting","wp-google-maps"); ?></h2>
                <hr />
                <p><?php _e("WP Google Maps Pro has a diverse and wide range of features which may, from time to time, run into conflicts with the thousands of themes and other plugins on the market.","wp-google-maps"); ?></p>
                <p><strong><?php _e("Common issues:","wp-google-maps"); ?></strong></p>
                <ul>
                    <li><a href='http://www.wpgmaps.com/documentation/troubleshooting/my-map-is-not-showing-on-my-website/' target='_BLANK' title='<?php _e("My map is not showing on my website","wp-google-maps"); ?>'><?php _e("My map is not showing on my website","wp-google-maps"); ?></a></li>
                    <li><a href='http://www.wpgmaps.com/documentation/troubleshooting/my-markers-are-not-showing-on-my-map/' target='_BLANK' title='<?php _e("My markers are not showing on my map in the front-end","wp-google-maps"); ?>'><?php _e("My markers are not showing on my map in the front-end","wp-google-maps"); ?></a></li>
                    <li><a href='http://www.wpgmaps.com/documentation/troubleshooting/im-getting-jquery-errors-showing-on-my-website/' target='_BLANK' title='<?php _e("I'm getting jQuery errors showing on my website","wp-google-maps"); ?>'><?php _e("I'm getting jQuery errors showing on my website","wp-google-maps"); ?></a></li>
                </ul>
            </div>
            <div class='wpgmza_row_col' style='background-color:#FFF;padding: 12px;'>
                <h2><i class="fa fa-bullhorn"></i> <?php _e("Support","wp-google-maps"); ?></h2>
                <hr />
                <p><?php _e("Still need help? Use one of these links below.","wp-google-maps"); ?></p>
                <ul>
                    <li><a href='http://www.wpgmaps.com/support/' target='_BLANK' title='<?php _e("Support desk","wp-google-maps"); ?>'><?php _e("Support desk","wp-google-maps"); ?></a></li>
                    <li><a href='http://www.wpgmaps.com/contact-us/' target='_BLANK' title='<?php _e("Contact us","wp-google-maps"); ?>'><?php _e("Contact us","wp-google-maps"); ?></a></li>
                </ul>
                
            </div>
            
            
        </div>
        
<?php
}



function wpgmaps_settings_page_pro() {


    echo"<div class=\"wrap\"><div id=\"icon-edit\" class=\"icon32 icon32-posts-post\"><br></div><h2>".__("WP Google Map Settings","wp-google-maps")."</h2>";
    wpgmza_version_check();

    if (function_exists("wpgmza_register_pro_version")) {
        $pro_settings1 = wpgmaps_settings_page_sub('infowindow');
        $pro_settings2 = wpgmaps_settings_page_sub('mapsettings');
        $pro_settings3 = wpgmaps_settings_page_sub('ugm');
        $pro_settings4 = wpgmaps_settings_page_sub('advanced');
        $pro_settings5 = wpgmaps_settings_page_sub('mlisting');
        global $wpgmza_version;
        if (floatval($wpgmza_version) < 5) {
            $prov_msg = "<div class='error below-h1'><p>Please update your BASIC version of this plugin for all of these settings to work.</p></div>";
        } else { $prov_msg = ''; }
    }
    if (function_exists('wpgmza_register_ugm_version')) {
        $pro_settings3 = wpgmaps_settings_page_sub('ugm');
    }

    echo "
        <form action='' method='post' id='wpgmaps_options'>
        <p>$prov_msg</p>
            
            <div id=\"wpgmaps_tabs\">
                <ul>
                        <li><a href=\"#tabs-1\">".__("Maps","wp-google-maps")."</a></li>
                        <li><a href=\"#tabs-2\">".__("InfoWindows","wp-google-maps")."</a></li>
                        <li><a href=\"#tabs-3\">".__("Marker Listing","wp-google-maps")."</a></li>
                        <li><a href=\"#tabs-4\">".__("Advanced","wp-google-maps")."</a></li>
                        <li><a href=\"#tabs-5\">".__("Visitor Generated Markers","wp-google-maps")."</a></li>
                        <li><a href=\"#tabs-6\">".__("Error Log","wp-google-maps")."</a></li>
                        ".apply_filters("wpgmza_global_settings_tabs", "")."
                </ul>
                <div id=\"tabs-1\">
                    $pro_settings2
                </div>
                <div id=\"tabs-2\">
                    $pro_settings1
                </div>
                <div id=\"tabs-3\">
                    $pro_settings5
                </div>
                <div id=\"tabs-4\">
                    $pro_settings4
                </div>
                <div id=\"tabs-5\">
                    $pro_settings3
                </div>
                <div id=\"tabs-6\">
                    <h3>".__("WP Google Maps Error log","wp-google-maps")."</h3>
                    <p>".__("Having issues? Perhaps something below can give you a clue as to what's wrong. Alternatively, email this through to nick@wpgmaps.com for help!","wp-google-maps")."</p>    
                    <textarea style='width:100%; height:600px;' readonly>
                        ".wpgmza_return_error_log()."
                    </textarea>
                </div>
                ".apply_filters("wpgmza_global_settings_tab_content", "")."
            </div>
            
                

                
                
                

                <p class='submit'><input type='submit' name='wpgmza_save_settings' class='button-primary' value='".__("Save Settings","wp-google-maps")." &raquo;' /></p>


            </form>
            
            
    ";

    echo "</div>";






}
register_activation_hook( __FILE__, 'wpgmaps_pro_activate' );
register_deactivation_hook( __FILE__, 'wpgmaps_pro_deactivate' );


$wpgmaps_api_url = 'http://ccplugins.co/api-wpgmaps-version-6/';
$wpgmaps_plugin_slug = basename(dirname(__FILE__));

// Take over the update check
add_filter('pre_set_site_transient_update_plugins', 'wpgmaps_check_for_plugin_update');

function wpgmaps_check_for_plugin_update($checked_data) {
	global $wpgmaps_api_url, $wpgmaps_plugin_slug, $wp_version;
	
	//Comment out these two lines during testing.
	if (empty($checked_data->checked))
		return $checked_data;
	
        
        
	$args = array(
		'slug' => $wpgmaps_plugin_slug,
		'version' => $checked_data->checked[$wpgmaps_plugin_slug .'/'. $wpgmaps_plugin_slug .'.php'],
	);
	$request_string = array(
			'body' => array(
				'action' => 'basic_check', 
				'request' => serialize($args),
				'api-key' => md5(get_bloginfo('url'))
			),
			'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
		);
	
	// Start checking for an update
	$raw_response = wp_remote_post($wpgmaps_api_url, $request_string);
        if (isset($raw_response)) {
            if (!is_wp_error($raw_response) && ($raw_response['response']['code'] == 200))
                    $response = unserialize($raw_response['body']);

            if (is_object($response) && !empty($response)) // Feed the update data into WP updater
                    $checked_data->response[$wpgmaps_plugin_slug .'/'. $wpgmaps_plugin_slug .'.php'] = $response;

            return $checked_data;
            
        } else {
            return $checked_data;
        }
}



add_filter('plugins_api', 'wpgmaps_plugin_api_call', 10, 3);

function wpgmaps_plugin_api_call($def, $action, $args) {
	global $wpgmaps_plugin_slug, $wpgmaps_api_url, $wp_version;
	
	if (!isset($args->slug) || ($args->slug != $wpgmaps_plugin_slug))
		return false;
	
	// Get the current version
	$plugin_info = get_site_transient('update_plugins');
	$current_version = $plugin_info->checked[$wpgmaps_plugin_slug .'/'. $wpgmaps_plugin_slug .'.php'];
	$args->version = $current_version;
	
	$request_string = array(
			'body' => array(
				'action' => $action, 
				'request' => serialize($args),
				'api-key' => md5(get_bloginfo('url'))
			),
			'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
		);
	
	$request = wp_remote_post($wpgmaps_api_url, $request_string);
	
	if (is_wp_error($request)) {
		$res = new WP_Error('plugins_api_failed', __('An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>'), $request->get_error_message());
	} else {
		$res = unserialize($request['body']);
		
		if ($res === false)
			$res = new WP_Error('plugins_api_failed', __('An unknown error occurred'), $request['body']);
	}
	
	return $res;
}



function wpgmaps_settings_page_sub($section) {

    if ($section == "ugm") {
        if (function_exists('wpgmaps_ugm_settings_page')) { return wpgmaps_ugm_settings_page(); }
        else { 
            $ret = "<h3>".__("Visitor Generated Markers Settings","wp-google-maps")."</h3>";
            $ret .= "<a href='http://www.wpgmaps.com/visitor-generated-markers-add-on/?utm_source=plugin&utm_medium=link&utm_campaign=vgm_addon' target='_BLANK'>".__("Purchase the Visitor Generated Markers Add-on","wp-google-maps")."</a> ".__("to enable this feature. <br /><br />If you have already purchased it please ensure that you have uploaded activated the plugin.","wp-google-maps");
            return $ret;
        }
    }
    if ($section == "mlisting") {
        $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");
        if (isset($wpgmza_settings['wpgmza_settings_markerlist_category'])) { $wpgmza_settings_markerlist_category = $wpgmza_settings['wpgmza_settings_markerlist_category']; } else { $wpgmza_settings_markerlist_category = ""; }
        if (isset($wpgmza_settings['wpgmza_settings_markerlist_icon'])) { $wpgmza_settings_markerlist_icon = $wpgmza_settings['wpgmza_settings_markerlist_icon']; } else { $wpgmza_settings_markerlist_icon = ""; }
        if (isset($wpgmza_settings['wpgmza_settings_markerlist_title'])) { $wpgmza_settings_markerlist_title = $wpgmza_settings['wpgmza_settings_markerlist_title']; } else { $wpgmza_settings_markerlist_title = ""; }
        if (isset($wpgmza_settings['wpgmza_settings_markerlist_description'])) { $wpgmza_settings_markerlist_description = $wpgmza_settings['wpgmza_settings_markerlist_description']; } else { $wpgmza_settings_markerlist_description = ""; }
        if (isset($wpgmza_settings['wpgmza_settings_markerlist_address'])) { $wpgmza_settings_markerlist_address = $wpgmza_settings['wpgmza_settings_markerlist_address']; } else { $wpgmza_settings_markerlist_address = ""; }
        if ($wpgmza_settings_markerlist_category == "yes") { $wpgmza_hide_category_checked = "checked='checked'"; } else { $wpgmza_hide_category_checked = ''; }
        if ($wpgmza_settings_markerlist_icon == "yes") { $wpgmza_hide_icon_checked = "checked='checked'"; } else { $wpgmza_hide_icon_checked = ''; }
        if ($wpgmza_settings_markerlist_title == "yes") { $wpgmza_hide_title_checked = "checked='checked'"; } else { $wpgmza_hide_title_checked = ''; }
        if ($wpgmza_settings_markerlist_address == "yes") { $wpgmza_hide_address_checked = "checked='checked'"; } else { $wpgmza_hide_address_checked = ''; }
        if ($wpgmza_settings_markerlist_description == "yes") { $wpgmza_hide_description_checked = "checked='checked'"; } else { $wpgmza_hide_description_checked = ''; }

        if (isset($wpgmza_settings['wpgmza_settings_carousel_markerlist_image'])) { $wpgmza_settings_carousel_markerlist_image = $wpgmza_settings['wpgmza_settings_carousel_markerlist_image']; } else { $wpgmza_settings_carousel_markerlist_image = ""; }
        if (isset($wpgmza_settings['wpgmza_settings_carousel_markerlist_icon'])) { $wpgmza_settings_carousel_markerlist_icon = $wpgmza_settings['wpgmza_settings_carousel_markerlist_icon']; } else { $wpgmza_settings_carousel_markerlist_icon = ""; }
        if (isset($wpgmza_settings['wpgmza_settings_carousel_markerlist_title'])) { $wpgmza_settings_carousel_markerlist_title = $wpgmza_settings['wpgmza_settings_carousel_markerlist_title']; } else { $wpgmza_settings_carousel_markerlist_title = ""; }
        if (isset($wpgmza_settings['wpgmza_settings_carousel_markerlist_address'])) { $wpgmza_settings_carousel_markerlist_address = $wpgmza_settings['wpgmza_settings_carousel_markerlist_address']; } else { $wpgmza_settings_carousel_markerlist_address = ""; }
        if (isset($wpgmza_settings['wpgmza_settings_carousel_markerlist_description'])) { $wpgmza_settings_carousel_markerlist_description = $wpgmza_settings['wpgmza_settings_carousel_markerlist_description']; } else { $wpgmza_settings_carousel_markerlist_description = ""; }
        if (isset($wpgmza_settings['wpgmza_settings_carousel_markerlist_directions'])) { $wpgmza_settings_carousel_markerlist_directions = $wpgmza_settings['wpgmza_settings_carousel_markerlist_directions']; } else { $wpgmza_settings_carousel_markerlist_directions = ""; }
        if (isset($wpgmza_settings['wpgmza_settings_carousel_markerlist_marker_link'])) { $wpgmza_settings_carousel_markerlist_marker_link = $wpgmza_settings['wpgmza_settings_carousel_markerlist_marker_link']; } else { $wpgmza_settings_carousel_markerlist_marker_link = ""; }
        if (isset($wpgmza_settings['wpgmza_settings_carousel_markerlist_resize_image'])) { $wpgmza_settings_carousel_markerlist_resize_image = $wpgmza_settings['wpgmza_settings_carousel_markerlist_resize_image']; } else { $wpgmza_settings_carousel_markerlist_resize_image = ""; }

        if (isset($wpgmza_settings['carousel_lazyload'])) { $wpgmza_settings_carousel_markerlist_lazyload = $wpgmza_settings['carousel_lazyload']; } else { $wpgmza_settings_carousel_markerlist_lazyload = ""; }
        if (isset($wpgmza_settings['carousel_autoplay'])) { $wpgmza_settings_carousel_markerlist_autoplay = $wpgmza_settings['carousel_autoplay']; } else { $wpgmza_settings_carousel_markerlist_autoplay = "5000"; }
        if (isset($wpgmza_settings['carousel_autoheight'])) { $wpgmza_settings_carousel_markerlist_autoheight = $wpgmza_settings['carousel_autoheight']; } else { $wpgmza_settings_carousel_markerlist_autoheight = ""; }
        if (isset($wpgmza_settings['carousel_pagination'])) { $wpgmza_settings_carousel_markerlist_pagination = $wpgmza_settings['carousel_pagination']; } else { $wpgmza_settings_carousel_markerlist_pagination = ""; }
        if (isset($wpgmza_settings['carousel_items'])) { $wpgmza_settings_carousel_markerlist_items = $wpgmza_settings['carousel_items']; } else { $wpgmza_settings_carousel_markerlist_items = "5"; }
        if (isset($wpgmza_settings['carousel_navigation'])) { $wpgmza_settings_carousel_markerlist_navigation = $wpgmza_settings['carousel_navigation']; } else { $wpgmza_settings_carousel_markerlist_navigation = ""; }

        if (isset($wpgmza_settings['wpgmza_default_items'])) { $wpgmza_settings_default_items = $wpgmza_settings['wpgmza_default_items']; } else { $wpgmza_settings_default_items = "10"; }

        if ($wpgmza_settings_carousel_markerlist_image == "yes") { $wpgmza_hide_carousel_image_checked = "checked='checked'"; } else { $wpgmza_hide_carousel_image_checked = ''; }
        if ($wpgmza_settings_carousel_markerlist_icon == "yes") { $wpgmza_hide_carousel_icon_checked = "checked='checked'"; } else { $wpgmza_hide_carousel_icon_checked = ''; }
        if ($wpgmza_settings_carousel_markerlist_title == "yes") { $wpgmza_hide_carousel_title_checked = "checked='checked'"; } else { $wpgmza_hide_carousel_title_checked = ''; }
        if ($wpgmza_settings_carousel_markerlist_address == "yes") { $wpgmza_hide_carousel_address_checked = "checked='checked'"; } else { $wpgmza_hide_carousel_address_checked = ''; }
        if ($wpgmza_settings_carousel_markerlist_description == "yes") { $wpgmza_hide_carousel_description_checked = "checked='checked'"; } else { $wpgmza_hide_carousel_description_checked = ''; }
        if ($wpgmza_settings_carousel_markerlist_directions == "yes") { $wpgmza_hide_carousel_directions_checked = "checked='checked'"; } else { $wpgmza_hide_carousel_directions_checked = ''; }
        if ($wpgmza_settings_carousel_markerlist_marker_link == "yes") { $wpgmza_hide_carousel_marker_link_checked = "checked='checked'"; } else { $wpgmza_hide_carousel_marker_link_checked = ''; }
        if ($wpgmza_settings_carousel_markerlist_resize_image == "yes") { $wpgmza_hide_carousel_resize_image_checked = "checked='checked'"; } else { $wpgmza_hide_carousel_resize_image_checked = ''; }

        
        if ($wpgmza_settings_carousel_markerlist_lazyload == "yes") { $wpgmza_settings_carousel_markerlist_lazyload_checked = "checked='checked'"; } else { $wpgmza_settings_carousel_markerlist_lazyload_checked = ''; }
        if ($wpgmza_settings_carousel_markerlist_autoheight == "yes") { $wpgmza_settings_carousel_markerlist_autoheight_checked = "checked='checked'"; } else { $wpgmza_settings_carousel_markerlist_autoheight_checked = ''; }
        if ($wpgmza_settings_carousel_markerlist_pagination == "yes") { $wpgmza_settings_carousel_markerlist_pagination_checked = "checked='checked'"; } else { $wpgmza_settings_carousel_markerlist_pagination_checked = ''; }
        if ($wpgmza_settings_carousel_markerlist_navigation == "yes") { $wpgmza_settings_carousel_markerlist_navigation_checked = "checked='checked'"; } else { $wpgmza_settings_carousel_markerlist_navigation_checked = ''; }
        
        if (isset($wpgmza_settings['wpgmza_settings_carousel_markerlist_theme'])) { $wpgmza_carousel_theme = $wpgmza_settings['wpgmza_settings_carousel_markerlist_theme']; }
        
        $wpgmza_carousel_theme_selected = array();
        for ($i=0;$i<=7;$i++) {
            $wpgmza_carousel_theme_selected[$i] = "";
        }
        
        for ($i=0;$i<=5;$i++) {
            $wpgmza_default_show_items_selected[$i] = "";
        }
        if ($wpgmza_settings_default_items == "10") { $wpgmza_default_show_items_selected[0] = "selected"; }
        else if ($wpgmza_settings_default_items == "25") { $wpgmza_default_show_items_selected[1] = "selected"; }
        else if ($wpgmza_settings_default_items == "50") { $wpgmza_default_show_items_selected[2] = "selected"; }
        else if ($wpgmza_settings_default_items == "100") { $wpgmza_default_show_items_selected[3] = "selected"; }
        else if ($wpgmza_settings_default_items == "-1") { $wpgmza_default_show_items_selected[4] = "selected"; }

        if (isset($wpgmza_carousel_theme) && $wpgmza_carousel_theme == "sky") { $wpgmza_carousel_theme_selected[0] = "selected"; }
        else if (isset($wpgmza_carousel_theme) && $wpgmza_carousel_theme == "sun") { $wpgmza_carousel_theme_selected[1] = "selected"; }
        else if (isset($wpgmza_carousel_theme) && $wpgmza_carousel_theme == "earth") { $wpgmza_carousel_theme_selected[2] = "selected"; }
        else if (isset($wpgmza_carousel_theme) && $wpgmza_carousel_theme == "monotone") { $wpgmza_carousel_theme_selected[3] = "selected"; }
        else if (isset($wpgmza_carousel_theme) && $wpgmza_carousel_theme == "pinkpurple") { $wpgmza_carousel_theme_selected[4] = "selected"; }
        else if (isset($wpgmza_carousel_theme) && $wpgmza_carousel_theme == "white") { $wpgmza_carousel_theme_selected[5] = "selected"; }
        else if (isset($wpgmza_carousel_theme) && $wpgmza_carousel_theme == "black") { $wpgmza_carousel_theme_selected[6] = "selected"; }
        else { $wpgmza_api_version_selected[0] = "selected"; }
        
            $ret = "<h3>".__("Marker Listing Settings","wp-google-maps")."</h3>";
            $ret .= "<p>".__("Changing these settings will alter the way the marker list appears on your website.","wp-google-maps")."</p>";
            $ret .= "<hr />";
            
            $ret .= "<h4>".__("Advanced Marker Listing","wp-google-maps")." & ".__("Basic Marker Listings","wp-google-maps")."</h4>";
            $ret .= "<table class='form-table'>";
            $ret .= "   <tr>";
            $ret .= "   <td width='200' valign='top' style='vertical-align:top;'>".__("Column settings","wp-google-maps")."</td>";
            $ret .= "   <td>";
            $ret .= "           <div class='switch'><input name='wpgmza_settings_markerlist_icon' class='cmn-toggle cmn-toggle-round-flat' type='checkbox' id='wpgmza_settings_markerlist_icon' value='yes' $wpgmza_hide_icon_checked /> <label for='wpgmza_settings_markerlist_icon'></label></div> ".__("Hide the Icon column","wp-google-maps")."<br />";
            $ret .= "           <div class='switch'><input name='wpgmza_settings_markerlist_title' class='cmn-toggle cmn-toggle-round-flat' type='checkbox' id='wpgmza_settings_markerlist_title' value='yes' $wpgmza_hide_title_checked /> <label for='wpgmza_settings_markerlist_title'></label></div> ".__("Hide the Title column","wp-google-maps")."<br />";
            $ret .= "           <div class='switch'><input name='wpgmza_settings_markerlist_address' class='cmn-toggle cmn-toggle-round-flat' type='checkbox' id='wpgmza_settings_markerlist_address' value='yes' $wpgmza_hide_address_checked /> <label for='wpgmza_settings_markerlist_address'></label></div> ".__("Hide the Address column","wp-google-maps")."<br />";
            $ret .= "           <div class='switch'><input name='wpgmza_settings_markerlist_category' class='cmn-toggle cmn-toggle-round-flat' type='checkbox' id='wpgmza_settings_markerlist_category' value='yes' $wpgmza_hide_category_checked /> <label for='wpgmza_settings_markerlist_category'></label></div> ".__("Hide the Category column","wp-google-maps")."<br />";
            $ret .= "           <div class='switch'><input name='wpgmza_settings_markerlist_description' class='cmn-toggle cmn-toggle-round-flat' type='checkbox' id='wpgmza_settings_markerlist_description' value='yes' $wpgmza_hide_description_checked /> <label for='wpgmza_settings_markerlist_description'></label></div> ".__("Hide the Description column","wp-google-maps")."<br />";
            $ret .= "       </td>";
            $ret .= "   </tr>";
            $ret .= "   <tr>";
            $ret .= "   <td width='200' valign='top' style='vertical-align:top;'>".__("Show X items by default","wp-google-maps")."</td>";
            $ret .= "   <td>";
            $ret .= "           <select id='wpgmza_default_items' name='wpgmza_default_items'  >";
            $ret .= "               <option value=\"5\" ".$wpgmza_default_show_items_selected[5].">5</option>";
            $ret .= "               <option value=\"10\" ".$wpgmza_default_show_items_selected[0].">10</option>";
            $ret .= "               <option value=\"25\" ".$wpgmza_default_show_items_selected[1].">25</option>";
            $ret .= "               <option value=\"50\" ".$wpgmza_default_show_items_selected[2].">50</option>";
            $ret .= "               <option value=\"100\" ".$wpgmza_default_show_items_selected[3].">100</option>";
            $ret .= "               <option value=\"-1\" ".$wpgmza_default_show_items_selected[4].">ALL</option>";
            $ret .= "           </select>";
            $ret .= "       </td>";
            $ret .= "   </tr>";
            $ret .= "</table>";
            $ret .= "<hr/>";
             
            $ret .= "<h4>".__("Carousel Marker Listing","wp-google-maps")."</h4>";
            $ret .= "<table class='form-table'>";
            $ret .= "   <tr>";
            $ret .= "   <td width='200' valign='top' style='vertical-align:top;'>".__("Theme selection","wp-google-maps")."</td>";
            $ret .= "   <td>";
            $ret .= "   <select id='wpgmza_settings_carousel_markerlist_theme' name='wpgmza_settings_carousel_markerlist_theme'  >";
            $ret .= "   <option value=\"sky\" ".$wpgmza_carousel_theme_selected[0].">".__("Sky","wp-google-maps")."</option>";
            $ret .= "   <option value=\"sun\" ".$wpgmza_carousel_theme_selected[1].">".__("Sun","wp-google-maps")."</option>";
            $ret .= "   <option value=\"earth\" ".$wpgmza_carousel_theme_selected[2].">".__("Earth","wp-google-maps")."</option>";
            $ret .= "   <option value=\"monotone\" ".$wpgmza_carousel_theme_selected[3].">".__("Monotone","wp-google-maps")."</option>";
            $ret .= "   <option value=\"pinkpurple\" ".$wpgmza_carousel_theme_selected[4].">".__("PinkPurple","wp-google-maps")."</option>";
            $ret .= "   <option value=\"white\" ".$wpgmza_carousel_theme_selected[5].">".__("White","wp-google-maps")."</option>";
            $ret .= "   <option value=\"black\" ".$wpgmza_carousel_theme_selected[6].">".__("Black","wp-google-maps")."</option>";

            $ret .= "   </select>";
            $ret .= "    </td>";
            $ret .= "    </tr>";
            $ret .= "   <td width='200' valign='top' style='vertical-align:top;'>".__("Carousel settings","wp-google-maps")."</td>";
            $ret .= "   <td>";
            $ret .= "       <div class='switch'><input name='wpgmza_settings_carousel_markerlist_image' class='cmn-toggle cmn-toggle-round-flat' type='checkbox' id='wpgmza_settings_carousel_markerlist_image' value='yes' $wpgmza_hide_carousel_image_checked /><label for='wpgmza_settings_carousel_markerlist_image'></label></div> ".__("Hide the Image","wp-google-maps")."<br />";
            $ret .= "       <div class='switch'><input name='wpgmza_settings_carousel_markerlist_title' class='cmn-toggle cmn-toggle-round-flat' type='checkbox' id='wpgmza_settings_carousel_markerlist_title' value='yes' $wpgmza_hide_carousel_title_checked /><label for='wpgmza_settings_carousel_markerlist_title'></label></div> ".__("Hide the Title","wp-google-maps")."<br />";
            $ret .= "       <div class='switch'><input name='wpgmza_settings_carousel_markerlist_icon' class='cmn-toggle cmn-toggle-round-flat' type='checkbox' id='wpgmza_settings_carousel_markerlist_icon' value='yes' $wpgmza_hide_carousel_icon_checked /><label for='wpgmza_settings_carousel_markerlist_icon'></label></div> ".__("Hide the Marker Icon","wp-google-maps")."<br />";
            $ret .= "       <div class='switch'><input name='wpgmza_settings_carousel_markerlist_address' class='cmn-toggle cmn-toggle-round-flat' type='checkbox' id='wpgmza_settings_carousel_markerlist_address' value='yes' $wpgmza_hide_carousel_address_checked /><label for='wpgmza_settings_carousel_markerlist_address'></label></div> ".__("Hide the Address","wp-google-maps")."<br />";
            $ret .= "       <div class='switch'><input name='wpgmza_settings_carousel_markerlist_description' class='cmn-toggle cmn-toggle-round-flat' type='checkbox' id='wpgmza_settings_carousel_markerlist_description' value='yes' $wpgmza_hide_carousel_description_checked /><label for='wpgmza_settings_carousel_markerlist_description'></label></div> ".__("Hide the Description","wp-google-maps")."<br />";
            $ret .= "       <div class='switch'><input name='wpgmza_settings_carousel_markerlist_marker_link' class='cmn-toggle cmn-toggle-round-flat' type='checkbox' id='wpgmza_settings_carousel_markerlist_marker_link' value='yes' $wpgmza_hide_carousel_marker_link_checked /><label for='wpgmza_settings_carousel_markerlist_marker_link'></label></div> ".__("Hide the Marker Link","wp-google-maps")."<br />";
            $ret .= "       <div class='switch'><input name='wpgmza_settings_carousel_markerlist_directions' class='cmn-toggle cmn-toggle-round-flat' type='checkbox' id='wpgmza_settings_carousel_markerlist_directions' value='yes' $wpgmza_hide_carousel_directions_checked /><label for='wpgmza_settings_carousel_markerlist_directions'></label></div> ".__("Hide the Directions Link","wp-google-maps")."<br />";
            //$ret .= "       <br /><div class='switch'><input name='wpgmza_settings_carousel_markerlist_resize_image' class='cmn-toggle cmn-toggle-round-flat' type='checkbox' id='wpgmza_settings_carousel_markerlist_resize_image' value='yes' $wpgmza_hide_carousel_resize_image_checked /><label for='wpgmza_settings_carousel_markerlist_resize_image'></label></div> ".__("Resize Images with Timthumb","wp-google-maps")."<br />";
            $ret .= "       <br /><div class='switch'><input name='carousel_lazyload' class='cmn-toggle cmn-toggle-round-flat' type='checkbox' id='carousel_lazyload' value='yes' $wpgmza_settings_carousel_markerlist_lazyload_checked /><label for='carousel_lazyload'></label></div> ".__("Enable lazyload of images","wp-google-maps")."<br />";
            $ret .= "       <div class='switch'><input name='carousel_autoheight' class='cmn-toggle cmn-toggle-round-flat' type='checkbox' id='carousel_autoheight' value='yes' $wpgmza_settings_carousel_markerlist_autoheight_checked /><label for='carousel_autoheight'></label></div> ".__("Enable autoheight","wp-google-maps")."<br />";
            $ret .= "       <div class='switch'><input name='carousel_pagination' class='cmn-toggle cmn-toggle-round-flat' type='checkbox' id='carousel_pagination' value='yes' $wpgmza_settings_carousel_markerlist_pagination_checked /> <label for='carousel_pagination'></label></div>".__("Enable pagination","wp-google-maps")."<br />";
            $ret .= "       <div class='switch'><input name='carousel_navigation' class='cmn-toggle cmn-toggle-round-flat' type='checkbox' id='carousel_navigation' value='yes' $wpgmza_settings_carousel_markerlist_navigation_checked /><label for='carousel_navigation'></label></div> ".__("Enable navigation","wp-google-maps")."<br />";
            $ret .= "       <input name='carousel_items' type='text' id='carousel_items' value='$wpgmza_settings_carousel_markerlist_items' /> ".__("Items","wp-google-maps")."<br />";
            $ret .= "       <input name='carousel_autoplay' type='text' id='carousel_autoplay' value='$wpgmza_settings_carousel_markerlist_autoplay' /> ".__("Autoplay after x milliseconds (1000 = 1 second)","wp-google-maps")."<br />";
            $ret .= "    </td>";
            $ret .= "    </tr>";
            $ret .= "   </table>";
            return $ret;


        
    }
    if ($section == "advanced") {
        $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");
        if (isset($wpgmza_settings['wpgmza_custom_css'])) { $wpgmza_custom_css = $wpgmza_settings['wpgmza_custom_css']; } else { $wpgmza_custom_css  = ""; }
        if (function_exists("wpgmza_return_marker_url")) {
            $marker_location = wpgmza_return_marker_path();
            $marker_url = wpgmza_return_marker_url();
            $wpgmza_use_url = __("You can use the following","wp-google-maps").": {wp_content_url},{plugins_url},{uploads_url}<br /><br />";
            $wpgmza_use_dir = __("You can use the following","wp-google-maps").": {wp_content_dir},{plugins_dir},{uploads_dir}<br /><br />";
        } else {
            $marker_location = get_option("wpgmza_xml_location");
            $marker_url = get_option("wpgmza_xml_url");
            $wpgmza_use_url = "";
            $wpgmza_use_dir = "";
        }
        
        $show_advanced_marker_tr = 'style="visibility:hidden; display:none;"';
        $wpgmza_settings_marker_pull_checked[0] = "";
        $wpgmza_settings_marker_pull_checked[1] = "";
        if (isset($wpgmza_settings['wpgmza_settings_marker_pull'])) { $wpgmza_settings_marker_pull = $wpgmza_settings['wpgmza_settings_marker_pull']; } else { $wpgmza_settings_marker_pull = false; }
        if ($wpgmza_settings_marker_pull == '0' || $wpgmza_settings_marker_pull == 0) { $wpgmza_settings_marker_pull_checked[0] = "checked='checked'"; $show_advanced_marker_tr = 'style="visibility:hidden; display:none;"'; }
        else if ($wpgmza_settings_marker_pull == '1' || $wpgmza_settings_marker_pull == 1) { $wpgmza_settings_marker_pull_checked[1] = "checked='checked'";  $show_advanced_marker_tr = 'style="visibility:visible; display:table-row;"'; }
        else { $wpgmza_settings_marker_pull_checked[0] = "checked='checked'"; $show_advanced_marker_tr = 'style="visibility:hidden; display:none;"'; }   

        
        
        
        $wpgmza_file_perms = @substr(sprintf('%o', fileperms($marker_location)), -4);
        $fpe = false;
        $fpe_error = "";
        if ($wpgmza_file_perms == "0777" || $wpgmza_file_perms == "0755" || $wpgmza_file_perms == "0775" || $wpgmza_file_perms == "0705" || $wpgmza_file_perms == "2777" || $wpgmza_file_perms == "2755" || $wpgmza_file_perms == "2775" || $wpgmza_file_perms == "2705") { 
            $fpe = true;
            $fpe_error = "";
        }
        else if ($wpgmza_file_perms == "0") {
            $fpe = false;
            $fpe_error = __("This folder does not exist. Please create it.","wp-google-maps");
        } else if (@is_writable($marker_location)) {
            $fpe = true;
            $fpe_error = "";
        } else { 
            $fpe = false;
            $fpe_error = __("File Permissions:","wp-google-maps").$wpgmza_file_perms." ".__(" - The plugin does not have write access to this folder. Please CHMOD this folder to 755 or 777, or change the location","wp-google-maps");
        }

        if (!$fpe) {
            $wpgmza_file_perms_check = "<span style='color:red;'>$fpe_error</span>";
        } else {
            $wpgmza_file_perms_check = "<span style='color:green;'>$fpe_error</span>";

        }
        
        $upload_dir = wp_upload_dir();
        return "
        <h3>".__("Advanced Settings")."</h3>

        		<table class='form-table'>
					
					<tr>

						<td valign='top' width='200' style='vertical-align:top;'>".__('Google Maps API Key (optional)', 'wp-google-maps')."</td>
						<td>
							<input type='text' id='wpgmza_google_maps_api_key' name='wpgmza_google_maps_api_key' value='".get_option('wpgmza_google_maps_api_key')."' style='width: 400px;' />
							<p>".__("This API key can be obtained from the <a href='https://console.developers.google.com' target='_BLANK'>Google Developers Console</a>. Our <a href='http://www.wpgmaps.com/documentation/creating-a-google-maps-api-key/' target='_BLANK'>documentation</a> provides a full guide on how to obtain this. ","wp-google-maps")."</p>
						</td>
					
					</tr>
										

	                <p>".__("We suggest that you change the two fields below ONLY if you are experiencing issues when trying to save the marker XML files.","wp-google-maps")."</p>
    
                    <tr>
                        <td valign='top' width='200' style='vertical-align:top;'>".__("Pull marker data from","wp-google-maps")." </td>
                            <td>
                                     <input name='wpgmza_settings_marker_pull' type='radio' id='wpgmza_settings_marker_pull' class='wpgmza_settings_marker_pull' value='0' ".$wpgmza_settings_marker_pull_checked[0]." />".__("Database (Great for small amounts of markers)","wp-google-maps")." <br />
                                     <input name='wpgmza_settings_marker_pull' type='radio' id='wpgmza_settings_marker_pull' class='wpgmza_settings_marker_pull' value='1' ".$wpgmza_settings_marker_pull_checked[1]." />".__("XML File  (Great for large amounts of markers)","wp-google-maps")." 
                                  </td>
                   </tr>
                     <tr class='wpgmza_marker_dir_tr' $show_advanced_marker_tr>
                            <td width='200' valign='top' style='vertical-align:top;'>".__("Marker data XML directory","wp-google-maps").":</td>
                            <td>
                                <input id='wpgmza_marker_xml_location' name='wpgmza_marker_xml_location' value='".get_option("wpgmza_xml_location")."' class='regular-text code' /> $wpgmza_file_perms_check
                                <br />

                                <small>$wpgmza_use_dir
                                ".__("Currently using","wp-google-maps").": <strong><em>$marker_location</em></strong></small>
                        </td>
                    </tr>
                     <tr class='wpgmza_marker_url_tr' $show_advanced_marker_tr>
                            <td width='200' valign='top' style='vertical-align:top;'>".__("Marker data XML URL","wp-google-maps").":</td>
                         <td>
                            <input id='wpgmza_marker_xml_url' name='wpgmza_marker_xml_url' value='".get_option("wpgmza_xml_url")."' class='regular-text code' />
                                <br />
                                <br />
                                <small>$wpgmza_use_url
                                ".__("Currently using","wp-google-maps").": <strong><em>$marker_url</em></strong></small>
                        </td>
                    </tr>
                    </table>
                    <h4>".__("Custom CSS","wp-google-maps")."</h4>
                               <table class='form-table'>
                                <tr>
                                       <td width='200' valign='top' style='vertical-align:top;'>".__("Custom CSS","wp-google-maps").":</td>
                                       <td>
                                           <textarea name=\"wpgmza_custom_css\" id=\"wpgmza_marker_xml_url\" cols=\"70\" rows=\"10\">".stripslashes($wpgmza_custom_css)."</textarea>
                                   </td>
                               </tr>
                               </table>";
        
        
    }

    if ($section == "mapsettings") {
        $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");
        if (isset($wpgmza_settings['wpgmza_settings_map_full_screen_control'])) { $wpgmza_settings_map_full_screen_control = $wpgmza_settings['wpgmza_settings_map_full_screen_control']; } else { $wpgmza_settings_map_full_screen_control = ""; }
        if (isset($wpgmza_settings['wpgmza_settings_map_streetview'])) { $wpgmza_settings_map_streetview = $wpgmza_settings['wpgmza_settings_map_streetview']; } else { $wpgmza_settings_map_streetview = ""; }
        if (isset($wpgmza_settings['wpgmza_settings_map_zoom'])) { $wpgmza_settings_map_zoom = $wpgmza_settings['wpgmza_settings_map_zoom']; } else { $wpgmza_settings_map_zoom = ""; }
        if (isset($wpgmza_settings['wpgmza_settings_map_pan'])) { $wpgmza_settings_map_pan = $wpgmza_settings['wpgmza_settings_map_pan']; } else { $wpgmza_settings_map_pan = ""; }
        if (isset($wpgmza_settings['wpgmza_settings_map_type'])) { $wpgmza_settings_map_type = $wpgmza_settings['wpgmza_settings_map_type']; } else { $wpgmza_settings_map_type = ""; }
        if (isset($wpgmza_settings['wpgmza_settings_map_scroll'])) { $wpgmza_settings_map_scroll = $wpgmza_settings['wpgmza_settings_map_scroll']; } else { $wpgmza_settings_map_scroll = ""; }
        if (isset($wpgmza_settings['wpgmza_settings_map_draggable'])) { $wpgmza_settings_map_draggable = $wpgmza_settings['wpgmza_settings_map_draggable']; } else { $wpgmza_settings_map_draggable = ""; }
        if (isset($wpgmza_settings['wpgmza_settings_map_clickzoom'])) { $wpgmza_settings_map_clickzoom = $wpgmza_settings['wpgmza_settings_map_clickzoom']; } else { $wpgmza_settings_map_clickzoom = ""; }
        if (isset($wpgmza_settings['wpgmza_settings_cat_display_qty'])) { $wpgmza_settings_cat_display_qty = $wpgmza_settings['wpgmza_settings_cat_display_qty']; } else { $wpgmza_settings_cat_display_qty = ""; }
        if (isset($wpgmza_settings['wpgmza_settings_force_jquery'])) { $wpgmza_force_jquery = $wpgmza_settings['wpgmza_settings_force_jquery']; } else { $wpgmza_force_jquery = ""; }
        if (isset($wpgmza_settings['wpgmza_settings_remove_api'])) { $wpgmza_remove_api = $wpgmza_settings['wpgmza_settings_remove_api']; }
        if (isset($wpgmza_settings['wpgmza_force_greedy_gestures'])) { $wpgmza_force_greedy_gestures = $wpgmza_settings['wpgmza_force_greedy_gestures']; }
        if (isset($wpgmza_settings['wpgmza_settings_filterbycat_type'])) { $wpgmza_settings_filterbycat_type = $wpgmza_settings['wpgmza_settings_filterbycat_type']; } else { $wpgmza_settings_filterbycat_type = ""; }
        
        if ($wpgmza_settings_map_full_screen_control == "yes") { $wpgmza_fullscreen_checked = "checked='checked'"; } else { $wpgmza_fullscreen_checked = ''; }
        if ($wpgmza_settings_map_streetview == "yes") { $wpgmza_streetview_checked = "checked='checked'"; } else { $wpgmza_streetview_checked = ''; }
        if ($wpgmza_settings_map_zoom == "yes") { $wpgmza_zoom_checked = "checked='checked'"; } else { $wpgmza_zoom_checked = ''; }
        if ($wpgmza_settings_map_pan == "yes") { $wpgmza_pan_checked = "checked='checked'"; } else { $wpgmza_pan_checked = ''; }
        if ($wpgmza_settings_map_type == "yes") { $wpgmza_type_checked = "checked='checked'"; } else { $wpgmza_type_checked = ''; }
        if ($wpgmza_settings_map_scroll == "yes") { $wpgmza_scroll_checked = "checked='checked'"; } else { $wpgmza_scroll_checked = ''; }
        if ($wpgmza_settings_map_draggable == "yes") { $wpgmza_draggable_checked = "checked='checked'"; } else { $wpgmza_draggable_checked = ''; }
        if ($wpgmza_settings_map_clickzoom == "yes") { $wpgmza_clickzoom_checked = "checked='checked'"; } else { $wpgmza_clickzoom_checked = ''; }


        if ($wpgmza_settings_cat_display_qty == "yes") { $wpgmza_cat_qty_checked = "checked='checked'"; } else { $wpgmza_cat_qty_checked = ''; }

        if ($wpgmza_force_jquery == "yes") { $wpgmza_force_jquery_checked = "checked='checked'"; } else { $wpgmza_force_jquery_checked = ''; }
        	
        if (isset($wpgmza_remove_api)) { if ($wpgmza_remove_api == "yes") { $wpgmza_remove_api_checked = "checked='checked'"; } else { $wpgmza_remove_api_checked = ""; } } else { $wpgmza_remove_api_checked = ""; }
        
        if (isset($wpgmza_force_greedy_gestures)) { if ($wpgmza_force_greedy_gestures == "yes") { $wpgmza_force_greedy_gestures_checked = "checked='checked'"; } else { $wpgmza_force_greedy_gestures_checked = ""; } } else { $wpgmza_force_greedy_gestures_checked = ""; }

    	
        if (isset($wpgmza_settings['wpgmza_api_version'])) { $wpgmza_api_version = $wpgmza_settings['wpgmza_api_version']; }
        $wpgmza_api_version_selected = array();
        $wpgmza_api_version_selected[0] = "";
        $wpgmza_api_version_selected[1] = "";
        $wpgmza_api_version_selected[2] = "";
        if (isset($wpgmza_api_version) && $wpgmza_api_version == "3.25") { $wpgmza_api_version_selected[0] = "selected"; }
        else if (isset($wpgmza_api_version) && $wpgmza_api_version == "3.26") { $wpgmza_api_version_selected[1] = "selected"; }
        else if (isset($wpgmza_api_version) && $wpgmza_api_version == "3.exp") { $wpgmza_api_version_selected[2] = "selected"; }
        else { $wpgmza_api_version_selected[0] = "selected"; }



        
        $wpgmza_settings_map_open_marker_by_checked[0] = '';
        $wpgmza_settings_map_open_marker_by_checked[1] = '';
        if (isset($wpgmza_settings['wpgmza_settings_map_open_marker_by'])) { $wpgmza_settings_map_open_marker_by = $wpgmza_settings['wpgmza_settings_map_open_marker_by']; } else {$wpgmza_settings_map_open_marker_by = false; }
        if ($wpgmza_settings_map_open_marker_by == '1') { $wpgmza_settings_map_open_marker_by_checked[0] = "checked='checked'"; }
        else if ($wpgmza_settings_map_open_marker_by == '2') { $wpgmza_settings_map_open_marker_by_checked[1] = "checked='checked'"; }
        else { $wpgmza_settings_map_open_marker_by_checked[0] = "checked='checked'"; }



        if (isset($wpgmza_settings['wpgmza_settings_cat_logic'])) { $wpgmza_settings_cat_logic = $wpgmza_settings['wpgmza_settings_cat_logic']; } else {$wpgmza_settings_cat_logic = false; }
        if ($wpgmza_settings_cat_logic == '0') { $wpgmza_settings_cat_logic_checked[0] = "checked='checked'"; $wpgmza_settings_cat_logic_checked[1] = ''; }
        else if ($wpgmza_settings_cat_logic == '1') { $wpgmza_settings_cat_logic_checked[1] = "checked='checked'"; $wpgmza_settings_cat_logic_checked[0] = ''; }
        else { $wpgmza_settings_cat_logic_checked[0] = "checked='checked'"; $wpgmza_settings_cat_logic_checked[1] = ''; }




        $wpgmza_access_level_checked[0] = "";
        $wpgmza_access_level_checked[1] = "";
        $wpgmza_access_level_checked[2] = "";
        $wpgmza_access_level_checked[3] = "";
        $wpgmza_access_level_checked[4] = "";
        if (isset($wpgmza_settings['wpgmza_settings_access_level'])) { $wpgmza_access_level = $wpgmza_settings['wpgmza_settings_access_level']; } else { $wpgmza_access_level = ""; }
        if ($wpgmza_access_level == "manage_options") { $wpgmza_access_level_checked[0] = "selected"; }
        else if ($wpgmza_access_level == "edit_pages") { $wpgmza_access_level_checked[1] = "selected"; }
        else if ($wpgmza_access_level == "publish_posts") { $wpgmza_access_level_checked[2] = "selected"; }
        else if ($wpgmza_access_level == "edit_posts") { $wpgmza_access_level_checked[3] = "selected"; }
        else if ($wpgmza_access_level == "read") { $wpgmza_access_level_checked[4] = "selected"; }
        else { $wpgmza_access_level_checked[0] = "selected"; }
        

        if ($wpgmza_settings_filterbycat_type == "1" || $wpgmza_settings_filterbycat_type == "" || !$wpgmza_settings_filterbycat_type) { 
            $wpgmza_settings_filterbycat_type_checked_dropdown = "checked='checked'";
            $wpgmza_settings_filterbycat_type_checked_checkbox = "";
        } else {
            $wpgmza_settings_filterbycat_type_checked_checkbox = "checked='checked'";
            $wpgmza_settings_filterbycat_type_checked_dropdown = "";
        }


        if (isset($wpgmza_settings['wpgmza_settings_retina_width'])) { $wpgmza_settings_retina_width = $wpgmza_settings['wpgmza_settings_retina_width']; } else { $wpgmza_settings_retina_width = "31"; }
        if (isset($wpgmza_settings['wpgmza_settings_retina_height'])) { $wpgmza_settings_retina_height = $wpgmza_settings['wpgmza_settings_retina_height']; } else { $wpgmza_settings_retina_height = "45"; }

        
        return "
            <h3>".__("Map Settings","wp-google-maps")."</h3>
                

                

                <table class='form-table'>
                    <tr>
                         <td width='200' valign='top' style='vertical-align:top;'>".__("General Map Settings","wp-google-maps").":</td>
                         <td>
                                <div class='switch'><input name='wpgmza_settings_map_full_screen_control' type='checkbox' class='cmn-toggle cmn-toggle-round-flat' id='wpgmza_settings_map_full_screen_control' value='yes' $wpgmza_fullscreen_checked /> <label for='wpgmza_settings_map_full_screen_control'></label></div>".__("Disable Full Screen Control")."<br />
                                <div class='switch'><input name='wpgmza_settings_map_streetview' type='checkbox' class='cmn-toggle cmn-toggle-round-flat' id='wpgmza_settings_map_streetview' value='yes' $wpgmza_streetview_checked /> <label for='wpgmza_settings_map_streetview'></label></div>".__("Disable StreetView")."<br />
                                <div class='switch'><input name='wpgmza_settings_map_zoom' type='checkbox' class='cmn-toggle cmn-toggle-round-flat' id='wpgmza_settings_map_zoom' value='yes' $wpgmza_zoom_checked /> <label for='wpgmza_settings_map_zoom'></label></div>".__("Disable Zoom Controls")."<br />
                                <div class='switch'><input name='wpgmza_settings_map_pan' type='checkbox' class='cmn-toggle cmn-toggle-round-flat' id='wpgmza_settings_map_pan' value='yes' $wpgmza_pan_checked /> <label for='wpgmza_settings_map_pan'></label></div>".__("Disable Pan Controls")."<br />
                                <div class='switch'><input name='wpgmza_settings_map_type' type='checkbox' class='cmn-toggle cmn-toggle-round-flat' id='wpgmza_settings_map_type' value='yes' $wpgmza_type_checked /> <label for='wpgmza_settings_map_type'></label></div>".__("Disable Map Type Controls")."<br />
                                <div class='switch'><input name='wpgmza_settings_map_scroll' type='checkbox' class='cmn-toggle cmn-toggle-round-flat' id='wpgmza_settings_map_scroll' value='yes' $wpgmza_scroll_checked /> <label for='wpgmza_settings_map_scroll'></label></div>".__("Disable Mouse Wheel Zoom","wp-google-maps")."<br />
                                <div class='switch'><input name='wpgmza_settings_map_draggable' type='checkbox' class='cmn-toggle cmn-toggle-round-flat' id='wpgmza_settings_map_draggable' value='yes' $wpgmza_draggable_checked /> <label for='wpgmza_settings_map_draggable'></label></div>".__("Disable Mouse Dragging","wp-google-maps")."<br />
                                <div class='switch'><input name='wpgmza_settings_map_clickzoom' type='checkbox' class='cmn-toggle cmn-toggle-round-flat' id='wpgmza_settings_map_clickzoom' value='yes' $wpgmza_clickzoom_checked /> <label for='wpgmza_settings_map_clickzoom'></label></div>".__("Disable Mouse Double Click Zooming","wp-google-maps")."<br />
                            </td>
                    </tr>
                    <tr>
                        <td valign='top' style='vertical-align:top;'>".__("Open Marker InfoWindows by","wp-google-maps")." </td>
                            <td><input name='wpgmza_settings_map_open_marker_by' type='radio' id='wpgmza_settings_map_open_marker_by' value='1' ".$wpgmza_settings_map_open_marker_by_checked[0]." />Click<br /><input name='wpgmza_settings_map_open_marker_by' type='radio' id='wpgmza_settings_map_open_marker_by' value='2' ".$wpgmza_settings_map_open_marker_by_checked[1]." />Hover </td>
                    </tr>
                    <tr>
                        <td valign='top' style='vertical-align:top;'>".__("Category Selection Logic","wp-google-maps")." </td>
                            <td>
                            	<input name='wpgmza_settings_cat_logic' type='radio' id='wpgmza_settings_cat_logic' value='0' ".$wpgmza_settings_cat_logic_checked[0]." />".__("OR"," wp-google-maps")." &nbsp; (<span class='description'>".__("Example: Show the marker if it belongs to Cat A _OR_ Cat B.", "wp-google-maps")."</span>)<br />
                            	<input name='wpgmza_settings_cat_logic' type='radio' id='wpgmza_settings_cat_logic' value='1' ".$wpgmza_settings_cat_logic_checked[1]." />".__("AND"," wp-google-maps")." &nbsp; (<span class='description'>".__("Example: Only show the marker if it belongs to Cat A _AND_ Cat B.", "wp-google-maps")."</span>)

                        	</td>
                    </tr>
                    <tr>
                         <td width='200' valign='top' style='vertical-align:top;'>".__("Filter by category displayed as","wp-google-maps").":</td>
                         <td>
                                <input name='wpgmza_settings_filterbycat_type' type='radio' id='wpgmza_settings_filterbycat_type' value='1' $wpgmza_settings_filterbycat_type_checked_dropdown /> ".__("Dropdown","wp-google-maps")."<br />
                                <input name='wpgmza_settings_filterbycat_type' type='radio' id='wpgmza_settings_filterbycat_type' value='2' $wpgmza_settings_filterbycat_type_checked_checkbox /> ".__("Checkboxes","wp-google-maps")."<br />
                            </td>
                    </tr>
                    <tr>
                         <td width='200' valign='top' style='vertical-align:top;'>".__("Additional Category Settings","wp-google-maps").":</td>
                         <td>
                                <div class='switch'><input name='wpgmza_settings_cat_display_qty' type='checkbox' class='cmn-toggle cmn-toggle-round-flat' id='wpgmza_settings_cat_display_qty' value='yes' $wpgmza_cat_qty_checked /> <label for='wpgmza_settings_cat_display_qty'></label></div>".__("Enable Category Count")." <span class='description'>(Displays a count of the markers per category on the front end)</span><br />
                            </td>
                    </tr>
                    
                   
                    <tr>
                         <td width='200' valign='top'>".__("Troubleshooting Options","wp-google-maps").":</td>
                         <td>
                                <div class='switch'><input name='wpgmza_settings_force_jquery' type='checkbox' class='cmn-toggle cmn-toggle-yes-no' id='wpgmza_settings_force_jquery' value='yes' $wpgmza_force_jquery_checked /> <label for='wpgmza_settings_force_jquery' data-on='".__("Yes", "wp-google-maps")."' data-off='".__("No", "wp-google-maps")."'></label></div> ".__("Over-ride current jQuery with version 1.11.3 (Tick this box if you are receiving jQuery related errors after updating to WordPress 4.5)", 'wp-google-maps')."<br />
                        </td>
                    </tr>

                    <tr>
                         <td width='200' valign='top'></td>
                         <td>
                                 <div class='switch'><input name='wpgmza_settings_remove_api' type='checkbox' class='cmn-toggle cmn-toggle-yes-no' id='wpgmza_settings_remove_api' value='yes' $wpgmza_remove_api_checked /> <label for='wpgmza_settings_remove_api' data-on='".__("Yes", "wp-google-maps")."' data-off='".__("No", "wp-google-maps")."'></label></div> ".__("Do not load the Google Maps API (Only check this if your theme loads the Google Maps API by default)", 'wp-google-maps')."<br />
                        </td>
                    </tr>

                    <tr>
                           <td width='200' valign='top'>".__("Use Google Maps API","wp-google-maps").":</td>
                        <td>
                           <select id='wpgmza_api_version' name='wpgmza_api_version'  >
                               <option value=\"3.25\" ".$wpgmza_api_version_selected[0].">3.25</option>
                               <option value=\"3.26\" ".$wpgmza_api_version_selected[1].">3.26</option>
                               <option value=\"3.exp\" ".$wpgmza_api_version_selected[2].">3.exp</option>

                            </select>    
                       </td>
                   </tr>
            <tr>
                    <td width='200' valign='top'>".__("Lowest level of access to the map editor","wp-google-maps").":</td>
                 <td>
                    <select id='wpgmza_access_level' name='wpgmza_access_level'  >
                                <option value=\"manage_options\" ".$wpgmza_access_level_checked[0].">Admin</option>
                                <option value=\"edit_pages\" ".$wpgmza_access_level_checked[1].">Editor</option>
                                <option value=\"publish_posts\" ".$wpgmza_access_level_checked[2].">Author</option>
                                <option value=\"edit_posts\" ".$wpgmza_access_level_checked[3].">Contributor</option>
                                <option value=\"read\" ".$wpgmza_access_level_checked[4].">Subscriber</option>
                    </select>    
                </td>
            </tr>
                    <tr>
                         <td width='400'>".__("Retina Icon Width","wp-google-maps").":</td>
                         <td><input id='wpgmza_settings_retina_width' name='wpgmza_settings_retina_width' type='text' size='4' maxlength='4' value='$wpgmza_settings_retina_width' /> px </td>
                    </tr>
                    <tr>
                         <td>".__("Retina Icon Height","wp-google-maps").":</td>
                         <td><input id='wpgmza_settings_retina_height' name='wpgmza_settings_retina_height' type='text' size='4' maxlength='4' value='$wpgmza_settings_retina_height' /> px </td>
                    </tr> 

		            <tr>
		            	<td width='200' valign='top'>".__("Disable Two-Finger Pan","wp-google-maps").":</td>
		           		<td>
		            		<div class='switch'><input name='wpgmza_force_greedy_gestures' type='checkbox' class='cmn-toggle cmn-toggle-yes-no' id='wpgmza_force_greedy_gestures' value='yes' $wpgmza_force_greedy_gestures_checked /> <label for='wpgmza_force_greedy_gestures' data-on='".__("Yes", "wp-google-maps")."' data-off='".__("No", "wp-google-maps")."'></label></div> " . __("Removes the need to use two fingers to move the map on mobile devices", "wp-google-maps") . "
		               </td>
		            </tr>           
                    
                </table>
                ".apply_filters("wpgooglemaps_map_settings_output_bottom","",$wpgmza_settings)."
                
            ";




    }

    if ($section == "infowindow") {
        $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");

        if (isset($wpgmza_settings['wpgmza_settings_image_width'])) { $wpgmza_set_img_width = $wpgmza_settings['wpgmza_settings_image_width']; }
        if (isset($wpgmza_settings['wpgmza_settings_image_height'])) { $wpgmza_set_img_height = $wpgmza_settings['wpgmza_settings_image_height']; }
        if (isset($wpgmza_settings['wpgmza_settings_infowindow_links'])) { $wpgmza_settings_infowindow_links = $wpgmza_settings['wpgmza_settings_infowindow_links']; }
        if (isset($wpgmza_settings['wpgmza_settings_infowindow_address'])) { $wpgmza_settings_infowindow_address = $wpgmza_settings['wpgmza_settings_infowindow_address']; }
        if (isset($wpgmza_settings['wpgmza_settings_infowindow_link_text'])) { $wpgmza_link_text = $wpgmza_settings['wpgmza_settings_infowindow_link_text']; } else { $wpgmza_link_text = false; }

        if (isset($wpgmza_settings['wpgmza_settings_image_resizing'])) { $wpgmza_set_resize_img = $wpgmza_settings['wpgmza_settings_image_resizing']; }
        /**
         * Deprecated in 6.09
         * if (isset($wpgmza_settings['wpgmza_settings_use_timthumb'])) { $wpgmza_set_use_timthumb = $wpgmza_settings['wpgmza_settings_use_timthumb']; }
         */
        
        
        if (!$wpgmza_link_text) { $wpgmza_link_text = __("More details","wp-google-maps"); }
        
        if (isset($wpgmza_settings['wpgmza_settings_infowindow_width'])) { $wpgmza_settings_infowindow_width = $wpgmza_settings['wpgmza_settings_infowindow_width'];} else { $wpgmza_settings_infowindow_width = ""; }

        if (isset($wpgmza_set_resize_img) && $wpgmza_set_resize_img == "yes") { $wpgmza_resizechecked = "checked='checked'"; } else { $wpgmza_resizechecked = ""; }
		/**
		 * Deprecated in 6.09
		 * if (isset($wpgmza_set_use_timthumb) && $wpgmza_set_use_timthumb == "yes") { $wpgmza_timchecked = "checked='checked'";  } else { $wpgmza_timchecked = ""; }
		 */


		if (isset($wpgmza_settings['wpgmza_iw_type'])) { $infowwindow_sel_checked[$wpgmza_settings['wpgmza_iw_type']] = "checked"; $wpgmza_iw_class[$wpgmza_settings['wpgmza_iw_type']] = "wpgmza_mlist_selection_activate"; } else {  $wpgmza_iw_type = false; }



		for ($i=0;$i<5;$i++) {
            if (!isset($wpgmza_iw_class[$i])) { $wpgmza_iw_class[$i] = ""; }
        }
		for ($i=0;$i<5;$i++) {
            if (!isset($infowwindow_sel_checked[$i])) { $infowwindow_sel_checked[$i] = ""; }
        }	

        if ($infowwindow_sel_checked[0] == "checked") {
        	$infowwindow_sel_text = __("Default Infowindow","wp-google-maps");
        } else if ($infowwindow_sel_checked[1] == "checked") {
        	$infowwindow_sel_text = __("Modern Infowindow","wp-google-maps");
        }else if ($infowwindow_sel_checked[2] == "checked") {
        	$infowwindow_sel_text = __("Modern Plus Infowindow","wp-google-maps");
        }else if ($infowwindow_sel_checked[3] == "checked") {
        	$infowwindow_sel_text = __("Circular Infowindow","wp-google-maps");
        } else if ($infowwindow_sel_checked[4] == "checked") {
        	$infowwindow_sel_text = __("No Global Setting","wp-google-maps");
        } else {
        	$infowwindow_sel_text = __("No Global Setting","wp-google-maps");
        }




        if (!isset($wpgmza_set_img_width) || $wpgmza_set_img_width == "") { $wpgmza_set_img_width = ""; }
        if (!isset($wpgmza_set_img_height) || $wpgmza_set_img_height == "" ) { $wpgmza_set_img_height = ""; }
        if (!isset($wpgmza_settings_infowindow_width) || $wpgmza_settings_infowindow_width == "") { $wpgmza_settings_infowindow_width = ""; }
        if (isset($wpgmza_settings_infowindow_links) && $wpgmza_settings_infowindow_links == "yes") { $wpgmza_linkschecked = "checked='checked'"; } else { $wpgmza_linkschecked = ""; }
        if (isset($wpgmza_settings_infowindow_address) && $wpgmza_settings_infowindow_address == "yes") { $wpgmza_addresschecked = "checked='checked'"; } else { $wpgmza_addresschecked = ""; }

        return "
                <h3>".__("InfoWindow Settings","wp-google-maps")."</h3>

				<table class=\"form-table\"><form method=\"post\"></form>
				    <tbody>
				    	<tr>
					        <th>
					        	<label for=\"\">".__("Infowindow Style","wp-google-maps")."</label>
				        	</th>
					        <td>          
					            <img src=\"".WPGMAPS_DIR."/images/marker_iw_type_1.png\" title=\"Default\" id=\"wpgmza_iw_selection_1\" width=\"250\" class=\"wpgmza_mlist_selection ".$wpgmza_iw_class[0]."\">     
					            <img src=\"".WPGMAPS_DIR."/images/marker_iw_type_2.png\" title=\"Modern\" id=\"wpgmza_iw_selection_2\" width=\"250\" class=\"wpgmza_mlist_selection ".$wpgmza_iw_class[1]."\"> 
					            <img src=\"".WPGMAPS_DIR."/images/marker_iw_type_3.png\" title=\"Plus\" id=\"wpgmza_iw_selection_3\" width=\"250\" class=\"wpgmza_mlist_selection ".$wpgmza_iw_class[2]."\">   
					            <img src=\"".WPGMAPS_DIR."/images/marker_iw_type_4.png\" title=\"Circular\" id=\"wpgmza_iw_selection_4\" width=\"250\" class=\"wpgmza_mlist_selection ".$wpgmza_iw_class[3]."\">       
					            <img src=\"".WPGMAPS_DIR."/images/marker_iw_type_null.png\" title=\"No Global\" id=\"wpgmza_iw_selection_null\" width=\"250\" class=\"wpgmza_mlist_selection ".$wpgmza_iw_class[4]."\">
                                <input type=\"radio\" name=\"wpgmza_iw_type\" id=\"rb_wpgmza_iw_selection_1\" value=\"0\" ".$infowwindow_sel_checked[0]." class=\"sola_t_hide_input\">
                                <input type=\"radio\" name=\"wpgmza_iw_type\" id=\"rb_wpgmza_iw_selection_2\" value=\"1\" ".$infowwindow_sel_checked[1]." class=\"sola_t_hide_input\">
                                <input type=\"radio\" name=\"wpgmza_iw_type\" id=\"rb_wpgmza_iw_selection_3\" value=\"2\" ".$infowwindow_sel_checked[2]." class=\"sola_t_hide_input\">
                                <input type=\"radio\" name=\"wpgmza_iw_type\" id=\"rb_wpgmza_iw_selection_4\" value=\"3\" ".$infowwindow_sel_checked[3]." class=\"sola_t_hide_input\">
                                <input type=\"radio\" name=\"wpgmza_iw_type\" id=\"rb_wpgmza_iw_selection_null\" value=\"-1\" ".$infowwindow_sel_checked[4]." class=\"sola_t_hide_input\">
					        </td>
				    	</tr>
				    	<tr>
					        <th>
					        	&nbsp;
				        	</th>
					        <td>     
					       	 ".__("Your selection:","wp-google-maps")."   
					            <span class=\"wpgmza_iw_sel_text\" style=\"font-weight:bold;\">".$infowwindow_sel_text."</span>
					        </td>
				    	</tr>
				    </table>


                <table class='form-table'>
                    <tr>
                         <td>".__("Resize Images","wp-google-maps").":</td>
                         <td>
                                <div class='switch'><input name='wpgmza_settings_image_resizing' class='cmn-toggle cmn-toggle-round-flat' type='checkbox' id='wpgmza_settings_image_resizing' value='yes' $wpgmza_resizechecked /> <label for='wpgmza_settings_image_resizing'></label></div> ".__("Resize all images to the below sizes","wp-google-maps")."
                        </td>
                    </tr>
                    <tr>
                         <td width='200'>".__("Default Image Width","wp-google-maps").":</td>
                         <td><input id='wpgmza_settings_image_width' name='wpgmza_settings_image_width' type='text' size='4' maxlength='4' value='$wpgmza_set_img_width' /> px  <em>".__("(can be left blank - max width will be limited to max infowindow width)","wp-google-maps")."</em></td>
                    </tr>
                    <tr>
                         <td>".__("Default Image Height","wp-google-maps").":</td>
                         <td><input id='wpgmza_settings_image_height' name='wpgmza_settings_image_height' type='text' size='4' maxlength='4' value='$wpgmza_set_img_height' /> px <em>".__("(can be left blank - leaving both the width and height blank will revert to full size images being used)","wp-google-maps")."</em></td>
                    </tr>
                    <tr>
                         <td>".__("Max InfoWindow Width","wp-google-maps").":</td>
                         <td><input id='wpgmza_settings_infowindow_width' name='wpgmza_settings_infowindow_width' type='text' size='4' maxlength='4' value='$wpgmza_settings_infowindow_width' /> px <em>".__("(Minimum: 200px)","wp-google-maps")."</em></td>
                    </tr>
                    <tr>
                         <td>".__("Other settings","wp-google-maps").":</td>
                         <td>
                                <div class='switch'><input name='wpgmza_settings_infowindow_links' class='cmn-toggle cmn-toggle-round-flat' type='checkbox' id='wpgmza_settings_infowindow_links' value='yes' $wpgmza_linkschecked /> <label for='wpgmza_settings_infowindow_links'></label></div>".__("Open links in a new window","wp-google-maps")." <em>
                                ".__("(Tick this if you want to open your links in a new window)","wp-google-maps")."</em>
                                <br /><div class='switch'><input name='wpgmza_settings_infowindow_address' class='cmn-toggle cmn-toggle-round-flat' type='checkbox' id='wpgmza_settings_infowindow_address' value='yes' $wpgmza_addresschecked /> <label for='wpgmza_settings_infowindow_address'></label></div>".__("Hide the address field","wp-google-maps")."<br />
                        </td>
                    </tr>
                    <tr>
                         <td>".__("Link text","wp-google-maps").":</td>
                         <td>
                                <input name='wpgmza_settings_infowindow_link_text' type='text' id='wpgmza_settings_infowindow_link_text' value='$wpgmza_link_text' /> 
                        </td>
                    </tr>

                </table>
                <br /><br />
        ";


    }
}
function wpgmza_version_check() {


	if (isset($_GET['wpgmza_tc']) && $_GET['wpgmza_tc'] == '1') {
		update_option('wpgmza_timthumb_check',true);
	}

	/* warn them about the impending timthumb removal */
	$wpgmza_checker = get_option('wpgmza_timthumb_check');

    global $wpgmza_version;
    $wpgmza_vc = floatval(str_replace(".","",$wpgmza_version));
    
    if ($wpgmza_vc < 615) {
		
    }
}
function wpgmaps_head_pro() {
    global $wpgmza_tblname_maps;
    if (isset($_POST['wpgmza_savemap'])){
        global $wpdb;


        $map_id = esc_attr($_POST['wpgmza_id']);
        $map_title = esc_attr($_POST['wpgmza_title']);
        $map_height = esc_attr($_POST['wpgmza_height']);
        $map_width = esc_attr($_POST['wpgmza_width']);


        $map_width_type = esc_attr($_POST['wpgmza_map_width_type']);
        if ($map_width_type == "%") { $map_width_type = "\%"; }
        $map_height_type = esc_attr($_POST['wpgmza_map_height_type']);
        if ($map_height_type == "%") { $map_height_type = "\%"; }
        $map_start_location = esc_attr($_POST['wpgmza_start_location']);
        if (isset($_POST['wpgmza_start_zoom'])) { $map_start_zoom = intval($_POST['wpgmza_start_zoom']); } else { $map_start_zoom = ""; }
        $type = intval($_POST['wpgmza_map_type']);
        $alignment = intval($_POST['wpgmza_map_align']);
        $order_markers_by = intval($_POST['wpgmza_order_markers_by']);
        $order_markers_choice = intval($_POST['wpgmza_order_markers_choice']);
        $show_user_location = isset($_POST['wpgmza_show_user_location']) ? 1 : 2;
        
        $directions_enabled = isset($_POST['wpgmza_directions']) ? 1 : 2;
        
        $bicycle_enabled = isset($_POST['wpgmza_bicycle']) ? 1 : 2;
        $traffic_enabled = isset($_POST['wpgmza_traffic']) ? 1 : 2;

        $dbox = intval($_POST['wpgmza_dbox']);
        $dbox_width = esc_attr($_POST['wpgmza_dbox_width']);
        $default_to = esc_attr($_POST['wpgmza_default_to']);
        if (isset($_POST['wpgmza_listmarkers'])) { $listmarkers = intval($_POST['wpgmza_listmarkers']); } else { $listmarkers = ""; }
        if (isset($_POST['wpgmza_listmarkers_advanced'])) { $listmarkers_advanced = intval($_POST['wpgmza_listmarkers_advanced']); } else { $listmarkers_advanced = ""; }
        if (isset($_POST['wpgmza_filterbycat'])) { $filterbycat = intval($_POST['wpgmza_filterbycat']); } else { $filterbycat = ""; }

        $other_settings = array();


        
        

        if (isset($_POST['wpgmza_store_locator'])) { $other_settings['store_locator_enabled'] = isset($_POST['wpgmza_store_locator']) ? 1 : 2; }
        if (isset($_POST['wpgmza_store_locator_restrict'])) { $other_settings['wpgmza_store_locator_restrict'] = esc_attr($_POST['wpgmza_store_locator_restrict']); }
        if (isset($_POST['wpgmza_sl_animation'])) { $other_settings['wpgmza_sl_animation'] = esc_attr($_POST['wpgmza_sl_animation']); }
        if (isset($_POST['wpgmza_store_locator_distance'])) { $other_settings['store_locator_distance'] = isset($_POST['wpgmza_store_locator_distance']) ? 1 : 2; }
        if (isset($_POST['wpgmza_store_locator_position'])) { $other_settings['store_locator_below'] = isset($_POST['wpgmza_store_locator_position']) ? 1 : 2; }
        if (isset($_POST['wpgmza_store_locator_bounce'])) { $other_settings['store_locator_bounce'] = isset($_POST['wpgmza_store_locator_bounce']) ? 1 : 2; }
        if (isset($_POST['wpgmza_store_locator_hide_before_search'])) { $other_settings['store_locator_hide_before_search'] = isset($_POST['wpgmza_store_locator_hide_before_search']) ? 1 : 2; }
        if (isset($_POST['wpgmza_store_locator_use_their_location'])) { $other_settings['store_locator_use_their_location'] = isset($_POST['wpgmza_store_locator_use_their_location']) ? 1 : 2; }
        if (isset($_POST['wpgmza_store_locator_name_search'])) { $other_settings['store_locator_name_search'] = isset($_POST['wpgmza_store_locator_name_search']) ? 1 : 2; }
        if (isset($_POST['wpgmza_store_locator_category_enabled'])) { $other_settings['store_locator_category'] = isset($_POST['wpgmza_store_locator_category_enabled']) ? 1 : 2; }
        if (isset($_POST['wpgmza_store_locator_query_string'])) { $other_settings['store_locator_query_string'] = esc_attr($_POST['wpgmza_store_locator_query_string']); }
        if (isset($_POST['wpgmza_store_locator_name_string'])) { $other_settings['store_locator_name_string'] = esc_attr($_POST['wpgmza_store_locator_name_string']); }
        if (isset($_POST['wpgmza_store_locator_default_address'])) { $other_settings['store_locator_default_address'] = sanitize_text_field($_POST['wpgmza_store_locator_default_address']); }

        if (isset($_POST['wpgmza_dbox_width_type'])) { $other_settings['wpgmza_dbox_width_type'] = esc_attr($_POST['wpgmza_dbox_width_type']); }

        if (isset($_POST['wpgmza_marker_listing_position'])) { $other_settings['store_marker_listing_below'] = isset($_POST['wpgmza_marker_listing_position']) ? 1 : 2; }


        $map_max_zoom = intval($_POST['wpgmza_max_zoom']);
        $other_settings['map_max_zoom'] = sanitize_text_field($map_max_zoom);
        $map_min_zoom = intval($_POST['wpgmza_min_zoom']);
        $other_settings['map_min_zoom'] = sanitize_text_field($map_min_zoom);
        $other_settings['sl_stroke_color'] = $_POST['sl_stroke_color'];
        $other_settings['sl_stroke_opacity'] = $_POST['sl_stroke_opacity'];
        $other_settings['sl_fill_color'] = $_POST['sl_fill_color'];
        $other_settings['sl_fill_opacity'] = $_POST['sl_fill_opacity'];
		$other_settings['click_open_link'] = isset($_POST['wpgmza_click_open_link']) ? 1 : 2;
        //$other_settings['weather_layer'] = intval($_POST['wpgmza_weather']);
        //$other_settings['weather_layer_temp_type'] = intval($_POST['wpgmza_weather_temp_type']);
        //$other_settings['cloud_layer'] = intval($_POST['wpgmza_cloud']);
        $other_settings['transport_layer'] = isset($_POST['wpgmza_transport']) ? 1 : 2;


        $other_settings['iw_primary_color'] = $_POST['iw_primary_color'];
        $other_settings['iw_accent_color'] = $_POST['iw_accent_color'];
        $other_settings['iw_text_color'] = $_POST['iw_text_color'];

        if (isset($_POST['wpgmza_iw_type'])) { $other_settings['wpgmza_iw_type'] = $_POST['wpgmza_iw_type']; } else { $other_settings['wpgmza_iw_type'] = "0"; }

        
        if (isset($_POST['wpgmza_listmarkers_by'])) { $other_settings['list_markers_by'] = $_POST['wpgmza_listmarkers_by']; } else { $other_settings['list_markers_by'] = ""; }
        if (isset($_POST['wpgmza_push_in_map'])) { $other_settings['push_in_map'] = $_POST['wpgmza_push_in_map']; } else { $other_settings['push_in_map'] = ""; }
        if (isset($_POST['wpgmza_push_in_map_placement'])) { $other_settings['push_in_map_placement'] = $_POST['wpgmza_push_in_map_placement']; } else { $other_settings['push_in_map_placement'] = ""; }
        if (isset($_POST['wpgmza_push_in_map_width'])) { $other_settings['wpgmza_push_in_map_width'] = esc_attr($_POST['wpgmza_push_in_map_width']); }
        if (isset($_POST['wpgmza_push_in_map_height'])) { $other_settings['wpgmza_push_in_map_height'] = esc_attr($_POST['wpgmza_push_in_map_height']); }

		if (isset($_POST['wpgmza_theme'])) { 
	        $theme = intval(sanitize_text_field($_POST['wpgmza_theme']));
	        $theme_data = sanitize_text_field($_POST['wpgmza_theme_data_'.$theme]);
	        $other_settings['wpgmza_theme_data'] = $theme_data;
	        $other_settings['wpgmza_theme_selection'] = $theme;
    	}
        /* overwrite theme data if a custom theme is selected */
        if (isset($_POST['wpgmza_styling_json'])) { $other_settings['wpgmza_theme_data'] = sanitize_text_field($_POST['wpgmza_styling_json']); }


        $map_default_ul_marker = str_replace('http:', '', $_POST['upload_default_ul_marker']);
        $other_settings['upload_default_ul_marker'] = $map_default_ul_marker;

        $map_default_sl_marker = str_replace('http:', '', $_POST['upload_default_sl_marker']);
        $other_settings['upload_default_sl_marker'] = $map_default_sl_marker;
        

        $other_settings = apply_filters("wpgmza_pro_filter_save_map_other_settings",$other_settings);

        $other_settings_data = maybe_serialize($other_settings);

        
        
        $gps = explode(",",$map_start_location);
        $map_start_lat = $gps[0];
        $map_start_lng = $gps[1];
        $map_default_marker = str_replace('http:', '', $_POST['upload_default_marker']);
        $kml = esc_attr($_POST['wpgmza_kml']);
        $fusion = esc_attr($_POST['wpgmza_fusion']);

        $data['map_default_starting_lat'] = $map_start_lat;
        $data['map_default_starting_lng'] = $map_start_lng;
        $data['map_default_height'] = $map_height;
        $data['map_default_width'] = $map_width;
        $data['map_default_zoom'] = $map_start_zoom;
        $data['map_default_max_zoom'] = $map_max_zoom;
        $data['map_default_min_zoom'] = $map_min_zoom;
        $data['map_default_type'] = $type;
        $data['map_default_alignment'] = $alignment;
        $data['map_default_order_markers_by'] = $order_markers_by;
        $data['map_default_order_markers_choice'] = $order_markers_choice;
        $data['map_default_show_user_location'] = $show_user_location;
        $data['map_default_directions'] = $directions_enabled;
        $data['map_default_bicycle'] = $bicycle_enabled;
        $data['map_default_traffic'] = $traffic_enabled;
        $data['map_default_dbox'] = $dbox;
        $data['map_default_dbox_width'] = $dbox_width;
        $data['map_default_default_to'] = $default_to;
        $data['map_default_listmarkers'] = $listmarkers;
        $data['map_default_listmarkers_advanced'] = $listmarkers_advanced;
        $data['map_default_filterbycat'] = $filterbycat;
        $data['map_default_marker'] = $map_default_marker;
        $data['map_default_ul_marker'] = $map_default_ul_marker;
        $data['map_default_sl_marker'] = $map_default_sl_marker;
        $data['map_default_width_type'] = $map_width_type;
        $data['map_default_height_type'] = $map_height_type;





        $rows_affected = $wpdb->query( $wpdb->prepare(
                "UPDATE $wpgmza_tblname_maps SET
                map_title = %s,
                map_width = %s,
                map_height = %s,
                map_start_lat = %f,
                map_start_lng = %f,
                map_start_location = %s,
                map_start_zoom = %d,
                default_marker = %s,
                type = %d,
                alignment = %d,
                order_markers_by = %d,
                order_markers_choice = %d,
                show_user_location = %d,
                directions_enabled = %d,
                kml = %s,
                bicycle = %d,
                traffic = %d,
                dbox = %d,
                dbox_width = %s,
                default_to = %s,
                listmarkers = %d,
                listmarkers_advanced = %d,
                filterbycat = %d,
                fusion = %s,
                map_width_type = %s,
                map_height_type = %s,
                other_settings = %s
                WHERE id = %d",

                $map_title,
                $map_width,
                $map_height,
                $map_start_lat,
                $map_start_lng,
                $map_start_location,
                $map_start_zoom,
                $map_default_marker,
                $type,
                $alignment,
                $order_markers_by,
                $order_markers_choice,
                $show_user_location,
                $directions_enabled,
                $kml,
                $bicycle_enabled,
                $traffic_enabled,
                $dbox,
                $dbox_width,
                $default_to,
                $listmarkers,
                $listmarkers_advanced,
                $filterbycat,
                $fusion,
                $map_width_type,
                $map_height_type,
                $other_settings_data,
                $map_id)
        );

        //echo $wpdb->print_error();


        update_option('WPGMZA_SETTINGS', $data);
        do_action("wpgooglemaps_hook_save_map",$map_id);


        echo "<div class='updated'>";
        _e("Your settings have been saved.","wp-google-maps");
        echo "</div>";

        if( function_exists( 'wpgmza_caching_notice_changes' ) ){
        	add_action( 'admin_notices', 'wpgmza_caching_notice_changes' );
        }

    }

    else if (isset($_POST['wpgmza_save_maker_location'])){
        global $wpdb;
        global $wpgmza_tblname;
        $mid = esc_attr($_POST['wpgmaps_marker_id']);
        $wpgmaps_marker_lat = esc_attr($_POST['wpgmaps_marker_lat']);
        $wpgmaps_marker_lng = esc_attr($_POST['wpgmaps_marker_lng']);

        $rows_affected = $wpdb->query( $wpdb->prepare(
                "UPDATE $wpgmza_tblname SET
                lat = %s,
                lng = %s
                WHERE id = %d",

                $wpgmaps_marker_lat,
                $wpgmaps_marker_lng,
                $mid)
        );





        //update_option('WPGMZA', $data);
        echo "<div class='updated'>";
        _e("Your marker location has been saved.","wp-google-maps");
        echo "</div>";


    }
    else if (isset($_POST['wpgmza_save_poly'])){
        global $wpdb;
        global $wpgmza_tblname_poly;
         if (!isset($_POST['wpgmza_polygon']) || $_POST['wpgmza_polygon'] == "") {
            echo "<div class='error'>";
            _e("You cannot save a blank polygon","wp-google-maps");
            echo "</div>";
            
        } else {
        
	        $mid = esc_attr($_POST['wpgmaps_map_id']);
	        $wpgmaps_polydata = esc_attr($_POST['wpgmza_polygon']);
	        $linecolor = esc_attr($_POST['poly_line']);
	        $fillcolor = esc_attr($_POST['poly_fill']);
	        $polyname = esc_attr($_POST['poly_name']);
	        $line_opacity = esc_attr($_POST['poly_line_opacity']);
	        if (!isset ($line_opacity) || $line_opacity == "" ) { $line_opacity = "1"; }
	        $opacity = esc_attr($_POST['poly_opacity']);
	        $ohlinecolor = esc_attr($_POST['poly_line_hover_line_color']);
	        $ohfillcolor = esc_attr($_POST['poly_hover_fill_color']);
	        $ohopacity = esc_attr($_POST['poly_hover_opacity']);
	        $title = esc_attr($_POST['poly_title']);
	        $link = esc_attr($_POST['poly_link']);

	        $rows_affected = $wpdb->query( $wpdb->prepare(
	                "INSERT INTO $wpgmza_tblname_poly SET
	                map_id = %d,
	                polydata = %s,
	                polyname = %s,
	                linecolor = %s,
	                lineopacity = %s,
	                fillcolor = %s,
	                opacity = %s,
	                ohlinecolor = %s,
	                ohfillcolor = %s,
	                ohopacity = %s,
	                title = %s,
	                link = %s
	                ",

	                $mid,
	                $wpgmaps_polydata,
	                $polyname,
	                $linecolor,
	                $line_opacity,
	                $fillcolor,
	                $opacity,
	                $ohlinecolor,
	                $ohfillcolor,
	                $ohopacity,
	                $title,
	                $link
	            )
	        );

	        echo "<div class='updated'>";
	        _e("Your polygon has been created.","wp-google-maps");
	        echo "</div>";
	    }


    }
    else if (isset($_POST['wpgmza_edit_poly'])){
        global $wpdb;
        global $wpgmza_tblname_poly;
        
        if (!isset($_POST['wpgmza_polygon']) || $_POST['wpgmza_polygon'] == "") {
            echo "<div class='error'>";
            _e("You cannot save a blank polygon","wp-google-maps");
            echo "</div>";
    
        } else {
        
	        $mid = esc_attr($_POST['wpgmaps_map_id']);
	        $pid = esc_attr($_POST['wpgmaps_poly_id']);
	        $wpgmaps_polydata = esc_attr($_POST['wpgmza_polygon']);
	        
	        
	        $polyname = esc_attr($_POST['poly_name']);
	        $linecolor = esc_attr($_POST['poly_line']);
	        $fillcolor = esc_attr($_POST['poly_fill']);
	        $line_opacity = esc_attr($_POST['poly_line_opacity']);
	        if (!isset ($line_opacity) || $line_opacity == "" ) { $line_opacity = "1"; }
	        $opacity = esc_attr($_POST['poly_opacity']);
	        $ohlinecolor = esc_attr($_POST['poly_line_hover_line_color']);
	        $ohfillcolor = esc_attr($_POST['poly_hover_fill_color']);
	        $ohopacity = esc_attr($_POST['poly_hover_opacity']);
	        $title = esc_attr($_POST['poly_title']);
	        $link = esc_attr($_POST['poly_link']);

	        $rows_affected = $wpdb->query( $wpdb->prepare(
	                "UPDATE $wpgmza_tblname_poly SET
	                polydata = %s,
	                polyname = %s,
	                linecolor = %s,
	                lineopacity = %s,
	                fillcolor = %s,
	                opacity = %s,
	                ohlinecolor = %s,
	                ohfillcolor = %s,
	                ohopacity = %s,
	                title = %s,
	                link = %s
	                WHERE `id` = %d"
	                ,

	                $wpgmaps_polydata,
	                $polyname,
	                $linecolor,
	                $line_opacity,
	                $fillcolor,
	                $opacity,
	                $ohlinecolor,
	                $ohfillcolor,
	                $ohopacity,
	                $title,
	                $link,
	                $pid
	            )
	        );
	        
	        echo "<div class='updated'>";
	        _e("Your polygon has been saved.","wp-google-maps");
	        echo "</div>";
	    }


    }
    else if (isset($_POST['wpgmza_save_polyline'])){
        global $wpdb;
        global $wpgmza_tblname_polylines;
        if (!isset($_POST['wpgmza_polyline']) || $_POST['wpgmza_polyline'] == "") {
            echo "<div class='error'>";
            _e("You cannot save a blank polyline","wp-google-maps");
            echo "</div>";
    
        } else {        
	        $mid = esc_attr($_POST['wpgmaps_map_id']);
	        $wpgmaps_polydata = esc_attr($_POST['wpgmza_polyline']);
	        $polyname = esc_attr($_POST['poly_name']);
	        $linecolor = esc_attr($_POST['poly_line']);
	        $linethickness = esc_attr($_POST['poly_thickness']);
	        $opacity = esc_attr($_POST['poly_opacity']);

	        $rows_affected = $wpdb->query( $wpdb->prepare(
	                "INSERT INTO $wpgmza_tblname_polylines SET
	                map_id = %d,
	                polydata = %s,
	                polyname = %s,
	                linecolor = %s,
	                linethickness = %s,
	                opacity = %s
	                ",

	                $mid,
	                $wpgmaps_polydata,
	                $polyname,
	                $linecolor,
	                $linethickness,
	                $opacity
	            )
	        );
	        echo "<div class='updated'>";
	        _e("Your polyline has been created.","wp-google-maps");
	        echo "</div>";
	    }


    }
    else if (isset($_POST['wpgmza_edit_polyline'])){
        global $wpdb;
        global $wpgmza_tblname_polylines;
        if (!isset($_POST['wpgmza_polyline']) || $_POST['wpgmza_polyline'] == "") {
            echo "<div class='error'>";
            _e("You cannot save a blank polyline","wp-google-maps");
            echo "</div>";
    
        } else {        
	        $mid = esc_attr($_POST['wpgmaps_map_id']);
	        $pid = esc_attr($_POST['wpgmaps_poly_id']);
	        $polyname = esc_attr($_POST['poly_name']);
	        $wpgmaps_polydata = esc_attr($_POST['wpgmza_polyline']);
	        $linecolor = esc_attr($_POST['poly_line']);
	        $linethickness = esc_attr($_POST['poly_thickness']);
	        $opacity = esc_attr($_POST['poly_opacity']);

	        $rows_affected = $wpdb->query( $wpdb->prepare(
	                "UPDATE $wpgmza_tblname_polylines SET
	                polydata = %s,
	                polyname = %s,
	                linecolor = %s,
	                linethickness = %s,
	                opacity = %s
	                WHERE `id` = %d"
	                ,

	                $wpgmaps_polydata,
	                $polyname,
	                $linecolor,
	                $linethickness,
	                $opacity,
	                $pid
	            )
	        );
	        echo "<div class='updated'>";
	        _e("Your polyline has been saved.","wp-google-maps");
	        echo "</div>";
	    }


    }
    else if (isset($_POST['wpgmza_save_heatmap'])){
        global $wpdb;
        global $wpgmza_tblname_datasets;
        
        $mid = esc_attr($_POST['wpgmaps_map_id']);
        $wpgmaps_polydata = esc_attr($_POST['wpgmza_heatmap_data']);
        $wpgmaps_polydata = esc_attr($_POST['wpgmza_heatmap_data']);

        $wpgmaps_polydata = trim($wpgmaps_polydata);
        $wpgmaps_polydata = str_replace("\r\n", "", $wpgmaps_polydata); // windows -> unix
		$wpgmaps_polydata = str_replace("\r", "", $wpgmaps_polydata);   // remaining -> unix


		$dataset_option = array(
			'poly_name' => esc_attr($_POST['poly_name']),
			'heatmap_opacity' => esc_attr($_POST['heatmap_opacity']),
			'heatmap_radius' => esc_attr($_POST['heatmap_radius']),
			'heatmap_gradient' => esc_attr($_POST['heatmap_gradient'])
		);

        $polyname = esc_attr($_POST['poly_name']);
        $rows_affected = $wpdb->query( $wpdb->prepare(
                "INSERT INTO $wpgmza_tblname_datasets SET
                `map_id` = %d,
                `dataset` = %s,
                `dataset_name` = %s,
                `options` = %s
                ",

                $mid,
                $wpgmaps_polydata,
                $polyname,
                maybe_serialize($dataset_option)

        )
        );

        echo "<div class='updated'>";
        _e("Your dataset has been created.","wp-google-maps");
        echo "</div>";


    }
    else if (isset($_POST['wpgmza_edit_heatmap'])){
        global $wpdb;
        global $wpgmza_tblname_datasets;
        
        
        
        $mid = esc_attr($_POST['wpgmaps_map_id']);
        $pid = esc_attr($_POST['wpgmaps_poly_id']);
        $wpgmaps_polydata = esc_attr($_POST['wpgmza_heatmap_data']);
        $wpgmaps_polydata = trim($wpgmaps_polydata);
        $wpgmaps_polydata = str_replace("\r\n", "", $wpgmaps_polydata); // windows -> unix
		$wpgmaps_polydata = str_replace("\r", "", $wpgmaps_polydata);   // remaining -> unix

		$dataset_option = array(
			'poly_name' => esc_attr($_POST['poly_name']),
			'heatmap_opacity' => esc_attr($_POST['heatmap_opacity']),
			'heatmap_radius' => esc_attr($_POST['heatmap_radius']),
			'heatmap_gradient' => esc_attr($_POST['heatmap_gradient'])
		);

        

        $polyname = esc_attr($_POST['poly_name']);

        $rows_affected = $wpdb->query( $wpdb->prepare(
                "UPDATE $wpgmza_tblname_datasets SET
                `dataset` = %s,
                `dataset_name` = %s,
                `options` = %s
                WHERE `id` = %d"
                ,

                trim($wpgmaps_polydata),
                $polyname,
                maybe_serialize($dataset_option),
                $pid
            )
        );
        
        echo "<div class='updated'>";
        _e("Your dataset has been saved.","wp-google-maps");
        echo "</div>";


    }
    else if (isset($_POST['wpgmza_save_settings'])){
        global $wpdb;
        if (isset($_POST['wpgmza_settings_image_resizing'])) { $wpgmza_data['wpgmza_settings_image_resizing'] = esc_attr($_POST['wpgmza_settings_image_resizing']); } else { $wpgmza_data['wpgmza_settings_image_resizing'] = 'no'; }
        if (isset($_POST['wpgmza_settings_image_width'])) { $wpgmza_data['wpgmza_settings_image_width'] = esc_attr($_POST['wpgmza_settings_image_width']); } else { $wpgmza_data['wpgmza_settings_image_width'] = ""; }
        if (isset($_POST['wpgmza_settings_image_height'])) { $wpgmza_data['wpgmza_settings_image_height'] = esc_attr($_POST['wpgmza_settings_image_height']); } else { $wpgmza_data['wpgmza_settings_image_height'] = ""; }
        /**
         * Deprecated in 6.09
         * if (isset($_POST['wpgmza_settings_use_timthumb'])) { $wpgmza_data['wpgmza_settings_use_timthumb'] = esc_attr($_POST['wpgmza_settings_use_timthumb']); }
         */
        if (isset($_POST['wpgmza_settings_infowindow_width'])) { $wpgmza_data['wpgmza_settings_infowindow_width'] = esc_attr($_POST['wpgmza_settings_infowindow_width']); }
        if (isset($_POST['wpgmza_settings_infowindow_links'])) { $wpgmza_data['wpgmza_settings_infowindow_links'] = esc_attr($_POST['wpgmza_settings_infowindow_links']); }
        if (isset($_POST['wpgmza_settings_infowindow_address'])) { $wpgmza_data['wpgmza_settings_infowindow_address'] = esc_attr($_POST['wpgmza_settings_infowindow_address']); }
        if (isset($_POST['wpgmza_settings_infowindow_link_text'])) { $wpgmza_data['wpgmza_settings_infowindow_link_text'] = esc_attr($_POST['wpgmza_settings_infowindow_link_text']); }
        if (isset($_POST['wpgmza_settings_map_full_screen_control'])) { $wpgmza_data['wpgmza_settings_map_full_screen_control'] = esc_attr($_POST['wpgmza_settings_map_full_screen_control']); }
        if (isset($_POST['wpgmza_settings_map_streetview'])) { $wpgmza_data['wpgmza_settings_map_streetview'] = esc_attr($_POST['wpgmza_settings_map_streetview']); }
        if (isset($_POST['wpgmza_settings_map_zoom'])) { $wpgmza_data['wpgmza_settings_map_zoom'] = esc_attr($_POST['wpgmza_settings_map_zoom']); }
        if (isset($_POST['wpgmza_settings_map_pan'])) { $wpgmza_data['wpgmza_settings_map_pan'] = esc_attr($_POST['wpgmza_settings_map_pan']); }
        if (isset($_POST['wpgmza_settings_map_type'])) { $wpgmza_data['wpgmza_settings_map_type'] = esc_attr($_POST['wpgmza_settings_map_type']); }
        if (isset($_POST['wpgmza_settings_map_scroll'])) { $wpgmza_data['wpgmza_settings_map_scroll'] = esc_attr($_POST['wpgmza_settings_map_scroll']); }
        if (isset($_POST['wpgmza_settings_map_draggable'])) { $wpgmza_data['wpgmza_settings_map_draggable'] = esc_attr($_POST['wpgmza_settings_map_draggable']); }
        if (isset($_POST['wpgmza_settings_map_clickzoom'])) { $wpgmza_data['wpgmza_settings_map_clickzoom'] = esc_attr($_POST['wpgmza_settings_map_clickzoom']); }
        if (isset($_POST['wpgmza_settings_cat_display_qty'])) { $wpgmza_data['wpgmza_settings_cat_display_qty'] = esc_attr($_POST['wpgmza_settings_cat_display_qty']); }
        if (isset($_POST['wpgmza_settings_map_striptags'])) { $wpgmza_data['wpgmza_settings_ugm_striptags'] = esc_attr($_POST['wpgmza_settings_map_striptags']); } else { $wpgmza_data['wpgmza_settings_map_striptags'] = '0'; }
        if (isset($_POST['wpgmza_settings_ugm_autoapprove'])) { $wpgmza_data['wpgmza_settings_ugm_autoapprove'] = esc_attr($_POST['wpgmza_settings_ugm_autoapprove']); } else { $wpgmza_data['wpgmza_settings_ugm_autoapprove'] = '0'; }
        if (isset($_POST['wpgmza_settings_ugm_email_new_marker'])) { $wpgmza_data['wpgmza_settings_ugm_email_new_marker'] = esc_attr($_POST['wpgmza_settings_ugm_email_new_marker']); } else { $wpgmza_data['wpgmza_settings_ugm_email_new_marker'] = '0'; }
        if (isset($_POST['wpgmza_settings_ugm_email_address'])) { $wpgmza_data['wpgmza_settings_ugm_email_address'] = esc_attr($_POST['wpgmza_settings_ugm_email_address']); } else { $wpgmza_data['wpgmza_settings_ugm_email_address'] = get_option('admin_email'); }
        if (isset($_POST['wpgmza_settings_force_jquery'])) { $wpgmza_data['wpgmza_settings_force_jquery'] = esc_attr($_POST['wpgmza_settings_force_jquery']); }
        if (isset($_POST['wpgmza_settings_remove_api'])) { $wpgmza_data['wpgmza_settings_remove_api'] = esc_attr($_POST['wpgmza_settings_remove_api']); }
        if (isset($_POST['wpgmza_force_greedy_gestures'])) { $wpgmza_data['wpgmza_force_greedy_gestures'] = esc_attr($_POST['wpgmza_force_greedy_gestures']); }
        
        if (isset($_POST['wpgmza_settings_markerlist_category'])) { $wpgmza_data['wpgmza_settings_markerlist_category'] = esc_attr($_POST['wpgmza_settings_markerlist_category']); }
        if (isset($_POST['wpgmza_settings_markerlist_icon'])) { $wpgmza_data['wpgmza_settings_markerlist_icon'] = esc_attr($_POST['wpgmza_settings_markerlist_icon']); }
        if (isset($_POST['wpgmza_settings_markerlist_title'])) { $wpgmza_data['wpgmza_settings_markerlist_title'] = esc_attr($_POST['wpgmza_settings_markerlist_title']); }
        if (isset($_POST['wpgmza_settings_markerlist_address'])) { $wpgmza_data['wpgmza_settings_markerlist_address'] = esc_attr($_POST['wpgmza_settings_markerlist_address']); }
        if (isset($_POST['wpgmza_settings_markerlist_description'])) { $wpgmza_data['wpgmza_settings_markerlist_description'] = esc_attr($_POST['wpgmza_settings_markerlist_description']); }
        if (isset($_POST['wpgmza_custom_css'])) { $wpgmza_data['wpgmza_custom_css'] = esc_attr($_POST['wpgmza_custom_css']); }
        if (isset($_POST['wpgmza_settings_carousel_markerlist_image'])) { $wpgmza_data['wpgmza_settings_carousel_markerlist_image'] = esc_attr($_POST['wpgmza_settings_carousel_markerlist_image']); }
        if (isset($_POST['wpgmza_settings_carousel_markerlist_title'])) { $wpgmza_data['wpgmza_settings_carousel_markerlist_title'] = esc_attr($_POST['wpgmza_settings_carousel_markerlist_title']); }
        if (isset($_POST['wpgmza_settings_carousel_markerlist_icon'])) { $wpgmza_data['wpgmza_settings_carousel_markerlist_icon'] = esc_attr($_POST['wpgmza_settings_carousel_markerlist_icon']); }
        if (isset($_POST['wpgmza_settings_carousel_markerlist_address'])) { $wpgmza_data['wpgmza_settings_carousel_markerlist_address'] = esc_attr($_POST['wpgmza_settings_carousel_markerlist_address']); }
        if (isset($_POST['wpgmza_settings_carousel_markerlist_description'])) { $wpgmza_data['wpgmza_settings_carousel_markerlist_description'] = esc_attr($_POST['wpgmza_settings_carousel_markerlist_description']); }
        if (isset($_POST['wpgmza_settings_carousel_markerlist_marker_link'])) { $wpgmza_data['wpgmza_settings_carousel_markerlist_marker_link'] = esc_attr($_POST['wpgmza_settings_carousel_markerlist_marker_link']); }
        if (isset($_POST['wpgmza_settings_carousel_markerlist_directions'])) { $wpgmza_data['wpgmza_settings_carousel_markerlist_directions'] = esc_attr($_POST['wpgmza_settings_carousel_markerlist_directions']); }
        /**
         * Deprecated in 6.09
         * if (isset($_POST['wpgmza_settings_carousel_markerlist_resize_image'])) { $wpgmza_data['wpgmza_settings_carousel_markerlist_resize_image'] = esc_attr($_POST['wpgmza_settings_carousel_markerlist_resize_image']); } *
         */
        
        if (isset($_POST['wpgmza_settings_carousel_markerlist_theme'])) { $wpgmza_data['wpgmza_settings_carousel_markerlist_theme'] = esc_attr($_POST['wpgmza_settings_carousel_markerlist_theme']); }
        if (isset($_POST['wpgmza_default_items'])) { $wpgmza_data['wpgmza_default_items'] = esc_attr($_POST['wpgmza_default_items']); }

        if (isset($_POST['carousel_items'])) { $wpgmza_data['carousel_items'] = esc_attr($_POST['carousel_items']); }
        if (isset($_POST['carousel_autoplay'])) { $wpgmza_data['carousel_autoplay'] = esc_attr($_POST['carousel_autoplay']); }
        if (isset($_POST['carousel_lazyload'])) { $wpgmza_data['carousel_lazyload'] = esc_attr($_POST['carousel_lazyload']); }
        if (isset($_POST['carousel_autoheight'])) { $wpgmza_data['carousel_autoheight'] = esc_attr($_POST['carousel_autoheight']); }
        if (isset($_POST['carousel_navigation'])) { $wpgmza_data['carousel_navigation'] = esc_attr($_POST['carousel_navigation']); }
        if (isset($_POST['carousel_pagination'])) { $wpgmza_data['carousel_pagination'] = esc_attr($_POST['carousel_pagination']); }
        
        
        if (isset($_POST['wpgmza_settings_filterbycat_type'])) { $wpgmza_data['wpgmza_settings_filterbycat_type'] = esc_attr($_POST['wpgmza_settings_filterbycat_type']); }
        if (isset($_POST['wpgmza_settings_map_open_marker_by'])) { $wpgmza_data['wpgmza_settings_map_open_marker_by'] = esc_attr($_POST['wpgmza_settings_map_open_marker_by']); }
        if (isset($_POST['wpgmza_settings_cat_logic'])) { $wpgmza_data['wpgmza_settings_cat_logic'] = esc_attr($_POST['wpgmza_settings_cat_logic']); }
        if (isset($_POST['wpgmza_api_version'])) { $wpgmza_data['wpgmza_api_version'] = esc_attr($_POST['wpgmza_api_version']); }
        if (isset($_POST['wpgmza_marker_xml_location'])) { update_option("wpgmza_xml_location",$_POST['wpgmza_marker_xml_location']); }
        if (isset($_POST['wpgmza_marker_xml_url'])) { update_option("wpgmza_xml_url",$_POST['wpgmza_marker_xml_url']); }

        if (isset($_POST['wpgmza_access_level'])) { $wpgmza_data['wpgmza_settings_access_level'] = esc_attr($_POST['wpgmza_access_level']); }
        if (isset($_POST['wpgmza_settings_retina_width'])) { $wpgmza_data['wpgmza_settings_retina_width'] = esc_attr($_POST['wpgmza_settings_retina_width']); }
        if (isset($_POST['wpgmza_settings_retina_height'])) { $wpgmza_data['wpgmza_settings_retina_height'] = esc_attr($_POST['wpgmza_settings_retina_height']); }

        if (isset($_POST['wpgmza_settings_marker_pull'])) { $wpgmza_data['wpgmza_settings_marker_pull'] = esc_attr($_POST['wpgmza_settings_marker_pull']); }

        if (isset($_POST['wpgmza_iw_type'])) { $wpgmza_data['wpgmza_iw_type'] = esc_attr($_POST['wpgmza_iw_type']); } else {  $wpgmza_data['wpgmza_iw_type'] = '-1'; } //Set to -1 if not set


        $wpgmza_data = apply_filters("wpgooglemaps_filter_save_settings",$wpgmza_data);

        if( isset( $_POST['wpgmza_google_maps_api_key'] ) ){ update_option( 'wpgmza_google_maps_api_key', $_POST['wpgmza_google_maps_api_key'] ); }

        update_option('WPGMZA_OTHER_SETTINGS', $wpgmza_data);
        echo "<div class='updated'><p>";
        _e("Your settings have been saved.","wp-google-maps");
        echo "</p></div>";

        if( function_exists( 'wpgmza_caching_notice_changes' ) ){
        	add_action( 'admin_notices', 'wpgmza_caching_notice_changes' );
        }

    }



}


function wpgmza_b_real_pro_add_poly($mid) {
    global $wpgmza_tblname_maps;
    global $wpdb;
    if ($_GET['action'] == "add_poly" && isset($mid)) {
        $res = wpgmza_get_map_data($mid);
        echo "
            

            
          
           <div class='wrap'>
                <h1>WP Google Maps</h1>
                <div class='wide'>

                    <h2>".__("Add a Polygon","wp-google-maps")."</h2>
                    <form action='?page=wp-google-maps-menu&action=edit&map_id=".$mid."' method='post' id='wpgmaps_add_poly_form'>
                    <input type='hidden' name='wpgmaps_map_id' id='wpgmaps_map_id' value='".$mid."' />
                    
                    <table class='wpgmza-listing-comp' style='width:30%;float:left;'>
                    <tr>
                        <td>".__("Name","wp-google-maps")."</td><td><input id=\"poly_name\" name=\"poly_name\" type=\"text\" value=\"\" /></td>
                    </tr>
                    <tr>
                        <td>".__("Title","wp-google-maps")."</td><td><input id=\"poly_title\" name=\"poly_title\" type=\"text\" value=\"\" /></td>
                    </tr>
                    <tr>
                        <td>".__("Link","wp-google-maps")."</td><td><input id=\"poly_link\" name=\"poly_link\" type=\"text\" value=\"\" /></td> 
                    </tr>
                    <tr>
                        <td>".__("Line Color","wp-google-maps")."</td><td><input id=\"poly_line\" name=\"poly_line\" type=\"text\" class=\"color\" value=\"000000\" /></td>   
                    </tr>
                    <tr>
                        <td>".__("Line Opacity","wp-google-maps")."</td><td><input id=\"poly_line_opacity\" name=\"poly_line_opacity\" type=\"text\" value=\"0.5\" /> (0 - 1.0) example: 0.5 for 50%</td>   
                    </tr>
                    <tr>
                        <td>".__("Fill Color","wp-google-maps")."</td><td><input id=\"poly_fill\" name=\"poly_fill\" type=\"text\" class=\"color\" value=\"66ff00\" /></td>  
                    </tr>
                    <tr>
                        <td>".__("Opacity","wp-google-maps")."</td><td><input id=\"poly_opacity\" name=\"poly_opacity\" type=\"text\" value=\"0.5\" /> (0 - 1.0) example: 0.5 for 50%</td>   
                    </tr>
                    <tr>
                        <td>".__("On Hover Line Color","wp-google-maps")."</td><td><input id=\"poly_line_hover_line_color\" name=\"poly_line_hover_line_color\" class=\"color\" type=\"text\" value=\"737373\" /></td>   
                    </tr>
                    <tr>
                        <td>".__("On Hover Fill Color","wp-google-maps")."</td><td><input id=\"poly_hover_fill_color\" name=\"poly_hover_fill_color\" type=\"text\" class=\"color\" value=\"57FF78\" /></td>  
                    </tr>
                    <tr>
                        <td>".__("On Hover Opacity","wp-google-maps")."</td><td><input id=\"poly_hover_opacity\" name=\"poly_hover_opacity\" type=\"text\" value=\"0.7\" /> (0 - 1.0) example: 0.5 for 50%</td>   
                    </tr>
                        
                    </table>

                    <div class='wpgmza_map_seventy'> 
	                    <div id=\"wpgmza_map\">&nbsp;</div>
	                    <p>
	                            <ul style=\"list-style:initial;\" class='update-nag update-blue update-slim update-map-overlay'>
	                                <li style=\"margin-left:30px;\">".__("Click on the map to insert a vertex.","wp-google-maps")."</li>
	                                <li style=\"margin-left:30px;\">".__("Click on a vertex to remove it.","wp-google-maps")."</li>
	                                <li style=\"margin-left:30px;\">".__("Drag a vertex to move it.","wp-google-maps")."</li>
	                            </ul>
	                    </p>
                    </div>
                    


                     <p>Polygon data:<br /><textarea name=\"wpgmza_polygon\" id=\"poly_line_list\" style=\"width:90%; height:100px; border:1px solid #ccc; background-color:#FFF; padding:5px; overflow:auto;\"></textarea>
                    <p class='submit'><a href='javascript:history.back();' class='button button-secondary' title='".__("Cancel")."'>".__("Cancel")."</a> <input type='submit' name='wpgmza_save_poly' class='button-primary' value='".__("Save Polygon","wp-google-maps")." &raquo;' /></p>

                    </form>
                </div>


            </div>



        ";

    }



}
function wpgmza_b_real_pro_edit_poly($mid) {
    global $wpgmza_tblname_maps;
    global $wpdb;
    if ($_GET['action'] == "edit_poly" && isset($mid)) {
        $res = wpgmza_get_map_data($mid);
        $pol = wpgmza_b_return_poly_options(sanitize_text_field($_GET['poly_id']));
echo "
            

            
          
           <div class='wrap'>
                <h1>WP Google Maps</h1>
                <div class='wide'>

                    <h2>".__("Add a Polygon","wp-google-maps")."</h2>
                    <form action='?page=wp-google-maps-menu&action=edit&map_id=".$mid."' method='post' id='wpgmaps_edit_poly_form'>
                    <input type='hidden' name='wpgmaps_map_id' id='wpgmaps_map_id' value='".$mid."' />
                    <input type='hidden' name='wpgmaps_poly_id' id='wpgmaps_poly_id' value='".$_GET['poly_id']."' />
                    
                    <table class='wpgmza-listing-comp' style='width:30%;float:left;'>
                    <tr>
                        <td>".__("Name","wp-google-maps")."</td><td><input id=\"poly_name\" name=\"poly_name\" type=\"text\" value=\"".stripslashes($pol->polyname)."\" /></td>
                    </tr>
                    <tr>
                        <td>".__("Title","wp-google-maps")."</td><td><input id=\"poly_title\" name=\"poly_title\" type=\"text\" value=\"".stripslashes($pol->title)."\" /></td>
                    </tr>
                    <tr>
                        <td>".__("Link","wp-google-maps")."</td><td><input id=\"poly_link\" name=\"poly_link\" type=\"text\" value=\"".$pol->link."\" /></td> 
                    </tr>
                    <tr>
                        <td>".__("Line Color","wp-google-maps")."</td><td><input id=\"poly_line\" name=\"poly_line\" type=\"text\" class=\"color\" value=\"".$pol->linecolor."\" /></td>   
                    </tr>
                    <tr>
                        <td>".__("Line Opacity","wp-google-maps")."</td><td><input id=\"poly_line_opacity\" name=\"poly_line_opacity\" type=\"text\" value=\"".$pol->lineopacity."\" /> (0 - 1.0) example: 0.5 for 50%</td>   
                    </tr>
                    <tr>
                        <td>".__("Fill Color","wp-google-maps")."</td><td><input id=\"poly_fill\" name=\"poly_fill\" type=\"text\" class=\"color\" value=\"".$pol->fillcolor."\" /></td>  
                    </tr>
                    <tr>
                        <td>".__("Opacity","wp-google-maps")."</td><td><input id=\"poly_opacity\" name=\"poly_opacity\" type=\"text\" value=\"".$pol->opacity."\" /> (0 - 1.0) example: 0.5 for 50%</td>   
                    </tr>
                    <tr>
                        <td>".__("On Hover Line Color","wp-google-maps")."</td><td><input id=\"poly_line_hover_line_color\" name=\"poly_line_hover_line_color\" class=\"color\" type=\"text\" value=\"".$pol->ohlinecolor."\" /></td>   
                    </tr>
                    <tr>
                        <td>".__("On Hover Fill Color","wp-google-maps")."</td><td><input id=\"poly_hover_fill_color\" name=\"poly_hover_fill_color\" type=\"text\" class=\"color\" value=\"".$pol->ohfillcolor."\" /></td>  
                    </tr>
                    <tr>
                        <td>".__("On Hover Opacity","wp-google-maps")."</td><td><input id=\"poly_hover_opacity\" name=\"poly_hover_opacity\" type=\"text\" value=\"".$pol->ohopacity."\" /> (0 - 1.0) example: 0.5 for 50%</td>   
                    </tr>
                        
                    </table>
                     <div class='wpgmza_map_seventy'> 
                        <div id=\"wpgmza_map\">&nbsp;</div>
		                    <p>
		                            <ul style=\"list-style:initial;\" class='update-nag update-blue update-slim update-map-overlay'>
		                                <li style=\"margin-left:30px;\">".__("Click on the map to insert a vertex.","wp-google-maps")."</li>
		                                <li style=\"margin-left:30px;\">".__("Click on a vertex to remove it.","wp-google-maps")."</li>
		                                <li style=\"margin-left:30px;\">".__("Drag a vertex to move it.","wp-google-maps")."</li>
		                            </ul>
		                    </p>
                     </div>
                    


                     <p>Polygon data:<br /><textarea name=\"wpgmza_polygon\" id=\"poly_line_list\" style=\"width:90%; height:100px; border:1px solid #ccc; background-color:#FFF; padding:5px; overflow:auto;\"></textarea>
                    <p class='submit'><a href='javascript:history.back();' class='button button-secondary' title='".__("Cancel")."'>".__("Cancel")."</a> <input type='submit' name='wpgmza_edit_poly' class='button-primary' value='".__("Save Polygon","wp-google-maps")." &raquo;' /></p>

                    </form>
                </div>


            </div>



        ";

    }



}



add_action( 'wp_ajax_nopriv_wpgmza_datatables', 'wpgmza_datatables_update');
add_action( 'wp_ajax_wpgmza_datatables','wpgmza_datatables_update');

add_action( 'wp_ajax_nopriv_wpgmza_carousel_update', 'wpgmza_carousel_update');
add_action( 'wp_ajax_wpgmza_carousel_update','wpgmza_carousel_update');

add_action( 'wp_ajax_nopriv_wpgmza_basiclist_update', 'wpgmza_basiclist_update');
add_action( 'wp_ajax_wpgmza_basiclist_update','wpgmza_basiclist_update');

add_action( 'wp_ajax_nopriv_wpgmza_basictable_update', 'wpgmza_basictable_update');
add_action( 'wp_ajax_wpgmza_basictable_update','wpgmza_basictable_update');


function wpgmza_carousel_update() {
    global $wpgmza_tblname;
    global $wpdb;
    /* add nonce check */
    $map_id = $_POST['map_id'];
    if (!$map_id || $map_id == "") { die('no map id'); }
    
    $category_data = $_POST['category_data'];

    $wpgmc = new wpgmza();
	if (is_array($_POST['mashup_maps'])) {
    	$wpgmza_marker_list_output = $wpgmc->list_markers(false,3,$map_id,$category_data,true,$_POST['mashup_maps'],false);
    } else {
    	$wpgmza_marker_list_output = $wpgmc->list_markers(false,3,$map_id,$category_data,false,false,false);

    }
    echo $wpgmza_marker_list_output;
    die();
    
}
function wpgmza_basiclist_update() {
    global $wpgmza_tblname;
    global $wpdb;
    /* add nonce check */
    $map_id = $_POST['map_id'];
    if (!$map_id || $map_id == "") { die('no map id'); }
    
    $category_data = $_POST['category_data'];

    $wpgmc = new wpgmza();
    if (is_array($_POST['mashup_maps'])) {
    	$wpgmza_marker_list_output = $wpgmc->list_markers(false,4,$map_id,$category_data,true,$_POST['mashup_maps'],false);
    } else {
    	$wpgmza_marker_list_output = $wpgmc->list_markers(false,4,$map_id,$category_data,false,false,false);

    }
    echo $wpgmza_marker_list_output;
    die();
    
}
function wpgmza_basictable_update() {
    global $wpgmza_tblname;
    global $wpdb;
    /* add nonce check */
    $map_id = $_POST['map_id'];
    if (!$map_id || $map_id == "") { die('no map id'); }
    
    $category_data = $_POST['category_data'];

    $wpgmc = new wpgmza();
	if (is_array($_POST['mashup_maps'])) {
    	$wpgmza_marker_list_output = $wpgmc->list_markers(false,1,$map_id,$category_data,true,$_POST['mashup_maps'],false);
    } else {
    	$wpgmza_marker_list_output = $wpgmc->list_markers(false,1,$map_id,$category_data,false,false,false);

    }
    echo $wpgmza_marker_list_output;
    die();
    
}
function wpgmza_datatables_update() {
    global $wpgmza_tblname;
    global $wpdb;
    /* add nonce check */
    $map_id = $_POST['map_id'];
    if (!$map_id || $map_id == "") { die('no map id'); }
    
    
    $category_data = $_POST['category_data'];

    $wpgmc = new wpgmza();
	if (is_array($_POST['mashup_maps'])) {
    	$wpgmza_marker_list_output = $wpgmc->list_markers(false,2,$map_id,$category_data,true,$_POST['mashup_maps'],false);
    } else {
    	$wpgmza_marker_list_output = $wpgmc->list_markers(false,2,$map_id,$category_data,false,false,false);

    }
    echo $wpgmza_marker_list_output;
    die();

	
            
    
}



add_action( 'wp_ajax_nopriv_wpgmza_datatables_sl', 'wpgmza_datatables_update_sl');
add_action( 'wp_ajax_wpgmza_datatables_sl','wpgmza_datatables_update_sl');
add_action( 'wp_ajax_nopriv_wpgmza_sl_carousel', 'wpgmza_datatables_update_sl_carousel');
add_action( 'wp_ajax_wpgmza_sl_carousel','wpgmza_datatables_update_sl_carousel');
add_action( 'wp_ajax_nopriv_wpgmza_sl_basiclist', 'wpgmza_datatables_update_sl_basiclist');
add_action( 'wp_ajax_wpgmza_sl_basiclist','wpgmza_datatables_update_sl_basiclist');
add_action( 'wp_ajax_nopriv_wpgmza_sl_basictable', 'wpgmza_datatables_update_sl_basictable');
add_action( 'wp_ajax_wpgmza_sl_basictable','wpgmza_datatables_update_sl_basictable');



function wpgmza_datatables_update_sl_carousel() {
    
    $map_id = $_POST['map_id'];
    if (!$map_id || $map_id == "") { die('no map id'); }
    
    if (!isset($_POST['marker_array'])) {
        echo "";
        die();
    }
    $marker_array = $_POST['marker_array'];
    $wpgmc = new wpgmza();
	if (is_array($_POST['mashup_maps'])) {
	    $wpgmza_marker_list_output = $wpgmc->list_markers(false,3,$map_id,false,true,$_POST['mashup_maps'],$marker_array);
	} else {
		$wpgmza_marker_list_output = $wpgmc->list_markers(false,3,$map_id,false,false,false,$marker_array);
	}
    echo $wpgmza_marker_list_output;
    die();
}
function wpgmza_datatables_update_sl_basiclist() {
    
    $map_id = $_POST['map_id'];
    if (!$map_id || $map_id == "") { die('no map id'); }
    
    if (!isset($_POST['marker_array'])) {
        echo "";
        die();
    }
    $marker_array = $_POST['marker_array'];
    $wpgmc = new wpgmza();
	if (is_array($_POST['mashup_maps'])) {
	    $wpgmza_marker_list_output = $wpgmc->list_markers(false,4,$map_id,false,true,$_POST['mashup_maps'],$marker_array);
	} else {
		$wpgmza_marker_list_output = $wpgmc->list_markers(false,4,$map_id,false,false,false,$marker_array);
	}

    echo $wpgmza_marker_list_output;
    die();
}
function wpgmza_datatables_update_sl_basictable() {
    
    $map_id = $_POST['map_id'];
    if (!$map_id || $map_id == "") { die('no map id'); }
    
    if (!isset($_POST['marker_array'])) {
        echo "";
        die();
    }
    $marker_array = $_POST['marker_array'];
    $wpgmc = new wpgmza();
	if (is_array($_POST['mashup_maps'])) {
	    $wpgmza_marker_list_output = $wpgmc->list_markers(false,1,$map_id,false,true,$_POST['mashup_maps'],$marker_array);
	} else {
		$wpgmza_marker_list_output = $wpgmc->list_markers(false,1,$map_id,false,false,false,$marker_array);
	}

    echo $wpgmza_marker_list_output;
    die();
}

function wpgmza_datatables_update_sl() {

	global $wpgmza_tblname;
    global $wpdb;
    /* add nonce check */
    $map_id = $_POST['map_id'];
    if (!$map_id || $map_id == "") { die('no map id'); }
    
    if (!isset($_POST['marker_array'])) {
        echo "";
        die();
    }
    $marker_array = $_POST['marker_array'];

    $wpgmc = new wpgmza();
    
	if (is_array($_POST['mashup_maps'])) {
	    $wpgmza_marker_list_output = $wpgmc->list_markers(false,2,$map_id,false,true,$_POST['mashup_maps'],$marker_array);
	} else {
		$wpgmza_marker_list_output = $wpgmc->list_markers(false,2,$map_id,false,false,false,$marker_array);
	}

    echo $wpgmza_marker_list_output;
    die();


    
}

add_action('admin_print_scripts', 'wpgmaps_admin_scripts_pro');
add_action('admin_print_styles', 'wpgmaps_admin_styles_pro');


function wpgmaps_admin_scripts_pro() {
    
	$wpgmza_lang_strings = array(
		"wpgm_mlist_sel_1" =>__("Carousel","wp-google-maps"),
		"wpgm_mlist_sel_2" => __("No marker listing","wp-google-maps"),
		"wpgm_mlist_sel_3" => __("Basic list","wp-google-maps"),
		"wpgm_mlist_sel_4" => __("Basic table","wp-google-maps"),
		"wpgm_mlist_sel_5" => __("Advanced table","wp-google-maps"),
		"wpgm_iw_sel_1" => __("Default Infowindow","wp-google-maps"),
		"wpgm_iw_sel_2" => __("Modern Infowindow","wp-google-maps"),
		"wpgm_copy_string" => __("Copied to clipboard","wp-google-maps"),
		"wpgm_iw_sel_3" => __("Modern Plus Infowindow","wp-google-maps"),
		"wpgm_iw_sel_4" => __("Circular Infowindow","wp-google-maps"),
		"wpgm_iw_sel_null" => __("No Global Setting","wp-google-maps")
	);

    if (isset($_GET['page'])) {
        if ($_GET['page'] == "wp-google-maps-menu-settings" || $_GET['page'] == "wp-google-maps-menu-advanced") {
            wp_enqueue_script( 'jquery-ui-tabs');
            if (wp_script_is('my-wpgmaps-tabs','registered')) {  } else {
                //wp_register_style('jquery-ui-smoothness', 'https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css');
                //wp_enqueue_style('jquery-ui-smoothness');
                wp_register_script('my-wpgmaps-tabs', WPGMAPS_DIR.'js/wpgmaps_tabs.js', array('jquery-ui-core'), '1.0.1', true);
                wp_enqueue_script('my-wpgmaps-tabs');
                wp_register_script('admin-wpgmaps', plugins_url('js/wpgmaps-admin.js', __FILE__));
                wp_enqueue_script('admin-wpgmaps');
                wp_localize_script( 'admin-wpgmaps', 'wpgmaps_localize_strings', $wpgmza_lang_strings);

                
            }
        }
        if ($_GET['page'] == "wp-google-maps-menu") {

                wp_register_script('admin-wpgmaps', plugins_url('js/wpgmaps-admin.js', __FILE__));
                wp_enqueue_script('admin-wpgmaps');
                wp_localize_script( 'admin-wpgmaps', 'wpgmaps_localize_strings', $wpgmza_lang_strings);

        }
    }
}

function wpgmaps_admin_styles_pro() {
    if (isset($_GET['page'])) {
        /*if ($_GET['page'] == "wp-google-maps-menu-support") {
            wp_register_style('fontawesome', plugins_url('css/font-awesome.min.css', __FILE__));
            wp_enqueue_style('fontawesome');
            wp_register_style('wpgmaps-admin-style', plugins_url('css/wpgmaps-admin.css', __FILE__));
            wp_enqueue_style('wpgmaps-admin-style');
            
        }
        if ($_GET['page'] == "wp-google-maps-menu" || $_GET['page'] == "wp-google-maps-menu-settings") {
            wp_register_style('wpgmaps-admin-style', plugins_url('css/wpgmaps-admin.css', __FILE__));
            wp_enqueue_style('wpgmaps-admin-style');

        }*/

        if(strpos($_GET['page'], "wp-google-maps") !== false){
            wp_register_style('fontawesome', plugins_url('css/font-awesome.min.css', __FILE__));
            wp_enqueue_style('fontawesome');
            wp_register_style('wpgmaps-admin-style', plugins_url('css/wpgmaps-admin.css', __FILE__));
            wp_enqueue_style('wpgmaps-admin-style');
        }
    }
}



function wpgmaps_sl_user_output_pro($map_id,$atts = false) {
    $map_settings = wpgmza_get_map_data($map_id);
    $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");



    
    $map_width = $map_settings->map_width;
    $map_width_type = stripslashes($map_settings->map_width_type);
    $map_other_settings = maybe_unserialize($map_settings->other_settings);
    
    if (isset($map_other_settings['store_locator_query_string'])) { $sl_query_string = stripslashes($map_other_settings['store_locator_query_string']); } else { $sl_query_string = __("ZIP / Address:","wp-google-maps"); }
    if (isset($map_other_settings['store_locator_name_string'])) { $sl_name_string = stripslashes($map_other_settings['store_locator_name_string']); } else { $sl_name_string = __("Title / Description:","wp-google-maps"); }
    if (isset($map_other_settings['store_locator_default_address'])) { $sl_default_address = stripslashes($map_other_settings['store_locator_default_address']); } else { $sl_default_address = ''; }


	if (isset($map_other_settings['store_locator_use_their_location']) && $map_other_settings['store_locator_use_their_location'] == "1") { $sl_use_their_location = true; } else { $sl_use_their_location = false; }
    
    
    if ($map_width_type == "px" && $map_width < 300) { $map_width = "300"; }
    
    $ret_msg = "";
    
    $ret_msg .= "<div class=\"wpgmza_sl_main_div\">";
    $ret_msg .= "       <div class=\"wpgmza_sl_query_div\">";
    $ret_msg .= "           <div class=\"wpgmza_sl_query_innerdiv1\">".$sl_query_string."</div>";
    $ret_msg .= "           <div class=\"wpgmza_sl_query_innerdiv2\">";
    $ret_msg .= "				<input type=\"text\" id=\"addressInput_".$map_id."\" size=\"20\" value=\"".$sl_default_address."\" mid=\"".$map_id."\" class='addressInput' /> ";
    if ($sl_use_their_location) {
    $ret_msg .= "				<button id=\"sl_use_my_location_".$map_id."\" class=\"sl_use_loc\" mid=\"".$map_id."\" title='".__("Use my location","wp-google-maps")."' ><img src='".plugins_url(plugin_basename(dirname(__FILE__)))."/images/mylocation.png' title='".__("Use my location","wp-google-maps")."' width='15' /></button>";
    }
    $ret_msg .= "			</div>";
    $ret_msg .= "       </div>";

    if (isset($map_other_settings['store_locator_name_search']) && intval($map_other_settings['store_locator_name_search']) == 1) {
        $ret_msg .= "       <div class=\"wpgmza_sl_query_div\">";
        $ret_msg .= "           <div class=\"wpgmza_sl_query_innerdiv1 wpgmza_name_search_string\">".$sl_name_string."</div>";
        $ret_msg .= "           <div class=\"wpgmza_sl_query_innerdiv2 wpgmza_name_search_field\"><input type=\"text\" id=\"nameInput_".$map_id."\" size=\"20\" value=\"\" /></div>";
        $ret_msg .= "       </div>";
    }

    
    
    $ret_msg .= "       <div class=\"wpgmza_sl_radius_div\">";
    $ret_msg .= "           <div class=\"wpgmza_sl_radius_innerdiv1\">".__("Radius","wp-google-maps").":</div>";
    $ret_msg .= "           <div class=\"wpgmza_sl_radius_innerdiv2\">";
    $ret_msg .= "           <select class=\"wpgmza_sl_radius_select\" id=\"radiusSelect_".$map_id."\">";
    $ret_msg .= "               ";

    if (isset($map_other_settings['store_locator_distance']) && $map_other_settings['store_locator_distance'] == 1) {
        $ret_msg .= "                   <option class=\"wpgmza_sl_select_option\" value=\"1\">".__("1mi","wp-google-maps")."</option>";
        $ret_msg .= "                   <option class=\"wpgmza_sl_select_option\" value=\"5\">".__("5mi","wp-google-maps")."</option>";
        $ret_msg .= "                   <option class=\"wpgmza_sl_select_option\" value=\"10\" selected>".__("10mi","wp-google-maps")."</option>";
        $ret_msg .= "                   <option class=\"wpgmza_sl_select_option\" value=\"25\">".__("25mi","wp-google-maps")."</option>";
        $ret_msg .= "                   <option class=\"wpgmza_sl_select_option\" value=\"50\">".__("50mi","wp-google-maps")."</option>";
        $ret_msg .= "                   <option class=\"wpgmza_sl_select_option\" value=\"75\">".__("75mi","wp-google-maps")."</option>";
        $ret_msg .= "                   <option class=\"wpgmza_sl_select_option\" value=\"100\">".__("100mi","wp-google-maps")."</option>";
        $ret_msg .= "                   <option class=\"wpgmza_sl_select_option\" value=\"150\">".__("150mi","wp-google-maps")."</option>";
        $ret_msg .= "                   <option class=\"wpgmza_sl_select_option\" value=\"200\">".__("200mi","wp-google-maps")."</option>";
        $ret_msg .= "                   <option class=\"wpgmza_sl_select_option\" value=\"300\">".__("300mi","wp-google-maps")."</option>";
    } else {
        $ret_msg .= "                   <option class=\"wpgmza_sl_select_option\" value=\"1\">".__("1km","wp-google-maps")."</option>";
        $ret_msg .= "                   <option class=\"wpgmza_sl_select_option\" value=\"5\">".__("5km","wp-google-maps")."</option>";
        $ret_msg .= "                   <option class=\"wpgmza_sl_select_option\" value=\"10\" selected>".__("10km","wp-google-maps")."</option>";
        $ret_msg .= "                   <option class=\"wpgmza_sl_select_option\" value=\"25\">".__("25km","wp-google-maps")."</option>";
        $ret_msg .= "                   <option class=\"wpgmza_sl_select_option\" value=\"50\">".__("50km","wp-google-maps")."</option>";
        $ret_msg .= "                   <option class=\"wpgmza_sl_select_option\" value=\"75\">".__("75km","wp-google-maps")."</option>";
        $ret_msg .= "                   <option class=\"wpgmza_sl_select_option\" value=\"100\">".__("100km","wp-google-maps")."</option>";
        $ret_msg .= "                   <option class=\"wpgmza_sl_select_option\" value=\"150\">".__("150km","wp-google-maps")."</option>";
        $ret_msg .= "                   <option class=\"wpgmza_sl_select_option\" value=\"200\">".__("200km","wp-google-maps")."</option>";
        $ret_msg .= "                   <option class=\"wpgmza_sl_select_option\" value=\"300\">".__("300km","wp-google-maps")."</option>";
    }
	$sl_distance = isset($map_other_settings['store_locator_distance']) ? $map_other_settings['store_locator_distance'] : "";    
    $ret_msg .= "               </select><input type='hidden' value='".$sl_distance."' name='wpgmza_distance_type' id='wpgmza_distance_type_".$map_id."'  style='display:none;' />";
    $ret_msg .= "           </div>";
    $ret_msg .= "       </div>";
    
    if (function_exists("wpgmza_register_pro_version") && isset($map_other_settings['store_locator_category']) && $map_other_settings['store_locator_category'] == "1") {
        
		/** shortcode override */
        $cats_override_hide = 1;
	    if ($atts !== false && isset($atts['enable_category'])) { 
	    	$cats_override_hide = intval($atts['enable_category']);
	    }
	    if ($cats_override_hide) {

	        $ret_msg .= "       <div class=\"wpgmza_sl_category_div\">";
	        $ret_msg .= "           <div class=\"wpgmza_sl_category_innerdiv1\">".__("Category","wp-google-maps").":</div>";
	        $ret_msg .= "           <div class=\"wpgmza_sl_category_innerdiv2\">";

	        $filterbycat = $map_settings->filterbycat;

	        
		    

			if (isset($wpgmza_settings['wpgmza_settings_filterbycat_type'])) { $filterbycat_type = $wpgmza_settings['wpgmza_settings_filterbycat_type']; } else { $filterbycat_type = false; }
		    if (!$filterbycat_type) { $filterbycat_type = 1; }

			if ($filterbycat_type == "1") {
	        	$wpgmza_filter_dropdown = wpgmza_pro_return_category_select_list($map_id);
	            $ret_msg .= "<select mid=\"".$map_id."\" name=\"wpgmza_filter_select\" id=\"wpgmza_filter_select\" class=\"wpgmza_filter_select_".$map_id."\">";
	            $ret_msg .= $wpgmza_filter_dropdown;
	            $ret_msg .= "</select>";
	        } 
	        else {
	        	
	            	$ret_msg .= wpgmza_pro_return_category_checkbox_list($map_id,true,false);	            
	            
	        }

	        $ret_msg .= "           </div>";
	        $ret_msg .= "       </div>";
    	}
    }

    $ret_msg .= "       <div class=\"wpgmza_sl_search_button_div\"><input class=\"wpgmza_sl_search_button_".$map_id."\" mid=\"".$map_id."\" type=\"button\" onclick=\"searchLocations($map_id)\" value=\"".__("Search","wp-google-maps")."\"/></div>";
    $ret_msg .= "       <div class=\"wpgmza_sl_reset_button_div\"><input class=\"wpgmza_sl_reset_button_".$map_id."\" mid=\"".$map_id."\" type=\"button\" onclick=\"resetLocations($map_id)\" value=\"".__("Reset","wp-google-maps")."\"/></div>";
    $ret_msg .= "    </div>";
    $ret_msg .= "    <div><select id=\"locationSelect\" style=\"width:100%;visibility:hidden\"></select></div>";
    
    return $ret_msg;
    
}
function wpgmza_content_filter($content) {

    $lat = get_post_meta( get_the_ID(), 'lat', true );
    $lng = get_post_meta( get_the_ID(), 'lng', true );
    $parent_id = get_post_meta( get_the_ID(), 'map_parent_id', true );
    $map_data = "";
    
    // check if the custom field has a value
    if( ! empty( $lat ) && ! empty( $lng ) ) {
        
       /* check if they have a parent ID set, if not, take first active available map ID */
       if (empty($parent_id) || !$parent_id) {
           global $wpdb;
           global $wpgmza_tblname_maps;
           $result = $wpdb->get_row(
            "
                SELECT *
                FROM `$wpgmza_tblname_maps`
                WHERE `active` = 0
                ORDER BY `id` ASC
                LIMIT 1
            ");
           if ($result) {
                $parent_id = $result->id;
           } else { $parent_id = false; }
       } 
        
       $map_data = do_shortcode("[wpgmza id='1' lat='$lat' lng='$lng' parent_id='$parent_id']");
    }   
    
    
    return $content.$map_data;
}
add_filter( 'the_content', 'wpgmza_content_filter' );

function wpgmaps_return_markers_pro($mapid = false) {

    if (!$mapid) {
        return;
    }
    global $wpdb;
    
    $table_name = $wpdb->prefix . "wpgmza";
    $sql = "SELECT * FROM $table_name WHERE `map_id` = '$mapid' AND `approved` = 1";
    $results = $wpdb->get_results($sql);
    $m_array = array();
    $cnt = 0;
    foreach ( $results as $result ) {   

        $id = $result->id;
        $address = addslashes($result->address);
        $description = addslashes($result->description);
        $pic = $result->pic;
        if (!$pic) { $pic = ""; }
        $icon = $result->icon;
        if (!$icon) { $icon = ""; }
        $link_url = $result->link;
        if ($link_url) {  } else { $link_url = ""; }
        $lat = $result->lat;
        $lng = $result->lng;
        $anim = $result->anim;
        $retina = $result->retina;
        $category = $result->category;
        // $other_data = $result->other_settings;
		if (isset($result->other_data)) { $other_data = maybe_unserialize($result->other_data); } else { $other_data = ''; }
        
        if ($icon == "") {
            if (function_exists('wpgmza_get_category_data')) {
                $category_data = wpgmza_get_category_data($category);
                if (isset($category_data->category_icon) && isset($category_data->category_icon) != "") {
                    $icon = $category_data->category_icon;
                } else {
                   $icon = "";
                }
                if (isset($category_data->retina)) {
                    $retina = $category_data->retina;
                }
            }
        }
        $infoopen = $result->infoopen;
        $approved = $result->approved;
        
        $mtitle = addslashes($result->title);
        $map_id = $result->map_id;
        
        
        $m_array[$cnt] = array(
            'map_id' => $map_id,
            'marker_id' => $id,
            'title' => $mtitle,
            'address' => $address,
            'desc' => trim(preg_replace('/\s+/', ' ', nl2br($description))),
            'pic' => $pic,
            'icon' => $icon,
            'linkd' => $link_url,
            'lat' => $lat,
            'lng' => $lng,
            'anim' => $anim,
            'retina' => $retina,
            'category' => $category,
            'infoopen' => $infoopen,
            'approved' => $approved,
            'other_data' => $other_data
        );
        $cnt++;
        
    }

    return $m_array;
   
}

function wpgmaps_list_maps_pro() {
    global $wpdb;
    global $wpgmza_tblname_maps;
    
    if ($wpgmza_tblname_maps) { $table_name = $wpgmza_tblname_maps; } else { $table_name = $wpdb->prefix . "wpgmza_maps"; }
    $results = $wpdb->get_results(
        "
	SELECT *
	FROM $table_name
        WHERE `active` = 0
        ORDER BY `id` DESC
	"
    );
    echo "

      <table class=\"wp-list-table widefat fixed wpgmza-listing\" cellspacing=\"0\">
	<thead>
	<tr>
		<th scope='col' id='id' class='manage-column column-id sortable desc'  style=''><span>".__("ID","wp-google-maps")."</span></th>
                <th scope='col' id='map_title' class='manage-column column-map_title sortable desc'  style=''><span>".__("Title","wp-google-maps")."</span></th>
                <th scope='col' id='map_width' class='manage-column column-map_width' style=\"\">".__("Width","wp-google-maps")."</th>
                <th scope='col' id='map_height' class='manage-column column-map_height'  style=\"\">".__("Height","wp-google-maps")."</th>
                <th scope='col' id='type' class='manage-column column-type sortable desc'  style=\"\"><span>".__("Type","wp-google-maps")."</span></th>
                <th scope='col' id='type' class='manage-column column-type sortable desc'  style=\"\"><span>".__("Shortcode","wp-google-maps")."</span></th>
        </tr>
	</thead>
        <tbody id=\"the-list\" class='list:wp_list_text_link'>
";
    foreach ( $results as $result ) {
        if ($result->type == "1") { $map_type = __("Roadmap","wp-google-maps"); }
        else if ($result->type == "2") { $map_type = __("Satellite","wp-google-maps"); }
        else if ($result->type == "3") { $map_type = __("Hybrid","wp-google-maps"); }
        else if ($result->type == "4") { $map_type = __("Terrain","wp-google-maps"); }
        $trashlink = "| <a href=\"?page=wp-google-maps-menu&action=trash&map_id=".$result->id."\" title=\"".__("Trash","wp-google-maps")."\">".__("Trash","wp-google-maps")."</a>";
        $duplink = "| <a href=\"?page=wp-google-maps-menu&action=duplicate&map_id=".$result->id."\" title=\"".__("Duplicate","wp-google-maps")."\">".__("Duplicate","wp-google-maps")."</a>";
        echo "<tr id=\"record_".$result->id."\">";
        echo "<td class='id column-id'>".$result->id."</td>";
        echo "<td class='map_title column-map_title'><strong><big><a href=\"?page=wp-google-maps-menu&action=edit&map_id=".$result->id."\" title=\"".__("Edit","wp-google-maps")."\">".$result->map_title."</a></big></strong><br /><a href=\"?page=wp-google-maps-menu&action=edit&map_id=".$result->id."\" title=\"".__("Edit","wp-google-maps")."\">".__("Edit","wp-google-maps")."</a> $trashlink $duplink</td>";
        echo "<td class='map_width column-map_width'>".$result->map_width."".stripslashes($result->map_width_type)."</td>";
        echo "<td class='map_width column-map_height'>".$result->map_height."".stripslashes($result->map_height_type)."</td>";
        echo "<td class='type column-type'>".$map_type."</td>";
        echo "<td class='type column-type'><input class='wpgmza_copy_shortcode' type='text' readonly value='[wpgmza id=\"".$result->id."\"]'/></td>";
        echo "</tr>";


    }
    echo "</table>";
}

function wpgmaps_duplicate_map($map_id) {
    global $wpdb;
    global $wpgmza_tblname;
    global $wpgmza_tblname_maps;
    
    global $wpgmza_tblname_polylines;
    global $wpgmza_tblname_poly;
    global $wpgmza_tblname_category_maps;
    
    $map_row_data = $wpdb->get_row(
        "
	SELECT *
	FROM $wpgmza_tblname_maps
        WHERE `id` = $map_id
        LIMIT 1
	"
    );
    $insert_row = "";
    $cnt = 1;
    $max_cnt = count(get_object_vars($map_row_data));
    foreach ($map_row_data as $key => $val) {
        if ($key == 'id') { $cnt++; /* dont include the ID column */ } else {
            $insert_array[$key] = $val;
            $cnt++;
        }
    }
    
    
    $rows_affected = $wpdb->insert( $wpgmza_tblname_maps, $insert_array );
    $new_map_id = $wpdb->insert_id;
    
    if (!$new_map_id) { return "Error duplicating the map"; }
    
    
    
    $marker_data = $wpdb->get_results(
        "
	SELECT *
	FROM $wpgmza_tblname
        WHERE `map_id` = $map_id
	"
    );
    
    unset($insert_array);
    $insert_array = array();
    foreach ($marker_data as $marker) {
        $cnt = 1;
        $max_cnt = count(get_object_vars($marker));
        foreach ($marker as $key => $val) {
            if ($key == 'id' || $key == 'map_id') { $cnt++; /* dont include the ID column */ } else {
                $insert_array[$key] = $val;
                $cnt++;
            }
        }
        $insert_array['map_id'] = $new_map_id;
        $rows_affected = $wpdb->insert( $wpgmza_tblname, $insert_array );

    }
    
    
    $polyline_data = $wpdb->get_results(
        "
	SELECT *
	FROM $wpgmza_tblname_polylines
        WHERE `map_id` = $map_id
	"
    );
    
    
    unset($insert_array);
    $insert_array = array();
    foreach ($polyline_data as $polyline) {
        $cnt = 1;
        $max_cnt = count(get_object_vars($polyline));
        foreach ($polyline as $key => $val) {
            if ($key == 'id' || $key == 'map_id') { $cnt++; /* dont include the ID column */ } else {
                $insert_array[$key] = $val;
                $cnt++;
            }
        }
        $insert_array['map_id'] = $new_map_id;
        $rows_affected = $wpdb->insert( $wpgmza_tblname_polylines, $insert_array );

    }
    

    
    $polygon_data = $wpdb->get_results(
        "
	SELECT *
	FROM $wpgmza_tblname_poly
        WHERE `map_id` = $map_id
	"
    );
    
    
    unset($insert_array);
    $insert_array = array();
    foreach ($polygon_data as $polygon) {
        $cnt = 1;
        $max_cnt = count(get_object_vars($polygon));
        foreach ($polygon as $key => $val) {
            if ($key == 'id' || $key == 'map_id') { $cnt++; /* dont include the ID column */ } else {
                $insert_array[$key] = $val;
                $cnt++;
            }
        }
        $insert_array['map_id'] = $new_map_id;
        $rows_affected = $wpdb->insert( $wpgmza_tblname_poly, $insert_array );

    }
    
    
    
    $cat_data = $wpdb->get_results(
        "
	SELECT *
	FROM $wpgmza_tblname_category_maps
        WHERE `map_id` = $map_id
	"
    );
    unset($insert_array);
    $insert_array = array();
    foreach ($cat_data as $cat) {
        $cnt = 1;
        $max_cnt = count(get_object_vars($cat));
        foreach ($cat as $key => $val) {
            if ($key == 'id' || $key == 'map_id') { $cnt++; /* dont include the ID column */ } else {
                $insert_array[$key] = $val;
                $cnt++;
            }
        }
        $insert_array['map_id'] = $new_map_id;
        $rows_affected = $wpdb->insert( $wpgmza_tblname_category_maps, $insert_array );

    }

    return $new_map_id;
    
}


function wpgmza_b_return_heatmaps_list($map_id,$admin = true,$width = "100%") {
    global $wpdb;
    global $wpgmza_tblname_datasets;
    $wpgmza_tmp = "";

    $results = $wpdb->get_results("
	SELECT *
	FROM `".$wpgmza_tblname_datasets."`
	WHERE `map_id` = '".$map_id."' ORDER BY `id` DESC
    ");
    
    $wpgmza_tmp .= "
        
        <table id=\"wpgmza_table_heatmaps\" class=\"display\" cellspacing=\"0\" cellpadding=\"0\" style=\"width:$width;\">
        <thead>
        <tr>
            <th align='left'><strong>".__("ID","wp-google-maps")."</strong></th>
            <th align='left'><strong>".__("Name","wp-google-maps")."</strong></th>
            <th align='left' style='width:182px;'><strong>".__("Action","wp-google-maps")."</strong></th>
        </tr>
        </thead>
        <tbody>
    ";
    $res = wpgmza_get_map_data($map_id);
    $default_marker = "<img src='".$res->default_marker."' />";
    
    foreach ( $results as $result ) {
        unset($data_data);
        unset($data_array);
        $data_data = '';
        if (isset($result->dataset_name) && $result->dataset_name != "") { $dataset_name = $result->dataset_name; } else { $dataset_name = "Dataset".$result->id; }

        $wpgmza_tmp .= "
            <tr id=\"wpgmza_poly_tr_".$result->id."\">
                <td height=\"40\">".$result->id."</td>
                <td height=\"40\">$dataset_name</td>
                <td width='170' align='left'>
                    <a href=\"".get_option('siteurl')."/wp-admin/admin.php?page=wp-google-maps-menu&action=edit_heatmap&map_id=".$map_id."&id=".$result->id."\" title=\"".__("Edit","wp-google-maps")."\" class=\"wpgmza_edit_dataset_btn button\" id=\"".$result->id."\"><i class=\"fa fa-edit\"> </i></a> 
                    <a href=\"javascript:void(0);\" title=\"".__("Delete this dataset","wp-google-maps")."\" class=\"wpgmza_dataset_del_btn button\" id=\"".$result->id."\"><i class=\"fa fa-times\"> </i></a>
                </td>
            </tr>";
        
    }
    $wpgmza_tmp .= "</tbody></table>";
    

    return $wpgmza_tmp;
    
}
function wpgmza_b_return_dataset_array($id) {
    global $wpdb;
    global $wpgmza_tblname_datasets;
    $results = $wpdb->get_results("
	SELECT *
	FROM $wpgmza_tblname_datasets
	WHERE `id` = '$id' LIMIT 1
    ");
    foreach ( $results as $result ) {
        $current_polydata = $result->dataset;
        $new_polydata = str_replace("),(","|",$current_polydata);
        $new_polydata = str_replace("(","",$new_polydata);
        $new_polydata = str_replace("),","",$new_polydata);
        $new_polydata = explode("|",$new_polydata);
        foreach ($new_polydata as $poly) {
            
            $ret[] = $poly;
        }
        return $ret;
    }

}

function wpgmza_b_return_dataset_options($id) {
    global $wpdb;
    global $wpgmza_tblname_datasets;
    $results = $wpdb->get_results("
	SELECT *
	FROM $wpgmza_tblname_datasets
	WHERE `id` = '$id' LIMIT 1
    ");
    foreach ( $results as $result ) {
    	if (isset($result)) { return $result; }
    	else { return false; }
    }
}
function wpgmza_b_return_dataset_id_array($map_id) {
    global $wpdb;
    global $wpgmza_tblname_datasets;
    $ret = array();
    $results = $wpdb->get_results("
	SELECT *
	FROM $wpgmza_tblname_datasets
	WHERE `map_id` = '$map_id'
    ");
    foreach ( $results as $result ) {
        $current_id = $result->id;
        $ret[] = $current_id;
        
    }
    return $ret;
}

function wpgmaps_b_admin_edit_heatmap_javascript($mapid,$polyid) {
        $res = wpgmza_get_map_data($mapid);
        
        $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");


        $wpgmza_lat = $res->map_start_lat;
        
        $wpgmza_lng = $res->map_start_lng;
        $wpgmza_map_type = $res->type;
        $wpgmza_width = $res->map_width;
        $wpgmza_height = $res->map_height;
        $wpgmza_width_type = $res->map_width_type;
        $wpgmza_height_type = $res->map_height_type;
        if (!$wpgmza_map_type || $wpgmza_map_type == "" || $wpgmza_map_type == "1") { $wpgmza_map_type = "ROADMAP"; }
        else if ($wpgmza_map_type == "2") { $wpgmza_map_type = "SATELLITE"; }
        else if ($wpgmza_map_type == "3") { $wpgmza_map_type = "HYBRID"; }
        else if ($wpgmza_map_type == "4") { $wpgmza_map_type = "TERRAIN"; }
        else { $wpgmza_map_type = "ROADMAP"; }
        $start_zoom = $res->map_start_zoom;
        if ($start_zoom < 1 || !$start_zoom) {
            $start_zoom = 5;
        }

        
        $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");

        ?>
        <?php 
		$wpgmza_locale = get_locale();
		$wpgmza_suffix = ".com";
		/* Hebrew correction */
		if ($wpgmza_locale == "he_IL") { $wpgmza_locale = "iw"; }

		/* Chinese integration */
		if ($wpgmza_locale == "zh_CN") { $wpgmza_suffix = ".cn"; } else { $wpgmza_suffix = ".com"; } 

		$wpgmza_locale = substr( $wpgmza_locale, 0, 2 );

        if( get_option( 'wpgmza_google_maps_api_key' ) ){ ?>
	        <script type="text/javascript">
	            var gmapsJsHost = (("https:" == document.location.protocol) ? "https://" : "http://");
	            var wpgmza_api_key = '<?php echo get_option( 'wpgmza_google_maps_api_key' ); ?>';
	            document.write(unescape("%3Cscript src='" + gmapsJsHost + "maps.google<?php echo $wpgmza_suffix; ?>/maps/api/js?v=3.exp&key="+wpgmza_api_key+"&language=<?php echo $wpgmza_locale; ?>&libraries=places,visualization' type='text/javascript'%3E%3C/script%3E"));
	        </script>
	    <?php } else { ?>
	        <script type="text/javascript">
	            var gmapsJsHost = (("https:" == document.location.protocol) ? "https://" : "http://");
	            document.write(unescape("%3Cscript src='" + gmapsJsHost + "maps.google<?php echo $wpgmza_suffix; ?>/maps/api/js?v=3.exp&language=<?php echo $wpgmza_locale; ?>&libraries=places,visualization' type='text/javascript'%3E%3C/script%3E"));
	        </script>
	    <?php } ?>
        <link rel='stylesheet' id='wpgooglemaps-css'  href='<?php echo wpgmaps_get_plugin_url(); ?>/css/wpgmza_style.css' type='text/css' media='all' />
        <script type="text/javascript" >
             // polygons variables
            var poly;
            var heatmap = [];
            var poly_markers = [];
            var poly_path = [];
            var WPGM_PathLineData = [];
            var WPGM_Path = [];
            var poly_path = new google.maps.MVCArray;
            var enable_draw = false;

                
            jQuery(document).ready(function(){
                
                    function wpgmza_InitMap() {
                        var myLatLng = new google.maps.LatLng(<?php echo $wpgmza_lat; ?>,<?php echo $wpgmza_lng; ?>);
                        MYMAP.init('#wpgmza_map', myLatLng, <?php echo $start_zoom; ?>);
                    }
                    jQuery("#wpgmza_map").css({
                        height:'<?php echo $wpgmza_height; ?><?php echo $wpgmza_height_type; ?>',
                        width:'<?php echo $wpgmza_width; ?><?php echo $wpgmza_width_type; ?>'
                    });
                    wpgmza_InitMap();

                    var gradient = jQuery("#heatmap_gradient").html();
                    var opacity = jQuery("#heatmap_opacity").val();
                    var radius = jQuery("#heatmap_radius").val();
					jQuery("#heatmap_radius").focusout();
					jQuery("#heatmap_opacity").keyup();
					jQuery("#heatmap_gradient").keyup();
					poly.set('opacity', jQuery("#heatmap_opacity").val());
                	poly.set('radius', jQuery("#heatmap_radius").val());
	            	 var tmp = jQuery("#heatmap_gradient").html();
					 if (tmp !== "") { var gradient = JSON.parse(tmp); } else { var gradient = null; }
	            	 if (gradient == '1') { poly.set('gradient', null); } else { poly.set('gradient', gradient); }


                    jQuery("#heatmap_radius").focusout(function() {
                    	poly.set('radius', jQuery("#heatmap_radius").val());
                    });
                    jQuery("#heatmap_opacity").keyup(function() {
                    	poly.set('opacity', jQuery("#heatmap_opacity").val());
                    });
                    jQuery("body").on("keyup", "#heatmap_gradient", function() {
		            	 var tmp = jQuery(this).html();
						 var gradient = JSON.parse(tmp);
                    	 if (gradient == '1') { poly.set('gradient', null); } else { poly.set('gradient', gradient); }
                    });

                    
            });
            

            var MYMAP = {
                map: null,
                bounds: null
            }
            MYMAP.init = function(selector, latLng, zoom) {
                  var myOptions = {
                    zoom:zoom,
                    center: latLng,
                    zoomControl: true,
                    panControl: true,
                    mapTypeControl: true,
                    streetViewControl: false,
                    mapTypeId: google.maps.MapTypeId.<?php echo $wpgmza_map_type; ?>
                  }
                this.map = new google.maps.Map(jQuery(selector)[0], myOptions);
                this.bounds = new google.maps.LatLngBounds();

                // polygons
                
                <?php
                $total_dataset_array = wpgmza_b_return_dataset_id_array(sanitize_text_field($_GET['map_id']));
                if ($total_dataset_array > 0) {
                foreach ($total_dataset_array as $poly_id) {
                    $polyoptions = wpgmza_b_return_dataset_options($poly_id);
                    $poly_array = wpgmza_b_return_dataset_array($poly_id);                    





                    if ($polyid != $poly_id) {
						if (sizeof($poly_array) >= 1) { ?>
		                    WPGM_PathLineData[<?php echo $poly_id; ?>] = [
		                    <?php
		                    $poly_array = wpgmza_b_return_dataset_array($poly_id);

		                    foreach ($poly_array as $single_poly) {
		                        $poly_data_raw = str_replace(" ","",$single_poly);
		                        $poly_data_raw = explode(",",$poly_data_raw);
		                        $lat = floatval($poly_data_raw[0]);
		                        $lng = floatval($poly_data_raw[1]);
		                        ?>
                    new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>),            
		                        <?php
		                    }
		                    ?>
		                ];
	              	heatmap[<?php echo $poly_id; ?>] = new google.maps.visualization.HeatmapLayer({data: WPGM_PathLineData[<?php echo $poly_id; ?>]});

                	heatmap[<?php echo $poly_id; ?>].setMap(this.map);

                <?php } } } ?>

                <?php } ?>


                
                addCurrentHeatMap();
                

            }
            function addCurrentHeatMap() {
                <?php
                $poly_array = wpgmza_b_return_dataset_array($polyid);
                    
                $polyoptions = wpgmza_b_return_dataset_options($polyid);
                foreach ($poly_array as $single_poly) {
                    $poly_data_raw = str_replace(" ","",$single_poly);
                    $poly_data_raw = explode(",",$poly_data_raw);
                    $lat = $poly_data_raw[0];
                    $lng = $poly_data_raw[1];
                    ?>
                    var temp_gps = new google.maps.LatLng(<?php echo floatval($lat); ?>, <?php echo floatval($lng); ?>);
                    addExistingPoint(temp_gps);
                    updatePolyPath(poly_path);
                    
                    
                    
                    <?php
                }
                ?>
                poly = new google.maps.visualization.HeatmapLayer({
                  data: poly_path
                });
                poly.setMap(MYMAP.map);


				google.maps.event.addListener(MYMAP.map, 'rightclick', change_draw);

				document.onkeydown = function(evt) {
				    evt = evt || window.event;
				    var isEscape = false;
				    if ("key" in evt) {
				        isEscape = evt.key == "Escape";
				    } else {
				        isEscape = evt.keyCode == 27;
				    }
				    if (isEscape) {
				    	if(!enable_draw){
				        	change_draw(); //Only if draw mode is active
				        }
				    }
				};

				change_draw();
            }
            function addExistingPoint(temp_gps) {
                poly_path.insertAt(poly_path.length, temp_gps);
                var poly_marker = new google.maps.Marker({
                  position: temp_gps,
                  map: MYMAP.map,
                  draggable: true
                });
                poly_markers.push(poly_marker);
                poly_marker.setTitle("#" + poly_path.length);
                google.maps.event.addListener(poly_marker, 'click', function() {
                      poly_marker.setMap(null);
                      for (var i = 0, I = poly_markers.length; i < I && poly_markers[i] != poly_marker; ++i);
                      poly_markers.splice(i, 1);
                      poly_path.removeAt(i);
                      updatePolyPath(poly_path);    
                      }
                    );

                    google.maps.event.addListener(poly_marker, 'dragend', function() {
                      for (var i = 0, I = poly_markers.length; i < I && poly_markers[i] != poly_marker; ++i);
                      poly_path.setAt(i, poly_marker.getPosition());
                      updatePolyPath(poly_path);    
                      }
                    );
            }
            function addPoint(event) {
                
                    poly_path.insertAt(poly_path.length, event.latLng);

                    var poly_marker = new google.maps.Marker({
                      position: event.latLng,
                      map: MYMAP.map,
                      icon: "<?php echo wpgmaps_get_plugin_url()."/images/marker.png"; ?>",
                      draggable: true
                    });
                    

                    
                    poly_markers.push(poly_marker);
                    poly_marker.setTitle("#" + poly_path.length);

                    google.maps.event.addListener(poly_marker, 'click', function() {
                      poly_marker.setMap(null);
                      for (var i = 0, I = poly_markers.length; i < I && poly_markers[i] != poly_marker; ++i);
                      poly_markers.splice(i, 1);
                      poly_path.removeAt(i);
                      updatePolyPath(poly_path);    
                      }
                    );

                    google.maps.event.addListener(poly_marker, 'dragend', function() {
                      for (var i = 0, I = poly_markers.length; i < I && poly_markers[i] != poly_marker; ++i);
                      poly_path.setAt(i, poly_marker.getPosition());
                      updatePolyPath(poly_path);    
                      }
                    );
                        
                        
                    updatePolyPath(poly_path);    
              }
              
              function updatePolyPath(poly_path) {
                var temp_array;
                temp_array = "";
                poly_path.forEach(function(latLng, index) { 
//                  temp_array = temp_array + " ["+ index +"] => "+ latLng + ", ";
                  temp_array = temp_array + latLng + ",";
                }); 
                jQuery("#wpgmza_heatmap_data").html(temp_array);
              }     
              function change_draw() {
            	 if (enable_draw) {
            	 	google.maps.event.clearListeners(MYMAP.map, 'click');
					google.maps.event.addListener(MYMAP.map, 'mousemove', addPoint);
				} else {
            	 	google.maps.event.clearListeners(MYMAP.map, 'mousemove');
					google.maps.event.addListener(MYMAP.map, 'click', addPoint);
				}
            	if (enable_draw) { enable_draw = false; } else { enable_draw = true; }
            }

       
             

        </script>
        <?php
}

function wpgmaps_b_admin_add_heatmap_javascript($mapid) {
        $res = wpgmza_get_map_data(sanitize_text_field($_GET['map_id']));
        $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");


        $wpgmza_lat = $res->map_start_lat;
        $wpgmza_lng = $res->map_start_lng;
        $wpgmza_map_type = $res->type;
        $wpgmza_width = $res->map_width;
        $wpgmza_height = $res->map_height;
        $wpgmza_width_type = $res->map_width_type;
        $wpgmza_height_type = $res->map_height_type;
        if (!$wpgmza_map_type || $wpgmza_map_type == "" || $wpgmza_map_type == "1") { $wpgmza_map_type = "ROADMAP"; }
        else if ($wpgmza_map_type == "2") { $wpgmza_map_type = "SATELLITE"; }
        else if ($wpgmza_map_type == "3") { $wpgmza_map_type = "HYBRID"; }
        else if ($wpgmza_map_type == "4") { $wpgmza_map_type = "TERRAIN"; }
        else { $wpgmza_map_type = "ROADMAP"; }
        $start_zoom = $res->map_start_zoom;
        if ($start_zoom < 1 || !$start_zoom) {
            $start_zoom = 5;
        }

        
        $wpgmza_settings = get_option("WPGMZA_OTHER_SETTINGS");
    	global $api_version_string;
        ?>
        <?php 
		$wpgmza_locale = get_locale();
		$wpgmza_suffix = ".com";
		/* Hebrew correction */
		if ($wpgmza_locale == "he_IL") { $wpgmza_locale = "iw"; }

		/* Chinese integration */
		if ($wpgmza_locale == "zh_CN") { $wpgmza_suffix = ".cn"; } else { $wpgmza_suffix = ".com"; } 

		$wpgmza_locale = substr( $wpgmza_locale, 0, 2 );
		
        if( get_option( 'wpgmza_google_maps_api_key' ) ){ ?>
	        <script type="text/javascript">
	            var gmapsJsHost = (("https:" == document.location.protocol) ? "https://" : "http://");
	            var wpgmza_api_key = '<?php echo get_option( 'wpgmza_google_maps_api_key' ); ?>';
	            document.write(unescape("%3Cscript src='" + gmapsJsHost + "maps.google<?php echo $wpgmza_suffix; ?>/maps/api/js?<?php echo $api_version_string; ?>key="+wpgmza_api_key+"&language=<?php echo $wpgmza_locale; ?>&libraries=places,visualization' type='text/javascript'%3E%3C/script%3E"));
	        </script>
	    <?php } else { ?>
	        <script type="text/javascript">
	            var gmapsJsHost = (("https:" == document.location.protocol) ? "https://" : "http://");
	            document.write(unescape("%3Cscript src='" + gmapsJsHost + "maps.google<?php echo $wpgmza_suffix; ?>/maps/api/js?<?php echo $api_version_string; ?>language=<?php echo $wpgmza_locale; ?>&libraries=places,visualization' type='text/javascript'%3E%3C/script%3E"));
	        </script>
	    <?php } ?>
        <link rel='stylesheet' id='wpgooglemaps-css'  href='<?php echo wpgmaps_get_plugin_url(); ?>/css/wpgmza_style.css' type='text/css' media='all' />
        <script type="text/javascript" >
            	var myLatLng = new google.maps.LatLng(<?php echo $wpgmza_lat; ?>,<?php echo $wpgmza_lng; ?>);
            jQuery(document).ready(function(){
                    function wpgmza_InitMap() {
                        
                        MYMAP.init('#wpgmza_map', myLatLng, <?php echo $start_zoom; ?>);
                    }
                    jQuery("#wpgmza_map").css({
                        height:'<?php echo $wpgmza_height; ?><?php echo $wpgmza_height_type; ?>',
                        width:'<?php echo $wpgmza_width; ?><?php echo $wpgmza_width_type; ?>'
                    });
                    wpgmza_InitMap();
                    jQuery("#heatmap_radius").focusout(function() {
                    	poly.set('radius', jQuery("#heatmap_radius").val());
                    });
                    jQuery("#heatmap_opacity").keyup(function() {
                    	poly.set('opacity', jQuery("#heatmap_opacity").val());
                    });
                    jQuery("body").on("keyup", "#heatmap_gradient", function() {
		            	 var tmp = jQuery(this).html();
						 var gradient = JSON.parse(tmp);
                    	 if (gradient == '1') { poly.set('gradient', null); } else { poly.set('gradient', gradient); }
                    });
                    
                    
            });
             // polygons variables
            var poly;
            var poly_markers = [];
            var poly_path = [];
            var heatmap = [];
            var enable_draw = false;
            var WPGM_PathLineData = [];
            var poly_path = new google.maps.MVCArray;
            <?php 
			$total_dataset_array = wpgmza_b_return_dataset_id_array(sanitize_text_field($_GET['map_id']));
            foreach ($total_dataset_array as $poly_id) {
				
             ?>
            WPGM_PathLineData[<?php echo $poly_id; ?>];
            <?php } ?>
            

            var MYMAP = {
                map: null,
                bounds: null
            }
            MYMAP.init = function(selector, latLng, zoom) {
                  var myOptions = {
                    zoom:zoom,
                    center: latLng,
                    zoomControl: true,
                    panControl: true,
                    mapTypeControl: true,
                    streetViewControl: true,
                    mapTypeId: google.maps.MapTypeId.<?php echo $wpgmza_map_type; ?>
                  }
                this.map = new google.maps.Map(jQuery(selector)[0], myOptions);
                this.bounds = new google.maps.LatLngBounds();
                
                
                poly = new google.maps.visualization.HeatmapLayer({
                  data: poly_path
                });
                poly.setMap(this.map);

				google.maps.event.addListener(this.map, 'rightclick', change_draw);

				document.onkeydown = function(evt) {
				    evt = evt || window.event;
				    var isEscape = false;
				    if ("key" in evt) {
				        isEscape = evt.key == "Escape";
				    } else {
				        isEscape = evt.keyCode == 27;
				    }
				    if (isEscape) {
				        if(!enable_draw){
				        	change_draw(); //Only if draw mode is active
				        }
				    }
				};

				change_draw();
                
               
//				google.maps.event.addListener(this.map, 'click', addPoint);
                <?php
                /* datasets */
                    
                    if ($total_dataset_array > 0) {
                    foreach ($total_dataset_array as $poly_id) {
                        $polyoptions = wpgmza_b_return_dataset_options($poly_id);
                        ?>                
<?php
                        $poly_array = wpgmza_b_return_dataset_array($poly_id);
						if (sizeof($poly_array) >= 1) { ?>
		                    WPGM_PathLineData[<?php echo $poly_id; ?>] = [
		                    <?php
		                    $poly_array = wpgmza_b_return_dataset_array($poly_id);

		                    foreach ($poly_array as $single_poly) {
		                        $poly_data_raw = str_replace(" ","",$single_poly);
		                        $poly_data_raw = explode(",",$poly_data_raw);
		                        $lat = floatval($poly_data_raw[0]);
		                        $lng = floatval($poly_data_raw[1]);
		                        ?>
                    new google.maps.LatLng(<?php echo $lat; ?>, <?php echo $lng; ?>),            
		                        <?php
		                    }
		                    ?>
		                ];
	              	heatmap[<?php echo $poly_id; ?>] = new google.maps.visualization.HeatmapLayer({data: WPGM_PathLineData[<?php echo $poly_id; ?>]});

                	heatmap[<?php echo $poly_id; ?>].setMap(this.map);
                <?php } } } ?> 

            }

            function change_draw() {
            	 if (enable_draw) {
            	 	google.maps.event.clearListeners(MYMAP.map, 'click');
					google.maps.event.addListener(MYMAP.map, 'mousemove', addPoint);
				} else {
            	 	google.maps.event.clearListeners(MYMAP.map, 'mousemove');
					google.maps.event.addListener(MYMAP.map, 'click', addPoint);
				}
            	if (enable_draw) { enable_draw = false; } else { enable_draw = true; }
            }

            function addPoint(event) {
            	poly_path.push(event.latLng);

                var poly_marker = new google.maps.Marker({
                  position: event.latLng,
                  map: MYMAP.map,
                  icon: "<?php echo wpgmaps_get_plugin_url()."/images/marker.png"; ?>",
                  draggable: true
                });
                

                
                poly_markers.push(poly_marker);
                poly_marker.setTitle("#" + poly_path.length);

                google.maps.event.addListener(poly_marker, 'click', function() {
                  poly_marker.setMap(null);
                  for (var i = 0, I = poly_markers.length; i < I && poly_markers[i] != poly_marker; ++i);
                  poly_markers.splice(i, 1);
                  poly_path.removeAt(i);
                  updatePolyPath(poly_path);    
                  }
                );

                google.maps.event.addListener(poly_marker, 'dragend', function() {
                  for (var i = 0, I = poly_markers.length; i < I && poly_markers[i] != poly_marker; ++i);
                  poly_path.setAt(i, poly_marker.getPosition());
                  updatePolyPath(poly_path);    
                  }
                );
                    
                    
                updatePolyPath(poly_path);    
          	}
			function updatePolyPath(poly_path) {
				var temp_array;
				temp_array = "";
				poly_path.forEach(function(latLng, index) { 
					temp_array = temp_array + latLng + ",";
				}); 				
				jQuery("#wpgmza_heatmap_data").html(temp_array);
                
			}           	

                    


        </script>
        <?php
}


function wpgmza_b_pro_add_heatmap($mid) {
    global $wpgmza_tblname_maps;
    global $wpdb;
    if ($_GET['action'] == "add_heatmap" && isset($mid)) {
        $res = wpgmza_get_map_data($mid);
        echo "
            

            
          
           <div class='wrap'>
                <h1>WP Google Maps</h1>
                <div class='wide'>

                    <h2>".__("Add heatmap data","wp-google-maps")."</h2>
                    <form action='?page=wp-google-maps-menu&action=edit&map_id=".$mid."' method='post' id='wpgmaps_add_heatmap_form'>
                    <input type='hidden' name='wpgmaps_map_id' id='wpgmaps_map_id' value='".$mid."' />
                    <table class='wpgmza-listing-comp' style='width:30%;float:left;'>
                        <tr>
                            <td>
                                ".__("Name","wp-google-maps")."
                            </td>
                            <td>
                                <input id=\"poly_line\" name=\"poly_name\" type=\"text\" value=\"\" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ".__("Gradient","wp-google-maps")."
                            </td>
                            <td>
                                <textarea id=\"heatmap_gradient\" name=\"heatmap_gradient\" style='display:none; width:200px; height:200px;' /></textarea><button id='wpgmza_gradient_show' gtype='default' class='wpgmza_gradient_show button button-secondary' />".__("Default","wp-google-maps")."</button> <button id='wpgmza_gradient_show' gtype='blue' class='wpgmza_gradient_show button button-secondary' />".__("Blue","wp-google-maps")."</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ".__("Opacity","wp-google-maps")."
                            </td>
                            <td>
                                <input id=\"heatmap_opacity\" name=\"heatmap_opacity\" type=\"text\" value=\"0.6\" /> (0 - 1.0) example: 0.6 for 60%
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ".__("Radius","wp-google-maps")."
                            </td>
                            <td>
                                <input id=\"heatmap_radius\" name=\"heatmap_radius\" type=\"text\" value=\"20\" />
                            </td>
                                
                    	</tr>
                    </table>
                    <div class='wpgmza_map_seventy'> 
	                    <div id=\"wpgmza_map\">&nbsp;</div>
	                    <p>
	                            <ul style=\"list-style:initial; margin-top: -145px !important;\" class='update-nag update-blue update-slim update-map-overlay'>
	                                <li style=\"margin-left:30px;\">Click on the map to insert a vertex.</li>
	                                <li style=\"margin-left:30px;\">Click on a vertex to remove it.</li>
	                                <li style=\"margin-left:30px;\">Drag a vertex to move it.</li>
	                                <li style=\"margin-left:30px;\">Right-Click to activate 'Draw Mode'.</li>
	                                <li style=\"margin-left:30px;\">Press the 'Escape' key to deactivate 'Draw Mode'.</li>
	                            </ul>
	                    </p>
	                </div>

                    <p>Heatmap data:<br /><textarea name=\"wpgmza_heatmap_data\" id=\"wpgmza_heatmap_data\" style=\"width:90%; height:100px; border:1px solid #ccc; background-color:#FFF; padding:5px; overflow:auto;\"></textarea>
                    


                    <p class='submit'><a href='javascript:history.back();' class='button button-secondary' title='".__("Cancel")."'>".__("Cancel")."</a> <input type='submit' name='wpgmza_save_heatmap' class='button-primary' value='".__("Save Dataset","wp-google-maps")." &raquo;' /></p>

                    </form>
                </div>


            </div>



        ";

    }



}
function wpgmza_b_pro_edit_heatmap($mid) {
    global $wpgmza_tblname_maps;
    global $wpdb;
    if ($_GET['action'] == "edit_heatmap" && isset($mid)) {
        $res = wpgmza_get_map_data($mid);
        $pol = wpgmza_b_return_dataset_options(sanitize_text_field($_GET['id']));
        $options = maybe_unserialize($pol->options);

        echo "
            

           <div class='wrap'>
                <h1>WP Google Maps</h1>
                <div class='wide'>

                    <h2>".__("Edit Dataset","wp-google-maps")."</h2>
                    <form action='?page=wp-google-maps-menu&action=edit&map_id=".$mid."' method='post' id='wpgmaps_edit_heatmap_form'>
                    <input type='hidden' name='wpgmaps_map_id' id='wpgmaps_map_id' value='".$mid."' />
                    <input type='hidden' name='wpgmaps_poly_id' id='wpgmaps_poly_id' value='".sanitize_text_field($_GET['id'])."' />
                    <table class='wpgmza-listing-comp' style='width:30%;float:left;'>
                        <tr>
                            <td>
                                ".__("Name","wp-google-maps")."
                            </td>
                            <td>
                                <input id=\"poly_line\" name=\"poly_name\" type=\"text\" value=\"".$pol->dataset_name."\" />
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ".__("Gradient","wp-google-maps")."
                            </td>
                            <td>
                                <textarea id=\"heatmap_gradient\" name=\"heatmap_gradient\" style='display:none; width:200px; height:200px;' />".stripslashes($options['heatmap_gradient'])."</textarea><button id='wpgmza_gradient_show' gtype='default' class='wpgmza_gradient_show button button-secondary' />".__("Default","wp-google-maps")."</button> <button id='wpgmza_gradient_show' gtype='blue' class='wpgmza_gradient_show button button-secondary' />".__("Blue","wp-google-maps")."</button>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ".__("Opacity","wp-google-maps")."
                            </td>
                            <td>
                                <input id=\"heatmap_opacity\" name=\"heatmap_opacity\" type=\"text\" value=\"".$options['heatmap_opacity']."\" /> (0 - 1.0) example: 0.6 for 60%
                            </td>
                        </tr>
                        <tr>
                            <td>
                                ".__("Radius","wp-google-maps")."
                            </td>
                            <td>
                                <input id=\"heatmap_radius\" name=\"heatmap_radius\" type=\"text\" value=\"".$options['heatmap_radius']."\" />
                            </td>
                                
                    	</tr>                        
                    </table>
                    <div class='wpgmza_map_seventy'> 
                    	<div id=\"wpgmza_map\">&nbsp;</div>
							<p>
	                            <ul style=\"list-style:initial; margin-top: -145px !important;\" class='update-nag update-blue update-slim update-map-overlay'>
	                                <li style=\"margin-left:30px;\">Click on the map to insert a vertex.</li>
	                                <li style=\"margin-left:30px;\">Click on a vertex to remove it.</li>
	                                <li style=\"margin-left:30px;\">Drag a vertex to move it.</li>
	                                <li style=\"margin-left:30px;\">Right-Click to activate 'Draw Mode'.</li>
	                                <li style=\"margin-left:30px;\">Press the 'Escape' key to deactivate 'Draw Mode'.</li>
	                            </ul>
		                    </p>
		            </div>
	                
	                <p>Heatmap data:<br /><textarea name=\"wpgmza_heatmap_data\" id=\"wpgmza_heatmap_data\" style=\"width:90%; height:100px; border:1px solid #ccc; background-color:#FFF; padding:5px; overflow:auto;\">".$pol->dataset."</textarea>
	                    
                    <p class='submit'><input type='submit' name='wpgmza_edit_heatmap' class='button-primary' value='".__("Save Dataset","wp-google-maps")." &raquo;' /></p>

                    </form>
                </div>


            </div>



        ";

    }



}

//add_action("wpgooglemaps_hook_user_js_after_core","wpgooglemaps_pro_full_screen_hook_control_user_js_after_core",10);
function wpgooglemaps_pro_full_screen_hook_control_user_js_after_core() {
    global $wpgmza_p_version;
    wp_register_style( 'wp-google-maps-full-screen', WPGMAPS_DIR.'/css/wp-google-maps-full-screen-map.css',array(),$wpgmza_p_version);
    wp_enqueue_style( 'wp-google-maps-full-screen' );
    wp_register_script('wp-google-maps-full-screen-js', plugins_url('/js/wp-google-maps-full-screen-map.js',__FILE__), array(), $wpgmza_p_version, false);
    wp_enqueue_script('wp-google-maps-full-screen-js');
}



add_filter("wpgmza_filter_marker_add_table_tr","wpgmza_pro_filter_control_marker_add_table_tr",10,3);
function wpgmza_pro_filter_control_marker_add_table_tr($content,$map_data,$settings) {
	$content .= "<tr>".PHP_EOL;
	$content .= "<td>".__("Display on front end","wp-google-maps")."</td>".PHP_EOL;
	$content .= "<td>".PHP_EOL;
    $content .= "	<select name=\"wpgmza_approved\" id=\"wpgmza_approved\">".PHP_EOL;
    $content .= "		<option value=\"1\">".__("Yes","wp-google-maps")."</option>".PHP_EOL;
    $content .= "		<option value=\"0\">".__("No","wp-google-maps")."</option>".PHP_EOL;
    $content .= "	</select>".PHP_EOL;
	$content .= "</td>".PHP_EOL;
	$content .= "</tr>";
	return $content;
}


//add_filter("wpgmza_filter_marker_add_table_tr","wpgmza_pro_filter_control_marker_add_custom_icon_click_tr",10,3);
function wpgmza_pro_filter_control_marker_add_custom_icon_click_tr($content,$map_data,$settings) {
	$content .= "<tr>".PHP_EOL;
	$content .= "<td>".__("On click, change icon to","wp-google-maps")."</td>".PHP_EOL;
	$content .= "<td>".PHP_EOL;
    $content .= "	<span id=\"wpgmza_cmm_custom\"><img src='".wpgmaps_get_plugin_url()."/images/marker.png' border='0' /></span><input id='wpgmza_add_custom_marker_on_click' name=\"wpgmza_add_custom_marker_on_click\" type='hidden' size='35' maxlength='700' value='' />";
    $content .= " 	<input id=\"upload_custom_marker_click_button\" type=\"button\" value=\"".__("Upload Image","wp-google-maps")."\"  /> &nbsp; <small><i>(".__("ignore if you want to use the normal marker","wp-google-maps").")</i></small><br />";
	$content .= "</td>".PHP_EOL;
	$content .= "</tr>";
	return $content;
}



/* Takes three arrays and filters default map data accordingly
 * Data Content Array -  Array with default values
 * Data Keys - Keys to override default values
 * Data Values - Values associated to each key in array
*/
function wpgmza_wizard_data_filter($wpgmza_map_data_content, $wpmgza_map_data_keys, $wpmgza_map_data_values){

    for($i = 0; $i < count($wpmgza_map_data_keys); $i++){
    	if($i < count($wpmgza_map_data_keys) -1){
    		$wpgmza_map_data_content[$wpmgza_map_data_keys[$i]] = $wpmgza_map_data_values[$i]; //Change value at index
    	} else {
    		//Deal with other settings here
    		$new_other_settings = explode("@", $wpmgza_map_data_values[$i]);
    		$other_settings_to_pass = array();

    		for($b = 0; $b <  count($new_other_settings); $b ++){
    			if($b % 2 == 0){
    				//Is key
    				$other_settings_to_pass[ $new_other_settings[ $b ] ] = $new_other_settings[ $b+1 ];
    			}
    		}
    		$wpgmza_map_data_content[$wpmgza_map_data_keys[$i]] = maybe_serialize($other_settings_to_pass);
    	}
    }
    return $wpgmza_map_data_content;
}

if( isset( $_GET['page'] ) && $_GET['page'] == 'wp-google-maps-menu' ){
    if( is_admin() ){
        add_action('admin_enqueue_styles', 'wpgmza_pro_deregister_styles',999);
        add_action('admin_enqueue_scripts', 'wpgmza_pro_deregister_styles',999);        
        add_action('admin_head', 'wpgmza_pro_deregister_styles',999);
        add_action('init', 'wpgmza_pro_deregister_styles',999);
        add_action('admin_footer', 'wpgmza_pro_deregister_styles',999);
        add_action('admin_print_styles', 'wpgmza_pro_deregister_styles',999);        
    }
}

function wpgmza_pro_deregister_styles() {
    global $wp_styles;            
    if (isset($wp_styles->registered) && is_array($wp_styles->registered)) {                
        foreach ( $wp_styles->registered as $script) {                    
            if (strpos($script->src, 'jquery-ui.theme.css') !== false || strpos($script->src, 'jquery-ui.css') !== false) {
                $script->handle = "";
                $script->src = "";
            }
        }
    }
}

/**
 * This changes the global setting variable should the user add "new_window_link='1'" to the short code
 */
add_filter("wpgmza_filter_localize_settings","wpgooglemaps_hook_control_overrides_user_js_settings",10);
function wpgooglemaps_hook_control_overrides_user_js_settings($wpgmza_settings) {
	global $wpgmza_override;
	if (isset($wpgmza_override['new_window_link'])) {
        $wpgmza_settings['wpgmza_settings_infowindow_links'] = (string) $wpgmza_override['new_window_link'];
	}
	return $wpgmza_settings;
}





add_action("wpgooglemaps_hook_user_js_after_core","wpgooglemaps_hook_control_overrides_user_js_after_core",10);
function wpgooglemaps_hook_control_overrides_user_js_after_core() {
	global $wpgmza_override;
	if (isset($wpgmza_override['zoom'])) {
        wp_localize_script( 'wpgmaps_core', 'wpgmza_override_zoom', $wpgmza_override['zoom']);
	}
}
add_action("wpgooglemaps_hook_user_js_after_core","wpgooglemaps_hook_control_overrides_user_js_after_core_markeroverride",10);
function wpgooglemaps_hook_control_overrides_user_js_after_core_markeroverride() {
	global $wpgmza_override;
	if (isset($wpgmza_override['marker'])) {
        wp_localize_script( 'wpgmaps_core', 'wpgmza_override_marker', $wpgmza_override['marker']);
	}
}

function wpgmza_get_allowed_tags(){
   $tags = wp_kses_allowed_html("post");
   $tags['iframe'] = array(
           'src'             => true,
           'width'           => true,
           'height'          => true,
           'align'           => true,
           'class'           => true,
           'style'           => true,
           'name'            => true,
           'id'              => true,
           'frameborder'     => true,
           'seamless'        => true,
           'srcdoc'          => true,
           'sandbox'         => true,
           'allowfullscreen' => true
       );
   $tags['input'] = array(
           'type'            => true,
           'value'           => true,
           'placeholder'     => true,
           'class'           => true,
           'style'           => true,
           'name'            => true,
           'id'              => true,
           'checked'         => true,
           'readonly'        => true,
           'disabled'        => true,
           'enabled'         => true
       );
   $tags['select'] = array(
           'value'           => true,
           'class'           => true,
           'style'           => true,
           'name'            => true,
           'id'              => true
       );
   $tags['option'] = array(
           'value'           => true,
           'class'           => true,
           'style'           => true,
           'name'            => true,
           'id'              => true,
           'selected'        => true
       );
   return $tags;
}