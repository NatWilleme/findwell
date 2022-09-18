<?php

function displayHome($ads, $notification, $lastAddedCompanies) {
    require_once('views/view_Home.php');
}

function displayRegister($alert = '', $choice = '', $companyForm = '', $domainePage = '') {
    require_once('views/view_register.php');
}

function displayAdminPanel($alert = null, $companies = null, $companyToEdit = null, $companyToConfirm = null, $companiesToBeConfirmed = null, $ads = null, 
                           $adToEdit = null, $action = null, $users = null, $userToEdit = null, $addNewCompany = null, $domainePage = null, $notification = null, 
                           $companyDomaines = null, $missionsToBeAccepted = null, $missionsAccepted = null, $popups = null, $displayAddPopup = null, $popupToEdit = null) {
    require_once('views/view_adminPanel.php');
}

function displayCategoriesList($categories, $notification) {
    require_once('views/view_categoriesList.php');
}

function displayCompaniesList($companies, $notification, $sort) {
    require_once('views/view_companiesList.php');
}

function displayAnnonce($notification, $categoriesServiceToDisplay = null, $occasions = null, $occasionToDisplay = null, $servicesToDisplay = null,
                        $serviceToDisplay = null, $categoriesMaterialsToDisplay = null, $addOccasion = null,
                        $addService = null, $categoriesService = null, $servicesOfUser = null, $occasionsOfUser = null, $serviceToEdit = null, $editPermission = null,
                        $occasionToEdit = null, $companiesMaterialToDisplay = null, $addMission = null, $missionsToDisplay = null, $missionToDisplay = null, $missionToEdit = null,
                        $missionsOfUser = null)
{
    require_once('views/view_annonce.php');
}

function displayCompanyDetails($company, $rating, $comments, $messageBtn, $users, $alert, $notification) {
    require_once('views/view_companyDetails.php');
}

function displayConnexion($alert, $forget = '', $newPwd = '') {
    require_once('views/view_connexion.php');
}

function displayEditProfil($alert, $user, $company, $notification, $changePwd = '') {
    require_once('views/view_editProfil.php');
}

function displayFavorites($companies, $notification) {
    require_once('views/view_favorites.php');
}

function displaySearch($searchResult, $notification) {
    require_once('views/view_search.php');
}

function displayTemplateConnected($title, $content, $notification, $scripts = ''){
    require_once('templates/templateConnected.php');
}

function displayTemplateNotConnected($title, $content, $scripts = ''){
    if(!isset($_SESSION['categoriesTemplate'])){
        $_SESSION['categoriesTemplate']['Gros Travaux'] = getCategoriesToDisplay("Gros Travaux");
        $_SESSION['categoriesTemplate']['Petits Travaux'] = getCategoriesToDisplay("Petits Travaux");
        $_SESSION['categoriesTemplate']['Service'] = getCategoriesToDisplay("Service");
    }
    require_once('templates/templateNotConnected.php');
}

function displayPayment($notification){
    require_once('views/view_payment.php');
}

function displayContact($notification, $alert = ''){
    require_once('views/view_contact.php');
}

function displayContactBug($notification, $alert = ''){
    require_once('views/view_contactBug.php');
}

function displayAboutUs($notification){
    require_once('views/view_aboutUs.php');
}

function displayConfidential($notification){
    require_once('views/view_confidential.php');
}

function displayCGV($notification){
    require_once('views/view_cgv.php');
}

?>