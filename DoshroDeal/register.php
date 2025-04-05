<?php
session_start();
require 'links/connection.php';

// Function to show an alert message
function function_alert($message) {
    echo "<script>alert('$message');</script>";
}

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $cpassword = mysqli_real_escape_string($conn, $_POST['cpassword']);

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        function_alert("Invalid email format");
        header('location:account.php');
        exit();
    }

    // Encrypt passwords (use only for `$password`, not `$cpassword`)
    $pass = password_hash($password, PASSWORD_BCRYPT);

    // File upload validation
    $file = $_FILES['file'];
    $fileName = $_FILES['file']['name'];
    $fileTempName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];

    $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
    $allowedExt = array("jpg", "jpeg", "png", "pdf");

    if (!in_array($fileExt, $allowedExt)) {
        function_alert("Invalid file type. Only JPG, JPEG, PNG, and PDF are allowed.");
        header('location:account.php');
        exit();
    }

    if ($fileError !== 0) {
        function_alert("File upload error. Please try again.");
        header('location:account.php');
        exit();
    }

    if ($fileSize > 10000000) {
        function_alert("File size exceeds the 10MB limit.");
        header('location:account.php');
        exit();
    }

    $fileNemeNew = uniqid('', true) . "." . $fileExt;
    $fileDestination = 'uploads/' . $fileNemeNew;

    if (!move_uploaded_file($fileTempName, $fileDestination)) {
        function_alert("Failed to upload the image. Please try again.");
        header('location:account.php');
        exit();
    }

    // Check if email already exists
    $emailquery = "SELECT * FROM user WHERE email='$email'";
    $query = mysqli_query($conn, $emailquery);
    $emailcount = mysqli_num_rows($query);

    if ($emailcount > 0) {
        echo "<script>
        alert('Email already exists');
        window.location.href='account.php';
        </script>";
        exit();
    }

    // Check if passwords match
    if ($password !== $cpassword) {
        function_alert("Passwords do not match.");
        header('location:account.php');
        exit();
    }

    // Insert user data into the database
    $insertquery = "INSERT INTO user (username, email, phone, password, userimage) 
                    VALUES ('$name', '$email', '$phone', '$pass', '$fileDestination')";

    $iquery = mysqli_query($conn, $insertquery);

    if ($iquery) {
        function_alert("Registration successful!");
        header('location:index.php');
    } else {
        function_alert("Something went wrong. Please try again.");
        header('location:account.php');
    }
}
?>
