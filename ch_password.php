<?php
session_start();
$page_title = "Change Password";
include('includes/header.php');

include('config/dbcon.php');


if(isset($_POST['password_update']))
{
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $new_password = mysqli_real_escape_string($con, $_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($con, $_POST['confirm_password']);
    $token = mysqli_real_escape_string($con, $_POST['password_token']);

    if(!empty($token))
    {
        if(!empty($email) && !empty($new_password) && !empty($confirm_password))
        {
            // Checking token is Valid or not 
            $check_token = "SELECT verify_token FROM employee_tb WHERE verify_token= '$token' LIMIT 1 ";
            $check_token_run = mysqli_query($con, $check_token);

            if(mysqli_num_rows($check_token_run) > 0)
            {
                if($new_password == $confirm_password)
                {
                    $update_password = "UPDATE employee_tb SET password='$new_password' WHERE verify_token= '$token' LIMIT 1";
                    $update_password_run = mysqli_query($con, $update_password );
                    
                    if($update_password_run)
                    {
                        $new_token = md5(rand());
                        $update_to_new_token = "UPDATE employee_tb SET verify_token='$new_token' WHERE verify_token= '$token' LIMIT 1";
                        $update_to_new_token_run = mysqli_query($con, $update_to_new_token);
                        $_SESSION['status'] = "New Password Successfly.!";
                        header("Location: index.php");
                        exit(0);
                    }
                    else
                    {
                        $_SESSION['status'] = "Did not update password something went wrong.!";
                        header("Location: ch_password.php?token=$token&email=$email");
                        exit(0);
                    }
                }
                else
                {
                    $_SESSION['status'] = "Password and Confirm Passwrd does not match";
                    header("Location: ch_password.php?token=$token&email=$email");
                    exit(0);
                }
            }
            else
            {
                $_SESSION['status'] = "Invalid Token";
                header("Location: ch_password.php?token=$token&email=$email");
                exit(0);
            }
        }
        else
        {
            $_SESSION['status'] = "All Filed are Mandetory";
            header("Location: ch_password.php?token=$token&email=$email");
            exit(0);
        }
    }
    else
    {
        $_SESSION['status'] = "No Token Available";
        header("Location: ch_password.php");
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
                        <h5>Change Password</h5>
                    </div>
                    <div class="card-body">
                        <form action="ch_password.php" method="post">
                            
                            <input type="hidden" name="password_token" value="<?php if(isset($_GET['token'])){echo $_GET['token'];} ?>">

                            <div class="form-group mb-3">
                                <label>Email Address</label>
                                <input type="text" name="email" value="<?php if(isset($_GET['email'])){echo $_GET['email'];} ?>" class="form-control" placeholder="Enter Email Address" readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label>New Password</label>
                                <input type="password" name="new_password" class="form-control" placeholder="Enter New Password">
                            </div>
                            <div class="form-group mb-3">
                                <label>Confirm Password</label>
                                <input type="password" name="confirm_password" class="form-control" placeholder="Enter Confirm Password">
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" name="password_update" class="btn btn-success w-100">Update Password</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('includes/foater.php'); ?>