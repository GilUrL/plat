<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro - PlantMonitor</title>
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
            <h2 class="auth-title">Crea tu cuenta</h2>
            <p class="auth-subtitle">Comienza tu experiencia con nosotros</p>
        </div>

        <form id="registro">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="primerNombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="primerNombre" placeholder="Ingresa tu nombre">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="apellidos" class="form-label">Apellidos</label>
                    <input type="text" class="form-control" id="apellidos" placeholder="Ingresa tus apellidos">
                </div>
            </div>

            <div class="mb-3">
                <label for="correo" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="correo" placeholder="ejemplo@gmail.com">
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control" id="password" placeholder="••••••••">
                <div class="password-strength">
                    <div class="password-strength-bar" id="passwordStrengthBar"></div>
                </div>
                <div class="form-text">Mínimo 8 caracteres</div>
            </div>

            <div class="mb-3">
                <label for="confirmPassword" class="form-label">Confirmar contraseña</label>
                <input type="password" class="form-control" id="confirmPassword" placeholder="••••••••">
            </div>

            <div class="form-check mb-4">
                <input class="form-check-input" type="checkbox" id="terms">
                <label class="form-check-label" for="terms">
                    Acepto los <a href="#" class="auth-link">Términos y condiciones</a>
                </label>
            </div>

            <div class="d-grid gap-2 mb-3">
                <button type="button" id="registro" class="btn btn-plant registro text-white">
                    <i class="bi bi-person-plus me-2" disabled></i> Registrarse
                </button>
            </div>

            <div class="auth-footer">
                ¿Ya tienes una cuenta? <a href="../login/iniciar_sesion.php" class="auth-link">Inicia sesión</a>
            </div>
        </form>
    </div>

    <!-- jquery -->
    <script src="../../assets/jquery/jquery.js"></script>
    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="../../assets/sweetalert/js/sweetalert2.all.min.js"></script>

    <script type="module" src="./js/registro.js"></script>

</html>
</body>