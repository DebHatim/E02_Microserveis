<?php

class Autoload  {
    
    public static function load() {
        $directoris = array_slice(scandir(__ROOT__."classes"),2);
        foreach ($directoris as $directori) {            
            $array[$directori] = array_slice(scandir(__ROOT__."classes/".$directori),2);
        }
        
        foreach ($array as $dir => $clases) {
            foreach ($clases as $clase) {
                self::loadClase($dir, $clase);
            }
        }
    }
    
    public static function loadClase($dir,$nomClase) {
        include_once __ROOT__."classes/".$dir."/".$nomClase;
    }
    
}

?>