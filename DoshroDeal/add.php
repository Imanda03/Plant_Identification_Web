<?php
require 'links/connection.php';
session_start();

// Check if user is logged in
if (!isset($_SESSION['userID'])) {
    header('location: account.php');
    exit();
}

$userid = $_SESSION['userID'];

function getCategoryId($categoryName, $conn) {
    $categoryName = mysqli_real_escape_string($conn, $categoryName);
    $query = "SELECT categoryID FROM categories WHERE categoryName = '$categoryName'";
    $result = mysqli_query($conn, $query);
    
    if ($result && $row = mysqli_fetch_assoc($result)) {
        return $row['categoryID'];
    }
    return null;
}

function handleImageUpload($file) {
    $target_dir = "uploads/";
    $epoch = microtime(true);
    $target_file = $target_dir . $epoch . basename($file["name"]);
    $image_path = $target_dir . $epoch . htmlspecialchars(basename($file["name"]));
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    // Check file size
    if ($file["size"] > 5000000) {
        throw new Exception("Sorry, your file is too large.");
    }
    
    // Allow certain file formats
    if (!in_array($imageFileType, ["jpg", "jpeg", "png", "gif"])) {
        throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
    }
    
    if (!move_uploaded_file($file["tmp_name"], $target_file)) {
        throw new Exception("Sorry, there was an error uploading your file.");
    }
    
    return $image_path;
}

if (isset($_POST['submit'])) {
    try {
        // Validate required fields
        $required_fields = ['title', 'price', 'quantity', 'description', 'location'];
        foreach ($required_fields as $field) {
            if (empty($_POST[$field])) {
                throw new Exception("$field is required");
            }
        }
        
        // Validate and sanitize input
        $title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
        $price = filter_var($_POST['price'], FILTER_VALIDATE_FLOAT);
        $quantity = filter_var($_POST['quantity'], FILTER_VALIDATE_INT);
        $description = filter_var($_POST['description'], FILTER_SANITIZE_STRING);
        $product_condition = filter_var($_POST['product_condition'], FILTER_SANITIZE_STRING);
        $category = filter_var($_POST['category'], FILTER_SANITIZE_STRING);
        $location = filter_var($_POST['location'], FILTER_SANITIZE_STRING);
        
        if ($price === false || $quantity === false) {
            throw new Exception("Invalid price or quantity");
        }
        
        // Get category ID
        $categoryId = getCategoryId($category, $conn);
        if (!$categoryId) {
            throw new Exception("Invalid category");
        }
        
        // Handle image upload
        $image_path = handleImageUpload($_FILES["image"]);
        
        // Begin transaction
        mysqli_begin_transaction($conn);
        
        // Insert product
        $insertquery = "INSERT INTO `product` 
                       (`title`, `price`, `quantity`, `description`, `pcondition`, 
                        `location`, `filename`, `categoryID`, `userID`) 
                       VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = mysqli_prepare($conn, $insertquery);
        mysqli_stmt_bind_param($stmt, "ssissssii", 
                             $title, $price, $quantity, $description, 
                             $product_condition, $location, $image_path, 
                             $categoryId, $userid);
        
        if (!mysqli_stmt_execute($stmt)) {
            throw new Exception("Error inserting product: " . mysqli_error($conn));
        }
        
        $productid = mysqli_insert_id($conn);
        
        // Insert sales record
        $sql = "INSERT INTO `sales` (`userID`, `productID`) VALUES (?, ?)";
        $stmt2 = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt2, "ii", $userid, $productid);
        
        if (!mysqli_stmt_execute($stmt2)) {
            throw new Exception("Error inserting into sales: " . mysqli_error($conn));
        }
        
        // Commit transaction
        mysqli_commit($conn);
        
        // Redirect to listing page
        header('location: listing.php');
        exit();
        
    } catch (Exception $e) {
        mysqli_rollback($conn);
        $error_message = $e->getMessage();
        // Store error in session and redirect back to form
        $_SESSION['error_message'] = $error_message;
        header('location: ads.php');
        exit();
    }
}
?>

<!-- Add this to your listing.php file -->
<?php
function displayBuyButton($productUserId, $currentUserId) {
    if ($productUserId !== $currentUserId) {
        echo '<button class="buy-now-btn">Buy Now</button>';
    } else {
        echo '<span class="owner-badge">Your Listing</span>';
    }
}
?>