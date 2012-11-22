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
require_once(dirname(__FILE__).'/'.'filemanager.php');
require_once(dirname(__FILE__).'/'.'utils.php');

class c_load{
	
	/**
		 * Load PHP CLASSES
		 * @author Daniel Sum
		 * @version 0.1
		 * @package arx
		 * @comments :
	*/
	
	public $sJs, $root, $key, $add, $sCSS;
	
	public static function loadAll(){
		echo self::loadCSS();
		echo self::loadJS();
	}
	
	public static function loadPHP($sFiles = 'all' , $c = array())
	{
		$c = u::toArray($c);
		
		switch(true)
		{	
			case (is_array($sFiles)):
				$sFiles = $sFiles;
			break;
			case (is_file($sFiles)):
				$sFiles = array($sFiles);
			break;
			case (is_dir($sFiles)):
				$sFiles = c_fm::find($sFiles, '*.php');
			break;
		}
		
		
		if(!array($sFiles))
		{
		
			$root = '';
			
			//if a context root is set
			if(isset($c['root']) && $c['root'] == '-')
				$root = '';
			elseif( !empty($c['root']) )
				$root = $c['root'];
			//else load from default INC repository
			else
				$root = ZE_INCROOT;
			
			if(!is_array($sFiles)){ $sFiles = explode( ',', str_replace(' ','', $sFiles )); }
		}

		foreach($sFiles as $sFp)
		{
			$sFp = $root . $sFp;
			if (!file_exists($sFp) OR is_dir($sFp))
			{
				throw new Exception('The specified file '.$sFp.' cannot be found!');
			}
			else
				require_once($sFp);
		}
	}
	
	public static function PHP($sFiles = 'all' , $c = array())
	{
		self::loadPHP($sFiles, $c);
	}
	
	/**
		 * Load JS scripts
		 * @author Daniel Sum
		 * @version 0.1
		 * @package arx
		 * @comments :
	*/
	public static function loadJS($sFiles = 'all' , $c = array())
	{
		$c = u::toArray($c);
		
		if($sFiles == 'all')
		{
			if(!empty($c['root'])){
				$sFiles = c_fm::findIn($c['root'], array('dir' => JS));
			}
			else
			{
				
				$appJs = c_fm::findIn(DIR_APPS, array('pattern' => '*/js/*.js'));
				
				$sFiles = c_fm::findIn('', array('dir' => JS));
				
				if(count($appJs) > 0)
				{
					
				}
			}
		}
		
		if(!is_array($sFiles)){ $sFiles = explode( ',', str_replace(' ','', $sFiles )); }
		
		
		foreach($sFiles as $sFp)
		{
			$sFp = u::getUrlFile($sFp);	
			if(!strpos($sFp, '.only.') && !strpos($sFp, '.not.') && strpos($sFp, '.js'))
			{
					$sJs .= '<script type="text/javascript" src="'. $sFp .'"></script>'."\r\n";
					c_hook::js($sCSS);
			}
		}
		
		if(!empty($c['cat']))
		{
			foreach($sFiles as $sFp)
			{
				if(strpos($sFp, $c['cat']))
				{
						$sJs .= '<script type="text/javascript" src="'. $sFp .'"></script>'."\r\n";
				}
			}
		}
		
		return $sJs;
	}
	
	public static function eLoadJS($sFiles = 'all' , $c = array())
	{
		return self::loadJS( $sFiles, $c );
	}
	
	public static function js($sFiles = 'all' , $c = array())
	{
		return self::loadJS( $sFiles, $c );
	}
	
	public static function jsDir($root = ZE_JSROOT)
	{
		return self::loadJS('all', array('dir' => $root));
	}
	
	
	/**
		 * Load CSS scripts
		 * @author Daniel Sum
		 * @version 0.1
		 * @package arx
		 * @comments :
	*/
	public static function loadCSS($sFiles = 'all' , $c = array())
	{
		
		$c = u::toArray($c);
			
		if($sFiles == 'all')
		{
			if(!empty($c['root'])){
				$sFiles = c_fm::findIn($c['root'], array('dir' => CSS));
			}
			else
				$sFiles = $GLOBALS['allCSS'];
		}
		
		//if a context root is set
		if( !empty($c['root']) )
			$root = $c['root'];

		//else load from default CSS repository
		else
			$root = ARX_CSS;
		
		if(!is_array($sFiles)){ $sFiles = explode( ',', str_replace(' ','', $sFiles )); }
		
		//preventdefault exclude
		$c['exclude'][] = '.not.';
		
		//pre($c['exclude']);
		
		foreach($sFiles as $key=>$sFp)
		{
			$sFp = u::getUrlFile($sFp);
			
			if(!in_array(str_replace(CSS.DS,'',$sFp), $c['exclude']))
			{
				if(strpos($sFp, '.print.'))
					$sCSS .= '<link rel="stylesheet" media="print" href="'. $sFp .'" type="text/css" '. (!empty($c['add'][$key]) ? $c['add'][$key] : $c['add']) .' />  '."\r\n";
					
				elseif(strpos($sFp, '.css'))	
					$sCSS .= '<link rel="stylesheet"  href="'. $sFp .'" type="text/css" '. (!empty($c['add'][$key]) ? $c['add'][$key] : $c['add']) .' />'."\r\n";
				
				//c_hook::css($sCSS);
				
			}
		}
		
		return $sCSS;
	}
	
	public static function CSS($sFiles = 'all' , $c = array())
	{
		return self::loadCSS($sFiles, $c);
	}
	
	public static function eCSS($sFiles = 'all' , $c = array())
	{
		echo self::loadCSS($sFiles, $c);
	}
	
	public static function eLoadCSS($sFiles = 'all' , $c = array())
	{
		echo self::loadCSS( $sFiles, $c );
	}
}

class c_loader extends c_load{ }