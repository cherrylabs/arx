<?php

namespace DataManager{

	class m_data extends \c_model
	{

		public function test(){
			predie(self::table());
		}

		public function get($id){
			predie(self::table());
		}

		public function create($data, $opts = null){

		}

		public function table(){
			return \a_db::table(T_DATA);
		}
	}

	
}
