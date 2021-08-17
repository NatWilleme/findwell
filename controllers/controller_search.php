<?php
require_once('../models/models/company.php');
require_once('../models/models/user.php');
require_once('../models/models/comment.php');
require_once('../models/models/category.php');
require_once('../models/dao/companiesManager.php');
require_once('../models/dao/categoriesManager.php');
require_once('../models/dao/commentsManager.php');
if(session_status() != PHP_SESSION_ACTIVE)
    session_start();

if(isset($_SESSION['category'])) 
    unset($_SESSION['category']);
if(isset($_SESSION['subcategory']))
    unset($_SESSION['subcategory']);
$notification = sizeof(companiesManager::getAllCompaniesToBeConfirmed());

$searchResult = companiesManager::searchCompany($_GET['company']);
foreach ($searchResult as $company) {
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
require_once('../views/view_search.php');

?>