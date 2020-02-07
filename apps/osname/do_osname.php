<?php

require_once(realpath(dirname(__FILE__) ."/../../db_function/connection.php"));
require_once(realpath(dirname(__FILE__) ."/../../db_function/function.php"));
$tbl="osname";
$page="osname";

if(isset($_GET["action"]) && $_GET["action"] == "save_osname"){
    $row_count =rows_count($tbl," os_id='".$_POST["os_id"]."'") ;  
     
    foreach ($_POST as $key => $value) {
        echo "Field ".htmlspecialchars($key)." is ".htmlspecialchars($value)."<br>";
    }
    //exit();
    if(!empty($_POST["os_id"]) && ($row_count>0)){

        $req = array(
            "status" => isset($_POST["status"]) ? $_POST["status"] : "",
            "os_name" => filter_var_string($_POST["os_name"], "Operating System Name"),
            "os_id" => isset($_POST["os_id"]) ? $_POST["os_id"] : "",
        );
    
        $required = array(
            
            "os_name" => "os_name",   
            "os_id" => "os_id",   
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
            $sql .= " os_name = :os_name ";
            $sql .= "  WHERE os_id = :os_id  ";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":status",$req["status"]);
            $stmt->bindParam(":os_name",$req["os_name"]);
            $stmt->bindParam(":os_id",$req["os_id"]);
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
            "os_name" => filter_var_string($_POST["os_name"], "Operating System Name"),
            "os_id" => filter_var_string($_POST["os_id"], "Operating System Code"),
        );
    
        $required = array(
            
            "os_name" => "os_name",   
        );
    
        if(validate($req, $required) === FALSE){
            $_SESSION["STATUS"] = FALSE;
            $_SESSION["MSG"] = "Parameter Missing";
            header("location:../../index.php?page=$page");
            exit();
        }

        try{
            $sql = "INSERT INTO $tbl (status ,os_id,os_name ) values (:status, :os_id,:os_name  ) ; ";
       
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":status",$req["status"]);
            $stmt->bindParam(":os_id",$req["os_id"]);
            $stmt->bindParam(":os_name",$req["os_name"]);
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
        "os_id" => $_GET["os_id"],
    );

    $required = array(  
        "os_id" => "section ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=$page");
        exit();
    }

try{
    $sql = "DELETE FROM $tbl  ";
    $sql .= "  WHERE os_id = :os_id ";
    $stmt = $conn->prepare($sql);
    //$stmt->bindParam(":os_id",$req["os_id"], PDO::PARAM_INT);
    $stmt->bindParam(":os_id",$req["os_id"], PDO::PARAM_STR);
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
        "os_id" => $_POST["ch"],
    );

    $required = array(  
        "os_id" => "Operating System Code",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=$page");
        exit();
    }

    $arr = array();
    $os_id = implode("','", $req["os_id"]);

try{
    $sql = "DELETE FROM $tbl  ";
    $sql .= "  WHERE os_id IN ('$os_id') ";

 
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