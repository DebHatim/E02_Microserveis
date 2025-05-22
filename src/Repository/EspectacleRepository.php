<?php

namespace Hatim\Entradas\Repository;

use Doctrine\ORM\EntityRepository;

class EspectacleRepository extends EntityRepository
{
    public function findByData(string $date): array
    {
        $start = new \DateTime($date . ' 00:00:00');
        $end = new \DateTime($date . ' 23:59:59');

        return $this->createQueryBuilder('e')
            ->where('e.horaInici BETWEEN :start AND :end')
            ->setParameter('start', $start)
            ->setParameter('end', $end)
            ->getQuery()
            ->getResult();
    }


}
