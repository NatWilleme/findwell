<?php

require_once('../models/models/user.php');
require_once('../models/models/company.php');
require_once('../models/models/category.php');
require_once('../models/dao/usersManager.php');
require_once('../models/dao/categoriesManager.php');
require_once('../models/dao/companiesManager.php');
if(session_status() != PHP_SESSION_ACTIVE)
    session_start();
$notification = sizeof(companiesManager::getAllCompaniesToBeConfirmed());

// Page 1 Inscription
if(isset($_POST['submitRegister'])){
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $user = UsersManager::checkIfExist($mail);
    if($user['count'] == 0){
        $_SESSION['newUser'] = new User();
        $_SESSION['newUser']->__set('mail', $mail);
        $_SESSION['newUser']->__set('password', $password);
        $choice = true;
        require_once('../views/view_register.php');
    } else{
        $alert['color'] = "danger";
        $alert['message'] = "Un compte avec cette adresse mail existe déjà.";
        require_once('../views/view_register.php');
    }
    
// Page 2 Choix du type d'utilisateur
} else if(isset($_POST['type'])){
    $_SESSION['newUser']->__set('code', uniqid());
    if($_POST['type'] == 'Utilisateur'){
        $_SESSION['newUser']->__set('type', 'user');
        registerNewUser($_SESSION['newUser']);
        $_SESSION['newUser'] = usersManager::getUser($_SESSION['newUser']->mail);
        $content = "Merci de confirmer votre inscription à Findwell en cliquant sur le lien ci-dessous.";
        $url = $_SERVER['SERVER_NAME']."/controllers/controller_login.php?idUserToConfirm=".$_SESSION['newUser']->id."&code=".$_SESSION['newUser']->code;
        $object = "Finalisation de l'inscription";
        require_once('../models/sendEmail.php');
    } else {
        $_SESSION['newUser']->__set('type', 'company');
        $companyForm = true;
        require_once('../views/view_register.php');  
    }
// Page 3 Inscription pour entreprise
} else if(isset($_POST['submitCompany'])){
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
    $domainePage = true;
    $categoriesGrosTravaux = categoriesManager::getAllSubcategoriesFor('Gros Travaux');
    $categoriesPetitsTravaux = categoriesManager::getAllSubcategoriesFor('Petits Travaux');
    $categoriesDepannage = categoriesManager::getAllSubcategoriesFor('Dépannage d\'urgence');
    require_once('../views/view_register.php'); 
    
} else if(isset($_POST['submitDomaine'])){  
    registerNewCompany($_SESSION['newUser'], $_SESSION['newCompany']);
    $company = companiesManager::getOneCompanyByMail($_SESSION['newCompany']->mail);
    if(isset($_POST['checkGros'])){
        foreach ($_POST['checkGros'] as $dom) {
            categoriesManager::addLinkCatComp($company->id, $dom);
        }
    }
    if(isset($_POST['checkPetits'])){
        foreach ($_POST['checkPetits'] as $dom) {
            categoriesManager::addLinkCatComp($company->id, $dom);
        }
    }
    if(isset($_POST['checkDepannage'])){
        foreach ($_POST['checkDepannage'] as $dom) {
            categoriesManager::addLinkCatComp($company->id, $dom);
        }
    }
    $_SESSION['newUser'] = usersManager::getUser($_SESSION['newUser']->mail);
    $content = "Merci de confirmer votre inscription à Findwell en cliquant sur le lien ci-dessous.";
    $url = $_SERVER['SERVER_NAME']."/controllers/controller_login.php?idUserToConfirm=".$_SESSION['newUser']->id."&code=".$_SESSION['newUser']->code;
    $object = "Finalisation de l'inscription";
    require_once('../models/sendEmail.php');
// Page Connexion
} else if(isset($_POST['submitConnexion'])){
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    connectUser($mail, $password);
// Page Déconnexion
} else if(isset($_GET['disconnect'])){
    unset($_COOKIE['userConnected']);
    setcookie('userConnected', '', time() - 3600, '/');
    session_destroy();
    require_once('../controllers/controller_home.php');
// Activation du compte
} else if (isset($_GET['idUserToConfirm'])) {
    $idUserToConfirm = $_GET['idUserToConfirm'];
    $code = $_GET['code'];
    $user = usersManager::getUserByID($idUserToConfirm);
    if($user->code == $code){
        usersManager::confirmUser($idUserToConfirm);
        $alert['color'] = "success";
        $alert['message'] = "Votre compte est maintenant activé, vous pouvez dès à présent vous connecter et remplir vos informations dans Mon profil > Mes informations";
        require_once('../views/view_connexion.php');
    }
}

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
    require_once('../views/view_register.php');
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
    require_once('../views/view_register.php');
}

function connectUser($mail, $password){
    $user = UsersManager::checkIfExist($mail);
    if($user['count'] == 1){
        $user = UsersManager::getUser($mail);
        if($user->mail == $mail && password_verify($password, $user->password) && $user->confirmed == 1){
            $_SESSION['user'] = $user;
            setcookie("userConnected", "1",time()+1*24*60*60,"/",$_SERVER['SERVER_NAME']);
            $_COOKIE['userConnected'] = "1";
            require_once('../controllers/controller_home.php');
        } else {
            $alert['color'] = "danger";
            $alert['message'] = "Échec de connexion. Vérifiez vos identifiants";
            require_once('../views/view_connexion.php');
        }
    } else {
        require_once('../controllers/controller_home.php');
    }
}


?>