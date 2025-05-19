<?php
function convertirJSON($respuesta)
{
    $jsonResponse = json_encode($respuesta, JSON_UNESCAPED_UNICODE);
    header("HTTP/1.1 200 OK");
    header("Content-Type: application/json");
    
    // Hacer echo del JSON y salir
    echo $jsonResponse;
    exit;  // Detener la ejecución del script después de imprimir
}
?>
