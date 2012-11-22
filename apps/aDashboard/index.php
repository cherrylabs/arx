<?php
/**
	 * A Dashboard manager
	 * @author Daniel Sum
	 * @version 0.1
	 * @package arx
	 * @description : 
	 * @comments :
*/


require_once(dirname(__FILE__).'/../core.php');

arx::uses('c_feed,c_html,c_user,c_text');

$arx = new arx();

if(LEVEL_ENV < 2)
{
	
	$arx->tpl->addFilters('filter_admin');
	
	function filter_admin($str)
	{
		$html = str_get_html($str); 
		
		return $html;
		//return str_replace('</body>','<div class="a_debug">'.epre($GLOBALS['DEBUG']).'</div></body>', $str);
	}
}

if(isset($_GET['debug']))
	$arx->display('/tests/index.tpl.php');

$arx->display(VIEWS.DS.'index.tpl.php');