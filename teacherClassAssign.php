<?php
require "connection.php";
$grade=$_POST["tGrade"];
$subject=$_POST["tSubject"];
$email=$_POST["email"];
$fees=$_POST["fees"];
$duration=$_POST["duration"];
$medium=$_POST["medium"];

if(!empty($email)&& $grade!="Select"&& $subject!="Select"){
    $r=Database::search("select * from teacher_has_class where teacher_email='".$email."' and subject_id='".$subject."' and grade_id='".$grade."' and medium_id='".$medium."' ");
    $n=$r->num_rows;

    if($n>0){
        echo "This teacher has already assigned to this class";
    }else{
        Database::iud("insert into teacher_has_class (teacher_email,subject_id,grade_id,fee,duration,medium_id) values ('".$email."','".$subject."','".$grade."','".$fees."','".$duration."','".$medium."')");
        echo "Teacher added to new class successfully";
    }
}else{
    echo "Please fill details";
}

?>