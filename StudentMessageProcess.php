<?php

require "connection.php";
$msg = $_POST["mt"];
$student_email = $_POST["student_email"];
if (!empty($msg) && !empty($student_email)) {
    date_default_timezone_set("Asia/Colombo");
    $date=date("Y-m-d H:m:s");
    Database::iud("insert into messages (`from`,`to`,message,date_time,status) values ('".$student_email."','wkapraveen@gamil.com','".$msg."','".$date."','1')");
    echo "Success";
}