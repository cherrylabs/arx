<?php

require_once(DIR_ROOT . DS . MODELS . DS . 'm_fileExplorer.php');
require_once(DIR_ROOT . DS . MODELS . DS . 'm_users.php'); // User model used for 87seconds

//Get Users
$app->users = a_db::table('a_users');


$app->projects = a_db::table('a_projects');

if(isset($_GET['new_user']))
{
	$user = new m_users($_GET['email'], $_GET['password']);
}