<?php

function updateAndGetUserInformation()
{
    $user = UsersManager::getUser($_SESSION['user']->mail);
    $userToEdit = new User();
    $userToEdit->__set("id", $user->id);

    if($_POST['username'] != "")
        $userToEdit->__set("username", $_POST['username']);
    else
        $userToEdit->__set("username", NULL);

    if($_POST['phone'] != "")
        $userToEdit->__set("phone", $_POST['phone']);
    else
        $userToEdit->__set("phone", NULL);

    if(!empty($_FILES['image']['name'])){
        $from = $_FILES['image']['tmp_name'];
        $path = $_FILES['image']['name'];
        //get the extension of file
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $imageName = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
        $to = 'images/upload/photos_profils/' . $imageName;
        move_uploaded_file($from,$to);
        $userToEdit->__set('image',$to);
    } else {
        $userToEdit->__set('image',$_POST['imageOld']);
    }
    if($_POST['number'] == "")
        $userToEdit->__set("number", NULL);
    else
        $userToEdit->__set("number", $_POST['number']);

    if($_POST['street'] == "")
        $userToEdit->__set("street", NULL);
    else
        $userToEdit->__set("street", $_POST['street']);

    if($_POST['city'] == "")
        $userToEdit->__set("city", NULL);
    else
        $userToEdit->__set("city", $_POST['city']);

    if($_POST['state'] == "")
        $userToEdit->__set("state", NULL);
    else
        $userToEdit->__set("state", $_POST['state']);

    if($_POST['zip'] == "")
        $userToEdit->__set("zip", NULL);
    else
        $userToEdit->__set("zip", $_POST['zip']);
    if($_POST['submit'] == "updateCompany"){
        $userToEdit->__set("type", "company");
    } else if($_SESSION['user']->type == "admin"){
        $userToEdit->__set("type", "admin");
    } else {
        $userToEdit->__set("type", "user");
    }
    
    UsersManager::updateUser($userToEdit);
    return UsersManager::getUser(strtolower($_SESSION['user']->mail));
}

function updateCompanyInformation()
{
    $company = companiesManager::getOneCompanyByMail($_SESSION['user']->mail);
    $companyToEdit = new Company();
    $companyToEdit->__set("id", $company->id);
    $companyToEdit->__set("name", $_POST['username']);
    $companyToEdit->__set("phone", $_POST['phone']);
    $companyToEdit->__set("description", $_POST['description']);
    $companyToEdit->__set("hours", $_POST['hours']);
    if($_FILES['image']['name'] != ""){
        $from = $_FILES['image']['tmp_name'];
        $path = $_FILES['image']['name'];
        //get the extension of file
        $ext = pathinfo($path, PATHINFO_EXTENSION);
        $imageName = date('Y-m-d-H-i-s') . '-' . uniqid() . '.' . $ext;
        $to = 'images/upload/photos_profils/' . $imageName;
        move_uploaded_file($from,$to);
        $companyToEdit->__set('image',$to);
    } else {
        $companyToEdit->__set('image',$_POST['imageOld']);
    }
    $companyToEdit->__set("number", $_POST['number']);
    $companyToEdit->__set("street", $_POST['street']);
    $companyToEdit->__set("city", $_POST['city']);
    $companyToEdit->__set("state", $_POST['state']);
    $companyToEdit->__set("postalCode", $_POST['zip']);
    companiesManager::updateCompany($companyToEdit);
}

function getSuccessAlertForEditProfil()
{
    $alert['color'] = "success";
    $alert['message'] = "Vos informations ont été mise à jour.";
    return $alert;
}

function getSuccessAlertForChangePwd()
{
    $alert['color'] = "success";
    $alert['message'] = "Votre mot de passe a été changé.";
    return $alert;
}

function getFailAlertForChangePwd()
{
    $alert['color'] = "danger";
    $alert['message'] = "Les mots de passes entrés ne correspondent pas.";
    return $alert;
}

?>