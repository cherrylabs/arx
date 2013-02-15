<?php

class ctrl_action extends c_controller{

	public function create($type = 'data'){
		switch ($type) {
			case 'data':
				$response = \DataManager\m_data::create($_POST);

				$this->response = $response;

				predie($response);

				break;
			
			default:
				# code...
				break;
		}
	}

}