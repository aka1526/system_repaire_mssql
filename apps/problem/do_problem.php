<?php

require_once(realpath(dirname(__FILE__) ."/../../db_function/connection.php"));
require_once(realpath(dirname(__FILE__) ."/../../db_function/function.php"));
$table="problem";
$page="problem"; 
if(isset($_GET["action"]) && $_GET["action"] == "save_problem"){


    if(!empty($_POST["problem_id"])){

        $req = array(
            "problem_name" => filter_var_string($_POST["problem_name"], "Problem Name"),
            "problem_id" => isset($_POST["problem_id"]) ? $_POST["problem_id"] : "",
        );
    
        $required = array(
            "problem_name" => "problem_name",   
            "problem_id" => "problem_id",   
        );
    
        if(validate($req, $required) === FALSE){
            $_SESSION["STATUS"] = FALSE;
            $_SESSION["MSG"] = "Parameter Missing";
            header("location:../../index.php?page=$page");
            exit();
        }

        try{
            $sql = "UPDATE $table SET ";
            $sql .= " name = :problem_name ";
            $sql .= "  WHERE id = :problem_id  ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":problem_name",$req["problem_name"]);
            $stmt->bindParam(":problem_id",$req["problem_id"]);
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
            "problem_name" => filter_var_string($_POST["problem_name"], "Problem Name"),
        );
    
        $required = array(
            "problem_name" => "Problem Name",   
        );
    
        if(validate($req, $required) === FALSE){
            $_SESSION["STATUS"] = FALSE;
            $_SESSION["MSG"] = "Parameter Missing";
            header("location:../../index.php?page=$page");
            exit();
        }

        try{
            $sql = "INSERT INTO $table (name)values (:problem_name);  ";
           // $sql .= " name = :problem_name ";
            // $sql .= "  WHERE id = :id  ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":problem_name",$req["problem_name"]);
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
        "problem_id" => $_GET["problem_id"],
    );

    $required = array(  
        "problem_id" => "Problem ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=$page");
        exit();
    }

try{
    $sql = "DELETE FROM $table  ";
    $sql .= "  WHERE id = :problem_id ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":problem_id",$req["problem_id"], PDO::PARAM_INT);
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
        "problem_id" => $_POST["ch"],
    );

    $required = array(  
        "problem_id" => "Problem ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=$page");
        exit();
    }

    $arr = array();
    $problem_id = implode(",", $req["problem_id"]);

try{
    $sql = "DELETE FROM $table  ";
    $sql .= "  WHERE id IN ($problem_id) ";

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