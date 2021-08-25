<?php

function displayHome() {
    //notif à faire à chaque chargement de chaque page
    $notification = sizeof(companiesManager::getAllCompaniesToBeConfirmed());
    $ads = adsManager::getAdsToDisplay();
    if(isset($_SESSION['category'])){
        unset($_SESSION['category']);
    }
    if(isset($_SESSION['subcategory'])){
        unset($_SESSION['subcategory']);
    }
    require_once('views/view_Home.php');
}

function displayRegister($alert = '') {
    require_once('views/view_register.php');
}

function displayAdminPanel() {
    require_once('views/view_adminPanel.php');
}

function displayCategoriesList() {
    require_once('views/view_categoriesList.php');
}

function displayCompaniesList() {
    require_once('views/view_companiesList.php');
}

function displayCompanyDetails() {
    require_once('views/view_companyDetails.php');
}

function displayConnexion() {
    require_once('views/view_connexion.php');
}

function displayEditProfil() {
    require_once('views/view_editProfil.php');
}

function displayFavorites() {
    require_once('views/view_favorites.php');
}

function displaySearch() {
    require_once('views/view_search.php');
}

?>