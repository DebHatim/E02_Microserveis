<?php

class ON_Admin
{

    private $user;
    private $pass;
    private $token;
    private $expiracio;

    public function __construct($user, $pass, $token = null, $expiracio = null)
    {
        $this->user = $user;
        $this->pass = $pass;
        $this->token = $token;
        $this->expiracio = $expiracio;
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