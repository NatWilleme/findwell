<?php
session_start();
require_once('../models/models/company.php');
require_once('../models/models/comment.php');
require_once('../models/models/user.php');
require_once('../models/dao/companiesManager.php');
require_once('../models/dao/commentsManager.php');
require_once('../models/dao/categoriesManager.php');
require_once('../models/dao/usersManager.php');

$idCompany = $_GET["idCompany"];
displayCompanyDetails($idCompany);

function displayCompanyDetails($idCompany){
    $company = companiesManager::getOneCompany($idCompany);
    $rating = commentsManager::getRatingForCompany($idCompany);
    $comments = commentsManager::getCommentsForACompany($idCompany);
    $users = array();
    foreach ($comments as $comment) {
        $user = usersManager::getOneUser($comment->id_user);
        array_push($users,$user);
    }
    require_once('../views/view_companyDetails.php');
}


?>