<?php


use PHPMailer\PHPMailer\PHPMailer;
if(isset($_POST["name"]))
{
    $name=$_POST['name'];
    $email=$_POST['email'];
    $comment=$_POST['comment'];

    require_once "PHPMailer/PHPMailer.php";
    require_once "PHPMailer/SMTP.php";

    require_once "PHPMailer/Exception.php";


    $mail=new PHPMailer();

                            
$mail->isSMTP();                                    
$mail->Host = 'smtp.gmail.com'; 
$mail->SMTPAuth = true;                             
$mail->Username = 'kanagaroriri23@gmail.com';              
$mail->Password = 'kxce sdhv usbf mflz';                          
$mail->SMTPSecure = 'tls';                           
$mail->Port = 587;                                  

   
// $mail->addAddress('ellen@example.com');             
// $mail->addReplyTo('info@example.com', 'Information');
// $mail->addCC('cc@example.com');
// $mail->addBCC('bcc@example.com');

// $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);
$mail->setFrom($email);
$mail->addAddress('kanagaroriri23@gmail.com');                                   // Set email format to HTML

$mail->Subject = 'Sample Mail Test';
$mail->Body    = 'Name: '.  $name . 'Email: ' .$email . 'message'.$comment ;// whatever give it to to the  body will send it to the TO mail Address.......


if(!$mail->send()) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'Message has been sent';
}

}
?>