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
        'title' => 'Basta',
        'licence' => 'http://cherrypulp.com/licence',
        'url' => 'http://basta.oxfamsol.be',
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
        'db' => 'Arx\a_db'
    ),

    // Database
    'database' => array(
        'driver' => 'mysql', // mysql | sqlite
        'database' => 'basta', // database name || database filepath
        'username' => 'basta',
        'password' => 'VkRMtNjr',
        'host' => 'localhost',
        'charset' => 'utf8',
        'prefix' => '',
    ),

    // Site
    'langs' => array(
        'fr' => 'Français'
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
    ini_set('display_errors', 1);
    ini_set('log_errors', 1);

}

return $arxConfig;