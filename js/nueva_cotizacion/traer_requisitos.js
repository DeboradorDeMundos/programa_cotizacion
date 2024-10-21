
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
    -------------------------------------- INICIO ITred Spa Traer requisitos.JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

// Título: Alternar requisitos
// Función para mostrar u ocultar una tabla de requisitos basada en el estado de un checkbox
function toggleRequisitos() {
    const checkbox = document.getElementById('toggle-requisitos'); // Obtener el checkbox
    const table = document.getElementById('requisitos-table'); // Obtener la tabla de requisitos
    // Muestra u oculta la tabla según el estado del checkbox
    table.style.display = checkbox.checked ? 'table' : 'none';
}



/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Traer requisitos.JS ---------------------------------------
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