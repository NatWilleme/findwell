<?php
require_once('../models/models/user.php');
require_once('../models/models/company.php');
require_once('../models/dao/usersManager.php');
require_once('../models/dao/companiesManager.php');

if(session_status() != PHP_SESSION_ACTIVE)
    session_start();

$user = UsersManager::getUser($_SESSION['user']->mail);
if($user->type == "company")
    $company = companiesManager::getOneCompanyByMail($_SESSION['user']->mail);
if(isset($_POST['submit'])){
    if($_POST['submit'] == "update"){
        $userToEdit = new User();
        $userToEdit->__set("id", $user->id);
        $userToEdit->__set("username", $_POST['username']);
        $userToEdit->__set("username", $_POST['username']);
        $userToEdit->__set("phone", $_POST['phone']);
        if(!empty($_FILES['image']['name'])){
            $from = $_FILES['image']['tmp_name'];
            $path = $_FILES['image']['name'];
            //get the extension of file
            $ext = pathinfo($path, PATHINFO_EXTENSION);
            $files = scandir('../images/upload/photos_profils/');
            $cptImage = count($files)-1;
            $to = '../images/upload/photos_profils/profil'.$cptImage.'.'.$ext;
            move_uploaded_file($from,$to);
            $userToEdit->__set('image',$to);
        } else {
            $userToEdit->__set('image',$_POST['imageOld']);
        }
        if($_POST['number'] == "")
            $userToEdit->__set("number", NULL);
        else
            $userToEdit->__set("number", $_POST['number']);
        $userToEdit->__set("street", $_POST['street']);
        $userToEdit->__set("city", $_POST['city']);
        $userToEdit->__set("state", $_POST['state']);
        $userToEdit->__set("zip", $_POST['zip']);
        $userToEdit->__set("phone", $_POST['phone']);
        UsersManager::updateUser($userToEdit);
        $user = UsersManager::getUser($_SESSION['user']->mail);
        $alert['color'] = "success";
        $alert['message'] = "Vos informations ont été mise à jour.";
        unset($_POST['submit']);
        require_once("../views/view_editProfil.php");
    } else {
        require_once("../views/view_editProfil.php");
    }
} else {
    require_once("../views/view_editProfil.php");
}


?>