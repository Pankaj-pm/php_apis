<?php

 class Student{
    private $id=10;
    private $name;
    private $age;

    function setData($id,$name,$age){
        $this->id=$id;
        $this->age=$age;
        $this->name=$name;
    }

    function showDetail(){
        echo "id = ".$this->id." name = ". $this->name ." Age = ".$this->age;
    }
 }


?>
