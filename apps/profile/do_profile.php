<?php

require_once(realpath(dirname(__FILE__) ."/../../db_function/connection.php"));
require_once(realpath(dirname(__FILE__) ."/../../db_function/function.php"));

if(isset($_GET["action"]) && $_GET["action"] == "upload_info"){
    $req = array(
        "status" => isset($_POST["status"]) ? $_POST["status"] : "",
        "permission" => isset($_POST["permission"]) ? $_POST["permission"] : "",
        "username" => $_POST["username"],
        "email" => $_POST["email"],
        "first_name" => $_POST["first_name"],
        "last_name" => $_POST["last_name"],
        "gender" => $_POST["gender"],
        "birthdate" => $_POST["birthdate"],
        "phone_number" => $_POST["phone_number"],
    );

    $required = array(
        "username" => "Username",   
        "email" => "Email",
        "first_name" => "First Name",
        "last_name" => "Last Name",
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=profile");
        exit();
    }

try{

    $sql = "UPDATE users SET ";
    if(!empty($req["status"])){
        $sql .= " status = :status, ";
    }
    if(!empty($req["status"])){
        $sql .= " permission =:permission, ";
    }
    $sql .= " username = :username, ";
    $sql .= " email =:email, ";
    $sql .= " first_name = :first_name, ";
    $sql .= " last_name = :last_name, ";
    $sql .= " gender = :gender, ";
    $sql .= " birthdate = :birthdate, ";
    $sql .= " phone_number = :phone_number ";
    $sql .= "  WHERE id = :id  ";
    $stmt = $conn->prepare($sql);
    if(!empty($req["status"])){
    $stmt->bindParam(":status",$req["status"]);
    }
    if(!empty($req["status"])){
    $stmt->bindParam(":permission",$req["permission"]);
    }
    $stmt->bindParam(":username",$req["username"]);
    $stmt->bindParam(":email",$req["email"]);
    $stmt->bindParam(":first_name",$req["first_name"]);
    $stmt->bindParam(":last_name",$req["last_name"]);
    $stmt->bindParam(":gender",$req["gender"]);
    $stmt->bindParam(":birthdate",$req["birthdate"]);
    $stmt->bindParam(":phone_number",$req["phone_number"]);
    $stmt->bindParam(":id",$_SESSION["USER_ID"]);
    $result = $stmt->execute();

    if($result){
        $_SESSION["FIRST_NAME"] = $req["first_name"];
        $_SESSION["LAST_NAME"] = $req["last_name"];
        $_SESSION["PERMISSION"] = $req["permission"];
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = "Update Profile Success.";
        header("location:../../index.php?page=profile");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}

}elseif(isset($_GET["action"]) && $_GET["action"] == "check_username"){

    $req = array(
        "username" => $_POST["username"],
    );

    $required = array(
        "username" => "Username",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=profile");
        exit();
    }

    try{
        $sql = "SELECT COUNT(username) AS num FROM users WHERE username = :username AND id != :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':username', $req["username"]);
        $stmt->bindValue(':id', $_SESSION["USER_ID"]);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row['num'] > 0){
            echo json_encode('This username is already taken.');
        }else{
            echo json_encode('true');
        }
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        die();
    }

    
}elseif(isset($_GET["action"]) && $_GET["action"] == "check_email"){

    $req = array(
        "email" => $_POST["email"],
    );

    $required = array(
        "email" => "Email",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=profile");
        exit();
    }

    try{
        $sql = "SELECT COUNT(email) AS num FROM users WHERE email = :email AND id != :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':email', $req["email"]);
        $stmt->bindValue(':id', $_SESSION["USER_ID"]);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if($row['num'] > 0){
            echo json_encode('This email is already taken.');
        }else{
            echo json_encode('true');
        }
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        die();
    }

}elseif(isset($_GET["action"]) && $_GET["action"] == "check_password"){

    $req = array(
        "current_password" => $_POST["current_password"],
    );

    $required = array(
        "current_password" => "Current Password",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=profile");
        exit();
    }

    try{
        $sql = "SELECT password FROM users WHERE id = :id ";
        $stmt = $conn->prepare($sql);
        $stmt->bindValue(':id', $_SESSION["USER_ID"]);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $validPassword = password_verify($req["current_password"], $row['password']);
        if($validPassword){
            echo json_encode('true');
        }else{
            echo json_encode('Current password does not match!');
        }
    }catch(PDOException $e){
        echo "Error: " . $e->getMessage();
        die();
    }

}elseif(isset($_GET["action"]) && $_GET["action"] == "change_password"){
    $req = array(
        "new_password" => password_hash($_POST["new_password"], PASSWORD_DEFAULT),
    );

    $required = array(
        "new_password" => "New Password",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=profile");
        exit();
    }

try{

    $stmt = $conn->prepare("UPDATE users SET password = :password WHERE id = :id ");
    $stmt->bindParam(":password",$req["new_password"]);
    $stmt->bindParam(":id",$_SESSION["USER_ID"]);
    $result = $stmt->execute();
    if($result){
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = "Change Password Success.";
        header("location:../../index.php?page=profile");
        exit();
     
    }
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}

}elseif(isset($_GET["action"]) && $_GET["action"] == "upload_profile"){

    if (!empty($_FILES["photo"]["name"])) {
        $file = $_FILES["photo"];
        $temp = explode(".", $file["name"]);
        $photo = round(microtime(true)) . '_' . $_SESSION["USER_ID"] . '.' . end($temp);

        if (!empty($_POST["old_profile"])) {
            unlink("../../uploads/users/" . $_POST["old_profile"]);
        }

        if (move_uploaded_file($file["tmp_name"], '../../uploads/users/' . $photo)) { } else {
            $_SESSION["alert"] = array("status" => "error", "msg" => "Upload file failed");
            header("location:../../index.php?page=profile");
            return false;
        }
    }

    $req = array(
        "profile" => $photo
    );

    $required = array(
        "profile" => "Profile",   
    );

    if(validate($req, $required) === FALSE){
        $_SESSION["STATUS"] = FALSE;
        $_SESSION["MSG"] = "Parameter Missing";
        header("location:../../index.php?page=profile");
        exit();
    }

try{

    $stmt = $conn->prepare("UPDATE users SET profile = :profile WHERE id = :id ");
    $stmt->bindParam(":profile",$req["profile"]);
    $stmt->bindParam(":id",$_SESSION["USER_ID"]);
    $result = $stmt->execute();
    if($result){
        $_SESSION["PROFILE"] = $photo;
        $_SESSION["STATUS"] = TRUE;
        $_SESSION["MSG"] = "Upload Profile Success.";
        header("location:../../index.php?page=profile");
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