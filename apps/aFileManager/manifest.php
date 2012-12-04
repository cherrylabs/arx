<?php
/**
	 * Manifest
	 * @author Daniel Sum
	 * @version 0.1
	 * @package arx
	 * @description : 
	 * @comments :
*/

require_once('core.php');

$manifest = new c_manifest();

$manifest->version = "0.1";

$manifest->title = "File Manager";

$manifest->description = "Lorem ipsum sic doloret";

$manifest->icon = "icon-file";

$manifest->modes = array('widget','full','lightbox');

$manifest->output();