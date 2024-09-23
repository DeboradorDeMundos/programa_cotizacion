
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

let tituloContador = 1; // Contador global para los títulos

function addDetailSection() {
    const container = document.getElementById('detalle-container');
    const newSection = document.createElement('div');
    newSection.classList.add('detalle-section');
    newSection.dataset.tituloIndex = tituloContador; // Asigna un índice único al título

    newSection.innerHTML = `
        <div class="detalle-content">
            <div class="titulo-container" style="display: flex; align-items: center;">
                <label for="titulo">Título:</label>
                <input type="text" name="detalle_titulo[${tituloContador}]" required style="margin-right: 10px;">
                <button type="button" class="btn-eliminar-titulo" onclick="removeDetailSection(this)">Eliminar Título</button>
            </div>
            <table class="detalle-table">
                <thead>
                    <!-- Las filas de la cabecera se agregarán aquí -->
                </thead>
                <tbody class="detalle-contenido">
                    <!-- Las filas de detalles y subtítulos se agregarán aquí -->
                </tbody>
            </table>
        </div>
        <div class="detalle-buttons">
            <button type="button" onclick="addDetailRow(this)">Agregar detalles</button>
            <button type="button" onclick="agregarSubtitulo(this)">Agregar subtítulo</button>
        </div>
    `;
    container.appendChild(newSection);
    tituloContador++; // Incrementa el contador de títulos
}

function removeDetailSection(button) {
    if (confirm('¿Estás seguro de que quieres eliminar esta sección?')) {
        const section = button.closest('.detalle-section');
        section.remove();
        calculateTotals();
    }
}

function addcabeza(button) {   
    const section = button.closest('.detalle-section');
    const tableHead = section.querySelector('thead');
    const tableBody = section.querySelector('.detalle-contenido');

    // Verifica si ya hay un encabezado para evitar duplicados
    if (!tableHead.querySelector('tr') && !tableBody.querySelector('.subtitulo')) {
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



function addDetailRow(button) {
    const section = button.closest('.detalle-section');
    const tableBody = section.querySelector('.detalle-contenido');
    const tableHead = section.querySelector('thead');
    const tituloIndex = section.dataset.tituloIndex; // Obtiene el índice del título

    // Verificar si ya existe una cabecera
    const existeCabecera = tableHead.querySelector('tr');

    // Obtener la última fila del tbody
    const lastRow = tableBody.lastElementChild;

    // Si no hay cabecera y no es un subtítulo, agregarla
    if (!existeCabecera && (!lastRow || !lastRow.classList.contains('subtitulo'))) {
        addcabeza(button);
    }

    // Si el último elemento es un subtítulo, agregar cabecera después de él
    if (lastRow && lastRow.classList.contains('subtitulo')) {
        const newHeaderRow = document.createElement('tr');
        newHeaderRow.innerHTML = `
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
        // Insertar la cabecera después del subtítulo
        tableBody.insertBefore(newHeaderRow, lastRow.nextSibling);
        
    }

    // Crear una nueva fila de detalle
    const newRow = document.createElement('tr');
    newRow.innerHTML = `
        <td>
            <select name="tipo_producto[${tituloIndex}][]">
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
        <td><input type="text" name="nombre_producto[${tituloIndex}][]"></td>
        <td><input type="checkbox" onclick="toggleDescription(this)"></td>
        <td><input type="number" name="detalle_cantidad[${tituloIndex}][]" step="1" min="1" required oninput="updateTotal(this)"></td>
        <td><input type="number" name="detalle_precio_unitario[${tituloIndex}][]" step="0.01" min="0" required oninput="updateTotal(this)"></td>
        <td><input type="number" name="detalle_descuento[${tituloIndex}][]" step="1" min="0" required oninput="updateTotal(this)"></td>
        <td><input type="number" name="detalle_total[${tituloIndex}][]" step="0.01" min="0" readonly></td>
        <td><button type="button" class="btn-eliminar" onclick="removeDetailRow(this)">Eliminar</button></td>
    `;

    // Agregar la nueva fila de detalle al final del cuerpo de la tabla
    tableBody.appendChild(newRow);

    // Fila opcional de descripción
    const descriptionRow = document.createElement('tr');
    descriptionRow.className = 'descripcion-row';
    descriptionRow.style.display = 'none';
    descriptionRow.innerHTML = `
        <td colspan="7">
            <textarea name="detalle_descripcion[${tituloIndex}][]" placeholder="Ingrese sólo si requiere ingresar una descripción extendida del producto o servicio"></textarea>
        </td>
    `;
    tableBody.appendChild(descriptionRow);

    calculateTotals();
}


function agregarSubtitulo(button) {
    const section = button.closest('.detalle-section');
    const tableBody = section.querySelector('.detalle-contenido');
    const tituloIndex = section.dataset.tituloIndex; // Obtiene el índice del título

    // Crear una nueva fila de subtítulo
    const newSubtitle = document.createElement('tr');
    newSubtitle.classList.add('subtitulo');
    newSubtitle.innerHTML = `
        <td colspan="7">
            <label for="subtitulo">Subtítulo:</label>
            <input type="text" name="detalle_subtitulo[${tituloIndex}][]" style="margin-right: 10px;">
        </td>
        <td><button type="button" class="btn-eliminar-titulo" onclick="borrarSubtitulo(this)">Eliminar subtítulo</button></td>
    `;

    // Agregar el subtítulo al final de todas las filas de detalles actuales
    tableBody.appendChild(newSubtitle);
}

function borrarSubtitulo(button) {
    // Encuentra la fila del subtítulo
    const row = button.closest('tr');

    // Elimina la fila del subtítulo
    if (row) {
        row.remove();
    }
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
    


function removeCabeza(button) {
    const tableHead = button.closest('.detalle-section').querySelector('thead');

    // Verifica si hay una fila para eliminar
    const row = tableHead.querySelector('tr');
    if (row) {
        row.remove(); // Elimina la fila del encabezado
    }

    calculateTotals(); // Recalcular los totales después de eliminar
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