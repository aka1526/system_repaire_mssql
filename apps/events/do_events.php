<?php

require_once(realpath(dirname(__FILE__) ."/../../db_function/connection.php"));
require_once(realpath(dirname(__FILE__) ."/../../db_function/function.php"));
if(isset($_GET["action"]) && $_GET["action"] == "add_event"){
    $req = array(
        "name" => $_POST["name"],
        "description" => $_POST["description"],
    );

    $required = array(
        "name" => "name",   
        "description" => "Description",
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=events");
        exit();
    }

    try{

        $stmt = $conn->prepare("INSERT INTO events SET name = :name, description =:description " );
        $stmt->bindParam(":name",$req["name"]);
        $stmt->bindParam(":description",$req["description"]);
        $result = $stmt->execute();
    
        if($result){
            $_SESSION["STATUS"] = TRUE;
            $_SESSION["MSG"] = "Update Profile Success.";
            header("location:../../index.php?page=events");
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