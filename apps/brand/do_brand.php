<?php

require_once(realpath(dirname(__FILE__) ."/../../db_function/connection.php"));
require_once(realpath(dirname(__FILE__) ."/../../db_function/function.php"));

if(isset($_GET["action"]) && $_GET["action"] == "save_brand"){


    if(!empty($_POST["brand_id"])){

        $req = array(
            "status" => isset($_POST["status"]) ? $_POST["status"] : "",
            "brand_name" => filter_var_string($_POST["brand_name"], "brand Name"),
            "brand_id" => isset($_POST["brand_id"]) ? $_POST["brand_id"] : "",
        );
    
        $required = array(
             
            "brand_name" => "brand_name",   
            "brand_id" => "brand_id",   
        );
    
        if(validate($req, $required) === FALSE){
            $_SESSION["STATUS"] = FALSE;
            $_SESSION["MSG"] = "Parameter Missing";
            header("location:../../index.php?page=brand");
            exit();
        }

        try{
            $sql = "UPDATE brand SET ";
            $sql .= " status = :status, ";
            $sql .= " name = :brand_name ";
            $sql .= "  WHERE id = :brand_id  ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":status",$req["status"]);
            $stmt->bindParam(":brand_name",$req["brand_name"]);
            $stmt->bindParam(":brand_id",$req["brand_id"]);
            $result = $stmt->execute();
        
            if($result){
                $_SESSION["STATUS"] = TRUE;
                $_SESSION["MSG"] = "Update Success.";
                header("location:../../index.php?page=brand");
                exit();
             
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            die();
        }

    }else{
        $req = array(
            "status" => isset($_POST["status"]) ? $_POST["status"] : "",
            "brand_name" => filter_var_string($_POST["brand_name"], "brand Name"),
        );
    
        $required = array(
          
            "brand_name" => "brand_name",   
        );
    
        if(validate($req, $required) === FALSE){
            $_SESSION["STATUS"] = FALSE;
            $_SESSION["MSG"] = "Parameter Missing";
            header("location:../../index.php?page=brand");
            exit();
        }

        try{
            $sql = "INSERT INTO brand  (status, name) values (:status ,:brand_name); ";
           /*  $sql .= " status = :status, ";
            $sql .= " type = :type, ";
            $sql .= " name = :brand_name "; */
            // $sql .= "  WHERE id = :id  ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":status",$req["status"]);
            $stmt->bindParam(":brand_name",$req["brand_name"]);
            $result = $stmt->execute();
        
            if($result){
                $_SESSION["STATUS"] = TRUE;
                $_SESSION["MSG"] = "Insert Success.";
                header("location:../../index.php?page=brand");
                exit();
             
            }
        }catch(PDOException $e){
            echo "Error: " . $e->getMessage();
            die();
        }
    }
    

}elseif(isset($_GET["action"]) && $_GET["action"] == "delete"){

    $req = array(
        "brand_id" => $_GET["brand_id"],
    );

    $required = array(  
        "brand_id" => "brand ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=brand");
        exit();
    }

try{
    $sql = "DELETE FROM brand  ";
    $sql .= "  WHERE id = :brand_id ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":brand_id",$req["brand_id"], PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = "Delete Success.";
        header("location:../../index.php?page=brand");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}


}elseif(isset($_GET["action"]) && $_GET["action"] == "delete_all"){

    $req = array(
        "brand_id" => $_POST["ch"],
    );

    $required = array(  
        "brand_id" => "brand ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=brand");
        exit();
    }

    $arr = array();
    $brand_id = implode(",", $req["brand_id"]);

try{
    $sql = "DELETE FROM brand  ";
    $sql .= "  WHERE id IN ($brand_id) ";

    echo $sql;
    $stmt = $conn->prepare($sql);
    // $stmt->bindParam(":user_id",$user_id, PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = "Delete Success.";
        header("location:../../index.php?page=brand");
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