<?php
require_once('../models/models/user.php');
require_once('../models/dao/usersManager.php');

if(session_status() != PHP_SESSION_ACTIVE)
    session_start();

$user = UsersManager::getUser($_SESSION['user']->mail);
if(isset($_POST['submit'])){
    if($_POST['submit'] == "update"){
        $userToEdit = new User();
        $userToEdit->__set("id", $user->id);
        $userToEdit->__set("username", $_POST['username']);
        $userToEdit->__set("username", $_POST['username']);
        $userToEdit->__set("phone", $_POST['phone']);
        $userToEdit->__set("street", $_POST['street']);
        $userToEdit->__set("city", $_POST['city']);
        $userToEdit->__set("state", $_POST['state']);
        $userToEdit->__set("zip", $_POST['zip']);
        $userToEdit->__set("phone", $_POST['phone']);
        UsersManager::updateUser($userToEdit);
        $alert['color'] = "success";
        $alert['message'] = "Vos informations ont été mise à jour.";
        unset($_POST['submit']);
        require('./controller_editProfil.php');
    } else {
        require_once("../views/view_editProfil.php");
    }
} else {
    require_once("../views/view_editProfil.php");
}


?>