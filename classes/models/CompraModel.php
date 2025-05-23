<?php

use Hatim\Entradas\Entity\Compra;
use Hatim\Entradas\Entity\Entrada;

class CompraModel {

    public static function crea($ON_Compra) {
        global $em;
        $DB_Usuari = $ON_Compra->__get("usuari");
        if ($DB_Usuari === null) {
            throw new Exception("Correu d'usuari inexistent.");
        }
        else if ($ON_Compra->__get("entrada") === null) {
            throw new Exception("Codi de referencia inexistent.");
        }
        else if ($ON_Compra->__get("entrada")->getEstat() == "Venuda") {
            throw new Exception("Aquesta entrada ja s,ha venuda.");
        }
        else {
            $ON_Compra->__get("entrada")->setEstat("Venuda");
        }

        $comp = new Compra();
        $comp->setUsuari($ON_Compra->__get("usuari"));
        $comp->setMetodePagament($ON_Compra->__get("metodepagament"));
        $comp->addEntrada($ON_Compra->__get("entrada"));

        $em->persist($comp);
        $DB_Usuari->addCompra($comp);
        $em->persist($DB_Usuari);
        $em->flush();
    }

    public static function actualitza($ON_Compra) {
        global $em;

        $DB_Compra = $em->getRepository(Compra::class)->find($ON_Compra->__get("id"));
        if ($DB_Compra === null) {
            throw new Exception("Id de compra inexistent.");
        }

        $DB_Compra->setDataCompra($ON_Compra->__get("nom"));
        $DB_Compra->setMetodePagament($ON_Compra->__get("email"));
        $DB_Compra->setUsuari($ON_Compra->__get("email"));

        $em->persist($DB_Compra);
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

    public static function findAll(): array
    {
        global $em;
        return $em->getRepository(Compra::class)->findAll();
    }

    public static function find(int $id): ?Compra
    {
        global $em;
        return $em->getRepository(Compra::class)->find($id);
    }

}