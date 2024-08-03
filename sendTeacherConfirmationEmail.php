<?php
$email = $_POST["email"];
require "connection.php";

require "SMTP.php";
require "PHPMailer.php";
require "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$resultset1 = Database::search("SELECT * FROM `teacher` WHERE `email`='" . $email . "'");
$n1 = $resultset1->num_rows;
$rs1 = $resultset1->fetch_assoc();

if ($n1 == 1) {
    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'wkapraveen@gmail.com';
    $mail->Password = 'aamrtautcbdnrtnl';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('email', 'Tution');
    $mail->addReplyTo('email', 'Tution');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = 'Registration Confirmation';

    $bodyContent = '<h1 style="color:blue;">Your Request to join as a teacher for Future Heros Tution has been approved</h1>';
   
    $mail->Body    = $bodyContent;

    if (!$mail->send()) {
        echo 'Verification email sending failed';
    } else {
        echo 'Success';
    }
}
