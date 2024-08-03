<?php
echo "ok";
require "connection.php";

$e = $_POST["e"];
$np = $_POST["np"];
$rnp = $_POST["rnp"];
$vc = $_POST["vc"];

if (empty($e)) {
    echo "Missing email address";
} else if (empty($np)) {
    echo "Enter your New Password";
} else if (strlen($np) <= 5 || strlen($np) > 20) {
    echo "Password length should be between 5 to 20";
} else if ($np != $rnp) {
    echo "Your password does not match to your re-typed password";
} else if (empty($vc)) {
    echo "Please enter ypur verification code";
} else {

    $r = Database::search("select * from user where email='" . $e . "' and verification_code='" . $vc . "'");
    $r1 = Database::search("select * from teacher where email='" . $e . "' and verification_code='" . $vc . "'");
    $n = $r->num_rows;
    $n1 = $r1->num_rows;
    if ($n == 1) {
        Database::iud("update user set password='" . $np . "' where email='" . $e . "'");
        echo "Sucess";
    }else if($n1==1){
      Database::iud("update teacher set password='" . $np . "' where email='" . $e . "'");
        echo "Sucess";
    } else {
        echo "Invalid Email or verification code";

      
    }
}
