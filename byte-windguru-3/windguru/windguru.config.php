<?php
/*
CONFIGURATION FILE FOR windguru.inc.php VERSION 1.7 
*/
function WG_config() {
	global $wpdb;
	// #################################################################################	
	// PLEASE EDIT FOLLOWING CONFIGURATION VALUES:
	// #################################################################################	

	$WG_config['id_user']    =  get_option('wewgpi_id_user','0'); // YOUR WINDGURU USER ID (IF YOU DO NOT REMEMBER YOUR ID, SEE YOUR SETTINGS PAGE ON WINDGURU.CZ)

	$WG_config['lang']    = get_option('wewgpi_lang','en'); // DEFAULT LANGUAGE VERSION, possible values:
	//    'en' = english (default), 
	//    'cz' = czech
	//    'de' = german
	//    'fr' = french
	//    'es' = spanish
	//    'it' = italian
	// list of current available languages here: http://www.windguru.cz/int/help_index.php?sec=distr 

	$WG_config['encoding']    = get_option('wewgpi_encoding',''); // YOUR WEBPAGE ENCODING, FOR EXAMPLE 'UTF-8' ...
	// if not set then UTF-8 is used, if you only use english version then you will probably never need to set this variable...
	// if your encoding does not work try the default ''

	$WG_config['cache_type'] = get_option('wewgpi_cache_type','mysql'); // CACHE TYPE SETTING - supported values: 'mysql', 'postgresql', 'file'

	// Depending on the type you set in $WG_config['cache_type'] you must also edit following options:

	// if you use 'file':
	$WG_config['cache_dir'] = get_option('wewgpi_cache_type','.'); // your file cache directory (default '.' = current directory)

	// NOTE: WEBSERVER MUST BE ABLE TO READ FROM AND WRITE TO THAT DIRECTORY!  

	// if you use 'mysql':
	$WG_config['cache_mysql_host']          = DB_HOST; // mysql database hostname / IP
	$WG_config['cache_mysql_port']          = ''; // mysql database port (usually 3306)
	$WG_config['cache_mysql_user']          = DB_USER; // mysql database username
	$WG_config['cache_mysql_password']      = DB_PASSWORD; // mysql database password
	$WG_config['cache_mysql_dbname']        = DB_NAME; // name of your mysql database 
	$WG_config['db_prefix'] 				= $wpdb->prefix;
	// NOTE: IF YOU USE MYSQL, YOU MUST CREATE THE DATABASE TABLES USING 'mysql_tables.sql' IN YOUR DATABASE  

	// if you use 'postgresql':
	$WG_config['cache_postgresql_host']     = 'localhost'; // postgresql database hostname / IP
	$WG_config['cache_postgresql_port']     = '5432'; // postgresql port (usually 5432)
	$WG_config['cache_postgresql_user']     = ''; // postgresql database username
	$WG_config['cache_postgresql_password'] = ''; // postgresql database password
	$WG_config['cache_postgresql_dbname']   = ''; // name of your postgresql database 
	// NOTE: IF YOU USE POSTGRESQL, YOU MUST CREATE THE DATABASE TABLES USING 'postgresql_tables.sql' IN YOUR DATABASE   

	$WG_config['download_method'] = 'fopen'; // DOWNLOAD METHOD SETTING - supported values: 'fopen', 'curl';
	// default is 'fopen', 'fopen' method requires 'allow_url_fopen = On' in php configuration
	// if you want to use "curl" you must have PHP with curl enabled or use the curl php extension 
	// if your PHP is configured with 'allow_url_fopen = Off' (and you can't alter this configuration) you will have to use "curl"

	// #################################################################################	


	return $WG_config;
}

?>