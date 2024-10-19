
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
    -------------------------------------- INICIO ITred Spa Traer detalle .JS --------------------------------------
    ------------------------------------------------------------------------------------------------------------- */


// Título: Manejo de secciones de detalle en un formulario
// Detalle: Este script se encarga de agregar secciones de detalle 
// dinámicamente al formulario y manejar notas y subtítulos.

document.addEventListener('DOMContentLoaded', function() {
    console.log("El DOM está completamente cargado"); // Mensaje de depuración
    AgregarSeccionDeDetalle(); // Agrega la primera sección de detalle al cargar la página
});

// Contadores para títulos y subtítulos
let tituloContador = 0; // Contador global para los títulos
let subtituloContador = {}; // Objeto para contar subtítulos por título

// Título: Función para agregar una nueva sección de detalle
// Detalle: Crea y agrega una nueva sección con un título, notas y una tabla al contenedor.
function AgregarSeccionDeDetalle() {
    const contenedor = document.getElementById('detalle-contenedor'); // Obtener el contenedor principal
    const NuevaSeccion = document.createElement('div'); // Crear un nuevo div para la sección
    NuevaSeccion.classList.add('seccion-detalle'); // Agregar clase a la sección
    NuevaSeccion.dataset.IndiceTitulo = tituloContador; // Asignar un índice único al título

    subtituloContador[tituloContador] = 0; // Inicializar el contador de subtítulos para este título

    // Contenido HTML de la nueva sección
    NuevaSeccion.innerHTML = `
        <div class="detalle-content">
            <div class="titulo-contenedor" style="display: flex; align-items: center;">
                <label for="titulo">Título:</label>
                <input type="text" name="detalle_titulo[${tituloContador}]" required style="margin-right: 10px;" oninput="QuitarCaracteresInvalidos(this)">
                <button type="button" class="btn-eliminar-titulo" onclick="QuitarSeccionDeDetalle(this)">Eliminar Título</button>
            </div>
            <div class="notas-contenedor">
                <!-- Las notas se agregarán aquí -->
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
            <button type="button" onclick="agregarNota(this)">Agregar nota</button>
        </div>
    `;
    contenedor.appendChild(NuevaSeccion); // Agregar la nueva sección al contenedor
    tituloContador++; // Incrementar el contador de títulos
}

// Título: Función para agregar una nueva nota
// Detalle: Crea una nueva nota y la agrega al contenedor de notas dentro de una sección.
function agregarNota(button) {
    const section = button.closest('.seccion-detalle'); // Obtener la sección más cercana
    const indiceTitulo = section.dataset.IndiceTitulo; // Obtener el índice del título
    const notasContenedor = section.querySelector('.notas-contenedor'); // Obtener el contenedor de notas

    // Verificar si ya existe una nota de cada color
    const existingNotes = Array.from(notasContenedor.querySelectorAll('.nota'));
    const colorsUsed = existingNotes.map(note => note.querySelector('select').value);

    // Limitar la cantidad de colores usados a 3
    if (colorsUsed.length >= 3) {
        alert('Ya se han agregado notas de todos los colores.'); // Alerta si se excede el límite
        return; // Salir de la función si se alcanza el límite
    }

    const nota = document.createElement('div'); // Crear un nuevo div para la nota
    nota.classList.add('nota', 'input-group'); // Agregar clases para la nota

    // Usar un contador similar al de los subtítulos para cada nota
    const contadorNota = existingNotes.length + 1; // Contador para las notas

    // Contenido HTML de la nueva nota
    nota.innerHTML = `
        <select name="nota_color[${indiceTitulo}][${contadorNota}]" required onchange="actualizarColoresDisponibles(this)">
            <option value="" disabled selected>Seleccione color</option>
            <option value="rojo" style="color: red;" ${colorsUsed.includes('rojo') ? 'disabled' : ''}>Rojo</option>
            <option value="naranjo" style="color: orange;" ${colorsUsed.includes('naranjo') ? 'disabled' : ''}>Naranjo</option>
            <option value="verde" style="color: green;" ${colorsUsed.includes('verde') ? 'disabled' : ''}>Verde</option>
        </select>
        <input type="text" name="nota_texto[${indiceTitulo}][${contadorNota}]" required>
        <button type="button" class="btn-eliminar-nota" onclick="borrarNota(this)">Eliminar nota</button>
    `;
    
    notasContenedor.appendChild(nota); // Agregar la nueva nota al contenedor de notas
}

// Título: Función para actualizar la disponibilidad de colores
// Detalle: Deshabilita opciones de colores en el selector según las notas existentes.
function actualizarColoresDisponibles(selectElement) {
    const section = selectElement.closest('.seccion-detalle'); // Obtener la sección más cercana
    const notasContenedor = section.querySelector('.notas-contenedor'); // Obtener el contenedor de notas
    const existingNotes = Array.from(notasContenedor.querySelectorAll('.nota select')); // Obtener todas las notas

    // Actualizar la disponibilidad de colores
    const colorsUsed = existingNotes.map(note => note.value); // Obtener colores usados
    existingNotes.forEach(note => {
        const options = note.querySelectorAll('option'); // Obtener todas las opciones del selector
        options.forEach(option => {
            // Deshabilitar opciones si el color ya está en uso
            option.disabled = colorsUsed.includes(option.value) && option.value !== note.value;
        });
    });
}

// Título: Función para eliminar una sección de detalle
// Detalle: Elimina la sección de detalle si el usuario confirma la acción.
function QuitarSeccionDeDetalle(button) {
    if (confirm('¿Estás seguro de que quieres eliminar esta sección?')) {
        const section = button.closest('.seccion-detalle'); // Obtener la sección más cercana
        section.remove(); // Eliminar la sección
        CalcularTotales(); // Recalcular totales si es necesario
    }
}

// Título: Función para agregar la cabecera a una tabla
// Detalle: Crea y agrega una fila de cabecera a la tabla si aún no existe.
function AgregarCabeza(button) {   
    const section = button.closest('.seccion-detalle'); // Obtener la sección más cercana
    const CabeceraTabla = section.querySelector('thead'); // Obtener el encabezado de la tabla
    const CuerpoTabla = section.querySelector('.detalle-contenido'); // Obtener el cuerpo de la tabla

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
            <th class="hidden-column">COLOR</th>
            <th class="hidden-column">ACCIÓN</th>
            <th class="hidden-column"></th> <!-- Espacio para el botón de eliminar cabecera -->
        `;
        CabeceraTabla.appendChild(NuevaLineaDeCabecera); // Agregar la nueva línea de cabecera

        // Asegúrate de que solo las columnas con la clase 'hidden-column' estén ocultas
        const ColumnasOcultas = CabeceraTabla.querySelectorAll('.hidden-column');
        ColumnasOcultas.forEach(column => {
            column.style.display = 'none'; // Ocultar las columnas que no deben mostrarse
        });
    }
}

// Título: Función para agregar una nueva línea de detalle
// Detalle: Crea una nueva fila de detalle en la tabla correspondiente a la sección de detalle,
//          verifica la existencia de una cabecera y la agrega si es necesario.
function AgregarLineaDeDetalle(button) { 
    const section = button.closest('.seccion-detalle'); // Obtener la sección del detalle
    const CuerpoTabla = section.querySelector('.detalle-contenido'); // Obtener el cuerpo de la tabla
    const CabeceraTabla = section.querySelector('thead'); // Obtener la cabecera de la tabla
    const IndiceTitulo = section.dataset.IndiceTitulo; // Obtener el índice del título

    // Verificar si ya existe una cabecera
    const existeCabecera = section.querySelector('thead tr');

    // Obtener el índice del subtítulo
    const subIndiceTitulo = subtituloContador[IndiceTitulo];

    // Obtener la última fila del tbody
    const UltimaFila = CuerpoTabla.lastElementChild;

    // Si no hay cabecera y no es un subtítulo, agregarla
    if (!existeCabecera && (!UltimaFila || !UltimaFila.classList.contains('subtitulo'))) {
        AgregarCabeza(button); // Llamar a la función para agregar la cabecera
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
            <th>COLOR</th>
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
        <td class="hidden-column"><input type="number" name="detalle_precio_unitario[${IndiceTitulo}][${subIndiceTitulo}][]" step="0" min="0" required oninput="ActualizarTotal(this)" oninput="QuitarCaracteresInvalidos(this)"></td>
        <td class="hidden-column"><input type="number" name="detalle_descuento[${IndiceTitulo}][${subIndiceTitulo}][]" step="1" min="0" required oninput="ActualizarTotal(this)" oninput="QuitarCaracteresInvalidos(this)"></td>
        <td class="hidden-column"><input type="number" name="detalle_total[${IndiceTitulo}][${subIndiceTitulo}][]" step="0" min="0" readonly></td>
        <td class="hidden-column">
            <select name="color[${IndiceTitulo}][${subIndiceTitulo}][]">
                <option value="negro" style="color: black;" selected>Negro</option>
                <option value="verde" style="color: green;">Verde</option>
                <option value="naranjo" style="color: orange;">Naranjo</option>
                <option value="rojo" style="color: red;">Rojo</option>
            </select>
        </td>
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

    CalcularTotales(); // Calcular totales después de agregar la nueva línea
}

// Título: Función para capturar el tipo de producto seleccionado y cambiar columnas
// Detalle: Actualiza la visibilidad de las columnas en la fila de detalle según el tipo de producto seleccionado.
function CapturarTipoYCambiar(selectElement) {
    // Obtener la fila más cercana al elemento select
    const row = selectElement.closest('tr');
    // Seleccionar todas las columnas ocultas en la fila
    const ColumnasOcultas = row.querySelectorAll('.hidden-column');
    // Obtener la primera celda de la fila (que contiene el select)
    const PrimeraCelda = row.firstElementChild; // Se refiere a la celda del select

    // Verificar si el valor seleccionado no está vacío
    if (selectElement.value !== "") {
        PrimeraCelda.setAttribute('colspan', '1'); // Cambiar colspan a 1
        // Ocultar todas las columnas ocultas
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
            row.querySelector('td.hidden-column:nth-of-type(9)').style.display = "table-cell"; // Total

            // Si existe la columna vacía, elimínala
            const emptyPriceCell = row.querySelector('td.hidden-column:nth-of-type(9)'); // Asumiendo que la columna vacía es la 9
            if (emptyPriceCell) {
                row.removeChild(emptyPriceCell); // Eliminar la columna vacía
            }
        } else {
            // Mostrar todas las columnas ocultas si no es "otros" ni "extras"
            ColumnasOcultas.forEach(column => {
                column.style.display = "table-cell"; // Mostrar columnas ocultas
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
    
// Título: Función para agregar un nuevo subtítulo
// Detalle: Crea una nueva fila de subtítulo en la tabla, incrementando el contador de subtítulos
//          y asignando valores a los campos de entrada de subtítulo y color.
function agregarSubtitulo(button) {
    const section = button.closest('.seccion-detalle'); // Obtener la sección más cercana al botón
    const CuerpoTabla = section.querySelector('.detalle-contenido'); // Seleccionar el cuerpo de la tabla
    const IndiceTitulo = section.dataset.IndiceTitulo; // Obtener el índice del título

    subtituloContador[IndiceTitulo]++; // Incrementar el contador de subtítulos

    // Crear una nueva fila de subtítulo
    const NuevoSubtitulo = document.createElement('tr');
    NuevoSubtitulo.classList.add('subtitulo'); // Agregar clase 'subtitulo' a la fila

    // Definir el contenido HTML de la nueva fila
    NuevoSubtitulo.innerHTML = `
        <td colspan="9">
            <label for="subtitulo">Subtítulo:</label>
            <input type="text" name="detalle_subtitulo[${IndiceTitulo}][${subtituloContador[IndiceTitulo]}]" style="margin-right: 10px;" oninput="QuitarCaracteresInvalidos(this)">
            <select name="color_subtitulo[${IndiceTitulo}][${subtituloContador[IndiceTitulo]}]" class="color-subtitulo" required style="margin-left: 10px;">
                <option value="negro" selected>Negro</option>
                <option value="rojo">Rojo</option>
                <option value="naranjo">Naranjo</option>
                <option value="verde">Verde</option>
            </select>
            <button type="button" class="btn-eliminar-titulo" onclick="borrarSubtitulo(this)">Eliminar subtítulo</button>
        </td>
    `;

    // Agregar el subtítulo al final de todas las filas de detalles actuales
    CuerpoTabla.appendChild(NuevoSubtitulo);
}

// Título: Función para borrar un subtítulo
// Detalle: Elimina la fila de subtítulo correspondiente al botón presionado.
function borrarSubtitulo(button) {
    const row = button.closest('tr'); // Obtener la fila más cercana al botón
    if (row) {
        row.remove(); // Eliminar la fila del subtítulo
    }
}

// Título: Función para quitar una línea de detalle
// Detalle: Elimina la fila de detalle actual y su línea de descripción asociada si existe.
function QuitarLineaDeDetalle(button) {
    const row = button.closest('tr'); // Obtener la fila más cercana al botón
    const LineaDeDescripcion = row.nextElementSibling; // Obtener la siguiente línea de descripción

    row.remove(); // Eliminar la fila actual
    // Verificar si existe una línea de descripción y eliminarla
    if (LineaDeDescripcion && LineaDeDescripcion.classList.contains('descripcion-row')) {
        LineaDeDescripcion.remove(); // Eliminar la línea de descripción
    }

    calcularTotal(); // Calcular el total después de eliminar la línea
}

// Título: Función para mostrar u ocultar la línea de descripción
// Detalle: Muestra o oculta la línea de descripción según si el checkbox está marcado.
function MostrarDescripcion(checkbox) {
    const LineaDeDescripcion = checkbox.closest('tr').nextElementSibling; // Obtener la línea de descripción
    LineaDeDescripcion.style.display = checkbox.checked ? 'table-row' : 'none'; // Mostrar u ocultar
}

// Título: Función para eliminar la cabecera de la tabla
// Detalle: Elimina la fila de cabecera de la tabla en la sección correspondiente al botón presionado.
function removeCabeza(button) {
    const CabeceraTabla = button.closest('.seccion-detalle').querySelector('thead'); // Obtener la cabecera de la tabla
    const row = CabeceraTabla.querySelector('tr'); // Seleccionar la primera fila en el encabezado
    if (row) {
        row.remove(); // Eliminar la fila del encabezado
    }
    CalcularTotales(); // Recalcular los totales después de eliminar
}

// Título: Función para actualizar el total en una fila de detalle
// Detalle: Calcula el total basado en cantidad, precio unitario y descuento, y lo asigna al campo correspondiente.
function ActualizarTotal(input) {
    const row = input.closest('tr'); // Obtener la fila más cercana al campo de entrada
    const cantidad = parseFloat(row.querySelector('input[name*="detalle_cantidad"]').value) || 0; // Obtener cantidad
    const precioUnitario = parseFloat(row.querySelector('input[name*="detalle_precio_unitario"]').value) || 0; // Obtener precio unitario
    const descuento = parseFloat(row.querySelector('input[name*="detalle_descuento"]').value) || 0; // Obtener descuento

    // Calcular el total
    const total = (cantidad * precioUnitario) - (cantidad * precioUnitario * (descuento / 100)); // Calcular el total
    row.querySelector('input[name*="detalle_total"]').value = total.toFixed(2); // Asignar el total calculado
    console.log("Total calculado:", total); // Mostrar en consola el total calculado

    calcularTotal(); // Llamar a la función que recalcula el total general
}

// Título: Función para calcular el total general
// Detalle: Suma todos los totales de los detalles, aplica el descuento global y calcula el IVA y el total final.
function calcularTotal() {
    const totalInputs = document.querySelectorAll('input[name*="detalle_total"]'); // Obtener todos los inputs de total
    let subTotal = 0; // Inicializar subtotal
    let descuentoGlobalPorcentaje = parseFloat(document.getElementById('descuento_global_porcentaje').value) || 0; // Obtener el descuento global
    let descuentoGlobalMonto = 0; // Inicializar monto de descuento global
    let ivaValor = 0; // Inicializar valor del IVA
    let totalFinal = 0; // Inicializar total final

    // Calcular el subtotal sumando todos los totales de los inputs
    totalInputs.forEach(totalInput => {
        const totalItem = parseFloat(totalInput.value) || 0; // Obtener total del ítem
        subTotal += totalItem; // Sumar al subtotal
    });

    // Calcular el monto de descuento global
    descuentoGlobalMonto = Math.round(subTotal * (descuentoGlobalPorcentaje / 100));
    ivaValor = ((subTotal - descuentoGlobalMonto) * 0.19).toFixed(2);  // Calcular IVA (19%)
    totalFinal = Math.round(subTotal - descuentoGlobalMonto + parseFloat(ivaValor)); // Calcular total final

    // Actualizar campos de total en el formulario
    document.getElementById('sub_total').value = Math.round(subTotal); // Asignar subtotal
    document.getElementById('descuento_global_monto').value = descuentoGlobalMonto; // Asignar monto de descuento
    document.getElementById('monto_neto').value = Math.round(subTotal - descuentoGlobalMonto); // Asignar monto neto
    document.getElementById('total_iva').value = ivaValor; // Asignar IVA
    document.getElementById('total_final').value = totalFinal; // Asignar total final

    convertirTotalATexto(); // Convertir el número actual a texto para mostrar
    calcularPago(); // Llamar a la función para calcular el pago
}


/* --------------------------------------------------------------------------------------------------------------
    ---------------------------------------- FIN ITred Spa Traer detalle .JS ---------------------------------------
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