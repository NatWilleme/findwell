<?php
session_start();
require_once('../models/models/category.php');
require_once('../models/dao/categoriesManager.php');

$category = $_GET['category'];
$_SESSION['category'] = $category;
displayCategoriesAccordingTo($category);

function displayCategoriesAccordingTo($category){
    $categories = categoriesManager::getAllSubcategoriesFor($category);
    require_once('../views/view_categoriesList.php');
}

?>