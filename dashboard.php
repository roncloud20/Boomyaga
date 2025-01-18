<?php
    $pagetitle = "Dashboard";
    require_once "assets/header.php";
    require_once "assets/mailer.php";
    // $session_start();
    $name = $_SESSION['name'];
    echo "<h1>Welcome $name!</h1>";