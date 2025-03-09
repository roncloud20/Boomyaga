<?php
$pagetitle = "My Products";
require_once "assets/header.php";

$vendor_id = $_SESSION['user_id'];
echo $vendor_id;
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
        $query = "SELECT * FROM products WHERE user_id = $vendor_id";
        $result = mysqli_query($conn, $query);
        $i = 1;
        if(mysqli_num_rows($result) > 0) {
            echo "<tbody>";
            while($row = mysqli_fetch_assoc($result)) {
    ?>

    <tr>
        <th scope="row"><?= $i++ ?></th>
        <td><?= $row['product_name']?></td>
        <td><?= $row['product_category']?></td>
        <td><?= "&#8358;" . number_format($row['initial_price'], 2, '.',",")?></td>
        <td><?= "&#8358;" . number_format($row['selling_price'], 2, '.',",")?></td>
        <td><a href="edit_product.php?pid=<?= $row['product_id']?>" class="btn btn-warning">&#x1F4DD; Edit</a></td>
        <td><a href="delete_product.php?pid=<?= $row['product_id']?>" class="btn btn-danger">&#x1F5D1; Remove</a></td>
    </tr>
    <?php
        }
            echo ' </tbody>';
        } else {
        echo "<h1>No products found</h1>";
        }
    ?>
</table>