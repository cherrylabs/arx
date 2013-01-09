<?php
/**
 * Example of using the ARX KIT, feel free to adapt it for your needs
 * 
 * PHP File - /index.php
 */

/*============================
=            INIT            =
============================*/

//load the arx core and the aConfig.php file
require_once(dirname(__FILE__) . '/arx/core.php'); 

//Here is an example of use to check if a param is defined in aConfig.php
arx::needs('WEB_ROOT');

//Here is an example of autoloading some class and adapters c_xxx and a_xxx refers to arx/classes/xxx.php and arx/adapters/xxx.php
arx::uses('c_form');

// get an arx instance

global $app;

$app = new arx();

// autoload all php files in the web_root/models folder
c_load::php(WEB_ROOT.DS.MODELS);

// hook is usefull to hook any data in a GLOBALS (in your view page simply call c_hook::output('xxx') )
c_hook::add('css', array(
    ARX_CSS.'/bootstrap.css',
    WEB_ROOT.'/libs/css/style.css'
));

c_hook::add('js', array(
    ARX_JS.'/bootstrap.js'
));

// init the default root
c_load::php(WEB_ROOT.DS.'index.php');

/*-----  End of INIT  ------*/