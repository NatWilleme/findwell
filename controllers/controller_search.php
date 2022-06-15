<?php



function getSearchResult()
{
    $searchResult['companies'] = companiesManager::searchCompany($_POST['company']);
    if($_POST['company'] != ""){
        if(isset($_SESSION['location'])){
            $userAddress = $_SESSION['location'];
        } else if(!isset($_POST['location']) || $_POST['location'] == ""){
            $userAddress = null;
        } else if(isset($_POST['location'])){
            $_SESSION['location'] = $_POST['location'];
            $userAddress = $_POST['location'];
        }
    }
   
    foreach ($searchResult['companies'] as $company) {
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
        if($_POST['company'] != ""){
            if(isset($_POST['city'])){
                $company->distance = getDistance($_POST['city'], $companyAddress, $unit = 'K');
            // } else if(isset($_SESSION['distanceCompanies'][$company->id])){
            //     $company->distance = $_SESSION['distanceCompanies'][$company->id];
            // } else if($userAddress == null){
            //     $company->distance = null;
            } else {
                $companyAddress = $company->number.' '.$company->street.', '.$company->postalCode.' '.$company->city;
                $company->distance = getDistance($userAddress, $companyAddress, $unit = 'K');
                $_SESSION['distanceCompanies'][$company->id] = $company->distance;
            }
        }
        

        $rate = commentsManager::getRatingForCompany($company->id);
        $company->__set('rating', $rate['rate']); 

        $domaines = categoriesManager::getAllDomainesForCompany($company->id);
        $domaines = array_unique($domaines);
        $domainesAsString = "";
        foreach ($domaines as $domaine) {
            $domainesAsString .= $domaine;
            $domainesAsString .= ", ";
        }
        $domainesAsString = substr($domainesAsString,0,-2);
        $domainesAsString .= '.';
        $company->__set('domaines', $domainesAsString);
    } 
    if((!isset($_POST['sort']) && !isset($_POST['city'])) || (isset($_POST['sort']) && $_POST['sort'] == "note")){
        usort($searchResult['companies'], 'cmpRating');
        $searchResult['sort'] = "note";
    } else {
        usort($searchResult['companies'], 'cmpDistance');
        $searchResult['sort'] = "distance";
    }

    return $searchResult;
}

function getAllCompanies(){
    $searchResult['companies'] = companiesManager::getAllActiveCompanies();
    if(!isset($_POST['location']) || $_POST['location'] == ""){
        $userAddress = null;
    } else {
        $userAddress = $_POST['location'];
    }
    foreach ($searchResult['companies'] as $company) {
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
        
        // if(isset($_POST['city'])){
        //     $company->distance = getDistance($_POST['city'], $companyAddress, $unit = 'K');
        // } else if(isset($_SESSION['distanceCompanies'][$company->id])){
        //     $company->distance = $_SESSION['distanceCompanies'][$company->id];
        // } else if($userAddress == null){
        //     $company->distance = null;
        // } else {
        //     $companyAddress = $company->number.' '.$company->street.', '.$company->postalCode.' '.$company->city;
        //     $company->distance = getDistance($userAddress, $companyAddress, $unit = 'K');
        //     $_SESSION['distanceCompanies'][$company->id] = $company->distance;
        // }

        $rate = commentsManager::getRatingForCompany($company->id);
        $company->__set('rating', $rate['rate']); 

        $domaines = categoriesManager::getAllDomainesForCompany($company->id);
        $domaines = array_unique($domaines);
        $domainesAsString = "";
        foreach ($domaines as $domaine) {
            $domainesAsString .= $domaine;
            $domainesAsString .= ", ";
        }
        $domainesAsString = substr($domainesAsString,0,-2);
        $domainesAsString .= '.';
        $company->__set('domaines', $domainesAsString);
    } 
    if((!isset($_POST['sort']) && !isset($_POST['city'])) || (isset($_POST['sort']) && $_POST['sort'] == "note")){
        usort($searchResult['companies'], 'cmpRating');
        $searchResult['sort'] = "note";
    } else {
        usort($searchResult['companies'], 'cmpDistance');
        $searchResult['sort'] = "distance";
    }

    return $searchResult;
}

?>