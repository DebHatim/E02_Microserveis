<?php

namespace Hatim\Entradas\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'Usuari')]

class Usuari implements \JSONSerializable {
    
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;

    #[ORM\Column(type: 'string', length:30)]
    private string $nom;

    #[ORM\Column(type: 'string', length:100, unique: true)]
    private string $email;

    #[ORM\Column(type: 'string', length: 12, nullable: true)]
    private string $telefon;

    #[ORM\Column(type: 'date')]
    private DateTime $dataCreacio;

    #[ORM\OneToMany(targetEntity: Compra::class, mappedBy: 'usuari')]
    private Collection $compres;

    public function __construct() {
        $this->compres = new ArrayCollection();
        $this->dataCreacio = new DateTime();
    }
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

    public function getEmail(): string
    {
        return $this->email;
    }
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getTelefon(): string
    {
        return $this->telefon;
    }

    public function setTelefon(string $telefon): void
    {
        $this->telefon = $telefon;
    }
    public function getDataCreacio(): DateTime
    {
        return $this->dataCreacio;
    }
    public function setDataCreacio(DateTime $dataCreacio): void
    {
        $this->dataCreacio = $dataCreacio;
    }

    public function getCompres(): Collection
    {
        return $this->compres;
    }

    public function addCompra(Compra $compra): void
    {
        $this->compres->add($compra);
    }
    public function jsonSerialize() : array
    {
        return [
            'id'          => $this->id,
            'nom'         => $this->nom,
            'email'       => $this->email,
            'telefon'     => $this->telefon ?? null,
            'dataCreacio' => $this->dataCreacio->format('Y-m-d'),
            'compres'      => array_map(static fn(Compra $c) => $c->jsonSerialize(), $this->compres->toArray()),
        ];
    }

}