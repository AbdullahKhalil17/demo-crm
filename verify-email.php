<?php
session_start();
include('config/dbcon.php');
if(isset($_GET['token']))
{
    $token = $_GET['token'];
    $verify_query = "SELECT verify_token, verify_status FROM employee_tb WHERE verify_token = '$token' LIMIT 1 ";
    $verify_query_run = mysqli_query($con, $verify_query);
    if(mysqli_num_rows($verify_query_run) > 0)
    {
        $row = mysqli_fetch_array($verify_query_run);
        // echo $row['verify_token'];
        if($row['verify_status'] == "0")
        {
            $clicked_token = $row['verify_token'];
            $update_query = "UPDATE employee_tb SET verify_status = '1' WHERE  verify_token ='$clicked_token' LIMIT 1";
            $update_query_run = mysqli_query($con, $update_query);
            if($update_query_run)
            {
                $_SESSION['status'] = "Your Account has been verifid Successfully..!";
                header("Location: index.php");
                exit(0);
            }
            else
            {
                $_SESSION['status'] = "Verifaction Failed..!";
                header("Location: index.php");
                exit(0);
            }
        }
        else
        {
            $_SESSION['status'] = "Email Already Verified Please Logain";
            header("Location: index.php");
            exit(0);
        }
    }
    else
    {
        $_SESSION['status'] = "This Token dose not Exists";
        header("Location: index.php");
        exit(0);
    }
}
else
{
    $_SESSION['status'] = "Not Allowed";
    header("Location: index.php");
    exit(0);
}
?>

