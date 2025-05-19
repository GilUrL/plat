// regex.js

export const regex = {

    correo: /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,

    nombreUsuario: /^[a-zA-Z0-9_]{4,20}$/,

    contrasena: /^(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$/,

    nombre: /^[a-zA-ZÁÉÍÓÚáéíóúÑñ ]{0,40}$/,

    usuarios: /^(?:[a-zA-Z0-9_]{3,20}|[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,})$/


};
