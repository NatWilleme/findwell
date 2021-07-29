<?php

require_once('../models/dao/DBManager.php');

abstract class UsersManager extends DBManager{
    
    static public function addUser($user){
        $sql = "INSERT INTO users (password_user, mail_user)
                VALUES (:password_user, :mail_user)";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $state = $pdo_statement->execute(array(':password_user' => password_hash($user->password, PASSWORD_DEFAULT),
                                ':mail_user' => $user->mail));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
        return $state;
    }

    static public function updateUser($user){
        $sql = "UPDATE users SET username_user=:username_user, password_user=:password_user, mail_user=:mail_user,
                image_user=:image_user WHERE id_user=:id_user";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':username_user' => $user->username, ':password_user' => $user->password, ':mail_user' => $user->mail,
                                ':image_user' => $user->image));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
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
                "image" => $elem["image_user"]
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