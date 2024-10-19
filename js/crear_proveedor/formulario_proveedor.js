/* 
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Aguirre Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ 
*/


/* --------------------------------------------------------------------------------------------------------------
    -------------------------------------- INICIO ITred Spa Crear Proveedor .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

// Título para la validación del nombre
// Validación del campo de nombre del proveedor
document.getElementById('nombre_proveedor').addEventListener('input', function() {
    var nombreField = document.getElementById('nombre_proveedor');
    var nombreError = document.getElementById('nombre_error');
    
    // Expresión regular para validar el nombre
    var pattern = /^[A-Z][a-zA-Z\s]*$/;

    // Verificar si el nombre coincide con el patrón
    if (pattern.test(nombreField.value)) {
        nombreError.style.display = 'none'; // Ocultar mensaje de error si es válido
    } else {
        nombreError.style.display = 'block'; // Mostrar mensaje de error si es inválido
    }
});

// Título para la validación del teléfono
// Validación del campo de teléfono del proveedor
document.getElementById('telefono_proveedor').addEventListener('input', function() {
    var telefonoField = document.getElementById('telefono_proveedor');
    var telefonoError = document.getElementById('telefono_error');

    // Expresión regular para validar el número de teléfono
    var pattern = /^\d{1,9}$/;

    // Verificar si el teléfono coincide con el patrón
    if (pattern.test(telefonoField.value)) {
        telefonoError.style.display = 'none'; // Ocultar mensaje de error si es válido
    } else {
        telefonoError.style.display = 'block'; // Mostrar mensaje de error si es inválido
    }
});

// Título para la validación del RUT
// Validación del campo de RUT del proveedor
document.getElementById('rut_proveedor').addEventListener('input', function() {
    var rutField = document.getElementById('rut_proveedor');
    var rutError = document.getElementById('rut_error');

    // Expresión regular para validar el RUT
    var pattern = /^\d{8}-[0-9K]$/;

    // Verificar si el RUT coincide con el patrón
    if (pattern.test(rutField.value)) {
        rutError.style.display = 'none'; // Ocultar mensaje de error si es válido
    } else {
        rutError.style.display = 'block'; // Mostrar mensaje de error si es inválido
    }
});

// Título para la validación del correo electrónico
// Validación del campo de correo electrónico del proveedor
document.getElementById('email_proveedor').addEventListener('input', function() {
    var emailField = document.getElementById('email_proveedor');
    var emailError = document.getElementById('email_error');
    
    // Expresión regular para validar el formato del correo
    var pattern = /^[a-zA-Z0-9._]+@[a-zA-Z0-9.-]+\.(cl|com|[a-zA-Z]{2,})$/;

    // Verificar si el correo coincide con el patrón
    if (pattern.test(emailField.value)) {
        emailError.style.display = 'none'; // Ocultar mensaje de error si es válido
    } else {
        emailError.style.display = 'block'; // Mostrar mensaje de error si es inválido
    }
});

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Crear Proveedor .JS ---------------------------------------
    ------------------------------------------------------------------------------------------------------------- */


/*
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Aguirre Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
*/