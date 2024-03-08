<?php
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require 'vender/PHPMailer/src/Exception.php';
// require 'vender/PHPMailer/src/PHPMailer.php';
// require 'vender/PHPMailer/src/SMTP.php';

// //Create an instance; passing `true` enables exceptions
// $mail = new PHPMailer(true);

// try {
//     //Server settings
//     // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
//     $mail->isSMTP();                                            //Send using SMTP
//     $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
//     $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
//     $mail->Username   = 'anhvu171003@gmail.com';                     //SMTP username
//     $mail->Password   = '@Anhvu00003';                               //SMTP password
//     $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
//     $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

//     //Recipients
//     $mail->setFrom('anhvu171003@gmail.com', 'Sungga');
//     $mail->addAddress('anhvu17003@gmail.com', 'Anh Vu');     //Add a recipient
//     // $mail->addAddress('ellen@example.com');               //Name is optional
//     // $mail->addReplyTo('info@example.com', 'Information');
//     // $mail->addCC('cc@example.com');
//     // $mail->addBCC('bcc@example.com');

//     //Attachments
//     // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
//     // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

//     //Content
//     $mail->isHTML(true);                                  //Set email format to HTML
//     $mail->Subject = 'Here is the subject';
//     $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
//     $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//     $mail->send();
//     echo 'Message has been sent';
// } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
// }
?>

<?php
    // if (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') {
    //     echo "Kết nối an toàn (HTTPS).";
    // } else {
    //     echo $_SERVER['HTTP'];
    // }

    echo "Địa chỉ URL hiện tại: " . $_SERVER['REQUEST_URI'];
?>
<form action="" method="GET">
    <input type="text">
    <input type="submit" value="ấn">
</form>