<?php
require_once('../models/models/category.php');
require_once('../models/models/user.php');
require_once('../models/models/company.php');
require_once('../models/dao/categoriesManager.php');
require_once('../models/dao/companiesManager.php');
if(session_status() != PHP_SESSION_ACTIVE)
    session_start();


$category = $_GET['category'];
$_SESSION['category'] = $category;
displayCategoriesAccordingTo($category);

function displayCategoriesAccordingTo($category){
    $notification = sizeof(companiesManager::getAllCompaniesToBeConfirmed());
    $categories = categoriesManager::getAllSubcategoriesFor($category);
    require_once('../views/view_categoriesList.php');
}

?>