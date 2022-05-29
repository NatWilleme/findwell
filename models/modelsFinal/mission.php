<?php

class Mission{
    private $id;
    private $title;
    private $description;
    private $date;
    private $price;
    private $region;
    private $idUser;
    private $idCompany;
    private $username;
    private $mailMission;
    private $mailCompany;
    private $phone;
    private $images;
    private $imageUser;
    private $buildingType;
    private $accessibility;
    private $accepted;
    private $acceptPending;

    // Magic method get
    public function __get($value){   
        return $this->$value;
    }

    // Magic method set
    public function __set($property,$value){
    $this->$property=$value;
    }

    // Hydrate method
    public function hydrate(array $data){
        foreach ($data as $key => $value){
            $method = "__set";
            if(method_exists($this,$method)){
                $this->$method($key,$value);
            }else{
                echo 'Nom de champs invalide';
            }
        }
    }
}

?>