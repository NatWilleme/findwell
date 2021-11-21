<?php 

    abstract class MaterialsManager extends DBManager{

        static public function getAllMaterials(){
            $result = array();
            $sql = "SELECT * FROM materials INNER JOIN companies ON companies.id_comp = materials.id_comp";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute();
                $resultQuery = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultQuery as $elem){
                    $values=array(
                        "idMaterial" => $elem["id_mat"],  
                        "title" => $elem["title_mat"],  
                        "description" => $elem["description_mat"],  
                        "date" => $elem["date_mat"], 
                        "price" => $elem["price_mat"],
                        "idCompany" => $elem["id_comp"],  
                        "nameCompany" => $elem["name_comp"],  
                        "mail" => $elem["mail_comp"], 
                        "region" => $elem["city_comp"],
                        "imageMaterial" => $elem["image_mat"],
                        "imageCompany" => $elem["image_comp"],
                        "phone" => $elem["phone_comp"]
                    );
                    $material = new Material();
                    $material->hydrate($values);
                    array_push($result,$material);
                }
            } catch (Exception $e) {
                die($e->getMessage());
            } finally{
                $pdo_statement->closeCursor();
                $pdo_statement = null;
            }
            return $result;
        }

        static public function getMaterialByID(int $id){
            $sql = "SELECT * FROM materials INNER JOIN companies ON companies.id_comp = materials.id_comp WHERE materials.id_mat = :id_mat";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute(array(':id_mat' => $id));
                $elem = $pdo_statement->fetch(PDO::FETCH_ASSOC);
                $values=array(
                    "idMaterial" => $elem["id_mat"],  
                    "title" => $elem["title_mat"],  
                    "description" => $elem["description_mat"],  
                    "date" => $elem["date_mat"], 
                    "price" => $elem["price_mat"],
                    "idCompany" => $elem["id_comp"],  
                    "nameCompany" => $elem["name_comp"],  
                    "mail" => $elem["mail_comp"], 
                    "imageMaterial" => $elem["image_mat"],
                    "region" => $elem["city_comp"],
                    "imageCompany" => $elem["image_comp"],
                    "phone" => $elem["phone_comp"]
                );
                $material = new Material();
                $material->hydrate($values);
            } catch (Exception $e) {
                die($e->getMessage());
            } finally{
                $pdo_statement->closeCursor();
                $pdo_statement = null;
            }
            return $material;
        }

        static public function getAllMaterialsForCategory(string $category){
            $result = array();
            $sql = "SELECT * FROM materials INNER JOIN materialscategories ON materialscategories.id_mat = materials.id_mat INNER JOIN categories ON categories.id_cat = materialscategories.id_cat INNER JOIN companies ON companies.id_comp = materials.id_comp WHERE categories.parent_cat LIKE 'Materiel' AND categories.name_cat = :category_name";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute(array(':category_name' => $category));
                $resultQuery = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultQuery as $elem){
                    $values=array(
                        "idMaterial" => $elem["id_mat"],  
                        "title" => $elem["title_mat"],  
                        "description" => $elem["description_mat"],  
                        "date" => $elem["date_mat"], 
                        "price" => $elem["price_mat"],
                        "idCompany" => $elem["id_comp"],  
                        "nameCompany" => $elem["name_comp"],  
                        "mail" => $elem["mail_comp"], 
                        "imageMaterial" => $elem["image_mat"],
                        "imageCompany" => $elem["image_comp"],
                        "region" => $elem["city_comp"],
                        "phone" => $elem["phone_comp"]
                    );
                    $material = new Material();
                    $material->hydrate($values);
                    array_push($result,$material);
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