<?php

class Occasion{
    private $idOccasion;
    private $title;
    private $description;
    private $date;
    private $price;
    private $region;
    private $idUser;
    private $username;
    private $mail;
    private $phone;
    private $imageOccasion;
    private $imageUser;
    private $type;

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