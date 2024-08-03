<?php

require "connection.php";
$msg = $_POST["mt"];
$teacher_email = $_POST["teacher_email"];
if (!empty($msg) && !empty($teacher_email)) {
    date_default_timezone_set("Asia/Colombo");
    $date=date("Y-m-d H:m:s");
    Database::iud("insert into messages (`from`,`to`,message,date_time,status) values ('".$teacher_email."','wkapraveen@gamil.com','".$msg."','".$date."','1')");
    echo "Success";
}