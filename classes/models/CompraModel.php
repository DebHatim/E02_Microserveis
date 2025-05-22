<?php

use Hatim\Entradas\Entity\Compra;
use Hatim\Entradas\Entity\Entrada;

class CompraModel {

    public static function crea($compra) {
        global $em;
        $comp = new Compra();
        $comp->setUsuari($compra->__get("usuari"));
        $comp->setMetodePagament($compra->__get("metodepagament"));
        $comp->addEntrada($compra->__get("entrada"));

        $em->persist($comp);
        $em->flush();
    }

    public static function actualitza($ON_Espectacle) {
        global $em;

        $DB_Espectacle = $em->getRepository(Espectacle::class)->find($ON_Espectacle->__get("id"));
        if ($DB_Espectacle === null) {
            throw new Exception("Id d'espectacle inexistent.");
        }

        $DB_Espectacle->setNom($ON_Espectacle->__get("nom"));
        $DB_Espectacle->setEmail($ON_Espectacle->__get("email"));
        $DB_Espectacle->setEmail($ON_Espectacle->__get("email"));
        $DB_Espectacle->setEmail($ON_Espectacle->__get("email"));
        $DB_Espectacle->setEmail($ON_Espectacle->__get("email"));

        $em->persist($DB_Espectacle);
        $em->flush();
    }

    public static function elimina($ONCompra) {
        global $em;
        $compra = $em->getRepository(Compra::class)->find($ONCompra->__get("id"));

        if ($compra === null) {
            throw new Exception("Id de compra inexistent.");
        }

        if ($em->getRepository(Entrada::class)->findOneBy(["compra" => $compra])) {
            $entrades = $em->getRepository(Entrada::class)->findBy(["compra" => $compra]);
            foreach ($entrades as $entrada) {
                $em->remove($entrada);
            }
        }

        $em->remove($compra);
        $em->flush();
    }


}