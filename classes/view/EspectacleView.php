<?php

class EspectacleView {

    public static function show($espectacles) : void {
        $xml = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?><espectacles></espectacles>");

        foreach ($espectacles as $espectacle) {
            $entradaXml = $xml->addChild('espectacle');
            $entradaXml->addChild('nom', $espectacle->getNom());
            $entradaXml->addChild('lloc', $espectacle->getLocalitzacio()->getNom());
            $entradaXml->addChild('data', $espectacle->getHoraInici()->format('Y-m-d'));
        }

        header('Content-type: application/xml');
        echo $xml->asXML();
    }

}