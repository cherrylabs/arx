<?php 
/**
	 * Facebook adaptater
	 * @author Daniel Sum
	 * @version 0.1
	 * @package arx
	 * @comments :
*/
require_once(dirname(__FILE__).'/../a-config.php');
require_once(DIR_LIBS.'/FacebookSDK/facebook.php');

class cFacebook extends Facebook
{
	public $facebook;
	/**
 	 * Recursive version of glob
 	 * @return array containing all pattern-matched files.
 	 * @param string $sDir      Directory to start with.
 	 * @param string $sPattern  Pattern to glob for.
 	 * @param int $nFlags      Flags sent to glob.
 	 */
 	 
 	public function __construct(){
 		
 		$c = func_get_args();
 		$nb = func_num_args();
 		
 		if($nb == 2)
 		{
 			$FACEBOOK_APPID = $c[0];
 			$FACEBOOK_APPSECRET = $c[1];
		}
		else
		{
			$FACEBOOK_APPID = $GLOBALS['FACEBOOK']['APPID'];
			$FACEBOOK_APPSECRET = $GLOBALS['FACEBOOK']['APPSECRET'];
		}
 		
 		parent::__construct(array(
		  'appId'  => $FACEBOOK_APPID,
		  'secret' => $FACEBOOK_APPSECRET
		));

 	}
	}
?>