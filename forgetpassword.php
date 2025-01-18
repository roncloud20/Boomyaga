<?php
    $pagetitle = "Forget Password";
    require_once "assets/header.php";
    require_once "assets/mailer.php";

    $errorMsg = "";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1) {
            $verification_token = bin2hex(random_bytes(32));
            $stmt = $conn->prepare("UPDATE users SET verification_token = ? WHERE email = ?");
            $stmt->bind_param("ss", $verification_token, $email);
            // $stmt->execute();
            $verification_link = "http://localhost/boomyaga/resetpassword.php?token=$verification_token";
            if ($stmt->execute()) {
                $mail->setFrom('boomyaga@roncloud.com.ng', "Boomyaga Reset Password");
                $mail->addAddress($email);
                $mail->isHTML(true);
                $mail->Subject = 'Reset Password';
                $mail->Body = "<h1>Hello</h1> 
                <p>Please click on this link to Reset your password: <a href='$verification_link'>Reset Password</a></p>";
                $mail->AltBody = "Hello, Please click on this link to Reset your password: $verification_link";
                $mail->send();
                $errorMsg = "<span class='text-success'>Please check your mail to reset your password</span>";
            } else {
                $errorMsg = "<span class='text-danger'>Failed to reset password</span>";
            }

        } else {
            $errorMsg = "Invalid Email Address";
        }
    }

?>

<section class="vh-100 m-4">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="assets/boomyaga.png" class="img-fluid" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form method="post">
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <p class="lead fw-normal mb-0 me-3">Forget Password</p>
          </div>

          <div class="divider d-flex flex-column align-items-center my-4">
            <h1 class="text-danger"><?= $errorMsg; ?></h1>
          </div>

          <!-- Email input -->
          <div class="form-outline mb-4">
            <input type="email" id="form3Example3" class="form-control form-control-lg"
              placeholder="Enter a valid email address"  name="email" required/>
          </div>

          <div class="text-center text-lg-start mt-4 pt-2">
            <input type="submit" class="btn btn-primary btn-lg"
              style="padding-left: 2.5rem; padding-right: 2.5rem;" value="Reset Password"/>
            <p class="small fw-bold mt-2 pt-1 mb-0">Don't have an account? <a href="#!"
                class="link-danger">Register</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</section>
