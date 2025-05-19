<?php
require_once './helper/convertirJSON.php';
require_once './model/usuarios/usuariosModel.php';

class UsuariosController extends UsuariosModel
{

    private $peticion;
    private $datos;

    public function __construct($peticion = null, $datos = null)
    {
        parent::__construct($datos);
        $this->peticion = $peticion;
        $this->datos = $datos;
    }


    public function peticiones()
    {
        switch ($this->peticion) {
            case 'registrar_usuario':
                $this->registrarUsuario();
                break;
            case ('iniciar_sesion'):
                $this->iniciarSesion();
                break;
            default:
                http_response_code(404);
                echo json_encode(["error" => "Petición no reconocida"]);
                break;
        }
    }

    private function registrarUsuario()
    {
        $usuario = $this->nuevoUsuario();
        if ($usuario) {
            $res = [
                "status" => $usuario['status'] ?? "no se encontro status del model",
                "msg" => $usuario['msg'] ?? "no se encontro mensaje del model",
                "datos" => $usuario['datos'] ?? "model no proporciono datos"
            ];
        } else {
            $res = [
                "status" => $usuario['status'] ?? "no se encontro status del model",
                "msg" => $usuario['msg'] ?? "no se encontro mensaje del model",
                "datos" => $usuario['datos'] ?? "model no proporciono datos"
            ];
        }
        convertirJSON($res);
    }

    private function iniciarSesion()
    {
        session_start();
        $resultadoLogin = $this->loginUsuario();

        if (!is_array($resultadoLogin) || !isset($resultadoLogin['status'])) {
            $res = [
                "status" => false,
                "msg" => "Error inesperado en el login",
                "datos" => null,
                "cod" => 500
            ];
            convertirJSON($res);
            return;
        }

        if ($resultadoLogin['status']) {
            session_regenerate_id(true);

            $_SESSION['usuario'] = [
                'nombre' => $resultadoLogin['datos']['nombre'] ?? null,
                'correo' => $resultadoLogin['datos']['correo'] ?? null,
                'logged_in' => true
            ];

            $res = [
                "status" => true,
                "msg" => $resultadoLogin['msg'] ?? "Login exitoso",
                "datos" => $resultadoLogin['datos'] ?? null
            ];
        } else {
            $res = [
                "status" => false,
                "msg" => $resultadoLogin['msg'] ?? "Error en el login",
                "datos" => null,
                "cod" => $resultadoLogin['cod'] ?? 401
            ];
        }
        convertirJSON($res);
    }
}
