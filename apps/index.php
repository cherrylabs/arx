<?php
/**
 * Apps controller
 */
require_once(dirname(__FILE__) .'/'.'core.php');

global $app;

$app = new arx();

$app->route->map('/:app(/:controller)(/:action)(/:param1)(/:param2)(/:param3)(/:param4)(/:param5)(/:param6)', function() use ($app) {

    $aArgs = func_get_args();
    $iArgs = func_num_args();

    $aParam = array();

    foreach ($aArgs as $key => $value) {
        if($key == 0)	$app->_app = $_app = $value;
        elseif($key == 1)	$controller = $app->_controller = $value;
        elseif($key == 2)	$action = $app->_action = $value;
        else $aParam[] = $value;
    }

    //CHANGE DIR PATH => RELATIVE TO THE APP FOLDER NOW !! PAID ATTENTION
    
    if (is_dir(dirname(__FILE__).DS.$_app)) {
        define('APP_URL', URL_ROOT.'/'.APPS.'/'.$_app.'/');
        define('APP_ROOT', dirname(__FILE__).DS.$_app);
        define('APP_DIR', '/'.$_app.'/');

        define('ROOT_PATH', APP_ROOT);
        define('BASE_URL', APP_URL);

        chdir(dirname(__FILE__).DS.$_app);
    }

    //Check if there is a core php for the app

    if (is_file('core'.CTL)) {
        require_once 'core'.CTL;
    }

    //CHECK if there is a controller for the apps
    if (is_file(CTRL.DS.$controller.CTL)) {
        require_once CTRL.DS.$controller.CTL;
    } elseif (is_file('index'.CTL)) {
        require_once CTRL.DS.$controller.CTL;
    } else {
        require_once CTRL.DS.'index'.CTL;
    }


    //CHECK if a class ctrl exist
    
    $classController = CTRL.$app->_controller;

    if (class_exists($classController)) {
        
        $app_controller = new $classController($app);

        switch ($iArgs) {
            case 1:
                call_user_func_array(array($app_controller, 'index'));
                break;

            case 2:
                call_user_func_array(array($app_controller, $app->_action));
                break;
            
            default:
                call_user_func_array(array($app_controller, $app->_action), $aParam);
                break;
        }
    }

    //CHECK if there is a js controller
    if (is_file(JS.DS.$controller.'.js')) {
        c_hook::js( URL_ROOT.'/'.JS.'/'.$controller.'.js');
    }

    // Check if there is a views for the controller (if not by default html5 tpl)
    if (is_file($_app.DS.VIEWS.DS.$controller.TPL)) {
        $app->display($_app.DS.VIEWS.DS.$controller.TPL);
    } elseif (is_file($_app.DS.VIEWS.DS.'html5'.TPL)) {
        $app->display($_app.DS.VIEWS.DS.'html5'.TPL);
    }

})->via('GET','POST','DELETE','PUT');

$app->run();