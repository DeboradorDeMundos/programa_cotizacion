
/* 
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Agui Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ 
*/


/* --------------------------------------------------------------------------------------------------------------
    -------------------------------------- INICIO ITred Spa Detalle cliente.JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

    function formatPhoneNumber(input) {
        // Eliminar todo lo que no sea número o espacio
        let value = input.value.replace(/[^\d]/g, '');
        
        // Verificar que el número de caracteres sea mayor que 10 (código de país + número)
        if (value.length > 10) {
            // Formatear el número
            value = value.replace(/^(\d{2})(\d)(\d{4})(\d{4})$/, '+$1 $2 $3 $4');
        } else if (value.length > 7) {
            value = value.replace(/^(\d{2})(\d)(\d{4})$/, '+$1 $2 $3');
        } else if (value.length > 2) {
            value = value.replace(/^(\d{2})(\d)$/, '+$1 $2');
        } else if (value.length > 1) {
            value = value.replace(/^(\d{2})$/, '+$1');
        }
    
        input.value = value; // Actualizar el valor del campo de entrada
    }

    function completeEmail(input) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Expresión regular para validar el correo electrónico
        
        // Verificar si el correo tiene un formato válido
        if (!emailPattern.test(input.value)) {
            // Comprobar si el valor no contiene '@'
            if (!input.value.includes('@')) {
                input.value += '@gmail.com'; // Añadir '@gmail.com' si no se ingresó
            } else {
                alert("Por favor, ingresa un correo electrónico válido."); // Mensaje de error si no es válido
            }
        }
    }



/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Detalle cliente.JS ---------------------------------------
    ------------------------------------------------------------------------------------------------------------- */


/*
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Agui Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ
*/