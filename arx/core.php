<?php	
/**
 * Arx core definition
 * @author Daniel Sum, Stephan Zych
 * @version 0.9
 * @package arx
	@comments :
 */

if(!isset($_aconfig)) $_aconfig = 'a-config.php';

require_once( dirname(__FILE__). '/config.php' );

require_once( DIR_ROOT . DS . $_aconfig);

//minimum requirements
require_once( DIR_CLASSES . DS . 'utils.php' );
require_once( DIR_CLASSES . DS . 'singleton.php' );
require_once( DIR_CLASSES . DS . 'kohana.php' );
require_once( DIR_CLASSES . DS . 'config.php' );
require_once( DIR_CLASSES . DS . 'html.php' );
require_once( DIR_CLASSES . DS . 'load.php' );
require_once( DIR_CLASSES . DS . 'hook.php' );
require_once( DIR_CLASSES . DS . 'filemanager.php' );
require_once( DIR_CLASSES . DS . 'debug.php' );

class Arx{
	
	private $_aConfig = array();
	private $_oHook;
	private $_oLoad;
	
	//public function 
	public $route;
	public $tpl;
	public $orm;
	
	private $_oInstance;
	
	
	public function __construct( $aConfig = array() ) {
		
		global $cfg;
		
		$aConfig = u::toArray( $aConfig );
		
		$this->_aConfig = array_merge( $cfg, $aConfig );
		
		arx::uses($this->_aConfig['system']);
		
		$this->tpl = new $this->_aConfig['system']['tpl']();
		
		$this->route = new $this->_aConfig['system']['route']();
		
		$this->tpl->error = array();
		
		//$this->db = new a_db();
		
	} // __construct
	
	public function __call( $sName, $mArgs ) {
	
		switch( $sName ) {
			// Router
			case 'map':
			case 'post':
			case 'render':
			case 'run':
				return $this->route->{ $sName }($mArgs);
			break;
			
			// tpl
			case 'edisplay':
			case 'fetch':
				if( is_array($mArgs[1]) ){
					foreach ($mArgs[1] as $key => $val) {
						$this->tpl->{ $key } = $val;
					}
				}
				return $this->tpl->{ $sName }( $mArgs[0] );
				
				break;
				
			case 'display':
				
				if( is_array($mArgs[1]) ){
					foreach ($mArgs[1] as $key => $val) {
						$this->tpl->{ $key } = $val;
					}
				}
			
				return $this->tpl->{ $sName }( $mArgs[0] );
				break;
			
			// Load
			case 'loadPHP':
			case 'loadCSS':
			case 'loadJS':
				$this->_oLoad->{ $sName }( $mArgs[0], $mArgs[1] );
				break;
		}
	} // __call
	
	
	public function __get( $sName ) {
		switch( $sName ) {
			// Router
			case 'route':
				return $this->route;
				break;
			
			// Utils
			case 'utils':
				//return $this->_oUtils;
				break;
			case 'global':
			case 'globals':
				//return $this->utils->globals;
				break;
				
			// tpl
			case 'tpls':
			case 'tpl':
			case 'tpl':
				return $this->tpl;
				break;
			
			// Database
			case 'db':
					return $this->_oDB;
				break;
			
			// Config
			case 'config':
				return $this->_oConfig;
				break;
			
			// Cache
			case 'cache':
				//return $this->_oCache;
				break;
			
				
			default:
				return $this->tpl->{ $sName };
				break;
		}
	} // __get
	
	// $app->test = $value;
	public function __set( $sName, $mValue ) {
		switch( $sName ){
			case 'error':
				$this->tpl->error = $mValue;
				break;
			default:
				
				$this->tpl->{ $sName } = $mValue;
				break;
		}
	} // __set
	
	static public function uses($mFiles)
	{	
		injects_once($mFiles);
	}
	
	/**
	 * require_config
	 * force a class to check if a global config is defined
	 * @param $
	 *	
	 * @return
	 *	
	 * @code 
	 *	
	 * @endcode
	 */
	static public function require_config($mValues)
	{
		$aValues = u::toarray($mValues);
		
		$aUndefinedVars = array();
		
		foreach($aValues as $key=>$value)
		{
			if(! isset($GLOBALS[$key]))
			{
				$aUndefinedVars[] = $key;
			}
		}
		
		if(!empty($aUndefinedVars))
			c_debug::warning('Missing configuration', $aUndefinedVars);
		
	}
	
} // class::arx

class aglobals
{
	public function __get($sName)
	{
		return $GLOBALS[$sName];		
	}
	
	public function __set($sName, $sValue)
	{
		$GLOBALS[$sName] = $sValue;
		return $sValue;
	}
}

class asession
{
	public function __get($sName)
	{
		return $GLOBALS[$sName];		
	}
	
	public function __set($sName, $sValue)
	{
		$GLOBALS[$sName] = $sValue;
		return $sValue;
	}
}

/**
	 * Arx injector => will add the script orderly in the same path, then in the root, then in the ARX directory
	 * @author Daniel Sum
	 * @version 0.1
	 * @package arx
	 * @description : 
	 * @comments :
*/

function inject_once( $mFiles = null ){
	
	if(empty($mFiles))	trigger_error("error");
	
	$sFilename = str_replace(
				array('kohana_', 'classes_','c_','adapters_','a_', 'ctrl_', 'm_')
				, array(CLASSES.DS.'kohana'.DS, CLASSES.DS,CLASSES.DS,ADAPTERS.DS,ADAPTERS.DS,CTRL.DS, MODELS.DS.'m_') 
				, $mFiles
				).EXT_PHP;
	
	switch(true)
	{	
		//This function 
		case ( is_file(  $sFilename ) ):
			include_once( $sFilename );
		break;
		
		case ( is_file( DIR_ROOT . DS . $sFilename ) ):
			include_once( DIR_ROOT . DS . $sFilename );
		break;
		
		case ( is_file(DIR_ARX . DS . $sFilename)):
			include_once( DIR_ARX . DS . $sFilename );
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
			foreach($aFiles as $file)
			{
				inject_once($file);
			}
		} 	
		else inject_once($mArray);

	} catch(Exception $e){ die($e); }
}

/*----- AUTOLOAD REGISTER -----*/

function arx_autoload( $className )
{

	$className = strtolower($className);

	$path = dirname(__FILE__) . DS . str_replace(
	  array('kohana_', 'classes_','c_','adapters_','a_', 'ctrl_')
	, array(CLASSES.DS.'kohana'.DS, CLASSES.DS,CLASSES.DS,ADAPTERS.DS,ADAPTERS.DS, CTRL.DS, CTRL.DS) 
	, strtolower($className)) . EXT_PHP;
	
	switch( true ) {
		
		case is_file($path):
			include_once($path);
		break;
		
		case is_file(DIR_CTRL . DS. $className . EXT_PHP):
			include_once(DIR_CTRL . DS. $className . EXT_PHP);
		break;
		
		case is_file(DIR_ADAPTERS . DS. $className . EXT_PHP):
			include_once(DIR_ADAPTERS . DS. $className . EXT_PHP);
		break;
		
		case is_file(DIR_CLASSES . DS. $className . EXT_PHP):
			include_once(DIR_CLASSES . DS. $className . EXT_PHP);
		break;
		
		case is_file(DIR_CLASSES . DS. 'kohana' .DS. strtolower($className). EXT_PHP):
			include_once(DIR_CLASSES . DS. $className . EXT_PHP);
		break;
	
	}
}

//if class is not found => call this function
spl_autoload_register('arx_autoload');

// Application Hook looks for every additionnal scripts to load in apps (by default load all appFiles 
# in DIR_APPS . APPS /inc/xxx.load.php, /css/xxx.load.css, /js/xxx.load.php)
c_hook::preload();