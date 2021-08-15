<?php
require_once('../models/models/company.php');
require_once('../models/models/user.php');
require_once('../models/dao/companiesManager.php');
require_once('../models/dao/commentsManager.php');
require_once('../models/dao/categoriesManager.php');
require_once('../models/geolocation.php');
if(session_status() != PHP_SESSION_ACTIVE)
    session_start();


$subcategory = $_GET['subcategory'];
$_SESSION['subcategory'] = $subcategory;
displayCompaniesAccordingTo($_SESSION['category'], $subcategory);

// TEST DE GEOLOCALISATION

// $addressFrom = "92, rue du butia, 6183 Trazegnies";
// $addressTo = "60, rue de gosselies, 6183 Trazegnies";
// echo getDistance($addressFrom, $addressTo, $unit = 'K');

//FIN DU TEST DE GEOLOCALISATION


function cmp($object1, $object2) {
    return $object1->distance > $object2->distance ? 1 : 0;
}

function displayCompaniesAccordingTo($category, $subcategory){
    $notification = sizeof(companiesManager::getAllCompaniesToBeConfirmed());
    $companies = CompaniesManager::getAllCompaniesAccordingTo($category, $subcategory);
    $userAddress = getUserAddress();
    foreach ($companies as $company) {
        $companyAddress = $company->number.' '.$company->street.', '.$company->postalCode.' '.$company->city;
        $company->distance = getDistance($userAddress, $companyAddress, $unit = 'K');
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
    usort($companies, 'cmp');
    require_once('../views/view_companiesList.php');
}


?>