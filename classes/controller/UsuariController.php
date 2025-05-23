<?php

class UsuariController {

    public static function mostraTots(): void
    {
        try {
            PeticioGETView::mostra(UsuariModel::findAll());
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(['Error' => "No s'han trobat usuaris."]);
        }
    }

    public static function mostraUnic($id): void
    {
        try {
            PeticioGETView::mostra(UsuariModel::find($id));
        } catch (Exception $e) {
            http_response_code($e->getCode());
            echo json_encode(['Error' => "No s'ha trobat cap usuari amb aquest id."]);
        }
    }

    public static function crea($data): void
    {
        try {
            UsuariModel::crea(new ON_Usuari($data["email"], $data["nom"], $data["telefon"]));
            http_response_code(200);
            echo json_encode(['Resposta' => 'Usuari creat']);
        } catch (Exception $e) {
            http_response_code($e->getCode());
            echo json_encode(['Error' => $e->getMessage()]);
        }
    }

    public static function actualitza($data): void
    {
        try {
            UsuariModel::actualitza(new ON_Usuari($data["email"], $data["nom"], $data["telefon"], $data["id"]));
            http_response_code(200);
            echo json_encode(['Resposta' => 'Usuari actualitzat']);
        } catch (Exception $e) {
            http_response_code($e->getCode());
            echo json_encode(['Error' => $e->getMessage()]);
        }
    }

    public static function elimina($data): void
    {
        try {
            UsuariModel::elimina(new ON_Usuari($data["email"]));
            http_response_code(200);
            echo json_encode(['Resposta' => 'Usuari eliminat']);
        } catch (Exception $e) {
            http_response_code($e->getCode());
            echo json_encode(['Error' => $e->getMessage()]);
        }
    }

}