<?php
    $product_name = $_GET['product_name'];
    $pagetitle = "View Product | $product_name";
    require_once "assets/header.php";

    // echo $_SESSION['order_id'];

    // Fetching  product details from database
    $product_id = $_GET['product_id'];

    $query = "SELECT * FROM products WHERE product_id = $product_id LIMIT 1";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) > 0) {
        $item = mysqli_fetch_assoc($result);
        // echo "<pre>";
        // var_dump($item);
        // echo "</pre>";
?>
    <main class="mx-5 d-flex flex-wrap gap-5 mx-7 my-5 ">
        <!-- Product Images -->
        <div class="d-flex flex-column gap-3">
            <img class="border border-danger rounded object-fit-cover" src="<?= $item['product_images']?>" alt="<?= $item['product_name']?>" width="500px" height="500px"/>
            <div class="d-flex">
                <img class="border border-danger rounded object-fit-cover" src="<?= $item['product_images']?>" alt="<?= $item['product_name']?>" width="125px" height="125px"/>
                <img class="border border-danger rounded object-fit-cover" src="<?= $item['product_images']?>" alt="<?= $item['product_name']?>" width="125px" height="125px"/>
                <img class="border border-danger rounded object-fit-cover" src="<?= $item['product_images']?>" alt="<?= $item['product_name']?>" width="125px" height="125px"/>
                <img class="border border-danger rounded object-fit-cover" src="<?= $item['product_images']?>" alt="<?= $item['product_name']?>" width="125px" height="125px"/>
            </div>
        </div>

        <!-- Product Contents -->
        <div class="d-flex flex-column flex-fill gap-5">
            <h1><?= $item['product_name']?></h1>
            <h4><a href='#' class='border rounded-pill m-1 px-3 text-decoration-none'><?= $item['product_category']?></a></h4>
            <div>
                <span>Product Tags: </span>
                <?php
                    $tags = explode(",",$item['tags']);
                    foreach($tags as $tag) {
                        echo "<a href='#' class='border rounded-pill m-1 px-3 text-decoration-none'>$tag</a>";
                    }
                ?>
            </div>

            <h4>Description</h4>
            <p><?= $item['description']?></p>

            <h6>
                Cost Price: <span class="text-decoration-line-through"><?= $item['initial_price']?></span> |
                Selling Price: <?= $item['selling_price']?>
            </h6>
            <form action="add_to_cart.php" method="post">
                <input type="hidden" name="product_id" value="<?= $item['product_id']?>">
                <div class="d-flex flex-wrap">
                    <span>Product Colors: </span>
                    <?php
                        $colors = explode(",",$item['product_colors']);
                        foreach($colors as $color) {
                            // echo "<a href='#' style='background-color: $color' class='border rounded-pill m-1 px-2 text-decoration-none'>$color</a>";
                            echo " <span style='background-color: $color' class='border rounded-pill m-1 px-3 py-1 text-decoration-none'> <input type='radio' value='$color' name='color'/>$color</span> ";
                        }
                    ?>
                </div>
                <div>
                    <span>Product Sizes: </span>
                    <?php
                        $sizes = explode(",",$item['product_sizes']);
                        echo "<select name='size' class='form-control' required>";
                        foreach($sizes as $size) {
                            // echo "<a href='#' class='border rounded-pill m-1 px-3 text-decoration-none'>$size</a>";
                            echo "<option value='$size'> $size</option>";
                        }
                        echo "</select>";
                    ?>
                </div>
                <div class="d-flex flex-wrap">
                    <h6>Quantity</h6>
                    <input type="number" min="1" max="<?= $item['quantity'] ?>" class="form-control" name="quantity" value="1">
                </div>
                <input type="submit" class="btn btn-lg btn-danger mb-auto" value="Add to Cart" />
            </form>
        </div>
    </main>

<?php
    } else {
        echo "Product not found";
    }
?>
