<?php
session_start();

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
        <li><a href="ads.php"><i class="fa fa-shopping-cart fa-lg" aria-hidden="true"></i></a></li>

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
   <!-- user profile side-bar start-->
   <?php require 'sidebar.php'?>


<!-- user profile side-bar end-->
      
<section class="listing">
<div class="container">
       <h3 class="text-primary text-uppercase text-center">My Listing</h3>

      
       <div class="row" id="records_contant" >
       
       </div>
         </div>
     

<!-- update modal -->
   <!-- The Modal -->
   <div class="modal" id="update">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Update Your Listing</h4>
        <button type="button" class="close" data-dismiss="modal" >&times;</button>
      </div>
      <form action="update.php" method="POST" enctype="multipart/form-data">
      <!-- Modal body -->
      <div class="modal-body">
      
       <div class="form-group">
          <input type="text"  id="update_title"  name="title" class="form-control" placeholder="Title">
       </div>
       <div class="form-group">
           
           <input type="text"  id="update_price" class="form-control" name="price" placeholder="price">
           </div>
           <div class="form-group">
           
           <input type="text"  id="update_description" class="form-control" name="description" placeholder="Product Description">
           </div>
           <div class="form-group">
           
           <input type="text" id="update_condition" class="form-control" name="product_condition" placeholder="Product Condition">   
       </div>
       <div class="form-group">
          
           <input type="text"  id="update_location"  name="location" class="form-control" placeholder="Product Location">   
       </div>
       <div class="form-group">
          
       <select placeholder="Enter category" name="category">
                            <option value="Furniture">furniture</option>
                            <option value="Automobile">automobile</option>
                            <option value="Realestate">realestate</option>
                            <option value="Gadget">gadget</option>
                            <option value="Appliances">appliances</option>
                        </select> 
       </div>
       <div class="form-group">
          
           <input type="file" name="image" accept=".png, .gif, .jpg, .jpeg" id="update_filename" class="form-control" placeholder="Product image">   
       </div>
      
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
       
          
           <button type="submit"  value="submit" name="submit" class="btn btn-danger" data-dismiss="modal"  >Save</button> 
        
        <input type="hidden" name="hidden_user_id" id="hidden_user_id">
      </div>
         </form>
    </div>
  </div>
</div> 


   </div>
</section>
<!-- footer -->
    <?php require 'links/footer.php'; ?>
   
    <script type="text/javascript">
      

      $(document).ready(function(){
          readRecords();
      });
       function readRecords(){
           var readrecord = "readrecord";

           $.ajax({
               url:"listing-backend.php",
               type:"post",
               data:{ readrecord:readrecord},
               success:function(data,status){
                   $('#records_contant').html(data);
               }
           });
       };
  

      function deleteUser(deleteid){
          var conf = confirm("Are you sure about deleting the data!!!");
          if(conf===true){
              $.ajax({
                  url: "listing-backend.php",
                  type: "post",
                  data:{ deleteid:deleteid},
                  success:function(data,status){
                      readRecords();
                  },
              });
              
          }
      };

      function getUserDetails(id){
        var conf = confirm("Are you sure about updating the data!!!");
        console.log("test");
        
        
        
          $('#hidden_user_id').val(id);
        
         $("#update").show();

     
      };
      function updateUserDetail(){
        var title = $('#update_title').val();
          var price= $('#update_price').val();
          var description = $('#update_description').val();
          var condition = $('#update_condition').val();
          var category = $('#update_category').val();
          var location = $('#update_location').val();
          var filename = $('#update_filename').val();
          
          

          var hidden_user_idupd = $('#hidden_user_id').val();
          $.post("listing-backend.php",{
            hidden_user_idupd:hidden_user_idupd,
              title:title,
              price:price,
              description:description,
              condition:condition,
              category:category,
              location:location,
              filename:filename,
          },
          function(data,status){
            $("#update").close();
            readRecords();
          }

          );
      };
      $(".close").click(function(){
            $("#update").hide();
        });
  </script>
<script src="usermenu.js"></script>
</body>
</html>
