import { mensajes } from "../../../hooks/mensajes.js";
const apiUrl = "https://plantatech.ultrasoftware.pro/api/";

// Variables globales de gráficos
let soilChart, tempHumidityChart, lightChart;

// Ejecutar al cargar la página
document.addEventListener("DOMContentLoaded", function () {
    const horas = [];
    for (let i = 0; i < 24; i++) {
        horas.push(i + ':00');
    }

    // Inicializar gráficos
    const soilCtx = document.getElementById('soilChart').getContext('2d');
    soilChart = new Chart(soilCtx, {
        type: 'line',
        data: {
            labels: horas,
            datasets: [{
                label: 'Humedad del Suelo (%)',
                data: [],
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
                legend: { position: 'top' }
            },
            scales: {
                y: {
                    beginAtZero: false,
                    min: 0,
                    max: 100
                }
            }
        }
    });

    const tempHumidityCtx = document.getElementById('tempHumidityChart').getContext('2d');
    tempHumidityChart = new Chart(tempHumidityCtx, {
        type: 'line',
        data: {
            labels: horas,
            datasets: [{
                label: 'Temperatura (°C)',
                data: [],
                borderColor: '#dc3545',
                backgroundColor: 'rgba(220, 53, 69, 0.1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                yAxisID: 'y'
            }, {
                label: 'Humedad del Aire (%)',
                data: [],
                borderColor: '#17a2b8',
                backgroundColor: 'rgba(23, 162, 184, 0.1)',
                borderWidth: 2,
                tension: 0.4,
                fill: true,
                yAxisID: 'y1'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'top' }
            },
            scales: {
                y: {
                    type: 'linear',
                    position: 'left',
                    title: { display: true, text: 'Temperatura (°C)' },
                    min: 0,
                    max: 50
                },
                y1: {
                    type: 'linear',
                    position: 'right',
                    title: { display: true, text: 'Humedad (%)' },
                    min: 0,
                    max: 100,
                    grid: { drawOnChartArea: false }
                }
            }
        }
    });

    const lightCtx = document.getElementById('lightChart').getContext('2d');
    lightChart = new Chart(lightCtx, {
        type: 'bar',
        data: {
            labels: horas,
            datasets: [{
                label: 'Nivel de Luz (lux)',
                data: [],
                backgroundColor: 'rgba(255, 193, 7, 0.7)',
                borderColor: 'rgba(255, 193, 7, 1)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { position: 'top' }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: { display: true, text: 'Lux' }
                }
            }
        }
    });

    // Obtener correo del localStorage y hacer la primera petición
    let correo = localStorage.getItem('correo');
    if (correo) {
        const datos = { correo };
        obtener_lecturas(datos);

        // Actualizar cada 5 segundos
        setInterval(() => obtener_lecturas(datos), 5000);
    } else {
        mensajes("No se encontró correo en localStorage", "error", "", 4000);
    }
});

// Función para obtener lecturas
function obtener_lecturas(datos) {
    $.ajax({
        url: apiUrl + "obtener_lecturas",
        method: "POST",
        data: JSON.stringify(datos),
        contentType: "application/json",
        dataType: "json",
        success: function (respuesta) {
            if (respuesta.status === true) {
                const lecturas = respuesta.datos;
                const horas = [];
                const temperatura = [];
                const humedadAire = [];
                const humedadSuelo = [];
                const nivelLuz = [];

                lecturas.forEach(item => {
                    horas.push(item.hora_registro);
                    temperatura.push(parseFloat(item.temperatura));
                    humedadAire.push(parseFloat(item.humedad_aire));
                    humedadSuelo.push(parseFloat(item.humedad_suelo));
                    nivelLuz.push(parseFloat(item.nivel_luz));
                });

                actualizarGraficos(horas, temperatura, humedadAire, humedadSuelo, nivelLuz);
                actualizarLecturasActuales(lecturas[lecturas.length - 1]);
            } else {
                mensajes(respuesta.msg, "error", "", 4000);
            }
        },
        error: function (xhr, status, error) {
            console.error("Error AJAX:", status, error);
        }
    });
}

function actualizarGraficos(horas, temperatura, humedadAire, humedadSuelo, nivelLuz) {
    soilChart.data.labels = horas;
    soilChart.data.datasets[0].data = humedadSuelo;
    soilChart.update();

    tempHumidityChart.data.labels = horas;
    tempHumidityChart.data.datasets[0].data = temperatura;
    tempHumidityChart.data.datasets[1].data = humedadAire;
    tempHumidityChart.update();

    lightChart.data.labels = horas;
    lightChart.data.datasets[0].data = nivelLuz;
    lightChart.update();
}

function actualizarLecturasActuales(lectura) {
    const light = parseFloat(lectura.nivel_luz);
    const airHumidity = parseFloat(lectura.humedad_aire);
    const temperature = parseFloat(lectura.temperatura);
    const soilHumidity = parseFloat(lectura.humedad_suelo);

    document.getElementById('light-value').textContent = light;
    document.getElementById('air-humidity-value').textContent = airHumidity;
    document.getElementById('temperature-value').textContent = temperature.toFixed(1);
    document.getElementById('soil-humidity-value').textContent = soilHumidity;

    document.querySelector('.progress-bar.bg-warning').style.width = `${(light / 1500) * 100}%`;
    document.querySelector('.progress-bar.bg-info').style.width = `${airHumidity}%`;
    document.querySelector('.progress-bar.bg-danger').style.width = `${((temperature - 15) / 15) * 100}%`;
    document.querySelector('.progress-bar.bg-primary').style.width = `${soilHumidity}%`;

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

    // ACTUALIZAR ALERTAS Y RECOMENDACIONES
    const alertContainer = document.getElementById('alertas-contenedor');
    alertContainer.innerHTML = ''; // Limpiar

    // Humedad del suelo
    if (soilHumidity < 40) {
        alertContainer.innerHTML += `
            <div class="alert alert-warning d-flex align-items-center">
                <div class="alert-icon bg-warning text-white me-3">
                    <i class="bi bi-droplet"></i>
                </div>
                <div>
                    <strong>Humedad del suelo baja</strong> - Considera regar la planta
                </div>
            </div>`;
    } else if (soilHumidity > 60) {
        alertContainer.innerHTML += `
            <div class="alert alert-danger d-flex align-items-center">
                <div class="alert-icon bg-danger text-white me-3">
                    <i class="bi bi-droplet-half"></i>
                </div>
                <div>
                    <strong>Humedad del suelo alta</strong> - Evita exceso de riego
                </div>
            </div>`;
    } else {
        alertContainer.innerHTML += `
            <div class="alert alert-success d-flex align-items-center">
                <div class="alert-icon bg-success text-white me-3">
                    <i class="bi bi-droplet"></i>
                </div>
                <div>
                    <strong>Humedad del suelo óptima</strong> - Todo está bien
                </div>
            </div>`;
    }

    // Temperatura
    if (temperature < 18) {
        alertContainer.innerHTML += `
            <div class="alert alert-warning d-flex align-items-center">
                <div class="alert-icon bg-warning text-white me-3">
                    <i class="bi bi-thermometer-snow"></i>
                </div>
                <div>
                    <strong>Temperatura baja</strong> - Considera ubicar la planta en un lugar más cálido
                </div>
            </div>`;
    } else if (temperature > 28) {
        alertContainer.innerHTML += `
            <div class="alert alert-danger d-flex align-items-center">
                <div class="alert-icon bg-danger text-white me-3">
                    <i class="bi bi-thermometer-sun"></i>
                </div>
                <div>
                    <strong>Temperatura alta</strong> - Verifica que la planta no esté expuesta al sol directo
                </div>
            </div>`;
    } else {
        alertContainer.innerHTML += `
            <div class="alert alert-success d-flex align-items-center">
                <div class="alert-icon bg-success text-white me-3">
                    <i class="bi bi-thermometer"></i>
                </div>
                <div>
                    <strong>Temperatura óptima</strong> - La temperatura es ideal para tu planta
                </div>
            </div>`;
    }

    // Luz
    if (light < 300) {
        alertContainer.innerHTML += `
            <div class="alert alert-warning d-flex align-items-center">
                <div class="alert-icon bg-warning text-white me-3">
                    <i class="bi bi-sunrise"></i>
                </div>
                <div>
                    <strong>Poca luz</strong> - Reubica la planta a un lugar más iluminado
                </div>
            </div>`;
    } else if (light > 1200) {
        alertContainer.innerHTML += `
            <div class="alert alert-danger d-flex align-items-center">
                <div class="alert-icon bg-danger text-white me-3">
                    <i class="bi bi-brightness-high"></i>
                </div>
                <div>
                    <strong>Exceso de luz</strong> - Considera sombra parcial
                </div>
            </div>`;
    } else {
        alertContainer.innerHTML += `
            <div class="alert alert-info d-flex align-items-center">
                <div class="alert-icon bg-info text-white me-3">
                    <i class="bi bi-sun"></i>
                </div>
                <div>
                    <strong>Luz adecuada</strong> - La planta recibe suficiente luz
                </div>
            </div>`;
    }

    // Simulación de último riego
    alertContainer.innerHTML += `
        <div class="alert alert-primary d-flex align-items-center">
            <div class="alert-icon bg-primary text-white me-3">
                <i class="bi bi-clock-history"></i>
            </div>
            <div>
                <strong>Último riego:</strong> Hace 2 días
            </div>
        </div>`;
}
