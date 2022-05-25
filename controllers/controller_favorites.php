<?php

function getFavoriteCompanies()
{
    $companies = CompaniesManager::getAllFavoriteCompaniesFor($_SESSION['user']->id);
    foreach ($companies as $company) {
        $rate = commentsManager::getRatingForCompany($company->id);
        $company->__set('rating', $rate['rate']); 

        $domaines = categoriesManager::getAllDomainesForCompany($company->id);
        $domainesAsString = "";
        if(sizeof($domaines) != 0){
            foreach ($domaines as $domaine) {
                $domainesAsString .= $domaine;
                $domainesAsString .= ", ";
            }
            $domainesAsString = substr($domainesAsString,0,-2);
            $domainesAsString .= '.';
        }
        $company->__set('domaines', $domainesAsString); 
        
    }
    return $companies;
}


?>