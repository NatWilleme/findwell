<?php

require_once('../models/models/ad.php');
require_once('../models/models/user.php');
require_once('../models/dao/adsManager.php');
if(session_status() != PHP_SESSION_ACTIVE)
    session_start();
    
$ads = adsManager::getAdsToDisplay();
if(isset($_SESSION['category'])){
    unset($_SESSION['category']);
}
if(isset($_SESSION['subcategory'])){
    unset($_SESSION['subcategory']);
}

require_once('../views/view_Home.php');


?>