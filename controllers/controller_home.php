<?php

require_once('../models/models/ad.php');
require_once('../models/dao/adsManager.php');
if(session_status() != PHP_SESSION_ACTIVE)
    session_start();
    
$ads = adsManager::getAdsToDisplay();


require_once('../views/view_Home.php');


?>