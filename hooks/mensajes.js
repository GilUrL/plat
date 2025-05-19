export const mensajes = (
    msg,
    icono = "success",
    texto = "",
    tiempo = null,
) => {
    Swal.fire({
        title: msg,
        text: texto,
        icon: icono,
        timer: tiempo,
        timerProgressBar: !!tiempo,
    });
};
