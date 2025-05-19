<?php
require_once './library/conexion.php';

class UsuariosModel extends DatabaseDB
{
    private $nombre;
    private $apellidos;
    private $correo;
    private $contrasena;

    public function __construct($p)
    {
        parent::__construct();
        //desempaquetar datos

        $this->nombre = $p['nombre'] ?? null;
        $this->apellidos = $p['apellidos'] ?? null;
        $this->correo = $p['correo'] ?? null;
        $this->contrasena = $p['password'] ?? null;
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

    protected function nuevoUsuario()
    {
        try {
            $verificar = $this->existeCorreo();
            if ($verificar == true) {
                return [
                    "status" => false,
                    "msg" => "El correo ya esta registrado",
                    "datos" => null,
                    "cod" => 409
                ];
            }
            $conn = $this->connBD();
            $sql = "INSERT INTO `usuario`(`nombre`, `apellidos`, `correo`, `contrasena`, `token`, `acepto_terminos`)
             VALUES (:nombre, :apellidos, :correo, :contrasena,:token, :acepto_terminos )";
            $stmt = $conn->prepare($sql);
            $stmt->execute([
                ":nombre" => $this->nombre,
                ":apellidos" => $this->apellidos,
                ":correo" => $this->correo,
                ":contrasena" => password_hash($this->contrasena, PASSWORD_DEFAULT),
                ":token" => bin2hex(random_bytes(16)),
                ":acepto_terminos" => "aceptado"
            ]);
            $resultado = $stmt->rowCount();
            if ($resultado <= 0) {
                return [
                    "status" => false,
                    "msg" => "No se pudo crear el usuario",
                    "datos" => null,
                    "cod" => 409
                ];
            }
            return [
                "status" => true,
                "msg" => "Usuario creado correctamente",
                "datos" => null,
                "cod" => 201
            ];
        } catch (Exception $e) {
            error_log("Error en nuevoUsuario: " . $e->getMessage());
            return [
                "status" => false,
                "msg" => "Error al crear el usuario",
                "datos" => null,
                "cod" => 500
            ];
        }
    }

    protected function existeUsuario()
    {
        try {
            $sql = "SELECT nombre, correo FROM usuario WHERE correo = :correo";
            $execute = $this->connBD()->prepare($sql);
            $arrayValues = array(
                ":correo" => $this->correo,
            );
            $execute->execute($arrayValues);
            $res = $execute->fetchAll(PDO::FETCH_ASSOC);

            return !empty($res);
        } catch (PDOException $e) {
            error_log("Error en existeUsuario: " . $e->getMessage());
            return false;
        }
    }

    protected function loginUsuario()
    {
        try {
            if (!$this->existeUsuario()) {
                return [
                    "status" => false,
                    "msg" => "El usuario no existe",
                    "datos" => null,
                    "cod" => 404
                ];
            }

            $sql = "SELECT `nombre`, `contrasena`, `correo` FROM `usuario` 
                WHERE correo = :correo";

            $stmt = $this->connBD()->prepare($sql);
            $stmt->execute([
                ":correo" => $this->correo,
                
            ]);

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuario && password_verify($this->contrasena, $usuario['contrasena'])) {
                $ahora = date('Y-m-d H:i:s');

                $sql = "UPDATE `usuario` SET `fecha_sesion` = :ultimoLogin 
                    WHERE correo = :correo";

                $stmt = $this->connBD()->prepare($sql);
                $stmt->execute([
                    ":ultimoLogin" => $ahora,
                    ":correo" => $this->correo
                ]);

                return [
                    "status" => true,
                    "msg" => "Usuario logeado",
                    "datos" => $usuario,
                    "cod" => 201
                ];
            } else {
                return [
                    "status" => false,
                    "msg" => "Contraseña incorrecta",
                    "datos" => null,
                    "cod" => 401
                ];
            }
        } catch (PDOException $e) {
            error_log("Error en loginUsuario: " . $e->getMessage());
            return [
                "status" => false,
                "msg" => "Error en el login",
                "datos" => null,
                "cod" => 500
            ];
        }
    }
}
