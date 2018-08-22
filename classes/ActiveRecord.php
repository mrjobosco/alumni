<?php

class ActiveRecord{
	private $_db, $_table, $_data;

	public function __construct($tableName){

		$this->_db = DB::getInstance();
		$this->_table = $tableName;
	}

	public function create($fields= [])
	{
		if(!$this->_db->insert($this->_table, $fields))
		{
			throw new Exception("Something went wrong, Please try again");
			
		}
	}

	public function read(){
		return $this->_db->read($this->_table);
	}

	public function find($user = null){
		if($user){
			$field = (is_numeric($user))? 'id' : 'username';
			$data = $this->_db->get($this->_table, [$field,'=',$user]);
			if($data->counter()){
			$this->_data = $data->first();
				
				return true;
			}
			else{
				return false;
			}

		}
	}

	public function getId()
		{
			return $this->_data->id;
		}

	public function getUsername()
		{
			return $this->_data->username;
		}

	public function update($fields){
		if(!$this->_db->update($this->_table, $this->getId(), $fields))
		{
			throw new Exception('There was a problem updating your record');
		}
	
	}

	public function search($where){

	    if ($data = $this->_db->actionSearch($this->_table, $where)){

	        return $data->results();

        }else throw new Exception('There was a problem searching for this record');
    }

	public function data()
	{
		return $this->_data;
	}

	public function delete($where = []){

	    $new_where = [];
	    foreach ($where as $item => $value){
	        $new_where[0] = $item;
            $new_where[1] = '=';
            $new_where[2] = $value;

        }

		if($this->_db->delete($this->_table, $new_where)) return true;

	}

	public function tableName(){

		return $this->_table;
	}


	public function hasOne($table, $where){
		foreach ($where as $key => $value) {
			$field = $key;
			$id = $value;
		}

		if($data = $this->_db->get($table, [$field, '=', $id])){
			return $data->first();
			
					}else{
			return false;
		}

		
	}

	public function hasMany($table, $where){
foreach ($where as $key => $value) {
			$field = $key;
			$id = $value;
		}

		if($data = $this->_db->get($table, [$field, '=', $id])){
			return $this->_db->results();
			
					}else{
			return false;
		}
		
	}

    public function hasOneCondition($table, $where1, $condition ,$where2){

        foreach ($where1 as $key => $value) {
            $field1 = $key;
            $id1 = $value;
        }

        foreach ($where2 as $key => $value) {
            $field2 = $key;
            $id2 = $value;
        }

        if($data = $this->_db->getCondition($table, [$field1, '=', $id1], $condition, [$field2, '=', $id2])){
            return $this->_db->first();

        }else{



        }
    }

    public function getMany($table, $where1, $condition ,$where2){



        if($data = $this->_db->getCondition($table, [$where1[0], $where1[1], $where1[2]], $condition, [$where2[0], $where2[1], $where2[2]])){
            return $this->_db->results();

        }else{



        }
    }

	public function hasManyCondition($table, $where1, $condition ,$where2){

	foreach ($where1 as $key => $value) {
			$field1 = $key;
			$id1 = $value;
		}

	foreach ($where2 as $key => $value) {
			$field2 = $key;
			$id2 = $value;
		}

		if($data = $this->_db->getCondition($table, [$field1, '=', $id1], $condition, [$field2, '=', $id2])){
		    $this->_data = $this->_db->first();
			return $this->_db->first();
			
					}else{
		

		
	}
}

	public function hasResultsCondition($table, $where1, $condition ,$where2){

	foreach ($where1 as $key => $value) {
			$field1 = $key;
			$id1 = $value;
		}

	foreach ($where2 as $key => $value) {
			$field2 = $key;
			$id2 = $value;
		}

		if($data = $this->_db->getCondition($table, [$field1, '=', $id1], $condition, [$field2, '=', $id2])){
			return $this->_db->results();
			
					}else{
		

		
	}
}

public function drelate($table, $where1, $condition ,$where2){

	foreach ($where1 as $key => $value) {
			$field1 = $key;
			$id1 = $value;
		}

	foreach ($where2 as $key => $value) {
			$field2 = $key;
			$id2 = $value;
		}

		if($data = $this->_db->getCondition($table, [$field1, '=', $id1], $condition, [$field2, '=', $id2])){
			$this->_data = $data->first();
			return true;

					}else{
		

		
	}
}


	public function hasManyConditionOP($table, $where, $con, $where1, $con1, $where2, $con2, $where3){

		$field = $where[0];
		$op = $where[1];
		$value = $where[2];


		$field1 = $where1[0];
		$op1 = $where1[1];
		$value1 = $where1[2];

		$field2 = $where2[0];
		$op2 = $where2[1];
		$value2 = $where2[2];

		$field3 = $where3[0];
		$op3 = $where3[1];
		$value3 = $where3[2];


		if($data = $this->_db->getConditionOP($table, [$field, $op, $value], $con, [$field1, $op1, $value1], $con1, [$field2, $op2, $value2], $con2, [$field3, $op3, $value3] )){
			return $this->_db->results();
			
					}else{
		

		
	}
}


public function hasManyConditionOPxtra($table, $where, $con, $where1, $con1, $where2, $con2, $where3, $con3, $where4){

		$field = $where[0];
		$op = $where[1];
		$value = $where[2];


		$field1 = $where1[0];
		$op1 = $where1[1];
		$value1 = $where1[2];

		$field2 = $where2[0];
		$op2 = $where2[1];
		$value2 = $where2[2];

		$field3 = $where3[0];
		$op3 = $where3[1];
		$value3 = $where3[2];

		$field4 = $where4[0];
		$op4 = $where4[1];
		$value4 = $where4[2];


		if($data = $this->_db->getConditionOP($table, [$field, $op, $value], $con, [$field1, $op1, $value1], $con1, [$field2, $op2, $value2], $con2, [$field3, $op3, $value3], $con3, [$field4, $op4, $value4] )){
			return $this->_db->results();
			
					}else{
		

		
	}
}


public function hasManyCustom($table, $where, $con, $where1, $con1, $where2, $con2, $where3, $con3, $where4 , $con4, $where5){

		$field = $where[0];
		$op = $where[1];
		$value = $where[2];


		$field1 = $where1[0];
		$op1 = $where1[1];
		$value1 = $where1[2];

		$field2 = $where2[0];
		$op2 = $where2[1];
		$value2 = $where2[2];

		$field3 = $where3[0];
		$op3 = $where3[1];
		$value3 = $where3[2];

		$field4 = $where4[0];
		$op4 = $where4[1];
		$value4 = $where4[2];

		$field5 = $where5[0];
		$op5 = $where5[1];
		$value5 = $where5[2];

		if($data = $this->_db->getCustom($table, [$field, $op, $value], $con, [$field1, $op1, $value1], $con1, [$field2, $op2, $value2], $con2, [$field3, $op3, $value3], $con3, [$field4, $op4, $value4], $con4, [$field5, $op5, $value5] )){
			return $this->_db->results();
			
					}else{
		

		
	}
}

    public function hasManyConditionOr($table, $where){


        if($data = $this->_db->getConditionOr($table, $where))
        {
            return $this->_db->results();

        }else{



        }
    }

	public function hasManyConditionOr1($table, $where1, $condition ,$where2){

	foreach ($where1 as $key => $value) {
			$field1 = $key;
			$id01 = $value[0];
			$operator = $value[1];
			$id02 = $value[2];
		}

	foreach ($where2 as $key => $value) {
			$field2 = $key;
			$id11 = $value[0];
			$operator1 = $value[1];
			$id12 = $value[2];
		}

		if($data = $this->_db->getConditionOr($table, [$field1, '=', $id01, $operator, $id02], $condition, [$field2, '=', $id11, $operator1, $id12]))
		{
			return $this->_db->results();
			
					}else{
		

		
	}
}




	public function hasManyOrder($table, $where, $order){
	foreach ($where as $key => $value) {
			$field = $key;
			$id = $value;
		}

		if($data = $this->_db->getOrder($table, [$field, '=', $id], $order)){
			return $this->_db->results();
			
					}else{
			return false;
		}
		
	}

	public function relation($where = []){
		foreach ($where as $key => $value) {
			$field = $key;
			$id = $value;
		}

		if($data = $this->_db->get($this->_table, [$field, '=', $id])){
			return $data->first();
			
		}else{
			return false;
		}

		
	}

	public function relate($where = []){
		foreach ($where as $key => $value) {
			$field = $key;
			$id = $value;
		}

		if($data = $this->_db->get($this->_table, [$field, '=', $id])){
			$this->_data = $data->first();
			return true;

		}else{
			return false;
		}

		
	}


}


?>