<?php
namespace DataManager {

	class m_datatree
	{

		public function get($id = null, $opts = array()){
			return self::table()->find_one();
		}

		public function create($data, $opts){
			
		}

		public function table(){
			return \a_db::table(T_DATATREE);
		}
	}
}
