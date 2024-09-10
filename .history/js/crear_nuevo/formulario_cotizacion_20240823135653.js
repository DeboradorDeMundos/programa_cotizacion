document.addEventListener('DOMContentLoaded', () => {
    const fechaGeneracion = new Date().toLocaleDateString();
    document.getElementById('fecha-generacion').textContent = fechaGeneracion;

    // Lógica para generar el número de cotización
    const cotizacionNumero = `COT-${Math.floor(Math.random() * 10000)}`;
    document.getElementById('cotizacion-numero').textContent = cotizacionNumero;
    
    // Asignar valores al formulario
    document.getElementById('numero_cotizacion').value = cotizacionNumero;
    document.getElementById('fecha_emision').value = new Date().toISOString().split('T')[0]; // Fecha actual

    // Solicitud AJAX para obtener el RUT de la empresa
    fetch('obtener_rut_empresa.php')
        .then(response => response.json())
        .then(data => {
            if (data.rut) {
                document.getElementById('empresa_rut').textContent = data.rut;
                document.getElementById('numero_cotizacion').value = cotizacionNumero;
            } else if (data.error) {
                console.error(data.error);
            }
        })
        .catch(error => {
            console.error('Error al obtener el RUT de la empresa:', error);
        });
});

function addDetailSection() {
    const container = document.getElementById('detalle-container');
    const titleContainer = document.getElementById('titulos-container');
    
    // Crear una nueva sección de detalle
    const newSection = document.createElement('div');
    newSection.classList.add('detalle-section');
    
    newSection.innerHTML = `
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="detalle_titulo[]" required>
        <button type="button" onclick="addDetailRow(this)">Agregar detalles</button>
        <table class="detalle-table">
            <thead>
                <tr>
                    <th>CANTIDAD</th>
                    <th>DESCRIPCIÓN</th>
                    <th>PRECIO UNI.</th>
                    <th>TOTAL</th>
                    <th>ACCION</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="number" name="detalle_cantidad[]" step="1" min="1" required></td>
                    <td><input type="text" name="detalle_descripcion[]" required></td>
                    <td><input type="number" name="detalle_precio_unitario[]" step="0.01" min="0" required></td>
                    <td><input type="number" name="detalle_total_item[]" step="0.01" min="0" value="0"></td>
                    <td><button type="button" onclick="removeDetailRow(this)">Eliminar</button></td>
                </tr>
            </tbody>
        </table>
    `;
    
    // Insertar la nueva sección antes de la sección de cálculos finales
    container.insertBefore(newSection, document.getElementById('calculos-finales'));
}

function addDetailRow(button) {
    const row = button.parentElement.nextElementSibling;
    const newRow = row.querySelector('tbody').insertRow();
    newRow.innerHTML = `
        <td><input type="number" name="detalle_cantidad[]" step="1" min="1" required></td>
        <td><input type="text" name="detalle_descripcion[]" required></td>
        <td><input type="number" name="detalle_precio_unitario[]" step="0.01" min="0" required></td>
        <td><input type="number" name="detalle_total_item[]" step="0.01" min="0" value="0"></td>
        <td><button type="button" onclick="removeDetailRow(this)">Eliminar</button></td>
    `;
}

function removeDetailRow(button) {
    const row = button.parentElement.parentElement;
    row.parentElement.removeChild(row);
}

function removeDetailSection(button) {
    const section = button.closest('.detalle-section');
    section.remove();
}

function updateTotal(input) {
    const row = input.closest('tr');
    const cantidad = row.querySelector('input[name="detalle_cantidad[]"]').value;
    const precioUnitario = row.querySelector('input[name="detalle_precio_unitario[]"]').value;
    const totalInput = row.querySelector('input[name="detalle_total[]"]');

    const total = (cantidad * precioUnitario).toFixed(2);
    totalInput.value = total;
}
