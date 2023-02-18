<?php 
ob_start();
session_start();
include('authentication.php');
    $page_title ="Data User";
    include('includes/header.php');
    include('includes/topbar.php');
    include('includes/sidebar.php');
    include('config/dbcon.php');
?>
<?php
if(isset($_POST['check_Userbtn']))
{
  $username =mysqli_real_escape_string($con, $_POST['username']);
  $checkusername = "SELECT username FROM employee_tb WHERE username='$username' ";
  
    $checkusername_run = mysqli_query($con, $checkusername);
      if(mysqli_num_rows($checkusername_run) > 0)
      {
        echo "User name already Taken.!";
      }
      else
      {
        echo "It's Available";
      }
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
function sendemail_verify($empname,$email,$username,$verify_token)
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
  $mail->Subject = "Email Verification from CRM SYSTEM | POWER SOFT";
  $email_template = " 
          <h2>Hello..!</h2>
          <h5>Please click the button below to verify your email address.</h5>
          <br/><br/>
          <a href='http://localhost/CRMSYSTEM-2023/verify-email.php?token=$verify_token'>Click me</a>
  ";
  $mail->Body    = $email_template;
  $mail->send();
  echo 'Message has been sent';
}
if(isset($_POST['addUser']))
{
    $empname =mysqli_real_escape_string($con, $_POST['empname']);
    $email =mysqli_real_escape_string($con, $_POST['email']);
    $username =mysqli_real_escape_string($con, $_POST['username']);
    $phone =mysqli_real_escape_string($con, $_POST['phone']);
    $password =mysqli_real_escape_string($con, $_POST['password']);
    $verify_token =md5(rand());

    $checkemail = "SELECT email FROM employee_tb WHERE email='$email' ";
    $checkemail_run = mysqli_query($con, $checkemail);
    if(mysqli_num_rows($checkemail_run) > 0)
    {
        $_SESSION['status'] = "Email Id Already Exists";
        header("Location: registered.php");
        exit(0);
    }
    else
    {
        $sql = "INSERT INTO employee_tb (empname,email,username,phone,password,verify_token)
        VALUES ('".$empname."','".$email."','".$username."','".$phone."','".$password."','".$verify_token."')";
        $sql_run = mysqli_query($con, $sql);
        if($sql_run)
        {
            sendemail_verify("$empname","$email","$username","$verify_token");
            $_SESSION['status'] = "Registraion Successfull...! Please verify Email Address";
            header("Location: registered.php");
            exit(0);
        }
        else
        {
            $_SESSION['status'] = "Registraion Failed";
            header("Location: registered.php");
            exit(0);
        }
    }
}
?>
      <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- User Modal -->
  <div class="modal fade" id="AddUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Register User</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times</span>
          </button>
        </div>
        <form action="registered.php" method="post">
        <div class="modal-body">
            <div class="form-group">
              <label for="">Agent Name</label>
              <input type="text" name="empname" class="form-control" placeholder="Enter Agent Name">
            </div>
            <div class="form-group">
              <label for="">Email</label>
              <input type="email" name="email" class="form-control" placeholder="Enter Email">
            </div>
            <div class="form-group">
              <label for="">Phone Number</label>
              <input type="text" name="phone" class="form-control" placeholder="Enter Phone Number">
            </div>
            <div class="form-group">
              <label for="">User Name</label>
              <span class="user_error" ></span>
              <input type="text" name="username" class="form-control user_id" placeholder="Enter User Name">
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password"  name="password" class="form-control" placeholder="Enter Password">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="">Confirm Password</label>
                        <input type="password"  name="confirmpassword" class="form-control" placeholder="Enter Confirm Password">
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="addUser" class="btn btn-primary">Save</button>
        </div>
      </form>
      </div>
    </div>
  </div>

<!-- Delet User Modal -->

  <div class="modal fade" id="DeletModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete User</h1>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times</span>
          </button>
        </div>
        <form action="registered.php" method="post">
        <div class="modal-body">
          <input type="text" name="delete_id" class="delete_user_id">
          <p>
            Are you sure. you want to delete this data ?
          </p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" name="DeleteUserbtn" class="btn btn-primary">Yes, Delete.!</button>
        </div>
      </form>
      </div>
    </div>
  </div>
   <!-- Delet User Modal -->
  








    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
            <h1 class="m-0">Registered Users</h1>
            </div><!-- /.col -->
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Registered Users</li>
            </ol>
        </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
    <!-- /.content-header -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
          <?php include('message.php'); ?>
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Registere User</h3>
                <a href="#" data-toggle="modal" data-target="#AddUserModal" class="btn btn-primary btn-sm float-right">Add User</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>User Name</th>
                    <th>Created Date</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    $sql = "SELECT * FROM employee_tb";
                    $sql_run = mysqli_query($con, $sql);
                    if(mysqli_num_rows($sql_run ) > 0)
                    {
                      foreach($sql_run as $row)
                      {
                        // echo $items['email'];
                        ?>
                        <tr>
                          <td><?= $row['emp_id'];?></td>
                          <td><?= $row['empname'];?></td>
                          <td><?= $row['email'];?></td>
                          <td><?= $row['phone'];?></td>
                          <td><?= $row['username'];?></td>
                          <td><?= $row['created_at'];?></td>
                          <td>
                            <a href=""></a>
                            <button type="button" value="<?php $row['emp_id']; ?>" class="btn btn-danger btn-sm deletebtn">Delet</button>
                          </td>
                          
                        </tr>
                        <?php
                      }
                    }
                    else
                    {
                      ?>
                        <tr>
                          <td>Not Record Found</td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
</div>
<?php include('includes/script.php'); ?>

<script>

$(doucument).ready(function () {
    $('.user_id').ready(function (e) {
      var user = $(this).val();
      console.log(user);
      
      $.ajax({
        type: "POST",
        url: "registered.php",
        data: {
          'check_Userbtn': 1,
          'user':user, 
        },
        success: function (response){
          $('.user_error').text(response);

        }
      })
    });
  });

</script>


<?php include('includes/script.php'); ?>
<?php include('includes/foater.php'); ?>