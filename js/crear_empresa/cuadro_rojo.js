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
    -------------------------------------- Inicio ITred Spa Cuadro Rojo .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

    document.getElementById('empresa_nombre').addEventListener('input', function () {
        const input = this;
        // Elimina caracteres no válidos
        input.value = input.value.replace(/[^A-Za-zÀ-ÿ0-9\s&.-]/g, '');
    });
    
/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Cuadro Rojo .JS ---------------------------------------
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