<?php

require_once(realpath(dirname(__FILE__) ."/../../db_function/connection.php"));
require_once(realpath(dirname(__FILE__) ."/../../db_function/function.php"));
date_default_timezone_set("Asia/Bangkok");
 
$time=date("Y-m-d H:i:s");  
$dateat=date("Y-m-d");   

if(isset($_GET["action"]) && $_GET["action"] == "create_repair"){
 

    $req = array(
        "problem" => filter_var_string($_POST["problem"], "Problem"),
        "description" => filter_var_string($_POST["description"], "Description"),
        "inventory" => $_POST["inven"],
        "doc_status" => "3",
        "repairer"=> filter_var_string($_POST["repairer"], "Repairer"),
       // "user_id" => $_SESSION["USER_ID"],
		//"user_name" => $_SESSION["USERNAME"],
         
		
    );

    $required = array(
        "problem" => "Problem",   
        "description" => "Description",   
        "inventory" => "Inventory",
         "repairer" => "Repairer",
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=repair");
        exit();
    }

try{
 
	$sql = "INSERT INTO repair ( description,inventory_id,problem,repairer,doc_status,updated_at,created_at,doc_date) 
	VALUES ( :description,:inventory,:problem,:repairer,:doc_status,:updated_at,:created_at, :doc_date); ";
    
    $stmt = $conn->prepare($sql);
    
    $stmt->bindParam(":description",$req["description"]);
    $stmt->bindParam(":inventory",$req["inventory"]);
    $stmt->bindParam(":problem",$req["problem"]);
    $stmt->bindParam(":repairer",$req["repairer"]);
    $stmt->bindParam(":doc_status",$req["doc_status"]);
	$stmt->bindParam(":updated_at",$time);
	$stmt->bindParam(":created_at",$time);
 	$stmt->bindParam(":doc_date", $dateat);
    $result = $stmt->execute();
    $id = $conn->lastInsertId();
    $status_id = "3";
    if($result){
    
    $sql = "INSERT INTO repair_detail (repair_id,status_id,updated_at,created_at,user_name,inventory_id,doc_date,problem_id) 
	       VALUES (:repair_id,:status_id,:updated_at,:created_at,:user_name,:inventory_id ,:doc_date,:problem_id ); ";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":repair_id",$id, PDO::PARAM_INT);
    $stmt->bindParam(":status_id",$status_id, PDO::PARAM_INT);
	$stmt->bindParam(":updated_at",$time);
	$stmt->bindParam(":created_at",$time);
	$stmt->bindParam(":user_name", $req["user_name"]);
    $stmt->bindParam(":inventory_id", $req["inventory"]);
    $stmt->bindParam(":doc_date", $dateat);
    $stmt->bindParam(":problem_id", $req["problem"]);
    $result = $stmt->execute();
    

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = "Insert Success.";
        header("location:../../index.php?page=repair");
        exit();
     
    }

      
}
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}

}elseif(isset($_GET["action"]) && $_GET["action"] == "update_repair"){


    $req = array(
        "title" => filter_var_string($_POST["title"], "Title"),
        "description" => filter_var_string($_POST["description"], "Description"),
        "inventory" => $_POST["inven"],
        "user_id" => $_SESSION["USER_ID"],
		"user_name" => $_SESSION["USERNAME"],
		"repair_id" => $_POST["repair_id"],

    );

    $required = array(
        "title" => "Title",   
        "description" => "Description",   
        "inventory" => "Inventory",
        "user_id" => "User ID",
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=repair");
        exit();
    }

try{
 
	$sql = "UPDATE repair SET  "; 
	$sql .= " title = :title, ";
    $sql .= " description = :description, ";
    $sql .= " inventory_id = :inventory, ";
    $sql .= " user_id = :user_id, ";
    $sql .= " updated_at = :updated_at ";
    $sql .= "  WHERE id = :id  ";
	
	
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":title",$req["title"]);
    $stmt->bindParam(":description",$req["description"]);
    $stmt->bindParam(":inventory",$req["inventory"]);
    $stmt->bindParam(":user_id",$req["user_id"]);
	$stmt->bindParam(":updated_at",$time);
	$stmt->bindParam(":id",$req["repair_id"]);
 
    $result = $stmt->execute();
 
	if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = "Update Success.";
        header("location:../../index.php?page=repair");
        exit();
     
    }
	
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}

} elseif(isset($_GET["action"]) && $_GET["action"] == "update_users"){

    $req = array(
        "status" => isset($_POST["status"]) ? $_POST["status"] : "",
        "permission" => isset($_POST["permission"]) ? $_POST["permission"] : "",
        "username" => filter_var_string($_POST["username"] , "Username"),
        "email" => filter_var_email($_POST["email"], "Email"),
        "first_name" => filter_var_string($_POST["first_name"], "First Name"),
        "last_name" => filter_var_string($_POST["last_name"], "Last Name"),
        "gender" => $_POST["gender"],
        "birthdate" => $_POST["birthdate"],
        "phone_number" => isset($_POST["phone_number"]) ? $_POST["phone_number"] : "",
        "user_id" => $_POST["user_id"],
    );

    $required = array(
        "user_id" => "User ID",   
        "username" => "Username",     
        "email" => "Email",
        "first_name" => "First Name",
        "last_name" => "Last Name",
    );


    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=users");
        exit();
    }

try{

    $sql = "UPDATE users SET ";
    if(!empty($req["status"])){
        $sql .= " status = :status, ";
    }
    if(!empty($req["permission"])){
        $sql .= " permission =:permission, ";
    }
    $sql .= " username = :username, ";
    $sql .= " email =:email, ";
    $sql .= " first_name = :first_name, ";
    $sql .= " last_name = :last_name, ";
    $sql .= " gender = :gender, ";
    $sql .= " birthdate = :birthdate, ";
    $sql .= " phone_number = :phone_number ";
    $sql .= "  WHERE id = :user_id  ";
    $stmt = $conn->prepare($sql);
    if(!empty($req["status"])){
    $stmt->bindParam(":status",$req["status"]);
    }
    if(!empty($req["permission"])){
    $stmt->bindParam(":permission",$req["permission"]);
    }
    $stmt->bindParam(":username",$req["username"]);
    $stmt->bindParam(":email",$req["email"]);
    $stmt->bindParam(":first_name",$req["first_name"]);
    $stmt->bindParam(":last_name",$req["last_name"]);
    $stmt->bindParam(":gender",$req["gender"]);
    $stmt->bindParam(":birthdate",$req["birthdate"]);
    $stmt->bindParam(":phone_number",$req["phone_number"]);
    $stmt->bindParam(":user_id",$req["user_id"]);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = "Update Success.";
        header("location:../../index.php?page=users/edit&user_id=".$req["user_id"]);
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}


}elseif(isset($_GET["action"]) && $_GET["action"] == "delete"){

    $req = array(
        "repair_id" => $_GET["repair_id"],
    );

    $required = array(  
        "repair_id" => "Repair ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=repair");
        exit();
    }


try{
    $sql = "DELETE FROM repair  ";
    $sql .= "  WHERE id = :repair_id ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":repair_id",$req["repair_id"], PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = "Delete Success.";
        header("location:../../index.php?page=repair");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}


}elseif(isset($_GET["action"]) && $_GET["action"] == "delete_all"){

    $req = array(
        "repair_id" => $_POST["ch"],
    );

    $required = array(  
        "repair_id" => "Repair ID",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=repair");
        exit();
    }

    $arr = array();

    foreach($_POST["ch"] as $v){
        $arr[] = explode(",",$v);
    }

    $user_id = "";

    foreach($arr as $v){
        $user_id .= $v[0].",";

    }


    $repair_id = substr($user_id, 0,-1);


try{
    $sql = " DELETE FROM repair  ";
    $sql .= "  WHERE id IN ($repair_id) ";

   // echo $sql;
    $stmt = $conn->prepare($sql);
    // $stmt->bindParam(":user_id",$user_id, PDO::PARAM_INT);
    $result = $stmt->execute();

    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = "Delete Success.";
        header("location:../../index.php?page=repair");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}

}elseif(isset($_GET["action"]) && $_GET["action"] == "created_detail"){

    $req = array(
        "note" => $_POST["note"],
        "status" => $_POST["status"],
        "amount" => $_POST["amount"],
        "breakdown" => $_POST["breakdown"],
        "repair_id" => $_POST["repair_id"],
         "user_name" => $_SESSION["USERNAME"],
         "inventory" => $_POST["inventory_id"],
         "problem" => $_POST["problem"],
		  //$_SESSION["USERNAME"] $_SESSION["USER_ID"]
    );


 
	
    $required = array(
        "status" => "status",   
        "repair_id" => "repair_id",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=repair/edit&repair_id=".$req["repair_id"]);
        exit();
    }

try{
 
    $sql = "INSERT INTO repair_detail (repair_id,note,status_id,amount,breakdown,updated_at,created_at,user_name,doc_date,inventory_id,problem_id) 
	values (:repair_id,:note, :status,:amount,:breakdown,:updated_at,:created_at,:user_name,:doc_date,:inventory_id,:problem_id); ";
  
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(":repair_id",$req["repair_id"]);
    $stmt->bindParam(":note",$req["note"]);
    $stmt->bindParam(":status",$req["status"]);
    $stmt->bindParam(":amount",$req["amount"]);
    $stmt->bindParam(":breakdown",$req["breakdown"]);
	$stmt->bindParam(":updated_at",$time);
	$stmt->bindParam(":created_at",$time);
    $stmt->bindParam(":user_name", $req["user_name"]);
    $stmt->bindParam(":doc_date", $dateat);
    $stmt->bindParam(":inventory_id", $req["inventory"]);
    $stmt->bindParam(":problem_id", $req["problem"]);
    
    
	$result = $stmt->execute();
    $id = $conn->lastInsertId();

    if($result){
        $sql = " update repair  set doc_status = :doc_status where id =:id ; ";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(":doc_status",$req["status"]);
        $stmt->bindParam(":id",$req["repair_id"], PDO::PARAM_INT);
        $result = $stmt->execute();
     if($result){

        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = "Insert Success.";
        header("location:../../index.php?page=repair/edit&repair_id=".$req["repair_id"]);
        exit();
     
    }
}

}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    exit();
    die();
}


}else{
    defined('APPS') OR exit('No direct script access allowed ==>');
}





?>