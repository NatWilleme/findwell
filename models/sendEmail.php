<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require_once("vendor/autoload.php");

$mail = new PHPMailer(true);

try{
    $mail->isSMTP();
    $mail->Host = 'mail51.lwspanel.com';
    $mail->Port = 587;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->SMTPAuth = true;
    $mail->Username = "noreply@findwell.be";
    $mail->Password = "dF4-zZ8f$4TsSJ-";


    $mail->setFrom("noreply@findwell.be", 'FindWell');
    $mail->addAddress($mailTo);

    $mail->Subject = $object;
    $mail->isHTML(true);
    $mail->CharSet = 'UTF-8';
    $templateMail = file_get_contents('templates/templateEmail.html', true);
    $templateMail = str_replace('${CONTENT}', $content, $templateMail);

    $mail->Body = $templateMail;
    $mail->send();
} catch(Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>