<?php

class EntradaController {

    public static function mostraPDF($ref = null): void
    {
        if (strlen(trim($ref)) == 15) {
            try {
                $DB_Entrada = EntradaModel::findOneByRef($ref);
                if ($DB_Entrada === null) {
                    http_response_code(404);
                    echo "Error: codi de referencia inexistent.";
                }
                EntradaView::mostraPDF($DB_Entrada);
            } catch (Exception $e) {
                http_response_code(404);
                echo json_encode(['Error' => $e->getMessage()]);
            }
        }
        else {
            http_response_code(400);
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