<?php
require_once('../models/models/company.php');
require_once('../models/models/user.php');
require_once('../models/dao/companiesManager.php');
if(session_status() != PHP_SESSION_ACTIVE)
    session_start();
$notification = sizeof(companiesManager::getAllCompaniesToBeConfirmed());

$searchResult = companiesManager::searchCompany($_GET['company']);
require_once('../views/view_search.php');

?>