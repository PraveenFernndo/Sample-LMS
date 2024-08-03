<?php

    require "connection.php";

    require "SMTP.php";
    require "PHPMailer.php";
    require "Exception.php";

    use PHPMailer\PHPMailer\PHPMailer;

    if(isset($_GET["e"])){

        $email=$_GET["e"];
    

        $resultset=Database::search("SELECT * FROM `user` WHERE `email`='".$email."'");
        $n=$resultset->num_rows;
        $resultset1=Database::search("SELECT * FROM `teacher` WHERE `email`='".$email."'");
        $n1=$resultset1->num_rows;
        if($n==1){

            $code=uniqid();//this method generate a code with 13 characters
    
            Database::iud("UPDATE user SET `verification_code`='".$code."' WHERE `email`='".$email."'");

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
            $mail->Subject = 'Tution ForgetPassword Verification Code.'; 
            $bodyContent = '<h1 style="color:blue;">Your Verification code is:'.$code.'</h1>'; 
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo 'Success';
            }

        }else if($n1==1){
            $code=uniqid();//this method generate a code with 13 characters
    
            Database::iud("UPDATE teacher SET `verification_code`='".$code."' WHERE `email`='".$email."'");

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
            $mail->Subject = 'Tution ForgetPassword Verification Code.'; 
            $bodyContent = '<h1 style="color:blue;">Your Verification code is:'.$code.'</h1>'; 
            $mail->Body    = $bodyContent;

            if (!$mail->send()) {
                echo 'Verification code sending failed';
            } else {
                echo 'Success';
            }
        }else{
            echo "Email not found";
        }

    }else{
        echo "Please Enter your email";
    }

?>