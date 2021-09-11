<?php
require_once('models/geolocation.php');

require_once('models/modelsFinal/ad.php');
require_once('models/modelsFinal/category.php');
require_once('models/modelsFinal/comment.php');
require_once('models/modelsFinal/company.php');
require_once('models/modelsFinal/user.php');

require_once('models/daoFinal/DBManager.php');
require_once('models/daoFinal/adsManager.php');
require_once('models/daoFinal/categoriesManager.php');
require_once('models/daoFinal/commentsManager.php');
require_once('models/daoFinal/companiesManager.php');
require_once('models/daoFinal/usersManager.php');

require_once('controllers/controllersFinal/controller_adminPanel.php');
require_once('controllers/controllersFinal/controller_categoriesList.php');
require_once('controllers/controllersFinal/controller_companiesList.php');
require_once('controllers/controllersFinal/controller_companyDetails.php');
require_once('controllers/controllersFinal/controller_editProfil.php');
require_once('controllers/controllersFinal/controller_favorites.php');
require_once('controllers/controllersFinal/controller_home.php');
require_once('controllers/controllersFinal/controller_login.php');
require_once('controllers/controllersFinal/controller_search.php');
require_once('controllers/controllersFinal/controller_display.php');


try {

    openOrRefreshSession();
    $notification = 0;
    $alert = null;
    if(isset($_GET['disconnect'])){
        unset($_COOKIE['userConnected']);
        setcookie('userConnected', '', time() - 3600, '/');
        session_destroy();
        homePage($notification);
    }
    if(isConnected()){
        $notification = sizeof(companiesManager::getAllCompaniesToBeConfirmed());
    } else if(isset($_POST['submitConnexion'])){
        if(connectUser($_POST['mail'], $_POST['password'])){
            $notification = sizeof(companiesManager::getAllCompaniesToBeConfirmed());
            homePage($notification);
        } else {
            $alert['color'] = "danger";
            $alert['message'] = "Échec de connexion. Vérifiez vos identifiants";
            displayConnexion($alert);
        }
    }

    if(isset($_GET['viewToDisplay']) && $_GET['viewToDisplay'] == 'displayConnexion'){
        if(isset($_GET['pwdforget']) && $_GET['pwdforget'] == 1){
            $forget = true;
            displayConnexion($alert, $forget);
        } else if(isset($_GET['newpwd']) && $_GET['newpwd'] == 1){
            $_SESSION['mailToChangePwd'] = $_GET['mail'];
            $newPwd = true;
            displayConnexion($alert, $forget = '', $newPwd);
        } else if(isset($_POST['submitForget'])){
            if(checkIfUserExist($_POST['mail'])['count'] != 0){
                $user = UsersManager::getUser($_POST['mail']);
                sendReinitialisationMail($user->mail, $user->code);
                $alert['color'] = "warning";
                $alert['message'] = "Un mail de réinitialisation a été envoyé à l'adresse : ".$_POST['mail'];
            } else {
                $alert['color'] = "danger";
                $alert['message'] = "L'adresse mail entrée ne correspond à aucun compte Findwell.";
            }
            displayConnexion($alert);
        } else if(isset($_POST['submitReinitialisation'])){
            $user = usersManager::getUser($_POST['mail']);
            if($user->code == $_POST['code']){
                if($_POST['password'] == $_POST['passwordVerif']){
                    usersManager::updatePwd($_SESSION['mailToChangePwd'], $_POST['password']);
                    $alert['color'] = "success";
                    $alert['message'] = "Votre mot de passe a bien été changé.";
                    displayConnexion($alert);
                } else{
                    $alert['color'] = "danger";
                    $alert['message'] = "Les deux champs de mot de passe ne correspondent pas.";
                    $newPwd = true;
                    displayConnexion($alert, $forget = '', $newPwd);
                }
            } else {
                $newPwd = true;
                displayConnexion($alert, $forget = '', $newPwd);
            }
        } else{
            displayConnexion($alert);
        }
        
    } else if(isset($_GET['viewToDisplay']) && $_GET['viewToDisplay'] == 'displayRegister'){
        displayRegister();
    } else if(isset($_GET['viewToDisplay']) && $_GET['viewToDisplay'] == 'displayContact'){
        displayContact($notification);
    } else if(isset($_GET['viewToDisplay']) && $_GET['viewToDisplay'] == 'displaySearch'){
        if(isset($_SESSION['category'])) 
            unset($_SESSION['category']);
        if(isset($_SESSION['subcategory']))
            unset($_SESSION['subcategory']);

        $searchResult = getSearchResult();
        displaySearch($searchResult, $notification);
    } else if(isset($_GET['viewToDisplay']) && $_GET['viewToDisplay'] == 'displayCategoriesList'){
        $category = $_GET['category'];
        $_SESSION['category'] = $category;
        $categories = getCategoriesToDisplay($category);
        displayCategoriesList($categories, $notification);
    } else if(isset($_GET['viewToDisplay']) && $_GET['viewToDisplay'] == 'displayCompanyDetails' && isset($_GET['favorite'])){
        AddOrRemoveFavorite($_GET['favorite']);
        prepareDisplayCompanyDetails($_GET['favorite'], $notification);
    } else if(isset($_GET['viewToDisplay']) && $_GET['viewToDisplay'] == 'displayCompanyDetails' && isset($_GET['newComment'])){
        addComment($_GET['newComment'], $_SESSION['user']->id);
        prepareDisplayCompanyDetails($_GET['newComment'], $notification);
    } else if(isset($_GET['viewToDisplay']) && $_GET['viewToDisplay'] == 'displayCompaniesList'){
        $subcategory = $_GET['subcategory'];
        $_SESSION['subcategory'] = $subcategory;
        displayCompaniesAccordingTo($_SESSION['category'], $subcategory, $notification);
    } else if(isset($_GET['viewToDisplay']) && $_GET['viewToDisplay'] == 'displayCompanyDetails' && !isset($_GET['favorite'])){
        prepareDisplayCompanyDetails($_GET['idCompany'], $notification);
    } else if(isset($_GET['viewToDisplay']) && $_GET['viewToDisplay'] == 'displayEditProfil'){
        $company = $alert = '';
        $user = $_SESSION['user'];
        if($user->type == "company")
            $company = companiesManager::getOneCompanyByMail($_SESSION['user']->mail);
        if(isset($_POST['submit'])){
            if($_POST['submit'] == "update" || $_POST['submit'] == "updateCompany"){
                $user = updateAndGetUserInformation();

                if($_POST['submit'] == "updateCompany"){
                    updateCompanyInformation();
                    $company = companiesManager::getOneCompanyByMail($_SESSION['user']->mail);
                    if($company->acceptPending == 0 && $company->certified == 0){
                        companiesManager::switchAcceptPending($company->id);
                    }
                }
                $_SESSION['user'] = UsersManager::getUser($_SESSION['user']->mail);
                if($user->type == "company")
                    $company = companiesManager::getOneCompanyByMail($_SESSION['user']->mail);
                $alert = getSuccessAlertForEditProfil();
                unset($_POST['submit']);
                displayEditProfil($alert, $user, $company, $notification);
            } else if($_POST['submit'] == "changePwd") {
                $changePwd = true;
                displayEditProfil($alert, $user, $company, $changePwd, $notification);
            } else if($_POST['submit'] == "acceptChangePwd") {
                if($_POST['password'] == $_POST['passwordVerif']){
                    usersManager::updatePwd($_SESSION['user']->mail, $_POST['password']);
                    $alert = getSuccessAlertForChangePwd();
                } else {
                    $alert = getFailAlertForChangePwd();
                }
                displayEditProfil($alert, $user, $company, $notification);
            } else {
                displayEditProfil($alert, $user, $company, $notification);
            }
        } else {
            displayEditProfil($alert, $user, $company, $notification);
        }
    } else if(isset($_GET['viewToDisplay']) && $_GET['viewToDisplay'] == 'displayFavorite'){
        $companies = getFavoriteCompanies();
        displayFavorites($companies, $notification);

    } else if(isset($_GET['viewToDisplay']) && $_GET['viewToDisplay'] == 'displayPayment'){
        displayPayment($notification);

    } else if(isset($_GET['viewToDisplay']) && $_GET['viewToDisplay'] == 'displayAdminPanel'){
        $companies = $companyToEdit = $companyToConfirm = $companiesToBeConfirmed = $ads = $adToEdit = $action = $users = $userToEdit = null;
        if(isset($_POST['action'])){
            if($_POST['action'] == "addAd"){
                addAd();
            } else if($_POST['action'] == "editAd"){
                editAd();
            } else if($_POST['action'] == "editUser"){
                editUser();
            }
        }

        if(isset($_GET['view'])){
            if($_GET['view'] == "companies"){
                if(isset($_GET['delete'])){
                    deleteCompany();
                    $companies = companiesManager::getAllActiveCompanies();
                } else if(isset($_GET['edit'])) {
                    $companyToEdit = getCompanyToEdit();
                } else if(isset($_POST['submitEditCompany'])){
                    editCompany();
                    $companies = companiesManager::getAllActiveCompanies();
                } else {
                    $companies = getAllActiveCompanyWithRatingAndCommentCount();
                }   

            } else if($_GET['view'] == "users"){

                if(isset($_GET['edit'])) {
                    $userToEdit = getUserToEdit();
                } else {
                    $users = getAllUsers();
                }

            } else if($_GET['view'] == "ads") {
                if((isset($_GET['action']) && $_GET['action'] == "add") || isset($_GET['edit'])){
                    $companies = companiesManager::getAllActiveCompanies();
                    $action = true;
                    if(isset($_GET['edit'])){
                        $adToEdit = adsManager::getAd($_GET['edit']);
                    }
                }
                if(isset($_GET['delete'])){
                    adsManager::deleteAd($_GET['delete']);
                }
                $ads = adsManager::getAllAds();
                foreach ($ads as $ad) {
                    $ad->name_comp = companiesManager::getOneCompany($ad->id_comp)->name;
                }
            } else if($_GET['view'] == "companiesNotCertified"){
                if(isset($_GET['see'])) {
                    $companyToConfirm = getCompanyToConfirm();
                } else {
                    if(isset($_POST['accept'])) {
                        confirmCompany();
                        sendAcceptMail($_POST['accept']);
                        $notification = sizeof(companiesManager::getAllCompaniesToBeConfirmed());
                    } else if(isset($_POST['delete'])) {
                        sendRejectMail($_POST['delete'], $_POST['messageRefus']);
                    }
                    $companiesToBeConfirmed = companiesManager::getAllCompaniesToBeConfirmed();
                }
                
            }
        }

        if(isset($_SESSION['user']) && $_SESSION['user']->type == "admin")
            displayAdminPanel($companies, $companyToEdit, $companyToConfirm, $companiesToBeConfirmed, $ads, $adToEdit, $action, $users, $userToEdit, $notification);
        else
            homePage($notification);



    } else if(isset($_POST['submitRegister'])){     //Page 1 Inscription
        $user = checkIfUserExist($_POST['mail']);
        if($user['count'] == 0){
            prepareNewUser($_POST['mail'], $_POST['password']);
            $choice = true;
            displayRegister('', $choice);
        } else{
            $alert['color'] = "danger";
            $alert['message'] = "Un compte avec cette adresse mail existe déjà.";
            displayRegister($alert);
        }
        
    // Page 2 Choix du type d'utilisateur
    } else if(isset($_POST['type'])){
        $_SESSION['newUser']->__set('code', uniqid());
        if($_POST['type'] == 'Utilisateur'){
            $_SESSION['newUser']->__set('type', 'user');
            $alert = registerNewUser($_SESSION['newUser']);
            $_SESSION['newUser'] = usersManager::getUser($_SESSION['newUser']->mail);
            sendConfirmationMail();
            displayConnexion($alert);
        } else {
            $_SESSION['newUser']->__set('type', 'company');
            $companyForm = true;
            displayRegister('', '', $companyForm);
        }
    // Page 3 Inscription pour entreprise
    } else if(isset($_POST['submitCompany'])){
        saveNewCompanySession();
        saveNewUserSession();
        $domainePage['value'] = true;
        $domainePage['categoriesGrosTravaux'] = categoriesManager::getAllSubcategoriesFor('Gros Travaux');
        $domainePage['categoriesPetitsTravaux'] = categoriesManager::getAllSubcategoriesFor('Petits Travaux');
        $domainePage['categoriesDepannage'] = categoriesManager::getAllSubcategoriesFor('Dépannage d\'urgence');
        displayRegister('', '', '', $domainePage);
    } else if(isset($_POST['submitDomaine'])){  
        registerNewCompany($_SESSION['newUser'], $_SESSION['newCompany']);
        $company = companiesManager::getOneCompanyByMail($_SESSION['newCompany']->mail);
        if(isset($_POST['checkGros'])){
            foreach ($_POST['checkGros'] as $dom) {
                categoriesManager::addLinkCatComp($company->id, $dom);
            }
        }
        if(isset($_POST['checkPetits'])){
            foreach ($_POST['checkPetits'] as $dom) {
                categoriesManager::addLinkCatComp($company->id, $dom);
            }
        }
        if(isset($_POST['checkDepannage'])){
            foreach ($_POST['checkDepannage'] as $dom) {
                categoriesManager::addLinkCatComp($company->id, $dom);
            }
        }
        $_SESSION['newUser'] = usersManager::getUser($_SESSION['newUser']->mail);
        sendConfirmationMail(); 
    // Activation du compte
    } else if (isset($_GET['idUserToConfirm'])) {
        $idUserToConfirm = $_GET['idUserToConfirm'];
        $code = $_GET['code'];
        $user = usersManager::getUserByID($idUserToConfirm);
        if($user->code == $code){
            $alert = validUser($idUserToConfirm);
            displayConnexion($alert);
        } else {
            $alert['color'] = "danger";
            $alert['message'] = "Une erreur est survenue lors de l'activation de votre compte. Si le problème subsiste, contactez-nous.";
            displayConnexion($alert);
        }
    }
  
    else {
        homePage($notification);
    }
    







    
} catch (Exception $e) {
    echo $e->message;
}




function openOrRefreshSession() {
    session_set_cookie_params(3600);
    session_start();
}

function isConnected() {
    if(isset($_SESSION['user']) && isset($_COOKIE['userConnected']))
        return true;
    else return false;
}


?>