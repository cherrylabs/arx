<?php
require_once dirname(__FILE__).'/../core.php';

global $app;

$app = new arx();

$app->route->map('/:controller', function($controller) use ($app) {

    include( CTRL.DS.$controller.CTL );

    $app->display(VIEWS.DS.$controller.TPL);

})->via('GET', 'POST', 'DELETE', 'PUT');

$app->route->map('/', function() use ($app) {

    include( CTRL.DS.'index'.CTL );

    $app->display(VIEWS.DS.'index'.TPL);

})->via('GET', 'POST', 'DELETE', 'PUT');

$app->run();
