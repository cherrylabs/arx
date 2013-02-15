<?php

namespace DataManager{

	class m_data extends \c_model
	{

		public function test(){
			predie(self::table());
		}

		public function structure(){
			return array_keys(self::table()->find_one()->as_array());
		} 

		public function get($id){
			predie(self::table());
		}

		public function create($data, $opts = null){

			$oData = self::table()->create();

			$structure = self::structure();

			foreach ($data as $key => $value) {
				if(in_array($key, $structure)){
					$oData->{$key} = $value;
				}
			}

			$response = $oData->save();

			if ($response) {
				return array('result' => $oData->id, 'message' => '{id} is created', 'data' => $oData->as_array());
			}

			return array('result' => false, 'message' => 'error db general');;
		}

		public function table(){
			return \a_db::table(T_DATA);
		}
	}

	
}
