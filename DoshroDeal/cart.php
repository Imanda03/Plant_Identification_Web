<?php
session_start();
include 'links/connection.php';
if(!isset($_SESSION['userID'])){
    header('location:account.php');
 };
 
if(isset($_SESSION['userID'])){
   $buyerID = $_SESSION['userID'];
   $grand_total = 0;
    $sql = "SELECT * FROM cart AS s LEFT JOIN user AS u ON s.sellerID= u.userID LEFT JOIN product AS p ON s.proID = p.productID WHERE buyerID='$buyerID'; ";
    $result = mysqli_query($conn, $sql);

    if(isset($_GET['delete'])){
        $deleteID= $_GET['delete'];
        $delete_sql = "DELETE FROM `cart` WHERE `cart`.`cartID` = '$deleteID';" ;
        mysqli_query($conn,$delete_sql);
        header('location:cart.php');
     }
     if(isset($_GET['delete_all'])){
        $delete_all_sql = "DELETE FROM `cart` WHERE buyerID = '$buyerID';";
        mysqli_query($conn,$delete_all_sql);
        header('location:cart.php');
     }
     if(isset($_POST['update'])){
        $cart_id = $_POST['cart_id'];
        $p_qty = $_POST['p_qty'];
        $p_qty = filter_var($p_qty, FILTER_SANITIZE_STRING);
        $update_qty = "UPDATE `cart` SET cquantity = '$p_qty' WHERE cartID = '$cart_id'";
        if(mysqli_query($conn,$update_qty)){
            header('location:cart.php');
        };
        
        
        
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
       

      <div class="cart-width">
       
         <!-- cart items details -->
    <div class="small-container cart-page">
        <table>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>

            </tr>
            <?php
             if (mysqli_num_rows($result) > 0) {
               
                while($row = mysqli_fetch_assoc($result)){ ?>
                    <tr>
                <td>
                    <div class="cart-info">
                    <img src='<?php echo $row['filename']?>' alt="">
                        <div>
                            <p><?php echo $row['title']?></p>
                            <small>Price: Rs:<?php echo $row['price']?></small><br>
                            <a href="cart.php?delete=<?php echo $row['cartID']?>" class="small">Remove</a>
                        </div>
                    </div>
                </td>
                <form action="" method="post">
                <td>
                
                    <input type="number" value="<?php echo $row['cquantity']?>" min="1" max="<?php echo $row['quantity']?>" name="p_qty" >
                    <input type="hidden" value="<?php echo $row['cartID']?>" name="cart_id">
                    <input type="submit" value="Update" name="update" >
                    

                
                
                </td>
                </form>
                <td>Rs:<?php $sub_total= $row['cquantity'] * $row['price'];
                echo $sub_total;
                ?></td>
            </tr>
            <?php
            $grand_total += $sub_total;
                };


            } else {
                ?>
                     <tr>
                    <td></td>
                    <td>
                    </td>
                    <td></td>

                </tr>
                
                <tr>
                    <td></td>
                    <td><h3>Empty</h3>
                    </td>
                    <td></td>

                </tr>
                <tr>
                    <td></td>
                    <td>
                    </td>
                    <td></td>

                </tr>
                <?php
            }
             ?>
            
           
           
        </table>

        <div class="total-price">
            <table>
                <tr>
                    <td>Total</td>
                    <td><?php echo $grand_total;?></td>

                </tr>
                <tr>
                    <td><a href="welcome.php">Continue Shopping</a></td>
                    <td></td>
                </tr>
                <tr>
                    <td><a href="cart.php?delete_all" class="del check">Delete All</a></td>
                    <td></td>
                </tr>
                <tr>
                    <td><a href="checkout.php" class="check">Proceed To Checkout</a></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>

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
