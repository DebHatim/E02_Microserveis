<?php

class ON_Compra
{

    private $id;
    private $usuari;
    private $metodepagament;
    private $entrada;
    private $dataCompra;

    public function __construct($id, $usuari = null, $metodepagament = null, $entrada = null, $dataCompra = null)
    {
        $this->id = $id;
        $this->usuari = $usuari;
        $this->metodepagament = $metodepagament;
        $this->entrada = $entrada;
        $this->dataCompra = $dataCompra;
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