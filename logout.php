<?php
    // unset($_SESSION['user_role']);
    // unset($_SESSION['user_id']);
    // unset($_SESSION['name']);
    // // session_abort();
    // session_destroy();
    // header('Location: index.php');

    session_start();
    // unset($_SESSION['parent_id']);
    $_SESSION = array();
    session_destroy();
    header("Location: index.php");
?>