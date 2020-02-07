<?php

require_once(realpath(dirname(__FILE__) ."/../../db_function/connection.php"));
require_once(realpath(dirname(__FILE__) ."/../../db_function/function.php"));

if(isset($_GET["action"]) && $_GET["action"] == "create_inventory"){


    if (!empty($_FILES["photo"]["name"])) {
        $file = $_FILES["photo"];
        $temp = explode(".", $file["name"]);
        $photo = round(microtime(true)) . '_' . $_SESSION["USER_ID"] . '.' . end($temp);

        if (!empty($_POST["old_photo"])) {
            unlink("../../uploads/inventory/" . $_POST["old_photo"]);
        }

        if (move_uploaded_file($file["tmp_name"], '../../uploads/inventory/' . $photo)) { } else {
            $_SESSION["alert"] = array("status" => "error", "msg" => "Upload file failed");
            header("location:../../index.php?page=inventory");
            return false;
        }
    }

    $req = array(
        "expire_date" => isset($_POST["expire_date"]) ? $_POST["expire_date"] : "",
        "name" => filter_var_string($_POST["name"], "Name"),
        "serial_number" => $_POST["serial_number"] , 
        "category" => $_POST["category"],
        "type" => $_POST["type"],
        "section" => $_POST["section"],
        "owner_name" => $_POST["owner_name"],
        "brand" => $_POST["brand"],
        "os_name" => $_POST["os_name"],
        "cpu_model" => $_POST["cpu_model"],
        "ram_model" => $_POST["ram_model"],
        "hdd_model" => $_POST["hdd_model"],
        "monitor_model" => $_POST["monitor_model"],
        "inven_status" => isset($_POST["inven_status"]) ? $_POST["inven_status"] : "1",
        "photo" => isset($photo) ? $photo : "",
    );

    $required = array(
        "name" => "Name",   
        "category" => "Category",
        "type" => "Type",
        "section" => "section",
        "brand" => "Brand",
        
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=inventory");
        exit();
    }

try{

    $sql = "INSERT INTO inventory (expire_date,section,name,serial_number,owner_name,category,type,brand,photo,inven_status,os_name,cpu_model,ram_model,hdd_model,monitor_model) values   ";
	$sql .= "(:expire_date,:section,:name,:serial_number,:owner_name,:category, :type,:brand,:photo,:inven_status,:os_name,:cpu_model,:ram_model,:hdd_model,:monitor_model); ";
   /*  $sql .= " status = :status, ";
    $sql .= " name = :name, ";
    $sql .= " serial_number = :serial_number, ";
    $sql .= " category =:category, ";
    $sql .= " type = :type, ";
    $sql .= " brand = :brand, ";
    $sql .= " photo = :photo "; */
 
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":expire_date",$req["expire_date"]);
    $stmt->bindParam(":name",$req["name"]);
    $stmt->bindParam(":serial_number",$req["serial_number"]);
    $stmt->bindParam(":owner_name",$req["owner_name"]);
    $stmt->bindParam(":category",$req["category"]);
    $stmt->bindParam(":type",$req["type"]);
    $stmt->bindParam(":section",$req["section"]);
    $stmt->bindParam(":brand",$req["brand"]);
    $stmt->bindParam(":os_name",$req["os_name"]);
    $stmt->bindParam(":cpu_model",$req["cpu_model"]);
    $stmt->bindParam(":ram_model",$req["ram_model"]);
    $stmt->bindParam(":hdd_model",$req["hdd_model"]);
   // $stmt->bindParam(":monitor_model",html_escape($req["monitor_model"]));   PDO::PARAM_STR
    $stmt->bindParam(":monitor_model",$req["monitor_model"] );  
    $stmt->bindParam(":photo",$req["photo"]);
    $stmt->bindParam(":inven_status",$req["inven_status"]);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = "Insert Success.";
        header("location:../../index.php?page=inventory");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}

}elseif(isset($_GET["action"]) && $_GET["action"] == "update_inventory"){

    if (!empty($_FILES["photo"]["name"])) {
        $file = $_FILES["photo"];
        $temp = explode(".", $file["name"]);
        $photo = round(microtime(true)) . '_' . $_SESSION["USER_ID"] . '.' . end($temp);

        if (!empty($_POST["old_photo"])) {
            unlink("../../uploads/inventory/" . $_POST["old_photo"]);
        }

        if (move_uploaded_file($file["tmp_name"], '../../uploads/inventory/' . $photo)) { } else {
            $_SESSION["alert"] = array("status" => "error", "msg" => "Upload file failed");
            header("location:../../index.php?page=inventory");
            return false;
        }
    }

/*
    $req = array(
        "status" => isset($_POST["status"]) ? $_POST["status"] : "1",
        "name" =>  isset($_POST["name"]) ? $_POST["name"] : "",
         "serial_number" => isset($_POST["serial_number"]) ? $_POST["serial_number"] : "-",
        "category" => $_POST["category"],
        "section" => $_POST["section"],
        "type" => $_POST["type"],
        "brand" => $_POST["brand"],
        "photo" => isset($photo) ? $photo : "",
        "inventory_id" => $_GET["inventory_id"],
    );

    $required = array(
        "status" => "Status",
        "name" => "Name",   
        "category" => "Category",
        "section" => "Section",
        "type" => "Type",
        "brand" => "Brand",
        "inventory_id" => "Inventory ID",  
    );
*/

    $req = array(
        "inven_status" =>  $_POST["inven_status"] ,
        "name" => filter_var_string($_POST["name"], "Name"),
        "serial_number" =>$_POST["serial_number"],
        "owner_name" =>$_POST["owner_name"],
        "category" => $_POST["category"],
        "section" => $_POST["section"],
        "type" => $_POST["type"],
        "expire_date" => $_POST["expire_date"],
        "brand" => $_POST["brand"],
        "os_name" => $_POST["os_name"],
        "cpu_model" => $_POST["cpu_model"],
        "ram_model" => $_POST["ram_model"],
        "hdd_model" => $_POST["hdd_model"],
        "monitor_model" => $_POST["monitor_model"],
        "photo" => isset($photo) ? $photo : "",
        "inventory_id" => $_GET["inventory_id"],
    );

    $required = array(
        "name" => "Name",   
        "category" => "Category",
        "type" => "Type",
        "brand" => "Brand",
        "inventory_id" => "Inventory ID",  
    );


    print_r($req);
    //echo "<br/>";
    //print_r($required);
   //  exit();
    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
       header("location:../../index.php?page=inventory");
        exit();
    }

try{
 
    $sql = " UPDATE inventory SET ";
    $sql .= " inven_status = :inven_status, ";
    $sql .= " name = :name, ";
    $sql .= " serial_number =:serial_number, ";
    $sql .= " owner_name =:owner_name, ";
    $sql .= " category = :category, ";
    $sql .= " section = :section, ";
    $sql .= " type = :type, ";
    $sql .= " expire_date = :expire_date, ";
    $sql .= " os_name = :os_name, ";
    $sql .= " cpu_model = :cpu_model, ";
    $sql .= " ram_model = :ram_model, ";
    $sql .= " hdd_model = :hdd_model, ";
    $sql .= " monitor_model = :monitor_model, ";
    if(!empty($req["photo"])){
        $sql .= " photo = :photo, ";
    }
    $sql .= " brand = :brand ";
    $sql .= "  WHERE id = :inventory_id  ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":inven_status",$req["inven_status"]);
    $stmt->bindParam(":name",$req["name"]);
    $stmt->bindParam(":serial_number",$req["serial_number"]);
    $stmt->bindParam(":owner_name",$req["owner_name"]);
    $stmt->bindParam(":category",$req["category"]);
    $stmt->bindParam(":section",$req["section"]);
    $stmt->bindParam(":type",$req["type"]);
    $stmt->bindParam(":expire_date",$req["expire_date"]);
    $stmt->bindParam(":brand",$req["brand"]);
    $stmt->bindParam(":os_name",$req["os_name"]);
    $stmt->bindParam(":cpu_model",$req["cpu_model"]);
    $stmt->bindParam(":ram_model",$req["ram_model"]);
    $stmt->bindParam(":hdd_model",$req["hdd_model"]);
    $stmt->bindParam(":monitor_model", $req["monitor_model"]);
    $stmt->bindParam(":inventory_id",$req["inventory_id"]);
    if(!empty($req["photo"])){
        $stmt->bindParam(":photo",$req["photo"]);
    }
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = "Update Success.";
        header("location:../../index.php?page=inventory/edit&inventory_id=".$req["inventory_id"]);
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}


}elseif(isset($_GET["action"]) && $_GET["action"] == "delete"){

    $req = array(
        "inventory_id" => $_GET["inventory_id"],
        "profile" => $_GET["photo"],
    );

    $required = array(  
        "inventory_id" => "Inventory ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=inventory");
        exit();
    }

    if($req["profile"]){
        unlink("../../uploads/inventory/" . $req["photo"]);
    }

try{
    $sql = "DELETE FROM inventory  ";
    $sql .= "  WHERE id = :inventory_id ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":inventory_id",$req["inventory_id"], PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = "Delete Success.";
        header("location:../../index.php?page=inventory");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}


}elseif(isset($_GET["action"]) && $_GET["action"] == "delete_all"){

    $req = array(
        "inventory_id" => $_POST["ch"],
    );

    $required = array(  
        "inventory_id" => "Inventory ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=inventory_id");
        exit();
    }

    $arr = array();

    foreach($_POST["ch"] as $v){
        $arr[] = explode(",",$v);
    }

    $inventory_id = "";
    $photo = "";

    foreach($arr as $v){
        $inventory_id .= $v[0].",";
        $photo .= $v[1].",";

    }

    $photo_ex = explode(",", $photo);
    foreach($photo_ex as $v){
        if($v){
            unlink("../../uploads/inventory/" . $v);
        }
    }

    $inventory_id = substr($inventory_id, 0,-1);
try{
    $sql = "DELETE FROM inventory  ";
    $sql .= "  WHERE id IN ($inventory_id) ";

    echo $sql;
    $stmt = $conn->prepare($sql);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = "Delete Success.";
        header("location:../../index.php?page=inventory");
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