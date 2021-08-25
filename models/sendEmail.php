<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once("vendor/autoload.php");

$mail = new PHPMailer(true);

try{
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->SMTPAuth = true;
    $mail->Username = "nathanwilleme@gmail.com";
    $mail->Password = "AzE602573";


    $mail->setFrom("nathanwilleme@gmail.com", 'FindWell');
    $mail->addAddress($_SESSION['newUser']->mail);

    $mail->Subject = $object;
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $templateMail = file_get_contents('templates/templateEmail.html', true);
    $templateMail = str_replace('${CONTENT}', $content, $templateMail);
    $templateMail = str_replace('${URL_FORM}', $url, $templateMail);

    $mail->Body = $templateMail;
    $mail->send();
} catch(Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>