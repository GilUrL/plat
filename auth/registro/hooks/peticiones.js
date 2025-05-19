import { mensajes } from "../../../hooks/mensajes.js";
const apiUrl = "http://plat.test/api/"; //cambiar para el hosting


export const registrarUsuario = (datos) =>{
    $.ajax({
        url: apiUrl + "registrar_usuario",
        method: "POST",
        data: JSON.stringify(datos),
    contentType: "application/json",
        dataType: "json",
        success: function (respuesta) {
            if (respuesta.status == true){
                mensajes(respuesta.msg, "success","",4000);
                $("#registro")[0].reset();
            }else {
                mensajes(respuesta.msg, "error", "", 4000)
            }
        },
        error: function (xhr, status, error) {
            console.error("Estado:", status);
        }
    });
}