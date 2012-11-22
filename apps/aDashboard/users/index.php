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



a_db::query();

aDashboard_ctrol_table_crud extends ctrl_table_crud
{
	

}

$c = new ctrl_table_crud(T_USERS);

$c->display();