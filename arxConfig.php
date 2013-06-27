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

$arxConfig = arxConfig()->load(__DIR__.'/app/config');

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