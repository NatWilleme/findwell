<?php

class Company{
    private $id;
    private $name;
    private $description;
    private $hours;
    private $city;
    private $street;
    private $number;
    private $postalCode;
    private $state;
    private $phone;
    private $mail;
    private $image;
    private $deleted;
    private $certified;
    private $countComment;
    private $rating;
    private $domaines;
    private $tva;
    private $distance;

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