<?php
require_once('../models/models/company.php');
require_once('../models/models/comment.php');
require_once('../models/models/user.php');
require_once('../models/dao/companiesManager.php');
require_once('../models/dao/commentsManager.php');
require_once('../models/dao/categoriesManager.php');
require_once('../models/dao/usersManager.php');
session_start();

if(isset($_GET['favorite'])){
    $idCompany = $_GET['favorite'];
    CompaniesManager::editFavorite($_GET['favorite'], $_SESSION['user']->id);
} else {
    $idCompany = $_GET["idCompany"];
}

if(isset($_COOKIE['userConnected'])){
    $idUser = $_SESSION['user']->id;
    $favoris = CompaniesManager::getAllFavoriteCompaniesFor($idUser);
    $cpt = $flag = 0;
    while ($flag == 0 && $cpt < sizeof($favoris)) {
        if($favoris[$cpt]->id == $idCompany) $flag = 1;
        $cpt++;
    }

    if($flag == 0) $messageBtn = "<i class=\"bi bi-suit-heart\"></i> Ajouter aux favoris";
    else $messageBtn = "<i class=\"bi bi-suit-heart-fill\"></i>Retirer des favoris";

    if(isset($_POST["submit"])){
        $newComment = new Comment();
        $newComment->__set('comment',$_POST['newComment']);
        if(isset($_FILES['img'])){
            $from = $_FILES['img']['tmp_name'];
            $to = '../images/upload/'.$_FILES['img']['name'];
            move_uploaded_file($from,$to);
            $newComment->__set('image',$to);
        } else {
            $newComment->__set('image',"");
        }
        $newComment->__set('rating',$_POST['rating']);
        $newComment->__set('date',date("Y-m-d"));
        $newComment->__set('id_comp',$idCompany);
        $newComment->__set('id_user',$idUser);
        commentsManager::addComment($newComment);
        unset($newComment);
    }

} else $messageBtn = "";


displayCompanyDetails($idCompany, $messageBtn);

function displayCompanyDetails($idCompany, $messageBtn){
    $company = companiesManager::getOneCompany($idCompany);
    $rating = commentsManager::getRatingForCompany($idCompany);
    $comments = commentsManager::getCommentsForACompany($idCompany);
    $users = array();
    foreach ($comments as $comment) {
        $user = usersManager::getUserByID($comment->id_user);
        array_push($users,$user);
    }
    
    require_once('../views/view_companyDetails.php');
}


?>