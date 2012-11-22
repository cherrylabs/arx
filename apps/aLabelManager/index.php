<?php
	require_once(dirname(__FILE__).'/../core.php');
	
	$a = new arx();
	
	$a->display('index.tpl.php');
	
	/*if(aUser::role(1))
	{
		$a->display('index.tpl.php');
	}
	else
		header('Location:'.ZE_ADMINROOT)*/
?>