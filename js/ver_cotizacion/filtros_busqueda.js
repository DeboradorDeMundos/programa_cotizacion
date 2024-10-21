
/* 
Sitio Web Creado por ITred Spa.
Direccion: Guido Reni #4190
Pedro Aguire Cerda - Santiago - Chile
contacto@itred.cl o itred.spa@gmail.com
https://www.itred.cl
Creado, Programado y Diseñado por ITred Spa.
BPPJ 
*/


/* --------------------------------------------------------------------------------------------------------------
    -------------------------------------- INICIO ITred Spa Filtro Busqueda.JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

// TÍTULO: EVENTO PARA MANEJAR EL ENVÍO DEL FORMULARIO DE FILTRO
    //  Este bloque de código captura el evento de envío del formulario, evita el comportamiento por defecto, 
    // serializa los datos del formulario y redirige a la misma página con los filtros aplicados.

    document.getElementById('filtro-form').addEventListener('submit', function(e) {
        e.preventDefault(); // Evita el comportamiento por defecto del envío del formulario

        //  Crea un objeto FormData para capturar los datos ingresados en el formulario y luego convierte esos datos en una cadena de consulta.
        var formData = new FormData(this); // Captura los datos del formulario
        var queryString = new URLSearchParams(formData).toString(); // Convierte los datos en una cadena de consulta

        //  Cambia la ubicación actual a la misma página, añadiendo los filtros como parámetros en la URL.
        window.location.href = window.location.pathname + '?' + queryString; // Redirige a la URL con los parámetros de filtro
    });

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Filtro Busqueda .JS ---------------------------------------
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