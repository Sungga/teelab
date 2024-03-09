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
    session_start();
    echo "Địa chỉ URL hiện tại: " . $_SERVER['REQUEST_URI'];
    echo "<pre>";
    print_r($_SESSION['filterSize']);
    echo "<pre>";
    print_r($_SESSION['filterColor']);
    echo "<pre>";
    print_r($_SESSION['filterRange']);

    if($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<pre>";
        print_r($_POST['a']);
    }

    $a = 'a';
    $a .= ' b';
    echo $a;
?>

<?php
// $a = 5678945;

// // Chuyển đổi số thành định dạng tiền tệ VND
// $a_formatted = number_format($a, 0, ',', '.');

// // Hiển thị kết quả
// echo $a_formatted . ' VND';
?>
<form action="" method="POST">
    <!-- <input type="text" name="b"> -->
    <input type="checkbox" name="a[]" id="" value="c">
    <input type="checkbox" name="a[]" id="" value="b">
    <input type="submit" value="ấn">
</form>