<?php 

    abstract class OccasionsManager extends DBManager{

        static public function getAllOccasions(){
            $result = array();
            $sql = "SELECT * FROM occasions INNER JOIN users ON users.id_user = occasions.id_user";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute();
                $resultQuery = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultQuery as $elem){
                    $values=array(
                        "idOccasion" => $elem["id_occ"],  
                        "title" => $elem["title_occ"],  
                        "description" => $elem["description_occ"],  
                        "date" => $elem["date_occ"],
                        "region" => $elem["region_occ"],  
                        "price" => $elem["price_occ"],  
                        "idUser" => $elem["id_user"],  
                        "username" => $elem["username_user"],  
                        "mail" => $elem["mail_user"], 
                        "imageOccasion" => $elem["image_occ"],
                        "imageUser" => $elem["image_user"],
                        "phone" => $elem["phone_user"],
                        "type" => $elem["type_user"]
                    );
                    $occasion = new Occasion();
                    $occasion->hydrate($values);
                    array_push($result,$occasion);
                }
            } catch (Exception $e) {
                die($e->getMessage());
            } finally{
                $pdo_statement->closeCursor();
                $pdo_statement = null;
            }
            return $result;
        }

        static public function getOccasionByID(int $id){
            $sql = "SELECT * FROM occasions INNER JOIN users ON users.id_user = occasions.id_user WHERE occasions.id_occ = :id_user";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute(array(':id_user' => $id));
                $elem = $pdo_statement->fetch(PDO::FETCH_ASSOC);
                $values=array(
                    "idOccasion" => $elem["id_occ"],  
                    "title" => $elem["title_occ"],  
                    "description" => $elem["description_occ"],  
                    "date" => $elem["date_occ"],
                    "region" => $elem["region_occ"],
                    "price" => $elem["price_occ"],  
                    "idUser" => $elem["id_user"],  
                    "username" => $elem["username_user"],  
                    "mail" => $elem["mail_user"], 
                    "imageOccasion" => $elem["image_occ"],
                    "imageUser" => $elem["image_user"],
                    "phone" => $elem["phone_user"],
                    "type" => $elem["type_user"]
                );
                $occasion = new Occasion();
                $occasion->hydrate($values);
            } catch (Exception $e) {
                die($e->getMessage());
            } finally{
                $pdo_statement->closeCursor();
                $pdo_statement = null;
            }
            return $occasion;
        }

    }

?>