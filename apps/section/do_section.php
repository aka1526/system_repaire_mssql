<?php

require_once(realpath(dirname(__FILE__) ."/../../db_function/connection.php"));
require_once(realpath(dirname(__FILE__) ."/../../db_function/function.php"));
$tbl="section";
$page="section";
if(isset($_GET["action"]) && $_GET["action"] == "save_section"){


    if(!empty($_POST["section_id"])){

        $req = array(
            "status" => isset($_POST["status"]) ? $_POST["status"] : "",
            "section_name" => filter_var_string($_POST["section_name"], "section Name"),
            "section_id" => isset($_POST["section_id"]) ? $_POST["section_id"] : "",
        );
    
        $required = array(
            
            "section_name" => "section_name",   
            "section_id" => "section_id",   
        );
    
        if(validate($req, $required) === FALSE){
            $_SESSION["STATUS"] = FALSE;
            $_SESSION["MSG"] = "Parameter Missing";
            header("location:../../index.php?page=$page");
            exit();
        }

        try{
            $sql = "UPDATE $tbl SET ";
            $sql .= " status = :status, ";
            $sql .= " name = :section_name ";
            $sql .= "  WHERE id = :section_id  ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":status",$req["status"]);
            $stmt->bindParam(":section_name",$req["section_name"]);
            $stmt->bindParam(":section_id",$req["section_id"]);
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
            
            "status" => isset($_POST["status"]) ? $_POST["status"] : "",
            "section_name" => filter_var_string($_POST["section_name"], "Section Name"),
        );
    
        $required = array(
            
            "section_name" => "section_name",   
        );
    
        if(validate($req, $required) === FALSE){
            $_SESSION["STATUS"] = FALSE;
            $_SESSION["MSG"] = "Parameter Missing";
            header("location:../../index.php?page=$page");
            exit();
        }

        try{
            $sql = "INSERT INTO $tbl (status ,name ) values (:status, :section_name  ) ; ";
       
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":status",$req["status"]);
            $stmt->bindParam(":section_name",$req["section_name"]);
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
        "section_id" => $_GET["section_id"],
    );

    $required = array(  
        "section_id" => "section ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=$page");
        exit();
    }

try{
    $sql = "DELETE FROM $tbl  ";
    $sql .= "  WHERE id = :section_id ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":section_id",$req["section_id"], PDO::PARAM_INT);
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
        "section_id" => $_POST["ch"],
    );

    $required = array(  
        "section_id" => "section ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=$page");
        exit();
    }

    $arr = array();
    $section_id = implode(",", $req["section_id"]);

try{
    $sql = "DELETE FROM $tbl  ";
    $sql .= "  WHERE id IN ($section_id) ";

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