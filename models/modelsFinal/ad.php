<?php

class Ad{
    private $id;
    private $id_comp;
    private $name_comp;
    private $image;
    private $display;

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