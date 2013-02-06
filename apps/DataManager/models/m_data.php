<?php

namespace DataManager{

class m_data
{

	public function test(){
		predie(self::table());
	}

	public function get($id){
		predie(self::table());
	}

	public function create($data, $opts){
		
	}

	public function table(){
		return \a_db::table(T_DATA);
	}
}

	
}
