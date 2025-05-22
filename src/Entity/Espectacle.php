<?php

namespace Hatim\Entradas\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinColumn;
use Doctrine\ORM\Mapping\ManyToOne;
use Hatim\Entradas\Repository\EspectacleRepository;
#[ORM\Entity(repositoryClass:EspectacleRepository::class)]
#[ORM\Table(name: 'Espectacle')]

class Espectacle implements \JSONSerializable {
    
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;

    #[ORM\Column(type: 'string', length:50, unique: true)]
    private string $nom;

    #[ORM\Column(type: 'text')]
    private string $poster;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $horaInici;

    #[ORM\Column(type: 'datetime')]
    private \DateTime $horaFinal;

    #[ORM\OneToMany(targetEntity: Entrada::class,  mappedBy: "espectacle")]
    private Collection $entrades;

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

    public function getNom(): string
    {
        return $this->nom;
    }

    public function setNom(string $nom): void
    {
        $this->nom = $nom;
    }

    public function getPoster(): string
    {
        return $this->poster;
    }

    public function setPoster(string $poster): void
    {
        $this->poster = $poster;
    }

    public function getData(): String
    {
        return $this->horaInici->format('Y-m-d');
    }

    public function getHoraInici(): \DateTime
    {
        return $this->horaInici;
    }

    public function setHoraInici(\DateTime $horaInici): void
    {
        $this->horaInici = $horaInici;
    }

    public function getHoraFinal(): \DateTime
    {
        return $this->horaFinal;
    }

    public function setHoraFinal(\DateTime $horaFinal): void
    {
        $this->horaFinal = $horaFinal;
    }

    public function getEntrades(): Collection
    {
        return $this->entrades;
    }

    public function setEntrades(Collection $entrades): void
    {
        $this->entrades = $entrades;
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
            'nom'         => $this->nom,
            'poster'       => $this->poster,
            'horaInici'     => $this->horaInici->format('Y-m-d H:i:s'),
            'horaFinal' => $this->horaFinal->format('Y-m-d H:i:s'),
            'localitzacio' => $this->localitzacio->getNom()
        ];
    }

}