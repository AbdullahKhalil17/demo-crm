<?php
//  Code logout
session_start();
include('authentication.php');
include('config/dbcon.php');

if(isset($_POST['logout_btn']))
{
    // session_destroy();
    unset($_SESSION['auth']);
    unset($_SESSION['auth_user']);

    $_SESSION['status'] = "Logged out Successfully";
    header('Location: login.php ');
    exit(0);
}



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

function resend_email_verifry($empname, $username, $email, $verify_token)
{
    $mail = new PHPMailer(true);
    
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    
    $mail->isSMTP();                                            //Send using SMTP
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
   
    $mail->Host       = 'tls://smtp.gmail.com:587';                     //Set the SMTP server to send through
    $mail->Username   = 'k.goma959@gmail.com';                     //SMTP username
    $mail->Password   = 'ppeiirbjoguvvxit';                               //SMTP password

    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('k.goma959@gmail.com', $email);
    $mail->addAddress($email);     //Add a recipient
    
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "Resend - Email Verification from CRM SYSTEM | POWER SOFT";
    $email_template = " 
            <h2>You have Registered with CRM SYSTEM | POWER SOFT</h2>
             <h5>Verify your email address to Login with the below given link</h5>
            <br/><br/>
            <a href='http://localhost/CRM_SYSTEM2023/verify-email.php?token=$verify_token'>Click me</a>
    ";
    $mail->Body    = $email_template;
    $mail->send();
    echo 'Message has been sent';
}
?>