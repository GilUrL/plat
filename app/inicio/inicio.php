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
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" class="user-avatar me-2">
                            <span class="text-white">Usuario</span>
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
                    <h5 class="fw-bold mb-3"><i class="bi bi-exclamation-triangle me-2"></i>Alertas y Recomendaciones</h5>
                    <div class="alert alert-warning d-flex align-items-center">
                        <div class="alert-icon bg-warning text-white me-3">
                            <i class="bi bi-droplet"></i>
                        </div>
                        <div>
                            <strong>Humedad del suelo baja</strong> - Considera regar la planta
                        </div>
                    </div>
                    <div class="alert alert-success d-flex align-items-center">
                        <div class="alert-icon bg-success text-white me-3">
                            <i class="bi bi-thermometer"></i>
                        </div>
                        <div>
                            <strong>Temperatura óptima</strong> - La temperatura es ideal para tu planta
                        </div>
                    </div>
                    <div class="alert alert-info d-flex align-items-center">
                        <div class="alert-icon bg-info text-white me-3">
                            <i class="bi bi-sun"></i>
                        </div>
                        <div>
                            <strong>Luz adecuada</strong> - La planta recibe suficiente luz
                        </div>
                    </div>
                    <div class="alert alert-primary d-flex align-items-center">
                        <div class="alert-icon bg-primary text-white me-3">
                            <i class="bi bi-clock-history"></i>
                        </div>
                        <div>
                            <strong>Último riego:</strong> Hace 2 días
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../../assets/jquery/jquery.js"></script>

    <!-- Bootstrap 5 JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Datos de ejemplo para los gráficos
        const hours = [];
        for (let i = 0; i < 24; i++) {
            hours.push(i + ':00');
        }

        // Gráfico de Humedad del Suelo
        const soilCtx = document.getElementById('soilChart').getContext('2d');
        const soilChart = new Chart(soilCtx, {
            type: 'line',
            data: {
                labels: hours,
                datasets: [{
                    label: 'Humedad del Suelo (%)',
                    data: [45, 44, 43, 42, 41, 40, 42, 45, 50, 48, 45, 43,
                        42, 41, 40, 39, 38, 37, 36, 38, 40, 42, 43, 44
                    ],
                    borderColor: '#4361ee',
                    backgroundColor: 'rgba(67, 97, 238, 0.1)',
                    borderWidth: 2,
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        min: 30,
                        max: 60
                    }
                }
            }
        });

        // Gráfico de Temperatura y Humedad
        const tempHumidityCtx = document.getElementById('tempHumidityChart').getContext('2d');
        const tempHumidityChart = new Chart(tempHumidityCtx, {
            type: 'line',
            data: {
                labels: hours,
                datasets: [{
                        label: 'Temperatura (°C)',
                        data: [20, 19.5, 19, 18.5, 18, 18.5, 19, 20, 22, 24, 25, 24.5,
                            24, 23.5, 23, 22.5, 22, 21.5, 21, 20.5, 20, 19.5, 19, 20
                        ],
                        borderColor: '#dc3545',
                        backgroundColor: 'rgba(220, 53, 69, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Humedad del Aire (%)',
                        data: [70, 72, 73, 74, 75, 73, 70, 68, 65, 60, 58, 60,
                            62, 63, 64, 65, 66, 67, 68, 69, 70, 71, 72, 70
                        ],
                        borderColor: '#17a2b8',
                        backgroundColor: 'rgba(23, 162, 184, 0.1)',
                        borderWidth: 2,
                        tension: 0.4,
                        fill: true,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        title: {
                            display: true,
                            text: 'Temperatura (°C)'
                        },
                        min: 15,
                        max: 30
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        title: {
                            display: true,
                            text: 'Humedad (%)'
                        },
                        min: 50,
                        max: 80,
                        grid: {
                            drawOnChartArea: false
                        }
                    }
                }
            }
        });

        // Gráfico de Niveles de Luz
        const lightCtx = document.getElementById('lightChart').getContext('2d');
        const lightChart = new Chart(lightCtx, {
            type: 'bar',
            data: {
                labels: hours,
                datasets: [{
                    label: 'Nivel de Luz (lux)',
                    data: [0, 0, 0, 0, 0, 50, 200, 500, 800, 1000, 1200, 1100,
                        1000, 950, 900, 850, 800, 700, 500, 300, 100, 50, 0, 0
                    ],
                    backgroundColor: 'rgba(255, 193, 7, 0.7)',
                    borderColor: 'rgba(255, 193, 7, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Lux'
                        }
                    }
                }
            }
        });

        // Simular datos en tiempo real (para demostración)
        function updateSensorValues() {
            // Variaciones pequeñas para simular cambios
            const light = 850 + Math.floor(Math.random() * 50 - 25);
            const airHumidity = 65 + Math.floor(Math.random() * 6 - 3);
            const temperature = 22.5 + (Math.random() * 2 - 1);
            const soilHumidity = 42 + Math.floor(Math.random() * 6 - 3);

            document.getElementById('light-value').textContent = light;
            document.getElementById('air-humidity-value').textContent = airHumidity;
            document.getElementById('temperature-value').textContent = temperature.toFixed(1);
            document.getElementById('soil-humidity-value').textContent = soilHumidity;

            // Actualizar progress bars
            document.querySelector('.progress-bar.bg-warning').style.width = `${(light/1500)*100}%`;
            document.querySelector('.progress-bar.bg-info').style.width = `${airHumidity}%`;
            document.querySelector('.progress-bar.bg-danger').style.width = `${((temperature-15)/15)*100}%`;
            document.querySelector('.progress-bar.bg-primary').style.width = `${soilHumidity}%`;

            // Actualizar estado de humedad del suelo
            const soilBadge = document.querySelector('#soil-humidity-value').closest('.plant-card').querySelector('.badge');
            if (soilHumidity < 40) {
                soilBadge.className = 'badge bg-warning text-dark';
                soilBadge.textContent = 'Bajo';
            } else if (soilHumidity > 60) {
                soilBadge.className = 'badge bg-danger';
                soilBadge.textContent = 'Alto';
            } else {
                soilBadge.className = 'badge bg-success';
                soilBadge.textContent = 'Óptimo';
            }
        }

        // Actualizar cada 5 segundos (simulación)
        setInterval(updateSensorValues, 5000);
    </script>

    <script type="module" src="js/inicio.js"></script>
</body>

</html>