<?php
/*
Plugin Name: WordPress Arx Plugin
Description: Plate-forme ARX pour wordpress
Version: 0.1
License: GPL
Author: Daniel Sum
Author URI: http://www.arx.xxx
*/

require_once(dirname(__FILE__).'/arx/core.php');

add_action('admin_menu', 'arx');
function arx() {
	// Add a new submenu under tools
	add_menu_page('ARX','ARX','edit_themes', basename(__FILE__), 'arxInit');
}

add_filter('plugin_action_links_'.plugin_basename(__FILE__),"arx_addConfigureLink", 10, 2);
function arx_addConfigureLink($links) { 
	$link = '<a href="tools.php?page=arx.php">' . __('Settings') . '</a>';
	array_unshift( $links, $link ); 
	return $links; 
}

function arxInit(){
	require_once(DIR_ADMIN . '/index.php');
}