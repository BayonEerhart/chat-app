<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
//Load Composer's autoloader
require 'vendor/autoload.php';
$email_sende_to = "sanderdenhollander12@gmail.com";
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                         //Enable verbose debug output
    $mail->isSMTP();                                               //Send using SMTP
    $mail->Host       = 'smtp-mail.outlook.com';                   //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                      //Enable SMTP authentication
    $mail->Username   = "bayon-nashi@hotmail.com";                 //SMTP username
    include_once("passwords.php");                                 //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
    $mail->Port       = 587;                                       //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
    //Recipients
    $mail->setFrom('bayon-nashi@hotmail.com');
    $mail->addAddress($email_sende_to);                              //Add a recipient
    
    //Content
    $mail->isHTML(true);                                          //Set email format to HTML
    $mail->Subject = " hey bayon";
    $code = "12341234";
    $mail->Body    = "<table style='width: 500px; background-color: #191c1b;'><tr><td style='background-color: rgb(41, 63, 124); color: #e0e3e1; padding: 20px;'><h1 style='margin: 0;'>welcome</h1></td></tr><tr><td style='padding: 20px;'><h3 style='color: #e0e3e1; margin: 0;'>u got a code to verefie ur email :D</h3></td></tr><tr><td style='background-color: #e0e3e1; color: #191c1b; padding: 20px;'><h2 style='margin: 0;'>$code</h2></td></tr><tr><td style='padding: 20px;'><p style='color: #e0e3e1; margin: 0;'>u got any questions? Go to my website <strong><a href='https://www.bayon-nashi.nl' style='color: #e0e3e1; text-decoration: none;'>bayon-nashi.nl</a></strong></p></td></tr></table>


    ";
    $mail->AltBody = "No html :(";
    
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>