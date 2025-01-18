<?php
    include_once 'assets/db_connect.php';
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="assets/boomyaga_icon.png" type="image/x-icon">
    <title><?= $pagetitle; ?></title>
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-dark sticky-top" data-bs-theme="dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php"><img src="assets/boomyaga.png" alt="Boomyaga" width="100px"/></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarScroll">
            <?php if(isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'vendor') {?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="dashboard.php"> Vendor Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="addproduct.php"> Add Product</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="logout.php">Logout</a></li>
                </ul>
            <?php } else if(isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'user') {?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="dashboard.php">User Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="logout.php">Logout</a></li>
                </ul>
            <?php } else {?>
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="about.php">About Us</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="contact.php">Contact Us</a></li>
                    <li class="nav-item"><a class="nav-link active" aria-current="page" href="login.php">Login</a></li>
                </ul>
            <?php }?>

            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
            <section class="d-flex m-3">
                <a href="register.php" class="btn btn-outline-primary ">Register</a>
            </section>
        </div>
    </div>
    </nav>
</body>
</html>