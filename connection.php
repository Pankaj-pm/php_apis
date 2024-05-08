<?php

 class Connection{
    public $host="localhost";
    public $pass="";
    public $username="root";
    public $dbname="user_db";
    public $conn;

    function connect(){
        $c=mysqli_connect($this->host,$this->username,$this->pass,$this->dbname);

        if($c){
            echo "Connected";
            $this->conn=$c;
        }else{
            echo "Error";
        }
    }

    function insertRec($fullname,$email,$password,$number,$mark){
        $this->connect();
    
        $q= "INSERT INTO `student`(`fulll_name`, `email`, `password`, `number`, `marks`) VALUES ('$fullname','$email','$password','$number','$mark')";
        echo $q."</br>";
        $res=mysqli_query($this->conn,$q);
        echo $res;
    }

    function getData(){
        $this->connect();

        $q= "SELECT * From student";
    
        $res=mysqli_query($this->conn,$q);
        return $res;
    }

 }

?>