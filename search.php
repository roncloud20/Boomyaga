<?php
    $pagetitle = "Search Product";
    require_once "assets/header.php";
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $search = htmlspecialchars($_POST['search']);

        $query = "SELECT * FROM products WHERE product_name LIKE '%$search%'";
        $stmt = $conn->prepare($query);
        // $stmt->bind_param('s', $search);
        if ($stmt->execute()){
            $result = $stmt->get_result();
            if($result->num_rows > 0){
                echo "<div class='d-flex gap-3 flex-wrap my-2'>";
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
                echo "No results found";
            }
        } else {
            echo "Error: " . $stmt->error;
        }
    }
?>