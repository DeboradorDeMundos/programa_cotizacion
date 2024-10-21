
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
    -------------------------------------- INICIO ITred Spa Traer condiciones.JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

// TÍTULO: ALTERNAR VISIBILIDAD DE CONDICIONES
    // Función para mostrar u ocultar la tabla de condiciones basada en el estado de un checkbox
    function toggleConditions() {
        const checkbox = document.getElementById('toggle-conditions'); // Obtener el checkbox
        const table = document.getElementById('conditions-table'); // Obtener la tabla de condiciones
        table.style.display = checkbox.checked ? 'table' : 'none'; // Alternar la visibilidad de la tabla
    }

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Traer condiciones.JS ---------------------------------------
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