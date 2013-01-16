<?php
require_once dirname(__FILE__).'/../core.php';

//LOAD MODELS 87seconds
arx::uses('c_fileExplorer,a_idiorm');

global $app;

$app = new arx();

$app->route->map('/:controller', function($controller) use ($app) {

    include( CTRL.DS.$controller.CTL );

    // Check if there is a views for the controller (if not by default html5 tpl)
    if(is_file(VIEWS.DS.$controller.TPL))
        $app->display(VIEWS.DS.$controller.TPL);
    else
        $app->display(ARX_VIEWS.DS.'html5'.TPL);

});

$app->route->map('/', function() use ($app) {

    include( CTRL.DS.'index'.CTL );

    $app->display(VIEWS.DS.'index'.TPL);

})->via('GET', 'POST', 'DELETE', 'PUT');

$app->run();
