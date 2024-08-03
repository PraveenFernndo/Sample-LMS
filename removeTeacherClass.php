<?php
require "connection.php";
$email=$_POST["email"];
$subject=$_POST["subject"];
$grade=$_POST["grade"];


$r=Database::search("select * from teacher_has_class where teacher_email='".$email."' and grade_id='".$grade."' and subject_id='".$subject."'");
$n=$r->num_rows;
if($n>0){
    Database::iud("delete from teacher_has_class where teacher_email='".$email."' and grade_id='".$grade."' and subject_id='".$subject."'");
    echo "Success";
}

?>