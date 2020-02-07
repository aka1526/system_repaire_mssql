<?php

require_once(realpath(dirname(__FILE__) ."/../../db_function/connection.php"));
require_once(realpath(dirname(__FILE__) ."/../../db_function/function.php"));

if(isset($_GET["action"]) && $_GET["action"] == "update_system"){

    $req = array(
        "system_title" => filter_var_string($_POST["title"], "System Title"),
        "system_name" => filter_var_string($_POST["name"], "System Name"),
    );

    $required = array(
        "system_title" => "System Title",
        "system_name" => "System Name",
    );


    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=system");
        exit();
    }

try{

    $sql = "UPDATE system SET ";
    $sql .= " title = :system_title, ";
    $sql .= " name = :system_name ";
    $sql .= "  WHERE id = '1'  ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":system_title",$req["system_title"]);
    $stmt->bindParam(":system_name",$req["system_name"]);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = "Update Success.";
        header("location:../../index.php?page=system");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}

}else{
    defined('APPS') OR exit('No direct script access allowed');
}





?>