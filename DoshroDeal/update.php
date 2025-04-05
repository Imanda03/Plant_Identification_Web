<?php
require 'links/connection.php';
session_start();
$userid = $_SESSION['userID'];
// echo "whoami:";
// echo exec('whoami');

if (isset($_POST['submit']) && isset($_POST['hidden_user_id'])) {

    $hidden_user_id = $_POST['hidden_user_id'];
    echo $hidden_user_id;
	// $ads_id = $_POST['ads_id'];
	$title = $_POST['title'];
    echo $title;

	$price = $_POST['price'];
    echo $price;

	$description = $_POST['description'];
    echo $description;

	$product_condition = $_POST['product_condition'];
    echo $product_condition;

	$category = $_POST['category'];
    echo $category;

	$location = $_POST['location'];
    echo $hidden_user_id;

	$image = $_POST['image'];
    echo $image;


	$target_dir = "uploads/";
	$epoch = microtime(true);
	$target_file = $target_dir .$epoch. basename($_FILES["image"]["name"]);
	$image_path = $target_dir.$epoch.htmlspecialchars(basename($_FILES["image"]["name"]));
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

	// Check if image file is a actual image or fake image
	if (isset($_POST["submit"])) {
		$check = getimagesize($_FILES["image"]["tmp_name"]);
		if ($check !== false) {
			echo ("File is an image - " . $check["mime"] . ".");
			$uploadOk = 1;
		} else {
			die ("File is not an image.");
			$uploadOk = 0;
		}
	}

	// Check if file already exists
	if (file_exists($target_file)) {
		die ("Sorry, file already exists.");
		$uploadOk = 0;
	}

	// Check file size
	if ($_FILES["image"]["size"] > 500000) {
		die ("Sorry, your file is too large.");
		$uploadOk = 0;
	}

	// Allow certain file formats
	if (
		$imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif"
	) {
		die ("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
		$uploadOk = 0;
	}

	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		die ("Sorry, your file was not uploaded.");
		// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
			echo ("The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.");
		} else {
			die ("Sorry, there was an error uploading your file.");
		}
	}
	

	$insertquery = "UPDATE `product` SET `title`='$title',`price`='$price',`description`='$description',`pcondition`='$product_condition',`location`='$location ',`filename`='$image_path',`categoryID`='$category' WHERE productID = '$hidden_user_id';";
	$iquery = mysqli_query($conn,$insertquery);
	
	header ('location:listing.php');
}
	
	

// 	$sql = "INSERT INTO advertise (`title`,`price`,`description`,
//    `product_condition`,`category`,`location`,`image_path`, `filename`)	
//     VALUES ('$title','$price',
//     '$description','$product_condition','$category', '$location','$image_path', 'random')";
// 	if (mysqli_query($conn, $sql)) {
// 		echo "New record created successfully !";
// 		echo "<script> location.href='home.php'; </script>";

// 	} else {
// 		echo "Error: " . $sql . "
// " . mysqli_error($conn);
// 	}
// 	mysqli_close($conn);

else {
	echo "request not working here";
}

if(isset($_POST['submit']) && isset($_POST['name'])){


	$name = mysqli_real_escape_string($conn,$_POST['name']);
	$email =mysqli_real_escape_string($conn, $_POST['email']);
	$phone =mysqli_real_escape_string($conn, $_POST['phone']);
	$password =  mysqli_real_escape_string($conn, $_POST['password']);
	$cpassword =  mysqli_real_escape_string($conn, $_POST['cpassword']);
	
	//encrypt password
	$pass = password_hash($password,PASSWORD_BCRYPT);
	$cpass = password_hash($cpassword,PASSWORD_BCRYPT);
	
	//Taking the files from input
	$file = $_FILES['file'];
	//Getting the file name of the uploaded file
	$fileName = $_FILES['file']['name'];
	//Getting the Temporary file name of the uploaded file
	$fileTempName = $_FILES['file']['tmp_name'];
	//Getting the file size of the uploaded file
	$fileSize = $_FILES['file']['size'];
	//getting the no. of error in uploading the file
	$fileError = $_FILES['file']['error'];
	//Getting the file type of the uploaded file
	$fileType = $_FILES['file']['type'];
	
	//Getting the file ext
	$fileExt = explode('.',$fileName);
	$fileActualExt = strtolower(end($fileExt));
	
	//Array of Allowed file type
	$allowedExt = array("jpg","jpeg","png","pdf");
	
	
	//checking existing email 
	

	
	//Checking, Is file extentation is in allowed extentation array
	if(in_array($fileActualExt, $allowedExt)){
	  //Checking, Is there any file error
	  if($fileError == 0){
		  //Checking,The file size is bellow than the allowed file size
		  if($fileSize < 10000000){
			  //Creating a unique name for file
			  $fileNemeNew = uniqid('',true).".".$fileActualExt;
			  //File destination
			  $fileDestination = 'uploads/'.$fileNemeNew;
			  //function to move temp location to permanent location
			  if(move_uploaded_file($fileTempName, $fileDestination)){
				  echo "File Uploaded successfully";
	
				
					if($password === $cpassword){
					  $insertquery = "UPDATE `user` SET `username`='$name',`password`='$pass',`email`='$email',`phone`='$phone',`userimage`='$fileDestination' WHERE userID='$userid'";
					  $iquery = mysqli_query($conn,$insertquery);
					  
					header('location:logout.php');
					}
					else{
					  echo "password are not matching";
					  header('location:account.php');
					}
				  
				  
				 
	
				  
				 
			  }else
			  echo "failed to upload image";
			  //Message after success
			 
		  }else{
			  //Message,If file size greater than allowed size
			  echo "File Size Limit beyond acceptance";
		  }
	  }else{
		  //Message, If there is some error
		  echo "Something Went Wrong Please try again!";
	  }
	}else{
	  //Message,If this is not a valid file type
	  echo "You can't upload this extention of file";
	}
	
	}
	
?>