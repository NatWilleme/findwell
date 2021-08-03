<?php
require_once('../models/models/user.php');
require_once('../models/dao/usersManager.php');
if(session_status() != PHP_SESSION_ACTIVE)
    session_start();

if(isset($_POST['submitRegister'])){
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    registerNewUser($mail, $password);
} else if(isset($_POST['submitConnexion'])){
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    connectUser($mail, $password);
} else if(isset($_GET['disconnect'])){
    unset($_COOKIE['userConnected']);
    setcookie('userConnected', '', time() - 3600, '/');
    require_once('../views/view_Home.php');
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
            $_SESSION['user'] = $user;
            setcookie("userConnected", "1",time()+1*24*60*60,"/",$_SERVER['SERVER_NAME']);
            $_COOKIE['userConnected'] = "1";
            require_once('../views/view_Home.php');
        } else {
            $alert['color'] = "danger";
            $alert['message'] = "Échec de connexion. Vérifiez vos identifiants";
            require_once('../views/view_connexion.php');
        }
    } else {
        require_once('../views/view_connexion.php');
    }
}



?>