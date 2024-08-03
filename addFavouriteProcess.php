<?php

session_start();
require "connection.php";

if(isset($_SESSION["u"])){

    if(isset($_GET["uid"])){

        $user_id=$_GET["uid"];
        $subject_id=$_GET["sid"];
        $teacher_id=$_GET["tid"];
        $grade_id=$_GET["gid"];
        $medium_id=$_GET["mid"];

        $favourite_rs=Database::search("select * from favourite where user_id='".$user_id."' and teacher_id='".$teacher_id."' and subject_id='".$subject_id."' and grade_id='".$grade_id."' and medium_id='".$medium_id."'");
        $favourite_num=$favourite_rs->num_rows;

        if($favourite_num==1){

            $favourite_data=$favourite_rs->fetch_assoc();
            $list_id=$favourite_data["id"];

            Database::iud("delete from favourite where id='".$list_id."'");
            echo "Removed";

        }else{

            Database::iud("insert into favourite (user_id,subject_id,grade_id,teacher_id,medium_id) values ('".$user_id."','".$subject_id."','".$grade_id."','".$teacher_id."','".$medium_id."')");
            echo "A";

        }

    }else{
        echo "Something went wrong";
    }

}else {
    echo "Please Signin or Register";
}
