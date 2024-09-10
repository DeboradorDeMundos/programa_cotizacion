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
    -------------------------------------- INICIO ITred Spa Nueva_Cotizacion .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */
   
document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('fecha_emision').value = new Date().toISOString().split('T')[0];
});

function calculateAdelanto() {
    const porcentajeAdelanto = parseFloat(document.getElementById('porcentaje_adelanto').value) || 0;
    const totalFinal = parseFloat(document.getElementById('total_final').value) || 0;
    const montoAdelanto = (totalFinal * (porcentajeAdelanto / 100)).toFixed(2);

    document.getElementById('monto_adelanto').value = montoAdelanto;
}
//

function updateTotal(input) {
    const row = input.closest('tr');
    const cantidad = parseFloat(row.querySelector('input[name="detalle_cantidad[]"]').value) || 0;
    const precioUnitario = parseFloat(row.querySelector('input[name="detalle_precio_unitario[]"]').value) || 0;
    const descuento = parseFloat(row.querySelector('input[name="detalle_descuento[]"]').value) || 0;
    const totalInput = row.querySelector('input[name="detalle_total[]"]');

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
        const totalInput = row.querySelector('input[name="detalle_total[]"]');
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

    calculateAdelanto();
}

function formatRut(input) {
    let rut = input.value.replace(/\D/g, '');
    if (rut.length > 1) {
        rut = rut.slice(0, -1).replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '-' + rut.slice(-1);
    }
    input.value = rut;
}

function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const output = document.getElementById('logo-preview');
        output.src = reader.result;
        output.style.display = 'block';
        document.getElementById('logo-text').style.display = 'none';
    }
    reader.readAsDataURL(event.target.files[0]);
}

function togglePaymentInfo(checkbox) {
    const table = checkbox.closest('table');
    const paymentInfoContainer = table.querySelector('.payment-info');
    const paymentHeader = table.querySelector('.payment-header');

    if (checkbox.checked) {
        paymentInfoContainer.style.display = 'table-row-group';
        paymentHeader.style.display = 'table-row';
    } else {
        paymentInfoContainer.style.display = 'none';
        paymentHeader.style.display = 'none';
    }
}

/* --------------------------------------------------------------------------------------------------------------
    --------------------------------------- FINAL ITred Spa Nueva_Cotizacion .JS ----------------------------------------
-----
    
    /* --------------------------------------------------------------------------------------------------------------
        ---------------------------------------- FIN ITred Spa Nueva_Cotizacion .JS ---------------------------------------
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