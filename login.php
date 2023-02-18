<?php 
session_start();
$page_title ="Login";
include('includes/header.php');
    
if(isset($_SESSION['auth']))
{
    $_SESSION['status'] = "You are already logged In";
    header('Location: index.php');
    exit(0);
}
?>
<div class="section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 my-5">
                    <?php
                        if(isset($_SESSION['auth_status']))
                        {
                        ?>
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Hey.!</strong><?php echo $_SESSION['auth_status'];?>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <?php
                        unset($_SESSION['auth_status']);
                        }
                    ?>
                    <?php
                        include('message.php');
                    ?>
                <div class="card my-5">
                    <div class="card-header bg-light">
                        <h5>Login Form</h5>
                    </div>
                    <div class="card-body">
                        <form action="logincode.php" method="post">
                            <div class="form-group">
                                <label for="">Username</label>
                                <input type="text" name="email" class="form-control" placeholder="Enter Username">
                            </div>
                            <div class="form-group">
                                <label for="">Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Enter Password">
                            </div>
                            <hr>
                            <!-- <div class="form-group">
                                <button type="submit" name="loginbtn" class="btn btn-primary btn-block">Login Now</button>
                            </div> -->
                            <div class="form-group">
                                <button type="submit" name="loginbtn" class="btn btn-primary">Login Now</button>
                                <a href="re_password.php" class="float-end">Forget Your Password...?</a>
                            </div>
                        </form>
                        <h5>
                            Did not Recieve your Verification Email?
                            <a href="resend-email-Verification.php">Resend</a>
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- <?php echo $_SERVER['PHP_SELF']?> -->

<?php include('includes/script.php'); ?>
<?php include('includes/foater.php'); ?>