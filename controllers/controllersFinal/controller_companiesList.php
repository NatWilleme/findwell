<?php

function cmp($object1, $object2) {
    return $object1->rating < $object2->rating ? 1 : 0;
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
    displayCompaniesList($companies, $notification);
}


?>