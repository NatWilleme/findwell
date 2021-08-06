<?php

require_once('../models/dao/DBManager.php');

abstract class CategoriesManager extends DBManager{

    static public function getAllDomainesForCompany($idCompany){
        $result = array();
        $sql = "SELECT categories.name_cat FROM categories INNER JOIN appartient ON appartient.id_cat = categories.id_cat WHERE appartient.id_comp = :id_comp ORDER BY categories.name_cat";
        try{
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_comp' => $idCompany));
            $resultQuery = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultQuery as $elem){
                array_push($result,$elem["name_cat"]);
            }
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
        return $result;
    }

    static public function getAllSubcategoriesFor($categoryName){
        $result = array();
        $sql = "SELECT * FROM categories WHERE categories.parent_cat = :name_cat ORDER BY categories.name_cat";
        try{
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':name_cat' => $categoryName));
            $resultQuery = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultQuery as $elem){
                $values=array(
                    "id" => $elem['id_cat'],
                    "name" => $elem['name_cat'],
                    "parentName" => $elem['parent_cat'],
                    "image" => $elem['image_cat']
                );
                $category = new Category();
                $category->hydrate($values);
                array_push($result,$category);
            }
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
        return $result;
    }

    static public function addLinkCatComp($id_comp, $id_cat){
        $sql = "INSERT INTO appartient (id_cat, id_comp)
                VALUES (:id_cat, :id_comp)";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_cat' => $id_cat, ':id_comp' => $id_comp));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }
}

?>