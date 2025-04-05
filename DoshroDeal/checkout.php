<?php
session_start();
include 'links/connection.php';
if(!isset($_SESSION['userID'])){
    header('location:account.php');
 };
 
 if(isset($_POST['order'])){
   $buyerID = $_SESSION['userID'];
   
 

    $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = $_POST['address'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   
   $sql = "SELECT * FROM cart AS s LEFT JOIN user AS u ON s.sellerID= u.userID LEFT JOIN product AS p ON s.proID = p.productID WHERE buyerID='$buyerID'; ";
   $result = mysqli_query($conn, $sql);

   if (mysqli_num_rows($result) > 0) {
               
    while($row = mysqli_fetch_assoc($result)){ 
        $buyer = $row['buyerID'];
        $seller = $row['sellerID'];
        $product = $row['proID'];
        $oquantity = $row['cquantity'];
   $insertquery = "INSERT INTO `orders` (`orderID`, `buyer`, `seller`, `product`, `oquantity`, `name`, `number`, `address`,`method`,`status`) VALUES (NULL, '$buyer', '$seller', '$product', '$oquantity', '$name', '$number', '$address','$method','pending')";

   if(mysqli_query($conn,$insertquery)){
    $delete_query = "DELETE FROM cart WHERE `cart`.`buyerID` = '$buyerID';";
    mysqli_query($conn,$delete_query);
    echo "<script>
    alert('Your order has been placed');
    window.location.href='welcome.php';
    </script>";
   }
    }

       

     
    
   


}
 }
;

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy and Sell Online</title>
  
    <!-- <link rel="stylesheet" href="./login.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Latest compiled and minified CSS -->
<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"> -->

<!-- jQuery library -->
<!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script> -->

<!-- Popper JS -->
<!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script> -->

<!-- Latest compiled JavaScript -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script> -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

     <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./login.css">

</head>
<body>
    
    <!-- Navigation Bar -->
    <header>

<!-- <a href="welcome.php" class="logo"><img src="images/Screenshot from 2022-04-08 23-38-46.png" alt="logo " class="logo"></a> -->
 <a href="index.php" class="logo"><p class="logo_text">Buy and Sell</p></a>

<nav>
    <ul class="nav-links">
        <li><a href="welcome.php"><i class="fa fa-home fa-lg" aria-hidden="true"></i></a></li>
        <li><a href="ads.php"><i class="fa fa-plus-square-o fa-lg" aria-hidden="true"></i></a></li>
        <li><a href="cart.php"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i></a></li>

        <li id="user-menu"><i class="fa fa-user-circle-o fa-lg " aria-hidden="true" ></i> </li>
        
    </ul>
</nav>
<!-- <div class="nav-sell">
<a href="#" class="cta"> <button><i class="fa fa-plus-circle" aria-hidden="true"></i>Add Listing</button></a>
</div>

<a href="usermenu.php">
<div class="nav-profile" id="user-menu">
<img src="images/6481225432795d8cdf48f0f85800cf66.jpg" alt="">
</div>
</a> -->
</header>
  
   <!-- user profile side-bar start-->
   <?php require 'sidebar.php'?>


<!-- user profile side-bar end-->
      
<section class="listing">
<div class="container">
    <div class="heading">
    <h2 class="text-primary text-uppercase text-center">Ready To Checkout</h2>
    <p>Please fill out some information before checking out.    </p>
    </div>
    <div class="checkout-orders"> 
<form action="" method="post">
    
  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" class="form-control" name="name" required>
  </div>
  <div class="form-group">
    <label for="phone">Phone Number:</label>
    <input type="tel" class="form-control" name="number" pattern="[9][8][0-9]{8}" max="10" required>
  </div>
  <div class="form-group">
    <label for="method">Payment Method:</label>
    <select type="text" class="form-control" name="method"  required>
        <option value="cash on delivery">Cash On Delivery</option>
    </select>
  </div>
  <div class="form-group">
    <label for="address">Address:</label>
    <input type="text" class="form-control" name="address" required>
  </div>
 
  <button type="submit" class="btn btn-default" name="order">Place Order</button>
</form>
       </div>
       </div>  
     

</section>
<!-- footer -->
   <?php require 'links/footer.php'; ?>
<script src="usermenu.js"></script>


</body>
</html>
