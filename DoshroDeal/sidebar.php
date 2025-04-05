<!-- user profile side-bar start-->
<div class="side-bar">
<div id="close-side-bar"> 
<i class="fa fa-times"  ></i>
</div>

<div class="user">
<img src="<?php echo $_SESSION['userimage']; ?>" alt="">
<h3><?php echo $_SESSION['username']; ?></h3>

<div class="user-navbar">
    <a href="listing.php"><i class="fa fa-angle-right" aria-hidden="true"></i>My Listing</a>
    <a href="orders.php"><i class="fa fa-angle-right" aria-hidden="true"></i>My Orders&nbsp;</a>

    <!-- <a href="" data-toggle="modal" data-target="#myModal" id="cside-bar"><i class="fa fa-angle-right" aria-hidden="true"></i>Edit Profile</a> -->
    <div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Your Profile</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form action="update.php" method="POST" enctype="multipart/form-data">
      <!-- Modal body -->
      <div class="modal-body">
       <div class="form-group">
          
          <input type="text" name="name" id="firstname" class="form-control" placeholder="Enter UserName">
       </div>
       <div class="form-group">
           
           <input type="email" name="email" id="lastname" class="form-control" placeholder="Enter Email">
           </div>
           <div class="form-group">
           
           <input type="password" name="phone" id="email" class="form-control" placeholder="Enter Phone">
           </div>
           <div class="form-group">

           <input type="password" name="password" id="mobile" class="form-control" placeholder="Enter Password">   
       </div>
       <div class="form-group">

<input type="text" name="cpassword" id="mobile" class="form-control" placeholder="Confirm assword">   
</div>
<div class="form-group">

<input type="file" name="file" id="mobile" class="form-control" >   
</div>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
      <button type="submit"  value="submit" name="submit" class="btn btn-danger"  >Save</button>       
      </div>
      </form>
    </div>
  </div>
</div> 

    <a href="logout.php"><i class="fa fa-angle-right" aria-hidden="true"></i>Log Out&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
   

    

</div>

</div>
</div>



<!-- user profile side-bar end-->