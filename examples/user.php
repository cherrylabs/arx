<?php
/**
	* a User class utilisation example
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

require_once('../arx/core.php');

arx::uses('c_user');

$user = c_acl::setAllRoles(array('superadmin', 'admin'));