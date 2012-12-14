<?php
/**
 * [ProjectName]
 * PHP File - /a-config.php
 * @description     ARX basic config file
 * @see             arx/config.php for extended settings and URL/Path shortcuts
 * @package         arx
 * @author          Daniel Sum, Stéphan Zych
 * @link            http://www.arx.xxx @endlink
 */

// @todo:
// - clean system settings

global $aConfig;

$aConfig = array(

    // System
    'system' => array(
        'orm' => 'redbean',   // ORM used
        'tpl' => 'savant3',   // template engine used
        'route' => 'slim',    // routing system used
        //'acl' => 'c_acl',
    ),

    // Database
    'db_type' => 'sqlite', // mysql | sqlite
    'db_name' => DIR_ROOT . '/db/arx.sqlite', // database_name | database_filepath
    'db_user' => '',
    'db_pass' => '',
    'db_host' => '',
    'db_charset' => 'utf8',
    'db_prefix' => 't_',

    // Site
    'langs' => array(
        'en'=>'English',
        'fr'=>'French',
        'nl'=>'Dutch'
    ),

    // Mail
    'mail' => array(
        'ssl' => true,
        'type' => 'smtp', //smtp|default
        'port' => 465,
        'host' => 'smtp.gmail.com',
        'login' => 'hello@example.tld',
        'password' => 'azerty',
        'email' => 'hello@example.tld',
        'name' => 'Your name here'
    ),

    // Additional (the more you centralize in a config file, the less you have to configure)
    'google_anaytics' => array(
        'api_key' => ''
    ),
    'google_maps' => array(
        'api_key' => ''
    ),
    'facebook' => array(
        'app_id' => '',
        'app_secret' => '',
        'scope' => 'email,publish_stream,read_friendlists,user_birthday'
    ),

); // $aConfig


define('ZE_LANG', 'en'); // default language
define('ZE_LANGS' , json_encode($aConfig['langs']));

define('ZE_ADMINLOGIN', 'admin');
define('ZE_SALT', 'hp[2d`I2+Z>[5l]@)q`.vc^X[DUcPIH8gY07#R}DL)L+NjwJ(1q0%C/!C)lpjc,T'); // https://api.wordpress.org/secret-key/1.1/salt/
define('ZE_ALGO', 'sha1'); //sha1, sha256, md5 allowed
define('ZE_ADMINPWD', 'admin');

define('ZE_DBNAME', $aConfig['db_name']);
define('ZE_DBUSER', $aConfig['db_user']);
define('ZE_DBPASSWORD', $aConfig['db_pass']);
define('ZE_DBHOST', $aConfig['db_host']);
define('ZE_DBCHARSET', $aConfig['db_charset']);
define('ZE_DBTYPE', $aConfig['db_type']);
define('ZE_DBPREFIX', $aConfig['db_prefix']);



// Multi-environments (feel free to adapt to your need)
if (preg_match( '/loc/' , $_SERVER['SERVER_NAME'])) {
    
    define('ZE_ENV' , 'local');
    define('LEVEL_ENV' , 0);

    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('display_errors', 1);

    error_reporting(E_ALL & ~E_NOTICE);

    $aConfig['facebook']['app_id'] = '';
    $aConfig['facebook']['app_secret'] = '';

} elseif (preg_match( '/dev/' , $_SERVER['SERVER_NAME'] )) {

    define('ZE_ENV' , 'dev');
    define('LEVEL_ENV' , 1);

    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    
    error_reporting(E_ALL & ~E_NOTICE);
    
    $aConfig['facebook']['app_id'] = '';
    $aConfig['facebook']['app_secret'] = '';

} elseif (preg_match( '/demo/' , $_SERVER['SERVER_NAME'] )) {

    define('ZE_ENV' , 'demo');
    define('LEVEL_ENV' , 2);
    
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);

    $aConfig['facebook']['app_id'] = '206342166168916';
    $aConfig['facebook']['app_secret'] = '42afbb4078f80b0c81ef6fc00261a72b';

} else {

    define('ZE_ENV' , 'www');
    define('LEVEL_ENV' , 3);
    
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    
    $aConfig['facebook']['app_id'] = '';
    $aConfig['facebook']['app_secret'] = '';

}

