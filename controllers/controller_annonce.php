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

function getAllServicesOfUser(int $idUser)
{
    return ServicesManager::getAllServicesOfUser($idUser);
}

function addService(Service $newService)
{
    if(!is_null($newService->title) && !is_null($newService->description) && !is_null($newService->region) && (!is_null($newService->phone) || !is_null($newService->mail))){
        return ServicesManager::addService($newService);
    }
}

function editService(Service $serviceToEdit)
{
    if(!is_null($serviceToEdit->title) && !is_null($serviceToEdit->description) && !is_null($serviceToEdit->region) && (!is_null($serviceToEdit->phone) || !is_null($serviceToEdit->mail))){
        ServicesManager::editService($serviceToEdit);
    }
}

function delAllLinkServiceCategory($idService)
{
    ServicesManager::delAllLinkServiceCategory($idService);
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

function getAllOccasionsOfUser(int $îdUser){
    return OccasionsManager::getAllOccasionsOfUser($îdUser);
}

function addOccasion(Occasion $newOccasion)
{
    if(!is_null($newOccasion->title) && !is_null($newOccasion->description) && !is_null($newOccasion->price) && !is_null($newOccasion->region) && (!is_null($newOccasion->phone) || !is_null($newOccasion->mail))){
        OccasionsManager::addOccasion($newOccasion);
    }
}

function editOccasion(Occasion $occasionToEdit)
{
    if(!is_null($occasionToEdit->title) && !is_null($occasionToEdit->description) && !is_null($occasionToEdit->price) && !is_null($occasionToEdit->region) && (!is_null($occasionToEdit->phone) || !is_null($occasionToEdit->mail))){
        OccasionsManager::editOccasion($occasionToEdit);
    }
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

function getAllMissions()
{
    return MissionsManager::getAllMissions();
}

function addMission(Mission $newMission)
{
    if(!is_null($newMission->title) && !is_null($newMission->description) && !is_null($newMission->price) && !is_null($newMission->region) && (!is_null($newMission->phone) || !is_null($newMission->mail))){
        MissionsManager::addMission($newMission);
    }
}

function getMissionByID(int $id){
    return MissionsManager::getMissionByID($id);
}

function editMission(Mission $editedMission)
{
    MissionsManager::editMission($editedMission);
}

function deleteMission(int $id)
{
    MissionsManager::deleteMission($id);
}

function getAllMissionsOfUser(int $idUser)
{
    return MissionsManager::getAllMissionsOfUser($idUser);
}
?>