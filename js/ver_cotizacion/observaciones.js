
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
    -------------------------------------- INICIO ITred Spa observaciones .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

// TÍTULO: VALIDAR ENTRADA DE OBSERVACIONES
    // Esta función se activa al introducir texto en el campo de observaciones, 
    // eliminando caracteres peligrosos para evitar problemas de seguridad.

    document.getElementById('observacion').addEventListener('input', function() {
        // Expresión regular para detectar caracteres no permitidos (ajusta según tus necesidades)
        const pattern = /['"<>;\\]/g;
        
        // Si el texto contiene caracteres no permitidos, los elimina
        if (pattern.test(this.value)) {
            this.value = this.value.replace(pattern, ''); // Reemplaza los caracteres no permitidos con una cadena vacía
            alert('Se han eliminado caracteres no permitidos se borraran.'); // Alerta al usuario sobre la eliminación
        }
    });


/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa observaciones .JS ---------------------------------------
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