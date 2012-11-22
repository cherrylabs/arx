<?php
/**
	 * Arx
	 * @author Daniel Sum
	 * @version 0.1
	 * @package arx
	 * @description : 
	 * @comments :
*/

function inject_once( $mFiles = null ){
	
	if(empty($mFiles))	trigger_error("error");
	
	$sPath = DIR_ARX . DS . str_replace(
				array('classes_','c_','c/', 'adapters_','a_','a/') 
				,array('classes'. DS,'classes'. DS,'classes'. DS,'adapters'. DS,'adapters'. DS,'adapters'. DS)
				, $mFiles
				).EXT_PHP;
	
	switch(true)
	{	
		case ( is_file( $sPath ) ):
			include_once( $sPath );
		break;
		
		case ( is_file(DIR_ARX . DS . $mFiles)):
			include_once( DIR_ARX . DS . $mFiles );
		break;
		
		default:
			include_once( $mFiles );
		break;
	
	}
}

function injects_once($mArray)
{
	try{
		$aFiles = u::toArray($mArray);
		
		if(is_array($aFiles))
		{
			foreach($aFiles as $file)	inject_once($file);
		} 	
		else inject_once($mArray);

	} catch(Exception $e){ die($e); }
}

/*----- AUTOLOAD REGISTER -----*/

function arx_autoload( $className )
{

	$className = strtolower($className);

	$path = dirname(__FILE__) . DS . str_replace(array('kohana_', 'classes_','c_','adapters_','a_', ), array('classes/kohana/', 'classes/','classes/','adapters/','adapters/') , strtolower($className)) . EXT_PHP;
	
		
	switch( true ) {
		
		case is_file(DIR_ADAPTERS . DS. $className . EXT_PHP):
			include_once(DIR_ADAPTERS . DS. $className . EXT_PHP);
		break;
		
		case is_file(DIR_CLASSES . DS. $className . EXT_PHP):
			include_once(DIR_CLASSES . DS. $className . EXT_PHP);
		break;
		
		case is_file(DIR_CLASSES . DS. 'kohana' .DS. strtolower($className). EXT_PHP):
			include_once(DIR_CLASSES . DS. $className . EXT_PHP);
		break;
		
		case is_file($path):
			include_once($path);
		break;
	
	}
}

//little class to add automatically a class by default
spl_autoload_register('arx_autoload');