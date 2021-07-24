<?php
session_start();
require_once('../models/models/company.php');
require_once('../models/dao/companiesManager.php');
require_once('../models/dao/commentsManager.php');
require_once('../models/dao/categoriesManager.php');

$subcategory = $_GET['subcategory'];
$_SESSION['subcategory'] = $subcategory;
displayCompaniesAccordingTo($_SESSION['category'], $subcategory);

function displayCompaniesAccordingTo($category, $subcategory){
    $companies = CompaniesManager::getAllCompaniesAccordingTo($category, $subcategory);
    foreach ($companies as $company) {
        $rate = commentsManager::getRatingForCompany($company->id);
        $company->__set('rating', $rate['rate']); 

        $domaines = categoriesManager::getAllDomainesForCompany($company->id);
        $domainesAsString = "";
        foreach ($domaines as $domaine) {
            $domainesAsString .= $domaine;
            $domainesAsString .= ", ";
        }
        $domainesAsString = substr($domainesAsString,0,-2);
        $domainesAsString .= '.';
        $company->__set('domaines', $domainesAsString); 
        
    } 
    require_once('../views/view_companiesList.php');
}

?>