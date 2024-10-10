
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
    -------------------------------------- INICIO ITred Spa Detalle total.JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

    // Función para actualizar el total de una fila cuando cambia algún valor

    // Función para calcular los totales globales después de actualizar los valores de las filas
    function CalcularTotales() {
        const rows = document.querySelectorAll('.seccion-detalle .detalle-table tbody tr'); // Selecciona todas las filas de detalle

        let subTotal = 0; // Inicializa el subtotal
        let descuentoGlobalPorcentaje = parseFloat(document.getElementById('descuento_global_porcentaje').value) || 0; // Obtiene el porcentaje de descuento global
        let descuentoGlobalMonto = 0; // Inicializa el monto de descuento global
        let ivaValor = 0; // Inicializa el valor del IVA
        let totalFinal = 0; // Inicializa el total final

        // Recorre cada fila para calcular el subtotal
        rows.forEach(row => {
            const totalInput = row.querySelector('input[name^="detalle_total"]'); // Busca el input que contiene el total de cada fila

            if (totalInput) {
                const totalItem = parseFloat(totalInput.value) || 0; // Obtiene el valor del total de la fila
                subTotal += totalItem; // Suma el total al subtotal
            }
        });

        // Calcula el monto del descuento global
        descuentoGlobalMonto = Math.round(subTotal * (descuentoGlobalPorcentaje / 100));
        // Calcula el IVA sobre el subtotal menos el descuento
        ivaValor = ((subTotal - descuentoGlobalMonto) * 0.19).toFixed(2); // 19% IVA
        // Calcula el total final sumando el subtotal y el IVA, menos el descuento
        totalFinal = Math.round(subTotal - descuentoGlobalMonto + parseFloat(ivaValor));

        // Asigna los valores calculados a los inputs correspondientes en el formulario
        document.getElementById('sub_total').value = Math.round(subTotal);
        document.getElementById('descuento_global_monto').value = descuentoGlobalMonto;
        document.getElementById('monto_neto').value = Math.round(subTotal - descuentoGlobalMonto);
        document.getElementById('total_iva').value = ivaValor;
        document.getElementById('total_final').value = totalFinal;

        // Llama a la función para calcular el pago total
        calcularPago();
    }

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Detalle total.JS ---------------------------------------
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