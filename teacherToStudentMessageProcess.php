<?php

require "connection.php";
$msg = $_POST["mt"];
$student_email = $_POST["student_email"];
$teacher_email = $_POST["teacher_email"];
if (!empty($msg) && !empty($student_email) &&!empty($teacher_email)) {
    date_default_timezone_set("Asia/Colombo");
    $date=date("Y-m-d H:m:s");
    Database::iud("insert into messages (`from`,`to`,message,date_time,status) values ('".$teacher_email."','".$student_email."','".$msg."','".$date."','1')");
    echo "Success";
}