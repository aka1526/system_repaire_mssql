<?php

function   escapetohtml($value= NULL){
    $_str="";
    $search = array("\\",  "\x00", "\n",  "\r",  "'",  "\x1a","&quot;",'"' );
    $replace = array("\\\\","\\0","\\n", "\\r", "\'",  "\\Z",'"','\"' );
    $_str = str_replace($search, $replace, $value);
    //$_str="";
    return   $_str;
}

function validate($req, $required){
    foreach($required as $key => $value){
        if(!isset($req[$key]) || empty($req[$key]) && $req[$key] != "0"){
            return false;
        }
    }
    return true;
}

function filter_var_string($req ,$name = NULL){
    $response = filter_var($req,FILTER_SANITIZE_STRING);
    if($response){
        return $response;
    }else{
        die("$name is not a valid string");
    }
    
}

function filter_var_email($req ,$name = NULL){
    $response = filter_var($req,FILTER_VALIDATE_EMAIL);
    if($response){
        return $response;
    }else{
        die("$name is not a valid email address");
    }
}

function filter_var_int($req ,$name = NULL){
    $response = (int)filter_var($req,FILTER_VALIDATE_INT);
    if($response){
        return $response;
    }else{
        die("$name is not a valid integer");
    }
}

function showDate($_date = NULL){
	$newDate="";
	if($_date!=""){
		 $newDate = date("d-m-Y", strtotime($_date));
	}
   
   
   return $newDate;
     
}
function showDatetime($_date = NULL){
	$newDate="";
	if($_date!=""){
		 $newDate = date("d-m-Y H:i:s", strtotime($_date));
	}
   
   
   return $newDate;
     
}


function login($req){
    global $conn;
    try{
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND status = 'Y' ");
        $stmt->bindParam(":username",filter_var_string($req["username"], "Username"));
        // $stmt->bindParam(":password",$req["password"]);
        $stmt->execute();
        $data = array();
        // if($count = $stmt->rowCount() > 0){
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if($data === FALSE){
            $response = array(
                "status" => FALSE,
                "msg" => "Incorrect username / password combination!",
            );
        }else{

            $validPassword = password_verify(filter_var_string($req["password"], "Password"), $data['password']);

            if($validPassword){
                $_SESSION["LOGIN"] = TRUE;
                $_SESSION["USER_ID"] = $data["id"];
                $_SESSION["USERNAME"] = $data["username"];
                $_SESSION["FIRST_NAME"] = $data["first_name"];
                $_SESSION["LAST_NAME"] = $data["last_name"];
                $_SESSION["PROFILE"] = $data["profile"];
                $_SESSION["PERMISSION"] = $data["permission"];

                $response = array(
                    "status" => TRUE,
                    "msg" => "Login Success.",
                );
            }else{
                $response = array(
                    "status" => FALSE,
                    "msg" => "Incorrect username / password combination!",
                );
            }
            
        }
        
        return $response;

    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        die();
    }
    
}


function fetch_all($fields, $table, $conditions = NULL , $req = NULL){
    global $conn;
    try{
        $stmt = $conn->prepare("SELECT $fields FROM $table $conditions ");
        if(!empty($req)){
            foreach($req as $key => $v){
                $stmt->bindParam(":".$key,$v);
            }
        }
        $result = $stmt->execute();
        $data = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          $data[] = $row;
        }
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        die();
    }
   
    return $data;
}

function fetch_query($_string = NULL , $req = NULL){
    global $conn;
    try{
        $stmt = $conn->prepare(" $_string ");
        if(!empty($req)){
            foreach($req as $key => $v){
                $stmt->bindParam(":".$key,$v);
            }
        }
        $result = $stmt->execute();
        $data = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          $data[] = $row;
        }
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        die();
    }
   
    return $data;
}


function num_rows($table,$where=null){
    global $conn;
    try{
        if($where==""){
            $where= " status = 'Y'";
        }
        $sql="SELECT * FROM $table WHERE  $where ";
        echo $sql;
        $stmt = $conn->prepare($sql);
        $result = $stmt->execute();
        $count = $stmt->rowCount();
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        die();
    }
   
    return $count;
}
function rows_count($table,$wh=null){
    global $conn;
    try{
        
        $sql="SELECT count(*)row FROM $table  ";
        if($wh!=""){
            $sql .=" WHERE  $wh ";
        }
        //echo $sql;
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data = array();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if($data === FALSE){
            $count=0;
        }else{
                
                $count = $data["row"];
            }
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        die();
    }
   
    return $count;
}

function getInvenName( $inven_id = NULL){
  global $conn;
	$inven_name="";
	
    if($inven_id==""){
		return $inven_name;	
	}
	$sql = "select name";
	$sql .= " from inventory ";
	$sql .= " WHERE id = '". $inven_id."'; ";
	
	$stmt = $conn->prepare($sql);
	$stmt->execute();
	$data = array();
	$data = $stmt->fetch(PDO::FETCH_ASSOC);
	if($data === FALSE){
		$inven_name="";
	}else{
		$inven_name = $data["name"];
	}
	return $inven_name;		
}


 
 function   SendLineNotify($sToken=null,$sMessage=null){
  	$chOne = curl_init(); 
	curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
	curl_setopt( $chOne, CURLOPT_POST, 1); 
	curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
	$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
	curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec( $chOne ); 
 	if(curl_error($chOne)) {
		curl_close( $chOne );   
		return true;
	} else {
		curl_close( $chOne );   
		return false;
	}
	
	
 }
 

?>