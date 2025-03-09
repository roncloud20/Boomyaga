<?php
    $pagetitle = "Add To Cart";
    require_once "assets/header.php";

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $product_id = $_POST['product_id'];
        $order_id = $_SESSION['order_id'];
        $quantity = $_POST['quantity'];
        $color = $_POST['color'];
        $size = $_POST['size'];

        echo $product_id . "<br/>";
        echo $order_id . "<br/>";
        echo $quantity . "<br/>";
        echo $color . "<br/>";
        echo $size . "<br/>";

        $query = "INSERT INTO carts(product_id, order_id, quantity, product_color, product_size) VALUES (?,?,?,?,?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iiiss", $product_id, $order_id, $quantity, $color, $size);
        if($stmt->execute()){
            header("Location: index.php");
        } else {
            echo "Error: " . $stmt->error;
        };
    }
?>