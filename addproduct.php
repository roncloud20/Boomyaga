<?php
$pagetitle = "Add Product";
require_once "assets/header.php";

// Initializing the variables
$productName = $productCategory = $productImages = $tags = $description = $initialPrice = $sellingPrice = $quantity = $productColors = $productSizes = "";

$user_id = $_SESSION['user_id'];

// Form validation
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $productName = htmlspecialchars($_POST['product_name']);
  $productCategory = htmlspecialchars($_POST['product_category']);
  $initialPrice = htmlspecialchars($_POST['initial_price']);
  $sellingPrice = htmlspecialchars($_POST['selling_price']);
  $quantity = htmlspecialchars($_POST['quantity']);

  $productImages = $_FILES['product_images'];
  echo $productImages['name'];
  
  // Product Colors Validations
  if (!empty($_POST['product_colors'])) {
    $product_colors = explode(',', $_POST['product_colors']);
    foreach ($product_colors as $color) {
      echo htmlspecialchars($color) . ", ";
    }
  } else {
    echo "No product sizes entered.";
  }
  // Product Sizes Validations
  if (!empty($_POST['product_sizes'])) {
    $product_sizes = explode(',', $_POST['product_sizes']);
    foreach ($product_sizes as $size) {
      echo htmlspecialchars($size) . ", ";
    }
  } else {
    echo "No product sizes entered.";
  }

  // Product Tags Validations
  if (!empty($_POST['tags'])) {
    $tags = explode(',', $_POST['tags']);
    foreach ($tags as $tag) {
      echo htmlspecialchars($tag) . ", ";
    }
  } else {
    echo "No product sizes entered.";
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

              <form method="post" enctype="multipart/form-data">

                <!-- Product Image Preview -->
                <div class="form-outline mb-4">
                  <img class="form-control form-control-lg" alt="New Product" src="./assets/boomyaga_icon.png" id="imagePreview"/>
                  <label class="form-label" id="upload_label">Upload Product Image</label>
                  <input type="file" id="product_upload" class="form-control form-control-lg" name="product_images"/>
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
                  <input type="text" id="form3Example1cg" class="form-control form-control-lg" name="product_name"
                    placeholder="Product Name" />
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example3cg">Category</label>
                  <select class="form-control form-control-lg" name="product_category">
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

                <div class="form-outline mb-4 d-flex gap-3">
                  <input type="number" class="form-control form-control-lg" name="initial_price"
                    placeholder="Initial Price" />
                  <input type="number" class="form-control form-control-lg" name="selling_price"
                    placeholder="Selling Price" />
                </div>

                <div class="form-outline mb-4">
                  <input type="number" class="form-control form-control-lg" name="quantity" placeholder="quantity" />
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
                  <textarea class="form-control form-control-lg" name="description" placeholder="Product Description" rows="8"></textarea>
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