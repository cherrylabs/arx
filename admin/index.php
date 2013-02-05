<?php

require_once dirname(__FILE__) . '/core.php';

arx::uses('c_i18n,c_user');

$app = new arx();

$app->get('/logout', 'map_logout');

function map_logout()
{
    c_user::destruct();
}

if ( c_user::granted($_POST['login'], $_POST['password']) ) {

    global $aConfig;

    $app->user = $_SESSION[ ZE_USER ];

    $app->title = $aConfig['project']['title'];

    $aFound = c_fm::findIn( DIR_APPS, array( 'pattern' => '/*/manifest.php' ) );

    $aApps = array();

    $aMenu = array();

    foreach ($aFound as $key => $oApp) {

        $path = u::getUrlPath($oApp);

        //predie(u::getUrlFile($app));

        $r = u::get_json($oApp);

        if( !empty( $r->url ) )
            $path = $r->url;

        //TODO : clean url

        $path = str_replace(array('http://http://'),array('http://'), $path);

        if( empty( $r->icon ) )
            $r->icon = 'icon-cog';

        $aMenu[] = array(
            'class' => (($path === $_GET['path']) ? 'active' : ''),
            'path' => str_replace(DIR_URL, '', $path),
            'title' => $r->description,
            'name' => $r->title,
            'image' => '<i class="'. $r->icon .'"></i>',
            'submenu' => $r->submenu
        );

        $aApps[ $key ] = array( 'title' => $r-title, 'description' => $r->description, 'path' => $path) ;
    }

    switch (true) {
        case (isset($_GET['app'])):

            $panel = str_get_html($app->fetch(DIR_APPS.DS.$_GET['app']));

            $app->panel = $panel;

        break;
        default:

        break;
    }

    $app->display( VIEWS.DS. 'home.tpl', array('sidemenu' => $aMenu, 'apps' => $aApps));

} else {
    $app->display( VIEWS.DS. 'login.tpl' );
}

$app->run();
