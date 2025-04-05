<?php
session_start();


if(!isset($_SESSION['username'])){
    header('location:account.php');
};
?>
<!DOCTYPE html>
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
<html>

<body>
<header>

<!-- <a href="welcome.php" class="logo"><img src="images/Screenshot from 2022-04-08 23-38-46.png" alt="logo " class="logo"></a> -->
 <a href="index.php" class="logo"><p class="logo_text">Buy and Sell</p></a>

<nav>
    <ul class="nav-links">
        <li><a href="welcome.php"><i class="fa fa-home fa-lg" aria-hidden="true"></i></a></li>
        <li><a href="ads.php"><i class="fa fa-plus-square-o fa-lg" aria-hidden="true"></i></a></li>
        <li><a href="ads.php"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i></a></li>

        <li id="user-menu"><i class="fa fa-user-circle-o fa-lg " aria-hidden="true" ></i> </li>
        
    </ul>
</nav>
</header>
<?php include 'sidebar.php'?>
   


            <div class="row place" >
            <h2>Enter Product Details:</h2>
                <form action="add.php" method="POST" enctype="multipart/form-data">


                    <div class="ads-form">
                        <!-- <label>ads_id : </label>
                        <input type="Number" placeholder="Enter id" name="ads_id"><br><br> -->

                        <label>Title : </label>
                        <input type="text area" placeholder="Enter Title" name="title" required><br><br>


                        <label>Price: </label>
                        <input type="number" placeholder="Enter Price" name="price"  required min="0" ><br><br>

                        <label>Quantity: </label>
                        <input type="number" placeholder="Enter Available Quantity" name="quantity"  required max="1000" min="1"><br><br>

                        <label>Description : </label>
                        <input type="text " placeholder="Enter Description" name="description" required maxlength="80"><br><br>


                        <label>Product Condition : </label>
                        <input type="text" placeholder="Enter Condition" name="product_condition" maxlength="60"><br><br>

                        <label>category : </label>
                        <select placeholder="Enter category" name="category">
                            <option value="Furniture">furniture</option>
                            <option value="Automobile">automobile</option>
                            <option value="Realestate">realestate</option>
                            <option value="Gadget">gadget</option>
                            <option value="Appliances">appliances</option>
                        </select> 
                        <br><br>
                        


                        <label>location : </label>
                        <input type="text" placeholder="Enter Location" name="location"  required><br><br>

                        <label>filename : </label>
                        <input type="file" name="image" accept=".png, .gif, .jpg, .jpeg" required>
   
                        <button type="submit" value="submit" name="submit">submit</button>
                        <br>
                        <br>
                    </div>

                </form>
                
            </div>
       
    
    <script src="usermenu.js"></script>
    <?php include 'links/footer.php'?>
</body>

</html>