<?php

require_once('../models/dao/DBManager.php');

abstract class UsersManager extends DBManager{
    
    static public function addUser($user){
        $sql = "INSERT INTO users (username_user, password_user, mail_user, image_user)
                VALUES (:username_user, :password_user, :mail_user, :image_user)";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':username_user' => $company->__get('username'), ':password_user' => $company->__get('password'),
                                ':mail_user' => $company->__get('mail'), ':image_user' => $company->__get('image')));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

    static public function updateUser($user){
        $sql = "UPDATE users SET username_user=:username_user, password_user=:password_user, mail_user=:mail_user,
                image_user=:image_user WHERE id_user=:id_user";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':username_user' => $company->__get('username'), ':password_user' => $company->__get('password'), ':mail_user' => $company->__get('mail'),
                                ':image_user' => $company->__get('image')));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

    static public function getOneUser($idUser){
        $sql = "SELECT * FROM users WHERE id_user=:id_user";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_user' => $idUser));
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

}

?>