
<?php
/*
* Controlador de rutas principal
* Redirecciona las peticiones a los controladores correspondientes
*/




header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
    header("Access-Control-Allow-Headers: Content-Type");
    exit(0);
}

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', trim($uri, '/'));

$resource = $uri[1] ?? null;
$id = $uri[2] ?? null;

$input = json_decode(file_get_contents("php://input"), true) ?? [];

switch ($resource) {
    case 'registrar_usuario':
        if ($method === 'POST') {
            require_once './controller/usuarios/usuariosController.php';
            $controller = new UsuariosController($resource, $input);
            $controller->peticiones();
        
        } else {
            http_response_code(405);
            echo json_encode(["error" => "Metodo no permitido"]);
        }
        break;
    case 'iniciar_sesion':
        if ($method === 'POST') {
            require_once './controller/usuarios/usuariosController.php';
            $controller = new UsuariosController($resource, $input);
            $controller->peticiones();
        
        } else {
            http_response_code(405);
            echo json_encode(["error" => "Metodo no permitido"]);
        }
        break;
    case 'registrar_lecturas':
        if ($method === 'POST') {
            require_once './controller/macetas/macetasController.php';
            $controller = new MacetasController($resource, $input);
            $controller->peticiones();
        
        } else {
            http_response_code(405);
            echo json_encode(["error" => "Metodo no permitido"]);
        }
        break;
    default:
        http_response_code(404);
        echo json_encode(["error" => "Recurso no encontrado"]);
        break;
}
