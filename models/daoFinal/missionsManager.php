<?php 

    abstract class MissionsManager extends DBManager{

        static public function addMission(Mission $newMission){
            $sql = "INSERT INTO mission (title_mis, description_mis, image_mis, price_mis, id_user, date_mis, region_mis, mail_mis, phone_mis, accessibility_mis, buildingType_mis)
                    VALUES (:title_mis, :description_mis, :image_mis, :price_mis, :id_user, :date_mis, :region_mis, :mail_mis, :phone_mis, :accessibility_mis, :buildingType_mis)";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute(array(
                    ':title_mis' => $newMission->title,
                    ':description_mis' => $newMission->description,
                    ':date_mis' => date_format(date_create(), 'Y/m/d H:i:s'), 
                    ':region_mis' => $newMission->region,
                    ':image_mis' => serialize($newMission->images), 
                    ':id_user' => $newMission->idUser,
                    ':phone_mis' => $newMission->phone,
                    ':mail_mis' => $newMission->mail,
                    ':price_mis' => $newMission->price,
                    ':accessibility_mis' => $newMission->accessibility,
                    ':buildingType_mis' => $newMission->buildingType,
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

        static public function editMission(Mission $missionToEdit){
            print_r($missionToEdit);
            $sql = "UPDATE mission SET title_mis = :title_mis, description_mis = :description_mis, 
                    region_mis = :region_mis, image_mis = :image_mis, phone_mis = :phone_mis, mail_mis = :mail_mis, price_mis = :price_mis, 
                    accessibility_mis = :accessibility_mis, buildingType_mis = :buildingType_mis WHERE id_mis=:id_mis";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute(array(
                    ':title_mis' => $missionToEdit->title,
                    ':description_mis' => $missionToEdit->description,
                    ':region_mis' => $missionToEdit->region,
                    ':image_mis' => serialize($missionToEdit->images), 
                    ':phone_mis' => $missionToEdit->phone,
                    ':mail_mis' => $missionToEdit->mailMission,
                    ':price_mis' => $missionToEdit->price,
                    ':accessibility_mis' => $missionToEdit->accessibility,
                    ':buildingType_mis' => $missionToEdit->buildingType,
                    ':id_mis' => $missionToEdit->id,
                ));
            } catch (Exception $e) {
                die($e->getMessage());
            } finally{
                $pdo_statement->closeCursor();
                $pdo_statement = null;
            }
        }

        static public function getAllMissions(){
            $result = array();
            $sql = "SELECT * FROM mission INNER JOIN users ON users.id_user = mission.id_user";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute();
                $resultQuery = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultQuery as $elem){
                    $values=array(
                        'id' => $elem['id_mis'],
                        'title' => $elem['title_mis'],
                        'description' => $elem['description_mis'],
                        'date' => $elem['date_mis'],
                        'price' => $elem['price_mis'],
                        'region' => $elem['region_mis'],
                        'idUser' => $elem['id_user'],
                        'username' => $elem['username_user'],
                        'mail' => $elem['mail_mis'],
                        'phone' => $elem['phone_mis'],
                        'images' => unserialize($elem['image_mis']),
                        // 'images' => $elem['image_mis'],
                        'imageUser' => $elem['image_user'],
                        'accessibility' => $elem['accessibility_mis'],
                        'buildingType' => $elem['buildingType_mis']
                    );
                    $mission = new Mission();
                    $mission->hydrate($values);
                    array_push($result,$mission);
                }
            } catch (Exception $e) {
                die($e->getMessage());
            } finally{
                $pdo_statement->closeCursor();
                $pdo_statement = null;
            }
            return $result;
        }

        static public function getAllMissionsOfUser(int $idUser){
            $result = array();
            $sql = "SELECT * FROM mission WHERE id_user = :id_user";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute(array(':id_user' => $idUser));
                $resultQuery = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
                foreach ($resultQuery as $elem){
                    $values=array(
                        'id' => $elem['id_mis'],
                        'title' => $elem['title_mis'],
                        'description' => $elem['description_mis'],
                        'date' => $elem['date_mis'],
                        'price' => $elem['price_mis'],
                        'region' => $elem['region_mis'],
                        'idUser' => $elem['id_user'],
                        'mail' => $elem['mail_mis'],
                        'phone' => $elem['phone_mis'],
                        'images' => unserialize($elem['image_mis']),
                        'accessibility' => $elem['accessibility_mis'],
                        'buildingType' => $elem['buildingType_mis'],
                    );
                    $mission = new Mission();
                    $mission->hydrate($values);
                    array_push($result,$mission);
                }
            } catch (Exception $e) {
                die($e->getMessage());
            } finally{
                $pdo_statement->closeCursor();
                $pdo_statement = null;
            }
            return $result;
        }

        static public function getMissionByID(int $id){
            $sql = "SELECT * FROM mission INNER JOIN users ON users.id_user = mission.id_user WHERE mission.id_mis = :id_mis";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute(array(':id_mis' => $id));
                $elem = $pdo_statement->fetch(PDO::FETCH_ASSOC);
                if($elem){
                    $values=array(
                        'id' => $elem['id_mis'],
                        'title' => $elem['title_mis'],
                        'description' => $elem['description_mis'],
                        'date' => $elem['date_mis'],
                        'price' => $elem['price_mis'],
                        'region' => $elem['region_mis'],
                        'idUser' => $elem['id_user'],
                        'username' => $elem['username_user'],
                        'mailMission' => $elem['mail_mis'],
                        'mailCompany' => $elem['mail_user'],
                        'phone' => $elem['phone_mis'],
                        'images' => unserialize($elem['image_mis']),
                        'imageUser' => $elem['image_user'],
                        'accessibility' => $elem['accessibility_mis'],
                        'buildingType' => $elem['buildingType_mis'],
                    );
                    $mission = new Mission();
                    $mission->hydrate($values);
                } else {
                    $mission = null;    
                }
            } catch (Exception $e) {
                die($e->getMessage());
            } finally{
                $pdo_statement->closeCursor();
                $pdo_statement = null;
            }
            return $mission;
        }

        static public function deleteMission(int $id){
            $sql = "DELETE FROM mission WHERE id_mis = :id_mis";
            try{
                $pdo_connexion = parent::connexionDB();
                $pdo_statement = $pdo_connexion->prepare($sql);
                $pdo_statement->execute(array(':id_mis' => $id));
            } catch (Exception $e) {
                die($e->getMessage());
            } finally{
                $pdo_statement->closeCursor();
                $pdo_statement = null;
            }
        }
    }

?>