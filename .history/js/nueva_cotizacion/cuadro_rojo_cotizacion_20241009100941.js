
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
    -------------------------------------- INICIO ITred Spa cuadro rojo cotizacion.JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */
    function calcularFechaValidez() {
        // Obtener el valor de los días de validez
        let diasValidezInput = document.getElementById('dias_validez').value;
    
        // Asegurarnos de que se introduzca un número válido de días de validez
        if (diasValidezInput && !isNaN(diasValidezInput)) {
            let diasValidez = parseInt(diasValidezInput);
    
            // Obtener la fecha actual (fecha de emisión)
            let fechaEmision = new Date();
    
            // Sumar los días de validez a la fecha actual
            fechaEmision.setDate(fechaEmision.getDate() + diasValidez);
    
            // Formatear la fecha de validez en formato yyyy-mm-dd
            let anio = fechaEmision.getFullYear();
            let mes = ('0' + (fechaEmision.getMonth() + 1)).slice(-2);
            let dia = ('0' + fechaEmision.getDate()).slice(-2);
    
            let fechaValidez = `${anio}-${mes}-${dia}`;
    
            // Asignar la fecha calculada al campo de fecha de validez
            document.getElementById('fecha_validez').value = fechaValidez;
    
            // Depuración
            console.log("Fecha de validez calculada: ", fechaValidez);
        } else {
            // Si no hay un valor válido para los días de validez, limpiar la fecha de validez
            document.getElementById('fecha_validez').value = '';
        }
    }
    
    // Llama a la función cuando se cargue la página, solo si hay un valor predefinido en el campo de días de validez
    window.onload = function() {
        calcularFechaValidez();
    };
    
    


/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa cuadro rojo cotizacion.JS ---------------------------------------
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