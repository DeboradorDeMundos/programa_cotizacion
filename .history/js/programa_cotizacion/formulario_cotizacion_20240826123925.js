
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
    -------------------------------------- INICIO ITred Spa Formulario Cotizacion .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */



document.addEventListener('DOMContentLoaded', () => {
    // Generar el número de cotización
    const cotizacionNumero = Math.floor(Math.random() * 10000);
    
    // Verificar que el elemento existe antes de asignar el valor
    const numeroCotizacionElement = document.getElementById('numero_cotizacion');
    if (numeroCotizacionElement) {
        numeroCotizacionElement.value = cotizacionNumero;
    } else {
        console.error('Elemento con id "numero_cotizacion" no encontrado');
    }

    document.getElementById('fecha_emision').value = new Date().toISOString().split('T')[0]; // Fecha actual
});

function addDetailRow(button) {
    const tableBody = button.closest('.detalle-section').querySelector('tbody');
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td><input type="number" name="detalle_cantidad[]" step="1" min="1" required oninput="updateTotal(this)"></td>
        <td><input type="text" name="detalle_descripcion[]" required></td>
        <td><input type="number" name="detalle_precio_unitario[]" step="0.01" min="0" required oninput="updateTotal(this)"></td>
        <td><input type="number" name="detalle_total[]" step="0.01" min="0" readonly></td>
        <td><button type="button" onclick="removeDetailRow(this)">Eliminar</button></td>
    `;
    tableBody.appendChild(newRow);

    calculateTotals();  // Recalcular totales después de agregar una nueva fila
}

function removeDetailRow(button) {
    const row = button.parentElement.parentElement;
    row.remove();

    calculateTotals();  // Recalcular totales después de eliminar una fila
}

function addDetailSection() {
    const container = document.getElementById('detalle-container');
    const newSection = document.createElement('div');
    newSection.classList.add('detalle-section');
    newSection.innerHTML = `
        <label for="titulo">Título:</label>
        <input type="text" name="detalle_titulo[]" required>
        <button type="button" onclick="addDetailRow(this)">Agregar detalles</button>
        <button type="button" onclick="removeDetailSection(this)">Eliminar Sección</button>
        <table class="detalle-table">
            <thead>
                <tr>
                    <th>CANTIDAD</th>
                    <th>DESCRIPCIÓN</th>
                    <th>PRECIO UNI.</th>
                    <th>TOTAL</th>
                    <th>ACCIÓN</th>
                </tr>
            </thead>
            <tbody>
                <!-- Las filas de detalles se agregarán aquí -->
            </tbody>
        </table>
    `;
    container.appendChild(newSection);
}

function removeDetailSection(button) {
    // Mostrar un cuadro de diálogo de confirmación
    const confirmacion = confirm('¿Estás seguro de que quieres eliminar esta sección?');

    // Si el usuario confirma, proceder con la eliminación
    if (confirmacion) {
        const section = button.closest('.detalle-section');
        section.remove();

        calculateTotals();  // Recalcular totales después de eliminar una sección
    }
}

function updateTotal(input) {
    const row = input.closest('tr');
    const cantidad = parseFloat(row.querySelector('input[name="detalle_cantidad[]"]').value) || 0;
    const precioUnitario = parseFloat(row.querySelector('input[name="detalle_precio_unitario[]"]').value) || 0;
    const totalInput = row.querySelector('input[name="detalle_total[]"]');

    const total = (cantidad * precioUnitario).toFixed(2);
    totalInput.value = total;

    calculateTotals();  // Recalcular totales después de actualizar una fila
}

function calculateTotals() {
    const rows = document.querySelectorAll('.detalle-section .detalle-table tbody tr');
    let subtotal = 0;
    let ivaTotal = 0;
    let descuentoTotal = parseFloat(document.getElementById('detalle_descuento').value) || 0;
    let totalConDescuento = 0;

    rows.forEach(row => {
        const totalItem = parseFloat(row.querySelector('input[name="detalle_total[]"]').value) || 0;
        subtotal += totalItem;
    });

    ivaTotal = (subtotal * 0.19).toFixed(2);  // 19% IVA
    totalConDescuento = (subtotal + parseFloat(ivaTotal) - descuentoTotal).toFixed(2);

    document.getElementById('detalle_neto').value = subtotal.toFixed(2);
    document.getElementById('detalle_iva').value = ivaTotal;
    document.getElementById('detalle_total').value = (subtotal + parseFloat(ivaTotal)).toFixed(2);
    document.getElementById('detalle_total_con_descuento').value = totalConDescuento;
}

function formatRut(input) {
    // Obtiene el valor del campo y elimina los caracteres no numéricos
    let rut = input.value.replace(/\D/g, '');

    // Aplica el formato de RUT
    if (rut.length > 1) {
        rut = rut.slice(0, -1).replace(/\B(?=(\d{3})+(?!\d))/g, '.') + '-' + rut.slice(-1);
    }

    // Asigna el valor formateado de vuelta al campo de entrada
    input.value = rut;
}


/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Formulario Cotizacion .JS ---------------------------------------
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