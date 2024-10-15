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
    -------------------------------------- Inicio ITred Spa formulario Clientes .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */


// Función para validar el nombre del cliente
function validarNombre(input) {
    // Expresión regular para permitir solo letras (mayúsculas y minúsculas) y espacios
    const regex = /^[A-Za-záéíóúñÁÉÍÓÚÑ ]*$/;
    const errorMensaje = document.getElementById("error_nombre");

    // Obtener el valor actual
    const valorActual = input.value;

    // Verificar si el valor es válido
    if (!regex.test(valorActual)) {
        // Reemplazar el valor con el que sea válido (eliminando el carácter no válido)
        input.value = valorActual.replace(/[^A-Za-záéíóúñÁÉÍÓÚÑ ]/g, "");
        errorMensaje.style.display = "block"; // Mostrar mensaje de error
    } else {
        errorMensaje.style.display = "none"; // Ocultar mensaje de error
    }
}
 


// Funcion para validar el nombre de la Empresa del cliente
    function validarEmpresa(input) {
        const empresaInput = document.getElementById("empresa_cliente");
        const errorMensaje = document.getElementById("error_empresa");

        // Expresión regular para permitir letras, espacios, puntos, comas y guiones
        const regex = /^[A-Za-záéíóúñÁÉÍÓÚÑ ., -]*$/;

        // Obtener el valor actual
        const valorActual = empresaInput.value;

        // Verificar si el último carácter es válido
        if (!regex.test(valorActual)) {
            // Reemplazar el valor con el que sea válido (eliminando el carácter no válido)
            empresaInput.value = valorActual.replace(/[^A-Za-záéíóúñÁÉÍÓÚÑ ., -]/g, "");
            errorMensaje.style.display = "block"; // Mostrar mensaje de error
        } else {
            errorMensaje.style.display = "none"; // Ocultar mensaje de error
        }
    }

// Función para formatear un RUT (número de identificación chileno) en el campo de entrada
function formatoRut(input) {
    // Obtiene el valor del campo y elimina cualquier carácter que no sea numérico
    let rut = input.value.replace(/\D/g, '');

    // Si el RUT tiene más de 9 caracteres, se limita a los primeros 9 (incluyendo el dígito verificador)
    if (rut.length > 9) {
        rut = rut.slice(0, 9);
    }

    // Aplica el formato al RUT. Si tiene más de 1 dígito, coloca un punto cada 3 dígitos y un guion antes del último
    if (rut.length > 1) {
        rut = rut.slice(0, -1).replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '-' + rut.slice(-1);
    }

    // Establece el valor del input formateado
    input.value = rut;

    // Limita la longitud total del input, asegurándose de que no exceda el formato esperado (12 caracteres)
    if (input.value.length > 12) {
        input.value = input.value.slice(0, 12);
    }
}

      // Función para formatear la dirección del cliente
      function formatoDireccion(input) {
        // Obtiene el valor del campo y elimina cualquier carácter que no sea alfanumérico o espacio
        let direccion = input.value.replace(/[^A-Za-z0-9\s]/g, '');

        // Limita la longitud total del input a 100 caracteres (ajusta según lo que necesites)
        if (direccion.length > 100) {
            direccion = direccion.slice(0, 100);
        }

        // Establece el valor del input formateado
        input.value = direccion;

        // Muestra u oculta el mensaje de error
        const errorSpan = document.getElementById('error_direccion');
        if (input.value.length < input.value.replace(/[^A-Za-z0-9\s]/g, '').length) {
            errorSpan.style.display = 'inline'; // Mostrar el mensaje de error
        } else {
            errorSpan.style.display = 'none'; // Ocultar el mensaje de error
        }
    }
/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa formulario Clientes .JS ---------------------------------------
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