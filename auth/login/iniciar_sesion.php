<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesion - PlantaTech</title>
    <!-- Bootstrap 5 CSS -->
    <link href="../../assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- sweetalert -->
    <link rel="stylesheet" href="../../assets/sweetalert/css/sweetalert2.min.css">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <div class="auth-container">
        <div class="auth-header">
            <h2 class="auth-title">Acceder</h2>
            <p class="auth-subtitle">Inicia sesion </p>
        </div>

        <form id="iniciar_sesion">

            <div class="mb-3">
                <label for="correo" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="correo_electronico" placeholder="ejemplo@gmail.com">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" placeholder="••••••••">
            </div>

            <div class="d-grid gap-2 mb-3">
                <button type="button" id="iniciar-sesion" class="btn btn-plant registro text-white">
                    <i class="bi bi-person-plus me-2" disabled></i> Iniciar Sesión
                </button>
            </div>

            <div class="auth-footer">
                ¿Ya tienes una cuenta? <a href="../registro/registro.php" class="auth-link">Registrate</a>
            </div
        </form>
    </div>

    <!-- jquery -->
    <script src="../../assets/jquery/jquery.js"></script>
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="../../assets/sweetalert/js/sweetalert2.all.min.js"></script>

    <script type="module" src="./js/login.js"></script>

</html>
</body>