<?php
$servername = "localhost";
$username = "anish";
$password = "anish";
$dbname = "project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
 ?>
 <script>
   alert('error'); 
 </script>
 <?php
}
else
{
  ?>
   <script>
  //  alert('connected successfully'); 
 </script>
 <?php
}
?>

