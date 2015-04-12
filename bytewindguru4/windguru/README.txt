
                   README for windguru.inc.php (version 1.7)

================================================================================
                                  REQUIREMENTS
================================================================================

- PHP 4 or PHP 5

- MySQL or PostgreSQL or at least one writable directory for caching the 
forecasts.


================================================================================
                                  INSTALLATION
================================================================================

 IF YOU ARE UPGRADING FROM PREVIOUS VERSION SEE 'UPGRADING' SECTION BELOW...

 1) On windguru.cz go to windguru user settings -> forecasts for webmasters 
 section. Fill the form with forecasts options and configure up to 10 forecasts
 which you want to use on your website.  
 
 2) Upload 'windguru.inc.php' and 'windguru.config.php' to directory which is 
 specified in include_path in your php configuration (php.ini) so that PHP can
 find them
 
 3) Edit 'windguru.config.php' as needed. You have to decide which cache type 
 you are going to use, you have 3 possibilites: mysql, postgresql or file. If 
 you use 'mysql' for the cache, use 'mysql_tables.sql' to create the necessary 
 tables in your database, if you use 'postgresql' use 'postgresql_tables.sql'. 
 If you can't or do not want to use any database use 'file'. Depending on the 
 type of cache you use, edit the appropriate options. If you use 'file' you need 
 a directory where your webserver can write to / read from. See the comments in 
 'windguru.config.php'
 
 4) Upload 'wg_images' directory (contains the GIFs with wind arrows, windguru 
 logo, css etc..) to the same directory where are your PHP scripts which show the 
 windguru forecasts.

 5) To test if it works, upload 'windguru_forecast_test.php' to the same 
 directory where are your PHP scripts which show the windguru forecasts and try 
 in your browser. You should see Spain - Tarifa forecast with windguru logo and 
 information about the cache test. 
 
 If you see the forecast as expected and cache test says OK then you are ready. 
 If not check your configuration. 
 
 IF YOU SEE THE FORECAST BUT CACHE TEST FAILS, DO NOT START USING THE SCRIPTS! 
 (you could cause windguru server overload) 
 
 6) After your test is succesfull include the forecasts to your PHP scripts 
 using this:
 
 ...
 <?php
 
 require_once('windguru.inc.php');  // this will load the necessary classes

 windguru_forecast(100,'SOME_CODE'); // includes your forecast for spot id=100 
 windguru_forecast(100,'SOME_CODE','fr'); // the same but in french language
 
 // these are only examples!  
 // replace 100 (spot id) and 'SOME_CODE' with the right one - you will see after 
 // configuring the forecast in point 1) - see see "PHP code" from forecast 
 // configuration on windguru.cz
 ?>
 ...
 
 7) Link the windguru style sheet inside the <head> section of your PHP forecast
 page like this:
 <link rel="stylesheet" href="wg_images/wgstyle.css" type="text/css">
 you can modify the css file if you need
 

================================================================================
                                   UPGRADING 
================================================================================

 Replace old windguru.inc.php with the new version of windguru.inc.php

================================================================================
                                 TROUBLESHOOTING 
================================================================================
 
 IF you see this PHP warning:
 "Warning: file(): URL file-access is disabled in the server configuration"
 make sure you have "allow_url_fopen = On" in your php.ini or use CURL download 
 method instead (you can set this in windguru.config.php)
 
 If the forecast looks ugly, make sure you did include the style sheet - see 
 Installation, 7)
 
 If you make changes to your forecast preferences in your windguru settings,  
 it is possible that you will need to wait till the next model update to take
 effect
 
================================================================================
                                     NOTES
================================================================================
 
 - USE THE SCRIPTS AT YOUR OWN RISK! If your server burns down or your cat dies, 
 it was your fault.
 
 - !!!! DO NOT EDIT 'windguru.inc.php' WITHOUT ASKING FOR PERMISSION !!!!
 
 - If you would like to modify/improve 'windguru.inc.php' mail to 
 <vhornik@seznam.cz> 
 
 - Send bug reports to <vhornik@seznam.cz>
 
 - If you have troubles mail to vhornik@seznam.cz
 
 - Please be patient when waiting for my answers.


Contact: Vaclav Hornik <vhornik@seznam.cz>
Date: 3. 9. 2010