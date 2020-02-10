<?php
 
require_once(realpath(dirname(__FILE__) ."/../../db_function/connection.php"));
require_once(realpath(dirname(__FILE__) ."/../../db_function/function.php"));
$tbl="calendar";
$page="calendar";
if(isset($_GET["action"]) && $_GET["action"] == "save_section"){

    if(!empty($_POST["inventory"]) &&!empty($_POST["pmdate"])&&!empty($_POST["pmitem"])){

        $req = array(
            "inventory" => filter_var_string($_POST["inventory"], "inventory item Name"),
            "pmitem" => filter_var_string($_POST["pmitem"], "PM item Name"),
            "pmdate" => filter_var_string($_POST["pmdate"], "pmdate item Name"),
            "color" => isset($_POST["set_color"]) ? $_POST["set_color"] : "#ff1a8c",
            "type" => isset($_POST["type"]) ? $_POST["type"] : "",
            
        );
    
        $required = array(
            "inventory" => "section_name",   
            "pmitem" => "pmitem",   
            "pmdate" => "pmdate",   
            
        );
    
        if(validate($req, $required) === FALSE){
            $_SESSION["STATUS"] = FALSE;
            $_SESSION["MSG"] = "Parameter Missing";
            header("location:../../index.php?page=$page");
            exit();
        }

        try{
            
  if($_svhost=="mysql"){ 
        $sql = "INSERT INTO $tbl (title,inventory,start,end,color,type ) 
        values (:title,:inventory,:start,:end,:color,:type) ; ";
  } else {
    $sql = "INSERT INTO $tbl (title,inventory,start,[end],color,type ) 
    values (:title,:inventory,:start,:end,:color,:type) ; ";
      }
           
                
       
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":title",$req["pmitem"]);
            $stmt->bindParam(":inventory",$req["inventory"]);
            $stmt->bindParam(":start",$req["pmdate"]);
            $stmt->bindParam(":end",$req["pmdate"]);
            $stmt->bindParam(":color",$req["color"]);
            $stmt->bindParam(":type",$req["type"]);

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

    } else {
        $_SESSION["STATUS"] = false;
        $_SESSION["MSG"] = "Parameter Missing.";
        header("location:../../index.php?page=$page");
        exit();
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