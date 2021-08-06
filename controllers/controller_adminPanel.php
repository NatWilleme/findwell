<?php
require_once('../models/models/company.php');
require_once('../models/models/user.php');
require_once('../models/models/comment.php');
require_once('../models/models/ad.php');
require_once('../models/dao/companiesManager.php');
require_once('../models/dao/adsManager.php');
require_once('../models/dao/usersManager.php');
require_once('../models/dao/commentsManager.php');
if(session_status() != PHP_SESSION_ACTIVE)
    session_start();

if(isset($_POST['action'])){
    if($_POST['action'] == "addAd"){
        print_r($_POST);
        $newAd = new Ad();
        $newAd->__set('id_comp', $_POST['company']);
        $from = $_FILES['image']['tmp_name'];
        $to = '../images/upload/'.$_FILES['image']['name'];
        move_uploaded_file($from,$to);
        $newAd->__set('image',$to);
        $newAd->__set('display', $_POST['display']);
        adsManager::addAd($newAd);
        unset($newAd);
    } else if($_POST['action'] == "editAd"){
        $newAd = new Ad();
        $newAd->__set('id', $_POST['idToEdit']);
        $newAd->__set('id_comp', $_POST['company']);
        $newAd->__set('display', $_POST['display']);
        if(!empty($_FILES['image']['name'])){
            $from = $_FILES['image']['tmp_name'];
            $to = '../images/upload/'.$_FILES['image']['name'];
            move_uploaded_file($from,$to);
            $newAd->__set('image',$to);
        } else {
            $newAd->__set('image',$_POST['imageOld']);
        }
        adsManager::updateAd($newAd);
    } else if($_POST['action'] == "editUser"){
        print_r($_POST);
        $newUser = new User();
        $newUser->__set('id', $_POST['idToEdit']);
        $newUser->__set('username', $_POST['username']);
        $newUser->__set('phone', $_POST['phone']);
        $newUser->__set('street', $_POST['street']);
        $newUser->__set('number', $_POST['number']);
        $newUser->__set('city', $_POST['city']);
        $newUser->__set('zip', $_POST['zip']);
        $newUser->__set('type', $_POST['type']);
        usersManager::updateUser($newUser);
    }
}

if(isset($_GET['view'])){
    if($_GET['view'] == "companies"){

        if(isset($_GET['delete'])){
            companiesManager::deleteCompany($_GET['delete']);
        } else if(isset($_GET['edit'])) {
            $companyToEdit = companiesManager::getOneCompany($_GET['edit']);
        } else {
            $companies = companiesManager::getAllCompanies();
            foreach ($companies as $company) {
                $company->__set('rating', number_format(commentsManager::getRatingForCompany($company->id)['rate']) );
                $company->countComment = count(commentsManager::getCommentsForACompany($company->id));
            }
        }   

    } else if($_GET['view'] == "users"){

        if(isset($_GET['edit'])) {
            $userToEdit = usersManager::getUserByID($_GET['edit']);
        } else {
            $users = usersManager::getAllUser();
        }

    } else if($_GET['view'] == "ads") {
        if((isset($_GET['action']) && $_GET['action'] == "add") || (isset($_GET['edit']))){
            $companies = companiesManager::getAllCompanies();
            $action = true;
            if(isset($_GET['edit'])){
                $adToEdit = adsManager::getAd($_GET['edit']);
            }
        }
        if(isset($_GET['delete'])){
            adsManager::deleteAd($_GET['delete']);
        }
        $ads = adsManager::getAllAds();
        foreach ($ads as $ad) {
            $ad->name_comp = companiesManager::getOneCompany($ad->id_comp)->name;
        }
    }
}

if($_SESSION['user']->type == "admin")
    require_once('../views/view_adminPanel.php');
else
    require_once('../controllers/controller_home.php');

?>