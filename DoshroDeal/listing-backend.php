<?php

session_start();
require 'links/connection.php';
$userid = $_SESSION['userID'];

extract($_POST);
//display data
if(isset($_POST['readrecord'])){
   
    $displayquery = "SELECT sales.salesID, product.productID, product.title, product.price, product.description, product.pcondition, product.location, product.filename, product.categoryID
    FROM sales
    INNER JOIN product ON sales.productID = product.productID
    WHERE sales.userID = '$userid';";
    $result = mysqli_query($conn,$displayquery);

    if(mysqli_num_rows($result)>0){
      $number = 1;
       while($row = mysqli_fetch_array($result)){
       
           $filename = $row['filename'];
        $data .= '
        <div class="col ">
                <div class="img-bar">
                   <a href="product-details.html"><img src="'.$filename.'   " alt=""></a> 
                </div>
                <div class="description-bar">

                    <div class="pet-name">'.$row['title'].'</div>
                    <div class="about-wrapper">
                       <div class="condition"><i class="fa fa-clock-o" aria-hidden="true"></i>'.$row['pcondition'].'</div> 
                        <div class="loaction"><i class="fa fa-map-marker" aria-hidden="true">'.$row['location'].'</i>
                        </div>
                        <!-- <div> 0.8 kg</div> -->
                    </div>
                </div>
                <div class="bottom-bar">
                    <div class="breed-bar">
                        <div>'.$row['categoryID'].'</div>
                    </div>
                    <div class="price-bar">Price
                        <div>Rs: '.$row['price'].'</div>
                    </div>
                </div>
                <div class="function">
                <button onclick="getUserDetails('.$row['productID'].')" class="btn btn-warning" >Edit</button>
                <button onclick="deleteUser('.$row['productID'].')" class="btn btn-danger" >Delete</button>
                </div>
            </div>';
        $number++;
       }
    }
    else{
      $data .= '<div><h1> No data found</h1></div>';
    }
    
    echo $data;


}



//delete user record

if(isset($_POST['deleteid'])){
  echo "it works";
  $useridd = $_POST['deleteid'];
  $deletequery = "DELETE FROM `product` WHERE productID = '$useridd';";
  mysqli_query($conn,$deletequery);
}

//get userid for update
if(isset($_POST['id']) && isset($_POST['id']) != ""){
  $user_idd = $_POST['id'];
  $query = "SELECT * FROM `product` WHERE  productID='$user_idd'";
  if(!$result = mysqli_query($conn,$query)){
    exit(mysqli_error($conn));
  }

  $response = array();
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
      $response = $row;
      
    }
  }
  else {
    $response['status'] = 200;
    $response['message'] = "Data not found!";
  }
  //php has some built-in functions to handle JSON
  //objects in PHP can be converted into JSON by using the PHP function
  echo json_encode($response);

}else{
  $response['status'] = 200;
    $response['message'] = "Invalid Request";
}

//update table
if(isset($_POST['hidden_user_idupd'])){
  $hidden_user_idupd = $_POST['hidden_user_idupd'];
  $title = $_POST['title'];
  $price = $_POST['price'];
  $description = $_POST['description'];
  $condition = $_POST['condition'];
  $category = $_POST['category'];
  $location = $_POST['location'];
  $filename = $_POST['filename'];

  $query = "UPDATE `product` SET `title`='$title',`price`='$price',`description`=' $description',`pcondition`='$condition',`location`='$location',`filename`='$filename',`categoryID`='$category' WHERE 1";
  mysqli_query($conn,$query);
}
?>