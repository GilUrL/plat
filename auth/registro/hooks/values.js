export const valores = () => {
    let nombre = $("#primerNombre").val().trim();
    let apellido = $("#apellidos").val().trim();
    let correo = $("#correo").val().trim();
    let password = $("#password").val().trim();

    let datos = {
        "nombre": nombre,
        "apellidos": apellido,
        "correo": correo,
        "password": password
    }

    return datos;
}