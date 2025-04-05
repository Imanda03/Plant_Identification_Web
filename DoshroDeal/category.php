<?php
session_start();
include 'links/connection.php';

if(isset($_GET['cat'])) {
    $cat = mysqli_real_escape_string($conn, $_GET['cat']);
    $userID = $_SESSION['userID']; // Assuming the user ID is stored in the session

    // Prepare the SQL query with placeholders
    $sql = "SELECT p.*, s.salesID 
            FROM product p 
            LEFT JOIN sales s ON p.productID = s.productID
            WHERE p.categoryID = (
                CASE 
                    WHEN ? = 'Furniture' THEN 1
                    WHEN ? = 'Automobile' THEN 2
                    WHEN ? = 'Realestate' THEN 3
                    WHEN ? = 'Gadget' THEN 4
                    WHEN ? = 'Appliances' THEN 5
                END
            )
            AND p.userID != ?";

    // Prepare the statement
    $stmt = mysqli_prepare($conn, $sql);

    // Bind parameters to the statement
    // 5 instances of 's' for the 'cat' value and 1 instance of 'i' for the 'userID'
    mysqli_stmt_bind_param($stmt, 'sssssi', $cat, $cat, $cat, $cat, $cat, $userID);

    // Execute the statement
    mysqli_stmt_execute($stmt);

    // Get the result
    $result = mysqli_stmt_get_result($stmt);

    if (!$result || mysqli_num_rows($result) == 0) {
        echo "<script>alert('No records found');</script>";
    }
}
?>
<html>
    <head>
    <link rel="stylesheet" href="./style.css">
    <link rel="stylesheet" href="./login.css">
    <!-- <link rel="stylesheet" href="./login.css"> -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
        
   
<?php include 'links/navigation.php';?>
<!-- Lastest One Section -->
    
<section class="container">
        <h2 class="title">Items on <?php echo $cat;?></h2>
        <div class="row">
           
        <?php
            while ($row = mysqli_fetch_assoc($result)) { ?>
                <div class="col">

                    <div class="img-bar">
                        <a href="product-details.html">



                            <img src='<?php echo $row['filename']?>' alt="">
                        </a>
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
                   <div class="buy-bar">
                        <a href="product-details.php?id=<?php echo $row['salesID'] ? $row['salesID'] : $row['productID']; ?>" style="color: white;">Buy Now</a>
                    </div>
            </div>  
            <?php } ?>          
        </div>     
        
    </section>
    <?php include 'links/footer.php'?>  
    </body>
    </html>