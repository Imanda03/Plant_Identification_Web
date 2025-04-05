<?php
require 'links/connection.php';
session_start();

if(!isset($_SESSION['userID'])) {
    // If the user is not logged in, show an alert and redirect them to login page.
    echo "<script>
        alert('Please login to add items to cart');
        window.location.href = 'account.php'; // Redirect to your login page
    </script>";
    exit(); // Stop further execution of the script
}

if(isset($_POST['cart'])) {
    $productID = (int)$_POST['productID'];
    $buyerID = (int)$_SESSION['userID'];  // Get from session instead of POST
    $sellerID = (int)$_POST['sellerID'];
    $quantity = (int)$_POST['quantity'];

    if(!$productID || !$buyerID || !$sellerID || !$quantity) {
        die("Invalid input data");
    }

    $stmt = $conn->prepare("SELECT * FROM cart WHERE proID = ? AND buyerID = ?");
    $stmt->bind_param("ii", $productID, $buyerID);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0) {
        echo "<script>
            alert('Already added to cart');
            window.location.href='cart.php';
        </script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO cart (buyerID, proID, cquantity, sellerID) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("iiii", $buyerID, $productID, $quantity, $sellerID);
        
        if($stmt->execute()) {
            header('location:cart.php');
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
?>
