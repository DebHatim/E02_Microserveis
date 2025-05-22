<?php

namespace Hatim\Entradas\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'Localitzacio')]

class Localitzacio {

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;

    #[ORM\Column(type: 'string', length:100, unique: true)]
    private string $nom;

    #[ORM\Column(type: 'string', length: 100)]
    private string $direccio;

    #[ORM\Column(type: 'string', length:100)]
    private string $ciutat;

    #[ORM\Column(type: 'integer')]
    private string $capacitat;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function getDireccio(): string
    {
        return $this->direccio;
    }

    public function setDireccio(string $direccio): void
    {
        $this->direccio = $direccio;
    }

    public function getCiutat(): string
    {
        return $this->ciutat;
    }

    public function setCiutat(string $ciutat): void
    {
        $this->ciutat = $ciutat;
    }

    public function getCapacitat(): string
    {
        return $this->capacitat;
    }

    public function setCapacitat(string $capacitat): void
    {
        $this->capacitat = $capacitat;
    }

}

?>