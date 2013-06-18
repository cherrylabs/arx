<?php

/**
 * aConfig for Arx
 *
 * @author Daniel Sum <daniel@cherrylabs.net>
 * @link http://www.cherrylabs.net
 * @copyright Copyright &copy; 2010-2012 cherrylabs.net
 * @license http://www.cherrylabs.net/licence
 * @package arx
 * @since 1.0
 */

/*=======================================
=            GLOBALS CONFIG            =
=======================================*/

# variables that need to be accessible from anywhere and can potentially change or be a scalable variable

global $arxConfig;

$arxConfig = array(

    'project' => array(
        'title' => '',
        'licence' => '',
        'url' => '',
        'authors' => array(
            "Daniel Sum" => 'daniel@cherrypulp.com',
            "Stephan Zych" => 'stephan@cherrypulp.com',
        ),
    ),

    // System
    'system' => array(
        'app' => 'Arx\c_app',
        'route' => 'Arx\c_route',
        'template' => 'Arx\c_template',
        'auth' => 'Arx\c_auth',
        'db' => 'Arx\c_db'
    ),

    // Database
    'database' => array(
        'driver' => 'sqlite', // mysql | sqlite
        'database' => '/files/db.sqlite', // database name || database filepath
        'username' => '',
        'password' => '',
        'host' => '',
        'charset' => 'utf8',
        'prefix' => '',
    ),

    // Site
    'langs' => array(
        'en' => 'English',
        'fr' => 'Français'
    ),

    // Mail
    'mail' => array(

    )
);

/*-----  End of GLOABALS CONFIG  ------*/

/*=========================================
=            Middleware CONFIG            =
=========================================*/

# variables that change depending the staging (feel free to adapt to your need)

if (preg_match('/loc|localhost/', $_SERVER['SERVER_NAME'])) {

    define('ZE_ENV', 'local');
    define('LEVEL_ENV', 0);
    defined('ROOT_URL') or define('ROOT_URL', "http://loc.aquascope.be");

    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
    ini_set('display_errors', 1);

    error_reporting(E_ALL & ~E_NOTICE);

} elseif (preg_match('/dev/', $_SERVER['SERVER_NAME'])) {

    define('ZE_ENV', 'dev');
    define('LEVEL_ENV', 1);

    ini_set('display_errors', 1);
    ini_set('log_errors', 1);

    error_reporting(E_ALL & ~E_NOTICE);

} elseif (preg_match('/demo/', $_SERVER['SERVER_NAME'])) {

    define('ZE_ENV', 'demo');
    define('LEVEL_ENV', 2);

    ini_set('display_errors', 0);
    ini_set('log_errors', 1);

} else {

    defined('ZE_ENV') or define('ZE_ENV', 'www');
    defined('LEVEL_ENV') or define('LEVEL_ENV', 3);
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);

}

/*-----  End of Middleware CONFIG  ------*/

/*=======================================
=            CONSTANT CONFIG            =
=======================================*/

defined('ZE_LANG') or define('ZE_LANG', 'en'); // default language
defined('ZE_LANGS') or define('ZE_LANGS', json_encode($arxConfig['langs']));

defined('ZE_SALT') or define('ZE_SALT', 'hp[2d`I2+Z>[5l]@)q`.vc^X[DUcPIH8gY07#R}DL)L+NjwJ(1q0%C/!C)lpjc,T'); // https://api.wordpress.org/secret-key/1.1/salt/
defined('ZE_ALGO') or define('ZE_ALGO', 'sha1'); //sha1, sha256, md5 allowed
defined('ZE_ADMINLOGIN') or define('ZE_ADMINLOGIN', 'admin');
defined('ZE_ADMINPWD') or define('ZE_ADMINPWD', 'admin');

/*-----  End of CONSTANT CONFIG  ------*/

return $arxConfig;