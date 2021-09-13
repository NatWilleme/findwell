<?php



function getSearchResult()
{
    $searchResult = companiesManager::searchCompany($_POST['company']);
    if(!isset($_POST['location']) || $_POST['location'] == ""){
        $userAddress = null;
    } else {
        $userAddress = $_POST['location'];
    }
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
    usort($searchResult, 'cmp');
    return $searchResult;
}

?>