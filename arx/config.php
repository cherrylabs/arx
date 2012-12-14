<?php
/**
 * Config file
 * 
 * 
 * @file
 *  
 * @package 87seconds
 * @author Daniel Sum
 * @link   @endlink
 * @see 
 * @description
 * 
 * @todo cleaning the config file
*/

define('DIR_ROOT', dirname(dirname(__FILE__)) );


/*if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) {
  define("HTTP", "https://"); // DEFINE PROTOCOL
  define('IS_HTTPS', true);
} else {
  define("HTTP", "http://");
  define('IS_HTTPS', false);
}*/

//define("URL_ROOT", HTTP.$_SERVER['HTTP_HOST'].substr_replace(dirname($_SERVER['PHP_SELF']), '', -1)); // DEFINE WEBROOT PATH

if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443)
{
  define( 'IS_HTTPS', true); 
}

define( 'HTTP', 'http'.(defined('IS_HTTPS') ? 's' : '').'://');

define( 'URL_ROOT', HTTP.$_SERVER['HTTP_HOST'] . str_replace($_SERVER['DOCUMENT_ROOT'],'',dirname(dirname(__FILE__))) );

define( 'DIR_FILE', str_replace('//', '/' , $_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI']) );
define( 'URL_FILE', URL_ROOT.$_SERVER['REQUEST_URI'] );

define( 'EXT_PHP' , '.php' );
define( 'ZE_EXT', EXT_PHP);
define( 'TPL' , '.tpl');
define( 'CTL' , '.php');
define( 'EXT_TPL' , '.tpl'.ZE_EXT );
define( 'EXT_CTL' , '.ctl'.ZE_EXT );

define('DS', '/');

define('ZE_DEBUG', 'ZE_DEBUG');

/*----- PATH CONFIGURATION -----*/

define( 'CSS', 'css');
define( 'JS', 'js');
define( 'IMG', 'img');
define( 'INC', 'inc');
define( 'LIBS', 'libs');
define( 'APPS', 'apps');
define( 'ADMIN', 'arxmin');
define( 'MODELS', 'models');
define( 'VIEWS', 'views');
define( 'CTRL', 'controllers');
define( 'ARX', 'arx');
define( 'CLASSES', 'classes');
define( 'ADAPTERS', 'adapters');
define( 'HELPERS', 'helpers');

define( 'ROOT_ADMIN', DIR_ROOT . DS . ADMIN );
define( 'DIR_APPS', DIR_ROOT . DS . APPS );
define( 'DIR_CSS', DIR_ROOT . DS . CSS );
define( 'DIR_JS', DIR_ROOT . DS . JS );
define( 'DIR_INC', DIR_ROOT . DS . INC );
define( 'DIR_LIBS', DIR_ROOT . DS . LIBS );

define( 'DIR_MODELS', DIR_ROOT . DS . MODELS );
define( 'DIR_VIEWS', DIR_ROOT . DS . VIEWS );
define( 'DIR_CTRL', DIR_ROOT . DS . CTRL );

define( 'DIR_ARX', DIR_ROOT . DS . ARX );

define( 'DIR_CLASSES', DIR_ARX . DS . CLASSES);
define( 'DIR_ADAPTERS', DIR_ARX . DS . ADAPTERS);
define( 'DIR_HELPERS', DIR_ARX . DS . HELPERS);

define( 'ARX_CLASSES' , DIR_ARX . DS . CLASSES);
define( 'ARX_ADAPTERS' , DIR_ARX . DS . ADAPTERS);
define( 'ARX_VIEWS' , DIR_ARX . DS . VIEWS);
define( 'ARX_LIBS' , DIR_ARX . DS . LIBS);
define( 'ARX_HELPERS' , ARX_VIEWS . DS . HELPERS);
define( 'ARX_CSS' , URL_ROOT . DS. ARX . DS . LIBS . DS . CSS );
define( 'ARX_JS' , URL_ROOT . DS. ARX . DS . LIBS . DS . JS);
define( 'ARX_INC' , ARX_LIBS . DS . INC);

define( 'LIBS_CSS' , ARX_CSS );
define( 'LIBS_JS' , ARX_JS );
define( 'LIBS_INC' , ARX_LIBS . DS . INC);


define( 'HOOK' , 'arx_hook');

define( 'SYSPATH', DIR_CLASSES); //needed for Kohana