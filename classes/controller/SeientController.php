<?php

class SeientController {

    public static function mostraTots(): void
    {
        try {
            PeticioGETView::mostra(SeientModel::findAll());
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(['Error' => "No s'han trobat seients."]);
        }
    }

    public static function mostraUnic($id): void
    {
        try {
            PeticioGETView::mostra(SeientModel::find($id));
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(['Error' => "No s'ha trobat cap seient amb aquest id."]);
        }
    }

    public static function crea($data): void
    {
        try {
            $localitzacio = LocalitzacioModel::findByNom($data["localitzacio"]);
            SeientModel::crea(new ON_Seient($data["numero"], $data["fila"], $localitzacio, $data["tipus"]));
            http_response_code(200);
            echo json_encode(['Resposta' => 'Seient creat']);
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(['Error' => $e->getMessage()]);
        }
    }

    public static function actualitza($data): void
    {
        try {
            $DB_Localitzacio = LocalitzacioModel::find($data["localitzacio"]);
            SeientModel::actualitza(new ON_Seient($data["numero"], $data["fila"], $DB_Localitzacio, $data["tipus"], $data["id"]));
            http_response_code(200);
            echo json_encode(['Resposta' => 'Seient actualitzat']);
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(['Error' => $e->getMessage()]);
        }
    }

    public static function elimina($data): void
    {
        try {
            SeientModel::elimina(new ON_Seient("","","","",$data["id"]));
            http_response_code(200);
            echo json_encode(['Resposta' => 'Seient eliminat']);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(['Error' => $e->getMessage()]);
        }

    }

}