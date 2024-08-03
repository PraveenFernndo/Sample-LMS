<?php 
session_start();
if(isset($_SESSION["email"])){
    require_once ('includes/config.php');
    $sql = mysqli_query($con, "update users user_status=1 where email='$email'");
    echo "<script type='text/javascript'> document.location = 'login.php'; </script>";
}else{
    echo "<script>alert('Something went wrong');</script>";
    echo "<script type='text/javascript'> document.location = 'signup.php'; </script>";
}

?>