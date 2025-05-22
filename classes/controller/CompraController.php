<?php

class CompraController {

    public static function mostraTots(): void
    {
        try {
            PeticioGETView::mostra(CompraModel::findAll());
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(['Error' => "No s'han trobat compres."]);
        }
    }

    public static function mostraUnic($id): void
    {
        try {
            PeticioGETView::mostra(CompraModel::find($id));
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(['Error' => "No s'ha trobat cap compra amb aquest id."]);
        }
    }

    public static function crea($data): void
    {

        if (UsuariModel::findOneByEmail($data["usuari"])) {
            if (EntradaModel::findOneByRef($data["ref"])) {
                $usuari = UsuariModel::findOneByEmail($data["usuari"]);
                $entrada = EntradaModel::findOneByRef($data["ref"]);
                $on = new ON_Compra(null, $usuari, $data["metodepagament"], $entrada);
                CompraModel::crea($on);
            }
            else {
                http_response_code(404);
                echo json_encode(['status' => 'Id entrada inexistent']);
            }
        }
        else {
            http_response_code(404);
            echo json_encode(['status' => 'Email usuari inexistent']);
        }

    }

    public static function actualitza($data): void
    {
        try {
            CompraModel::actualitza(new ON_Compra($data["id"], $data["usuari"], $data["metodepagament"], "", $data["dataCompra"]));
            http_response_code(200);
            echo json_encode(['Resposta' => 'Compra actualitzada']);
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(['Error' => $e->getMessage()]);
        }
    }

    public static function elimina($data): void
    {
        try {
            CompraModel::elimina(new ON_Compra($data["id"]));
            http_response_code(200);
            echo json_encode(['Resposta' => 'Compra eliminada']);
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(['Error' => $e->getMessage()]);
        }
    }

}