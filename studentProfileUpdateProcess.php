<?php
session_start();
require "connection.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$school = $_POST["school"];
$address = $_POST["address"];

if (empty($fname)) {
    echo "Please Enter Your First Name";
} else if (empty($lname)) {
    echo "Please Enter your Last Name";
} else if (empty($address)) {
    echo "Pleas Enter your Address";
} else if (empty($school)) {
    echo "Please Enter your School";
} else {
    $email = $_SESSION["u"]["email"];
    Database::iud("update user set first_name='" . $fname . "', last_name='" . $lname . "',school='" . $school . "',address='" . $address . "' where email='" . $email . "'");

    if (!empty($_FILES["profileImage"])) {
        $profileImage = $_FILES["profileImage"];

        $path = "profile_pictures//" . uniqid() . ".png";
        move_uploaded_file($profileImage["tmp_name"], $path);

        $rs = Database::search("select * from student_profile_picture where email='" . $email . "'");
        $n = $rs->num_rows;
        if ($n == 0) {
            Database::iud("insert into student_profile_picture (path,email) values ('" . $path . "','" . $email . "')");
        } else if ($n == 1) {
            Database::iud("update student_profile_picture set path='" . $path . "' where email='" . $email . "' ");
        }
    }

    echo "Success";

}
