<?php

require __DIR__.'/../vendor/autoload.php';

use Arx\Classes\App;

$app = new arx();

include_once '../app/routes.php';

//include_once '../app/filters.php';

$app->run();