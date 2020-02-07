<?php

require_once(realpath(dirname(__FILE__) ."/../config.php"));

// class DB{

//     protected $db;

//     public function __construct($db_config){
//         try{
//             $this->db = new PDO("mysql:host={$db_config['DB_host']};dbname={$db_config['DB_name']}", $db_config['DB_user'], $db_config['DB_pass']);
//             $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//             $this->db->exec("set names ".$db_config['DB_charset']);

//            return $this->db;
//        }catch(PDOException $e){
//            echo "Connection failed: " . $e->getMessage();
//        }
//     }

//     public function db_select($sql){

//     }

// }

// $DB = new DB($db_config);

try{
	if($db_config['DB_type']=="mysql"){ 
		$conn = new PDO("mysql:host={$db_config['DB_host']};dbname={$db_config['DB_name']}", $db_config['DB_user'], $db_config['DB_pass']);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		$conn->exec("set names ".$db_config['DB_charset']);
	} else	if($db_config['DB_type']=="sqlsrv"){ 
	 
		$conn = new PDO("sqlsrv:server={$db_config['DB_host']};Database={$db_config['DB_name']}", $db_config['DB_user'], $db_config['DB_pass']);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		//$conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		//$conn->exec("set names ".$db_config['DB_charset']);
	}
  
}catch(PDOException $e){
    echo "Connection failed: " . $e->getMessage();
}












?>