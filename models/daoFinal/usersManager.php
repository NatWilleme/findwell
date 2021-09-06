<?php

abstract class UsersManager extends DBManager{
    
    static public function addUser($user){
        $sql = "INSERT INTO users (password_user, mail_user, type_user, code_user)
                VALUES (:password_user, :mail_user, :type_user, :code_user)";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $state = $pdo_statement->execute(array(':password_user' => password_hash($user->password, PASSWORD_DEFAULT),
                                ':mail_user' => $user->mail, ':type_user' => $user->type, ':code_user' => $user->code));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
        return $state;
    }

    static public function updateUser($user){
        $sql = "UPDATE users SET username_user=:username_user, phone_user=:phone_user, 
        street_user=:street_user, city_user=:city_user, state_user=:state_user, zip_user=:zip_user, 
         number_user=:number_user, image_user=:image_user WHERE id_user=:id_user";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':username_user' => $user->username, ':phone_user' => $user->phone, ':street_user' => $user->street,
                                ':city_user' => $user->city, ':state_user' => $user->state, ':zip_user' => $user->zip, ':id_user' => $user->id, ':number_user' => $user->number, ':image_user' => $user->image));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

    static public function updatePwd($mail, $password){
        $sql = "UPDATE users SET password_user=:password_user WHERE mail_user=:mail_user";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':password_user' => password_hash($password, PASSWORD_DEFAULT), ':mail_user' => $mail));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

    static public function confirmUser($idUser){
        $sql = "UPDATE users SET confirmed_user = 1 WHERE id_user=:id_user";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_user' => $idUser));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

    static public function getAllUser(){
        $result = array();
        $sql = "SELECT * FROM users";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute();
            $resultQuery = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultQuery as $elem){
                $values=array(
                    "id" => $elem["id_user"],  
                    "username" => $elem["username_user"],  
                    "password" => $elem["password_user"],  
                    "mail" => $elem["mail_user"], 
                    "image" => $elem["image_user"],
                    "phone" => $elem["phone_user"],
                    "street" => $elem["street_user"],
                    "number" => $elem["number_user"],
                    "state" => $elem["state_user"],
                    "zip" => $elem["zip_user"],
                    "city" => $elem["city_user"],
                    "type" => $elem["type_user"]
                );
                $user = new User();
                $user->hydrate($values);
                array_push($result, $user);
            }
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
        return $result;
    }

    static public function getUser($mail){
        $sql = "SELECT * FROM users WHERE mail_user=:mail_user";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':mail_user' => $mail));
            $elem = $pdo_statement->fetch(PDO::FETCH_ASSOC);
            $values=array(
                "id" => $elem["id_user"],  
                "username" => $elem["username_user"],  
                "password" => $elem["password_user"],  
                "mail" => $elem["mail_user"], 
                "image" => $elem["image_user"],
                "phone" => $elem["phone_user"],
                "street" => $elem["street_user"],
                "number" => $elem["number_user"],
                "state" => $elem["state_user"],
                "zip" => $elem["zip_user"],
                "city" => $elem["city_user"],
                "type" => $elem["type_user"],
                "confirmed" => $elem["confirmed_user"],
                "code" => $elem["code_user"]
            );
            $user = new User();
            $user->hydrate($values);
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
        return $user;
    }

    static public function getUserByID($id){
        $sql = "SELECT * FROM users WHERE id_user=:id_user";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_user' => $id));
            $elem = $pdo_statement->fetch(PDO::FETCH_ASSOC);
            $values=array(
                "id" => $elem["id_user"],  
                "username" => $elem["username_user"],  
                "password" => $elem["password_user"],  
                "mail" => $elem["mail_user"], 
                "image" => $elem["image_user"],
                "phone" => $elem["phone_user"],
                "street" => $elem["street_user"],
                "number" => $elem["number_user"],
                "state" => $elem["state_user"],
                "zip" => $elem["zip_user"],
                "city" => $elem["city_user"],
                "type" => $elem["type_user"],
                "confirmed" => $elem["confirmed_user"],
                "code" => $elem["code_user"]
            );
            $user = new User();
            $user->hydrate($values);
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
        return $user;
    }

    static public function checkIfExist($mail){
        $sql = "SELECT COUNT(*) AS count FROM users WHERE mail_user=:mail_user";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':mail_user' => $mail));
            $result = $pdo_statement->fetch(PDO::FETCH_ASSOC);
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