<?php

require "connection.php";

$email = $_POST["email"];
$number = $_POST["number"];

$r=Database::search("select * from teacher where email='".$email."'");
$rs=$r->fetch_assoc();

if ($number == 1 && $rs["status"]=="2") {
    Database::iud("update teacher set status='1' where email='" . $email . "'");
echo "Request Accepted";
}
if ($number == 0 && $rs["status"]=="1" || $rs["status"]=="0") {
    Database::iud("update teacher set status='2' where email='" . $email . "'");
echo "Request Rejected";
}
