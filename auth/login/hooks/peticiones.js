import { mensajes } from "../../../hooks/mensajes.js";
const apiUrl = "https://plantatech.ultrasoftware.pro/api/"; //cambiar para el hosting


export const iniciar_sesion = (datos) => {
    $.ajax({
        url: apiUrl + "iniciar_sesion",
        method: "POST",
        data: JSON.stringify(datos),
        contentType: "application/json",
        dataType: "json",
        success: function (respuesta) {
            if (respuesta.status == true) {
                mensajes(respuesta.msg, "success", "", 4000);
                $("#iniciar_sesion")[0].reset();
                window.location.href = '../../app/inicio/inicio.php';
            } else {
                mensajes(respuesta.msg, "error", "", 4000)
            }
        },
        error: function (xhr, status, error) {
            console.error("Estado:", status);
        }
    });
}
