<?php
session_start();
require 'links/connection.php';

// $email_search = "SELECT * FROM user WHERE email='mamata@gmail.com' ";
// $query = mysqli_query($conn,$email_search);

// //checking whether email exits in database or not
// $email_count = mysqli_num_rows($query);
// print_r($email_count);
// $email_pass = mysqli_fetch_assoc($query);
// print_r($email_pass);
// $userID =  $email_pass['userID'];
// echo $userID;

$userid = $_SESSION['userID'];
echo $userid;
$productid = mysqli_insert_id($conn);
echo $productid
//checking whether email exits in database or not
// $email_count = mysqli_num_rows($query);
// echo $_SESSION['username'];
// echo $_SESSION['userID'];
?>