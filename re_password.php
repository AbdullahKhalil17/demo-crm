<?php
session_start();
$page_title = "Reset Password";
include('includes/header.php');
include('config/dbcon.php');


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

function send_password_reset($get_agentname, $get_email, $token)
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
    $mail->setFrom('k.goma959@gmail.com', $get_agentname);
    $mail->addAddress($get_email);     //Add a recipient
    
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = "Change Password from CRM SYSTEM | POWER SOFT";
    $email_template = " 
            <h2>Change Password with CRM SYSTEM | POWER SOFT</h2>
            <h5>Please click the button below to Change Password</h5>
            <br/><br/>
            <a href='http://localhost/CRMSYSTEM-2023/ch_password.php?token=$token&email=$get_email'> Click me</a>
    ";
    $mail->Body    = $email_template;
    $mail->send();
    echo 'Message has been sent';   
}

if(isset($_POST['re_password_btn']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $token = md5(rand());

    $check_email = "SELECT email FROM employee_tb WHERE email = '$email' LIMIT 1 ";
    $check_email_run = mysqli_query($con, $check_email);

    if(mysqli_num_rows($check_email_run) > 0)
    {
        $row = mysqli_fetch_array($check_email_run);
        $get_agentname = $row['agentname'];
        $get_email = $row['email'];

        $update_token = "UPDATE employee_tb SET verify_token='$token' WHERE email='$get_email' LIMIT 1";
        $update_token_run = mysqli_query($con, $update_token);

        if($update_token_run)
        {
            send_password_reset($get_agentname, $get_email, $token);
            $_SESSION['status'] = "Email and Password Reset Link";
            header("Location: index.php");
            exit(0);
        }
        else
        {
            $_SESSION['status'] = "Something went wrong . #1";
            header("Location: re_password.php");
            exit(0);
        }
    }
    else
    {
        $_SESSION['status'] = "No Email found";
        header("Location: re_password.php");
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
                        <h5>Reset Password</h5>
                    </div>
                    <div class="card-body">
                        <form action="re_password.php" method="post">
                            <div class="form-group mb-3">
                                <label>Email Address</label>
                                <input type="text" name="email" class="form-control" placeholder="Enter Email Address">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="re_password_btn" class="btn btn-primary">Send Password Reset Link</button>
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