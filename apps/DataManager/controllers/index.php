<?php

require_once 'default.php';

class ctrl_index extends ctrl_default{

	public function index(){
		$this->menu = self::tree();
		$this->page .= $this->fetch('form-data');
		$this->page .= $this->fetch('page-dashboard');
		$this->display('index');
	}

	public function tree($id = null){
		return DataManager\m_datatree::get($id)->as_array();
	}

}