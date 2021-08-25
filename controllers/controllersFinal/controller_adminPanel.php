<?php

function addAd(){
    $newAd = new Ad();
    $newAd->__set('id_comp', $_POST['company']);
    $from = $_FILES['image']['tmp_name'];
    $path = $_FILES['image']['name'];
    //get the extension of file
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $files = scandir('../images/upload/advertising/');
    $cptImage = count($files)-1;
    $to = '../images/upload/advertising/ad_'.$cptImage.'.'.$ext;
    move_uploaded_file($from,$to);
    $newAd->__set('image',$to);
    $newAd->__set('display', $_POST['display']);
    adsManager::addAd($newAd);
    unset($newAd);
}

function editAd(){
    $newAd = new Ad();
    $newAd->__set('id', $_POST['idToEdit']);
    $newAd->__set('id_comp', $_POST['company']);
    $newAd->__set('display', $_POST['display']);
    if(!empty($_FILES['image']['name'])){
        $from = $_FILES['image']['tmp_name'];
        $path = $_FILES['image']['name'];
        //get the extension of file
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $files = scandir('../images/upload/advertising/');
        $cptImage = count($files)-1;
        $to = '../images/upload/advertising/ad_'.$cptImage.'.'.$ext;
        move_uploaded_file($from,$to);
        $newAd->__set('image',$to);
    } else {
        $newAd->__set('image',$_POST['imageOld']);
    }
    adsManager::updateAd($newAd);
}

function editUser(){
    $newUser = new User();
    $newUser->__set('id', $_POST['idToEdit']);
    $newUser->__set('username', $_POST['username']);
    $newUser->__set('phone', $_POST['phone']);
    $newUser->__set('street', $_POST['street']);
    $newUser->__set('number', $_POST['number']);
    $newUser->__set('city', $_POST['city']);
    $newUser->__set('zip', $_POST['zip']);
    $newUser->__set('type', $_POST['type']);
    $newUser->__set('image', $_SESSION['user']->image);
    usersManager::updateUser($newUser);
}

function editCompany()
{
    $newCompany = new Company();
    $newCompany->__set('id', $_POST['idCompany']);
    $newCompany->__set('name', $_POST['name']);
    $newCompany->__set('phone', $_POST['phone']);
    $newCompany->__set('description', $_POST['description']);
    $newCompany->__set('hours', $_POST['hours']);
    $newCompany->__set('street', $_POST['street']);
    $newCompany->__set('number', $_POST['number']);
    $newCompany->__set('city', $_POST['city']);
    $newCompany->__set('postalCode', $_POST['zip']);
    $newCompany->__set('certified', $_POST['certified']);
    $newCompany->__set('image', $_POST['image']);
    companiesManager::updateCompany($newCompany);
    
}

function getCompanyToEdit(){
    return companiesManager::getOneCompany($_GET['edit']);
}

function getAllActiveCompanyWithRatingAndCommentCount(){
    $companies = companiesManager::getAllActiveCompanies();
    foreach ($companies as $company) {
        $company->__set('rating', number_format(commentsManager::getRatingForCompany($company->id)['rate']) );
        $company->countComment = count(commentsManager::getCommentsForACompany($company->id));
    }
    return $companies;
}

function getUserToEdit(){
    return usersManager::getUserByID($_GET['edit']);
}

function getAllUsers(){
    return usersManager::getAllUser();
}

function getAllAdsWithCompanyName(){
    $ads = adsManager::getAllAds();
    foreach ($ads as $ad) {
        $ad->name_comp = companiesManager::getOneCompany($ad->id_comp)->name;
    }
    return $ads;
}

function confirmCompany(){
    $idCompany = $_GET['accept'];
    companiesManager::confirmCompany($idCompany);
}

function deleteCompany(){
    $idCompany = $_GET['delete'];
    companiesManager::deleteCompany($idCompany);
}

function getCompanyToConfirm(){
    $idCompany = $_GET['see'];
    $companyToConfirm = companiesManager::getOneCompany($idCompany);
    $domaines = categoriesManager::getAllDomainesForCompany($idCompany);
    $domainesAsString = "";
    if(sizeof($domaines) != 0){
        foreach ($domaines as $domaine) {
            $domainesAsString .= $domaine;
            $domainesAsString .= ", ";
        }
        $domainesAsString = substr($domainesAsString,0,-2);
        $domainesAsString .= '.';
    } 
    
    $companyToConfirm->__set('domaines', $domainesAsString); 
    return $companyToConfirm;
}










// if(isset($_POST['action'])){
//     if($_POST['action'] == "addAd"){
//         addAd();
//     } else if($_POST['action'] == "editAd"){
//         editAd();
//     } else if($_POST['action'] == "editUser"){
//         editUser();
//     }
// }

// if(isset($_GET['view'])){
//     if($_GET['view'] == "companies"){
//         if(isset($_GET['delete'])){
//             deleteCompany();
//         } else if(isset($_GET['edit'])) {
//             $companyToEdit = getCompanyToEdit();
//         } else {
//             $companies = getAllActiveCompanyWithRatingAndCommentCount();
//         }   

//     } else if($_GET['view'] == "users"){

//         if(isset($_GET['edit'])) {
//             $userToEdit = getUserToEdit();
//         } else {
//             $users = getAllUsers();
//         }

//     } else if($_GET['view'] == "ads") {
//         if((isset($_GET['action']) && $_GET['action'] == "add") || (isset($_GET['edit']))){
//             $companies = companiesManager::getAllActiveCompanies();
//             $action = true;
//             if(isset($_GET['edit'])){
//                 $adToEdit = adsManager::getAd($_GET['edit']);
//             }
//         }
//         if(isset($_GET['delete'])){
//             adsManager::deleteAd($_GET['delete']);
//         }
//         $ads = adsManager::getAllAds();
//         foreach ($ads as $ad) {
//             $ad->name_comp = companiesManager::getOneCompany($ad->id_comp)->name;
//         }
//     } else if($_GET['view'] == "companiesNotCertified"){

//         if(isset($_GET['accept'])){
//             confirmCompany();
//             $companiesToBeConfirmed = companiesManager::getAllCompaniesToBeConfirmed();
//         } else if(isset($_GET['delete'])) {
//             deleteCompany();
//             $companiesToBeConfirmed = companiesManager::getAllCompaniesToBeConfirmed();
//         } else if(isset($_GET['see'])) {
//             $companyToConfirm = getCompanyToConfirm();
//         }
//     }
// }

// if($_SESSION['user']->type == "admin")
//     require_once('../views/view_adminPanel.php');
// else
//     require_once('../controllers/controller_home.php');




    
?>