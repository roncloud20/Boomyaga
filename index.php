<?php
    $pagetitle = "Boomyaga | No 1 Retail Store";
    require_once "assets/header.php";
?>

<h1>Home Page</h1>
<input type="password" id="password"/>
<input type="checkbox" id="show" onchange="showPass(password, show)"/> Show
<input type="password" id="password1"/>
<input type="checkbox" id="show1" onchange="showPass(password1, show1)"/> Show
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