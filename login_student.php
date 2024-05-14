<?php

header("Access-Control-Allow-Methods: GET");
header("Content-Type:application/json");
$response = [];
if ($_SERVER["REQUEST_METHOD"] == "POST" ) {

    
    $email = $_POST['email'];
    $password = $_POST['password'];

    

    $passHash=password_hash($password,PASSWORD_DEFAULT);



    include("connection.php");
    $connection=new Connection();
    $connection->connect();

    $res=$connection->login($email,$passHash);   
    $sData=mysqli_fetch_assoc($res);
    if($sData!=null){
        $response["result"]="Success";
        $response["data"]=$sData;
    }else{
        $response["result"]="Error";
        $response["message"]="Invalid User email or password";
    }


    
 
    
    
    

} else {
    $response["result"] = "Error Only Get Allow";
    
}


echo json_encode($response);

?>