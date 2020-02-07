<?php

require_once(realpath(dirname(__FILE__) ."/../../db_function/connection.php"));
require_once(realpath(dirname(__FILE__) ."/../../db_function/function.php"));

// if(isset($_SESSION["LOGIN"]) === FALSE){
//     header("location:../../index.php");
//     exit();
// }

if(isset($_GET["action"]) && $_GET["action"] == "check_login"){
    $req = array(
        "username" => $_POST["user"],
        "password" => $_POST["password"],
    );
    
    // $crud = new CRUD($db_config);
    // $res_login = $crud->login($req);
    $res_login = login($req);
    if($res_login["status"] === TRUE){
        header("location:../../index.php");
        exit();
    }else{
        $_SESSION["STATUS"] = $res_login["status"];
        $_SESSION["MSG"] = $res_login["msg"];
        header("location:../../index.php");
        exit();
    }
}else{
    defined('APPS') OR exit('No direct script access allowed');
}





?>