<?php
    // Connecting to our database
    $conn = mysqli_connect("localhost", "root", '',"boomyaga");

    if(!$conn) {
      die("Couldn't connect to database ". mysqli_error($conn));
    }
?>