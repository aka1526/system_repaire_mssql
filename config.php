<?php

error_reporting(E_ALL);
ob_start();
session_start();
date_default_timezone_set("Asia/Bangkok");



if(strpos($_SERVER['DOCUMENT_ROOT'], ":")){
    $db_config = array(
		"DB_type" => "sqlsrv",
        "DB_host" => "22.16.0.1",
        "DB_name" => "system_repair",
        "DB_user" => "sa",
        "DB_pass" => "sa",
        "DB_charset" => "utf8",
    );
}else{
    $db_config = array(
	    "DB_type" => "mysql",
        "DB_host" => "22.16.0.1",
        "DB_name" => "system_repair",
        "DB_user" => "sa",
        "DB_pass" => "sa",
        "DB_charset" => "utf8",
    );
}


?>