<?php
require_once(realpath(dirname(__FILE__) ."/../../db_function/connection.php"));
require_once(realpath(dirname(__FILE__) ."/../../db_function/function.php"));

try{
    $stmt = $conn->prepare("SELECT username, email, first_name, last_name, birthdate, phone_number, updated_at FROM Users WHERE id = :id");
    $stmt->bindValue(":id", $_SESSION["USER_ID"]);
    $result = $stmt->execute();
    $profile_info = $stmt->fetch(PDO::FETCH_ASSOC);
}catch(PDOException $e){
    echo "Error: " . $e->getMessage();
    die();
}













?>