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
                        "price" => $elem["price_occ"],  
                        "imageOccasion" => $elem["image_occ"]
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

        static public function getAllOccasionsOfUser(int $îdUser){
            $result = array();
            $sql = "SELECT * FROM occasions WHERE id_user = :id_user";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute(array(':id_user' => $îdUser));
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
                        "imageOccasion" => $elem["image_occ"]
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
                if($elem){
                    $values=array(
                        "idOccasion" => $elem["id_occ"],  
                        "title" => $elem["title_occ"],  
                        "description" => $elem["description_occ"],  
                        "date" => $elem["date_occ"],
                        "region" => $elem["region_occ"],
                        "price" => $elem["price_occ"],  
                        "idUser" => $elem["id_user"],  
                        "username" => $elem["username_user"],  
                        "mail" => $elem["mail_occ"], 
                        "imageOccasion" => $elem["image_occ"],
                        "imageUser" => $elem["image_user"],
                        "phone" => $elem["phone_occ"],
                        "type" => $elem["type_user"]
                    );
                    $occasion = new Occasion();
                    $occasion->hydrate($values);
                } else {
                    $occasion = null;
                }
                
            } catch (Exception $e) {
                die($e->getMessage());
            } finally{
                $pdo_statement->closeCursor();
                $pdo_statement = null;
            }
            return $occasion;
        }

        static public function addOccasion(Occasion $newOccasion){
            $sql = "INSERT INTO occasions (title_occ, description_occ, image_occ, price_occ, id_user, date_occ, region_occ, mail_occ, phone_occ) 
                    VALUES (:title_occ, :description_occ, :image_occ, :price_occ, :id_user, :date_occ, :region_occ, :mail_occ, :phone_occ)";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute(array(
                    ':title_occ' => $newOccasion->title,
                    ':description_occ' => $newOccasion->description, 
                    ':image_occ' => serialize($newOccasion->imageOccasion),
                    ':price_occ' => $newOccasion->price,
                    ':id_user' => $_SESSION['user']->id,
                    ':date_occ' => date_format(date_create(), 'Y/m/d'),
                    ':region_occ' => $newOccasion->region,
                    ':mail_occ' => $newOccasion->mail,
                    ':phone_occ' => $newOccasion->phone
                ));
                
            } catch (Exception $e) {
                die($e->getMessage());
            } finally{
                $pdo_statement->closeCursor();
                $pdo_statement = null;
            }
        }

        static public function editOccasion(Occasion $occasionToEdit){
            $sql = "UPDATE occasions SET title_occ = :title_occ, description_occ = :description_occ, image_occ = :image_occ, price_occ = :price_occ, id_user = :id_user,
                    date_occ = :date_occ, region_occ = :region_occ, mail_occ = :mail_occ, phone_occ = :phone_occ WHERE id_occ = :id_occ";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute(array(
                    ':id_occ' => $occasionToEdit->idOccasion,
                    ':title_occ' => $occasionToEdit->title,
                    ':description_occ' => $occasionToEdit->description, 
                    ':image_occ' => serialize($occasionToEdit->imageOccasion),
                    ':price_occ' => $occasionToEdit->price,
                    ':id_user' => $_SESSION['user']->id,
                    ':date_occ' => date_format(date_create(), 'Y/m/d'),
                    ':region_occ' => $occasionToEdit->region,
                    ':mail_occ' => $occasionToEdit->mail,
                    ':phone_occ' => $occasionToEdit->phone
                ));
                
            } catch (Exception $e) {
                die($e->getMessage());
            } finally{
                $pdo_statement->closeCursor();
                $pdo_statement = null;
            }
        }

        static public function deleteOccasion($id)
        {
            $sql = "DELETE FROM occasions WHERE id_occ = :id_occ";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute(array(
                    ':id_occ' => $id
                ));
                
            } catch (Exception $e) {
                die($e->getMessage());
            } finally{
                $pdo_statement->closeCursor();
                $pdo_statement = null;
            }
        }
    }

?>