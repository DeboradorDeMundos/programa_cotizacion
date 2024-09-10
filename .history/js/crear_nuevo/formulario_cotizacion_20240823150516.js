document.addEventListener('DOMContentLoaded', () => {
    // Generar el número de cotización
    const cotizacionNumero = Math.floor(Math.random() * 10000);
    
    // Verificar que el elemento existe antes de asignar el valor
    const numeroCotizacionElement = document.getElementById('numero_cotizacion');
    if (numeroCotizacionElement) {
        numeroCotizacionElement.textContent = cotizacionNumero;
        document.getElementById('numero_cotizacion').value = cotizacionNumero;
    } else {
        console.error('Elemento con id "cotizacion-numero" no encontrado');
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
    const section = button.closest('.detalle-section');
    section.remove();

    calculateTotals();  // Recalcular totales después de eliminar una sección
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
    let descuentoTotal = parseFloat(document.querySelector('input[name="detalle_descuento[]"]').value) || 0;
    let totalConDescuento = 0;

    rows.forEach(row => {
        const totalItem = parseFloat(row.querySelector('input[name="detalle_total[]"]').value) || 0;
        subtotal += totalItem;
    });

    ivaTotal = (subtotal * 0.19).toFixed(2);  // 19% IVA
    totalConDescuento = (subtotal + parseFloat(ivaTotal) - descuentoTotal).toFixed(2);

    document.querySelector('input[name="detalle_neto[]"]').value = subtotal.toFixed(2);
    document.querySelector('input[name="detalle_iva[]"]').value = ivaTotal;
    document.querySelector('input[name="detalle_total[]"]').value = (subtotal + parseFloat(ivaTotal)).toFixed(2);
    document.querySelector('input[name="detalle_total_con_descuento[]"]').value = totalConDescuento;
}
