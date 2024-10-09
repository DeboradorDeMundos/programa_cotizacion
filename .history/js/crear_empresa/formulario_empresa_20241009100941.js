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
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('fecha_creacion').value = new Date().toISOString().split('T')[0];
    });
    


    document.getElementById('empresa_nombre').addEventListener('input', function () {
        const input = this;
        // Elimina caracteres no válidos
        input.value = input.value.replace(/[^A-Za-zÀ-ÿ0-9\s&.-]/g, '');
    });

    document.getElementById('empresa_area').addEventListener('input', function () {
        const input = this;
        // Elimina caracteres no válidos
        input.value = input.value.replace(/[^A-Za-zÀ-ÿ\s&.-]/g, '');
    });
    
    document.getElementById('empresa_direccion').addEventListener('input', function () {
        const input = this;
        // Elimina caracteres no válidos
        input.value = input.value.replace(/[^A-Za-z0-9À-ÿ\s#,-.]/g, '');
    });

    function FormatearNumeroTelefono(input) {
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

    function CompletarEmail(input) {
        // Eliminar comillas simples y dobles de la entrada
        input.value = input.value.replace(/['"]/g, '');
    
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