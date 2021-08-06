<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once 'vendor/autoload.php';

$mail = new PHPMailer(true);

try{
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->SMTPAuth = true;
    $mail->Username = $GLOBALS['MAIL_ADDRESS'];
    $mail->Password = $GLOBALS['MAIL_PASSWORD'];


    $mail->setFrom($GLOBALS['MAIL_ADDRESS'], 'IGForms 03');
    $mail->addAddress($mailDestination);

    $mail->Subject = $object;
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $templateMail = file_get_contents('templates/tempEmail.html', true);
    $templateMail = str_replace('${CONTENT}', $content, $templateMail);
    $templateMail = str_replace('${URL_FORM}', $url, $templateMail);

    $mail->Body = $templateMail;
    $mail->send();
} catch(Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>