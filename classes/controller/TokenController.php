<?php

class TokenController
{

    public static function check($metode, $path): void
    {
        if (($metode == 'POST' && $path != "api/auth") ||
            ($metode == 'GET' && $path == "api/espectacle") ||
            ($metode === 'GET' && $path === '' && (
                (isset($_GET['ref']) && !isset($_GET['data'])) ||
                (isset($_GET['data']) && !isset($_GET['ref']))))) {
            return;
        }
        if (!isset($_SESSION['token'])) {
            throw new Exception("Token requerit.", 511);
        }
        else {
            try {
                TokenModel::comprovaToken($_SESSION['token']);
            } catch (Exception $e) {
                session_unset();
                session_destroy();
                http_response_code($e->getCode());
                echo json_encode(['Error' => $e->getMessage()]);
                exit;
            }
        }

    }

    public static function crea($data): void
    {
        try {
            $ON_Admin = new ON_Admin($data["user"], $data["pass"]);
            TokenModel::comprovaUsuari($ON_Admin);

            $token = bin2hex(random_bytes(8));
            $expiracio = new \DateTime("+1 hour");

            $ON_Admin->__set("token", $token);
            $ON_Admin->__set("expiracio", $expiracio);
            TokenModel::actualitza($ON_Admin);

            $_SESSION['token'] = $token;
            http_response_code(200);
            echo json_encode(['Resposta' => 'Sessio iniciada. El teu token: ' . $token]);
        } catch (Exception $e) {
            http_response_code($e->getCode());
            echo json_encode(['Error' => $e->getMessage()]);
        }

    }

}