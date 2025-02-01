<?php
    $pagetitle = "Boomyaga | No 1 Retail Store";
    require_once "assets/header.php";
?>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['product_sizes'])) {
        $product_sizes = explode(',', $_POST['product_sizes']);
        echo "Product Sizes Submitted:<br>";
        foreach ($product_sizes as $size) {
            echo htmlspecialchars($size) . "<br>";
        }
    } else {
        echo "No product sizes entered.";
    }
}
?>

<h1>Home Page</h1>
<!-- <input type="password" id="password"/>
<input type="checkbox" id="show" onchange="showPass(password, show)"/> Show
<input type="password" id="password1"/>
<input type="checkbox" id="show1" onchange="showPass(password1, show1)"/> Show -->
<script>
    // var password = document.getElementById(pass);
    // var show = document.getElementById(check);
    // show.addEventListener("change", (e) => {
    //     if(e.target.checked) {
    //         password.type = "text";
    //     } else {
    //         password.type = "password";
    //     }
    // });
    function showPass(pass, check) {
        if(check.checked) {
            pass.type = "text";
        } else {
            pass.type = "password";
        }
    }
</script>

<!-- Product Sizes -->
<form method="POST" action="">
  <div class="form-outline mb-4">
    <label class="form-label">Product Sizes</label> <br />
    <div class="tags-input">
      <ul id="tags2"></ul>
      <input type="text" id="input-tag2" class="form-control" placeholder="Enter Product Sizes" onfocus="tagentry('tags2', 'input-tag2')" />
    </div>
    <input type="hidden" name="product_sizes" id="product_sizes_hidden" />
  </div>
  <button type="submit">Submit</button>
</form>

<script>
    function tagentry(tagEntry, inputEntry) {
    const tags = document.getElementById(tagEntry);
    const input = document.getElementById(inputEntry);
    const hiddenInput = document.getElementById('product_sizes_hidden');

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