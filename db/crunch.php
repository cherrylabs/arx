<?php
	/**
		 * Database creator
		 * @author Daniel Sum
		 * @version 0.1
		 * @package arx
		 * @description : 
		 * @comments :
		 \TODO : A YAML cruncher to database
	*/
	require_once(dirname(__FILE__).'/../arx/core.php');
	
	inject_once('a.yaml.php');
	
	$spyce = new Spyc(array("test"));
	
	$array = array(
	"t_users" => array(
						"id"=>array(
									"primary_key"=>true,
									"auto_increment"=>true
								)
					)
	
	
	);
	
	pre(yaml_load_file('arx.yaml'));
	
	
	pre($spyce->dump($array));
	
?>