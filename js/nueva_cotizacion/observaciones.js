
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

// Título: Validación de entrada de observaciones
// Evento para validar la entrada de texto en el campo 'observacion'
// Elimina caracteres peligrosos como comillas, menor que, mayor que, punto y coma y barra invertida
document.getElementById('observacion').addEventListener('input', function() {
    const pattern = /['"<>;\\]/g; // Expresión regular para detectar caracteres peligrosos
    
    // Si el texto contiene caracteres no permitidos, los elimina
    if (pattern.test(this.value)) {
        this.value = this.value.replace(pattern, ''); // Reemplaza caracteres peligrosos por una cadena vacía
        alert('Se han eliminado caracteres no permitidos y se borrarán.'); // Alerta al usuario
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