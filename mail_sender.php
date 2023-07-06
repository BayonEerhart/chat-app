<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

session_start();

if (isset($_GET["email"])){
    $email_sende_to = $_GET["email"];
    $code = rand(100000, 999999);
    $_SESSION["code"] = $code;

} else {
    header("Location: register.php"); 
    die();
}

$mail = new PHPMailer(true);

$mail->SMTPDebug = SMTP::DEBUG_SERVER;                         
$mail->isSMTP();                                               
$mail->Host       = 'smtp-mail.outlook.com';                   
$mail->SMTPAuth   = true;                                      
include_once("passwords.php");                                 
$mail->Username   = $mail_adress;                 
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            
$mail->Port       = 587;                                     

$mail->setFrom($mail_adress);
$mail->addAddress($email_sende_to);          

$mail->isHTML(true);
$mail->Subject = " hey here is the mail with ur code";
$mail->Body    = "<table style='width: 500px; background-color: #191c1b;'><tr><td style='background-color: rgb(41, 63, 124); color: #e0e3e1; padding: 20px;'><h1 style='margin: 0;'>welcome</h1></td></tr><tr><td style='padding: 20px;'><h3 style='color: #e0e3e1; margin: 0;'>u got a code to verefie ur email :D</h3></td></tr><tr><td style='background-color: #e0e3e1; color: #191c1b; padding: 20px;'><h2 style='margin: 0;'>$code</h2></td></tr><tr><td style='padding: 20px;'><p style='color: #e0e3e1; margin: 0;'>u got any questions? Go to my website <strong><a href='https://www.bayon-nashi.nl' style='color: #e0e3e1; text-decoration: none;'>bayon-nashi.nl</a></strong></p></td></tr></table>";
$mail->AltBody = "no html found? well still ur code: $code";
header("Location: register.php?email=" . $_GET['email']);
$mail->send();
die();

    

?>