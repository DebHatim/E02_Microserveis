<?php

class ON_Espectacle
{

    private $id;
    private $nom;
    private $poster;
    private $horaInici;
    private $horaFinal;
    private $localitzacio;

    public function __construct($nom, $poster = null, $horaInici = null, $horaFinal = null, $localitzacio = null, $id = null)
    {
        $this->nom = $nom;
        $this->poster = $poster;
        $this->horaInici = $horaInici;
        $this->horaFinal = $horaFinal;
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

?>