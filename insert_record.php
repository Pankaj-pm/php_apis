<?php

header("Access-Control-Allow-Methods: POST");
header("Content-Type:application/json");

include ("connection.php");

$con = new Connection();
$con->connect();


$res = [];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $pass = $_POST["password"];
    $num = $_POST["number"];
    $marks = $_POST["marks"];
    $iby = $_POST["insert_by"];

    $myFileName = $_FILES["image"]["name"];
    $myFilePath = $_FILES["image"]["tmp_name"];

    $res["result"] = $myFilePath;

    $imgToPath = "images/" . $myFileName;

    $errorMessage = "";

    if (move_uploaded_file($myFilePath, $imgToPath)) {
        $errorMessage = $errorMessage . " upload complete,";
    } else {
        $errorMessage = $errorMessage . " move_uploaded_file failed,";
    }

    if ($name == null) {
        $errorMessage = $errorMessage . " name,";
    }
    if ($email == null) {
        $errorMessage = $errorMessage . " email,";
    }
    if ($pass == null) {
        $errorMessage = $errorMessage . " password,";
    }
    if ($num == null) {
        $errorMessage = $errorMessage . " number,";
    }
    if ($marks == null) {
        $errorMessage = $errorMessage . " marks,";
    }

    if ($name != null && $email != null && $pass != null && $num != null && $marks != null ) {
        $con = new Connection();
        $con->connect();
        $con->insertRec($name, $email, $pass, $num, $marks, $myFileName, $iby);

        $res["data"] = "Successfully added";
        $usersData = [];
        $sRec = $con->getStudentDataByType($iby);
        while ($s = mysqli_fetch_assoc($sRec)) {
            array_push($usersData, $s);
        }
        // $user=$gsbd;
        $res["result"] = true;

        $user["name"] = $name;
        $user["email"] = $email;
        $user["password"] = $pass;
        $user["number"] = $num;
        $user["marks"] = $marks;
        $user["insert_by"] = $iby;
        $res["user"] = $usersData;
    } else {
        $res["result"] = false;
        $res["message"] = $errorMessage . " parameter is missing";
    }





} else {
    $res["data"] = "Allow only Post";
}

echo json_encode($res);

?>