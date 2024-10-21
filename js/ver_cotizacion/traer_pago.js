
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
    -------------------------------------- INICIO ITred Spa Traer pago.JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

// Título: Función para agregar un nuevo pago
// Detalle: Crea una nueva fila en la tabla de pagos y verifica que el total de porcentajes no exceda el 100%.
function AgregarPago() {
    const contenedor = document.getElementById('payments-contenedor'); // Obtener el contenedor de pagos
    const porcentajeInputs = contenedor.querySelectorAll('input[name="porcentaje_pago[]"]'); // Seleccionar inputs de porcentaje
    let totalPorcentaje = 0;

    // Sumar todos los porcentajes existentes
    porcentajeInputs.forEach(input => {
        totalPorcentaje += parseFloat(input.value) || 0; // Sumar los porcentajes, considerando valor por defecto 0
    });

    // Verificar si el total ya alcanza o supera el 100%
    if (totalPorcentaje >= 100) {
        alert("Ya se ha alcanzado el 100% de los pagos. No se pueden agregar más pagos.");
        return; // Salir de la función si se ha alcanzado el límite
    }

    // Mostrar la tabla si está oculta
    const table = document.getElementById('payment-table');
    if (table.style.display === 'none') {
        table.style.display = 'table'; // Cambiar a modo de visualización de tabla
    }

    // Crear un nuevo bloque de pago
    const LineaPago = document.createElement('tr');

    // Generar el HTML para un nuevo pago dentro de la tabla
    LineaPago.innerHTML = `
        <td><input type="number" name="numero_pago[]" required oninput="QuitarCaracteresInvalidos(this)"></td>
        <td><textarea name="descripcion_pago[]" placeholder="Descripción del pago" oninput="QuitarCaracteresInvalidos(this)"></textarea></td>
        <td><input type="number" id="porcentaje-pago" name="porcentaje_pago[]" min="0" max="${100 - totalPorcentaje}" required oninput="calcularPago(this)" oninput="QuitarCaracteresInvalidos(this)"></td>
        <td><input type="number" id="monto-pago" name="monto_pago[]" min="0" required readonly oninput="QuitarCaracteresInvalidos(this)"></td>
        <td><input type="date" name="fecha_pago[]" required oninput="QuitarCaracteresInvalidos(this)"></td>
        <td><button type="button" onclick="EliminarPago(this)">Eliminar</button></td>
    `;

    // Agregar la nueva fila de pago al cuerpo de la tabla
    contenedor.appendChild(LineaPago);
}

// Título: Función para eliminar un pago
// Detalle: Elimina la fila correspondiente al pago y oculta la tabla si no quedan filas.
function EliminarPago(button) {
    const row = button.closest('tr'); // Eliminar la fila correspondiente
    row.remove();

    // Ocultar la tabla si no quedan filas
    const contenedor = document.getElementById('payments-contenedor');
    if (contenedor.children.length === 0) {
        document.getElementById('payment-table').style.display = 'none'; // Ocultar tabla si no hay filas
    }
}

// Título: Función para calcular el monto del pago
// Detalle: Calcula el monto a partir del porcentaje ingresado y el total final.
function calcularPago(input) {
    const row = input.closest('tr'); // Obtener la fila actual
    const montoPagoInput = row.querySelector('#monto-pago'); // Obtener el input de monto
    const totalFinalInput = document.getElementById('total_final'); // Obtener el total final

    const porcentajeAdelanto = parseFloat(input.value) || 0; // Obtener porcentaje del input
    const totalFinal = parseFloat(totalFinalInput.value) || 0; // Obtener el total final

    const montoAdelanto = (totalFinal * (porcentajeAdelanto / 100)).toFixed(2); // Calcular monto del pago
    montoPagoInput.value = montoAdelanto; // Asignar monto al input correspondiente

    // Verificar si la suma de todos los porcentajes excede el 100%
    verificarTotalPorcentajes(input);
}

// Título: Función para verificar el total de porcentajes
// Detalle: Asegura que la suma de los porcentajes no exceda el 100%, ajustando si es necesario.
function verificarTotalPorcentajes(input) {
    const contenedor = document.getElementById('payments-contenedor');
    const porcentajeInputs = contenedor.querySelectorAll('input[name="porcentaje_pago[]"]'); // Seleccionar inputs de porcentaje
    let totalPorcentaje = 0;

    // Sumar todos los porcentajes existentes
    porcentajeInputs.forEach(porcentajeInput => {
        totalPorcentaje += parseFloat(porcentajeInput.value) || 0; // Sumar porcentajes
    });

    // Si el total supera el 100%, restablecer el último valor y mostrar alerta
    if (totalPorcentaje > 100) {
        // Restablecer el valor del campo actual para no exceder el 100%
        const porcentajeActual = parseFloat(input.value);
        const maxValorPermitido = 100 - (totalPorcentaje - porcentajeActual); // Calcular el máximo permitido
        input.value = Math.max(0, maxValorPermitido); // Limitar el valor al máximo permitido

        alert("La suma de los porcentajes no puede exceder el 100%. Por favor, ajusta los pagos existentes.");
    }
}

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Traer pago.JS ---------------------------------------
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