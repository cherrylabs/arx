<?php

class ctrl_action extends c_controller{

	public function create($type = 'data'){
		switch ($type) {
			case 'data':
				predie( DataManager\m_data::create($_POST) );
				break;
			
			default:
				# code...
				break;
		}
	}
	
}