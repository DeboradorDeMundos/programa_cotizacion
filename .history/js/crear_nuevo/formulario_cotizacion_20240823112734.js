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
                document.getElementById('empresa-rut').textContent = data.rut;
                document.getElementById('numero_cotizacion').value = cotizacionNumero;
            } else if (data.error) {
                console.error(data.error);
            }
        })
        .catch(error => {
            console.error('Error al obtener el RUT de la empresa:', error);
        });
});


function addDetailRow() {
    var table = document.getElementById("detalle_cotizacion");
    var rowCount = table.rows.length;
    var row = table.insertRow(rowCount);

    row.innerHTML = `
        <td><input type="text" name="detalle_descripcion[]" required></td>
        <td><input type="number" name="detalle_cantidad[]" step="1" min="1" required></td>
        <td><input type="number" name="detalle_precio_unitario[]" step="0.01" min="0" required></td>
        <td><input type="number" name="detalle_descuento[]" step="0.01" min="0" value="0"></td>
        <td><button type="button" onclick="removeDetailRow(this)">Eliminar</button></td>
    `;
}

function removeDetailRow(button) {
    var row = button.parentNode.parentNode;
    row.parentNode.removeChild(row);
}