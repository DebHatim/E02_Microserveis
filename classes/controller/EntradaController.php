<?php

class EntradaController {

    public static function mostra($ref = null): void
    {
        if (strlen(trim($ref)) == 15) {

            $on = new ON_Entrada($ref);

            if (PDFModel::checkRef($on)) {
                PDFView::show(PDFModel::findByRef($on));
            }
            else {
                PDFView::show(null);
            }
        }
    }

    public static function crea($data): void
    {
        try {
            $DB_Espectacle = EspectacleModel::findByNom($data["espectacle"]);
            $DB_Seient = SeientModel::findOneById($data["seient"]);
            EntradaModel::crea(new ON_Entrada($data["ref"], $data["preu"], $DB_Espectacle, $DB_Seient, $data["estat"]));
            http_response_code(200);
            echo json_encode(['Resposta' => 'Entrada creada']);
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(['Error' => $e->getMessage()]);
        }
    }

    public static function actualitza($data): void
    {
        try {
            $DB_Espectacle = EspectacleModel::findByNom($data["espectacle"]);
            $DB_Seient = SeientModel::findOneById($data["seient_id"]);
            EntradaModel::actualitza(new ON_Entrada($data["ref"], $data["preu"], $DB_Espectacle, $DB_Seient, $data["estat"], $data["id"]));
            http_response_code(200);
            echo json_encode(['Resposta' => 'Entrada actualitzada']);
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(['Error' => $e->getMessage()]);
        }
    }

    public static function elimina($data): void
    {
        try {
            EntradaModel::elimina(new ON_Entrada($data["ref"]));
            http_response_code(200);
            echo json_encode(['Resposta' => 'Entrada eliminada']);
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(['Error' => $e->getMessage()]);
        }
    }

}