<?php
session_start();
require "connection.php";

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$institute = $_POST["institute"];
$address = $_POST["address"];
$description = $_POST["description"];
// $grade1 = $_POST["grade1"];
// $grade2 = $_POST["grade2"];
// $grade3 = $_POST["grade3"];
// $grade4 = $_POST["grade4"];
// $grade5 = $_POST["grade5"];
// $grade6 = $_POST["grade6"];
// $grade7 = $_POST["grade7"];
// $grade8 = $_POST["grade8"];
// $grade9 = $_POST["grade9"];
// $grade10 = $_POST["grade10"];
// $grade11 = $_POST["grade11"];
// $al = $_POST["al"];

if (empty($fname)) {
    echo "Please Enter Your First Name";
} else if (empty($lname)) {
    echo "Please Enter Your Last Name";
} else if (empty($institute)) {
    echo "Please Enter Your Institute Name";
} else if (empty($address)) {
    "Please Enter Your Address";
} else if (empty($description)) {
    echo "Please Eneter The description";
} else {

    $email = $_SESSION["t"]["email"];

    Database::iud("update teacher set first_name='" . $fname . "', last_name='" . $lname . "',institute='" . $institute . "',address='" . $address . "',description='" . $description . "'");
    $result = Database::search("select * from teacher_profile_picture where email='" . $email . "'");
    $n = $result->num_rows;

    if (!empty($_FILES["profile_image"])) {
        $profile_image = $_FILES["profile_image"];
        $path = "profile_pictures//" . uniqid() . ".png";
        move_uploaded_file($profile_image["tmp_name"], $path);

        if ($n == 1) {
            Database::iud("update teacher_profile_picture set path='" . $path . "' where email='" . $email . "'");
        } else {
            Database::iud("insert into teacher_profile_picture (email,path) values ('" . $email . "','" . $path . "') ");
        }
    }
    // if ($grade1 == "yes") {
    //     $r1 = Database::search("select * from teacher_has_class where teacher_email='" . $email . "' and grade_id='1' and subject_id='" . $subject . "' ");
    //     $n1 = $r1->num_rows;
    //     if ($n1 == 0) {
    //         Database::iud("insert into teacher_has_class (teacher_email,subject_id,grade_id) values ('" . $email . "','" . $subject . "','1')");
    //     }
    // }
    // if ($grade2 == "yes") {
    //     $r2 = Database::search("select * from teacher_has_class where teacher_email='" . $email . "' and grade_id='2' and subject_id='" . $subject . "' ");
    //     $n2 = $r2->num_rows;
    //     if ($n2 == 0) {
    //         Database::iud("insert into teacher_has_class (teacher_email,subject_id,grade_id) values ('" . $email . "','" . $subject . "','2')");
    //     }
    // }
    // if ($grade3 == "yes") {
    //     $r3 = Database::search("select * from teacher_has_class where teacher_email='" . $email . "' and grade_id='3' and subject_id='" . $subject . "' ");
    //     $n3 = $r3->num_rows;
    //     if ($n3 == 0) {
    //         Database::iud("insert into teacher_has_class (teacher_email,subject_id,grade_id) values ('" . $email . "','" . $subject . "','3')");
    //     }
    // }
    // if ($grade4 == "yes") {
    //     $r4 = Database::search("select * from teacher_has_class where teacher_email='" . $email . "' and grade_id='4' and subject_id='" . $subject . "' ");
    //     $n4 = $r4->num_rows;
    //     if ($n4 == 0) {
    //         Database::iud("insert into teacher_has_class (teacher_email,subject_id,grade_id) values ('" . $email . "','" . $subject . "','4')");
    //     }
    // }
    // if ($grade5 == "yes") {
    //     $r5 = Database::search("select * from teacher_has_class where teacher_email='" . $email . "' and grade_id='5' and subject_id='" . $subject . "' ");
    //     $n5 = $r5->num_rows;
    //     if ($n5 == 0) {
    //         Database::iud("insert into teacher_has_class (teacher_email,subject_id,grade_id) values ('" . $email . "','" . $subject . "','5')");
    //     }
    // }
    // if ($grade6 == "yes") {
    //     $r6 = Database::search("select * from teacher_has_class where teacher_email='" . $email . "' and grade_id='6' and subject_id='" . $subject . "' ");
    //     $n6 = $r6->num_rows;
    //     if ($n6 == 0) {
    //         Database::iud("insert into teacher_has_class (teacher_email,subject_id,grade_id) values ('" . $email . "','" . $subject . "','6')");
    //     }
    // }
    // if ($grade7 == "yes") {
    //     $r7 = Database::search("select * from teacher_has_class where teacher_email='" . $email . "' and grade_id='7' and subject_id='" . $subject . "' ");
    //     $n7 = $r7->num_rows;
    //     if ($n7 == 0) {
    //         Database::iud("insert into teacher_has_class (teacher_email,subject_id,grade_id) values ('" . $email . "','" . $subject . "','7')");
    //     }
    // }
    // if ($grade8 == "yes") {
    //     $r8 = Database::search("select * from teacher_has_class where teacher_email='" . $email . "' and grade_id='8' and subject_id='" . $subject . "' ");
    //     $n8 = $r8->num_rows;
    //     if ($n8 == 0) {
    //         Database::iud("insert into teacher_has_class (teacher_email,subject_id,grade_id) values ('" . $email . "','" . $subject . "','8')");
    //     }
    // }
    // if ($grade9 == "yes") {
    //     $r9 = Database::search("select * from teacher_has_class where teacher_email='" . $email . "' and grade_id='9' and subject_id='" . $subject . "' ");
    //     $n9 = $r9->num_rows;
    //     if ($n9 == 0) {
    //         Database::iud("insert into teacher_has_class (teacher_email,subject_id,grade_id) values ('" . $email . "','" . $subject . "','9')");
    //     }
    // }
    // if ($grade10 == "yes") {
    //     $r10 = Database::search("select * from teacher_has_class where teacher_email='" . $email . "' and grade_id='10' and subject_id='" . $subject . "' ");
    //     $n10 = $r10->num_rows;
    //     if ($n10 == 0) {
    //         Database::iud("insert into teacher_has_class (teacher_email,subject_id,grade_id) values ('" . $email . "','" . $subject . "','10')");
    //     }
    // }
    // if ($grade11 == "yes") {
    //     $r11 = Database::search("select * from teacher_has_class where teacher_email='" . $email . "' and grade_id='11' and subject_id='" . $subject . "' ");
    //     $n11 = $r11->num_rows;
    //     if ($n11 == 0) {
    //         Database::iud("insert into teacher_has_class (teacher_email,subject_id,grade_id) values ('" . $email . "','" . $subject . "','11')");
    //     }
    // }
    // if ($al == "yes") {
    //     $r12 = Database::search("select * from teacher_has_class where teacher_email='" . $email . "' and grade_id='12' and subject_id='" . $subject . "' ");
    //     $n12 = $r12->num_rows;
    //     if ($n12 == 0) {
    //         Database::iud("insert into teacher_has_class (teacher_email,subject_id,grade_id) values ('" . $email . "','" . $subject . "','12')");
    //     }
    // }
    echo "Success";
}
