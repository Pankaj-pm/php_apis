<?php

    header ("Access-Control-Allow-Methods: POST");
    header("Content-Type:application/json");

    include("connection.php");
    
    $con=new Connection();
    $con->connect();


    $res=[];
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $name=$_POST["name"];
        $email=$_POST["email"];
        $pass=$_POST["password"];
        $num=$_POST["number"];
        $marks=$_POST["marks"];
        $iby=$_POST["insert_by"];

        $con=new Connection();
        $con->connect();
        $con->insertRec($name,$email,$pass,$num,$marks,$iby);

        $res["data"]="Successfully added";
        $usersData=[];
        $sRec=$con->getStudentDataByType($iby);
        while ($s = mysqli_fetch_assoc($sRec)) {
            array_push($usersData,$s);
        }
        // $user=$gsbd;

        $user["name"]=$name;
        $user["email"]=$email;
        $user["password"]=$pass;
        $user["number"]=$num;
        $user["marks"]=$marks;
        $user["insert_by"]=$iby;
        $res["user"]=$usersData;

    }else{
        $res["data"]="Allow only Post";
    }
   
    echo json_encode($res);

?>