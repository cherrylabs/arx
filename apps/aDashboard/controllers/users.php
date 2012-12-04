<?php
/**
	* User panels system
	* @file
	*	
	* @package
	* @author Daniel Sum
	* @link 	@endlink
	* @see 
	* @description
	* 
	* @code 	@endcode
	* @comments
	* @todo 
*/

require_once(dirname(__FILE__).'/../core.php');

$app = new ctrl_table('a_users', "_ajax=false");

if(isset($_GET['add']))
{
	
}

$app->aUsers = a_db::table('t_users');

$app->display();