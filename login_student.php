<?php

header("Access-Control-Allow-Methods: GET");
header("Content-Type:application/json");
$response = [];
if ($_SERVER["REQUEST_METHOD"] == "POST" ) {

    
    $email = $_POST['email'];
    $password = $_POST['password'];


    include("connection.php");
    $connection=new Connection();
    $connection->connect();

    $res=$connection->login($email);   
    $sData=mysqli_fetch_assoc($res);

    if($sData!=null){
        $response["result"]="Success";
        
        $vp=password_verify($password,$sData["password"]);
        if($vp){
            $response["result"]="Success";
            $response["data"]=$sData;
            
        }else{
            $response["result"]="Error";
            $response["message"]="Invalid User Password";
        }
       
    }else{
        $response["result"]="Error";
        $response["message"]="Invalid User email";
    }


    
 
    
    
    

} else {
    $response["result"] = "Error Only Get Allow";
    
}


echo json_encode($response);

?>