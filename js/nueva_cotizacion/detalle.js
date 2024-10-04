
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
let subtituloContador = {}; // Objeto para llevar el conteo de subtítulos por título

function addDetailSection() {
    const container = document.getElementById('detalle-container');
    const newSection = document.createElement('div');
    newSection.classList.add('detalle-section');
    newSection.dataset.tituloIndex = tituloContador; // Asigna un índice único al título

    subtituloContador[tituloContador] = 0; // Inicializa el contador de subtítulos para este título

    newSection.innerHTML = `
        <div class="detalle-content">
            <div class="titulo-container" style="display: flex; align-items: center;">
                <label for="titulo">Título:</label>
                <input type="text" name="detalle_titulo[${tituloContador}]" required style="margin-right: 10px;" oninput="removeInvalidChars(this)">
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
            <button type="button" onclick="agregarSubtitulo(this)">Agregar subtítulo</button>
            <button type="button" onclick="addDetailRow(this)">Agregar detalles</button>
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
    if (!tableHead.querySelector('tr')) {
        // Crear la fila del encabezado con solo la columna 'Tipo' visible inicialmente
        const newHeaderRow = document.createElement('tr');
        newHeaderRow.innerHTML = `
            <th>Tipo</th>
            <th class="hidden-column">Nombre producto</th>
            <th class="hidden-column">DESCRIPCIÓN</th>
            <th class="hidden-column">CANTIDAD</th>
            <th class="hidden-column">PRECIO UNI.</th>
            <th class="hidden-column">DESCUENTO %</th>
            <th class="hidden-column">TOTAL</th>
            <th class="hidden-column">ACCIÓN</th>
            <th class="hidden-column"></th> <!-- Espacio para el botón de eliminar cabecera -->
        `;
        tableHead.appendChild(newHeaderRow);

        // Asegúrate de que solo las columnas con la clase 'hidden-column' estén ocultas
        const hiddenColumns = tableHead.querySelectorAll('.hidden-column');
        hiddenColumns.forEach(column => {
            column.style.display = 'none';
        });
    }
}

function addDetailRow(button) { 
    const section = button.closest('.detalle-section');
    const tableBody = section.querySelector('.detalle-contenido');
    const tableHead = section.querySelector('thead');
    const tituloIndex = section.dataset.tituloIndex;

    // Verificar si ya existe una cabecera
    const existeCabecera = section.querySelector('thead tr');

    // Obtener el índice del subtítulo
    const subtituloIndex = subtituloContador[tituloIndex];

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
        <td colspan="9">
            <select name="tipo_producto[${tituloIndex}][${subtituloIndex}][]" onchange="handleTipoChange(this)">
                <option value="">Seleccione un tipo</option>
                <option value="nuevo">Nuevo</option>
                <option value="insumo">Insumo</option>
                <option value="producto">Producto</option>
                <option value="material">Material</option>
                <option value="ferreteria">Ferretería</option>
                <option value="profesional">Profesional</option>
                <option value="tecnico">Técnico</option>
                <option value="maestro">Maestro</option>
                <option value="ayudante">Ayudante</option>
                <option value="producto_imagen">Producto con Imagen</option>
                <option value="otros">Otros</option>
                <option value="extras_proyecto">Extras del Proyecto</option>
                <option value="horas_extras">Horas Extras</option>
                <option value="seguro">Seguro</option>
                <option value="viatico">Viático</option>
                <option value="bodega">Bodega</option>
                <option value="gastos_generales">Gastos Generales</option>
                <option value="utilidades_empresa">Utilidades de la Empresa</option>
                <option value="garantias">Garantías</option>
                <option value="eventos_perdidas">Eventos o Pérdidas</option>
                <option value="asesoria">Asesoría</option>
            </select>
        </td>
        <td class="hidden-column"><input type="text" name="nombre_producto[${tituloIndex}][${subtituloIndex}][]" oninput="removeInvalidChars(this)"></td>
        <td class="hidden-column"><input type="checkbox" onclick="toggleDescription(this)"></td>
        <td class="hidden-column"><input type="number" name="detalle_cantidad[${tituloIndex}][${subtituloIndex}][]" step="1" min="1" required oninput="updateTotal(this)" oninput="removeInvalidChars(this)"></td>
        <td class="hidden-column"><input type="number" name="detalle_precio_unitario[${tituloIndex}][${subtituloIndex}][]" step="0.01" min="0" required oninput="updateTotal(this)" oninput="removeInvalidChars(this)"></td>
        <td class="hidden-column"><input type="number" name="detalle_descuento[${tituloIndex}][${subtituloIndex}][]" step="1" min="0" required oninput="updateTotal(this)" oninput="removeInvalidChars(this)"></td>
        <td class="hidden-column"><input type="number" name="detalle_total[${tituloIndex}][${subtituloIndex}][]" step="0.01" min="0" readonly></td>
        <td colspan="2" class="hidden-column">
            <button type="button" class="btn-eliminar" onclick="removeDetailRow(this)">Eliminar</button>
        </td>
    `;

    // Agregar la nueva fila de detalle al final del cuerpo de la tabla
    tableBody.appendChild(newRow);

    // Fila opcional de descripción, oculta inicialmente
    const descriptionRow = document.createElement('tr');
    descriptionRow.className = 'descripcion-row';
    descriptionRow.style.display = 'none';
    descriptionRow.innerHTML = `
        <td colspan="9">
            <textarea name="detalle_descripcion[${tituloIndex}][${subtituloIndex}][]" placeholder="Ingrese sólo si requiere ingresar una descripción extendida del producto o servicio" oninput="removeInvalidChars(this)"></textarea>
        </td>
    `;
    tableBody.appendChild(descriptionRow);

    // Asegurarse de que las columnas adicionales estén ocultas desde el principio
    const hiddenColumns = newRow.querySelectorAll('.hidden-column');
    hiddenColumns.forEach(column => {
        column.style.display = 'none';
    });

    calculateTotals();
}


function handleTipoChange(selectElement) {
    const row = selectElement.closest('tr');
    const hiddenColumns = row.querySelectorAll('.hidden-column');
    const firstCell = row.firstElementChild; // Se refiere a la celda del select

    if (selectElement.value !== "") {
        firstCell.setAttribute('colspan', '1'); // Cambiar colspan a 1
        hiddenColumns.forEach(column => {
            column.style.display = "none"; // Ocultar todas las columnas ocultas
        });

        // Mostrar solo los campos específicos para "otros" o "extras del proyecto"
        if (selectElement.value === "otros" || selectElement.value === "extras_proyecto") {
            row.querySelector('td.hidden-column:nth-of-type(2)').style.display = "table-cell"; // Nombre producto
            row.querySelector('td.hidden-column:nth-of-type(3)').style.display = "table-cell"; // Checkbox descripción
            row.querySelector('td.hidden-column:nth-of-type(4)').style.display = "table-cell"; // Cantidad
            
            // Ocultar Precio Unitario y asignar 0
            const priceInput = row.querySelector('input[name^="detalle_precio_unitario"]');
            priceInput.value = 0; // Asignar 0 al precio unitario
            row.querySelector('td.hidden-column:nth-of-type(5)').style.display = "none"; // Ocultar Precio Unitario
            
            row.querySelector('td.hidden-column:nth-of-type(6)').style.display = "table-cell"; // Descuento
            row.querySelector('td.hidden-column:nth-of-type(7)').style.display = "table-cell"; // Total
            row.querySelector('td.hidden-column:nth-of-type(8)').style.display = "table-cell"; // Acción (Eliminar)

            // Si existe la columna vacía, elimínala
            const emptyPriceCell = row.querySelector('td.hidden-column:nth-of-type(9)'); // Asumiendo que la columna vacía es la 9
            if (emptyPriceCell) {
                row.removeChild(emptyPriceCell);
            }
        } else {
            // Mostrar todas las columnas ocultas si no es "otros" ni "extras"
            hiddenColumns.forEach(column => {
                column.style.display = "table-cell"; 
            });
        }
    } else {
        firstCell.setAttribute('colspan', '9'); // Cambiar colspan de vuelta a 9
        hiddenColumns.forEach(column => {
            column.style.display = "none"; // Ocultar las columnas si se vuelve a seleccionar "Seleccione un tipo"
        });
    }

    // Asegurarse de que las otras partes del head de la tabla estén visibles
    const headerCells = document.querySelectorAll('thead th');
    headerCells.forEach(cell => {
        cell.style.display = ""; // Mostrar todas las celdas del encabezado
    });
}

function agregarSubtitulo(button) {
    const section = button.closest('.detalle-section');
    const tableBody = section.querySelector('.detalle-contenido');
    const tituloIndex = section.dataset.tituloIndex; // Obtiene el índice del título

    // Incrementar el contador de subtítulos para este título
    subtituloContador[tituloIndex]++;

    // Crear una nueva fila de subtítulo
    const newSubtitle = document.createElement('tr');
    newSubtitle.classList.add('subtitulo');
    newSubtitle.innerHTML = `
        <td colspan="9">
            <label for="subtitulo">Subtítulo:</label>
            <input type="text" name="detalle_subtitulo[${tituloIndex}][${subtituloContador[tituloIndex]}]" style="margin-right: 10px;" oninput="removeInvalidChars(this)">
            <button type="button" class="btn-eliminar-titulo" onclick="borrarSubtitulo(this)">Eliminar subtítulo</button>
        </td>
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

    calcularTotal();
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

function updateTotal(input) {
    const row = input.closest('tr');
    const cantidad = parseFloat(row.querySelector('input[name*="detalle_cantidad"]').value) || 0;
    const precioUnitario = parseFloat(row.querySelector('input[name*="detalle_precio_unitario"]').value) || 0;
    const descuento = parseFloat(row.querySelector('input[name*="detalle_descuento"]').value) || 0;

    // Calcular el total solo si cantidad y precio unitario son válidos
    const total = (cantidad * precioUnitario) - (cantidad * precioUnitario * (descuento / 100));
    row.querySelector('input[name*="detalle_total"]').value = total.toFixed(2);
    console.log("Total calculado:", total);

    calcularTotal();
}


function calcularTotal() {
    const totalInputs = document.querySelectorAll('input[name*="detalle_total"]');

    let subTotal = 0;
    let descuentoGlobalPorcentaje = parseFloat(document.getElementById('descuento_global_porcentaje').value) || 0;
    let descuentoGlobalMonto = 0;
    let ivaValor = 0;
    let totalFinal = 0;

    totalInputs.forEach(totalInput => {
            const totalItem = parseFloat(totalInput.value) || 0;
            subTotal += totalItem;
    });

    descuentoGlobalMonto = Math.round(subTotal * (descuentoGlobalPorcentaje / 100));
    ivaValor = ((subTotal - descuentoGlobalMonto) * 0.19).toFixed(2);  // 19% IVA
    totalFinal = Math.round(subTotal - descuentoGlobalMonto + parseFloat(ivaValor));

    document.getElementById('sub_total').value = Math.round(subTotal);
    document.getElementById('descuento_global_monto').value = descuentoGlobalMonto;
    document.getElementById('monto_neto').value = Math.round(subTotal - descuentoGlobalMonto);
    document.getElementById('total_iva').value = ivaValor;
    document.getElementById('total_final').value = totalFinal;

    convertirTotalATexto(); // Convertir el número actual a texto

    calcularPago();
}
function init() {
    addDetailSection();
}



window.onload = init;





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