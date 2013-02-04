<?php
/**
     * Manifest
     * @author Daniel Sum
     * @version 0.1
     * @package arx
     * @description :
     * @comments :
*/

require_once 'core.php';

$manifest = new c_manifest();

$manifest->version = "0.1";

$manifest->title = "Content Manager";

$manifest->description = "Lorem ipsum sic doloret";

$manifest->icon = "icon-sitemap";

$manifest->submenu[] = array("url" => "panels/users.php", "icon" => "icon-user");

$manifest->topmenu[] = array("url" => "panels/users.php", "icon" => "icon-wrench");

$manifest->modes = array('widget','full','lightbox');

$manifest->require = array("table" => array("t_data", "t_data_tree", "t_data_table"));

$manifest->output();
