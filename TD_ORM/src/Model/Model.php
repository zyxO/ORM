<?php



namespace App\Model;

use App\Query\Query;

/**
* 
*/
class Model
{

	protected static $table;
	protected static $primaryKey = 'id';
	protected $dictionary = [];
	
	function __construct($dictionary = 	array())
	{
		$this->dictionary = $dictionary;
	}

	/*
	* Getter
	*/

	public function __get($key){
		if(array_key_exists($key, $this->dictionary))
			return $this->dictionary[$key];
	}

	/*
	* Setter
	*/
	public function __set($key, $value){
			$this->dictionary[$key] = $value;
	}


	public function save(){




	}

	public function insert() {
	$query = new Query();
	$query = $query::table(static::$table);
	return $query->insert($this->dictionary);

	}

	public function update(){





	}



	public function delete(){

		if(property_exists($this, 'primaryKey') && !is_null($this->primaryKey)){
			return Query::table($this->table)->where($this->primaryKey, '=', $this->dictionary[$this->primaryKey])->delete();
		}


	}

	public static function all() : array {
		$all = new Query();
		$all = Query::table(static::$table)->get();
		$return=[];
		foreach( $all as $m) {
		$return[] = new static($m);

		}

			return $return;
	}

	public static function find($val,$tab=['*']) : array{
	$query = Query::table(static::$table)->select($tab);
	$query = $query->get();
	$return=[];
	foreach ($query as $m) {
	$return[] = new static($m);
	}

	return $return; 



		
	}

}