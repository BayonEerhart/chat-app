<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);


    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                         //Enable verbose debug output
        $mail->isSMTP();                                               //Send using SMTP
        $mail->Host       = 'smtp-mail.outlook.com';                   //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                      //Enable SMTP authentication
        $mail->Username   = "bayon-nashi@hotmail.com";                 //SMTP username
        require("passwords.php");                                      //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = 587;                                       //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
        //Recipients
        $mail->setFrom('bayon-nashi@hotmail.com');
        $mail->addAddress($email_sender);                              //Add a recipient
        
        //Content
        $mail->isHTML(true);                                          //Set email format to HTML
        $mail->Subject = " $i hey $i thasdasdaere";
        $mail->Body    = "<p>lm$ asdasdi f$i osdasdad</p>$i";
        
        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
    ?>