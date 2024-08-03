<?php
require "connection.php";
$grade=$_POST["grade"];

if(empty($grade)){
    echo "Please Add New Grade";
}else{

    $r=Database::search("select * from grade where name='".$grade."'");
$n=$r->num_rows;
if($n>0){
    echo "This grade already added";
}else{
    Database::iud("insert into grade (name) values ('".$grade."')");
    echo "New Grade Added Successfully";
}

}

?>