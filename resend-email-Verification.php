<?php
session_start();
$page_title = "Login Form";
include('includes/header.php');
// include('includes/topbar.php');
// include('includes/sidebar.php');
include('config/dbcon.php');


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
            <a href='http://localhost/CRMSYSTEM-2023/verify-email.php?token=$verify_token'>Click me</a>
    ";
    $mail->Body    = $email_template;
    $mail->send();
    echo 'Message has been sent';
}


/* Start code resend email */
if(isset($_POST['resend-email-Verification_btn']))
{
    if(!empty(trim($_POST['email'])))
    {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $checkemail_query = "SELECT * FROM employee_tb WHERE email='$email' LIMIT 1";
        $checkemail_query_run = mysqli_query($con, $checkemail_query);
        
        if(mysqli_num_rows($checkemail_query_run) > 0)
        {
            $row = mysqli_fetch_array($checkemail_query_run);
            if($row['verify_status'] == "0")
            {
                $empname = $row['empname'];
                $username = $row['username'];
                $email = $row['email'];
                $verify_token = $row['verify_token'];
                resend_email_verifry($empname, $username, $email, $verify_token);
                $_SESSION['status'] = "Verification Email Link has been sent to your email address.!";
                header("Location: login.php");
                exit(0);
            }
            else
            {
                $_SESSION['status'] = "Email already verified Please Login";
                header("Location: resend-email-Verification.php");
                exit(0);
            }
        }
        else
        {
            $_SESSION['status'] = "Email is not registered.... Please  Register Now..!";
            header("Location: registered.php");
            exit(0);
        }

    }
    else
    {
        $_SESSION['status'] = "Please Enter the email failed";
        header("Location: resend-email-Verification.php");
        exit(0);
    }
}
?>


<div class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <?php include('message.php') ?>
                <div class="card">
                    <div class="card-header">
                        <h5>Resend Email Verification</h5>
                    </div>
                    <div class="card-body">
                        <form action="resend-email-Verification.php" method="post">
                            <div class="form-group mb-3">
                                <label>Email Address</label>
                                <input type="text" name="email" class="form-control" placeholder="Enter Email Address">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="resend-email-Verification_btn" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/script.php'); ?>
<?php include('includes/foater.php'); ?>