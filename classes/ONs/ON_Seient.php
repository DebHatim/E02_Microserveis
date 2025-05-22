<?php

class ON_Seient
{
    private $id;
    private $numero;
    private $fila;
    private $tipus;
    private $localitzacio;

    public function __construct($numero, $fila, $localitzacio, $tipus = null, $id = null)
    {
        $this->numero = $numero;
        $this->fila = $fila;
        $this->tipus = $tipus;
        $this->localitzacio = $localitzacio;
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