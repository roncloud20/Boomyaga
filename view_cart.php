<?php
$pagetitle = "My Carts";
require_once "assets/header.php";

$order_id = $_SESSION['order_id'];
echo $order_id;
?>

<table class="table table-hover">
    <thead class="thead-dark">
        <tr>
        <th scope="col">#</th>
        <th scope="col">Product Name</th>
        <th scope="col">Product Category</th>
        <th scope="col">Inital Price</th>
        <th scope="col">Selling Price</th>
        <th scope="col">Edit Item</th>
        <th scope="col">Remove Item</th>
        </tr>
    </thead>
    
    <?php 
        // Fetching vendor products in the database
        $query = "SELECT p.product_id, p.product_name, p.product_images, p.selling_price, c.product_id, c.order_id, c.quantity, c.product_color, c.product_size FROM carts c INNER JOIN products p ON c.product_id = p.product_id WHERE c.order_id = $order_id AND c.status = 'Pending'";
        $result = mysqli_query($conn, $query);
        $i = 1;
        if(mysqli_num_rows($result) > 0) {
            echo "<tbody>";
            while($row = mysqli_fetch_assoc($result)) {
    ?>

    <tr>
        <th scope="row"><?= $i++ ?></th>
        <td><?= $row['product_name']?></td>
        <td><?= $row['quantity']?></td>
        <td><?= "&#8358;" . number_format($row['selling_price'], 2, '.',",")?></td>
        <?php $subtotal = $row['quantity'] * $row['selling_price']  ?>
        <td><?= "&#8358;" . number_format($subtotal, 2, '.',",")?></td>
        <td><a href="edit_product.php?pid=<?= $row['product_id']?>" class="btn btn-warning">&#x1F4DD; Edit</a></td>
        <td><a href="delete_product.php?pid=<?= $row['product_id']?>" class="btn btn-danger">&#x1F5D1; Remove</a></td>
    </tr>
    <?php
        }
            echo '</tbody>';
        } else {
        echo "<h1>Cart is Empty</h1>";
        }
    ?>
</table>