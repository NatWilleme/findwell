<?php
session_start();
require_once('../models/models/company.php');
require_once('../models/models/comment.php');
require_once('../models/models/user.php');
require_once('../models/dao/companiesManager.php');
require_once('../models/dao/commentsManager.php');
require_once('../models/dao/categoriesManager.php');
require_once('../models/dao/usersManager.php');

if(isset($_GET['favorite'])){
    $idCompany = $_GET['favorite'];
    CompaniesManager::editFavorite($_GET['favorite'], unserialize($_COOKIE['userConnected'])->id);
} else {
    $idCompany = $_GET["idCompany"];
}

if(isset($_COOKIE['userConnected'])){
    $favoris = CompaniesManager::getAllFavoriteCompaniesFor(unserialize($_COOKIE['userConnected'])->id);
    $cpt = $flag = 0;
    while ($flag == 0 && $cpt < sizeof($favoris)) {
        if($favoris[$cpt]->id == $idCompany) $flag = 1;
        $cpt++;
    }

    if($flag == 0) $messageBtn = "<i class=\"bi bi-suit-heart\"></i> Ajouter aux favoris";
    else $messageBtn = "<i class=\"bi bi-suit-heart-fill\"></i>Retirer des favoris";

} else $messageBtn = "";


displayCompanyDetails($idCompany, $messageBtn);

function displayCompanyDetails($idCompany, $messageBtn){
    $company = companiesManager::getOneCompany($idCompany);
    $rating = commentsManager::getRatingForCompany($idCompany);
    $comments = commentsManager::getCommentsForACompany($idCompany);
    $users = array();
    foreach ($comments as $comment) {
        $user = usersManager::getUser($comment->id_user);
        array_push($users,$user);
    }
    require_once('../views/view_companyDetails.php');
}


?>