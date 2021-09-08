<?php

function addAd(){
    $newAd = new Ad();
    $newAd->__set('id_comp', $_POST['company']);
    $from = $_FILES['image']['tmp_name'];
    $path = $_FILES['image']['name'];
    //get the extension of file
    $ext = pathinfo($path, PATHINFO_EXTENSION);
    $files = scandir('../images/upload/advertising/');
    $cptImage = count($files)-1;
    $to = '../images/upload/advertising/ad_'.$cptImage.'.'.$ext;
    move_uploaded_file($from,$to);
    $newAd->__set('image',$to);
    $newAd->__set('display', $_POST['display']);
    adsManager::addAd($newAd);
    unset($newAd);
}

function editAd(){
    $newAd = new Ad();
    $newAd->__set('id', $_POST['idToEdit']);
    $newAd->__set('id_comp', $_POST['company']);
    $newAd->__set('display', $_POST['display']);
    if(!empty($_FILES['image']['name'])){
        $from = $_FILES['image']['tmp_name'];
        $path = $_FILES['image']['name'];
        //get the extension of file
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $files = scandir('../images/upload/advertising/');
        $cptImage = count($files)-1;
        $to = '../images/upload/advertising/ad_'.$cptImage.'.'.$ext;
        move_uploaded_file($from,$to);
        $newAd->__set('image',$to);
    } else {
        $newAd->__set('image',$_POST['imageOld']);
    }
    adsManager::updateAd($newAd);
}

function editUser(){
    $newUser = new User();
    $newUser->__set('id', $_POST['idToEdit']);
    $newUser->__set('username', $_POST['username']);
    $newUser->__set('phone', $_POST['phone']);
    $newUser->__set('street', $_POST['street']);
    $newUser->__set('number', $_POST['number']);
    $newUser->__set('city', $_POST['city']);
    $newUser->__set('zip', $_POST['zip']);
    $newUser->__set('type', $_POST['type']);
    $newUser->__set('image', $_SESSION['user']->image);
    usersManager::updateUser($newUser);
}

function editCompany()
{
    $newCompany = new Company();
    $newCompany->__set('id', $_POST['idCompany']);
    $newCompany->__set('name', $_POST['name']);
    $newCompany->__set('phone', $_POST['phone']);
    $newCompany->__set('description', $_POST['description']);
    $newCompany->__set('hours', $_POST['hours']);
    $newCompany->__set('street', $_POST['street']);
    $newCompany->__set('number', $_POST['number']);
    $newCompany->__set('city', $_POST['city']);
    $newCompany->__set('postalCode', $_POST['zip']);
    $newCompany->__set('certified', $_POST['certified']);
    $newCompany->__set('hasPaid', $_POST['hasPaid']);
    $newCompany->__set('image', $_POST['image']);
    companiesManager::updateCompany($newCompany);
    $company = companiesManager::getOneCompany($newCompany->id);
    if($newCompany->certified != $company->certified){
        companiesManager::switchConfirmCompany($company->id);
    }
    if($newCompany->hasPaid != $company->hasPaid){
        companiesManager::switchCompanyPaid($company->id);
    }
    
}

function getCompanyToEdit(){
    return companiesManager::getOneCompany($_GET['edit']);
}

function getAllActiveCompanyWithRatingAndCommentCount(){
    $companies = companiesManager::getAllActiveCompanies();
    foreach ($companies as $company) {
        $company->__set('rating', number_format(commentsManager::getRatingForCompany($company->id)['rate']) );
        $company->countComment = count(commentsManager::getCommentsForACompany($company->id));
    }
    return $companies;
}

function getUserToEdit(){
    return usersManager::getUserByID($_GET['edit']);
}

function getAllUsers(){
    return usersManager::getAllUser();
}

function getAllAdsWithCompanyName(){
    $ads = adsManager::getAllAds();
    foreach ($ads as $ad) {
        $ad->name_comp = companiesManager::getOneCompany($ad->id_comp)->name;
    }
    return $ads;
}

function confirmCompany(){
    $idCompany = $_POST['accept'];
    companiesManager::switchConfirmCompany($idCompany);
}

function deleteCompany(){
    $idCompany = $_GET['delete'];
    companiesManager::deleteCompany($idCompany);
}

function getCompanyToConfirm(){
    $idCompany = $_GET['see'];
    $companyToConfirm = companiesManager::getOneCompany($idCompany);
    $domaines = categoriesManager::getAllDomainesForCompany($idCompany);
    $domainesAsString = "";
    if(sizeof($domaines) != 0){
        foreach ($domaines as $domaine) {
            $domainesAsString .= $domaine;
            $domainesAsString .= ", ";
        }
        $domainesAsString = substr($domainesAsString,0,-2);
        $domainesAsString .= '.';
    } 
    
    $companyToConfirm->__set('domaines', $domainesAsString); 
    return $companyToConfirm;
}

function sendAcceptMail($idCompany)
{
    $mailTo = companiesManager::getOneCompany($idCompany)->mail;
    $content = "Félicitation ! Votre entreprise a été accepté sur la plateforme Findwell !<br>Vous pouvez dès à présent accéder à la page de paiement afin de figurer sur la plateforme Findwell en suivant ce lien: <a href=\"findwell.be/index.php?viewToDisplay=displayPayment\">Cliquez ici</a>";
    $url = '';
    $object = "Votre entreprise a été ajouté avec succès sur Findwell";
    require_once('models/sendEmail.php');
}

function sendRejectMail($idCompany, $rejectMessage)
{
    companiesManager::switchAcceptPending($idCompany);
    $mailTo = companiesManager::getOneCompany($idCompany)->mail;
    $content = "Malheureusement, votre entreprise n'a pu être ajoutée à Findwell...<br>Raison du refus:<br><i>$rejectMessage</i>";
    $url = '';
    $object = "Votre entreprise n'a pas pu être ajouter à Findwell";
    require_once('models/sendEmail.php');
}
    
?>