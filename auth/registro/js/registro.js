import { regex } from "../hooks/regex.js";
import { valores } from "../hooks/values.js";
import { registrarUsuario } from "../hooks/peticiones.js";
$(document).ready(function () {
    const $correo = $('#correo');
    const $nombre = $('#primerNombre');
    const $apellido = $('#apellidos');
    const $password = $('#password');
    const $confirmPassword = $('#confirmPassword');
    const $terms = $('#terms');
    const $registroBtn = $('#registro');
    $registroBtn.prop('disabled', true);

    $('input').removeClass('is-valid is-invalid');

    const validateInput = ($input, pattern) => {
        const value = $input.val().trim();
        if (value === '') {
            // Si está vacío, quitar las clases pero no mostrar error
            $input.removeClass('is-valid is-invalid');
            return false;
        }
        
        if (pattern.test(value)) {
            $input.removeClass('is-invalid').addClass('is-valid');
            return true;
        } else {
            $input.removeClass('is-valid').addClass('is-invalid');
            return false;
        }
    };

    const validatePasswordMatch = () => {
        const password = $password.val();
        const confirm = $confirmPassword.val();
        
        if (confirm === '') {
            $confirmPassword.removeClass('is-valid is-invalid');
            return false;
        }
        
        if (password === confirm) {
            $confirmPassword.removeClass('is-invalid').addClass('is-valid');
            return true;
        } else {
            $confirmPassword.removeClass('is-valid').addClass('is-invalid');
            return false;
        }
    };

    const checkFormValidity = () => {
        const isNombreValid = $nombre.val().trim() === '' ? false : validateInput($nombre, regex.nombre);
        const isApellidoValid = $apellido.val().trim() === '' ? false : validateInput($apellido, regex.nombre);
        const isCorreoValid = $correo.val().trim() === '' ? false : validateInput($correo, regex.correo);
        const isPasswordValid = $password.val().trim() === '' ? false : validateInput($password, regex.contrasena);
        const isPasswordMatch = $confirmPassword.val().trim() === '' ? false : validatePasswordMatch();
        const isTermsChecked = $terms.is(':checked');

        // Habilitar el botón solo si todo es válido
        $registroBtn.prop('disabled', !(
            isNombreValid && 
            isApellidoValid && 
            isCorreoValid && 
            isPasswordValid && 
            isPasswordMatch &&
            isTermsChecked
        ));
    };
    $('input').on('focus', function() {
        $('input').not(this).removeClass('is-valid is-invalid');
    });

    $nombre.on('input', function () {
        validateInput($(this), regex.nombre);
        checkFormValidity();
    });

    $apellido.on('input', function () {
        validateInput($(this), regex.nombre);
        checkFormValidity();
    });

    $correo.on('input', function () {
        validateInput($(this), regex.correo);
        checkFormValidity();
    });

    $password.on('input', function () {
        validateInput($(this), regex.contrasena);
        checkFormValidity();
        updatePasswordStrength(this.value);
    });

    $confirmPassword.on('input', function () {
        validatePasswordMatch();
        checkFormValidity();
    });

    $terms.on('change', function() {
        checkFormValidity();
    });

    // Función para medir la fortaleza de la contraseña
    const updatePasswordStrength = (password) => {
        const strengthBar = document.getElementById('passwordStrengthBar');
        let strength = 0;

        if (password.length > 0) strength += 20;
        if (password.length >= 8) strength += 30;
        if (/[A-Z]/.test(password)) strength += 20;
        if (/[0-9]/.test(password)) strength += 20;
        if (/[^A-Za-z0-9]/.test(password)) strength += 10;

        strengthBar.style.width = Math.min(strength, 100) + '%';

        if (strength < 40) {
            strengthBar.style.backgroundColor = '#dc3545';
        } else if (strength < 70) {
            strengthBar.style.backgroundColor = '#fd7e14';
        } else {
            strengthBar.style.backgroundColor = '#28a745';
        }
    };

    $registroBtn.on("click", function() {
        if (!$registroBtn.prop('disabled')) {
            let datos = valores();
            registrarUsuario(datos);
            
        }
    });
});