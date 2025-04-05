<?php
session_start();
include 'links/connection.php';
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "SELECT * FROM sales AS s LEFT JOIN user AS u ON s.userID= u.userID LEFT JOIN product AS p ON s.productID = p.productID WHERE salesID='$id'; ";
    $result = mysqli_query($conn, $sql);

      $row = mysqli_fetch_assoc($result);
    
   


};

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="product-details.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
</head>
<body>
         
   <?php include 'links/navigation.php'?>
    <!-- Product Details -->
    <section class="product">
    
        <div class="row-1">
        <div class="col-1">
            <img src="<?php echo $row['filename'];?>" alt="">
            <div class="details">
                <h2> <?php
                            echo $row['title'];
                            ?></h2>
                <br>
                <h3>Price: Rs<span id="price"> <?php
                                echo  $row['price'];
                                ?></span></h3><br><hr>
                <h4>Details:</h4>
                <p> <span id="description"><?php
                                echo  $row['description'];
                                ?> </span></p>
               
               <p> <i class="fa fa-clock-o" aria-hidden="true"></i>Condition: <span id="condition"><?php
                                echo  $row['pcondition'];
                                ?></span></p>
               <p><i class="fa fa-caret-square-o-right" aria-hidden="true"></i>Category: <span id="#category"><?php
                                echo   $row['categoryID'];
   ?></span></p>
   <p><i class="fa fa-map-marker" aria-hidden="true"></i>Location: <span id="#category"><?php
                                echo   $row['location'];
   ?></span></p>
     <?php
              if($row['quantity'] > 0){?>
     <p><i class="fa fa-caret-right" aria-hidden="true"></i>Available: <span id="#category"><?php
                                echo   $row['quantity'];
   ?></span></p>
              <br>
              <br>

              
              
             
                <form action="add-cart.php" method="post">
                Quanity:
                <input type="number" style="width:100px;"  max="<?php echo $row['quantity'];?>" min="1" value="1" required name="quantity">
                <input type="hidden" value="<?php echo $row['productID'];?> " name="productID">
                <input type="hidden" value="<?php echo $row['userID'];?>" name="sellerID">
                <input type="hidden" value="<?php echo $_SESSION['userID'];?>" name="buyerID" >
                <br><br>
                <button type="submit" value="cart" name="cart">Add to cart</button>
              </form>
            
              <?php
              }else{
                ?>
                <p ><i class="fa fa-caret-right" aria-hidden="true"></i>Available: <span id="#category" style="color:#555;">Out of Stocks</span></p>
                <?php
              };
               ?>

             
            </div>


        </div>
        <div class="col-2">
            <div class="seller-info">
           
                <h2>Seller's info</h2>
                
                <hr>
                <img src="<?php echo $row['userimage'];?>" alt="">
                <h4><?php echo $row['username'];?></h4>
               <p> <i class="fa fa-user" aria-hidden="true"> Private Person</i></p>
                <br>
               
                

            </div>
        

        </div>
    </div>

    </section>





<!-- footer -->
<section class="footer">
<div style="background-color: black;">
    <div class="footer-bar">
        Join Our Pay Less Get More Culture
    </div>
    <p style="text-align: center; font-size: large; font: bolder; color: white; ">“Choose best Make it Last”</p>
    <a href="mailto: abc@example.com" class="d-flex justify-center" style="color: white;">thehaatbazar@gmail.com </a>


    <div class="footer-item">
        <div class="d-flex justify-center  align-center ">

            <a href="facebook.com" style="color: white; padding-right: 10px; ">Facebook</a>

            <a href="facebook.com" style="color: white; padding-right: 10px; ">Instragram</a>
            <a href="facebook.com" style="color: white; padding-right: 10px; ">Linkkedin</a>
            <a href="facebook.com" style="color: white; padding-right: 10px; ">Twitter</a>
        </div>

        <div class="d-flex justify-center  mg-t-10">


            <a href="contact.com" style="padding-right: 15px; color: white;" class="font-black">Contact </a>



            <a href="blog.com" style="padding-right: 15px; color: white;" class="font-black">Blog</a>

            <a href="medication.com" style="padding-right: 15px; color: white;" class="font-black">Terms and Condition</a>

            <a href="delivery.com" style="padding-right: 15px; color: white;" class="font-black">Delivery</a>
            <a href="delivery.com" style="padding-right: 15px; color: white;" class="font-black">Privacy Policy</a>
            <a href="delivery.com" style="padding-right: 15px; color: white;" class="font-black">Help & Support</a>
        </div>


    </div>
</div>
</section>
</body>
</html>