<?php 

class DataModel {
    
    public static function findByData($on) {
        global $em;
        return $em->getRepository("Entrada\Entity\Espectacle")->findByData($on->__get("data"));
    }
    
}

?>