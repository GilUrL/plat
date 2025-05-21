import { mensajes } from "../../../hooks/mensajes.js";
const apiUrl = "https://plantatech.ultrasoftware.pro/api/"; //cambiar para el hosting


export const obtener_lecturas = (datos) => {
    $.ajax({
        url: apiUrl + "obtener_lecturas",
        method: "POST",
        data: JSON.stringify(datos),
        contentType: "application/json",
        dataType: "json",
        success: function (respuesta) {
            if (respuesta.status == true) {
                console.log(respuesta.datos);
            } else {
                mensajes(respuesta.msg, "error", "", 4000)
            }
        },
        error: function (xhr, status, error) {
            console.error("Estado:", status);
        }
    });
}
