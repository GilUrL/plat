<?php
require_once './helper/convertirJSON.php';
require_once './model/macetas/MacetasModel.php';

class MacetasController extends MacetasModel
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
            case 'registrar_lecturas':
                $this->registroLectura();
                break;
            case 'obtener_lecturas':
                $this->obtenerLecturas();
                break;
            default:
                http_response_code(404);
                echo json_encode(["error" => "Petición no reconocida"]);
                break;
        }
    }

    private function registroLectura()
    {
        $lectura = $this->nuevaLectura();
        if ($lectura) {
            $res = [
                "status" => $lectura['status'] ?? "no se encontro status del model",
                "msg" => $lectura['msg'] ?? "no se encontro mensaje del model",
                "datos" => $lectura['datos'] ?? "model no proporciono datos"
            ];
        } else {
            $res = [
                "status" => $lectura['status'] ?? "no se encontro status del model",
                "msg" => $lectura['msg'] ?? "no se encontro mensaje del model",
                "datos" => $lectura['datos'] ?? "model no proporciono datos"
            ];
        }
        convertirJSON($res);
    }
    private function obtenerLecturas()
    {
        $lectura = $this->traerLectura();
        if ($lectura) {
            $res = [
                "status" => $lectura['status'] ?? "no se encontro status del model",
                "msg" => $lectura['msg'] ?? "no se encontro mensaje del model",
                "datos" => $lectura['datos'] ?? "model no proporciono datos"
            ];
        } else {
            $res = [
                "status" => $lectura['status'] ?? "no se encontro status del model",
                "msg" => $lectura['msg'] ?? "no se encontro mensaje del model",
                "datos" => $lectura['datos'] ?? "model no proporciono datos"
            ];
        }
        convertirJSON($res);
    }

}
