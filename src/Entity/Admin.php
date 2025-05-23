<?php

namespace Hatim\Entradas\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'Entrada')]

class Admin {

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 15, unique: true)]
    private string $usuari;

    #[ORM\Column(type: 'string', length: 15)]
    private string $pass;

    #[ORM\Column(type: 'string', length: 100)]
    private string $token;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getUsuari(): string
    {
        return $this->usuari;
    }

    public function setUsuari(string $usuari): void
    {
        $this->usuari = $usuari;
    }

    public function getPass(): string
    {
        return $this->pass;
    }

    public function setPass(string $pass): void
    {
        $this->pass = $pass;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

}