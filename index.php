<?php
    $pagetitle = "Boomyaga | No 1 Retail Store";
    require_once "assets/header.php";

    if(!isset($_SESSION['order_id'])) {
        $_SESSION['order_id'] = random_int(00000, 99999);
        // echo $_SESSION['order_id'];
    }
?>
<main>
    <h1>Home Page</h1>
    <?php 
        // Fetching all products in  the database
        $query = "SELECT * FROM products";
        $result = mysqli_query($conn, $query);
        // 08148262465
        if(mysqli_num_rows($result) > 0) {
            echo "<div class='d-flex gap-3 flex-wrap'>";
            while($row = mysqli_fetch_assoc($result)) {
    ?>
                <div class="card" style="width: 18rem;">
                    <img src="<?= $row['product_images']?>" class="card-img-top" alt="<?= $row['product_name']?>" style="height:250px; object-fit: cover;"/>
                    <div class="card-body">
                        <h5 class="card-title"><?= $row['product_name']?></h5>
                        <p>
                            <span class="text-decoration-line-through">Initial Price: <?= "&#8358;" . number_format($row['initial_price'], 2, '.', ',')?> </span> <br/>
                            <span>Selling Price: <?= "&#8358;" . number_format($row['selling_price'], 2, '.', ',')?></span>
                        </p>
                        <a href="view_product.php?product_id=<?=$row['product_id']?>&product_name=<?=$row['product_name']?>"  class="btn btn-primary">View Product</a>
                    </div>
                </div>
    <?php
            }
            echo '</div>';
        } else {
            echo "<h1>No products found</h1>";
        }

    ?>
    
    
    
</main>