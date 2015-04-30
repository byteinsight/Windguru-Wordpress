<?php  
    if($_POST['wewgpi_hidden'] == 'Y') {  
        //Form data sent  
        $id_user = $_POST['wewgpi_id_user'];  
        update_option('wewgpi_id_user', $id_user);  
  
        $lang = $_POST['wewgpi_lang'];  
        update_option('wewgpi_lang', $lang);  
  
        $encoding = $_POST['wewgpi_encoding'];  
        update_option('wewgpi_encoding', $encoding);  
  
        $download_method = $_POST['wewgpi_download_method'];  
        update_option('wewgpi_download_method', $download_method);  
  
        $cache = $_POST['wewgpi_cache'];  
        update_option('wewgpi_cache', $cache);  
  
        $cache_dir = $_POST['wewgpi_cache_dir'];  
        update_option('wewgpi_cache_dir', $cache_dir);  
        ?>  
        <div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>  
        <?php  
    } else {  
        //Normal page display  
        $id_user = get_option('wewgpi_id_user');  
        $lang = get_option('wewgpi_lang');  
        $encoding = get_option('wewgpi_encoding');  
        $dbpwd = get_option('wewgpi_download_method');  
        $cache= get_option('wewgpi_cache');  
        $cache_dir = get_option('wewgpi_cache_dir');  
    }  
?>
    
<div class="wrap">  
	<?php echo "<h2>Byte Insight Windguru Plugin Options</h2>"; ?>  
  
	<form name="wewgpi_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">  
		<input type="hidden" name="wewgpi_hidden" value="Y"> 
		<?php echo "<h4>General Settings</h4>"; ?>
		<table class = "form-table">
		<tbody>
			<tr>
				<td><?php _e("Windguru User ID: " ); ?></td>
				<td><input type="text" name="wewgpi_id_user" value="<?php echo $id_user; ?>" size="20"></td>
				<td><?php _e("IF YOU DO NOT REMEMBER YOUR ID, SEE YOUR SETTINGS PAGE ON WINDGURU.CZ" ); ?></td>
			</tr>
			<tr>
				<td><?php _e("Language: " ); ?></td>
				<td><input type="text" name="wewgpi_lang" value="<?php echo $lang; ?>" size="20"></td>
				<td><?php _e("'en' = english (default), 'cz' = czech, 'de' = german, 'fr' = french, 'es' = spanish, 'it' = italian.  A complete list of current available languages here: http://www.windguru.cz/int/help_index.php?sec=distr " ); ?></td>
			</tr>	
			<tr>
				<td><?php _e("Encoding: " ); ?></td>
				<td><input type="text" name="wewgpi_encoding" value="<?php echo $encoding; ?>" size="20"></td>
				<td><?php _e("YOUR WEBPAGE ENCODING, FOR EXAMPLE 'UTF-8' if not set then UTF-8 is used, if you only use english version then you will probably never need to set this variable.  if your encoding does not work try the default ''" ); ?></td>
			</tr>
			<tr>
				<td><?php _e("Download Method " ); ?></td>
				<td><input type="text" name="wewgpi_download_method" value="<?php echo $download_method; ?>" size="20"></td>
				<td><?php _e("DOWNLOAD METHOD SETTING - supported values: 'fopen', 'curl'" ); ?></td>
			</tr>
			<tr>
				<td><?php _e("Cache Type " ); ?></td>
				<td><input type="text" name="wewgpi_cache" value="<?php echo $cache; ?>" size="20"></td>
				<td><?php _e("CACHE TYPE SETTING - supported values: 'mysql', 'postgresql', 'file'" ); ?></td>
			</tr>
		
			<tr>
				<td colspan="3">
					<?php echo "<h4>Cache Type continued...</h4>"; ?>
					<p>If you are using the FILE Cache Type you will need to edit the following:</p>
				</td>
			<tr>	
			<tr>
				<td><?php _e("Cache folder: " ); ?></td>
				<td><input type="text" name="wewgpi_cache_dir" value="<?php echo $cache_dir; ?>" size="20"></td>
				<td><?php _e("Your file cache directory (default '.' = current directory)" ); ?></td>
			</tr>
		</tbody></table>
		
		<p class="submit">  
		<input type="submit" name="Submit" value="Update Options" />  
		</p>  
	</form>  
	
	
	
	<h4>Installation Notes</h4>
	<p>The system is configured as default to use the same mysql database as wordpress and pulls its settings from the wp-config file.  Tests against file and postsql are pending.</p>
	<p>If you are using the twenty-ten theme then the #content table declarations from line 508 to 528 really mess with the styling and you'll need to do some work - I'd recommend working with the toolbox theme.</p>
</div>  
	
