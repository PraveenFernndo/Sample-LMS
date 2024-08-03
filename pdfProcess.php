<?php
session_start();
require "connection.php";


$description=$_POST["description"];
$grade=$_POST["grade_id"];
$email=$_SESSION["t"]["email"];
$subject=$_POST["subject_id"];
$medium=$_POST["medium_id"];

if(empty($description)){
    echo "Please Enter Description";
}else if(empty($_FILES["file"])){
    echo "Please Select Lesson Note";
}else{
    $file=$_FILES["file"];
    $r=Database::search("select * from lesson_notes where description='".$description."' and medium_id='".$medium."'");
    $n=$r->num_rows;

    $path="lesson_notes//".uniqid().".pdf";
    move_uploaded_file($file["tmp_name"],$path);

    if($n==0){

        Database::iud("insert into lesson_notes (teacher_email,grade_id,subject_id,path,description,medium_id) values ('".$email."','".$grade."','".$subject."','".$path."','".$description."','".$medium."')");
        echo "Lesson Note Uploaded Successfully";
    }else{
        echo "This Lesson Note already uploaded";
    }

}

?>