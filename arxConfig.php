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
        'database' => '/app/database/production.sqlite', // database name || database filepath
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
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);
} else {
    ini_set('display_errors', 0);
    ini_set('log_errors', 1);

}

return $arxConfig;