<?php
/**
	* The world famous Hello World !
	* @author Daniel Sum
	* @version 0.1
	* @package arx
	* @description : 
	* @comments :
*/
/*----- 1. Just require the core -----*/
require_once(dirname(__FILE__) . '/arx/core.php');

/*----- 2. then you have some magic conventions to autoload a class ( c_xxx = arx/classes/xxx ) -----*/

$bench = new c_bench();

$bench->record('after_core');

arx::uses('c_i18n,c_user');

/*----- 3. Instance the arx object -----*/

$app = new arx();

//You have a Savant php template system where you assign any values like that

$bench->record('after_i18n');

$app->title = 'Hello world example';

$app->meta = array('description'=>'Exemple','keywords'=>'Hello world example');

/*----- 3. Create your application -----*/

//Then you can create your custom functions accessible via any page if you embrace some conventions

//like this little LabelsManager example instanciate lg function from apps/aLabels/inc/labels.load.php (see this file for more information)

$content .= lg('hello_world','w',array(
						 'en' => 'Hello, world !'
						,'fr' => 'Bonjour, le monde !'
					));

$content .= lg('hello_world');

$bench->record('after_hello_call');

//$controller = new ctrl_table_crud('t_labels');

//$controller->display();

/*----- 4. Render the template -----*/

$app->display('html5' , array('content' => $content, 'footer'=> 'Footer test'));