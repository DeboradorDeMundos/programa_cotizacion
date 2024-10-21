
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

// TÍTULO: ESCUCHA EL EVENTO DOMCONTENTLOADED
    // Función que se ejecuta cuando el DOM está completamente cargado
    document.addEventListener('DOMContentLoaded', function() {
        console.log("El DOM está completamente cargado"); // Mensaje de carga del DOM
        AgregarSeccionDeDetalle(); // Llama a la función para agregar la primera sección de detalle
    });

// TÍTULO: CONTADORES GLOBALES
    // Variables para manejar el conteo de títulos y subtítulos
    let tituloContador = 0; // Contador para el número de títulos
    let subtituloContador = {}; // Objeto para contar subtítulos por título

// TÍTULO: AGREGAR NUEVA SECCIÓN DE DETALLE
    // Función para crear y agregar una nueva sección de detalle al contenedor
    function AgregarSeccionDeDetalle() {
        const contenedor = document.getElementById('detalle-contenedor'); // Obtiene el contenedor
        const NuevaSeccion = document.createElement('div'); // Crea un nuevo div para la sección
        NuevaSeccion.classList.add('seccion-detalle'); // Añade la clase 'seccion-detalle' al nuevo div
        NuevaSeccion.dataset.IndiceTitulo = tituloContador; // Asigna un índice único al título

        subtituloContador[tituloContador] = 0; // Inicializa el contador de subtítulos para este título

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
        contenedor.appendChild(NuevaSeccion); // Inserta la nueva sección en el contenedor
        tituloContador++; // Incrementa el contador de títulos
    }

// TÍTULO: AGREGAR UNA NOTA
    // Función para agregar una nueva nota en la sección de detalle
    function agregarNota(button) {
        const section = button.closest('.seccion-detalle'); // Encuentra la sección contenedora
        const indiceTitulo = section.dataset.IndiceTitulo; // Obtiene el índice del título
        const notasContenedor = section.querySelector('.notas-contenedor'); // Obtiene el contenedor de notas

        // Verificar si ya existe una nota de cada color
        const existingNotes = Array.from(notasContenedor.querySelectorAll('.nota'));
        const colorsUsed = existingNotes.map(note => note.querySelector('select').value);

        // Limitar a tres colores de notas
        if (colorsUsed.length >= 3) {
            alert('Ya se han agregado notas de todos los colores.'); // Mensaje de advertencia
            return; // Sale de la función si ya hay 3 colores
        }

        const nota = document.createElement('div'); // Crea un nuevo div para la nota
        nota.classList.add('nota', 'input-group'); // Añade clases a la nota

        // Usar un contador similar al de los subtítulos para cada nota
        const contadorNota = existingNotes.length + 1; // Establece el contador de notas

        // Contenido HTML de la nota
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
        
        notasContenedor.appendChild(nota); // Inserta la nota en el contenedor de notas
    }

// TÍTULO: ACTUALIZAR COLORES DISPONIBLES
    // Función para actualizar la disponibilidad de colores en las notas
    function actualizarColoresDisponibles(selectElement) {
        const section = selectElement.closest('.seccion-detalle'); // Encuentra la sección contenedora
        const notasContenedor = section.querySelector('.notas-contenedor'); // Obtiene el contenedor de notas
        const existingNotes = Array.from(notasContenedor.querySelectorAll('.nota select')); // Selecciona todos los select de notas

        // Actualiza la disponibilidad de colores
        const colorsUsed = existingNotes.map(note => note.value); // Crea un array con los colores usados
        existingNotes.forEach(note => {
            const options = note.querySelectorAll('option'); // Obtiene todas las opciones del select
            options.forEach(option => {
                option.disabled = colorsUsed.includes(option.value) && option.value !== note.value; // Desactiva opciones ya usadas
            });
        });
    }

// TÍTULO: QUITAR SECCIÓN DE DETALLE
    // Función para eliminar una sección de detalle
    function QuitarSeccionDeDetalle(button) {
        if (confirm('¿Estás seguro de que quieres eliminar esta sección?')) { // Confirmación antes de eliminar
            const section = button.closest('.seccion-detalle'); // Encuentra la sección contenedora
            section.remove(); // Elimina la sección del DOM
            CalcularTotales(); // Llama a la función para recalcular totales (si aplica)
        }
    }

// TÍTULO: AGREGAR CABECERA A LA TABLA
    // Función para agregar un encabezado a la tabla dentro de la sección de detalle
    function AgregarCabeza(button) {   
        const section = button.closest('.seccion-detalle'); // Encuentra la sección contenedora
        const CabeceraTabla = section.querySelector('thead'); // Obtiene el elemento thead de la tabla
        const CuerpoTabla = section.querySelector('.detalle-contenido'); // Obtiene el cuerpo de la tabla

        // Verifica si ya hay un encabezado para evitar duplicados
        if (!CabeceraTabla.querySelector('tr')) {
            // Crear la fila del encabezado con solo la columna 'Tipo' visible inicialmente
            const NuevaLineaDeCabecera = document.createElement('tr'); // Crea una nueva fila
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
            CabeceraTabla.appendChild(NuevaLineaDeCabecera); // Añade la nueva fila al thead

            // Asegúrate de que solo las columnas con la clase 'hidden-column' estén ocultas
            const ColumnasOcultas = CabeceraTabla.querySelectorAll('.hidden-column'); // Selecciona columnas ocultas
            ColumnasOcultas.forEach(column => {
                column.style.display = 'none'; // Oculta las columnas
            });
        }
    }

// TÍTULO: AGREGAR LÍNEA DE DETALLE
    // Función para agregar una nueva línea de detalle a la tabla dentro de la sección de detalle
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

// TÍTULO: CAPTURAR TIPO Y CAMBIAR COLUMNAS VISIBLES
    // Función para capturar el tipo seleccionado y mostrar/ocultar columnas de la fila correspondiente
    function CapturarTipoYCambiar(selectElement) {
        const row = selectElement.closest('tr'); // Obtener la fila más cercana al elemento select
        const ColumnasOcultas = row.querySelectorAll('.hidden-column'); // Seleccionar todas las columnas ocultas en la fila
        const PrimeraCelda = row.firstElementChild; // Se refiere a la celda del select

        // Verificar si el valor seleccionado no está vacío
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

// TÍTULO: AGREGAR SUBTÍTULO
    // Función para agregar un nuevo subtítulo a la sección de detalles
    function agregarSubtitulo(button) {
        const section = button.closest('.seccion-detalle'); // Obtener la sección más cercana al botón que fue presionado
        const CuerpoTabla = section.querySelector('.detalle-contenido'); // Seleccionar el cuerpo de la tabla dentro de la sección
        const IndiceTitulo = section.dataset.IndiceTitulo; // Obtener el índice del título de la sección

        // Incrementar el contador de subtítulos para este título
        subtituloContador[IndiceTitulo]++;

        // Crear una nueva fila de subtítulo
        const NuevoSubtitulo = document.createElement('tr');
        NuevoSubtitulo.classList.add('subtitulo'); // Agregar clase 'subtitulo' a la fila

        // Definir el contenido HTML de la nueva fila, manteniendo la estructura de antes
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

// TÍTULO: BORRAR SUBTÍTULO
    // Función para eliminar un subtítulo de la sección de detalles
    function borrarSubtitulo(button) {
        const row = button.closest('tr'); // Obtener la fila más cercana al botón
        if (row) {
            row.remove(); // Remover la fila
        }
    }

// TÍTULO: QUITAR LÍNEA DE DETALLE
    // Función para eliminar una línea de detalle y su descripción asociada
    function QuitarLineaDeDetalle(button) {
        const row = button.closest('tr'); // Obtener la fila más cercana al botón
        const LineaDeDescripcion = row.nextElementSibling; // Obtener la siguiente línea de descripción en la tabla

        row.remove(); // Eliminar la fila actual
        // Verificar si existe una línea de descripción y eliminarla
        if (LineaDeDescripcion && LineaDeDescripcion.classList.contains('descripcion-row')) {
            LineaDeDescripcion.remove(); // Eliminar la línea de descripción
        }

        calcularTotal(); // Calcular el total después de eliminar la línea
    }

// TÍTULO: MOSTRAR DESCRIPCIÓN
    // Función para mostrar u ocultar la línea de descripción según el estado del checkbox
    function MostrarDescripcion(checkbox) {
        const LineaDeDescripcion = checkbox.closest('tr').nextElementSibling; // Obtener la línea de descripción más cercana al checkbox
        // Mostrar o ocultar la línea de descripción según si el checkbox está marcado
        LineaDeDescripcion.style.display = checkbox.checked ? 'table-row' : 'none';
    }

// TÍTULO: ELIMINAR CABECERA DE LA TABLA
    // Función para eliminar la fila de cabecera de la tabla en la sección correspondiente
    function removeCabeza(button) {
        const CabeceraTabla = button.closest('.seccion-detalle').querySelector('thead'); // Obtener la cabecera de la tabla
        const row = CabeceraTabla.querySelector('tr'); // Seleccionar la primera fila en el encabezado
        
        // Verifica si hay una fila para eliminar
        if (row) {
            row.remove(); // Elimina la fila del encabezado
        }

        CalcularTotales(); // Recalcular los totales después de eliminar
    }

// TÍTULO: ACTUALIZAR TOTAL DE DETALLE
    // Función para actualizar el total en una fila de detalle cuando se modifica algún input
    function ActualizarTotal(input) {
        const row = input.closest('tr'); // Obtener la fila más cercana al campo de entrada que se está modificando
        const cantidad = parseFloat(row.querySelector('input[name*="detalle_cantidad"]').value) || 0; // Obtener cantidad
        const precioUnitario = parseFloat(row.querySelector('input[name*="detalle_precio_unitario"]').value) || 0; // Obtener precio unitario
        const descuento = parseFloat(row.querySelector('input[name*="detalle_descuento"]').value) || 0; // Obtener descuento

        // Calcular el total solo si cantidad y precio unitario son válidos
        const total = (cantidad * precioUnitario) - (cantidad * precioUnitario * (descuento / 100)); // Calcular el total
        row.querySelector('input[name*="detalle_total"]').value = total.toFixed(2); // Asignar el total calculado al campo correspondiente
        console.log("Total calculado:", total); // Mostrar en consola el total calculado

        calcularTotal(); // Llamar a la función que recalcula el total general
    }

// TÍTULO: CALCULAR TOTAL GENERAL
    // Función para calcular el subtotal, descuentos, IVA y total final de todos los detalles
    function calcularTotal() {
        const totalInputs = document.querySelectorAll('input[name*="detalle_total"]'); // Obtener todos los inputs que contienen el total de cada detalle

        let subTotal = 0; // Inicializar subtotal
        let descuentoGlobalPorcentaje = parseFloat(document.getElementById('descuento_global_porcentaje').value) || 0; // Obtener el descuento global porcentual ingresado por el usuario
        let descuentoGlobalMonto = 0; // Inicializar monto de descuento global
        let ivaValor = 0; // Inicializar valor del IVA
        let totalFinal = 0; // Inicializar total final

        // Calcular el subtotal sumando todos los totales de los inputs
        totalInputs.forEach(totalInput => {
            const totalItem = parseFloat(totalInput.value) || 0; // Obtener el total del item, o 0 si está vacío
            subTotal += totalItem; // Sumar al subtotal
        });

        // Calcular el monto de descuento global
        descuentoGlobalMonto = Math.round(subTotal * (descuentoGlobalPorcentaje / 100));
        // Calcular el IVA (19% del subtotal menos el monto de descuento)
        ivaValor = ((subTotal - descuentoGlobalMonto) * 0.19).toFixed(2);  // 19% IVA
        // Calcular el total final
        totalFinal = Math.round(subTotal - descuentoGlobalMonto + parseFloat(ivaValor));

        // Actualizar los campos de total en el formulario
        document.getElementById('sub_total').value = Math.round(subTotal); // Asignar el subtotal
        document.getElementById('descuento_global_monto').value = descuentoGlobalMonto; // Asignar el monto de descuento
        document.getElementById('monto_neto').value = Math.round(subTotal - descuentoGlobalMonto); // Asignar el monto neto
        document.getElementById('total_iva').value = ivaValor; // Asignar el IVA
        document.getElementById('total_final').value = totalFinal; // Asignar el total final

        convertirTotalATexto(); // Convertir el número actual a texto para mostrar

        calcularPago(); // Llamar a la función para calcular el pago
    }

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