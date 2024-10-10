
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


    document.getElementById('observacion').addEventListener('input', function() {
        // Expresión regular para evitar caracteres peligrosos (puedes ajustar según tus necesidades)
        const pattern = /['"<>;\\]/g;
        
        // Si el texto contiene caracteres no permitidos, los elimina
        if (pattern.test(this.value)) {
            this.value = this.value.replace(pattern, '');
            alert('Se han eliminado caracteres no permitidos se borraran.');
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