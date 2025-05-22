<?php 

use Mpdf\Mpdf;
use Hatim\Entradas\Entity\Entrada;

class PDFView {

    public static function show($entrada = null) {

        if ($entrada instanceof Entrada) {

            // Aixó serveix per posar la url correctament al codi QR

            if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')
                $link = "https";
            else
                $link = "http";

            $link .= "://";
            $link .= $_SERVER['HTTP_HOST'];
            $link .= $_SERVER['REQUEST_URI'];

            $mpdf = new Mpdf(['tempDir' => '/tmp']);
            $mpdf->SetProtection([], "2025@Thos", "2025@Thos");

            $nom = $entrada->getEspectacle()->getNom();
            $data = explode(" ", $entrada->getEspectacle()->getHoraInici()->format('d/m/Y H:i'))[0];
            $horainici = explode(" ", $entrada->getEspectacle()->getHoraInici()->format('d/m/Y H:i'))[1];
            $horafinal = explode(" ", $entrada->getEspectacle()->getHoraFinal()->format('d/m/Y H:i'))[1];
            $lloc = $entrada->getEspectacle()->getLocalitzacio()->getNom();
            $preu = $entrada->getPreu();
            $preu = number_format((float)$preu, 2, '.', ''); // mostrar 2 decimals
            $tipus = $entrada->getSeient()->getTipus();
            $fila = $entrada->getSeient()->getFila();
            $seient = $entrada->getSeient()->getNumero();
            $poster = $entrada->getEspectacle()->getPoster();

            $cbarres = "<barcode code=\"{$entrada->getRef()}\" type=\"C128A\" size=\"1.5\" height=\"1\"></barcode>";
            $cqr = "<barcode code=\"$link\" type=\"QR\" size=\"1.5\" height=\"1\"></barcode>";

            ob_start();
            include __ROOT__ . '/inc/template.php';
            $html = ob_get_clean();

            $mpdf->SetWatermarkText('TICKETS HALAL', 0.2);
            $mpdf->showWatermarkText = true;
            $mpdf->WriteHTML($html);
            $mpdf->Output();
        }
        else {
            $mpdf = new Mpdf(['tempDir' => '/tmp']);
            $mpdf->WriteHTML("<p></p>");
            $mpdf->Output();
        }

    }
    
}

?>
