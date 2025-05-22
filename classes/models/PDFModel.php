<?php 

use Hatim\Entradas\Entity\Entrada;
class PDFModel {
    
    public static function findByRef($on) {
        global $em;
        return $em->getRepository(Entrada::class)->findByRef($on->__get("ref"));
    }

    public static function checkRef($on) {
        global $em;
        return $em->find(Entrada::class, $on->__get("ref"));
    }
}

?>