<?php

use PHPMailer\PHPMailer\PHPMailer;

session_start();
if (isset($_SESSION["email"])) {
    require "connection.php";

    require "SMTP.php";
    require "PHPMailer.php";
    require "Exception.php";

    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'wkapraveen@gmail.com';
    $mail->Password = 'suzr jsvw kdmd ryjo';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('email', 'Tution');
    $mail->addReplyTo('email', 'Tution');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Moodle Email Verification';
    $bodyContent = '<a href="https://skillstest.exemplarpa.com.au/apply/confirmEmailSetup.php?i=1">Click this link to confirm your email</a>';
    $mail->Body = $bodyContent;

    if (!$mail->send()) {
        echo 'Verification code sending failed';
    } else {
        echo "<script>alert('Success');</script>";
    }


} else {
    echo "<script>Something went wrong</script>";
    echo "<script type='text/javascript'> document.location = 'signup.php'; </script>";
}



?>