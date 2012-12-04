<?php 

require_once(dirname(__FILE__).'/core.php');

arx::uses('c_i18n,c_user');

$a = new arx();

if( isset( $_GET['logout'] ) ) {
	c_user::destruct();
}

if( c_user::granted($_POST['login'], $_POST['password']) ) {
	$a->user = $_SESSION[ ZE_USER ];
	
	$a->title = '87Seconds Admin';
	
	
	$aFound = c_fm::findIn( DIR_APPS, array( 'pattern' => '/*/manifest.php' ) );
	
	$aApps = array();
	
	$aMenu = array();
	
	$menuTemplate = '<li class="{class}">
										<a href="index.php?path={path}" title="{title}">
											<span class="name">{name}</span>
											<span class="image">{image}</span>
										</a>
									</li>';

	foreach ( $aFound as $key => $app ) {
		
		$path = u::getUrlPath($app);
		
		$r = json_decode( file_get_contents(u::getUrlFile($app)) );
		
		if( !empty( $r->url ) )
			$path = $r->url;
		
		//TODO : clean url 
		
		$path = str_replace(array('http://http://'),array('http://'), $path);
		
		if( empty( $r->icon ) )
			$r->icon = 'icon-cog';

		$aMenu[] = u::strtr($menuTemplate, array(
			'class' => (($path === $_GET['path']) ? 'active' : ''),
			'path' => $path,
			'title' => $r->description,
			'name' => $r->title,
			'image' => '<i class="'. $r->icon .'"></i>'
		));
		
		$aApps[ $key ] = array( 'title' => $r-title, 'description' => $r->description, 'path' => $path) ;
	}
		
	switch(true)
	{
		case (isset($_GET['app'])):
			$panel = str_get_html($a->fetch(DIR_APPS.DS.$_GET['app']));
			
			$a->panel = $panel;
			
		break;
		default:
	
		break;
	}
	
	$a->display( VIEWS.DS. 'arxmin.tpl', array('sidemenu' => $aMenu, 'apps' => $aApps));
	
	
	
}
else{
	$a->display( VIEWS.DS. 'login.tpl' );
}
