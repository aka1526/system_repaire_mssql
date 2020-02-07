<?php

require_once(realpath(dirname(__FILE__) ."/../../db_function/connection.php"));
require_once(realpath(dirname(__FILE__) ."/../../db_function/function.php"));

if(isset($_GET["action"]) && $_GET["action"] == "save_type"){


    if(!empty($_POST["type_id"])){

        $req = array(
            "status" => isset($_POST["status"]) ? $_POST["status"] : "",
            "type_name" => filter_var_string($_POST["type_name"], "type Name"),
            "type_id" => isset($_POST["type_id"]) ? $_POST["type_id"] : "",
        );
    
        $required = array(
            "type_name" => "type_name",   
            "type_id" => "type_id",   
        );
    
        if(validate($req, $required) === FALSE){
            $_SESSION["STATUS"] = FALSE;
            $_SESSION["MSG"] = "Parameter Missing";
            header("location:../../index.php?page=types");
            exit();
        }

        try{
            $sql = "UPDATE type SET ";
            $sql .= " status = :status, ";
            $sql .= " name = :type_name ";
            $sql .= "  WHERE id = :type_id  ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":status",$req["status"]);
            $stmt->bindParam(":type_name",$req["type_name"]);
            $stmt->bindParam(":type_id",$req["type_id"]);
            $result = $stmt->execute();
        
            if($result){
                $_SESSION["STATUS"] = TRUE;
                $_SESSION["MSG"] = "Update Success.";
                header("location:../../index.php?page=types");
                exit();
             
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            die();
        }

    }else{
        $req = array(
           
            "status" => isset($_POST["status"]) ? $_POST["status"] : "",
            "type_name" => filter_var_string($_POST["type_name"], "type Name"),
        );
    
        $required = array(
          
            "type_name" => "type_name",   
        );
    
        if(validate($req, $required) === FALSE){
            $_SESSION["STATUS"] = FALSE;
            $_SESSION["MSG"] = "Parameter Missing";
            header("location:../../index.php?page=types");
            exit();
        }

        try{
            $sql = "INSERT INTO type (status,name ) values (:status,:type_name  ) ; ";
        /*     $sql .= " status = :status, ";
            $sql .= " category = :category, ";
            $sql .= " name = :type_name "; */
            // $sql .= "  WHERE id = :id  ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":status",$req["status"]);
            $stmt->bindParam(":type_name",$req["type_name"]);
            $result = $stmt->execute();
        
            if($result){
                $_SESSION["STATUS"] = TRUE;
                $_SESSION["MSG"] = "Insert Success.";
                header("location:../../index.php?page=types");
                exit();
             
            }
        }catch(PDOException $e){ 
            echo "Error: " . $e->getMessage();
            die();
        }
    }
    

}elseif(isset($_GET["action"]) && $_GET["action"] == "delete"){

    $req = array(
        "type_id" => $_GET["type_id"],
    );

    $required = array(  
        "type_id" => "type ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=types");
        exit();
    }

try{
    $sql = "DELETE FROM type  ";
    $sql .= "  WHERE id = :type_id ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":type_id",$req["type_id"], PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = "Delete Success.";
        header("location:../../index.php?page=types");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}


}elseif(isset($_GET["action"]) && $_GET["action"] == "delete_all"){

    $req = array(
        "type_id" => $_POST["ch"],
    );

    $required = array(  
        "type_id" => "type ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=types");
        exit();
    }

    $arr = array();
    $type_id = implode(",", $req["type_id"]);

try{
    $sql = "DELETE FROM type  ";
    $sql .= "  WHERE id IN ($type_id) ";

    echo $sql;
    $stmt = $conn->prepare($sql);
    // $stmt->bindParam(":user_id",$user_id, PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = "Delete Success.";
        header("location:../../index.php?page=types");
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