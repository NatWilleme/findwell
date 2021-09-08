<?php

function AddOrRemoveFavorite($idCompany){
    CompaniesManager::editFavorite($idCompany, $_SESSION['user']->id);
}

function getMessageBtnToDisplay($idCompany)
{
    $idUser = $_SESSION['user']->id;
    $favoris = CompaniesManager::getAllFavoriteCompaniesFor($idUser);
    $cpt = $flag = 0;
    while ($flag == 0 && $cpt < sizeof($favoris)) {
        if($favoris[$cpt]->id == $idCompany) $flag = 1;
        $cpt++;
    }

    if($flag == 0) $messageBtn = "<i class=\"bi bi-suit-heart\"></i> Ajouter aux favoris";
    else $messageBtn = "<i class=\"bi bi-suit-heart-fill\"></i>Retirer des favoris";
    return $messageBtn;
}

function addComment($idCompany, $idUser)
{
    $newComment = new Comment();
    $newComment->__set('comment',$_POST['newComment']);
    if(isset($_FILES['img']) && $_FILES['img'] != ""){
        $from = $_FILES['img']['tmp_name'];
        $to = 'images/upload/'.$_FILES['img']['name'];
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

function getSuccessAlert()
{
    $alert['color'] = "success";
    $alert['message'] = "Votre commentaire a été publié.";
    return $alert;
}

function getFailAlert()
{
    $alert['color'] = "danger";
    $alert['message'] = "Veuillez compléter vos informations pour pouvoir ajouter un commentaire.";
    return $alert;
}

function prepareDisplayCompanyDetails($idCompany, $notification){
    $alert = '';
    if(isset($_COOKIE['userConnected']) && isset($_SESSION['user'])){
        $messageBtn = getMessageBtnToDisplay($idCompany);
    } else $messageBtn = "";
    $company = companiesManager::getOneCompany($idCompany);
    $rating = commentsManager::getRatingForCompany($idCompany);
    $comments = commentsManager::getCommentsForACompany($idCompany);
    $users = array();
    foreach ($comments as $comment) {
        $user = usersManager::getUserByID($comment->id_user);
        array_push($users,$user);
    }
    displayCompanyDetails($company, $rating, $comments, $messageBtn, $users, $alert, $notification);
}

?>