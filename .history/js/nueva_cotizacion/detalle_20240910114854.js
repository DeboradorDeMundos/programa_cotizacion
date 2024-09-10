
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
    -------------------------------------- INICIO ITred Spa Detalle.JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

    function addcabeza(button) {   
        const tableHead = button.closest('.detalle-section').querySelector('thead');
    
        // Verifica si ya hay un encabezado para evitar duplicados
        if (!tableHead.querySelector('tr')) {
            // Crear la fila del encabezado
            const new2row = document.createElement('tr');
            new2row.innerHTML = `
                <th>Tipo</th>
                <th>Nombre producto</th>
                <th>DESCRIPCIÓN</th>
                <th>CANTIDAD</th>
                <th>PRECIO UNI.</th>
                <th>DESCUENTO %</th>
                <th>TOTAL</th>
                <th>ACCIÓN</th>
                <th></th> <!-- Espacio para el botón de eliminar cabecera -->
            `;
            tableHead.appendChild(new2row);
    
            // Crear el botón para eliminar el encabezado
            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.className = 'btn-eliminar-titulo';
            removeButton.textContent = 'Eliminar cabecera';
            removeButton.onclick = () => removeCabeza(button);
    
            // Añadir el botón al final de la fila
            new2row.querySelector('th:last-child').appendChild(removeButton);
        }
    }
    
    function removeCabeza(button) {
        const tableHead = button.closest('.detalle-section').querySelector('thead');
    
        // Verifica si hay una fila para eliminar
        const row = tableHead.querySelector('tr');
        if (row) {
            row.remove(); // Elimina la fila del encabezado
        }
    
        calculateTotals(); // Recalcular los totales después de eliminar
    }
    
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestión de Cotizaciones</title>
        <style>
            /* Estilos opcionales para mejorar la apariencia */
            .detalle-section { margin-bottom: 20px; }
            .detalle-table { width: 100%; border-collapse: collapse; }
            .detalle-table th, .detalle-table td { border: 1px solid #ddd; padding: 8px; }
            .detalle-buttons { margin-top: 10px; }
        </style>
    </head>
    <body>
    
    <form action="guardar_cotizacion.php" method="POST">
        <fieldset>
            <legend>Detalle de la Cotización</legend>
            <div id="detalle-container">
                <div class="detalle-section">
                    <div class="detalle-content">
                        <div class="titulo-container" style="display: flex; align-items: center;">
                            <label for="titulo">Título:</label>
                            <input type="text" name="detalle_titulo[]" required style="margin-right: 10px;">
                            <button type="button" class="btn-eliminar-titulo" onclick="removeDetailSection(this)">Eliminar Título</button>
                        </div>
                        <table class="detalle-table">
                            <thead>
                                <tr>
                                    <th>Tipo</th>
                                    <th>Nombre Producto</th>
                                    <th>Descripción</th>
                                    <th>Cantidad</th>
                                    <th>Precio Unitario</th>
                                    <th>Descuento (%)</th>
                                    <th>Total</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody class="detalle-contenido">
                                <!-- Las filas de detalles y subtítulos se agregarán aquí -->
                            </tbody>
                        </table>
                    </div>
                    <div class="detalle-buttons">
                        <button type="button" onclick="addcabeza(this)">Agregar Cabecera</button>
                        <button type="button" onclick="addDetailRow(this)">Agregar detalles</button>
                        <button type="button" onclick="addSubtitleRow(this)">Agregar subtítulo</button>
                    </div>
                </div>
            </div>
            <div class="fixed-button-container">
                <button type="submit">Guardar Cotización</button>
            </div>
        </fieldset>
    </form>
    
    <script>
        function addDetailSection() {
            const container = document.getElementById('detalle-container');
            const newSection = document.createElement('div');
            newSection.classList.add('detalle-section');
            newSection.innerHTML = `
                <div class="detalle-content">
                    <div class="titulo-container" style="display: flex; align-items: center;">
                        <label for="titulo">Título:</label>
                        <input type="text" name="detalle_titulo[]" required style="margin-right: 10px;">
                        <button type="button" class="btn-eliminar-titulo" onclick="removeDetailSection(this)">Eliminar Título</button>
                    </div>
                    <table class="detalle-table">
                        <thead>
                            <tr>
                                <th>Tipo</th>
                                <th>Nombre Producto</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Precio Unitario</th>
                                <th>Descuento (%)</th>
                                <th>Total</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody class="detalle-contenido">
                            <!-- Las filas de detalles y subtítulos se agregarán aquí -->
                        </tbody>
                    </table>
                </div>
                <div class="detalle-buttons">
                    <button type="button" onclick="addDetailRow(this)">Agregar detalles</button>
                    <button type="button" onclick="addSubtitleRow(this)">Agregar subtítulo</button>
                </div>
            `;
            container.appendChild(newSection);
        }
    
        function removeDetailSection(button) {
            if (confirm('¿Estás seguro de que quieres eliminar esta sección?')) {
                const section = button.closest('.detalle-section');
                section.remove();
                calculateTotals();
            }
        }
    
        function addDetailRow(button) {
            const tableBody = button.closest('.detalle-section').querySelector('.detalle-contenido');
            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td>
                    <select name="tipo_producto[]">
                        <option value="nuevo">Nuevo</option>
                        <option value="insumo">Insumo</option>
                        <option value="producto">Producto</option>
                        <option value="material">Material</option>
                        <option value="ferreteria">Ferretería</option>
                        <option value="profesional">Profesional</option>
                        <option value="tecnico">Técnico</option>
                        <option value="maestro">Maestro</option>
                        <option value="ayudante">Ayudante</option>
                    </select>
                </td>
                <td><input type="text" name="nombre_producto[]"></td>
                <td><input type="checkbox" onclick="toggleDescription(this)"></td>
                <td><input type="number" name="detalle_cantidad[]" step="1" min="1" required oninput="updateTotal(this)"></td>
                <td><input type="number" name="detalle_precio_unitario[]" step="0.01" min="0" required oninput="updateTotal(this)"></td>
                <td><input type="number" name="detalle_descuento[]" step="1" min="0" required oninput="updateTotal(this)"></td>
                <td><input type="number" name="detalle_total[]" step="0.01" min="0" readonly></td>
                <td><button type="button" class="btn-eliminar" onclick="removeDetailRow(this)">Eliminar</button></td>
            `;
            tableBody.appendChild(newRow);
    
            const descriptionRow = document.createElement('tr');
            descriptionRow.className = 'descripcion-row';
            descriptionRow.style.display = 'none';
            descriptionRow.innerHTML = `
                <td colspan="7">
                    <textarea name="detalle_descripcion[]" placeholder="Ingrese sólo si requiere ingresar una descripción extendida del producto o servicio"></textarea>
                </td>
            `;
            tableBody.appendChild(descriptionRow);
    
            calculateTotals();
        }
    
        function addSubtitleRow(button) {
            const tableBody = button.closest('.detalle-section').querySelector('.detalle-contenido');
            const newSubtitle = document.createElement('tr');
            newSubtitle.classList.add('subtitulo');
            newSubtitle.innerHTML = `
                <td colspan="7">
                    <label for="subtitulo">Subtítulo:</label>
                    <input type="text" name="detalle_subtitulo[]" style="margin-right: 10px;">
                </td>
                <td><button type="button" class="btn-eliminar-titulo" onclick="removeSubtitleRow(this)">Eliminar subtítulo</button></td>
            `;
            tableBody.appendChild(newSubtitle);
        }
    
        function removeSubtitleRow(button) {
            const subtitle = button.closest('tr');
            subtitle.remove();
        }
    
        function removeDetailRow(button) {
            const row = button.closest('tr');
            const descriptionRow = row.nextElementSibling;
    
            row.remove();
            if (descriptionRow && descriptionRow.classList.contains('descripcion-row')) {
                descriptionRow.remove();
            }
    
            calculateTotals();
        }
    
        function toggleDescription(checkbox) {
            const descriptionRow = checkbox.closest('tr').nextElementSibling;
            descriptionRow.style.display = checkbox.checked ? 'table-row' : 'none';
        }
    
        function updateTotal(input) {
            const row = input.closest('tr');
            const cantidad = row.querySelector('input[name="detalle_cantidad[]"]').value;
            const precioUnitario = row.querySelector('input[name="detalle_precio_unitario[]"]').value;
            const descuento = row.querySelector('input[name="detalle_descuento[]"]').value;
    
            const total = cantidad * precioUnitario * (1 - descuento / 100);
            row.querySelector('input[name="detalle_total[]"]').value = total.toFixed(2);
        }
    
        function calculateTotals() {
            // Implementa si necesitas calcular totales en el formulario
        }
    
    

/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Detalle.JS ---------------------------------------
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