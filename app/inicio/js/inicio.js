import { obtener_lecturas } from "../hooks/peticiones.js";

$(document).ready(function () {
    let prueba = localStorage.getItem('correo');
    let datos = {
        "correo":prueba
    }
    console.log(prueba);
    obtener_lecturas(datos);
});
