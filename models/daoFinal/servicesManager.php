<?php 

    abstract class ServicesManager extends DBManager{

        static public function addService(Service $newService){
            $sql = "INSERT INTO services (title_serv, description_serv, date_serv, region_serv, image_serv, id_user, phone_serv, mail_serv)
                    VALUES (:title_serv, :description_serv, :date_serv, :region_serv, :image_serv, :id_user, :phone_serv, :mail_serv)";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute(array(
                    ':title_serv' => $newService->title,
                    ':description_serv' => $newService->description,
                    ':date_serv' => date_format(date_create(), 'Y/m/d'), 
                    ':region_serv' => $newService->region,
                    ':image_serv' => serialize($newService->imageService), 
                    ':id_user' => $newService->idUser,
                    ':phone_serv' => $newService->phone,
                    ':mail_serv' => $newService->mail
                ));
                $lastId = $pdo_connexion->lastInsertId();
            } catch (Exception $e) {
                die($e->getMessage());
            } finally{
                $pdo_statement->closeCursor();
                $pdo_statement = null;
            }
            return $lastId;
        }

        static public function editService(Service $serviceToEdit){
            $sql = "UPDATE services SET title_serv = :title_serv, description_serv = :description_serv, date_serv = :date_serv, 
                    region_serv = :region_serv, image_serv = :image_serv, id_user = :id_user, phone_serv = :phone_serv, mail_serv = :mail_serv WHERE id_serv=:id_serv";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute(array(
                    ':id_serv' => $serviceToEdit->idService,
                    ':title_serv' => $serviceToEdit->title,
                    ':description_serv' => $serviceToEdit->description,
                    ':date_serv' => date_format(date_create(), 'Y/m/d'), 
                    ':region_serv' => $serviceToEdit->region,
                    ':image_serv' => serialize($serviceToEdit->imageService), 
                    ':id_user' => $serviceToEdit->idUser,
                    ':phone_serv' => $serviceToEdit->phone,
                    ':mail_serv' => $serviceToEdit->mail
                ));
            } catch (Exception $e) {
                die($e->getMessage());
            } finally{
                $pdo_statement->closeCursor();
                $pdo_statement = null;
            }
        }

        static public function addLinkServiceCategory($idService, $idCategory){
            $sql = "INSERT INTO servicescategories (id_serv, id_cat) VALUES (:id_serv, :id_cat)";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $isSuccess = $pdo_statement->execute(array(
                    ':id_serv' => $idService,
                    ':id_cat' => $idCategory
                ));
            } catch (Exception $e) {
                die($e->getMessage());
            } finally{
                $pdo_statement->closeCursor();
                $pdo_statement = null;
            }
            return $isSuccess;
        }

        static public function delAllLinkServiceCategory($idService){
            $sql = "DELETE FROM servicescategories WHERE id_serv = :id_serv";
            try {
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute(array(':id_serv' => $idService));
            } catch (Exception $e) {
                die($e->getMessage());
            } finally{
                $pdo_statement->closeCursor();
                $pdo_statement = null;
            }
        }

        static public function getCategoriesForService(int $idService){
            $result = array();
            $sql = "SELECT * FROM servicescategories WHERE id_serv = :id_serv";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute(array(':id_serv' => $idService));
                $resultQuery = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultQuery as $elem){
                    array_push($result, $elem['id_cat']);
                }
            } catch (Exception $e) {
                die($e->getMessage());
            } finally{
                $pdo_statement->closeCursor();
                $pdo_statement = null;
            }
            return $result;
        }

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
                        "mail" => $elem["mail_serv"], 
                        "imageService" => $elem["image_serv"],
                        "imageUser" => $elem["image_user"],
                        "phone" => $elem["phone_serv"],
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
                        "imageService" => $elem["image_serv"],
                        "mail" => $elem["mail_serv"],
                        "phone" => $elem["phone_serv"]
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

        static public function getAllServicesOfUser(int $idUser){
            $result = array();
            $sql = "SELECT * FROM services WHERE id_user = :id_user";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute(array(':id_user' => $idUser));
                $resultQuery = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultQuery as $elem){
                    $values=array(
                        "idService" => $elem["id_serv"],  
                        "title" => $elem["title_serv"],  
                        "description" => $elem["description_serv"],  
                        "date" => $elem["date_serv"],
                        "region" => $elem["region_serv"],  
                        "idUser" => $elem["id_user"], 
                        "imageService" => $elem["image_serv"],
                        "mail" => $elem["mail_serv"],
                        "phone" => $elem["phone_serv"]
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
            $sql = "SELECT * FROM services INNER JOIN users ON users.id_user = services.id_user INNER JOIN servicescategories ON servicescategories.id_serv = :id_serv WHERE services.id_serv = :id_serv";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute(array(':id_serv' => $id));
                $elem = $pdo_statement->fetch(PDO::FETCH_ASSOC);
                if($elem){
                    $values=array(
                        "idService" => $elem["id_serv"],  
                        "title" => $elem["title_serv"],  
                        "description" => $elem["description_serv"],  
                        "date" => $elem["date_serv"],
                        "region" => $elem["region_serv"],  
                        "idUser" => $elem["id_user"],  
                        "username" => $elem["username_user"],  
                        "mail" => $elem["mail_serv"], 
                        "imageService" => $elem["image_serv"],
                        "imageUser" => $elem["image_user"],
                        "phone" => $elem["phone_serv"],
                        "type" => $elem["type_user"]
                    );
                    $service = new Service();
                    $service->hydrate($values);
                    $service->idCategories = ServicesManager::getCategoriesForService($id);
                } else {
                    $service = null;    
                }
            } catch (Exception $e) {
                die($e->getMessage());
            } finally{
                $pdo_statement->closeCursor();
                $pdo_statement = null;
            }
            return $service;
        }

        static public function deleteService(int $id){
            $sql = "DELETE FROM services WHERE id_serv = :id_serv";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute(array(':id_serv' => $id));
            } catch (Exception $e) {
                die($e->getMessage());
            } finally{
                $pdo_statement->closeCursor();
                $pdo_statement = null;
            }
        }
    }

?>