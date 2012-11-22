<?php
	require_once( dirname( __FILE__ ) . '/../core.php' );
	
	
	Config::getInstance()->apply( array('template' => array('path' => dirname( __FILE__ ) . '/templates')) );
	
	
	$a = new arx();
	
	

		
	
		$a->display('templates/index.tpl.php');

	
	
	
	//$a->run();
?>