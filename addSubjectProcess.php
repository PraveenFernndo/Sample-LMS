<?php
require "connection.php";
$subject=$_POST["sub"];

if(empty($subject)){
    echo "Please Add New Subject Name";
}else{

    $r=Database::search("select * from subject where name='".$subject."'");
$n=$r->num_rows;
if($n>0){
    echo "This Subject already added";
}else{
    Database::iud("insert into subject (name) values ('".$subject."')");
    echo "New Subject Added Successfully";
}

}

?>