<?php
require_once('models/geolocation.php');

require_once('models/modelsFinal/ad.php');
require_once('models/modelsFinal/category.php');
require_once('models/modelsFinal/comment.php');
require_once('models/modelsFinal/company.php');
require_once('models/modelsFinal/user.php');
require_once('models/modelsFinal/service.php');
require_once('models/modelsFinal/occasion.php');
require_once('models/modelsFinal/material.php');

require_once('models/daoFinal/DBManager.php');
require_once('models/daoFinal/adsManager.php');
require_once('models/daoFinal/categoriesManager.php');
require_once('models/daoFinal/commentsManager.php');
require_once('models/daoFinal/companiesManager.php');
require_once('models/daoFinal/usersManager.php');
require_once('models/daoFinal/servicesManager.php');
require_once('models/daoFinal/occasionsManager.php');
require_once('models/daoFinal/materialsManager.php');

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
require_once('controllers/controllersFinal/controller_contact.php');
require_once('controllers/controllersFinal/controller_annonce.php');


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


    if(isset($_GET['viewToDisplay']) && $_GET['viewToDisplay'] == 'displayAnnonce'){
        if(isset($_GET['subcategory'])){
            if($_GET['subcategory'] == "service"){
                if(isset($_GET['category'])){
                    $servicesToDisplay = getServicesForCategories($_GET['category']);
                    foreach ($servicesToDisplay as $service) {
                        $service->imageService = unserialize($service->imageService);
                    }
                    displayAnnonce(notification: $notification, servicesToDisplay: $servicesToDisplay);
                } else if(isset($_GET['service'])){
                    $serviceToDisplay = getServiceByID($_GET['service']);
                    if(!is_null($serviceToDisplay)){
                        $serviceToDisplay->imageService = unserialize($serviceToDisplay->imageService);
                    
                        //Avoir le nombre de jour depuis l'ajout du service
                        $datetime1 = new DateTime(date("Y/m/d"));
                        $datetime2 = new DateTime($serviceToDisplay->date);
                        $serviceToDisplay->date = $datetime1->diff($datetime2)->format('%d');
                        displayAnnonce(notification: $notification, serviceToDisplay: $serviceToDisplay);
                    } else {
                        $categoriesServiceToDisplay = getCategoriesOfService();
                        displayAnnonce(notification: $notification, categoriesServiceToDisplay: $categoriesServiceToDisplay);
                    }    
                                    
                } else if(isset($_GET['action'])){
                    if($_GET['action'] == 'displayAdd' && isConnected()){
                        $addService = true;
                        $categoriesService = getCategoriesToDisplay("Service");
                        displayAnnonce(notification: $notification, addService: $addService, categoriesService : $categoriesService);
                    } else if($_GET['action'] == 'add' && isConnected()){
                        $values = array(
                            "title" => $_POST['title'],
                            "description" => $_POST['description'],
                            "imageService" => $_FILES['image'],
                            "region" => $_POST['region'],
                            "phone" => $_POST['phone'],
                            "mail" => $_POST['mail'],
                            "idUser" => $_SESSION['user']->id
                        );
                        
                        $newService = new Service();
                        $newService->hydrate($values);
                        $imageArray = array();

                        for ($i=0; $i < sizeof($_FILES['image']['name']); $i++) { 
                            $from = $_FILES['image']['tmp_name'][$i];
                            $path = $_FILES['image']['name'][$i];
                            //get the extension of file
                            $ext = pathinfo($path, PATHINFO_EXTENSION);
                            $files = scandir('images/upload/services/');
                            $cptImage = count($files)-1;
                            $to = 'images/upload/services/service'.$cptImage.'.'.$ext;
                            move_uploaded_file($from,$to);
                            array_push($imageArray, $to);
                        }
                        $newService->__set('imageService',$imageArray);
                        $idNewService = addService($newService);
                        foreach ($_POST['checkService'] as $dom) {
                            ServicesManager::addLinkServiceCategory($idNewService, $dom);
                        }
                        header("Location: index.php?viewToDisplay=displayAnnonce&message=1");
                    } else if($_GET['action'] == 'edit' && isConnected()){
                        $values = array(
                            "idService" => $_POST['idService'],
                            "title" => $_POST['title'],
                            "description" => $_POST['description'],
                            "imageService" => $_FILES['image'],
                            "region" => $_POST['region'],
                            "phone" => $_POST['phone'],
                            "mail" => $_POST['mail'],
                            "idUser" => $_SESSION['user']->id
                        );
                        
                        $newService = new Service();
                        $newService->hydrate($values);
                        $imageArray = array();

                        for ($i=0; $i < sizeof($_FILES['image']['name']); $i++) { 
                            $from = $_FILES['image']['tmp_name'][$i];
                            $path = $_FILES['image']['name'][$i];
                            //get the extension of file
                            $ext = pathinfo($path, PATHINFO_EXTENSION);
                            $files = scandir('images/upload/services/');
                            $cptImage = count($files)-1;
                            $to = 'images/upload/services/service'.$cptImage.'.'.$ext;
                            move_uploaded_file($from,$to);
                            array_push($imageArray, $to);
                        }
                        $newService->__set('imageService',$imageArray);
                        editService($newService);
                        delAllLinkServiceCategory($newService->idService);
                        foreach ($_POST['checkService'] as $dom) {
                            ServicesManager::addLinkServiceCategory($newService->idService, $dom);
                        }
                        header("Location: index.php?viewToDisplay=displayAnnonce&message=2");
                    }
                } else if(isset($_GET['idUser'])){ 
                    $servicesOfUser = getAllServicesOfUser($_GET['idUser']);
                    foreach ($servicesOfUser as $service) {
                        $service->imageService = unserialize($service->imageService);
                    }
                    displayAnnonce(notification: $notification, servicesOfUser: $servicesOfUser);
                } else if(isset($_GET['edit'])){
                    $serviceToEdit = getServiceByID($_GET['edit']);
                    if(isset($_SESSION['user']) && $serviceToEdit->idUser == $_SESSION['user']->id){
                        $editPermission = true;
                    } else {
                        $editPermission = false;
                    }
                    
                    $categoriesService = getCategoriesToDisplay("Service");
                    displayAnnonce(notification: $notification, serviceToEdit: $serviceToEdit, editPermission: $editPermission, categoriesService: $categoriesService);
                } else if(isset($_GET['delete'])){
                    $serviceToEdit = getServiceByID($_GET['delete']);
                    if(isset($_SESSION['user']) && $serviceToEdit->idUser == $_SESSION['user']->id){
                        ServicesManager::deleteService($_GET['delete']);
                    }
                    
                    $categoriesService = getCategoriesToDisplay("Service");
                    displayAnnonce(notification: $notification, categoriesService: $categoriesService);
                    
                } else {
                    $categoriesServiceToDisplay = getCategoriesOfService();
                    displayAnnonce(notification: $notification, categoriesServiceToDisplay: $categoriesServiceToDisplay);
                }
            } else if($_GET['subcategory'] == "occasion"){
                if(isset($_GET['occasionToDisplay'])){
                    $occasionToDisplay = getOccasionByID($_GET['occasionToDisplay']);
                    if(!is_null($occasionToDisplay)){
                        $occasionToDisplay->imageOccasion = unserialize($occasionToDisplay->imageOccasion);

                        //Avoir le nombre de jour depuis l'ajout du service
                        $datetime1 = new DateTime(date("Y/m/d"));
                        $datetime2 = new DateTime($occasionToDisplay->date);
                        $occasionToDisplay->date = $datetime1->diff($datetime2)->format('%d');
                        displayAnnonce(notification: $notification, occasionToDisplay: $occasionToDisplay);
                    } else {
                        $occasions = getAllOccasions();
                        foreach ($occasions as $occasion) {
                            $occasion->imageOccasion = unserialize($occasion->imageOccasion);
                        }
                        displayAnnonce(notification: $notification, occasions: $occasions);
                    }
                } else if(isset($_GET['action'])){
                    if($_GET['action'] == 'displayAdd' && isConnected()){
                        $addOccasion = true;
                        displayAnnonce(notification: $notification, addOccasion: $addOccasion);
                    } else if($_GET['action'] == 'add' && isConnected()){
                        $values = array(
                            "title" => $_POST['title'],
                            "description" => $_POST['description'],
                            "price" => $_POST['price'],
                            "imageOccasion" => $_FILES['image'],
                            "region" => $_POST['region'],
                            "phone" => $_POST['phone'],
                            "mail" => $_POST['mail']
                        );
                        $newOccasion = new Occasion();
                        $newOccasion->hydrate($values);
                        $imageArray = array();

                        for ($i=0; $i < sizeof($_FILES['image']['name']); $i++) { 
                            $from = $_FILES['image']['tmp_name'][$i];
                            $path = $_FILES['image']['name'][$i];
                            //get the extension of file
                            $ext = pathinfo($path, PATHINFO_EXTENSION);
                            $files = scandir('images/upload/occasions/');
                            $cptImage = count($files)-1;
                            $to = 'images/upload/occasions/occasion'.$cptImage.'.'.$ext;
                            move_uploaded_file($from,$to);
                            array_push($imageArray, $to);
                        }
                        $newOccasion->__set('imageOccasion',$imageArray);
                        addOccasion($newOccasion);
                        header("Location: index.php?viewToDisplay=displayAnnonce&message=1");
                    } else if($_GET['action'] == 'edit' && isConnected()){
                        $values = array(
                            "idOccasion" => $_POST['idOccasion'],
                            "title" => $_POST['title'],
                            "description" => $_POST['description'],
                            "price" => $_POST['price'],
                            "imageOccasion" => $_FILES['image'],
                            "region" => $_POST['region'],
                            "phone" => $_POST['phone'],
                            "mail" => $_POST['mail']
                        );
                        $occasionToEdit = new Occasion();
                        $occasionToEdit->hydrate($values);
                        $imageArray = array();

                        for ($i=0; $i < sizeof($_FILES['image']['name']); $i++) { 
                            $from = $_FILES['image']['tmp_name'][$i];
                            $path = $_FILES['image']['name'][$i];
                            //get the extension of file
                            $ext = pathinfo($path, PATHINFO_EXTENSION);
                            $files = scandir('images/upload/occasions/');
                            $cptImage = count($files)-1;
                            $to = 'images/upload/occasions/occasion'.$cptImage.'.'.$ext;
                            move_uploaded_file($from,$to);
                            array_push($imageArray, $to);
                        }
                        $occasionToEdit->__set('imageOccasion',$imageArray);
                        editOccasion($occasionToEdit);
                        header("Location: index.php?viewToDisplay=displayAnnonce&message=2");
                    }
                } else if(isset($_GET['idUser'])){ 
                    $occasionsOfUser = getAllOccasionsOfUser($_GET['idUser']);
                    foreach ($occasionsOfUser as $occasion) {
                        $occasion->imageOccasion = unserialize($occasion->imageOccasion);
                    }
                    displayAnnonce(notification: $notification, occasionsOfUser: $occasionsOfUser);
                } else if(isset($_GET['edit'])){
                    $occasionToEdit = getOccasionByID($_GET['edit']);
                    if($occasionToEdit->idUser == $_SESSION['user']->id){
                        $editPermission = true;
                    } else {
                        $editPermission = false;
                    }
                    displayAnnonce(notification: $notification, occasionToEdit: $occasionToEdit, editPermission: $editPermission);
                } else if(isset($_GET['delete'])){
                    $occasionToDelete = getOccasionByID($_GET['delete']);
                    if(isset($_SESSION['user']) && $occasionToDelete != null && $occasionToDelete->idUser == $_SESSION['user']->id){
                        $editPermission = true;
                        OccasionsManager::deleteOccasion($occasionToDelete->idOccasion);
                    } else {
                        $editPermission = false;
                    }
                    displayAnnonce(notification: $notification, editPermission: $editPermission);
                } else {
                    $occasions = getAllOccasions();
                    foreach ($occasions as $occasion) {
                        $occasion->imageOccasion = unserialize($occasion->imageOccasion);
                    }
                    displayAnnonce(notification: $notification, occasions: $occasions);
                }
            } else {
                if(isset($_GET['addMateriel'])){
                    $company = getOneCompanyByMail($_SESSION['user']->mail);
                    if($company->deleted == 0){
                        $idCategory = CategoriesManager:: getIDCategoryFromName("Materiel", $_GET['category']);
                        if(CategoriesManager::checkIfLinkAlreadyExist($company->id, $idCategory) == 0){
                            CategoriesManager::addLinkCatComp($company->id, $idCategory);
                            header("Location: index.php?viewToDisplay=displayAnnonce&message=1");
                        } else {
                            header("Location: index.php?viewToDisplay=displayAnnonce&message=3");
                        }
                    } else {
                        header("Location: index.php?viewToDisplay=displayAnnonce&message=3");
                    }
                    
                } else if(isset($_GET['category'])){
                    $companiesMaterialToDisplay = getAllCompaniesAccordingTo("Materiel", $_GET['category']);
                    displayAnnonce(notification: $notification, companiesMaterialToDisplay: $companiesMaterialToDisplay);
                } else {
                    $categoriesMaterialsToDisplay = getMaterielCategories();
                    displayAnnonce(notification: $notification, categoriesMaterialsToDisplay: $categoriesMaterialsToDisplay);
                }
            }
            
        } else {
            displayAnnonce($notification);
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
        if(isset($_POST['sendContactMail'])){
            sendContactMail();
            $alert['color'] = "success";
            $alert['message'] = "Votre message a bien été envoyé à notre service client.";
            displayContact($notification, $alert);
        } else {
            displayContact($notification);
        }
        
    } else if(isset($_GET['viewToDisplay']) && $_GET['viewToDisplay'] == 'displayAboutUs'){
        displayAboutUs($notification);
    } else if(isset($_GET['viewToDisplay']) && $_GET['viewToDisplay'] == 'displayConfidential'){
        displayConfidential($notification);
    } else if(isset($_GET['viewToDisplay']) && $_GET['viewToDisplay'] == 'displayCGV'){
        displayCGV($notification);
    } else if(isset($_GET['viewToDisplay']) && $_GET['viewToDisplay'] == 'displaySearch'){
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
        if($_SESSION['user']->username != NULL){
            addComment($_GET['newComment'], $_SESSION['user']->id);
            $alert['color'] = "success";
            $alert['message'] = "Votre commentaire a bien été pris en compte.";
            prepareDisplayCompanyDetails($_GET['newComment'], $notification, $alert);
        } else {
            $alert['color'] = "danger";
            $alert['message'] = "Vous devez completer votre profil pour ajouter un commentaire.";
            prepareDisplayCompanyDetails($_GET['newComment'], $notification, $alert);
        }
        
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
            $company = companiesManager::getOneCompanyByMail(strtolower($_SESSION['user']->mail));
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
                $_SESSION['user'] = UsersManager::getUser(strtolower($_SESSION['user']->mail));
                if($user->type == "company")
                    $company = companiesManager::getOneCompanyByMail(strtolower($_SESSION['user']->mail));
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
        $alert = $companies = $companyToEdit = $companyToConfirm = $companiesToBeConfirmed = $ads = $adToEdit = $action = $users = $userToEdit = $domainePage = $addNewCompany = $companyDomaines = null;
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
                    $companyDomaines = categoriesManager::getAllIdDomainesForCompany($companyToEdit->id);
                    $domainePage['categoriesGrosTravaux'] = categoriesManager::getAllSubcategoriesFor('Gros Travaux');
                    $domainePage['categoriesPetitsTravaux'] = categoriesManager::getAllSubcategoriesFor('Petits Travaux');
                    $domainePage['categoriesDepannage'] = categoriesManager::getAllSubcategoriesFor('Dépannage d\'urgence');
                } else if(isset($_POST['submitEditCompany'])){
                    editCompany();
                    categoriesManager::delAllLinkCatComp($_POST['idCompany']);
                    if(isset($_POST['checkGros'])){
                        foreach ($_POST['checkGros'] as $dom) {
                            categoriesManager::addLinkCatComp($_POST['idCompany'], $dom);
                        }
                    }
                    if(isset($_POST['checkPetits'])){
                        foreach ($_POST['checkPetits'] as $dom) {
                            categoriesManager::addLinkCatComp($_POST['idCompany'], $dom);
                        }
                    }
                    if(isset($_POST['checkDepannage'])){
                        foreach ($_POST['checkDepannage'] as $dom) {
                            categoriesManager::addLinkCatComp($_POST['idCompany'], $dom);
                        }
                    }
                    $companies = companiesManager::getAllActiveCompanies();
                } else if(isset($_GET['action']) && $_GET['action'] == "add"){
                    $addNewCompany = true;
                    $domainePage['categoriesGrosTravaux'] = categoriesManager::getAllSubcategoriesFor('Gros Travaux');
                    $domainePage['categoriesPetitsTravaux'] = categoriesManager::getAllSubcategoriesFor('Petits Travaux');
                    $domainePage['categoriesDepannage'] = categoriesManager::getAllSubcategoriesFor('Dépannage d\'urgence');
                } else if(isset($_POST['submitNewCompanyByAdmin'])){
                    $newUser = new User();
                    $newUser->__set("mail", $_POST['mail']);
                    $newUser->__set('password', randomPassword());
                    $newUser->__set('username', $_POST['name']);
                    $newUser->__set('phone', $_POST['phone']);
                    $newUser->__set('street', $_POST['street']);
                    $newUser->__set('number', $_POST['number']);
                    $newUser->__set('city', $_POST['city']);
                    $newUser->__set('state', $_POST['state']);
                    $newUser->__set('zip', $_POST['zip']);

                    $from = $_FILES['image']['tmp_name'];
                    $path = $_FILES['image']['name'];
                    //get the extension of file
                    $ext = pathinfo($path, PATHINFO_EXTENSION);
                    $imageName = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
                    $to = 'images/upload/photos_profils/' . $imageName;
                    move_uploaded_file($from,$to);
                    $newUser->__set('image',$to);

                    $newUser->__set('type', "company");
                    $newUser->__set('code', uniqid());
                    
                    $newCompany = new Company();
                    $newCompany->__set("mail", $_POST['mail']);
                    $newCompany->__set('name', $_POST['name']);
                    $newCompany->__set('description', nl2br($_POST['description'], true));
                    $newCompany->__set('hours', nl2br($_POST['hours'], true));
                    $newCompany->__set('city', $_POST['city']);
                    $newCompany->__set('street', $_POST['street']);
                    $newCompany->__set('number', $_POST['number']);
                    $newCompany->__set('postalCode', $_POST['zip']);
                    $newCompany->__set('web', $_POST['web']);
                    $newCompany->__set('state', $_POST['state']);
                    $newCompany->__set('phone', $_POST['phone']);
                    $newCompany->__set('image',$to);
                    $newCompany->__set('tva', $_POST['tva']);
                    usersManager::addUserWithFullInformation($newUser);
                    companiesManager::addCompany($newCompany);
                    usersManager::confirmUser(usersManager::getUser($newUser->mail)->id);
                    $company = companiesManager::getOneCompanyByMail($newCompany->mail);
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
                    CompaniesManager::switchConfirmCompany($company->id);
                    CompaniesManager::switchCompanyPaid($company->id);
                    sendConfirmationMailToCompanyRegisteredByAdmin($newUser ->mail, $newUser->password);
                    $companies = getAllActiveCompanyWithRatingAndCommentCount();
                    $alert['color'] = "success";
                    $alert['message'] = "L'entreprise $company->name a été ajoutée.";
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
            displayAdminPanel($alert, $companies, $companyToEdit, $companyToConfirm, $companiesToBeConfirmed, $ads, $adToEdit, $action, $users, $userToEdit, $addNewCompany, $domainePage, $notification, $companyDomaines);
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
    } else if(isset($_GET['searchAll'])){
        $searchResult = getAllCompanies();
        displaySearch($searchResult, $notification);
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
