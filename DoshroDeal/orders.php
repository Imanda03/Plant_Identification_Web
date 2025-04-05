<?php
session_start();
include 'links/connection.php';
if(!isset($_SESSION['userID'])){
    header('location:account.php');
 };

$userID = $_SESSION['userID'];
$sql = "SELECT o.*, u.*, p.* 
        FROM orders o
        LEFT JOIN user u ON o.buyer = u.userID 
        LEFT JOIN product p ON o.product = p.productID 
        WHERE o.seller = $userID";
$result = mysqli_query($conn, $sql);
   
   if(isset($_GET['orderID'])){
    $orderID = $_GET['orderID'];
    $sql = "DELETE FROM orders WHERE `orders`.`orderID` = '$orderID'";
    mysqli_query($conn,$sql);
    header('location:orders.php');
   }

   if(isset($_POST['update'] )){
    $updateID = $_POST['orderID'];
    $status = $_POST['status'];
    $quantity = $_POST['quantity'];
    $oquantity = $_POST['oquantity'];
    $new_quantity = $quantity - $oquantity;
    $productID= $_POST['productID'];

    $sql = "UPDATE orders SET status='$status' WHERE  `orders`.`orderID` = '$updateID'; ";
    mysqli_query($conn,$sql);
     $updatesql = "UPDATE product SET quantity='$new_quantity' WHERE  `product`.`productID` = '$productID';";
     if(mysqli_query($conn,$updatesql)){;
     
    header('location:orders.php');
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
<div class="row"  >
     <?php
             if (mysqli_num_rows($result) > 0) {
               
                while($row = mysqli_fetch_assoc($result)){ ?>
                <div class="col">

               
                <div class="description-bar">

                    <div class="pet-name">Product Name:<br><?php echo $row['title']?></div>
                    <div class="about-wrapper">
                       <div class="condition"><?php echo $row['name']?></div>
                       <div class="condition"><?php echo $row['number']?></div>
                       <div class="condition"><?php echo $row['address']?></div>
                       <div class="condition">Quantity: <?php echo $row['oquantity']?></div>
                       
                       <div class="condition">Price: <?php echo $row['price']?></div>
                       <div class="condition">Total: <?php echo $row['oquantity']*$row['price']?></div>
                       <div class="condition"><?php echo $row['method']?></div>
                        <!-- <div> 0.8 kg</div> -->
                      
                    </div>
                </div>
              
                
                   <?php if($row['status'] != 'completed') { ?>
<div class="function">
    <form action="" method="post">
        <input type="hidden" name="orderID" value="<?php echo $row['orderID']?>">
        <input type="hidden" name="oquantity" value="<?php echo $row['oquantity']?>">
        <input type="hidden" name="quantity" value="<?php echo $row['quantity']?>">
        <input type="hidden" name="productID" value="<?php echo $row['productID']?>">

        Status:
        <select name="status">
            <option value="pending" <?php echo ($row['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
            <option value="completed" <?php echo ($row['status'] == 'completed') ? 'selected' : ''; ?>>Completed</option>
        </select>
        <button type="submit" class="btn btn-warning" name="update">Update</button>
        <a href="orders.php?orderID=<?php echo $row['orderID']?>" class="btn btn-danger">Delete</a>
    </form>
</div>

<!-- For completed orders -->
<?php } else { ?>
<div class="function">
    <form action="" method="post">
        <input type="hidden" name="orderID" value="<?php echo $row['orderID']?>">
        Status:
        <select name="status" disabled>
            <option value="pending" <?php echo ($row['status'] == 'pending') ? 'selected' : ''; ?>>Pending</option>
            <option value="completed" <?php echo ($row['status'] == 'completed') ? 'selected' : ''; ?>>Completed</option>
        </select>
        <button type="submit" class="btn btn-warning" name="update" disabled>Update</button>
        <a href="orders.php?orderID=<?php echo $row['orderID']?>" class="btn btn-danger">Delete</a>
    </form>
</div>
<?php } ?>
            </div>
            <?php }
            }?>

      </div>
        
</div>

</section>
<!-- footer -->
   <?php require 'links/footer.php'; ?>
<script src="usermenu.js"></script>

<?php
if($grand_total <1){
    ?>
    <script>
        $('.check').each(function(){
    $(this).data("href", $(this).attr("href")).removeAttr("href");
});
    </script>
    <?php
}else{
?>
<script>
$('.check').each(function(){
    $(this).attr("href", $(this).data("href"));
});
</script>
<?php } ?>
</body>
</html>
