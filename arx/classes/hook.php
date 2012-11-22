<?php
/**
	 * Loader System
	 * @author Daniel Sum
	 * @version 0.1
	 * @package arx
	 * @var : 
	 	- JS
	 	- CSS
	 	- CORE
	 	- CACHE
	 * @comments :
*/

require_once(dirname(__FILE__).'/../'.'core.php');
require_once(dirname(__FILE__).'/'.'filemanager.php');



/**
	 * Class extension
	 * @author Daniel Sum
	 * @version 0.1
	 * @package arx
	 * @comments :
*/

class c_hook
{
	public function __construct()
	{
		
	}
	
	public function __get($name)
	{
		return $GLOBALS['hooked_'.$name];
	}
	
	public function __set($name, $value)
	{
		return self::add($name, $value);
	}
	
	static public function add($name, $value)
	{
		$GLOBALS['all_hooked_name'][] = $name;
		
		if(is_array($value))
		{
			foreach($value as $v)
			{
				return $GLOBALS['hooked_'.$name][] = $v;
			}
		}	
		else	return $GLOBALS['hooked_'.$name][] = $value;
		
	}
	
	/**
		 * Load PHP CLASSES
		 * @author Daniel Sum
		 * @version 0.1
		 * @package arx
		 * @comments :
	*/
	public static function info($c = null)
	{
		return new c_info();
	}
	
	/**
		 * Load PHP CLASSES
		 * @author Daniel Sum
		 * @version 0.1
		 * @package arx
		 * @comments :
	*/
	public static function js($value)
	{
		return self::add('js', $value);
	}
	
	/**
		 * Load PHP CLASSES
		 * @author Daniel Sum
		 * @version 0.1
		 * @package arx
		 * @comments :
	*/
	public static function css($value)
	{
		return self::add('css', $value);
	}
	
	/**
		 * Load PHP CLASSES
		 * @author Daniel Sum
		 * @version 0.1
		 * @package arx
		 * @comments :
	*/
	public static function getAll($c = null)
	{
		return $GLOBALS['all_hooked_name'];
	}
	
	/**
		 * preLoad function
		 * @author Daniel Sum
		 * @version 0.1
		 * @package arx
		 * @comments :
	*/
	public static function preload($c = null)
	{
		
		$c = u::toarray($c);

		$aInc = c_fm::findrIn(DIR_APPS . DS, array('pattern' => '*/inc/*.load.php'));
		
		if($aInc)	c_load::loadPHP($aInc);
		
		$GLOBALS['hooked_css'] = c_fm::findrIn(DIR_APPS . DS, array('pattern' => '*/'.CSS.'/*.load.css'));
		
		$GLOBALS['hooked_js'] = c_fm::findrIn(DIR_APPS . DS, array('pattern' => '*/'.JS.'/*.load.js'));
	
	}
	
	/**
		 * preLoad function
		 * @author Daniel Sum
		 * @version 0.1
		 * @package arx
		 * @comments :
	*/
	public static function postload($c = null)
	{
		return true;
	}
		
}

if(isset($arx_hook))
{
	c_debug::notice('$arx_hook already instanciate');
}
else
{
	$GLOBALS['arx_hook'] = new c_hook();
}