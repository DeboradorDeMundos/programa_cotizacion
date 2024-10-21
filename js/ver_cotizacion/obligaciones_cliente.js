
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

// TÍTULO: ALTERNAR OBLIGACIONES
    //  Esta función muestra u oculta una tabla de obligaciones en función del estado de un checkbox.
    function toggleObligaciones() {
        const checkbox = document.getElementById('toggle-obligaciones'); // Obtener el checkbox que controla la visibilidad
        const table = document.getElementById('obligaciones-table'); // Obtener la tabla de obligaciones
        
        // Muestra u oculta la tabla según el estado del checkbox
        table.style.display = checkbox.checked ? 'table' : 'none'; // Si el checkbox está marcado, muestra la tabla; de lo contrario, ocúltala.
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