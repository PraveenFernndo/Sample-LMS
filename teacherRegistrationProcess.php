<?php

require "connection.php";

$fname=$_POST["fname"];
$lname=$_POST["lname"];
$gender=$_POST["gender"];
$password=$_POST["password"];
$address=$_POST["address"];
$institute=$_POST["institute"];
$email=$_POST["email"];
$mobile=$_POST["mobile"];
$description=$_POST["description"];
$classDetails=$_POST["classDetails"];

$degree=$_POST["degree"];
if(!empty($_FILES["qualification"])){
    $qualification=$_FILES["qualification"];
}else{
    $qualification="";
}

if(empty($fname)){
    echo "Please enter Your First Name";
}else if(empty($lname)){
    echo "Please enter Your Last Name";
}else if($gender=="Select"){
    echo "Please Select Your Geneder";
}else if(empty($email)){
    echo "Please enter Your Email";
}else if(empty($password)){
    echo "Please enter Your Password";
}else if(strlen($password)<=8){
    echo "Password must have at least 8 characters";
}else if(empty($mobile)){
    echo "Please enter Your Mobile";
}else if(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$mobile)){
    echo "Invalid Mobile Number";
}else if(strlen($mobile)!=10){
    echo "Mobile Number Must have 10 characters";
}else if(empty($degree)){
    echo "Please Enter Your Degree";
}else if(empty($institute)){
    echo "Please Enter Your Institute Name";
}else if(empty($address)){
    echo "Please Enter Your Address";
}else if(empty($description)){
    echo "Please Enter Your Description";
}else if(empty($classDetails)){
    echo "Please Enter Your Class Details";
}else if(empty($qualification)){
    echo "Please Enter Your Qualification";
}else{
    $r1=Database::search("select * from teacher where email='".$email."' or mobile='".$mobile."' ");
    $n1=$r1->num_rows;

    if($n1>0){
        echo "Some of the data already exist";
    }else{
        $path="teacher_qualification//".uniqid().".png";
        move_uploaded_file($qualification["tmp_name"],$path);

        Database::iud("insert into teacher (first_name,last_name,degree,gender_id,password,email,mobile,address,institute,description,status,class_details,verification_code) values ('".$fname."','".$lname."','".$degree."','".$gender."','".$password."','".$email."','".$mobile."','".$address."','".$institute."','".$description."','0','".$classDetails."','001203')");
        Database::iud("insert into teacher_qualification (path,email) values ('".$path."','".$email."')");
        echo "Success";

    }

}
