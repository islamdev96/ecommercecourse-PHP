<?php

include "../connect.php";

$username = filterRequest("username");
$password = sha1($_POST['password']);
$email = filterRequest("email");
// $phone = filterRequest("phone");
$verfiycode     = rand(10000 , 99999);

$stmt = $con->prepare("SELECT * FROM users WHERE users_email = ?");
$stmt->execute(array($email));
$count = $stmt->rowCount();
if ($count > 0) {
    printFailure("EMAIL");
} else {

    $data = array(
        "users_name" => $username,
        "users_password" =>  $password,
        "users_email" => $email,
        // "users_phone" => $phone,
        "users_verfiycode" => $verfiycode ,
    );
    sendEmail($email , "Verfiy Code Ecommerce" , "Verfiy Code $verfiycode") ; 
    insertData("users" , $data) ; 

}