<?php

require __DIR__.'/../vendor/autoload.php';

$app = new arx();

include_once '../app/routes.php';

include_once '../app/filter.php';

$app->run();