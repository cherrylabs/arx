<?php

require dirname(__FILE__).'/vendor/autoload.php';

$app = new arx();

$app->get('/', function() use ($app){
    $ctrl = new \Arx\ctrl_install();
    $ctrl->setup();
});

$app->run();