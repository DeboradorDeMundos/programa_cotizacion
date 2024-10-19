
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
    
// Título: Función para calcular la fecha de validez basada en los días ingresados
//  Calcula y asigna la fecha de validez a partir de los días ingresados por el usuario en el formulario.
function calcularFechaValidez() {
    // Título: Obtener el valor de los días de validez
    //  Accede al campo donde el usuario ingresa el número de días de validez.
    let diasValidezInput = document.getElementById('dias_validez').value;

    // Título: Validar el número de días ingresado
    //  Asegura que el valor introducido sea un número y no esté vacío.
    if (diasValidezInput && !isNaN(diasValidezInput)) {
        let diasValidez = parseInt(diasValidezInput); // Convertir el valor a un número entero

        // Título: Obtener la fecha actual (fecha de emisión)
        //  Crea un objeto de fecha que representa la fecha y hora actuales.
        let fechaEmision = new Date(); // Crear un objeto de fecha para la fecha actual

        // Título: Calcular la nueva fecha de validez
        //  Sumar los días de validez ingresados a la fecha de emisión.
        fechaEmision.setDate(fechaEmision.getDate() + diasValidez); // Actualizar la fecha

        // Título: Formatear la fecha de validez
        //  Formatea la nueva fecha en el formato yyyy-mm-dd.
        let anio = fechaEmision.getFullYear(); // Obtener el año
        let mes = ('0' + (fechaEmision.getMonth() + 1)).slice(-2); // Obtener el mes con formato de dos dígitos
        let dia = ('0' + fechaEmision.getDate()).slice(-2); // Obtener el día con formato de dos dígitos

        // Título: Crear la cadena de fecha en formato yyyy-mm-dd
        //  Combina el año, mes y día en una cadena de texto.
        let fechaValidez = `${anio}-${mes}-${dia}`;

        // Título: Asignar la fecha calculada al campo de fecha de validez en el formulario
        //  Establece el valor calculado en el campo correspondiente del formulario.
        document.getElementById('fecha_validez').value = fechaValidez;

        // Título: Mensaje de depuración en la consola
        //  Muestra la fecha de validez calculada en la consola para verificar su correcto cálculo.
        console.log("Fecha de validez calculada: ", fechaValidez);
    } else {
        // Título: Manejo de entrada no válida
        //  Si no se ingresó un valor válido, limpia el campo de fecha de validez.
        document.getElementById('fecha_validez').value = '';
    }
}

// Título: Cargar la función al inicio
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