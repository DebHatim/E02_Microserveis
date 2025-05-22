<?php

use Hatim\Entradas\Entity\Espectacle;
use Hatim\Entradas\Entity\Localitzacio;

class LocalitzacioModel {

    public static function crea($localitzacio) {
        global $em;
        $lo = new Localitzacio();
        $lo->setNom($localitzacio->__get("nom"));
        $lo->setDireccio($localitzacio->__get("direccio"));
        $lo->setCiutat($localitzacio->__get("ciutat"));
        $lo->setCapacitat((int) $localitzacio->__get("capacitat"));
        $em->persist($lo);
        $em->flush();
    }

    public static function actualitza($ON_Localitzacio) {
        global $em;

        $DB_Localitzacio = $em->getRepository(Localitzacio::class)->find($ON_Localitzacio->__get("id"));
        if ($DB_Localitzacio === null) {
            throw new Exception("Id de localitzacio no trobat.");
        }

        $DB_Localitzacio->setNom($ON_Localitzacio->__get("nom"));
        $DB_Localitzacio->setDireccio($ON_Localitzacio->__get("direccio"));
        $DB_Localitzacio->setCiutat($ON_Localitzacio->__get("ciutat"));
        $DB_Localitzacio->setCapacitat($ON_Localitzacio->__get("capacitat"));

        $em->persist($DB_Localitzacio);
        $em->flush();
    }

    public static function elimina($ONlocalitzacio) {
        global $em;
        $localitzacio = $em->getRepository(Localitzacio::class)->findOneBy(['nom' => $ONlocalitzacio->__get("nom")]);

        if ($localitzacio === null) {
            throw new Exception("Localització no trobada.");
        }

        $espectacles = $em->getRepository(Espectacle::class)->findBy(['localitzacio' => $localitzacio]);

        foreach ($espectacles as $espectacle) {
            $espectacle->setLocalitzacio($em->getRepository(Localitzacio::class)->find(1));
        }

        $em->remove($localitzacio);
        $em->flush();
    }

    public static function findByNom($nom) {
        global $em;
        return $em->getRepository(Localitzacio::class)->findOneBy(['nom' => $nom]);
    }

}