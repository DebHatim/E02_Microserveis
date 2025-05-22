<?php

class PeticioGETView {

    public static function mostra($data): void
    {
        header('Content-Type: application/json; charset=UTF-8');
        if (empty($data)) {
            throw new Exception();
        }
        else {
            echo json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
    }

}