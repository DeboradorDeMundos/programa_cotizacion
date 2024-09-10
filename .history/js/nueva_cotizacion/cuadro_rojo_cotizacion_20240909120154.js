
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
    -------------------------------------- INICIO ITred Spa cuadro rojo cotizacion.JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */


    function calcularFechaValidez() {
        // Supongamos que la fecha de emisión es la fecha actual
        let fechaEmision = new Date();
        
        // Obtenemos el valor del campo de días de validez
        let diasValidezInput = document.getElementById('dias_validez').value;
        let diasValidez = parseInt(diasValidezInput);
        
        // Calculamos la fecha de validez sumando los días de validez a la fecha de emisión
        fechaEmision.setDate(fechaEmision.getDate() + diasValidez);
        
        // Formateamos la fecha de validez al formato yyyy-mm-dd para que coincida con el campo de tipo "date"
        let anio = fechaEmision.getFullYear();
        let mes = ('0' + (fechaEmision.getMonth() + 1)).slice(-2); // Añadimos 1 porque los meses en JS van de 0 a 11
        let dia = ('0' + fechaEmision.getDate()).slice(-2);
        let fechaValidez = `${anio}-${mes}-${dia}`;
        
        // Asignamos la fecha calculada al campo de fecha de validez
        document.getElementById('fecha_validez').value = fechaValidez;
    }
    


/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa cuadro rojo cotizacion.JS ---------------------------------------
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