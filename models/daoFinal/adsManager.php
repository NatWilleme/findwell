<?php

abstract class AdsManager extends DBManager{
    
    static public function addAd(Ad $ad){
        $sql = "INSERT INTO ads (id_comp, imagePC_ads, imageMobile_ads, display_ads)
                VALUES (:id_comp, :imagePC_ads, :imageMobile_ads, :display_ads)";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_comp' => $ad->id_comp, ':imagePC_ads' => $ad->imagePC, ':imageMobile_ads' => $ad->imageMobile, ':display_ads' => $ad->display));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

    static public function updateAd(Ad $ad){
        $sql = "UPDATE ads SET id_comp=:id_comp, imagePC_ads=:imagePC_ads, imageMobile_ads=:imageMobile_ads, display_ads=:display_ads WHERE id_ads=:id_ads";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_comp' => $ad->id_comp, ':imagePC_ads' => $ad->imagePC, ':imageMobile_ads' => $ad->imageMobile, ':display_ads' => $ad->display, ':id_ads' => $ad->id));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

    static public function deleteAd(int $id){
        $sql = "DELETE FROM ads WHERE id_ads = :id_ads";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_ads' => $id));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

    static public function getAd($id){
        $sql = "SELECT * FROM ads WHERE id_ads = :id_ads";
        try{
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_ads' => $id));
            $result = $pdo_statement->fetch(PDO::FETCH_ASSOC);
            $values=array(
                "id" => $result["id_ads"],  
                "id_comp" => $result["id_comp"],  
                "imagePC" => $result["imagePC_ads"],
                "imageMobile" => $result["imageMobile_ads"],
                "display" => $result["display_ads"]
            );
            $ad = new Ad();
            $ad->hydrate($values);
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
        return $ad;
    }

    static public function getAllAds(){
        $result = array();
        $sql = "SELECT * FROM ads INNER JOIN companies ON companies.id_comp = ads.id_comp WHERE companies.deleted_comp = 0;";
        try{
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute();
            $resultQuery = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultQuery as $elem) {
                $values=array(
                    "id" => $elem["id_ads"],  
                    "id_comp" => $elem["id_comp"],  
                    "imagePC" => $elem["imagePC_ads"],
                    "imageMobile" => $elem["imageMobile_ads"],
                    "display" => $elem["display_ads"]
                );
                $ad = new Ad();
                $ad->hydrate($values);
                array_push($result, $ad);
            }
            
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
        return $result;
    }

    static public function getAdsToDisplay(){
        $result = array();
        $sql = "SELECT * FROM ads WHERE display_ads = 1";
        try{
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute();
            $resultQuery = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultQuery as $elem) {
                $values=array(
                    "id" => $elem["id_ads"],  
                    "id_comp" => $elem["id_comp"],  
                    "imagePC" => $elem["imagePC_ads"],
                    "imageMobile" => $elem["imageMobile_ads"],
                    "display" => $elem["display_ads"]
                );
                $ad = new Ad();
                $ad->hydrate($values);
                array_push($result, $ad);
            }
            
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