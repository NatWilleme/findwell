<?php

class Material{
    private $idMaterial;
    private $title;
    private $description;
    private $date;
    private $price;
    private $region;
    private $idCompany;
    private $nameCompany;
    private $mail;
    private $phone;
    private $imageMaterial;
    private $imageCompany;
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