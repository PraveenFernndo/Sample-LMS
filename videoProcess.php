<?php
session_start();
require "connection.php";

$url=$_POST["url"];
$description=$_POST["description"];
$grade=$_POST["grade_id"];
$email=$_SESSION["t"]["email"];
$subject=$_POST["subject_id"];
$medium=$_POST["medium_id"];

if(empty($description)){
    echo "Please Enter Description";
}else if(empty($url)){
    echo "Please Enter URL";
}else{

    $r=Database::search("select * from lesson_videos where url='".$url."'");
    $n=$r->num_rows;

    if($n==0){

        Database::iud("insert into lesson_videos (teacher_email,grade_id,subject_id,url,description,medium_id) values ('".$email."','".$grade."','".$subject."','".$url."','".$description."','".$medium."')");
        echo "Video Uploaded Successfully";
    }else{
        echo "This Video already uploaded";
    }

}

?>