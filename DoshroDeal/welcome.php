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
    // echo "Please log in to view products.";
    // exit;
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy and Sell Online</title>
    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>

<!-- Popper JS -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./login.css">
    <!-- <link rel="stylesheet" href="./login.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    

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
    <!-- <header>

<a href="#" class="logo"><img src="images/Screenshot from 2022-04-08 23-38-46.png" alt="logo " class="logo"></a>

<nav>
    <ul class="nav-links">
        <li><a href="#">Home</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="">Contact Us

        </a></li>
    </ul>
</nav>
<div class="nav-sell">
<a href="ads.php" class="cta"> <button><i class="fa fa-plus-circle" aria-hidden="true"></i>Add Listing</button></a>
</div>


<div class="nav-profile" id="user-menu">
<img src="images/6481225432795d8cdf48f0f85800cf66.jpg" alt="">
</div>
</header>
   -->
   
   <?php require 'sidebar.php'?>
   <!-- search bar -->
    <section class="search">
        <div class="search-bar">
          <h1 data-text="Buy Sell And Exchange!">Buy Sell And Exchange!<hr></h1><br>
          
          
          
          
            <form action="search.php" class="search-input" method="post">
                <input type="text" name="search" id="" placeholder="Search for an item
                " autofocus>
                <button type="submit"><i class="fa fa-search"></i></button>
            </form>
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
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <div class="col">
                <div class="img-bar">
                    <img src='<?php echo $row['filename']?>' alt="">
                </div>
                <div class="description-bar">
                    <div class="pet-name"><br>
                        <?php echo $row['title']; ?>
                    </div>
                    <div class="about-wrapper">
                        <div class="pet-name">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            <?php echo $row['pcondition']; ?>
                        </div>
                        <div class="pet-name">
                            <i class="fa fa-map-marker" aria-hidden="true"></i>
                            <?php echo $row['location']; ?>
                        </div>
                    </div>
                </div>
                <div class="bottom-bar">
                    <div class="breed-bar">
                        <div class="pet-name">
                            <?php echo $row['categoryID']; ?>
                        </div>
                    </div>
                    <div class="price-bar">Price
                        <div><?php echo "Rs " . $row['price']; ?></div>
                    </div>
                </div>
                <?php
                // Updated buy button logic
                if (isset($_SESSION['userID'])) {
                    // Check if the product has a userID and if it matches the current user
                    if ($row['userID'] == $_SESSION['userID']) {
                        // This is the user's own listing
                        ?>
                        <div class="owner-badge">
                            Your Listing
                        </div>
                        <?php
                    } else {
                        // This is someone else's listing or a listing without a userID
                        ?>
                        <div class="buy-bar">
                            <a href="product-details.php?id=<?php echo $row['productID']; ?>" class="buy-button">
                                Buy Now
                            </a>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>  
        <?php } ?>          
    </div>     
</section>



<!-- footer -->
    <?php require 'links/footer.php'; ?>

<script src="usermenu.js"></script>

</body>
</html>
