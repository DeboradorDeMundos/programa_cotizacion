
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
    -------------------------------------- INICIO ITred Spa Detalle.JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */

let tituloContador = 1; // Contador global para los títulos
let subtituloContador = {}; // Objeto para llevar el conteo de subtítulos por título

function AgregarSeccionDeDetalle() {
    const contenedor = document.getElementById('detalle-contenedor');
    const NuevaSeccion = document.createElement('div');
    NuevaSeccion.classList.add('seccion-detalle');
    NuevaSeccion.dataset.IndiceTitulo = tituloContador; // Asigna un índice único al título

    subtituloContador[tituloContador] = 0; // Inicializa el contador de subtítulos para este título

    NuevaSeccion.innerHTML = `
        <div class="detalle-content">
            <div class="titulo-contenedor" style="display: flex; align-items: center;">
                <label for="titulo">Título:</label>
                <input type="text" name="detalle_titulo[${tituloContador}]" required style="margin-right: 10px;" oninput="QuitarCaracteresInvalidos(this)">
                <button type="button" class="btn-eliminar-titulo" onclick="QuitarSeccionDeDetalle(this)">Eliminar Título</button>
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
            <button type="button" onclick="AgregarLineaDeDetalle(this)">Agregar detalles</button>
        </div>
    `;
    contenedor.appendChild(NuevaSeccion);
    tituloContador++; // Incrementa el contador de títulos
}

function QuitarSeccionDeDetalle(button) {
    if (confirm('¿Estás seguro de que quieres eliminar esta sección?')) {
        const section = button.closest('.seccion-detalle');
        section.remove();
        CalcularTotales();
    }
}

function AgregarCabeza(button) {   
    const section = button.closest('.seccion-detalle');

    const CabeceraTabla = section.querySelector('thead');
    const CuerpoTabla = section.querySelector('.detalle-contenido');

    // Verifica si ya hay un encabezado para evitar duplicados
    if (!CabeceraTabla.querySelector('tr')) {
        // Crear la fila del encabezado con solo la columna 'Tipo' visible inicialmente
        const NuevaLineaDeCabecera = document.createElement('tr');
        NuevaLineaDeCabecera.innerHTML = `
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
        CabeceraTabla.appendChild(NuevaLineaDeCabecera);

        // Asegúrate de que solo las columnas con la clase 'hidden-column' estén ocultas
        const ColumnasOcultas = CabeceraTabla.querySelectorAll('.hidden-column');
        ColumnasOcultas.forEach(column => {
            column.style.display = 'none';
        });
    }
}

function AgregarLineaDeDetalle(button) { 
    const section = button.closest('.seccion-detalle');
    const CuerpoTabla = section.querySelector('.detalle-contenido');
    const CabeceraTabla = section.querySelector('thead');
    const IndiceTitulo = section.dataset.IndiceTitulo;

    // Verificar si ya existe una cabecera
    const existeCabecera = section.querySelector('thead tr');

    // Obtener el índice del subtítulo
    const subIndiceTitulo = subtituloContador[IndiceTitulo];

    // Obtener la última fila del tbody
    const UltimaFila = CuerpoTabla.lastElementChild;

    // Si no hay cabecera y no es un subtítulo, agregarla
    if (!existeCabecera && (!UltimaFila || !UltimaFila.classList.contains('subtitulo'))) {
        AgregarCabeza(button);
    }

    // Si el último elemento es un subtítulo, agregar cabecera después de él
    if (UltimaFila && UltimaFila.classList.contains('subtitulo')) {
        const NuevaLineaDeCabecera = document.createElement('tr');
        NuevaLineaDeCabecera.innerHTML = `    
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
        CuerpoTabla.insertBefore(NuevaLineaDeCabecera, UltimaFila.nextSibling);  
    }

    // Crear una nueva fila de detalle
    const NuevaFila = document.createElement('tr');
    NuevaFila.innerHTML = `
        <td colspan="9">
        <select name="tipo_producto[${IndiceTitulo}][${subIndiceTitulo}][]" onchange="CapturarTipoYCambiar(this)">
            <option value="">Seleccione un tipo</option>
            
            <optgroup label="Productos">
                <option value="nuevo">Nuevo</option>
                <option value="insumo">Insumo</option>
                <option value="producto">Producto</option>
                <option value="material">Material</option>
                <option value="ferreteria">Ferretería</option>
            </optgroup>
            
            <optgroup label="Personal">
                <option value="profesional">Profesional</option>
                <option value="tecnico">Técnico</option>
                <option value="maestro">Maestro</option>
                <option value="ayudante">Ayudante</option>
            </optgroup>

            <optgroup label="Otros productos">
                <option value="producto_imagen">Producto con Imagen</option>
                <option value="otros">Otros</option>
                <option value="extras_proyecto">Extras del Proyecto</option>
            </optgroup>
            
            <optgroup label="Costos adicionales">
                <option value="horas_extras">Horas Extras</option>
                <option value="seguro">Seguro</option>
                <option value="viatico">Viático</option>
                <option value="bodega">Bodega</option>
                <option value="gastos_generales">Gastos Generales</option>
                <option value="utilidades_empresa">Utilidades de la Empresa</option>
                <option value="garantias">Garantías</option>
                <option value="eventos_perdidas">Eventos o Pérdidas</option>
                <option value="asesoria">Asesoría</option>
            </optgroup>
        </select>
        </td>
        <td class="hidden-column"><input type="text" name="nombre_producto[${IndiceTitulo}][${subIndiceTitulo}][]" oninput="QuitarCaracteresInvalidos(this)"></td>
        <td class="hidden-column"><input type="checkbox" onclick="MostrarDescripcion(this)"></td>
        <td class="hidden-column"><input type="number" name="detalle_cantidad[${IndiceTitulo}][${subIndiceTitulo}][]" step="1" min="1" required oninput="ActualizarTotal(this)" oninput="QuitarCaracteresInvalidos(this)"></td>
        <td class="hidden-column"><input type="number" name="detalle_precio_unitario[${IndiceTitulo}][${subIndiceTitulo}][]" step="0.01" min="0" required oninput="ActualizarTotal(this)" oninput="QuitarCaracteresInvalidos(this)"></td>
        <td class="hidden-column"><input type="number" name="detalle_descuento[${IndiceTitulo}][${subIndiceTitulo}][]" step="1" min="0" required oninput="ActualizarTotal(this)" oninput="QuitarCaracteresInvalidos(this)"></td>
        <td class="hidden-column"><input type="number" name="detalle_total[${IndiceTitulo}][${subIndiceTitulo}][]" step="0.01" min="0" readonly></td>
        <td colspan="2" class="hidden-column">
            <button type="button" class="btn-eliminar" onclick="QuitarLineaDeDetalle(this)">Eliminar</button>
        </td>
    `;

    // Agregar la nueva fila de detalle al final del cuerpo de la tabla
    CuerpoTabla.appendChild(NuevaFila);

    // Fila opcional de descripción, oculta inicialmente
    const LineaDeDescripcion = document.createElement('tr');
    LineaDeDescripcion.className = 'descripcion-row';
    LineaDeDescripcion.style.display = 'none';
    LineaDeDescripcion.innerHTML = `
        <td colspan="9">
            <textarea name="detalle_descripcion[${IndiceTitulo}][${subIndiceTitulo}][]" placeholder="Ingrese sólo si requiere ingresar una descripción extendida del producto o servicio" oninput="QuitarCaracteresInvalidos(this)"></textarea>
        </td>
    `;
    CuerpoTabla.appendChild(LineaDeDescripcion);

    // Asegurarse de que las columnas adicionales estén ocultas desde el principio
    const ColumnasOcultas = NuevaFila.querySelectorAll('.hidden-column');
    ColumnasOcultas.forEach(column => {
        column.style.display = 'none';
    });

    CalcularTotales();
}


function CapturarTipoYCambiar(selectElement) {
    const row = selectElement.closest('tr');
    const ColumnasOcultas = row.querySelectorAll('.hidden-column');
    const PrimeraCelda = row.firstElementChild; // Se refiere a la celda del select

    if (selectElement.value !== "") {
        PrimeraCelda.setAttribute('colspan', '1'); // Cambiar colspan a 1
        ColumnasOcultas.forEach(column => {
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
            ColumnasOcultas.forEach(column => {
                column.style.display = "table-cell"; 
            });
        }
    } else {
        PrimeraCelda.setAttribute('colspan', '9'); // Cambiar colspan de vuelta a 9
        ColumnasOcultas.forEach(column => {
            column.style.display = "none"; // Ocultar las columnas si se vuelve a seleccionar "Seleccione un tipo"
        });
    }

    // Asegurarse de que las otras partes del head de la tabla estén visibles
    const CeldasCabecera = document.querySelectorAll('thead th');
    CeldasCabecera.forEach(cell => {
        cell.style.display = ""; // Mostrar todas las celdas del encabezado
    });
}

function agregarSubtitulo(button) {
    const section = button.closest('.seccion-detalle');
    const CuerpoTabla = section.querySelector('.detalle-contenido');
    const IndiceTitulo = section.dataset.IndiceTitulo; // Obtiene el índice del título

    // Incrementar el contador de subtítulos para este título
    subtituloContador[IndiceTitulo]++;

    // Crear una nueva fila de subtítulo
    const NuevoSubtitulo = document.createElement('tr');
    NuevoSubtitulo.classList.add('subtitulo');
    NuevoSubtitulo.innerHTML = `
        <td colspan="9">
            <label for="subtitulo">Subtítulo:</label>
            <input type="text" name="detalle_subtitulo[${IndiceTitulo}][${subtituloContador[IndiceTitulo]}]" style="margin-right: 10px;" oninput="QuitarCaracteresInvalidos(this)">
            <button type="button" class="btn-eliminar-titulo" onclick="borrarSubtitulo(this)">Eliminar subtítulo</button>
        </td>
    `;

    // Agregar el subtítulo al final de todas las filas de detalles actuales
    CuerpoTabla.appendChild(NuevoSubtitulo);
}

function borrarSubtitulo(button) {
    // Encuentra la fila del subtítulo
    const row = button.closest('tr');

    // Elimina la fila del subtítulo
    if (row) {
        row.remove();
    }
}

function QuitarLineaDeDetalle(button) {
    const row = button.closest('tr');
    const LineaDeDescripcion = row.nextElementSibling;

    row.remove();
    if (LineaDeDescripcion && LineaDeDescripcion.classList.contains('descripcion-row')) {
        LineaDeDescripcion.remove();
    }

    calcularTotal();
}

function MostrarDescripcion(checkbox) {
    const LineaDeDescripcion = checkbox.closest('tr').nextElementSibling;
    LineaDeDescripcion.style.display = checkbox.checked ? 'table-row' : 'none';
}

function removeCabeza(button) {
    const CabeceraTabla = button.closest('.seccion-detalle').querySelector('thead');

    // Verifica si hay una fila para eliminar
    const row = CabeceraTabla.querySelector('tr');
    if (row) {
        row.remove(); // Elimina la fila del encabezado
    }

    CalcularTotales(); // Recalcular los totales después de eliminar
}

function ActualizarTotal(input) {
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
    AgregarSeccionDeDetalle();
}



window.onload = init;





/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Detalle.JS ---------------------------------------
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