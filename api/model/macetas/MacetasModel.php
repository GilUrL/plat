<?php
require_once './library/conexion.php';

class MacetasModel extends DatabaseDB
{
    private $nombre;
    private $apellidos;
    private $correo;
    private $contrasena;

    private $nivel_luz;
    private $humedad_aire;
    private $temperatura;
    private $humedad_suelo;


    public function __construct($p)
    {
        parent::__construct();
        //desempaquetar datos

        $this->nombre = $p['nombre'] ?? null;
        $this->apellidos = $p['apellidos'] ?? null;
        $this->correo = $p['correo'] ?? null;
        $this->contrasena = $p['password'] ?? null;


        $this->nivel_luz = $p['nivel_luz'] ?? null;
        $this->humedad_aire = $p['humedad_aire'] ?? null;
        $this->temperatura = $p['temperatura'] ?? null;
        $this->humedad_suelo = $p['humedad_suelo'] ?? null;
    }

    protected function existeCorreo()
    {
        try {
            $conn = $this->connBD();
            $sql = "SELECT `id_usuario` FROM `usuario` WHERE correo = :correo";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ":correo" => $this->correo
            ]);
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!empty($resultado)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            error_log("Error en existeCorreo: " . $e->getMessage());
            return [
                "status" => false,
                "msg" => "Error al obtener los correos ",
                "datos" => null,
                "cod" => 500
            ];
        }
    }


    protected function existeUsuario()
    {
        try {
            $sql = "SELECT id_usuario FROM usuario WHERE correo = :correo";
            $execute = $this->connBD()->prepare($sql);
            $arrayValues = array(
                ":correo" => $this->correo,
            );
            $execute->execute($arrayValues);
            $res = $execute->fetch(PDO::FETCH_ASSOC);

            if ($res && isset($res['id_usuario'])) {
                return $res['id_usuario'];
            } else {
                return false;
            }
        } catch (PDOException $e) {
            error_log("Error en existeUsuario: " . $e->getMessage());
            return false;
        }
    }


    protected function nuevaLectura()
    {
        try {
            $id_usuario = $this->existeUsuario();
            if (!$id_usuario) {
                return [
                    "status" => false,
                    "msg" => "El usuario no fue encontrado",
                    "datos" => null,
                    "cod" => 409
                ];
            }
            date_default_timezone_set('America/Mexico_City');
            $conn = $this->connBD();
            $sql = "INSERT INTO `lecturas`(`nivel_luz`, `humedad_aire`, `temperatura`, `humedad_suelo`, `hora_registro`, `fecha_registro`, `id_usuario`) 
            VALUES (:luz,:humedad_aire,:temperatura,:humedad_suelo,:hora_registro,:fecha_registro,:id_usuario)";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ":luz" => $this->nivel_luz,
                ":humedad_aire" => $this->humedad_aire,
                ":temperatura" => $this->temperatura,
                ":humedad_suelo" => $this->humedad_suelo,
                ":hora_registro" => date('H:i:s'),
                ":fecha_registro" => date('Y-m-d'),
                ":id_usuario" => $id_usuario
            ]);
            $respuesta = $stmt->rowCount();
            if ($respuesta) {
                return [
                    "status" => true,
                    "msg" => "La lectura fue registrada correctamente",
                    "datos" => null,
                    "cod" => 201
                ];
            } else {
                return [
                    "status" => true,
                    "msg" => "La lectura no se pudo registrar",
                    "datos" => null,
                    "cod" => 500
                ];
            }
        } catch (PDOException $e) {
            error_log("Error en nuevaLectura: " . $e->getMessage());
            return false;
        }
    }

    protected function traerLectura()
    {
        try {
            $conn = $this->connBD();

            $sql = "SELECT 
            nivel_luz, 
            humedad_aire, 
            temperatura, 
            humedad_suelo, 
            hora_registro, 
            fecha_registro 
            FROM lecturas 
            INNER JOIN usuario ON usuario.id_usuario = lecturas.id_usuario 
            WHERE correo = :correo 
            ORDER BY fecha_registro DESC, hora_registro DESC 
            LIMIT 1;";

            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ':correo' => $this->correo
            ]);
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($res) {
                return [
                    "status" => true,
                    "msg" => "Lecturas obtenidas ",
                    "datos" => $res,
                    "cod" => 200
                ];
            }
            return [
                "status" => true,
                "msg" => "La lectura no fue encontrada",
                "datos" => null,
                "cod" => 500
            ];
        } catch (PDOException $e) {
            error_log("Error en traerLectura: " . $e->getMessage());
            return false;
        }
    }
}
