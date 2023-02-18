<?php

// $host = "localhost";
// $username= "root";
// $password = "";
// $database= "crm";

// // Conection 
// $con = mysqli_connect("$host","$username","$password","$database");

// // Check Connection
// if (!$con)
// {
//     header("Location: admin/errors/db.php");
//     die();
//     mysqli_connect_errno($con)
// }
// else
// {
//     echo "<h1>Database Connected.!</h1>";
// }
?>





<?php
$hostname= "localhost";
$database= "crm2_db";
$username= "root";
$password = "";
$con = new mysqli($hostname,$username,$password,$database);
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}
else
echo'';
?>

