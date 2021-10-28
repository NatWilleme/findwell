<?php 

function getCategoriesOfService(){
    return CategoriesManager::getAllSubcategoriesFor("Service");
}

function getServiceByID(int $id){
    return ServicesManager::getServicesByID($id);
}


function getServicesForCategories(string $category){ 
    return ServicesManager::getAllServicesForCategory($category);
}

function getAllServices(){
    return ServicesManager::getAllServices();
}

function getMaterielCategories(){
    return CategoriesManager::getAllSubcategoriesFor("Materiel");
}

?>