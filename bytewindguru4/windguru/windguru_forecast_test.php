<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title>WindGURU forecast TEST</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<link rel="stylesheet" href="wg_images/wgstyle.css" type="text/css"/>
</head>
<body>
<?php
error_reporting (E_ALL); 
require_once('windguru.inc.php');  // this will load the necessary classes

windguru_forecast(43,'ad53f7d7f4');
windguru_forecast_cachetest(); // run the test
?>
</body>
</html>