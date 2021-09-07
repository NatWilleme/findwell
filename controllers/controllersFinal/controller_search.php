<?php



function getSearchResult()
{
    $searchResult = companiesManager::searchCompany($_GET['company']);
    $userAddress = getUserAddress();
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
    usort($searchResult, 'cmp');
    return $searchResult;
}

?>