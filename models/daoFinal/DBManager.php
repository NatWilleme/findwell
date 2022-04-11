<?php

abstract class DBManager{
    static public function connexionDB(){
        $host = "localhost";
        $login = "root";
        $pwd = "";
        $DB = "findw1710907";
        // $host = "91.216.107.184";
        // $login = "findw1710907";
        // $pwd = "fH3*1Z_Wja6x3Ce";
        // $DB = "findw1710907";

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