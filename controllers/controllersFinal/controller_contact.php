<?php

function sendContactMail()
{
    $mailTo = "contact@findwell.be";
    $object = $_POST['subject'];
    $content = "Vous avez un nouveau message de : ". $_POST['mail']. "<br><i>";
    $content .= $_POST['message']. "</i>";
    require "models/sendEmail.php";
}

function sendContactBugMail()
{
    $mailTo = "nathanwilleme@gmail.com";
    $object = "BUG FINDWELL";
    $content = "Vous avez un nouveau message de : ". $_POST['mail']. "<br><i>";
    $content .= $_POST['message']. "</i>";
    require "models/sendEmail.php";
}


?>