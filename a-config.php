<?php
/**
	* @file
	*	Configure almost all usefull settings that needs to be configurated
	* @see arx/config.php for extended settings
	* @package	arx
	* @author *Daniel Sum
	* @link http://www.arx.xxx	@endlink
	* @comments on our conventions :
	- Use hungarian notification to define your variable : $mXx = mix variable, $oXx = object, $aXx = array, $sXx = string, $iXx = int
	- Use 'ZE_' to define a global, DIR_XX to define a dir, XX to define a common folder name
	- Use 'c_xx' to define a class refering to arx/classes/xx
	- Use 'a_xx' to define an adapters refering to arx/adapters/xx
	- be Creative And RefleXible
	* @todo cleaning the settings
*/

/**
 @see arx/config.php for extended and conventionnal settings
 @example : DIR_ROOT = root, DIR_CLASS = arx/classes/, DIR_VIEWS = /views, DIR_APP_VIEWS = apps/views etc.
*/ 
require_once(dirname(__FILE__).'/arx/config.php');

$GLOBALS['cfg'] = array(
	
	// Database config
	'db' => array(
		'type' => 'sqlite', // mysql | sqlite
		'name' => DIR_ROOT.'/db/arx.sqlite', // database_name | database_filepath
		'user' => '',
		'password' => '',
		'host' => '',
		'charset' => 'utf8',
		'prefix' => 't_'
	),
	
	// Languages config
	'languages' => array(
		 'en' => 'English'
		,'fr' => 'French'
	),
	
	// System config
	'system' => array(
		 'orm' => 'a_redbean' // define the default ORM to be used
		,'tpl' => 'a_savant3' // define the default template engine used
		,'route' => 'a_slim'
		,'acl' => 'c_acl' //
	)
);




/*----- DATABASE CONFIGURATION -----*/

$GLOBALS['ZE_DBTYPE'] = $GLOBALS['cfg']['db']['type'];

$GLOBALS['ZE_DBNAME'] = $GLOBALS['cfg']['db']['name'];

$GLOBALS['ZE_DBUSER'] = $GLOBALS['cfg']['db']['user'];

$GLOBALS['ZE_DBPASSWORD'] = $GLOBALS['cfg']['db']['password'];

$GLOBALS['ZE_DBHOST'] = $GLOBALS['cfg']['db']['host'];

$GLOBALS['ZE_DBCHARSET'] = $GLOBALS['cfg']['db']['charset'];

$GLOBALS['ZE_DBPREFIX'] = $GLOBALS['cfg']['db']['prefix'];


/*----- SITE CONFIGURATION -----*/

define( 'ZE_LANGS' , json_encode(array(
		  'en'=>'English'
		 ,'fr'=>'French'
		 //Put your additionnal language here (format isocode)
		)));

define('ZE_LANG','en');

define('ZE_ADMINUSER','admin');

define('ZE_SALTKEY', 'hp[2d`I2+Z>[5l]@)q`.vc^X[DUcPIH8gY07#R}DL)L+NjwJ(1q0%C/!C)lpjc,T'); // feel free to change it !

define('ZE_ADMINPWD', 'admin');


/*----- ADDITIONNAL CONFIG -----*/

// Put any additionnal config here the more you centralize in a config file, the less you have to configure

$GLOBALS['ZE_GOOGLEANALYTICS']['api_key'] = 'UA-XXXXX-X';

$GLOBALS['ZE_GOOGLEMAP']['api_key'] = '';

$GLOBALS['ZE_FACEBOOK'] = array('APPID' => '', 'APPSECRET' => '');


/*----- MULTIENVIRONNMENT CONFIGURATION -----*/

//feel free to adapt to you need
if( preg_match( '/localhost/' , $_SERVER['SERVER_NAME'] ))
{ 
	define( 'ZE_ENV' , 'local');
	define( 'LEVEL_ENV' , 0);
	ini_set('display_errors', 1);
	ini_set('log_errors', 1);
	ini_set('display_errors', 1);
	error_reporting(E_ALL & ~E_NOTICE);
}
elseif( preg_match( '/dev/' , $_SERVER['SERVER_NAME'] ))
{ 
	define( 'ZE_ENV' , 'dev');
	define( 'LEVEL_ENV' , 1);
	ini_set('display_errors', 1);
	ini_set('log_errors', 1);
	error_reporting(E_ALL & ~E_NOTICE);
}
elseif( preg_match( '/demo/' , $_SERVER['SERVER_NAME'])){
	define( 'ZE_ENV' , 'demo');
	define( 'LEVEL_ENV' , 2);
	ini_set('display_errors', 0);
	ini_set('log_errors', 1);
}
else{
	define( 'ZE_ENV' , 'www');
	define( 'LEVEL_ENV' , 3);
	ini_set('display_errors', 0);
	ini_set('log_errors', 1);
}

define( 'ZE_DBNAME', $GLOBALS['ZE_DBNAME']);

define( 'ZE_DBUSER', $GLOBALS['ZE_DBUSER']);

define( 'ZE_DBPASSWORD', $GLOBALS['ZE_DBPASSWORD']);

define( 'ZE_DBHOST', $GLOBALS['ZE_DBHOST']);

define( 'ZE_DBCHARSET', $GLOBALS['ZE_DBCHARSET']);

define( 'ZE_DBTYPE', $GLOBALS['ZE_DBTYPE']);

define( 'ZE_DBPREFIX', $GLOBALS['ZE_DBPREFIX']);


require_once(dirname(__FILE__).'/arx/core.php'); // prevent misloading