export const getValues = () => {
  let correo_electronico = $("#correo_electronico").val().trim();
  let contrasena = $("#password").val().trim();

  let datos = {
    "correo": correo_electronico,
    "password": contrasena
  }
  return datos;
};