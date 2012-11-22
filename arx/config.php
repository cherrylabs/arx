<?php
/**
	* Config file
	* @file
	*	
	* @package 87seconds
	* @author Daniel Sum
	* @link 	@endlink
	* @see 
	* @description
	* 
	* @code 	@endcode
	* @comments
	* @todo 
*/

define('DIR_ROOT', (dirname(dirname(__FILE__))));

if(!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443)
{
	define('IS_HTTPS', true); 
}

define('HTTP', 'http'.(defined('IS_HTTPS') ? 's' : '').'://');

define('URL_ROOT', HTTP.str_replace($_SERVER['DOCUMENT_ROOT'], $_SERVER['HTTP_HOST'], DIR_ROOT));

define('DIR_FILE', str_replace('//', '/' , $_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI']) );
define('URL_FILE', HTTP.str_replace('//', '/' , $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']) );

define( 'EXT_PHP' , '.php' );
define( 'ZE_EXT', EXT_PHP);
define( 'EXT_TPL' , '.tpl'.ZE_EXT );
define( 'EXT_CTL' , '.ctl'.ZE_EXT );

define('DS', DIRECTORY_SEPARATOR);

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

define( 'LIBS_CSS' , ARX_CSS . DS);
define( 'LIBS_JS' , ARX_JS . DS);
define( 'LIBS_INC' , ARX_LIBS . DS . INC);


define( 'HOOK' , 'arx_hook');

define( 'SYSPATH', DIR_CLASSES); //needed for Kohana

/*----- SETTING COMMON PATH FOR APPS -----*/

define( 'COMMON' , '_common' );

define( 'DIR_COMMON' , DIR_APPS.DS.COMMON );

define( 'COMMON_JS'	, DIR_APPS.DS.COMMON . DS . JS);
define( 'COMMON_CSS' , DIR_APPS.DS.COMMON . DS . CSS);
define( 'COMMON_IMG' , DIR_APPS.DS.COMMON . DS . IMG);
define( 'COMMON_INC' , DIR_APPS.DS.COMMON . DS . INC);
define( 'COMMON_VIEWS' , DIR_APPS.DS.COMMON . DS . VIEWS);