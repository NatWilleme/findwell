<?php

function addAd()
{
    $newAd = new Ad();
    $newAd->__set('id_comp', $_POST['company']);
    $imageName = 'pc_' . date('Y-m-d-H-i-s') . '_' . uniqid() . '.png';
    $to = 'images/upload/advertising/pc/' . $imageName;
    $imageCroppedPC = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $_POST['imagePCBase64']));
    echo "<script>console.log('" . $imageCroppedPC . "');</script>";
    file_put_contents($to, $imageCroppedPC);
    $newAd->__set('imagePC', $to);

    $imageName = 'mobile_' . date('Y-m-d-H-i-s') . '_' . uniqid() . '.png';
    $to = 'images/upload/advertising/mobile/' . $imageName; 
    $imageCroppedMobile = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $_POST['imageMobileBase64']));
    file_put_contents($to, $imageCroppedMobile);
    $newAd->__set('imageMobile', $to);

    $newAd->__set('display', $_POST['display']);
    adsManager::addAd($newAd);
    unset($newAd);
}

function editAd()
{
    $newAd = new Ad();
    $newAd->__set('id', $_POST['idToEdit']);
    $newAd->__set('id_comp', $_POST['company']);
    $newAd->__set('display', $_POST['display']);
    // if (!empty($_FILES['imagePC']['name'])) {
    //     $from = $_FILES['imagePC']['tmp_name'];
    //     $path = $_FILES['imagePC']['name'];
    //     //get the extension of file
    //     $ext = pathinfo($path, PATHINFO_EXTENSION);
    //     $imageName = 'pcAd_' . date('Y-m-d-H-i-s') . '_' . uniqid() . '.' . $ext;
    //     $to = 'images/upload/advertising/pc/' . $imageName;
    //     move_uploaded_file($from, $to);
    //     $newAd->__set('imagePC', $to);
    if(!empty($_POST['imagePCBase64'])){
        $imageName = 'pc_' . date('Y-m-d-H-i-s') . '_' . uniqid() . '.png';
        $to = 'images/upload/advertising/pc/' . $imageName;
        $imageCroppedPC = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $_POST['imagePCBase64']));
        file_put_contents($to, $imageCroppedPC);
        $newAd->__set('imagePC', $to);
    } else {
        $newAd->__set('imagePC', $_POST['imageOldPC']);
    }
    // if (!empty($_FILES['imageMobile']['name'])) {
    //     $from = $_FILES['imageMobile']['tmp_name'];
    //     $path = $_FILES['imageMobile']['name'];
    //     //get the extension of file
    //     $ext = pathinfo($path, PATHINFO_EXTENSION);
    //     $files = scandir('images/upload/advertising/mobile/');
    //     $imageName = 'mobileAd_' . date('Y-m-d-H-i-s') . '_' . uniqid() . '.' . $ext;
    //     $to = 'images/upload/advertising/pc/' . $imageName;
    //     move_uploaded_file($from, $to);
    //     $newAd->__set('imageMobile', $to);
    if(!empty($_POST['imageMobileBase64'])){
        $imageName = 'mobile_' . date('Y-m-d-H-i-s') . '_' . uniqid() . '.png';
        $to = 'images/upload/advertising/mobile/' . $imageName; 
        $imageCroppedMobile = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $_POST['imageMobileBase64']));
        file_put_contents($to, $imageCroppedMobile);
        $newAd->__set('imageMobile', $to);
    } else {
        $newAd->__set('imageMobile', $_POST['imageOldMobile']);
    }
    adsManager::updateAd($newAd);
}

function editUser()
{
    $newUser = new User();
    $newUser->__set('id', $_POST['idToEdit']);
    $newUser->__set('username', $_POST['username']);
    $newUser->__set('phone', $_POST['phone']);
    $newUser->__set('street', $_POST['street']);
    $newUser->__set('number', $_POST['number']);
    $newUser->__set('city', $_POST['city']);
    $newUser->__set('zip', $_POST['zip']);
    $newUser->__set('type', $_POST['type']);
    $newUser->__set('image', UsersManager::getUserByID($_POST['idToEdit'])->image);
    usersManager::updateUser($newUser);
}

function editCompany()
{
    $newCompany = new Company();
    $newCompany->__set('id', $_POST['idCompany']);
    $newCompany->__set('name', $_POST['name']);
    $newCompany->__set('phone', $_POST['phone']);
    $newCompany->__set('description', nl2br($_POST['description'], true));
    $newCompany->__set('hours', nl2br($_POST['hours'], true));
    $newCompany->__set('street', $_POST['street']);
    $newCompany->__set('number', $_POST['number']);
    $newCompany->__set('city', $_POST['city']);
    $newCompany->__set('postalCode', $_POST['zip']);
    $newCompany->__set('web', $_POST['web']);
    $newCompany->__set('certified', $_POST['certified']);
    $newCompany->__set('hasPaid', $_POST['hasPaid']);
    if (!empty($_FILES['image']['name'])) {
        $from = $_FILES['image']['tmp_name'];
        $path = $_FILES['image']['name'];
        //get the extension of file
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $imageName = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
        $to = 'images/upload/photos_profils/' . $imageName;
        move_uploaded_file($from, $to);
        $newCompany->__set('image', $to);
    } else {
        $newCompany->__set('image', $_POST['image']);
    }
    companiesManager::updateCompany($newCompany);
    $company = companiesManager::getOneCompany($newCompany->id);
    if ($newCompany->certified != $company->certified) {
        companiesManager::switchConfirmCompany($company->id);
    }
    if ($newCompany->hasPaid != $company->hasPaid) {
        companiesManager::switchCompanyPaid($company->id);
        sendActiveMail($company->id);
    }
}

function sendConfirmationMailToCompanyRegisteredByAdmin($mailTo, $password)
{
    $content = "Votre entreprise est maintenant disponible sur la plateforme Findwell!<br>
                Vous pouvez dès à présent vous connecter avec les identifiants suivants: <br>
                <ul>
                    <li>adresse mail: $mailTo</li>
                    <li>mot de passe provisoire: $password</li>
                </ul>";
    $object = "Bienvenue chez Findwell !";
    require_once('models/sendEmail.php');
}

function getCompanyToEdit()
{
    return companiesManager::getOneCompany($_GET['edit']);
}

function getAllActiveCompanyWithRatingAndCommentCount()
{
    $companies = companiesManager::getAllActiveCompanies();
    foreach ($companies as $company) {
        $company->__set('rating', number_format(commentsManager::getRatingForCompany($company->id)['rate']));
        $company->countComment = count(commentsManager::getCommentsForACompany($company->id));
    }
    return $companies;
}

function getUserToEdit()
{
    return usersManager::getUserByID($_GET['edit']);
}

function getAllUsers()
{
    return usersManager::getAllUser();
}

function getAllAdsWithCompanyName()
{
    $ads = adsManager::getAllAds();
    foreach ($ads as $ad) {
        $ad->name_comp = companiesManager::getOneCompany($ad->id_comp)->name;
    }
    return $ads;
}

function confirmCompany()
{
    $idCompany = $_POST['accept'];
    companiesManager::switchConfirmCompany($idCompany);
}

function deleteCompany()
{
    $idCompany = $_GET['delete'];
    companiesManager::deleteCompany($idCompany);
}

function getCompanyToConfirm()
{
    $idCompany = $_GET['see'];
    $companyToConfirm = companiesManager::getOneCompany($idCompany);
    $domaines = categoriesManager::getAllDomainesForCompany($idCompany);
    $domainesAsString = "";
    if (sizeof($domaines) != 0) {
        foreach ($domaines as $domaine) {
            $domainesAsString .= $domaine;
            $domainesAsString .= ", ";
        }
        $domainesAsString = substr($domainesAsString, 0, -2);
        $domainesAsString .= '.';
    }

    $companyToConfirm->__set('domaines', $domainesAsString);
    return $companyToConfirm;
}

function randomPassword()
{
    $chars =  'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz' . '0123456789`-=~!@#$%^&*()_+,./<>?;:[]{}\|';
    $str = '';
    $max = strlen($chars) - 1;

    for ($i = 0; $i < 10; $i++)
        $str .= $chars[random_int(0, $max)];

    return $str;
}

function sendAcceptMail($idCompany)
{
    $mailTo = companiesManager::getOneCompany($idCompany)->mail;
    $content = "Félicitation ! Votre entreprise a été accepté sur la plateforme Findwell !<br>Vous pouvez dès à présent accéder à la page de paiement afin de figurer sur la plateforme Findwell en suivant ce lien: <a href=\"findwell.be/index.php?viewToDisplay=displayPayment\">Cliquez ici</a>";
    $url = '';
    $object = "Votre entreprise a été ajouté avec succès sur Findwell";
    require_once('models/sendEmail.php');
}

function sendActiveMail($idCompany)
{
    $mailTo = companiesManager::getOneCompany($idCompany)->mail;
    $content = "Félicitation ! Votre entreprise est maintenant active sur la plateforme. Vous pouvez dès à présent accéder à votre page en <a href='http://findwell/index.php?viewToDisplay=displayCompanyDetails&idCompany=$idCompany'>cliquant ici</a>";
    $url = '';
    $object = "Votre entreprise est activée";
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
