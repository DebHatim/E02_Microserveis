<?php

error_reporting(E_ALL);
ini_set("display_errors", 1);
const __ROOT__ = __DIR__ . "/../";

require_once __ROOT__ . '/src/bootstrap.php';
require_once __ROOT__ . '/vendor/autoload.php';
require_once __ROOT__ . '/classes/core/Autoload.php';

session_start();
Autoload::load();

try {
    $sanititzador = new Controller();
    $scriptDir = str_replace('\\','/', dirname($_SERVER['SCRIPT_NAME']));
    $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $path = trim( substr($requestUri, strlen($scriptDir)), '/' );

    try {
        TokenController::check($_SERVER['REQUEST_METHOD'], $path);
    }
    catch (Exception $e) {
        http_response_code($e->getCode());
        echo json_encode(['Error' => $e->getMessage()]);
        exit;
    }
    switch ($_SERVER['REQUEST_METHOD']) {
        case "GET":
            if (empty($path)) {
                if (count($_GET) == 0) {
                    http_response_code(400);
                    exit;
                }
                else if (count($_GET) == 1) {
                    if (array_keys($_GET)[0] == "data") {
                        EspectacleController::mostraData($_GET["data"]);
                    } else if (array_keys($_GET)[0] == "ref") {
                        EntradaController::mostraPDF($_GET["ref"]);
                    }
                }
                else {
                    EspectacleController::mostraData();
                    break;
                }
            }
            else {
                $divisio = explode("/", $path);
                $solicitud = $divisio[1] ?? null;
                $id = $divisio[2] ?? null;

                switch ($solicitud) {
                    case "usuari":
                        if ($id) {
                            UsuariController::mostraUnic($id);
                        }
                        else {
                            UsuariController::mostraTots();
                        }
                        break;
                    case "localitzacio":
                        if ($id) {
                            LocalitzacioController::mostraUnic($id);
                        }
                        else {
                            LocalitzacioController::mostraTots();
                        }
                        break;
                    case "espectacle":
                        if ($id) {
                            EspectacleController::mostraUnic($id);
                        }
                        else {
                            EspectacleController::mostraTots();
                        }
                        break;
                    case "seient":
                        if ($id) {
                            SeientController::mostraUnic($id);
                        }
                        else {
                            SeientController::mostraTots();
                        }
                        break;
                    case "entrada":
                        if ($id) {
                            EntradaController::mostraUnic($id);
                        }
                        else {
                            EntradaController::mostraTots();
                        }
                        break;
                    case "compra":
                        if ($id) {
                            CompraController::mostraUnic($id);
                        }
                        else {
                            CompraController::mostraTots();
                        }
                        break;
                    default:
                        http_response_code(400);
                        echo "Error. Sense parametres.";
                        exit;
                }
            }
            break;
        case "POST":
            $body = file_get_contents('php://input');
            $data = json_decode($body, true);
            if ($path == "api/auth") {
                if (!is_array($data) || !isset($data['user'], $data['pass'])) {
                    http_response_code(400);
                    echo json_encode(['Error' => 'Camps necessaris: user - pass']);
                    exit;
                }
                $data["user"] = $sanititzador->sanitize($data["user"], 'string');

                if (empty($data["user"]) || empty($data["pass"])) {
                    http_response_code(400);
                    echo json_encode(['Error' => 'Els camps no poden estar buits.']);
                    exit;
                }
                else if (strlen($data["user"]) > 15) {
                    http_response_code(400);
                    echo json_encode(['Error' => 'Maxima longitud del nom usuari: 15']);
                    exit;
                }
                TokenController::crea($data);
                exit;
            }
            else if ($path == "api/usuari") {
                if (!is_array($data) || !isset($data['nom'], $data['email'], $data['telefon'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris: nom - email - telefon']);
                    exit;
                }
                else {
                    $data["nom"] = $sanititzador->sanitize($data["nom"], 'string');
                    $data["email"] = $sanititzador->sanitize($data["email"], 'email');
                    $data["telefon"] = $sanititzador->sanitize($data["telefon"], 'string');

                    if (empty($data["nom"]) || empty($data["email"])) {
                        http_response_code(400);
                        echo json_encode(['status' => 'Camps necessaris buits: nom - email']);
                        exit;
                    }
                    else if (strlen($data["telefon"]) > 12) {
                        http_response_code(400);
                        echo json_encode(['error' => 'Telefon massa llarg']);
                        exit;
                    }
                    else if (!$sanititzador->validateItem($data['email'], 'email') ||
                        !$sanititzador->validateItem($data['telefon'], 'phone')) {
                        http_response_code(400);
                        echo json_encode(['status' => 'Format incorrecte en algun camp.']);
                        exit;
                    }

                    UsuariController::crea($data);
                    exit;
                }
            } else if ($path == "api/localitzacio") {
                if (!is_array($data) || !isset($data['nom'], $data['direccio'], $data['ciutat'], $data['capacitat'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris: nom - direccio - ciutat - capacitat']);
                    exit;
                }
                else {
                    $data["nom"] = $sanititzador->sanitize($data["nom"], 'string');
                    $data["direccio"] = $sanititzador->sanitize($data["direccio"], 'string');
                    $data["ciutat"] = $sanititzador->sanitize($data["ciutat"], 'string');
                    $data["capacitat"] = $sanititzador->sanitize($data["capacitat"], 'int');

                    if (empty($data["nom"]) || empty($data["direccio"]) || empty($data["ciutat"]) || empty($data["capacitat"])) {
                        http_response_code(400);
                        echo json_encode(['status' => 'Camps necessaris buits: nom - direccio - ciutat - capacitat']);
                        exit;
                    }
                    else if (!$sanititzador->validateItem($data['nom'], 'words') ||
                        !$sanititzador->validateItem($data['direccio'], 'words') ||
                        !$sanititzador->validateItem($data['ciutat'], 'words') ||
                        !$sanititzador->validateItem($data['capacitat'], 'number')) {
                        http_response_code(400);
                        echo json_encode(['status' => 'Format incorrecte en algun camp.']);
                        exit;
                    }

                    LocalitzacioController::crea($data);
                    exit;
                }
            } else if ($path == "api/espectacle") {
                if (!is_array($data) || !isset($data['nom'], $data['poster'], $data['horainici'], $data['horafinal'], $data['localitzacio'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris: nom - poster - horainici - horafinal - localitzacio']);
                    exit;
                }
                else {
                    $data["nom"] = $sanititzador->sanitize($data["nom"], 'string');
                    // SANITIZO URL? A LO MEJOR NO FUNCIONA LUEGO
                    // NO SE COMO SANITIZAR HORA INICI Y HORA FINAL
                    $data["localitzacio"] = $sanititzador->sanitize($data["localitzacio"], 'string');

                    if (empty($data["nom"]) || empty($data["poster"]) || empty($data["horainici"]) || empty($data["horafinal"]) || empty($data["localitzacio"])) {
                        http_response_code(400);
                        echo json_encode(['status' => 'Camps necessaris buits: nom - poster - horainici - horafinal - localitzacio']);
                        exit;
                    }

                    EspectacleController::crea($data);
                    exit;
                }
            } else if ($path == "api/seient") {
                if (!is_array($data) || !isset($data['numero'], $data['fila'], $data['tipus'], $data['localitzacio'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris: numero - fila - tipus - localitzacio']);
                    exit;
                }
                else {
                    $data["numero"] = $sanititzador->sanitize($data["numero"], 'int');
                    $data["fila"] = $sanititzador->sanitize($data["fila"], 'int');
                    $data["tipus"] = $sanititzador->sanitize($data["tipus"], 'string');
                    $data["localitzacio"] = $sanititzador->sanitize($data["localitzacio"], 'string');

                    if (empty($data["numero"]) || empty($data["fila"]) || empty($data["tipus"]) || empty($data["localitzacio"])) {
                        http_response_code(400);
                        echo json_encode(['status' => 'Camps necessaris buits: numero - fila - tipus - localitzacio']);
                        exit;
                    }

                    SeientController::crea($data);
                    exit;
                }
            } else if ($path == "api/entrada") {
                if (!is_array($data) || !isset($data['ref'], $data['preu'], $data['espectacle'], $data['seient_id'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris: ref - preu - espectacle - seient_id']);
                    exit;
                }
                else {
                    $data["ref"] = $sanititzador->sanitize($data["ref"], 'string');
                    $data["preu"] = $sanititzador->sanitize($data["preu"], 'float');
                    $data["espectacle"] = $sanititzador->sanitize($data["espectacle"], 'string');
                    $data["seient_id"] = $sanititzador->sanitize($data["seient_id"], 'int');

                    if (empty($data["ref"]) || empty($data["preu"]) || empty($data["espectacle"]) || empty($data["seient_id"])) {
                        http_response_code(400);
                        echo json_encode(['status' => 'Camps necessaris buits: ref - preu - espectacle - seient_id']);
                        exit;
                    }

                    EntradaController::crea($data);
                    exit;
                }
            } else if ($path == "api/compra") {
                if (!is_array($data) || !isset($data['usuari'], $data['metodepagament'], $data['ref'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris: usuari - metodepagament - ref']);
                    exit;
                }
                else {
                    $data["usuari"] = $sanititzador->sanitize($data["usuari"], 'string');
                    $data["metodepagament"] = $sanititzador->sanitize($data["metodepagament"], 'string');
                    $data["ref"] = $sanititzador->sanitize($data["ref"], 'string');

                    if (empty($data["usuari"]) || empty($data["metodepagament"]) || empty($data["ref"])) {
                        http_response_code(400);
                        echo json_encode(['status' => 'Camps necessaris buits: usuari - metodepagament - ref']);
                        exit;
                    }

                    CompraController::crea($data);
                    exit;
                }
            }

            break;
        case "PUT":
            $body = file_get_contents('php://input');
            $data = json_decode($body, true);
            if ($path == "api/usuari") {
                if (!is_array($data) || !isset($data['id'], $data['nom'], $data['email'], $data['telefon'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris: id - nom - email - telefon']);
                    exit;
                }
                $data["id"] = $sanititzador->sanitize($data["id"], 'int');
                $data["nom"] = $sanititzador->sanitize($data["nom"], 'string');
                $data["email"] = $sanititzador->sanitize($data["email"], 'email');
                $data["telefon"] = $sanititzador->sanitize($data["telefon"], 'string');

                if (empty($data["id"]) || empty($data["nom"]) || empty($data["email"]) || empty($data["telefon"])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris buits: id - nom - email - telefon']);
                    exit;
                }
                else if (strlen($data["telefon"]) > 12) {
                    http_response_code(400);
                    echo json_encode(['error' => 'Telefon massa llarg']);
                    exit;
                }
                else if (!$sanititzador->validateItem($data['email'], 'email') ||
                    !$sanititzador->validateItem($data['telefon'], 'phone')) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Format incorrecte en el telefon.']);
                    exit;
                }

                UsuariController::actualitza($data);
                exit;
            }
            else if ($path == "api/localitzacio") {
                if (!is_array($data) || !isset($data['id'], $data['nom'], $data['direccio'], $data['ciutat'], $data['capacitat'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris: id - nom - direccio - ciutat - capacitat']);
                    exit;
                }
                $data["id"] = $sanititzador->sanitize($data["id"], 'int');
                $data["nom"] = $sanititzador->sanitize($data["nom"], 'string');
                $data["direccio"] = $sanititzador->sanitize($data["direccio"], 'string');
                $data["ciutat"] = $sanititzador->sanitize($data["ciutat"], 'string');
                $data["capacitat"] = $sanititzador->sanitize($data["capacitat"], 'int');

                if (empty($data["id"]) || empty($data["nom"]) || empty($data["direccio"]) || empty($data["ciutat"]) || empty($data["capacitat"])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris buits: id - nom - direccio - ciutat - capacitat']);
                    exit;
                }

                LocalitzacioController::actualitza($data);
                exit;
            }
            else if ($path == "api/espectacle") {
                if (!is_array($data) || !isset($data['id'], $data['nom'], $data['poster'], $data['horaInici'],
                                               $data['horaFinal'], $data['localitzacio'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris: id - nom - poster - horaInici - horaFinal - localitzacio']);
                    exit;
                }
                $data["id"] = $sanititzador->sanitize($data["id"], 'int');
                $data["nom"] = $sanititzador->sanitize($data["nom"], 'string');
                $data["localitzacio"] = $sanititzador->sanitize($data["localitzacio"], 'string');

                if (empty($data["id"]) || empty($data["nom"]) || empty($data["poster"]) || empty($data["horaInici"]) ||
                    empty($data["horaFinal"]) || empty($data["localitzacio"])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris buits: id - nom - poster - horaInici - horaFinal - localitzacio']);
                    exit;
                }

                EspectacleController::actualitza($data);
                exit;
            }
            else if ($path == "api/seient") {
                if (!is_array($data) || !isset($data['id'], $data['fila'], $data['numero'], $data['tipus'], $data['localitzacio'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris: id - fila - numero - tipus - localitzacio']);
                    exit;
                }
                $data["id"] = $sanititzador->sanitize($data["id"], 'int');
                $data["fila"] = $sanititzador->sanitize($data["fila"], 'int');
                $data["numero"] = $sanititzador->sanitize($data["numero"], 'int');
                $data["tipus"] = $sanititzador->sanitize($data["tipus"], 'string');
                $data["localitzacio"] = $sanititzador->sanitize($data["localitzacio"], 'string');

                if (empty($data["id"]) || empty($data["fila"]) || empty($data["numero"]) || empty($data["tipus"]) || empty($data["localitzacio"])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris buits: id - fila - numero - tipus - localitzacio']);
                    exit;
                }

                SeientController::actualitza($data);
                exit;
            }
            else if ($path == "api/entrada") {
                if (!is_array($data) || !isset($data['id'], $data['ref'], $data['estat'], $data['preu'], $data['espectacle'], $data['seient_id'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris: id - ref - estat - preu - espectacle - seient_id']);
                    exit;
                }
                $data["id"] = $sanititzador->sanitize($data["id"], 'int');
                $data["ref"] = $sanititzador->sanitize($data["ref"], 'string');
                $data["estat"] = $sanititzador->sanitize($data["estat"], 'string');
                $data["preu"] = $sanititzador->sanitize($data["preu"], 'float');
                $data["espectacle"] = $sanititzador->sanitize($data["espectacle"], 'string');
                $data["seient_id"] = $sanititzador->sanitize($data["seient_id"], 'int');

                if (empty($data["id"]) || empty($data["ref"]) || empty($data["estat"]) || empty($data["preu"]) ||
                    empty($data["espectacle"]) || empty($data["seient_id"])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris buits: id - ref - estat - preu - espectacle - seient_id']);
                    exit;
                }

                EntradaController::actualitza($data);
                exit;
            }
            else if ($path == "api/compra") {
                if (!is_array($data) || !isset($data['id'], $data['dataCompra'], $data['metodepagament'], $data['usuari'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris: id - dataCompra - metodepagament - usuari']);
                    exit;
                }
                $data["id"] = $sanititzador->sanitize($data["id"], 'int');
                $data["metodepagament"] = $sanititzador->sanitize($data["email"], 'string');
                $data["usuari"] = $sanititzador->sanitize($data["usuari"], 'email');

                if (empty($data["id"]) || empty($data["dataCompra"]) || empty($data["metodepagament"]) || empty($data["usuari"])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris buits: id - dataCompra - metodepagament - usuari']);
                    exit;
                }

                CompraController::actualitza($data);
                exit;
            }
            break;
        case "DELETE":
            $body = file_get_contents('php://input');
            $data = json_decode($body, true);
            if ($path == "api/usuari") {
                if (!is_array($data) || !isset($data['email'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camp necessari: email']);
                    exit;
                }
                $data["email"] = $sanititzador->sanitize($data["email"], 'email');

                if (empty($data["email"])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris buits: email']);
                    exit;
                }

                UsuariController::elimina($data);
                exit;
            } else if ($path == "api/localitzacio") {
                if (!is_array($data) || !isset($data['nom'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris: nom']);
                    exit;
                }
                $data["nom"] = $sanititzador->sanitize($data["nom"], 'string');

                if (empty($data["nom"])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris buits: nom']);
                    exit;
                }

                LocalitzacioController::elimina($data);
                exit;
            } else if ($path == "api/espectacle") {
                if (!is_array($data) || !isset($data['nom'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris: nom']);
                    exit;
                }
                $data["nom"] = $sanititzador->sanitize($data["nom"], 'string');

                if (empty($data["nom"])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris buits: nom']);
                    exit;
                }

                EspectacleController::elimina($data);
                exit;
            } else if ($path == "api/seient") {
                if (!is_array($data) || !isset($data['id'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris: id']);
                    exit;
                }
                $data["id"] = $sanititzador->sanitize($data["id"], 'int');

                if (empty($data["id"])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris buits: id']);
                    exit;
                }

                SeientController::elimina($data);
                exit;
            } else if ($path == "api/entrada") {
                if (!is_array($data) || !isset($data['ref'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camp necessari: ref']);
                    exit;
                }
                $data["ref"] = $sanititzador->sanitize($data["ref"], 'string');

                if (empty($data["ref"])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris buits: ref']);
                    exit;
                }

                EntradaController::elimina($data);
                exit;
            } else if ($path == "api/compra") {
                if (!is_array($data) || !isset($data['id'])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camp necessari: id']);
                    exit;
                }
                $data["id"] = $sanititzador->sanitize($data["id"], 'int');

                if (empty($data["id"])) {
                    http_response_code(400);
                    echo json_encode(['status' => 'Camps necessaris buits: id']);
                    exit;
                }

                CompraController::elimina($data);
                exit;
            }

            break;
        default:
            http_response_code(405);
            exit;
    }
} catch (Exception $e) {
    ErrorView::show($e);
}