
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

// Título: Alternar condiciones
// Esta función muestra u oculta una tabla de condiciones 
// basada en el estado de un checkbox.

function toggleConditions() {
    const checkbox = document.getElementById('toggle-conditions'); // Obtener el checkbox
    const table = document.getElementById('conditions-table'); // Obtener la tabla de condiciones

    // Muestra u oculta la tabla según el estado del checkbox
    table.style.display = checkbox.checked ? 'table' : 'none'; // Cambiar la visibilidad de la tabla
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