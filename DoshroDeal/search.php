<?php
session_start();
include 'links/connection.php';

if(isset($_POST['search'])){
    $cat = $_POST['search'];
    echo $cat;
    $sql = "SELECT sales.salesID, product.productID, product.title, product.price, product.description,product.pcondition,product.location,product.filename,product.categoryID
    FROM sales
    INNER JOIN product ON sales.productID = product.productID
    WHERE title='$cat';";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        
    } else {
        $msg = "No Record found";
        ?>
        <script >alert("no records found");</script>
        <?php
        // header('location:welcome.php');
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
                    <div class="buy-bar"><a href="product-details.php?id=<?php echo $row['salesID']?> " style="color: white;">Buy Now</a></div>
            </div>  
            <?php } ?>          
        </div>     
        
    </section>
    <?php include 'links/footer.php'?>  
    </body>
    </html>