<?php 

    abstract class ServicesManager extends DBManager{

        static public function getAllServices(){
            $result = array();
            $sql = "SELECT * FROM services INNER JOIN users ON users.id_user = services.id_user";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute();
                $resultQuery = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultQuery as $elem){
                    $values=array(
                        "idService" => $elem["id_serv"],  
                        "title" => $elem["title_serv"],  
                        "description" => $elem["description_serv"],  
                        "date" => $elem["date_serv"],
                        "region" => $elem["region_serv"],  
                        "idUser" => $elem["id_user"],  
                        "username" => $elem["username_user"],  
                        "mail" => $elem["mail_user"], 
                        "imageService" => $elem["image_serv"],
                        "imageUser" => $elem["image_user"],
                        "phone" => $elem["phone_user"],
                        "type" => $elem["type_user"]
                    );
                    $service = new Service();
                    $service->hydrate($values);
                    array_push($result,$service);
                }
            } catch (Exception $e) {
                die($e->getMessage());
            } finally{
                $pdo_statement->closeCursor();
                $pdo_statement = null;
            }
            return $result;
        }

        static public function getAllServicesForCategory(string $category){
            $result = array();
            $sql = "SELECT * FROM services INNER JOIN servicescategories ON servicescategories.id_serv = services.id_serv INNER JOIN categories ON categories.id_cat = servicescategories.id_cat INNER JOIN users ON users.id_user = services.id_user WHERE categories.parent_cat LIKE 'Service' AND categories.name_cat = :category_name";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute(array(':category_name' => $category));
                $resultQuery = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultQuery as $elem){
                    $values=array(
                        "idService" => $elem["id_serv"],  
                        "title" => $elem["title_serv"],  
                        "description" => $elem["description_serv"],  
                        "date" => $elem["date_serv"],
                        "region" => $elem["region_serv"],  
                        "idUser" => $elem["id_user"], 
                        "imageUser" => $elem["image_user"],  
                        "username" => $elem["username_user"],  
                        "imageService" => $elem["image_serv"]
                    );
                    $service = new Service();
                    $service->hydrate($values);
                    array_push($result,$service);
                }
            } catch (Exception $e) {
                die($e->getMessage());
            } finally{
                $pdo_statement->closeCursor();
                $pdo_statement = null;
            }
            return $result;
        }

        static public function getServicesByID(int $id){
            $sql = "SELECT * FROM services INNER JOIN users ON users.id_user = services.id_user WHERE services.id_serv = :id_user";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute(array(':id_user' => $id));
                $elem = $pdo_statement->fetch(PDO::FETCH_ASSOC);
                $values=array(
                    "idService" => $elem["id_serv"],  
                    "title" => $elem["title_serv"],  
                    "description" => $elem["description_serv"],  
                    "date" => $elem["date_serv"],
                    "region" => $elem["region_serv"],  
                    "idUser" => $elem["id_user"],  
                    "username" => $elem["username_user"],  
                    "mail" => $elem["mail_user"], 
                    "imageService" => $elem["image_serv"],
                    "imageUser" => $elem["image_user"],
                    "phone" => $elem["phone_user"],
                    "type" => $elem["type_user"]
                );
                $service = new Service();
                $service->hydrate($values);
            } catch (Exception $e) {
                die($e->getMessage());
            } finally{
                $pdo_statement->closeCursor();
                $pdo_statement = null;
            }
            return $service;
        }

    }

?>