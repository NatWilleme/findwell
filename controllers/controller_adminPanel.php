<?php
require_once('../models/models/company.php');
require_once('../models/models/user.php');
require_once('../models/dao/companiesManager.php');
require_once('../models/dao/usersManager.php');
require_once('../models/dao/commentsManager.php');

if(isset($_GET['view'])){
    if($_GET['view'] == "companies"){
        if(isset($_GET['delete'])){
            companiesManager::deleteCompany($_GET['delete']);
        } else if(isset($_GET['edit'])) {
            $companyToEdit = companiesManager::getOneCompany($_GET['edit']);
        } else {
            $companies = companiesManager::getAllCompanies();
            foreach ($companies as $company) {
                $company->__set('rating', number_format(commentsManager::getRatingForCompany($company->id)['rate']) );
            }
        }        
    } else if($_GET['view'] == "users"){
        if(isset($_GET['edit'])) {
            $userToEdit = usersManager::getUserByID($_GET['edit']);
        } else {
            $users = usersManager::getAllUser();
        }
    }
}


require_once('../views/view_adminPanel.php');

?>