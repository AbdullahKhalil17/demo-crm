<?php
session_start();
include('config/dbcon.php');
if(isset($_POST['loginbtn']))
{
    $email = $_POST['email'];

    $password = $_POST['password'];

    $log_query = "SELECT * FROM employee_tb WHERE email='$email' AND password='$password' LIMIT 1 ";
    $log_query_run = mysqli_query($con, $log_query);
    
    if(mysqli_num_rows($log_query_run) > 0)
    {
        foreach($log_query_run as $row){
            $user_id = $row['id'];
            $user_empname = $row['empname'];
            $user_email = $row['email'];
            $user_phonenumber= $row['phonenumber'];
            $user_username = $row['username'];
        }
        $_SESSION['auth'] = true;
        $_SESSION['auth_user'] = [
            'empname' => $row['empname'],
            'email' => $row['email'],
            'username' => $row['username'],
            'phone' => $row['phone'],
        ];
        $_SESSION['status'] = "Logged In Successfully";
        header('Location: index.php');
    }
    else
    {
        $_SESSION['status'] = "Invalid Email or Password";
        header('Location: login.php');
    }
}
else
{
    $_SESSION['status'] = "Acces Denied";
    header('Location: login.php');
}
?>



