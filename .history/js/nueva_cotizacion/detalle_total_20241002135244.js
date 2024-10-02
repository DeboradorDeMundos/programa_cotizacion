
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
    -------------------------------------- INICIO ITred Spa Detalle total.JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

// calculations.js
function updateTotal(input) {
    const row = input.closest('tr');
    const section = row.closest('.detalle-section');
    const tituloIndex = section.dataset.tituloIndex; // Obtiene el índice del título
    const subtituloIndex = row.closest('.subtitulo-section').dataset.subtituloIndex; // Obtiene el índice del subtítulo

    const cantidad = parseFloat(row.querySelector(`input[name="detalle_cantidad[${tituloIndex}][${subtituloIndex}]"]`).value) || 0;
    const precioUnitario = parseFloat(row.querySelector(`input[name="detalle_precio_unitario[${tituloIndex}][${subtituloIndex}]"]`).value) || 0;
    const descuento = parseFloat(row.querySelector(`input[name="detalle_descuento[${tituloIndex}][${subtituloIndex}]"]`).value) || 0;
    const totalInput = row.querySelector(`input[name="detalle_total[${tituloIndex}][${subtituloIndex}]"]`);

    const desc = (precioUnitario * (descuento / 100));
    const total = (cantidad * (precioUnitario - desc)).toFixed(2);
    totalInput.value = total;

    calculateTotals();
}


function calculateTotals() {
    const rows = document.querySelectorAll('.detalle-section .detalle-table tbody tr');

    let subTotal = 0;
    let descuentoGlobalPorcentaje = parseFloat(document.getElementById('descuento_global_porcentaje').value) || 0;
    let descuentoGlobalMonto = 0;
    let ivaValor = 0;
    let totalFinal = 0;

    rows.forEach(row => {
        const totalInput = row.querySelector('input[name^="detalle_total"]');

        if (totalInput) {
            const totalItem = parseFloat(totalInput.value) || 0;
            subTotal += totalItem;
        }
    });

    descuentoGlobalMonto = Math.round(subTotal * (descuentoGlobalPorcentaje / 100));
    ivaValor = ((subTotal - descuentoGlobalMonto) * 0.19).toFixed(2);  // 19% IVA
    totalFinal = Math.round(subTotal - descuentoGlobalMonto + parseFloat(ivaValor));

    document.getElementById('sub_total').value = Math.round(subTotal);
    document.getElementById('descuento_global_monto').value = descuentoGlobalMonto;
    document.getElementById('monto_neto').value = Math.round(subTotal - descuentoGlobalMonto);
    document.getElementById('total_iva').value = ivaValor;
    document.getElementById('total_final').value = totalFinal;

    calcularPago();
}



/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Detalle total.JS ---------------------------------------
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