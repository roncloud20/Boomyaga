<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';

    $mail = new PHPMailer(true);

    try {
        // Server SMTP Settings
        $mail->isSMTP();
        $mail->Host = 'mail.roncloud.com.ng';
        $mail->SMTPAuth = true;
        $mail->Username = 'boomyaga@roncloud.com.ng';
        $mail->Password = 'boomyaga@24';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        // $mail->setFrom('boomyaga@roncloud.com.ng', "Boomyaga");
        // $mail->addAddress('okorov028@gmail.com', "Ifeanyi");

        // // Content
        // $mail->isHTML(true);
        // $mail->Subject = 'Boomyaga Test';
        // $mail->Body = 'Hello, it is just a test';
        // $mail->AltBody = 'Hello, it is just a test';
        // $mail->send();
        // echo 'Mail sent';
    } catch (\Exception $e) {
        echo "Mail not sent: {$mail->ErrorInfo}";
    }
?>