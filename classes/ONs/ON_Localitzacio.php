<?php

class ON_Localitzacio
{

    private $id;
    private $nom;
    private $direccio;
    private $ciutat;
    private $capacitat;

    public function __construct($nom, $direccio = null, $ciutat = null, $capacitat = null, $id = null)
    {
        $this->nom = $nom;
        $this->direccio = $direccio;
        $this->ciutat = $ciutat;
        $this->capacitat = $capacitat;
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