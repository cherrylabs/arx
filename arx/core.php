<?php   
/**
 * ARX
 * PHP File - /arx/core.php
 * @description     Core File
 * @package         arx
 * @author          Daniel Sum, Stéphan Zych
 * @version         0.9
 */

// @todo:
// - delete public members -> use accessor !
// - Arx -> clean accessors
// `require_config` will be use in app, so maybe we have to put in into app interface

require_once(dirname(__FILE__). '/config.php');
require_once(DIR_ROOT . DS . 'a-config.php');

// Minimum requirements:
require_once(DIR_CLASSES . DS . 'utils.php');
require_once(DIR_CLASSES . DS . 'singleton.php');
require_once(DIR_CLASSES . DS . 'kohana.php');
require_once(DIR_CLASSES . DS . 'config.php');
require_once(DIR_CLASSES . DS . 'html.php');
require_once(DIR_CLASSES . DS . 'load.php');
require_once(DIR_CLASSES . DS . 'hook.php');
require_once(DIR_CLASSES . DS . 'filemanager.php');
require_once(DIR_CLASSES . DS . 'debug.php');


/**
 * @class           Arx
 * @description     Core class
 * @dependency      /a-config.php (global $_config), /classes/utils.php
 * @example:
 *      $app = new Arx(array('orm' => 'redbean'));
 *  or
 *      $app = new Arx('{orm: redbean}');
 */
class Arx {

    // --- Magic methods
    
    public function __construct($mConfig = array()) {
        global $_config;
        
        $mConfig = u::toArray($mConfig);
        
        $this->_aConfig = array_merge($_config, $mConfig);
        
        arx::uses($this->_aConfig['system']);
        
        $this->_oTpl = new $this->_aConfig['system']['tpl']();
        $this->_oRoute = new $this->_aConfig['system']['route']();
        
        $this->_oTpl->error = array();
    } // __construct

    
    public function __call($sName, $mArgs) {
        switch($sName) {
            // Router
            case 'map':
            case 'post':
            case 'render':
            case 'run':
                return $this->_oRoute->{$sName}($mArgs);
                break;
            
            // tpl
            case 'edisplay':
            case 'fetch':
                if (is_array($mArgs[1])) {
                    foreach ($mArgs[1] as $k => $v) {
                        $this->_oTpl->{$k} = $v;
                    }
                }

                return $this->_oTpl->{$sName}($mArgs[0]);
                break;
                
            case 'display':
                if (is_array($mArgs[1])) {
                    foreach ($mArgs[1] as $k => $v) {
                        $this->_oTpl->{$k} = $v;
                    }
                }
            
                return $this->_oTpl->{$sName}($mArgs[0]);
                break;
            
            // Load
            case 'loadPHP':
            case 'loadCSS':
            case 'loadJS':
                $this->_oLoad->{$sName}($mArgs[0], $mArgs[1]);
                break;
        }
    } // __call
    
    
    public function __get($sName) {
        switch($sName) {
            // Router
            case 'route':
                return $this->_oRoute;
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
                return $this->_oTpl;
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
                return $this->_oTpl->{$sName};
        }
    } // __get
    
    
    public function __set($sName, $mValue) {
        switch($sName){
            case 'error':
                $this->_oTpl->error = $mValue;
                break;

            default:
                $this->_oTpl->{$sName} = $mValue;
        }
    } // __set


    // --- Public methods
    
    static public function uses($mFiles) {
        injects_once($mFiles);
    } // uses
    

    /**
     * require_config
     * force a class to check if a global config is defined
     */
    static public function require_config($mValues) {
        $aValues = u::toarray($mValues);
        
        $aUndefinedVars = array();
        
        foreach ($aValues as $key=>$value) {
            if (!isset($GLOBALS[$key])) {
                $aUndefinedVars[] = $key;
            }
        }
        
        if (!empty($aUndefinedVars)) {
            c_debug::warning('Missing configuration', $aUndefinedVars);
        }
    } // require_config


    // --- Private memebers
    
    private $_aConfig = array();
    private $_oHook;
    private $_oLoad;
    private $_oRoute;
    private $_oTpl;
    private $_oOrm;
    private $_oInstance;
    
} // class::arx




/**
 * Arx injector => will add the script orderly in the same path, then in the root, then in the ARX directory
 * @author Daniel Sum
 * @version 0.1
 */
function inject_once($mFiles = null) {
    
    if (empty($mFiles)) {
        trigger_error('error');
    }
    
    $sFilename = str_replace(
                array('kohana_', 'classes_','c_','adapters_','a_', 'ctrl_', 'm_')
                , array(CLASSES.DS.'kohana'.DS, CLASSES.DS,CLASSES.DS,ADAPTERS.DS,ADAPTERS.DS,CTRL.DS, MODELS.DS.'m_') 
                , $mFiles
                ).EXT_PHP;
    
    switch (true) { 
        //This function 
        case (is_file($sFilename)):
            include_once($sFilename);
            break;
        
        case (is_file(DIR_ROOT . DS . $sFilename)):
            include_once(DIR_ROOT . DS . $sFilename);
            break;
        
        case (is_file(DIR_ARX . DS . $sFilename)):
            include_once(DIR_ARX . DS . $sFilename);
            break;
        
        default:
            include_once($mFiles);
    }
} // inject_once


function injects_once($mArray) {
    try {
        $aFiles = u::toArray($mArray);
            
        if (is_array($aFiles)) {
            foreach ($aFiles as $file) {
                inject_once($file);
            }
        } else {
            inject_once($mArray);
        }
    } catch(Exception $e) {
        die($e);
    }
} // injects_once


/*----- AUTOLOAD REGISTER -----*/

function arx_autoload($className) {
    $className = strtolower($className);

    $path = dirname(__FILE__) . DS . str_replace(
      array('kohana_', 'classes_','c_','adapters_','a_', 'ctrl_')
    , array(CLASSES.DS.'kohana'.DS, CLASSES.DS, CLASSES.DS, ADAPTERS.DS, ADAPTERS.DS, CTRL.DS, CTRL.DS) 
    , strtolower($className)) . EXT_PHP;
    
    switch (true) {
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
} // arx_autoload


//if class is not found => call this function
spl_autoload_register('arx_autoload');


// Application Hook looks for every additionnal scripts to load in apps (by default load all appFiles 
# in DIR_APPS . APPS /inc/xxx.load.php, /css/xxx.load.css, /js/xxx.load.php)
c_hook::preload();
