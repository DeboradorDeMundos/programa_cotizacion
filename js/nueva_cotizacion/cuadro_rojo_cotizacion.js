
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
    
    // Función para calcular la fecha de validez basada en los días ingresados
    function calcularFechaValidez() {
        // Obtener el valor de los días de validez ingresado por el usuario
        let diasValidezInput = document.getElementById('dias_validez').value;

        // Asegurarse de que se introduzca un número válido de días de validez
        if (diasValidezInput && !isNaN(diasValidezInput)) {
            let diasValidez = parseInt(diasValidezInput); // Convertir el valor a un número entero

            // Obtener la fecha actual (fecha de emisión)
            let fechaEmision = new Date(); // Crear un objeto de fecha para la fecha actual

            // Sumar los días de validez a la fecha actual
            fechaEmision.setDate(fechaEmision.getDate() + diasValidez); // Actualizar la fecha

            // Formatear la fecha de validez en formato yyyy-mm-dd
            let anio = fechaEmision.getFullYear(); // Obtener el año
            let mes = ('0' + (fechaEmision.getMonth() + 1)).slice(-2); // Obtener el mes y asegurarse de que tenga dos dígitos
            let dia = ('0' + fechaEmision.getDate()).slice(-2); // Obtener el día y asegurarse de que tenga dos dígitos

            // Crear la cadena de fecha en formato yyyy-mm-dd
            let fechaValidez = `${anio}-${mes}-${dia}`;

            // Asignar la fecha calculada al campo de fecha de validez en el formulario
            document.getElementById('fecha_validez').value = fechaValidez;

            // Mensaje de depuración en la consola
            console.log("Fecha de validez calculada: ", fechaValidez);
        } else {
            // Si no hay un valor válido para los días de validez, limpiar el campo de fecha de validez
            document.getElementById('fecha_validez').value = '';
        }
    }

    // Llama a la función cuando se cargue la página, solo si hay un valor predefinido en el campo de días de validez
    window.onload = function() {
        calcularFechaValidez(); // Ejecutar la función al cargar la página
    };

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