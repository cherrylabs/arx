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

$manifest->title = "A Dashboard";

$manifest->description = "Lorem ipsum sic doloret";

$manifest->icon = "icon-home";

$manifest->submenu[] = array("url" => "users", "icon" => "icon-user");

$manifest->submenu[] = array("url" => "settings", "icon" => "icon-user");

$manifest->modes = array('widget','full','lightbox');

$manifest->output();