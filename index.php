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

//Here is an example of use arx to simply check if a param is defined in aConfig.php
arx::needs('WEB_ROOT');

//Here is an example of autoloading some class and adapters c_xxx and a_xxx refers to arx/classes/xxx.php and arx/adapters/xxx.php
arx::uses('c_form,a_vimeo');

// get an arx instance

global $app;

$app = new arx();

// init the default root
c_load::php(WEB_ROOT.DS.'index.php');

/*-----  End of INIT  ------*/