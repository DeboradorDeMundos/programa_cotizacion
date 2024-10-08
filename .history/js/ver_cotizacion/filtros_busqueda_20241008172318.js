
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

    document.getElementById('filtro-form').addEventListener('submit', function(e) {
        e.preventDefault();
        
        // Serializa los datos del formulario
        var formData = new FormData(this);
        var queryString = new URLSearchParams(formData).toString();
        
        // Redirige a la misma página con los filtros aplicados
        window.location.href = window.location.pathname + '?' + queryString;
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