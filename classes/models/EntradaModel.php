<?php

use Hatim\Entradas\Entity\Entrada;

class EntradaModel {

    public static function crea($ON_Entrada) {
        global $em;

        if ($em->getRepository(Entrada::class)->findOneBy(['ref' => $ON_Entrada->__get("ref")])) {
            throw new Exception("Codi de referencia ja utilitzat.", 226);
        }
        else if ($ON_Entrada->__get("espectacle") === null) {
            throw new Exception("Nom d'espectacle inexistent.", 404);
        }
        else if ($ON_Entrada->__get("seient") === null) {
            throw new Exception("Id de seient inexistent.", 404);
        }
        else if ($em->getRepository(Entrada::class)->findOneBy(['seient' => $ON_Entrada->__get("seient")])) {
            throw new Exception("Seient ja utilitzat per una altra entrada.", 226);
        }

        $en = new Entrada();
        $en->setRef($ON_Entrada->__get("ref"));
        $en->setPreu($ON_Entrada->__get("preu"));
        $en->setEspectacle($ON_Entrada->__get("espectacle"));
        $en->setSeient($ON_Entrada->__get("seient"));
        $en->setEstat("Disponible");

        $em->persist($en);
        $em->flush();
    }

    public static function actualitza($ON_Entrada) {
        global $em;

        $DB_Entrada = $em->getRepository(Entrada::class)->find($ON_Entrada->__get("id"));
        if ($DB_Entrada === null) {
            throw new Exception("Id d'entrada inexistent.", 404);
        }
        else if ($ON_Entrada->__get("espectacle") === null) {
            throw new Exception("Nom d'espectacle inexistent.", 404);
        }
        else if ($ON_Entrada->__get("seient") === null) {
            throw new Exception("Id de seient inexistent.", 404);
        }

        $DB_Entrada->setRef($ON_Entrada->__get("ref"));
        $DB_Entrada->setEstat($ON_Entrada->__get("estat"));
        $DB_Entrada->setPreu($ON_Entrada->__get("preu"));
        $DB_Entrada->setEspectacle($ON_Entrada->__get("espectacle"));
        $DB_Entrada->setSeient($ON_Entrada->__get("seient"));

        $em->persist($DB_Entrada);
        $em->flush();
    }

    public static function elimina($ON_entrada) {
        global $em;
        $entrada = $em->getRepository(Entrada::class)->findOneBy(["ref" => $ON_entrada->__get("ref")]);

        if ($entrada === null) {
            throw new Exception("No s'ha trobat una entrada amb aquest codi de referencia.", 404);
        }
        else {
            $em->remove($entrada);
            $em->flush();
        }
    }
    public static function findOneByRef($ref) {
        global $em;
        return $em->getRepository(Entrada::class)->findOneBy(['ref' => $ref]);
    }

    public static function findAll(): array
    {
        global $em;
        return $em->getRepository(Entrada::class)->findAll();
    }

    public static function find(int $id): ?Entrada
    {
        global $em;
        return $em->getRepository(Entrada::class)->find($id);
    }

}