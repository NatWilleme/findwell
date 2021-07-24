<?php

abstract class DBManager{
    static public function connexionDB(){
        $host = "localhost";
        $login = "root";
        $pwd = "";
        $DB = "findwell";

        try {
            $pdo = new PDO("mysql:host=$host;dbname=$DB;charset=utf8", $login, $pwd);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (\Throwable $errorMsg) {
            die("Echec de la connexion à la DB $host : ".$errorMsg->getMessage());
        }   
    }
}

?>