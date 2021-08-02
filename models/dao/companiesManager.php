<?php

require_once('../models/dao/DBManager.php');

abstract class CompaniesManager extends DBManager{
    
    static public function addCompany(Company $company){
        $sql = "INSERT INTO companies (name_comp, description_comp, hours_comp, city_comp, street_comp, number_comp, postalcode_comp, phone_comp, image_comp)
                VALUES (:name_comp, :description_comp, :hours_comp, :city_comp, :street_comp, :number_comp, :postalcode_comp, :phone_comp, :image_comp)";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':name_comp' => $company->__get('name'), ':description_comp' => $company->__get('description'),
                                ':hours_comp' => $company->__get('hours'), ':city_comp' => $company->__get('city_comp'), ':street_comp' => $company->__get('street_comp'),
                                ':number_comp' => $company->__get('number_comp'), ':postalcode_comp' => $company->__get('postalcode_comp'), ':phone_comp' => $company->__get('phone_comp'), 
                                ':image_comp' =>  $company->__get('image')));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

    static public function updateCompany(Company $company){
        $sql = "UPDATE companies SET name_comp=:name_comp, description_comp=:description_comp, hours_comp=:hours_comp,
                city_comp=:city_comp, street_comp=:street_comp, number_comp=:number_comp, postalcode_comp=:postalcode_comp, phone_comp=:phone_comp, image_comp=:image_comp WHERE id_comp=:id_comp";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_comp' => $company->__get('id'), ':name_comp' => $company->__get('name'), ':description_comp' => $company->__get('description'),
                                ':hours_comp' => $company->__get('hours'), ':city_comp' => $company->__get('city_comp'), ':street_comp' => $company->__get('street_comp'),
                                ':number_comp' => $company->__get('number_comp'), ':postalcode_comp' => $company->__get('postalcode_comp'), ':phone_comp' => $company->__get('phone_comp'), 
                                ':image_comp' => $company->__get('image')));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

    static public function deleteCompany(int $idCompany){
        $sql = "UPDATE companies SET deleted_comp=:deleted_comp WHERE id_comp=:id_comp";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_comp' => $idCompany, ':deleted_comp' => 1));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

    static public function getOneCompany($idCompany){
        $sql = "SELECT * FROM companies WHERE id_comp=:id_comp AND deleted_comp=0";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_comp' => $idCompany));
            $elem = $pdo_statement->fetch(PDO::FETCH_ASSOC);
            $values=array(
                "id" => $elem["id_comp"],  
                "name" => $elem["name_comp"],  
                "description" => $elem["description_comp"],  
                "hours" => $elem["hours_comp"], 
                "city" => $elem["city_comp"],
                "street" => $elem["street_comp"],
                "number" => $elem["number_comp"],
                "postalCode" => $elem["postalcode_comp"],
                "mail" => $elem["mail_comp"],
                "phone" => $elem["phone_comp"],
                "image" => $elem["image_comp"],
                "deleted" => $elem["deleted_comp"],
                "certified" => $elem["certified_comp"]
            );
            $company = new Company();
            $company->hydrate($values);
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
        return $company;
    }

    static public function getAllCompanies(){
        $result = array();
        $sql = "SELECT * FROM companies";
        try{
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute();
            $resultQuery = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultQuery as $elem){
                $values=array(
                    "id" => $elem["id_comp"],  
                    "name" => $elem["name_comp"],  
                    "description" => $elem["description_comp"],  
                    "hours" => $elem["hours_comp"], 
                    "city" => $elem["city_comp"],
                    "street" => $elem["street_comp"],
                    "number" => $elem["number_comp"],
                    "postalCode" => $elem["postalcode_comp"],
                    "phone" => $elem["phone_comp"],
                    "image" => $elem["image_comp"],
                    "mail" => $elem["mail_comp"],
                    "deleted" => $elem["deleted_comp"]
                );
                $company = new Company();
                $company->hydrate($values);
                array_push($result,$company);
            }
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
        return $result;
    }

    static public function getAllCompaniesAccordingTo($category, $subcategory){
        $result = array();
        $sql = "SELECT * FROM companies INNER JOIN appartient ON appartient.id_comp = companies.id_comp INNER JOIN categories ON categories.id_cat = appartient.id_cat WHERE categories.name_cat = :subcategory AND categories.parent_cat = :category ";
        try{
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':category' => $category, ':subcategory' => $subcategory));
            $resultQuery = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultQuery as $elem){
                $values=array(
                    "id" => $elem["id_comp"],  
                    "name" => $elem["name_comp"],  
                    "description" => $elem["description_comp"],  
                    "hours" => $elem["hours_comp"], 
                    "city" => $elem["city_comp"],
                    "street" => $elem["street_comp"],
                    "number" => $elem["number_comp"],
                    "postalCode" => $elem["postalcode_comp"],
                    "phone" => $elem["phone_comp"],
                    "image" => $elem["image_comp"],
                    "deleted" => $elem["deleted_comp"]
                );
                $company = new Company();
                $company->hydrate($values);
                array_push($result,$company);
            }
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
        return $result;
    }

    static public function editFavorite($idCompany, $idUser){
        if(companiesManager::favoriteExist($idCompany, $idUser))
            $sql = "DELETE FROM favoris WHERE favoris.id_comp = :id_comp AND favoris.id_user = :id_user";
        else
            $sql = "INSERT INTO favoris (id_user, id_comp) VALUES (:id_user, :id_comp)";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_user' => $idUser, ':id_comp' => $idCompany));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

    static public function favoriteExist($idCompany, $idUser){
        $sql = "SELECT COUNT(*) AS count FROM favoris WHERE favoris.id_comp = :id_comp AND favoris.id_user = :id_user ";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_user' => $idUser, ':id_comp' => $idCompany));
            $result = $pdo_statement->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
        if($result['count'] > 0) return true;
        else return false;
    }

    static public function getAllFavoriteCompaniesFor($idUser){
        $result = array();
        $sql = "SELECT * FROM companies INNER JOIN favoris ON favoris.id_comp = companies.id_comp WHERE favoris.id_user = :id_user";
        try{
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_user' => $idUser));
            $resultQuery = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultQuery as $elem){
                $values=array(
                    "id" => $elem["id_comp"],  
                    "name" => $elem["name_comp"],  
                    "description" => $elem["description_comp"],  
                    "hours" => $elem["hours_comp"], 
                    "city" => $elem["city_comp"],
                    "street" => $elem["street_comp"],
                    "number" => $elem["number_comp"],
                    "postalCode" => $elem["postalcode_comp"],
                    "phone" => $elem["phone_comp"],
                    "image" => $elem["image_comp"],
                    "deleted" => $elem["deleted_comp"]
                );
                $company = new Company();
                $company->hydrate($values);
                array_push($result,$company);
            }
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
        return $result;
    }

}

?>