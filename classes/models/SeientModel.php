<?php

use Hatim\Entradas\Entity\Entrada;
use Hatim\Entradas\Entity\Seient;

class SeientModel {

    public static function crea($ON_Seient) {
        global $em;

        $DB_Localitzacio = $ON_Seient->__get("localitzacio");
        if ($DB_Localitzacio === null) {
            throw new Exception("Nom de localitzacio inexistent.", 404);
        }
        else if ($em->getRepository(Seient::class)->findOneBy(['numero' => $ON_Seient->__get("numero")])->getLocalitzacio()
            == $ON_Seient->__get("localitzacio")) {
            throw new Exception("Numero de seient en us.", 226);
        }

        $se = new Seient();
        $se->setNumero($ON_Seient->__get("numero"));
        $se->setFila($ON_Seient->__get("fila"));
        $se->setTipus($ON_Seient->__get("tipus"));
        $se->setLocalitzacio($ON_Seient->__get("localitzacio"));

        $em->persist($se);
        $em->flush();
    }

    public static function actualitza($ON_Seient) {
        global $em;

        $DB_Seient = $em->getRepository(Seient::class)->find($ON_Seient->__get("id"));
        if ($DB_Seient === null) {
            throw new Exception("Id de seient inexistent.", 404);
        }
        else if ($ON_Seient->__get("localitzacio") === null) {
            throw new Exception("Nom de localitzacio inexistent.", 404);
        }
        else if ($em->getRepository(Seient::class)->findOneBy(['numero' => $ON_Seient->__get("numero")])->getLocalitzacio()
            == $ON_Seient->__get("localitzacio")) {
            throw new Exception("Numero de seient en us.", 226);
        }

        $DB_Seient->setFila($ON_Seient->__get("fila"));
        $DB_Seient->setNumero($ON_Seient->__get("numero"));
        $DB_Seient->setTipus($ON_Seient->__get("tipus"));
        $DB_Seient->setLocalitzacio($ON_Seient->__get("localitzacio"));

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