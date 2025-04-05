<?php
session_start();

if(!isset($_SESSION['username'])){
   header('location:account.php');
}
else {
    header('location:welcome.php');
}

?>

<!-- user profile side-bar start-->
<div class="side-bar">
<div id="close-side-bar"> 
<i class="fa fa-times"  ></i>
</div>

<div class="user">
<img src="images/6481225432795d8cdf48f0f85800cf66.jpg" alt="">
<h3>This is <?php echo $_SESSION['username']; ?></h3>
<div class="user-navbar">
    <a href=""><i class="fa fa-angle-right" aria-hidden="true"></i>My Listing</a>
    <a href=""><i class="fa fa-angle-right" aria-hidden="true"></i>Edit Profile</a>
    <a href="logout.php"><i class="fa fa-angle-right" aria-hidden="true"></i>Log Out&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
    




</div>

</div>
</div>



<!-- user profile side-bar end-->