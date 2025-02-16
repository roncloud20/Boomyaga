<?php
$pagetitle = "Add Product";
require_once "assets/header.php";
require_once "assets/mailer.php";

// Initializing the variables
$productName = $productCategory = $productImages = $tags = $description = $initialPrice = $sellingPrice = $quantity = $productColors = $productSizes = "";

// Initializing the error variables
$initialPriceError = $sellingPriceError = $productImagesError = "";

// Capturing login user information
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['name'];
$user_email = $_SESSION['email'];
$msg = "";

// Form validation
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $productName = htmlspecialchars($_POST['product_name']);
  $productCategory = htmlspecialchars($_POST['product_category']);
  $description = htmlspecialchars($_POST['description']);
  $initialPrice = htmlspecialchars($_POST['initial_price']);
  $sellingPrice = htmlspecialchars($_POST['selling_price']);
  $quantity = htmlspecialchars($_POST['quantity']);
  $productColors = htmlspecialchars($_POST['product_colors']);
  $productSizes = htmlspecialchars($_POST['product_sizes']);
  $tags = htmlspecialchars($_POST['tags']);

  // Validating Product Image
  $productImages = $_FILES['product_images'];
  if ($productImages['error'] == 0) {
    $filename = uniqid($productName . '_') . "." . pathinfo($productImages['name'], PATHINFO_EXTENSION);
    $filelocation = 'products_images/' . $filename;
    move_uploaded_file( $productImages['tmp_name'], $filelocation);
  } else {
    $productImagesError = "Product images Upload Failed";
  }

  // Validating Initial Price & Selling Price
  if ($sellingPrice > $initialPrice) {
    $initialPriceError = $sellingPriceError = "Selling Price cannot be more than Initial Price";
  } else {
    $initialPriceError = $sellingPriceError = "";
  }

  if ($productImagesError == "" && $initialPriceError == "" && $sellingPriceError == "") {
    // Populating Database
    $query = "INSERT INTO products(product_name, product_category, product_images, tags, description, initial_price, selling_price, quantity, product_colors, product_sizes, user_id) VALUES (?,?,?,?,?,?,?,?,?,?,?)";

    $stmt = $conn->prepare($query);
    $stmt->bind_param('sssssddissi', $productName, $productCategory, $filelocation, $tags, $description, $initialPrice, $sellingPrice, $quantity, $productColors, $productSizes, $user_id);

    if ($stmt->execute()) {
      $mail->setFrom('boomyaga@roncloud.com.ng', "Boomyaga New Product");
      $mail->addAddress($user_email, $user_name);
      $mail->isHTML(true);
      $mail->Subject = 'Product Verification';
      $mail->Body = "<h1>Hello, $user_name</h1> 
        <p>You have successfully add a new product $productName</p>";
      $mail->AltBody = "Hello, $user_name. You have successfully add a new product $productName<";
      $mail->send();
      $msg = "<span class='text-success'>Product Added Successfully</span>";
    } else {
      $msg = "<span class='text-danger'>Failed To Add Product</span>";
    }
  }
}
?>

<section class="vh-100 bg-image"
  style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-5">
              <h2 class="text-uppercase text-center mb-5">Add A Product</h2>
              <h3><?= $msg ?></h3>

              <form method="post" enctype="multipart/form-data">

                <!-- Product Image Preview -->
                <div class="form-outline mb-4">
                  <img class="form-control form-control-lg" alt="New Product" src="./assets/boomyaga_icon.png" id="imagePreview"/>
                  <label class="form-label" id="upload_label">Upload Product Image</label>
                  <span class="text-danger"><?= $productImagesError ?></span>
                  <input type="file" id="product_upload" class="form-control form-control-lg" name="product_images" required/>
                </div>
                <script>
                  const preview =document.getElementById("imagePreview");
                  const image = document.getElementById("product_upload");
                  const label = document.getElementById("upload_label");
                  

                  image.addEventListener("change", () => {
                    let file = image.files[0];
                    const filesize = 3 * 1024 * 1024;
                    if(file['type'] == "image/jpeg" || file['type'] == "image/png" || file['type'] == "image/jpg") {
                      if(file['size'] <= filesize) {
                        const reader = new FileReader();
                        reader.onload = () => {
                          preview.src = reader.result;
                        }

                        reader.readAsDataURL(file);
                        label.innerHTML = "<span class='text-success'>Upload Successfully</span>";
                      } else {
                        console.log("Image size is to large");
                        preview.src = "./assets/boomyaga_icon.png";
                        image.value = "";
                        label.innerHTML = "<span class='text-danger'>Image size is to large</span>";
                      }
                    } else {
                      console.log("file type is not supported");
                      preview.src = "./assets/boomyaga_icon.png";
                      image.value = "";
                      label.innerHTML = "<span class='text-danger'>file type is not supported</span>";
                    }
                  });
                </script>
                <div class="form-outline mb-4">
                  <input type="text" id="form3Example1cg" class="form-control form-control-lg" name="product_name" placeholder="Product Name" required />
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example3cg">Category</label>
                  <select class="form-control form-control-lg" name="product_category" required>
                    <option value="Fashion">Fashion</option>
                    <option value="Beauty & Health">Beauty & Health</option>
                    <option value="Mobile & Tablets">Mobile & Tablets</option>
                    <option value="Computer & Accessories">Computer & Accessories</option>
                    <option value="Home & Kitchen">Home & Kitchen</option>
                    <option value="Sports & Fitness">Sports & Fitness</option>
                    <option value="Baby care & Toys">Baby care & Toys</option>
                    <option value="Office & School Supplies">Office & School Supplies</option>
                    <option value="Foods & Drinks">Foods & Drinks</option>
                    <option value="Tools">Tools</option>
                    <option value="Automobilies">Automobilies</option>
                  </select>
                </div>

                <div class="form-outline d-flex gap-3">
                  <input type="number" class="form-control form-control-lg" name="initial_price" placeholder="Initial Price" required />
                  <input type="number" class="form-control form-control-lg" name="selling_price" placeholder="Selling Price" required />
                </div>
                <div class="mb-4">
                  <span class="text-danger"><?= $initialPriceError ?></span>
                </div>

                <div class="form-outline mb-4">
                  <input type="number" class="form-control form-control-lg" name="quantity" placeholder="quantity" min="1" required />
                </div>

                <!-- Product Colors -->
                <div class="form-outline mb-4">
                  <label class="form-label">Product Colors</label> <br />
                  <div class="tags-input">
                    <ul id="tags1"></ul>
                    <input type="text" id="input-tag1" class="form-control" placeholder="Enter Product Colors" onfocus="tagentry('tags1', 'input-tag1', 'product_colors_hidden')" />
                  </div>
                  <input type="hidden" name="product_colors" id="product_colors_hidden" />
                </div>

                <!-- Product Sizes -->
                <div class="form-outline mb-4">
                  <label class="form-label">Product Sizes</label> <br />
                  <div class="tags-input">
                    <ul id="tags2"></ul>
                    <input type="text" id="input-tag2" class="form-control" placeholder="Enter Product Sizes" onfocus="tagentry('tags2', 'input-tag2', 'product_sizes_hidden')" />
                  </div>
                  <input type="hidden" name="product_sizes" id="product_sizes_hidden" />
                </div>
                
                <!-- Product Description -->
                <div class="form-outline mb-4">
                  <textarea class="form-control form-control-lg" name="description" placeholder="Product Description" rows="8" required></textarea>
                </div>

                <!-- Product Tags -->
                <div class="form-outline mb-4">
                  <label class="form-label">Tags</label> <br />
                  <div class="tags-input">
                    <ul id="tags3"></ul>
                    <input type="text" id="input-tag3" class="form-control" placeholder="Enter Product Tags" onfocus="tagentry('tags3', 'input-tag3', 'product_tags_hidden')" />
                  </div>
                  <input type="hidden" name="tags" id="product_tags_hidden" />
                </div>

                <div class="d-flex justify-content-center">
                  <input type="submit" value="Create Product" class="btn btn-success btn-block btn-lg gradient-custom-4 text-body"/>
                </div>
              </form>

          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>


<!-- Tag Input CSS -->
<style>
  .tags-input {
    display: inline-block;
    position: relative;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 5px;
    box-shadow: 2px 2px 5px #00000033;
    width: 100%;
  }

  .tags-input ul {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .tags-input li {
    display: inline-block;
    background-color: #f2f2f2;
    color: #333;
    border-radius: 20px;
    padding: 5px 10px;
    margin-right: 5px;
    margin-bottom: 5px;
  }

  .tags-input input[type="text"] {
    border: none;
    outline: none;
    padding: 5px;
    font-size: 14px;
  }

  .tags-input input[type="text"]:focus {
    outline: none;
  }

  .tags-input .delete-button {
    background-color: transparent;
    border: none;
    color: #999;
    cursor: pointer;
    margin-left: 5px;
  }
</style>

<script>
  function tagentry(tagEntry, inputEntry, hiddenInputEntry) {
    const tags = document.getElementById(tagEntry);
    const input = document.getElementById(inputEntry);
    const hiddenInput = document.getElementById(hiddenInputEntry);

    input.addEventListener('keydown', function (event) {
      if (event.key === 'Enter') {
        event.preventDefault();
        const tagContent = input.value.trim();

        if (tagContent !== '') {
          const tag = document.createElement('li');
          tag.innerHTML = `${tagContent} <button class="delete-button">X</button>`;
          tags.appendChild(tag);
          updateHiddenInput();

          input.value = '';
        }
      }
    });

    tags.addEventListener('click', function (event) {
      if (event.target.classList.contains('delete-button')) {
        event.target.parentNode.remove();
        updateHiddenInput();
      }
    });

    function updateHiddenInput() {
      let tagValues = Array.from(tags.children).map(tag => tag.innerText.replace('X', '').trim());
      hiddenInput.value = tagValues.join(',');
    }
  }
</script>