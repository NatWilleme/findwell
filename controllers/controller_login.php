<?php
require_once('../models/models/user.php');
require_once('../models/dao/usersManager.php');

if(isset($_POST['submitRegister'])){
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    registerNewUser($mail, $password);
} else if(isset($_POST['submitConnexion'])){
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    connectUser($mail, $password);
}

function registerNewUser($mail, $password){
    $user = UsersManager::checkIfExist($mail);
    if($user['count'] == 0){
        $newUser = new User();
        $newUser->__set('mail', $mail);
        $newUser->__set('password', $password);
        $state = UsersManager::addUser($newUser);
        if($state){
            $alert['color'] = "success";
            $alert['message'] = "Vous êtes maintenant inscrit.";
        } else{
            $alert['color'] = "danger";
            $alert['message'] = "Votre insription a échoué.";
        }
    } else{
        $alert['color'] = "danger";
        $alert['message'] = "Un compte avec cette adresse mail existe déjà.";
    }
    require_once('../views/view_register.php');
}

function connectUser($mail, $password){
    $user = UsersManager::checkIfExist($mail);
    if($user['count'] == 1){
        $user = UsersManager::getUser($mail);
        if($user->mail == $mail && password_verify($password, $user->password)){
            setcookie("userConnected", serialize($user),time()+1*24*60*60,"/",$_SERVER['SERVER_NAME']);
            require_once('../views/view_Home.php');
        } else {
            require_once('../views/view_connexion.php');
        }
    } else {
        require_once('../views/view_connexion.php');
    }
}



?>