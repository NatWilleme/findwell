<?php

abstract class ToastMessageManager extends DBManager{
    
    static public function addToastMessage(ToastMessage $toastMessage){
        $sql = "INSERT INTO toastmessage (message_tm, image_tm, active_tm) VALUES (:message, :image, :active)";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(
                ':message' => $toastMessage->__get('message'),
                ':image' => $toastMessage->__get('image'),
                ':active' => $toastMessage->__get('active')
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

    static public function updateToastMessage(ToastMessage $toastMessage){
        $sql = "UPDATE toastmessage SET message_tm=:message, image_tm=:image, active_tm=:active WHERE id_tm=:id";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(
                ':message' => $toastMessage->__get('message'),
                ':image' => $toastMessage->__get('image'),
                ':active' => $toastMessage->__get('active'),
                ':id' => $toastMessage->__get('id')
            ));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

    //delete toast message by id
    static public function deleteToastMessage(int $id){
        $sql = "DELETE FROM toastmessage WHERE id_tm = :id_tm";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_tm' => $id));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

    //get all toast messages
    static public function getAllToastMessages(){
        $sql = "SELECT * FROM toastmessage";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute();
            $result = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
            $toastMessages = array();
            foreach ($result as $row){
                $values=array(
                    "id" => $row["id_tm"],  
                    "message" => $row["message_tm"],
                    "image" => $row["image_tm"],
                    "active" => $row["active_tm"]
                );
                $toastMessage = new ToastMessage();
                $toastMessage->hydrate($values);
                $toastMessages[] = $toastMessage;
            }
            return $toastMessages;
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

    //get last 5 toast messages
    static public function getAllActiveToastMessages(){
        $sql = "SELECT * FROM toastmessage WHERE active_tm = 1 ORDER BY id_tm DESC";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute();
            $result = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
            $toastMessages = array();
            
            foreach ($result as $row){
                $values=array(
                    "id" => $row["id_tm"], 
                    "message" => $row["message_tm"],
                    "image" => $row["image_tm"],
                    "active" => $row["active_tm"]
                );
                $toastMessage = new ToastMessage();
                $toastMessage->hydrate($values);
                array_push($toastMessages, $toastMessage);
            }
            return $toastMessages;
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

    //get toast message by id
    static public function getToastMessageById(int $id){
        $sql = "SELECT * FROM toastmessage WHERE id_tm = :id_tm";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_tm' => $id));
            $result = $pdo_statement->fetch(PDO::FETCH_ASSOC);
            $values=array(
                "id" => $result["id_tm"],
                "message" => $result["message_tm"],
                "image" => $result["image_tm"],
                "active" => $result["active_tm"]
            );
            $toastMessage = new ToastMessage();
            $toastMessage->hydrate($values);
            return $toastMessage;
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

}

?>