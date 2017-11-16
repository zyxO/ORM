<?php

/**
* 
*/

namespace App\Query;

class Query
{
	private $sqltable;
	private $fields = '*';
	private $where = null;
	private $args = [];
	private $sql = '';



	static function table(string $table) 
	{

		$query = new Query;
		$query->sqltable= $table;
		return $query;
	}

	public function select($fields){
	$this->fields = implode( ',', $fields);
	return $this;

	}

	public function where($col, $op, $val) {
		
		if(is_null($this->where)){
			$this->where=" where $col $op ?";
		}else{
			$this->where.=" and $col $op ?";

		}
		$this->args[]=$val;
		return $this;
	}


	public function get()  {
		$pdo = \Connection\ConnectionFactory::getConnection();
		$this->sql  = 'select '. $this->fields . ' from ' . $this->sqltable;
		

		if(!is_null($this->where)){

			$this->sql  .= ' where '.$this->where;
			

		}
		
		//return $this->sql;
		$stmt = $pdo->prepare($this->sql);
		$stmt->execute($this->args);
		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
	}

	public function insert(array $insertion){
		$pdo = \Connection\ConnectionFactory::getConnection();
		$this->sql = 'insert into '.$this->sqltable;
		$into=[];
		$values=[];
		foreach ($insertion as $attname => $attval) {
			# code...
			$into[]=$attname;
			$values[]= ':'.$attname;
			$this->args[]=$attval;
		}

		$this->sql .= ' ('.implode(' , ', $into).') values ('.implode(',', $values).')';
		$stmt = $pdo->prepare($this->sql);
		foreach ($values as $index => $value) {
			$stmt->bindParam($value, $this->args[$index]);
		}
		$stmt->execute();

		return $pdo->lastInsertId();

	}

	public function delete(){
		$pdo = \Connection\ConnectionFactory::getConnection();
		$this->sql = 'DELETE FROM '.$this->sqltable;
		if (!is_null($this->where)) {
			$this->sql.=' WHERE '.$this->where;
		}
		
		$stmt = $pdo->prepare($this->sql);
		$stmt->execute($this->args);
	


	}

	public function update(){


	}

}