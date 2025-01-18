<?php
    $pagetitle = "Email Verification";
    require_once "assets/header.php";
    require_once "assets/mailer.php";

    if(isset($_GET['token'])) {
        $token = $_GET['token'];
        $stmt = $conn->prepare("SELECT * FROM users WHERE verification_token = ?");
        $stmt->bind_param("s", $token);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1) {
            $stmt = $conn->prepare("UPDATE users SET verified = 1, verification_token = NULL WHERE verification_token = ?");
            $stmt->bind_param("s", $token);
            if($stmt->execute()) {
                echo "<h1>Email Verification was successful</h1>";
            } else {
                echo "Email verification failed";
            }
        } else {
            echo "Invalid varification token";
        }
    } else {
        echo "Error: No token available";
    }
?>