<?php

header("Access-Control-Allow-Methods: GET");
header("Content-Type:application/json");
$response = [];
if ($_SERVER["REQUEST_METHOD"] == "PUT" || $_SERVER["REQUEST_METHOD"] == "PATCH") {

    $input = file_get_contents('php://input'); // returns string

    parse_str($input, $_UPDATE);

    $id = $_UPDATE['id'];
    $name = $_UPDATE['name'];
    $email = $_UPDATE['email'];
    $password = $_UPDATE['password'];
    $number = $_UPDATE['number'];
    $mark = $_UPDATE['mark'];

    $passHash=password_hash($password,PASSWORD_DEFAULT);



    include("connection.php");
    $connection=new Connection();
    $connection->connect();

    $connection->updateRec($id,$name,$email,$passHash,$number,$mark);    
    $response["result"]="Success";
    http_response_code(201);

} else {
    $response["result"] = "Error Only Get Allow";
    
}


echo json_encode($response);

?>