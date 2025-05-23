<?php

class TokenController {

    public static function check($metode, $path, $headers): bool
    {
        if ($metode === 'DELETE' || $metode == 'PUT' || $metode == 'POST') {
            if (!isset($_COOKIE['token'])) {
                return false;
            }
            else {
                try {
                    TokenModel::comprovaToken($_COOKIE['token']);
                    return true;
                }
                catch (Exception $e) {
                    http_response_code(400);
                    echo json_encode(['Error' => $e->getMessage()]);
                }
            }
        }
        return true;
    }

    public static function crea($data): void
    {
        try {
            $ON_Admin = new ON_Admin($data["user"], $data["pass"]);
            TokenModel::comprovaUsuari($ON_Admin);

            $token = bin2hex(random_bytes(8));
            setcookie("token", $token,
                [
                    'expires' => time() + 3600,  // 1 hora
                    'path' => '/',
                    'secure' => false,
                    'httponly' => true,
                    'samesite' => 'Lax'
                ]
            );

            http_response_code(200);
            echo json_encode(['Resposta' => 'Sessio iniciada. El teu token: ' . $token]);
        } catch (Exception $e) {
            http_response_code(404);
            echo json_encode(['Error' => $e->getMessage()]);
        }

    }

}