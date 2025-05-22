<?php

class LocalitzacioController {

    public static function mostraTots(): void
    {
        try {
            PeticioGETView::mostra(LocalitzacioModel::findAll());
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(['Error' => "No s'han trobat localitzacions."]);
        }
    }

    public static function mostraUnic($id): void
    {
        try {
            PeticioGETView::mostra(LocalitzacioModel::find($id));
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(['Error' => "No s'ha trobat cap localitzacio amb aquest id."]);
        }
    }

    public static function crea($data = null) {
        try {
            $on = new ON_Localitzacio($data["nom"], $data["direccio"], $data["ciutat"], $data["capacitat"]);
            LocalitzacioModel::crea($on);
            http_response_code(200);
            echo json_encode(['Resposta' => 'Localitzacio creada']);
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(['Error' => $e->getMessage()]);
        }
    }

    public static function actualitza($data = null) {
        if ($data["id"] == 1) {
            http_response_code(400);
            echo json_encode(['Resposta' => 'No es pot actualitzar aquesta localitzacio']);
            exit;
        }
        try {
            $on = new ON_Localitzacio($data["nom"], $data["direccio"], $data["ciutat"], $data["capacitat"], $data["id"]);
            LocalitzacioModel::actualitza($on);
            http_response_code(200);
            echo json_encode(['Resposta' => 'Localitzacio actualitzada']);
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(['Error' => $e->getMessage()]);
        }
    }

    public static function elimina($data = null) {
        try {
            $on = new ON_Localitzacio($data["nom"], "", "", "");
            LocalitzacioModel::elimina($on);
            http_response_code(200);
            echo json_encode(['Resposta' => 'Localitzacio eliminada']);
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(['Error' => $e->getMessage()]);
        }
    }

}