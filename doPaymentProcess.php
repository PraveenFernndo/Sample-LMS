<?php
require "connection.php";

$total=$_POST["total"];
$class_id=$_POST["class_id"];
$user_id=$_POST["user_id"];

$d=new DateTime('now',new DateTimeZone("Asia/Colombo"));
$date=date("Y-m-d");

Database::iud("insert into payment (`date`,student_id,class_id,price,withdraw_status) values ('".$date."','".$user_id."','".$class_id."','".$total."','0')");

$r=Database::search("select * from student_has_class where class_id='".$class_id."' and student_id='".$user_id."'");
$n=$r->num_rows;
if($n==1){
    Database::iud("update student_has_class set status='1' where student_id='".$user_id."' and class_id='".$class_id."'");
}else{
    Database::iud("insert into student_has_class (student_id,class_id,status) values ('".$user_id."','".$class_id."','1')");
}
?>