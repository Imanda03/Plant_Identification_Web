<?php
session_start();
require 'links/connection.php';


if(isset($_POST['submit'])){


//login data
  $email = $_POST['email'];
  $password = $_POST['password'];

  $email_search = "SELECT * FROM user WHERE email='$email' ";
  $query = mysqli_query($conn,$email_search);

//checking whether email exits in database or not
  $email_count = mysqli_num_rows($query);
  if($email_count){
    $email_pass = mysqli_fetch_assoc($query);
    $db_pass = $email_pass['password'];
    $pass_decode = password_verify($password, $db_pass);


    if (password_verify($password, $db_pass)) {
        // Successful login
        $_SESSION['username'] = $email_pass['username'];
        $_SESSION['userID'] = $email_pass['userID'];
        $_SESSION['userimage'] = $email_pass['userimage'];

         header('location:welcome.php');
    } else {
        // Incorrect password
        echo "Invalid password!";
    }
  }
  else{
    echo "Invalid Email";

  }
   

}




// //login data
// $name = $_POST['name'];
// $password = $_POST['password'] ;



// //selection query
// $sql = "SELECT * FROM `user`;";
// $result = $conn->query($sql);

// if ($result->num_rows > 0) {
//   // output data of each row
//   while($row = $result->fetch_assoc()) {

//     if(($name === $row["username"]) && ($password === $row["password"])){
//         echo "welcome ".$row["username"];
//         echo "<p>Your Profile</p><br>";
//     echo "id: " . $row["user_id"]. "<br>Name: " . $row["username"]. "<br>Email " . $row["email"]. "<br>Phone Number:". $row["phone"]."<br>";
   
//     }
//   }
// } else {
//   echo "0 results";
// }
// $conn->close();
?>