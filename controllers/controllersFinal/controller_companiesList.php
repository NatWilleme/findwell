<?php

function cmpRating($object1, $object2) {
    return $object1->rating < $object2->rating ? 1 : 0;
}

function cmpDistance($object1, $object2) {
    return $object1->distance > $object2->distance ? 1 : 0;
}

function displayCompaniesAccordingTo($category, $subcategory){
    $notification = sizeof(companiesManager::getAllCompaniesToBeConfirmed());
    $companies = CompaniesManager::getAllCompaniesAccordingTo($category, $subcategory);
    if(!isset($_POST['location']) || $_POST['location'] == ""){
        $userAddress = null;
    } else {
        $userAddress = $_POST['location'];
    }
    foreach ($companies as $company) {
        $companyAddress = $company->number.' '.$company->street.', '.$company->postalCode.' '.$company->city;
        if(isset($_SESSION['distanceCompanies'][$company->id])){
            $company->distance = $_SESSION['distanceCompanies'][$company->id];
        } else if($userAddress == null){
            $company->distance = null;
        } else {
            $companyAddress = $company->number.' '.$company->street.', '.$company->postalCode.' '.$company->city;
            $company->distance = getDistance($userAddress, $companyAddress, $unit = 'K');
            $_SESSION['distanceCompanies'][$company->id] = $company->distance;
        }
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
    if(!isset($_POST['sort']) || $_POST['sort'] == "note"){
        usort($companies, 'cmpRating');
    } else {
        usort($companies, 'cmpDistance');
    }
    displayCompaniesList($companies, $notification);
}


?>