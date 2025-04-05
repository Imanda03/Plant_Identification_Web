<?php
session_start();
include 'links/connection.php';

// Debug: Log session variables in console
echo "<script>console.log(" . json_encode($_SESSION) . ");</script>";

if (isset($_SESSION['username']) && isset($_SESSION['userID'])) {
    // Updated query to use placeholders
    $sql = "SELECT 
                p.productID,
                p.title,
                p.price,
                p.description,
                p.pcondition,
                p.location,
                p.filename,
                p.categoryID,
                p.quantity,
                p.userID,
                c.categoryName
            FROM product p
            LEFT JOIN categories c ON p.categoryID = c.categoryID
            WHERE p.userID != ?
            ORDER BY p.productID DESC";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        // Bind the userID parameter
        mysqli_stmt_bind_param($stmt, "i", $_SESSION['userID']);

        // Execute the statement
        mysqli_stmt_execute($stmt);

        // Get the result set
        $result = mysqli_stmt_get_result($stmt);
    } else {
        die("Query preparation failed: " . mysqli_error($conn));
    }
} else {
    echo "Please log in to view products.";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy and Sell Online</title>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./login.css">
    <!-- <link rel="stylesheet" href="./login.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    

</head>
<body>
    
    <!-- Navigation Bar -->
   <?php require 'links/navigation.php'; ?>
  
   <!-- search bar -->
    <section class="search">
        <div class="search-bar">
          <h1 data-text="Buy Sell And Exchange!">Buy Sell And Exchange!<hr></h1><br>
          
          
          
          
          <!-- <form action="search.php" class="search-input" method="post">
                <input type="text" name="search" id="" placeholder="Search for an item
                " autofocus>
                <button type="submit"><i class="fa fa-search"></i></button>
            </form> -->
        </div>
</section>
         <!-- categories section -->
    <section class="categories">
    <h2 >Our Categories</h2>
    <div class="cat-row">
        <div class="cat-col">
            <a href="category.php?cat=Furniture">
            <img src="images/furniture.jpeg" alt="">
            </a>
            <h5>Furnitures</h5>
           
        </div>
        <div class="cat-col">
        <a href="category.php?cat=Automobile">
            <img src="images/automobile.jpeg" alt="">
            </a>
            <h5>Automobiles</h5>
        </div>
        <div class="cat-col">
        <a href="category.php?cat=Realestate">
            <img src="images/real-estate-business-compressor.jpg" alt="">
            </a>
            <h5>Real Estates</h5>
        </div>
        <div class="cat-col">
        <a href="category.php?cat=Gadget">
            <img src="images/gadgets.jpeg" alt="">
            </a>
            <h5>Gadgets</h5>
        </div>
        <div class="cat-col">
        <a href="category.php?cat=Appliances">
            <img src="images/appliances.jpg" alt="">
            </a>
            <h5>Home Appliances</h5>
        </div>
    </div>
    </section>
<!-- Lastest One Section -->
    
<section class="container">
        <h2 class="title">Items On Sale</h2>
        <div class="row">
           
        <?php
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col">

                    <div class="img-bar">
                       



                            <img src='<?php echo $row['filename']?>' alt="">
                        
                    </div>
                    <div class="description-bar">

                        <div class="pet-name">
                            <?php
                            echo $row['title'];
                            ?>

                        </div>

                        <div class="about-wrapper">



                            <div class="pet-name">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                                <?php
                                echo $row['pcondition'];
                                ?>

                            </div>
                            <div class="pet-name"><i class="fa fa-map-marker" aria-hidden="true"></i>
                                <?php
                                echo $row['location'];
                                ?>

                            </div>

                        </div>

                    </div>
                    <div class="bottom-bar">
                        <div class="breed-bar">


                            <div class="pet-name">
                                <?php
                                echo $row['categoryID'];
                                ?>

                            </div>

                        </div>
                        <div class="price-bar">Price
                            <div>
                                <?php
                                echo "Rs " . $row['price'];
                                ?></div>
                        </div>
                    </div>
                    <div class="buy-bar"><a href="product-details.php?id=<?php echo $row['salesID']?> " style="color: white;">Buy Now</a></div>
            </div>  
            <?php } ?>          
        </div>     
    </section>

    
<!-- footer -->
    <?php require 'links/footer.php'; ?>


<script src="usermenu.js"></script>
</body>
</html>