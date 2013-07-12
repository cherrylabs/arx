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

use Arx\Classes\Request;
use Arx\classes\View;

class adapterRoute extends \Arx\facades\Route{

}


$app = new Arx();

$app->before(function(){
});

$app->after(function(){

});

$app->get('/', function() use ($app){
    return View::make('index', array(
        'content' => 'test'
    ));
});

$app->get('/{value}', function($value){
    echo $value;
});

$app->post('/admin', function(){
   return 'tre';
});

$app->run();

/*-----  End of INIT  ------*/