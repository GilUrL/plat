<?php

class DatabaseDB {
    private $host = 'localhost';
    private $nombre_bd = 'plat';
    private $usuario = 'root';
    private $password = '';

    public function __construct(){
      
    }
    protected function connBD() {

        try {
            $conexion = new PDO("mysql:host=$this->host;dbname=$this->nombre_bd;charset=utf8", $this->usuario, $this->password);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
            #echo "Conexión exitosa a la base de datos.";   
            return $conexion;
        } catch (PDOException $e) {
            echo "Error en la conexión: " . $e->getMessage();
            return null;
        }
    }
};

// $conexion = new DatabaseDB(); 
// //al hacer la instancia de la clase invoco automaticamente el constructor que son los parentesis
// print_r($conexion);
?>
 
