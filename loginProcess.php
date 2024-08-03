<?php
session_start();
if (isset($_SESSION["u"]) || isset($_SESSION["t"]) || isset($_SESSION["a"])) {

    $_SESSION["u"] = null;
    $_SESSION["a"] = null;
    $_SESSION["t"] = null;
    session_destroy();
}

if (session_id() == "") {
    session_start();
}

require "connection.php";
$email = $_POST["email"];
$password = $_POST["password"];
$rememberMe = $_POST["rem"];

if (empty($email)) {
    echo "Please Enter your Email";
} else if (empty($password)) {
    echo "Please Enter your Password";
} else {

    $resultSet1 = Database::search("select * from user where email='" . $email . "' and password='" . $password . "'");
    $n1 = $resultSet1->num_rows;

    $resultSet2 = Database::search("select * from teacher where email='" . $email . "' and password='" . $password . "'");
    $n2 = $resultSet2->num_rows;

    $resultSet3 = Database::search("select * from teacher where email='" . $email . "'");

    $date = date("d");

    if ($n1 == 1) {
        // set payment status when student does not pay the monthly payment
        echo "User Login Successfull";
        $d = $resultSet1->fetch_assoc();
        $_SESSION["u"] = $d;
        $today = date_create(date("Y-m-d"));
$student_id=$d["id"];
        $d = Database::search("select * from student_has_class where student_id='" . $student_id . "'");
        $dn = $d->num_rows;

        if ($dn > 0) {

            for ($p = 0; $p < $dn; $p++) {
                $ds = $d->fetch_assoc();
                $class_id = $ds["id"];

                $d1 = Database::search("select * from payment where student_id='" . $student_id . "' and class_id='".$class_id."' order by date DESC ");
                $d1n = $d1->num_rows;
                if ($d1n > 0) {
                    $d1s = $d1->fetch_assoc();
                    $dt = $d1s["date"];
                    $date = date_create(date("Y-m-d", strtotime($dt)));
//check wether if date diferance is grater than or equal 35
                    if (date_add($date, date_interval_create_from_date_string("35 days")) <= $today) {

                        Database::iud("update student_has_class set status='0' where id='" . $class_id . "'");
                    }
                }
            }
        }


        if ($rememberMe == "true") {
            setcookie("email", $email, time() + 60 * 60 * 24 * 365);
            setcookie("password", $password, time() + 60 * 60 * 24 * 365);
        } else {
            setcookie("email", "", -1);
            setcookie("password", "", -1);
        }
    } else if ($n2 == 1) {
        $s = $resultSet3->fetch_assoc();
        $status = $s["status"];
        if ($status == "1") {
            echo "Teacher Login Successfull";
            $d = $resultSet2->fetch_assoc();
            $_SESSION["t"] = $d;

            if ($rememberMe == "true") {
                setcookie("email", $email, time() + 60 * 60 * 24 * 365);
                setcookie("password", $password, time() + 60 * 60 * 24 * 365);
            } else {
                setcookie("email", "", -1);
                setcookie("password", "", -1);
            }
        } else {
            echo "Waiting";
        }
    } else if ($email == "wkapraveen@gmail.com" & $password == "12345") {
        echo "Admin Login Successfull";
        $_SESSION["a"] = "wkapraveen@gmail.com";

        if ($rememberMe == "true") {
            setcookie("email", $email, time() + 60 * 60 * 24 * 365);
            setcookie("password", $password, time() + 60 * 60 * 24 * 365);
        } else {
            setcookie("email", "", -1);
            setcookie("password", "", -1);
        }
    } else {
        echo "Invalid Email or Password";
    }
}
