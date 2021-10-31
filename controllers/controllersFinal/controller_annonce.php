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

function getOccasionByID(int $id){
    return OccasionsManager::getOccasionByID($id);
}

function getAllOccasions(){
    return OccasionsManager::getAllOccasions();
}

function getMaterialByID(int $id){
    return MaterialsManager::getMaterialByID($id);
}

function getMaterialsForCategories(string $category){ 
    return MaterialsManager::getAllMaterialsForCategory($category);
}

function getAllMaterials(){
    return MaterialsManager::getAllMaterials();
}
?>