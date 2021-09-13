<?php

function sendContactMail()
{
    $mailTo = "contact@findwell.be";
    $object = $_POST['subject'];
    $content = "Vous avez un nouveau message de : ". $_POST['mail']. "<br><i>";
    $content .= $_POST['message']. "</i>";
    require "models/SendEmail.php";
}

?>