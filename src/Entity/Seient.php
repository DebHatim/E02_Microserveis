<?php

namespace Hatim\Entradas\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;

#[ORM\Entity]
#[ORM\Table(name: 'Seient')]

class Seient implements \JSONSerializable {

    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;

    #[ORM\Column(type: 'integer')]
    private string $fila;

    #[ORM\Column(type: 'integer')]
    private int $numero;

    #[ORM\Column(type: 'string', length:20)]
    private string $tipus;

    #[ManyToOne(targetEntity: Localitzacio::class)]
    #[JoinColumn(name: 'localitzacio_id', referencedColumnName: 'id')]
    private Localitzacio $localitzacio;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getFila(): string
    {
        return $this->fila;
    }

    public function setFila(string $fila): void
    {
        $this->fila = $fila;
    }

    public function getNumero(): int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): void
    {
        $this->numero = $numero;
    }

    public function getTipus(): string
    {
        return $this->tipus;
    }

    public function setTipus(string $tipus): void
    {
        $this->tipus = $tipus;
    }

    public function getLocalitzacio(): Localitzacio
    {
        return $this->localitzacio;
    }

    public function setLocalitzacio(Localitzacio $localitzacio): void
    {
        $this->localitzacio = $localitzacio;
    }

    public function jsonSerialize() : array
    {
        return [
            'id'          => $this->id,
            'fila'         => $this->fila,
            'numero'       => $this->numero,
            'tipus'     => $this->tipus,
            'localitzacio' => $this->localitzacio->getNom(),
        ];
    }

}