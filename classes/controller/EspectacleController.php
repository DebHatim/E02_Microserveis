<?php

class EspectacleController
{

    public static function mostraTots(): void
    {
        try {
            PeticioGETView::mostra(EspectacleModel::findAll());
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(['Error' => "No s'han trobat espectacles."]);
        }
    }

    public static function mostraUnic($id): void
    {
        try {
            PeticioGETView::mostra(EspectacleModel::find($id));
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(['Error' => "No s'ha trobat cap espectacle amb aquest id."]);
        }
    }
    public static function mostraData($data = null)
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data ?? '')) {
            http_response_code(400);
            echo "Format de data invàlid. (YYYY-MM-DD)";
            exit;
        }

        $espectacles = EspectacleModel::findByData($data);

        EspectacleView::show($espectacles);
    }

    public static function crea($data): void
    {
        try {
            $DB_Localitzacio = LocalitzacioModel::findByNom($data["localitzacio"]);;
            $on = new ON_Espectacle($data["nom"], $data["poster"], $data["horainici"], $data["horafinal"], $DB_Localitzacio);
            EspectacleModel::crea($on);
            http_response_code(200);
            echo json_encode(['Resposta' => 'Espectacle creat']);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode(['Error' => $e->getMessage()]);
        }

    }

    public static function actualitza($data = null) {
        try {
            $on = new ON_Espectacle($data["nom"], $data["poster"], $data["horaInici"], $data["horaFinal"], $data["localitzacio"], $data["id"]);
            EspectacleModel::actualitza($on);
            http_response_code(200);
            echo json_encode(['Resposta' => 'Espectacle actualitzat']);
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(['Error' => $e->getMessage()]);
        }
    }

    public static function elimina($data): void
    {
        try {
            $on = new ON_Espectacle($data["nom"], "", "", "", "");
            EspectacleModel::elimina($on);
            http_response_code(200);
            echo json_encode(['Resposta' => 'Espectacle eliminat']);
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(['Error' => $e->getMessage()]);
        }
    }

}