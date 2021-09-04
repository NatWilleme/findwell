<?php

function registerNewUser($newUser){
    $user = UsersManager::checkIfExist($newUser->mail);
    if($user['count'] == 0){
        $state = UsersManager::addUser($newUser);
        if($state){
            $alert['color'] = "success";
            $alert['message'] = "Vérifier vos mails afin de finaliser votre inscription.";
        } else{
            $alert['color'] = "danger";
            $alert['message'] = "Votre insription a échoué.";
        }
    } else{
        $alert['color'] = "danger";
        $alert['message'] = "Un compte avec cette adresse mail existe déjà.";
    }
    return $alert;
}

function registerNewCompany($newUser, $newCompany){
    $user = UsersManager::checkIfExist($newUser->mail);
    if($user['count'] == 0){
        $operationSuccess1 = UsersManager::addUser($newUser);
        $operationSuccess2 = companiesManager::addCompany($newCompany);
        if($operationSuccess1 && $operationSuccess2){
            $alert['color'] = "success";
            $alert['message'] = "Vérifier vos mails afin de finaliser votre inscription.";
        } else{
            $alert['color'] = "danger";
            $alert['message'] = "Votre insription a échoué.";
        }
    } else{
        $alert['color'] = "danger";
        $alert['message'] = "Un compte avec cette adresse mail existe déjà.";
    }
    displayConnexion($alert);
}

function connectUser($mail, $password){
    $user = UsersManager::checkIfExist($mail);
    if($user['count'] == 1){
        $user = UsersManager::getUser($mail);
        if($user->mail == $mail && password_verify($password, $user->password) && $user->confirmed == 1){
            $_SESSION['user'] = $user;
            setcookie("userConnected", "1",time()+1*24*60*60,"/",$_SERVER['SERVER_NAME']);
            $_COOKIE['userConnected'] = "1";
            return true;
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function checkIfUserExist($mail)
{
    return UsersManager::checkIfExist($mail);
}

function prepareNewUser($mail, $password)
{
    $_SESSION['newUser'] = new User();
    $_SESSION['newUser']->__set('mail', $mail);
    $_SESSION['newUser']->__set('password', $password);
}

function sendConfirmationMail()
{
    $content = "Merci de confirmer votre inscription à Findwell en cliquant sur le lien ci-dessous.<br><a href=\"findwell/index.php?idUserToConfirm=".$_SESSION['newUser']->id."&code=".$_SESSION['newUser']->code."\">Cliquez ici pour confirmer votre compte</a>";
    $object = "Finalisation de l'inscription";
    $mailTo = $_SESSION['newUser']->mail;
    require_once('models/sendEmail.php');
}

function saveNewCompanySession()
{
    $_SESSION['newCompany'] = new Company();
    $_SESSION['newCompany']->__set('name', $_POST['name']);
    $_SESSION['newCompany']->__set('mail', $_SESSION['newUser']->mail);
    $_SESSION['newCompany']->__set('description', nl2br($_POST['description'], true));
    $_SESSION['newCompany']->__set('phone', $_POST['phone']);
    $_SESSION['newCompany']->__set('hours', nl2br($_POST['hours'], true));
    $_SESSION['newCompany']->__set('city', $_POST['city']);
    $_SESSION['newCompany']->__set('street', $_POST['street']);
    $_SESSION['newCompany']->__set('number', $_POST['number']);
    $_SESSION['newCompany']->__set('postalCode', $_POST['zip']);
    $_SESSION['newCompany']->__set('image', "");
    $_SESSION['newCompany']->__set('state', $_POST['state']);
    $_SESSION['newCompany']->__set('tva', $_POST['tva']);
}

function validUser($idUserToConfirm)
{
    usersManager::confirmUser($idUserToConfirm);
    $alert['color'] = "success";
    $alert['message'] = "Votre compte est maintenant activé, vous pouvez dès à présent vous connecter et remplir vos informations dans Mon profil > Mes informations";
    return $alert;
}

?>