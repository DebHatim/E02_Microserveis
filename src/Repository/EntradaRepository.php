<?php

namespace Hatim\Entradas\Repository;

use Doctrine\ORM\EntityRepository;
use Hatim\Entradas\Entity\Entrada;

class EntradaRepository extends EntityRepository
{
    public function findByRef($ref): Entrada
    {
        return $this->createQueryBuilder('en')
            ->where("en.ref = :ref")
            ->setParameter('ref', $ref)
            ->getQuery()
            ->getOneOrNullResult();
    }

}
