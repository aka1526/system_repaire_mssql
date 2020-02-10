<?php

error_reporting(E_ALL);
ob_start();
session_start();
date_default_timezone_set("Asia/Bangkok");

$_svhost="mysql";

if($_svhost=="sqlsrv"){
    $db_config = array(
		"DB_type" => "sqlsrv",
        "DB_host" => "xxxxx",
        "DB_name" => "system_repair",
        "DB_user" => "xxx",
        "DB_pass" => "xxx",
        "DB_charset" => "utf8",
    );
}else{
    $db_config = array(
	    "DB_type" => "mysql",
        "DB_host" => "127.0.0.1",
        "DB_name" => "system_repair",
        "DB_user" => "root",
        "DB_pass" => "",
        "DB_charset" => "utf8",
    );
}


?>