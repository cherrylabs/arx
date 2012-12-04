<?php
/** ARX - aLabelManager
 * PHP File - /apps/aLabelManager/controllers/edit.php
 */
 
arx::uses('c_form');


if ($_GET['get'] == '.js') {
	
	u::header('js');
	
	$app->display(JS.DS .'edit.js');
	
	exit;

}


if (isset($_GET['id'])) {

	c_hook::css(array(
		ARX_CSS.DS .'bootstrap.css',
		ARX_CSS.DS .'font-awesome.css',
		CSS.DS. 'edit.css'
	));
		
	c_hook::js(array(
		ARX_JS.DS .'jquery.js',
		ARX_JS.DS .'tiny_mce/tiny_mce.js',
		ARX_JS.DS .'tiny_mce/jquery.tinymce.js',
		ARX_JS.DS .'arx.js',
		'?get=.js'
	));
	
	$row = a_db::table('t_labels')->find_one($_GET['id']);
	
	if (isset($_POST['value'])) {
	
		$row->value = stripcslashes($_POST['value']);
		
		$row->save();
	}
	
	$app->value = $row->value;
	
	$app->display(VIEWS.DS.'edit'.TPL);
	
	//$app->_body = $app->tpl->fetch(VIEWS.DS.'edit'.TPL);
	//$app->display(ARX_VIEWS.DS.'html5'.TPL);
	
	exit;

}

