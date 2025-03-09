<?php
$pagetitle = "Add Product";
require_once "assets/header.php";
require_once "assets/mailer.php";

$product_id = $_GET['pid'];
echo "<h1>Product ID: $product_id</h1>";

// Fetching a product from the database
$query = "SELECT * FROM products WHERE product_id = $product_id LIMIT 1";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($result);

// Validating Entries
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productName = $_POST['product_name'];
    $initialPrice = $_POST['initial_price'];
    $sellingPrice = $_POST['selling_price'];

    $query = "UPDATE products SET product_name = ?, initial_price =?, selling_price=? WHERE product_id = ?";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('sddi', $productName,  $initialPrice, $sellingPrice, $product_id);
    $stmt->execute();
    echo "<span class='text-success'>Product Added Successfully</span>";

    // if ($stmt->execute()) {
    //   $mail->setFrom('boomyaga@roncloud.com.ng', "Boomyaga New Product");
    //   $mail->addAddress($user_email, $user_name);
    //   $mail->isHTML(true);
    //   $mail->Subject = 'Product Verification';
    //   $mail->Body = "<h1>Hello, $user_name</h1> 
    //     <p>You have successfully add a new product $productName</p>";
    //   $mail->AltBody = "Hello, $user_name. You have successfully add a new product $productName<";
    //   $mail->send();
    //   $msg = "<span class='text-success'>Product Added Successfully</span>";
    // } else {
    //   $msg = "<span class='text-danger'>Failed To Add Product</span>";
    // }
}

?>


<form action="" method="post">
    <input type="text" name="product_name" value="<?= $row['product_name']?>"> <br/>
    <input type="number" name="initial_price" value="<?= $row['initial_price']?>"> <br/>
    <input type="number" name="selling_price" value="<?= $row['selling_price']?>" max="<?= $row['initial_price']?>"> <br/>
    <input type="submit" value="Edit Product">
</form>