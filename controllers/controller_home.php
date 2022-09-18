<?php

function homePage($notification) {
    $ads = adsManager::getAdsToDisplay();
    $lastAddedCompanies = CompaniesManager::getLastAddedCompanies();
    if(isset($_SESSION['category'])){
        unset($_SESSION['category']);
    }
    if(isset($_SESSION['subcategory'])){
        unset($_SESSION['subcategory']);
    }
    displayHome($ads, $notification, $lastAddedCompanies);
}

?>