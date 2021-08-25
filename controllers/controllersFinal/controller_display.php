<?php

function displayHome($ads, $notification) {
    require_once('views/viewFinal/view_Home.php');
}

function displayRegister($alert = '', $choice = '', $companyForm = '', $domainePage = '') {
    require_once('views/viewFinal/view_register.php');
}

function displayAdminPanel($companies, $companyToEdit, $companyToConfirm, $companiesToBeConfirmed, $ads, $adToEdit, $action, $users, $userToEdit, $notification) {
    require_once('views/viewFinal/view_adminPanel.php');
}

function displayCategoriesList($categories, $notification) {
    require_once('views/viewFinal/view_categoriesList.php');
}

function displayCompaniesList($companies, $notification) {
    require_once('views/viewFinal/view_companiesList.php');
}

function displayCompanyDetails($company, $rating, $comments, $messageBtn, $users, $alert, $notification) {
    require_once('views/viewFinal/view_companyDetails.php');
}

function displayConnexion($alert) {
    require_once('views/viewFinal/view_connexion.php');
}

function displayEditProfil($alert, $user, $company, $notification) {
    require_once('views/viewFinal/view_editProfil.php');
}

function displayFavorites($companies, $notification) {
    require_once('views/viewFinal/view_favorites.php');
}

function displaySearch($searchResult, $notification) {
    require_once('views/viewFinal/view_search.php');
}

function displayTemplateConnected($title, $content, $notification){
    require_once('templates/templateFinal/templateConnected.php');
}

function displayTemplateNotConnected($title, $content){
    require_once('templates/templateFinal/templateNotConnected.php');
}

?>