<?php

use Hatim\Entradas\Entity\Entrada;
use Hatim\Entradas\Entity\Espectacle;
use Hatim\Entradas\Entity\Localitzacio;

class EspectacleModel {
    public static function crea($ON_Espectacle) {
        global $em;
        if ($em->getRepository(Espectacle::class)->findBy(['nom' => $ON_Espectacle->__get("nom")])) {
            throw new Exception("Nom d'espectacle ja existeix.", 226);
        }
        else if ($ON_Espectacle->__get("localitzacio") === null) {
            throw new Exception("Nom de localitzacio inexistent.", 404);
        }

        $es = new Espectacle();
        $es->setNom($ON_Espectacle->__get("nom"));
        $es->setPoster($ON_Espectacle->__get("poster"));
        $es->setHoraInici(new DateTime($ON_Espectacle->__get("horaInici")));
        $es->setHoraFinal(new DateTime($ON_Espectacle->__get("horaFinal")));
        $es->setLocalitzacio($ON_Espectacle->__get("localitzacio"));

        $em->persist($es);
        $em->flush();
    }
    public static function actualitza($ON_Espectacle) {
        global $em;

        $DB_Espectacle = $em->getRepository(Espectacle::class)->find($ON_Espectacle->__get("id"));
        $DB_Localitzacio = $em->getRepository(Localitzacio::class)->findOneBy(["nom" => $ON_Espectacle->__get("localitzacio")]);
        if ($DB_Espectacle === null) {
            throw new Exception("Id d'espectacle inexistent.", 404);
        }
        else if ($DB_Localitzacio === null) {
            throw new Exception("Nom de localitzacio inexistent.", 404);
        }

        $DB_Espectacle->setNom($ON_Espectacle->__get("nom"));
        $DB_Espectacle->setPoster($ON_Espectacle->__get("poster"));
        $DB_Espectacle->setHoraInici(new DateTime($ON_Espectacle->__get("horaInici")));
        $DB_Espectacle->setHoraFinal(new DateTime($ON_Espectacle->__get("horaFinal")));
        $DB_Espectacle->setLocalitzacio($DB_Localitzacio);

        $em->persist($DB_Espectacle);
        $em->flush();
    }

    public static function elimina($ONespectacle) {
        global $em;
        $espectacle = $em->getRepository(Espectacle::class)->findOneBy(['nom' => $ONespectacle->__get("nom")]);

        if ($espectacle === null) {
            throw new Exception("Espectacle no trobat.", 404);
        }

        $entrades = $em->getRepository(Entrada::class)->findBy(['espectacle' => $espectacle]);

        foreach ($entrades as $entrada) {
            $em->remove($entrada);
        }

        $em->remove($espectacle);
        $em->flush();
    }

    public static function findByData($data) {
        global $em;
        return $em->getRepository(Espectacle::class)->findByData($data);
    }

    public static function findByNom($nom) {
        global $em;
        return $em->getRepository(Espectacle::class)->findOneBy(['nom' => $nom]);
    }

    public static function findAll(): array
    {
        global $em;
        return $em->getRepository(Espectacle::class)->findAll();
    }

    public static function find(int $id): ?Espectacle
    {
        global $em;
        return $em->getRepository(Espectacle::class)->find($id);
    }

}