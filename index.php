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
require_once dirname(__FILE__).'/vendor/autoload.php';

$app = new arx();

$app->get('/', function() use ($app){

    $app->content('Hello world !');

    $app->display('html', array("menu" => array("test", "test 2")));
});

$app->get('/admin+', 'ctrl_index');


$app->run();

/*-----  End of INIT  ------*/