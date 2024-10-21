
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
    
// TÍTULO: FUNCIÓN PARA CALCULAR LA FECHA DE VALIDEZ BASADA EN LOS DÍAS INGRESADOS
    //  Calcula y asigna la fecha de validez a partir de los días ingresados por el usuario en el formulario.
    function calcularFechaValidez() {
        //  Accede al campo donde el usuario ingresa el número de días de validez.
        let diasValidezInput = document.getElementById('dias_validez').value;

        //  Asegura que el valor introducido sea un número y no esté vacío.
        if (diasValidezInput && !isNaN(diasValidezInput)) {
            let diasValidez = parseInt(diasValidezInput); // Convertir el valor a un número entero

            //  Crea un objeto de fecha que representa la fecha y hora actuales.
            let fechaEmision = new Date(); // Crear un objeto de fecha para la fecha actual

            //  Sumar los días de validez ingresados a la fecha de emisión.
            fechaEmision.setDate(fechaEmision.getDate() + diasValidez); // Actualizar la fecha

            //  Formatea la nueva fecha en el formato yyyy-mm-dd.
            let anio = fechaEmision.getFullYear(); // Obtener el año
            let mes = ('0' + (fechaEmision.getMonth() + 1)).slice(-2); // Obtener el mes con formato de dos dígitos
            let dia = ('0' + fechaEmision.getDate()).slice(-2); // Obtener el día con formato de dos dígitos

            //  Combina el año, mes y día en una cadena de texto.
            let fechaValidez = `${anio}-${mes}-${dia}`;

            //  Establece el valor calculado en el campo correspondiente del formulario.
            document.getElementById('fecha_validez').value = fechaValidez;

            //  Muestra la fecha de validez calculada en la consola para verificar su correcto cálculo.
            console.log("Fecha de validez calculada: ", fechaValidez);
        } else {
            //  Si no se ingresó un valor válido, limpia el campo de fecha de validez.
            document.getElementById('fecha_validez').value = '';
        }
    }

// TÍTULO: CARGAR LA FUNCIÓN AL INICIO
    //  Ejecuta la función calcularFechaValidez cuando la página se carga, para establecer la fecha si hay un valor predefinido.
    window.onload = function() {
        calcularFechaValidez(); // Ejecutar la función al cargar la página
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