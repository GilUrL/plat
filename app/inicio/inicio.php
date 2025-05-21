<?php
require_once '../conf/verificarSesion.php';
verificarSesion();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maceta Inteligente - Dashboard</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <!-- Barra de Navegación Mejorada -->
    <nav class="navbar navbar-plant navbar-expand-lg navbar-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand navbar-brand-plant" href="#">
                <i class="bi bi-flower1 logo-icon"></i>
                <span>PlantaTech</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarMain">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link nav-link-plant active" href="#">
                            <i class="bi bi-speedometer2 me-1"></i> Dashboard
                        </a>
                    <li class="nav-item">
                        <a class="nav-link nav-link-plant" href="#">
                            <i class="bi bi-question-circle me-1"></i> Ayuda
                        </a>
                    </li>
                </ul>

                <div class="d-flex align-items-center">
                    <div class="search-box me-3">
                        <i class="bi bi-search search-icon"></i>
                        <input class="form-control search-input" type="search" placeholder="Buscar planta...">
                    </div>

                    <div class="dropdown me-3">
                        <a class="btn btn-link position-relative p-0" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-bell text-white fs-5"></i>
                            <span class="notification-badge badge rounded-pill">3</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-plant dropdown-menu-end">
                            <li>
                                <h6 class="dropdown-header">Notificaciones</h6>
                            </li>
                            <li>
                                <a class="dropdown-item dropdown-item-plant" href="#">
                                    <div class="d-flex">
                                        <div class="me-2 text-danger">
                                            <i class="bi bi-droplet"></i>
                                        </div>
                                        <div>
                                            <small>Hace 30 min</small>
                                            <p class="mb-0">Humedad del suelo baja</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item dropdown-item-plant" href="#">
                                    <div class="d-flex">
                                        <div class="me-2 text-success">
                                            <i class="bi bi-thermometer-sun"></i>
                                        </div>
                                        <div>
                                            <small>Hace 2 horas</small>
                                            <p class="mb-0">Temperatura estable</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item dropdown-item-plant" href="#">
                                    <div class="d-flex">
                                        <div class="me-2 text-warning">
                                            <i class="bi bi-lightbulb"></i>
                                        </div>
                                        <div>
                                            <small>Hoy, 08:15</small>
                                            <p class="mb-0">Luz solar detectada</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item dropdown-item-plant text-center" href="#">Ver todas</a></li>
                        </ul>
                    </div>

                    <div class="dropdown">
                        <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <img src="#" class="user-avatar me-2">
                            <span class="text-white">
                                <?php echo htmlspecialchars($_SESSION['usuario']['nombre'] ?? 'Usuario'); ?>
                            </span>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-plant dropdown-menu-end">
                            <li>
                                <a class="dropdown-item dropdown-item-plant" href="#">
                                    <i class="bi bi-person me-2"></i> Perfil
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item dropdown-item-plant" href="#">
                                    <i class="bi bi-sliders me-2"></i> Preferencias
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item dropdown-item-plant" href="#">
                                    <i class="bi bi-shield-lock me-2"></i> Seguridad
                                </a>
                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li>
                                <a class="dropdown-item dropdown-item-plant" href="#">
                                    <i class="bi bi-box-arrow-right me-2"></i> Cerrar sesión
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col">
                <h2 class="fw-bold"><i class="bi bi-flower1 me-2" style="color: var(--plant-primary);"></i> Maceta Inteligente</h2>
                <p class="text-muted">Monitoreo en tiempo real de los sensores</p>
            </div>
        </div>

        <!-- Tarjetas de estado actual -->
        <div class="row g-4 mb-4">
            <!-- Luz -->
            <div class="col-md-6 col-lg-3">
                <div class="plant-card p-4 h-100 plant-status">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="fw-bold mb-3"><i class="bi bi-sun me-2"></i>Nivel de Luz</h5>
                            <div class="d-flex align-items-end">
                                <span class="sensor-value" id="light-value">850</span>
                                <span class="sensor-unit mb-2 ms-1">lux</span>
                            </div>
                            <div class="mt-2">
                                <span class="badge bg-success">Óptimo</span>
                            </div>
                        </div>
                        <div class="sensor-icon bg-warning">
                            <i class="bi bi-brightness-high"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 65%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Humedad del Aire -->
            <div class="col-md-6 col-lg-3">
                <div class="plant-card p-4 h-100 plant-status">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="fw-bold mb-3"><i class="bi bi-cloud-rain me-2"></i>Humedad Aire</h5>
                            <div class="d-flex align-items-end">
                                <span class="sensor-value" id="air-humidity-value">65</span>
                                <span class="sensor-unit mb-2 ms-1">%</span>
                            </div>
                            <div class="mt-2">
                                <span class="badge bg-success">Normal</span>
                            </div>
                        </div>
                        <div class="sensor-icon bg-info">
                            <i class="bi bi-droplet"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 65%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Temperatura -->
            <div class="col-md-6 col-lg-3">
                <div class="plant-card p-4 h-100 plant-status">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="fw-bold mb-3"><i class="bi bi-thermometer me-2"></i>Temperatura</h5>
                            <div class="d-flex align-items-end">
                                <span class="sensor-value" id="temperature-value">22.5</span>
                                <span class="sensor-unit mb-2 ms-1">°C</span>
                            </div>
                            <div class="mt-2">
                                <span class="badge bg-success">Ideal</span>
                            </div>
                        </div>
                        <div class="sensor-icon bg-danger">
                            <i class="bi bi-thermometer-half"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-danger" role="progressbar" style="width: 45%;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Humedad del Suelo -->
            <div class="col-md-6 col-lg-3">
                <div class="plant-card p-4 h-100 plant-status">
                    <div class="d-flex justify-content-between align-items-start">
                        <div>
                            <h5 class="fw-bold mb-3"><i class="bi bi-moisture me-2"></i>Humedad Suelo</h5>
                            <div class="d-flex align-items-end">
                                <span class="sensor-value" id="soil-humidity-value">42</span>
                                <span class="sensor-unit mb-2 ms-1">%</span>
                            </div>
                            <div class="mt-2">
                                <span class="badge bg-warning text-dark">Bajo</span>
                            </div>
                        </div>
                        <div class="sensor-icon bg-primary">
                            <i class="bi bi-water"></i>
                        </div>
                    </div>
                    <div class="mt-3">
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 42%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gráficos -->
        <div class="row g-4">
            <!-- Gráfico de Humedad del Suelo -->
            <div class="col-lg-6">
                <div class="plant-card p-4 h-100">
                    <h5 class="fw-bold mb-3"><i class="bi bi-moisture me-2"></i>Humedad del Suelo (24h)</h5>
                    <div class="chart-container">
                        <canvas id="soilChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Gráfico de Temperatura y Humedad -->
            <div class="col-lg-6">
                <div class="plant-card p-4 h-100">
                    <h5 class="fw-bold mb-3"><i class="bi bi-clipboard2-data me-2"></i>Temperatura & Humedad (24h)</h5>
                    <div class="chart-container">
                        <canvas id="tempHumidityChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Gráfico de Luz -->
            <div class="col-lg-6">
                <div class="plant-card p-4 h-100">
                    <h5 class="fw-bold mb-3"><i class="bi bi-brightness-high me-2"></i>Niveles de Luz (24h)</h5>
                    <div class="chart-container">
                        <canvas id="lightChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Alertas y Recomendaciones -->
            <div class="col-lg-6">
                <div class="plant-card p-4 h-100">
                    <h5 class="fw-bold mb-3">
                        <i class="bi bi-exclamation-triangle me-2"></i>Alertas y Recomendaciones
                    </h5>
                    <div id="alertas-contenedor"></div> <!-- Aquí se insertarán dinámicamente las alertas -->
                </div>
            </div>

        </div>
    </div>
    <script src="../../assets/jquery/jquery.js"></script>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script type="module" src="./hooks/peticiones.js"></script>
</body>

</html>