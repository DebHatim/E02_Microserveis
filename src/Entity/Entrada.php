<?php

namespace Hatim\Entradas\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\OneToOne;
use Hatim\Entradas\Repository\EntradaRepository;

#[ORM\Entity(repositoryClass:EntradaRepository::class)]
#[ORM\Table(name: 'Entrada')]

class Entrada {
    
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 15, unique: true)]
    private ?string $ref = null;
    
    #[ORM\ManyToOne(targetEntity: Espectacle::class, inversedBy: 'entrades')]
    #[ORM\JoinColumn(name: "espectacle_id", referencedColumnName: "id")]
    private Espectacle $espectacle;

    #[ORM\Column(type: 'string')]
    private string $estat;

    #[ORM\Column(type: 'decimal', precision:10, scale:2)]
    private float $preu;

    #[OneToOne(targetEntity: Seient::class)]
    private Seient $seient;

    #[ORM\ManyToOne(targetEntity: Compra::class, cascade: ['persist'], inversedBy: 'entrades')]
    #[ORM\JoinColumn(name: 'compra_id', referencedColumnName: 'id', nullable: true)]
    private ?Compra $compra = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(?string $ref): void
    {
        $this->ref = $ref;
    }

    public function getEspectacle(): Espectacle
    {
        return $this->espectacle;
    }

    public function setEspectacle(Espectacle $espectacle): void
    {
        $this->espectacle = $espectacle;
    }

    public function getEstat(): string
    {
        return $this->estat;
    }

    public function setEstat(string $estat): void
    {
        $this->estat = $estat;
    }

    public function getPreu(): float
    {
        return $this->preu;
    }

    public function setPreu(float $preu): void
    {
        $this->preu = $preu;
    }

    public function getSeient(): Seient
    {
        return $this->seient;
    }

    public function setSeient(Seient $seient): void
    {
        $this->seient = $seient;
    }

    public function getCompra(): ?Compra
    {
        return $this->compra;
    }

    public function setCompra(?Compra $compra): void
    {
        $this->compra = $compra;
    }



}