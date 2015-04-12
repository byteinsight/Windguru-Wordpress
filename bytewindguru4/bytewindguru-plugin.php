<?php
/**
* Plugin Name: Byte Windguru Plugin
* Plugin URL: http://weather.davies-barnard.uk/wordpress-windguru-plugin/
* Version: v4.00
* Author: <a href="http://weather.davies-barnard.uk/wordpress-windguru-plugin/">Chris Davies-Barnard @ Byte Insight</a>
* Description: A plugin that allows you to insert your <a href="http://windguru.com">windguru</a> forecasts into Wordpress.  Uses Windguru 1.7 as its foundation and developed on/for * Wordpress v3.1.3 
*/

/***** Byte Windguru Plugin Class *****/

//Check that my class does not already exist.
if(!class_exists("byteWindguruPlugin")) {

	global $bytewindguru_version;
	$bytewindguru_version = "4.0";

	//Create the wind-guru plugin class
	class byteWindguruPlugin {
	
	
						
		//Constructor for the class
		function byteWindguruPlugin() {
			$this->url = plugins_url();	
		} //End of Constructor
	
	
		//Function to add comment and windguru styling to the template header.
		function addHeaderCode() {
			echo "<!-- This site uses the Byte Windguru Plugin found on http://weather.davies-barnard.uk/wordpress-windguru-plugin -->";
			wp_enqueue_style( 'windguru-theme-overides', plugins_url('/themeoverrides.css', __FILE__ ));
			//wp_enqueue_style( 'windguru-styles', plugins_url('/windguru/wg_images/wgstyle.css', __FILE__ ));
		}
		
	
		//Function to add content into pane.
		function display($station,$id) {
		
			//Set all errors on.
			error_reporting(E_ALL);
			ini_set('display_errors', '1');
				
			//Include the windguru classes
			include_once(WP_PLUGIN_DIR.'/bytewindguru/windguru/windguru.inc.php'); 
								
			//Get forecast from windguru.
			$forecast =  windguru_forecast($station,$id); 
			
			//Update the default wg_images folder with actual location based on the plugins location with the site root.
			$new_path = plugins_url('/bytewindguru/windguru/wg_images');
			$forecast = str_replace('wg_images',$new_path,$forecast);
			
			//$debug = "Station:".$station." & ID: ".$id;
			
			return "<div id='windguru-".$station."' class='bytewindguru'>".$forecast."</div>"; //.$debug;
							
		}
				
		// Display weather observations for posts.
		function display_handler($atts, $content=null) {
			
			// extract our shortcode e.g. [wewgpi station="43" id="ad53f7d7f4"]
			$pairs = array('station' => '','id' => '');
			extract(shortcode_atts($pairs,$atts));
			
			//Return the forecast.
			return $this->display($station,$id);
		}
	
		function install() {
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

			add_option("version", $version);
		}
		
		function install_data() {
			global $wpdb;
		
			$table_name = $wpdb->prefix . "wg_data_status";
			$rows_affected = $wpdb->insert( $table_name, array( 'id' => 0, 'val' => '0' ) );
			$rows_affected = $wpdb->insert( $table_name, array( 'id' => 3, 'val' => '1970-01-01 00:00:00' ) );
			$rows_affected = $wpdb->insert( $table_name, array( 'id' => 10, 'val' => '1970-01-01 00:00:00' ) );
		}
		
		function admin() {  
			include('bytewindguru-admin.php');  
		}  
	  
		function admin_actions() {  
			add_options_page("Windguru Plugin", "Windguru Plugin", 1, "windguru_admin_plugin", array(&$this,'admin'));  
		}  
	  
	
	} // End of Class
		
} //End of IF EXISTS for Class.	

/***** END OF CLASS *****/


//Check a class object has been created
if(class_exists("byteWindguruPlugin")) {
	$bytewindguru = new byteWindguruPlugin();
}

//Run these functions on install
register_activation_hook(__FILE__,array(&$bytewindguru,'install'));
register_activation_hook(__FILE__,array(&$bytewindguru,'install_data'));

//Actions and Filters for the Object
if(isset($bytewindguru)) {
	
	//Actions
	add_action('wp_head',array(&$bytewindguru,'addHeaderCode'),1);
	
	add_action('admin_menu', array(&$bytewindguru,'admin_actions'));  
	
	// Add shortcode support.
	if (function_exists('add_shortcode')) {
		add_shortcode('wewgpi', array(&$bytewindguru,'display_handler'));
	}

}

?>