<?php

require_once(realpath(dirname(__FILE__) ."/../../db_function/connection.php"));
require_once(realpath(dirname(__FILE__) ."/../../db_function/function.php"));
$table="preventive";
$page="preventive";
if(isset($_GET["action"]) && $_GET["action"] == "save_preventive"){


    if(!empty($_POST["preventive_id"])){

        $req = array(
            "preventive_name" => filter_var_string($_POST["preventive_name"], "Status Name"),
            "preventive_id" => isset($_POST["preventive_id"]) ? $_POST["preventive_id"] : "",
        );
    
        $required = array(
            "preventive_name" => "preventive_name",   
            "preventive_id" => "preventive_id",   
        );
    
        if(validate($req, $required) === FALSE){
            $_SESSION["STATUS"] = FALSE;
            $_SESSION["MSG"] = "Parameter Missing";
            header("location:../../index.php?page=$page");
            exit();
        }

        try{
            $sql = "UPDATE $table SET ";
            $sql .= " name = :preventive_name ";
            $sql .= "  WHERE id = :preventive_id  ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":preventive_name",$req["preventive_name"]);
            $stmt->bindParam(":preventive_id",$req["preventive_id"]);
            $result = $stmt->execute();
        
            if($result){
                $_SESSION["STATUS"] = TRUE;
                $_SESSION["MSG"] = "Update Success.";
                header("location:../../index.php?page=$page");
                exit();
             
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            die();
        }

    }else{
        $req = array(
            "preventive_name" => filter_var_string($_POST["preventive_name"], "Status Name"),
        );
    
        $required = array(
            "preventive_name" => "Status Name",   
        );
    
        if(validate($req, $required) === FALSE){
            $_SESSION["STATUS"] = FALSE;
            $_SESSION["MSG"] = "Parameter Missing";
            header("location:../../index.php?page=$page");
            exit();
        }

        try{
            $sql = "INSERT INTO $table (name,status)values (:preventive_name,'Y');  ";
           // $sql .= " name = :preventive_name ";
            // $sql .= "  WHERE id = :id  ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":preventive_name",$req["preventive_name"]);
            $result = $stmt->execute();
        
            if($result){
                $_SESSION["STATUS"] = TRUE;
                $_SESSION["MSG"] = "Insert Success.";
                header("location:../../index.php?page=$page");
                exit();
             
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            die();
        }
    }
    

}elseif(isset($_GET["action"]) && $_GET["action"] == "delete"){

    $req = array(
        "preventive_id" => $_GET["preventive_id"],
    );

    $required = array(  
        "preventive_id" => "Status ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=$page");
        exit();
    }

try{
    $sql = "DELETE FROM $table  ";
    $sql .= "  WHERE id = :preventive_id ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":preventive_id",$req["preventive_id"], PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = "Delete Success.";
        header("location:../../index.php?page=$page");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}


}elseif(isset($_GET["action"]) && $_GET["action"] == "delete_all"){

    $req = array(
        "preventive_id" => $_POST["ch"],
    );

    $required = array(  
        "preventive_id" => "Status ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=$page");
        exit();
    }

    $arr = array();
    $preventive_id = implode(",", $req["preventive_id"]);

try{
    $sql = "DELETE FROM $table  ";
    $sql .= "  WHERE id IN ($preventive_id) ";

    echo $sql;
    $stmt = $conn->prepare($sql);
    // $stmt->bindParam(":user_id",$user_id, PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = "Delete Success.";
        header("location:../../index.php?page=$page");
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