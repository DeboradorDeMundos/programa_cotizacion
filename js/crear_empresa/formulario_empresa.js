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
    -------------------------------------- Inicio ITred Spa Formulario Empresa .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

    // Se ejecuta cuando el contenido del DOM ha sido completamente cargado
    document.addEventListener('DOMContentLoaded', () => {
        // Establece el valor del campo 'fecha_creacion' a la fecha actual en formato ISO (YYYY-MM-DD)
        document.getElementById('fecha_creacion').value = new Date().toISOString().split('T')[0];
    });

    // Evento para validar el nombre de la empresa al introducir texto
    document.getElementById('empresa_nombre').addEventListener('input', function () {
        const input = this;
        // Elimina caracteres no válidos (solo permite letras, números y algunos caracteres especiales)
        input.value = input.value.replace(/[^A-Za-zÀ-ÿ0-9\s&.-]/g, '');
    });

    // Evento para validar el área de la empresa al introducir texto
    document.getElementById('empresa_area').addEventListener('input', function () {
        const input = this;
        // Elimina caracteres no válidos (solo permite letras y algunos caracteres especiales)
        input.value = input.value.replace(/[^A-Za-zÀ-ÿ\s&.-]/g, '');
    });

    // Evento para validar la dirección de la empresa al introducir texto
    document.getElementById('empresa_direccion').addEventListener('input', function () {
        const input = this;
        // Elimina caracteres no válidos (solo permite letras, números y algunos caracteres especiales)
        input.value = input.value.replace(/[^A-Za-z0-9À-ÿ\s#,-.]/g, '');
    });

    // Función para formatear el número de teléfono al introducirlo
    function FormatearNumeroTelefono(input) {
        // Eliminar todo lo que no sea número
        let value = input.value.replace(/[^\d]/g, '');
        
        // Verificar la longitud del número de caracteres
        if (value.length > 10) {
            // Formato para números de teléfono con más de 10 dígitos
            value = value.replace(/^(\d{2})(\d)(\d{4})(\d{4})$/, '+$1 $2 $3 $4');
        } else if (value.length > 7) {
            // Formato para números con más de 7 dígitos
            value = value.replace(/^(\d{2})(\d)(\d{4})$/, '+$1 $2 $3');
        } else if (value.length > 2) {
            // Formato para números con más de 2 dígitos
            value = value.replace(/^(\d{2})(\d)$/, '+$1 $2');
        } else if (value.length > 1) {
            // Formato para números con 2 dígitos
            value = value.replace(/^(\d{2})$/, '+$1');
        }

        // Actualiza el valor del campo de entrada
        input.value = value;
    }

    // Función para completar el correo electrónico automáticamente
    function CompletarEmail(input) {
        // Eliminar comillas simples y dobles de la entrada
        input.value = input.value.replace(/['"]/g, '');

        // Patrón de expresión regular para validar el correo electrónico
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; 
        
        // Verifica si el correo electrónico tiene un formato válido
        if (!emailPattern.test(input.value)) {
            // Comprueba si el valor no contiene '@'
            if (!input.value.includes('@')) {
                // Añadir '@gmail.com' si no se ingresó un dominio
                input.value += '@gmail.com'; 
            } else {
                alert("Por favor, ingresa un correo electrónico válido."); // Mensaje de error si no es válido
            }
        }
    }

    // Función para quitar caracteres inválidos de la entrada
    function QuitarCaracteresInvalidos(input) {
        // Eliminar comillas simples, dobles y cualquier otro carácter no deseado
        input.value = input.value.replace(/['"]/g, '');
    }

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Formulario Empresa .JS ---------------------------------------
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