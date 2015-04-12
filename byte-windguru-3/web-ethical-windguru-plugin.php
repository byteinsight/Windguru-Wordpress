<?php
/*

Plugin Name: Web-Ethical's Windguru Plugin
Plugin URL: http://web-ethical.co.uk/windguru-plugin
Version: v3.00
Author: <a href="http://web-ethical.co.uk/windguru-plugin">Chris Davies-Barnard @ Web Ethical</a>
Description: A plugin that allows you to insert your <a href="http://windguru.com">windguru</a> forecasts into Wordpress.  Uses Windguru 1.7 as its foundation and developed on/for Wordpress v3.1.3 

*/

/***** Webethical Windguru Plugin Class *****/

//Check that my class does not already exist.
if(!class_exists("webEthicalWindguruPlugin")) {

	global $wewgpi_version;
	$wewgpi_version = "3.0";

	//Create the wind-guru plugin class
	class webEthicalWindguruPlugin {
					
		//Constructor for the class
		function webEthicalWindguruPlugin() {
					
		} //End of Constructor
	
	
		//Function to add comment and windguru styling to the template header.
		function wewgpi_addHeaderCode() {
			echo "<!-- This site uses the Web-Ethical Windguru Plugin found on http://web-ethical.co.uk/windguru-plugin -->";
			echo "<link rel='stylesheet' type='text/css' media='all' href='".get_option('siteurl')."/wp-content/plugins/web-ethical-windguru-plugin/windguru/wg_images/wgstyle.css' />";
		}
		
	
		//Function to add content into pane.
		function wewgpi_display($station,$id) {
		
			//Set all errors on.
			error_reporting(E_ALL);
			ini_set('display_errors', '1');
				
			//Include the windguru classes
			include_once(ABSPATH.'wp-content/plugins/web-ethical-windguru-plugin/windguru/windguru.inc.php'); 
								
			//Get forecast from windguru.
			$forecast =  windguru_forecast($station,$id); 
			
			//Update the default wg_images folder with actual location based on the plugins location with the site root.
			$new_path = get_option('siteurl').'/wp-content/plugins/web-ethical-windguru-plugin/windguru/wg_images';
			$forecast = str_replace('wg_images',$new_path,$forecast);
				
			return $forecast;
							
		}
				
		// Display weather observations for posts.
		function wewgpi_display_handler($atts, $content=null) {
			
			// extract our shortcode e.g. [wewgpi station="43" id="ad53f7d7f4"]
			extract(shortcode_atts(array(
				'station' => '',
				'id' => '',
			), $atts));
			
			//Return the forecast.
			return $this->wewgpi_display($station,$id);
		}

		function wewgpi_install() {
			global $wewgpi_version;
			require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
			
			// wg_data_cache
			$table_name = $wpdb->prefix . "wg_data_cache";
			$sql = "CREATE TABLE " . $table_name . " (
			  `id_spot` int(10) unsigned NOT NULL,
			  `id_model` int(10) unsigned NOT NULL,
			  `lang` char(2),
			  `data` blob NOT NULL,
			  `met` datetime default NULL,
			  `wave` datetime default NULL
			);";
			dbDelta($sql);
			
			// wg_data_status
			$table_name = $wpdb->prefix . "wg_data_status";
			$sql = "CREATE TABLE " . $table_name . " (
			  `id` int(10) unsigned NOT NULL,
			  `val` text
			);";
			dbDelta($sql);
			
 
			add_option("wewgpi_version", $wewgpi_version);
		}
		
		function wewgpi_install_data() {
			global $wpdb;
		
			$table_name = $wpdb->prefix . "wg_data_status";
			$rows_affected = $wpdb->insert( $table_name, array( 'id' => 0, 'val' => '0' ) );
			$rows_affected = $wpdb->insert( $table_name, array( 'id' => 3, 'val' => '1970-01-01 00:00:00' ) );
			$rows_affected = $wpdb->insert( $table_name, array( 'id' => 10, 'val' => '1970-01-01 00:00:00' ) );
		}
		
		function wewgpi_admin() {  
			include('web-ethical-windguru-admin.php');  
		}  
      
		function wewgpi_admin_actions() {  
			add_options_page("Windguru Plugin", "Windguru Plugin", 1, "windguru_admin_plugin", array(&$this,'wewgpi_admin'));  
		}  
      
    
	} // End of Class
	
} //End of IF EXISTS for Class.	

/***** END OF CLASS *****/


//Check a class object has been created
if(class_exists("webEthicalWindguruPlugin")) {
	$wewgpi = new webEthicalWindguruPlugin();
}

//Run these functions on install
register_activation_hook(__FILE__,array(&$wewgpi,'wewgpi_install'));
register_activation_hook(__FILE__,array(&$wewgpi,'wewgpi_install_data'));

//Actions and Filters for the Object
if(isset($wewgpi)) {
	
	//Actions
	add_action('wp_head',array(&$wewgpi,'wewgpi_addHeaderCode'),1);

	add_action('admin_menu', array(&$wewgpi,'wewgpi_admin_actions'));  
	
	// Add shortcode support.
	if (function_exists('add_shortcode')) {
		add_shortcode('wewgpi', array(&$wewgpi,'wewgpi_display_handler'));
	}

}

?>