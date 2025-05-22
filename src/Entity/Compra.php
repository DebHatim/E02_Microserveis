<?php

namespace Hatim\Entradas\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'Compra')]

class Compra {
    
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    private int|null $id = null;

    #[ORM\Column(type: 'datetime')]
    private DateTime $dataCompra;
    
    #[ORM\Column(type: 'string', length:50)]
    private string $metodePagament;

    #[ORM\Column(type: 'decimal', precision:10, scale:2)]
    private float $total = 0.00;

    #[ORM\ManyToOne(targetEntity: Usuari::class, inversedBy: 'compres')]
    #[ORM\JoinColumn(name: 'user_id', referencedColumnName: 'id', nullable: false)]
    private Usuari $usuari;

    #[ORM\OneToMany(targetEntity: Entrada::class, mappedBy: 'compra', cascade: ['persist'], orphanRemoval: true)]
    private Collection $entrades;

    public function __construct() {
        $this->dataCompra = new DateTime();
        $this->entrades = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getDataCompra(): DateTime
    {
        return $this->dataCompra;
    }

    public function setDataCompra(DateTime $dataCompra): void
    {
        $this->dataCompra = $dataCompra;
    }

    public function getMetodePagament(): string
    {
        return $this->metodePagament;
    }

    public function setMetodePagament(string $metodePagament): void
    {
        $this->metodePagament = $metodePagament;
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    public function getUsuari(): Usuari
    {
        return $this->usuari;
    }

    public function setUsuari(Usuari $usuari): void
    {
        $this->usuari = $usuari;
    }

    public function getEntrades(): Collection
    {
        return $this->entrades;
    }

    public function addEntrada(Entrada $e): void
    {
        if (!$this->entrades->contains($e)) {
            $this->entrades->add($e);
            $e->setCompra($this);
            $sum = 0.0;
            foreach ($this->entrades as $e) {
                $sum += $e->getPreu();
            }
            $this->total = $sum;
        }
    }

    public function removeEntrada(Entrada $e): void
    {
        if ($this->entrades->contains($e)) {
            $this->entrades->removeElement($e);
            $e->setCompra(null);
            $sum = 0.0;
            foreach ($this->entrades as $e) {
                $sum += $e->getPreu();
            }
            $this->total = $sum;
        }
    }

}

