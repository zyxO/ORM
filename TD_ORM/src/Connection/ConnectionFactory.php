<?php

namespace Connection; 



/**
* 
*/
class ConnectionFactory

{

	 static $bdd = '';
	

	 static function makeConnection (array $conf){

		

		$host_bdd= $conf['host_bdd'];
		$name_bdd= $conf['name_bdd'];
		$user_bdd= $conf['user_bdd'];
		$pass_bdd= $conf['pass_bdd'];

		


		try{
			self::$bdd = new \PDO ("mysql:host=".$host_bdd.";dbname=".$name_bdd."", "".$user_bdd."", "".$pass_bdd."");
			self::$bdd ->exec("SET NAMES utf8");
			self::$bdd ->setAttribute(\PDO::ATTR_PERSISTENT,true);
			self::$bdd ->setAttribute(\PDO::ATTR_ERRMODE,\PDO::ERRMODE_EXCEPTION);
			self::$bdd ->setAttribute(\PDO::ATTR_EMULATE_PREPARES,false);
			self::$bdd ->setAttribute(\PDO::ATTR_STRINGIFY_FETCHES,false);

		}

		catch(\Exception $e){
			die("Erreur!".$e->getMessage());
		}

		return self::$bdd;


	}



	static function getConnection(){

		if (isset(self::$bdd)) {
		# code...
		
		return self::$bdd;	


		}



	}
}



