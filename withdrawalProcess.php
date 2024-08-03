<?php

require "connection.php";

$class_id = $_POST["class_id"];
$total_amount = 0;
$r = Database::search("select * from payment where class_id='" . $class_id . "' and withdraw_status='0' ");
$nr = $r->num_rows;
if ($nr > 0) {
    for ($x = 0; $x < $nr; $x++) {
        $rs = $r->fetch_assoc();
        $total_amount = $total_amount + floatval($rs["price"]);
    }
}
// $total_amount=floatval($_POST["total_amount"]);
$service_charge = $total_amount * 0.1;
$withdrawal_amount = $total_amount - $service_charge;

$date = new DateTime('now', new DateTimeZone("Asia/Colombo"));
$date = $date->format("Y-m-d H:m:s");
Database::iud("update payment set withdraw_status='1' where class_id='" . $class_id . "'");
Database::iud("insert into teacher_withdraw (amount,class_id,date_time,service_charges) values ('" . $withdrawal_amount . "','" . $class_id . "','" . $date . "','" . $service_charge . "')");
echo "Success";
