<?php
function verificarSesion()
{
    session_start();
    if (!isset($_SESSION['usuario']) || !$_SESSION['usuario']['logged_in']) {
        header('Location: ../../auth/login/iniciar_sesion.php');
        exit();
    }
}
?>