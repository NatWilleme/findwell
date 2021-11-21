<?php

function displayHome($ads, $notification) {
    require_once('views/viewFinal/view_Home.php');
}

function displayRegister($alert = '', $choice = '', $companyForm = '', $domainePage = '') {
    require_once('views/viewFinal/view_register.php');
}

function displayAdminPanel($alert, $companies, $companyToEdit, $companyToConfirm, $companiesToBeConfirmed, $ads, $adToEdit, $action, $users, $userToEdit, $addNewCompany, $domainePage, $notification, $companyDomaines) {
    require_once('views/viewFinal/view_adminPanel.php');
}

function displayCategoriesList($categories, $notification) {
    require_once('views/viewFinal/view_categoriesList.php');
}

function displayCompaniesList($companies, $notification, $sort) {
    require_once('views/viewFinal/view_companiesList.php');
}

function displayAnnonce($notification, $categoriesServiceToDisplay = null, $occasions = null, $occasionToDisplay = null, $servicesToDisplay = null,
                        $serviceToDisplay = null, $categoriesMaterialsToDisplay = null, $addOccasion = null,
                        $addService = null, $categoriesService = null, $servicesOfUser = null, $occasionsOfUser = null, $serviceToEdit = null, $editPermission = null,
                        $occasionToEdit = null, $companiesMaterialToDisplay = null)
{
    require_once('views/viewFinal/view_annonce.php');
}

function displayCompanyDetails($company, $rating, $comments, $messageBtn, $users, $alert, $notification) {
    require_once('views/viewFinal/view_companyDetails.php');
}

function displayConnexion($alert, $forget = '', $newPwd = '') {
    require_once('views/viewFinal/view_connexion.php');
}

function displayEditProfil($alert, $user, $company, $notification, $changePwd = '') {
    require_once('views/viewFinal/view_editProfil.php');
}

function displayFavorites($companies, $notification) {
    require_once('views/viewFinal/view_favorites.php');
}

function displaySearch($searchResult, $notification) {
    require_once('views/viewFinal/view_search.php');
}

function displayTemplateConnected($title, $content, $notification, $scripts = ''){
    require_once('templates/templateFinal/templateConnected.php');
}

function displayTemplateNotConnected($title, $content, $scripts = ''){
    require_once('templates/templateFinal/templateNotConnected.php');
}

function displayPayment($notification){
    require_once('views/viewFinal/view_payment.php');
}

function displayContact($notification, $alert = ''){
    require_once('views/viewFinal/view_contact.php');
}

function displayAboutUs($notification){
    require_once('views/viewFinal/view_aboutUs.php');
}

function displayConfidential($notification){
    require_once('views/viewFinal/view_confidential.php');
}

function displayCGV($notification){
    require_once('views/viewFinal/view_cgv.php');
}

?>