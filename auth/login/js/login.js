import { getValues } from "../hooks/getValues.js";
import { iniciar_sesion } from "../hooks/peticiones.js";
$("#iniciar-sesion").on("click", function () {
    let datos = getValues();
    localStorage.setItem('correo', datos.correo);
    console.log(datos);
    iniciar_sesion(datos);
});