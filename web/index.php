<?php
/**
 * Bootstrap
 */

arx::uses('app_aDataManager');

global $app;

// change the root url
chdir(dirname(__FILE__));

define('VIEWS_PAGE', VIEWS.DS.'page');

/*===============================
=            ROUTING            =
===============================*/

// Using the Ruby pattern for routing (example of default using)

$app->route->map('/:controller(/:action)(/:param1)(/:param2)(/:param3)', function() use ($app) {

    $aArgs = func_get_args();
    $iArgs = func_num_args();

    $aParam = array();

    foreach ($aArgs as $key => $value) {
        if($key == 0)	$controller = $value;
        elseif($key == 1)	$action = $value;
        else $aParam[] = $value;
    }

    //CHECK if there is controller
    if(is_file(WEB_ROOT.DS.CTRL.DS.$controller.CTL))
        include( WEB_ROOT.DS.CTRL.DS.$controller.CTL );
    else
        include( WEB_ROOT.DS.CTRL.DS.'index'.CTL );

    if ($iArgs > 1) {
        $classController = 'ctrl_'.$controller;
        $app_controller = new $classController($app);
        call_user_func_array(array($app_controller,$action), $aParam);
    }

    //CHECK if there is a js controller with the same name
    if (is_file(WEB_ROOT.DS.JS.DS.$controller.'.js')) {
        c_hook::js( WEB_ROOT.DS.URL_ROOT.'/'.JS.'/'.$controller.'.js');
    }

    // Check if there is a views for the controller (if not by default html5 tpl)
    if(is_file(WEB_ROOT.DS.VIEWS.DS.$controller.TPL))
        $app->display(WEB_ROOT.DS.VIEWS.DS.$controller.TPL);
    else
        $app->display(WEB_ROOT.DS.VIEWS.DS.'html5'.TPL);

})->via('GET','POST','DELETE','PUT');

$app->route->get('/', function() use ($app) {

    $controller = 'index';

    include( WEB_ROOT.DS.CTRL.DS.$controller.CTL );

    // Check if there is a views for the controller (if not by default html5 tpl you can find the sample file in arx/views/html5.tpl)
    if(is_file(WEB_ROOT.DS.VIEWS.DS.$controller.TPL))
        $app->display(WEB_ROOT.DS.VIEWS.DS.$controller.TPL);
    else
        $app->display('html5');

})->via('GET', 'POST', 'DELETE', 'PUT');

$app->run();

/*-----  End of ROUTING  ------*/