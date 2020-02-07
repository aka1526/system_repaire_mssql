<?php

require_once(realpath(dirname(__FILE__) ."/../../db_function/connection.php"));
require_once(realpath(dirname(__FILE__) ."/../../db_function/function.php"));

if(isset($_GET["action"]) && $_GET["action"] == "save_status"){


    if(!empty($_POST["status_id"])){

        $req = array(
            "status_name" => filter_var_string($_POST["status_name"], "Status Name"),
            "status_id" => isset($_POST["status_id"]) ? $_POST["status_id"] : "",
        );
    
        $required = array(
            "status_name" => "status_name",   
            "status_id" => "status_id",   
        );
    
        if(validate($req, $required) === FALSE){
            $_SESSION["STATUS"] = FALSE;
            $_SESSION["MSG"] = "Parameter Missing";
            header("location:../../index.php?page=status");
            exit();
        }

        try{
            $sql = "UPDATE status SET ";
            $sql .= " name = :status_name ";
            $sql .= "  WHERE id = :status_id  ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":status_name",$req["status_name"]);
            $stmt->bindParam(":status_id",$req["status_id"]);
            $result = $stmt->execute();
        
            if($result){
                $_SESSION["STATUS"] = TRUE;
                $_SESSION["MSG"] = "Update Success.";
                header("location:../../index.php?page=status");
                exit();
             
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            die();
        }

    }else{
        $req = array(
            "status_name" => filter_var_string($_POST["status_name"], "Status Name"),
        );
    
        $required = array(
            "status_name" => "Status Name",   
        );
    
        if(validate($req, $required) === FALSE){
            $_SESSION["STATUS"] = FALSE;
            $_SESSION["MSG"] = "Parameter Missing";
            header("location:../../index.php?page=status");
            exit();
        }

        try{
            $sql = "INSERT INTO status (name)values (:status_name);  ";
           // $sql .= " name = :status_name ";
            // $sql .= "  WHERE id = :id  ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":status_name",$req["status_name"]);
            $result = $stmt->execute();
        
            if($result){
                $_SESSION["STATUS"] = TRUE;
                $_SESSION["MSG"] = "Insert Success.";
                header("location:../../index.php?page=status");
                exit();
             
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            die();
        }
    }
    

}elseif(isset($_GET["action"]) && $_GET["action"] == "delete"){

    $req = array(
        "status_id" => $_GET["status_id"],
    );

    $required = array(  
        "status_id" => "Status ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=status");
        exit();
    }

try{
    $sql = "DELETE FROM status  ";
    $sql .= "  WHERE id = :status_id ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":status_id",$req["status_id"], PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = "Delete Success.";
        header("location:../../index.php?page=status");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}


}elseif(isset($_GET["action"]) && $_GET["action"] == "delete_all"){

    $req = array(
        "status_id" => $_POST["ch"],
    );

    $required = array(  
        "status_id" => "Status ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=status");
        exit();
    }

    $arr = array();
    $status_id = implode(",", $req["status_id"]);

try{
    $sql = "DELETE FROM status  ";
    $sql .= "  WHERE id IN ($status_id) ";

    echo $sql;
    $stmt = $conn->prepare($sql);
    // $stmt->bindParam(":user_id",$user_id, PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = "Delete Success.";
        header("location:../../index.php?page=status");
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