<?php

class ON_Entrada
{

    private $id;
    private $ref;
    private $preu;
    private $espectacle;
    private $seient;
    private $estat;

    public function __construct($ref, $preu = null, $espectacle = null, $seient = null, $estat = null, $id = null)
    {
        $this->ref = $ref;
        $this->preu = $preu;
        $this->espectacle = $espectacle;
        $this->seient = $seient;
        $this->estat = $estat;
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