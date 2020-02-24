<?php

require_once(realpath(dirname(__FILE__) ."/../../db_function/connection.php"));
require_once(realpath(dirname(__FILE__) ."/../../db_function/function.php"));

if(isset($_GET["action"]) && $_GET["action"] == "add_services"){

  $req = array(
				"docdate" => isset($_POST["docdate"]) ? $_POST["docdate"] : date("Y-m-d"),
				"inven_id" => $_POST["inventory"] ,
				"borrow_name" => $_POST["borrow_name"] , 
				"sec_id" => $_POST["section"],
				"type_name" => trim($_POST["type_name"]),
				"type_in" => isset($_POST["type_in"]) ? $_POST["type_in"] :"REC",
				"type_out" => isset($_POST["type_out"]) ? $_POST["type_out"] : "ISSUE",
				"remark" => $_POST["remark"],
				"doc_refer" => $_POST["doc_refer"],
				"tel" => $_POST["tel"],
				"create_date_time" => date("Y-m-d H:i:s"),
				"due_date" => $_POST["due_date"],
				"line_token" => $_POST["line_token"],
				 
			);

			$required = array(
				 
				"inven_id" => "inven_id",
				"sec_id" => "sec_id",
			);

			if(validate($req, $required) === FALSE){
				$_SESSION["STATUS"] = FALSE;
				$_SESSION["MSG"] = "Parameter Missing";
				header("location:../../index.php?page=services");
				exit();
			}

			$inven_name="";
			if($req["inven_id"]!=""){
				$inven_name=getInvenName($req["inven_id"]);
			}	

		try{

			$sql = "INSERT INTO services ( docdate, inven_id, borrow_name, sec_id, type_name, type_in, type_out, remark, doc_refer, tel, create_date_time,due_date) values   ";
			$sql .= " (:docdate,:inven_id,:borrow_name,:sec_id,:type_name,:type_in, :type_out,:remark,:doc_refer,:tel,:create_date_time,:due_date );";
			$sql .= " update services set row_refer =row_index where row_refer is null ;";
		  
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(":docdate",$req["docdate"]);
			$stmt->bindParam(":inven_id",$req["inven_id"]);
			$stmt->bindParam(":borrow_name",$req["borrow_name"]);
			$stmt->bindParam(":sec_id",$req["sec_id"]);
			$stmt->bindParam(":type_name",$req["type_name"]);
			$stmt->bindParam(":type_in",$req["type_in"]);
			$stmt->bindParam(":type_out",$req["type_out"]);
			$stmt->bindParam(":remark",$req["remark"]);
			$stmt->bindParam(":doc_refer",$req["doc_refer"]);
			$stmt->bindParam(":tel",$req["tel"]);
			$stmt->bindParam(":create_date_time",$req["create_date_time"]);
			$stmt->bindParam(":due_date",$req["due_date"]);
			 
			$result = $stmt->execute();
           // 
			if($result){
				$_SESSION["STATUS"] = TRUE;
				$_SESSION["MSG"] = "Insert Success.";
			 
				$msg = " วันที่ :".$req["docdate"] ." \nรายการขอยืม :  ".$inven_name ."\nโดย " . $req["borrow_name"] ;
				$msg .= "\nเหตุผล :" .$req["remark"] ."\nเบอร์ติดต่อ ". $req["tel"];
				SendLineNotify($req["line_token"],$msg);
				header("location:../../index.php?page=services");
				exit();
			 
			}
		}catch(PDOException $e){
			echo "Error: " . $e->getMessage();
			die();
		}

  

}else if(isset($_GET["action"]) && $_GET["action"] == "rec_services"){

  $req = array(
				"docdate" => isset($_POST["docdate"]) ? $_POST["docdate"] : date("Y-m-d"),
				"inven_id" => $_POST["inven_id"] ,
				"borrow_name" => $_POST["borrow_name"] , 
				"sec_id" => $_POST["sec_id"],
				"type_name" => trim($_POST["type_name"]),
				"type_in" => isset($_POST["type_in"]) ? $_POST["type_in"] :"REC",
				"type_out" => isset($_POST["type_out"]) ? $_POST["type_out"] : "ISSUE",
				"remark" => $_POST["remark"],
				"doc_refer" => $_POST["doc_refer"],
				"tel" => $_POST["tel"],
				"create_date_time" => date("Y-m-d H:i:s"),
				"due_date" => $_POST["due_date"],
				"row_refer" => $_POST["row_refer"],
				"line_token" => $_POST["line_token"],
			);

			$required = array(
				 
				"inven_id" => "inven_id",
				"sec_id" => "sec_id",
			);

			if(validate($req, $required) === FALSE){
				$_SESSION["STATUS"] = FALSE;
				$_SESSION["MSG"] = "Parameter Missing";
				header("location:../../index.php?page=services");
				exit();
			}

			$inven_name="";
			if($req["inven_id"]!=""){
				$inven_name=getInvenName($req["inven_id"]);
			}	
			
		try{

			$sql = "INSERT INTO services ( docdate, inven_id, borrow_name, sec_id, type_name, type_in, type_out, remark, doc_refer, tel, create_date_time,due_date,row_refer) values   ";
			$sql .= " (:docdate,:inven_id,:borrow_name,:sec_id,:type_name,:type_in, :type_out,:remark,:doc_refer,:tel,:create_date_time,:due_date,:row_refer ); ";
		  
			$stmt = $conn->prepare($sql);
			$stmt->bindParam(":docdate",$req["docdate"]);
			$stmt->bindParam(":inven_id",$req["inven_id"]);
			$stmt->bindParam(":borrow_name",$req["borrow_name"]);
			$stmt->bindParam(":sec_id",$req["sec_id"]);
			$stmt->bindParam(":type_name",$req["type_name"]);
			$stmt->bindParam(":type_in",$req["type_in"]);
			$stmt->bindParam(":type_out",$req["type_out"]);
			$stmt->bindParam(":remark",$req["remark"]);
			$stmt->bindParam(":doc_refer",$req["doc_refer"]);
			$stmt->bindParam(":tel",$req["tel"]);
			$stmt->bindParam(":create_date_time",$req["create_date_time"]);
			$stmt->bindParam(":due_date",$req["due_date"]);
			$stmt->bindParam(":row_refer",$req["row_refer"]);
			$result = $stmt->execute();

			if($result){
				$_SESSION["STATUS"] = TRUE;
				$_SESSION["MSG"] = "Insert Success.";
				$msg = " วันที่คืน :".$req["docdate"] ." \nรายการคืน :  ".$inven_name ."\nโดย " . $req["borrow_name"] ;
				$msg .= "\nเหตุผล :" .$req["remark"] ."\nเบอร์ติดต่อ ". $req["tel"];
				SendLineNotify($req["line_token"],$msg);
				 
				header("location:../../index.php?page=services");
				exit();
			 
			}
		}catch(PDOException $e){
			echo "Error: " . $e->getMessage();
			die();
		}

  

}


else{
    defined('APPS') OR exit('No direct script access allowed');
}
 

?>