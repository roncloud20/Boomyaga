<?php
    // $product_name = $_GET['product_name'];
    $pagetitle = "Delete Product";
    require_once "assets/header.php";

    // echo $_SESSION['order_id'];

    $vendor_id = $_SESSION['user_id'];
    $product_id = $_GET['pid'];

    // Fetching  product details from database
    $query = "SELECT * FROM products WHERE user_id = ? AND product_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ii', $vendor_id, $product_id);
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows == 1) {
            $query = "DELETE FROM products WHERE product_id = $product_id LIMIT 1";
            $result = mysqli_query($conn, $query);
            header("Location: vendor_products.php");
        } else {
            echo "Error: no product found";
        }
    } else {
        $echo = $stmt->error;
    }

    
?>
