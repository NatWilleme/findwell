<?php 

    abstract class ImmobilierManager extends DBManager{

        static public function getAllImmobilier(){
            $result = array();
            $sql = "SELECT * FROM immobilier INNER JOIN users ON users.id_user = immobilier.id_user";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute();
                $resultQuery = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultQuery as $elem){
                    $values=array(
                        "id" => $elem["id_immo"],  
                        "title" => $elem["title_immo"],  
                        "description" => $elem["description_immo"],  
                        "region" => $elem["region_immo"],  
                        "price" => $elem["price_immo"],  
                        "images" => $elem["images_immo"],
                        "type" => $elem["type_immo"]
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

        static public function getImmobilierById(int $id){
            $result = array();
            $sql = "SELECT * FROM immobilier WHERE id_immo = :id_immo";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute(array(':id_immo' => $id));
                $resultQuery = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultQuery as $elem){
                    $values=array(
                        "id" => $elem["id_immo"],  
                        "title" => $elem["title_immo"],  
                        "description" => $elem["description_immo"],  
                        "region" => $elem["region_immo"],  
                        "price" => $elem["price_immo"],  
                        "images" => $elem["images_immo"],
                        "type" => $elem["type_immo"],
                        "idUser" => $elem["id_user"],
                        "date" => $elem["date_immo"],
                        "mail" => $elem["mail_immo"],
                        "phone" => $elem["phone_immo"]
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

        static public function addImmobilier(Immobilier $immobilier){
            $sql = "INSERT INTO immobilier (title_immo,description_immo,region_immo,price_immo,images_immo,type_immo,id_user,date_immo,mail_immo,phone_immo) 
                VALUES (:title_immo,:description_immo,:region_immo,:price_immo,:images_immo,:type_immo,:id_user,:date_immo,:mail_immo,:phone_immo)";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute(array(
                    ':title_immo' => $immobilier->__get('title'),
                    ':description_immo' => $immobilier->__get('description'),
                    ':region_immo' => $immobilier->__get('region'),
                    ':price_immo' => $immobilier->__get('price'),
                    ':images_immo' => $immobilier->__get('images'),
                    ':type_immo' => $immobilier->__get('type'),
                    ':id_user' => $immobilier->__get('idUser'),
                    ':date_immo' => $immobilier->__get('date'),
                    ':mail_immo' => $immobilier->__get('mail'),
                    ':phone_immo' => $immobilier->__get('phone')
                ));
            } catch (Exception $e) {
                die($e->getMessage());
            } finally{
                $pdo_statement->closeCursor();
                $pdo_statement = null;
            }
        }

        static public function updateImmobilier(Immobilier $immobilier){
            $sql = "UPDATE immobilier SET title_immo = :title_immo, description_immo = :description_immo, region_immo = :region_immo, price_immo = :price_immo, images_immo = :images_immo, type_immo = :type_immo, id_user = :id_user, date_immo = :date_immo, mail_immo = :mail_immo, phone_immo = :phone_immo WHERE id_immo = :id_immo";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute(array(
                    ':title_immo' => $immobilier->__get('title'),
                    ':description_immo' => $immobilier->__get('description'),
                    ':region_immo' => $immobilier->__get('region'),
                    ':price_immo' => $immobilier->__get('price'),
                    ':images_immo' => $immobilier->__get('images'),
                    ':type_immo' => $immobilier->__get('type'),
                    ':id_user' => $immobilier->__get('idUser'),
                    ':date_immo' => $immobilier->__get('date'),
                    ':mail_immo' => $immobilier->__get('mail'),
                    ':phone_immo' => $immobilier->__get('phone'),
                    ':id_immo' => $immobilier->__get('id')
                ));
            } catch (Exception $e) {
                die($e->getMessage());
            } finally{
                $pdo_statement->closeCursor();
                $pdo_statement = null;
            }
        }

        static public function deleteImmobilier(int $id){
            $sql = "DELETE FROM immobilier WHERE id_immo = :id_immo";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute(array(':id_immo' => $id));
            } catch (Exception $e) {
                die($e->getMessage());
            } finally{
                $pdo_statement->closeCursor();
                $pdo_statement = null;
            }
        }
    }

?>