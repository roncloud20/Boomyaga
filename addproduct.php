<?php
$pagetitle = "Add Product";
require_once "assets/header.php";

// Form validation
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

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
                  <label class="form-label" for="form3Example1cg">Upload Product Image</label>
                  <input type="file" id="product_upload" class="form-control form-control-lg" />
                </div>
                <script>
                  const preview =document.getElementById("imagePreview");
                  const image = document.getElementById("product_upload");

                  image.addEventListener("change", ()=>{
                    // console.log(image.files[0]);
                    let file = image.files[0];
                    const filesize = 3 * 1024 * 1024;
                    if(file['type'] == "image/jpeg" || file['type'] == "image/png" || file['type'] == "image/jpg") {
                      if(file['size'] <= filesize) {
                        // console.log(file);
                        const reader = new FileReader();
                        reader.onload = () => {
                          preview.src = reader.result;
                        }

                        reader.readAsDataURL(file);
                      } else {
                        console.log("Image size is to large");
                        preview.src = "./assets/boomyaga_icon.png";
                        image.value = "";
                      }
                    } else {
                      console.log("file type is not supported");
                      preview.src = "./assets/boomyaga_icon.png";
                      image.value = "";
                    }

                  });
                </script>
                <div class="form-outline mb-4">
                  <input type="text" id="form3Example1cg" class="form-control form-control-lg" name="product_name"
                    placeholder="Product Name" />
                </div>

                <div class="form-outline mb-4">
                  <!-- <label class="form-label" for="form3Example3cg">Category</label> -->
                  <select class="form-control form-control-lg">
                    <option disabled selected>Product Category</option>
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

                
                <div class="form-outline mb-4">
                  <label class="form-label">Product Colors</label> <br />
                  <div class="tags-input">
                    <ul id="tags1"></ul>
                    <input type="text" id="input-tag1" class="form-control" placeholder="Enter Product Colors"
                    onfocus="tagentry(tags1.id, this.id)" />
                  </div>
                </div>

                <!-- Product Sizes -->
                <div class="form-outline mb-4">
                  <label class="form-label">Product Sizes</label> <br />
                  <div class="tags-input">
                    <ul id="tags2"></ul>
                    <input type="text" id="input-tag2" class="form-control" placeholder="Enter Product Sizes"
                      onfocus="tagentry(tags2.id, this.id)" />
                  </div>
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
                    <input type="text" id="input-tag3" class="form-control" placeholder="Enter Product Tags"
                      onfocus="tagentry(tags3.id, this.id)" />
                  </div>
                </div>

                

                <div class="form-check d-flex justify-content-center mb-5">
                  <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" />
                  <label class="form-check-label" for="form2Example3g">
                    I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>
                  </label>
                </div>

                <div class="d-flex justify-content-center">
                  <button type="button"
                    class="btn btn-success btn-block btn-lg gradient-custom-4 text-body">Register</button>
                </div>

                <p class="text-center text-muted mt-5 mb-0">Have already an account?
                  <a href="#!" class="fw-bold text-body"><u>Login here</u></a>
                </p>

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

<!-- Tag Input Script -->
<script>

  function tagentry(tagEntry, inputEntry) {
    // console.log(tagEntry);
    // console.log(inputEntry);
    // Get the tags and input elements from the DOM
    const tags = document.getElementById(tagEntry);
    const input = document.getElementById(inputEntry);

    // Add an event listener for keydown on the input element
    input.addEventListener('keydown', function (event) {

      // Check if the key pressed is 'Enter'
      if (event.key === 'Enter') {

        // Prevent the default action of the keypress
        // event (submitting the form)
        event.preventDefault();

        // Create a new list item element for the tag
        const tag = document.createElement('li');

        // Get the trimmed value of the input element
        const tagContent = input.value.trim();

        // If the trimmed value is not an empty string
        if (tagContent !== '') {

          // Set the text content of the tag to 
          // the trimmed value
          tag.innerText = tagContent;

          // Add a delete button to the tag
          tag.innerHTML += '<button class="delete-button">X</button>';

          // Append the tag to the tags list
          tags.appendChild(tag);

          // Clear the input element's value
          input.value = '';
        }
      }
    });

    // Add an event listener for click on the tags list
    tags.addEventListener('click', function (event) {

      // If the clicked element has the class 'delete-button'
      if (event.target.classList.contains('delete-button')) {

        // Remove the parent element (the tag)
        event.target.parentNode.remove();
      }
    });
  }

</script>