<?php

use Hatim\Entradas\Entity\Entrada;
use Hatim\Entradas\Entity\Seient;

class SeientModel {

    public static function crea($ON_Seient)
    {
        global $em;

        $loc = $ON_Seient->__get('localitzacio');
        if ($loc === null) {
            throw new Exception('Nom de localització inexistent.', 404);
        }

        $existeix = $em->getRepository(Seient::class)->findOneBy([
            'numero'        => $ON_Seient->__get('numero'),
            'localitzacio'  => $loc
        ]);

        if ($existeix !== null) {
            throw new Exception('Número de seient en ús.', 409);
        }

        $se = new Seient();
        $se->setNumero($ON_Seient->__get('numero'));
        $se->setFila($ON_Seient->__get('fila'));
        $se->setTipus($ON_Seient->__get('tipus'));
        $se->setLocalitzacio($loc);

        $em->persist($se);
        $em->flush();
    }

    public static function actualitza($ON_Seient)
    {
        global $em;

        $DB_Seient = $em->getRepository(Seient::class)->find($ON_Seient->__get("id"));
        if ($DB_Seient === null) {
            throw new Exception("Id de seient inexistent.", 404);
        }

        $loc = $ON_Seient->__get("localitzacio");
        if ($loc === null) {
            throw new Exception("Nom de localització inexistent.", 404);
        }

        $duplicat = $em->getRepository(Seient::class)->findOneBy([
            'numero' => $ON_Seient->__get("numero"),
            'localitzacio' => $loc
        ]);

        if ($duplicat !== null && $duplicat->getId() !== $DB_Seient->getId()) {
            throw new Exception("Número de seient en ús.", 409);
        }

        $DB_Seient->setFila($ON_Seient->__get("fila"));
        $DB_Seient->setNumero($ON_Seient->__get("numero"));
        $DB_Seient->setTipus($ON_Seient->__get("tipus"));
        $DB_Seient->setLocalitzacio($loc);

        $em->persist($DB_Seient);
        $em->flush();
    }

    public static function elimina($ON_Seient) {
        global $em;
        if ($ON_Seient->__get("id") === null) {
            throw new Exception("Id de seient inexistent.", 404);
        }
        $DB_Seient = $em->getRepository(Seient::class)->find($ON_Seient->__get("id"));
        $DB_Entrada = $em->getRepository(Entrada::class)->findOneBy(['seient' => $DB_Seient]);

        if ($DB_Entrada) {
            throw new Exception("Seient utilitzat per una entrada", 226);
        }

        $em->remove($DB_Seient);
        $em->flush();
    }

    public static function findAll(): array
    {
        global $em;
        return $em->getRepository(Seient::class)->findAll();
    }

    public static function find(int $id): ?Seient
    {
        global $em;
        return $em->getRepository(Seient::class)->find($id);
    }

}