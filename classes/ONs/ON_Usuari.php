<?php

class ON_Usuari
{

    private $id;
    private $nom;
    private $email;
    private $telefon;

    public function __construct($email, $nom = null, $telefon = null, $id = null)
    {
        $this->nom = $nom;
        $this->email = $email;
        $this->telefon = $telefon;
        $this->id = $id;
    }

    public function __get($property)
    {
        if (property_exists($this, $property)) {
            return $this->$property;
        }
    }

    public function __set($property, $value)
    {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }
}
