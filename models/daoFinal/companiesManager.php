<?php


abstract class CompaniesManager extends DBManager{
    
    static public function addCompany(Company $company){
        $sql = "INSERT INTO companies (name_comp, description_comp, hours_comp, city_comp, street_comp, number_comp, postalcode_comp, state_comp, mail_comp, web_comp, phone_comp, image_comp, tva_comp, certified_comp)
                VALUES (:name_comp, :description_comp, :hours_comp, :city_comp, :street_comp, :number_comp, :postalcode_comp, :state_comp, :mail_comp, :web_comp, :phone_comp, :image_comp, :tva_comp, 0)";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $state = $pdo_statement->execute(array(':name_comp' => $company->name, ':description_comp' => $company->description, ':mail_comp' => $company->mail, ':web_comp' => $company->web,
                                ':hours_comp' => $company->hours, ':city_comp' => $company->city, ':street_comp' => $company->street,
                                ':number_comp' => $company->number, ':postalcode_comp' => $company->postalCode,':state_comp' => $company->state, ':phone_comp' => $company->phone, 
                                ':image_comp' =>  $company->image, ':tva_comp' =>  $company->tva));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
        return $state;
    }

    static public function updateCompany(Company $company){
        $sql = "UPDATE companies SET name_comp=:name_comp, description_comp=:description_comp, hours_comp=:hours_comp,
                city_comp=:city_comp, street_comp=:street_comp, number_comp=:number_comp, postalcode_comp=:postalcode_comp, phone_comp=:phone_comp, web_comp=:web_comp, image_comp=:image_comp WHERE id_comp=:id_comp";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_comp' => $company->id, ':name_comp' => $company->name, ':description_comp' => $company->description,
                                ':hours_comp' => $company->hours, ':city_comp' => $company->city, ':street_comp' => $company->street,
                                ':number_comp' => $company->number, ':postalcode_comp' => $company->postalCode, ':phone_comp' => $company->phone, ':web_comp' => $company->web,
                                ':image_comp' => $company->image));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

    static public function switchConfirmCompany($idCompany){
        $sql = "UPDATE companies SET certified_comp = 1-certified_comp, acceptPending_comp = 0 WHERE id_comp=:id_comp";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_comp' => $idCompany));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

    static public function switchAcceptPending($idCompany){
        $sql = "UPDATE companies SET acceptPending_comp = 1-acceptPending_comp WHERE id_comp=:id_comp";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_comp' => $idCompany));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

    static public function switchCompanyPaid($idCompany){
        $sql = "UPDATE companies SET hasPaid_comp = 1-hasPaid_comp WHERE id_comp=:id_comp";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_comp' => $idCompany));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

    static public function deleteCompany(int $idCompany){
        $sql = "UPDATE companies SET deleted_comp=:deleted_comp WHERE id_comp=:id_comp";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_comp' => $idCompany, ':deleted_comp' => 1));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

    static public function getOneCompany($idCompany){
        $sql = "SELECT * FROM companies WHERE id_comp=:id_comp AND deleted_comp=0";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_comp' => $idCompany));
            $elem = $pdo_statement->fetch(PDO::FETCH_ASSOC);
            $values=array(
                "id" => $elem["id_comp"],  
                "name" => $elem["name_comp"],  
                "description" => $elem["description_comp"],  
                "hours" => $elem["hours_comp"], 
                "city" => $elem["city_comp"],
                "street" => $elem["street_comp"],
                "number" => $elem["number_comp"],
                "postalCode" => $elem["postalcode_comp"],
                "mail" => $elem["mail_comp"],
                "phone" => $elem["phone_comp"],
                "image" => $elem["image_comp"],
                "web" => $elem["web_comp"],
                "deleted" => $elem["deleted_comp"],
                "certified" => $elem["certified_comp"],
                "tva" => $elem["tva_comp"],
                "acceptPending" => $elem["acceptPending_comp"],
                "hasPaid" => $elem["hasPaid_comp"]
            );
            $company = new Company();
            $company->hydrate($values);
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
        return $company;
    }

    static public function getOneCompanyByMail($mail){
        $sql = "SELECT * FROM companies WHERE mail_comp=:mail_comp";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':mail_comp' => $mail));
            $elem = $pdo_statement->fetch(PDO::FETCH_ASSOC);
            $values=array(
                "id" => $elem["id_comp"],  
                "name" => $elem["name_comp"],  
                "description" => $elem["description_comp"],  
                "hours" => $elem["hours_comp"], 
                "city" => $elem["city_comp"],
                "street" => $elem["street_comp"],
                "number" => $elem["number_comp"],
                "postalCode" => $elem["postalcode_comp"],
                "mail" => $elem["mail_comp"],
                "phone" => $elem["phone_comp"],
                "image" => $elem["image_comp"],
                "web" => $elem["web_comp"],
                "deleted" => $elem["deleted_comp"],
                "certified" => $elem["certified_comp"],
                "tva" => $elem["tva_comp"],
                "acceptPending" => $elem["acceptPending_comp"],
                "hasPaid" => $elem["hasPaid_comp"]
            );
            $company = new Company();
            $company->hydrate($values);
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
        return $company;
    }

    static public function getIdCompanyFromMail($mail){
        $sql = "SELECT id_comp FROM companies WHERE mail_comp=:mail_comp";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':mail_comp' => $mail));
            $elem = $pdo_statement->fetch(PDO::FETCH_ASSOC);
            $idCompany = $elem["id_comp"];
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
        return $idCompany;
    }

    static public function getAllActiveCompanies(){
        $result = array();
        $sql = "SELECT * FROM companies WHERE certified_comp = 1 AND deleted_comp = 0";
        try{
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute();
            $resultQuery = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultQuery as $elem){
                $values=array(
                    "id" => $elem["id_comp"],  
                    "name" => $elem["name_comp"],  
                    "description" => $elem["description_comp"],  
                    "hours" => $elem["hours_comp"], 
                    "city" => $elem["city_comp"],
                    "street" => $elem["street_comp"],
                    "number" => $elem["number_comp"],
                    "postalCode" => $elem["postalcode_comp"],
                    "phone" => $elem["phone_comp"],
                    "image" => $elem["image_comp"],
                    "web" => $elem["web_comp"],
                    "mail" => $elem["mail_comp"],
                    "deleted" => $elem["deleted_comp"],
                    "tva" => $elem["tva_comp"],
                    "acceptPending" => $elem["acceptPending_comp"],
                    "hasPaid" => $elem["hasPaid_comp"]
                );
                $company = new Company();
                $company->hydrate($values);
                array_push($result,$company);
            }
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
        return $result;
    }

    static public function getAllCompaniesToBeConfirmed(){
        $result = array();
        $sql = "SELECT * FROM companies WHERE certified_comp = 0 AND acceptPending_comp = 1";
        try{
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute();
            $resultQuery = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultQuery as $elem){
                $values=array(
                    "id" => $elem["id_comp"],  
                    "name" => $elem["name_comp"],  
                    "description" => $elem["description_comp"],  
                    "hours" => $elem["hours_comp"], 
                    "city" => $elem["city_comp"],
                    "street" => $elem["street_comp"],
                    "number" => $elem["number_comp"],
                    "postalCode" => $elem["postalcode_comp"],
                    "phone" => $elem["phone_comp"],
                    "image" => $elem["image_comp"],
                    "web" => $elem["web_comp"],
                    "mail" => $elem["mail_comp"],
                    "deleted" => $elem["deleted_comp"],
                    "tva" => $elem["tva_comp"],
                    "acceptPending" => $elem["acceptPending_comp"],
                    "hasPaid" => $elem["hasPaid_comp"]
                );
                $company = new Company();
                $company->hydrate($values);
                array_push($result,$company);
            }
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
        return $result;
    }

    static public function getAllCompaniesAccordingTo($category, $subcategory){
        $result = array();
        $sql = "SELECT * FROM companies INNER JOIN appartient ON appartient.id_comp = companies.id_comp INNER JOIN categories ON categories.id_cat = appartient.id_cat WHERE categories.name_cat = :subcategory AND categories.parent_cat = :category AND certified_comp = 1 AND deleted_comp = 0 AND hasPaid_comp = 1";
        try{
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':category' => $category, ':subcategory' => $subcategory));
            $resultQuery = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultQuery as $elem){
                $values=array(
                    "id" => $elem["id_comp"],  
                    "name" => $elem["name_comp"],  
                    "description" => $elem["description_comp"],  
                    "hours" => $elem["hours_comp"], 
                    "city" => $elem["city_comp"],
                    "street" => $elem["street_comp"],
                    "number" => $elem["number_comp"],
                    "postalCode" => $elem["postalcode_comp"],
                    "phone" => $elem["phone_comp"],
                    "image" => $elem["image_comp"],
                    "web" => $elem["web_comp"],
                    "deleted" => $elem["deleted_comp"],
                    "tva" => $elem["tva_comp"],
                    "acceptPending" => $elem["acceptPending_comp"],
                    "hasPaid" => $elem["hasPaid_comp"]
                );
                $company = new Company();
                $company->hydrate($values);
                array_push($result,$company);
            }
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
        return $result;
    }

    static public function editFavorite($idCompany, $idUser){
        if(companiesManager::favoriteExist($idCompany, $idUser))
            $sql = "DELETE FROM favoris WHERE favoris.id_comp = :id_comp AND favoris.id_user = :id_user";
        else
            $sql = "INSERT INTO favoris (id_user, id_comp) VALUES (:id_user, :id_comp)";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_user' => $idUser, ':id_comp' => $idCompany));
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
    }

    static public function favoriteExist($idCompany, $idUser){
        $sql = "SELECT COUNT(*) AS count FROM favoris WHERE favoris.id_comp = :id_comp AND favoris.id_user = :id_user ";
        try {
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_user' => $idUser, ':id_comp' => $idCompany));
            $result = $pdo_statement->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
        if($result['count'] > 0) return true;
        else return false;
    }

    static public function getAllFavoriteCompaniesFor($idUser){
        $result = array();
        $sql = "SELECT * FROM companies INNER JOIN favoris ON favoris.id_comp = companies.id_comp WHERE favoris.id_user = :id_user AND certified_comp = 1 AND deleted_comp = 0 AND hasPaid_comp = 1";
        try{
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute(array(':id_user' => $idUser));
            $resultQuery = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultQuery as $elem){
                $values=array(
                    "id" => $elem["id_comp"],  
                    "name" => $elem["name_comp"],  
                    "description" => $elem["description_comp"],  
                    "hours" => $elem["hours_comp"], 
                    "city" => $elem["city_comp"],
                    "street" => $elem["street_comp"],
                    "number" => $elem["number_comp"],
                    "postalCode" => $elem["postalcode_comp"],
                    "phone" => $elem["phone_comp"],
                    "image" => $elem["image_comp"],
                    "web" => $elem["web_comp"],
                    "deleted" => $elem["deleted_comp"],
                    "tva" => $elem["tva_comp"],
                    "acceptPending" => $elem["acceptPending_comp"],
                    "hasPaid" => $elem["hasPaid_comp"]
                );
                $company = new Company();
                $company->hydrate($values);
                array_push($result,$company);
            }
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
        return $result;
    }

    static public function searchCompany($keyword){
        $result = array();
        $sql = 
            "SELECT 
                companies.id_comp, 
                name_comp, 
                description_comp, 
                hours_comp, city_comp, 
                street_comp, 
                number_comp, 
                postalcode_comp, 
                phone_comp, 
                image_comp, 
                web_comp, 
                mail_comp, 
                deleted_comp, 
                tva_comp, 
                acceptPending_comp, 
                hasPaid_comp 
            FROM companies
            INNER JOIN appartient ON appartient.id_comp
            INNER JOIN categories ON categories.id_cat
            WHERE companies.name_comp LIKE '%$keyword%' OR (categories.name_cat LIKE '%$keyword%' AND categories.id_cat = appartient.id_cat AND appartient.id_comp = companies.id_comp)
            GROUP BY companies.id_comp";
        try{
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute();
            $resultQuery = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultQuery as $elem){
                $values=array(
                    "id" => $elem["id_comp"],  
                    "name" => $elem["name_comp"],  
                    "description" => $elem["description_comp"],  
                    "hours" => $elem["hours_comp"], 
                    "city" => $elem["city_comp"],
                    "street" => $elem["street_comp"],
                    "number" => $elem["number_comp"],
                    "postalCode" => $elem["postalcode_comp"],
                    "phone" => $elem["phone_comp"],
                    "image" => $elem["image_comp"],
                    "web" => $elem["web_comp"],
                    "mail" => $elem["mail_comp"],
                    "deleted" => $elem["deleted_comp"],
                    "tva" => $elem["tva_comp"],
                    "acceptPending" => $elem["acceptPending_comp"],
                    "hasPaid" => $elem["hasPaid_comp"]
                );
                $company = new Company();
                $company->hydrate($values);
                array_push($result,$company);
            }
        } catch (Exception $e) {
            die($e->getMessage());
        } finally{
            $pdo_statement->closeCursor();
            $pdo_statement = null;
        }
        return $result;
    }


    static public function getLastAddedCompanies(){
        $result = array();
        $sql = "SELECT * FROM companies ORDER BY id_comp DESC LIMIT 6";
        try{
            $pdo_connexion = parent::connexionDB();
            $pdo_statement = $pdo_connexion->prepare($sql);
            $pdo_statement->execute();
            $resultQuery = $pdo_statement->fetchAll(PDO::FETCH_ASSOC);
            foreach ($resultQuery as $elem){
                $values=array(
                    "id" => $elem["id_comp"],  
                    "name" => $elem["name_comp"],  
                    "description" => $elem["description_comp"],  
                    "hours" => $elem["hours_comp"], 
                    "city" => $elem["city_comp"],
                    "street" => $elem["street_comp"],
                    "number" => $elem["number_comp"],
                    "postalCode" => $elem["postalcode_comp"],
                    "phone" => $elem["phone_comp"],
                    "image" => $elem["image_comp"],
                    "web" => $elem["web_comp"],
                    "deleted" => $elem["deleted_comp"],
                    "tva" => $elem["tva_comp"],
                    "acceptPending" => $elem["acceptPending_comp"],
                    "hasPaid" => $elem["hasPaid_comp"]
                );
                $company = new Company();
                $company->hydrate($values);
                array_push($result,$company);
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