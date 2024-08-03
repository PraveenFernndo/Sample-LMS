<?php

require "connection.php";

$fname=$_POST["fname"];
$lname=$_POST["lname"];
$gender=$_POST["gender"];
$grade=$_POST["grade"];
$password=$_POST["password"];
$address=$_POST["address"];
$school=$_POST["school"];
$email=$_POST["email"];
$mobile=$_POST["mobile"];

if(empty($fname)){
    echo "Please enter Your First Name";
}else if(empty($lname)){
    echo "Please enter Your Last Name";
}else if($gender=="Select"){
    echo "Please Select Your Geneder";
}else if($grade=="Select"){
    echo "Please Enter your Grade";
}else if(empty($password)){
    echo "Please enter Your Password";
}else if(strlen($password)<=8){
    echo "Password must have at least 8 characters";
}else if(empty($email)){
    echo "Please enter Your Email";
}else if(empty($mobile)){
    echo "Please enter Your Mobile";
}else if(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$mobile)){
    echo "Invalid Mobile Number";
}else if(strlen($mobile)>10 || strlen($mobile)<10){
    echo "Mobile Number Must have 10 characters";
}else if(empty($address)){
    echo "Please Enter Your Address";
}else if(empty($school)){
    echo "Please Enter Your School Name";
}else{

    $r1=Database::search("select * from user where email='".$email."' and password='".$password."' or mobile='".$mobile."' ");
    $n1=$r1->num_rows;

    //check if teacher and student both are using same login details or not.
    $t=Database::search("select * from teacher where email='".$email."' and password='".$password."' ");
    $tnum=$t->num_rows;

    if($n1>0 || $tnum>0){
        echo "Some data already exist";
    }else{

        Database::iud("insert into user (first_name,last_name,gender_id,grade_id,password,email,mobile,address,school,verification_code) values ('".$fname."','".$lname."','".$gender."','".$grade."','".$password."','".$email."','".$mobile."','".$address."','".$school."','121933')");
        echo "Success";

    }

}
