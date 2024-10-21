
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
    -------------------------------------- INICIO ITred Spa Obligaciones cliente .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

// TÍTULO: ALTERNAR VISIBILIDAD DE OBLIGACIONES
    // Función para mostrar u ocultar la tabla de obligaciones según el estado de un checkbox
    function toggleObligaciones() {
        const checkbox = document.getElementById('toggle-obligaciones'); // Obtiene el checkbox de las obligaciones
        const table = document.getElementById('obligaciones-table'); // Obtiene la tabla de obligaciones
        // Establece la visibilidad de la tabla según si el checkbox está marcado
        table.style.display = checkbox.checked ? 'table' : 'none'; 
    }

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Obligaciones cliente .JS ---------------------------------------
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