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
        $operationSuccess1 = UsersManager::addUserWithFullInformation($newUser);
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
    $user = UsersManager::checkIfExist(strtolower($mail));
    if($user['count'] == 1){
        $user = UsersManager::getUser(strtolower($mail));
        if($user->mail == strtolower($mail) && password_verify($password, $user->password) && $user->confirmed == 1){
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
    $content = "Merci de confirmer votre inscription à Findwell en cliquant sur le lien ci-dessous.<br><a href=\"https://findwell.be/index.php?idUserToConfirm=".$_SESSION['newUser']->id."&code=".$_SESSION['newUser']->code."\">Cliquez ici pour confirmer votre compte</a>";
    $object = "Finalisation de l'inscription";
    $mailTo = $_SESSION['newUser']->mail;
    require_once('models/sendEmail.php');
}

function sendReinitialisationMail($mail, $code) {
    $content = "Une demande de réinitialisation a été demandée. Si vous n'êtes pas à l'origine de cette demande, ignorez ce mail.<br><a href='www.findwell.be/index.php?viewToDisplay=displayConnexion&newpwd=1&mail=$mail&code=$code' class='btn btn-primary'>Cliquez ici pour réinitialiser le mot de passe</a>";
    $object = "Findwell : Réinitialisation du mot de passe";
    $mailTo = $mail;
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
    $_SESSION['newCompany']->__set('web', $_POST['web']);
    $_SESSION['newCompany']->__set('postalCode', $_POST['zip']);
    if($_FILES['image']['name'] != ""){
        $from = $_FILES['image']['tmp_name'];
        $path = $_FILES['image']['name'];
        //get the extension of file
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $imageName = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
        $to = 'images/upload/photos_profils/' . $imageName;
        move_uploaded_file($from,$to);
        $_SESSION['newCompany']->__set('image',$to);
    }
    $_SESSION['newCompany']->__set('state', $_POST['state']);
    $_SESSION['newCompany']->__set('tva', $_POST['tva']);
}

function saveNewUserSession()
{
    $_SESSION['newUser']->__set('username', $_POST['name']);
    $_SESSION['newUser']->__set('phone', $_POST['phone']);
    $_SESSION['newUser']->__set('hours', nl2br($_POST['hours'], true));
    $_SESSION['newUser']->__set('city', $_POST['city']);
    $_SESSION['newUser']->__set('street', $_POST['street']);
    $_SESSION['newUser']->__set('number', $_POST['number']);
    $_SESSION['newUser']->__set('zip', $_POST['zip']);
    $_SESSION['newUser']->__set('image',$_SESSION['newCompany']->image);
    $_SESSION['newUser']->__set('state', $_POST['state']);
}

function validUser($idUserToConfirm)
{
    usersManager::confirmUser($idUserToConfirm);
    $alert['color'] = "success";
    $alert['message'] = "Votre compte est maintenant activé, vous pouvez dès à présent vous connecter et remplir vos informations dans Mon profil > Mes informations";
    return $alert;
}

?>