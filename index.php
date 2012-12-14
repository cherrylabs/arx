<?php
/**
 * ProjectName
 * PHP File - /index.php
 * @complementary   informations
 */

// @todo:
// - do something

require_once(dirname(__FILE__) . '/arx/core.php');

// arx::uses('');

global $app, $_config;

$app = new arx();

predie( _L('hello_world') );

$app->route->map('/:mix', function ($mix) use ($app, $_config) {

    if (in_array($mix, $_config['langs'] )) {
        $_GET['lang'] = $mix;

        $app->route->redirect('/' . $mix . '/');
    }
    //  else {
    //     // detected language
    //     $app->route->redirect('/' . c::get_lang() . '/' . $mix . '/');
    // }

}); // /:mix

$app->route->map('/', function () use ($app) {

    $app->route->redirect('/home');

}); // /


$app->run();
